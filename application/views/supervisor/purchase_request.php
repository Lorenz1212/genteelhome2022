<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-supervisor-purchase-request">
		<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
			<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
				<div class="d-flex align-items-center flex-wrap mr-1">
					<div class="d-flex flex-column">
						<h2 class="text-white font-weight-bold my-2 mr-5">Purchased Request</h2>
					</div>
				</div>
			</div>
		</div>
<!--end::Subheader-->
<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row">
			<div class="col-xl-4">
				<div class="card card-custom">
					<div class="card-header">
						<div class="card-title">
							<span class="card-icon">
								<i class="flaticon2-psd text-primary"></i>
							</span>
							<h3 class="card-label"><select type="text" class="form-control" id="joborder" name="production_no"><option value="" disabled="" selected="">SELECT JOB ORDER</option></select></h3>
						</div>
					</div>
				<!--begin:: Form-->
					<form class="form" data-link="Create_EM_Purchase_Request">
						<div class="card-body">
							<input type="hidden" name="page1" value="supervisor">
							<div class="form-group">
								   <label>ITEM</label>
								   <input type="text" class="form-control form-control-solid" id="title" disabled />
							</div>
							<div class="form-group">
								   <label>PALLETE COLOR</label>
								   <input type="text" class="form-control form-control-solid" id="c_name" disabled />
							</div>
							<div class="form-group">
									   <label>Special Option</label>
									   <select class="form-control" name="special_option"/>
									   	<option value="common">Common Item</option>
									   	<option value="special">Special Item</option>
									   </select>
							</div>
							<div class="form-group hide_special">
									   <label>SPECIAL ITEM:</label>
									   <input type="text" class="form-control form-control-solid special" id="special_item" name="special_item" />
									   <span class="form-text text-muted">Please enter your item</span>
							</div>
							<div class="form-group hide_common">
									   <label>MATERIAL:</label>
									   <select class="form-control selectpicker common" data-size="7" data-live-search="true" name="purchase_item"/>
									   	<option></option>
									   </select>
									   <span class="form-text text-muted">Please enter your item</span>
							</div>
							<div class="row">
								<div class="col-xl-6">
									<div class="form-group">
										<label>QTY</label>
										<input type="text" class="form-control form-control-solid form-control-lg" name="purchase_quantity" placeholder="Quantity" id="qty" />
										<span class="form-text text-muted">Please enter your qty</span>
									</div>
								</div>
								<div class="col-xl-6">
									<div class="form-group">
										<label>UNIT</label>
										<input type="text" class="form-control form-control-solid form-control-lg" id="purchase_unit" name="purchase_unit" />
										<span class="form-text text-muted">Please enter your Unit</span>
									</div>
								</div>
							</div>
						 	<div class="form-group">
								   <label>Remarks</label>
								   <div class="input-group input-group-lg">
								   <textarea class="form-control" id="purchase_remarks" rows="3"></textarea>
							   </div>
						 	</div>
						 </div>
						<div class="card-footer">
							<button type="button" class="btn btn-primary mr-2" id="add_purchase">Add</button>
						</div>
					</form>
						<!--end:: Form-->
				</div>
			</div>
				<div class="col-xl-8">
					<div class="card card-custom overflow-hidden">
						<div class="card-body p-0">
							<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
								<div class="col-md-10">
									<div class="table-responsive">
										<table class="table" id="myTable1">
											<thead>
												<tr>
													<th class="text-left font-weight-bold text-muted text-uppercase">Items</th>
													<th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
													<th class="text-right font-weight-bold text-muted text-uppercase">Unit</th>
													<th class="text-right font-weight-bold text-muted text-uppercase">Remarks</th>
													<th class="text-right font-weight-bold text-muted text-uppercase">Action</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
								<div class="col-md-9">
									<div class="d-flex justify-content-between">
										<button type="button" class="btn btn-light-primary font-weight-bold" id="Create_EM_Purchase_Request">Submit</button>
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