<?php
if (!defined('ABSPATH')) {
	return;
}

/**
 * Theme Setup
 */
if (! function_exists('cct_action_add_theme_support')) {
	function cct_action_add_theme_support() {
		load_theme_textdomain('cct', get_template_directory() . '/languages');

		global $content_width;

		if (!isset($content_width)) {
			$content_width	= 1170;
		}

		add_theme_support('custom-header');
		add_theme_support('custom-background');

		add_theme_support('automatic-feed-links');
		add_theme_support("title-tag");
		add_theme_support('post-thumbnails');
		add_theme_support('editor_style');

		add_editor_style();

		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');

		remove_theme_support('custom-header');

		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		));

		add_theme_support('microformats2');
		add_theme_support('microformats');
		add_theme_support('microdata');
	}

	add_action('after_setup_theme', 'cct_action_add_theme_support');
}
if (! function_exists('theme_widgets_init')) {
    function theme_widgets_init()
    {
        register_sidebar(array(
            'name' => __('Footer Widget logo'),
            'id' => 'footer-logo',
            'description' => __('Insert logo'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ));
    }

    add_action('widgets_init', 'theme_widgets_init');

}
if (! function_exists('theme_widgets_init1')) {
    function theme_widgets_init1()
    {
        register_sidebar(array(
            'name' => __('Footer Widget text'),
            'id' => 'footer-logo-text',
            'description' => __('Insert logo text'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ));
    }

    add_action('widgets_init', 'theme_widgets_init1');
}
if (! function_exists('theme_widgets_init2')) {
    function theme_widgets_init2()
    {
        register_sidebar(array(
            'name' => __('Footer Widget Link'),
            'id' => 'footer-link',
            'description' => __('Insert title and link'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ));
    }

    add_action('widgets_init', 'theme_widgets_init2');

}
if (! function_exists('theme_widgets_init3')) {
    function theme_widgets_init3()
    {
        register_sidebar(array(
            'name' => __('Footer Widget Area Post'),
            'id' => 'footer-post',
            'description' => __('Appears in the post'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }

    add_action('widgets_init', 'theme_widgets_init3');
}