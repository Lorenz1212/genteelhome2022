<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-design-stocks">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Design For Stocks</h2>
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
			                    <a class="nav-link active" data-toggle="tab" href="#approved">
			                        <span class="nav-icon"><i class="flaticon-list-3"></i></span>
			                        <span class="nav-text">APPROVED <span class="label label-rounded label-success approved_stocks">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#request">
			                        <span class="nav-icon"><i class="flaticon-exclamation-1"></i></span>
			                        <span class="nav-text">REQUEST FOR APPROVAL <span class="label label-rounded label-warning request_stocks">0</span></span>
			                    </a>
			                </li>
			                 <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#rejected">
			                        <span class="nav-icon"><i class="flaticon-cancel"></i></span>
			                        <span class="nav-text">REJECTED <span class="label label-rounded label-danger rejected_stocks">0</span></span>
			                    </a>
			                 </li>
			            </ul>
			        </div>
			    </div>
			    <div class="card-body">
			        <div class="tab-content">
			        	<div class="tab-pane fade show active" id="approved" role="tabpanel" aria-labelledby="approved">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_design_stocks_approved" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>IMAGE</th>
										<th>TITLE</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request">
			               <table class="table table-bordered table-hover table-checkable link" id="tbl_design_stocks_request" data-link="tbl_design_stocks" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>IMAGE</th>
										<th>TITLE</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_design_stocks_rejected" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>IMAGE</th>
										<th>TITLE</th>
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
            	<form class="form" data-link="Update_Design_Stocks">
            	<div class="row justify-content-center">
					<div class="col-xl-6 col-xxl-6 col-md-6">
			        	<div class="row">
							<div class="col-lg-6 col-xl-6">
								<div class="form-group image-view" style="display: block;">
									<label class="col-xl-3 col-lg-3 col-form-label text-left">Image</label>
									<div class="col-lg-3 col-xl-3">
										<div class="image-input image-input-outline">
											  <img class="image-input-wrapper image" id="myImg" src="" />
										</div>
									</div>
								</div>
								<div class="form-group image-update" style="display: none;">
										<label class="col-xl-3 col-lg-3 col-form-label text-left">Image</label>
										<div class="col-lg-3 col-xl-3">
											<div class="image-input image-input-outline" id="design_image">
												<div class="image-input-wrapper image-stocks"></div>
												<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
													<i class="fa fa-pen icon-sm text-muted"></i>
													<input type="file" name="image" accept=".png, .jpg, .jpeg" />
													<input type="hidden" name="image_remove"/>
													<input type="hidden" name="image_previous">
												</label>
												<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
													<i class="ki ki-bold-close icon-xs text-muted"></i>
												</span>
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
						 <div class="form-group row specifications-edit" style="display:none">
						 	<div class="col-lg-10 col-xl-10 col-md-10">
								<label>SPECIFICATIONS</label>
								<div></div>
								<div class="custom-file">
								  <input type="file" name="docs" accept=".doc, .pdf"/>
								   <input type="hidden" name="docs_previous">
								</div>
							</div>
						 </div>
						 <div class="form-group">
							   <label>ITEM</label>
							   <input class="form-control" name="title" readonly/>
					  	 </div>
					  	  <div class="row">
						 	  <div class="col-lg-12 col-xl-12">
								 <div class="form-group">
									   <label>PALLETE COLOR</label>
									    <div class="input-group">
									     <input type="text" class="form-control form-control-solid form-control-lg" name="c_name" readonly/>
									     <div class="input-group-append color-view" style="padding-left: 10px; display: block;">
									     	<a id="cimage_href" target="_blank">
										      <img class="images mx-auto d-block img-thumbnail z-depth-3 c_image" id="myImg" style="width:50;height:45px;"/>
										    </a>
									      </div>
									        <div class="input-group-append color-update " style="padding-left: 10px;display: none;">
									        <a class="upfile1" style="cursor:pointer;">
										      <img class="images mx-auto d-block img-thumbnail z-depth-3 c-image" id="blah" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg" style="width:50;height:45px;"/>
										     </a>
										      <input type="file" value="" accept=".png, .jpg, .jpeg" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" id="c-image" name="color" style="display:none"/>
										      <input type="hidden" name="color_previous">
									       </div>
									    </div>
								  </div>
							 </div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button  class="btn btn-dark btn-edit" style="display:block"><i class="flaticon2-pen"></i> Edit</button>
					<button  class="btn btn-dark btn-save" style="display:none"><i class="flaticon2-pen"></i>Save Changes</button>
	            </div>
            </div>
        </form>
        </div>
    </div>
</div>

