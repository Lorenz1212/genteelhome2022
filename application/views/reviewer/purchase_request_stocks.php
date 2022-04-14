<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-purchase-stocks-request">
	<div class="form" data-link="Update_Purchase_Request_Stocks"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Purchase Request For J.O Stocks</h2>
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
						                        <span class="label label-rounded label-warning request_material_pending">0</span>
						                    </a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="nav-item">
											 <a class="nav-link" data-toggle="tab" href="#inprogress">
						                        <span class="nav-text">IN PROGRESS</span>
						                        <span class="label label-rounded label-primary request_material_pending">0</span>
						                    </a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="nav-item">
											 <a class="nav-link" data-toggle="tab" href="#complete">
						                        <span class="nav-text">COMPLETE</span>
						                        <span class="label label-rounded label-success request_material_pending">0</span>
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
											<table class="table table-bordered table-hover table-checkable link" id="tbl_purchase_request" data-link="tbl_purchase_request_stocks" style="margin-top: 13px !important">
												<thead>
													<tr>
														<th>NO</th>
														<th>IMAGE</th>
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
														<th>IMAGE</th>
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
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        	 <div class="modal-header">
                <h5 class="modal-title" id="production_no"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<div class="row justify-content-center py-5 px-5 py-md-5 px-md-0">
								<div class="col-md-12">
									<div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
										<div class="d-flex flex-column px-0 order-2 order-md-1 align-items-center align-items-md-start">
											<span class="d-flex flex-column font-size-h5 font-weight-bold text-muted align-items-center align-items-md-start">
												<span id="title"></span>
												<span id="date_created"></span>
												<span id="requestor"></span>
											</span>
										</div>
										<h1 class="display-3 font-weight-boldest order-1 order-md-2 mb-5 mb-md-0"><span id="status"></span></h1>
									</div>
								</div>
							</div>
						<div class="row justify-content-center">
							<div class="col-md-12">
								<div data-scroll="true" data-height="300">
									<div class="table-responsive">
										<table class="table" id="tbl_purchasing_modal">
											<thead>
												<tr class="font-weight-boldest h-65px">
													<th class="align-middle font-size-h4 pl-0 ">MATERIAL</th>
													<th class="align-middle font-size-h4 text-center">QUANTITY</th>
													<th class="align-middle font-size-h4 text-center">REMARKS</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								</div>
								<div class="col-md-12 d-none">
									<div data-scroll="true" data-height="300">
									<div class="table-responsive">
										<table class="table" id="tbl_purchasing_estimate">
											<thead>
												<tr class="font-weight-boldest h-65px">
													<th class="align-middle font-size-h4 pl-0 ">MATERIAL</th>
													<th class="align-middle font-size-h4 text-center">QUANTITY</th>
													<th class="align-middle font-size-h4 text-center">AMOUNT</th>
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
					 <div class="modal-footer">
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
        	 <div class="modal-header">
                <h5 class="modal-title" id="joborder"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<div class="row justify-content-center py-5 px-5 py-md-5 px-md-0">
								<div class="col-md-12">
									<div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
										<div class="d-flex flex-column px-0 order-2 order-md-1 align-items-center align-items-md-start">
											<span class="d-flex flex-column font-size-h5 font-weight-bold text-muted align-items-center align-items-md-start">
												<span id="title_inprocess"></span>
												<span id="date_created_inprocess"></span>
												<span id="requestor_inprocess"></span>
											</span>
										</div>
										<h1 class="display-3 font-weight-boldest order-1 order-md-2 mb-5 mb-md-0"><span id="status"></span></h1>
									</div>
								</div>
							</div>
						<div class="row justify-content-center">
							<div class="col-xl-12 col-xxl-12 col-md-12" id="view-details">
								<div data-scroll="true" data-height="300">
									<div class="table-responsive">
										<table class="table" id="tbl_purchasing_inprogress_modal">
											<thead>
												<tr class="font-weight-boldest h-65px">
													<th class="align-middle font-size-h4 pl-0 ">MATERIAL</th>
													<th class="align-middle font-size-h4 text-center">QUANTITY</th>
													<th class="align-middle font-size-h4 text-center">REMARKS</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								</div>
								<div class="col-xl-12 col-xxl-12 col-md-12" id="view-purchased">
									<div class="row">
										<div class="col-xl-12 col-xxl-12 col-md-12">
											<div class="row">
												<div class="col-xl-3 col-xxl-3 col-md-3">
													<div class="form-group">
														<label>Purchased Item</label>
														<select class="form-control form-control-solid" id="select-material" name="item">
														</select>
													</div>
												</div>
												<div class="col-xl-2 col-xxl-2 col-md-2">
													<div class="form-group">
														<label>Supplier</label>
														<select class="form-control form-control-solid" name="supplier">
														<?php 
															$query = $this->db->select('*')->from('tbl_supplier')->where('status',1)->get();
															foreach($query->result() as $row){
																echo '<option value="'.$this->encryption->encrypt($row->id).'">'.$row->name.'</option>';
															}
														?>
														</select>
													</div>
												</div>
												<div class="col-xl-2 col-xxl-2 col-md-2">
													<div class="form-group">
														<label>Terms</label>
														<select class="form-control form-control-solid" name="terms">
															<option value="1">CASH</option>
															<option value="2">TERMS</option>
														</select>
													</div>
												</div>
												<div class="col-xl-2 col-xxl-2 col-md-2">
													<div class="form-group">
														<label>Quantity</label>
														<input type="number" min="0" class="form-control form-control-solid text-center" name="quantity" placeholder="Input Quantity" />
													</div>
												</div>
												<div class="col-xl-3 col-xxl-3 col-md-3">
													<div class="form-group">
														<label>Amount</label>
														 <div class="input-group">
														<input class="form-control form-control-solid text-center text-amount-process" name="amount_process" placeholder="Input Item Amount" />
														<div class="input-group-append">
																<button class="btn btn-light-dark font-weight-bold mr-2 btn-add" data-toggle="tooltip" data-theme="dark" title="Click To Add Purchased Item"><i class="flaticon2-plus"></i></button>
														</div>
														</div>
													</div>
												</div>
		
											</div>
										</div>
										<div class="col-xl-12 col-xxl-12 col-md-12">
											<div data-scroll="true" data-height="300">
											<div class="table-responsive">
												<table class="table" id="tbl_purchasing_process">
													<thead>
														<tr class="font-weight-boldest h-65px">
															<th class="align-middle font-size-h4 pl-0">MATERIAL</th>
															<th class="align-middle font-size-h4 text-right">SUPPLIER</th>
															<th class="align-middle font-size-h4 text-right">TERMS</th>
															<th class="align-middle font-size-h4 text-center">QUANTITY</th>
															<th class="align-middle font-size-h4 text-right">AMOUNT</th>
															<th class="align-middle font-size-h4 text-center">ACTION</th>
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



