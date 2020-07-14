<?php 
get_header(); 
$cterm = get_queried_object();
get_template_part( 'templates/page', 'banner' );
?>


<section class="hm-our-references-sec referenties-references-sec">
  <div class="hm-our-references-sec-cntlr">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="hm-our-references-sec-hdr referenties-references-sec-hdr">
            <h3 class="horshdr-title">Neque feugiat vehicula aliquet</h3>
            <p>Vitae ridiculus dapibus morbi non, at orci leo volutpat integer. Aliquam ipsum sit magna est nulla nulla. Dictum feugiat consectetur in mauris, scelerisque mattis netus gravida.</p>
          </div>
        </div>
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

                <?php foreach( $sCats as $sCat ): ?>
                <li>
                  <a href="<?php echo get_term_link( $sCat ); ?>" class="tab-btn<?php echo ($cterm->term_id == $sCat->term_id)? ' current': ''; ?>">
                    <i>
                      <svg class="tab-link-icon-01-svg" width="24" height="24" viewBox="0 0 24 24" fill="#474747">
                        <use xlink:href="#tab-link-icon-01-svg"></use>
                      </svg> 
                    </i>
                    <span><?php echo $sCat->name; ?></span>
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
  <div class="referenties-references-sec-angle-cntlr">
    <div class="referenties-references-sec-angle">
      <img src="<?php echo THEME_URI; ?>/assets/images/referenties-references-sec-angle.png">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="tp-references-grd-row tp-referenties-references-grd-row clearfix">
            <div class="tp-references-grd-lft-col">
              <div class="tp-references-grd-lft-fea-img inline-bg" style="background: url(<?php echo THEME_URI; ?>/assets/images/references-item-fea-img-01.png);">
                
              </div>
            </div>
            <div class="tp-references-grd-rgt-col">
              <span class="tp-references-grd-rgt-col-title">In de kijker</span>
              <h4 class="tp-references-grd-des-title">Project titel</h4>
              <p>Vitae ridiculus dapibus morbi non, at orci leo volutpat integer. Aliquam ipsum sit magna est nulla nulla. Dictum feugiat consectetur in mauris, scelerisque mattis netus gravida.</p>
              <ul>
                <li>Dictum feugiat consectetur in mauris, scelerisque mattis.</li>
                <li>Vitae ornare nullam purus, nec. Velit mi pretium lorem.</li>
                <li>Amet, purus etiam nulla urna sed. Risus id lectus.</li>
              </ul>
              <div class="hm-overons-sec-des-btns">
                <div class="hm-overons-sec-des-btn hm-overons-sec-des-btn-1">
                  <a href="#">Lees meer</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>



<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$query = new WP_Query(array( 
    'post_type'=> 'referentie',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order'=> 'ASC',
    'paged' => $paged
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