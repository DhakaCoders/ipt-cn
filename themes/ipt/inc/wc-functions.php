<?php

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);


add_action('woocommerce_before_main_content', 'get_custom_wc_output_content_wrapper', 11);
add_action('woocommerce_after_main_content', 'get_custom_wc_output_content_wrapper_end', 9);

function get_custom_wc_output_content_wrapper(){

    if(is_shop() OR is_product_category()){ 
    	echo '<section class="product-list-page-con">
		<div class="container-xlg">
		    <div class="row">
		      <div class="col-md-12">
		        <div class="fl-page-entry-hdr">
		          <h1 class="fl-page-entry-hdr-title">';
		          woocommerce_page_title();
		          echo '</h1>
		          <span class="fl-total-products-number">';
		          woocommerce_result_count();
		          echo '</span>
		        </div>
		      </div>
		    </div>
		  </div> 
    	<div class="container-xlg">
    	<div class="row">
    	<div class="col-lg-4">
    		<div class="fl-sidebar-cntlr">';
	    	  cbv_custom_both_breadcrump();  
			echo '<div class="fl-my-slection">
		            <div class="fl-my-slection-hdr">
		              <label>My Selection</label>
		              <a href="'.get_permalink(get_option( 'woocommerce_shop_page_id' )).'" class="delete-all-btn">Delete all</a>
		            </div>
		            <div class="fl-my-slect-items">
		              <ul class="reset-list">';
                        remove_checked_parameters();
		              echo '</ul>
		            </div>
	          	</div>';
	          	echo do_shortcode( '[searchandfilter id="product_filter"]' );
    		echo '</div>
    	</div>';
    	echo '<div class="col-lg-8">';
    	echo '<div class="fl-product-list-con">';
    }


}

function get_custom_wc_output_content_wrapper_end(){
	if(is_shop() OR is_product_category()){ 
    	echo '</div></div></div></div></section>';
	}

}

function remove_checked_parameters(){
    if( isset( $_GET['wpf_category'] ) && !empty($_GET['wpf_category']) ){
        $catarrays = get_array( $_GET['wpf_category'] );
        if( $catarrays && !empty($catarrays) ){
            foreach( $catarrays as $cat ){
                echo '<li id="cat_'.$cat.'"><label>'.$cat.'</label>';
                echo "<span onclick=\"removeCatParam('".$cat."')\">";
                echo '<img src="'.THEME_URI.'/assets/images/close-sm-icon.png"></span></li>';
            }
        }
    }

    if( isset( $_GET['sex'] ) && !empty($_GET['sex']) ){
        $sexarrays = get_array( $_GET['sex'] );
        if( $sexarrays && !empty($sexarrays) ){
            foreach( $sexarrays as $sex ){
                echo '<li id="sex_'.$sex.'"><label>'.$sex.'</label>';
                echo "<span onclick=\"removeSexParam('".$sex."')\">";
                echo '<img src="'.THEME_URI.'/assets/images/close-sm-icon.png"></span></li>';
            }
        }
    }

    if( isset( $_GET['size'] ) && !empty($_GET['size']) ){
        $sizearrays = get_array( $_GET['size'] );
        if( $sizearrays && !empty($sizearrays) ){
            foreach( $sizearrays as $size ){
                echo '<li id="size_'.$size.'"><label>'.$size.'</label>';
                echo "<span onclick=\"removeSizeParam('".$size."')\">";
                echo '<img src="'.THEME_URI.'/assets/images/close-sm-icon.png"></span></li>';
            }
        }
    }

    if( isset( $_GET['color'] ) && !empty($_GET['color']) ){
        $colorarrays = get_array( $_GET['color'] );
        if( $colorarrays && !empty($colorarrays) ){
            foreach( $colorarrays as $color ){
                echo '<li id="color_'.$color.'"><label>'.$color.'</label>';
                echo "<span onclick=\"removeColorParam('".$color."')\">";
                echo '<img src="'.THEME_URI.'/assets/images/close-sm-icon.png"></span></li>';
            }
        }
    }

    if( isset( $_GET['material'] ) && !empty($_GET['material']) ){
        $materialarrays = get_array( $_GET['material'] );
        if( $materialarrays && !empty($materialarrays) ){
            foreach( $materialarrays as $material ){
                echo '<li id="mat_'.$material.'"><label>'.$material.'</label>';
                echo "<span onclick=\"removeMaterialParam('".$material."')\">";
                echo '<img src="'.THEME_URI.'/assets/images/close-sm-icon.png"></span></li>';
            }
        }
    }

    if( isset( $_GET['collection'] ) && !empty($_GET['collection']) ){
        $collectionarrays = get_array( $_GET['collection'] );
        if( $collectionarrays && !empty($collectionarrays) ){
            foreach( $collectionarrays as $collection ){
                echo '<li id="coll_'.$collection.'"><label>'.$collection.'</label>';
                echo "<span onclick=\"removeCollectionParam('".$collection."')\">";
                echo '<img src="'.THEME_URI.'/assets/images/close-sm-icon.png"></span></li>';
            }
        }
    }
}

function get_array( $string ){
    if( !empty( $string ) ){ 
        $str_arr = preg_split ("/\,/", $string);   
        return $str_arr;
    }
    return false;
}

add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');

