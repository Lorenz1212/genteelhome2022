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
				TableData = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_stocks_request',TableURL,TableData,[[ 0, "desc" ]]);

				let TableURL1 = baseURL + 'datatable_controller/Design_Stocks_Approved_DataTable';
				let TableData1 = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_stocks_approved',TableURL1,TableData1,[[ 0, "desc" ]]);

				let TableURL2 = baseURL + 'datatable_controller/Design_Stocks_Rejected_DataTable';
				let TableData2 = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_stocks_rejected',TableURL2,TableData2,[[ 0, "desc" ]]);
				break;
			}
			case "tbl_design_project":{
				TableURL = baseURL + 'datatable_controller/Design_Project_Request_DataTable';
				TableData = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_project_request',TableURL,TableData,[[ 0, "desc" ]]);

				let TableURL1 = baseURL + 'datatable_controller/Design_Project_Approved_DataTable';
				let TableData1 = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_project_approved',TableURL1,TableData1,[[ 0, "desc" ]]);

				let TableURL2 = baseURL + 'datatable_controller/Design_Project_Rejected_DataTable';
				let TableData2 = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_design_project_rejected',TableURL2,TableData2,[[ 0, "desc" ]]);
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
