<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-purchased-material-stocks-request">
	<div class="form" data-link="Update_Purchase_Stocks_Request">
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
			                        <span class="nav-text mr-2">Request</span>
			                        <span class="label label-rounded label-warning purchase_stocks_pending">0</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#delivered">
			                        <span class="nav-icon"><i class="flaticon-truck"></i></span>
			                        <span class="nav-text mr-2">Delivered</span>
			                        <span class="label label-rounded label-success purchase_stocks_approved">0</span>
			                    </a>
			                </li>
			            </ul>
			        </div>
			    </div>
			    <div class="card-body">
			        <div class="tab-content link" data-link="tbl_purchased_material_stocks_request">
			            <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request">
			                <table class="table table-bordered table-hover table-sm " id="tbl_purchased_request"  style="width: 100%;">
								<thead>
									<tr>
										<th>NO</th>
										<th>TITLE</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>STATUS</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered">
			                <table class="table table-bordered table-hover table-sm" id="tbl_purchased_received" style="width: 100%;">
								<thead>
									<tr>
										<th>NO</th>
										<th>TITLE</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>STATUS</th>
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
<div class="modal fade" id="view-purchased-request" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      		  <div class="modal-content">
      		  		<div class="card card-custom gutter-b">
      		  			
      		  			<div class="card-body">
      		  				<div class="row ">
      		  					<div class="col-xl-12 col-md-12">
									<div class="separator separator-solid separator-border-2" id="separator-status-1"></div>
								</div>
							</div>
							<div class="row  mt-2">
      		  					<div class="col-xl-12 col-md-12">
      		  						<h3 class="display-5 text-center status">REQUEST</h3>
      		  					</div>
      		  				</div>
							<div class="row">
      		  					<div class="col-xl-12 col-md-12">
									<div class="separator separator-solid separator-border-2" id="separator-status-2"></div>
								</div>
							</div>
      		  				<div class="row pt-5">
      		  					<div class="col-xl-12 col-md-12">
      		  						<div class="mb-7">
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Trans # :</span>
											<span class="font-weight-bold text-primary cash_fund"></span>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Job Order # :</span>
											<span class="font-weight-bold text-primary joborder"></span>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Purchaser :</span>
											<span class="font-weight-bold text-primary requestor"></span>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Date Request :</span>
											<span class="font-weight-bold text-primary date_created"></span>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Title :</span>
											<span class="font-weight-bold text-primary title"></span>
										</div>
									</div>
      		  					</div>	
      		  				</div>
      		  				<div class="row">
      		  					<div class="col-xl-12 col-md-12">
									<div class="separator separator-dashed separator-border-2 separator-dark"></div>
								</div>
							</div>
							<div class="row">
      		  					<div class="col-xl-12 col-md-12">
      		  						<div class="tableFixHead">
										<table class="table" id="tbl_purchased_estimate">
											<thead>
												<tr class="table-dark">
													<th>ITEM</th>
													<th class="text-center">QUANTITY</th>
													<th class="text-right">Est. Amount</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="row">
      		  					<div class="col-xl-12 col-md-12">
									<div class="separator separator-dashed separator-border-2 separator-dark"></div>
								</div>
							</div>
							<div class="row">
      		  					<div class="col-xl-12 col-md-12">
									<div class="h3 pt-2  text-center text-success">₱ <span class="font-weight-bolder total">0.00</span></div>
								</div>
							</div>
							<div class="row">
      		  					<div class="col-xl-12 col-md-12">
									<div class="separator separator-dashed separator-border-2 separator-dark"></div>
								</div>
							</div>
							<div class="row pt-2 purchase-cash-fund">
      		  					<div class="col-xl-12 col-md-12">
									<div class="card card-custom">
										<div class="card-body bg-secondary">
											<div class="h4 text-center">Cash Fund</div>
											<div class="h3 font-weight-bolder text-center total_fund">0.00</div>
										</div>
									</div>
								</div>
							</div>
								<div class="row pt-3 purchase-button">
	      		  					<div class="col-xl-12 col-md-12">
	      		  						<form id="Update_Accounting_Purchase_Request_Stocks">
											 <div class="form-group text-center">
											    <label class="font-weight-bold">Cash Fund</label>
											    <input type="text" class="form-control form-control-solid text-center amount" name="cash_fund"  placeholder="0.00" />
											  </div>
										 </form>
									</div>
								</div>
							<div class="row purchase-button">
      		  					<div class="col-xl-12 col-md-12">
									<button type="button" class="btn btn btn-outline-success btn-lg btn-block btn-request-submit" data-status="1">Submit</button>
								</div>
							</div>
      		  			</div>
      		  		</div>
	            </div>
	        </div>
	    </div>

