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
