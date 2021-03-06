<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete_controller extends CI_Controller 
{ 
    public function __construct()
    {
      parent::__construct();
      $this->load->model('delete_model');
    }
     
    public function Delete_Web_Project_Image(){
        $id = $this->input->post('id');    
        $data = $this->delete_model->Delete_Web_Project_Image($id);
        echo json_encode($data);
    }
    public function Delete_Web_Project_Gallery(){
        $id = $this->input->post('id');    
        $this->delete_model->Delete_Web_Project_Gallery($id);
        $data = array('status' => 'success','id' => $id);
        echo json_encode($data);
    }
     public function Delete_Web_Cart(){
        $id = $this->input->post('id');    
        $this->delete_model->Delete_Web_Cart($id);
        $data = array('status' => 'success','id' => $id);
        echo json_encode($data);
    }
     public function Delete_Collection(){
        $id = $this->input->post('id');    
        $this->delete_model->Delete_Collection($id);
        $data = array('status' => 'success');
        echo json_encode($data);
    }
    public function Delete_Web_Interior_Image(){
        $id = $this->input->post('id');    
        $this->delete_model->Delete_Web_Interior_Image($id);
        $data = array('status' => 'success',
                      'id'     => $id);
        echo json_encode($data);
    }
    public function Delete_Cash_Position(){
        $id = isset($_POST['id'])? $this->input->post('id'): false;
        $this->delete_model->Delete_Cash_Position($id);
        $data = array('status' => 'success');
        echo json_encode($data);
    }
    public function Delete_Testimony(){
        $id = isset($_POST['id'])? $this->input->post('id'): false;
        $data = $this->delete_model->Delete_Testimony($id);
        echo json_encode($data);
    }
    public function Delete_Inspection_Image(){
        $id = isset($_POST['id'])? $this->input->post('id'): false;
        $data = $this->delete_model->Delete_Inspection_Image($id);
        echo json_encode($data);
    }
    public function Delete_Material_Request_Supervisor(){
        $id =  $this->input->post('id');
        $data = $this->delete_model->Delete_Material_Request_Supervisor($id);
        echo json_encode($data);
    }
    public function Delete_Purchase_Request_Supervisor(){
        $id =  $this->input->post('id');
        $data = $this->delete_model->Delete_Purchase_Request_Supervisor($id);
        echo json_encode($data);
    }
    public function Delete_Purchased_Transaction(){
        $fund_no =  $this->input->post('fund_no');
        $id =  $this->input->post('id');
        $data = $this->delete_model->Delete_Purchased_Transaction($fund_no,$id);
        echo json_encode($data);
    }
    public function Delete_Purchased_Transaction_Inventory(){
        $fund_no =  $this->input->post('fund_no');
        $id =  $this->input->post('id');
        $data = $this->delete_model->Delete_Purchased_Transaction_Inventory($fund_no,$id);
        echo json_encode($data);
    }
}
?>
