<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_controller extends CI_Controller 
{ 
    public function __construct()
    {
      parent::__construct();
      $this->load->helper('url'); 
      $this->load->model('view_model');
      $this->load->library('session');
    }
    public function View_Profile(){
        $id = $this->session->userdata('id');
        $data = $this->view_model->View_Profile($id);
        echo json_encode($data);
    }
    public function View_SO_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_SO_Data($id);
        echo json_encode($data);
    }
    public function View_Inspection_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Inspection_Data($id);
        echo json_encode($data);
    }
    public function View_Joborder_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Joborder_Data($id);
        echo json_encode($data);
    }
    public function View_Return_Item_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Return_Item_Data($id);
        echo json_encode($data);
    }
    public function View_MaterialUsed_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_MaterialUsed_Data($id);
        echo json_encode($data);
    }
    public function View_Project_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Project_Data($id);
        echo json_encode($data);
    }
    public function View_Project_Process_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Project_Process_Data($id);
        echo json_encode($data);
    }
    public function View_Purchase_Stocks_Process(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Purchase_Stocks_Process($id);
        echo json_encode($data);
    }
    public function View_Material_Request_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Material_Request_Data($id);
        echo json_encode($data);
    }
    public function View_Officesupplies_Request_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Officesupplies_Request_Data($id);
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
    public function View_Delivery_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Delivery_Data($id);
        echo json_encode($data);
     }
    public function View_Delivery_Stocks_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Delivery_Stocks_Data($id);
        echo json_encode($data);
     }
    public function View_Officesupplier_Request_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Officesupplier_Request_Data($id);
        echo json_encode($data);
    }
    public function View_Spareparts_Request_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_Spareparts_Request_Data($id);
        echo json_encode($data);
    }
    public function View_SalesOrder_Data(){
        $id = $this->input->post('id');
        $data = $this->view_model->View_SalesOrder_Data($id);
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
    public function View_OnlineOrder(){
       $id = $this->input->post('id');
       $data = $this->view_model->View_OnlineOrder($id);
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
   
   
}
?>
