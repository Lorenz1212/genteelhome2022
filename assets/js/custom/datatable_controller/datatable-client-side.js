'use strict';
var KTDatatablesDataSourceAjaxClient = function() {

	
	var initTable1_purchasing = function(tbl,action) {
		$('#tbl_purchasing').DataTable({
			responsive: true,
			language: {
		      emptyTable: "No payout recorded"
		    },
			// order: [ 0, 'desc' ],
			processing: true,
			serverSide: true,
			destroy: true,
			ajax: {
				url: baseURL + 'index.php/purchasing_controller.php',
				type: 'POST',
				data: {
					columnsDef: ['request_id', 'date_created', 'status', 'action'],
				},
				beforeSend: function() {
		        },
		        complete: function() {
		        }
			},
			columns: [
				{data: 'request_id'},
				{data: 'date_created'},
				{data: 'status'},
				{data: 'action'},
			],
			// columnDefs: [
			// 	{
			// 		targets: -1,
			// 		title: 'ACTION',
			// 		orderable: false,
			// 		render: function(data, type, full, meta) {
			// 		let action_btn='';
			// 		if(full.status=='C'){
			// 			action_btn='<a href="javascript:;" class="btn btn-sm btn-clean btn-icon view-remarks-encashment" data-id="'+full.action+'" title="View remarks">\
			// 							<i class="la la-envelope-o icon-xl"></i>\
			// 						</a>';
			// 		}else if(full.status=='S'){
			// 			action_btn='<a href="javascript:;" class="btn btn-sm btn-clean btn-icon view-invoice-encashment" data-id="'+full.action+'" title="View invoice">\
			// 							<i class="la la-file icon-xl"></i>\
			// 						</a>';
			// 						// <a href="javascript:;" class="btn btn-sm btn-clean btn-icon view-check-encashment" data-id="'+full.action+'" title="View check">\
			// 						// 	<i class="la la-file-alt icon-xl"></i>\
			// 						// </a>\
			// 			// action_btn='<button data-id="'+full.action+'" class="btn btn-icon btn-light-info btn-sm m-1 view-check-encashment" title="View details"><i class="flaticon2-notepad"></i></button>\
			// 			// <button data-id="'+full.action+'" class="btn btn-icon btn-light-info btn-sm m-1 view-invoice-encashment" title="View details"><i class="flaticon2-notepad"></i></button>';
			// 		};
			// 		return '<div class="d-flex flex-row">'+action_btn+'</div>';

			// 		},
			// 	},
			// 	{
			// 		targets: -2,
			// 		render: function(data, type, full, meta) {
			// 			var status = {
			// 				'P': {'title': 'Pending', 'state': 'info'},
			// 				'S': {'title': 'Approved', 'state': 'success'},
			// 				'C': {'title': 'Cancelled', 'state': 'danger'}
			// 			};
			// 			if (typeof status[data] === 'undefined') {
			// 				return data;
			// 			}
			// 			return '<div class="d-flex flex-row align-items-center"><span class="label label-' + status[data].state + ' label-dot mr-2"></span>' +
			// 				'<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span></div>';
			// 		},
			// 	},
			// ],
		});

		
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1_purchasing();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceAjaxClient.init();
});
