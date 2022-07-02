<?php 

class Gh extends CI_Controller { 
    public function __construct(){
      parent::__construct();
    }
    public function app_login(){
        $query =  $this->db->select("*")->from("tbl_customer_online")->where('email',$this->input->post('email'))->where('status',1)->get();
        $row = $query->row();
        if ($query->num_rows()){    
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
                           $data = array('status' => 'success','message'=>'Login Successfully');  
                           echo json_encode($data);
                  }else{
                    $data = array('status' => 'error','message'=>'Invalid Email/Password');  
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
              case ' ':{$this->load->view('website/index.php');break;}
              case 'index':{$this->load->view('website/index.php');break;}
              case 'featured':{$this->load->view('website/blogs.php');break;}
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
              case 'popular-product':{$this->load->view('website/popular_product.php');break;}
              default: {redirect(base_url().'gh/app/index');break;} 
            }
        }else{
             switch ($view1) {
              case ' ':{$this->load->view('website/index.php');break;}
              case 'index':{$this->load->view('website/index.php');break;}
              case 'featured':{$this->load->view('website/blogs.php');break;}
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
              case 'popular-product':{$this->load->view('website/popular_product.php');break;}
              default: {redirect(base_url().'gh/app/index');break;}
            }
        }
        $this->load->view('website/layouts/footer.php');
    }
     public function logout($view = null){
        $data = $this->session->userdata($view);
        foreach($data as $row => $rows_value){$this->session->unset_userdata($row);}
        delete_cookie($this->appinfo->sess_name().'_'.$view.'_user');
        delete_cookie($this->appinfo->sess_name().'_'.$view.'_auth');
        redirect(base_url().'authentication/login');
    }
    public function designer($view = null){
      if($this->session->userdata('designer')){
        $this->load->view('designer/layouts/header.php');
        $this->load->view('designer/layouts/navbar.php');
        switch ($view) {
          case 'index':{$this->load->view('designer/index.php');break;}
          case "design-for-stocks":{$this->load->view('designer/design_stocks.php'); break;}
          case "design-for-project":{$this->load->view('designer/design_project.php'); break;}
          case "joborder-stocks":{$this->load->view('designer/joborder-stocks.php'); break;}
          case "joborder-project":{$this->load->view('designer/joborder-project.php'); break;}
          case "joborder-create-stocks":{$this->load->view('designer/joborder-create-stocks.php');break;}
          case "joborder-create-project":{$this->load->view('designer/joborder-create-project.php');break;}
          case "joborder-update-stocks":{$this->load->view('designer/joborder-update-stocks.php');break;}
          case "joborder-update-project":{$this->load->view('designer/joborder-update-project.php');break;}
          case "joborder-update-project":{$this->load->view('designer/joborder-update-project.php');break;}
          case "request-material-list":{$this->load->view('designer/request_material_list.php');break;}
          case "request-material-create":{$this->load->view('designer/request_material_create.php');break;}
          case "request-pre-order":{$this->load->view('designer/request_preorder.php');break;}
          case "request-customized":{$this->load->view('designer/request_customized.php');break;}
          case "user_update":{$this->load->view('designer/user_update.php');break;}
          case "tutorial":{$this->load->view('designer/tutorial.php');break;}
          default: {redirect(base_url().'gh/designer/index');break;}
        }
        $this->load->view('designer/layouts/footer.php');
      }else{
            redirect(base_url().'authentication/login');
      }
    }
    public function production($view = null){
       if($this->session->userdata('production')){
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
            case "spare-parts":{$this->load->view('production/spareparts_list.php');break;}
            case "office-supplies":{$this->load->view('production/officesupplies_list.php');break;}
            case "finish-product":{$this->load->view('production/finishproduct_list.php');break;}
            case "raw-materials":{$this->load->view('production/rawmaterial_list.php'); break;}
            case "production-stocks":{$this->load->view('production/production_stocks.php'); break;}
            case "user_update":{$this->load->view('production/user_update.php');break;}
            case "tutorial":{$this->load->view('production/tutorial.php');break;}
            default: {redirect(base_url().'gh/production/index');break;}
          }
          $this->load->view('production/layouts/footer.php');
        }else{
             redirect(base_url().'authentication/login');
        }
    }
     public function supervisor($view = null){
       if($this->session->userdata('supervisor')){
          $this->load->view('supervisor/layouts/header.php');
          $this->load->view('supervisor/layouts/navbar.php');
          switch ($view) {
            case 'index':{$this->load->view('supervisor/index.php');break;}
            case "user_update":{$this->load->view('supervisor/user_update.php');break;}
            case "production-stocks":{$this->load->view('supervisor/production_stocks.php');break;}
            case "joborder-stocks":{$this->load->view('supervisor/joborder_stocks_list.php');break;}
            case "joborder-project":{$this->load->view('supervisor/joborder_project_list.php');break;}
             case "tutorial":{$this->load->view('supervisor/tutorial.php');break;}
            default: {redirect(base_url().'gh/supervisor/index');break;}
          }
          $this->load->view('supervisor/layouts/footer.php');
        }else{
              redirect(base_url().'authentication/login');
        }
    }
    public function superuser($view = null){
        if($this->session->userdata('superuser')){
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
            case "customer-concern":{$this->load->view('reviewer/customer_concern.php');break;}
            case "spareparts":{$this->load->view('reviewer/spareparts_list.php');break;}
            case "spareparts-create":{$this->load->view('reviewer/spareparts_add.php');break;}
            case "rawmaterials":{$this->load->view('reviewer/rawmaterial_list.php');break;}
            case "rawmaterial_create":{$this->load->view('reviewer/rawmaterial_add.php'); break;}
            case "officesupplies":{$this->load->view('reviewer/officesupplies_list.php');break;} 
            case "officesupplies-create":{$this->load->view('reviewer/officesupplies_add.php');break;}
            case "production-stocks":{$this->load->view('reviewer/production_stocks.php');break;}
            case "return-item-warehouse":{$this->load->view('reviewer/return_item_warehouse.php');break;}
            case "return-item-customer":{$this->load->view('reviewer/return_item_customer.php');break;}
            case "request-material-stocks":{$this->load->view('reviewer/request_material_stocks.php');break;}
            case "delivery-receipt-list":{$this->load->view('reviewer/delivery_receipt_list.php');break;}
            case "purchase-inventory-create":{$this->load->view('reviewer/purchase_inventory_create.php');break;}
            case "purchase-inventory-list":{$this->load->view('reviewer/purchase_inventory_list.php');break;}
            case "users":{$this->load->view('reviewer/user_list.php');break;}
            case "user_create":{$this->load->view('reviewer/user_create.php');break;}
            case "user_update":{$this->load->view('reviewer/user_update.php');break;}
            case "supplier":{$this->load->view('reviewer/supplier_list.php'); break;}
            case "tutorial":{$this->load->view('reviewer/tutorial.php');break;}
            default: {redirect(base_url().'gh/reviewer/index');break;}
          }
          $this->load->view('reviewer/layouts/footer.php');
        }else{
                redirect(base_url().'authentication/login');
        }
    }
    public function admin($view = null){
      if($this->session->userdata('admin')){
          $this->load->view('admin/layouts/header.php');
          $this->load->view('admin/layouts/navbar.php');
          switch ($view) {
            case 'index':{$this->load->view('admin/index.php');break;}
            case "salesorder-stocks-request":{$this->load->view('admin/salesorder_stocks_request.php');break;}
            case "salesorder-project-request":{$this->load->view('admin/salesorder_project_request.php');break;}
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
            case "voucher":{$this->load->view('admin/coupon_list.php');break;}
            case 'production-supplies':{$this->load->view('admin/report_production.php');break;}
           
            case 'report-cash-position':{$this->load->view('admin/report_cashposition.php');break;}
            case 'report-cashfund':{$this->load->view('admin/report_cashfund.php');break;}
            case 'report-sales-order':{$this->load->view('admin/report_salesorder.php');break;}
            case 'report-collection':{$this->load->view('admin/report_collection.php');break;}
            case "tutorial":{$this->load->view('admin/tutorial.php');break;}
            default: {redirect(base_url().'gh/admin/index');break;} 
          }
          $this->load->view('admin/layouts/footer.php');
        }else{
               redirect(base_url().'authentication/login');
        }
    }
    public function accounting($view = null){
        if($this->session->userdata('accounting')){
          $this->load->view('accounting/layouts/header.php');
          $this->load->view('accounting/layouts/navbar.php');
          switch ($view) {
            case 'index':{$this->load->view('accounting/index.php');break;}
            case 'purchased-stocks':{$this->load->view('accounting/purchased_stocks.php');break;}
            case 'purchased-project':{$this->load->view('accounting/purchased_project.php');break;}
            case 'purchased-inventory':{$this->load->view('accounting/purchased_inventory.php');break;}
            case 'collection':{$this->load->view('accounting/collection.php');break;}
            case "salesorder-stocks":{$this->load->view('accounting/salesorder_stocks.php');break;}
            case "salesorder-project":{$this->load->view('accounting/salesorder_project.php');break;}
            case "salesorder-create-stocks":{$this->load->view('accounting/salesorder_create_stocks.php');break;}
            case "salesorder-create-project":{$this->load->view('accounting/salesorder_create_project.php');break;}
           

            case "spareparts":{$this->load->view('accounting/spareparts_list.php');break;}
            case "officesupplies":{$this->load->view('accounting/officesupplies_list.php');break;}
            case "rawmaterials":{$this->load->view('accounting/rawmaterial_list.php');break;}
            case "rawmaterials":{$this->load->view('accounting/rawmaterial_list.php'); break;}
            case "production-stocks":{$this->load->view('accounting/production_stocks.php'); break;}
            case "supplier":{$this->load->view('accounting/supplier_list.php'); break;}

             case "tutorial":{$this->load->view('accounting/tutorial.php');break;}
            case 'report-project-monitoring':{$this->load->view('accounting/report_production.php');break;}
            case 'report-cash-position':{$this->load->view('accounting/report_cashposition.php');break;}
            case 'report-cashfund':{$this->load->view('accounting/report_cashfund.php');break;}
            case 'report-sales-order':{$this->load->view('accounting/report_salesorder.php');break;}
            case 'report-collection':{$this->load->view('accounting/report_collection.php');break;}
            case "accounting":{$this->load->view('accounting/tutorial.php');break;}
            default: {redirect(base_url().'gh/accounting/index');break;}
          }
          $this->load->view('accounting/layouts/footer.php');
        }else{
                redirect(base_url().'authentication/login');
        }
    }
    public function webmodifier($view = null){
        if($this->session->userdata('webmodifier')){
          $this->load->view('webmodifier/layouts/header.php');
          $this->load->view('webmodifier/layouts/navbar.php');
          switch ($view) {
            case 'index':{$this->load->view('webmodifier/index.php');break;}
            case 'banner':{$this->load->view('webmodifier/banner.php');break;}
            case 'interior':{$this->load->view('webmodifier/interior.php');break;}
            case 'events':{$this->load->view('webmodifier/events.php');break;}
            case 'product':{$this->load->view('webmodifier/product.php');break;}
            case 'category-list':{$this->load->view('webmodifier/category-list.php');break;}
            case 'company':{$this->load->view('webmodifier/company.php');break;}
            case 'lookbook':{$this->load->view('webmodifier/lookbook.php');break;}
            case 'voucher':{$this->load->view('webmodifier/voucher.php');break;}
            case 'shipping-fee':{$this->load->view('webmodifier/shipping_fee.php');break;}
            case 'user_update':{$this->load->view('webmodifier/user_update.php');break;}
            case 'testimony':{$this->load->view('webmodifier/testimony.php');break;}
            case "tutorial":{$this->load->view('webmodifier/tutorial.php');break;}
            default: {redirect(base_url().'gh/webmodifier/index');break;} 
          }
          $this->load->view('webmodifier/layouts/footer.php');
        }else{
           redirect(base_url().'authentication/login');
        }
    }
    public function sales($view = null){
        if($this->session->userdata('sales')){
          $this->load->view('sales/layouts/header.php');
          $this->load->view('sales/layouts/navbar.php');
          switch ($view) {
            case 'index':{$this->load->view('sales/index.php');break;}
            case 'user_update':{$this->load->view('sales/user_update.php');break;}
            case 'online-order':{$this->load->view('sales/online_order_request.php');break;}
            case "salesorder-stocks":{$this->load->view('sales/salesorder_stocks.php');break;}
            case "salesorder-project":{$this->load->view('sales/salesorder_project.php');break;}
            case "salesorder-create-stocks":{$this->load->view('sales/salesorder_create_stocks.php');break;}
            case "salesorder-create-project":{$this->load->view('sales/salesorder_create_project.php');break;}
            case "salesorder-update-stocks":{$this->load->view('sales/salesorder_update_stocks.php');break;}
            case "voucher":{$this->load->view('sales/coupon_list.php');break;}
            case "customer-concern":{$this->load->view('sales/customer_concern.php');break;}
            case "customer-list":{$this->load->view('sales/customer_list.php');break;}
            case 'customer-inquiry':{$this->load->view('sales/customer_inquiry.php');break;}
            case 'customer-customized':{$this->load->view('sales/customer_customized.php');break;}
            case "collection":{$this->load->view('sales/collection.php');break;}
            case "tutorial":{$this->load->view('sales/tutorial.php');break;}
            default: {redirect(base_url().'gh/sales/index');break;}
          }
          $this->load->view('sales/layouts/footer.php');
        }else{
             redirect(base_url().'authentication/login');
        }
    }
    public function printview($view=null){
        switch ($view) {
           case "print-salesorder-stocks":{$this->load->view('print/print_salesorder_stocks.php');break;}
           case "print-salesorder-project":{$this->load->view('print/print_salesorder_project.php');break;}
           case "print-salesorder-delivery":{$this->load->view('print/print_salesorder_delivery.php');break;}
           default: false;break;
        }
        
    }

}
?>