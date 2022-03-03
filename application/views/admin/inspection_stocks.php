<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-approval-inspection-stocks">
  <div class="form" data-link="Update_Approval_Inspection_Stocks"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Inspection Request For Project Approval</h2>
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
			                <table class="table table-bordered table-hover table-checkable link" id="tbl_approval_inspection_stocks_request" data-link="tbl_approval_inspection_stocks" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>IMAGE</th>
										<th>TITLE</th>
										<th>QUANTITY</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved">
			                 <table class="table table-bordered table-hover table-checkable" id="tbl_approval_inspection_stocks_approved" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>IMAGE</th>
										<th>TITLE</th>
										<th>QUANTITY</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_approval_inspection_stocks_rejected" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>IMAGE</th>
										<th>TITLE</th>
										<th>QUANTITY</th>
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

<div class="modal fade" id="requestModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title" id="joborder"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            
            </div>
            <div class="modal-body">
						<div class="card-body">
										<div class="row justify-content-center">
											<div class="col-xl-10 col-xxl-10 col-md-10">
												<div class="row">
													<div class="col-lg-4 col-xl-4 col-md-4">
														<div class="form-group">
															<label>Image</label>
															<div class="col-lg-3 col-xl-3">
																<div class="image-input image-input-outline" id="design_image">
																	<a id="image_href" target="_blank">
																	  <img class="image-input-wrapper" id="image" style="width: 250px;height: 250px;object-fit: cover;" />
																    </a>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-8 col-xl-8 col-md-8">
															<div class="form-group">
																   <label>Project Name</label>
																   <input class="form-control" id="title" disabled />
														  	 </div>
															<div class="form-group">
														    <label>Specification</label>
																 <div class="input-group">
																    <div class="input-group-append">
																      <a id="docs_href" target="_blank" data-toggle="tooltip" data-theme="dark" title="View Specification" class="btn  btn-light-dark btn-icon"><i class="flaticon-eye"></i></a>
																    </div>
																     <input type="text" class="form-control form-control-solid" id="docs" placeholder="No Specification Uploaded" style="cursor:pointer;" disabled/>
															    </div>
													  		</div>
													  		<div class="form-group">
															 <label>Input Remarks (Optional)</label>
															<div class="summernote" id="kt_summernote_1"></div>
														</div>
													</div>
												</div>
											</div>
												<div class="row">
													<div class="col-xl-12 col-xxl-12 col-md-12">
														<div class="card card-custom">
															 <div class="card-header bg-dark">
															  	<div class="card-title">
														          <h3 class="text-white">Inspection </h3>
														        </div>
															 </div>
															 <div class="card-body">
																<div class="row" id="requestInspection">
																</div>
															 </div>
														</div>
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
		    </div>
		</div>
		