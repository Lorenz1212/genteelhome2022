<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-purchase-project-request">
	<div class="form" data-link="Update_Purchase_Request_Project"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Purchase Request For J.O Projects</h2>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->
	<!--begin::Entry-->
			<div class="d-flex flex-column-fluid">
				<!--begin::Container-->
				<div class="container">
					<!--begin::Row-->
					<div class="row">
						<div class="col-xl-12">
							<!--begin::Nav Panel Widget 1-->
							<div class="card card-custom gutter-b">
								  <div class="card-header card-header-tabs-line">
							        <div class="card-toolbar">
							           <ul class="nav nav-tabs nav-bold nav-tabs-line">
										<!--begin::Item-->
										<li class="nav-item">
											 <a class="nav-link active" data-toggle="tab" href="#request">
						                        <span class="nav-text">Request</span>
						                        <span class="label label-rounded label-warning purchase_project_pending">0</span>
						                    </a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="nav-item">
											 <a class="nav-link" data-toggle="tab" href="#inprogress">
						                        <span class="nav-text">IN PROGRESS</span>
						                        <span class="label label-rounded label-primary purchase_project_approved">0</span>
						                    </a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="nav-item">
											 <a class="nav-link" data-toggle="tab" href="#complete">
						                        <span class="nav-text">RECEIVED</span>
						                        <span class="label label-rounded label-success purchase_project_complete">0</span>
						                    </a>
										</li>
										<!--end::Item-->
									</ul>
							   		 </div>
							   	</div>
								<!--begin::Body-->
								<div class="card-body">
									<!--end::Nav Tabs-->
									<!--begin::Nav Content-->
									<div class="tab-content m-0 p-10">
										<div class="tab-pane active" id="request" role="tabpanel">
											<table class="table table-bordered table-hover table-checkable link" id="tbl_purchase_request" data-link="tbl_purchase_request_project" style="margin-top: 13px !important">
												<thead>
													<tr>
														<th>NO</th>
														<th>TITLE</th>
														<th>REQUESTOR</th>
														<th>ITEM REQUEST</th>
														<th>DATE</th>
														<th>ACTION</th>
													</tr>
												</thead>
											</table>
										</div>
										<div class="tab-pane" id="inprogress" role="tabpanel">
											<table class="table table-bordered table-hover table-checkable" id="tbl_purchase_request_inprogress" style="margin-top: 13px !important">
												<thead>
													<tr>
														<th>NO</th>
														<th>TITLE</th>
														<th>REQUESTOR</th>
														<th>STATUS</th>
														<th>DATE</th>
														<th>ACTION</th>
													</tr>
												</thead>
											</table>
										</div>
										<div class="tab-pane" id="complete" role="tabpanel">
											<table class="table table-bordered table-hover table-checkable" id="tbl_purchase_request_complete" style="margin-top: 13px !important">
												<thead>
													<tr>
														<th>NO</th>
														<th>ITEM</th>
														<th>QUANTITY</th>
														<th>AMOUNT</th>
														<th>SUPPLIER</th>
														<th>PAYMENT</th>
														<th>DATE</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
									<!--end::Nav Content-->
								</div>
								<!--end::Body-->
							</div>
							<!--begin::Nav Panel Widget 1-->
						</div>
					</div>
					<!--end::Row-->
				</div>
			</div>
			<!--end::Row-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
<!-- Modal-->
<!-- Modal-->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
            	<div class="row d-flex justify-content-between">
						<div class="col-md-6">
							<!--begin::Card-->
								<div class="card card-custom gutter-b bg-dark">
									<!--begin::Body-->
									<div class="card-body pt-3">
										<!--begin::User-->
										<div class="d-flex align-items-center mt-5">
											<div class="symbol symbol-60 symbol-xl-100 mr-5 align-self-start align-self-xxl-center">
												<div class="symbol-label image-view" style="background-image:url('assets/media/users/300_13.jpg')"></div>
											</div>
											<div>
												<span class="font-weight-bold font-size-h5 text-white text-hover-primary title"></span>
											<!-- 	<div class="font-weight-bold font-size-h5 text-white text-hover-primary color"></div> -->
												<div class="text-muted requestor" id="requestor"></div>
												<div class="text-muted date_created" id="date_created"></div>
												<div class="text-white text-hover-primary " id="joborder"></div>
											</div>
										</div>
										<!--end::User-->
									</div>
									<!--end::Body-->
								</div>
							</div>
							<div class="col-md-6" >
								<button type="button" class="close" style="float: right" class="close" data-dismiss="modal" aria-label="Close"><i aria-hidden="true" class="ki ki-close"></i></button>
							</div>
						</div>
						<div class="row justify-content-center" style="height: 300px;">
							<div class="col-md-12">
									<table class="table" id="tbl_purchasing_modal">
										<thead>
											<tr class="table-primary">
												<th>MATERIAL</th>
												<th class="text-center">QUANTITY</th>
												<th class="text-center">REMARKS</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="col-md-12 d-none" style="height: 300px;">
									<div class="tableFixHead">
										<table class="table" id="tbl_purchasing_estimate">
											<thead>
												<tr class="table-primary">
													<th>MATERIAL</th>
													<th class="text-center">QUANTITY</th>
													<th class="text-center">AMOUNT</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					 <div class="modal-footer d-flex justify-content-between">
					 	<button class="btn btn-dark btn-shadow mr-2 btn-change" data-action="view"></button>
					 	<button class="btn btn-success btn-shadow mr-2 btn-submit d-none">Submit Form</button>
	            	</div>	
				</form>
		    </div>
		</div>
	</div>


