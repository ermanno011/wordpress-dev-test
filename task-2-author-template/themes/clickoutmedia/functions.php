<?php
// Theme setup
add_action('after_setup_theme', function() {
    // Disable support for Gutenberg block editor
    remove_theme_support('core-block-patterns');
    remove_theme_support('widgets-block-editor');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('title-tag'); // Optional: allows WordPress to manage <title>
});

// Remove Gutenberg editor completely
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

// Disable REST API and oEmbed-related stuff
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11);
remove_action('wp_head', 'wp_shortlink_wp_head', 10);

// Remove emoji scripts
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

// Remove embeds and related scripts
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_site_icon', 99);
remove_action('init', 'wp_embed_register_handler');
remove_filter('the_content', [$GLOBALS['wp_embed'], 'autoembed'], 8);

// Remove jQuery everywhere except on the front page
function remove_default_jquery() {
    if ( ! is_admin() && ! is_front_page() ) {
        // Don't remove from admin dashboard and homepage
        wp_deregister_script( 'jquery' );
        wp_deregister_script( 'jquery-core' );
        wp_deregister_script( 'jquery-migrate' );
    }
}
add_action( 'wp_enqueue_scripts', 'remove_default_jquery', 100 );

// Disable WordPress embeds script
add_action('init', function() {
    wp_deregister_script('wp-embed');
});

// Remove comments support
add_action('admin_init', function () {
    // Disable comments on all post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments from admin menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments metabox from dashboard
add_action('admin_init', function () {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
});

// Remove comment links from admin bar
add_action('admin_bar_menu', function($wp_admin_bar) {
    $wp_admin_bar->remove_node('comments');
}, 999);

// Disable self pingbacks
add_action('pre_ping', function(&$links) {
    $home = get_option('home');
    foreach ($links as $l => $link) {
        if (0 === strpos($link, $home)) {
            unset($links[$l]);
        }
    }
});

// Clean up unnecessary scripts and styles
add_action('wp_enqueue_scripts', function() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}, 100);

// Optional: Disable admin bar on front-end
add_filter('show_admin_bar', '__return_false');

// Register assets - .js and .css
function register_assets() {
  wp_enqueue_style( 'master', get_template_directory_uri() . '/assets/css/master.css', array(), filemtime(get_template_directory() . '/assets/css/master.css'), 'all' );
  wp_enqueue_style( 'header', get_template_directory_uri() . '/assets/css/header.css', array(), filemtime(get_template_directory() . '/assets/css/header.css'), 'all' );
  wp_enqueue_style( 'footer', get_template_directory_uri() . '/assets/css/footer.css', array(), filemtime(get_template_directory() . '/assets/css/footer.css'), 'all' );
  if ( is_author() ) {
      wp_enqueue_style( 'author', get_template_directory_uri() . '/assets/css/author.css', array(), filemtime(get_template_directory() . '/assets/css/author.css'), 'all');
  }
}
add_action('wp_enqueue_scripts', 'register_assets');

// Preload most used fonts
function com_preload_fonts() {
    ?>
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans/OpenSans-Light.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans/OpenSans-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans/OpenSans-Medium.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans/OpenSans-SemiBold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans/OpenSans-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <?php
}
add_action( 'wp_head', 'com_preload_fonts' );

// enable featured image in regular posts
add_theme_support( 'post-thumbnails' );

// define new thumbnail used on author pages
add_image_size('custom-thumb-177', 177, 9999, false);
add_image_size('custom-thumb-50', 50, 9999, false);

// create widget for clickonemedia theme
function clickonemedia_widget() {
    register_sidebar([
        'name'          => 'Homepage Widget Area',
        'id'            => 'homepage-widget-area',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'clickonemedia_widget');
