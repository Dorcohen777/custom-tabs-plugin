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

    // Array of field IDs
    $fields = [
        'field_title_one' => 'Title - item 1',
        'field_description_one' => 'Description - item 1',
        'field_bold_description_one' => 'Bold Description - item 1',
        'field_person_img_one' => 'Preson URL - item 1',
        'field_person_name_one' => 'Person Name - item 1',
        'field_person_job_one' => 'Person Job - item 1',
        'field_brand_logo_one' => 'CaseStudy Logo - item 1',
        'field_section_bg_one' => 'Section Background URL - item 1',
        'field_title_right' => 'Section title right side - item 1',
        'field_subtitle_right' => 'Section subtitle right side - item 1',
        'field_cta_text' => 'CTA Text - item 1',
    ];

    // Creating field
    foreach ($fields as $field_id => $field_title) {
        add_settings_field(
            $field_id,
            __($field_title, 'custom-tabs-plugin'),
            "render_{$field_id}",
            'custom_tabs_plugin',
            'custom_tabs_plugin_section'
        );
    };

}

// Item 1 title
function render_field_title_one()
{
    custom_render_fields('field_title_one');
}

// Item 1 bold description 
function render_field_bold_description_one()
{
    custom_render_fields('field_bold_description_one', 'textarea');
}

// Item 1 description 
function render_field_description_one()
{
    custom_render_fields('field_description_one', 'textarea');
}

// Item 1 person image
function render_field_person_img_one()
{
    custom_render_fields('field_person_img_one');
}
// Item 1 person name
function render_field_person_name_one()
{
    custom_render_fields('field_person_name_one');
}

// Item 1 person job
function render_field_person_job_one()
{
    custom_render_fields('field_person_job_one');
}

// Item 1 logo image
function render_field_brand_logo_one()
{
    custom_render_fields('field_brand_logo_one');
}
// Item 1 section background image
function render_field_section_bg_one()
{
    custom_render_fields('field_section_bg_one');
}

// Item 1 right side title
function render_field_title_right()
{
    custom_render_fields('field_title_right');
}

// Item 1 right side subtitle
function render_field_subtitle_right()
{
    custom_render_fields('field_subtitle_right');
}
function render_field_cta_text()
{
    custom_render_fields('field_cta_text');
}

// Function that render and generate custom fields
function custom_render_fields($field_id, $type = 'text')
{
    $options = get_option('custom_tabs_options');
    $value = isset($options[$field_id]) ? esc_attr($options[$field_id]) : '';

    if ($type == 'textarea') {
        echo "<textarea name='custom_tabs_options[$field_id]'>$value</textarea>";
    } else {
        echo "<input type='text' name='custom_tabs_options[$field_id]' value='$value'>";
    }
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

    // Item 1
    $fieldTitleOne = isset($options['field_title_one']) ? $options['field_title_one'] : '';
    $fieldBoldDescriptionOne = isset($options['field_bold_description_one']) ? $options['field_bold_description_one'] : '';
    $fieldDescriptionOne = isset($options['field_description_one']) ? $options['field_description_one'] : '';
    $fieldPersonImgOne = isset($options['field_person_img_one']) ? $options['field_person_img_one'] : '';
    $fieldPersonNameOne = isset($options['field_person_name_one']) ? $options['field_person_name_one'] : '';
    $fieldPersonJobOne = isset($options['field_person_job_one']) ? $options['field_person_job_one'] : '';
    $fieldBrandLogoOne = isset($options['field_brand_logo_one']) ? $options['field_brand_logo_one'] : '';
    $fieldSectionBgOne = isset($options['field_section_bg_one']) ? $options['field_section_bg_one'] : '';
    $fieldTitleRight = isset($options['field_title_right']) ? $options['field_title_right'] : '';
    $fieldSubtitleRight = isset($options['field_subtitle_right']) ? $options['field_subtitle_right'] : '';
    $fieldCtaText = isset($options['field_cta_text']) ? $options['field_cta_text'] : '';


    $html = "";

    $html .=
        "

    <div class='titles-container'>
    <h3> $fieldTitleOne </h3>
    </div>

    <section class='case-studies-container'> 

    <acticle class='left-side-container'> 

    <div class='desc-container'>

    <img  class='apostrophes' />
    <b class='desc-bold'> $fieldBoldDescriptionOne </b>
    <p class='desc-text'> $fieldDescriptionOne </p>

    <div class='review-person-container'>
        <div>
        
        <img class='person' src='$fieldPersonImgOne' />
        </div>
        
        <div>
        <p class='review-name'> $fieldPersonNameOne </p>
        <p class='review-job'> $fieldPersonJobOne </p>
        </div>
    </div>

    <img class='company-logo' src='$fieldBrandLogoOne'/>

    </article>

    <article class='right-side-container'>

    <div class='right-side-title-container'>
    <h2>$fieldTitleRight</h2>
    <p>$fieldSubtitleRight</p>
    </div>

    <div class='cta-container'>
        <a> $fieldCtaText </a>
    </div>

    </article>

    </section>
    ";

    return $html;
}

// Register the shortcode
add_shortcode('custom_tabs_value', 'custom_tabs_value_shortcode');
?>