<?php
/*
Plugin Name: WP GDPR Cookie Consent & Tracking
Plugin URI: https://servebolt.com
Description: This plugin adds a nice cookie consent to the bottom of the browser, with advanced cookie settings accessable to the users. The user automatically consent to using cookies on scroll.
Author: Thomas Audunhus
Version: 0.1
Author URI: https://servebolt.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: servebolt-gdpr
*/


// TODO: update styling
// TODO: make comments
// TODO: make readme

define( 'SERVEBOLT_COOKIE_NOTICE_PATH_URL', plugin_dir_url( __FILE__ ) );
define( 'SERVEBOLT_COOKIE_NOTICE_PATH', plugin_dir_path( __FILE__ ) );

class sb_gdpr_setup {
    public function __construct() {
        // Hook into the admin menu
        add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
        add_action( 'admin_init', array( $this, 'setup_sections' ) );
        add_action( 'admin_init', array( $this, 'setup_fields' ) );
        add_action( 'wp_footer',  array( $this, 'init_cookie_warning' ), 999);
        add_action( 'wp_head',    array( $this, 'head_scripts' ));
        add_action( 'wp_footer',  array( $this, 'body_scripts' ));
        add_option('servebolt_gdpr_settings');
        wp_enqueue_script( 'sb_gdpr_notice_script', SERVEBOLT_COOKIE_NOTICE_PATH_URL.'/gdpr-cookie-notice-js/dist/script.js', false, '0.1', false );
        wp_enqueue_style( 'sb_gdpr_notice_style', SERVEBOLT_COOKIE_NOTICE_PATH_URL.'/gdpr-cookie-notice-js/dist/style.css', false, '0.1' );
    }

