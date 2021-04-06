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

		echo cct_mobile_menu();
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
				'menu_class'     => 'main-nav',
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

		if ( ! cct_get_option( 'header_enable_search' ) ) {
			return;
		}

		$html[] = '<div class="cct-h-search">';
		$html[] = '<div class="search-icon-action hide-min-lg">';
		$html[] = '<svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.3457 5.49982C11.3457 8.26112 9.10717 10.4996 6.34572 10.4996C3.58427 10.4996 1.3457 8.26112 1.3457 5.49982C1.3457 2.73851 3.58427 0.5 6.34572 0.5C9.10717 0.5 11.3457 2.73851 11.3457 5.49982Z" stroke="#2D2D2D"></path><line y1="-0.5" x2="4.94967" y2="-0.5" transform="matrix(0.70712 0.707094 -0.70712 0.707094 9.3457 9.50012)" stroke="#2D2D2D" stroke-linejoin="round"></line></svg>';
		$html[] = '</div>';
		$html[] = '<div class="site-nav-canvas">';
		$html[] = '<div class="site-search-container">';
		$html[] = '<div class="search-box wpo-wrapper-search">';

		$html[] = '<form method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">';
		$html[] = '<div class="form-content">';
		$html[] = '<input type="search" placeholder="' . esc_html__( 'Search...', 'cct' ) . '" name="s" />';
		$html[] = '<div class="btnSearch d-lg-none d-lg-inline-block">';
		$html[] = '<svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.3457 5.49982C11.3457 8.26112 9.10717 10.4996 6.34572 10.4996C3.58427 10.4996 1.3457 8.26112 1.3457 5.49982C1.3457 2.73851 3.58427 0.5 6.34572 0.5C9.10717 0.5 11.3457 2.73851 11.3457 5.49982Z" stroke="#2D2D2D"></path><line y1="-0.5" x2="4.94967" y2="-0.5" transform="matrix(0.70712 0.707094 -0.70712 0.707094 9.3457 9.50012)" stroke="#2D2D2D" stroke-linejoin="round"></line></svg>';
		$html[] = '</div>';
		$html[] = '<div class="close-button"><img src="' . get_template_directory_uri() . '/images/frontend/search-close.png" alt=""></div>';
		$html[] = '</div>';
		$html[] = '</form>';

		$html[] = '</div>';
		$html[] = '</div>';
		$html[] = '</div>';
		$html[] = '</div>'; //== [ End cct2 search ]

		return implode( "\n", $html );
	}
}

/**
 * Render icon cart.
 */
if ( ! function_exists( 'cct_header_icon_cart' ) ) {
	function cct_header_icon_cart( $type = 'icon', $icon = false, $image = false ) {
		if ( ! class_exists( 'WooCommerce' ) || ! cct_get_option( 'header_enable_cart' ) ) {
			return;
		}

		$count = WC()->cart->cart_contents_count;

		ob_start();
		woocommerce_mini_cart();
		$mini_cart = ob_get_clean();

		$html = array();

		$html[] = '<div class="cct-icon-cart">';
		$html[] = '<a class="cct-btn-cart" href="' . esc_url( wc_get_cart_url() ) . '">';

		$html[] = '<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 16H0V5H15V16ZM0.789474 15.1665H14.1228V5.84209H0.789474V15.1665Z" fill="#2D2D2D"></path><path d="M11.1586 7.25279H10.4849V3.78071C10.4849 2.08325 9.13752 0.694416 7.49074 0.694416C5.84395 0.694416 4.49658 2.08325 4.49658 3.78071V7.17563H3.74805V3.78071C3.74805 1.69746 5.39483 0 7.49074 0C9.58664 0 11.2334 1.69746 11.2334 3.78071V7.25279H11.1586Z" fill="#2D2D2D"></path><path d="M5.09591 6.48145H3V7.25302H5.09591V6.48145Z" fill="#2D2D2D"></path><path d="M11.8322 6.48145H9.73633V7.25302H11.8322V6.48145Z" fill="#2D2D2D"></path></svg>';

		$html[] = '<span class="nm"><span clas="cart-count">' . $count . '</span></span>';
		$html[] = '</a>';

		$html[] = '<div class="cct-cart-content">' . $mini_cart . '</div>';
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
		$user_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : '#';
		$html     = array();

		$html[] = '<div class="account-handle">';
		$html[] = '<a href="' . $user_url . '">';
		$html[] = '<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.99952 8C4.79727 8 2.98828 6.19608 2.98828 4C2.98828 1.80392 4.79727 0 6.99952 0C9.20176 0 11.0108 1.80392 11.0108 4C11.0108 6.19608 9.20176 8 6.99952 8ZM6.99952 1.01961C5.34783 1.01961 4.01075 2.35294 4.01075 4C4.01075 5.64706 5.34783 6.98039 6.99952 6.98039C8.6512 6.98039 9.98828 5.64706 9.98828 4C9.98828 2.35294 8.6512 1.01961 6.99952 1.01961Z" fill="#2D2D2D"></path><path d="M13.5281 15.9998H0.47191C0.157303 15.9998 0 15.7645 0 15.5292V12.0782C0 11.5292 0.235955 11.0586 0.707865 10.8233C4.48315 8.47036 9.59551 8.47036 13.3708 10.8233C13.764 11.0586 14.0787 11.6076 14.0787 12.0782V15.5292C14 15.7645 13.764 15.9998 13.5281 15.9998ZM1.02247 14.9802H13.0562V12.0782C13.0562 11.9213 12.9775 11.7645 12.8202 11.686C9.35955 9.5684 4.7191 9.5684 1.25843 11.686C1.10112 11.7645 1.02247 11.9213 1.02247 12.0782V14.9802Z" fill="#2D2D2D"></path></svg>';
		$html[] = '</a>';
		$html[] = '</div>';

		return implode( "\n", $html );
	}
}
