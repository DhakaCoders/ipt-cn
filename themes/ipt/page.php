<?php 
get_header();
get_template_part( 'templates/page', 'banner' );
while ( have_posts() ) :
  the_post();
?>
<section class="innerpage-con-wrap">
  <?php if(have_rows('inhoud')){  ?>
  <div class="container-md">
    <div class="row">
      <div class="col-md-12">
        <article class="default-page-con">
          <?php 
            while ( have_rows('inhoud') ) : the_row(); 
          if( get_row_layout() == 'introductietekst' ){
              $title = get_sub_field('titel');
              $fc_editor = get_sub_field('fc_teksteditor');
              $afbeelding = get_sub_field('afbeelding');
              echo '<div class="dfp-promo-module clearfix">';
                if( !empty($title) ) printf('<div><strong class="dfp-promo-module-title">%s</strong></div>', $title);
                if( !empty($fc_editor) ) echo wpautop( $fc_editor );
                if( !empty($afbeelding) ){
                  echo '<div class="dfp-plate-one-img-bx">', cbv_get_image_tag($afbeelding), '</div>';
                }
              echo '</div>';    
          }elseif( get_row_layout() == 'teksteditor' ){
              $beschrijving = get_sub_field('fc_teksteditor');
              echo '<div class="dfp-text-module clearfix">';
                if( !empty( $beschrijving ) ) echo wpautop($beschrijving);
              echo '</div>';    
            }elseif( get_row_layout() == 'afbeelding_tekst' ){
              $fc_afbeelding = get_sub_field('fc_afbeelding');
              $imgsrc = cbv_get_image_src($fc_afbeelding, 'dfpageg1');
              $fc_tekst = get_sub_field('fc_tekst');
              $positie_afbeelding = get_sub_field('positie_afbeelding');
              $imgposcls = ( $positie_afbeelding == 'right' ) ? 'fl-dft-rgtimg-lftdes' : '';
              echo '<div class="fl-dft-overflow-controller">
                <div class="fl-dft-lftimg-rgtdes clearfix '.$imgposcls.'">';
                      echo '<div class="fl-dft-lftimg-rgtdes-lft mHc" style="background: url('.$imgsrc.');"></div>';
                echo '<div class="fl-dft-lftimg-rgtdes-rgt mHc">';
                    echo wpautop($fc_tekst);
                echo '</div>';
              echo '</div></div>';      
            }elseif( get_row_layout() == 'galerij' ){
              $gallery_cn = get_sub_field('afbeeldingen');
              $lightbox = get_sub_field('lightbox');
              $kolom = get_sub_field('kolom');
              if( $gallery_cn ):
              echo "<div class='gallery-wrap clearfix'><div class='gallery gallery-columns-{$kolom}'>";
                foreach( $gallery_cn as $image ):
                $imgsrc = cbv_get_image_src($image['ID'], 'dfpageg1');  
                echo "<figure class='gallery-item'><div class='gallery-icon portrait'>";
                if( $lightbox ) echo "<a data-fancybox='gallery' href='{$image['url']}'>";
                    //echo '<div class="dfpagegalleryitem" style="background: url('.$imgsrc.');"></div>';
                    echo wp_get_attachment_image( $image['ID'], 'dfpageg1' );
                if( $lightbox ) echo "</a>";
                echo "</div></figure>";
                endforeach;
              echo "</div></div>";
              endif;      
            }elseif( get_row_layout() == 'troefs' ){
              $fc_usps = get_sub_field('fc_troefs');
              echo "<div class='dft-fea-boxs clearfix'>";
                foreach( $fc_usps as $usp ):
                  echo "<div class='dft-fea-box-item'>";
                    echo "<div class='dft-fea-box-item-inr'>";
                    if( $usp['knop'] ):
                      echo '<a href="'.$usp['knop'].'" class="overlay-link"></a>';
                    endif;
	                    echo '<div class="dft-fea-box-item-icon mHc1">';
	                    echo '<i><svg class="hm-fea-box-item-icon-svg" width="38" height="38" viewBox="0 0 38 38" fill="#fff">
                      <use xlink:href="#hm-fea-box-item-icon-svg"></use></svg></i>';
	                    echo "</div>";
	                    printf('<h4 class="dft-fea-box-item-title mHc2">%s</h4>', $usp['titel']);
	                    if( !empty( $usp['beschrijving'] ) ) echo wpautop($usp['beschrijving']);
                  	echo "</div>";
                  echo "</div>";
                endforeach;
              echo "</div>";
            }elseif( get_row_layout() == 'producten' ){
              $fc_prodcts = get_sub_field('fc_producten');
                echo '<div class="dft-pro-items">
                    <div class="dft-pro-item">
                      <div class="hm-pro-bxe-item">
                        <div class="hm-pro-bxe-item-icon mHc1">
                          <i>
                            <svg class="hm-pro-bxe-item-icon-01-svg" width="84" height="84" viewBox="0 0 84 84" fill="#000062">
                              <use xlink:href="#hm-pro-bxe-item-icon-01-svg"></use>
                            </svg> 
                          </i>';
                echo '</div>';
                if( !empty( $fc_prodcts['titel'] ) ) printf( '<h3 class="hm-pro-bxe-item-title mHc2">%s</h3>', $fc_prodcts['titel']); 
                if( !empty( $fc_prodcts['beschrijving'] ) ) echo wpautop($fc_prodcts['beschrijving']); 
                if( !empty($fc_prodcts['knop']) ):
                echo '<div class="hm-pro-bxe-item-more-link">'; 
                  printf('<a href="%s">Ontdek onze oplossingen</a>', $fc_prodcts['knop']);
                echo '</div>';
                endif;
                echo '</div></div></div>';
            }elseif( get_row_layout() == 'logo' ){
              $fc_logos = get_sub_field('fc_logo');
              if( $fc_logos ):
              echo '<div class="dft-overons-logos-cntlr">';
  	            echo '<div class="hm-overons-sec-des-logos clearfix">';
                foreach( $fc_logos as $fc_logo ):
  	            echo '<div class="hm-overons-des-logo"><div class="hm-overons-des-logo-inr mHc">';
    	          if( !empty($fc_logo['logo']) ) echo cbv_get_image_tag($fc_logo['logo']);
    	          echo '</div></div>';
                endforeach;
  	            echo '</div>';
	            echo '</div>';
            endif;
            }elseif( get_row_layout() == 'gmap' ){
              $fc_gmap = get_sub_field('fc_gmap');
              $ghours = $fc_gmap['openingstijden'];
              $address = get_field('address', 'options');
              $gmapsurl = get_field('google_maps', 'options');
              $gmaplink = !empty($gmapsurl)?$gmapsurl: 'javascript:void()';
              if($fc_gmap):
              echo '<div class="dft-map">';
              echo '<div class="google-map">';
              if( !empty($fc_gmap['map']) ) printf('%s', $fc_gmap['map']);
              echo '</div>';
              echo '<div class="contact-google-map-des">';
              echo '<div class="contact-google-map-des-ctlr">';
              echo '<div class="contact-google-map-des-inr">';
              echo '<h5 class="cnt-gm-title">';
              _e('Industrial Textile Products', THEME_NAME);
              echo '</h5>';
              echo '<div class="cnt-gm-location">';
              echo '<strong class="cnt-gm-lctn-title">';
              _e('Locatie', THEME_NAME);
              echo '</strong>';
              if( !empty($address) ) printf('<a href="%s">%s</a>', $gmaplink, $address);
              echo '</div>';
              echo '<div class="cnt-gm-opening-hours">';
              echo '<strong class="cnt-gm-oh-title">';
              _e('openingstijden', THEME_NAME);
              echo '</strong>';
              if($ghours):
              echo '<ul class="reset-list">';
                foreach( $ghours as $hour ):
                if(!empty($hour['hours'])) printf('<li><strong>%s</strong></li>', $hour['hours']);
                endforeach;
              echo '</ul> '; 
              endif;    
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '<hr>';
              endif;
            }elseif( get_row_layout() == 'table' ){
              $fc_table = get_sub_field('fc_table');
              cbv_table($fc_table);
            }elseif( get_row_layout() == 'horizontal_rule' ){
              $fc_horizontal_rule = get_sub_field('fc_horizontal_rule');
              echo '<div class="dft-2grd-img-content-separetor" style="height:'.$fc_horizontal_rule.'px"></div>';
            }elseif( get_row_layout() == 'afbeelding' ){
              $fc_afbeelding = get_sub_field('fc_afbeelding');
              if( !empty( $fc_afbeelding ) ){
                printf('<div class="dfp-plate-one-img-bx">%s</div>', cbv_get_image_tag($fc_afbeelding));
              }
            }elseif( get_row_layout() == 'horizontal_rule' ){
              $rheight = get_sub_field('fc_horizontal_rule');
              printf('<div class="dfhrule clearfix" style="height: %spx;"></div>', $rheight);
          
            }elseif( get_row_layout() == 'gap' ){
             $gap = get_sub_field('fc_gap');
             printf('<div class="gap clearfix" data-value="20" data-md="20" data-sm="20" data-xs="10" data-xxs="10"></div>', $rheight);
            }
          
           endwhile;?>
        </article>

      </div>
    </div>
  </div>
<?php }else{ ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="default-page-con">
                <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</section>
<?php 
endwhile; 
get_footer(); 
?>