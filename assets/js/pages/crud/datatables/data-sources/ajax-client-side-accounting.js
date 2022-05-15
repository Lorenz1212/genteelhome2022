'use strict';
var KTDatatablesDataSourceAjaxClient = function() {
var TableURL;
var TableData;
var value;
const queryString = window.location.search;
var url_Params_Status = queryString.replace('?dXJsc3RhdHVz','');
	var _DataTableLoader = async function(link,TableURL,TableData,val){
		var table = $('#'+link);
		table.DataTable().clear().destroy();
		$.fn.dataTable.ext.errMode = 'throw';
		table.DataTable({
			destroy: true,
			responsive: false,
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
				data: val,
			},
			columns:TableData,
		});
	}
	var _initView_Table = function(view){
		switch(view){
			//Accounting
			case "tbl_salesorder_stocks":{
				 TableURL = baseURL + 'datatable_controller/Salesorder_Stocks_Request_DataTable_Accounting';
				 TableData = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_salesorder_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Stocks_Approved_DataTable_Accounting';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_salesorder_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Stocks_Completed_DataTable_Accounting';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_salesorder_completed',TableURL2,TableData2,false);

				let TableURL3 = baseURL + 'datatable_controller/Salesorder_Stocks_Cancelled_DataTable_Accounting';
				let TableData3 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_salesorder_cancelled',TableURL3,TableData3,false);
				break;
			}
			case "tbl_salesorder_project":{
				 TableURL = baseURL + 'datatable_controller/Salesorder_Project_Request_DataTable_Accounting';
				 TableData = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_salesorder_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Project_Approved_DataTable_Accounting';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_salesorder_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Project_Completed_DataTable_Accounting';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_salesorder_completed',TableURL2,TableData2,false);

				let TableURL3 = baseURL + 'datatable_controller/Salesorder_Project_Cancelled_DataTable_Accounting';
				let TableData3 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_salesorder_cancelled',TableURL3,TableData3,false);
				break;
			}
			case "tbl_purchased_material_stocks":{
				TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks';
				TableData = [{data:'production_no'},{data:'title',width:200},{data:'requestor',width:10},{data:'date_created',width:10},{data:'status',width:10},{data:'action',orderable:false,width:10,className:"text-center"}];
				_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

				let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Received';
				let TableData2 = [{data:'production_no'},{data:'title',width:200},{data:'requestor',width:10},{data:'date_created',width:10},{data:'status',width:10},{data:'action',orderable:false,width:10,className:"text-center"}]; 
				_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
				break;
			}
			case "tbl_purchased_material_project":{
				TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Request';
				TableData = [{data:'production_no'},{data:'title',width:150},{data:'requestor',width:10},{data:'date_created',width:10},{data:'status',width:10},{data:'action',orderable:false,width:10,className:"text-center"}];
				_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

				let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Received';
				let TableData2 = [{data:'production_no'},{data:'title',width:150},{data:'requestor',width:10},{data:'date_created',width:10},{data:'status'},{data:'action',orderable:false,width:10,className:"text-center"}]; 
				_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
				break;
			}
			case "tbl_purchased_stocks_request":{
				TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Stocks_Request';
				TableData =  [{data: 'request_id'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
				_DataTableLoader('tbl_purchased_stocks_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Stocks_Approval';
				let TableData1 =  [{data:'fund_no'},{data: 'request_id'},{data: 'requestor'},{data:'date_created'},{data: 'action',orderable:false}];
				_DataTableLoader('tbl_purchased_stocks_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Stocks_Received';
				let TableData2 =  [{data:'fund_no'},{data: 'request_id'},{data: 'requestor'},{data:'date_created'},{data: 'action',orderable:false}];
				_DataTableLoader('tbl_purchased_stocks_received',TableURL2,TableData2,false);

				break;
			}
			case "tbl_rawmats":{
				TableURL = baseURL + 'datatable_controller/RawMaterial_Stocks_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action'}];
				_DataTableLoader('tbl_rawmats',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/RawMaterial_OutStocks_DataTable';
				let TableData1 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action'}];
				_DataTableLoader('tbl_rawmats_outofstocks',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/RawMaterial_New_DataTable';
				let TableData2 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_rawmats_new',TableURL2,TableData2,false);

				let TableURL3 = baseURL + 'datatable_controller/RawMaterial_Release_DataTable';
				let TableData3 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_rawmats_release',TableURL3,TableData3,false);
				break;
			}
			case "tbl_officesupplies":{
				TableURL = baseURL + 'datatable_controller/OfficeSupplies_Stocks_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action',orderable:false}];
				_DataTableLoader('tbl_officesupplies',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/OfficeSupplies_Outofstocks_DataTable';
				let TableData1 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action',orderable:false}];
				_DataTableLoader('tbl_officesupplies_outofstocks',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/OfficeSupplies_newstocks_DataTable';
				let TableData2 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_officesupplies_new',TableURL2,TableData2,false);

				let TableURL3 = baseURL + 'datatable_controller/OfficeSupplies_release_DataTable';
				let TableData3 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_officesupplies_release',TableURL3,TableData3,false);
				break;
			}

			case "tbl_spareparts":{
				TableURL = baseURL + 'datatable_controller/SpareParts_Stocks_DataTable';
				TableData =  [{data: 'no'},{data:'item'},{data:'stocks'},{data:'stocks_alert'},{data:'action',orderable:false}];
				_DataTableLoader('tbl_spareparts',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/SpareParts_Outofstocks_DataTable';
				let TableData1 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action',orderable:false}];
				_DataTableLoader('tbl_spareparts_outofstocks',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/SpareParts_newstocks_DataTable';
				let TableData2 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_spareparts_new',TableURL2,TableData2,false);

				let TableURL3 = baseURL + 'datatable_controller/SpareParts_release_DataTable';
				let TableData3 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_spareparts_release',TableURL3,TableData3,false);
				break;
			}
			case "tbl_production_stocks":{
				TableURL = baseURL + 'datatable_controller/RawMat_Production_Stocks_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'action',orderable:false}];
				_DataTableLoader('tbl_production_stocks',TableURL,TableData,false);
				break;
			}
			case "tbl_supplier_item":{
				TableURL = baseURL + 'datatable_controller/SupplierItem_DataTable';
				TableData =  [{data:'item'},{data: 'price'},{data:'status'},{data: 'date_created'},{data: 'action',orderable:false}];
				_DataTableLoader('tbl_supplier_item',TableURL,TableData,supplier_id);
				break;
			} 
			case "tbl_supplier":{
				TableURL = baseURL + 'datatable_controller/Supplier_Datatable';
				TableData =  [{data: 'name'},{data: 'address'},{data: 'mobile'},{data:'status'},{data: 'date_created'},{data: 'action',orderable:false}]; 
				_DataTableLoader('tbl_supplier',TableURL,TableData,false);
				break;
			}
			case "tbl_collection":{
				TableURL = baseURL + 'datatable_controller/Collected_Request_DataTable_Accounting';
				TableData = [{data:'so_no'},{data:'customer'},{data:'bank'},{data:'amount'},{data:'date'},{data:'status'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_collection_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Collected_Approved_DataTable_Accounting';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'bank'},{data:'amount'},{data:'date'},{data:'status'},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_collection_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Collected_Cancelled_DataTable_Accounting';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'bank'},{data:'amount'},{data:'date'},{data:'status'},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_collection_cancelled',TableURL2,TableData2,false);
				break;
			}
			case "tbl_other_purchase_invetory":{
				TableURL = baseURL + 'datatable_controller/Other_purchase_inventory_Request_Accounting';
				TableData = [{data:'trans_no'},{data:'requestor'},{data:'date_created'},{data:'status'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Other_purchase_inventory_received_Accounting';
				let TableData1 = [{data:'trans_no'},{data:'requestor'},{data:'date_created'},{data:'status'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_received',TableURL1,TableData1,false);
				break;
			}
			case "tbl_cashposition_category":{
				TableURL = baseURL + 'datatable_controller/Cashpostion_Category_Accounting';
				TableData = [{data:'name'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_cashposition_category',TableURL,TableData,false);
				break;
			}
		}	 
	}


	return {
		//main function to initiate the module
		init: function(table) {
			_initView_Table(table)
		},
	};

}();

// jQuery(document).ready(function() {
// 	KTDatatablesDataSourceAjaxClient.init();
// });
