<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-customization">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Customization</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100 i-title"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
			<div class="card card-custom">
				<div class="card-header">
					<div class="card-title">
						<span class="card-icon">
							<i class="flaticon2-psd text-primary"></i>
						</span>
						<h3 class="card-label">List of <span class="i-title"></span></h3>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-hover table-checkable link" id="tbl_customization" data-link="tbl_customization" style="margin-top: 13px !important">
						<thead>
							<tr>
								<th>SO NO.</th>
								<th>SALES PERSON</th>
								<th>DATE</th>
								<th>Actions</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<!--end::Card-->
		</div>
	</div>
</div>
<!-- Modal-->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="form" data-link="Update_Approval_Customization"></div>
    		<input type="hidden" id="page" value="customization">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title" id="so_no"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
                </div>
                    <div class="modal-body">
						<div class="col-xl-12">
							<textarea id="kt-tinymce-4" name="remarks" class="tox-target"></textarea>
						</div>
					</div>
					<div class="modal-footer" id="button_status">
						
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
