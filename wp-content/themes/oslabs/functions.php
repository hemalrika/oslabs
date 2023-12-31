<?php

/**
 * oslabs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package oslabs
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

function oslabs_setup()
{
	load_theme_textdomain('oslabs', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('editor-styles');
	add_theme_support("wp-block-styles");
	add_theme_support("responsive-embeds");
	add_theme_support("align-wide");
	add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array('site-title', 'site-description'),
		'unlink-homepage-logo' => true,
	);
	$args = array(
		'default-text-color' => '000',
		'width'              => 1000,
		'height'             => 250,
		'flex-width'         => true,
		'flex-height'        => true,
	);
	add_theme_support('custom-header', $args);
	add_theme_support('custom-background');
	add_theme_support('custom-logo', $defaults);
	if (function_exists('register_block_style')) {
		register_block_style(
			'core/quote',
			array(
				'name'         => 'blue-quote',
				'label'        => __('Blue Quote', 'oslabs'),
				'is_default'   => true,
				'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
			)
		);
	}
	register_block_pattern(
		'oslabs-pattern',
		array(
			'title'       => __('Oslabs Pattern', 'oslabs'),
			'description' => __('Oslabs Pattern', 'oslabs'),
			'content'     => __('Oslabs Pattern Content', 'oslabs')
		)
	);
	register_nav_menus(
		array(
			'main-menu' => esc_html__('Main Menu', 'oslabs'),
			'copyright_menu' => esc_html__('Copyright Menu', 'oslabs'),
		),
	);
	register_nav_menus(
		array(
			'footer-menu' => esc_html__('Footer Menu', 'oslabs'),
		),
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support(
		'custom-background',
		apply_filters(
			'oslabs_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);
	add_theme_support('post-formats', [
		'image',
		'audio',
		'video',
		'gallery',
		'quote',
	]);
	add_theme_support('customize-selective-refresh-widgets');
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 30,
			'width'       => 130,
			'flex-width'  => true,
			'flex-height' => true,
			'unlink-homepage-logo' => true,
		)
	);
}
add_action('after_setup_theme', 'oslabs_setup');

function oslabs_content_width()
{
	$GLOBALS['content_width'] = apply_filters('oslabs_content_width', 640);
}
add_action('after_setup_theme', 'oslabs_content_width', 0);

/*
 * Register widget area.
 */
