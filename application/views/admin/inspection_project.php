<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="inspection-project">
  <div class="form" data-link="Update_Approval_Inspection_Project"></div>
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
			                        <span class="nav-text">Request <span class="label label-rounded label-warning project_inpection_pending">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#approved">
			                        <span class="nav-icon"><i class="flaticon-list-3"></i></span>
			                        <span class="nav-text">Approved <span class="label label-rounded label-success project_inpection_approved">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#rejected">
			                        <span class="nav-icon"><i class="flaticon2-cross"></i></span>
			                        <span class="nav-text">Rejected <span class="label label-rounded label-danger project_inpection_rejected">0</span></span>
			                    </a>
			                </li>
			            </ul>
			        </div>
			    </div>
			    <div class="card-body">
			        <div class="tab-content">
			            <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request">
			                <table class="table table-bordered table-hover" id="tbl_approval_inspection_project_request" >
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
			                 <table class="table table-bordered table-hover" id="tbl_approval_inspection_project_approved">
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
			                <table class="table table-bordered table-hover" id="tbl_approval_inspection_project_rejected">
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

<div class="modal fade p-0" id="view-project" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0" >
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                
                <button type="button" class="close d-flex align-self-start" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body p-0" >
                <!-- <div class="card card-custom gutter-b card-stretch" > -->
                <div class="card-body py-0">
                    <span class="d-block font-weight-bolder mr-3 my-3 text-primary">Project Info</span>
                    <span class=" log-message"></span>
                    <div class="d-flex flex-wrap">
                        <div class="mr-12 d-flex flex-column ">
                            <span class="d-block font-weight-normal mb-4">Project Name</span>
                             <span class="d-block font-weight-bolder mb-4 project_name">---</span>
                        </div>
                        <div class="mr-12 d-flex flex-column ">
                            <span class="d-block font-weight-normal mb-4">Creator</span>
                            <span class="d-block font-weight-bolder mb-4 creator">---</span>
                        </div>
                         <div class="mr-12 d-flex flex-column ">
                            <span class="d-block font-weight-normal mb-4">Date Created</span>
                            <span class="d-block font-weight-bolder mb-4 date_created">---</span>
                        </div>
                    </div>
                    <div class="separator separator-solid mb-5"></div>
                    <span class="d-block font-weight-bolder mb-4 text-primary">Image & Specification</span>
                    <div class="row gutter-b view-form-image">
                    </div>
                    <div class="separator separator-solid mb-5"></div>
            	</div>
       		 </div>
    	</div>
	</div>
</div>

