<?php
/*
 * initial posts dispaly
 */

function post_script_load_more($args = array()) {
  $archive = $sorting = ''; $date_arg = array();

  if( isset($_GET['archive']) && !empty($_GET['archive'])) $archive = $_GET['archive'];
  if( isset($_GET['sort']) && !empty($_GET['sort'])) $sorting = $_GET['sort'];
    if(isset($archive) && !empty($archive)){
      $exp_date = explode('-', $archive);
      $date_arg = array(
       'year'  => @$exp_date[2],
       'month' => @$exp_date[1],
       'day'   => @$exp_date[0],
      );

      $query = new WP_Query(array( 
        'post_type'=> 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order'=> $sorting,
        'date_query' => array($date_arg),
      ) 
      );
    } else{
      $query = new WP_Query(array( 
          'post_type'=> 'post',
          'post_status' => 'publish',
          'orderby' => 'date',
          'order'=> $sorting
        ) 
      );
    }

    $query = new WP_Query(array( 
        'post_type'=> 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order'=> $sorting,
        'date_query' => array($date_arg),
      ) 
    );
    if($query->have_posts()){


  echo '<ul class="reset-list clearfix" id="ajax-content">';
      ajax_post_script_load_more($args, $archive, $sorting);
  echo '</ul>';
  echo '<div class="loadmorewrapp"><div class="ylw-blog-grid-load">
  <div class="ajaxloading" id="ajxaloader" style="display:none"><img src="'.THEME_URI.'/assets/images/loading.gif" alt="loader"></div>
   <a href="#" id="loadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >
   <img src="'.THEME_URI.'/assets/images/ylw-blog-grid-load-img.png">
   </a><span>LOAD MORE</span>';
   echo '</div></div>';
   }else{
    echo '<div class="postnot-found" style="text-align:center; padding:20px 0;">No results!</div>';
   }

}
/*
 * create short code.
 */
add_shortcode('ajax_posts', 'post_script_load_more');


/*
 * load more script call back
 */
function ajax_post_script_load_more($args, $archive = '', $sort = 'DESC') {
    //init ajax
    $ajax = false;
    //check ajax call or not
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $ajax = true;
    }
    //number of posts per page default
    $num = 3;
    //page number
    $paged = 1;
    $date_arg = '';
    if(isset($_POST['archive']) && !empty($_POST['archive'])){
      $archive = $_POST['archive'];
    }

    
    if(isset($_POST['sorting']) && !empty($_POST['sorting'])){
        $sort = $_POST['sorting'];
    }
    if(isset($_POST['page']) && !empty($_POST['page'])){
        $paged = $_POST['page'] + $paged;
    }
    if( isset($archive) && !empty($archive) ){
      $exp_date = explode('-', $archive);
      $date_arg = array(
       'year'  => @$exp_date[2],
       'month' => @$exp_date[1],
       'day'   => @$exp_date[0],
      );
      $query = new WP_Query(array( 
          'post_type'=> 'post',
          'post_status' => 'publish',
          'posts_per_page' =>$num,
          'paged'=>$paged,
          'orderby' => 'date',
          'order'=> $sort,
          'date_query' => array($date_arg)
        ) 
      );
    } else{
      $query = new WP_Query(array( 
          'post_type'=> 'post',
          'post_status' => 'publish',
          'posts_per_page' =>$num,
          'paged'=>$paged,
          'orderby' => 'date',
          'order'=> $sort
        ) 
      );
    }
    if($query->have_posts()){
    while($query->have_posts()): $query->the_post();
      $attach_id = get_post_thumbnail_id(get_the_ID());
      $feaimg_src = '';
      if( !empty($attach_id) ){
        $feaimg_src = cbv_get_image_src($attach_id, 'bloggrid');
      }
      else{
        $feaimg_src = THEME_URI.'/assets/images/ylw-blog-grid-item-img-3.png';
      }
    ?>
    <li>
      <div class="ylw-blog-grid-item">
        <div class="ylw-blog-grid-item-img-ctlr">
          <a href="<?php the_permalink(); ?>" class="overlay-link"></a>
          <div class="ylw-blog-grid-item-img" style="background: url('<?php echo $feaimg_src; ?>');">
          </div>
        </div>
        <div class="ylw-blog-grid-item-des mHc">
          <div class="ylw-blog-grid-item-des-inr">
            <span><?php echo get_the_date('d M Y'); ?></span>
            <h5 class="ylw-blog-grid-item-des-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <?php the_excerpt(); ?>
          </div>
        </div>
      </div>
    </li>
    <?php
    endwhile;
     
    }else{
      //echo '<div class="postnot-found" style="text-align:center; padding:20px 0;">No results!</div>';
      echo '<style>.ylw-blog-grid-load{display:none;}</style>';
    }  
    
    wp_reset_postdata();
    
    //check ajax call
    if($ajax) wp_die();
}

/*
 * load more script ajax hooks
 */
add_action('wp_ajax_nopriv_ajax_post_script_load_more', 'ajax_post_script_load_more');
add_action('wp_ajax_ajax_post_script_load_more', 'ajax_post_script_load_more');