<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable_controller extends CI_Controller 
{ 
    public function __construct()
    {
      parent::__construct();
      $this->load->helper('url'); 
      $this->load->model('datatable_model');
      $this->load->library('session');
       
    } 
    public function Design_Stocks_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Design_Stocks_Request_DataTable($user_id);
        echo json_encode($data);
    } 
    public function Design_Stocks_Approved_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Design_Stocks_Approved_DataTable($user_id);
        echo json_encode($data);
    }
    public function Design_Stocks_Rejected_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Design_Stocks_Rejected_DataTable($user_id);
        echo json_encode($data);
    }  
    public function Design_Project_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Design_Project_Request_DataTable($user_id);
        echo json_encode($data);
    } 
    public function Design_Project_Approved_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Design_Project_Approved_DataTable($user_id);
        echo json_encode($data);
    }
    public function Design_Project_Rejected_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Design_Project_Rejected_DataTable($user_id);
        echo json_encode($data);
    }  
    public function Customization_DataTable(){
        $user_id = $this->session->userdata('id');
        $base64_encode = $this->input->post('status');
        $base64_decode = base64_decode($base64_encode);
        $status =  trim($base64_decode,"=");
        $status = strtoupper($status);
        $data = $this->datatable_model->Customization_DataTable($user_id,$status);
        echo json_encode($data);
    }
     public function Customization_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $base64_encode = $this->input->post('status');
        $base64_decode = base64_decode($base64_encode);
        $status =  trim($base64_decode,"=");
        $status = strtoupper($status);
        $data = $this->datatable_model->Customization_Request_DataTable($user_id,$status);
        echo json_encode($data);
    }
    public function RawMaterial_DataTable(){
        $data = $this->datatable_model->RawMaterial_DataTable();
        echo json_encode($data);
    }
    public function SpareParts_DataTable(){
        $data = $this->datatable_model->SpareParts_DataTable();
        echo json_encode($data);
     }
    public function OfficeSupplies_DataTable(){
        $data = $this->datatable_model->OfficeSupplies_DataTable();
        echo json_encode($data);
    }
    public function RawMaterial_Stocks_DataTable(){
        $data = $this->datatable_model->RawMaterial_Stocks_DataTable();
        echo json_encode($data);
    }
     public function RawMaterial_OutStocks_DataTable(){
        $data = $this->datatable_model->RawMaterial_OutStocks_DataTable();
        echo json_encode($data);
    }
    public function RawMaterial_New_DataTable(){
        $data = $this->datatable_model->RawMaterial_New_DataTable();
        echo json_encode($data);
    }
    public function OfficeSupplies_Stocks_DataTable(){
        $data = $this->datatable_model->OfficeSupplies_Stocks_DataTable();
        echo json_encode($data);
    }
    public function OfficeSupplies_Outofstocks_DataTable(){
        $data = $this->datatable_model->OfficeSupplies_Outofstocks_DataTable();
        echo json_encode($data);
    }
    public function OfficeSupplies_newstocks_DataTable(){
        $data = $this->datatable_model->OfficeSupplies_newstocks_DataTable();
        echo json_encode($data);
    }
    public function SpareParts_Stocks_DataTable(){
        $data = $this->datatable_model->SpareParts_Stocks_DataTable();
        echo json_encode($data);
    }
    public function SpareParts_Outofstocks_DataTable(){
        $data = $this->datatable_model->SpareParts_Outofstocks_DataTable();
        echo json_encode($data);
    }
    public function SpareParts_newstocks_DataTable(){
        $data = $this->datatable_model->SpareParts_newstocks_DataTable();
        echo json_encode($data);
    }
    public function Production_Stocks_DataTable(){
        $data = $this->datatable_model->Production_Stocks_DataTable();
        echo json_encode($data);
    }
    public function RawMat_Production_Stocks_DataTable(){
        $data = $this->datatable_model->RawMat_Production_Stocks_DataTable();
        echo json_encode($data);
    }
    public function Purchase_Material_Stocks_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Purchase_Material_Stocks_Request_DataTable($user_id);
        echo json_encode($data);
    }
    public function Purchase_Material_Stocks_Inprogress_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Purchase_Material_Stocks_Inprogress_DataTable($user_id);
        echo json_encode($data);
    } 
    public function Purchase_Material_Stocks_Complete_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Purchase_Material_Stocks_Complete_DataTable($user_id);
        echo json_encode($data);
    }
    public function Purchase_Material_Project_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Purchase_Material_Project_Request_DataTable($user_id);
        echo json_encode($data);
    }
      public function Purchase_Material_Project_Inprogress_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Purchase_Material_Project_Inprogress_DataTable($user_id);
        echo json_encode($data);
    } 
    public function Purchase_Material_Project_Complete_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Purchase_Material_Project_Complete_DataTable($user_id);
        echo json_encode($data);
    }
    public function Material_Request_Stocks_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Material_Request_Stocks_DataTable($user_id);
        echo json_encode($data);
    }
    public function Material_Complete_Stocks_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Material_Complete_Stocks_DataTable($user_id);
        echo json_encode($data);
    }
    public function Material_Request_Project_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Material_Request_Project_DataTable($user_id);
        echo json_encode($data);
    }
    public function Material_Complete_Project_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Material_Complete_Project_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Stocks_Material_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Stocks_Material_Request_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Stocks_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Stocks_Request_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Stocks_Pending_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Stocks_Pending_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Stocks_Cancelled_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Stocks_Cancelled_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Stocks_Complete_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Stocks_Complete_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Stocks_Production_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Stocks_Production_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Project_Production_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Project_Production_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Masterlist_Stocks_DataTable(){
        $data = $this->datatable_model->Joborder_Masterlist_Stocks_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Masterlist_Project_DataTable(){
        $data = $this->datatable_model->Joborder_Masterlist_Project_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Stocks_Supervisor_DataTable(){
        $data = $this->datatable_model->Joborder_Stocks_Supervisor_DataTable();
        echo json_encode($data);
    }

    public function Joborder_Project_Material_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Project_Material_Request_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Project_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Project_Request_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Project_Pending_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Project_Pending_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Project_Cancelled_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Project_Cancelled_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Project_Complete_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Joborder_Project_Complete_DataTable($user_id);
        echo json_encode($data);
    }
    public function Joborder_Project_Masterlist_DataTable(){
        $data = $this->datatable_model->Joborder_Project_Masterlist_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Project_Supervisor_DataTable(){
        $data = $this->datatable_model->Joborder_Project_Supervisor_DataTable();
        echo json_encode($data);
    }


    public function Salesorder_Stocks_Request_DataTable_Production(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Stocks_Request_DataTable_Production($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Shipping_DataTable_Production(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Stocks_Shipping_DataTable_Production($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Delivered_DataTable_Production(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Stocks_Delivered_DataTable_Production($user_id);
        echo json_encode($data);
    }

    public function Salesorder_Project_Request_DataTable_Production(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Project_Request_DataTable_Production($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Project_Shipping_DataTable_Production(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Project_Shipping_DataTable_Production($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Project_Delivered_DataTable_Production(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Project_Delivered_DataTable_Production($user_id);
        echo json_encode($data);
    }
    
    public function Salesorder_Stocks_Request_DataTable_Admin(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Stocks_Request_DataTable_Admin($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Approved_DataTable_Admin(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Stocks_Approved_DataTable_Admin($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Rejected_DataTable_Admin(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Stocks_Rejected_DataTable_Admin($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Project_Request_DataTable_Admin(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Project_Request_DataTable_Admin($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Project_Approved_DataTable_Admin(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Project_Approved_DataTable_Admin($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Project_Rejected_DataTable_Admin(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Project_Rejected_DataTable_Admin($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Shipping_DataTable_Superuser(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Stocks_Shipping_DataTable_Superuser($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Delivered_DataTable_Superuser(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Stocks_Delivered_DataTable_Superuser($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Project_Shipping_DataTable_Superuser(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Project_Shipping_DataTable_Superuser($user_id);
        echo json_encode($data);
    }
    public function Salesorder_Project_Delivered_DataTable_Superuser(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Salesorder_Project_Delivered_DataTable_Superuser($user_id);
        echo json_encode($data);
    }
    public function Request_Material_List_Datatable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Request_Material_List_Datatable($user_id);
        echo json_encode($data);
    }
    public function Request_Material_Received_Datatable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Request_Material_Received_Datatable($user_id);
        echo json_encode($data);
    }
    public function Request_Material_Cancalled_Datatable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Request_Material_Cancalled_Datatable($user_id);
        echo json_encode($data);
    }

    public function Request_Material_List_Superuser_Datatable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Request_Material_List_Superuser_Datatable();
        echo json_encode($data);
    }
    public function Request_Material_Received_Superuser_Datatable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Request_Material_Received_Superuser_Datatable();
        echo json_encode($data);
    }
    public function Request_Material_Cancelled_Superuser_Datatable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Request_Material_Cancelled_Superuser_Datatable();
        echo json_encode($data);
    }



    public function Return_Item_Good_DataTable_Superuser(){
        $data = $this->datatable_model->Return_Item_Good_DataTable_Superuser();
        echo json_encode($data);
    }
    public function Return_Item_Rejected_DataTable_Superuser(){
        $data = $this->datatable_model->Return_Item_Rejected_DataTable_Superuser();
        echo json_encode($data);
    }


    public function Return_Item_Repair_Customer_DataTable_Superuser(){
        $data = $this->datatable_model->Return_Item_Repair_Customer_DataTable_Superuser();
        echo json_encode($data);
    }
    public function Return_Item_Good_Customer_DataTable_Superuser(){
        $data = $this->datatable_model->Return_Item_Good_Customer_DataTable_Superuser();
        echo json_encode($data);
    }
    public function Return_Item_Rejected_Customer_DataTable_Superuser(){
        $data = $this->datatable_model->Return_Item_Rejected_Customer_DataTable_Superuser();
        echo json_encode($data);
    }

    
    
    public function Users_DataTable(){
        $data = $this->datatable_model->Users_DataTable();
        echo json_encode($data);
    }
    public function Material_Received_DataTable(){
        $data = $this->datatable_model->Material_Received_DataTable();
        echo json_encode($data);
    }
    public function FinishProduct_DataTable(){
        $data = $this->datatable_model->FinishProduct_DataTable();
        echo json_encode($data);
    }
    public function Customer_Collected_Request_DataTable(){
        $data = $this->datatable_model->Customer_Collected_Request_DataTable();
        echo json_encode($data);
    }
    public function Customer_Collected_Approved_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Customer_Collected_Approved_DataTable($user_id);
        echo json_encode($data);
    }
     public function Customer_Collected_Approved_Accounting_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Customer_Collected_Approved_Accounting_DataTable($user_id);
        echo json_encode($data);
    }

    
    //APPROVAL
    public function Approval_Design_Stocks_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Approval_Design_Stocks_Request_DataTable($user_id);
        echo json_encode($data);
    }
    public function Approval_Design_Stocks_Approved_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Approval_Design_Stocks_Approved_DataTable($user_id);
        echo json_encode($data);
    }
    public function Approval_Design_Stocks_Rejected_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Approval_Design_Stocks_Rejected_DataTable($user_id);
        echo json_encode($data);
    }
      public function Approval_Design_Project_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Approval_Design_Project_Request_DataTable($user_id);
        echo json_encode($data);
    }
    public function Approval_Design_Project_Approved_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Approval_Design_Project_Approved_DataTable($user_id);
        echo json_encode($data);
    }
    public function Approval_Design_Project_Rejected_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Approval_Design_Project_Rejected_DataTable($user_id);
        echo json_encode($data);
    }
    public function Approval_Purchase_Request_DataTable(){
        $user_id = $this->session->userdata('id');
        $data   = $this->datatable_model->Approval_Purchase_Request_DataTable($user_id);
        echo json_encode($data);
    } 
    public function Approval_Purchase_Approved_DataTable(){
        $user_id = $this->session->userdata('id');
        $data   = $this->datatable_model->Approval_Purchase_Approved_DataTable($user_id);
        echo json_encode($data);
    }
    public function Approval_Purchase_Rejected_DataTable(){
        $user_id = $this->session->userdata('id');
        $data   = $this->datatable_model->Approval_Purchase_Rejected_DataTable($user_id);
        echo json_encode($data);
    }  

    public function Approval_Inspection_Stocks_Request_DataTable(){
        $data = $this->datatable_model->Approval_Inspection_Stocks_Request_DataTable();
        echo json_encode($data);
    }
    public function Approval_Inspection_Stocks_Approved_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Approval_Inspection_Stocks_Approved_DataTable($user_id);
        echo json_encode($data);
    }
    public function Approval_Inspection_Stocks_Rejected_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Approval_Inspection_Stocks_Rejected_DataTable($user_id);
        echo json_encode($data);
    }

    public function Approval_Inspection_Project_Request_DataTable(){
        $data = $this->datatable_model->Approval_Inspection_Project_Request_DataTable();
        echo json_encode($data);
    }
     public function Approval_Inspection_Project_Approved_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Approval_Inspection_Project_Approved_DataTable($user_id);
        echo json_encode($data);
    }
     public function Approval_Inspection_Project_Rejected_DataTable(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Approval_Inspection_Project_Rejected_DataTable($user_id);
        echo json_encode($data);
    }

    public function Approval_Request_Salesorder_DataTable(){
        $data = $this->datatable_model->Approval_Request_Salesorder_DataTable();
        echo json_encode($data);
    }
    public function Approval_Approved_Salesorder_DataTable(){
        $data = $this->datatable_model->Approval_Approved_Salesorder_DataTable();
        echo json_encode($data);
    }
    public function Approval_Rejected_Salesorder_DataTable(){
        $data = $this->datatable_model->Approval_Rejected_Salesorder_DataTable();
        echo json_encode($data);
    }
    
 
    //ACCOUNTING
    public function Accounting_Purchase_Material_Stocks_Request(){
        $data = $this->datatable_model->Accounting_Purchase_Material_Stocks_Request();
        echo json_encode($data);
    }
    public function Accounting_Purchase_Material_Stocks_Approval(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Accounting_Purchase_Material_Stocks_Approval($user_id);
        echo json_encode($data);
    }
    public function Accounting_Purchase_Material_Stocks_Received(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Accounting_Purchase_Material_Stocks_Received($user_id);
        echo json_encode($data);
    }

    public function Accounting_Purchase_Material_Project_Request(){
        $data = $this->datatable_model->Accounting_Purchase_Material_Project_Request();
        echo json_encode($data);
    }
    public function Accounting_Purchase_Material_Project_Approval(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Accounting_Purchase_Material_Project_Approval($user_id);
        echo json_encode($data);
    }
    public function Accounting_Purchase_Material_Project_Received(){
        $user_id = $this->session->userdata('id');
        $data = $this->datatable_model->Accounting_Purchase_Material_Project_Received($user_id);
        echo json_encode($data);
    }


   
    public function Account_Report_Collection_Stocks_Daily(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Stocks_Daily($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Collection_Stocks_Weekly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Stocks_Weekly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Collection_Stocks_Monthly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Stocks_Monthly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Collection_Stocks_Yearly(){
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Stocks_Yearly($year);
        echo json_encode($data);
    }

    public function Account_Report_Collection_Project_Daily(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Project_Daily($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Collection_Project_Weekly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Project_Weekly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Collection_Project_Monthly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Project_Monthly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Collection_Project_Yearly(){
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Project_Yearly($year);
        echo json_encode($data);
    }


    public function Account_Report_Salesorder_Stocks_Daily(){
        $month = isset($_POST['month']) ? $this->input->post('month'): date('m');
        $year = isset($_POST['year']) ? $this->input->post('year'): date('Y');
        $data = $this->datatable_model->Account_Report_Salesorder_Stocks_Daily($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Salesorder_Stocks_Weekly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Salesorder_Stocks_Weekly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Salesorder_Stocks_Monthly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Salesorder_Stocks_Monthly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Salesorder_Stocks_Yearly(){
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Salesorder_Stocks_Yearly($year);
        echo json_encode($data);
    }

    public function Account_Report_Salesorder_Project_Daily(){
        $month = isset($_POST['month']) ? $this->input->post('month'): date('m');
        $year = isset($_POST['year']) ? $this->input->post('year'): date('Y');
        $data = $this->datatable_model->Account_Report_Salesorder_Project_Daily($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Salesorder_Project_Weekly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Salesorder_Project_Weekly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Salesorder_Project_Monthly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Salesorder_Project_Monthly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Salesorder_Project_Yearly(){
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Salesorder_Project_Yearly($year);
        echo json_encode($data);
    }



    public function Account_Report_Project_Daily(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Project_Daily($year,$month);
        echo json_encode($data);
    }
    public function Account_Report_Project_Weekly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Project_Weekly($year,$month);
        echo json_encode($data);
    }
    public function Account_Report_Project_Monthly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Project_Monthly($year,$month);
        echo json_encode($data);
    }
    public function Account_Report_Project_Yearly(){
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Project_Yearly($year);
        echo json_encode($data);
    }
    public function Account_Report_Production_Supplies(){
        $id = $this->input->post('id');
        $data = $this->datatable_model->Account_Report_Production_Supplies($id);
        echo json_encode($data);
    }
    public function Account_Report_Income_Monthly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Income_Monthly($year,$month);
        echo json_encode($data);
    }
    public function Account_Report_Cashposition_Weekly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Cashposition_Weekly($year,$month);
        echo json_encode($data);
    }
    public function Account_Report_Cashposition_Monthly(){
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Cashposition_Monthly($year);
        echo json_encode($data);
    }



    //WebModifier
   public function Web_Banner_Data(){
        $data = $this->datatable_model->Web_Banner_Data();
        echo json_encode($data);
   }
   public function Web_Product_DataTable(){
        $data = $this->datatable_model->Web_Product_DataTable();
        echo json_encode($data);
   }
   public function Web_Category_Data(){
        $data = $this->datatable_model->Web_Category_Data();
        echo json_encode($data);
   }
   public function Web_SubCategory_Data(){
        $id = $this->input->post('id');
        $data = $this->datatable_model->Web_SubCategory_Data($id);
        echo json_encode($data);
   }
   public function Web_ProductCategory_Data(){
        $id = $this->input->post('id');
        $data = $this->datatable_model->Web_ProductCategory_Data($id);
        echo json_encode($data);
   }
   public function Web_Vouncher_DataTable(){
        $data = $this->datatable_model->Web_Vouncher_DataTable();
        echo json_encode($data);
   }
   public function Web_Shipping_DataTable(){
        $data = $this->datatable_model->Web_Shipping_DataTable();
        echo json_encode($data);
   }
   public function Web_Interior_Data(){
        $data = $this->datatable_model->Web_Interior_Data();
        echo json_encode($data);
   }
   public function Web_Events_Data(){
        $data = $this->datatable_model->Web_Events_Data();
        echo json_encode($data);
   }
   public function Web_Testimony_DataTable(){
      $data = $this->datatable_model->Web_Testimony_DataTable();
      echo json_encode($data);
   }
   public function supplier_DataTable(){
        $data = $this->datatable_model->supplier_DataTable();
        echo json_encode($data);
   } 
   public function SupplierItem_DataTable(){
         $id = $this->input->post('status');
         $data = $this->datatable_model->SupplierItem_DataTable($id);
         echo json_encode($data);
   }



   //Sales
   public function OnlineOrder_DataTable(){
     $data = $this->datatable_model->OnlineOrder_DataTable();
     echo json_encode($data);
   }
   public function Preorder_DataTable(){
     $data = $this->datatable_model->Preorder_DataTable();
     echo json_encode($data);
   }
    public function OnlineCustomization_DataTable(){
      $id = $this->session->userdata('id');
      $base64_encode = $this->input->post('status');
      $base64_decode = base64_decode($base64_encode);
      $status =  trim($base64_decode,"=");
      $status = strtoupper($status);
      $data = $this->datatable_model->OnlineCustomization_DataTable($id,$status);
      echo json_encode($data);
   }
   public function Coupon_DataTable(){
      $data = $this->datatable_model->Coupon_DataTable();
      echo json_encode($data);
   }

   public function Customer_Concern_Request_Sales_DataTable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Customer_Concern_Request_Sales_DataTable($id);
      echo json_encode($data);
   }
   public function Customer_Concern_Approved_Sales_DataTable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Customer_Concern_Approved_Sales_DataTable($id);
      echo json_encode($data);
   }
   public function Customer_Concern_Request_Superuser_DataTable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Customer_Concern_Request_Superuser_DataTable($id);
      echo json_encode($data);
   }
   public function Customer_Concern_Approved_Superuser_DataTable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Customer_Concern_Approved_Superuser_DataTable($id);
      echo json_encode($data);
   }




   public function Customer_List_DataTable(){
      $data = $this->datatable_model->Customer_List_DataTable();
      echo json_encode($data);
   }
    






   // Repair

     public function OnlineRequest_DataTable(){
        $user_id = $this->session->userdata('id');
        $base64_encode = $this->input->post('status');
        $base64_decode = base64_decode($base64_encode);
        $status =  trim($base64_decode,"=");
        $status = strtoupper($status);
        $data = $this->datatable_model->OnlineRequest_DataTable($user_id,$status);
        echo json_encode($data);
    }

    public function Approval_UsersRequest_DataTable(){
        $base64_encode = $this->input->post('status');
        $base64_decode = base64_decode($base64_encode);
        $status =  trim($base64_decode,"=");
        $status = strtoupper($status);
        $data = $this->datatable_model->Approval_UsersRequest_DataTable($status);
        echo json_encode($data);
    }

}
?>
