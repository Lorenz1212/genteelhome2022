<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-user-create">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5"></span>User's Account</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>

						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100">Create</span>
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
								<h3 class="card-label">Create New User</h3>
							</div>
						</div>
							<form class="form" id="Create_Users" data-link="Create_Users" enctype="multipart/form-data" accept-charset="utf-8">
								<input type="hidden"  name="status" value="ACTIVE" />
								<input type="hidden"  name="page" value="admin" />
								<div class="card-body">
										<div class="row">
														<div class="col-xl-3"></div>
														<div class="col-xl-7 my-2">
									<div class="row justify-content-center">
										<div class="col-xl-12 col-xxl-8">
											<!--begin::Group-->
										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label text-left">Avatar</label>
											<div class="col-lg-9 col-xl-9">
												<div class="image-input image-input-outline" id="avatar">
													<div class="image-input-wrapper" style="background-image: url(<?php echo base_url() ?>assets/images/avatar/default.jfif)"></div>
													<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
														<i class="fa fa-pen icon-sm text-muted"></i>
														<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
														<input type="hidden" name="profile_avatar_remove" />
													</label>
													<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
														<i class="ki ki-bold-close icon-xs text-muted"></i>
													</span>
												</div>
											</div>
										</div>
											<div class="form-group row"> 
													<div class="col-lg-12">
													    <label class="form-control-label">User Name</label>
													    <input type="text" class="form-control form-control-solid form-control-lg" name="username" placeholder="Enter Username"/>
													    <span id="alert"></span>
													</div>
													<div class="col-lg-6">
														    <label>Password</label>
														    <input class="form-control form-control-solid form-control-lg" name="password" type="password" />
													</div>
													<div class="col-lg-6">
														    <label>Confirmation Password</label>
														   <input class="form-control form-control-solid form-control-lg" placeholder="Verify password" name="conpassword" type="password"  />
													</div>
											</div>
											<div class="form-group row">
												<div class="col-lg-12">
												<label>First Name</label>
												<input class="form-control form-control-solid form-control-lg" name="firstname" type="text" />
											    </div>
											</div>
											<div class="form-group row">
												<div class="col-lg-12">
												<label>Last Name</label>
												<input class="form-control form-control-solid form-control-lg" name="lastname" type="text" />
												</div>
											</div>
											<div class="form-group row">
												<div class="col-lg-12">
												<label>Middle Name/Initial</label>
												<input class="form-control form-control-solid form-control-lg" name="middlename" type="text"  />
												</div>
											</div>
											<div class="form-group row">
												<div class="col-lg-6">
												<label>Voucher Access</label>
													<select class="form-control form-control-solid form-control-lg" name="voucher">
														<option value="1">INACTIVE</option>
														<option value="2">ACTIVE</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-lg-12">
												    <label>ROLE:</label>
												     <div class="checkbox-inline">
												        <label class="checkbox">
												            <input type="checkbox"  id="designer" value="1" />
												            <span></span>
												            Designer
												        </label>
												        <label class="checkbox">
												            <input type="checkbox"  id="production" value="1"/>
												            <span></span>
												            Production
												        </label>
												        <label class="checkbox">
												            <input type="checkbox"  id="supervisor" value="1"/>
												            <span></span>
												            Supervisor
												        </label>
												        <label class="checkbox">
												            <input type="checkbox" id="accounting" value="1"/>
												            <span></span>
												            Accounting
												        </label>
												        <label class="checkbox">
												            <input type="checkbox" id="sales" value="1"/>
												            <span></span>
												            Sales
												        </label>
												        <label class="checkbox">
												            <input type="checkbox" id="webmodifier" value="1"/>
												            <span></span>
												            Web Modifier
												        </label>
												        <label class="checkbox">
												            <input type="checkbox" id="superuser" value="1"/>
												            <span></span>
												            Superuser
												        </label>
												        <label class="checkbox">
												            <input type="checkbox" id="admin" value="1"/>
												            <span></span>
												            Admin
												        </label>
												    </div>
											   </div>
											</div>
										</div>
									</div>
										<div class="row justify-content-center">
											<div class="col-xl-12 col-xxl-7">
												<div class="card-footer">
													<button type="submit" class="btn btn-primary mr-2">Submit</button>
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