<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-joborder-project-list">
	<div class="form" data-link="Create_Joborder_Inpection_Project_Image"></div>
		<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
			<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
				<div class="d-flex align-items-center flex-wrap mr-1">
					<div class="d-flex flex-column">
						<h2 class="text-white font-weight-bold my-2 mr-5">Job Order For Project</h2>
					</div>
				</div>
				<div class="d-flex align-items-center">
					<button class="btn btn-light-success font-weight-bolder btn-sm" data-toggle="modal" id="form-add" data-target="#requestAddModal"><i class="flaticon-add-circular-button"></i> Create Job Order</button>
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
			                    <a class="nav-link active" data-toggle="tab" href="#pending">
			                        <span class="nav-text">List</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#complete">
			                        <span class="nav-text">Completed</span>
			                    </a>
			                </li>
			                 <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#cancelled">
			                        <span class="nav-text">Cancelled</span>
			                    </a>
			                </li>
			                 <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#request">
			                        <span class="nav-text">Request</span>
			                    </a>
			                </li>
			            </ul>
			        </div>
			    </div>
			    <div class="card-body">
			        <div class="tab-content">
			            <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
			               	<table class="table table-bordered table-hover table-checkable link" id="tbl_joborder_production" data-link="tbl_joborder_project" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>TITLE</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_joborder_pending" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>TITLE</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			               <table class="table table-bordered table-hover table-checkable" id="tbl_joborder_complete" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>TITLE</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			               <table class="table table-bordered table-hover table-checkable" id="tbl_joborder_cancelled" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>TITLE</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
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
<!-- Modal-->
<div class="modal fade" id="requestModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title" id="joborder"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            
            </div>
            <div class="modal-body">
						<div class="card-body">
								<ul class="dashboard-tabs nav nav-pills nav-dark row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
										<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
											<a class="nav-link active border py-10 d-flex flex-grow-1 rounded flex-column align-items-center btn-active" data-toggle="pill" href="#details">
												<span class="nav-icon py-2 w-auto">
													<span class="svg-icon svg-icon-3x">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														        <rect x="0" y="0" width="24" height="24"/>
														        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
														        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
														        <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
														        <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
														    </g>
														</svg>
													</span>
												</span>
												<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Detials</span>
											</a>
										</li>
										<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
											<a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center btn-active" data-action="material_request" data-toggle="pill" href="#material">
												<span class="nav-icon py-2 w-auto">
													<span class="svg-icon svg-icon-3x">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														        <rect x="0" y="0" width="24" height="24"/>
														        <path d="M5.94290508,4 L18.0570949,4 C18.5865712,4 19.0242774,4.41271535 19.0553693,4.94127798 L19.8754445,18.882556 C19.940307,19.9852194 19.0990032,20.9316862 17.9963398,20.9965487 C17.957234,20.9988491 17.9180691,21 17.8788957,21 L6.12110428,21 C5.01653478,21 4.12110428,20.1045695 4.12110428,19 C4.12110428,18.9608266 4.12225519,18.9216617 4.12455553,18.882556 L4.94463071,4.94127798 C4.97572263,4.41271535 5.41342877,4 5.94290508,4 Z" fill="#000000" opacity="0.3"/>
														        <path d="M7,7 L9,7 C9,8.65685425 10.3431458,10 12,10 C13.6568542,10 15,8.65685425 15,7 L17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 Z" fill="#000000"/>
														    </g>
														</svg>
													</span>
												</span>
												<span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Material Request</span>
											</a>
										</li>
										<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
											<a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center btn-active" data-toggle="pill" data-action="purchase_request" href="#purchase">
												<span class="nav-icon py-2 w-auto">
													<span class="svg-icon svg-icon-2x">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														        <rect x="0" y="0" width="24" height="24"/>
														        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"/>
														        <path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000"/>
														    </g>
														</svg>
													</span>
												</span>
												<span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Purchase Request</span>
											</a>
										</li>
									</ul>
							<div class="tab-content m-0 p-10">
								<div class="tab-pane active" id="details" role="tabpanel" style="height:400px">
										<div class="row justify-content-center">
											<div class="col-xl-9 col-xxl-9 col-md-9">
												<div class="row">
													<div class="col-lg-6 col-xl-6 col-md-6">
														<div class="form-group">
															<label>Image</label>
															<div class="col-lg-3 col-xl-3">
																<div class="image-input image-input-outline" id="design_image">
																	<a id="image_href" target="_blank">
																	  <img class="image-input-wrapper" id="image" style="width: 250px;height: 250px;object-fit: cover;" />
																    </a>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6 col-xl-6">
														<div class="form-group">
													    <label>Specification</label>
															 <div class="input-group">
															    	 <div class="input-group-append">
															      <a id="docs_href" target="_blank" data-toggle="tooltip" data-theme="dark" title="View Tearsheet" class="btn  btn-light-dark btn-icon"><i class="flaticon-eye"></i></a>
															     </div>
															     <input type="text" class="form-control form-control-solid" id="docs" placeholder="Click Here...." style="cursor:pointer;" disabled/>
														    </div>
												  		</div>
												  		<div class="form-group">
														   <label>Project Name</label>
														   <input class="form-control form-control-solid" id="title" disabled />
												  	 </div>
												  	 <div class="form-group">
														  <button class="btn btn-dark btn-lg btn-inspection" data-toggle="pill" href="#inspections">Click This Button For Inspection <i class="flaticon2-fast-next blink_me"></i></button>
												  	 </div>
												  	 <div class="form-group">
														 <div class="input-group">
														 	<select class="form-control form-control-solid" name="status"/>
														 		<option value="1">COMPLETE</option>
														 		<option value="2">CANCEL</option>
														 	</select>
														 	<div class="input-group-append">
														      	 <button class="btn btn-dark btn-save-qty">Save</button>
													        </div>
														 </div>
												  	 </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="material" role="tabpanel" style="height:400px">
									<div class="card card-custom">
										 <div class="card-header bg-dark">
										  	 <div class="card-title">
									            <h3 class="text-white">Material List</h3>
									         </div>
										 </div>
										 <div class="card-body">
										 	 <div data-scroll="true" data-height="300">
												    <table class="table table-sm" id="tbl_material">
														<thead>
															<tr>
																<th>ITEM</th>
																<th>QTY</th>
																<th>REMARKS</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
										        </div>
										 </div>
									</div>
								</div>
								<div class="tab-pane" id="purchase" role="tabpanel" style="height:400px">
										<div class="card card-custom">
										<div class="card-header bg-dark">
										  	 <div class="card-title">
									            <h3 class="text-white">Purchase List</h3>
									         </div>
										 </div>
										 <div class="card-body">
										 	 <div data-scroll="true" data-height="300">
												    <table class="table table-sm" id="tbl_puchased">
														<thead>
															<tr>
																<th>ITEM</th>
																<th>QTY</th>
																<th>REMARKS</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
										        </div>
										 </div>
									</div>
								</div>
								<div class="tab-pane" id="inspections" role="tabpanel" style="height:400px">
										<div class="card card-custom">
										 <div class="card-header bg-dark">
										  	<div class="card-title">
									          <h3 class="text-white">Inspection</h3>
									        </div>
									        <div class="card-toolbar">
									        	<button class="btn btn-transparent-white font-weight-bold mr-2 btn-status d-none" data-action="requestInspection"><i class="flaticon2-fast-back"></i> Back</button>
									            <button class="btn btn-transparent-white font-weight-bold mr-2 btn-status" data-action="approvedInspection"><i class="far fa-thumbs-up"></i> Approved</button>
									            <button class="btn btn-transparent-white font-weight-bold mr-2 btn-status" data-action="rejectedInspection"><i class="far fa-thumbs-down"></i> Rejected</button>
									        </div>
										 </div>
										 <div class="card-body">
										 	 <div class="row">
											  	<div class="col-lg-4 col-xl-4">
													  <div class="form-group">
													    <label>Upload Photo of Inspection</label>
														    <div class="input-group">
														     <input type="text" class="form-control form-control-solid upfile1" id="customFile" placeholder="Click Here...." style="cursor:pointesr;" readonly=""/>
														     <input type="file" value="" accept=".png, .jpg, .jpeg" onchange="document.getElementById('customFile').value = window.URL.createObjectURL(this.files[0])" id="imagess" name="image" style="display:none"/>
														      <div class="input-group-append">
														      <button class="btn btn-secondary save" type="button" id="save_image">SAVE</button>
														     </div>
													    </div>
												   </div>
											 </div>
										</div>
											<div class="row d-none" id="requestInspection">
											</div>
											<div class="row d-none" id="approvedInspection">
											</div>
											<div class="row d-none" id="rejectedInspection">
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
<div class="modal fade" id="requestAddModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title">Add Job Order For Stocks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            
            </div>
            <div class="modal-body">
				<div class="row">
				 	  <div class="col-lg-12 col-xl-12 col-md-12">
					    <div class="form-group">
						   <label>ITEM</label>
						   <div class="input-group">
							   <select class="form-control form-control-solid form-control-lg selectpicker" data-live-search="true" id="project_no" name="project_no" required />
							     <option value="" disabled="" selected="">Select Item</option>
							       <?php 
									  $query = $this->db->select('*')->from('tbl_project_design')->where('type',1)->where('project_status','APPROVED')->get();
									  foreach($query->result() as $row){
									  	 echo '<option value="'.$this->encryption->encrypt($row->id).'">'.$row->title.'</option>';
									  }
									?>
							  </select>
							   <div class="input-group-append" style="padding-left: 10px;">
							   		<a class="btn btn-light-dark font-weight-bold btn-sm btn-shadow btn-square" id="docs_href" data-toggle="tooltip" data-theme="dark" title="View Specification"><i class="flaticon2-paper"></i></a>
							   </div>
							</div>
						</div>
					</div>	
					<div class="col-lg-12 col-xl-12 col-md-12">
						 <div class="form-group">
							   <label>PALLETE COLOR</label>
							    <div class="input-group">
							     <select type="text" class="form-control form-control-solid form-control-lg" id="c_code" name="c_code" required >
							     	<option value="" disabled="" selected>Select Pallet Color</option>
							     </select>
							     <div class="input-group-append" style="padding-left: 10px;">
								      <img class="images mx-auto d-block img-thumbnail z-depth-3 upfile1" id="color" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg" style="width:50;height:43px;"/>
							       </div>
							    </div>
						  </div>
					</div>
					<div class="col-lg-12 col-xl-12 col-md-12">
						 <div class="form-group">
						   <label>QTY</label>
						   <input type="number" class="form-control form-control-solid form-control-lg" name="unit" placeholder="Enter Quantity" autocomplete="off" required/>
					    </div>
					</div>
		        </div>
		    </div>
		    <div class="modal-footer"><button class="btn btn-dark">Submit <i class="flaticon2-paper-plane"></i></button></div>
		</div>
	</div>
</div>		