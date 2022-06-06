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
						$val = $this->input->post('data3')??false;
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
					case "sales-collection":{
						$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
						$val = $this->input->post('data3')??false;
						$val1 = $this->input->post('data4')??false;
						$val2 = $this->input->post('data5')??false;
						$model_response = $this->Accounting_model->Sales_Collection($type,$val,$val1,$val2);
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
	                 'payload' => base64_encode(json_encode($model_response)));
           echo json_encode($data);
           break;
				}
				case "project-monitoring-materials":{
					$type = $this->input->post('type')??$this->invalidMissing_Input('Missing request type');
					$id = $this->input->post('item')??$this->invalidMissing_Input('Material is required');
					$quantity_costing = $this->input->post('quantity_costing')??$this->invalidMissing_Input('Quantity costing is required');
					$cost = $this->input->post('cost')??$this->invalidMissing_Input('Unit price is required');
					$model_response = $this->Accounting_model->Submit_Report_Projectmontoring_Material($type,$id,$quantity_costing,$cost);
            $data = array(
                 'status' => 'success',
                 'message' => 'request accepted',
                 'payload' => base64_encode(json_encode($model_response))
            );
          echo json_encode($data);
					break;
				}
				case "sales-collection":{
						$type = $this->input->post('type')??$this->invalidMissing_Input('Missing request type');
						$firstname = $this->input->post('firstname')??$this->invalidMissing_Input('First name is required');
						$lastname = $this->input->post('lastname')??$this->invalidMissing_Input('Last name is required');
						$mobile = $this->input->post('mobile')??$this->invalidMissing_Input('Mobile no. is required');
						$email = $this->input->post('email')??$this->invalidMissing_Input('Email is required');
						$order_no = $this->input->post('order_no')??$this->invalidMissing_Input('Transaction No. is required');
						$order_no = $this->Accounting_model->Find($order_no);
						if($order_no !=false){
							$trans_no = $order_no;
						}else{
							$trans_no = $this->invalidMissing_Input('Transaction No. is invalid');
						}
						$date_deposite = date('Y-m-d',strtotime($this->input->post('date_deposite')))??$this->invalidMissing_Input('Date deposite n is required');
						$bank = $this->input->post('bank')??$this->invalidMissing_Input('Bank is required');
						$amount = $this->input->post('amount')??$this->invalidMissing_Input('Amount is required');
						$amount = floatval(str_replace(',', '', $amount));
						$image = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
			    	$tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
						$model_response = $this->Accounting_model->Submit_Sales_Collection($type,$firstname,$lastname,$mobile,$email,$amount,$trans_no,$date_deposite,$bank,$image,$tmp);
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