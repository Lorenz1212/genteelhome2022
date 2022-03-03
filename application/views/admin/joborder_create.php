<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-joborder-request">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5"></span>Job Order Request</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>

						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100">Request</span>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->
<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-md-12">
					<form class="form" id="Create_Joborder" data-link="Create_Joborder">
					<div class="card card-custom">
						
						<div class="card-header">
							<div class="card-title">
								<span class="card-icon">
									<i class="flaticon2-psd text-primary"></i>
								</span>
								<h3 class="card-label">Create Job Order</h3>
							</div>
							 <div class="card-toolbar">
					      	 <button type="submit" class="btn btn-sm btn-success font-weight-bold"><i class="flaticon2-cube"></i>Submit</button>
					      </div>
						</div>
								<input type="hidden" name="page"      value="admin" />
								<div class="card-body">
									<div class="row justify-content-center">
										<div class="col-xl-7 col-xxl-6 col-md-6">
											<!--begin::Group-->
											<div class="form-group">
												<label>Assign For J.O</label>
													   <select class="form-control" id="users_data" name="assigned"/></select>
													  <span class="form-text text-muted">Please Select option</span>
												</div>
											<div class="form-group">
																  <label>ITEM</label>
																	   <select class="form-control" id="project_no" name="project_no"/>
																	   <option value="" disabled="" selected="">Select Project Title</option>
																	  </select>
																</div>
																 <div class="row">
																 	  <div class="col-lg-8 col-xl-8 col-md-8">
																		 <div class="form-group">
																			   <label>PALLETE COLOR</label>
																			    <div class="input-group">
																			     <select type="text" class="form-control form-control-solid form-control-lg" id="c_code" name="c_code">
																			     	<option value="" disabled="" selected>Select Pallet Color</option>
																			     </select>
																			     <div class="input-group-append" style="padding-left: 10px;">
																				      <img class="images mx-auto d-block img-thumbnail z-depth-3 upfile1" id="color" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg" style="width:50;height:43px;"/>
	
																			       </div>
																			    </div>
																		  </div>
																	 </div>
																</div>
																<div class="form-group">
																   <label>QTY</label>
																   <input type="text" class="form-control" name="unit"/>
															  </div>
											<div class="row">
												<div class="col-lg-6 col-xl-6 col-md-6">
													<div class="form-group">
														<label class="col-xl-3 col-lg-3 col-md-3 col-form-label text-left">Image</label>
														<div class="col-lg-3 col-xl-3 col-md-3">
															<div class="image-input image-input-outline">
																<a id="image_href" target="_blank">
																<img class="image-input-wrapper" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg"  id="image" />
																</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6 col-xl-6 col-md-6">
													<div class="form-group">
															<label class="col-xl-3 col-lg-3 col-md-3 col-form-label text-left">Docs</label>
														<div class="col-lg-3 col-xl-3 col-md-3">
															<div class="image-input image-input-outline" >
																<a id="docs_href" target="_blank">
																<img class="image-input-wrapper" src="<?php echo base_url();?>assets/images/design/project_request/docx/default.jpg" />
																</a>
															</div>
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