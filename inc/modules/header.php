<?php
if ( ! defined( 'ABSPATH' ) ) {
	return;
}
/**
 * Chosen header from option
 */
if ( ! function_exists( 'cct_header' ) ) {
	function cct_header() {
		$header_layout = cct_get_option( 'header_layout', 'header-1' );

		if ( is_page() ) {
			global $post;

			$page_meta     = get_post_meta( $post->ID, '_page_options', true );
			$header_layout = ( cct_get_value_in_array( $page_meta, 'header_page_setting' ) == 'custom' ) ? $page_meta['header_layout'] : $header_layout;
		}

		get_template_part( 'components/header/' . $header_layout );

//		echo cct_mobile_menu();
	}
}

/**
 * Generate header params
 */
if ( ! function_exists( 'cct_header_general_params' ) ) {
	function cct_header_general_params() {
		$header_fullwidth   = (boolean)cct_get_option( 'header_fullwidth', false );
		$header_transparent = (boolean)cct_get_option( 'header_transparent', false );
		$header_sticky      = (boolean)cct_get_option( 'header_sticky', false );
		if ( is_page() ) {
			global $post;

			$page_meta          = get_post_meta( $post->ID, '_page_options', true );
			$header_fullwidth   = ( cct_get_value_in_array( $page_meta, 'header_page_setting' ) == 'custom' ) ? $page_meta['header_fullwidth'] : $header_fullwidth;
			$header_transparent = ( cct_get_value_in_array( $page_meta, 'header_page_setting' ) == 'custom' ) ? $page_meta['header_transparent'] : $header_transparent;
			$header_sticky      = ( cct_get_value_in_array( $page_meta, 'header_page_setting' ) == 'custom' ) ? $page_meta['header_sticky'] : $header_sticky;
		}

		$params = array(
			'is_fullwidth'   => $header_fullwidth,
			'is_transparent' => $header_transparent,
			'is_sticky'      => $header_sticky
		);

		return $params;
	}
}

/**
 * General header class
 */
if ( ! function_exists( 'cct_header_generate_class' ) ) {
	function cct_header_generate_class( $custom_class ) {
		$general_options = cct_header_general_params();
		$header_class    = array(
			'cct-header',
			'header-sticky',
			$general_options['is_transparent'] ? 'header-transparent' : '',
			$general_options['is_sticky'] ? 'header-sticky' : '',
			$custom_class
		);

		$inner_class = $general_options['is_fullwidth'] ? 'container-fluid' : 'container';

		return array(
			'wrap'  => implode( ' ', $header_class ),
			'inner' => $inner_class
		);
	}
}

/**
 * Render site logo.
 */
if ( ! function_exists( 'cct_logo' ) ) {
	function cct_logo() {
		$home_url    = esc_url( home_url( '/' ) );
		$html        = array();
		$logo        = cct_get_option( 'logo' ) ? cct_get_option( 'logo' ) : array( 'url' => '' );
		$alt         = esc_attr( get_bloginfo( 'name' ) );


		$html[] = '<div id="cct-site-logo" class="cct-site-logo">';

		if ( $logo['url'] ) {
			$html[] = '<a href="' . esc_url( $home_url ) . '">';
			$html[] = $logo ? '<img class="cct-logo" src="' . esc_url( $logo['url'] ) . '" alt="' . $alt . '"/>' : '';
			$html[] = '</a>';
		} else {
			$html[] = '<h1 class="site-name"><a href="' . esc_url( $home_url ) . '">' . $alt . '</a></h1>';
		}

		$html[] = '</div>';

		return implode( "\n", $html );
	}
}

/**
 * Render main navigation menu.
 */
if ( ! function_exists( 'cct_header_main_menu' ) ) {
	function cct_header_main_menu() {
		$html = array();

		$html[] = '<nav id="cct-site-nav" class="cct-site-nav">';

		ob_start();

		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_class'     => 'main-nav d-flex',
				'container'      => '',
				'link_before'    => '<span class="cct-link-inner">',
				'link_after'     => '</span>',
			) );
		}

		$html[] = ob_get_clean();

		$html[] = '</nav>';

		return implode( "\n", $html );
	}
}

