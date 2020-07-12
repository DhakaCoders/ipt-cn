<?php
  $spacialArry = array(".", "/", "+", " ", "(", ")");$replaceArray = '';
  $promo = get_field('calltoaction', 'options');
  $emailadres = get_field('emailaddress', 'options');
  $show_telefoon = get_field('telephone', 'options');
  $telefoon = trim(str_replace($spacialArry, $replaceArray, $show_telefoon));
?>
<section class="ftr-top-sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="ftr-top-inr">
          <?php 
            if( !empty( $promo['titel'] ) ) printf( '<h2 class="ftshdr-title">%s</h2>', $promo['titel']); 
            if( !empty( $promo['beschrijving'] ) ) echo wpautop($promo['beschrijving']); 
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
                <span><?php echo $telefoon; ?></span>
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
            <div class="ftr-top-sec-btn-3">
              <?php
                $knop = $promo['knop'];
                if( is_array( $knop ) &&  !empty( $knop['url'] ) ){
                  printf('<a href="%s" target="%s">%s</a>', $knop['url'], $knop['target'], $knop['title']); 
                } 
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>