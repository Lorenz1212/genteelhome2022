<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!-- <div class="form" data-link="Create_Project_Image"></div>	 -->
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Product Details</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<button type="button" class="btn btn-success btn-shadow font-weight-bold py-3 px-6 dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create Product</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			        <a class="dropdown-item " href="javascript:;" data-toggle="modal" data-target="#create-product-modal"><p><i class="flaticon2-plus"></i> Add New Product</p></a>
			        <a class="dropdown-item " href="javascript:;" data-toggle="modal" data-target="#create-existing-modal" data-action="Update"><p><i class="flaticon2-plus"></i> Add New Pallet</p></a>
			    </div>
			</div>
		</div>
	</div>
	<!--end::Subheader-->
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">
				<div class="card card-custom">
					<div class="card-header">
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover" id="tbl_products">
							<thead>
								<tr>
									<th>ID</th>
									<th>NO</th>
									<th>TITLE</th>
									<th>DATE CREATED</th>
									<th>STATUS</th>
									<th>ACTION</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
	<!--end::Content-->

<!-- Modal-->
<div class="modal fade" id="view-details-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title"><span id="project_no"></span><span id="c_code"></span></h5>
                <button type="button" class="close" data-dismiss="modal" id="close"  aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<!--begin::Nav Tabs-->
						<ul class="dashboard-tabs nav nav-pills nav-dark row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
								<!--begin::Item-->
								<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 w-75px h-100px mr-2">
									<a class="nav-link active border py-3 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#overview">
										<span class="nav-icon py-2 w-auto">
											<span class="svg-icon svg-icon-3x">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												        <rect x="0" y="0" width="24" height="24"/>
												        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
												        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
												        <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
												        <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
												    </g>
												</svg>
												<!--end::Svg Icon-->
											</span>
										</span>
										<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Overview</span>
									</a>
								</li>
								<!--end::Item-->
								<!--begin::Item-->
								<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 w-75px h-100px mr-2">
									<a class="nav-link border py-3 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#gallery">
										<span class="nav-icon py-2 w-auto">
											<span class="svg-icon svg-icon-3x">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <polygon points="0 0 24 0 24 24 0 24"/>
													        <rect fill="#000000" opacity="0.3" x="2" y="4" width="20" height="16" rx="2"/>
													        <polygon fill="#000000" opacity="0.3" points="4 20 10.5 11 17 20"/>
													        <polygon fill="#000000" points="11 20 15.5 14 20 20"/>
													        <circle fill="#000000" opacity="0.3" cx="18.5" cy="8.5" r="1.5"/>
													    </g>
													</svg>
												<!--end::Svg Icon-->
											</span>
										</span>
										<span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Gallery</span>
									</a>
								</li>
								<!--end::Item-->
							</ul>
							<!--end::Nav Tabs-->
							<div class="tab-content m-0 p-10" style="height:400px">
								<div class="tab-pane active" id="overview" role="tabpanel">
									<div class="row justify-content-center">
										<div class="col-xl-12 col-xxl-12 col-md-12">
								        	<div class="row">
												<div class="col-lg-4 col-xl-4 col-md-4">
													<div class="form-group">
														<label>Image</label>
														<div class="col-lg-3 col-xl-3">
															<div class="image-input image-input-outline" id="design_image">
																<a id="image_href" target="_blank">
																  <img class="image-input-wrapper" id="image" style="width: 200px;height: 200px;object-fit: cover;" />
															    </a>
															</div>
														</div>
													</div>
													<div class="form-group">
													    <label>Upload Tearsheet</label>
														    <div class="input-group">
														    	 <div class="input-group-append">
														      <a id="tearsheet_href" target="_blank" data-toggle="tooltip" data-theme="dark" title="View Tearsheet" class="btn  btn-light-dark btn-icon"><i class="flaticon-eye"></i></a>
														     </div>
														     <input type="text" class="form-control tearsheets" id="tearsheetss" placeholder="Click Here...." style="cursor:pointer;" onclick="$('#tearsheets').trigger('click')" readonly=""/>
														     <input type="file" value="" accept=".docx, .pdf, .word" onchange="document.getElementById('tearsheetss').value = this.files[0].name" id="tearsheets" name="tearsheet" style="display:none"/>
														      <div class="input-group-append">
														      	<button class="btn btn-secondary save_tearsheet" type="button">SAVE</button>
														     </div>
													    </div>
												   </div>
												</div>
												
												<div class="col-lg-7 col-xl-7">
													<div class="row">
														<div class="col-lg-12 col-xl-12 col-md-12">
															 <div class="form-group">
																   <label>ITEM</label>
																   <div class="input-group">
																 	  <input class="form-control" id="title" name="title"/>
																 	  <div class="input-group-append">
																      <button class="btn btn-secondary save" type="button" data-name="title" data-status="1">SAVE</button>
																    </div>
																   </div>
														  	 </div>
													  	</div>
												  	</div>
												  	<div class="row">
												  	 <div class="col-lg-12 col-xl-12 col-md-12">
												  	 	<div class="form-group">
														   <label>PALLETE COLOR</label>
														   <div class="input-group">
														   		 <input type="text" class="form-control" id="c_name" name="c_name"/>
												   			 <div class="input-group-append">
														      <button class="btn btn-sm btn-secondary save" type="button" data-name="c_name" data-status="2">SAVE</button>
														    </div>
														    <div class="input-group-append pl-3">
														      <button type="button" data-toggle="tooltip" data-theme="dark" title="FILE SIZE (250 x 250)" class="btn btn-light-dark" onclick="$('#imagefile4').trigger('click')"><i class="flaticon-upload"></i></button>
														      <input type="file" value="" accept=".png, .jpg, .jpeg" id="imagefile4" class="color_update" name="color_update"  onchange="document.getElementById('changeimage4').src = window.URL.createObjectURL(this.files[0])" style="display:none"/>
													      </div>
													       <div class="input-group-append" style="padding-left: 10px;">
													       		<a id="cimage_href" target="_blank">
														      			<img class="images mx-auto d-block img-thumbnail z-depth-3 c_image" id="changeimage4" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg " style="width:50;height:45px;"/>
														  		</a>
													       </div>

														</div>
													</div>
											  	 </div>
											  	 <div class="col-lg-6 col-xl-6 col-md-6">
												  	  <div class="form-group">
													    <label>Price</label>
														    <div class="input-group">
														     <input class="form-control amount" name="c_price" id="c_price" autocomplete="off" />
														   <div class="input-group-append">
														      <button class="btn btn-secondary save" type="button" data-name="c_price" data-status="2">SAVE</button>
														     </div>
													    </div>
												   </div>
											</div>
											<div class="col-lg-6 col-xl-6 col-md-6">
										  	  <div class="form-group">
											    <label>Status</label>
												    <div class="input-group">
												     <select class="form-control" id="displayed_status" name="display_status">
												   		<option value="" selected="" disabled="">SELECT STATUS</option>
												   		<option value="displayed">Active</option>
												   		<option value="n/a">Inactive</option>
												   </select>
												   <div class="input-group-append">
												      <button class="btn btn-secondary save_status" type="button" data-name="display_status">SAVE</button>
												     </div>
											    </div>
										   </div>
									  	</div>
										  	<div class="col-lg-12 col-xl-12 col-md-12">
											  	  <div class="form-group">
												    <label>Categories</label>
													    <div class="input-group">
													     <select class="form-control cat_id_update" id="cat-id-edit" name="cat_id_update">
													   	 	<option value="" selected="" disabled="">SELECT CATEGORY</option>
															   	<?php 
														   			$query = $this->db->select('*')->from('tbl_category')->where('status','ACTIVE')->get();
															   			foreach($query->result() as $row){
															   				echo'<option value="'.$row->id.'">'.$row->cat_name.'</option>';
															   			}
															   	?>
													   </select>
													   <div class="input-group-append">
													      <button class="btn btn-secondary"><i class="flaticon-more-v2"></i></button>
													     </div>
													    <select class="form-control sub_category_update sub_category" id="sub-id-edit" name="sub_id_update">
													   	</select>
													    <div class="input-group-append">
													      <button class="btn btn-secondary save_category" type="button">SAVE</button>
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
						<div class="tab-pane" id="gallery" role="tabpanel" style="height:400px">
						  		<div class="row">
									  	<div class="col-lg-6 col-xl-6">
											  <div class="form-group">
											    <label>Upload Photo</label>
												    <div class="input-group">
												     <input type="text" class="form-control" id="customFile" placeholder="Click Here...." style="cursor:pointesr;" readonly="" onclick="$('#imagess').trigger('click')"/>
												     <input type="file" value="" accept=".png, .jpg, .jpeg" onchange="document.getElementById('customFile').value = this.files[0].name" id="imagess" name="gallery" style="display:none"/>
												      <div class="input-group-append">
												      <button class="btn btn-secondary save_image" type="button" id="save_image">SAVE</button>
												     </div>
											    </div>
										   </div>
									 </div>
								</div>
								<div data-scroll="true" data-height="250">
									<div class="row" id="divimages"></div>
								</div>
							</div>
					 </div>
		        </div>
		         <div class="modal-footer">
							<button  class="btn btn-success" data-dismiss="modal" id="close"  aria-label="Close">Close</button>
			           </div>
		    </div>
		</div>
	</div>
