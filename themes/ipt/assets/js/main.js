(function($) {

/*Google Map Style*/
var CustomMapStyles  = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]

var windowWidth = $(window).width();
$('.navbar-toggle').on('click', function(){
	$('#mobile-nav').slideToggle(300);
});
	
  
//matchHeightCol
if($('.mHc').length){
  $('.mHc').matchHeight();
};
if($('.mHc1').length){
  $('.mHc1').matchHeight();
};
if($('.mHc2').length){
  $('.mHc2').matchHeight();
};
if($('.mHc3').length){
  $('.mHc3').matchHeight();
};
if($('.mHc4').length){
  $('.mHc4').matchHeight();
};
if($('.mHc5').length){
  $('.mHc5').matchHeight();
};


//$('[data-toggle="tooltip"]').tooltip();

//banner animation
$(window).scroll(function() {
  var scroll = $(window).scrollTop();
  $('.page-banner-bg').css({
    '-webkit-transform' : 'scale(' + (1 + scroll/2000) + ')',
    '-moz-transform'    : 'scale(' + (1 + scroll/2000) + ')',
    '-ms-transform'     : 'scale(' + (1 + scroll/2000) + ')',
    '-o-transform'      : 'scale(' + (1 + scroll/2000) + ')',
    'transform'         : 'scale(' + (1 + scroll/2000) + ')'
  });
});


if($('.fancybox').length){
$('.fancybox').fancybox({
    //openEffect  : 'none',
    //closeEffect : 'none'
  });

}

// if (windowWidth <= 767) {
  $('.toggle-btn').on('click', function(){
    $(this).toggleClass('menu-expend');
    $('.toggle-bar ul').slideToggle(500);
  });

/**
Slick slider
*/
if( $('.responsive-slider').length ){
    $('.responsive-slider').slick({
      dots: true,
      infinite: false,
      autoplay: true,
      autoplaySpeed: 2000,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
}

if( $('#mapID').length ){
var latitude = $('#mapID').data('latitude');
var longitude = $('#mapID').data('longitude');

var myCenter= new google.maps.LatLng(latitude,  longitude);
function initialize(){
    var mapProp = {
      center:myCenter,
      mapTypeControl:true,
      scrollwheel: false,
      zoomControl: true,
      disableDefaultUI: true,
      zoom:7,
      streetViewControl: false,
      rotateControl: true,
      mapTypeId:google.maps.MapTypeId.ROADMAP,
      styles: CustomMapStyles
      };

    var map= new google.maps.Map(document.getElementById('mapID'),mapProp);
    var marker= new google.maps.Marker({
      position:myCenter,
        //icon:'map-marker.png'
      });
    marker.setMap(map);
}
google.maps.event.addDomListener(window, 'load', initialize);

}



var container = $(".container").width();
var sidewidth = windowWidth - container;
var leftsidewidth = sidewidth / 2;
//var gmdesWidth = leftsidewidth - 15;
$(".contact-google-map-des-ctlr").css({left : leftsidewidth});


if( $('.iptPdSliders').length ){
    $('.iptPdSliders').slick({
      pauseOnHover: false,
      dots: false,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 4000,
      arrows: true,
      speed: 600,
      centerMode: false,
      slidesToShow: 3,
      slidesToScroll: 1,
      prevArrow: $('.ipt-pd-slider-arrow .ipt-pd-slider-leftarrow'),
      nextArrow: $('.ipt-pd-slider-arrow .ipt-pd-slider-rightarrow'),
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: false,
            arrows: true
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: true
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
}


$('.referentiesDetailsSlider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  prevArrow: $('.rdls-arrows .rdls-lft-arrow'),
  nextArrow: $('.rdls-arrows .rdls-rgt-arrow'),
  fade: true,
  asNavFor: '.referentiesDetailsThumbnailSlider'
});

$('.referentiesDetailsThumbnailSlider').slick({
  slidesToShow: 2,
  slidesToScroll: 1,
  asNavFor: '.referentiesDetailsSlider',
  autoplay: true,
  autoplaySpeed: 4000,
  dots: false,
  infinite: true,
  focusOnSelect: true,
  arrows: true,
  prevArrow: $('.rdls-thumbnail-arrows .rdls-lft-arrow'),
  nextArrow: $('.rdls-thumbnail-arrows .rdls-rgt-arrow'),
  adaptiveHeight: true,
  vertical: true,
  verticalSwiping: true
});


$('.xsReferentiesDetailsBigSlider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  dots: false,
  asNavFor: '.xsReferentiesDetailsThumbSlider'
});

$('.xsReferentiesDetailsThumbSlider').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.xsReferentiesDetailsBigSlider',
  dots: false,
  arrows: false,
  infinite: false,
  focusOnSelect: true,
  responsive: [
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
          }
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
});
if( $('.hm-overons-sec-des-logos').length ){
    $('.hm-overons-sec-des-logos').slick({
      dots: false,
      infinite: false,
      autoplay: false,
      autoplaySpeed: 2000,
      speed: 300,
      slidesToShow: 2,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 640,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
          }
        }
      ]
    });
}


if( $('.hmFeaBoxsSecSlider').length ){
    $('.hmFeaBoxsSecSlider').slick({
      dots: false,
      infinite: false,
      autoplay: false,
      autoplaySpeed: 2000,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            dots: true
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            dots: true
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            dots: true,
            arrows: false
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
}

if( $('.hmReferencesSlider').length ){
    $('.hmReferencesSlider').slick({
      dots: false,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 4000,
      speed: 700,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      responsive: [
        {
          breakpoint: 640,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        }
      ]
    });
}


if (windowWidth <= 767) {
  $('.ftr-col h5').on('click', function(){
    $(this).toggleClass('active');
    $(this).parent().siblings().find('h6').removeClass('active');
    $(this).parent().siblings().find('ul').slideUp(300);
    $(this).parent().find('ul').slideToggle(300);
    
  });


  $('.nav-opener').on('click', function(){
    $('.xs-popup-menu').fadeIn(500);
    $('.xs-popup-menu').addClass('add-cls-show');
  });
  $('.xs-menu-close-btn-controller').on('click', function(){
    $('.xs-popup-menu').fadeOut(500);
    $('.xs-popup-menu').removeClass('add-cls-show');
  });

  $('.xs-main-nav > ul > li.menu-item-has-children > a').on('click', function(e){
    e.preventDefault();
    $(this).parent().find('ul.sub-menu').slideToggle(500);
    $(this).toggleClass('sub-menu-expend')
  });
}


var container = $(".container").width();
var tpreferencesgrdrgtcolWidth = $(".tp-references-grd-lft-col").outerWidth();
var tpreferencesgrdrgtcolWidthCal1 = (container - tpreferencesgrdrgtcolWidth) - 25;
var tpreferencesgrdrgtcolWidthCal2 = (container - tpreferencesgrdrgtcolWidth) - 70;
$(".hmReferencesSlider .slick-prev").css({right : tpreferencesgrdrgtcolWidthCal1});
$(".hmReferencesSlider .slick-next").css({right : tpreferencesgrdrgtcolWidthCal2});



$('.tp-tabs-btn').on('click', function(){
  $(this).toggleClass('tp-tabs-btn-expend');
  $('.tp-tabs-xs ul').slideToggle(500);
  
});
/*$('.tp-tabs-xs ul li').on('click', function(){
  var selectText = $(this).text();
  $('.tp-tabs-btn').html(selectText);
});*/

$("#producten").click(function(e) {
  e.preventDefault();
    $('html, body').animate({
        scrollTop: $("#target-producten").offset().top
    }, 500);
});
})(jQuery);