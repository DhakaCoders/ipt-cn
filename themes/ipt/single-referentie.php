<?php
get_header(); 
$referpageID = 240;
$thisID = get_the_ID();

$pageTitle = get_the_title($referpageID);
$standaardbanner = get_field('pagebanner', $thisID);
if( empty($standaardbanner) ) $standaardbanner = THEME_URI.'/assets/images/page-bnr.jpg';
?>
<section class="page-banner">
  <div class="page-banner-controller" style="overflow: hidden;">
    <div class="page-banner-bg inline-bg" style="background: url('<?php echo $standaardbanner; ?>');"></div>
    <div class="page-banner-des">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="page-banner-des-inner">
              <h1 class="page-banner-title"><?php echo $pageTitle; ?></h1>
              <div class="breadcrumbs">
                <?php cbv_breadcrumbs(); ?>
              </div>
              <div class="xs-breadcrumbs">
                <ul class="reset-list clearfix">
                  <li><a href="<?php echo esc_url( home_url() ); ?>">Home</a></li>
                  <li>
                    <a href="javascript:history.go(-1)">
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

<section class="back-link-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="back-link-sec-inr">
          <a href="javascript:history.go(-1)">
            Terug naar overzicht
            <i>
              <svg class="backlink-left-arrow-svg" width="8" height="14" viewBox="0 0 8 14" fill="#474747">
                <use xlink:href="#backlink-left-arrow-svg"></use>
              </svg> 
            </i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php 
$postTitle = get_the_title();
$permalink = get_the_permalink();
?>
<section class="referenties-details-slider-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="referenties-details-slider-sec-innr">
          <div class="referenties-details-slider-top">
            <div class="referenties-details-slider-top-hedding">
              <h2 class="referenties-details-slider-title"><?php the_title(); ?></h2>
            </div>
            <div class="referenties-details-slider-top-socials">
              <div class="referenties-details-slider-top-socials-text">
                <span>Delen:</span>
              </div>
              <div class="referenties-details-slider-top-socials-icons">
                <ul class="reset-list">
                  <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink; ?>&title=<?php echo $postTitle; ?>&summary=&source="><i class="fab fa-linkedin-in"></i></a></li>
                  <li><a href="https://twitter.com/home?status=<?php echo $permalink; ?>"><i class="fab fa-twitter"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
          <?php 
            $galerij = get_field('galerij', $thisID);
            if( $galerij ): 
          ?>
          <div class="referenties-details-sliders-cntlr">
            <div class="referenties-details-left-slider">
              <div class="rdls-arrows">
                <span class="rdls-lft-arrow">
                  <i>
                    <svg class="left-rd-arrow-white-svg" width="28" height="28" viewBox="0 0 28 28" fill="#fff">
                      <use xlink:href="#left-rd-arrow-white-svg"></use>
                    </svg> 
                  </i>
                </span>
                <span class="rdls-rgt-arrow">
                  <i>
                    <svg class="right-rd-arrow-white-svg" width="28" height="28" viewBox="0 0 28 28" fill="#fff">
                      <use xlink:href="#right-rd-arrow-white-svg"></use>
                    </svg> 
                  </i>
                </span>
              </div>
              <div class="referenties-details-slider referentiesDetailsSlider">
                <?php 
                $gful = '';
                foreach( $galerij as $galeri ): 
                  if( !empty($galeri['id']) ){
                    $gful = cbv_get_image_src($galeri['id'], 'galleryfull');
                  }
                ?>
                <div class="referenties-details-slider-items inline-bg" style="background: url('<?php echo $gful; ?>');">
                </div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="referenties-details-right-slider">
              <div class="rdls-thumbnail-arrows">
                <span class="rdls-lft-arrow">
                  <i>
                    <svg class="left-rd-arrow-white-svg" width="28" height="28" viewBox="0 0 28 28" fill="#fff">
                      <use xlink:href="#left-rd-arrow-white-svg"></use>
                    </svg> 
                  </i>
                </span>
                <span class="rdls-rgt-arrow">
                  <i>
                    <svg class="right-rd-arrow-white-svg" width="28" height="28" viewBox="0 0 28 28" fill="#fff">
                      <use xlink:href="#right-rd-arrow-white-svg"></use>
                    </svg> 
                  </i>
                </span>
              </div>
              <div class="referenties-details-thumbnail-slider referentiesDetailsThumbnailSlider">
                <?php 
                $gthum = '';
                foreach( $galerij as $galeri ): 
                  if( !empty($galeri['id']) ){
                    $gthum = cbv_get_image_src($galeri['id'], 'gallerythumb');
                  }
                ?>
                <div class="referenties-details-thumbnail-slider-items">
                  <div>
                    <div class="rdt-slider-items inline-bg" style="background: url('<?php echo $gthum; ?>');">
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
  $leftcol = get_field('leftcol', $thisID);
  $rightcol = get_field('rightcol', $thisID);
   
