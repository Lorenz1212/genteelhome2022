<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webmodifier_Controller extends CI_Controller 
{ 
	public function __construct(){
      parent::__construct();
      $this->load->model('Webmodifier_model');
    }
	public function Controller(){
		$action = $this->input->post('data1');
		switch($action){
			case "product":{
    			$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
				$val = $this->input->post('data3')??false;
				$model_response = $this->Webmodifier_model->Product_List($type,$val);
				 $data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
           		echo json_encode($data);
    			break;
    		}
    		case "voucher":{
    			$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$model_response = $this->Webmodifier_model->Voucher_List($type,$val);
				 	$data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
           		echo json_encode($data);
    			break;
    		}
    		case "shipping":{
    			$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$model_response = $this->Webmodifier_model->Shipping_List($type,$val);
				 $data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
           		echo json_encode($data);
    			break;
    		}
    		case "testimony":{
    			$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$model_response = $this->Webmodifier_model->Testimony_List($type,$val);
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

			}
    }
    private function invalidMissing_Input($message){
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