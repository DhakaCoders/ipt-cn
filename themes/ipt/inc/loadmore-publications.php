<?php
/*
 * initial posts dispaly
 */

function public_script_load_more($args = array()) {
  $year = $type = ''; 
  $taxs = array();

  $query = new WP_Query(array( 
    'post_type'=> 'publication',
    'post_status' => 'publish',
    'posts_per_page'=> 1,
    'orderby' => 'date',
    'order'=> 'DESC'
    ) 
  );
if( $query->have_posts() ):

while($query->have_posts()): $query->the_post();
    $recentID = get_the_ID();
 endwhile;
endif; wp_reset_postdata();

    if ( isset($_GET['type']) && !empty($_GET['type'])){
      $taxs[] = array(
        'taxonomy' => 'publication_type',
        'field' => 'slug',
        'terms' => $_GET['type']
      );
      $type = $_GET['type'];
    }

    if ( isset($_GET['years']) && !empty($_GET['years'])){
      $taxs[] = array(
        'taxonomy' => 'publication_year',
        'field' => 'slug',
        'terms' => $_GET['years']
      );
      $year = $_GET['years'];
    }

    $taxquery = '';
    if( $taxs ){
      if(count($taxs) > 1){
        $taxquery = array(
        'relation' => 'AND',
        $taxs
        );
      } else{
        $taxquery = array($taxs);
      }
    }
    $query2 = new WP_Query(array( 
      'post_type'=> 'publication',
      'post_status' => 'publish',
      'orderby' => 'date',
      'order'=> 'DESC',
      'post__not_in' => array($recentID),
      'tax_query' => $taxquery
      ) 
    );
    


 if( $query2->have_posts()  ):
  echo '<ul class="clearfix reset-list publicatinList" id="public-content">';
      ajax_public_script_load_more($args, $recentID, $type, $year);
  echo '</ul>';
  echo '<div class="fl-see-all-btn">
  <div class="ajaxloading" id="publicloader" style="display:none"><img src="'.THEME_URI.'/assets/images/loading.gif" alt="loader"></div>
   <a href="#" id="publicloadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >Load More</a>';
   echo '</div>';
  else:
  echo '<div class="noresult" style="text-align:center; padding:20px 0;">No Result!</div>';
  endif; wp_reset_postdata();
}
/*
 * create short code.
 */
add_shortcode('ajax_public_posts', 'public_script_load_more');


/*
 * load more script call back
 */
function ajax_public_script_load_more($args, $recentID = '', $type='', $year = '') {
    //init ajax
    $ajax = false;
    //check ajax call or not
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $ajax = true;
    }
    //number of posts per page default
    $num = 1;
    //page number
    $paged = 1;
    if(isset($_POST['page']) && !empty($_POST['page'])){
        $paged = $_POST['page'] + $paged;
    }
    if(isset($_POST['post_id']) && !empty($_POST['post_id'])){
        $recentID = $_POST['post_id'];
    }


    $taxs = array();
   
    if ( isset($_POST['type']) && !empty($_POST['type'])){
      $taxs[] = array(
        'taxonomy' => 'publication_type',
        'field' => 'slug',
        'terms' => $_POST['type']
      );
    }
    if ( isset($type) && !empty($type)){
      $taxs[] = array(
        'taxonomy' => 'publication_type',
        'field' => 'slug',
        'terms' => $type
      );
    }
    if ( isset($_POST['year']) && !empty($_POST['year'])){
      $taxs[] = array(
        'taxonomy' => 'publication_year',
        'field' => 'slug',
        'terms' => $_POST['year']
      );
    }
    if ( isset($year) && !empty($year)){
      $taxs[] = array(
        'taxonomy' => 'publication_year',
        'field' => 'slug',
        'terms' => $year
      );
    }

    $taxquery = '';
    if( $taxs ){
      if(count($taxs) > 1){
        $taxquery = array(
        'relation' => 'AND',
        $taxs
        );
      } else{
        $taxquery = array($taxs);
      }
    }
    $query = new WP_Query(array( 
      'post_type'=> 'publication',
      'post_status' => 'publish',
      'posts_per_page' =>$num,
      'paged'=>$paged,
      'orderby' => 'date',
      'order'=> 'DESC',
      'post__not_in' => array($recentID),
      'tax_query' => $taxquery
      ) 
    );
    if($query->have_posts()){
    $post_count = $query->found_posts;
    while($query->have_posts()): $query->the_post();
    $attach_id = get_post_thumbnail_id(get_the_ID());
    if( !empty($attach_id) )
      $pub_tag = cbv_get_image_tag($attach_id,'publicationgird');
    else
      $pub_tag = ''; 
    ?>
    <li>
      <div class="filter-result-items">
        <div class="filter-result-items-des">
            <h3 class="publicatons-sec-one-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <span><?php echo get_the_date('Y'); ?> | Policy Brief</span>
            <?php echo wpautop(cbv_limit_excerpt()); ?>
        </div>
        <div class="filter-result-items-img">
          <?php echo $pub_tag; ?>
          <div class="rp-desc">
            <h4><?php the_title(); ?></h4>
            <span>Publication <?php echo get_the_date('Y'); ?> | Policy Brief</span>
          </div>
        </div>
      </div>
    </li>
    <?php
    endwhile;

    if( $post_count <= $num  ){
      echo '<style>.fl-see-all-btn{display:none;}</style>';
    }
     
    }else{
      //echo '<div class="postnot-found" style="text-align:center; padding:20px 0;">No results!</div>';
      echo '<style>.fl-see-all-btn{display:none;}</style>';
    }  
    
    wp_reset_postdata();
    
    //check ajax call
    if($ajax) wp_die();
}

/*
 * load more script ajax hooks
 */
add_action('wp_ajax_nopriv_ajax_public_script_load_more', 'ajax_public_script_load_more');
add_action('wp_ajax_ajax_public_script_load_more', 'ajax_public_script_load_more');