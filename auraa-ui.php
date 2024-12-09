<?php
/**
 * Plugin Name: Auraa Addons 
 * Description: A custom plugin to display widgets including logo and navigation menu.
 * Version: 1.0
 * Author: Aditya Singh Borana
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Elementor Widgets
 */
function register_my_elementor_widgets()
{
    // Load widget files
    $widget_files = [
        'widgets/header_widget.php',
        'widgets/product_categories_widget.php',
    
    ];

    foreach ($widget_files as $file) {
        require_once plugin_dir_path(__FILE__) . $file;
    }
}
add_action('elementor/widgets/register', 'register_my_elementor_widgets');

/**
 * Enqueue Standard CSS for Frontend
 */
function my_plugin_enqueue_styles()
{
    wp_enqueue_style(
        'my-plugin-styles', // Handle for the stylesheet
        plugin_dir_url(__FILE__) . 'assets/css/logo-navigation-widgets.css', // Standard CSS file URL
        [], // No dependencies
        filemtime(plugin_dir_path(__FILE__) . 'assets/css/logo-navigation-widgets.css') // Cache-busting by modification time
    );
}
add_action('wp_enqueue_scripts', 'my_plugin_enqueue_styles');

function my_plugin_enqueue_category_loop_styles()
{
    wp_enqueue_style(
        'my-plugin-category-loop-styles', // Handle for the stylesheet
        plugin_dir_url(__FILE__) . 'assets/css/category-loop.css', // Standard CSS file URL
        [], // No dependencies
        filemtime(plugin_dir_path(__FILE__) . 'assets/css/category-loop.css') // Cache-busting by modification time
    );
}
add_action('wp_enqueue_scripts', 'my_plugin_enqueue_category_loop_styles');
/**
 * Enqueue Standard CSS for Elementor Editor
 */
function my_plugin_enqueue_styles_editor()
{
    wp_enqueue_style(
        'my-plugin-editor-styles', // Separate handle for editor CSS
        plugin_dir_url(__FILE__) . 'assets/css/styles.css', // Standard CSS file URL
        [], // No dependencies
        filemtime(plugin_dir_path(__FILE__) . 'assets/css/styles.css') // Cache-busting by modification time
    );
}
add_action('elementor/editor/after_enqueue_styles', 'my_plugin_enqueue_styles_editor');
