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
				let TableData =  [{data:'region'},{data:'shipping_range',responsivePriority:1},{data:'action'}];
				_DataTableLoader('tbl_shipping',response,TableData,[[0,'desc']]);
				break;
			}
			case "tbl_testimony":{
				let TableData = [{data:'no',visible:false},{data:'image'},{data:'name',className:"text-nowrap"},{data:'description'},{data:'date_created',className:"text-nowrap"},{data:'action'}];
				_DataTableLoader('tbl_testimony',response,TableData,[[4,'desc']]); 
				break;
			}
			case "tbl_category":{
				let TableData = [{data:'image'},{data:'name',className:"text-nowrap"},{data:'date_created',className:"text-nowrap"},{data:'status',className:"text-nowrap"},{data:'action'}];
				_DataTableLoader('tbl_category',response,TableData,[[2,'desc']]); 
				break;
			}
			case "tbl_sub_category":{
				let TableData = [{data:'name',className:"text-nowrap"},{data:'date_created',className:"text-nowrap"},{data:'status',className:"text-nowrap"},{data:'action'}];
				_DataTableLoader('tbl_sub_category',response,TableData,[[1,'desc']]); 
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
