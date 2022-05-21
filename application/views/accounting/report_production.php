
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="report-project-monitoring">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">PROJECT - EXPENSE MONITORING</h2>
				</div>
			</div>
		</div>
	</div>
<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="d-flex flex-row">
				<!--begin::Aside-->
				<div class="flex-column offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
					<!--begin::Forms Widget 13-->
					<div class="card card-custom gutter-b">
						<div class="card-header">
						<div class="card-title">Details</div>  
						</div>
						<!--begin::Body-->
						<div class="card-body pt-2 pb-0 mt-n3">
								<div class="mt-6">
									<div class="form-group mb-8">
									        <label class="font-weight-bolder">Job Order</label>
										    <div class="input-group">
										     	<select class="form-control form-control-solid" name="joborder" id="joborder"></select>
										     	<div class="input-group-prepend ml-2">
										     		 <button class="btn btn-light-success btn-search" data-id="0" type="button">Search</button>
										     	</div>
										    </div>
									   </div>
									   <div class="form-group mb-4">
									        <label class="font-weight-bolder">Name</label>
										     <input class="form-control text-name" placeholder="Enter Name" readonly/>
									   </div>
									    <div class="form-group mb-4">
									        <label class="font-weight-bolder">Address</label>
										     <input class="form-control text-address"  placeholder="Enter Address" readonly/>
									   </div>
									   <div class="form-group mb-4">
									       <label class="font-weight-bolder">Amount</label>
										    <input class="form-control  text-amount"  placeholder="0.00" readonly/>
									  </div>
									   <div class="form-group mb-4">
									       <label class="font-weight-bolder">Labor Cost</label>
										     	<input class="form-control  text-labor" placeholder="0.00" readonly/>
									  </div>
									  <div class="form-group mb-4">
									       <label class="font-weight-bolder">Start Date</label>
										     	<input class="form-control text-start-name" placeholder="MM/DD/YYY" readonly/>
									  </div>
									  <div class="form-group mb-4">
									       <label class="font-weight-bolder">End Date</label>
										     	<input class="form-control text-end-name" placeholder="MM/DD/YYY" readonly/>
									  </div>
								</div>
						</div>
						<div class="card-footer">
						        <button class="btn btn-outline-success font-weight-bold view-details" style="float:right"><i class="fas fa-pencil-alt"></i> Edit Details</button>
						 </div>
						<!--end::Body-->
					</div>
					<!--end::Forms Widget 13-->
				</div>
				<!--end::Aside-->
				<!--begin::Layout-->
				<div class="flex-row-fluid ml-lg-8">
					<!--begin::Card-->
					<div class="card card-custom card-stretch gutter-b">
						<div class="card-body">
								<table class="table table-bordered table-hover" id="tbl_framing">
										<thead>
											<tr class="table-warning">
												<th colspan="6" class="text-left">FRAMING - MATERIALS</th>
												<th colspan="2" class="text-center"> <button class="btn btn-primary btn-hover-success btn-sm btn-edit-materials" data-type="1"><i class="fas fa-pencil-alt icon-nm"></i> Edit</button></th>
											</tr>
											<tr class="table-success">
												<th  style="width: 30%" class="text-center">PARTICULAR</th>
												<th  style="width: 10%" colspan="2">QTY COSTING</th>
												<th  style="width: 10%" colspan="2">QTY ACTUAL</th>
												<th  style="width:  8.33%">UNIT PRICE</th>
												<th  style="width:  8.33%">AMOUNT COSTING</th>
												<th  style="width:  8.33%">AMOUNT ACTUAL</th>
											</tr>
										</thead>
										<tbody>
											<tr>
		             							<td colspan="8" class="text-center">NO DATA</td>
											</tr>
										</tbody>
									 </table>
									 <table class="table table-bordered table-hover" id="tbl_mechanism">
										<thead>
											<tr class="table-warning">
												<th colspan="6" class="text-left">MECHANISM - MATERIALS</th>
												<th colspan="2" class="text-center"> <button class="btn btn-primary btn-hover-success btn-sm btn-edit-materials" data-type="2"><i class="fas fa-pencil-alt icon-nm"></i> Edit</button></th>
											</tr>
											<tr class="table-success">
												<th  style="width: 30%" class="text-center">PARTICULAR</th>
												<th  style="width: 10%" colspan="2">QTY COSTING</th>
												<th  style="width: 10%" colspan="2">QTY ACTUAL</th>
												<th  style="width:  8.33%">UNIT PRICE</th>
												<th  style="width:  8.33%">AMOUNT COSTING</th>
												<th  style="width:  8.33%">AMOUNT ACTUAL</th>
											</tr>
										</thead>
										<tbody >
											<tr>
		             							<td colspan="8" class="text-center">NO DATA</td>
											</tr>
										</tbody>
									</table>

									<table class="table table-bordered table-hover" id="tbl_finishing">
										<thead>
											<tr class="table-warning">
												<th colspan="6" class="text-left">FINISHING - MATERIALS</th>
												<th colspan="2" class="text-center"> <button class="btn btn-primary btn-hover-success btn-sm btn-edit-materials" data-type="3"><i class="fas fa-pencil-alt icon-nm"></i> Edit</button></th>
											</tr>
											<tr class="table-success">
												<th  style="width: 30%" class="text-center ">PARTICULAR</th>
												<th  style="width: 10%" colspan="2">QTY COSTING</th>
												<th  style="width: 10%" colspan="2">QTY ACTUAL</th>
												<th  style="width:  8.33%">UNIT PRICE</th>
												<th  style="width:  8.33%">AMOUNT COSTING</th>
												<th  style="width:  8.33%">AMOUNT ACTUAL</th>
											</tr>
										</thead>
										<tbody>
											<tr>
		             							<td colspan="8" class="text-center">NO DATA</td>
											</tr>
										</tbody>
									</table>
									<table class="table table-bordered table-hover" id="tbl_sulihiya">
										<thead>
											<tr class="table-warning">
												<th colspan="6" class="text-left">SULIHIYA</th>
												<th colspan="2" class="text-center"> <button class="btn btn-primary btn-hover-success btn-sm btn-edit-materials" data-type="4"><i class="fas fa-pencil-alt icon-nm"></i> Edit</button></th>
											</tr>
											<tr class="table-success">
												<th  style="width: 30%" class="text-center">PARTICULAR</th>
												<th  style="width: 10%" colspan="2">QTY COSTING</th>
												<th  style="width: 10%" colspan="2">QTY ACTUAL</th>
												<th  style="width:  8.33%">UNIT PRICE</th>
												<th  style="width:  8.33%">AMOUNT COSTING</th>
												<th  style="width:  8.33%">AMOUNT ACTUAL</th>
											</tr>
										</thead>
										<tbody>
											<tr>
		             							<td colspan="8" class="text-center">NO DATA</td>
											</tr>
										</tbody>
									</table>
										<table class="table table-bordered table-hover" id="tbl_upholstery">
										<thead>
											<tr class="table-warning">
												<th colspan="6" class="text-left">UPHOLSTERY</th>
												<th colspan="2" class="text-center"> <button class="btn btn-primary btn-hover-success btn-sm btn-edit-materials" data-type="5"><i class="fas fa-pencil-alt icon-nm"></i> Edit</button></th>
											</tr>
											<tr class="table-success">
												<th  style="width: 30%" class="text-center">PARTICULAR</th>
												<th  style="width: 10%" colspan="2">QTY COSTING</th>
												<th  style="width: 10%" colspan="2">QTY ACTUAL</th>
												<th  style="width:  8.33%">UNIT PRICE</th>
												<th  style="width:  8.33%">AMOUNT COSTING</th>
												<th  style="width:  8.33%">AMOUNT ACTUAL</th>
											</tr>
										</thead>
										<tbody>
											<tr>
		             							<td colspan="8" class="text-center">NO DATA</td>
											</tr>
										</tbody>
									</table>
									<table class="table table-bordered table-hover"  id="tbl_others">
										<thead>
											<tr class="table-warning">
												<th colspan="6" class="text-left">OTHERS</th>
												<th colspan="2" class="text-center"> <button class="btn btn-primary btn-hover-success btn-sm btn-edit-materials" data-type="6"><i class="fas fa-pencil-alt icon-nm"></i> Edit</button></th>
											</tr>
											<tr class="table-success">
												<th  style="width: 30%" class="text-center">PARTICULAR</th>
												<th  style="width: 10%" colspan="2">QTY COSTING</th>
												<th  style="width: 10%" colspan="2">QTY ACTUAL</th>
												<th  style="width:  8.33%">UNIT PRICE</th>
												<th  style="width:  8.33%">AMOUNT COSTING</th>
												<th  style="width:  8.33%">AMOUNT ACTUAL</th>
											</tr>
										</thead>
										<tbody>
											<tr>
		             							<td colspan="8"  class="text-center">NO DATA</td>
											</tr>
										</tbody>
									</table>
						</div>
					</div>
					<!--end::Card-->
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="view-details" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-trans"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                 <form class="form" id="edit_details">
	                 	<div class="form-group mb-4">
					        <label class="font-weight-bolder">Name</label>
						     <input type="text" class="form-control text-name" name="customer" placeholder="Enter Name"/>
					   </div>
					    <div class="form-group mb-4">
					        <label class="font-weight-bolder">Address</label>
						     <input type="text" class="form-control text-address" name="address"  placeholder="Enter Address"/>
					   </div>
					   <div class="form-group mb-4">
					       <label class="font-weight-bolder">Amount</label>
						    <input type="text" class="form-control  text-amount amount" name="amount" placeholder="0.00"/>
					  </div>
					   <div class="form-group mb-4">
					       <label class="font-weight-bolder">Labor Cost</label>
						   <input type="text" class="form-control text-labor amount" name="labor" placeholder="0.00"/>
					  </div>
					  <div class="form-group mb-4">
					       <label class="font-weight-bolder">Start Date</label>
						    <input type="date"  class="form-control text-start" name="start" placeholder="MM/DD/YYY"/>
					  </div>
					  <div class="form-group mb-4">
					       <label class="font-weight-bolder">End Date</label>
						   <input type="date" class="form-control text-end" name="end" placeholder="MM/DD/YYY"/>
					  </div>
                 </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success font-weight-bold btn-edit-detials">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="view-materials" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-trans-material"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                 <form class="form" id="edit_materials">
                 	<input type="hidden" name="id" class="text-material-id">
	                 	<div class="form-group mb-4">
					        <label class="font-weight-bolder">Materials</label>
						    <select type="text" class="form-control item select2" style="width: 200px"  name="item"></select>
					   </div>
					    <div class="form-group mb-4">
					        <label class="font-weight-bolder">Quantity Costing</label>
						     <input type="text" class="form-control text-quantity-costing" name="quantity_costing"  placeholder="0"/>
					   </div>
					   <div class="form-group mb-4">
					       <label class="font-weight-bolder">Unit Price</label>
						    <input type="text" class="form-control  text-amount-costing amount" name="cost" placeholder="0.00"/>
					  </div>
                 </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success font-weight-bold btn-edit-details-materials">Save</button>
            </div>
        </div>
    </div>
</div>