function wc_customize_product_sorting($sorting_options){
    $sorting_options = array(
        'menu_order' => __( 'sort by', 'woocommerce' ),
        'popularity' => __( 'popularity', 'woocommerce' ),
        'rating'     => __( 'average rating', 'woocommerce' ),
        'date'       => __( 'newness', 'woocommerce' ),
        'price'      => __( 'low price', 'woocommerce' ),
        'price-desc' => __( 'high price', 'woocommerce' ),
    );

    return $sorting_options;
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

/*Loop Hooks*/


/**
 * Add loop inner details are below
 */

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action('woocommerce_shop_loop_item_title', 'add_shorttext_below_title_loop', 5);
if (!function_exists('add_shorttext_below_title_loop')) {
    function add_shorttext_below_title_loop() {
        global $product, $woocommerce, $post;
        $sc = '[yith_quick_view product_id="'.$product->get_id().'" type="icon" label="QV"]';
		echo '<div class="fl-product-item hello">';
        wc_stock_manage();
        echo '<div class="fl-product-item-fea-img">';
        echo '<a href="'.get_permalink( $product->get_id() ).'">';
        echo wp_get_attachment_image( get_post_thumbnail_id($product->get_id()), 'pgrid' );
        echo '</a>';
        echo '<div class="product-overlay-icons">';
        get_wish_thumb();
        echo '<a href="#" class="product-overlay-icon-search yith-wcqv-button" data-product_id="'.$product->get_id().'"><i class="fas fa-search"></i></a>';
        echo do_shortcode($sc);
        echo '</div>';
        echo '</div>';
        echo '<div class="fl-product-item-des mHc">';
        get_loop_condition();
        echo '<h6 class="fl-product-title"><a href="'.get_permalink( $product->get_id() ).'">'.get_the_title().'</a></h6>';
        echo '<div class="fl-product-box-prices">';
        echo '<div class="fl-product-regular-price">'.$product->get_price_html().'</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
    }
}

function get_wish_thumb(){
    if (class_exists('Alg_WC_Wish_List_Toggle_Btn')) {
        $obj = new Alg_WC_Wish_List_Toggle_Btn();
        echo '<a class="product-overlay-icon-heart">';
          $obj::show_thumb_btn();
        echo '</a>';
   }

}

function get_loop_condition(){
    global $product;
    $condition = get_field('condition', $product->get_id());
    if( !empty($condition) ):
        printf('<strong class="fl-product-variable-title">%s</strong>', $condition);
    endif;
}

function wc_stock_manage(){
    global $product;
    $StockQ = $product->get_stock_quantity();
    if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
        echo '<span class="out-of-stock">Out of Stock</span>';
        
    } elseif( $StockQ < 1 ) {
        if ($product->backorders_allowed()){
            echo '<span class="backorders">Available on Backorder</span>';
        } elseif ( !$product->backorders_allowed() && $StockQ == 0 && ! $product->is_in_stock()){
            echo '<span class="out-of-stock">Out of Stock</span>';
        } elseif ( $product->is_on_backorder() ){
            echo '<span class="backorders">Available on Backorder</span>';
        }
    } 
}

/*Remove Single page Woocommerce Hooks & Filters are below*/

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );



add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
function jk_related_products_args( $args ) {
$args['posts_per_page'] = 8; // 4 related products
return $args;
}

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 

function woocommerce_custom_single_add_to_cart_text() {
    return __( 'ADD TO BAG', 'woocommerce' ); 
}



add_action( 'wc_subtitle', 'wc_single_product_under_title', 6 );
function wc_single_product_under_title(){
    echo '<p>Science Stuff Collection</p>';
}

add_action( 'wc_view_page', 'wc_single_quickview_view_page' );
function wc_single_quickview_view_page(){
    global $product;
    echo '<div class="viewpage clearfix"><a href="'.get_permalink( $product->get_id() ).'">VIEW PRODUCT PAGE</a></div>';
}

add_action( 'woocommerce_single_product_summary', 'wc_single_product_under_cartbutton', 31 );
function wc_single_product_under_cartbutton(){
    echo '<div class="sharewith">SHARE WITH LOVE +</div>';
}

add_action( 'woocommerce_single_product_summary', 'wc_single_product_price', 10 );
function wc_single_product_price(){
    global $product;
    $output = '<div class="price-wrapp">';
    $output .= $product->get_price_html();
    $output .= '</div>';

    echo $output;
}


add_action( 'woocommerce_custom_metafield', 'wc_single_product_metafields' );

function wc_single_product_metafields(){
    global $product;
    $output = '';
    $spacifics = get_field('spacifications', $product->get_id());
    if( $spacifics ):
    $output .= '<div class="wc-accordion">';
    foreach( $spacifics as $spacific ):
    $output .= '<div class="faq-accordion-tab-row">';
                if( !empty($spacific['label']) ): 
    $output .= '<h6 class="faq-accordion-title">'.$spacific['label'].'</h6>';
                endif;
                if( !empty($spacific['details']) ): 
    $output .= '<div class="faq-accordion-des">';
    $output .= '<p>'.$spacific['details'].'</p>';
    $output .= '</div>';
                endif;
    $output .= '</div>';
    endforeach;
    $output .= '</div>';
    endif;

    echo $output;
}

//custom action 'woocommerce_delivery_text' is used on add to cart button 

add_action( 'woocommerce_delivery_text', 'wc_single_free_delivery_text' );

function wc_single_free_delivery_text(){

    echo '<div class="free-text"><p>Free Delivery for over 50 <span>€</span></p</div>';
}



// change a number of the breadcrumb defaults.
add_filter( 'woocommerce_breadcrumb_defaults', 'cbv_woocommerce_breadcrumbs' );
if( !function_exists('cbv_woocommerce_breadcrumbs')):
function cbv_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '',
            'wrap_before' => '<div class="fl-breadcrumbs"><ul class="reset-list">',
            'wrap_after'  => '</ul></div>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'home', 'breadcrumb', 'woocommerce' ),
        );
}
endif;