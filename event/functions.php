<?php
/**
 * _s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

/**
*THEME_URI = lay duong dan thu muc theme.
*/
define( 'THEME_URI', get_template_directory_uri() . '/' );
define( 'THEME_DIR', get_template_directory() . '/' );

// Chi duong dan do_action den Template hooks.
require_once THEME_DIR . 'inc/widgets/class-widget-recent-post-thumbnail.php';


if ( ! function_exists( '_s_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _s_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change '_s' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( '_s', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', '_s' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );


        // Add Widget Autos_Recent_Post_Thumnbail for user.
        function wpb_load_widget() {
            register_widget( 'Autos_Recent_Post_Thumnbail' );
        }
        add_action( 'widgets_init', 'wpb_load_widget' );      
        

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _s_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 640 );
}
add_action( 'after_setup_theme', '_s_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _s_widgets_init() {
	register_sidebar( 
        array(
    		'name'          => esc_html__( 'Sidebar', '_s' ),
    		'id'            => 'sidebar-1',
    		'description'   => esc_html__( 'Add widgets here.', '_s' ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', '_s_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function _s_scripts() {
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );

	wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Footer style.
if ( ! function_exists( 'footer_style' ) ) {
    function footer_style() {
        $color    = get_option( 'footer_color' );
        $bg_color = get_option( 'footer_background' );

        $style = 'color: ' . $color . ';';
        $style .= 'background-color: ' . $bg_color;

        echo $style;
    }
}

// Footer End style.
if ( ! function_exists( 'footer_end_style' ) ) {
    function footer_end_style() {
        $color    = get_option( 'footer_end_color', '#000' );
        $bg_color = get_option( 'footer_end_background', '#f5f5f5' );

        $style = 'color: ' . $color . ';';
        $style .= 'background-color: ' . $bg_color;

        echo $style;
    }
}

// Rename title page single cho page blog.
if ( ! function_exists( 'event_title_blog' ) ) {
    function event_title_blog() {
        $title     = get_option( 'blog_title' );
        if ( is_singular( 'post' ) ) {
            $title = get_the_title();
        }
        ?>
        <div class="block">
            <h1 class="blog-title" style="<?php blog_title_style(); ?>">
                <?php echo wp_kses_post( $title ); ?>
            </h1>
        </div>
        <?php
    }
}

// Add description 
if ( ! function_exists( 'event_description_blog' ) ) {
    function event_description_blog() {
        $title     = get_option( 'description_blog' );
        if ( is_singular( 'post' ) ) {
            $title = get_the_title();
        }
        ?>
            <h2 class="blog-title" style="<?php blog_title_style(); ?>">
                <?php echo wp_kses_post( $title ); ?>
            </h2>
        <?php
    }
}

// Color Blog Title.
if ( ! function_exists( 'blog_title_style' ) ) {
    function blog_title_style() {
        $color    = get_option( 'blog_color', '#000' );

        $style = 'color: ' . $color . ';';
        echo $style;
    }
}


// Replace image background Header.
if ( ! function_exists( 'event_page_header_background' ) ) {
    function event_page_header_background() {
        $bg_header = get_option( 'page_header_background' );
        $color     = get_option( 'background_header_image', '#303030' );
        $style     = 'background-color: ' . $color . ';';

        if ( false != $bg_header ) {
            $style .= 'background-image: url(' . $bg_header . ')';
        }

        echo $style;
    }
}

// Replace image background Footer.
if ( ! function_exists( 'event_page_footer_background' ) ) {
    function event_page_footer_background() {
        $bg_header = get_option( 'page_footer_background' );
        $color     = get_option( 'background_footer_image', '#303030' );
        $style     = 'background-color: ' . $color . ';';

        if ( false != $bg_header ) {
            $style .= 'background-image: url(' . $bg_header . ')';
        }

        echo $style;
    }
}