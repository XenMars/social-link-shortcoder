<?php
/*
Plugin Name: SocialLink Shortcoder
Plugin URI: https://xenbel.com/
Description: This plugin allows you to create <strong>customizable shortcodes</strong> to embed social media links anywhere on your website.
Version: 1.0
Author: Xen Beliaeva
Author URI: https://xenbel.com/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/ 

require_once('sociallink_shortcoder_manage_links_page.php');
require_once('sociallink_shortcoder_add_new_page.php');
require_once('sociallink_shortcoder_edit_page.php');
require_once('sociallink_shortcoder_settings_page.php');


// Hook the function to run on plugin activation
register_activation_hook(__FILE__, 'sociallink_shortcoder_install');
function sociallink_shortcoder_install() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'xb_social_links';

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        url varchar(255) NOT NULL,
        image varchar(255) DEFAULT '' NOT NULL,
        iconColor varchar(7) DEFAULT '#FFFFFF' NOT NULL,
        iconSize varchar(10) DEFAULT '24px' NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    try {
        dbDelta($sql);
    } catch (Exception $e) {
        error_log('Error creating table: ' . $e->getMessage());  // Логирование ошибки вместо вывода
    }
}

function sociallink_shortcoder_admin_menu() {
    add_menu_page(
        'SocialLink Shortcoder',      // Page title
        'SocialLink Shortcoder ',      // Menu title
        'manage_options',             // Capability
        'sociallink-shortcoder',      // Menu slug
        'sociallink_shortcoder_manage_links_page',  // Callback function
        'dashicons-admin-links',      // Icon URL 
        25                   // Position 
    );
    add_submenu_page(
        'sociallink-shortcoder',      // Parent slug
        'Manage Links',                // Page title
        'Manage Links',                // Menu title
        'manage_options',             // Capability
        'sociallink-shortcoder',      // Menu slug
        'sociallink_shortcoder_manage_links_page'  // Callback function
    );
    add_submenu_page(
        'sociallink-shortcoder',      // Parent slug
        'Add New Link',                // Page title
        'Add New Link',                // Menu title
        'manage_options',             // Capability
        'sociallink-shortcoder-add-new',  // Menu slug
        'sociallink_shortcoder_add_new_page'  // Callback function
    );
    add_submenu_page(
        'sociallink-shortcoder',      // Parent slug
        'How-To-Use',                // Page title
        'How-To-Use',                // Menu title
        'manage_options',             // Capability
        'sociallink-shortcoder-settings',  // Menu slug
        'sociallink_shortcoder_settings_page'  // Callback function
    );
    add_submenu_page(
        'null', 
        'Edit Link', 
        'Edit Link', 
        'manage_options', 
        'sociallink-shortcoder-edit', 
        'sociallink_shortcoder_edit_page' 
    );
}

add_action('admin_menu', 'sociallink_shortcoder_admin_menu');

// Include WordPress database upgrade functionality
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');



function get_social_links() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'xb_social_links';
    
    $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    return $results;
}

//scripts
function sociallink_shortcoder_admin_scripts() {
    wp_enqueue_style('main-sls-styles', plugin_dir_url(__FILE__) . 'css/main.css');
    wp_enqueue_style('font-awesome', plugin_dir_url(__FILE__) . 'css/fontawesome/css/all.min.css');

    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_media();
    wp_enqueue_script('sociallink-media-uploader', plugin_dir_url(__FILE__) . 'js/media-uploader.js', array('jquery'), null, true);
    wp_enqueue_script('sociallink-icon-picker', plugin_dir_url(__FILE__) . 'js/icon-picker.js', array('jquery'), null, true); 
}
add_action('admin_enqueue_scripts', 'sociallink_shortcoder_admin_scripts');

function sociallink_shortcoder_front_scripts() {
    wp_enqueue_style('frontmain-sls-styles', plugin_dir_url(__FILE__) . 'css/front-main.css');
    wp_enqueue_style('font-awesome', plugin_dir_url(__FILE__) . 'css/fontawesome/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'sociallink_shortcoder_front_scripts');



function load_color_picker_assets($hook_suffix) {
    // Убедимся, что стили и скрипты загружаются только на странице вашего плагина
    if ($hook_suffix != 'social-link-shortcoder.php') {
        return;
    }

    // Включаем стиль для Color Picker
    wp_enqueue_style('wp-color-picker');
    
    // Включаем скрипт для Color Picker
    wp_enqueue_script('wp-color-picker');
    
    // Опционально: добавить собственный скрипт для инициализации Color Picker
    // wp_enqueue_script('my-color-picker', plugin_dir_url(__FILE__) . 'js/my-color-picker.js', array('wp-color-picker'), false, true);
}
add_action('admin_enqueue_scripts', 'load_color_picker_assets');












