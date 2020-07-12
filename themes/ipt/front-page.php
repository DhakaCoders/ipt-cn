<?php 
get_header(); 
?>

<section class="main-bnr-con-sec">
  <?php 
    $intro = get_field('introsec', HOMEID);
    if( $intro ): 

    $bafbeelding = '';
    if( !empty($intro['afbeelding']) ){
      $bafbeelding = cbv_get_image_src($intro['afbeelding']);
    }
  ?>
  <div class="main-bnr-con-cntlr">
    <div class="main-bnr-cntlr">
      <div class="main-bnr-con inline-bg" style="background: url(<?php echo $bafbeelding; ?>);">
        <div class="main-bnr-con-des">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="main-bnr-con-des-inr">
                  <?php 
                    if( !empty( $intro['subtitel'] ) ) printf( '<h3 class="main-brn-sub-title">%s</h3>', $intro['subtitel']); 
                    if( !empty( $intro['titel'] ) ) printf( '<strong class="main-bnr-title">%s</strong>', $intro['titel']); 
                    if( !empty( $intro['beschrijving'] ) ) echo wpautop($intro['beschrijving']); 
                  ?>
                  <div class="main-bnr-con-des-btns">
                    <?php 
                      $knop1 = $intro['knop_1'];
                      $knop2 = $intro['knop_2'];
                      if( is_array( $knop1 ) &&  !empty( $knop1['url'] ) ){
                          printf('<div class="main-bnr-des-btn main-bnr-des-btn-1"><a href="%s" target="%s">%s</a></div>', $knop1['url'], $knop1['target'], $knop1['title']); 
                      } 
                      if( is_array( $knop2 ) &&  !empty( $knop2['url'] ) ){
                          printf('<div class="main-bnr-des-btn main-bnr-des-btn-2"><a href="%s" target="%s">%s</a></div>', $knop2['url'], $knop2['target'], $knop2['title']); 
                      } 
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
 <?php 
    $showhide_troef = get_field('showhide_troef', HOMEID);
    if( $showhide_troef ):
      $htroefs = get_field('home_troefs', HOMEID);
      if($htroefs):
  ?>
  <div class="hm-fea-boxs-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="hm-fea-boxs-sec-cntlr  hmFeaBoxsSecSlider clearfix">
            <?php foreach( $htroefs as $htroef ): ?>
            <div class="hm-fea-box-item-col">
              <div class="hm-fea-box-item mHc">
                <?php if( $htroef['knop'] ): ?>
                <a href="<?php echo $htroef['knop']; ?>" class="overlay-link"></a>
                <?php endif; ?>
                <div class="hm-fea-box-item-icon mHc1">
                  <i>
                    <svg class="hm-fea-box-item-icon-svg" width="38" height="38" viewBox="0 0 38 38" fill="#fff">
                      <use xlink:href="#hm-fea-box-item-icon-svg"></use>
                    </svg> 
                  </i>
                </div>
                <?php  
                  if( !empty( $htroef['titel'] ) ) printf( '<h4 class="hm-fea-box-item-title mHc2">%s</h4>', $htroef['titel']); 
                  if( !empty( $htroef['beschrijving'] ) ) echo wpautop($htroef['beschrijving']); 
                ?>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php 
endif;

endif; 
?>
</section>

<?php 
  $showhide_pcats = get_field('showhide_pcats', HOMEID);
  if( $showhide_pcats ):
    $pcats = get_field('pcats', HOMEID);
    if($pcats):
?>
<section class="hm-pro-bxes-section">
  <div class="hm-pro-bxes-sec-cntlr hmProBxesSlider clearfix">
    <?php 
    $pknop = '#';
    foreach( $pcats as $pcat ): 
      if( !empty($pcat['knop']) ):
        $pknop = $pcat['knop'];
      endif;
    ?>
    <div class="hmProBxesSlide">
      <div class="hm-pro-bxe-item mHc">
        <div class="hm-pro-bxe-item-icon mHc1">
          <i>
            <svg class="hm-pro-bxe-item-icon-01-svg" width="84" height="84" viewBox="0 0 84 84" fill="#000062">
              <use xlink:href="#hm-pro-bxe-item-icon-01-svg"></use>
            </svg> 
          </i>
        </div>
        <?php  
          if( !empty( $pcat['titel'] ) ) printf( '<h3 class="hm-pro-bxe-item-title mHc2"><a href="%s">%s</a></h3>', $pknop, $pcat['titel']); 
          if( !empty( $pcat['beschrijving'] ) ) echo wpautop($pcat['beschrijving']); 
        ?>
        <div class="hm-pro-bxe-item-more-link">
          <a href="<?php echo $pknop; ?>">Ontdek onze oplossingen</a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>

