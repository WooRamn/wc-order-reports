<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       
 * @since      1.0.0
 *
 * @package    Wc_Order_Reports
 * @subpackage Wc_Order_Reports/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Order_Reports
 * @subpackage Wc_Order_Reports/admin
 * @author     Wooramn <wooramn.plugin@gmail.com>
 */
if(!defined('ABSPATH')){
	exit; // Exit if accessed directly
}

if(!class_exists('Wc_Order_Reports_Admin')):
class Wc_Order_Reports_Admin{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	protected $wor_url;
	protected $screen_id;
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->wor_url = "admin.php?page=".$plugin_name;
		$this->screen_id = isset($_GET['page'])?$_GET['page']:"";
		add_action( 'wor_header', array($this,'start_page_contener'), 10);
		add_action( 'wor_header', array($this,'add_page_tabs'), 20);
		add_action( 'wor_footer', array($this,'end_page_contener'), 10);
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function wor_enqueue_styles() {
		if(str_contains($this->screen_id,"wc-order-reports")){
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-order-reports-admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function wor_enqueue_scripts() {		
		if(str_contains($this->screen_id,"wc-order-reports")){
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-order-reports-admin.js', array( 'jquery' ), $this->version, false );
		}
	}
	/**
	 * Add Menu for the admin area.	 *
	 * @since    1.0.0
	 */
	public function wor_admin_menu(){
		add_menu_page(
      'WO Reports', 'WC Order Reports', 'manage_options', "wc-order-reports", array($this, 'show_page'), plugin_dir_url(__FILE__) . 'images/logo-icon.png', 56
  	);
  	add_submenu_page('wc-order-reports', 'Order Overview', 'Order Overview', 'manage_options', 'wc-order-reports' );
  	add_submenu_page('wc-order-reports', 'Download', 'Download', 'manage_options', 'wc-order-reports-download', array($this, 'show_page'));
	}
	public function start_page_contener(){
		echo '<div class="wrap wor-main-contener">';
	}
	public function end_page_contener(){
		echo '</div>';
	}
 /* add active tab class */
  protected function is_active_tabs($tab_name=""){
    if($tab_name!="" && isset($_GET['page']) && $_GET['page'] == $tab_name){
      return "tab-current";
    }
  }
	public function add_page_tabs(){
		?>
		<div class="tabs wor-tabs">
			<nav>
				<ul>
					<li class="<?php echo $this->is_active_tabs("wc-order-reports"); ?>"><a href="<?php echo $this->wor_url; ?>" class="icon icon-home"><span>Order Overview</span></a></li>
					<li class="<?php echo $this->is_active_tabs('wc-order-reports-download'); ?>"><a href="<?php echo $this->wor_url.'-download'; ?>" class="icon icon-download"><span>Download Reports</span></a></li>
				</ul>
			</nav>
		</div>
		<?php
	}
	/**
	 * Load page for the admin area.	 *
	 * @since    1.0.0
	 */
	public function show_page() {
		$get_action = "wc_order_reports";
   	if(isset($_GET['page'])) {
      $get_action = str_replace("-", "_", $_GET['page']);
    }
     //echo $get_action ='get_'.$get_action.'_page';
    if(method_exists($this, $get_action)){
      $this->$get_action();
    }
  }

  /**
	 * Load dashboard page for the admin area.	 *
	 * @since    1.0.0
	 */
  public function wc_order_reports(){
  	require_once( 'partials/class-wc-order-reports.php');
  	new WOR_Dashboard();
  }
  /**
	 * Load dashboard page for the admin area.	 *
	 * @since    1.0.0
	 */
  public function wc_order_reports_download(){
  	require_once( 'partials/class-wc-order-reports-download.php');
  	new WOR_Download();
  }
	/**
	 * Add for language translations.	 *
	 * @since    1.0.0
	 */
	public function wor_translations(){
		$locale ="";
		if ( function_exists( 'determine_locale' ) ) { // WP5.0+
			$locale = determine_locale();
		} else {
			$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		}
		load_plugin_textdomain( 'wc-order-reports', false, dirname( plugin_basename(__FILE__) ) . '/languages' );
	}
} //Wc_Order_Reports_Admin
endif; // class_exists