<?php 
  /*
    Template Name: Product
  */
  get_header(); 
  $thisID = get_the_ID();
  $intro = get_field('introsec', $thisID); 

  get_template_part( 'templates/page', 'banner' );
?>

<section class="Neque-feugiat-sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="ftr-top-inr Neque-feugiat-innr">
          <h2 class="ftshdr-title">Neque feugiat vehicula aliquet</h2>
          <p>Vitae ridiculus dapibus morbi non, at orci leo volutpat integer. Aliquam ipsum sit magna est nulla nulla. <br>Dictum feugiat consectetur in mauris, scelerisque mattis netus gravida.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php 
  $terms = get_terms( array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'parent' => 0
  ) );
?>

<section class="producten-overview-items-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if ( $terms) { ?>
        <div class="producten-overview-items-sec-innr">
          <ul class="reset-list clearfix">
            <?php foreach ( $terms as $term ) { ?>
            <li>
              <div class="producten-overview-items mHc">
                <div class="producten-overview-items-cntlr">
                  <div class="producten-overview-items-img-cntlr">
                    <?php 
                    $afbeelding_id = get_field('afbeelding', $term, false); 
                    if( !empty($afbeelding_id) ):
                      $afbeelding_src = cbv_get_image_src( $afbeelding_id );
                    else:
                      $afbeelding_src = THEME_URI.'/assets/images/producten-overview-items-img-0010.jpg';
                    endif; ?>
                    <div class="producten-overview-items-img inline-bg" style="background: url('<?php echo $afbeelding_src; ?>');">
                      <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="overlay-link"></a>
                    </div>
                  </div>
                  <div class="producten-overview-items-title-wrap">
                    <h3 class="producten-overview-items-title mHc2"><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php printf('%s', $term->name); ?></a></h3>
                  </div>
                  <div class="producten-overview-items-btn">
                    <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php _e('meer info', THEME_NAME); ?></a>
                  </div>
                </div>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>
</section> 
<?php get_template_part('templates/promo', 'section'); ?>
<?php get_footer(); ?>