<?php 
  $showhide_overons = get_field('showhide_overons', HOMEID);
  if( $showhide_overons ):
    $hoverons = get_field('home_overons', HOMEID);
    if($hoverons):
    $ovafbeelding = '';
    if( !empty($hoverons['afbeelding']) ){
      $ovafbeelding = cbv_get_image_src($hoverons['afbeelding']);
    }
    $oblogos = $hoverons['logos'];
?>
<section class="hm-overons-section">
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="clearfix hm-overons-sec-inr">
            <div class="hm-overons-sec-fea-img-cntlr">
              <div class="hm-overons-sec-fea-img inline-bg" style="background: url(<?php echo $ovafbeelding; ?>);"></div>
            </div>
            <div class="hm-overons-sec-des">
              <?php  
                if( !empty( $hoverons['subtitel'] ) ) printf( '<h5 class="hm-overons-sec-des-sub-title">%s</h5>', $hoverons['subtitel']);  
                if( !empty( $hoverons['titel'] ) ) printf( '<h2 class="hm-overons-sec-des-title">%s</h2>', $hoverons['titel']);  
              ?>
              <?php if( $oblogos ): ?>
              <div class="hm-overons-sec-des-logos clearfix">
                <?php foreach($oblogos as $oblogo): ?>
                <div class="hm-overons-des-logo">
                  <div class="hm-overons-des-logo-inr mHc">
                    <?php if( !empty($oblogo['logo']) ) echo cbv_get_image_tag($oblogo['logo']); ?>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
              <?php if( !empty( $hoverons['beschrijving'] ) ) echo wpautop($hoverons['beschrijving']); ?>
              <div class="hm-overons-sec-des-btns">
                <?php 
                  $ovknop1 = $hoverons['knop_1'];
                  $ovknop2 = $hoverons['knop_2'];
                  if( is_array( $ovknop1 ) &&  !empty( $ovknop1['url'] ) ){
                      printf('<div class="hm-overons-sec-des-btn hm-overons-sec-des-btn-1"><a href="%s" target="%s">%s</a></div>', $ovknop1['url'], $ovknop1['target'], $ovknop1['title']); 
                  } 
                  if( is_array( $ovknop2 ) &&  !empty( $ovknop2['url'] ) ){
                      printf('<div class="hm-overons-sec-des-btn hm-overons-sec-des-btn-2"><a href="%s" target="%s">%s</a></div>', $ovknop2['url'], $ovknop2['target'], $ovknop2['title']); 
                  } 
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>    
</section>
<?php endif; ?>
<?php endif; ?>

<?php 
  $showhide_clients = get_field('showhide_clients', HOMEID);
  if( $showhide_clients ):
    $clientslogo = get_field('clientslogo', HOMEID);
    if($clientslogo):
?>
<section class="hm-client-logos-sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="hm-client-logos-sec-cntlr">
          <ul class="reset-list">
            <?php foreach($clientslogo as $clogo): ?>
            <li>
              <div class="mHc1">
                <?php if( !empty($clogo['logo']) ) echo cbv_get_image_tag($clogo['logo']); ?>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>

<?php 
  $showhide_referenties = get_field('showhide_referenties', HOMEID);
  if( $showhide_referenties ):
    $hrefer = get_field('hreferenties', HOMEID);
    if($hrefer):
