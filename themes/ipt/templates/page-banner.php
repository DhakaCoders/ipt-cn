<?php
if( is_tax('product_cat') ):
	$thisID = 238;
elseif( is_archive('referentie')):
	$thisID = 240;
else:
	$thisID = get_the_ID();
endif;

$pageTitle = get_the_title($thisID);
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