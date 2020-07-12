<?php
  $address = get_field('address', 'options');
  $gmapsurl = get_field('google_maps', 'options');
  $gmaplink = !empty($gmapsurl)?$gmapsurl: 'javascript:void()';
  $gmaps = get_field('gmaps', 'options');
  if($gmaps):
    $gmap = $gmaps['map'];
    $ghours = $gmaps['openingstijden'];
?>
<section class="google-map-sec">
  <div class="google-map" data-homeurl="<?php echo THEME_URI; ?>" data-latitude="<?php echo $gmap['lat']; ?>" data-longitude="<?php echo $gmap['lng']; ?>">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1053132.5390187346!2d3.919207982966997!3d50.8727335933461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c17d64edf39797%3A0x47ebf2b439e60ff2!2sBelgium!5e0!3m2!1sen!2sbd!4v1593595059125!5m2!1sen!2sbd" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  </div>
  <div class="contact-google-map-des">
    <div class="contact-google-map-des-ctlr">
      <div class="contact-google-map-des-inr">
        <h5 class="cnt-gm-title"><?php _e('Industrial Textile Products', THEME_NAME); ?></h5>
        <div class="cnt-gm-location">
          <strong class="cnt-gm-lctn-title"><?php _e('Locatie', THEME_NAME); ?></strong>
          <?php if( !empty($address) ) printf('<a href="%s">%s</a>', $gmaplink, $address); ?>
        </div>
        <div class="cnt-gm-opening-hours">
          <strong class="cnt-gm-oh-title"><?php _e('openingstijden', THEME_NAME); ?></strong>
          <?php if($ghours): ?>
          <ul class="reset-list">
            <?php foreach( $ghours as $hour ): ?>
            <?php if(!empty($hour['hours'])) printf('<li><strong>%s</strong></li>', $hour['hours']); ?>
            <?php endforeach; ?>
          </ul>  
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