<div class="modal fade" id="processModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
            	<div class="row d-flex justify-content-between">
						<div class="col-md-6">
							<!--begin::Card-->
								<div class="card card-custom gutter-b bg-dark">
									<!--begin::Body-->
									<div class="card-body pt-3">
										<!--begin::User-->
										<div class="d-flex align-items-center mt-5">
											<div class="symbol symbol-60 symbol-xl-100 mr-5 align-self-start align-self-xxl-center">
												<div class="symbol-label image-view" style="background-image:url('assets/media/users/300_13.jpg')"></div>
											</div>
											<div>
												<span class="font-weight-bold font-size-h5 text-white text-hover-primary title"></span>
												<div class="font-weight-bold font-size-h5 text-white text-hover-primary color"></div>
												<div class="text-muted requestor"></div>
												<div class="text-muted date_created"></div>
												<div class="text-white text-hover-primary joborder"></div>
												<div class="text-white text-hover-primary fund_no"></div>
											</div>
										</div>
										<!--end::User-->
									</div>
									<!--end::Body-->
								</div>
							</div>
							<div class="col-md-6" >
								<button type="button" class="close" style="float: right" class="close" data-dismiss="modal" aria-label="Close"><i aria-hidden="true" class="ki ki-close"></i></button>
							</div>
						</div>
						<div class="row" style="height: 300px;">
							<div class="col-xl-12 col-xxl-12 col-md-12" id="view-details">
									<table class="table" id="tbl_purchasing_inprogress_modal">
										<thead>
											<tr class="table-primary">
												<th>MATERIAL</th>
												<th class="text-center">QUANTITY</th>
												<th class="text-left">ESTIMATE AMOUNT</th>
												<th class="text-center">REMARKS</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="col-xl-12 col-xxl-12 col-md-12" id="view-purchased" style="height: 300px;">
									
									<div class="row">
										<div class="col-xl-12 col-xxl-12 col-md-12">
											<form id="Update_Purchase_Process">
											<div class="row">
												<div class="col-xl-3 col-xxl-3 col-md-3">
													<div class="form-group">
														<label>Purchased Item</label>
														<select class="form-control form-control-solid" id="item" name="item">
														</select>
													</div>
												</div>
												<div class="col-xl-2 col-xxl-2 col-md-2">
													<div class="form-group">
														<label>Supplier</label>
														<select class="form-control" id="supplier" name="supplier" style="width:160px">
														</select>
													</div>
												</div>
												<div class="col-xl-2 col-xxl-2 col-md-2">
													<div class="form-group">
														<label>Payment</label>
														<select class="form-control" name="terms">
															<option value="">SELECT PAYMENT</option>
															<option value="1">CASH</option>
															<option value="2">TERMS</option>
														</select>
													</div>
												</div>
												<div class="col-xl-2 col-xxl-2 col-md-2">
													<div class="form-group">
														<label>Quantity</label>
														<input type="number" min="1" class="form-control form-control-solid text-center" name="quantity" placeholder="0" />
													</div>
												</div>
												<div class="col-xl-3 col-xxl-3 col-md-3">
													<div class="form-group">
														<label>Amount</label>
														 <div class="input-group">
														<input class="form-control form-control-solid text-center text-amount-process amount" name="amount_process" placeholder="0.00" />
														<div class="input-group-append">
																<button class="btn btn-light-dark font-weight-bold mr-2 btn-add" data-toggle="tooltip" data-theme="dark" title="Click To Add Purchased Item"><i class="flaticon2-plus"></i></button>
														</div>
														</div>
													</div>
												</div>
				
											</div>
											</form>
										</div>
										<div class="col-xl-12 col-xxl-12 col-md-12">
												<table class="table" id="tbl_purchasing_process">
													<thead>
														<tr class="table-primary">
															<th>MATERIAL</th>
															<th>SUPPLIER</th>
															<th>PAYMENT</th>
															<th class="text-center">QUANTITY</th>
															<th class="text-right">AMOUNT</th>
															<th class="text-center">ACTION</th>
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
					 <div class="modal-footer btn-hide">
					 	<button class="btn btn-dark btn-shadow mr-2 btn-change-process" data-action="view"></button>
					 	<button class="btn btn-success btn-shadow mr-2 btn-submit-process d-none">Submit Form</button>
					 </div>
				</form>
		    </div>
		</div>
	</div>
<div class="modal fade" id="view-terms" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content bg-dark">
        	<div class="modal-body">
	        	<div class="row">
	        		<div class="col-xl-12 col-xxl-12 col-md-12 col-sm-12">
	        			  <div class="form-group" style="float: center">
						    <label class="text-white">Date of Terms</label>
						     <div class=" input-group">
						      <input type="date" class="form-control" name="start" placeholder="mm/dd/YYYY" />
						      <div class="input-group-append">
						       <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
						      </div>
						      <input type="date" class="form-control" name="end" placeholder="mm/dd/YYYY" />
						     </div>
						     <span class="form-text text-muted">Date From-To</span>
						   </div>
	        		</div>
	        	</div>

	        	<div class="row d-flex justify-content-between">
	        		<div class="col-xl-12 col-xxl-12 col-md-12 col-sm-12">
	        			<button class="btn btn-primary btn-shadow mr-2" data-dismiss="modal" aria-label="Close">Close</button>
	        			<button class="btn btn-success btn-shadow mr-2 btn-submit-terms" style="float: right">Submit</button>
	        		</div>
	        	</div>

	        </div>
        </div>
    </div>
</div>
