'use strict';
var KTDatatablesDataSourceAjaxClient = function() {
	var _DataTableLoader = async function(action,response,TableData,order_by){
		var table = $('#'+action);
		table.DataTable().clear().destroy();
		$.fn.dataTable.ext.errMode = 'throw';
		table.DataTable({
			responsive: true,
			processing: true,
			serverSide: false,
			destroy: true,
			order:order_by,
			language: {
		      emptyTable: "No Data Available"
		    },
			data: response,
			columns:TableData,
		});
	}
	var _initView_Table = function(view,response){
		switch(view){
			case "tbl_products":{
				let TableData =  [{data:'id',visible:false},{data:'c_code',responsivePriority:1},{data:'title',className:"text-nowrap",width:'100%'},{data:'date_created',className:"text-nowrap"},{data:'status'},{data: 'action',responsivePriority:-1}];
				_DataTableLoader('tbl_products',response,TableData,[[0,'desc']]);
				break;
			}
			case "tbl_voucher":{
				let TableData =  [{data:'no',visible:false},{data:'promo_code',responsivePriority:1},{data:'discount',className:"text-nowrap"},{data:'date_from'},{data:'date_to'},{data:'status'},{data: 'action',responsivePriority:-1}];
				_DataTableLoader('tbl_voucher',response,TableData,[[0,'desc']]);
				break;
			}
			
			case "tbl_shipping":{
				let TableURL = baseURL + 'datatable_controller/Web_Shipping_DataTable';
				let TableData = [{data:'region'},{data:'shipping_range'},{data:'action'}]; 
				_DataTableLoader('tbl_shipping',TableURL,TableData,false);
				break;
			}
			case "tbl_testimony":{
				TableURL = baseURL + 'datatable_controller/Web_Testimony_DataTable';
				TableData = [{data:'no'},{data:'image'},{data:'name'},{data:'description'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_testimony',TableURL,TableData,[[4,'desc']]);
				break;
			}
		}	 
	}


	return {
		//main function to initiate the module
		init: function(link,response) {
			_initView_Table(link,response)
		},
	};

}();

// jQuery(document).ready(function() {
// 	KTDatatablesDataSourceAjaxClient.init();
// });
