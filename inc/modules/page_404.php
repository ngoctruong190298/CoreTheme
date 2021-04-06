<?php
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

if ( ! function_exists( 'cct_page_404_content' ) ) {
	function cct_page_404_content( $slug = '_en' ) {
		$html = array();

		$banner      = cct_get_option( 'banner_404' );
		$option_404  = cct_get_option( '404_oc_option' );
		$title       = cct_get_value_in_array( $option_404, 'title_404' . $slug );
		$desc        = cct_get_value_in_array( $option_404, 'content_404' . $slug );
		$checkBanner = $banner['url'] != '' ? ' has-banner' : '';

		if ( $title || $desc ) {
			$html[] = '<div class="cct-404-content' . $checkBanner . '">';
			$html[] = '<h1 class="title">' . $title . '</h1>';
			$html[] = '<div class="icon"><img src="' . get_template_directory_uri() . '/images/frontend/404-error.jpg" alt="Error"></div>';
			$html[] = '<div class="desc">' . $desc . '</div>';
			$html[] = '</div>';
		}

		return implode( '', $html );
	}
}
