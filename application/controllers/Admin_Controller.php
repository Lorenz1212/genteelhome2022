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
			  	case "inspection-stocks":{
					$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$val1 = $this->input->post('data4')??false;
					$val2 = $this->input->post('data5')??false;
					$model_response = $this->Admin_model->Inspection_Stocks($type,$val,$val1,$val2);
		            $data = array(
		                 'status' => 'success',
		                 'message' => 'request accepted',
		                 'payload' => base64_encode(json_encode($model_response))
		            );
	           		echo json_encode($data);
			        break;
			  	}
			  	case "inspection-project":{
					$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$val1 = $this->input->post('data4')??false;
					$val2 = $this->input->post('data5')??false;
					$model_response = $this->Admin_model->Inspection_Project($type,$val,$val1,$val2);
		            $data = array(
		                 'status' => 'success',
		                 'message' => 'request accepted',
		                 'payload' => base64_encode(json_encode($model_response))
		            );
	           		echo json_encode($data);
			        break;
			  	}
			  	case "users":{
			  		$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
						$val = $this->input->post('data3')??false;
						$model_response = $this->Admin_model->User_List($type,$val);
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
				case "submit_users":{
					$type = $this->input->post('type')??$this->invalidMissing_Input('Missing request type');
					$id = $this->input->post('id')??false;
					$fname = $this->input->post('fname')??$this->invalidMissing_Input('Firstname is required');
					$lname = $this->input->post('lname')??$this->invalidMissing_Input('Middlename is required');
					$mname = $this->input->post('mname')??false;
					$role = $this->input->post('role')??false;
					$username = $this->input->post('username')??$this->invalidMissing_Input('Username is required');
					if($username){
						$result = $this->Admin_model->Check_User('username',$username);
						if($result == true){
							 $this->invalidMissing_Input('Username is already existing');
						}else{
							$username = $this->input->post('username')??$this->invalidMissing_Input('Username is required');
						}
					}
					$email = $this->input->post('email')??$this->invalidMissing_Input('Email is required');
					if($email){
						$result = $this->Admin_model->Check_User('email',$email);
						if($result == true){
							 $this->invalidMissing_Input('Email is already existing');
						}else{
							$email = $this->input->post('email')??$this->invalidMissing_Input('Email is required');
						}
					}
					$password = $this->input->post('password')??false;
					$email = $this->input->post('email')??false;
					$model_response = $this->Admin_model->Submit_Users($type,$id,$fname,$lname,$mname,$role,$username,$password,$email);
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