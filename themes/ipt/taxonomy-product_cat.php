<?php 
get_header(); 
$cterm = get_queried_object();

get_template_part( 'templates/page', 'banner' );
?>


<section class="back-link-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="back-link-sec-inr">
          <a href="javascript:history.go(-1)">
            Terug naar overzicht
            <i>
              <svg class="backlink-left-arrow-svg" width="8" height="14" viewBox="0 0 8 14" fill="#474747">
                <use xlink:href="#backlink-left-arrow-svg"></use>
              </svg> 
            </i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ipt-pd-welding-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="ipt-pd-welding-sec-inr">
          <div class="ipt-pd-welding-sec-ctlr clearfix">
          <?php 
            $afbeelding_id = get_field('afbeelding', $cterm, false); 
            if( !empty($afbeelding_id) ):
              $afbeelding_src = cbv_get_image_src( $afbeelding_id );
            else:
              $afbeelding_src = THEME_URI.'/assets/images/producten-overview-items-img-0010.jpg';
            endif; 
          ?>
            <div class="ipt-pd-wel-img inline-bg" style="background: url('<?php echo $afbeelding_src; ?>');">
            </div>
            <div class="ipt-pd-wel-des">
              <strong class="ipt-pd-wel-des-subtitle">Producten</strong>
              <?php printf('<h2 class="ipt-pd-wel-des-title">%s</h2>', $cterm->name); ?>
              <?php if( !empty($cterm->description) ) echo wpautop($cterm->description); ?>
              <a href="#">Producten</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $cintro = get_field('intro', $cterm);?>
<section class="ipt-pd-slider-sec-wrap">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="ipt-pd-slider-sec-inr">
          <?php if( $cintro ): ?>
          <div class="ipt-pd-slider-entry-hdr">
            <?php 
              if( !empty( $cintro['titel'] ) ) printf( '<h3 class="ipt-pd-slider-entry-tilte">%s</h3>', $cintro['titel']); 
              if( !empty( $cintro['beschrijving'] ) ) echo wpautop($cintro['beschrijving']); 
            ?>
          </div>
          <?php endif; ?>
          <?php
          $query = new WP_Query(array( 
            'post_type'=> 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order'=> 'ASC',
            'tax_query' => array(
              array(
                 'taxonomy' => 'product_cat',
                  'field'    => 'term_id',
                  'terms'    => $cterm->term_id
                  ),
            ),
            ) 
          );
          if($query->have_posts()){
          ?>
          <div class="ipt-pd-slider-sec">
            <div class="ipt-pd-slider-arrow">
              <span class="ipt-pd-slider-leftarrow">
              </span>
              <span class="ipt-pd-slider-rightarrow">
              </span>
            </div>
            <div class="ipt-pd-sliders iptPdSliders clearfix">
              <?php 
              while($query->have_posts()): $query->the_post(); 
                $overview = get_field('overview');
                if( !empty($overview['afbeelding']) )
                  $pro_tag = cbv_get_image_tag($overview['afbeelding']);
                else
                  $pro_tag = '';
              ?>
              <div class="ipt-pd-slider-item mHc">
                <div class="ipt-pd-slider-item-ctlr">
                  <div class="ipt-pd-slider-item-img">
                    <?php echo $pro_tag; ?>
                  </div>
                  
                  <h4 class="ipt-pd-slider-title mHc1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  <?php if( !empty( $overview['beschrijving'] ) ) echo wpautop($overview['beschrijving']); ?>
                </div>
              </div>
              <?php endwhile; ?>
            </div>
          </div>
         <?php } wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
  $showhide_contact = get_field('showhide_contacteerons', 'options');
  $contons = get_field('contacteerons', 'options');

  if($showhide_contact):
    if($contons):
?>

<div class="ipt-pd-ctlr">
  <section class="ipt-contact-form-sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="pd-contact">
            <div class="ipt-contact-form-sec-inr">
              <div class="ipt-contact-entry-hdr">
                <?php 
                  if( !empty( $contons['titel'] ) ) printf( '<h2 class="ipt-cnt-entry-title">%s</h2>', $contons['titel']); 
                  if( !empty( $contons['beschrijving'] ) ) echo wpautop($contons['beschrijving']); 
                ?>
              </div>
              <div class="wpforms-container">
                <?php if(!empty($contons['form_shortcode'])) echo do_shortcode( $contons['form_shortcode'] ); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php endif; ?>
<?php endif; ?>
<?php get_template_part('templates/promo', 'section'); ?>
<?php get_footer(); ?>