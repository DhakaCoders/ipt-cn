<?php
/*
 * initial posts dispaly
 */

function press_script_load_more($args = array()) {
  echo '<ul class="clearfix reset-list" id="press-content">';
      ajax_press_script_load_more($args);
  echo '</ul>';
  echo '<div class="fl-see-all-btn">
  <div class="ajaxloading pressloading" id="pressajxaloader" style="display:none"><img src="'.THEME_URI.'/assets/images/loading.gif" alt="loader"></div>
   <a href="#" id="pressLoadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >Load More</a>';
   echo '</div>';

}
/*
 * create short code.
 */
add_shortcode('ajax_press_posts', 'press_script_load_more');


/*
 * load more script call back
 */
function ajax_press_script_load_more($args) {
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
    if(isset($_POST['page']) && !empty($_POST['page'])){
        $paged = $_POST['page'] + $paged;
    }
    $query = new WP_Query(array( 
      'post_type'=> 'press',
      'post_status' => 'publish',
      'posts_per_page' =>$num,
      'paged'=>$paged,
      'orderby' => 'date',
      'order'=> 'ASC',
      'tax_query' => array(
        array(
           'taxonomy' => 'presstype',
            'field'    => 'slug',
            'terms'    => 'press-release',
            ),
      ),
      ) 
    );
    if($query->have_posts()){
    $post_count = $query->found_posts;
    while($query->have_posts()): $query->the_post();
    $attach_id = get_post_thumbnail_id(get_the_ID());
    if( !empty($attach_id) )
      $event_src = cbv_get_image_src($attach_id);
    else
      $event_src = ''; 
    $ninfo = get_field('news_info');  
    ?>
    <li>
      <div class="event-pp-report-page-tab-1-grd">
        <div class="epprpt-grd-fea-img">
          <a href="<?php the_permalink(); ?>" class="overlay-link"></a>
          <div class="inline-bg" style="background: url(<?php echo $event_src; ?>"></div>
        </div>
        <div class="mhc epprpt-grd-des">
          <span><?php echo get_the_date('M d, Y'); ?></span>
          <h4 class="epprpt-grd-des-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          <p><?php echo $ninfo; ?></p>
          <a href="<?php the_permalink(); ?>">View Full <i></i></a>
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
add_action('wp_ajax_nopriv_ajax_press_script_load_more', 'ajax_press_script_load_more');
add_action('wp_ajax_ajax_press_script_load_more', 'ajax_press_script_load_more');


function repress_script_load_more($args = array()) {
  echo '<ul class="clearfix reset-list" id="repress-content">';
      ajax_repress_script_load_more($args);
  echo '</ul>';
  echo '<div class="fl-see-all-btn-rep">
  <div class="ajaxloading repressloading" id="repressloader" style="display:none"><img src="'.THEME_URI.'/assets/images/loading.gif" alt="loader"></div>
   <a href="#" id="repressLoadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >Load More</a>';
   echo '</div>';

}
/*
 * create short code.
 */
add_shortcode('ajax_repress_posts', 'repress_script_load_more');


/*
 * load more script call back
 */
function ajax_repress_script_load_more($args) {
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
    if(isset($_POST['page']) && !empty($_POST['page'])){
        $paged = $_POST['page'] + $paged;
    }
    $query = new WP_Query(array( 
      'post_type'=> 'press',
      'post_status' => 'publish',
      'posts_per_page' =>$num,
      'paged'=>$paged,
      'orderby' => 'date',
      'order'=> 'DESC',
      'tax_query' => array(
        array(
           'taxonomy' => 'presstype',
            'field'    => 'slug',
            'terms'    => 'report',
            ),
      ),
      ) 
    );
    if($query->have_posts()){

    $post_count = $query->found_posts;

    while($query->have_posts()): $query->the_post();
    $attach_id = get_post_thumbnail_id(get_the_ID());
    if( !empty($attach_id) )
      $event_src = cbv_get_image_src($attach_id);
    else
      $event_src = ''; 
    $ninfo = get_field('news_info');  
    ?>
    <li>
      <div class="event-pp-report-page-tab-2-grd">
        <div class="epprpt2-grd-fea-img">
          <div class="inline-bg" style="background: url(<?php echo $event_src; ?>">
            <a href="<?php the_permalink(); ?>" class="overlay-link"></a>
          </div>
        </div>
        <div class="epprpt2-grd-des">
          <span><?php echo get_the_date('M d, Y'); ?></span>
          <h4 class="epprpt-grd-des-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          <strong><?php echo $ninfo; ?></strong>
          <p><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink(); ?>">Continue Reading.</a></p>
        </div>
      </div>
    </li>
    <?php
    endwhile;

    if( $post_count <= $num  ){
      echo '<style>.fl-see-all-btn-rep{display:none;}</style>';
    }
     
    }else{
      //echo '<div class="postnot-found" style="text-align:center; padding:20px 0;">No results!</div>';
      echo '<style>.fl-see-all-btn-rep{display:none;}</style>';
    }  
    
    wp_reset_postdata();
    
    //check ajax call
    if($ajax) wp_die();
}

/*
 * load more script ajax hooks
 */
add_action('wp_ajax_nopriv_ajax_repress_script_load_more', 'ajax_repress_script_load_more');
add_action('wp_ajax_ajax_repress_script_load_more', 'ajax_repress_script_load_more');