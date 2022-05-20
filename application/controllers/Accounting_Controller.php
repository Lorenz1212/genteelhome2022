<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_Controller extends CI_Controller 
{ 
	public function __construct(){
      parent::__construct();
      $this->load->model('Accounting_model');
    }
	public function Controller(){
		$action = $this->input->post('data1');
		switch($action){
			case "project-monitoring":{
				$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
				$val = $this->input->post('data3')??$this->invalidMissing_Input('Missing value');
				$val1 = $this->input->post('data4')??false;
				$model_response = $this->Accounting_model->Reports_Projectmonitoring($type,$val,$val1);
	            $data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
               echo json_encode($data);
               break;
			}
		}
    }
    public function Action(){
		$action = $this->input->post('action');
		switch($action){
			case "project-monitoring":{
				$type = $this->input->post('type')??$this->invalidMissing_Input('Missing request type');
				$customer = $this->input->post('customer')??$this->invalidMissing_Input('Customer is required');
				$address = $this->input->post('address')??$this->invalidMissing_Input('Address is required');
				$amount = $this->input->post('amount')??$this->invalidMissing_Input('Amount is required');
				$labor = $this->input->post('labor')??$this->invalidMissing_Input('Labor is required');
				$start = $this->input->post('start')??$this->invalidMissing_Input('Start date is required');
				$end = $this->input->post('end')??$this->invalidMissing_Input('End date is required');
				$id = $this->input->post('id')??false;
				$model_response = $this->Accounting_model->Submit_Report_Projectmontoring($type,$customer,$address,$amount,$labor,$start,$end,$id);
	            $data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
               echo json_encode($data);
               break;
			}
		}
    }
    public function invalidMissing_Input($message){
          $data = array(
              'status' => 'failed',
              'message' => $message,
              'payload' => ''
           );
           echo json_encode($data);
           exit();
    }
}
?>