'use strict';
var KTDatatablesDataSourceAjaxClientProduction = function() {
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

				let TableURL5 = baseURL + 'datatable_controller/Joborder_Stocks_Material_Request_DataTable';
				let TableData5 = [{data:'production_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}];

				let TableURL6 = baseURL + 'datatable_controller/Joborder_Stocks_Supervisor_DataTable';
				let TableData6 = [{data:'production_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false,width:20,className:"text-center"}]; 
				_DataTableLoader('tbl_joborder_supervisor',TableURL6,TableData6,[[ 4,'desc']]);

				let TableURL7 = baseURL + 'datatable_controller/Joborder_Stocks_Production_DataTable';
				let TableData7 = [{data:'production_no'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_production',TableURL7,TableData7,[[ 4,'desc']]);
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

				let TableURL5 = baseURL + 'datatable_controller/Joborder_Project_Material_Request_DataTable';
				let TableData5 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_joborder_material',TableURL5,TableData5,[[ 3,'desc']]);

				let TableURL6 = baseURL + 'datatable_controller/Joborder_Project_Supervisor_DataTable';
				let TableData6 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action',orderable:false}]; 
				_DataTableLoader('tbl_joborder_supervisor',TableURL6,TableData6,[[ 3,'desc']]);

				let TableURL7 = baseURL + 'datatable_controller/Joborder_Project_Production_DataTable';
				let TableData7 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'}]; 
				_DataTableLoader('tbl_joborder_production',TableURL7,TableData7,[[ 3,'desc']]);
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
