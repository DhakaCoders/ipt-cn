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
            <?php 
            $has_knop = '';
            foreach( $htroefs as $htroef ): 
              if( !empty( $htroef['knop']) ){
                $has_knop = ' has-knop';
              }
            ?>
            <div class="hm-fea-box-item-col">
              <div class="hm-fea-box-item<?php echo $has_knop; ?> mHc">
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
           <?php if( !empty($pcat['icon']) ) echo cbv_get_image_tag($pcat['icon']); ?>
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
      $sCats = $hrefer['selecteer_categorieen'];
      $activeCat = $hrefer['actievecategorie'];
      $selecteerproducten = $hrefer['selecteerproducten'];
      var_dump($selecteerproducten);
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
        <?php if( $sCats ): ?>
        <div class="col-sm-12">
          <div class="references-tab-btns">
            <div class="tp-tabs clearfix hide-sm">
              <ul class="reset-list">
                <?php foreach( $sCats as $sCat ): ?>
                <li>
                  <a href="<?php echo get_term_link( $sCat ); ?>" class="tab-link tab-btn<?php echo ($activeCat == $sCat->term_id)? ' current': ''; ?>">
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
            </div>
            <div class="tp-tabs-xs show-sm">
              <strong class="tp-tabs-btn">Groothandel</strong>
              <ul class="reset-list">
                <?php foreach( $sCats as $sCat ): ?>
                  <li><a href="<?php echo get_term_link( $sCat ); ?>"><?php echo $sCat->name; ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="references-tab-contens">
            <div class="current">
              <div class="hm-references-slider hmReferencesSlider">
                <div class="hmReferencesSlideItem">
                  <div class="tp-references-grd-row clearfix">
                    <div class="tp-references-grd-lft-col">
                      <div class="tp-references-grd-lft-fea-img inline-bg" style="background: url(assets/images/references-item-fea-img-01.png);">
                        
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
                      <div class="tp-references-grd-lft-fea-img inline-bg" style="background: url(assets/images/references-item-fea-img-01.png);">
                        
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
        <?php endif; ?>


      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>
<?php 
get_template_part('templates/promo', 'section'); 
get_template_part('templates/gmap', 'section'); 
?>
<?php get_footer(); ?>