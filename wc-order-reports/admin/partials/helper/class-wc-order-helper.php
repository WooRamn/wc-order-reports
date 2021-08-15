<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       
 * @since      1.0.0
 *
 * Order Reports for WooCommerce
 */

if(!defined('ABSPATH')){
	exit; // Exit if accessed directly
}
if(!class_exists('WC_Order_Helper')):
	class WC_Order_Helper {
		protected $currency_symbol;
		public function get_val_from_obj($obj, $key, $prefix = null){
			if(isset($obj[$key]) && $obj[$key]){
				return esc_attr($prefix.$obj[$key]);
			}else{
				return esc_attr($prefix."0");
			}
		}

		public function get_woocommerce_currency_symbol(){
			if(!empty($this->user_currency_symbol)){
				return $this->user_currency_symbol;
			}else{
				$code = get_woocommerce_currency();
				return get_woocommerce_currency_symbol($code);
			}
		}

		public function get_order_status_info($obj, $key){
			$obj = isset($obj[$key])?$obj[$key]:"";
			$currency = $this->get_woocommerce_currency_symbol();
			$display  = array('order_total'=>"Total sale",'line_subtotal'=>"Net sale", 'line_qty'=>"Quantity",'discount_amount'=>'Discount', 'refund_amount'=>'Refund','order_tax' =>"Order TAX",'order_shipping_tax' =>"Shipping TAX",'shipping' => "Shipping");
			$html = "<ul>";
			foreach ($display as $key => $value) {
				if($key != "line_qty"){
					$html .= "<li><label>".$value."</label>".$this->get_val_from_obj($obj, $key,$currency)."</li>";
				}else{
					$html .= "<li><label>".$value."</label>".$this->get_val_from_obj($obj, $key)."</li>";
				}
			}
			return $html .="</ul>";
		}
	}
endif; // class_exists