/**
 * Generate header mobile menu
 */
if ( ! function_exists( 'cct_mobile_menu' ) ) {
	function cct_mobile_menu() {
		$html   = array();
		$html[] = '<div id="cct-navigation-mobile">';

		ob_start();

		if ( has_nav_menu( 'mobile' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'mobile',
			) );
		} else {
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'mobile'         => true,
			) );
		}

		$html[] = ob_get_clean();

		$html[] = '</div>';

		return implode( "\n", $html );

	}
}

/**
 * Generate header mobile icon.
 */
//== [ Render action menu mobile ]
if ( ! function_exists( 'cct_header_menu_mobile_actions' ) ) {
	function cct_header_menu_mobile_actions( $custom ) {
		$html = array();

		if ( has_nav_menu( 'mobile-menu' ) ) {
			$html[] = '<div class="hamburger-menu-mobile ' . $custom . '">';
			$html[] = '<a class="d-flex" href="#menu-mobile"><svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg"><line y1="14.5" x2="20" y2="14.5" stroke="black"></line><line y1="7.5" x2="20" y2="7.5" stroke="black"></line><line y1="0.5" x2="20" y2="0.5" stroke="black"></line></svg></a>';
			$html[] = '</div>';
		}

		return implode( "\n", $html );
	}
}

/**
 * Render icon search.
 */
if ( ! function_exists( 'cct_header_icon_search' ) ) {
	function cct_header_icon_search() {
		$html = array();

		if ( ! cct_get_option( 'search-check' ) ) {
			return;
		}

		$html[] = '<div class="cct-h-search">';
		$html[] = '<div class="search-icon-action hide-min-lg">';
		$html[] = '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.49996 2.75C8.16495 2.75 6.85991 3.14588 5.74989 3.88757C4.63986 4.62927 3.7747 5.68347 3.26381 6.91686C2.75292 8.15026 2.61925 9.50745 2.8797 10.8168C3.14015 12.1262 3.78302 13.3289 4.72702 14.2729C5.67102 15.2169 6.87375 15.8598 8.18311 16.1202C9.49248 16.3807 10.8497 16.247 12.0831 15.7361C13.3165 15.2252 14.3707 14.3601 15.1124 13.25C15.854 12.14 16.2499 10.835 16.2499 9.49996C16.2498 7.70979 15.5386 5.99298 14.2728 4.72714C13.0069 3.46131 11.2901 2.75011 9.49996 2.75V2.75Z" stroke="#303030" stroke-width="2" stroke-miterlimit="10"/><path d="M14.5356 14.5361L19.2497 19.2502" stroke="#303030" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/></svg>';
		$html[] = '</div>';

//		$html[] = '<div class="site-nav-canvas">';
//		$html[] = '<div class="site-search-container">';
//		$html[] = '<div class="search-box wpo-wrapper-search">';
//
//		$html[] = '<form method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">';
//		$html[] = '<div class="form-content">';
//		$html[] = '<input type="search" placeholder="' . esc_html__( 'Search...', 'cct' ) . '" name="s" />';
//		$html[] = '<div class="btnSearch d-lg-none d-lg-inline-block">';
//		$html[] = '<svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.3457 5.49982C11.3457 8.26112 9.10717 10.4996 6.34572 10.4996C3.58427 10.4996 1.3457 8.26112 1.3457 5.49982C1.3457 2.73851 3.58427 0.5 6.34572 0.5C9.10717 0.5 11.3457 2.73851 11.3457 5.49982Z" stroke="#2D2D2D"></path><line y1="-0.5" x2="4.94967" y2="-0.5" transform="matrix(0.70712 0.707094 -0.70712 0.707094 9.3457 9.50012)" stroke="#2D2D2D" stroke-linejoin="round"></line></svg>';
//		$html[] = '</div>';
//		$html[] = '<div class="close-button"><img src="' . get_template_directory_uri() . '/images/frontend/search-close.png" alt=""></div>';
//		$html[] = '</div>';
//		$html[] = '</form>';
//
//		$html[] = '</div>';
//		$html[] = '</div>';
//		$html[] = '</div>';
        $html[] = '</div>'; //== [ End cct2 search ]

		return implode( "\n", $html );
	}
}

