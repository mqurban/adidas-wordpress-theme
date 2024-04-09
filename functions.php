<?php

/**
 * figma-wordpress-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package figma-wordpress-theme
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function figma_wordpress_theme_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on figma-wordpress-theme, use a find and replace
		* to change 'figma-wordpress-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('figma-wordpress-theme', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');


	/**
	 * Register Custom Navigation Walker
	 */
	if (!file_exists(get_template_directory() . '/ustom_Walker_Nav_Menu.php')) {
		// File does not exist... return an error.
		return new WP_Error('class-wp-bootstrap-navwalker-missing', __('It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker'));
	} else {
		// File exists... require it.
		require_once get_template_directory() . '/ustom_Walker_Nav_Menu.php';
	}


	// This theme uses wp_nav_menu() in one location.


	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'figma_wordpress_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'figma_wordpress_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function figma_wordpress_theme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('figma_wordpress_theme_content_width', 640);
}
add_action('after_setup_theme', 'figma_wordpress_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function figma_wordpress_theme_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'figma-wordpress-theme'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'figma-wordpress-theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		),
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar 2', 'figma-wordpress-theme'),
			'id'            => 'sidebar-2',
			'description'   => esc_html__('Add widgets here.', 'figma-wordpress-theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		),
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar 3', 'figma-wordpress-theme'),
			'id'            => 'sidebar-3',
			'description'   => esc_html__('Add widgets here.', 'figma-wordpress-theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		),
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar 4', 'figma-wordpress-theme'),
			'id'            => 'sidebar-4',
			'description'   => esc_html__('Add widgets here.', 'figma-wordpress-theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		),
	);
}
add_action('widgets_init', 'figma_wordpress_theme_widgets_init');

define('IMAGES', get_template_directory() . '/assets/images/');

/**
 * Enqueue scripts and styles.
 */
function figma_wordpress_theme_scripts()
{
	wp_enqueue_style('figma-wordpress-theme-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('figma-wordpress-theme-style1', get_theme_file_uri('/assets/CSS/style.css'));
	wp_enqueue_script('figma-wordpress-theme-JS', get_theme_file_uri('/assets/JS/main.js'), Null, _S_VERSION, true);
	// slider js 
	wp_enqueue_script('figma-wordpress-theme-slider-JS', get_theme_file_uri('/assets/JS/slider.js'), Null, _S_VERSION, true);

	// bootstrap link
	wp_enqueue_style('bootstrap-link', get_theme_file_uri('/assets/CSS/bootstrap.min.css'));

	// Enqueue Bootstrap JavaScript
	wp_enqueue_script('bootstrap-js', get_theme_file_uri('/assets/JS/bootstrap.bundle.min.js'), array('jquery'), true);

	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', '6.0.0');
	// Enqueue Popper.js
	wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'figma_wordpress_theme_scripts');

add_action('admin_enqueue_scripts', 'enqueue_admin_scripts');
function enqueue_admin_scripts()
{
	// Enqueue media scripts
	wp_enqueue_media();
}

// Admin styling 
function admin_style()
{
	$current_page = isset($_GET['page']) ? $_GET['page'] : '';
	$current_post = get_post_type() == 'event';

	if ($current_page === 'theme-settings' || $current_post) {
		wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/CSS/admin-style.css');
		// bootstrap css admin
		wp_enqueue_style('bootstrap-link-admin', get_theme_file_uri('/assets/CSS/bootstrap.min.css'));
		// bootstrap js admin
		wp_enqueue_script('bootstrap-js-admin', get_theme_file_uri('/assets/JS/bootstrap.bundle.min.js'), array('jquery'), true);
		wp_enqueue_script('admin-figma-wordpress-theme-JS', get_theme_file_uri('/assets/JS/main_admin.js'), array('jquery'), _S_VERSION, true);
	}
}
add_action('admin_enqueue_scripts', 'admin_style');


function register_custom_menu()
{
	register_nav_menus(
		array(
			'primary' => esc_html__('Primary', 'figma-wordpress-theme'),
			'secondary' => esc_html__('Secondary', 'figma-wordpress-theme'),

		)
	);
}
add_action('after_setup_theme', 'register_custom_menu');


/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


require_once get_template_directory() . '/inc/theme-settings.php';
require_once get_template_directory() . '/inc/slider-post.php';
require_once get_template_directory() . '/inc/facebook-page.php';
require_once get_template_directory() . '/inc/twitter-page.php';
require_once get_template_directory() . '/inc/event-post.php';
require_once get_template_directory() . '/inc/weather-report.php';
require_once get_template_directory() . '/inc/displaydate.php';




// footer 
function wpbrigadetask_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Footer Menu 1', 'wpbrigadetask'),
			'id'            => 'footer-menu-1',
			'description'   => esc_html__('Add widgets here.', 'wpbrigadetask'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Footer Menu 2', 'wpbrigadetask'),
			'id'            => 'footer-menu-2',
			'description'   => esc_html__('Add widgets here.', 'wpbrigadetask'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Copyright Section', 'wpbrigadetask'),
			'id'            => 'copyright-section',
			'description'   => esc_html__('Add widgets here.', 'wpbrigadetask'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'wpbrigadetask_widgets_init');



// Shortcode with parameters
function wpbrigadetask_shortcodes($atts)
{
	$atts = shortcode_atts(
		array(
			'wpb-linkurl' => 'https://www.wpbrigade.com',
			'title' => 'Terms & Conditions',
			'pp-title' => 'Privacy Policy',
			'pp-linkurl' => '#',
			'designed-by' => 'Designed by',
			'designer-link' => 'https://www.wpbrigade.com'
		),
		$atts,
		'wpbrigadetask_shortcode'
	);
	return '<div class="copyright">Copyrights &copy' . date('Y') . ' All rights reserved. <br>
		<a href="' . $atts['wpb-linkurl'] . '">' . $atts['title'] . '</a>'
		. ' | <a href="' . $atts['pp-linkurl'] . '">' . $atts['pp-title'] . '</a><br>'
		. $atts['designed-by'] . ' : <a href="' . $atts['designer-link'] . '">WpBrigade</a>
	</div>';
}
add_shortcode('wpbrigadetask_shortcode', 'wpbrigadetask_shortcodes');
