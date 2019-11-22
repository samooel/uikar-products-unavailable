<?php 
/*
 * Plugin Name:  wp make products out of stock
 * Plugin URI: https://www.uikar.com
 * Description: this plugin gives you an ability to change all of you woocommerce products in stock or out of stock.
 * Version: 1.0
 * Author: Saman Tohidian
 * Author URI: https://www.uikar.com
 * Text Domain: uikar-unavailable
 * Domain Path: /languages/
 *
 */
define('UIKAR_UNAVAILABLE_BUILDER_DIR', plugin_dir_path(__FILE__));
define('UIKAR_UNAVAILABLE_BUILDER_URL', plugin_dir_url(__FILE__));

//require_once(UIKAR_UNAVAILABLE_BUILDER_DIR.'includes/functions.php');

register_activation_hook(__FILE__, 'uirg_builder_activation');
//register_deactivation_hook(__FILE__, 'uikar_form_builder_deactivation');
 
function uiua_Builder_load() {

    if (is_admin()) { //load admin files only in admin
        require_once(UIKAR_UNAVAILABLE_BUILDER_DIR . 'includes/admin.php');
    }
}

uiua_Builder_load();

add_action('plugins_loaded', 'uiua_load_textdomain');
function uiua_load_textdomain() {
	load_plugin_textdomain( 'uikar-unavailable', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}





?>