<div class="modal fade" id="view-purchased-received" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      		  <div class="modal-content">
      		  		<div class="card card-custom gutter-b">
      		  			
      		  			<div class="card-body">
      		  				<div class="row ">
      		  					<div class="col-xl-12 col-md-12">
									<div class="separator separator-solid separator-border-2" id="separator-status-received-1"></div>
								</div>
							</div>
							<div class="row  mt-2">
      		  					<div class="col-xl-12 col-md-12">
      		  						<h3 class="display-5 text-center status-received">REQUEST</h3>
      		  					</div>
      		  				</div>
							<div class="row">
      		  					<div class="col-xl-12 col-md-12">
									<div class="separator separator-solid separator-border-2" id="separator-status-received-2"></div>
								</div>
							</div>
      		  				<div class="row pt-5">
      		  					<div class="col-xl-12 col-md-12">
      		  						<div class="mb-7">
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Trans # :</span>
											<span class="font-weight-bold text-primary cash_fund_r"></span>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Job Order # :</span>
											<span class="font-weight-bold text-primary joborder_r"></span>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Purchaser :</span>
											<span class="font-weight-bold text-primary requestor_r"></span>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Date Request :</span>
											<span class="font-weight-bold text-primary date_created_r"></span>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Title :</span>
											<span class="font-weight-bold text-primary title_r"></span>
										</div>
									</div>
      		  					</div>	
      		  				</div>
      		  				<div class="row">
      		  					<div class="col-xl-12 col-md-12">
									<div class="separator separator-dashed separator-border-2 separator-dark"></div>
								</div>
							</div>
							<div class="row">
      		  					<div class="col-xl-12 col-md-12">
      		  						<div class="tableFixHead">
										<table class="table" id="tbl_purchased_received_modal">
											<thead>
												<tr class="table-dark">
													<th>ITEM</th>
													<th class="text-center">QUANTITY</th>
													<th class="text-right">Amount</th>
													<th class="text-right">Supplier</th>
													<th class="text-center">Payment</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="row">
      		  					<div class="col-xl-12 col-md-12">
									<div class="separator separator-dashed separator-border-2 separator-dark"></div>
								</div>
							</div>
							<div class="row">
      		  					<div class="col-xl-12 col-md-12">
									<div class="h3 pt-2  text-center text-success">₱ <span class="font-weight-bolder total-received">0.00</span></div>
								</div>
							</div>
							<div class="row">
      		  					<div class="col-xl-12 col-md-12">
									<div class="separator separator-dashed separator-border-2 separator-dark"></div>
								</div>
							</div>
							<div class="row purchased-received-input">
      		  					<div class="col-xl-12 col-md-12">
      		  						<form id="Update_Accounting_Purchase_Request_Received">
									 <div class="form-group text-center">
									    <label class="font-weight-bold">Actual Change</label>
									    <input type="text" class="form-control form-control-solid text-center amount" name="actual_change" placeholder="0.00" />
									  </div>
									   <div class="form-group text-center">
									    <label class="font-weight-bold">For Refund (Optional)</label>
									    <input type="text" class="form-control form-control-solid text-center amount" name="refund"  placeholder="0.00" />
									  </div>
								</div>
								</form>
							</div>
							<div class="row pt-2 purchased-received-hide">
								<div class="col-xl-12 col-md-12">
									<div class="mb-7">
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Cash Fund :</span>
											<span class="font-weight-bold text-primary total_petty"></span>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Actual Change :</span>
											<span class="font-weight-bold text-primary actual_change"></span>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Refund :</span>
											<span class="font-weight-bold text-primary total_refund"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="row purchased-received-input">
      		  					<div class="col-xl-12 col-md-12">
									<button type="button" class="btn btn btn-outline-success btn-lg btn-block btn-received-submit">Submit</button>
								</div>
							</div>
      		  			</div>
      		  		</div>
	            </div>
	        </div>
	    </div>

