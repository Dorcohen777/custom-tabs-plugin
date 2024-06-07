<?php
/*
 * Plugin Name: custom-tabs-plugin
 * Author: Dor cohen
 */

// Hook to add admin menu
add_action('admin_menu', 'custom_tabs_add_admin_menu');

// Hook to register settings
add_action('admin_init', 'custom_tabs_settings_init');

// Function to add the options page
function custom_tabs_add_admin_menu()
{
    add_options_page(
        'Custom Tabs Plugin',       // Page title
        'Custom Tabs',              // Menu title
        'manage_options',           // Capability required
        'custom-tabs-plugin',       // Menu slug
        'custom_tabs_options_page'  // Function to display the page content
    );
}

// Function to register settings
function custom_tabs_settings_init() {
    register_setting('custom_tabs_plugin', 'custom_tabs_options'); 
    add_settings_section(
        'custom_tabs_plugin_section', // Section ID
        __('Custom Tabs Settings', 'custom-tabs-plugin'), // Title
        'custom_tabs_settings_section_callback', // Callback to display description
        'custom_tabs_plugin' // Page slug
    );

    add_settings_field(
        'custom_tabs_field_brands_name', // Field ID 
        __('Case Study Titles', 'custom-tabs-plugin'), // Case Study Titles
        'custom_tabs_field_brands_name_render', // Callback to render the field
        'custom_tabs_plugin', // Page Slug
        'custom_tabs_plugin_section', // Section ID 
    );
}

function custom_tabs_field_brands_name_render() {
    $options = get_option('custom_tabs_options');
    $titles = isset($options['custom_tabs_field_brands_name']) ? $options['custom_tabs_field_brands_name'] : '';

    ?>
    <textarea name="custom_tabs_options[custom_tabs_field_brands_name]" rows="5" cols="50"><?php echo esc_textarea($titles); ?></textarea>
    <p class="description"><?php _e('Enter each title on a new line.', 'custom-tabs-plugin'); ?></p>
    <?php
}

// Function to sanitize the input
function custom_tabs_sanitize_titles($input) {
    $sanitized_input = array();

    if (isset($input['custom_tabs_field_brands_name'])) {
        $lines = explode("\n", $input['custom_tabs_field_brands_name']);
        $sanitized_input['custom_tabs_field_brands_name'] = array_map('sanitize_text_field', $lines);
    }

    return $sanitized_input;
}

// Register sanitization function with the setting
add_filter('sanitize_option_custom_tabs_options', 'custom_tabs_sanitize_titles');

// register activation hook
register_activation_hook(__FILE__, 'activate_tabs_plugin');
?>
