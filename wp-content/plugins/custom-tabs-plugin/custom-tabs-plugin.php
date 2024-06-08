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
    wp_enqueue_style('custom-tabs-styles', plugins_url('./scss/custom-tabs-style.scss', __FILE__));
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

    $fields = [
        'field_title' => 'text',
        'field_bold_description' => 'textarea',
        'field_description' => 'textarea',
        'field_person_img' => 'text',
        'field_person_name' => 'text',
        'field_person_job' => 'text',
        'field_brand_logo' => 'text',
        'field_section_bg' => 'text',
        'field_title_right' => 'text',
        'field_subtitle_right' => 'text',
        'field_cta_text' => 'text',
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
            'custom_tabs_plugin_section',
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

// Generate Item object 
function generateItemObject($options, $prefix)
{
    return [
        'title' => isset($options[$prefix . 'title']) ? $options[$prefix . 'title'] : '',
        'boldDesc' => isset($options[$prefix . 'bold_description']) ? $options[$prefix . 'bold_description'] : '',
        'regDesc' => isset($options[$prefix . 'description']) ? $options[$prefix . 'description'] : '',
        'personImg' => isset($options[$prefix . 'person_img']) ? $options[$prefix . 'person_img'] : '',
        'personName' => isset($options[$prefix . 'person_name']) ? $options[$prefix . 'person_name'] : '',
        'personJob' => isset($options[$prefix . 'person_job']) ? $options[$prefix . 'person_job'] : '',
        'brandLogo' => isset($options[$prefix . 'brand_logo']) ? $options[$prefix . 'brand_logo'] : '',
        'sectionBg' => isset($options[$prefix . 'section_bg']) ? $options[$prefix . 'section_bg'] : '',
        'rightTitle' => isset($options[$prefix . 'title_right']) ? $options[$prefix . 'title_right'] : '',
        'rightSubtitle' => isset($options[$prefix . 'subtitle_right']) ? $options[$prefix . 'subtitle_right'] : '',
        'ctaText' => isset($options[$prefix . 'cta_text']) ? $options[$prefix . 'cta_text'] : ''
    ];
}

// Shortcode function to display the value of the input field
function custom_tabs_value_shortcode()
{
    $options = get_option('custom_tabs_options');

    // Define variables for item one and item two
    $itemOne = generateItemObject($options, 'field_');
    $itemTwo = generateItemObject($options, 'field_');

    extract($itemOne); // Extracting $title, $boldDesc, $regDesc, $personImg, $personName, $personJob, $brandLogo, $sectionBg, $rightTitle, $rightSubtitle, $ctaText

    // Start building HTML
    $html = "<script>
                console.log('live');
            </script>
    <div class='titles-container'>
        <h3 onclick=\"onChooseItem('retail')\" class='active'>Retail</h3>
        <h3 onclick=\"onChooseItem('luxury')\" class='inactive'>Luxury fashion</h3>
        <h3 onclick=\"onChooseItem('retail')\" class='inactive'>Digital goods</h3>
        <h3 onclick=\"onChooseItem('retail')\" class='inactive'>Travel</h3>
        <h3 onclick=\"onChooseItem('retail')\" class='inactive'>Athletic & Outdoors</h3>
    </div>
    <section class='case-studies-container'> 
        <article class='left-side-container' style='background-image: url($sectionBg)'>
            <div class='desc-container'>
                <a class='apostrophes'> &#x201E; </a>
                <b class='desc-bold bold'> $boldDesc </b>
                <p class='desc-text'> $regDesc </p>
           <div class='review-person-container'>
               <img class='person' src='$personImg' />
                    <div class='review-text-container'>
                        <b class='review-name'> $personName </b>
                        <p class='review-job'> $personJob </p>
                     </div>
           </div>
                <img class='company-logo' src='$brandLogo'/>
            </div>
        </article>
        <article class='right-side-container'>
            <div class='right-side-title-container'>
                <h2>$rightTitle</h2>
                <p>$rightSubtitle</p>
            </div>
            <div class='cta-container'>
                <p class='arrow'>&#x2197;</p>
                <a> $ctaText </a>
            </div>
        </article>
        
    </section>
    <div class='trusted-by-container'>
            <h4> TRUSTED BY </h4>
        <div>
            <img src='https://www.riskified.com/app/uploads/2024/02/Merchant-logos-4.png' class='trusted-img'/>
            <img src='https://www.riskified.com/app/uploads/2024/02/Merchant-logos-1-1.png'/>
            <img src='https://www.riskified.com/app/uploads/2024/02/Aldo.png'/>
            <img src='https://www.riskified.com/app/uploads/2024/02/bluemercury.png'/>
        </div>
    </div>
    ";
    return $html;
}

// Register the shortcode
add_shortcode('custom_tabs_value', 'custom_tabs_value_shortcode');
?>