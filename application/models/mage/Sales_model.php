<?php
class Sales_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getSales($fromDate = false, $toDate = false) {
		ini_set ( 'memory_limit', '-1' );
		$this->db->select ( 'sales_flat_order.entity_id as orderId, 
				sales_flat_order.state as status, 
				sales_flat_order.shipping_method as shippingMethod, 
				sales_flat_order.store_currency_code as currency,
				sales_flat_order.store_name as storeName,
				sales_flat_order.shipping_amount as shippingCharge,
				sales_flat_order.updated_at as lastUpdated,
				sales_flat_order.total_qty_ordered as totalQty,
				sales_flat_order.tax_amount as totalTax,
				sales_flat_order.customer_id as customerId,
				sales_flat_order_address.city as orderCity,
				sales_flat_order_address.address_type as addressType,
				sales_flat_order_address.postcode as postalCode,
				sales_flat_order_address.country_id as countryCode' );
		$this->db->join ( 'sales_flat_order_address', 'sales_flat_order_address.parent_id=sales_flat_order.entity_id' ,'left outer');
		if ($fromDate != "" && $fromDate != null && $fromDate != 'all') {
			$this->db->where ( 'sales_flat_order.updated_at >=', $fromDate );
		}
		
		$this->db->where('address_type','billing');
		
		if ($toDate != "today") {
			$newToDate = strtotime ( '+1 day', strtotime ( $toDate ) );
			$newToDate = date ( 'Y-m-j', $newToDate );
			$this->db->where ( 'sales_flat_order.updated_at <=', $newToDate );
		}
		$this->db->from ( 'sales_flat_order' );
		$query = $this->db->get ();
		return $query->result ();
	}
}
