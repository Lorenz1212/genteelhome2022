<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-testimony">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">TESTIMONY</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<button type="button" class="btn btn-success btn-shadow font-weight-bold py-3 px-6 btn-create" data-action="create" data-toggle="modal" data-target="#staticBackdrop">Create Product</button>
			</div>
		</div>
	</div>
	<!--end::Subheader-->
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">
				<div class="card card-custom">
					<div class="card-header">
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover table-checkable link" id="tbl_testimony" data-link="tbl_testimony" style="margin-top: 13px !important">
							<thead>
								<tr>
									<th>No</th>
									<th>Image</th>
									<th>Name</th>
									<th>Description</th>
									<th>Date Created</th>
									<th>ACTION</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
	<!--end::Content-->
<!-- Modal-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white">Testimony</h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close text-white"></i>
                </button>
            </div>
           	 <form class="form" id="Create_Update_Testimony" data-link="Create_Update_Testimony" enctype="multipart/form-data" accept-charset="utf-8">
            	<input type="hidden" name="previous_image"/>
				<input type="hidden" name="id"/>
				<input type="hidden" name="page"/>
            <div class="modal-body">
            	<div class="form-group">
            		<div class="image-input image-input-outline image-input-circle" id="kt_image_5">
						 <div class="image-input-wrapper" id="testimony-image" ></div>
						 <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
						  <i class="fa fa-pen icon-sm text-muted"></i>
						  <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/>
						  <input type="hidden" name="profile_avatar_remove"/>
						 </label>

						 <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
						  <i class="ki ki-bold-close icon-xs text-muted"></i>
						 </span>
					</div>
            	</div>
                 <div class="form-group">
				    <label class="text-white">Name <span class="text-danger">*</span></label>
				    <input type="text" class="form-control" name="name" autocomplete="off" />
				  </div>
				  <div class="form-group">
				    <label class="text-white">Testimony <span class="text-danger">*</span></label>
				  	<textarea class="form-control" name="description" rows="5"></textarea>
				  </div>
            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-success font-weight-bold">Submit</button>
	            </div>
	        </div>
    	</form>
    </div>
</div>