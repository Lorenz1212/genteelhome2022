<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="profile">
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
					<div class="card card-custom">
								<div class="card-header">
									<div class="card-title">
										<span class="card-icon">
											<i class="flaticon2-psd text-primary"></i>
										</span>
										<h3 class="card-label">Update Profile</h3>
									</div>
								</div>
								<div class="card-body">
									<div class="row justify-content-center">
									   <div class="col-xl-7 my-2">
										<div class="col-xl-12 col-xxl-9">
											<!--begin::Group-->
											<div class="row justify-content-center">
												<div class="col-lg-3 col-xl-3">
													<div class="form-group">
														<label>Image</label>
														<div class="col-lg-3 col-xl-3">
															<div class="image-input image-input-empty image-input-outline image-update" id="kt_image_5" style="background-image: url(<?php echo base_url('assets/images/avatar/default.jpg')?>)">
															 <div class="image-input-wrapper"></div>

															 <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
															  <i class="fa fa-pen icon-sm text-muted"></i>
															  <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/>
															  <input type="hidden" name="profile_avatar_remove"/>
															 </label>

															 <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															  <i class="ki ki-bold-close icon-xs text-muted"></i>
															 </span>
<!-- 
															 <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
															  <i class="ki ki-bold-close icon-xs text-muted"></i>
															 </span> -->
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-lg-12">
												<label class="form-control-label">User Name</label>
												   	<div class="input-group">
												     <input type="text" class="form-control form-control-solid form-control-lg username" name="username" placeholder="Enter Username"/>
													   <div class="input-group-append">
													      <button class="btn btn-secondary save" type="button" data-name="username">SAVE</button>
													    </div>
												   </div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-lg-12">
												<label class="form-control-label">Email Address</label>
												   	<div class="input-group">
												     <input type="text" class="form-control form-control-solid form-control-lg email" name="email" placeholder="Enter Email Address"/>
													   <div class="input-group-append">
													      <button class="btn btn-secondary save" type="button" data-name="email">SAVE</button>
													    </div>
												   </div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group ">
														<label>New Password</label>
														    <input type="password" class="form-control form-control-solid form-control-lg password" name="password" type="text" />
														</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group ">
													<div class="col-lg-12">
														<label>Confirmation Password</label>
														<div class="input-group">
														    <input type="password" class="form-control form-control-solid form-control-lg con_password" name="con_password" type="text" />
															   <div class="input-group-append">
															      <button class="btn btn-secondary save" type="button" data-name="password">SAVE</button>
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
												     <input class="form-control form-control-solid form-control-lg fname" name="fname" type="text" />
													   <div class="input-group-append">
													      <button class="btn btn-secondary save" type="button" data-name="fname">SAVE</button>
													   </div>
												 </div>
											</div>
										</div>
										<div class="form-group row">
												<div class="col-lg-12">
												<label>Last Name</label>
												<div class="input-group">
												    <input class="form-control form-control-solid form-control-lg lname" name="lname" type="text" />
													   <div class="input-group-append">
													      <button class="btn btn-secondary save" type="button"  data-name="lname">SAVE</button>
													   </div>
												 </div>
											</div>
										</div>
											<div class="form-group row">
												<div class="col-lg-12">
												<label>Middle Name/Initial</label>
												<div class="input-group">
												    <input class="form-control form-control-solid form-control-lg mname" name="mname" type="text" />
													   <div class="input-group-append">
													      <button class="btn btn-secondary save" type="button" data-name="mname">SAVE</button>
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
				</div>
			</div>
		</div>
	</div>
</div>