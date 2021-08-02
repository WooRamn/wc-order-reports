<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       
 * @since      1.0.0
 *
 * Woo Order Reports
 */

if(!defined('ABSPATH')){
	exit; // Exit if accessed directly
}
if(!class_exists('WOR_Download_Helper')):
	require_once( 'class-wor-helper.php');
	class WOR_Download_Helper extends WOR_Helper{

	}
endif; // class_exists