<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="design-stocks">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Design For Stocks</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<button class="btn btn-light-success font-weight-bolder btn-sm mr-2 add-stocks"><i class="flaticon-add-circular-button"></i> Create New Product</button>
				<button class="btn btn-light-primary font-weight-bolder btn-sm mr-2 add-stocks-existing"><i class="flaticon-add-circular-button"></i> Add Pallet Color</button>
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
			                    <a class="nav-link" data-toggle="tab" data-name="approved" href="#approved">
			                        <span class="nav-icon"><i class="flaticon-list-3"></i></span>
			                        <span class="nav-text">APPROVED <span class="label label-rounded label-success approved_stocks">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" data-name="request" href="#request">
			                        <span class="nav-icon"><i class="flaticon-exclamation-1"></i></span>
			                        <span class="nav-text">REQUEST FOR APPROVAL <span class="label label-rounded label-warning request_stocks">0</span></span>
			                    </a>
			                </li>
			                 <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" data-name="rejected" href="#rejected">
			                        <span class="nav-icon"><i class="flaticon-cancel"></i></span>
			                        <span class="nav-text">REJECTED <span class="label label-rounded label-danger rejected_stocks">0</span></span>
			                    </a>
			                 </li>
			            </ul>
			        </div>
			    </div>
			    <div class="card-body">
			        <div class="tab-content">
			        	<div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_design_stocks_approved" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>ID</th>
										<th>NO</th>
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
										<th>ID</th>
										<th>NO</th>
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
										<th>ID</th>
										<th>NO</th>
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


