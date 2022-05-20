<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable_controller extends CI_Controller 
{ 
    public function __construct()
    {
      parent::__construct();
      $this->load->model('datatable_model');
    } 
    public function Design_Stocks_Request_DataTable(){
        $data = $this->datatable_model->Design_Stocks_Request_DataTable();
        echo json_encode($data);
    } 
    public function Design_Stocks_Approved_DataTable(){
        $data = $this->datatable_model->Design_Stocks_Approved_DataTable();
        echo json_encode($data);
    }
    public function Design_Stocks_Rejected_DataTable(){
        $data = $this->datatable_model->Design_Stocks_Rejected_DataTable();
        echo json_encode($data);
    }  
    public function Design_Project_Request_DataTable(){
        $data = $this->datatable_model->Design_Project_Request_DataTable();
        echo json_encode($data);
    } 
    public function Design_Project_Approved_DataTable(){
        $data = $this->datatable_model->Design_Project_Approved_DataTable();
        echo json_encode($data);
    }
    public function Design_Project_Rejected_DataTable(){
        $data = $this->datatable_model->Design_Project_Rejected_DataTable();
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
    public function RawMaterial_Release_DataTable(){
        $data = $this->datatable_model->RawMaterial_Release_DataTable();
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
    public function OfficeSupplies_release_DataTable(){
        $data = $this->datatable_model->OfficeSupplies_release_DataTable();
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
    public function SpareParts_release_DataTable(){
        $data = $this->datatable_model->SpareParts_release_DataTable();
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
        $data = $this->datatable_model->Purchase_Material_Stocks_Request_DataTable();
        echo json_encode($data);
    }
    public function Purchase_Material_Stocks_Inprogress_DataTable(){
        $data = $this->datatable_model->Purchase_Material_Stocks_Inprogress_DataTable();
        echo json_encode($data);
    } 
    public function Purchase_Material_Stocks_Complete_DataTable(){
        $data = $this->datatable_model->Purchase_Material_Stocks_Complete_DataTable();
        echo json_encode($data);
    }
    public function Purchase_Material_Project_Request_DataTable(){
        $data = $this->datatable_model->Purchase_Material_Project_Request_DataTable();
        echo json_encode($data);
    }
    public function Purchase_Material_Project_Inprogress_DataTable(){
        $data = $this->datatable_model->Purchase_Material_Project_Inprogress_DataTable();
        echo json_encode($data);
    } 
    public function Purchase_Material_Project_Complete_DataTable(){
        $data = $this->datatable_model->Purchase_Material_Project_Complete_DataTable();
        echo json_encode($data);
    }
    public function Material_Request_Stocks_DataTable(){
        $data = $this->datatable_model->Material_Request_Stocks_DataTable();
        echo json_encode($data);
    }
    public function Material_Complete_Stocks_DataTable(){
        $data = $this->datatable_model->Material_Complete_Stocks_DataTable();
        echo json_encode($data);
    }
    public function Material_Request_Project_DataTable(){
        $data = $this->datatable_model->Material_Request_Project_DataTable();
        echo json_encode($data);
    }
    public function Material_Complete_Project_DataTable(){
        $data = $this->datatable_model->Material_Complete_Project_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Stocks_Material_Request_DataTable(){
        $data = $this->datatable_model->Joborder_Stocks_Material_Request_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Stocks_Request_DataTable(){
        $data = $this->datatable_model->Joborder_Stocks_Request_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Stocks_Pending_DataTable(){
        $data = $this->datatable_model->Joborder_Stocks_Pending_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Stocks_Cancelled_DataTable(){
        $data = $this->datatable_model->Joborder_Stocks_Cancelled_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Stocks_Complete_DataTable(){
        $data = $this->datatable_model->Joborder_Stocks_Complete_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Stocks_Production_DataTable(){
        $data = $this->datatable_model->Joborder_Stocks_Production_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Project_Production_DataTable(){
        $data = $this->datatable_model->Joborder_Project_Production_DataTable();
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
        $data = $this->datatable_model->Joborder_Project_Material_Request_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Project_Request_DataTable(){
        $data = $this->datatable_model->Joborder_Project_Request_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Project_Pending_DataTable(){
        $data = $this->datatable_model->Joborder_Project_Pending_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Project_Cancelled_DataTable(){
        $data = $this->datatable_model->Joborder_Project_Cancelled_DataTable();
        echo json_encode($data);
    }
    public function Joborder_Project_Complete_DataTable(){
        $data = $this->datatable_model->Joborder_Project_Complete_DataTable();
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
        $data = $this->datatable_model->Salesorder_Stocks_Request_DataTable_Production();
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Approved_DataTable_Production(){
        $data = $this->datatable_model->Salesorder_Stocks_Approved_DataTable_Production();
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Completed_DataTable_Production(){
        $data = $this->datatable_model->Salesorder_Stocks_Completed_DataTable_Production();
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Cancelled_DataTable_Production(){
        $data = $this->datatable_model->Salesorder_Stocks_Cancelled_DataTable_Production();
        echo json_encode($data);
    }


    public function Salesorder_Project_Request_DataTable_Production(){
        $data = $this->datatable_model->Salesorder_Project_Request_DataTable_Production();
        echo json_encode($data);
    }
    public function Salesorder_Project_Approved_DataTable_Production(){
        $data = $this->datatable_model->Salesorder_Project_Approved_DataTable_Production();
        echo json_encode($data);
    }
    public function Salesorder_Project_Completed_DataTable_Production(){
        $data = $this->datatable_model->Salesorder_Project_Completed_DataTable_Production();
        echo json_encode($data);
    }
    public function Salesorder_Project_Cancelled_DataTable_Production(){
        $data = $this->datatable_model->Salesorder_Project_Cancelled_DataTable_Production();
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Request_DataTable_Accounting(){
        $data = $this->datatable_model->Salesorder_Stocks_Request_DataTable_Accounting();
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Approved_DataTable_Accounting(){
        $data = $this->datatable_model->Salesorder_Stocks_Approved_DataTable_Accounting();
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Completed_DataTable_Accounting(){
        $data = $this->datatable_model->Salesorder_Stocks_Completed_DataTable_Accounting();
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Cancelled_DataTable_Accounting(){
        $data = $this->datatable_model->Salesorder_Stocks_Cancelled_DataTable_Accounting();
        echo json_encode($data);
    }
    public function Salesorder_Project_Request_DataTable_Accounting(){
        $data = $this->datatable_model->Salesorder_Project_Request_DataTable_Accounting();
        echo json_encode($data);
    }
    public function Salesorder_Project_Approved_DataTable_Accounting(){
        $data = $this->datatable_model->Salesorder_Project_Approved_DataTable_Accounting();
        echo json_encode($data);
    }
    public function Salesorder_Project_Completed_DataTable_Accounting(){
        $data = $this->datatable_model->Salesorder_Project_Completed_DataTable_Accounting();
        echo json_encode($data);
    }
    public function Salesorder_Project_Cancelled_DataTable_Accounting(){
        $data = $this->datatable_model->Salesorder_Project_Cancelled_DataTable_Accounting();
        echo json_encode($data);
    }

    
    public function Salesorder_Stocks_Request_DataTable_Admin(){
        $data = $this->datatable_model->Salesorder_Stocks_Request_DataTable_Admin();
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Approved_DataTable_Admin(){
        $data = $this->datatable_model->Salesorder_Stocks_Approved_DataTable_Admin();
        echo json_encode($data);
    }
    public function Salesorder_Stocks_Rejected_DataTable_Admin(){
        $data = $this->datatable_model->Salesorder_Stocks_Rejected_DataTable_Admin();
        echo json_encode($data);
    }
    public function Salesorder_Project_Request_DataTable_Admin(){
        $data = $this->datatable_model->Salesorder_Project_Request_DataTable_Admin();
        echo json_encode($data);
    }
    public function Salesorder_Project_Approved_DataTable_Admin(){
        $data = $this->datatable_model->Salesorder_Project_Approved_DataTable_Admin();
        echo json_encode($data);
    }
    public function Salesorder_Project_Rejected_DataTable_Admin(){
        $data = $this->datatable_model->Salesorder_Project_Rejected_DataTable_Admin();
        echo json_encode($data);
    }



    // DELIVER RECEIPT
    public function Sales_Delivery_Request_DataTable_Superuser(){
        $data = $this->datatable_model->Sales_Delivery_Request_DataTable_Superuser();
        echo json_encode($data);
    }
     public function Sales_Delivery_Ship_DataTable_Superuser(){
        $data = $this->datatable_model->Sales_Delivery_Ship_DataTable_Superuser();
        echo json_encode($data);
    }
    public function Sales_Delivery_Received_DataTable_Superuser(){
        $data = $this->datatable_model->Sales_Delivery_Received_DataTable_Superuser();
        echo json_encode($data);
    }
    public function Sales_Delivery_Completed_DataTable_Superuser(){
        $data = $this->datatable_model->Sales_Delivery_Completed_DataTable_Superuser();
        echo json_encode($data);
    }
    public function Sales_Delivery_Cancelled_DataTable_Superuser(){
        $data = $this->datatable_model->Sales_Delivery_Cancelled_DataTable_Superuser();
        echo json_encode($data);
    }



    public function Request_Material_List_Datatable(){
        $data = $this->datatable_model->Request_Material_List_Datatable();
        echo json_encode($data);
    }
    public function Request_Material_Received_Datatable(){
        $data = $this->datatable_model->Request_Material_Received_Datatable();
        echo json_encode($data);
    }
    public function Request_Material_Cancalled_Datatable(){
        $data = $this->datatable_model->Request_Material_Cancalled_Datatable();
        echo json_encode($data);
    }

    public function Request_Material_List_Superuser_Datatable(){
        $data = $this->datatable_model->Request_Material_List_Superuser_Datatable();
        echo json_encode($data);
    }
    public function Request_Material_Received_Superuser_Datatable(){
        $data = $this->datatable_model->Request_Material_Received_Superuser_Datatable();
        echo json_encode($data);
    }
    public function Request_Material_Cancelled_Superuser_Datatable(){
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

    
    public function Material_Received_DataTable(){
        $data = $this->datatable_model->Material_Received_DataTable();
        echo json_encode($data);
    }
    public function FinishProduct_DataTable(){
        $data = $this->datatable_model->FinishProduct_DataTable();
        echo json_encode($data);
    }


    public function Collected_Request_DataTable_Sales(){
        $data = $this->datatable_model->Collected_Request_DataTable_Sales();
        echo json_encode($data);
    }
    public function Collected_Approved_DataTable_Sales(){
        $data = $this->datatable_model->Collected_Approved_DataTable_Sales();
        echo json_encode($data);
    }
     public function Collected_Cancelled_DataTable_Sales(){
        $data = $this->datatable_model->Collected_Cancelled_DataTable_Sales();
        echo json_encode($data);
    }

    public function Collected_Request_DataTable_Accounting(){
        $data = $this->datatable_model->Collected_Request_DataTable_Accounting();
        echo json_encode($data);
    }
    public function Collected_Approved_DataTable_Accounting(){
        $data = $this->datatable_model->Collected_Approved_DataTable_Accounting();
        echo json_encode($data);
    }
     public function Collected_Cancelled_DataTable_Accounting(){
        $data = $this->datatable_model->Collected_Cancelled_DataTable_Accounting();
        echo json_encode($data);
    }

    
    //APPROVAL
    public function Approval_Design_Stocks_Request_DataTable(){
        $data = $this->datatable_model->Approval_Design_Stocks_Request_DataTable();
        echo json_encode($data);
    }
    public function Approval_Design_Stocks_Approved_DataTable(){
        $data = $this->datatable_model->Approval_Design_Stocks_Approved_DataTable();
        echo json_encode($data);
    }
    public function Approval_Design_Stocks_Rejected_DataTable(){
        $data = $this->datatable_model->Approval_Design_Stocks_Rejected_DataTable();
        echo json_encode($data);
    }
    public function Approval_Design_Project_Request_DataTable(){
        $data = $this->datatable_model->Approval_Design_Project_Request_DataTable();
        echo json_encode($data);
    }
    public function Approval_Design_Project_Approved_DataTable(){
        $data = $this->datatable_model->Approval_Design_Project_Approved_DataTable();
        echo json_encode($data);
    }
    public function Approval_Design_Project_Rejected_DataTable(){
        $data = $this->datatable_model->Approval_Design_Project_Rejected_DataTable();
        echo json_encode($data);
    }
    public function Approval_Purchase_Request_DataTable(){
        $data   = $this->datatable_model->Approval_Purchase_Request_DataTable();
        echo json_encode($data);
    } 
    public function Approval_Purchase_Approved_DataTable(){
        $data   = $this->datatable_model->Approval_Purchase_Approved_DataTable();
        echo json_encode($data);
    }
    public function Approval_Purchase_Rejected_DataTable(){
        $data   = $this->datatable_model->Approval_Purchase_Rejected_DataTable();
        echo json_encode($data);
    }  

    public function Approval_Inspection_Stocks_Request_DataTable(){
        $data = $this->datatable_model->Approval_Inspection_Stocks_Request_DataTable();
        echo json_encode($data);
    }
    public function Approval_Inspection_Stocks_Approved_DataTable(){
        $data = $this->datatable_model->Approval_Inspection_Stocks_Approved_DataTable();
        echo json_encode($data);
    }
    public function Approval_Inspection_Stocks_Rejected_DataTable(){
        $data = $this->datatable_model->Approval_Inspection_Stocks_Rejected_DataTable();
        echo json_encode($data);
    }

    public function Approval_Inspection_Project_Request_DataTable(){
        $data = $this->datatable_model->Approval_Inspection_Project_Request_DataTable();
        echo json_encode($data);
    }
     public function Approval_Inspection_Project_Approved_DataTable(){
        $data = $this->datatable_model->Approval_Inspection_Project_Approved_DataTable();
        echo json_encode($data);
    }
     public function Approval_Inspection_Project_Rejected_DataTable(){
        $data = $this->datatable_model->Approval_Inspection_Project_Rejected_DataTable();
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
    public function Accounting_Purchase_Material_Stocks(){
        $data = $this->datatable_model->Accounting_Purchase_Material_Stocks();
        echo json_encode($data);
    }
    public function Accounting_Purchase_Material_Stocks_Received(){
        $data = $this->datatable_model->Accounting_Purchase_Material_Stocks_Received();
        echo json_encode($data);
    }

    public function Accounting_Purchase_Material_Project_Request(){
        $data = $this->datatable_model->Accounting_Purchase_Material_Project_Request();
        echo json_encode($data);
    }
    public function Accounting_Purchase_Material_Project_Received(){
        $data = $this->datatable_model->Accounting_Purchase_Material_Project_Received();
        echo json_encode($data);
    }

    public function Account_Report_Collection_Daily(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Daily($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Collection_Weekly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Weekly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Collection_Monthly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Monthly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Collection_Yearly(){
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Collection_Yearly($year);
        echo json_encode($data);
    }


    public function Account_Report_Salesorder_Daily(){
        $month = isset($_POST['month']) ? $this->input->post('month'): date('m');
        $year = isset($_POST['year']) ? $this->input->post('year'): date('Y');
        $data = $this->datatable_model->Account_Report_Salesorder_Daily($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Salesorder_Weekly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Salesorder_Weekly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Salesorder_Monthly(){
        $month = isset($_POST['month']) ? $this->input->post('month'): false;
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Salesorder_Monthly($month,$year);
        echo json_encode($data);
    }
    public function Account_Report_Salesorder_Yearly(){
        $year = isset($_POST['year']) ? $this->input->post('year'): false;
        $data = $this->datatable_model->Account_Report_Salesorder_Yearly($year);
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

   public function Customized_Request_Sales_Datatable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Customized_Request_Sales_Datatable($id);
      echo json_encode($data);
   }
   public function Customized_Approved_Sales_Datatable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Customized_Approved_Sales_Datatable($id);
      echo json_encode($data);
   }
   public function Customized_Rejected_Sales_Datatable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Customized_Rejected_Sales_Datatable($id);
      echo json_encode($data);
   }



   public function Customer_List_DataTable(){
      $data = $this->datatable_model->Customer_List_DataTable();
      echo json_encode($data);
   }
   public function Pre_Order_Request_Datatable(){
      $data = $this->datatable_model->Pre_Order_Request_Datatable();
      echo json_encode($data);
   }
   public function Pre_Order_Approved_Datatable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Pre_Order_Approved_Datatable($id);
      echo json_encode($data);
   }
   public function Pre_Order_Rejected_Datatable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Pre_Order_Rejected_Datatable($id);
      echo json_encode($data);
   }
   public function Customized_Request_Datatable(){
      $data = $this->datatable_model->Customized_Request_Datatable();
      echo json_encode($data);
   }
   public function Customized_Approved_Datatable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Customized_Approved_Datatable($id);
      echo json_encode($data);
   }
   public function Customized_Rejected_Datatable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Customized_Rejected_Datatable($id);
      echo json_encode($data);
   } 
   public function Inquiry_Request_Sales_Datatable(){
      $data = $this->datatable_model->Inquiry_Request_Sales_Datatable();
      echo json_encode($data);
   }
   public function Inquiry_Approved_Sales_Datatable(){
      $id = $this->session->userdata('id');
      $data = $this->datatable_model->Inquiry_Approved_Sales_Datatable($id);
      echo json_encode($data);
   }

   public function Material_List_Supervisor(){
        $val = $this->input->post('val');
        $data = $this->datatable_model->Material_List_Supervisor($val);
        echo json_encode($data);
   } 
   public function Purchased_List_Supervisor(){
        $val = $this->input->post('val');
        $data = $this->datatable_model->Purchased_List_Supervisor($val);
        echo json_encode($data);
   } 
   public function Material_Used_List_Supervisor(){
        $val = $this->input->post('val');
        $data = $this->datatable_model->Material_Used_List_Supervisor($val);
        echo json_encode($data);
   } 

   public function Other_purchase_inventory_Request(){
        $data = $this->datatable_model->Other_purchase_inventory_Request();
        echo json_encode($data);
   }
   public function Other_purchase_inventory_Inprogress(){
        $data = $this->datatable_model->Other_purchase_inventory_Inprogress();
        echo json_encode($data);
   }
   public function Purchase_Material_Inventory_Complete_DataTable(){
        $data = $this->datatable_model->Purchase_Material_Inventory_Complete_DataTable();
        echo json_encode($data);
   }
   public function Other_purchase_inventory_Request_Accounting(){
        $data = $this->datatable_model->Other_purchase_inventory_Request_Accounting();
        echo json_encode($data);
   }
   public function Other_purchase_inventory_received_Accounting(){
        $data = $this->datatable_model->Other_purchase_inventory_received_Accounting();
        echo json_encode($data);
   }
   public function Cashpostion_Category_Accounting(){
        $data = $this->datatable_model->Cashpostion_Category_Accounting();
        echo json_encode($data);
   }



   // Repair
    public function Approval_UsersRequest_DataTable(){
        $data = $this->datatable_model->Approval_UsersRequest_DataTable();
        echo json_encode($data);
    }
    public function Users_DataTable(){
        $data = $this->datatable_model->Users_DataTable();
        echo json_encode($data);
    }

}
?>