function oslabs_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Blog Sidebar', 'oslabs'),
			'id'            => 'blog-sidebar',
			'description'   => esc_html__('Add Blog Sidebar.', 'oslabs'),
			'before_widget' => '<section id="%1$s" class="oslabs-blog-sidebar cb-toolkit-blog-sidebar mb-40 %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="oslabs-sidebar-title">',
			'after_title'   => '</h5>',
		)
	);
	// footer default
	for ($num = 1; $num <= 4; $num++) {
		$widget_class = '';
		$parent_class = '';
		switch ($num) {
			case 1:
				$widget_class = 'has-oslabs-rv-space-right-first';
				break;
			case 2:
				$parent_class = 'pl-30 oslabs-rv-footer-space-left-30';
				break;
			case 3:
				$parent_class = 'pl-30 oslabs-rv-footer-space-left-30';
			case 4:
				$parent_class = 'custom-fott-cls';
		}
		register_sidebar([
			'name'          => sprintf(esc_html__('Footer %1$s', 'oslabs'), $num),
			'id'            => 'footer-' . $num,
			'description'   => sprintf(esc_html__('Footer %1$s', 'oslabs'), $num),
			'before_widget' => '<div class="' . esc_attr($parent_class) . '"><div id="%1$s" class="oslabs-rv-footer-widget mb-40 footer-col-' . esc_attr($num) . ' ' . esc_attr($widget_class) . ' %2$s ">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h6 class="oslabs-rv-footer-widget-title">',
			'after_title'   => '</h6>',
		]);
	}
	// footer 2
	for ($num = 1; $num <= 5; $num++) {
		register_sidebar([
			'name'          => sprintf(esc_html__('Footer 2:%1$s', 'oslabs'), $num),
			'id'            => 'footer2-' . $num,
			'description'   => sprintf(esc_html__('Footer 2:%1$s', 'oslabs'), $num),
			'before_widget' => '<div id="%1$s" class="oslabs-fz-footer-widget-2 footer-col-' . esc_attr($num) . ' %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="oslabs-fz-footer-widget-title-2 mb-35">',
			'after_title'   => '</h5>',
		]);
	}
	// footer 3
	for ($num = 1; $num <= 5; $num++) {
		$parent_class = '';
		switch ($num) {
			case 1:
				$parent_class = 'pr-40 mb-40';
				break;
			case 2:
				$parent_class = 'pl-40 mb-40 oslabs-fz-footer-widget-3-link-list';
				break;
			case 3:
				$parent_class = 'pl-20 mb-40 oslabs-fz-footer-widget-3-link-list';
				break;
			case 4:
				$parent_class = 'mb-40 oslabs-fz-footer-widget-3-link-list';
				break;
			case 5:
				$parent_class = 'mb-40';
				break;
		}
		register_sidebar([
			'name'          => sprintf(esc_html__('Footer 3:%1$s', 'oslabs'), $num),
			'id'            => 'footer3-' . $num,
			'description'   => sprintf(esc_html__('Footer %1$s', 'oslabs'), $num),
			'before_widget' => '<div id="%1$s" class="oslabs-fz-footer-widget-3 ' . esc_attr($parent_class) . ' footer-col-' . esc_attr($num) . ' %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="oslabs-fz-footer-widget-3-title mb-30">',
			'after_title'   => '</h4>',
		]);
	}
	// footer 4
	for ($num = 1; $num <= 5; $num++) {
		$parent_class = '';
		switch ($num) {
			case 1:
				$parent_class = ' pr-70';
				break;
			case 2:
				$parent_class = 'pl-25';
				break;
			case 3:
				$parent_class = ' pl-25';
				break;
			case 4:
				$parent_class = 'pl-30';
				break;
			case 5:
				$parent_class = 'pl-30';
				break;
		}
		register_sidebar([
			'name'          => sprintf(esc_html__('Footer 4:%1$s', 'oslabs'), $num),
			'id'            => 'footer4-' . $num,
			'description'   => sprintf(esc_html__('Footer %1$s', 'oslabs'), $num),
			'before_widget' => '<div id="%1$s" class="oslabs-fz-footer-widget-4 ' . esc_attr($parent_class) . ' footer-col-' . esc_attr($num) . ' %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="oslabs-fz-footer-widget-title-4">',
			'after_title'   => '</h5>',
		]);
	}
	// footer 5
	for ($num = 1; $num <= 4; $num++) {
		$parent_class = '';
		switch ($num) {
			case 1:
				$parent_class = '';
				break;
			case 2:
				$parent_class = 'ml-90 oslabs-fz-footer5-list';
				break;
			case 3:
				$parent_class = 'ml-80 oslabs-fz-footer5-list';
				break;
			case 4:
				$parent_class = 'ml-90';
				break;
		}
		register_sidebar([
			'name'          => sprintf(esc_html__('Footer 5:%1$s', 'oslabs'), $num),
			'id'            => 'footer5-' . $num,
			'description'   => sprintf(esc_html__('Footer %1$s', 'oslabs'), $num),
			'before_widget' => '<div id="%1$s" class="oslabs-fz-footer5-widget mb-50 ' . esc_attr($parent_class) . ' footer-col-' . esc_attr($num) . ' %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="oslabs-fz-footer5-title">',
			'after_title'   => '</h4>',
		]);
	}
	// footer 6
	for ($num = 1; $num <= 4; $num++) {
		register_sidebar([
			'name'          => sprintf(esc_html__('Footer 6:%1$s', 'oslabs'), $num),
			'id'            => 'footer6-' . $num,
			'description'   => sprintf(esc_html__('Footer %1$s', 'oslabs'), $num),
			'before_widget' => '<div id="%1$s" class="oslabs-fz-footer-widget widget-' . esc_attr($num) . ' %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="oslabs-fz-footer-section-title-6">',
			'after_title'   => '</h4>',
		]);
	}
}
add_action('widgets_init', 'oslabs_widgets_init');



define('OSLABS_THEME_DIR', get_template_directory());
define('OSLABS_THEME_URI', get_template_directory_uri());
define('OSLABS_THEME_CSS_DIR', OSLABS_THEME_URI . '/assets/css/');
define('OSLABS_THEME_JS_DIR', OSLABS_THEME_URI . '/assets/js/');
define('OSLABS_THEME_INC', OSLABS_THEME_DIR . '/inc/');
define('OSLABS_THEME_HOOK', OSLABS_THEME_INC . 'hooks/');
define('OSLABS_THEME_CLASS', OSLABS_THEME_INC . 'classes/');

