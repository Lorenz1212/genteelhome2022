'use strict';
var KTDatatablesDataSourceAjaxClient = function() {
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
			case "tbl_rawmaterials_add":{
				TableURL = baseURL + 'datatable_controller/RawMaterial_DataTable';
				TableData = [{data:'no'},{data: 'item'},{data:'price'},{data: 'date_created'},{data: 'action'}]; 
				_DataTableLoader(view,TableURL,TableData,false);
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
			case "tbl_joborder_stocks":{
				TableURL = baseURL + 'datatable_controller/Joborder_Stocks_Request_DataTable';
				TableData = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_joborder_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Joborder_Stocks_Pending_DataTable';
				let TableData1 = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_joborder_pending',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Joborder_Stocks_Complete_DataTable';
				let TableData3 = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_complete',TableURL3,TableData3,false);

				let TableURL4 = baseURL + 'datatable_controller/Joborder_Stocks_Cancelled_DataTable';
				let TableData4 = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_cancelled',TableURL4,TableData4,false);

				let TableURL5 = baseURL + 'datatable_controller/Joborder_Stocks_Material_Request_DataTable';
				let TableData5 = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}];

				let TableURL6 = baseURL + 'datatable_controller/Joborder_Stocks_Supervisor_DataTable';
				let TableData6 = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_joborder_supervisor',TableURL6,TableData6,false);

				let TableURL7 = baseURL + 'datatable_controller/Joborder_Stocks_Production_DataTable';
				let TableData7 = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_production',TableURL7,TableData7,false);
				break;
			}
			case "tbl_joborder_project":{
				TableURL = baseURL + 'datatable_controller/Joborder_Project_Request_DataTable';
				TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_joborder_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Joborder_Project_Pending_DataTable';
				let TableData1 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_joborder_pending',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Joborder_Project_Complete_DataTable';
				let TableData3 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_complete',TableURL3,TableData3,false);

				let TableURL4 = baseURL + 'datatable_controller/Joborder_Project_Cancelled_DataTable';
				let TableData4 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_cancelled',TableURL4,TableData4,false);

				let TableURL5 = baseURL + 'datatable_controller/Joborder_Project_Material_Request_DataTable';
				let TableData5 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_joborder_material',TableURL5,TableData5,false);

				let TableURL6 = baseURL + 'datatable_controller/Joborder_Project_Supervisor_DataTable';
				let TableData6 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_joborder_supervisor',TableURL6,TableData6,false);

				let TableURL7 = baseURL + 'datatable_controller/Joborder_Project_Production_DataTable';
				let TableData7 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_production',TableURL7,TableData7,false);
				break;
			}
			case "tbl_joborder_masterlist_stocks":{
				TableURL = baseURL + 'datatable_controller/Joborder_Masterlist_Stocks_DataTable';
				TableData = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'quantity'},{data:'date_created'},{data:'requestor'},{data:'status'}]; 
				_DataTableLoader('tbl_joborder_masterlist',TableURL,TableData,false);
				break;
			}
			case "tbl_joborder_masterlist_project":{
				TableURL = baseURL + 'datatable_controller/Joborder_Masterlist_Project_DataTable';
				TableData = [{data:'production_no'},{data:'title'},{data:'quantity',visible:false},{data:'date_created'},{data:'requestor'},{data:'status'}]; 
				_DataTableLoader('tbl_joborder_masterlist',TableURL,TableData,false);
				break;
			}
			case "tbl_purchase_request_stocks":{
				TableURL = baseURL + 'datatable_controller/Purchase_Material_Stocks_Request_DataTable';
				TableData = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_purchase_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Purchase_Material_Stocks_Inprogress_DataTable';
				let TableData1 = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_purchase_request_inprogress',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Purchase_Material_Stocks_Complete_DataTable';
				let TableData3 = [{data:'production_no'},{data:'item'},{data:'quantity'},{data:'amount'},{data:'supplier'},{data:'terms'},{data:'date_created'}]; 
				_DataTableLoader('tbl_purchase_request_complete',TableURL3,TableData3,false);
				break;
			}
			case "tbl_purchase_request_project":{
				TableURL = baseURL + 'datatable_controller/Purchase_Material_Project_Request_DataTable';
				TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_purchase_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Purchase_Material_Project_Inprogress_DataTable';
				let TableData1 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_purchase_request_inprogress',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Purchase_Material_Project_Complete_DataTable';
				let TableData3 = [{data:'production_no'},{data:'item'},{data:'quantity'},{data:'amount'},{data:'supplier'},{data:'terms'},{data:'date_created'}]; 
				_DataTableLoader('tbl_purchase_request_complete',TableURL3,TableData3,false);
				break;
			}
			case "tbl_material_request_stocks":{
				let TableURL1 = baseURL + 'datatable_controller/Material_Request_Stocks_DataTable';
				let TableData1 = [{data:'production_no'},{data:'image',visible:false},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_material_request',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Material_Complete_Stocks_DataTable';
				let TableData3 = [{data:'production_no'},{data:'item'},{data:'quantity'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_material_request_complete',TableURL3,TableData3,false);
				break;
			}
			case "tbl_material_request_project":{
				let TableURL1 = baseURL + 'datatable_controller/Material_Request_Project_DataTable';
				let TableData1 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_material_request',TableURL1,TableData1,false);

				let TableURL3 = baseURL + 'datatable_controller/Material_Complete_Project_DataTable';
				let TableData3 = [{data:'production_no'},{data:'item'},{data:'quantity'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_material_request_complete',TableURL3,TableData3,false);
				break;
			}

			case "tbl_rawmats":{
				TableURL = baseURL + 'datatable_controller/RawMaterial_Stocks_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_rawmats',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/RawMaterial_OutStocks_DataTable';
				let TableData1 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_rawmats_outofstocks',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/RawMaterial_New_DataTable';
				let TableData2 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_rawmats_new',TableURL2,TableData2,false);
				break;
			}
			case "tbl_officesupplies":{
				TableURL = baseURL + 'datatable_controller/OfficeSupplies_Stocks_DataTable';
				TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_officesupplies',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/OfficeSupplies_Outofstocks_DataTable';
				let TableData1 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_officesupplies_outofstocks',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/OfficeSupplies_newstocks_DataTable';
				let TableData2 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_officesupplies_new',TableURL2,TableData2,false);
				break;
			}

			case "tbl_spareparts":{
				TableURL = baseURL + 'datatable_controller/SpareParts_Stocks_DataTable';
				TableData =  [{data: 'no'},{data:'item'},{data:'stocks'},{data:'stocks_alert'},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_spareparts',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/SpareParts_Outofstocks_DataTable';
				let TableData1 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_spareparts_outofstocks',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/SpareParts_newstocks_DataTable';
				let TableData2 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_spareparts_new',TableURL2,TableData2,false);
				break;
			}
			case "tbl_spareparts_add":{
				TableURL = baseURL + 'datatable_controller/SpareParts_DataTable';
				TableData = [{data:'no'},{data: 'item'},{data: 'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader(view,TableURL,TableData,false);
				break;
			}
			case "tbl_officesupplies_add":{
				TableURL = baseURL + 'datatable_controller/OfficeSupplies_DataTable';
				TableData = [{data:'no'},{data: 'item'},{data: 'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader(view,TableURL,TableData,false);
				break;
			}
			case "tbl_customer_deposite":{
				TableURL = baseURL + 'datatable_controller/Customer_Collected_Request_DataTable';
				TableData = [{data:'so_no'},{data:'customer'},{data:'bank'},{data:'amount'},{data:'date'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_customer_deposite',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Customer_Collected_Approved_DataTable';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'bank'},{data:'amount'},{data:'date'},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_customer_collected',TableURL1,TableData1,false);
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
				TableData =  [{data:'item'},{data: 'price'},{data:'status'},{data: 'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_supplier_item',TableURL,TableData,supplier_id);
				break;
			}
			case "tbl_supplier":{
				TableURL = baseURL + 'datatable_controller/Supplier_Datatable';
				TableData =  [{data: 'name'},{data: 'address'},{data: 'mobile'},{data:'status'},{data: 'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_supplier',TableURL,TableData,false);
				break;
			}
			case "tbl_salesorder_stocks_production":{
				 TableURL = baseURL + 'datatable_controller/Salesorder_Stocks_Request_DataTable_Production';
				 TableData = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_salesorder_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Stocks_Approved_DataTable_Production';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_salesorder_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Stocks_Completed_DataTable_Production';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_salesorder_completed',TableURL2,TableData2,false);

				let TableURL3 = baseURL + 'datatable_controller/Salesorder_Stocks_Cancelled_DataTable_Production';
				let TableData3 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_salesorder_cancelled',TableURL3,TableData3,false);
				break;
			}
			case "tbl_salesorder_project_production":{
				 TableURL = baseURL + 'datatable_controller/Salesorder_Project_Request_DataTable_Production';
				 TableData = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_salesorder_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Project_Approved_DataTable_Production';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_salesorder_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Project_Completed_DataTable_Production';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}];
				_DataTableLoader('tbl_salesorder_completed',TableURL2,TableData2,false);

				let TableURL3 = baseURL + 'datatable_controller/Salesorder_Project_Cancelled_DataTable_Production';
				let TableData3 = [{data:'so_no'},{data:'customer'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status',width:20},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_salesorder_cancelled',TableURL3,TableData3,false);
				break;
			}
			case "tbl_salesorder_stocks_request_admin":{
				 TableURL = baseURL + 'datatable_controller/Salesorder_Stocks_Request_DataTable_Admin';
				 TableData = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_salesorder_approved',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Stocks_Approved_DataTable_Admin';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Stocks_Rejected_DataTable_Admin';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
				break;
			}
			case "tbl_salesorder_project_request_admin":{
				 TableURL = baseURL + 'datatable_controller/Salesorder_Project_Request_DataTable_Admin';
				 TableData = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_salesorder_approved',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Salesorder_Project_Approved_DataTable_Admin';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Salesorder_Project_Rejected_DataTable_Admin';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
				break;
			}

			case "tbl_sales_delivery_superuser":{
				let TableURL1 = baseURL + 'datatable_controller/Sales_Delivery_Request_DataTable_Superuser';
				let TableData1 = [{data:'so_no'},{data:'customer'},{data:'email'},{data:'mobile'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_delivery_request',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Sales_Delivery_Ship_DataTable_Superuser';
				let TableData2 = [{data:'so_no'},{data:'customer'},{data:'email'},{data:'mobile'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_delivery_shipping',TableURL2,TableData2,false);

				let TableURL3 = baseURL + 'datatable_controller/Sales_Delivery_Received_DataTable_Superuser';
				let TableData3 = [{data:'so_no'},{data:'customer'},{data:'email'},{data:'mobile'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_delivery_received',TableURL3,TableData3,false);

				let TableURL4 = baseURL + 'datatable_controller/Sales_Delivery_Completed_DataTable_Superuser';
				let TableData4 = [{data:'so_no'},{data:'customer'},{data:'email'},{data:'mobile'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_delivery_completed',TableURL4,TableData4,false);

				let TableURL5 = baseURL + 'datatable_controller/Sales_Delivery_Cancelled_DataTable_Superuser';
				let TableData5 = [{data:'so_no'},{data:'customer'},{data:'email'},{data:'mobile'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_delivery_cancelled',TableURL5,TableData5,false);
				break;
			}
			case "tbl_return_item_warehouse_superuser":{
				let TableURL = baseURL + 'datatable_controller/Return_Item_Good_DataTable_Superuser';
				let TableData = [{data:'no'},{data:'item'},{data:'quantity'},{data:'remarks'},{data:'type'},{data:'date_created'}]; 
				_DataTableLoader('tbl_return_item_good',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Return_Item_Rejected_DataTable_Superuser';
				let TableData1 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'remarks'},{data:'type'},{data:'date_created'}]; 
				_DataTableLoader('tbl_return_item_rejected',TableURL1,TableData1,false);
				break;
			}
			case "tbl_return_item_customer_superuser":{
				let TableURL = baseURL + 'datatable_controller/Return_Item_Repair_Customer_DataTable_Superuser';
				let TableData = [{data:'no'},{data:'item'},{data:'quantity'},{data:'remarks'},{data:'date_created'}]; 
				_DataTableLoader('tbl_return_item_repair',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Return_Item_Good_Customer_DataTable_Superuser';
				let TableData1 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'remarks'},{data:'date_created'}]; 
				_DataTableLoader('tbl_return_item_good',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Return_Item_Rejected_Customer_DataTable_Superuser';
				let TableData2 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'remarks'},{data:'date_created'}]; 
				_DataTableLoader('tbl_return_item_rejected',TableURL2,TableData2,false);

				break;
			}
			case "tbl_request_material":{
				let TableURL = baseURL + 'datatable_controller/Request_Material_List_Datatable';
				let TableData = [{data:'no'},{data:'item'},{data:'quantity'},{data:'type'},{data:'date_created'}]; 
				_DataTableLoader('tbl_request_material_list',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Request_Material_Received_Datatable';
				let TableData1 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'type'},{data:'date_created'}]; 
				_DataTableLoader('tbl_request_material_received',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Request_Material_Cancalled_Datatable';
				let TableData2 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'type'},{data:'date_created'}]; 
				_DataTableLoader('tbl_request_material_cancelled',TableURL2,TableData2,false);
				break;
			}
			case "tbl_request_material_superuser":{
				let TableURL = baseURL + 'datatable_controller/Request_Material_List_Superuser_Datatable';
				let TableData = [{data:'no'},{data:'item'},{data:'quantity'},{data:'type'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_request_material_list',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Request_Material_Received_Superuser_Datatable';
				let TableData1 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'type'},{data:'date_created'}]; 
				_DataTableLoader('tbl_request_material_received',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Request_Material_Cancelled_Superuser_Datatable';
				let TableData2 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'type'},{data:'date_created'}]; 
				_DataTableLoader('tbl_request_material_cancelled',TableURL2,TableData2,false);
				break;
			}
			case "tbl_service_request_sales":{
				TableURL = baseURL + 'datatable_controller/Customer_Concern_Request_Sales_DataTable';
				TableData = [{data:'no'},{data:'production_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_service_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Customer_Concern_Approved_Sales_DataTable';
				let TableData1 = [{data:'no'},{data:'production_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_service_approved',TableURL1,TableData1,false);
				break
			}
			case "tbl_service_request_superuser":{
				TableURL = baseURL + 'datatable_controller/Customer_Concern_Request_Superuser_DataTable';
				TableData = [{data:'no'},{data:'production_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_service_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Customer_Concern_Approved_Superuser_DataTable';
				let TableData1 = [{data:'no'},{data:'production_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_service_approved',TableURL1,TableData1,false);
				break
			}
			case "tbl_onlineorder":{
				TableURL = baseURL + 'datatable_controller/OnlineOrder_DataTable';
				TableData = [{data:'order_no'},{data:'customer'},{data:'type'},{data:'date_order'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_onlineorder_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Preorder_DataTable';
				let TableData1 = [{data:'order_no'},{data:'title'},{data:'qty'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_preorder_request',TableURL1,TableData1,false);
				break;
			}
			case "tbl_preoder":{
				TableURL = baseURL + 'datatable_controller/Pre_Order_Request_Datatable';
				TableData = [{data:'order_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_preoder_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Pre_Order_Approved_Datatable';
				let TableData1 = [{data:'order_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_preoder_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Pre_Order_Rejected_Datatable';
				let TableData2 = [{data:'order_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_preoder_rejected',TableURL2,TableData2,false);
				break;
			}
			case "tbl_customized_sales":{
				TableURL = baseURL + 'datatable_controller/Customized_Request_Sales_Datatable';
				TableData = [{data:'no'},{data:'subject'},{data:'date_created'},{data:'action',orderable:false}];
				_DataTableLoader('tbl_customized_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Customized_Approved_Sales_Datatable';
				let TableData1 = [{data:'no'},{data:'subject'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_customized_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Customized_Rejected_Sales_Datatable';
				let TableData2 = [{data:'no'},{data:'subject'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_customized_rejected',TableURL2,TableData2,false);
				break;
			}
			case "tbl_customized":{
				TableURL = baseURL + 'datatable_controller/Customized_Request_Datatable';
				TableData = [{data:'no'},{data:'subject'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_customized_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Customized_Approved_Datatable';
				let TableData1 = [{data:'no'},{data:'subject'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_customized_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Customized_Rejected_Datatable';
				let TableData2 = [{data:'no'},{data:'subject'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_customized_rejected',TableURL2,TableData2,false);
				break;
			}
			case "tbl_inquiry":{
				TableURL = baseURL + 'datatable_controller/Inquiry_Request_Sales_Datatable';
				TableData = [{data:'no'},{data:'subject'},{data:'customer'},{data:'email'},{data:'date_created'},{data:'action',orderable:false}];
				_DataTableLoader('tbl_inquiry_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Inquiry_Approved_Sales_Datatable';
				let TableData1 = [{data:'no'},{data:'subject'},{data:'customer'},{data:'email'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_inquiry_approved',TableURL1,TableData1,false);
				break;
			}
			case "tbl_users":{
				TableURL = baseURL + 'datatable_controller/Users_DataTable';
				TableData = [{data:'no'},{data:'username'},{data:'name'},{data:'date_created'},{data:'status'},{data:'action',orderable:false}]; 
				_DataTableLoader(view,TableURL,TableData,false);
				break;
			}

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
		init: function(link) {
			var link = $('.link').attr('data-link');
			_initView_Table(link)
		},
	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceAjaxClient.init();
});
