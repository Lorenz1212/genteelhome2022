<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content"  data-table="data-supplier">
	<div class="form" data-link="Update_Supplier">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Supplier List</h2>
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
				    	<div class="card-title"></div>
				    	<div class="card-toolbar">
				    		<button href="#" class="btn btn-light-success mr-2 add-supplier" data-toggle="modal" data-target="#add-supplier"><i class="flaticon2-plus"></i> New Supplier</button>
				    	</div>
				    </div>
				    <div class="card-body">
				        <div class="tab-content">
				            <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request">
				                <table class="table table-bordered table-hover table-checkable link" id="tbl_supplier" data-link="tbl_supplier" style="margin-top: 13px !important">
									<thead>
										<tr>
											<th>NAME</th>
											<th>ADDRESS</th>
											<th>CEL NO.</th>
											<th>STATUS</th>
											<th>DATE</th>
											<th>ACTIONS</th>
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
</div>
<div class="modal fade" id="modal-form" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
            	<div class="row">
						<div class="col-md-6">
							<!--begin::Card-->
								<div class="card card-custom gutter-b bg-dark">
									<!--begin::Body-->
									<div class="card-body pt-3">
										<!--begin::User-->
										<div class="d-flex align-items-center mt-5">
											<div class="symbol symbol-60 symbol-xl-120 mr-5 align-self-start align-self-xxl-center">
												<div class="symbol-label image-view"></div>
											</div>
											<div>
												<span class="font-weight-bold font-size-h5 text-white text-hover-primary name"></span>
												<div class="text-muted email"></div>
												<div class="text-muted mobile" ></div>
												<div class="text-white text-hover-primary address"></div>
												<div class="mt-2">
													<input type="file" name="image" style="display: none;" accept="image/png, image/jpeg">
													<button class="btn btn-sm btn-light-primary mr-2 btn-change-image" onclick="$('input[name=image]').trigger('click')">Choose image</button>
													<button href="javascript:;" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-2 edit-supplier"><i class="flaticon2-pen"></i> Edit Profile</button>
												</div>

											</div>

										</div>
										<!--end::User-->
									</div>
									<!--end::Body-->
								</div>
							</div>
							<div class="col-md-6" >
								<button type="button" class="close" style="float: right" class="close" data-dismiss="modal" aria-label="Close"><i aria-hidden="true" class="ki ki-close"></i></button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="height: 430px;">
									<table class="table table-hover" id="tbl_supplier_item">
						              			<thead>
												<tr class="table-primary">
													<th>MATERIALS</th>
													<th class="text-center">AMOUNT</th>
													<th class="text-center">ACTION</th>
												</tr>
											</thead>
										<tbody>
										</tbody>
									</table>
							</div>
						</div>
					</div>
				 <div class="modal-footer">
				 	<button type="button" class="btn btn-dark btn-shadow mr-2 add-item"><i class="flaticon2-plus"></i> Add item</button>
            	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-body">
            	<form id="Update_Supplier_Item">
        			   <div class="form-group">
						    <label class="text-white">Material</label>
						    <select class="form-control form-control-lg" name="item" disabled>
						    	<?php 
									$query = $this->db->select('*')->from('tbl_materials')->order_by('id','ASC')->get();
									    if(!$query){return false;}else{ 
									        foreach($query->result() as $row){  
									        	if(!$row->unit){$unit = "";}else{$unit = $row->unit.'(s)';}
									        	echo '<option value="'.$row->id.'">'.$row->item.' - '.$unit.'</option>'; 
									        }  
									    }
								?>
						    </select>
					   </div>
					   <div class="form-group">
						    <label class="text-white">Amount</label>
						    <input type="text" class="form-control form-control-lg amount" name="amount"  placeholder="0.00"/>
					   </div>
					</form>
				</div>
				 <div class="modal-footer">
				 	<button type="button" class="btn btn-light-success btn-shadow mr-2 btn-save-item">Save</button>
            	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-body">
            	<form id="Create_Supplier_Item">
            			<div class="form-group">
						    <label class="text-white">Type</label>
						    <select class="form-control form-control-solid form-control-lg selectpicker" data-live-search="true" name="type"/>
							     <option value="1">Raw Materials</option>
							     <option value="2">Office & Janitorial Supplies</option>
							     <option value="3">Spare Parts</option>
							  </select>
					   </div>
        			   <div class="form-group">
						    <label class="text-white">Material</label>
						    <select class="form-control form-control-lg"  id="item" name="item_add"/>
						     <option value="">Select Item</option>
						  </select>
					   </div>
						   <div class="form-group">
							    <label class="text-white">Amount</label>
							    <input type="text" class="form-control form-control-lg amount" name="amount_add"  placeholder="0.00"/>
						   </div>
					</div>
				</form>
				 <div class="modal-footer">
				 	<button type="button" class="btn btn-light-success btn-shadow mr-2 btn-add">Save</button>
            	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-supplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-body">
            	<form id="Update_Supplier_Edit">
					   <div class="form-group">
						    <label class="text-white">Supplier Name</label>
						    <input type="text" class="form-control form-control-lg name" name="name"/>
					   </div>
					   <div class="form-group">
						    <label class="text-white">Mobile</label>
						    <input type="text" class="form-control form-control-lg mobile" maxlength="11" name="mobile" />
					   </div>
					   <div class="form-group">
						    <label class="text-white">Email</label>
						    <input type="text" class="form-control form-control-lg email" name="email"/>
					   </div>
					   <div class="form-group">
						    <label class="text-white">Address</label>
						    <input type="text" class="form-control form-control-lg address" name="address"/>
					   </div>
					</form>
				</div>
				 <div class="modal-footer">
				 	<button type="button" class="btn btn-light-success btn-shadow mr-2 btn-save-supplier">Save</button>
            	</div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-supplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-body">
            	<form id="Create_Supplier">
					   <div class="form-group">
						    <label class="text-white">Supplier Name</label>
						    <input type="text" class="form-control form-control-lg" name="name_add"/>
					   </div>
					   <div class="form-group">
						    <label class="text-white">Mobile</label>
						    <input type="text" class="form-control form-control-lg" maxlength="11" name="mobile_add" />
					   </div>
					   <div class="form-group">
						    <label class="text-white">Email</label>
						    <input type="text" class="form-control form-control-lg" name="email_add"/>
					   </div>
					   <div class="form-group">
						    <label class="text-white">Address</label>
						    <input type="text" class="form-control form-control-lg" name="address_add"/>
					   </div>
					</form>
				</div>
				 <div class="modal-footer">
				 	<button type="button" class="btn btn-light-success btn-shadow mr-2 btn-add-supplier">Save</button>
            	</div>
        </div>
    </div>
</div>
