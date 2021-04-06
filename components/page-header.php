<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 10/8/2019
 * Time: 3:20 PM
 */

global $post;

$post_id	= isset($post) ? $post->ID : false;
$post_id	= is_home() ? get_option('page_for_posts') : $post_id;
//$post_id	= cct_is_woocommerce_page() ? wc_get_page_id('shop') : $post_id;

if (is_front_page()) {
	return;
}

$bg_type	= cct_get_option('page_header_background_type', 'image');
$paralalx	= cct_get_option('page_header_parallax');
$align		= cct_get_option('page_header_content_align', 'center');
$overlay	= cct_get_option('page_header_overlay_color');

$mp4		= cct_get_option('page_header_mp4');
$ogv		= cct_get_option('page_header_ogv');
$webm		= cct_get_option('page_header_webm');

if (is_page()) {
	$page_options 	= get_post_meta($post_id, '_page_options', true);
	$type			= cct_get_value_in_array($page_options, 'page_header_type');

	if ($type == 'custom') {
		$bg_type	= cct_get_value_in_array($page_options,'page_header_background_type', 'image');
		$paralalx	= cct_get_value_in_array($page_options,'page_header_parallax');
		$align		= cct_get_value_in_array($page_options,'page_header_content_align', 'center');
		$overlay	= cct_get_value_in_array($page_options,'page_header_overlay_color');

		$mp4		= cct_get_value_in_array($page_options,'page_header_mp4');
		$ogv		= cct_get_value_in_array($page_options,'page_header_ogv');
		$webm		= cct_get_value_in_array($page_options,'page_header_webm');
	} else if ($type == 'disable') {
		return;
	}
}

if (is_search()) {
	$page_title = esc_html__('Search: ', 'cct') . esc_attr($_GET['s']);
} else if (is_category()) {
	$page_title = esc_html__('Category Archives: ', 'cct') . single_cat_title('', false);
} else if (is_author()) {
	$page_title = esc_html__('Author Archives: ', 'cct') . get_the_author();
} else if (is_404()) {
	$page_title = esc_html__('Page not found: ', 'cct');
} else if (is_day()) {
	$page_title = esc_html__('Daily Archives: ', 'cct') . get_the_date();
} else if (is_month()) {
	$page_title = esc_html__('Monthly Archives: ', 'cct') . get_the_date('F Y');
} else if (is_year()) {
	$page_title = esc_html__('Yearly Archives: ', 'cct') . get_the_date('Y');
} else if (is_tag()) {
	$page_title = esc_html__('Tags Archives: ', 'cct') . single_tag_title('', false);
} else {
	$page_title = get_the_title($post_id);
}

if (class_exists('WooCommerce')) {
	if (is_shop()) {
		$page_title = esc_html__('Shop', 'cct');
	}
}

if ($paralalx) {
	wp_enqueue_script('simpleParallax');
	wp_enqueue_script('cct-parallax');

	$bg				= cct_get_option('page_header_background');
	$image			= cct_get_value_in_array($bg, 'background-image');
	$url			= cct_get_value_in_array($image, 'url');
}
?>

<div class="cct-page-header text-<?php echo esc_attr($align); ?>">
	<?php if ($paralalx) : ?>
		<div class="cct-bg-parallax">
			<img src="<?php echo esc_url($url); ?>" class="cct-img-parallax" data-orientation="up" data-scale="1.2" data-delay="0.6" data-transition="cubic-bezier(0,0,0,1)" />
		</div>
	<?php endif; ?>

	<?php if ($overlay) : ?>
		<div class="cct-section-overlay"></div>
	<?php endif; ?>

	<div class="cct-section-content">
		<div class="section-title">
			<div class="container">
				<h1>
					<span>
						<?php echo esc_attr($page_title); ?>
					</span>
				</h1>
			</div>
		</div>
		<div class="section-breadcrumb">
			<div class="container">
				<?php echo cct_breadcrumb(); ?>
			</div>
		</div>
	</div>

	<?php if ($bg_type == 'video' && ($mp4 || $ogv || $webm)) : ?>
		<div class="cct-section-video-wrapper">
			<div class="cct-video-wrapper">
				<video width="1920" height="1080" poster="" autoplay>
					<?php if ($mp4) : ?>
						<source type="video/mp4" src="<?php echo esc_url($mp4); ?>" />
					<?php endif; ?>

					<?php if ($ogv) : ?>
						<source type="video/ogv" src="<?php echo esc_url($ogv); ?>" />
					<?php endif; ?>

					<?php if ($webm) : ?>
						<source type="video/webm" src="<?php echo esc_url($webm); ?>" />
					<?php endif; ?>
				</video>
			</div>
		</div>
	<?php endif; ?>
</div>