<div class="modal fade" id="edit-stocks-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
	            <div class="modal-body">
	            	<form id="Update_Design_Stocks">
		            		<div class="row justify-content-center">
							  <div class="col-xl-12 col-xxl-12 col-md-12">
					        	<div class="row">
									<div class="col-lg-12 col-xl-12">
										<div class="form-group">
												<label class="col-xl-12 col-lg-12 col-form-label text-left">Image</label>
												<div class="col-lg-12 col-xl-12">
													<div class="image-input image-input-outline" id="design_image">
														<div class="image-input-wrapper image-stocks-edit" style=""></div>
														<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
															<i class="fa fa-pen icon-sm text-muted"></i>
															<input type="file" name="image" accept=".png, .jpg, .jpeg" />
															<input type="hidden" name="image_remove"/>
														</label>
														<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
													</div>
												</div>
											</div>
									</div>
								</div>
								<div class="form-group">
								    <label>Specification</label>
								    <div class="input-group input-group-sm">
								     <div class="input-group-prepend"><button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-theme="success" title="Click to upload File" onclick="$('#file-validids').trigger('click');"><i class="fas fa-cloud-upload-alt"></i></button></div>
								     <input type="text" class="form-control form-control-sm valid-upload" onclick="$('#file-validids').trigger('click');" name="docs_previous" placeholder="Click here to upload files..." readonly/>
								     <input type="file" name="docs" accept="application/pdf" id="file-validids" style="display:none;">
								    </div>
						   		</div>
								 <div class="form-group">
									   <label>ITEM</label>
									   <input class="form-control" name="title"/>
							  	 </div>
							  	  <div class="form-group">
								<label>PALLETE COLOR</label>
								 <div class="input-group">
								    <input type="text" class="form-control form-control-lg" name="pallet_name" placeholder="Input pallet name / color name" />
								 	 <div class="input-group-append" style="padding-left: 10px;">
									      <button type="button" data-toggle="tooltip" data-theme="dark" title="FILE SIZE (250 x 250)" class="btn btn-sm btn-light-dark upfile1"><i class="flaticon-upload"></i></button>
									      <input type="file" value="" accept=".png, .jpg, .jpeg" id="image" name="pallet" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" style="display:none"/>
								      </div>
								       <div class="input-group-append" style="padding-left: 10px;">
									      <img class="images mx-auto d-block img-thumbnail z-depth-3 pallet-image" id="blah" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg" style="width:50;height:45px;cursor:pointer;"/>
								      </div>
								</div>
							</div>
						 </div>
					</div>
				</form>
			</div>
				<div class="modal-footer">
					<button  class="btn btn-dark btn-hover-success btn-edit-save">Submit</button>
	            </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="add-stocks-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title">Create New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
	            <div class="modal-body">
	            	<form id="Create_Design_Stocks">
		            		<div class="row justify-content-center">
							  <div class="col-xl-12 col-xxl-12 col-md-12">
					        	<div class="row">
									<div class="col-lg-12 col-xl-12">
										<div class="form-group">
												<label class="col-xl-12 col-lg-12 col-form-label text-left">Image</label>
												<div class="col-lg-12 col-xl-12">
													<div class="image-input image-input-outline" id="design_image_add">
														<div class="image-input-wrapper" style="background-image: url(<?php echo base_url()?>assets/images/design/project_request/images/default.jpg)"></div>
														<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
															<i class="fa fa-pen icon-sm text-muted"></i>
															<input type="file" name="image" accept=".png, .jpg, .jpeg" />
															<input type="hidden" name="image_remove"/>
														</label>
														<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
													</div>
												</div>
											</div>
									</div>
								</div>
								<div class="form-group">
								    <label>Specification</label>
								    <div class="input-group input-group-sm">
								     <div class="input-group-prepend"><button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-theme="success" title="Click to upload File" onclick="$('#file-valididsx').trigger('click');"><i class="fas fa-cloud-upload-alt"></i></button></div>
								     <input type="text" class="form-control form-control-sm valid-uploadx" onclick="$('#file-valididsx').trigger('click');" name="docs_previous" placeholder="Click here to upload files..." readonly/>
								     <input type="file" name="docs" accept="application/pdf" id="file-valididsx" style="display:none;">
								    </div>
						   		</div>
								 <div class="form-group">
									   <label>ITEM</label>
									   <input class="form-control" name="title"/>
							  	 </div>
							  	  <div class="form-group">
								<label>PALLETE COLOR</label>
								 <div class="input-group">
								    <input type="text" class="form-control form-control-lg" name="pallet_name" placeholder="Input pallet name / color name" />
								 	 <div class="input-group-append" style="padding-left: 10px;">
									      <button type="button" data-toggle="tooltip" data-theme="dark" title="FILE SIZE (250 x 250)" class="btn btn-sm btn-light-dark upfile3"><i class="flaticon-upload"></i></button>
									      <input type="file" value="" accept=".png, .jpg, .jpeg" id="image3" name="pallet" onchange="document.getElementById('blahx').src = window.URL.createObjectURL(this.files[0])" style="display:none"/>
								      </div>
								       <div class="input-group-append" style="padding-left: 10px;">
									      <img class="images mx-auto d-block img-thumbnail z-depth-3" id="blahx" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg" style="width:50;height:45px;cursor:pointer;"/>
								      </div>
								</div>
							</div>
						 </div>
					</div>
				</form>
			</div>
				<div class="modal-footer">
					<button  class="btn btn-dark btn-hover-success btn-add-save">Submit</button>
	            </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add-stocks-existing-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title">Create New Pallet Color</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form id="Create_Design_Stocks_Existing">
	            		<div class="row justify-content-center">
						  <div class="col-xl-12 col-xxl-12 col-md-12">
				        	<div class="row">
								<div class="col-lg-12 col-xl-12">
							<div class="form-group">
								   <label>ITEM</label>
								   <select class="form-control" id="title" name="title">
								   </select>
						  	</div>
							  <div class="form-group">
								<label>PALLETE COLOR</label>
								 <div class="input-group">
								    <input type="text" class="form-control form-control-lg" name="pallet_name" placeholder="Input pallet name / color name" />
								 	 <div class="input-group-append" style="padding-left: 10px;">
									      <button type="button" data-toggle="tooltip" data-theme="dark" title="FILE SIZE (250 x 250)" class="btn btn-sm btn-light-dark upfile2"><i class="flaticon-upload"></i></button>
									      <input type="file" value="" accept=".png, .jpg, .jpeg" id="image2" name="pallet" onchange="document.getElementById('blahh').src = window.URL.createObjectURL(this.files[0])" style="display:none"/>
								      </div>
								       <div class="input-group-append" style="padding-left: 10px;">
									      <img class="images mx-auto d-block img-thumbnail z-depth-3" id="blahh" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg" style="width:50;height:45px;cursor:pointer;"/>
								      </div>
								</div>
							</div>
							<div class="form-group">
							    <label>Specification</label>
							    <div class="input-group input-group-sm">
							     <div class="input-group-prepend"><button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-theme="success" title="Click to upload File" onclick="$('#file-valididss').trigger('click');"><i class="fas fa-cloud-upload-alt"></i></button></div>
							     <input type="text" class="form-control form-control-sm valid-uploadss" onclick="$('#file-valididss').trigger('click');" name="docs_previous" placeholder="Click here to upload files..." readonly/>
							     <input type="file" name="docs" accept="application/pdf" class="input-image" id="file-valididss" style="display:none;">
							    </div>
					   		</div>
						</div>
						</div>
					</div>
				</div>
			</form>
		</div>
				<div class="modal-footer">
					<button  class="btn btn-dark btn-hover-success btn-add-existing-save">Submit</button>
	            </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade p-0" id="view-stocks" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0" >
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                
                <button type="button" class="close d-flex align-self-start" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body p-0" >
                <div class="card-body py-0">
                    <span class="d-block font-weight-bolder mr-3 my-3 text-primary">Product Info</span>
                    <span class=" log-message"></span>
                    <div class="d-flex flex-wrap">
                        <div class="mr-12 d-flex flex-column ">
                            <span class="d-block font-weight-normal mb-4">Item Name</span>
                             <span class="d-block font-weight-bolder mb-4 title">---</span>
                        </div>
                         <div class="mr-12 d-flex flex-column ">
                            <span class="d-block font-weight-normal mb-4">Pallet Color</span>
                            <span class="d-block font-weight-bolder mb-4 c_name">---</span>
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
                    <span class="d-block font-weight-bolder mb-4 text-primary">Image, Pallet Color & Specification</span>
                    <div class="row gutter-b view-form-image">
                    </div>
                    <div class="separator separator-solid mb-5"></div>
            	</div>
       		 </div>
    	</div>
	</div>
</div>

