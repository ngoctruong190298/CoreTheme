<?php
if (!defined('ABSPATH')) {
	return;
}

/**
 * Primary widget
 */
register_sidebar(array(
	'id'			=> 'primary-bar',
	'name'			=> esc_html__('Primary Bar', 'cct'),
	'description'	=> esc_html__('Drag widgets for all of pages sidebar', 'cct'),
	'before_widget'	=> '<div class="cct-widget %2$s">',
	'after_widget'	=> '<div class="clear"></div></div>',
	'before_title'	=> '<div class="cct-widget-title"><h4>',
	'after_title'	=> '</h4></div>',
));

/**
 * Footer Widget
 */
		$num	= 3;
		register_sidebar(array(
			'id'			=> 'footer-' . $num,
			'name'			=> sprintf(esc_html__('Footer Widgets %d', 'cct'), $num),
			'description'	=> esc_html__('Drag widgets for all of pages sidebar', 'cct'),
			'before_widget'	=> '<div class="cct-widget %2$s">',
			'after_widget'	=> '<div class="clear"></div></div>',
			'before_title'	=> '<div class="cct-widget-title"><h4>',
			'after_title'	=> '</h4></div>',
		));


if (class_exists('WooCommerce')) {
	/**
	 * Shop widget
	 */
	register_sidebar(array(
		'id' => 'shop-bar',
		'name' => esc_html__('Shop Bar', 'cct'),
		'description' => esc_html__('Drag widgets for all of pages sidebar', 'cct'),
		'before_widget' => '<div class="cct-widget %2$s">',
		'after_widget' => '<div class="clear"></div></div>',
		'before_title' => '<div class="cct-widget-title"><h4>',
		'after_title' => '</h4></div>',
	));

	/**
	 * Product widget
	 */
	register_sidebar(array(
		'id' => 'product-bar',
		'name' => esc_html__('Product Bar', 'cct'),
		'description' => esc_html__('Drag widgets for all of pages sidebar', 'cct'),
		'before_widget' => '<div class="cct-widget %2$s">',
		'after_widget' => '<div class="clear"></div></div>',
		'before_title' => '<div class="cct-widget-title"><h4>',
		'after_title' => '</h4></div>',
	));
}