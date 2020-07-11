<?php 
  /*
    Template Name: Contact
  */
  get_header(); 

  $thisID = get_the_ID();
  $spacialArry = array(".", "/", "+", " ");$replaceArray = '';
  $address = get_field('address', 'options');
  $gmapsurl = get_field('google_maps', 'options');
  $emailadres = get_field('emailaddress', 'options');
  $show_telefoon = get_field('telephone', 'options');
  $telefoon = trim(str_replace($spacialArry, $replaceArray, $show_telefoon));
  $gmaplink = !empty($gmapsurl)?$gmapsurl: 'javascript:void()';

  $intro = get_field('introsec', $thisID); 
  $cont = get_field('contacteer_ons', $thisID); 
?>
<section class="page-banner">
  <div class="page-banner-controller" style="overflow: hidden;">
    <div class="page-banner-bg inline-bg" style="background: url('<?php echo THEME_URI; ?>/assets/images/page-bnr.jpg');"></div>
    <div class="page-banner-des">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="page-banner-des-inner">
              <h1 class="page-banner-title">Contact</h1>
              <div class="breadcrumbs">
                <ul class="reset-list">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Binnenpagina</a></li>
                  <li><a href="#">Binnenpagina</a></li>
                </ul>
              </div>
              <div class="xs-breadcrumbs">
                <ul class="reset-list clearfix">
                  <li><a href="#">Home</a></li>
                  <li>
                    <a href="#">
                    Terug
                      <i>
                        <svg class="xs-breadcrumbs-left-arrow-svg" width="12" height="12" viewBox="0 0 12 12" fill="#ffffff">
                          <use xlink:href="#xs-breadcrumbs-left-arrow-svg"></use>
                        </svg> 
                      </i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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

<section class="google-map-sec">
  <div class="google-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1053132.5390187346!2d3.919207982966997!3d50.8727335933461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c17d64edf39797%3A0x47ebf2b439e60ff2!2sBelgium!5e0!3m2!1sen!2sbd!4v1593595059125!5m2!1sen!2sbd" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  </div>
  <div class="contact-google-map-des">
    <div class="contact-google-map-des-ctlr">
      <div class="contact-google-map-des-inr">
        <h5 class="cnt-gm-title"><?php _e('Industrial Textile Products', THEME_NAME); ?></h5>
        <div class="cnt-gm-location">
          <strong class="cnt-gm-lctn-title">Locatie</strong>
          <?php if( !empty($address) ) printf('<a href="%s">%s</a>', $gmaplink, $address); ?>
        </div>
        <div class="cnt-gm-opening-hours">
          <strong class="cnt-gm-oh-title"><?php _e('openingstijden', THEME_NAME); ?></strong>
          <ul class="reset-list">
            <li><strong>M - V : 08u00 - 17u00</strong></li>
            <li><strong>Z : 08u00 - 11u00</strong></li>
            <li><strong>Z : gesloten</strong></li>
          </ul>  
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>