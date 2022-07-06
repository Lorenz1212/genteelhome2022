<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creative_Controller extends CI_Controller 
{ 
	public function __construct(){
      parent::__construct();
      $this->load->model('Creative_model');
    }
	public function Controller(){
			$action = $this->input->post('data1');
			switch($action){
				case "profile":{
					$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$val1 = $this->input->post('data4')??false;
					$image = isset($_FILES["data5"]["name"]) ? $_FILES["data5"]["name"]:false;
			    $tmp  =  isset($_FILES["data5"]["tmp_name"]) ? $_FILES["data5"]["tmp_name"]:false;
					$model_response = $this->Creative_model->Profile($type,$val,$val1,$image,$tmp);
		            $data = array(
		                 'status' => 'success',
		                 'message' => 'request accepted',
		                 'payload' => base64_encode(json_encode($model_response))
		            );
	        echo json_encode($data);
					break;
				}
				case "design-stocks":{
					$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$model_response = $this->Creative_model->Design_Stocks($type,$val);
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
					$model_response = $this->Creative_model->Design_Project($type,$val);
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
				case "design-stocks":{
					$type = $this->input->post('type')??$this->invalidMissing_Input('Missing request type');
					$title = $this->input->post('title')??$this->invalidMissing_Input('Item is required');
					$pallet_name = $this->input->post('pallet_name')??$this->invalidMissing_Input('Pallet name is required');
					$image = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
			    $tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
			    $docs = isset($_FILES["docs"]["name"]) ? $_FILES["docs"]["name"]:false;
			    $docs_tmp = isset($_FILES["docs"]["tmp_name"]) ? $_FILES["docs"]["tmp_name"]:false;
			    $pallet_image = isset($_FILES["pallet"]["name"]) ? $_FILES["pallet"]["name"]:false;
			    $pallet_tmp  =  isset($_FILES["pallet"]["tmp_name"]) ? $_FILES["pallet"]["tmp_name"]:false;
					$id = $this->input->post('id')??false;
					$model_response = $this->Creative_model->Submit_Design_Stocks($type,$title,$pallet_name,$image,$tmp,$docs,$docs_tmp,$pallet_image,$pallet_tmp,$id);
		            $data = array(
		                 'status' => 'success',
		                 'message' => 'request accepted',
		                 'payload' => base64_encode(json_encode($model_response))
		            );
           echo json_encode($data);
           break;
				}
				case "design-project":{
					$type = $this->input->post('type')??$this->invalidMissing_Input('Missing request type');
					$title = $this->input->post('title')??$this->invalidMissing_Input('Title is required');
					$image = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
			    $tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
			    $docs = isset($_FILES["docs"]["name"]) ? $_FILES["docs"]["name"]:false;
			    $docs_tmp = isset($_FILES["docs"]["tmp_name"]) ? $_FILES["docs"]["tmp_name"]:false;
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