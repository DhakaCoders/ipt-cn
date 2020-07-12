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
            }elseif( get_row_layout() == 'usps' ){
              $fc_usps = get_sub_field('fc_usps');
              echo "<div class='dft-fea-boxs clearfix'>";
                foreach( $fc_usps as $usp ):
                  echo "<div class='dft-fea-box-item'>";
                    echo "<div class='dft-fea-box-item-inr'>";
	                    echo '<div class="dft-fea-box-item-icon mHc1">';
	                    echo wp_get_attachment_image( $usp['icon'] );
	                    echo "</div>";
	                    printf('<h4 class="dft-fea-box-item-title mHc2">%s</h4>', $usp['titel']);
	                    if( !empty( $usp['beschrijving'] ) ) echo wpautop($usp['beschrijving']);
                  	echo "</div>";
                  echo "</div>";
                endforeach;
              echo "</div>";
            }elseif( get_row_layout() == 'logo' ){
              $fc_logos = get_sub_field('fc_logo');
              echo '<div class="dft-overons-logos-cntlr">';
	            echo '<div class="hm-overons-sec-des-logos clearfix">';
	              <div class="hm-overons-des-logo">
	                <div class="hm-overons-des-logo-inr mHc">
	                  <img src="assets/images/hm-overons-sec-des-logo-01.png">
	                </div>
	              </div>
	              <div class="hm-overons-des-logo">
	                <div class="hm-overons-des-logo-inr mHc">
	                  <img src="assets/images/hm-overons-sec-des-logo-02.png">
	                </div>
	              </div>
	            echo '</div>';
	          echo '</div>';
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