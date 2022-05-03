<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-design-create">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Create For Product Stocks</h2>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->
<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<form class="form" id="Create_Design_Stocks" data-link="Create_Design_Stocks" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="card card-custom">
						<div class="card-header">
							<div class="card-title">
							</div>
							<div class="card-toolbar">
							
					            <button type="submit" class="btn btn-sm btn-success font-weight-bold">
					                <i class="flaticon2-cube"></i> Submit</button>
						        </div>
							</div>
								<div class="card-body">
									<div class="row justify-content-center ">
										<div class="col-xl-6 col-xxl-6 col-md-6">
											<!--begin::Group-->
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-md-5 col-form-label text-left">IMAGE</label>
												<div class="col-lg-9 col-xl-9 col-md-9">
													<div class="image-input image-input-outline" id="design_image">
														<div class="image-input-wrapper" style="background-image: url(<?php echo base_url();?>assets/images/design/project_request/images/default.jpg)"></div>
														<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
															<i class="fa fa-pen icon-sm text-muted"></i>
															<input type="file" name="image" accept=".png, .jpg, .jpeg" />
															<input type="hidden" name="image_remove"/>
														</label>
														<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
														<span>File Size (500 X 500)</span>
													</div>
												</div>
											</div>
										 <div class="form-group row">
										 	<div class="col-lg-10 col-xl-10 col-md-10">
											<label>SPECIFICATIONS</label>
												<div></div>
												<div class="custom-file">
												<input type="file" name="docs" accept=".doc, .pdf"/>
												</div>
											</div>
										 </div>
										  <div class="form-group row">
										  	<div class="col-lg-10 col-xl-10 col-md-10">
											   <label>ITEM</label>
											   <input class="form-control form-control-solid form-control-lg" name="title" placeholder="Enter Project title...." required="" autocomplete="off" />
											</div>
										  </div>
										   <div class="row">
										 	  <div class="col-lg-8 col-xl-8 col-md-10">
												 <div class="form-group">
													   <label>PALLETE COLOR</label>
													    <div class="input-group">
													     <input type="text" class="form-control form-control-solid form-control-lg" name="c_name" placeholder="Enter pallete name...." required=""  autocomplete="off"/>
													     <div class="input-group-append" style="padding-left: 10px;">
														      <button type="button" data-toggle="tooltip" data-theme="dark" title="FILE SIZE (250 x 250)" class="btn btn-sm btn-light-dark upfile1"><i class="flaticon-upload"></i></button>
														      <input type="file" value="" accept=".png, .jpg, .jpeg" id="image" name="color" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" style="display:none"/>
													      </div>
													       <div class="input-group-append" style="padding-left: 10px;">
														      <img class="images mx-auto d-block img-thumbnail z-depth-3" id="blah" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg" style="width:50;height:45px;cursor:pointer;"/>
													      </div>
													    </div>
												  </div>
											 </div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>