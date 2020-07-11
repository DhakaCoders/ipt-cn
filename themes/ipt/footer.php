<?php 
  $logoObj = get_field('logo_1', 'options');
  $logoObj2 = get_field('logo_2', 'options');
  if( is_array($logoObj) ){
    $logo_tag = '<img src="'.$logoObj['url'].'" alt="'.$logoObj['alt'].'" title="'.$logoObj['title'].'">';
  }else{
    $logo_tag = '';
  }

  if( is_array($logoObj2) ){
    $logo_tag2 = '<img src="'.$logoObj2['url'].'" alt="'.$logoObj2['alt'].'" title="'.$logoObj2['title'].'">';
  }else{
    $logo_tag2 = '';
  }

  $spacialArry = array(".", "/", "+", " ");$replaceArray = '';
  $adres = get_field('address', 'options');
  $gmapsurl = get_field('google_maps', 'options');
  $e_mailadres = get_field('emailaddress', 'options');
  $show_telefoon = get_field('telephone', 'options');
  $telefoon = trim(str_replace($spacialArry, $replaceArray, $show_telefoon));
  $show_fax = get_field('fax', 'options');
  $fax = trim(str_replace($spacialArry, $replaceArray, $show_fax));
  $copyright_text = get_field('copyright_text', 'options');
  $gmaplink = !empty($gmapsurl)?$gmapsurl: 'javascript:void()';
  $bwt = get_field('bwt', 'options');
?>
<footer class="footer-wrp">
  <div class="ftr-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="ftr-cols clearfix">
            <div class="ftr-col ftr-col-1">
              <div class="ftr-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                  <?php echo $logo_tag; ?>
                </a>
              </div>
              <div class="ftr-extra-logo">
                <?php echo $logo_tag2; ?>
              </div>
            </div>
            <div class="ftr-col ftr-col-2">
              <h5 class="ftr-col-title">
                <span><?php _e('Navigatie', THEME_NAME); ?></span>
              </h5>
              <?php 
                $fmenuOptions = array( 
                    'theme_location' => 'cbv_fta_menu', 
                    'menu_class' => 'reset-list',
                    'container' => '',
                    'container_class' => ''
                  );
                wp_nav_menu( $fmenuOptions ); 
              ?>
            </div>
            <div class="ftr-col ftr-col-3">
              <h5 class="ftr-col-title">
                <span class="hide-sm"><?php _e('Andere', THEME_NAME); ?></span> 
                <span class="show-sm"><?php _e('Other', THEME_NAME); ?></span>

              </h5>
              <?php 
                $fmenuOptionsb = array( 
                    'theme_location' => 'cbv_ftb_menu', 
                    'menu_class' => 'reset-list',
                    'container' => '',
                    'container_class' => ''
                  );
                wp_nav_menu( $fmenuOptionsb ); 
              ?>
            </div>
            <div class="ftr-col ftr-col-4">
              <h5 class="ftr-col-title">
                <span class="hide-sm"><?php _e('Industrial Textile Products', THEME_NAME); ?></span> 
                <span class="show-sm"><?php _e('Contact', THEME_NAME); ?></span>
              </h5>
              <ul class="reset-list">
                <?php 
                  if( !empty( $adres ) ) printf('<li class="loc-address"><a href="%s">%s</a></li>', $gmaplink, $adres); 
                  if( !empty( $e_mailadres ) ) printf('<li><a href="mailto:%s">%s</a></li>', $e_mailadres, $e_mailadres); 
                  if( !empty( $show_telefoon ) ) printf('<li class="ftr-tel"><a href="tel:%s">T <span>%s</span></a></li>', $telefoon, $show_telefoon); 
                  if( !empty( $show_fax ) ) printf('<li><a href="tel:%s">F %s</a></li>', $fax, $show_fax); 
                  
                  if( !empty( $bwt ) ) printf('<li><a>BTW: %s</a></li>', $bwt); 
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ftr-btm">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="ftr-btm-inr">
            <?php if( !empty( $copyright_text ) ) printf( '<span>%s</span>', $copyright_text); ?>
            <a href="#">webdesign by conversal</a>
          </div>
        </div>
      </div>
    </div> 
  </div>
</footer>

<div class="show-sm">
  <div class="xs-nav-menu-bar clearfix">
   <div class="xs-nav-menu-innr clearfix">
    <div class="nav-opener">
       <div class="nav-opener-btn">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <strong><?php _e('MENU', THEME_NAME); ?></strong>
    </div>
   </div>
  </div>
</div>
<div class="xs-popup-menu">
    <div class="xs-popup-menu-innr" style="position: relative;">
       <div class="xs-logo">
          <div class="ftr-logo">
            <a href="#">
              <img src="<?php echo THEME_URI; ?>/assets/images/logo.png">
            </a>
          </div>
       </div>
        <nav class="xs-main-nav">

          <?php 
            $menuOptions = array( 
                'theme_location' => 'cbv_main_menu', 
                'menu_class' => 'clearfix reset-list',
                'container' => '',
                'container_class' => ''
              );
            wp_nav_menu( $menuOptions ); 
          ?>  
        </nav>
        <div class="xs-menu-close-btn-controller">
           <div class="fl-close-btn">
             <span></span>
             <span></span>
             <span></span>
           </div>
           <strong><?php _e('sluit', THEME_NAME); ?></strong>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>