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
function custom_tabs_settings_init()
{
    register_setting('custom_tabs_plugin', 'custom_tabs_options');

    add_settings_section(
        'custom_tabs_plugin_section', // Section ID
        __('Custom Tabs Settings', 'custom-tabs-plugin'), // Title
        'custom_tabs_settings_section_callback', // Callback to display description
        'custom_tabs_plugin' // Page slug
    );

    $fields = [
        'field_title_one' => 'Case Study title 1',
    ];

    foreach ($fields as $field_id => $field_title) {
        add_settings_field(
            $field_id,
            __($field_title, 'custom-tabs-plugin'),
            "render_{$field_id}",
            'custom_tabs_plugin',
            'custom_tabs_plugin_section'
        );
    };

    // Case Study 1 Title
    // add_settings_field(
    //     'custom_tabs_field_case_title_one', // Field ID 
    //     __('Case study 1 title', 'custom-tabs-plugin'), // Case Study 1 title
    //     'custom_tabs_field_case_title_one_render', // Callback to render the field
    //     'custom_tabs_plugin', // Page Slug
    //     'custom_tabs_plugin_section', // Section ID 
    // );


}

function custom_render_fields($field_id, $type = 'text')
{
    $options = get_option('custom_tabs_option');
    $value = isset($options[$field_id]) ? esc_attr($options[$field_id]) : '';

    if ($type == 'textarea') {
        echo "<textarea name='custom_tabs_options[$field_id]'>$value</textarea>";
    } else {
        echo "<input type='text' name='custom_tabs_options[$field_id]' value='$value'>";
    }
}

function render_field_title_one() {
    custom_render_fields('field_title_one');
}



// Callback function to display the section description
function custom_tabs_settings_section_callback()
{
    echo __('Enter your settings below:', 'custom-tabs-plugin');
}

// Callback function to display the options page
function custom_tabs_options_page()
{
    ?>
    <form action='options.php' method='post'>
        <h1><?php _e('Custom Tabs Plugin Settings', 'custom-tabs-plugin'); ?></h1>
        <?php
        settings_fields('custom_tabs_plugin');
        do_settings_sections('custom_tabs_plugin');
        submit_button();
        ?>
    </form>
    <?php
}

// Shortcode function to display the value of the input field
function custom_tabs_value_shortcode()
{
    $options = get_option('custom_tabs_options');

    $caseOneTitle = isset($options['field_title_one']) ? $options['field_title_one'] : '';

    $html = "";

    $html .=
        "
    <section class='case-studies-container'> 

    <div class='titles-container'>
    <h3> $caseOneTitle  </h3>
    </div>

    <div class='desc-container'>

    <img  class='apostrophes' />
    <b class='desc-bold'> </b>
    <p class='desc-text'>  </p>

    <div class='review-person-container'>
        <div>
        <img class='person' src=''/>
        </div>
        
        <div>
        <p class='review-name'>  </p>
        <p class='review-job'>  </p>
        </div>
    </div>

    <img class='company-logo'/>
    </div>

    </section>
    ";

    return $html;
}

// Register the shortcode
add_shortcode('custom_tabs_value', 'custom_tabs_value_shortcode');
?>