<div class="modal fade" id="create-product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title"> Create New Product</h5>
                <button type="button" class="close" id="close-add" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form class="form" id="create-product-form" enctype="multipart/form-data" accept-charset="utf-8">
            	<div class="row justify-content-center">
					<div class="col-xl-12 col-xxl-12 col-md-12">
			        	<div class="row">
							<div class="col-lg-4 col-xl-4">
								<div class="form-group image-update">
										<label class="col-xl-12 col-lg-12 col-md-12 col-form-label text-left">Image (Minimum 360x360)</label>
										<div>
											<div class="image-input image-input-outline" id="kt_image_5" style="width: 200px;height: 200px; box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);">
												 <div class="image-input-wrapper image-add" style="background-image: url(<?php echo base_url();?>assets/images/design/project_request/images/default.jpg);width: 200px;height: 200px;object-fit: cover;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast;"></div>
												 <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
												  <i class="fa fa-pen icon-sm text-muted"></i>
												  <input type="file" id="profile_avatar" name="image" accept=".png, .jpg, .jpeg"/>
												  <input type="hidden" name="image_remove"/>
												 </label>
												 <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow btn-close-image" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
												  <i class="ki ki-bold-close icon-xs text-muted"></i>
												 </span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="custom-file">
											 <button type="button" data-toggle="tooltip" data-theme="dark" title="PDF OR DOCS" class="btn btn-lg btn-light-dark tearsheet-btn" onclick="$('.docs-btn').trigger('click')"><i class="flaticon-upload"></i> TEARSHEET</button>
										  	<input type="file" class="docs-btn" name="docs" accept=".doc, .pdf" style="display:none;"/>
										  	<span class="form-text docs-text"></span>
										</div>
								   </div>
							</div>
							<div class="col-lg-8 col-xl-8 col-md-8">
								<div class="row">
									<div class="col-lg-12 col-xl-12 col-md-12">
										<div class="form-group">
											   <label>Product Name</label>
											   <input class="form-control form-control-solid" name="title" placeholder="Enter Product Name" required />
									  	 </div>
									</div>
									 <div class="col-lg-12 col-xl-12">
											 <div class="form-group">
												   <label>Pallet Color</label>
												    <div class="input-group">
												     <input type="text" class="form-control form-control-solid form-control-lg" name="pallet_name" placeholder="Enter pallete name...." required=""  autocomplete="off"/>
												     <div class="input-group-append" style="padding-left: 10px;">
													      <button type="button" data-toggle="tooltip" data-theme="dark" title="FILE SIZE (250 x 250)" class="btn btn-sm btn-light-dark upfile2" onclick="$('#imagefiless').trigger('click')"><i class="flaticon-upload"></i></button>
													      <input type="file" value="" accept=".png, .jpg, .jpeg" id="imagefiless" name="color" onchange="document.getElementById('changeimage').src = window.URL.createObjectURL(this.files[0])" style="display:none"/>
												      </div>
												       <div class="input-group-append" style="padding-left: 10px;">
													      <img class="images mx-auto d-block img-thumbnail z-depth-3 image" id="changeimage" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg" style="width:50;height:45px;cursor:pointer;"/>
												      </div>
												    </div>
											  </div>
								 		 </div>
								 		 <div class="col-lg-12 col-xl-12 col-md-12">
								 		 	<div class="form-group">
												   <label>Amount of Product</label>
												   <input class="form-control form-control-solid amount" name="amount" placeholder="Enter Amount" required/>
											 </div>
											<div class="form-group">
												   <label>Category</label>
												   <select class="form-control form-control-solid category" name="cat_id" required>
												   	<option value="" selected disabled>SELECT CATEGORY</option>
												   		<?php 
												   			$query = $this->db->select('*')->from('tbl_category')->where('status','ACTIVE')->get();
												   			foreach($query->result() as $row){
												   				echo'<option value="'.$row->id.'">'.$row->cat_name.'</option>';
												   			}
												   		?>
												   </select> 
											 </div>
										</div>
										<div class="col-lg-12 col-xl-12 col-md-12">
											<div class="form-group">
												   <label>Sub Category</label>
												  <select class="form-control form-control-solid sub_category" name="sub_id"></select> 
											 </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-primary font-weight-bold mr-2" id="close-add" data-dismiss="modal" aria-label="Close"><i aria-hidden="true" class="ki ki-close icon-nm"></i> Close</button>
					<button type="button" class="btn btn-dark btn-create-product"><i class="flaticon2-pen"></i> Save</button>
	            </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create-existing-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title">Create New Pallet</h5>
                <button type="button" class="close" id="close-color" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form class="form" id="create-existing-form" enctype="multipart/form-data" accept-charset="utf-8">
	            	<div class="row justify-content-center">
						<div class="col-xl-12 col-xxl-12 col-md-12">
				        	<div class="row">
						  	<div class="col-lg-12 col-xl-12 col-md-12">
						  	  <div class="row">
							 	  <div class="col-lg-12 col-xl-12">
							 	  	 <div class="form-group">
										   <label>Product Name</label>
										   <select class="form-control selectpicker" data-live-search="true" name="title">
										   		<option value="" disabled="" selected="">SELECT ITEM</option>
										   		<?php 
												  $query = $this->db->select('*')->from('tbl_project_design')->where('type',1)->where('project_status','APPROVED')->get();
												  foreach($query->result() as $row){
												  	 echo '<option value="'.$this->encryption->encrypt($row->id).'">'.$row->title.'</option>';
												  }
												?>
										   </select>
								  	 </div>
									 <div class="form-group">
										   <label>PALLETE COLOR</label>
										    <div class="input-group">
										     <input type="text" class="form-control form-control-solid form-control-lg" name="pallet_name" placeholder="Enter pallete name...." required=""  autocomplete="off"/>
										     <div class="input-group-append" style="padding-left: 10px;">
											      <button type="button" data-toggle="tooltip" data-theme="dark" title="FILE SIZE (250 x 250)" class="btn btn-sm btn-light-dark " onclick="$('#imagefilebtn').trigger('click')"><i class="flaticon-upload"></i></button>
											      <input type="file" value="" accept=".png, .jpg, .jpeg" id="imagefilebtn" name="color" onchange="document.getElementById('changeimage1').src = window.URL.createObjectURL(this.files[0])" style="display:none"/>
										      </div>
										       <div class="input-group-append" style="padding-left: 10px;">
											      <img class="images mx-auto d-block img-thumbnail z-depth-3 image" id="changeimage1" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg" style="width:50;height:45px;cursor:pointer;"/>
										      </div>
										    </div>
									  </div>
								 </div>
								 <div class="col-lg-12 col-xl-12 col-md-12">
									<div class="form-group">
										   <label>Product Amount</label>
										   <input class="form-control form-control-solid amount" name="amount" placeholder="Enter Amount" required/>
									 </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
				<div class="modal-footer">
					<button type="button"  class="btn btn-light-primary font-weight-bold mr-2" id="close-color" data-dismiss="modal" aria-label="Close"><i aria-hidden="true" class="ki ki-close icon-nm"></i> Close</button>
					<button  class="btn btn-dark btn-create-existing"><i class="flaticon2-pen"></i> Save</button>
	            </div>
	        </div>
	    </div>
	</div>
</div>
