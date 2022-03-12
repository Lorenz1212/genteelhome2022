<?php
class Gh extends CI_Controller { 
    public function __construct(){
      parent::__construct();
      $this->load->helper('url'); 
      $this->load->library('session');
      $this->load->helper('cookie');
    }
    public function app_login(){
        $query =  $this->db->select("*")->from("tbl_customer_online")->where('email', $this->input->post('email'))->where('status',1)->get();
        $row = $query->row();
        if ($query->num_rows())  
         {    
                  if(md5($this->input->post('password')) == $row->password){
                           $data = array(  
                                  'userId'      => $row->id,
                                  'password'    => $row->password,
                                  'email'       => $row->email,
                                  'name'        => $row->lastname.' '.$row->firstname,
                                  'image'       => $row->image,
                                  'website_logged_in' => 1  
                           );    
                           $this->session->set_userdata($data); 
                           $data = array('status' => 'success');  
                           echo json_encode($data);
                  }else{
                    $data = array('status' => 'error');  
                    echo json_encode($data);
                  }     
            }else{
                $data = array('status' => 'no account');  
                echo json_encode($data);
           }           
    }
    public function app_logout(){
        $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value){$this->session->unset_userdata($row);}
        redirect(base_url().'gh/app/index');
    }

    public function App($view = null,$id = null, $name=null){
        if($view == null){$view1 = 'index';}else{$view1 = $view;}
        $data['id'] = base64_decode($id);
        $datas['name'] = base64_decode($name);
        $this->load->view('website/layouts/header.php');
        $this->load->view('website/layouts/navbar.php');
        if(!$this->session->userdata('userId')){
            switch ($view1) {
              case 'index':{$this->load->view('website/index.php');break;}
              case 'blogs':{$this->load->view('website/blogs.php');break;}
              case 'registration':{$this->load->view('website/registration.php');break;}
              case 'product-list':{$this->load->view('website/product_list.php');break;}
              case 'product-details':{$this->load->view('website/product_details.php');break;}
              case 'new-arrival':{$this->load->view('website/new_arrival.php');break;} 
              case 'in-stocks':{$this->load->view('website/in_stocks.php');break;} 
              case 'about':{$this->load->view('website/about.php');break;} 
              case 'interior':{$this->load->view('website/interior.php');break;}
              case 'article':{$this->load->view('website/article.php',$datas);break;}
              case 'interior-list':{$this->load->view('website/interior_list.php');break;}
              case 'events':{$this->load->view('website/events.php');break;}
              case 'contact':{$this->load->view('website/contact.php');break;}
              case 'service':{$this->load->view('website/service.php');break;}
              case 'privacy-policy':{$this->load->view('website/privacy.php');break;}
              case 'shipping':{$this->load->view('website/shipping.php');break;}
              case 'terms-conditions':{$this->load->view('website/terms.php');break;}
              case 'returns-exchange-policy':{$this->load->view('website/return_policy.php');break;}
              case 'forgot-password':{$this->load->view('website/forgot_password.php');break;}
              case 'new-password':{$this->load->view('website/new_password.php');break;}
              default: {redirect(base_url().'gh/app/index');break;} 
            }
        }else{
             switch ($view1) {
              case 'index':{$this->load->view('website/index.php');break;}
              case 'blogs':{$this->load->view('website/blogs.php');break;}
              case 'product-list':{$this->load->view('website/product_list.php');break;}
              case 'product-details':{$this->load->view('website/product_details.php');break;}
              case 'cart':{$this->load->view('website/cart.php');break;}
              case 'collection':{$this->load->view('website/collection.php');break;}
              case 'account':{$this->load->view('website/account.php');break;}
              case 'checkout':{$this->load->view('website/checkout.php');break;} 
              case 'new-arrival':{$this->load->view('website/new_arrival.php');break;} 
              case 'in-stocks':{$this->load->view('website/in_stocks.php');break;}
              case 'collection':{$this->load->view('website/collection.php');break;}  
              case 'about':{$this->load->view('website/about.php');break;} 
              case 'interior':{$this->load->view('website/interior.php');break;} 
              case 'article':{$this->load->view('website/article.php',$datas);break;} 
              case 'interior-list':{$this->load->view('website/interior_list.php');break;}
              case 'events':{$this->load->view('website/events.php');break;}
              case 'payment-deposit':{$this->load->view('website/payment_deposit.php');break;}
              case 'contact':{$this->load->view('website/contact.php');break;}
              case 'service':{$this->load->view('website/service.php');break;}
              case 'privacy-policy':{$this->load->view('website/privacy.php');break;}
              case 'shipping':{$this->load->view('website/shipping.php');break;}
              case 'terms-conditions':{$this->load->view('website/terms.php');break;}
              case 'returns-exchange-policy':{$this->load->view('website/return_policy.php');break;}
              default: {redirect(base_url().'gh/app/index');break;}
            }
        }
       
        $this->load->view('website/layouts/footer.php');
    }
    public function login(){
        if(!$this->session->userdata('currently_logged_in')){
            $status = $this->input->post('status');
            $this->db->select("*")
              ->from("tbl_users")
              ->where('username', $this->input->post('username'));
              $query = $this->db->get();  
              $row = $query->row();
              if ($query->num_rows())  
              {    
                  if(md5($this->input->post('password')) == $row->password){
                     if($status == 'designer'){
                         $page = $row->designer;
                      }else if($status == 'production'){
                         $page = $row->production;
                      }else if($status == 'supervisor'){
                          $page = $row->supervisor;
                      }else if($status == 'sales'){
                        $page = $row->sales;
                      }else if($status == 'superuser'){
                        $page = $row->superuser;
                      }else if($status == 'admin'){
                        $page = $row->admin;
                      }else if($status == 'webmodifier'){
                         $page = $row->webmodifier;
                      }else if($status == 'accounting'){
                         $page = $row->accounting;
                      }
                       if($page == 1){
                                $data = array(  
                                  'id'          => $row->id,
                                  'username'    => $row->username,  
                                  'password'    => $row->password,
                                  'email'       => $row->email,
                                  'fullname'    => $row->lastname.' '.$row->firstname,
                                  'letter'      => $row->firstname[0],
                                  'middlename'  => $row->middlename,
                                  'image'       => $row->image,
                                  'voucher'     => $row->coupon_status,
                                  'login'       => 1,
                                  'page'        => $status,
                                  'currently_logged_in' => 1);    
                           $this->session->set_userdata($data);
                           if(!$this->session->userdata('currently_logged_in')){ 
                              $this->load->view('login/login.php');
                           }else{ 
                               $url ='gh/'.$status.'/index' ;  
                               $data = array('url'    =>  $url,'status' => 'success');  
                               echo json_encode($data);
                           }
                       }else{
                             $data = array('status' => 'no access');  
                             echo json_encode($data);
                       }     
                  }else{
                    $data = array('status' => 'error');  
                    echo json_encode($data);
                  }     
              }else
              {
                    $this->load->view('login/login.php');
              }           
          }else{
              if(!$this->session->userdata('page')){
                $page = base_url().'gh/login';
              }else{
                $page = base_url().'gh/'.$this->session->userdata('page').'/index';
              }
              redirect($page);
          }
    }
     public function logout(){
        $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value)
        {
            $this->session->unset_userdata($row);
        }
        redirect(base_url().'gh/login');
    }

    public function Designer_login(){       
        if(!$this->session->userdata('currently_logged_in')){
           $query = $this->db->select("*")->from("tbl_users")->where('username', $this->input->post('username'))->get();
              $row = $query->row();
              if ($query->num_rows()){    
                  if(md5($this->input->post('password')) == $row->password){
                       if($row->designer == 1){
                        $data = array(  
                          'id'                  => $row->id,
                          'username'            => $row->username,  
                          'password'            => $row->password,
                          'email'               => $row->email,
                          'fullname'            => $row->lastname.' '.$row->firstname,
                          'letter'              => $row->firstname[0],
                          'middlename'          => $row->middlename,
                          'image'               => $row->image,
                          'voucher'             => $row->coupon_status,
                          'page'                => 'designer',
                          'currently_logged_in' => 1);    
                           $this->session->set_userdata($data);
                           if(!$this->session->userdata('currently_logged_in')){ 
                              $this->load->view('login/designer_login.php');
                           }else{ 
                               $url ='gh/designer/index' ;  
                               $data = array('url'    =>  $url,'status' => 'success');  
                               echo json_encode($data);
                           }
                       }else{
                             $data = array('status' => 'no access');  
                             echo json_encode($data);
                       }     
                  }else{
                    $data = array('status' => 'error');  
                    echo json_encode($data);
                  }     
              }else
              {
                    $this->load->view('login/login.php');
              }           
          }else{
              redirect(base_url().'gh/designer/index');
          }
            
    }
    public function designer($view = null,$id = null){
      if($this->session->userdata('currently_logged_in') == 1 && $this->session->userdata('page') == 'designer'){
        $data['id'] = base64_decode($id);
        $this->load->view('designer/layouts/header.php');
        $this->load->view('designer/layouts/navbar.php');
        switch ($view) {
          case 'index':{$this->load->view('designer/index.php');break;}
          case "project":{$this->load->view('designer/project_list.php'); break;}
          case "design-for-stocks":{$this->load->view('designer/design_stocks.php'); break;}
          case "design-for-project":{$this->load->view('designer/design_project.php'); break;}
          case "create-design-stocks":{$this->load->view('designer/design_stocks_create.php'); break;}
          case "create-design-pallet":{$this->load->view('designer/design_pallet_create.php',$data); break;}
          case "create-design-project":{$this->load->view('designer/design_project_create.php'); break;}
          case "material-received":{$this->load->view('designer/material_received.php',$data);break;}
          case "customization":{$this->load->view('designer/customization.php');break;}
          case "request-for-stocks":{$this->load->view('designer/request_for_stocks.php');break;}
          case "user_update":{$this->load->view('designer/user_update.php');break;}
          case "officesupplies-request":{$this->load->view('designer/officesupplies_request.php');break;}
          case "create-officesupplies-request":{$this->load->view('designer/officesupplies_create.php');break;}
          case "spare-request":{$this->load->view('designer/spare_request.php');break;}
          case "create-spare-request":{$this->load->view('designer/sparerequest_create.php');break;}
          case "online-preorder":{$this->load->view('designer/online_request.php');break;}
          case "voucher":{$this->load->view('designer/coupon_list.php');break;}
          case "joborder-stocks":{$this->load->view('designer/joborder-stocks.php'); break;}
          case "joborder-project":{$this->load->view('designer/joborder-project.php'); break;}
          case "joborder-create-stocks":{$this->load->view('designer/joborder-create-stocks.php');break;}
          case "joborder-create-project":{$this->load->view('designer/joborder-create-project.php');break;}
          case "joborder-update-stocks":{$this->load->view('designer/joborder-update-stocks.php');break;}
          case "joborder-update-project":{$this->load->view('designer/joborder-update-project.php');break;}
          default: {redirect(base_url().'gh/designer/index');break;}
        }
        $this->load->view('designer/layouts/footer.php');
      }else{
            redirect(base_url().'gh/login');
      }
    }
    public function designer_logout(){
        $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value){$this->session->unset_userdata($row);}
        redirect(base_url().'gh/login');
    }

    public function production_login(){
      if(!$this->session->userdata('currently_logged_in')){
            $this->db->select("*")->from("tbl_users")->where('username', $this->input->post('username'));
              $query = $this->db->get();  
              $row = $query->row();
              if ($query->num_rows()){          
                 if(md5($this->input->post('password')) == $row->password){
                       if($row->production == 1){
                        $data = array(  
                          'id'          => $row->id,
                          'username'    => $row->username,  
                          'password'    => $row->password,
                          'email'       => $row->email,
                          'fullname'    => $row->lastname.' '.$row->firstname,
                          'letter'      => $row->firstname[0],
                          'middlename'  => $row->middlename,
                          'image'       => $row->image,
                          'voucher'     => $row->coupon_status,
                          'page'        => 'production',
                          'currently_logged_in' => 1);    
                           $this->session->set_userdata($data);
                           if(!$this->session->userdata('currently_logged_in')){ 
                              $this->load->view('login/production_login.php');
                           }else{ 
                               $url ='gh/production/index' ;  
                               $data = array('url'    =>  $url,'status' => 'success');  
                               echo json_encode($data);
                           }
                       }else{
                             $data = array('status' => 'no access');  
                             echo json_encode($data);
                       }                  
                   }else{
                    $data = array('status' => 'error');  
                    echo json_encode($data);
                  }   
                  
              }else{$this->load->view('login/login.php');}           
          }else{redirect(base_url().'gh/production/index');}
    }
    public function production($view = null,$id = null){
       if($this->session->userdata('currently_logged_in') == 1 && $this->session->userdata('page') == 'production'){
          $this->load->view('production/layouts/header.php');
          $this->load->view('production/layouts/navbar.php');
          switch ($view) {
            case 'index':{$this->load->view('production/index.php');break;}
            case "joborder-stocks":{$this->load->view('production/joborder_stocks.php'); break;}
            case "joborder-project":{$this->load->view('production/joborder_project.php'); break;}
            case "salesorder-stocks":{$this->load->view('production/salesorder_stocks.php');break;}
            case "salesorder-project":{$this->load->view('production/salesorder_project.php');break;}
            case "salesorder-create-stocks":{$this->load->view('production/salesorder_create_stocks.php');break;}
            case "salesorder-create-project":{$this->load->view('production/salesorder_create_project.php');break;}

            
            case "officesupplies-request":{$this->load->view('production/officesupplies_request.php');break;}
            case "create-officesupplies-request":{$this->load->view('production/officesupplies_create.php');break;}
            case "spare-request":{$this->load->view('production/spare_request.php');break;}
            case "create-spare-request":{$this->load->view('production/sparerequest_create.php');break;}
            case "spareparts":{$this->load->view('production/spareparts_list.php');break;}
            case "officesupplies":{$this->load->view('production/officesupplies_list.php');break;}
            case "rawmaterials":{$this->load->view('production/rawmaterial_list.php');break;}
            case "finishproduct":{$this->load->view('production/finishproduct_list.php');break;}
            case "rawmaterials":{$this->load->view('production/rawmaterial_list.php'); break;}

            case "voucher":{$this->load->view('production/coupon_list.php');break;}
            case "user_update":{$this->load->view('production/user_update.php');break;}
            default: {redirect(base_url().'gh/production/index');break;}
          }
          $this->load->view('production/layouts/footer.php');
        }else{
            redirect(base_url().'gh/login');
        }
    }
    public function production_logout(){
        $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value){$this->session->unset_userdata($row);}
        redirect(base_url().'gh/login');
    }

    public function supervisor_login(){
       if(!$this->session->userdata('currently_logged_in')){
            $this->db->select("*")
              ->from("tbl_users")
              ->where('username', $this->input->post('username'));
              $query = $this->db->get();  
              $row = $query->row();
              if ($query->num_rows()){          
                    if(md5($this->input->post('password')) == $row->password){
                       if($row->supervisor == 1){
                        $data = array(  
                          'id'          => $row->id,
                          'username'    => $row->username,  
                          'password'    => $row->password,
                          'email'       => $row->email,
                          'fullname'    => $row->lastname.' '.$row->firstname,
                          'letter'      => $row->firstname[0],
                          'middlename'  => $row->middlename,
                          'image'       => $row->image,
                          'voucher'     => $row->coupon_status,
                          'page'        => 'supervisor',
                          'currently_logged_in' => 1  
                          );    
                           $this->session->set_userdata($data);
                           if(!$this->session->userdata('currently_logged_in')){ 
                              $this->load->view('login/supervisor_login.php');
                           }else{ 
                               $url ='gh/supervisor/index' ;  
                               $data = array('url'    =>  $url,'status' => 'success');  
                               echo json_encode($data);
                           }
                       }else{
                             $data = array('status' => 'no access');  
                             echo json_encode($data);
                       }
                  }else{
                    $data = array('status' => 'error');  
                    echo json_encode($data);
                  } 
              }else{$this->load->view('login/login.php');}           
          }else{redirect(base_url().'gh/supervisor/index');}
    }
     public function supervisor($view = null,$id = null){
       if($this->session->userdata('currently_logged_in') == 1 && $this->session->userdata('page') == 'supervisor'){
          $data['id'] = base64_decode($id);
          $this->load->view('supervisor/layouts/header.php');
          $this->load->view('supervisor/layouts/navbar.php');
          switch ($view) {
            case 'index':{$this->load->view('supervisor/index.php');break;}
            case "user_update":{$this->load->view('supervisor/user_update.php');break;}
            case "production-stocks":{$this->load->view('supervisor/production_stocks.php');break;}
            case "joborder-stocks":{$this->load->view('supervisor/joborder_stocks_list.php');break;}
            case "joborder-project":{$this->load->view('supervisor/joborder_project_list.php');break;}
            default: {redirect(base_url().'gh/supervisor/index');break;}
          }
          $this->load->view('supervisor/layouts/footer.php');
        }else{
             redirect(base_url().'gh/login');
        }
    }
    public function supervisor_logout(){
        $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value){$this->session->unset_userdata($row);}
        redirect(base_url().'gh/login');
    }
    public function superuser_login(){
       if(!$this->session->userdata('currently_logged_in')){
            $this->db->select("*")
              ->from("tbl_users")
              ->where('username', $this->input->post('username'));
              $query = $this->db->get();  
              $row = $query->row();
               if ($query->num_rows()){          
                     if(md5($this->input->post('password')) == $row->password){
                        if($row->superuser == 1){
                        $data = array(  
                          'id'          => $row->id,
                          'username'    => $row->username,  
                          'password'    => $row->password,
                          'email'       => $row->email,
                          'fullname'    => $row->lastname.' '.$row->firstname,
                          'letter'      => $row->firstname[0],
                          'middlename'  => $row->middlename,
                          'image'       => $row->image,
                          'voucher'     => $row->coupon_status,
                          'page'        => 'superuser',
                          'currently_logged_in' => 1  
                          );    
                           $this->session->set_userdata($data);
                           if(!$this->session->userdata('currently_logged_in')){ 
                              $this->load->view('login/superuser_login.php');
                           }else{ 
                               $url ='gh/superuser/index' ;  
                               $data = array('url'    =>  $url,'status' => 'success');  
                               echo json_encode($data);
                           }
                       }else{
                             $data = array('status' => 'no access');  
                             echo json_encode($data);
                       }
                  }else{
                    $data = array('status' => 'error');  
                    echo json_encode($data);
                  } 
              }else{$this->load->view('login/login.php');}           
          }else{redirect(base_url().'gh/superuser/index');}
    }
    public function superuser($view = null,$id = null){
        if($this->session->userdata('currently_logged_in') == 1 && $this->session->userdata('page') == 'superuser'){
          $data['id'] = $id;
          $this->load->view('reviewer/layouts/header.php');
          $this->load->view('reviewer/layouts/navbar.php');
          switch ($view) {
            case 'index':{$this->load->view('reviewer/index.php');break;}
            case "material-request-stocks":{$this->load->view('reviewer/material_request_stocks.php');break;}
            case "material-request-project":{$this->load->view('reviewer/material_request_project.php');break;}
            case "purchase-request-stocks":{$this->load->view('reviewer/purchase_request_stocks.php'); break;}
            case "purchase-request-project":{$this->load->view('reviewer/purchase_request_project.php'); break;}
            case "joborder-masterlist-stocks":{$this->load->view('reviewer/joborder_masterlist_stocks.php');break;}
            case "joborder-masterlist-project":{$this->load->view('reviewer/joborder_masterlist_project.php');break;}
            case "returnmaterial_request":{$this->load->view('reviewer/returnmaterial_request.php');break;}
            case "spareparts-request":{$this->load->view('reviewer/spareparts_request.php');break;}
            case "spareparts-request-update":{$this->load->view('reviewer/spareparts_request_update.php',$data);break;}
            case "officesupplies-request":{$this->load->view('reviewer/officesupplies_request.php');break;}
            case "officesupplies-request-update":{$this->load->view('reviewer/officesupplies_request_update.php',$data);break;}
            case "return-finishproduct":{$this->load->view('reviewer/return_finishproduct.php');break;}
            case "return-finishproduct-create":{$this->load->view('reviewer/return_finishproduct_create.php');break;}
            // case "purchase-stocks":{$this->load->view('reviewer/purchase_stocks.php');break;}
            // case "purchase-stocks-create":{$this->load->view('reviewer/purchase_stocks_create.php');break;}
            // case "purchase-stocks-process":{$this->load->view('reviewer/purchase_stocks_process.php',$data);break;}
            // case "purchase-request-process":{$this->load->view('reviewer/purchase_request_process.php',$data); break;}
            // case "purchase-request-update":{$this->load->view('reviewer/purchase_request_update.php',$data); break;}
            case "release":{$this->load->view('reviewer/release_finishproduct.php');break;}
            case "users":{$this->load->view('reviewer/user_list.php');break;}
            case "user_create":{$this->load->view('reviewer/user_create.php');break;}
            case "user_update":{$this->load->view('reviewer/user_update.php');break;}
            case "spareparts":{$this->load->view('reviewer/spareparts_list.php');break;}
            case "spareparts-create":{$this->load->view('reviewer/spareparts_add.php');break;}
            case "officesupplies-create":{$this->load->view('reviewer/officesupplies_add.php');break;}
            case "officesupplies":{$this->load->view('reviewer/officesupplies_list.php');break;}
            case "rawmaterials":{$this->load->view('reviewer/rawmaterial_list.php');break;}
            case "rawmaterials":{$this->load->view('reviewer/rawmaterial_list.php'); break;}
            case "rawmaterial_create":{$this->load->view('reviewer/rawmaterial_add.php'); break;}
            case "production-stocks":{$this->load->view('reviewer/production_stocks.php');break;}
            case "voucher":{$this->load->view('reviewer/coupon_list.php');break;}
            case "customer-concern":{$this->load->view('reviewer/service_request.php');break;}
            case "supplier":{$this->load->view('reviewer/supplier_list.php'); break;}
            case "supplier_view":{$this->load->view('reviewer/supplier_view.php',$data); break;}
            case "supplier_create":{$this->load->view('reviewer/supplier_add.php'); break;}
            default: {redirect(base_url().'gh/reviewer/index');break;}
          }
          $this->load->view('reviewer/layouts/footer.php');
        }else{
                redirect(base_url().'gh/login');
        }
    }
    public function superuser_logout(){
      $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value){$this->session->unset_userdata($row);}
        redirect(base_url().'gh/superuser_login');
    }

    public function admin_login(){
      if(!$this->session->userdata('currently_logged_in')){
            $this->db->select("*")
              ->from("tbl_users")
              ->where('username', $this->input->post('username'));
              $query = $this->db->get();  
              $row = $query->row();
              if ($query->num_rows()){          
                   if(md5($this->input->post('password')) == $row->password){
                    if($row->admin == 1){
                        $data = array(  
                          'id'          => $row->id,
                          'username'    => $row->username,  
                          'password'    => $row->password,
                          'email'       => $row->email,
                          'fullname'    => $row->lastname.' '.$row->firstname,
                          'letter'      => $row->firstname[0],
                          'middlename'  => $row->middlename,
                          'image'       => $row->image,
                          'page'        => 'admin',
                          'currently_logged_in' => 1  
                          );    
                           $this->session->set_userdata($data);
                           if(!$this->session->userdata('currently_logged_in')){ 
                              $this->load->view('login/admin_login.php');
                           }else{ 
                               $url ='gh/admin/index' ;  
                               $data = array('url'    =>  $url,'status' => 'success');  
                               echo json_encode($data);
                           }
                       }else{
                             $data = array('status' => 'no access');  
                             echo json_encode($data);
                       }
                        
                  }else{
                    $data = array('status' => 'error');  
                    echo json_encode($data);
                  } 
              }else{$this->load->view('login/login.php');}           
          }else{redirect(base_url().'gh/admin/index');}
      
    }
    public function admin($view = null,$id = null){
      if($this->session->userdata('currently_logged_in') == 1  && $this->session->userdata('page') == 'admin'){
          $this->load->view('admin/layouts/header.php');
          $this->load->view('admin/layouts/navbar.php');
           $data['id'] = base64_decode($id);
          switch ($view) {
            case 'index':{$this->load->view('admin/index.php');break;}
            case 'designer_request':{$this->load->view('admin/designer_request.php');break;}
            case 'purchase-request':{$this->load->view('admin/purchase_request.php');break;}
            case "inspection-stocks":{$this->load->view('admin/inspection_stocks.php');break;}
            case "inspection-project":{$this->load->view('admin/inspection_project.php');break;}
            case "salesorder-request":{$this->load->view('admin/salesorder_request.php');break;}
            case "design-approval-stocks":{$this->load->view('admin/design_approval_stocks.php'); break;}
            case "design-approval-project":{$this->load->view('admin/design_approval_project.php'); break;}
            case "user-request":{$this->load->view('admin/user_request.php');break;}
            case "users":{$this->load->view('admin/user_list.php');break;}
            case "user_create":{$this->load->view('admin/user_create.php');break;}
            case "user_update":{$this->load->view('admin/user_update.php');break;}
            case "joborder":{$this->load->view('admin/joborder_list.php'); break;}
            case "joborder-finished":{$this->load->view('admin/joborder_finished.php'); break;}
            case "joborder_create":{$this->load->view('admin/joborder_create.php'); break;}
            case "salesorder_list":{$this->load->view('admin/salesorder_list.php');break;}
            case "salesorder_create":{$this->load->view('admin/salesorder_create.php');break;}
            case "salesorder_update":{$this->load->view('admin/salesorder_update.php',$data);break;}
            case "voucher":{$this->load->view('admin/coupon_list.php');break;}
            case 'collection':{$this->load->view('admin/report_collection.php');break;}
            case 'sales-order':{$this->load->view('admin/report_salesorder.php');break;}
            case 'production-supplies':{$this->load->view('admin/report_production.php');break;}
            case 'cashfund':{$this->load->view('admin/report_cashfund.php');break;}
            case 'cash-position':{$this->load->view('admin/report_cashposition.php');break;}
            default: {redirect(base_url().'gh/admin/index');break;} 
            
          }
          $this->load->view('admin/layouts/footer.php');
        }else{
                redirect(base_url().'gh/login');
        }
    }
    public function admin_logout(){
      $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value){$this->session->unset_userdata($row);}
        redirect(base_url().'gh/login');
    }

    public function accounting_login(){
        if(!$this->session->userdata('currently_logged_in')){
            $this->db->select("*")
              ->from("tbl_users")
              ->where('username', $this->input->post('username'));
              $query = $this->db->get();  
              $row = $query->row();
              if ($query->num_rows()){          
                   if(md5($this->input->post('password')) == $row->password){
                        if($row->accounting == 1){
                          $data = array(  
                          'id'          => $row->id,
                          'username'    => $row->username,  
                          'password'    => $row->password,
                          'email'       => $row->email,
                          'fullname'    => $row->lastname.' '.$row->firstname,
                          'letter'      => $row->firstname[0],
                          'middlename'  => $row->middlename,
                          'image'       => $row->image,
                          'voucher'     => $row->coupon_status,
                          'page'        => 'accounting',
                          'currently_logged_in' => 1  
                          );    
                           $this->session->set_userdata($data);
                           if(!$this->session->userdata('currently_logged_in')){ 
                              $this->load->view('login/accounting_login.php');
                           }else{ 
                               $url ='gh/accounting/index' ;  
                               $data = array('url'    =>  $url,'status' => 'success');  
                               echo json_encode($data);
                           }  
                       }else{
                             $data = array('status' => 'no access');  
                             echo json_encode($data);
                       }
                        
                  }else{
                    $data = array('status' => 'error');  
                    echo json_encode($data);
                  } 
              }else{$this->load->view('login/accounting_login.php');}           
          }else{redirect(base_url().'gh/accounting/index');}
    }
    public function accounting($view = null,$id = null){
        if($this->session->userdata('currently_logged_in') == 1  && $this->session->userdata('page') == 'accounting'){
          $this->load->view('accounting/layouts/header.php');
          $this->load->view('accounting/layouts/navbar.php');
           $data['id'] = base64_decode($id);
          switch ($view) {
            case 'index':{$this->load->view('accounting/index.php');break;}
            case 'purchased-stocks':{$this->load->view('accounting/purchased_stocks.php');break;}
            case 'purchased-project':{$this->load->view('accounting/purchased_project.php');break;}
            case 'purchase-approved':{$this->load->view('accounting/purchase_approved.php');break;}
            case 'purchase-received':{$this->load->view('accounting/purchase_received.php');break;}
            case 'purchase-stocks-request':{$this->load->view('accounting/purchase_stocks_request.php');break;}
            case 'purchase-stocks-approved':{$this->load->view('accounting/purchase_stocks_approved.php');break;}
            case 'purchase-stocks-received':{$this->load->view('accounting/purchase_stocks_received.php');break;}
            case 'other-expenses':{$this->load->view('accounting/other_expenses.php');break;}
            case 'collection':{$this->load->view('accounting/report_collection.php');break;}
            case 'sales-order':{$this->load->view('accounting/report_salesorder.php');break;}
            case 'production-supplies':{$this->load->view('accounting/report_production.php');break;}
            case 'cashfund':{$this->load->view('accounting/report_cashfund.php');break;}
            case 'cash-position':{$this->load->view('accounting/report_cashposition.php');break;}
            case "spareparts":{$this->load->view('accounting/spareparts_list.php');break;}
            case "officesupplies":{$this->load->view('accounting/officesupplies_list.php');break;}
            case "rawmaterials":{$this->load->view('accounting/rawmaterial_list.php');break;}
            case "rawmaterials":{$this->load->view('accounting/rawmaterial_list.php'); break;}
            case "production-stocks":{$this->load->view('accounting/production_stocks.php'); break;}
            case "supplier":{$this->load->view('accounting/supplier_list.php'); break;}
            case "supplier_view":{$this->load->view('accounting/supplier_view.php',$data); break;}
            case "supplier_create":{$this->load->view('accounting/supplier_add.php'); break;}
            default: {redirect(base_url().'gh/accounting/index');break;}
          }
          $this->load->view('accounting/layouts/footer.php');
        }else{
                redirect(base_url().'gh/login');
            }
    }
    public function accounting_logout(){
      $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value){$this->session->unset_userdata($row);}
        redirect(base_url().'gh/login');
    }
        public function webmodifier_login(){
        if(!$this->session->userdata('currently_logged_in')){
            $this->db->select("*")->from("tbl_users")->where('username', $this->input->post('username'));
              $query = $this->db->get();  
              $row = $query->row();
              if ($query->num_rows()){          
                   if(md5($this->input->post('password')) == $row->password){
                        if($row->webmodifier == 1){
                          $data = array(  
                          'id'          => $row->id,
                          'username'    => $row->username,  
                          'password'    => $row->password,
                          'email'       => $row->email,
                          'fullname'    => $row->lastname.' '.$row->firstname,
                          'letter'      => $row->firstname[0],
                          'middlename'  => $row->middlename,
                          'image'       => $row->image,
                          'page'        => 'webmodifier',
                          'currently_logged_in' => 1  
                          );    
                           $this->session->set_userdata($data);
                           if(!$this->session->userdata('currently_logged_in')){ 
                              $this->load->view('login/webmodifier_login.php');
                           }else{ 
                               $url ='gh/webmodifier/index' ;  
                               $data = array('url'    =>  $url,'status' => 'success');  
                               echo json_encode($data);
                           }  
                       }else{
                             $data = array('status' => 'no access');  
                             echo json_encode($data);
                       }
                        
                  }else{
                    $data = array('status' => 'error');  
                    echo json_encode($data);
                  } 
              }else{$this->load->view('login/login.php');}           
          }else{redirect(base_url().'gh/webmodifier/index');}
    }
    public function webmodifier($view = null,$id = null){
        if($this->session->userdata('currently_logged_in') == 1  && $this->session->userdata('page') == 'webmodifier'){
          $this->load->view('webmodifier/layouts/header.php');
          $this->load->view('webmodifier/layouts/navbar.php');
           $data['id'] = base64_decode($id);
          switch ($view) {
            case 'index':{$this->load->view('webmodifier/index.php');break;}
            case 'banner':{$this->load->view('webmodifier/banner.php');break;}
            case 'interior':{$this->load->view('webmodifier/interior.php');break;}
            case 'events':{$this->load->view('webmodifier/events.php');break;}
            case 'product':{$this->load->view('webmodifier/product.php');break;}
            case 'category':{$this->load->view('webmodifier/category.php');break;}
            case 'company':{$this->load->view('webmodifier/company.php');break;}
            case 'voucher':{$this->load->view('webmodifier/voucher.php');break;}
            case 'shipping-fee':{$this->load->view('webmodifier/shipping_fee.php');break;}
            case 'user_update':{$this->load->view('webmodifier/user_update.php');break;}
            case 'testimony':{$this->load->view('webmodifier/testimony.php');break;}
            default: {redirect(base_url().'gh/webmodifier/index');break;} 
          }
          $this->load->view('webmodifier/layouts/footer.php');
        }else{
            redirect(base_url().'gh/login');
        }
    }
    public function webmodifier_logout(){
      $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value){$this->session->unset_userdata($row);}
        redirect(base_url().'gh/login');
    }

    public function sales_login(){
        if(!$this->session->userdata('currently_logged_in')){
            $this->db->select("*")
              ->from("tbl_users")
              ->where('username', $this->input->post('username'));
              $query = $this->db->get();  
              $row = $query->row();
              if ($query->num_rows()){          
                   if(md5($this->input->post('password')) == $row->password){
                        if($row->sales == 1){
                          $data = array(  
                          'id'          => $row->id,
                          'username'    => $row->username,  
                          'password'    => $row->password,
                          'email'       => $row->email,
                          'fullname'    => $row->lastname.' '.$row->firstname,
                          'letter'      => $row->firstname[0],
                          'middlename'  => $row->middlename,
                          'image'       => $row->image,
                          'voucher'     => $row->coupon_status,
                          'page'        => 'sales',
                          'currently_logged_in' => 1);    
                           $this->session->set_userdata($data);
                           if(!$this->session->userdata('currently_logged_in')){ 
                              $this->load->view('login/sales_login.php');
                           }else{ 
                               $url ='gh/sales/index' ;  
                               $data = array('url'    =>  $url,'status' => 'success');  
                               echo json_encode($data);
                           }  
                       }else{
                             $data = array('status' => 'no access');  
                             echo json_encode($data);
                       }
                        
                  }else{
                    $data = array('status' => 'error');  
                    echo json_encode($data);
                  } 
              }else{$this->load->view('login/login.php');}           
          }else{redirect(base_url().'gh/sales/index');}
    }
    public function sales($view = null,$id = null){
        if($this->session->userdata('currently_logged_in') == 1  && $this->session->userdata('page') == 'sales'){
          $this->load->view('sales/layouts/header.php');
          $this->load->view('sales/layouts/navbar.php');
           $data['id'] = base64_decode($id);
          switch ($view) {
            case 'index':{$this->load->view('sales/index.php');break;}
            case 'user_update':{$this->load->view('sales/user_update.php');break;}
            case 'online-order':{$this->load->view('sales/online_order.php');break;}
            case 'onlineorder-update':{$this->load->view('sales/online_order_update.php',$data);break;}
            case 'customer-inquiry':{$this->load->view('sales/online_customization');break;}
            case 'sales-order':{$this->load->view('sales/sales_order.php');break;}
            case "salesorder_list":{$this->load->view('sales/salesorder_list.php');break;}
            case "salesorder_create":{$this->load->view('sales/salesorder_create.php');break;}
            case "salesorder_update":{$this->load->view('sales/salesorder_update.php',$data);break;}
            case "voucher":{$this->load->view('sales/coupon_list.php');break;}
            case "customer-concern":{$this->load->view('sales/service_request.php');break;}
            case "customer-list":{$this->load->view('sales/customer_list.php');break;}
            case "collection":{$this->load->view('sales/collection.php');break;}
            default: {redirect(base_url().'gh/sales/index');break;}
          }
          $this->load->view('sales/layouts/footer.php');
        }else{
             redirect(base_url().'gh/login');
        }
    }
    public function sales_logout(){
      $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value){$this->session->unset_userdata($row);}
        redirect(base_url().'gh/login');
    }

}
?>