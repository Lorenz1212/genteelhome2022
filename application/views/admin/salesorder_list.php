<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-salesorder-list" url-link="admin">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Sales Order</h2>
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
			                        <span class="nav-text">REQUEST</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#pending">
			                        <span class="nav-text">PENDING</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#approved">
			                        <span class="nav-text">REQUEST FOR APPROVAL</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#shipping">
			                        <span class="nav-text">FOR SHIPPING</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#delivered">
			                        <span class="nav-text">DELIVERED</span>
			                    </a>
			                </li>
			            </ul>
			   		 </div>
			   		</div>
			    <div class="card-body">
			        <div class="tab-content">
			            <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
			                <table class="table table-bordered table-hover table-checkable link" id="tbl_salesorder_request" data-link="tbl_salesorder" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>SO NO.</th>
										<th>SALES PERSON</th>
										<th>CUSTOMER</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_salesorder_pending" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>SO NO.</th>
										<th>SALES PERSON</th>
										<th>CUSTOMER</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_salesorder_approved" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>SO NO.</th>
										<th>SALES PERSON</th>
										<th>CUSTOMER</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_salesorder_shipping" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>SO NO.</th>
										<th>SALES PERSON</th>
										<th>CUSTOMER</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_salesorder_delivered" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>SO NO.</th>
										<th>SALES PERSON</th>
										<th>CUSTOMER</th>
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
<!-- Modal-->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
                    <div class="modal-body">
                    	<div class="form" data-link="Update_Approval_SalesOrder"></div>
							<div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
								<div class="col-md-12">
									<div class="d-flex justify-content-between pt-6">
										<div class="d-flex flex-column flex-root">
											<span class="font-weight-bolder mb-2">ORDER DATE</span>
											<span class="opacity-70" id="date_order"></span>
											<span class="font-weight-bolder mb-2">TRACKING NO.</span>
											<span class="opacity-70" id="so_no"></span>
											<span class="font-weight-bolder mb-2">INVOICE NO.</span>
											<span class="opacity-70" id="si_no"></span>
										</div>
										<div class="d-flex flex-column flex-root">
											<span class="font-weight-bolder mb-2">Customer Name</span>
											<span class="opacity-70" id="c_name"></span>
											<span class="font-weight-bolder mb-2">Mobile No.</span>
											<span class="opacity-70" id="mobile"></span>
											<span class="font-weight-bolder mb-2">Email Address</span>
											<span class="opacity-70" id="email"></span>
										</div>
										<div class="d-flex flex-column flex-root">
											<span class="font-weight-bolder mb-2">Billing Address</span>
											<span class="opacity-70" id="b_address"></span>
											<span class="opacity-70" id="b_city"></span>
											<span class="opacity-70" id="b_zipcode"></span>
											<span class="font-weight-bolder mb-2">Shipping Address</span>
											<span class="opacity-70" id="s_address"></span>
											<span class="opacity-70" id="s_city"></span>
											<span class="opacity-70" id="s_zipcode"></span>
										</div>
									</div>
								</div>
							</div>
							<!-- end: Invoice header-->
							<!-- begin: Invoice body-->
							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table" id="tbl_admin_salesorder_so">
											<thead>
												<tr>
													<th class="pl-0 font-weight-bold text-muted text-uppercase">ITEM</th>
													<th class="pl-0 font-weight-bold text-muted text-uppercase">COLOR</th>
													<th class="text-center font-weight-bold text-muted text-uppercase">QTY</th>
													<th class="text-right font-weight-bold text-muted text-uppercase">PRICE</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- end: Invoice body-->
							<!-- begin: Invoice footer-->
							<div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
								<div class="col-md-10">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th class="font-weight-bold text-muted text-uppercase text-right" colspan="4">TOTAL AMOUNT</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="text-success  font-weight-boldest text-right" width="400" colspan="3">Subtotal: </td>
													<td class="text-success  font-weight-boldest text-right" colspan="1"><span id="subtotal"></span></td>
												</tr>
												<tr>
													<td class="text-success  font-weight-boldest text-right" width="400" colspan="3">Discount:</td>
													<td class="text-success  font-weight-boldest text-right" colspan="1"><span id="discount"></span></td>
												</tr>
												<tr class="vat">
													<td class="text-success font-weight-boldest text-right" width="400" colspan="3">VAT (12%): </td>
													<td class="text-success font-weight-boldest text-right" colspan="1"><span id="vat"></span></td>
												</tr>
												<tr class="total">
													<td class="text-success  font-weight-boldest text-right" width="400" colspan="3">Total Amount:</td>
													<td class="text-success  font-weight-boldest text-right" colspan="1"><span id="total"></span></td>
												</tr>
												<tr class="downpayment">
													<td class="text-success font-weight-boldest text-right" width="400" colspan="3">Downpayment: </td>
													<td class="text-success font-weight-boldest text-right" colspan="1"><span id="downpayment"></span></td>
												</tr>
												<tr class="shipping_fee">
													<td class="text-success  font-weight-boldest text-right" width="400" colspan="3">Shipping Fee:</td>
													<td class="text-success  font-weight-boldest text-right" colspan="1"><span id="shipping_fee"></span></td>
												</tr>
												<tr class="grandtotal">
													<td class="text-success  font-weight-boldest text-right" width="400" colspan="3">Grand Total:</td>
													<td class="text-success  font-weight-boldest text-right" colspan="1"><span id="grandtotal"></span></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					 <div class="modal-footer">
            	    </div>
				</div>
            </div>
        </div>
    </div>
</div>

