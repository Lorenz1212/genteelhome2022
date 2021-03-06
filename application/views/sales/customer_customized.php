<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-customer-customized-sales">
	<div class="form" data-link="Create_Customized_Request"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Customize List</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<button type="button" class="btn btn-light-success font-weight-bold py-3 px-6" data-toggle="modal" data-target="#customized-form">Add Customize Product</button>
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
			                        <span class="nav-text">Request</span>
			                        <span class="label label-rounded label-warning request_customized_pending">0</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#approved">
			                        <span class="nav-text">Approved</span>
			                        <span class="label label-rounded label-success request_customized_approved">0</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#rejected">
			                        <span class="nav-text">Rejected</span>
			                        <span class="label label-rounded label-danger request_customized_rejected">0</span>
			                    </a>
			                </li>
			            </ul>
			   		 </div>
			   	</div>
			    <div class="card-body">
			        <div class="tab-content">
			            <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover" id="tbl_customized_request">
								<thead>
									<tr>
										<th>NO</th>
										<th>Subject</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover" id="tbl_customized_approved">
								<thead>
									<tr>
										<th>NO</th>
										<th>Subject</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			             <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover" id="tbl_customized_rejected">
								<thead>
									<tr>
										<th>NO</th>
										<th>Subject</th>
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
<div class="modal fade" id="customized-form" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Customize Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form id="Create_Customized_Request">
	            	 <div class="form-group">
					    <label>Subject <span class="text-danger">*</span></label>
					    <input type="text" class="form-control" name="subject"/>
					  </div>
	                  <div class="summernote"></div>
                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold Create_Customized_Request">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="customized-for-update" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customize Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form id="Update_Customized_Request">
	            	 <div class="form-group">
					    <label>Subject <span class="text-danger">*</span></label>
					    <input type="text" class="form-control" name="subject_update"/>
					  </div>
	                  <div class="summernote1"></div>
                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold Update_Customized_Request  btn-hide">Save Changes</button>
            </div>
        </div>
    </div>
</div>