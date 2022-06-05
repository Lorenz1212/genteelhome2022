'use strict';
var KTDatatablesDataSourceAjaxClientCreative = function() {
var TableURL;
var TableData;
var _DataTableLoader = async function(link,TableURL,TableData,order_by){
	var table = $('#'+link);
	table.DataTable().clear().destroy();
	$.fn.dataTable.ext.errMode = 'throw';
	table.DataTable({
		destroy: true,
		responsive: true,
		info: true,
		serverSide:false,
		order :order_by,
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
		},
		columns:TableData,
	});
}
	var _initView_Table = function(view){
		switch(view){
			case "tbl_design_stocks":{
				TableURL = baseURL + 'datatable_controller/Design_Stocks_Request_DataTable';
				TableData = [{data:'id',visible:false},{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_stocks_request',TableURL,TableData,[[ 0, "desc" ]]);

				let TableURL1 = baseURL + 'datatable_controller/Design_Stocks_Approved_DataTable';
				let TableData1 = [{data:'id',visible:false},{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_stocks_approved',TableURL1,TableData1,[[ 0, "desc" ]]);

				let TableURL2 = baseURL + 'datatable_controller/Design_Stocks_Rejected_DataTable';
				let TableData2 = [{data:'id',visible:false},{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_stocks_rejected',TableURL2,TableData2,[[ 0, "desc" ]]);
				break;
			}
			case "tbl_design_project":{
				TableURL = baseURL + 'datatable_controller/Design_Project_Request_DataTable';
				TableData = [{data:'id',visible:false},{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_project_request',TableURL,TableData,[[ 0, "desc" ]]);

				let TableURL1 = baseURL + 'datatable_controller/Design_Project_Approved_DataTable';
				let TableData1 = [{data:'id',visible:false},{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_project_approved',TableURL1,TableData1,[[ 0, "desc" ]]);

				let TableURL2 = baseURL + 'datatable_controller/Design_Project_Rejected_DataTable';
				let TableData2 = [{data:'id',visible:false},{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_project_rejected',TableURL2,TableData2,[[ 0, "desc" ]]);
				break;
			}
			case "tbl_customized":{
				TableURL = baseURL + 'datatable_controller/Customized_Request_Datatable';
				TableData = [{data:'no',visible:false},{data:'subject'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_customized_request',TableURL,TableData,[[0,'desc']]);

				let TableURL1 = baseURL + 'datatable_controller/Customized_Approved_Datatable';
				let TableData1 = [{data:'no',visible:false},{data:'subject'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_customized_approved',TableURL1,TableData1,[[0,'desc']]);

				let TableURL2 = baseURL + 'datatable_controller/Customized_Rejected_Datatable';
				let TableData2 = [{data:'no',visible:false},{data:'subject'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_customized_rejected',TableURL2,TableData2,[[0,'desc']]);
				break;
			}
			case "tbl_preoder":{
				TableURL = baseURL + 'datatable_controller/Pre_Order_Request_Datatable';
				TableData = [{data:'order_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_preoder_request',TableURL,TableData,[[4,'desc']]);

				let TableURL1 = baseURL + 'datatable_controller/Pre_Order_Approved_Datatable';
				let TableData1 = [{data:'order_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_preoder_approved',TableURL1,TableData1,[[4,'desc']]);

				let TableURL2 = baseURL + 'datatable_controller/Pre_Order_Rejected_Datatable';
				let TableData2 = [{data:'order_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_preoder_rejected',TableURL2,TableData2,[[4,'desc']]);
				break;
			}
			case "tbl_joborder_stocks":{
				TableURL = baseURL + 'datatable_controller/Joborder_Stocks_Request_DataTable';
				TableData = [{data:'production_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_joborder_request',TableURL,TableData,[[ 4,'desc']]);

				let TableURL1 = baseURL + 'datatable_controller/Joborder_Stocks_Pending_DataTable';
				let TableData1 = [{data:'production_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_joborder_pending',TableURL1,TableData1,[[ 4,'desc']]);

				let TableURL3 = baseURL + 'datatable_controller/Joborder_Stocks_Complete_DataTable';
				let TableData3 = [{data:'production_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_complete',TableURL3,TableData3,[[ 4,'desc']]);

				let TableURL4 = baseURL + 'datatable_controller/Joborder_Stocks_Cancelled_DataTable';
				let TableData4 = [{data:'production_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_cancelled',TableURL4,TableData4,[[ 4,'desc']]);
				break;
			}
			case "tbl_joborder_project":{
				TableURL = baseURL + 'datatable_controller/Joborder_Project_Request_DataTable';
				TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_joborder_request',TableURL,TableData,[[ 3,'desc']]);

				let TableURL1 = baseURL + 'datatable_controller/Joborder_Project_Pending_DataTable';
				let TableData1 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_joborder_pending',TableURL1,TableData1,[[ 3,'desc']]);

				let TableURL3 = baseURL + 'datatable_controller/Joborder_Project_Complete_DataTable';
				let TableData3 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_complete',TableURL3,TableData3,[[ 3,'desc']]);

				let TableURL4 = baseURL + 'datatable_controller/Joborder_Project_Cancelled_DataTable';
				let TableData4 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_cancelled',TableURL4,TableData4,[[ 3,'desc']]);
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
