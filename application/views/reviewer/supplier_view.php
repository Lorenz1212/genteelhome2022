
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-supplier">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="form" data-link="Update_SupplierItem"></div>
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Supplier</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100 i-title">Information</span>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->	
<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Profile 4-->
			<div class="d-flex flex-row">
				<!--begin::Aside-->
				<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
					<!--begin::Card-->
					<div class="card card-custom gutter-b">
						<!--begin::Body-->
						<div class="card-body pt-4">
							<!--begin::User-->
							<div class="d-flex align-items-center">
								<div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
									<div class="symbol-label" style="background-image:url('assets/media/users/300_13.jpg')"></div>
									<i class="symbol-badge bg-success"></i>
								</div>
								<div>
									<span id="supplier_name" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"></span>
									<div class="text-muted"><span id="status"></span></div>
								<!-- 	<div class="mt-2">
										<a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Chat</a>
										<a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Follow</a>
									</div> -->
								</div>
							</div>
							<!--end::User-->
							<!--begin::Contact-->
							<div class="pt-8 pb-6">
								<div class="d-flex align-items-center justify-content-between mb-2">
									<span class="font-weight-bold mr-2">Email:</span>
									<span class="text-muted text-hover-primary" id="email"></span>
								</div>
								<div class="d-flex align-items-center justify-content-between mb-2">
									<span class="font-weight-bold mr-2">Phone:</span>
									<span class="text-muted" id="mobile"></span>
								</div>
								<div class="d-flex align-items-center justify-content-between mb-2">
									<span class="font-weight-bold mr-2">Facebook:</span>
									<span class="text-muted" id="facebook"></span>
								</div>
								<div class="d-flex align-items-center justify-content-between mb-2">
									<span class="font-weight-bold mr-2">Website:</span>
									<span class="text-muted" id="website"></span>
								</div>
								<div class="d-flex align-items-center justify-content-between mb-2">
									<span class="font-weight-bold mr-2">Location:</span>
									<span class="text-muted" id="address"></span>
								</div>
							</div>
							<!--end::Contact-->
							<button class="btn btn-light-success font-weight-bold py-3 px-6 mb-2 text-center btn-block" data-toggle="modal" data-target="#modal-form">Edit Profile</button>
						</div>
						<!--end::Body-->
					</div>
					<!--end::Card-->
				</div>
				<!--end::Aside-->
				<!--begin::Content-->
				<div class="flex-row-fluid ml-lg-8">
					<!--begin::Row-->
					<div id="accordionExample7">
						<div class="card card-custom gutter-b">
							<div class="card-header"  id="headingOne7">
								<div class="card-title" data-toggle="collapse" data-target="#collapseOne7">
										<div class="card-toolbar">
											<button type="button" class="btn btn-light-primary font-weight-bolder" ><i class="la la-plus"></i>Add New Materials</button>
										</div>
									</div>
								</div>
								<div id="collapseOne7" class="collapse" data-parent="#accordionExample7">
									<div class="card-body">
										<div class="d-flex">
											<div class="flex-grow-1">
												<!--begin::Content-->
												<div class="d-flex justify-content-center">
													<div class="col-xl-12 col-xxl-9">
													<div>
														<div class="row">
														  <div class="col-lg-7">
															  <div class="form-group">
																   <label>ITEM</label>
																    <select class="form-control " data-size="7" data-live-search="true" id="item" name="item">
																    	<?php 
																    		$query=$this->db->select('*')->from('tbl_materials')->get()->result();
																    		foreach($query as $row){
																    			echo'<option value="'.$row->id.'">'.$row->item.'</option>';
																    		}
																    	?>
																	</select>
																   <span class="form-text text-muted">Please enter your item</span>
																  </div>
															</div>
															<div class="col-lg-4">
															  <div class="form-group">
																   <label>Amount</label>
																    <input type='text' class="form-control" id="price" name="price"/>
			     													<span class="form-text text-muted">Currency format</span>
															  </div>
															</div>
														</div>
															<div>
																<button type="button" id="Create_SupplierItem" class="btn btn-sm btn-success font-weight-bolder text-uppercase type">Save</button>
															</div>
													</div>
												  </div>
											  </div>
											<!--end::Content-->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
					<!--begin::Advance Table Widget 8-->
					<div class="card card-custom gutter-b">
						<!--begin::Header-->
						<div class="card-header border-0 py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label font-weight-bolder text-dark">List of Materials</span>
							</h3>
						</div>
						<div class="card-body pt-0 pb-3">
									<div class="table-responsive">
										<table class="table table-head-custom table-head-bg table-vertical-center table-borderless link" id="tbl_supplier_item" data-link="tbl_supplier_item">
											<thead>
												<tr class="bg-gray-100 text-left">
													<th style="min-width: 130px">ITEM</th>
													<th style="min-width: 120px">PRICE</th>
													<th style="min-width: 120px">STATUS</th>
													<th style="min-width: 120px">DATE</th>
													<th style="min-width: 110px">ACTION</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end::Container-->
	</div>
