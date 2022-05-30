<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller 
{ 
	public function __construct(){
      parent::__construct();
      $this->load->model('Admin_model');
    }
	public function Controller(){
			$action = $this->input->post('data1');
			switch($action){
				case "design-stocks":{
					$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$val1 = $this->input->post('data4')??false;
					$val2 = $this->input->post('data5')??false;
					$model_response = $this->Admin_model->Design_Stocks($type,$val,$val1,$val2);
		            $data = array(
		                 'status' => 'success',
		                 'message' => 'request accepted',
		                 'payload' => base64_encode(json_encode($model_response))
		            );
	           		echo json_encode($data);
			        break;
			  	}
				case "design-project":{
					$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$val1 = $this->input->post('data4')??false;
					$val2 = $this->input->post('data5')??false;
					$model_response = $this->Admin_model->Design_Project($type,$val,$val1,$val2);
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
				case "design-project":{
					$type = $this->input->post('type')??$this->invalidMissing_Input('Missing request type');
					$title = $this->input->post('title')??$this->invalidMissing_Input('Title is required');
					$image   =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
			        $tmp   =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
			        $docs   =  isset($_FILES["docs"]["name"]) ? $_FILES["docs"]["name"]:false;
			        $docs_tmp  =  isset($_FILES["docs"]["tmp_name"]) ? $_FILES["docs"]["tmp_name"]:false;
					$id = $this->input->post('id')??false;
					$model_response = $this->Creative_model->Submit_Design_Project($type,$title,$image,$tmp,$docs,$docs_tmp,$id);
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