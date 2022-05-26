'use strict';
var KTDatatablesDataSourceAjaxClientAdmin = function() {
var TableURL;
var TableData;
var _DataTableLoader = async function(link,TableURL,TableData,url_link){
	var table = $('#'+link);
	table.DataTable().clear().destroy();
	$.fn.dataTable.ext.errMode = 'throw';
	table.DataTable({
		destroy: true,
		responsive: true,
		info: true,
		serverSide:false,
		"fnDrawCallback": function() {
                $('[data-toggle="tooltip"]').tooltip();
        },
		language: { 
		 	infoEmpty: "No records available", 
		 },
		
		ajax: {
			url: TableURL,
			type: 'POST',
			datatype: "json",
			data: {status:url_link},
		},
		columns:TableData,
	});
}
	var _initView_Table = function(view){
		switch(view){
			//APPROVAL
			case "tbl_approval_inspection_stocks":{
				TableURL = baseURL + 'datatable_controller/Approval_Inspection_Stocks_Request_DataTable';
				TableData = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}];
				_DataTableLoader('tbl_approval_inspection_stocks_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Approval_Inspection_Stocks_Approved_DataTable';
				let TableData1 = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}];
				_DataTableLoader('tbl_approval_inspection_stocks_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Approval_Inspection_Stocks_Rejected_DataTable';
				let TableData2 = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}];
				_DataTableLoader('tbl_approval_inspection_stocks_rejected',TableURL2,TableData2,false);
				break;
			}
			case "tbl_approval_inspection_project":{
				TableURL = baseURL + 'datatable_controller/Approval_Inspection_Project_Request_DataTable';
				TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}];
				_DataTableLoader('tbl_approval_inspection_project_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Approval_Inspection_Project_Approved_DataTable';
				let TableData1 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}];
				_DataTableLoader('tbl_approval_inspection_project_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Approval_Inspection_Project_Rejected_DataTable';
				let TableData2 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}];
				_DataTableLoader('tbl_approval_inspection_project_rejected',TableURL2,TableData2,false);
				break;
			}
			case "tbl_approval_design_stocks_request":{
				TableURL = baseURL + 'datatable_controller/Approval_Design_Stocks_Request_DataTable';
				TableData = [{data:'project_no'},{data:'image',visible:false},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_approval_design_stocks_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Approval_Design_Stocks_Approved_DataTable';
				let TableData1 = [{data:'project_no'},{data:'image',visible:false},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_approval_design_stocks_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Approval_Design_Stocks_Rejected_DataTable';
				let TableData2 = [{data:'project_no'},{data:'image',visible:false},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_approval_design_stocks_rejected',TableURL2,TableData2,false);
				break;
			}
			case "tbl_approval_design_project_request":{
				TableURL = baseURL + 'datatable_controller/Approval_Design_Project_Request_DataTable';
				TableData = [{data:'project_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_approval_design_project_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Approval_Design_Project_Approved_DataTable';
				let TableData1 = [{data:'project_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_approval_design_project_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Approval_Design_Project_Rejected_DataTable';
				let TableData2 = [{data:'project_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_approval_design_project_rejected',TableURL2,TableData2,false);
				break;
			}
			case "tbl_other_purchase_invetory":{
				TableURL = baseURL + 'datatable_controller/Other_purchase_inventory_Request';
				TableData = [{data:'trans_no'},{data:'requestor'},{data:'date_created'},{data:'status'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Other_purchase_inventory_Inprogress';
				let TableData1 = [{data:'trans_no'},{data:'requestor'},{data:'date_created'},{data:'status'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_inprogress',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Purchase_Material_Inventory_Complete_DataTable';
				let TableData2 = [{data:'trans_no'},{data:'item'},{data:'quantity'},{data:'amount'},{data:'supplier'},{data:'date_created'},{data:'terms'}]; 
				_DataTableLoader('tbl_complete',TableURL2,TableData2,false);
			}

			//Repair>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			case "tbl_coupon":{
				TableURL = baseURL + 'datatable_controller/Coupon_DataTable';
				TableData = [{data:'no'},{data:'promo_code'},{data:'discount'},{data:'date_from'},{data:'date_to'},{data:'status'},{data:'action',orderable:false}]; 
				_DataTableLoader(view,TableURL,TableData,false);
				break;
			}


			
			case "tbl_production_stocks":{
				TableURL = baseURL + 'datatable_controller/Production_Stocks_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'}];
				_DataTableLoader(view,TableURL,TableData,false);
				break;
			}
		
		
			//Approval
			case "tbl_approval_purchased_request":{
				TableURL = baseURL + 'datatable_controller/Approval_Purchase_Request_DataTable';
				TableData = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_approval_purchased_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Approval_Purchase_Approved_DataTable';
				let TableData1 =[{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_approval_purchased_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Approval_Purchase_Rejected_DataTable';
				let TableData2 = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_approval_purchased_rejected',TableURL2,TableData2,false);
				break;
			}
			
			case "tbl_approval_userrequest":{
				TableURL = baseURL + 'datatable_controller/Approval_UsersRequest_DataTable';
				TableData = [{data:'no'},{data:'username'},{data:'name'},{data:'date_created'},{data:'status'},{data:'action',orderable:false}]; 
				_DataTableLoader(view,TableURL,TableData,false);
				break;
			}
			
			case "tbl_customer_list":{
				TableURL = baseURL + 'datatable_controller/Customer_List_DataTable';
				TableData =  [{data: 'no'},{data: 'name'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status'},{data: 'action',orderable:false}];
				_DataTableLoader('tbl_customer_list',TableURL,TableData,false);
				break;
			}

		

		}	 
	}


	return {
		//main function to initiate the module
		init: function(link,val=false) {
			_initView_Table(link,val)
		},
	};

}();

// jQuery(document).ready(function() {
// 	KTDatatablesDataSourceAjaxClientAdmin.init();
// });
