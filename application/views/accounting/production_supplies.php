<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-production-supplies">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Production Supplies</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
	<!--begin::Card-->
		<div class="card card-custom">
			<div class="card-header">
				<div class="card-title">
					<span class="card-icon">
						<i class="flaticon2-psd text-primary"></i>
					</span>
					<h3 class="card-label">List of purchase item</h3>
				</div>
			</div>
				<div class="card-body">
					<!--begin: Datatable-->
					<table class="table table-bordered table-hover table-checkable link" id="tbl_purchased_received" data-link="tbl_purchased_received" style="margin-top: 13px !important">
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
					<!--end: Datatable-->
				</div>
			</div>
			<!--end::Card-->
		</div>
	</div>
</div>
<!-- Modal-->
<div class="modal fade" id="requestModal" data-backdrop="static" data-keyboard="false" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
        	<form class="form" data-link="Update_Purchase_Received">
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
												<span id="production_no"></span>
												<span id="title"></span>
												<span id="unit"></span>
												<span id="date_created"></span>
												<span id="requestor"></span>
											</span>
										</div>
										<h1 class="display-3 font-weight-boldest order-1 order-md-2 mb-5 mb-md-0">TOTAL: P<span id="total"></span></h1>
									</div>
								</div>
							</div>
						<div class="row justify-content-center">
							<div class="col-md-12">
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
							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table">
											<tbody>
												<tr>
													<td class="align-middle font-size-h4 pl-0 text-right font-weight-boldest h-65px">TOTAL PAYMENT :</td>
													<td class="align-middle font-size-h4 pl-0 text-right" width="200"><span id="total_payment" ></span></td>
												</tr>
												<tr>
													<td class="align-middle font-size-h4 pl-0 text-right font-weight-boldest h-65px">CASH FUND :</td>
													<td class="align-middle font-size-h4 pl-0 text-right" width="200"><span id="pettycash1" ></span></td>
												</tr>
												<tr>
													<td class="align-middle font-size-h4 pl-0 text-right font-weight-boldest h-65px">ACTUAL CHANGE :</td>
													<td class="align-middle font-size-h4 pl-0 text-right"><div id="change"></div><div id="change1"></div></td>
												</tr>
												<tr>
													<td class="align-middle font-size-h4 pl-0 text-right font-weight-boldest h-65px">FOR REFUND :</td>
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
			</form>
        </div>
    </div>
</div>