?>
<section class="Beschrijving">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="Beschrijving-innr">
          <?php if( $leftcol ): ?>
          <div class="Beschrijving-left">
            <?php  
              if( !empty( $leftcol['titel'] ) ) printf( '<h3 class="Beschrijving-left-title">%s</h3>', $leftcol['titel']); 
              if( !empty( $leftcol['beschrijving'] ) ) echo wpautop($leftcol['beschrijving']); 
            ?>
          </div>
          <?php endif; ?>
          <?php if( $rightcol ): ?>
          <div class="Beschrijving-desc">
            <?php  
              if( !empty( $rightcol['titel'] ) ) printf( '<h3 class="Beschrijving-desc-title">%s</h3>', $rightcol['titel']); 
              if( !empty( $rightcol['beschrijving'] ) ) echo wpautop($rightcol['beschrijving']); 
            ?>
            <div class="Beschrijving-desc-btn">
              <?php
                $knop = $rightcol['knop'];
                if( is_array( $knop ) &&  !empty( $knop['url'] ) ){
                    printf('<a href="%s" target="%s">%s</a>', $knop['url'], $knop['target'], $knop['title']); 
                }
              ?>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
  $producte = array();
  $showhide_producten = get_field('showhide_producten', $thisID);
  if( $showhide_producten ):
    $producte = get_field('productensec', $thisID);

    $prodCats = $producte['productencategories'];
    
?>
<section class="producten-overview-items-sec referenties-details-items-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="producten-overview-items-sec-innr referenties-details-items-sec-innr">
          <div class="referenties-details-items-sec-hedding">
            <?php if( !empty($producte['titel']) ): ?>
              <h2 class="referenties-details-items-title"><?php echo $producte['titel']; ?></h2>
            <?php else: ?>
              <h2 class="referenties-details-items-title"><?php _e('Producten', THEME_NAME); ?></h2>
            <?php endif; ?>
          </div>
          <?php 
            if( !empty($prodCats) ){
              $terms = $prodCats;      
            }else{
              $terms = get_terms( array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                'number' => 3,
                'parent' => 0
              ) );
            }
            if( $terms ):
            ?>
          <ul class="reset-list">
            <?php foreach ( $terms as $term ) { ?>
            <li>
              <div class="producten-overview-items mHc">
                <div class="producten-overview-items-cntlr">
                  <div class="producten-overview-items-img-cntlr">
                    <?php 
                    $afbeelding_id = get_field('afbeelding', $term, false); 
                    if( !empty($afbeelding_id) ):
                      $afbeelding_src = cbv_get_image_src( $afbeelding_id, 'pcatgrid' );
                    else:
                      $afbeelding_src = THEME_URI.'/assets/images/producten-overview-items-img-0010.jpg';
                    endif; ?>
                    <div class="producten-overview-items-img inline-bg" style="background: url('<?php echo $afbeelding_src; ?>');">
                      <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="overlay-link"></a>
                    </div>
                  </div>
                  <div class="producten-overview-items-title-wrap">
                    <h3 class="producten-overview-items-title referenties-details-items-title mHc1"><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php printf('%s', $term->name); ?></a></h3>
                  </div>
                  <div class="producten-overview-items-btn">
                    <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php _e('meer info', THEME_NAME); ?></a>
                  </div>
                </div>
              </div>
            </li>
          <?php } ?>
          </ul>
          <?php endif; ?> 
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php get_template_part('templates/gmap', 'section'); ?>
<?php get_footer(); ?>