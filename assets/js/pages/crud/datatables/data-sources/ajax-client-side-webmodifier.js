'use strict';
var KTDatatablesDataSourceAjaxClient = function() {
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
			order:order_by,
			language: { 
			 	infoEmpty: "No records available", 
			 },
			
			serverSide:false,
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
			//Accounting
			case "tbl_products":{
				TableURL = baseURL + 'datatable_controller/Web_Product_DataTable';
				TableData =  [{data:'id',visible:false},{data:'c_code'},{data:'title'},{data:'status'},{data: 'action'}];
				_DataTableLoader('tbl_products',TableURL,TableData,[[0,'desc']]);
				break;
			}
			case "tbl_voucher":{
				TableURL = baseURL + 'datatable_controller/Web_Vouncher_DataTable';
				TableData = [{data:'no'},{data:'promo_code'},{data:'discount'},{data:'date_from'},{data:'date_to'},{data:'status'},{data:'action'}]; 
				_DataTableLoader(view,TableURL,TableData,[[4,'desc']]);
				break;
			}
			case "tbl_shipping":{
				TableURL = baseURL + 'datatable_controller/Web_Shipping_DataTable';
				TableData = [{data:'region'},{data:'shipping_range'},{data:'action'}]; 
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
		init: function(link) {
			_initView_Table(link)
		},
	};

}();

// jQuery(document).ready(function() {
// 	KTDatatablesDataSourceAjaxClient.init();
// });
