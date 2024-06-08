<?php
/*
 * Plugin Name: custom-tabs-plugin
 * Author: Dor cohen
 */

// Hook to add admin menu
add_action('admin_menu', 'custom_tabs_add_admin_menu');

// Hook to register settings
add_action('admin_init', 'custom_tabs_settings_init');

// Hook to load styles 
add_action('wp_enqueue_scripts', 'custom_tabs_enqueue_styles');

function custom_tabs_enqueue_styles()
{
    wp_enqueue_style('custom-tabs-styles', plugins_url('./css/custom-tabs-style.css', __FILE__));
}


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

    // Array of fields with their types
    $fields = [
        'field_title_one' => 'text',
        'field_bold_description_one' => 'textarea',
        'field_description_one' => 'textarea',
        'field_person_img_one' => 'text',
        'field_person_name_one' => 'text',
        'field_person_job_one' => 'text',
        'field_brand_logo_one' => 'text',
        'field_section_bg_one' => 'text',
        'field_title_right_one' => 'text',
        'field_subtitle_right_one' => 'text',
        'field_cta_text_one' => 'text',
        'field_title_two' => 'text',
        'field_bold_description_two' => 'textarea',
        'field_description_two' => 'textarea',
        'field_person_img_two' => 'text',
        'field_person_name_two' => 'text',
        'field_person_job_two' => 'text',
        'field_brand_logo_two' => 'text',
        'field_section_bg_two' => 'text',
        'field_title_right_two' => 'text',
        'field_subtitle_right_two' => 'text',
        'field_cta_text_two' => 'text',
    ];


    // Looping over the array of fields to add settings fields 
    foreach ($fields as $field_id => $field_type) {
        add_settings_field(
            $field_id,
            __(str_replace('_', ' ', ucwords($field_id, '_')), 'custom-tabs-plugin'), // Convert field ID to Title
            function () use ($field_id, $field_type) {
                custom_render_fields($field_id, $field_type);
            },
            'custom_tabs_plugin',
            'custom_tabs_plugin_section'
        );
    }
}

// Function to render and generate custom fields
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

// Rendering item by user prefrence
function onChooseItem($str){

    var_dump($str);
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
    $fieldTitleRightOne = isset($options['field_title_right_one']) ? $options['field_title_right_one'] : '';
    $fieldSubtitleRightOne = isset($options['field_subtitle_right_one']) ? $options['field_subtitle_right_one'] : '';
    $fieldCtaTextOne = isset($options['field_cta_text_one']) ? $options['field_cta_text_one'] : '';

    // Item 2
    $fieldTitleTwo = isset($options['field_title_two']) ? $options['field_title_two'] : '';
    $fieldBoldDescriptionTwo = isset($options['field_bold_description_two']) ? $options['field_bold_description_two'] : '';
    $fieldDescriptionTwo = isset($options['field_description_two']) ? $options['field_description_two'] : '';
    $fieldPersonImgTwo = isset($options['field_person_img_two']) ? $options['field_person_img_two'] : '';
    $fieldPersonNameTwo = isset($options['field_person_name_two']) ? $options['field_person_name_two'] : '';
    $fieldPersonJobTwo = isset($options['field_person_job_two']) ? $options['field_person_job_two'] : '';
    $fieldBrandLogoTwo = isset($options['field_brand_logo_two']) ? $options['field_brand_logo_two'] : '';
    $fieldSectionBgTwo = isset($options['field_section_bg_two']) ? $options['field_section_bg_two'] : '';
    $fieldTitleRightTwo = isset($options['field_title_right_two']) ? $options['field_title_right_two'] : '';
    $fieldSubtitleRightTwo = isset($options['field_subtitle_right_two']) ? $options['field_subtitle_right_two'] : '';
    $fieldCtaTextTwo = isset($options['field_cta_text_two']) ? $options['field_cta_text_two'] : '';

    $html = "";
    $html .=
        "

        <div class='titles-container'>
            <h3 onclick=onclick='onChooseItem('retail') class='active' '>Retail</h3>
            <h3 onclick=onclick='onChooseItem('luxury') class='inactive' '>Luxury fashion </h3>
            <h3 onclick=onclick='onChooseItem('digital') class='inactive' '>Digital goods </h3>
            <h3 onclick=onclick='onChooseItem('travel') class='inactive' '>Travel </h3>
            <h3 onclick=onclick='onChooseItem('athletic') class='inactive' '>Athletic & Outdoors  </h3>
        </div>
    
    <section class='case-studies-container'> 
    
        <article class='left-side-container' style='background-image: url($fieldSectionBgOne)'>

            <div class='desc-container'>
                <a class='apostrophes'> &#x201E; </a>
                <b class='desc-bold bold'> $fieldBoldDescriptionOne </b>
                <p class='desc-text'> $fieldDescriptionOne </p>
                <div class='review-person-container'>
                    <img class='person' src='$fieldPersonImgOne' />
                    <div class='review-text-container'>
                        <b class='review-name'> $fieldPersonNameOne </b>
                        <p class='review-job'> $fieldPersonJobOne </p>
                    </div>
                </div>
                <img class='company-logo' src='$fieldBrandLogoOne'/>
            </div>
        </article>
    
        <article class='right-side-container'>
            <div class='right-side-title-container'>
                <h2>$fieldTitleRightOne</h2>
                <p>$fieldSubtitleRightOne</p>
            </div>
            <div class='cta-container'>
                <p class='arrow'>&#x2197;</p>
                <a> $fieldCtaTextOne</a>
            </div>
        </article>
    
    </section>
    ";
    return $html;
}

// Register the shortcode
add_shortcode('custom_tabs_value', 'custom_tabs_value_shortcode');
?>