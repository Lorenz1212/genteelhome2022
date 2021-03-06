<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-user-create">
	<div class="subheader py-2 py-lg-12 subheader-transparent form" id="kt_subheader" data-link="Create_Users">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5"></span>User's Account</h2>
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
							<div class="card-toolbar">
								<button type="button" class="btn btn-primary mr-2 add_saves">Submit</button>
							</div>
						</div>
							<form id="Create_Users"  enctype="multipart/form-data" accept-charset="utf-8">
								<div class="card-body">
									<div class="row justify-content-center">
										<div class="col-xl-6 col-xxl-8">
											<!--begin::Group-->
										<!-- <div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label text-left">Avatar</label>
											<div class="col-lg-9 col-xl-9">
												<div class="image-input image-input-outline" id="avatar">
													<div class="image-input-wrapper" style="background-image: url(<?php echo base_url() ?>assets/images/avatar/default.jpg)"></div>
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
										</div> -->
										<div class=" form-group">
										    <label class="form-control-label">User Name</label>
										    <input type="text" class="form-control" name="username" placeholder="Enter Username"/>
										    <span id="alert"></span>
										</div>
											<div class="form-group row"> 
													<div class="col-lg-6">
														    <label>Password</label>
														    <input class="form-control" name="password" type="password" />
													</div>
													<div class="col-lg-6">
														    <label>Confirmation Password</label>
														   <input class="form-control" placeholder="Verify password" name="v_password" type="password"  />
													</div>
											</div>
											<div class="form-group">
												<label>Email Address</label>
												<input class="form-control" name="email" type="text" />
											</div>
											<div class="form-group">
												<label>First Name</label>
												<input class="form-control" name="fname" type="text" />
											</div>
											<div class="form-group">
												<label>Last Name</label>
												<input class="form-control" name="lname" type="text" />
											</div>
											<div class="form-group">
												<label>Middle Name/Initial</label>
												<input class="form-control" name="mname" type="text"  />
											</div>
											<div class="form-group">
											    <label>ROLE : </label>
											    <div class="checkbox-inline">
											        <label class="checkbox">
											            <input type="checkbox"  name="role[]" value="1" />
											            <span></span>
											            Designer
											        </label>
											        <label class="checkbox">
											            <input type="checkbox"  name="role[]" value="2"/>
											            <span></span>
											            Production
											        </label>
											        <label class="checkbox">
											            <input type="checkbox"  name="role[]" value="3"/>
											            <span></span>
											            Supervisor
											        </label>
											         <label class="checkbox">
											            <input type="checkbox" name="role[]" value="4"/>
											            <span></span>
											            Sales
											        </label>
											    </div>
											</div>
											<div class="form-group">
											    <div class="checkbox-inline">
											       	<label class="checkbox">
											            <input type="checkbox" name="role[]" value="5"/>
											            <span></span>
											            Inventory
											        </label>
											       <label class="checkbox">
											            <input type="checkbox" name="role[]" value="6"/>
											            <span></span>
											            Accounting
											        </label>
											       <label class="checkbox">
											            <input type="checkbox" name="role[]" value="7"/>
											            <span></span>
											            Web Modifier
											        </label>
											        <label class="checkbox">
											            <input type="checkbox" name="role[]" value="8"/>
											            <span></span>
											            Administrator
											        </label>
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