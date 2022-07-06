<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webmodifier_Controller extends CI_Controller{ 
	public function __construct(){
      parent::__construct();
      $this->load->model('Webmodifier_model');
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
			case "product":{
    			$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$val1 = $this->input->post('data4')??false;
					$val2 = $this->input->post('data5')??false;
					$val3 = $this->input->post('data6')??false;
					$image = isset($_FILES["data7"]["name"]) ? $_FILES["data7"]["name"]: false;
			    $tmp = isset($_FILES["data7"]["tmp_name"]) ? $_FILES["data7"]["tmp_name"]:false;
					$model_response = $this->Webmodifier_model->Product_List($type,$val,$val1,$val2,$val3,$image,$tmp);
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
    		case "category":{
    			$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$val1 = $this->input->post('data4')??false;
					$image = isset($_FILES["data5"]["name"]) ? $_FILES["data5"]["name"]: false;
			    $tmp = isset($_FILES["data5"]["tmp_name"]) ? $_FILES["data5"]["tmp_name"]:false;
					$model_response = $this->Webmodifier_model->Category_List($type,$val,$val1,$image,$tmp);
				 	$data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
           		echo json_encode($data);
    			break;
    		}
    		case "banner":{
    			$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$model_response = $this->Webmodifier_model->Banner($type,$val);
				 	$data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
          echo json_encode($data);
    			break;
    		}
    		case "interiors":{
    			$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$model_response = $this->Webmodifier_model->Interiors($type,$val);
				 	$data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
          echo json_encode($data);
    			break;
    		}
    		case "events":{
    			$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$model_response = $this->Webmodifier_model->Events($type,$val);
				 	$data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
          echo json_encode($data);
    			break;
    		}
    		case "lookbook":{
    			$type = $this->input->post('data2')??$this->invalidMissing_Input('Missing Type');
					$val = $this->input->post('data3')??false;
					$val1 = $this->input->post('data4')??false;
					$model_response = $this->Webmodifier_model->Lookbook($type,$val,$val1);
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
				case"banner":{
					$type = $this->input->post('type')??$this->invalidMissing_Input('Missing Type');
					$id = $this->input->post('id')??false;
					$title = $this->input->post('title')??false;
					$sub_title = $this->input->post('sub_title')??false;
					$slide = $this->input->post('slide')??false;
					$image = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
			    $tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
					$model_response = $this->Webmodifier_model->Submit_Banner($type,$id,$title,$sub_title,$slide,$image,$tmp);
				 	$data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
          echo json_encode($data);
					break;
				}
				case"interior":{
					$type = $this->input->post('type')??$this->invalidMissing_Input('Missing Type');
					$id = $this->input->post('id')??false;
					$project_name = $this->input->post('project_name')??false;
					$description = $this->input->post('description')??false;
					$cat_id = $this->input->post('cat_id')??false;
					$image = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
			    $tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
			    $bg_image = isset($_FILES["bg_image"]["name"]) ? $_FILES["bg_image"]["name"]: false;
			    $bg_tmp = isset($_FILES["bg_image"]["tmp_name"]) ? $_FILES["bg_image"]["tmp_name"]:false;
					$model_response = $this->Webmodifier_model->Submit_Interior($type,$id,$project_name,$description,$cat_id,$image,$tmp,$bg_image,$bg_tmp);
				 	$data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
          echo json_encode($data);
					break;
				}
				case"events":{
					$type = $this->input->post('type')??$this->invalidMissing_Input('Missing Type');
					$id = $this->input->post('id')??false;
					$title = $this->input->post('title')??false;
					$description = $this->input->post('description')??false;
					$date_event = date('Y-m-d',strtotime($this->input->post('date_event')))??false;
					$image = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
			    $tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
					$model_response = $this->Webmodifier_model->Submit_Events($type,$id,$title,$description,$date_event,$image,$tmp);
				 	$data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
          echo json_encode($data);
					break;
				}
				case"testimony":{
					$type = $this->input->post('type')??$this->invalidMissing_Input('Missing Type');
					$id = $this->input->post('id')??false;
					$name = $this->input->post('name')??false;
					$description = $this->input->post('description')??false;
					$image = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
			    $tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
					$model_response = $this->Webmodifier_model->Submit_Testimony($type,$id,$name,$description,$image,$tmp);
				 	$data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
          echo json_encode($data);
					break;
				}
				case"product":{
					$type = $this->input->post('type')??$this->invalidMissing_Input('Missing Type');
					$id = $this->input->post('id')??false;
					$title = $this->input->post('title')??false;
					$pallet_name = $this->input->post('pallet_name')??false;
					$cat_id = $this->input->post('cat_id')??false;
					$sub_id = $this->input->post('sub_id')??false;
					$amount = floatval(str_replace(',', '', $this->input->post('amount')))??false;
					$image = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
			    $tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
			    $pallet_image = isset($_FILES["color"]["name"]) ? $_FILES["color"]["name"]: false;
			    $pallet_tmp = isset($_FILES["color"]["tmp_name"]) ? $_FILES["color"]["tmp_name"]:false;
			    $docs_image = isset($_FILES["docs"]["name"]) ? $_FILES["docs"]["name"]: false;
			    $docs_tmp = isset($_FILES["docs"]["tmp_name"]) ? $_FILES["docs"]["tmp_name"]:false;
					$model_response = $this->Webmodifier_model->Submit_Product($type,$id,$title,$pallet_name,$cat_id,$sub_id,$amount,$image,$tmp,$pallet_image,$pallet_tmp,$docs_image,$docs_tmp);
				 	$data = array(
	                 'status' => 'success',
	                 'message' => 'request accepted',
	                 'payload' => base64_encode(json_encode($model_response))
	            );
          echo json_encode($data);
					break;
				}
				case "lookbook":{
					$type = $this->input->post('type')??$this->invalidMissing_Input('Missing Type');
					$id = $this->input->post('id')??false;
					$title = $this->input->post('title')??false;
					$cat_id = $this->input->post('cat_id')??false;
					$image = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
			    $tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
					$model_response = $this->Webmodifier_model->Submit_Lookbook($type,$id,$title,$cat_id,$image,$tmp);
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