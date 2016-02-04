<?php
/**
 * default functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package default
 */

if ( ! function_exists( 'default_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function default_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on default, use a find and replace
     * to change 'default' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'default', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'default' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    /*
     * Enable support for Post Formats.
     * See https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'default_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );
}
endif; // default_setup
add_action( 'after_setup_theme', 'default_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function default_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'default_content_width', 640 );
}
add_action( 'after_setup_theme', 'default_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function default_scripts() {

    wp_enqueue_style( 'bootstrap-style', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',array(),true);
    wp_enqueue_style( 'default-style', get_stylesheet_uri() );
    wp_enqueue_style( 'bootstrap-style', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css',array(),true);

    wp_enqueue_script( 'jquery-fun', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',array(),true);
    wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js',array(),true);
    wp_enqueue_script( 'jquery-scroll-to-plugin', get_template_directory_uri() . '/js/ScrollToPlugin.min_.js',array(),true);
    wp_enqueue_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',array(),true);
    wp_enqueue_script( 'script-theme', get_template_directory_uri() . '/js/script.js',array(),true);
    wp_enqueue_script( 'jquery-slicknav', get_template_directory_uri() . '/js/jquery.slicknav.js',array(),true);

    wp_enqueue_script( 'default-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js',array(),true);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'get_footer', 'default_scripts' );

/**
 * Remove todos os scripts do head e lança no footer
 */
function footer_enqueue_scripts() {
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    remove_action('wp_head', 'wp_print_styles', -1);

    add_action('wp_footer', 'wp_print_styles', 15);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action('after_setup_theme', 'footer_enqueue_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom post types for this theme.
 */
require get_template_directory() . '/inc/custom-posts.php';

/**
 * Custom post types taxonomies for this theme.
 */
require get_template_directory() . '/inc/custom-taxonomies.php';

/**
 * Widgets resgistered for this theme.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
