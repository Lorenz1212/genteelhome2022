<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-company-profile">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Company Info</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Set Up</a>
					</div>
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
				                    <a class="nav-link active" data-toggle="tab" href="#company">
				                        <span class="nav-icon"><i class="flaticon2-menu-4"></i></span>
				                        <span class="nav-text">Company Info</span>
				                    </a>
				                </li>
				                <li class="nav-item">
				                    <a class="nav-link" data-toggle="tab" href="#mission">
				                        <span class="nav-icon"><i class="flaticon2-calendar-3"></i></span>
				                        <span class="nav-text">About Company</span>
				                    </a>
				                </li>
				                <li class="nav-item">
				                    <a class="nav-link" data-toggle="tab" href="#testimony">
				                        <span class="nav-icon"><i class="flaticon-folder-1"></i></span>
				                        <span class="nav-text">Policy</span>
				                    </a>
				                </li>
				            </ul>
				        </div>
				    </div>
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="company" role="tabpanel" aria-labelledby="company">
								 <form class="form" data-link="Create_Company_Profile" enctype="multipart/form-data" accept-charset="utf-8">
					            	<div class="row justify-content-center">
										<div class="col-xl-6 col-xxl-6">
								        	<div class="row">
												<div class="col-lg-3 col-xl-3">
													<div class="form-group">
														<label>Logo</label>
														<div class="col-lg-3 col-xl-3">
															<div class="image-input image-input-outline">
																  <img class="image-input-wrapper images myImg" id="blank"/>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
													<div class="col-lg-6 col-xl-6">
													  <div class="form-group">
													    <label>Upload Photo</label>
														    <div class="input-group">
														     <input type="text" class="form-control form-control-solid upfile1" id="customFile" style="cursor:pointer;" readonly="" />
														     <input type="file" value="" accept=".png, .jpg, .jpeg" onchange="document.getElementById('customFile').value = window.URL.createObjectURL(this.files[0]);document.getElementById('blank').src = window.URL.createObjectURL(this.files[0])" id="imagefile" name="image" style="display:none"/>
														      <div class="input-group-append">
														      <button class="btn btn-secondary save_image" type="button">SAVE</button>
														     </div>
													    </div>
												   </div>
											  	</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-xl-12">
													<div class="form-group">
													    <label>Company Name</label>
														    <div class="input-group">
														     <input class="form-control company" name="company" id="company"/>
														   <div class="input-group-append">
														      <button class="btn btn-secondary save" type="button" id="save_company">SAVE</button>
														     </div>
													    </div>
												   </div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-xl-12">
													<div class="form-group">
													    <label>Address</label>
														    <div class="input-group">
														     <input class="form-control" name="address" id="address"/>
														   <div class="input-group-append">
														      <button class="btn btn-secondary save" type="button" id="save_address">SAVE</button>
														     </div>
													    </div>
												   </div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6 col-xl-6">
													<div class="form-group">
													    <label>Mobile No.</label>
														    <div class="input-group">
														     <input class="form-control" name="mobile" id="mobile" placeholder="+639...."/>
														   <div class="input-group-append">
														      <button class="btn btn-secondary save" type="button" id="save_mobile">SAVE</button>
														     </div>
													    </div>
												   </div>
												</div>
												<div class="col-lg-6 col-xl-6">
													<div class="form-group">
													    <label>Email Address</label>
														    <div class="input-group">
														     <input class="form-control" name="email" id="email" placeholder="Email Address..."/>
														   <div class="input-group-append">
														      <button class="btn btn-secondary save" type="button" id="save_email">SAVE</button>
														     </div>
													    </div>
												   </div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-xl-12">
													<div class="form-group">
													    <label>Store Open</label>
														    <div class="input-group">
														     <input class="form-control" name="store_open" id="store_open"/>
														   <div class="input-group-append">
														      <button class="btn btn-secondary save" type="button" id="save_open">SAVE</button>
														     </div>
													    </div>
												   </div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-xl-12">
													<div class="form-group">
													    <label>Facebook</label>
														    <div class="input-group">
														     <input class="form-control" name="facebook" id="facebook" placeholder="Link........" />
														   <div class="input-group-append">
														      <button class="btn btn-secondary save" type="button" id="save_facebook">SAVE</button>
														     </div>
													    </div>
												   </div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-xl-12">
													<div class="form-group">
													    <label>Instagram</label>
														    <div class="input-group">
														     <input class="form-control" name="instagram" id="instagram" placeholder="Link........" />
														   <div class="input-group-append">
														      <button class="btn btn-secondary save" type="button" id="save_instagram">SAVE</button>
														     </div>
													    </div>
												   </div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-xl-12">
													<div class="form-group">
													    <label>Twitter</label>
														    <div class="input-group">
														     <input class="form-control" name="tweeter" id="tweeter" placeholder="Link........" />
														   <div class="input-group-append">
														      <button class="btn btn-secondary save" type="button" id="save_tweeter">SAVE</button>
														     </div>
													    </div>
												   </div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-xl-12">
													<div class="form-group">
													    <label>Youtube</label>
														    <div class="input-group">
														     <input class="form-control" name="youtube" id="youtube" placeholder="Link........" />
														   <div class="input-group-append">
														      <button class="btn btn-secondary save" type="button" id="save_youtube">SAVE</button>
														     </div>
													    </div>
												   </div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>

							<!--Tab 2-->
							<div class="tab-pane fade" id="mission" role="tabpanel" aria-labelledby="mission">
								<div class="row justify-content-center">
										<div class="col-xl-7 col-xxl-7">
								        	<div class="row">
												<div class="col-lg-3 col-xl-3">
													<div class="form-group">
														<label>Image</label>
														<div class="col-lg-3 col-xl-3">
															<div class="image-input image-input-outline">
																  <img class="image-input-wrapper owner_image myImgs" id="blanks"/>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6 col-xl-6">
												  <div class="form-group">
												    <label>Upload Photo of Owner</label>
													    <div class="input-group">
													     <input type="text" class="form-control form-control-solid upfile2" id="customFiles" style="cursor:pointer;" readonly="" />
													     <input type="file" value="" accept=".png, .jpg, .jpeg" onchange="document.getElementById('customFiles').value = window.URL.createObjectURL(this.files[0]);document.getElementById('blanks').src = window.URL.createObjectURL(this.files[0])" id="imagefiles" name="owner_image" style="display:none"/>
													      <div class="input-group-append">
													      <button class="btn btn-secondary save_imageowner" type="button">SAVE</button>
													     </div>
												    </div>
											   </div>
											   <div class="form-group">
												    <label>Owner Name</label>
													    <div class="input-group">
													     <input type="text" class="form-control form-control-solid" id="owner_name" name="owner_name"/>
													      <div class="input-group-append">
													      <button class="btn btn-secondary saves" type="button" id="save_ownername">SAVE</button>
													     </div>
												    </div>
											   </div>
										  	</div>
										  	<div class="col-lg-12 col-xl-12">
												   <div class="form-group">
													    	<label>About the owner</label>
														     <button class="btn btn-secondary btn-sm saves" type="button" id="save_about">SAVE</button>
													    </div>
												   </div>
												 <div>
										  	</div>
										  	<div class="col-lg-12 col-xl-12">
										  		<div class="form-group">
										  				<div class="about" id="about"></div>
										  		</div>
										  	</div>
										  	<div class="col-lg-12 col-xl-12">
												   <div class="form-group">
													    	<label>About Company</label>
														     <button class="btn btn-secondary btn-sm saves" type="button" id="save_ourstory">SAVE</button>
													    </div>
												   </div>
												 <div>
										  	</div>
										  	<div class="col-lg-12 col-xl-12">
										  		<div class="form-group">
										  				<div class="ourstory" id="ourstory"></div>
										  		</div>
										  	</div>
										</div>
									</div>
				            </div>
				        </div>
				            <!--Tab 3-->
				            <div class="tab-pane fade" id="testimony" role="tabpanel" aria-labelledby="testimony">
				                <div class="row">
				                	<div class="col-lg-12 col-xl-12">
											   <div class="form-group">
												    	<label>Terms & Conditions</label>
													     <button class="btn btn-secondary btn-sm saves" type="button" id="save_terms">SAVE</button>
												    </div>
											   </div>
											 <div>
									  	</div>
									  	<div class="col-lg-12 col-xl-12">
									  		<div class="form-group">
									  				<div class="terms" id="terms"></div>
									  		</div>
									  	</div>
				                </div>
				                 <div class="row">
				                	<div class="col-lg-12 col-xl-12">
											   <div class="form-group">
												    	<label>Privacy Policy</label>
													     <button class="btn btn-secondary btn-sm saves" type="button" id="save_privacy">SAVE</button>
												    </div>
											   </div>
											 <div>
									  	</div>
									  	<div class="col-lg-12 col-xl-12">
									  		<div class="form-group">
									  				<div class="privacy" id="privacy"></div>
									  		</div>
									  	</div>
				                </div>
				                <div class="row">
				                	<div class="col-lg-12 col-xl-12">
											   <div class="form-group">
												    	<label>Returns & Exchanges Policy</label>
													     <button class="btn btn-secondary btn-sm saves" type="button" id="save_return">SAVE</button>
												    </div>
											   </div>
											 <div>
									  	</div>
									  	<div class="col-lg-12 col-xl-12">
									  		<div class="form-group">
									  				<div class="return" id="return"></div>
									  		</div>
									  	</div>
				                </div>
				                <div class="row">
				                	<div class="col-lg-12 col-xl-12">
											   <div class="form-group">
												    	<label>Shipping Policy</label>
													     <button class="btn btn-secondary btn-sm saves" type="button" id="save_shipping">SAVE</button>
												    </div>
											   </div>
											 <div>
									  	</div>
									  	<div class="col-lg-12 col-xl-12">
									  		<div class="form-group">
									  				<div class="shipping" id="shipping"></div>
									  		</div>
									  	</div>
				                </div>
				            </div>
				        </div>
					</div>
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
	<!--end::Content-->


