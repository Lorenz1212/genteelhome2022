'use strict';
var KTDatatablesDataSourceAjaxClient = function() {
var TableURL;
var TableData;
const queryString = window.location.search;
var url_Params_Status = queryString.replace('?dXJsc3RhdHVz','');
	var _DataTableLoader = async function(link,TableURL,TableData,url_link){
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
				data: {status:url_link},
			},
			columns:TableData,
		});
		
		
	}
	var _initView_Table = function(view){
		switch(view){
			case "tbl_coupon":{
				TableURL = baseURL + 'datatable_controller/Coupon_DataTable';
				TableData = [{data:'no'},{data:'promo_code'},{data:'discount'},{data:'date_from'},{data:'date_to'},{data:'status'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_online_customization":{
				TableURL = baseURL + 'datatable_controller/OnlineCustomization_DataTable';
				TableData = [{data:'no'},{data:'customer'},{data:'email'},{data:'subject'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_online_request":{
				TableURL = baseURL + 'datatable_controller/OnlineRequest_DataTable';
				TableData = [{data:'order_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'sales_person'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_onlineorder":{
				TableURL = baseURL + 'datatable_controller/OnlineOrder_DataTable';
				TableData = [{data:'order_no'},{data:'customer'},{data:'type'},{data:'date_order'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_design_stocks":{
				TableURL = baseURL + 'datatable_controller/Design_Stocks_Request_DataTable';
				TableData = [{data:'project_no'},{data:'image'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_stocks_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Design_Stocks_Approved_DataTable';
				let TableData1 = [{data:'project_no'},{data:'image'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_stocks_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Design_Stocks_Rejected_DataTable';
				let TableData2 = [{data:'project_no'},{data:'image'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_stocks_rejected',TableURL2,TableData2,false);
				break;
			}
			case "tbl_design_project":{
				TableURL = baseURL + 'datatable_controller/Design_Project_Request_DataTable';
				TableData = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_project_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Design_Project_Approved_DataTable';
				let TableData1 = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_project_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Design_Project_Rejected_DataTable';
				let TableData2 = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_project_rejected',TableURL2,TableData2,false);
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
			case "tbl_rawmaterials_add":{
				TableURL = baseURL + 'datatable_controller/RawMaterial_DataTable';
				TableData = [{data:'no'},{data: 'item'},{data:'price'},{data: 'date_created'},{data: 'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_joborder_stocks":{
				TableURL = baseURL + 'datatable_controller/Joborder_Stocks_Request_DataTable';
				TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_joborder_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Joborder_Stocks_Pending_DataTable';
				let TableData1 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_joborder_pending',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Joborder_Stocks_Complete_DataTable';
				let TableData3 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_complete',TableURL3,TableData3,false);

				let TableURL4 = baseURL + 'datatable_controller/Joborder_Stocks_Cancelled_DataTable';
				let TableData4 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_cancelled',TableURL4,TableData4,false);

				let TableURL5 = baseURL + 'datatable_controller/Joborder_Stocks_Material_Request_DataTable';
				let TableData5 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_joborder_material',TableURL5,TableData5,false);

				let TableURL6 = baseURL + 'datatable_controller/Joborder_Stocks_Supervisor_DataTable';
				let TableData6 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_joborder_supervisor',TableURL6,TableData6,false);

				let TableURL7 = baseURL + 'datatable_controller/Joborder_Stocks_Production_DataTable';
				let TableData7 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_production',TableURL7,TableData7,false);
				break;
			}
			case "tbl_joborder_project":{
				TableURL = baseURL + 'datatable_controller/Joborder_Project_Request_DataTable';
				TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_joborder_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Joborder_Project_Pending_DataTable';
				let TableData1 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_joborder_pending',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Joborder_Project_Complete_DataTable';
				let TableData3 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_complete',TableURL3,TableData3,false);

				let TableURL4 = baseURL + 'datatable_controller/Joborder_Project_Cancelled_DataTable';
				let TableData4 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_cancelled',TableURL4,TableData4,false);

				let TableURL5 = baseURL + 'datatable_controller/Joborder_Project_Material_Request_DataTable';
				let TableData5 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_joborder_material',TableURL5,TableData5,false);

				let TableURL6 = baseURL + 'datatable_controller/Joborder_Project_Supervisor_DataTable';
				let TableData6 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_joborder_supervisor',TableURL6,TableData6,false);

				let TableURL7 = baseURL + 'datatable_controller/Joborder_Project_Production_DataTable';
				let TableData7 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_production',TableURL7,TableData7,false);
				break;
			}
			case "tbl_joborder_masterlist_stocks":{
				TableURL = baseURL + 'datatable_controller/Joborder_Masterlist_Stocks_DataTable';
				TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'quantity'},{data:'status'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_masterlist',TableURL,TableData,false);
				break;
			}
			case "tbl_joborder_masterlist_project":{
				TableURL = baseURL + 'datatable_controller/Joborder_Masterlist_Project_DataTable';
				TableData = [{data:'production_no'},{data:'title'},{data:'quantity'},{data:'status'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_masterlist',TableURL,TableData,false);
				break;
			}
			case "tbl_purchase_request_stocks":{
				TableURL = baseURL + 'datatable_controller/Purchase_Material_Stocks_Request_DataTable';
				TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchase_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Purchase_Material_Stocks_Inprogress_DataTable';
				let TableData1 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchase_request_inprogress',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Purchase_Material_Stocks_Complete_DataTable';
				let TableData3 = [{data:'production_no'},{data:'item'},{data:'quantity'},{data:'amount'},{data:'supplier'},{data:'terms'},{data:'date_created'}]; 
				_DataTableLoader('tbl_purchase_request_complete',TableURL3,TableData3,false);
				break;
			}
			case "tbl_purchase_request_project":{
				TableURL = baseURL + 'datatable_controller/Purchase_Material_Project_Request_DataTable';
				TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchase_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Purchase_Material_Project_Inprogress_DataTable';
				let TableData1 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchase_request_inprogress',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Purchase_Material_Project_Complete_DataTable';
				let TableData3 = [{data:'production_no'},{data:'item'},{data:'quantity'},{data:'amount'},{data:'supplier'},{data:'terms'},{data:'date_created'}]; 
				_DataTableLoader('tbl_purchase_request_complete',TableURL3,TableData3,false);
				break;
			}
			case "tbl_material_request_stocks":{
				let TableURL1 = baseURL + 'datatable_controller/Material_Request_Stocks_DataTable';
				let TableData1 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_material_request',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Material_Complete_Stocks_DataTable';
				let TableData3 = [{data:'production_no'},{data:'item'},{data:'quantity'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_material_request_complete',TableURL3,TableData3,false);
				break;
			}
			case "tbl_material_request_project":{
				let TableURL1 = baseURL + 'datatable_controller/Material_Request_Project_DataTable';
				let TableData1 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_material_request',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Material_Complete_Project_DataTable';
				let TableData3 = [{data:'production_no'},{data:'item'},{data:'quantity'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_material_request_complete',TableURL3,TableData3,false);
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
			case "tbl_spareparts_add":{
				TableURL = baseURL + 'datatable_controller/SpareParts_DataTable';
				TableData = [{data:'no'},{data: 'item'},{data: 'date_created'},{data: 'action'}]; 
				_DataTableLoader(view,TableURL,TableData,false);
				break;
			}
			case "tbl_officesupplies_add":{
				TableURL = baseURL + 'datatable_controller/OfficeSupplies_DataTable';
				TableData = [{data:'no'},{data: 'item'},{data: 'date_created'},{data: 'action'}]; 
				_DataTableLoader(view,TableURL,TableData,false);
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
			case "tbl_approval_inspection_stocks":{
				TableURL = baseURL + 'datatable_controller/Approval_Inspection_Stocks_Request_DataTable';
				TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_approval_inspection_stocks_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Approval_Inspection_Stocks_Approved_DataTable';
				let TableData1 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_approval_inspection_stocks_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Approval_Inspection_Stocks_Rejected_DataTable';
				let TableData2 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_approval_inspection_stocks_rejected',TableURL2,TableData2,false);
				break;
			}
			case "tbl_approval_inspection_project":{
				TableURL = baseURL + 'datatable_controller/Approval_Inspection_Project_Request_DataTable';
				TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_approval_inspection_project_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Approval_Inspection_Project_Approved_DataTable';
				let TableData1 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_approval_inspection_project_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Approval_Inspection_Project_Rejected_DataTable';
				let TableData2 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_approval_inspection_project_rejected',TableURL2,TableData2,false);
				break;
			}
			case "tbl_approval_design_stocks_request":{
				TableURL = baseURL + 'datatable_controller/Approval_Design_Stocks_Request_DataTable';
				TableData = [{data:'project_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_approval_design_stocks_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Approval_Design_Stocks_Approved_DataTable';
				let TableData1 = [{data:'project_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_approval_design_stocks_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Approval_Design_Stocks_Rejected_DataTable';
				let TableData2 = [{data:'project_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_approval_design_stocks_rejected',TableURL2,TableData2,false);
				break;
			}
			case "tbl_approval_design_project_request":{
				TableURL = baseURL + 'datatable_controller/Approval_Design_Project_Request_DataTable';
				TableData = [{data:'project_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_approval_design_project_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Approval_Design_Project_Approved_DataTable';
				let TableData1 = [{data:'project_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_approval_design_project_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Approval_Design_Project_Rejected_DataTable';
				let TableData2 = [{data:'project_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_approval_design_project_rejected',TableURL2,TableData2,false);

				break;
			}
			case "tbl_production_stockss":{
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
			case "tbl_salesorder_stocks_production":{
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
			case "tbl_salesorder_project_production":{
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
			case "tbl_salesorder_stocks_request_admin":{
				 TableURL = baseURL + 'datatable_controller/Salesorder_Stocks_Request_DataTable_Admin';
				 TableData = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_approved',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Stocks_Approved_DataTable_Admin';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Stocks_Rejected_DataTable_Admin';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
				break;
			}
			case "tbl_salesorder_project_request_admin":{
				 TableURL = baseURL + 'datatable_controller/Salesorder_Project_Request_DataTable_Admin';
				 TableData = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_approved',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Project_Approved_DataTable_Admin';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Project_Rejected_DataTable_Admin';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
				break;
			}
			case "tbl_salesorder_stocks_superuser":{
				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Stocks_Shipping_DataTable_Superuser';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Stocks_Delivered_DataTable_Superuser';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
				break;
			}
			case "tbl_salesorder_project_superuser":{
				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Project_Shipping_DataTable_Superuser';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Project_Delivered_DataTable_Superuser';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
				break;
			}

			//Repair>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			case "tbl_customization":{
				TableURL = baseURL + 'datatable_controller/Customization_DataTable';
				TableData = [{data:'so_no'},{data:'sales_person'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_joborder_admin":{
				TableURL = baseURL + 'datatable_controller/Joborder_Admin_DataTable';
				TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'status'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_returnmaterials":{
				TableURL = baseURL + 'datatable_controller/ReturnMaterials_DataTable';
				TableData = [{data:'production_no'},{data:'requestor'},{data:'item'},{data:'qty'},{data:'unit'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			
			case "tbl_customization_request":{
				TableURL = baseURL + 'datatable_controller/Customization_Request_DataTable';
				TableData = [{data:'so_no'},{data:'sales_person'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			
			
			case "tbl_salesorder_return":{
				TableURL = baseURL + 'datatable_controller/Salesorder_Return_DataTable';
				TableData = [{data:'so_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'sales_person'},{data:'b_name'},{data:'date_created'},{data:'status'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_users":{
				TableURL = baseURL + 'datatable_controller/Users_DataTable';
				TableData = [{data:'no'},{data:'username'},{data:'name'},{data:'date_created'},{data:'status'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			
			
			case "tbl_material_received":{
				TableURL = baseURL + 'datatable_controller/Material_Received_DataTable';
				TableData = [{data:'production_no'},{data:'item'},{data:'quantity'},{data:'date_created'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_spare_request":{
				TableURL = baseURL + 'datatable_controller/SpareParts_Request_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'qty'},{data:'remarks'},{data:'status'},{data:'date_created'}];
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			
			case "tbl_officesupplies_request":{
				TableURL = baseURL + 'datatable_controller/OfficeSupplies_Request_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'qty'},{data:'remarks'},{data:'date_created'},{data:'status'},];
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_officesupplies_received":{
				TableURL = baseURL + 'datatable_controller/OfficeSupplies_Received_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'qty'},{data:'date_created'}];
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_spare_received":{
				TableURL = baseURL + 'datatable_controller/SpareParts_Received_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'qty'},{data:'date_created'}];
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			case "tbl_production_stocks":{
				TableURL = baseURL + 'datatable_controller/Production_Stocks_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'}];
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
		
			case "tbl_service_request":{
				TableURL = baseURL + 'datatable_controller/Customer_Concern_DataTable';
				TableData = [{data:'no'},{data:'production_no'},{data:'customer'},{data:'date_created'},{data:'status'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break
			}

			//Approval
			case "tbl_approval_purchased_request":{
				TableURL = baseURL + 'datatable_controller/Approval_Purchase_Request_DataTable';
				TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_approval_purchased_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Approval_Purchase_Approved_DataTable';
				let TableData1 =[{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_approval_purchased_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Approval_Purchase_Rejected_DataTable';
				let TableData2 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_approval_purchased_rejected',TableURL2,TableData2,false);
				break;
			}
			
			case "tbl_approval_userrequest":{
				TableURL = baseURL + 'datatable_controller/Approval_UsersRequest_DataTable';
				TableData = [{data:'no'},{data:'username'},{data:'name'},{data:'date_created'},{data:'status'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,url_Params_Status);
				break;
			}
			
			case "tbl_approval_officesupplies":{
				TableURL = baseURL + 'datatable_controller/Approval_OfficeSupplies_Request_DataTable';
				TableData =  [{data: 'no'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
				_DataTableLoader('tbl_approval_officesupplies_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Approval_OfficeSupplies_Partial_DataTable';
				let TableData1 =  [{data: 'no'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
				_DataTableLoader('tbl_approval_officesupplies_partial',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Approval_OfficeSupplies_Complete_DataTable';
				let TableData2 =  [{data: 'no'},{data: 'request_id'},{data:'item'},{data:'qty'},{data:'date_created'}];
				_DataTableLoader('tbl_approval_officesupplies_complete',TableURL2,TableData2,false);
				break;
			}
			case "tbl_approval_spareparts":{
				TableURL = baseURL + 'datatable_controller/Approval_SpareParts_Request_DataTable';
				TableData =  [{data: 'no'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
				_DataTableLoader('tbl_approval_spareparts_request',TableURL,TableData,url_Params_Status);

				let TableURL1 = baseURL + 'datatable_controller/Approval_SpareParts_Partial_DataTable';
				let TableData1 =  [{data: 'no'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
				_DataTableLoader('tbl_approval_spareparts_approved',TableURL1,TableData1,url_Params_Status);

				let TableURL2 = baseURL + 'datatable_controller/Approval_SpareParts_Complete_DataTable';
				let TableData2 =  [{data: 'no'},{data: 'request_id'},{data:'item'},{data:'qty'},{data:'date_created'}];
				_DataTableLoader('tbl_approval_spareparts_complete',TableURL2,TableData2,false);
				break;
			}
			case "tbl_customer_list":{
				TableURL = baseURL + 'datatable_controller/Customer_List_DataTable';
				TableData =  [{data: 'no'},{data: 'name'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status'},{data: 'action'}];
				_DataTableLoader('tbl_customer_list',TableURL,TableData,false);
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
