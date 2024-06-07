<?php 
/*
 * Plugin Name: custom-tabs-plugin
 * Author: Dor cohen
 */

 // hook to add admin menu
 add_action('admin_menu', 'custom_tabs_add_admin_menu');

// hook to register settings
 add_action('admin_init', 'custom_tabs_settings_init');

 function custom_tabs_add_admin_menu() {
    add_options_page(
        'Custom Tabs Plugin', // Page title
        'Custom Tabs',        // Menu title
        'manage_options',     // Capability required
        'custom-tabs-plugin', // Menu slug
        'custom_tabs_options_page' // Function to display the page content
    )
 };

 function activate_tabs_plugin() {
    
 }


 // register activation hook
 register_activation_hook(__FILE__, 'activate_tabs_plugin')


?>