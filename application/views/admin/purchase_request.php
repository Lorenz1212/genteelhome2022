<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-approval-purchased">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Purchase Request For Approval</h2>
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
			                    <a class="nav-link" data-toggle="tab" href="#rejected">
			                        <span class="nav-icon"><i class="flaticon2-cross"></i></span>
			                        <span class="nav-text">Rejected</span>
			                    </a>
			                </li>
			            </ul>
			        </div>
			    </div>
			    <div class="card-body">
			        <div class="tab-content">
			            <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request">
			                <table class="table table-bordered table-hover table-checkable link" id="tbl_approval_purchased_request" data-link="tbl_approval_purchased_request" style="margin-top: 13px !important">
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
			                <table class="table table-bordered table-hover table-checkable" id="tbl_approval_purchased_approved" style="margin-top: 13px !important">
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
			            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_approval_purchased_rejected" style="margin-top: 13px !important">
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
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>

<!-- Modal-->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
        	<form class="form" id="Update_Approval_Purchase" data-link="Update_Approval_Purchase">
        	 <div class="modal-header">
                <h5 class="modal-title">Request</h5>
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
												<input type="hidden" id="production_no_input" name="production_no"/>
												<span id="production_no"></span>
												<span id="title"></span>
												<span id="c_name"></span>
												<span id="unit"></span>
												<span id="date_created"></span>
												<span id="requestor"></span>
											</span>
										</div>
										<h1 class="display-3 font-weight-boldest order-1 order-md-2 mb-5 mb-md-0"><span id="status"></span></h1>
									</div>
								</div>
							</div>
						<div class="row justify-content-center">
							<div class="col-md-9">
									<div class="table-responsive">
										<table class="table" id="tbl_admin_project_modal">
											<thead>
												<tr class="font-weight-boldest h-65px">
													<th class="align-middle font-size-h4 pl-0 ">ITEM/DESCRIPTION</th>
													<th class="align-middle font-size-h4 text-center">Quantity</th>
													<th class="align-middle font-size-h4 text-right border-0">Amount</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
					</div>
				 <div class="modal-footer" id="button_status">
            	</div>
			</form>
        </div>
    </div>
</div>