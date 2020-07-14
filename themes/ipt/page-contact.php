<?php 
  /*
    Template Name: Contact
  */
  get_header(); 

  $thisID = get_the_ID();
  $spacialArry = array(".", "/", "+", " ", "(", ")");$replaceArray = '';
  $address = get_field('address', 'options');
  $gmapsurl = get_field('google_maps', 'options');
  $emailadres = get_field('emailaddress', 'options');
  $show_telefoon = get_field('telephone', 'options');
  $telefoon = trim(str_replace($spacialArry, $replaceArray, $show_telefoon));
  $gmaplink = !empty($gmapsurl)?$gmapsurl: 'javascript:void()';

  $intro = get_field('introsec', $thisID); 
  $cont = get_field('contacteer_ons', $thisID); 

  get_template_part( 'templates/page', 'banner' );
?>
<div class="contact-page-ctlr">
  <section class="ftr-top-sec">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="ftr-top-inr">
            <?php 
              if( !empty( $intro['titel'] ) ) printf( '<h2 class="ftshdr-title">%s</h2>', $intro['titel']); 
              if( !empty( $intro['beschrijving'] ) ) echo wpautop($intro['beschrijving']); 
            ?>
            <div class="ftr-top-sec-btns">
              <?php if( !empty($show_telefoon) ): ?>
              <div class="ftr-top-sec-btn ftr-top-sec-btn-tel">
                <a href="tel:<?php echo $telefoon; ?>">
                  <i>
                    <svg class="tel-blue-icon-svg" width="28" height="28" viewBox="0 0 28 28" fill="#000062">
                      <use xlink:href="#tel-blue-icon-svg"></use>
                    </svg> 
                  </i>
                  <span><?php echo $show_telefoon; ?></span>
                </a>
              </div>
              <?php endif; ?>
              <?php if( !empty($emailadres) ): ?>
              <div class="ftr-top-sec-btn ftr-top-sec-btn-mail">
                <a href="mailto:<?php echo $emailadres; ?>">
                  <i>
                    <svg class="mail-blue-icon-svg" width="28" height="28" viewBox="0 0 28 28" fill="#000062">
                      <use xlink:href="#mail-blue-icon-svg"></use>
                    </svg> 
                  </i>
                  <span><?php echo $emailadres; ?></span>
                </a>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<section class="ipt-contact-form-sec">
  <div class="container-md">
    <div class="row">
      <div class="col-md-12">
        <div class="ipt-contact-entry-hdr">
          <?php 
            if( !empty( $cont['titel'] ) ) printf( '<h2 class="ipt-cnt-entry-title">%s</h2>', $cont['titel']); 
            if( !empty( $cont['beschrijving'] ) ) echo wpautop($cont['beschrijving']); 
          ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="ipt-contact-form-sec-inr">
          <div class="wpforms-container">
            <?php if(!empty($cont['form_shortcode'])) echo do_shortcode( $cont['form_shortcode'] ); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_template_part('templates/gmap', 'section'); ?>
<?php get_footer(); ?>