    public function create_plugin_settings_page() {
        // Add the menu item and page
        $parent_slug = 'options-general.php'; // Add this to the settings menu
        $page_title = 'Servebolt Cookie & Tracking Notice';
        $menu_title = 'Cookie Notice';
        $capability = 'manage_options';
        $slug = 'servebolt_gdpr_notice';
        $callback = array( $this, 'plugin_settings_page_content' );

        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $slug, $callback);
    }

    public function setup_sections() {
        add_settings_section( 'servebolt_gdpr_general', 'General settings', array( $this, 'section_callback' ), 'servebolt_gdpr_notice' );
        add_settings_section( 'servebolt_gdpr_performance', 'Performance Cookies & Tracking', array( $this, 'section_callback' ), 'servebolt_gdpr_notice' );
        add_settings_section( 'servebolt_gdpr_analytics', 'Analytics Cookies & Tracking', array( $this, 'section_callback' ), 'servebolt_gdpr_notice' );
        add_settings_section( 'servebolt_gdpr_marketing', 'Marketing Cookies & Tracking', array( $this, 'section_callback' ), 'servebolt_gdpr_notice' );
    }

    public function setup_fields($getfields = false) {
        $fields = array(
            'sb_cookie_statement' => array(
                'uid' => 'sb_cookie_statement',
                'label' => 'Cookie Statement URL',
                'section' => 'servebolt_gdpr_general',
                'type' => 'text',
                'placeholder' => 'Some text',
                'supplimental' => 'The full URL to the page where a user can find your cookie statement listing all cookies you use, and for what purpose you are using each cookie.',
            ),
            'sb_essential_notice_desc' => array(
                'uid' => 'sb_essential_notice_desc',
                'label' => 'Notice description',
                'section' => 'servebolt_gdpr_general',
                'type' => 'textarea',
                'placeholder' => 'We use cookies to offer you a better browsing experience, personalise content and ads, to provide social media features and to analyse our traffic. Read about how we use cookies and how you can control them by clicking Cookie Settings. You consent to our cookies if you continue to use this website.',
                'supplimental' => 'The text you want to display on the cookie notice bar that is shown when the user has not given consent yet.',
            ),
            'sb_essential_cookies_desc' => array(
                'uid' => 'sb_essential_cookies_desc',
                'label' => 'Essential cookies description',
                'section' => 'servebolt_gdpr_general',
                'type' => 'textarea',
                'placeholder' => 'Necessary cookies help make a website usable by enabling basic functions like page navigation and access to secure areas of the website. The website cannot function properly without these cookies.',
                'supplimental' => 'The description of the essential cookies to make your WordPress website work. This will be shown in the cookie setting modal.',
            ),
            'sb_performance_cookies' => array(
                'uid' => 'sb_performance_cookies',
                'label' => 'Performance cookies',
                'section' => 'servebolt_gdpr_performance',
                'type' => 'textarea',
                'placeholder' =>
                    '_ga
_gid',
                'supplimental' => 'One cookie per line',
            ),
            'sb_performance_desc' => array(
                'uid' => 'sb_performance_desc',
                'label' => 'Performance tracking description',
                'section' => 'servebolt_gdpr_performance',
                'type' => 'textarea',
                'placeholder' => 'These cookies are used to enhance the performance and functionality of our websites but are non-essential to their use. For example it stores your preferred language or the region that you are in.',
                'supplimental' => 'Description of the performance related cookies you have on your site. This description will be showed in the cookie settings modal.',
            ),
            'sb_performance_scripts_head' => array(
                'uid' => 'sb_performance_scripts_head',
                'label' => 'Performance Scripts HEAD',
                'section' => 'servebolt_gdpr_performance',
                'type' => 'textarea',
                'placeholder' => 'Some text',
                'supplimental' => 'These scripts will be added to HEAD of your site, and will not run until the user has given consent.',
            ),
            'sb_performance_scripts_body' => array(
                'uid' => 'sb_performance_scripts_body',
                'label' => 'Performance Scripts BODY',
                'section' => 'servebolt_gdpr_performance',
                'type' => 'textarea',
                'placeholder' => 'Some text',
                'supplimental' => 'These scripts will be added to the end of the BODY, and will not run until the user has given consent.',
            ),
            'sb_analytics_cookies' => array(
                'uid' => 'sb_analytics_cookies',
                'label' => 'Analytics Cookies',
                'section' => 'servebolt_gdpr_analytics',
                'type' => 'textarea',
                'placeholder' =>
                    '_ga
_gid',
                'supplimental' => 'One cookie per line',
            ),
            'sb_analytics_desc' => array(
                'uid' => 'sb_analytics_desc',
                'label' => 'Analytics Cookies Description',
                'section' => 'servebolt_gdpr_analytics',
                'type' => 'textarea',
                'placeholder' => 'We use analytics cookies to help us measure how users interact with website content, which helps us customize our websites and application for you in order to enhance your experience.',
                'supplimental' => 'Description of the analytics related cookies you have on your site. This description will be showed in the cookie settings modal.',
            ),
            'sb_analytics_scripts_head' => array(
                'uid' => 'sb_analytics_scripts_head',
                'label' => 'Analytics Scripts HEAD',
                'section' => 'servebolt_gdpr_analytics',
                'type' => 'textarea',
                'placeholder' => '',
                'supplimental' => 'These scripts will be added to HEAD of your site, and will not run until the user has given consent.',
            ),
            'sb_analytics_scripts_body' => array(
                'uid' => 'sb_analytics_scripts_body',
                'label' => 'Analytics Scripts BODY',
                'section' => 'servebolt_gdpr_analytics',
                'type' => 'textarea',
                'placeholder' => '',
                'supplimental' => 'These scripts will be added to the end of the BODY, and will not run until the user has given consent.',
            ),
            'sb_marketing_cookies' => array(
                'uid' => 'sb_marketing_cookies',
                'label' => 'Cookies',
                'section' => 'servebolt_gdpr_marketing',
                'type' => 'textarea',
                'placeholder' =>
                    '_ga
_gid',
                'supplimental' => 'One cookie name per line',
            ),
            'sb_marketing_desc' => array(
                'uid' => 'sb_marketing_desc',
                'label' => 'Cookies Description',
                'section' => 'servebolt_gdpr_marketing',
                'type' => 'textarea',
                'placeholder' => 'These cookies are used to make advertising messages more relevant to you and your interests. The intention is to display ads that are relevant and engaging for the individual user and thereby more valuable for publishers and third party advertisers.',
                'supplimental' => 'Description of the marketing related cookies you have on your site. This description will be showed in the cookie settings modal.',
            ),
            'sb_marketing_scripts_head' => array(
                'uid' => 'sb_marketing_scripts_head',
                'label' => 'Marketing Scripts HEAD',
                'section' => 'servebolt_gdpr_marketing',
                'type' => 'textarea',
                'placeholder' => '',
                'supplimental' => 'These scripts will be added to HEAD of your site, and will not run until the user has given consent.',
            ),
            'sb_marketing_scripts_body' => array(
                'uid' => 'sb_marketing_scripts_body',
                'label' => 'Marketing Scripts BODY',
                'section' => 'servebolt_gdpr_marketing',
                'type' => 'textarea',
                'placeholder' => '',
                'supplimental' => 'These scripts will be added to the end of the BODY, and will not run until the user has given consent.',
            ),
        );

        if($getfields === true) return $fields;

        foreach( $fields as $field ){
            add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'servebolt_gdpr_notice', $field['section'], $field );
            register_setting( 'servebolt_gdpr_notice', $field['uid'] );
        }
    }

    public function field_callback( $arguments ) {
        $value = get_option( $arguments['uid'] );
        if( ! $value ) {
            $value = $arguments['default'];
        }
        switch( $arguments['type'] ){
            case 'text':
            case 'number':
                printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
                break;
            case 'textarea':
                printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
                break;
            case 'multiselect':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $attributes = '';
                    $options_markup = '';
                    foreach( $arguments['options'] as $key => $label ){
                        $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value[ array_search( $key, $value, true ) ], $key, false ), $label );
                    }
                    if( $arguments['type'] === 'multiselect' ){
                        $attributes = ' multiple="multiple" ';
                    }
                    printf( '<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup );
                }
                break;
            case 'checkbox':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $options_markup = '';
                    $iterator = 0;
                    foreach( $arguments['options'] as $key => $label ){
                        $iterator++;
                        $options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
                    }
                    printf( '<fieldset>%s</fieldset>', $options_markup );
                }
                break;
            case 'pages':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $options_markup = '';
                    $iterator = 0;
                    foreach( $arguments['options'] as $key => $label ){
                        $iterator++;
                        $options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
                    }
                    printf( '<fieldset>%s</fieldset>', $options_markup );
                }
                break;
        }
        if( $helper = $arguments['helper'] ){
            printf( '<span class="helper"> %s</span>', $helper );
        }
        if( $supplimental = $arguments['supplimental'] ){
            printf( '<p class="description">%s</p>', $supplimental );
        }
    }



    public function section_callback( $arguments ) {
        switch( $arguments['id'] ){
            case 'servebolt_gdpr_general':
                echo '<p>Necessary cookies help make a website usable by enabling basic functions like page navigation and access to secure areas of the website. The website cannot function properly without these cookies.</p>';
                break;
            case 'servebolt_gdpr_performance':
                echo '<p>These cookies & trackers are used to enhance the performance and functionality of our websites but are non-essential to their use. For example it stores your preferred language or the region that you are in.</p>';
                break;
            case 'servebolt_gdpr_analytics':
                echo '<p>We use analytics cookies to help us measure how users interact with website content, which helps us customize our websites and application for you in order to enhance your experience.</p>';
                break;
            case 'servebolt_gdpr_marketing':
                echo '<p>These cookies are used to make advertising messages more relevant to you and your interests. The intention is to display ads that are relevant and engaging for the individual user and thereby more valuable for publishers and third party advertisers.</p>';
                break;
        }
    }



    public function plugin_settings_page_content() {
        self::update_settings_option();
        ?>
        <div class="wrap">
            <h2>Servebolt GDPR Cookie & Tracking Notice</h2>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'servebolt_gdpr_notice' );
                do_settings_sections( 'servebolt_gdpr_notice' );
                submit_button();
                ?>
            </form>
        </div> <?php
    }


    static function update_settings_option(){
        $allfields = self::setup_fields(true);
        $options = array();
        foreach ($allfields as $field){
            $value = get_option($field['uid']);
            $fields_to_explode = array(
                'sb_performance_cookies',
                'sb_analytics_cookies',
                'sb_marketing_cookies'
            );
            $fields_to_escape = array(
                'sb_performance_scripts_head',
                'sb_performance_scripts_body',
                'sb_analytics_scripts_head',
                'sb_analytics_scripts_body',
                'sb_marketing_scripts_head',
                'sb_marketing_scripts_body'
            );
            if(in_array($field['uid'], $fields_to_explode)):
                $options[$field['uid']] = explode(',', str_replace(' ', '', $value));
            elseif(in_array($field['uid'], $fields_to_escape)):
                $options[$field['uid']] = esc_html(strip_tags($value));
            else:
                $options[$field['uid']] = $value;
            endif;

        }
        update_option('servebolt_gdpr_settings', $options );
    }

    public function init_cookie_warning() {
        ob_start();
        include 'templates/notice.php';
        include 'templates/modal.php';
        include 'templates/config-script.php';
        echo ob_get_clean();
    }

    public function head_scripts() {
        $script = get_option('servebolt_gdpr_settings');
        echo '<script type="text/javascript" async>
                document.addEventListener("gdprCookiesEnabled", function (e) {
                if(e.detail.performance) { 
                    '.htmlspecialchars_decode($script['sb_performance_scripts_head']).'
                }
            });
            </script>';
        echo '<script type="text/javascript" async>
                document.addEventListener("gdprCookiesEnabled", function (e) {
                if(e.detail.analytics) { 
                    '.htmlspecialchars_decode($script['sb_analytics_scripts_head']).'
                }
            });
            </script>';
        echo '<script type="text/javascript" async>
                document.addEventListener("gdprCookiesEnabled", function (e) {
                if(e.detail.marketing) { 
                    '.htmlspecialchars_decode($script['sb_marketing_scripts_head']).'
                }
            });
            </script>';
    }

    public function body_scripts(){
        $script = get_option('servebolt_gdpr_settings');
        echo '<script type="text/javascript" async>
                document.addEventListener("gdprCookiesEnabled", function (e) {
                if(e.detail.performance) { 
                    '.htmlspecialchars_decode($script['sb_performance_scripts_body']).'
                }
            });
            </script>';
        echo '<script type="text/javascript" async>
                document.addEventListener("gdprCookiesEnabled", function (e) {
                if(e.detail.analytics) { 
                    '.htmlspecialchars_decode($script['sb_analytics_scripts_body']).'
                }
            });
            </script>';
        echo '<script type="text/javascript" async>
                document.addEventListener("gdprCookiesEnabled", function (e) {
                if(e.detail.marketing) { 
                    '.htmlspecialchars_decode($script['sb_marketing_scripts_body']).'
                }
            });
            </script>';
    }
}
new sb_gdpr_setup();