<?php
/**
 * Starterpack functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Starterpack
 */

if ( ! function_exists( 'starterpack_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function starterpack_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Starterpack, use a find and replace
	 * to change 'starterpack' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'starterpack', get_template_directory() . '/languages' );

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
	add_image_size( 'starterpack-full-bleed', 2000, 1200, true );
    add_image_size( 'starterpack-index-img', 800, 450, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Header', 'starterpack' ),
		'social' => esc_html__( 'Social Media Menu', 'starterpack' ),
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
	add_theme_support( 'custom-background', apply_filters( 'starterpack_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

    // Add theme support for custom logo
    add_theme_support( 'custom-logo', array(
        'width' => 90,
        'height' => 90,
        'flex-width' => true,
    ));

    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}
endif;

add_action( 'after_setup_theme', 'starterpack_setup' );

/**
 * Register custom fonts.
 */
function starterpack_fonts_url() {
    $fonts_url = '';

    /**
     * Translators: If there are characters in your language that are not
     * supported by Source Sans Pro and PT Serif, translate this to 'off'. Do not translate
     * into your own language.
     */
    $fira_sans = _x( 'on', 'Fira Sans Pro font: on or off', 'starterpack' );

    $crimson_text = _x( 'on', 'Crimson Text font: on or off', 'starterpack' );

    $font_families = array();

    if ( 'off' !== $fira_sans ) {
        $font_families[] = 'Fira Sans:400,700';
    }

    if ( 'off' !== $crimson_text ) {
        $font_families[] = 'Crimson Text:400,700';
    }

    if ( in_array( 'on', array( $fira_sans, $crimson_text ) ) ) {

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function starterpack_resource_hints( $urls, $relation_type ) {
    if ( wp_style_is( 'starterpack-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter( 'wp_resource_hints', 'starterpack_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function starterpack_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'starterpack_content_width', 640 );
}
add_action( 'after_setup_theme', 'starterpack_content_width', 0 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function starterpack_content_image_sizes_attr( $sizes, $size ) {
    $width = $size[0];

    if ( 900 <= $width ) {
        $sizes = '(min-width: 900px) 700px, 900px';
    }

    if ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) ) {
        $sizes = '(min-width: 900px) 600px, 900px';
    }

    return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'starterpack_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function starterpack_header_image_tag( $html, $header, $attr ) {
    if ( isset( $attr['sizes'] ) ) {
        $html = str_replace( $attr['sizes'], '100vw', $html );
    }
    return $html;
}
add_filter( 'get_header_image_tag', 'starterpack_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function starterpack_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {

    if ( !is_singular() ) {
        if ( is_active_sidebar( 'sidebar-1' ) ) {
            $attr['sizes'] = '(max-width: 900px) 90vw, 800px';
        } else {
            $attr['sizes'] = '(max-width: 1000px) 90vw, 1000px';
        }
    } else {
        $attr['sizes'] = '100vw';
    }

    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'starterpack_post_thumbnail_sizes_attr', 10, 3 );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function starterpack_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'starterpack' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'starterpack' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widgets', 'starterpack' ),
        'id'            => 'sidebar-2',
        'description'   => esc_html__( 'Add footer widgets here.', 'starterpack' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Page Widgets', 'starterpack' ),
        'id'            => 'sidebar-3',
        'description'   => esc_html__( 'Add page widgets here.', 'starterpack' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'starterpack_widgets_init' );

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function my_header_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->cart_contents_count;
    ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php
    if ( $count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
        <?php            
    }
        ?></a><?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );


/**
 * Enqueue scripts and styles.
 */
function starterpack_scripts() {
    // Enque google fonts: 
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700' );

	wp_enqueue_style( 'starterpack-style', get_stylesheet_uri() );

	// Full bleed images
    wp_enqueue_script( 'starterpack-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20170516', true );

	wp_enqueue_script( 'starterpack-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );
    wp_localize_script( 'starterpack-navigation', 'starterpackScreenReaderText', array(
        'expand' => __( 'Expand child menu', 'starterpack' ),
        'collapse' => __( 'Collapse child menu', 'starterpack' ),
    ) );

    wp_enqueue_script( 'starterpack-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    wp_enqueue_script( 'scrollnav', get_template_directory_uri() . '/js/scrollnav.js', array(), '20151215', true );

    wp_enqueue_style( 'fa-icons', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'starterpack_scripts' );


function custom_upload_mimes( $existing_mimes = array() ) {
	// add svg to the list of mime types
	$existing_mimes['svg'] = 'image/svg';

	// return the array back to the function with our added mime type
	return $existing_mimes;
}
add_filter( 'upload_mimes', 'custom_upload_mimes' );

remove_filter('the_content', 'wpautop');

//* TN - Remove Query String from Static Resources
function remove_css_js_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
    $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_css_js_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_css_js_ver', 10, 2 ); 

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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Load WooCommerce compatibility file. 
*/ 
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load SVG compatability
 */
require get_template_directory() . '/inc/icon-functions.php';

/* 
** Woocommere Hooks and Filters
*/
function remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'remove_wc_breadcrumbs' );

/**
 * custom_woocommerce_template_loop_add_to_cart
*/
function custom_woocommerce_product_add_to_cart_text() {
	global $product;
	
	$product_type = $product->product_type;
	
	switch ( $product_type ) {
		case 'external':
			return __( 'Buy product', 'woocommerce' );
		break;
		case 'grouped':
			return __( 'View products', 'woocommerce' );
		break;
		case 'simple':
			return __( 'Add to cart', 'woocommerce' );
		break;
		case 'variable':
			return __( 'Choose a size', 'woocommerce' );
		break;
		default:
			return __( 'Shop', 'woocommerce' );
	}
	
}
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );

/* Remove product meta */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

//+/- finctionality add to cart
function kia_add_script_to_footer(){
    if( ! is_admin() ) { ?>
    <script>
    jQuery(document).ready(function($){
    $('.quantity').on('click', '.plus', function(e) {
        $input = $(this).prev('input.qty');
        var val = parseInt($input.val());
        var step = $input.attr('step');
        step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
        $input.val( val + step ).change();
    });
    $('.quantity').on('click', '.minus', 
        function(e) {
        $input = $(this).next('input.qty');
        var val = parseInt($input.val());
        var step = $input.attr('step');
        step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
        if (val > 0) {
            $input.val( val - step ).change();
        } 
    });
});
</script>
<?php }
}
add_action( 'wp_footer', 'kia_add_script_to_footer' );
