<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-purchased-material-stocks-request">
	<div class="form" data-link="Update_Purchase_Material_Stocks_Request">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Purchase Request For Stocks</h2>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
			<div class="card card-custom gutter-b">
			    <div class="card-header card-header-tabs-line">
			        <div class="card-toolbar">
			            <ul class="nav nav-tabs nav-bold nav-tabs-line">
			                <li class="nav-item">
			                    <a class="nav-link active" data-toggle="tab" href="#request">
			                        <span class="nav-icon"><i class="flaticon-exclamation-1"></i></span>
			                        <span class="nav-text">Request</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#approved">
			                        <span class="nav-icon"><i class="flaticon-list-3"></i></span>
			                        <span class="nav-text">Approved</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#delivered">
			                        <span class="nav-icon"><i class="flaticon-truck"></i></span>
			                        <span class="nav-text">Delivered</span>
			                    </a>
			                </li>
			            </ul>
			        </div>
			    </div>
			    <div class="card-body">
			        <div class="tab-content">
			            <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request">
			                <table class="table table-bordered table-hover table-checkable link" id="tbl_purchased_request" data-link="tbl_purchased_material_stocks_request" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>IMAGE</th>
										<th>TITLE</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_purchased_approved" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>CF NO.</th>
										<th>NO</th>
										<th>IMAGE</th>
										<th>TITLE</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_purchased_received" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>CF NO.</th>
										<th>NO</th>
										<th>IMAGE</th>
										<th>TITLE</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>
</div>

<!-- Modal-->
<div class="modal fade" id="requestModalRequest" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
        	 <div class="modal-header">
                <h5 class="modal-title" id="joborder"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<div class="row justify-content-center py-8 px-8 py-md-15 px-md-0">
								<div class="col-md-9 col-xl-9 col-xxl-9">
									<div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
										<div class="d-flex flex-column px-0 order-2 order-md-1 align-items-center align-items-md-start">
											<span class="d-flex flex-column font-size-h5 font-weight-bold text-muted align-items-center align-items-md-start">
												<span id="title"></span>
												<span id="c_name"></span>
												<span id="date_created"></span>
												<span id="requestor"></span>
											</span>
										</div>
										<h1 class="display-5 font-weight-boldest order-1 order-md-2 mb-5 mb-md-0"><span id="status"></span></h1>
									</div>
								</div>
							</div>
						<div class="row justify-content-center">
							<div class="col-md-9">
								<div data-scroll="true" data-height="300">
									<div class="table-responsive">
										<table class="table" id="tbl_purchase_request_modal">
											<thead>
												<tr>
													<th class="align-middle font-size-h4 pl-0 ">ITEM/DESCRIPTION</th>
													<th class="align-middle font-size-h4 text-center">QTY</th>
													<th class="align-middle font-size-h4 text-right border-0">AMOUNT</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
									</div>
								</div>
							</div>
					</div>
				 <div class="modal-footer" id="button_status">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="requestModalApproved" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
        	 <div class="modal-header">
                <h5 class="modal-title">CASH FUND : <span id="pettycash"></span> <small><del><span id="del_cash"></span></del></small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<div class="row justify-content-center py-8 px-8 py-md-15 px-md-0">
								<div class="col-md-9">
									<div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
										<div class="d-flex flex-column px-0 order-2 order-md-1 align-items-center align-items-md-start">
											<span class="d-flex flex-column font-size-h5 font-weight-bold text-muted align-items-center align-items-md-start">
												<input type="hidden" name="fund_no"/>
												<input type="hidden" name="previouscash"/>
												<span id="production_no_f"></span>
												<span id="title_f"></span>
												<span id="unit_f"></span>
												<span id="date_created_f"></span>
												<span id="requestor_f"></span>
											</span>
										</div>
										<h1 class="display-5 font-weight-boldest order-1 order-md-2 mb-5 mb-md-0"><span id="status_f"></span></h1>
									</div>
								</div>
							</div>
						<div class="row justify-content-center">
							<div class="col-md-9">
								 <div data-scroll="true" data-height="300">
									<div class="table-responsive">
										<table class="table" id="tbl_purchased_approved_modal">
											<thead>
												<tr class="font-weight-boldest h-65px">
													<th class="align-middle font-size-h4 pl-0 ">ITEM/DESCRIPTION</th>
													<th class="align-middle font-size-h4 text-center">QTY</th>
													<th class="align-middle font-size-h4 text-right border-0">AMOUNT</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
									</div>
								</div>
							</div>
					</div>
				 <div class="modal-footer" >
				 	<div id="button_edits"></div>
				 	<div id="button_saves"></div>
            	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="requestModalReceived" data-backdrop="static" data-keyboard="false" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
        	 <div class="modal-header">
                <h5 class="modal-title">CASH FUND : <span id="pettycash"></span> <small><del><span id="del_cash"></span></del></small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<div class="row justify-content-center py-8 px-8 py-md-15 px-md-0">
								<div class="col-md-9">
									<div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
										<div class="d-flex flex-column px-0 order-2 order-md-1 align-items-center align-items-md-start">
											<span class="d-flex flex-column font-size-h5 font-weight-bold text-muted align-items-center align-items-md-start">
												<input type="hidden" name="fund_no"/>
												<input type="hidden" name="previouscash"/>
												<span id="production_no_c"></span>
												<span id="title_c"></span>
												<span id="c_name_c"></span>
												<span id="unit_c"></span>
												<span id="date_created_c"></span>
												<span id="requestor_c"></span>
											</span>
										</div>
										<h1 class="display-5 font-weight-boldest order-1 order-md-2 mb-5 mb-md-0">TOTAL: P<span id="total"></span></h1>
									</div>
								</div>
							</div>
						<div class="row justify-content-center">
							<div class="col-md-12">
								 <div data-scroll="true" data-height="300">
									<div class="table-responsive">
										<table class="table" id="tbl_purchased_received_modal">
											<thead>
												<tr class="font-weight-boldest h-65px">
													<th class="align-middle font-size-h4 pl-0 ">ITEM/DESCRIPTION</th>
													<th class="align-middle font-size-h4 text-center">QTY</th>
													<th class="align-middle font-size-h4 text-center">SUPPLIER</th>
													<th class="align-middle font-size-h4 text-center">PAYMENT TYPE</th>
													<th class="align-middle font-size-h4 text-right border-0">AMOUNT</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table">
											<tbody>
												<tr>
													<td class="align-middle font-size-h4 pl-0 text-right font-weight-boldest">TOTAL PAYMENT :</td>
													<td class="align-middle font-size-h4 pl-0 text-right" width="200"><span id="total_payment" ></span></td>
												</tr>
												<tr>
													<td class="align-middle font-size-h4 pl-0 text-right font-weight-boldest">CASH FUND :</td>
													<td class="align-middle font-size-h4 pl-0 text-right" width="200"><span id="pettycash1" ></span></td>
												</tr>
												<tr>
													<td class="align-middle font-size-h4 pl-0 text-right font-weight-boldest">ACTUAL CHANGE :</td>
													<td class="align-middle font-size-h4 pl-0 text-right"><div id="change"></div><div id="change1"></div></td>
												</tr>
												<tr>
													<td class="align-middle font-size-h4 pl-0 text-right font-weight-boldest">FOR REFUND :</td>
													<td class="align-middle font-size-h4 pl-0 text-right"><div id="refund"></div><div id="refund1"></div></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
						   </div>
					</div>
				 <div class="modal-footer" >
				 	<div id="button_edit"></div>
				 	<div id="button_save"></div>
            	</div>
        </div>
    </div>
</div>