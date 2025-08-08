<?php
/*
Plugin Name: Most Viewed Articles
Description: Displays most viewed posts in tabbed widget (This Week / This Month)
Version: 1.1
Author: Aleksandar Bjelica
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Most_Viewed_Articles {

    public function __construct() {
        // Hook to track views on single post pages
        add_action('wp_head', [$this, 'track_post_view']);

        // Register view tracking only on post pages
        add_action( 'init', [ $this, 'register_view_tracking' ] );

        // AJAX actions
        add_action( 'wp_ajax_nopriv_get_most_viewed_articles', [ $this, 'ajax_get_articles' ] );
        add_action( 'wp_ajax_get_most_viewed_articles', [ $this, 'ajax_get_articles' ] );

        // Register widget
        add_action( 'widgets_init', function() {
            register_widget( 'Most_Viewed_Widget' );
        });

        // Enqueue frontend scripts
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

        // Admin page
        add_action( 'admin_menu', [ $this, 'register_admin_page' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );
    }

    public function enqueue_scripts() {
        if ( ! is_admin() ) {
            wp_enqueue_script( 'mva-tabs', plugin_dir_url(__FILE__) . 'js/mva-tabs.js', ['jquery'], null, true );
            wp_localize_script( 'mva-tabs', 'mva_ajax', [ 'ajax_url' => admin_url( 'admin-ajax.php' ) ] );
            wp_enqueue_style( 'mva-style', plugin_dir_url(__FILE__) . 'css/mva-style.css' );
        }
    }

    public function enqueue_admin_assets( $hook ) {
        if ( $hook === 'toplevel_page_most-viewed-articles' ) {
            wp_enqueue_script( 'mva-tabs', plugin_dir_url(__FILE__) . 'js/mva-tabs.js', ['jquery'], null, true );
            wp_localize_script( 'mva-tabs', 'mva_ajax', [ 'ajax_url' => admin_url( 'admin-ajax.php' ) ] );
            wp_enqueue_style( 'mva-style', plugin_dir_url(__FILE__) . 'css/mva-style.css' );
        }
    }

    public function register_admin_page() {
        add_menu_page(
            'Most Viewed Articles',
            'Most Viewed',
            'manage_options',
            'most-viewed-articles',
            [ $this, 'render_admin_page' ],
            'dashicons-chart-bar',
            20
        );
    }

    public function render_admin_page() {
        echo '<div class="wrap"><h1>Most Viewed Articles</h1>';
        echo '<div class="mva-widget">
                <div class="mva-tabs">
                    <button class="mva-tab active" data-range="week">This Week</button>
                    <button class="mva-tab" data-range="month">This Month</button>
                </div>
                <div class="mva-content"><p>Loading...</p></div>
             </div>';
        echo '</div>';
    }

    public function register_view_tracking() {
        if ( is_singular( 'post' ) ) {
            add_action( 'template_redirect', [ $this, 'track_post_view' ] );
        }
    }

    public function track_post_view() {
        if ( ! is_single() ) return;

        global $wpdb;
        $post_id = get_the_ID();
        $ip = $_SERVER['REMOTE_ADDR'];
        $table = $wpdb->prefix . 'most_viewed';

        // Check if this IP already viewed the post in the past hour
        $recent = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM $table
                 WHERE post_id = %d
                   AND ip_address = %s
                   AND viewed_at >= NOW() - INTERVAL 1 HOUR",
                $post_id,
                $ip
            )
        );

        if ( $recent == 0 ) {
            $wpdb->insert( $table, [
                'post_id'    => $post_id,
                'ip_address' => $ip,
                'viewed_at'  => current_time( 'mysql' )
            ]);
        }
    }


    public function ajax_get_articles() {
        global $wpdb;
        $range = sanitize_text_field( $_POST['range'] );
        $interval = $range === 'month' ? 30 : 7;

        $results = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT p.ID, p.post_title, COUNT(*) as views
                 FROM {$wpdb->prefix}most_viewed mv
                 INNER JOIN {$wpdb->posts} p ON p.ID = mv.post_id
                 WHERE p.post_status = 'publish'
                   AND p.post_type = 'post'
                   AND mv.viewed_at >= NOW() - INTERVAL %d DAY
                 GROUP BY mv.post_id
                 ORDER BY views DESC
                 LIMIT 10",
                $interval
            )
        );

        ob_start();
        echo '<ol class="mva-list">';
        foreach ( $results as $index => $row ) {
            printf(
                '<li> <div> <span class="rank">%d.</span> <a href="%s">%s</a> </div> <span class="mva-views">(%d views)</span> </li>',
                $index + 1,
                esc_url( get_permalink( $row->ID ) ),
                esc_html( $row->post_title ),
                intval( $row->views )
            );
        }
        echo '</ol>';
        echo ob_get_clean();
        wp_die();
    }
}

class Most_Viewed_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct( 'most_viewed_widget', 'Most Viewed Articles', [ 'description' => 'Displays top viewed posts for week/month.' ] );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        echo '<div class="mva-widget">
                <div class="mva-tabs">
                    <button class="mva-tab active" data-range="week">This Week</button>
                    <button class="mva-tab" data-range="month">This Month</button>
                </div>
                <div class="mva-content"></div>
             </div>';
        echo $args['after_widget'];
    }
}

// Create DB table on plugin activation
function mva_create_table() {
    global $wpdb;
    $table = $wpdb->prefix . 'most_viewed';
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        post_id BIGINT(20) NOT NULL,
        ip_address VARCHAR(100) NOT NULL,
        viewed_at DATETIME NOT NULL,
        INDEX (post_id),
        INDEX (viewed_at)
    ) $charset;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'mva_create_table' );

// Initialize the plugin
new Most_Viewed_Articles();