</div>
<!--end::Content-->
<!-- Modal-->
<div class="modal fade" id="modal-form" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SUPPLIER INFO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            			<form id="Update_Supplier">							
								<div class="row">
								  <div class="col-xl-9">
									  <div class="form-group">
									   <label>Supplier</label>
									   <input type="text" class="form-control form-control-solid" placeholder="Enter Name" name="name"/>
									   <span class="form-text text-muted">Please enter your supplier name</span>
									  </div>
									</div>
									<div class="col-xl-3">
									  <div class="form-group">
									   <label>Status</label>
									   <select type="text" class="form-control form-control-solid" name="s_status"/>
									   		<option value="1">ACTIVE</option>
						    				 <option value="2">INACTIVE</option>
										</select>
									   <span class="form-text text-muted">Please enter your supplier name</span>
									  </div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-5">
									  <div class="form-group">
									   <label>Mobile No.</label>
									   <input type="text" class="form-control form-control-solid" name="mobile" placeholder="+639" />
									   <span class="form-text text-muted">Please enter mobile no.</span>
									  </div>
									</div>
									<div class="col-xl-7">
									  <div class="form-group">
									   <label>Email.</label>
									   <input type="email" class="form-control form-control-solid" name="email" placeholder="sample@gmail.com" />
									   <span class="form-text text-muted">Please enter Email</span>
									  </div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-5">
									  <div class="form-group">
									   <label>Facebook</label>
									   <input type="text" class="form-control form-control-solid" name="facebook" placeholder="www.facebook.com/example" />
									   <span class="form-text text-muted">Please enter the link page on Facebook</span>
									  </div>
									</div>
									<div class="col-xl-7">
									  <div class="form-group">
									   <label>Website</label>
									   <input type="text" class="form-control form-control-solid" name="website" placeholder="www.example.com" />
									   <span class="form-text text-muted">Please enter Website</span>
									  </div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
									  <div class="form-group">
									   <label>Address</label>
									    <input type="text" class="form-control form-control-solid" name="address"/>
									    <span class="form-text text-muted">Please enter supplier address</span>
									  </div>
									</div>
								</div>
							</div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
				                <button type="submit" class="btn btn-primary font-weight-bold type">Save changes</button>
				            </div>
			        </div>
       		</form>
        </div>
    </div>

<div class="modal fade" id="modal-form-item" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ITEM INFO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form>
	            <div class="modal-body">
					 <div class="form-group">
						<label>ITEM</label>
						   <input type="hidden" name="ss_id">
						   <input type="text" class="form-control form-control-solid" placeholder="Enter Item" name="item" disabled="" />
					</div>
					<div class="form-group">
					   <label>Price</label>
					         <input type='text' class="form-control" id="price_s" name="price"/>
							<span class="form-text text-muted">Currency format</span>
				     </div>
					<div class="form-group">
					    <label>Status</label>
					    <select class="form-control form-control-solid" name="status">
						     <option value="1">ACTIVE</option>
						     <option value="2">INACTIVE</option>
					    </select>
				   </div>	
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
	                <button type="click" action="update" class="btn btn-primary font-weight-bold type">Save changes</button>
	            </div>
       		</form>
        </div>
	</div>
</div>
<script type="text/javascript">
	var supplier_id = '<?php echo $id?>';
</script>