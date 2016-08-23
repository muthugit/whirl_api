<?php
class Customer_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getCustomers() {
		$this->db->select ('entity_id as customerId,
				email');
		$this->db->from ( 'customer_entity' );
		$query = $this->db->get ();
		return $query->result ();
	}
}
