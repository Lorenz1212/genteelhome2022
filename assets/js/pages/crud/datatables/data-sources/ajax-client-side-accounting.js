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
			responsive: true,
			info: true,
			language: { 
			 	infoEmpty: "No records available", 
			 },
			
			serverSide:false,
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
			case "tbl_salesorder_stocks_accounting":{
				 TableURL = baseURL + 'datatable_controller/Salesorder_Stocks_Request_DataTable_Production';
				 TableData = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'status'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_approved',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Stocks_Shipping_DataTable_Production';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Stocks_Delivered_DataTable_Production';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
				break;
			}
			case "tbl_salesorder_project_accounting":{
				 TableURL = baseURL + 'datatable_controller/Salesorder_Project_Request_DataTable_Production';
				 TableData = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'status'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_approved',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Project_Shipping_DataTable_Production';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Project_Delivered_DataTable_Production';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
				break;
			}
			case "tbl_purchased_material_stocks_request":{
				TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Request';
				TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Approval';
				let TableData1 = [{data:'fund_no'},{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Received';
				let TableData2 = [{data:'fund_no'},{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
				break;
			}
			case "tbl_purchased_material_project_request":{
				TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Request';
				TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Approval';
				let TableData1 = [{data:'fund_no'},{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Received';
				let TableData2 = [{data:'fund_no'},{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
				break;
			}
			case "tbl_purchased_stocks_request":{
				TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Stocks_Request';
				TableData =  [{data: 'request_id'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
				_DataTableLoader('tbl_purchased_stocks_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Stocks_Approval';
				let TableData1 =  [{data:'fund_no'},{data: 'request_id'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
				_DataTableLoader('tbl_purchased_stocks_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Stocks_Received';
				let TableData2 =  [{data:'fund_no'},{data: 'request_id'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
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
				break;
			}
			case "tbl_officesupplies":{
				TableURL = baseURL + 'datatable_controller/OfficeSupplies_Stocks_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action'}];
				_DataTableLoader('tbl_officesupplies',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/OfficeSupplies_Outofstocks_DataTable';
				let TableData1 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action'}];
				_DataTableLoader('tbl_officesupplies_outofstocks',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/OfficeSupplies_newstocks_DataTable';
				let TableData2 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_officesupplies_new',TableURL2,TableData2,false);
				break;
			}

			case "tbl_spareparts":{
				TableURL = baseURL + 'datatable_controller/SpareParts_Stocks_DataTable';
				TableData =  [{data: 'no'},{data:'item'},{data:'stocks'},{data:'stocks_alert'},{data:'action'}];
				_DataTableLoader('tbl_spareparts',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/SpareParts_Outofstocks_DataTable';
				let TableData1 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action'}];
				_DataTableLoader('tbl_spareparts_outofstocks',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/SpareParts_newstocks_DataTable';
				let TableData2 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_spareparts_new',TableURL2,TableData2,false);
				break;
			}
			case "tbl_production_stocks":{
				TableURL = baseURL + 'datatable_controller/RawMat_Production_Stocks_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'action'}];
				_DataTableLoader('tbl_production_stocks',TableURL,TableData,false);
				break;
			}
			case "tbl_supplier_item":{
				TableURL = baseURL + 'datatable_controller/SupplierItem_DataTable';
				TableData =  [{data:'item'},{data: 'price'},{data:'status'},{data: 'date_created'},{data: 'action'}];
				_DataTableLoader('tbl_supplier_item',TableURL,TableData,supplier_id);
				break;
			}
			case "tbl_supplier":{
				TableURL = baseURL + 'datatable_controller/Supplier_Datatable';
				TableData =  [{data: 'name'},{data: 'address'},{data: 'mobile'},{data:'status'},{data: 'date_created'},{data: 'action'}]; 
				_DataTableLoader('tbl_supplier',TableURL,TableData,false);
				break;
			}
			case "tbl_customer_deposite":{
				TableURL = baseURL + 'datatable_controller/Customer_Collected_Request_DataTable';
				TableData = [{data:'so_no'},{data:'customer'},{data:'bank'},{data:'amount'},{data:'date'},{data:'action'}]; 
				_DataTableLoader('tbl_customer_deposite',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Customer_Collected_Approved_DataTable';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'bank'},{data:'amount'},{data:'date'},{data:'action'}];
				_DataTableLoader('tbl_customer_collected',TableURL1,TableData1,false);
				break;
			}
		}	 
	}


	return {
		//main function to initiate the module
		init: function(link) {
			var link = $('.link').attr('data-link');
			_initView_Table(link)
		},
	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceAjaxClient.init();
});