?>
<section class="hm-our-references-sec">
  <div class="hm-our-references-sec-angle">
    <img src="<?php echo THEME_URI; ?>/assets/images/hm-our-references-sec-angle.png">
  </div>
  <div class="hm-our-references-sec-cntlr">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="hm-our-references-sec-hdr">
            <?php  
              if( !empty( $hrefer['titel'] ) ) printf( '<h3 class="horshdr-title">%s</h3>', $hrefer['titel']); 
              if( !empty( $hrefer['beschrijving'] ) ) echo wpautop($hrefer['beschrijving']); 
            ?>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="references-tab-btns">
            <div class="tp-tabs clearfix hide-sm">
              <ul class="reset-list">
                <li>
                  <button class="tab-link tab-btn current" data-tab="tab-1">
                    <i>
                      <svg class="tab-link-icon-01-svg" width="24" height="24" viewBox="0 0 24 24" fill="#474747">
                        <use xlink:href="#tab-link-icon-01-svg"></use>
                      </svg> 
                    </i>
                    <span>Bouwsector</span>
                  </button>
                </li>
                <li>
                  <button class="tab-link tab-btn" data-tab="tab-2">
                    <i>
                      <svg class="tab-link-icon-02-svg" width="24" height="24" viewBox="0 0 24 24" fill="#474747">
                        <use xlink:href="#tab-link-icon-02-svg"></use>
                      </svg> 
                    </i>
                    <span>Groothandel</span>
                  </button>
                </li>
                <li>
                  <button class="tab-link tab-btn" data-tab="tab-3">
                    <i>
                      <svg class="tab-link-icon-03-svg" width="24" height="24" viewBox="0 0 24 24" fill="#474747">
                        <use xlink:href="#tab-link-icon-03-svg"></use>
                      </svg> 
                    </i>
                    <span>Automobiel</span>
                  </button>
                </li>
                <li>
                  <button class="tab-link tab-btn" data-tab="tab-4">
                    <i>
                      <svg class="tab-link-icon-04-svg" width="24" height="24" viewBox="0 0 24 24" fill="#474747">
                        <use xlink:href="#tab-link-icon-04-svg"></use>
                      </svg> 
                    </i>
                    <span>Fabriek</span>
                  </button>
                </li>
                <li>
                  <button class="tab-link tab-btn" data-tab="tab-5">
                    <i>
                      <svg class="tab-link-icon-05-svg" width="24" height="24" viewBox="0 0 24 24" fill="#474747">
                        <use xlink:href="#tab-link-icon-05-svg"></use>
                      </svg> 
                    </i>
                    <span>Kledij</span>
                  </button>
                </li>
              </ul>
            </div>
            <div class="tp-tabs-xs show-sm">
              <strong class="tp-tabs-btn">Groothandel</strong>
              <ul class="reset-list">
                <li>Bouwsector</li>
                <li>Groothandel</li>
                <li>Automobiel</li>
                <li>Fabriek</li>
                <li>Kledij</li>
              </ul>
            </div>
          </div>
          <div class="references-tab-contens">
            <div id="tab-1" class="fl-tab-content current">
              <div class="hm-references-slider hmReferencesSlider">
                <div class="hmReferencesSlideItem">
                  <div class="tp-references-grd-row clearfix">
                    <div class="tp-references-grd-lft-col">
                      <div class="tp-references-grd-lft-fea-img inline-bg" style="background: url(<?php echo THEME_URI; ?>/assets/images/references-item-fea-img-01.png);">
                        
                      </div>
                    </div>
                    <div class="tp-references-grd-rgt-col">
                      <div class="tp-references-grd-rgt-col-inr">
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
                          <div class="hm-overons-sec-des-btn hm-overons-sec-des-btn-2">
                            <a href="#">Contacteer ons</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="hmReferencesSlideItem">
                  <div class="tp-references-grd-row clearfix">
                    <div class="tp-references-grd-lft-col">
                      <div class="tp-references-grd-lft-fea-img inline-bg" style="background: url(<?php echo THEME_URI; ?>/assets/images/references-item-fea-img-01.png);">
                        
                      </div>
                    </div>
                    <div class="tp-references-grd-rgt-col">
                      <div class="tp-references-grd-rgt-col-inr">
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
                          <div class="hm-overons-sec-des-btn hm-overons-sec-des-btn-2">
                            <a href="#">Contacteer ons</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-2" class="fl-tab-content">
              <div class="hm-references-slider hmReferencesSlider">
                <div class="hmReferencesSlideItem">
                  <div class="tp-references-grd-row clearfix">
                    <div class="tp-references-grd-lft-col">
                      <div class="tp-references-grd-lft-fea-img inline-bg" style="background: url(<?php echo THEME_URI; ?>/assets/images/references-item-fea-img-01.png);">
                        
                      </div>
                    </div>
                    <div class="tp-references-grd-rgt-col">
                      <div class="tp-references-grd-rgt-col-inr">
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
                          <div class="hm-overons-sec-des-btn hm-overons-sec-des-btn-2">
                            <a href="#">Contacteer ons</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="hmReferencesSlideItem">
                  <div class="tp-references-grd-row clearfix">
                    <div class="tp-references-grd-lft-col">
                      <div class="tp-references-grd-lft-fea-img inline-bg" style="background: url(<?php echo THEME_URI; ?>/assets/images/references-item-fea-img-01.png);">
                        
                      </div>
                    </div>
                    <div class="tp-references-grd-rgt-col">
                      <div class="tp-references-grd-rgt-col-inr">
                        <h4 class="tp-references-grd-des-title">Project titel 2</h4>
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
                          <div class="hm-overons-sec-des-btn hm-overons-sec-des-btn-2">
                            <a href="#">Contacteer ons</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-3" class="fl-tab-content">
              <div class="hm-references-slider hmReferencesSlider">
                <div class="hmReferencesSlideItem">
                  <div class="tp-references-grd-row clearfix">
                    <div class="tp-references-grd-lft-col">
                      <div class="tp-references-grd-lft-fea-img inline-bg" style="background: url(<?php echo THEME_URI; ?>/assets/images/references-item-fea-img-01.png);">
                        
                      </div>
                    </div>
                    <div class="tp-references-grd-rgt-col">
                      <div class="tp-references-grd-rgt-col-inr">
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
                          <div class="hm-overons-sec-des-btn hm-overons-sec-des-btn-2">
                            <a href="#">Contacteer ons</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="view-all-references-btn">
              <a href="#">
                <span>Bekijk al onze referenties </span>
                <i>
                  <svg class="right-arrow-white-svg" width="12" height="10" viewBox="0 0 12 10" fill="#fff">
                    <use xlink:href="#right-arrow-white-svg"></use>
                  </svg> 
                </i>
              </a>
            </div>
          </div>

        </div>



      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>



