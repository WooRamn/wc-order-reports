<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              
 * @since             1.0.0
 * @package           Wc_Order_Reports
 *
 * @wordpress-plugin
 * Plugin Name:       Order Reports for WooCommerce
 * Plugin URI:        https://wordpress.org/plugins/wc-order-reports
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Requires at least: 4.4.0
 * Tested up to: 5.7
 * WC requires at least:    3.0.0
 * WC tested up to:         5.3.0
 * Author:            Ramnik Chavda
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-order-reports
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 * WOO ORDER REPORTS => WOR
 */
define( 'Wc_Order_Reports_VERSION', '1.0.0' );
if ( ! defined( 'WOR_PLUGIN_DIR' ) ) {
    define( 'WOR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'WOR_PLUGIN_URL' ) ) {
    define( 'WOR_PLUGIN_URL', plugins_url() . '/wc-order-reports' );
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-order-reports-activator.php
 */
function activate_wc_order_reports() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-order-reports-activator.php';
	Wc_Order_Reports_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-order-reports-deactivator.php
 */
function deactivate_wc_order_reports() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-order-reports-deactivator.php';
	Wc_Order_Reports_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Wc_Order_Reports' );
register_deactivation_hook( __FILE__, 'deactivate_Wc_Order_Reports' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-order-reports.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_order_reports() {

	$plugin = new Wc_Order_Reports();
	$plugin->run();

}
run_wc_order_reports();
