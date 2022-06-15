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
									                        <span class="nav-text  mr-2">Request</span>
									                        <span class="label label-rounded label-warning material_request_pending_stocks">0</span>
									                    </a>
													</li>
													<!--end::Item-->
													<!--begin::Item-->
													<li class="nav-item">
														 <a class="nav-link" data-toggle="tab" href="#complete">
									                        <span class="nav-text mr-2">RELEASE</span>
									                        <span class="label label-rounded label-success material_request_complete_stocks">0</span>
									                    </a>
													</li>
													<!--end::Item-->
												</ul>
										   		 </div>
										   	</div>
									<!--begin::Body-->
									<div class="card-body">
										<!--begin::Nav Content-->
										<div class="tab-content">
											<div class="tab-pane active" id="request" role="tabpanel">
												<table class="table table-bordered table-hover table-checkable link" id="tbl_material_request" data-link="tbl_material_request_stocks">
													<thead>
														<tr>
															<th style="width: 15%;">Trans #</th>
															<th style="width: 30%;">TITLE</th>
															<th style="width:10px;">REQUESTOR</th>
															<th>DATE</th>
															<th  style="width:5px;">ACTION</th>
														</tr>
													</thead>
												</table>
											</div>
											<div class="tab-pane" id="complete" role="tabpanel">
												<table class="table table-bordered table-hover table-checkable" id="tbl_material_request_complete">
													<thead>
														<tr>
															<th>Trans #</th>
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
<div class="modal fade" id="modal-form" style="overflow: auto;" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
            	<div class="row">
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
						<div class="row">
							<div class="col-md-12" style="height: 300px;">
									<table class="table table-hover" id="tbl_material_request_stocks_modal">
						              			<thead>
												<tr class="table-primary">
													<th class="align-middle pl-2">MATERIALS</th>
													<th class="align-middle text-center">QUANTITY</th>
													<th class="align-middle text-center">REMARKS</th>
												</tr>
											</thead>
										<tbody>
										</tbody>
									</table>
							</div>
							<div class="col-md-12" style="height: 300px;">
									<table class="table table-hover" id="tbl_material_accept">
						              			<thead>
												<tr class="table-primary">
													<th class="align-middle"></th>
													<th class="align-middle">MATERIALS</th>
													<th class="align-middle text-center">QUANTITY</th>
													<th class="align-middle text-center">STOCKS</th>
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
				 <div class="modal-footer d-flex justify-content-between">
				 	<button type="button" class="btn btn-light-danger btn-shadow mr-2 btn-view-cancel"><span id="count-cancelled"></span> Cancelled item</button>
				 	<button type="button" class="btn btn-dark btn-shadow mr-2 btn-change" data-action="view"></button>
            	</div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalTalble" style="overflow: auto;"  tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white"><span id="text-table"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close text-white"></i>
                </button>
            </div>
            <div class="modal-body">
             	<table class="table table-hover table-white" id="tbl_material_cancelled">
				      <thead>
				        <tr class="table-danger">
					         <th>MATERIALS</th>
					         <th>QUANTITY</th>
					         <th>DATE CANCELLED</th>
					         <th>ACTION</th>
				        </tr>
				      </thead>
				      <tbody class="text-white">

				      </tbody>
				    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-transparent-white font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



