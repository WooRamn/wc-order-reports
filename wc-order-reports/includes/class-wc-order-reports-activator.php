<?php

/**
 * Fired during plugin activation
 *
 * @link       
 * @since      1.0.0
 *
 * @package    Wc_Order_Reports
 * @subpackage Wc_Order_Reports/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wc_Order_Reports
 * @subpackage Wc_Order_Reports/includes
 * @author     Wooramn <wooramn.plugin@gmail.com>
 */
class Wc_Order_Reports_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if (!is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
      wp_die('Hey, It seems WooCommerce plugin is not active on your wp-admin. Woo Order Reports plugin can only be activated if you have active WooCommerce plugin in your wp-admin. <br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>');
    }
	}
}