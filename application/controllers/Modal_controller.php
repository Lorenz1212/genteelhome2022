<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modal_controller extends CI_Controller 
{ 
    public function __construct()
    {
      parent::__construct();
      $this->load->helper('url'); 
      $this->load->model('modal_model');
      $this->load->library('session');
    }
    public function Modal_Design_Stocks_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Design_Stocks_View($id);
        echo json_encode($data);
    }
    public function Modal_Design_Project_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Design_Project_View($id);
        echo json_encode($data);
    }
     public function Modal_SalesOrder_Stocks(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_SalesOrder_Stocks($id);
        echo json_encode($data);
    }
    public function Modal_SalesOrder_Project(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_SalesOrder_Project($id);
        echo json_encode($data);
    }
    public function Modal_Stocks_Rawmats_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Stocks_Rawmats_View($id);
        echo json_encode($data);
    }
    public function Modal_Stocks_SpareParts_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Stocks_SpareParts_View($id);
        echo json_encode($data);
    }
    public function Modal_Stocks_OfficeSupplies_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Stocks_OfficeSupplies_View($id);
        echo json_encode($data);
    }
    public function Modal_Designer_Customization(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Designer_Customization($id);
        echo json_encode($data);
    }
     public function Modal_Users(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Users($id);
        echo json_encode($data);
    }
     public function Modal_RawMaterial_view(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_RawMaterial_view($id);
        echo json_encode($data);
     }
      public function Modal_Other_Materials_view(){
        $id = $this->input->post('id');
        $type =  $this->input->post('type');
        $data = $this->modal_model->Modal_Other_Materials_view($id,$type);
        echo json_encode($data);
     }

    public function Modal_Purchase_Stocks_Request_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Purchase_Stocks_Request_View($id);
        echo json_encode($data);
     }
   public function Modal_Purchase_Stocks_Inprogress_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Purchase_Stocks_Inprogress_View($id);
        echo json_encode($data);
   }
   public function Modal_Purchase_Project_Request_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Purchase_Project_Request_View($id);
        echo json_encode($data);
   }
   public function Modal_Purchase_Project_Inprogress_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Purchase_Project_Inprogress_View($id);
        echo json_encode($data);
   }


     public function Modal_SupplierItem_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_SupplierItem_View($id);
        echo json_encode($data);
     }
     public function Modal_Production_Stocks(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Production_Stocks($id);
        echo json_encode($data);
     }
     
     public function Modal_Material_Request_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Material_Request_View($id);
        echo json_encode($data);
     }
     public function Modal_Material_Request_Stocks_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Material_Request_Stocks_View($id);
        echo json_encode($data);
     }
     public function Modal_Material_Request_Project_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Material_Request_Project_View($id);
        echo json_encode($data);
     }
     public function Modal_Material_Request_List_View(){
        $id = $this->input->post('val');
        $data = $this->modal_model->Modal_Material_Request_List_View($id);
        echo json_encode($data);
     }
     public function Modal_Material_Request_Accept_View(){
        $id = $this->input->post('val');
        $data = $this->modal_model->Modal_Material_Request_Accept_View($id);
        echo json_encode($data);
     }
     public function Modal_Material_Request_Cancel_View(){
        $id = $this->input->post('val');
        $data = $this->modal_model->Modal_Material_Request_Cancel_View($id);
        echo json_encode($data);
     }
     
     public function Modal_Material_Request_Partial_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Material_Request_Partial_View($id);
        echo json_encode($data);
     }

     public function Modal_Joborder_Project_Supervisor(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Joborder_Project_Supervisor($id);
        echo json_encode($data);
     }
     public function Modal_Joborder_Stocks_Supervisor(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Joborder_Stocks_Supervisor($id);
        echo json_encode($data);
     }

      public function Modal_Material_Request_Complete_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Material_Request_Complete_View($id);
        echo json_encode($data);
     }
     public function Modal_Joborder_Stocks_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Joborder_Stocks_View($id);
        echo json_encode($data);
    }
     public function Modal_Joborder_Project_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Joborder_Project_View($id);
        echo json_encode($data);
    }
     public function Modal_JobOrder_Finished(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_JobOrder_Finished($id);
        echo json_encode($data);
    }
    public function Modal_Purchase_Stocks_View(){
        $id = base64_decode($this->input->post('id'));
        $data = $this->modal_model->Modal_Purchase_Stocks_View($id);
        echo json_encode($data);
     }
    public function Modal_Purchase_Stocks_Complete_View(){
        $id = base64_decode($this->input->post('id'));
        $data = $this->modal_model->Modal_Purchase_Stocks_Complete_View($id);
        echo json_encode($data);
     }
     public function Modal_Stocks_Delivery_Data(){
        $id = base64_decode($this->input->post('id'));
        $data = $this->modal_model->Modal_Delivery_Stocks_Data($id);
        echo json_encode($data);
     }
     public function Modal_Customer_Collection(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Customer_Collection($id);
        echo json_encode($data);
     }
     public function Modal_Material_Request_Supervisor(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Material_Request_Supervisor($id);
        echo json_encode($data);
    }
     public function Modal_Purchased_Request_Supervisor(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Purchased_Request_Supervisor($id);
        echo json_encode($data);
    }
    public function Modal_Material_Used_Supervisor(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Material_Used_Supervisor($id);
        echo json_encode($data);
    }
    public function Modal_Request_Material(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Request_Material($id);
        echo json_encode($data);
    }
    
    //Approval
    public function Modal_Approval_Inspection_Project_View(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->modal_model->Modal_Approval_Inspection_Project_View($id,$status);
        echo json_encode($data);
    }
    public function Modal_Approval_Inspection_Stocks_View(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->modal_model->Modal_Approval_Inspection_Stocks_View($id,$status);
        echo json_encode($data);
    }
    public function Modal_Approval_Purchase_View(){
        $id = base64_decode($this->input->post('id'));
        $status = base64_decode($this->input->post('status'));
        $data = $this->modal_model->Modal_Approval_Purchase_View($id,$status);
        echo json_encode($data);
    }
     //Accounting
     public function Modal_Accounting_Purchase_Material_Stocks_Request(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Purchase_Material_Stocks_Request($id);
        echo json_encode($data);
     }
     public function Modal_Accounting_Purchase_Material_Stocks_Approved(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Purchase_Material_Stocks_Approved($id);
        echo json_encode($data);
     }
    public function Modal_Accounting_Purchase_Received_Stocks(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Purchase_Received_Stocks($id);
        echo json_encode($data);
     }
      public function Modal_Accounting_Purchase_Material_Project_Request(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Purchase_Material_Project_Request($id);
        echo json_encode($data);
     }
     public function Modal_Accounting_Purchase_Material_Project_Approved(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Purchase_Material_Project_Approved($id);
        echo json_encode($data);
     }
      public function Modal_Accounting_Purchase_Received_Project(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Purchase_Received_Project($id);
        echo json_encode($data);
     }

    
     public function Modal_Accounting_Purchase_Stocks_Request(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Purchase_Stocks_Request($id);
        echo json_encode($data);
     }
     public function Modal_Accounting_Purchase_Stocks_Approved(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Purchase_Stocks_Approved($id);
        echo json_encode($data);
     }
     public function Modal_Accounting_Purchase_Stocks_Received(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Purchase_Stocks_Received($id);
        echo json_encode($data);
     }
     public function Modal_Accounting_Other_Expenses(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Other_Expenses($id);
        echo json_encode($data);
     }
     public function Modal_Accounting_Category_Expenses(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Category_Expenses($id);
        echo json_encode($data);
     }
     public function Modal_Accounting_Category_Income(){
        $id = $this->encryption->decrypt($this->input->post('id'));
        $data = $this->modal_model->Modal_Accounting_Category_Income($id);
        echo json_encode($data);
     }
     public function Modal_Accounting_Income_Statement(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Accounting_Income_Statement($id);
        echo json_encode($data);
     }
     public function Modal_Accounting_Category_Income_List(){
        $data = $this->modal_model->Modal_Accounting_Category_Income_List();
        echo json_encode($data);
     }


     //Web Modifier
     public function Modal_Web_Banner(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Web_Banner($id);
        echo json_encode($data);
     }
     public function Modal_Web_Product_Data(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Web_Product_Data($id);
        echo json_encode($data);
    }
     public function Modal_Web_Category(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Web_Category($id);
        echo json_encode($data);
    }
    public function Modal_Web_Design_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Web_Design_View($id);
        echo json_encode($data);
    }
     public function Modal_Web_Product_Color_Data(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Web_Product_Color_Data($id);
        echo json_encode($data);
    }
    public function Modal_Web_SubCategory_Data(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Web_SubCategory_Data($id);
        echo json_encode($data);
    }
    public function Modal_Web_ProductDetails_Data(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Web_ProductDetails_Data($id);
        echo json_encode($data);
    }
    public function Modal_Web_Design_Gallery(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Web_Design_Gallery($id);
        echo json_encode($data);
    }
    public function Modal_Shipping_View(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Shipping_View($id);
        echo json_encode($data);
    }
     public function Modal_Web_Interior(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Web_Interior($id);
        echo json_encode($data);
     }
      public function Modal_Web_Interior_Image(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Web_Interior_Image($id);
        echo json_encode($data);
     }
     public function Modal_Web_Events(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_Web_Events($id);
        echo json_encode($data);
     }
     public function Modal_Testimony_View(){
       $id = $this->input->post('id');
       $data = $this->modal_model->Modal_Testimony_View($id);
       echo json_encode($data); 
     } 

   //Sales
    public function Modal_Customer_Concern(){
       $id = $this->input->post('id');
       $data = $this->modal_model->Modal_Customer_Concern($id);
       echo json_encode($data); 
    }
    public function Modal_OnlineOrder(){
        $id = $this->input->post('id');
        $data = $this->modal_model->Modal_OnlineOrder($id);
        echo json_encode($data);
    }
    public function Modal_Voucher_Customer(){
       $id = $this->input->post('id');
       $data = $this->modal_model->Modal_Voucher_Customer($id);
       echo json_encode($data); 
    }
    public function Modal_Inquiry_View(){
       $id = $this->input->post('id');
       $data = $this->modal_model->Modal_Inquiry_View($id);
       echo json_encode($data); 
    }
    public function Modal_Customer_View(){
       $id = $this->input->post('id');
       $data = $this->modal_model->Modal_Customer_View($id);
       echo json_encode($data); 
    }   
    public function Modal_Customized_View(){
       $id = $this->input->post('id');
       $data = $this->modal_model->Modal_Customized_View($id);
       echo json_encode($data); 
    }    
        
}
?>
