<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Customers extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	public function getAll() {
		$this->load->model ( DEFAULT_MODEL . '/customer_model' );
		$data ['customers'] = $this->customer_model->getCustomers ();
		echo (json_encode ( $data ));
	}
}
