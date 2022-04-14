<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-material-request-stocks">
	<div class="form" data-link="Update_Material_Request_Stocks_Process"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Material Request For Stocks</h2>
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
										<!--begin::Nav Content-->
										<div class="tab-content m-0 p-10">
											<div class="tab-pane active" id="request" role="tabpanel">
												<table class="table table-bordered table-hover table-checkable link" id="tbl_material_request" data-link="tbl_material_request_stocks" style="margin-top: 13px !important">
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
											<div class="tab-pane" id="complete" role="tabpanel">
												<table class="table table-bordered table-hover table-checkable" id="tbl_material_request_complete" style="margin-top: 13px !important">
													<thead>
														<tr>
															<th>NO</th>
															<th>ITEM</th>
															<th>QTY</th>
															<th>REQUESTOR</th>
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
	<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
        	
        	 <div class="modal-header">
                <h5 class="modal-title" id="joborder"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<div class="row justify-content-center">
								<div class="col-md-10">
									<div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
										<div class="d-flex flex-column px-0 order-2 order-md-1 align-items-center align-items-md-start">
											<span class="d-flex flex-column font-size-h5 font-weight-bold text-muted align-items-center align-items-md-start">
												<span id="title"></span><span id="c_name"></span>
												<span id="date_created"></span>
												<span id="requestor"></span>
											</span>
										</div>
										<h1 class="display-3 font-weight-boldest order-1 order-md-2 mb-5 mb-md-0"></h1>
									</div>
								</div>
							</div>
						<div class="row justify-content-center">
							<div class="col-md-10">
								<div data-scroll="true" data-height="300">
									<div class="table-responsive">
										<table class="table" id="tbl_material_request_stocks_modal">
							              			<thead>
													<tr>
														<th class="align-middle pl-0">MATERIAL</th>
														<th class="align-middle text-center">QUANTITY</th>
														<th class="align-middle text-center">UNIT</th>
														<th class="align-middle text-center">REMARKS</th>
													</tr>
												</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-10">
								<div data-scroll="true" data-height="300">
									<div class="table-responsive">
										<table class="table" id="tbl_material_accept">
							              			<thead>
													<tr>
														<th class="align-middle">MATERIAL</th>
														<th class="align-middle text-center">QUANTITY</th>
														<th class="align-middle text-center">UNIT</th>
														<th class="align-middle text-center">INPUT QUANTITY</th>
														<th class="align-middle text-center">ACTION</th>
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
				 	<button type="button" class="btn btn-dark btn-shadow mr-2 btn-change" data-action="view"></button>
            	</div>
        </div>
    </div>
</div>