<section class="ftr-top-sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="ftr-top-inr">
          <h2 class="ftshdr-title">Neque feugiat vehicula aliquet</h2>
          <p>Vitae ridiculus dapibus morbi non, at orci leo volutpat integer. Aliquam ipsum sit magna est nulla nulla. <br>Dictum feugiat consectetur in mauris, scelerisque mattis netus gravida.</p>
          <div class="ftr-top-sec-btns">
            <div class="ftr-top-sec-btn ftr-top-sec-btn-tel">
              <a href="#">
                <i>
                  <svg class="tel-blue-icon-svg" width="28" height="28" viewBox="0 0 28 28" fill="#000062">
                    <use xlink:href="#tel-blue-icon-svg"></use>
                  </svg> 
                </i>
                <span>+32(0)53 80 49 12</span>
              </a>
            </div>
            <div class="ftr-top-sec-btn ftr-top-sec-btn-mail">
              <a href="#">
                <i>
                  <svg class="mail-blue-icon-svg" width="28" height="28" viewBox="0 0 28 28" fill="#000062">
                    <use xlink:href="#mail-blue-icon-svg"></use>
                  </svg> 
                </i>
                <span>info@itp.eu</span>
              </a>
            </div>
            <div class="ftr-top-sec-btn-3">
              <a href="#">Contacteer Ons</a>
            </div>
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
        <h5 class="cnt-gm-title">Industrial Textile Products</h5>
        <div class="cnt-gm-location">
          <strong class="cnt-gm-lctn-title">Locatie</strong>
          <a href="#">Evenbroekveld 44 <br>B-9420 Erpe-Mere <br>België</a>
        </div>
        <div class="cnt-gm-opening-hours">
          <strong class="cnt-gm-oh-title">openingstijden</strong>
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