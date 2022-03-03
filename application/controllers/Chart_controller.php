<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_controller extends CI_Controller 
{ 
	public function __construct(){
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('Chart_model');
    }
	 public function Fetch_Options(){
	 	$type = $this->input->post('type');
	 	$option = $this->input->post('option');
	 	$data = $this->Chart_model->Fetch_Options($type,$option);
	 	echo json_encode($data);
	 }
	 public function Fetch_Chart(){
	 	$type = $this->input->post('type');
	 	$option = $this->input->post('option');
	 	$month = $this->input->post('month');
	 	$year = $this->input->post('year');
	 	$data = $this->Chart_model->Fetch_Chart($type,$option,$year,$month);
	 	echo json_encode($data);
	 }
}
?>