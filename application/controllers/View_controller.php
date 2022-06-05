<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_controller extends CI_Controller { 
    public function __construct()
    {
      parent::__construct();
      $this->load->model('view_model');
    }
    public function View_Profile(){
        $id = $this->session->userdata('id');
        $data = $this->view_model->View_Profile($id);
        echo json_encode($data);
    }
    public function View_Salesorder_Update(){
       $id = $this->input->post('id');
        $data = $this->view_model->View_Salesorder_Update($id);
        echo json_encode($data);
    }
    public function View_Joborder_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Joborder_Data($id);
        echo json_encode($data);
    }
  

    public function View_DesingProject_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_DesingProject_Data($id);
        echo json_encode($data);
    }
      public function View_Supplier_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Supplier_Data($id);
        echo json_encode($data);
     }


    public function View_Web_Company_Profile(){
       $id = $this->input->post('id');
       $data = $this->view_model->View_Web_Company_Profile($id);
       echo json_encode($data);  
    }
    public function View_Web_Owner_Profile(){
       $id = $this->input->post('id');
       $data = $this->view_model->View_Web_Owner_Profile($id);
       echo json_encode($data);  
    }
     public function View_Web_Voucher(){
       $id = $this->input->post('id');
       $data = $this->view_model->View_Web_Voucher($id);
       echo json_encode($data); 
    }
 
    public function View_Inpection_project(){
       $id = $this->input->post('id');
       $data = $this->view_model->View_Inpection_project($id);
       echo json_encode($data); 
    } 
    public function View_Inpection_Stocks(){
       $id = $this->input->post('id');
       $data = $this->view_model->View_Inpection_Stocks($id);
       echo json_encode($data); 
    } 
    public function View_Joborder_Material(){
        $id = $this->input->post('id');
       $data = $this->view_model->View_Joborder_Material($id);
       echo json_encode($data); 
    }
     public function View_Joborder_Purchase(){
        $id = $this->input->post('id');
       $data = $this->view_model->View_Joborder_Purchase($id);
       echo json_encode($data); 
    }
    public function View_Joborder_Request_Stocks(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Joborder_Request_Stocks($id);
        echo json_encode($data); 
    }
    public function View_Joborder_Request_Project(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Joborder_Request_Project($id);
        echo json_encode($data); 
    }
}
?>
