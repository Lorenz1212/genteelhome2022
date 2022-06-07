<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-officesupplies">
	<div class="form" data-link="Create_OfficeSupplies"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Create Office & Janitorial Supplies</h2>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">

		<div id="accordionExample7">
			<div class="card card-custom gutter-b">
				<div class="card-header"  id="headingOne7">
					<div class="card-title" data-toggle="collapse" data-target="#collapseOne7">
							<div class="card-toolbar">
								<button type="button" class="btn btn-light-primary font-weight-bolder" ><i class="la la-plus"></i>Add New Item</button>
							</div>
						</div>
					</div>
					<div id="collapseOne7" class="collapse" data-parent="#accordionExample7">
						<div class="card-body">
							<div class="d-flex">
								<div class="flex-grow-1">
									<!--begin::Content-->
									<div class="d-flex justify-content-center px-8 my-lg-5 px-lg-5">
										<div class="col-xl-12 col-xxl-7">
										<form id="Create_OfficeSupplies" >
											<div class="row">
											  <div class="col-lg-6">
												  <div class="form-group">
												   <label>ITEM</label>
												   <input type="text" class="form-control form-control-solid" placeholder="Enter Item" name="item"/>
												   <span class="form-text text-muted">Please enter your item</span>
												  </div>
												</div>
											</div>
											</form>
											<div class="d-flex justify-content-between border-top mt-5 pt-3">
													<button type="click" id="Create_OfficeSupplies_btn" class="btn btn-sm btn-success font-weight-bolder text-uppercase px-9 py-4 type">Save</button>
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
		<div class="card card-custom gutter-b">
			<div class="card-header">
				</div>
				<div class="card-body">
					<!--begin: Datatable-->
						<table class="table table-bordered table-hover table-checkable link" id="tbl_officesupplies_add" data-link="tbl_officesupplies_add" style="margin-top: 13px !important">
							<thead>
								<tr>
									<th>NO</th>
									<th>ITEM</th>
									<th>Date Created</th>
									<th>Actions</th>
								</tr>
							</thead>
						</table>
					<!--end: Datatable-->
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            
	            <div class="modal-body">
	            	<form  id="Update_OfficeSupplies">
					 <div class="form-group">
						<label>ITEM</label>
						   <input type="hidden" name="id">
						   <input type="text" class="form-control form-control-solid" placeholder="Enter Item" name="item_update"/>
					</div>	
					<div class="form-group">
					    <label>Status</label>
					    <select class="form-control form-control-solid" name="status">
						     <option value="1">ACTIVE</option>
						     <option value="2">INACTIVE</option>
					    </select>
				   </div>	
	            </div>
	            </form>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
	                <button type="click" class="btn btn-primary font-weight-bold Update_OfficeSupplies_btn">Save changes</button>
	            </div>
        </div>
    </div>
</div>