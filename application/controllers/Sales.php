<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Sales extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	public function flat($fromDate = FALSE, $toDate = FALSE) {
		$this->load->model ( DEFAULT_MODEL . '/sales_model' );
		$data ['salesFlat'] = $this->sales_model->getSales ( $fromDate, $toDate );
		echo (json_encode ( $data ));
	}
}
