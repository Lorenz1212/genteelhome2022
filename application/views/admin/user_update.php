<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-profile-update">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5"></span>Profile Account</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>

						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100">Update</span>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->
<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<form class="form" id="Update_Profile" data-link="Update_Profile" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="card card-custom">
								<div class="card-header">
									<div class="card-title">
										<span class="card-icon">
											<i class="flaticon2-psd text-primary"></i>
										</span>
										<h3 class="card-label">Update Profile</h3>
									</div>
								</div>
								<input type="hidden" name="page" value="admin"/>
								<div class="card-body">
									<div class="row justify-content-center">
										<div class="col-xl-3"></div>
									   <div class="col-xl-7 my-2">
										<div class="col-xl-12 col-xxl-9">
											<!--begin::Group-->
											<div class="row">
												<div class="col-lg-3 col-xl-3">
													<div class="form-group">
														<label>Image</label>
														<div class="col-lg-3 col-xl-3">
															<div class="image-input image-input-outline">
																  <img class="image-input-wrapper myImg images" id="blank"/>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
													<div class="col-lg-7 col-xl-7">
													  <div class="form-group">
													    <label>Upload Photo</label>
														    <div class="input-group">
														     <input type="text" class="form-control form-control-solid upfile1" id="customFile" style="cursor:pointer;" readonly="" />
														     <input type="file" value="" accept=".png, .jpg, .jpeg" onchange="document.getElementById('customFile').value = window.URL.createObjectURL(this.files[0]);document.getElementById('blank').src = window.URL.createObjectURL(this.files[0])" id="imagefile" name="image" style="display:none"/>
														      <div class="input-group-append">
														      <button class="btn btn-secondary" id="save_image" data-action="image" type="button">SAVE</button>
														     </div>
													    </div>
												   </div>
											  	</div>
											</div>
											<div class="form-group row">
												<div class="col-lg-12">
												<label class="form-control-label">User Name</label>
												   	<div class="input-group">
												     <input type="text" class="form-control form-control-solid form-control-lg" name="username" placeholder="Enter Username"/>
													   <div class="input-group-append">
													      <button class="btn btn-secondary save" type="button" id="save_username" data-action="username">SAVE</button>
													    </div>
												   </div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group ">
														<label>New Password</label>
														    <input type="password" class="form-control form-control-solid form-control-lg" name="password" type="text" />
														</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group ">
													<div class="col-lg-12">
														<label>Confirmation Password</label>
														<div class="input-group">
														    <input type="password" class="form-control form-control-solid form-control-lg" name="con_password" type="text" />
															   <div class="input-group-append">
															      <button class="btn btn-secondary" type="button" id="save_password" data-action="password">SAVE</button>
															   </div>
														 </div>
														</div>
													</div>
												</div>
											</div>
												
											<div class="form-group row">
												<div class="col-lg-12">
												<label>First Name</label>
											    <div class="input-group">
												     <input class="form-control form-control-solid form-control-lg" name="firstname" type="text" />
													   <div class="input-group-append">
													      <button class="btn btn-secondary" type="button" id="save_firstname" data-action="firstname">SAVE</button>
													   </div>
												 </div>
											</div>
										</div>
										<div class="form-group row">
												<div class="col-lg-12">
												<label>Last Name</label>
												<div class="input-group">
												    <input class="form-control form-control-solid form-control-lg" name="lastname" type="text" />
													   <div class="input-group-append">
													      <button class="btn btn-secondary" type="button" id="save_lastname" data-action="lastname">SAVE</button>
													   </div>
												 </div>
											</div>
										</div>
											<div class="form-group row">
												<div class="col-lg-12">
												<label>Middle Name/Initial</label>
												<div class="input-group">
												    <input class="form-control form-control-solid form-control-lg" name="middlename" type="text" />
													   <div class="input-group-append">
													      <button class="btn btn-secondary" type="button" id="save_middlename" data-action="middlename">SAVE</button>
													   </div>
												 </div>
												</div>
											</div>
										
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