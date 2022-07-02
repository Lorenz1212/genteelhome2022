'use strict';
var KTDatatablesDataSourceAjaxClient = function() {
	var _DataTableLoader = async function(action,response,TableData,order_by,reload){
		var table = $('#'+action);
		if(reload == 'reload'){
			 table.ajax.reload(null, false);
		}else{
			table.DataTable().clear().destroy();
		}
		$.fn.dataTable.ext.errMode = 'throw';
		table.DataTable({
			responsive: true,
			processing: true,
			serverSide: false,
			destroy: true,
			stateSave: true,
			order:order_by,
			language: {
		      emptyTable: "No Data Available"
		    },
			data: response,
			columns:TableData,
		})
	}
	var _initView_Table = function(view,response,reload){
		switch(view){
			case "tbl_products":{
				let TableData =  [{data:'id',visible:false},{data:'c_code',responsivePriority:1},{data:'title',className:"text-nowrap",width:'100%'},{data:'date_created',className:"text-nowrap"},{data:'status'},{data: 'action',responsivePriority:-1}];
				_DataTableLoader('tbl_products',response,TableData,[[0,'desc']],reload);
				break;
			}
			case "tbl_voucher":{
				let TableData =  [{data:'no',visible:false},{data:'promo_code',responsivePriority:1},{data:'discount',className:"text-nowrap"},{data:'date_from'},{data:'date_to'},{data:'status'},{data: 'action',responsivePriority:-1}];
				_DataTableLoader('tbl_voucher',response,TableData,[[0,'desc']],reload);
				break;
			}
			case "tbl_shipping":{
				let TableData =  [{data:'region'},{data:'shipping_range',responsivePriority:1},{data:'action'}];
				_DataTableLoader('tbl_shipping',response,TableData,[[0,'desc']],reload);
				break;
			}
			case "tbl_category":{
				let TableData = [{data:'image'},{data:'name',className:"text-nowrap"},{data:'date_created',className:"text-nowrap"},{data:'status',className:"text-nowrap"},{data:'action'}];
				_DataTableLoader('tbl_category',response,TableData,[[2,'desc']],reload); 
				break;
			}
			case "tbl_sub_category":{
				let TableData = [{data:'name',className:"text-nowrap"},{data:'date_created',className:"text-nowrap"},{data:'status',className:"text-nowrap"},{data:'action'}];
				_DataTableLoader('tbl_sub_category',response,TableData,[[1,'desc']],reload); 
				break;
			}
			case"tbl_banners":{
				let TableData = [{data:'image'},{data:'date_created',className:"text-nowrap"},{data:'status',className:"text-nowrap"},{data:'action',responsivePriority:-1}];
				_DataTableLoader('tbl_banners',response,TableData,[[4,'asc']],reload); 
				break;
			}
			case"tbl_interiors":{
				let TableData = [{data:'image',responsivePriority:3},{data:'project_name',responsivePriority: 1},{data:'category',responsivePriority: 2},{data:'date_created',responsivePriority: 2},{data:'status',className:"text-nowrap"},{data:'action',responsivePriority:-1}];
				_DataTableLoader('tbl_interiors',response,TableData,[[3,'desc']],reload); 
				break;
			}
			case"tbl_events":{
				let TableData = [{data:'image',responsivePriority:3},{data:'title',responsivePriority: 1},{data:'date_created',responsivePriority: 2},{data:'status',className:"text-nowrap"},{data:'action',responsivePriority:-1}];
				_DataTableLoader('tbl_events',response,TableData,[[2,'desc']],reload); 
				break;
			}
			case "tbl_testimony":{
				let TableData = [{data:'no',visible:false},{data:'image',responsivePriority:2},{data:'name',className:"text-nowrap",responsivePriority:1},{data:'description'},{data:'date_created',className:"text-nowrap"},{data:'status'},{data:'action',responsivePriority:-1}];
				_DataTableLoader('tbl_testimony',response,TableData,[[4,'desc']],reload); 
				break;
			}
			case "tbl_lookbooks":{
				let TableData = [{data:'image',responsivePriority:2},{data:'name',className:"text-nowrap",responsivePriority:1},{data:'category'},{data:'date_created',className:"text-nowrap"},{data:'status'},{data:'action',responsivePriority:-1}];
				_DataTableLoader('tbl_lookbooks',response,TableData,[[4,'desc']],reload); 
				break;
			}
			case "tbl_lookbook_categories":{
				let TableData = [{data:'name',className:"text-nowrap",responsivePriority:1},{data:'date_created',className:"text-nowrap"},{data:'status'},{data:'action',responsivePriority:-1}];
				_DataTableLoader('tbl_lookbook_categories',response,TableData,[[1,'desc']],reload); 
				break;
			}
		}	 
	}


	return {
		//main function to initiate the module
		init: function(link,response,reload=false) {
			_initView_Table(link,response,reload)
		},
	};

}();

// jQuery(document).ready(function() {
// 	KTDatatablesDataSourceAjaxClient.init();
// });