/**
 * Render icon cart.
 */
if ( ! function_exists( 'cct_header_icon_cart' ) ) {
	function cct_header_icon_cart( $type = 'icon', $icon = false, $image = false ) {
		if ( ! class_exists( 'WooCommerce' ) || ! cct_get_option( 'cart-check' ) ) {
			return;
		}

		$count = WC()->cart->cart_contents_count;

		ob_start();
		woocommerce_mini_cart();
		$mini_cart = ob_get_clean();

		$html = array();

		$html[] = '<div class="cct-icon-cart">';
		//$html[] = '<a class="cct-btn-cart" href="' . esc_url( wc_get_cart_url() ) . '">';
        $html[] = '<a href="#">';
		$html[] = '<i class="fal fa-shopping-cart"></i>';
    	$html[] = '<span class="nm"><span clas="cart-count">' . $count . ' Item</span></span>';
//		$html[] = '</a>';
////
//		//$html[] = '<div class="cct-cart-content">' . $mini_cart . '</div>';
//        $html[] = '<a>';
        $html[] = '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.5575 5.87988L9 9.31488L12.4425 5.87988L13.5 6.93738L9 11.4374L4.5 6.93738L5.5575 5.87988Z" fill="white"/></svg>';
        $html[] = '</a>';
        $html[] = '</div>';

		return implode( "\n", $html );
	}
}

/**
 * Render button list
 */
if ( ! function_exists( 'cct_header_button_actions' ) ) {
	function cct_header_button_actions() {
		$html = array();

		$html[] = '<div class="cct-header-btn">';

		$html[] = cct_header_icon_search( 'svg' );

		$html[] = cct_header_account();

		$html[] = cct_header_icon_cart( 'svg' );

		$html[] = cct_header_menu_mobile_actions( 'd-none d-md-inline-flex d-lg-none' );

		$html[] = '</div>';

		return implode( "\n", $html );
	}
}

//== [ Render Header account ]
if ( ! function_exists( 'cct_header_account' ) ) {
	function cct_header_account() {
        if ( ! cct_get_option( 'user-check' ) ) {
            return;
        }
		$user_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : '#';
		$html     = array();

		$html[] = '<div class="account-handle">';
		$html[] = '<a href="' . $user_url . '">';
		$html[] = '<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 4.375C10.6265 4.375 7.875 7.12646 7.875 10.5C7.875 12.6089 8.95166 14.4819 10.582 15.5859C7.46143 16.9258 5.25 20.0225 5.25 23.625H7C7 19.749 10.124 16.625 14 16.625C17.876 16.625 21 19.749 21 23.625H22.75C22.75 20.0225 20.5386 16.9258 17.418 15.5859C19.0483 14.4819 20.125 12.6089 20.125 10.5C20.125 7.12646 17.3735 4.375 14 4.375ZM14 6.125C16.4268 6.125 18.375 8.07324 18.375 10.5C18.375 12.9268 16.4268 14.875 14 14.875C11.5732 14.875 9.625 12.9268 9.625 10.5C9.625 8.07324 11.5732 6.125 14 6.125Z" fill="#303030"/></svg>';
		$html[] = '</a>';
		$html[] = '</div>';

		return implode( "\n", $html );
	}
}

//hero
if (! function_exists('cct_header_hero')){
    function cct_header_hero(){
        $html   = array();
        global $post;

        $html[] = '<div class="hero" style="background:'.  cct_get_option('background-color').'">';
        $html[] = '<div class=" container hero-inner ">';
        $html[] = '<h2> ';
        $html[] = '<a href="' . esc_url(get_the_permalink($post->ID)) . '">';
        $html[] =   get_the_title($post->ID);
        $html[] =  '</a>';
        $html[] = '</h2>';
        $html[] = '<div class="li-breadcrumbs">';
        $html[] =   cct_breadcrumb();
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '</div>';


        return implode( "\n", $html );
    }
}
