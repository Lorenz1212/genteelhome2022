<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller 
{ 
    public function __construct()
    {
      parent::__construct();
      $this->load->helper('url'); 
      $this->load->model('dashboard_model');
      $this->load->library('session');
    }
    public function designer_dashboard(){  
        $id = $this->session->userdata('id');
        $data = $this->dashboard_model->designer_dashboard($id);
        echo json_encode($data);
    } 
    public function production_dashboard(){  
        $id = $this->session->userdata('id');
        $data = $this->dashboard_model->production_dashboard($id);
        echo json_encode($data);
    }
    public function sales_dashboard(){ 
        $id = $this->session->userdata('id'); 
        $data = $this->dashboard_model->sales_dashboard($id);
        echo json_encode($data);
    } 
    public function admin_dashboard(){  
    	$data = $this->dashboard_model->admin_dashboard();
        echo json_encode($data);
    } 
    public function superuser_dashboard(){  
        $data = $this->dashboard_model->superuser_dashboard();
        echo json_encode($data);
    }
    public function accounting_dashboard(){ 
        $id = $this->session->userdata('id'); 
        $data = $this->dashboard_model->accounting_dashboard($id);
        echo json_encode($data);
    }  
    
}
?>