/*
 * Enqueue Admin scripts and styles.
 */
function oslabs_admin_custom_scripts()
{
	wp_enqueue_media();
	wp_enqueue_style('customizer-style', get_template_directory_uri() . '/inc/style/css/customizer-style.css', array());
	wp_register_script('oslabs-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', ['jquery'], '', true);
	wp_enqueue_script('oslabs-admin-custom');
}
add_action('admin_enqueue_scripts', 'oslabs_admin_custom_scripts');
/**
 * Registers an editor stylesheet for the theme.
 */
function OSLABS_theme_add_editor_styles()
{
	add_editor_style('assets/css/custom-editor-style.css');
}
add_action('admin_init', 'OSLABS_theme_add_editor_styles');

/*
 * Enqueue Theme scripts and styles.
 */

function oslabs_scripts()
{

	// all CSS
	wp_enqueue_style('oslabs-fonts', oslabs_fonts_url(), array(), '1.0.0');
	wp_enqueue_style('bootstrap', OSLABS_THEME_CSS_DIR . 'bootstrap.min.css');
	wp_enqueue_style('fontawesome-all', OSLABS_THEME_CSS_DIR . 'fontawesome-all.min.css');
	wp_enqueue_style('nice-select', OSLABS_THEME_CSS_DIR . 'nice-select.css');
	wp_enqueue_style('meanmenu', OSLABS_THEME_CSS_DIR . 'meanmenu.css');
	wp_enqueue_style('swipper', OSLABS_THEME_CSS_DIR . 'swipper.css');
	wp_enqueue_style('oslabs-core', OSLABS_THEME_CSS_DIR . 'oslabs-core.css', null, time());
	wp_enqueue_style('oslabs-custom', OSLABS_THEME_CSS_DIR . 'oslabs-custom.css', null, time());
	wp_enqueue_style('oslabs-unit', OSLABS_THEME_CSS_DIR . 'oslabs-unit.css', null, time());
	wp_enqueue_style('oslabs-style', get_stylesheet_uri());

	// all js
	wp_enqueue_script('bootstrap-bundle', OSLABS_THEME_JS_DIR . 'bootstrap.bundle.min.js', ['jquery'], '', true);
	wp_enqueue_script('swipper-bundle', OSLABS_THEME_JS_DIR . 'swipper-bundle.min.js', ['jquery'], '', true);
	wp_enqueue_script('meanmenu', OSLABS_THEME_JS_DIR . 'jquery.meanmenu.min.js', ['jquery'], '', true);
	wp_enqueue_script('jquery-nice-select', OSLABS_THEME_JS_DIR . 'jquery.nice-select.min.js', ['jquery'], '', true);
	wp_enqueue_script('scrollUp', OSLABS_THEME_JS_DIR . 'jquery.scrollUp.min.js', ['jquery'], '', true);
	wp_enqueue_script('oslabs-main', OSLABS_THEME_JS_DIR . 'main.js', ['jquery'], time(), true);
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'oslabs_scripts');
/*
Register Fonts
 */
function oslabs_fonts_url()
{
	$font_url = '';
	/*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
	if ('off' !== _x('on', 'Google font: on or off', 'oslabs')) {
		$font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@400;700&family=Roboto:wght@400;500;700&family=Kanit:wght@300;400;500;600;700;900&display=swap');
	}
	return $font_url;
}

require OSLABS_THEME_INC . 'template-helper.php';
require OSLABS_THEME_INC . 'custom-header.php';
require OSLABS_THEME_INC . 'template-tags.php';
require OSLABS_THEME_INC . 'template-functions.php';
include_once OSLABS_THEME_INC . '/style/php/customizer-style.php';
include_once OSLABS_THEME_INC . 'class-wp-bootstrap-navwalker.php';
require_once OSLABS_THEME_INC . 'class-tgm-plugin-activation.php';
require_once OSLABS_THEME_INC . 'classes/class-oslabs-comment.php';
if (defined('JETPACK__VERSION')) {
	require OSLABS_THEME_INC . 'jetpack.php';
}
if (class_exists('TGM_Plugin_Activation')) {
	require_once OSLABS_THEME_INC . 'add_plugin.php';
}
