<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-sparerequest-create">
		<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
			<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
				<div class="d-flex align-items-center flex-wrap mr-1">
					<div class="d-flex flex-column">
						<h2 class="text-white font-weight-bold my-2 mr-5">Production Supplies / Spare Parts Request</h2>
						<div class="d-flex align-items-center font-weight-bold my-2">
							<a href="#" class="opacity-75 hover-opacity-100">
								<i class="flaticon2-shelter text-white icon-1x"></i>
							</a>
							<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
							<span class="text-white text-hover-white opacity-75 hover-opacity-100">Request</span>
						</div>
					</div>
				</div>
			</div>
		</div>
<!--end::Subheader-->
<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row">
			<div class="col-xl-3">
				<div class="card card-custom">
					
				<!--begin:: Form-->
						<form class="form" data-link="Create_SpareParts_Request">
							<input type="hidden" name="page" value="designer">
						<div class="card-body">
							 <div class="form-group">
								   <label>ITEM:</label>
								   <select class="form-control "  id="spare_parts" name="item"/></select>
								   <span class="form-text text-muted">Please enter your item</span>
							</div>
							  <div class="form-group">
								   <label>QTY</label>
								   <div class="input-group input-group-lg">
								    <div class="input-group-prepend alert_3"><span class="input-group-text">Qty</span></div>
								    <input type="text" class="form-control form-control-solid" id="quantity" name="quantity" placeholder="Numbers Only" />
							   </div>
						 	</div>
						 	<div class="form-group">
								   <label>REMARKS</label>
								   <div class="input-group input-group-lg">
								   <textarea class="form-control" id="remarks" rows="3"></textarea>
							   </div>
						 	</div>
						 </div>
						<div class="card-footer">
							<button type="button" class="btn btn-primary mr-2" id="add_request">Add</button>
						</div>
					</form>
						<!--end:: Form-->
				</div>
			</div>
				<div class="col-xl-9">
					<div class="card card-custom overflow-hidden">
						<div class="card-body p-0">
							<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
								<div class="col-md-10">
									<div class="table-responsive">
										<table class="table" id="myTable">
											<thead>
												<tr>
													<th class="text-left font-weight-bold text-muted text-uppercase">Items</th>
													<th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
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
										<button type="button" class="btn btn-light-primary font-weight-bold" id="Create_SpareParts_Request">Submit</button>
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