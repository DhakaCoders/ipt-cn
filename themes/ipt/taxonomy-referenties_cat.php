<?php 
get_header(); 
$cterm = get_queried_object();
$topID = array();
$pageID = 240;
$intro = get_field('intro', $pageID);
get_template_part( 'templates/page', 'banner' );
?>


<section class="hm-our-references-sec referenties-references-sec">
  <div class="hm-our-references-sec-cntlr">
    <div class="container">
      <div class="row">
        <?php if( $intro ): ?>
        <div class="col-sm-12">
          <div class="hm-our-references-sec-hdr referenties-references-sec-hdr">
            <?php 
              if( !empty( $intro['titel'] ) ) printf( '<h3 class="horshdr-title">%s</h3>', $intro['titel']); 
              if( !empty( $intro['beschrijving'] ) ) echo wpautop($intro['beschrijving']); 
            ?>
          </div>
        </div>
        <?php endif; ?>
        <div class="col-sm-12">
          <div class="references-tab-btns referenties-references-tab-btns">
            <div class="tp-tabs clearfix">
              <?php 
              $hrefer = get_field('hreferenties', HOMEID);
              if($hrefer):
                $sCats = $hrefer['selecteer_categorieen'];
                if($sCats){
                  $terms = $sCats;
                }else{
                  $terms = get_terms( array(
                  'taxonomy' => 'referenties_cat',
                  'hide_empty' => false,
                  'parent' => 0
                ) );
                }
                
              ?>
              <ul class="reset-list">

                <?php foreach( $terms as $term ): ?>
                <li>
                  <a href="<?php echo get_term_link( $term ); ?>" class="tab-btn<?php echo ($cterm->term_id == $term->term_id)? ' current': ''; ?>">
                    <?php 
                    $afbeelding_id = get_field('icon', $term, false); 
                    if( !empty($afbeelding_id) ):
                      echo cbv_get_image_tag( $afbeelding_id );
                    endif;
                    ?>
                    <span><?php echo $term->name; ?></span>
                  </a> 
                </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    $query = new WP_Query(array( 
      'post_type'=> 'referentie',
      'post_status' => 'publish',
      'posts_per_page' => 1,
      'orderby' => 'date',
      'order'=> 'DESC',
      'meta_query' => array(
          array(
              'key'     => 'indekijker',
              'value'   => 'yes',
              'compare' => 'LIKE'
          ),
      ),
      'tax_query' => array(
        array(
           'taxonomy' => 'referenties_cat',
            'field'    => 'term_id',
            'terms'    => $cterm->term_id
            ),
      ),
      ) 
    );
    if($query->have_posts()){
  ?>
<?php 
while($query->have_posts()): $query->the_post(); 
  $overview = get_field('overview', get_the_ID());
  if( !empty($overview['afbeelding']) )
    $ref_src = cbv_get_image_src($overview['afbeelding']);
  else
    $ref_src = ''; 
    $topID = get_the_ID();
?>
  <div class="referenties-references-sec-angle-cntlr">
    <div class="referenties-references-sec-angle">
      <img src="<?php echo THEME_URI; ?>/assets/images/referenties-references-sec-angle.png">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="tp-references-grd-row tp-referenties-references-grd-row clearfix">
            <div class="tp-references-grd-lft-col">
              <div class="tp-references-grd-lft-fea-img inline-bg" style="background: url(<?php echo $ref_src; ?>);">
                
              </div>
            </div>
            <div class="tp-references-grd-rgt-col">
              <span class="tp-references-grd-rgt-col-title">In de kijker</span>
              <h4 class="tp-references-grd-des-title"><?php the_title(); ?></h4>
              <?php 
                if( !empty( $overview['homebeschrijving'] ) ) 
                  echo wpautop($overview['homebeschrijving']);
                else
                  the_excerpt();
              ?>
              <div class="hm-overons-sec-des-btns">
                <div class="hm-overons-sec-des-btn hm-overons-sec-des-btn-1">
                  <a href="<?php the_permalink(); ?>"><?php _e('Lees meer', THEME_NAME); ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endwhile; ?>
 <?php } wp_reset_postdata();  ?>
</section>



<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$query = new WP_Query(array( 
    'post_type'=> 'referentie',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order'=> 'DESC',
    'paged' => $paged,
    'post__not_in' => array($topID),
    'tax_query' => array(
      array(
         'taxonomy' => 'referenties_cat',
          'field'    => 'term_id',
          'terms'    => $cterm->term_id
          ),
    ),
  ) 
);

if($query->have_posts()):
?>
<section class="producten-overview-items-sec referenties-overview-items-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="producten-overview-items-sec-innr referenties-overview-items-sec-innr">
          <ul class="reset-list clearfix">
          <?php 
            while($query->have_posts()): $query->the_post();   
            $overview = get_field('overview', get_the_ID());
            if( !empty($overview['afbeelding']) )
              $ref_tag = cbv_get_image_src($overview['afbeelding']);
            else
              $ref_tag = ''; 
          ?>
            <li>
              <div class="producten-overview-items referenties-overview-items mHc">
                <div class="producten-overview-items-cntlr">
                  <div class="producten-overview-items-img-cntlr">
                    <div class="producten-overview-items-img inline-bg" style="background: url('<?php echo $ref_tag; ?>');">
                      <a href="<?php the_permalink(); ?>" class="overlay-link"></a>
                    </div>
                  </div>
                  <div class="referenties-overview-items-desc">
                    <div class="producten-overview-items-title-wrap rs-overview-wrap">
                      <h3 class="producten-overview-items-title mHc2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </div>
                    
                    <?php if( !empty( get_the_excerpt() ) ) printf('<p class="mHc3">%s</p>', get_the_excerpt()); ?>
                    <div class="producten-overview-items-btn referenties-overview-items-btn referenties-overview-items-btn">
                      <a href="<?php the_permalink(); ?>"><?php _e('meer info', THEME_NAME); ?></a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <?php endwhile; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section> 

<section class="referenties-pagination">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="referenties-pagination-innr">
          <div class="fl-pagi-ctlr">
            <?php
            if( $query->max_num_pages > 1 ):
            $big = 999999999; // need an unlikely integer
            echo paginate_links( array(
              'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'format' => '?paged=%#%',
              'current' => max( 1, get_query_var('paged') ),
              'total' => $query->max_num_pages,
              'type'  => 'list',
              'show_all' => true,
              'prev_next' => false
            ) );
            endif; 
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php 
  else:
    echo '<div class="hasgap"></div>';
  endif;  
  wp_reset_postdata();
?>
<?php get_template_part('templates/promo', 'section'); ?>
<?php get_footer(); ?>