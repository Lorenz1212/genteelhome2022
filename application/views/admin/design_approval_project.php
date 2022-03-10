<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-design-project-approval">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Project Request</h2>
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
			                <table class="table table-bordered table-hover table-checkable link" id="tbl_approval_design_project_request" data-link="tbl_approval_design_project_request" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>TITLE</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_approval_design_project_approved" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>TITLE</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_approval_design_project_rejected" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
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
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form class="form" data-link="Update_Approval_Designed_Project">
            	<div class="row justify-content-center">
					<div class="col-xl-6 col-xxl-6 col-md-6">
			        	<div class="row">
							<div class="col-lg-6 col-xl-6">
								<div class="form-group image-view" style="display: block;">
									<label class="col-xl-3 col-lg-3 col-form-label text-left">Image</label>
									<div class="col-lg-3 col-xl-3">
										<div class="image-input image-input-outline">
											<a id="image_href" target="_blank">
											  <img class="image-input-wrapper" src="" id="image"/>
										    </a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-xl-6">
								<div class="form-group">
									<label class="col-xl-3 col-lg-3 col-form-label text-left">Specifications</label>
									<div class="col-lg-3 col-xl-3">
										<div class="image-input image-input-outline" id="docs">
											<a id="docs_href" target="_blank">
											<img class="image-input-wrapper" src="<?php echo base_url();?>assets/images/design/project_request/docx/default.png" />
										    </a>
										</div>
									</div>
								</div>
							</div>
						</div>
						 <div class="form-group">
							   <label>ITEM</label>
							   <input class="form-control" name="title" readonly/>
					  	 </div>
					</div>
				</div>
				<div class="modal-footer button_status">
	            </div>
            </div>
        </form>
        </div>
    </div>
</div>