<?php
/*
 * initial posts dispaly
 */

function events_script_load_more($args = array()) {
  echo '<div class="past-event-con" id="ajax-content">';
      ajax_event_script_load_more($args);
  echo '</div>';
  echo '<div class="fl-see-all-btn">
  <div class="ajaxloading" id="ajxaloader" style="display:none"><img src="'.THEME_URI.'/assets/images/loading.gif" alt="loader"></div>
   <a href="#" id="loadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >Load More</a>';
   echo '</div>';

}
/*
 * create short code.
 */
add_shortcode('ajax_event_posts', 'events_script_load_more');


/*
 * load more script call back
 */
function ajax_event_script_load_more($args) {
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
      'post_type'=> 'event',
      'post_status' => 'publish',
      'posts_per_page' =>$num,
      'paged'=>$paged,
      'orderby' => 'date',
      'order'=> 'ASC',
      'tax_query' => array(
        array(
           'taxonomy' => 'event_cat',
            'field'    => 'slug',
            'terms'    => 'past',
            ),
      ),
      ) 
    );
    if($query->have_posts()){
    $post_count = $query->found_posts;
    while($query->have_posts()): $query->the_post();
    ?>
    <div class="past-event-item-row">
      <div class="past-event-date">
        <strong><?php echo get_the_date('d'); ?></strong>
        <span><?php echo get_the_date('M y'); ?></span>
      </div>
      <div class="past-event-item-row-des">
        <h3 class="peird-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <span><?php echo get_the_date('Y'); ?> | Policy Brief</span>
        <?php echo wpautop(cbv_limit_excerpt()); ?>
      </div>
    </div>
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
add_action('wp_ajax_nopriv_ajax_event_script_load_more', 'ajax_event_script_load_more');
add_action('wp_ajax_ajax_event_script_load_more', 'ajax_event_script_load_more');