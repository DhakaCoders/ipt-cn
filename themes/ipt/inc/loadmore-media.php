<?php
/*
 * initial posts dispaly
 */

function news_script_load_more($args = array()) {
  echo '<ul class="clearfix reset-list" id="news-content">';
      ajax_news_script_load_more($args);
  echo '</ul>';
  echo '<div class="fl-see-all-btn">
  <div class="ajaxloading" id="newsajxaloader" style="display:none"><img src="'.THEME_URI.'/assets/images/loading.gif" alt="loader"></div>
   <a href="#" id="newsLoadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >Load More</a>';
   echo '</div>';

}
/*
 * create short code.
 */
add_shortcode('ajax_news_posts', 'news_script_load_more');


/*
 * load more script call back
 */
function ajax_news_script_load_more($args) {
    //init ajax
    $ajax = false;
    //check ajax call or not
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $ajax = true;
    }
    //number of posts per page default
    $num = 2;
    //page number
    $paged = 1;
    if(isset($_POST['page']) && !empty($_POST['page'])){
        $paged = $_POST['page'] + $paged;
    }
    $query = new WP_Query(array( 
      'post_type'=> 'news',
      'post_status' => 'publish',
      'posts_per_page' =>$num,
      'paged'=>$paged,
      'orderby' => 'date',
      'order'=> 'ASC',
      'tax_query' => array(
        array(
           'taxonomy' => 'news_cat',
            'field'    => 'slug',
            'terms'    => 'news',
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
      <div class="event-media-page-tab-con-row clearfix">
        <div class="event-media-page-tab-con-fea-img">
          <?php echo cbv_get_image_tag($attach_id); ?>
        </div>
        <div class="event-media-page-tab-con-des">
          <h3 class="emptcd-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <span><?php echo $ninfo; ?></span>
          <p><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink(); ?>">Continue Reading...</a> </p>
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
add_action('wp_ajax_nopriv_ajax_news_script_load_more', 'ajax_news_script_load_more');
add_action('wp_ajax_ajax_news_script_load_more', 'ajax_news_script_load_more');


function media_script_load_more($args = array()) {
  echo '<ul class="clearfix reset-list" id="media-content">';
      ajax_media_script_load_more($args);
  echo '</ul>';
  echo '<div class="fl-see-all-btn-rep">
  <div class="ajaxloading" id="medialoader" style="display:none"><img src="'.THEME_URI.'/assets/images/loading.gif" alt="loader"></div>
   <a href="#" id="mediaLoadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >Load More</a>';
   echo '</div>';

}
/*
 * create short code.
 */
add_shortcode('ajax_media_posts', 'media_script_load_more');


/*
 * load more script call back
 */
function ajax_media_script_load_more($args) {
    //init ajax
    $ajax = false;
    //check ajax call or not
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $ajax = true;
    }
    //number of posts per page default
    $num = 2;
    //page number
    $paged = 1;
    if(isset($_POST['page']) && !empty($_POST['page'])){
        $paged = $_POST['page'] + $paged;
    }
    $query = new WP_Query(array( 
      'post_type'=> 'news',
      'post_status' => 'publish',
      'posts_per_page' =>$num,
      'paged'=>$paged,
      'orderby' => 'date',
      'order'=> 'DESC',
      'tax_query' => array(
        array(
           'taxonomy' => 'news_cat',
            'field'    => 'slug',
            'terms'    => 'oped-media',
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
      <div class="event-media-page-tab-con-row clearfix">
        <div class="event-media-page-tab-con-fea-img">
          <?php echo cbv_get_image_tag($attach_id); ?>
        </div>
        <div class="event-media-page-tab-con-des">
          <h3 class="emptcd-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <span><?php echo $ninfo; ?></span>
          <p><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink(); ?>">Continue Reading...</a> </p>
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
add_action('wp_ajax_nopriv_ajax_media_script_load_more', 'ajax_media_script_load_more');
add_action('wp_ajax_ajax_media_script_load_more', 'ajax_media_script_load_more');