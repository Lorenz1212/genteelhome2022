<?php defined('BASEPATH') OR exit('No direct script access allowed');
class View extends CI_Controller {
    function __construct(){
       parent::__construct();
    }
    public function accountingview($view='dashboard'){
        $view = explode('_', strtolower($view))[0];
        if($this->session->userdata('accountingview')){
             $this->load->view('admin/content');
             switch ($view){
                  case 'dashboard':{$this->session->set_userdata('accountingview',$view);break;}
                  case 'profile':{$this->session->set_userdata('accountingview',$view);break;}  
                  case 'employee':{$this->session->set_userdata('accountingview',$view);break;}  
                  case 'employee-info':{$this->session->set_userdata('accountingview',$view);break;}4
                  case 'reports-project-monitoring':{$this->session->set_userdata('accountingview',$view);break;}
                  default: {redirect(base_url().'view/accountingview/dashboard');break;} 
             }
        }else{
             redirect(base_url().'authentication/adminlogin');
        }
   }
    public function adminpage(){
        if($this->input->post('page')){
            $view = explode('_', strtolower($this->input->post('page')))[0];
            $this->load->view('admin/view/'.$view);
        }
    }
    public function logout(){
        $data = $this->session->userdata('adminview');
        foreach($data as $row => $rows_value){$this->session->unset_userdata($row);}
        delete_cookie($this->appinfo->sess_name().'_admin_user');
        delete_cookie($this->appinfo->sess_name().'_admin_auth');
        redirect(base_url().'authentication/adminlogin');
    }
}
?>