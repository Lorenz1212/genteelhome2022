
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-production-supplies">
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
						<!--begin::Body-->
						<div class="card-body pt-2 pb-0 mt-n3">
							<!--begin::Form-->
							<form class="form" data-link="Update_Project_Monitoring">
								<!--begin::Product info-->
								<div class="mt-6">
									<div class="text-muted mb-4 font-weight-bolder font-size-lg">Details</div>
									<!--begin::Input-->
									<div class="form-group mb-8">
									        <label class="font-weight-bolder">Job Order</label>
										    <div class="input-group">
										     	<select class="form-control form-control-solid" name="joborder" id="joborder"></select>
										     	<div class="input-group-prepend">
										     		 <button class="btn btn-secondary btn-search" data-id="0" type="button">Search</button>
										     	</div>
										    </div>
									   </div>
									   <div class="form-group mb-8">
									        <label class="font-weight-bolder">Name</label>
										    <div class="input-group">
										     	<input class="form-control form-control-solid text-name" name="name"  placeholder="Enter Name" disabled/>
										    </div>
									   </div>
									    <div class="form-group mb-8">
									        <label class="font-weight-bolder">Address</label>
										    <div class="input-group">
										     	<input class="form-control form-control-solid text-address" name="address"  placeholder="Enter Address" disabled/>
										    </div>
									   </div>
									   <div class="form-group mb-8">
									       <label class="font-weight-bolder">Amount</label>
										    <div class="input-group">
										     	<input class="form-control form-control-solid text-amount" name="amount" placeholder="0.00" disabled/>
										    </div>
									  </div>
									   <div class="form-group mb-8">
									       <label class="font-weight-bolder">Labor Cost</label>
										    <div class="input-group">
										     	<input class="form-control form-control-solid text-labor" name="labor" placeholder="0.00" disabled/>
										    </div>
									  </div>
									  <div class="form-group row">

										    <div class="col-lg-12 col-md-12 col-sm-12">
										    	 <label class="font-weight-bolder">Start & Due Date</label>
										       <div class="input-daterange input-group" >
										     		 <input type="text" class="form-control text-start" name="start"  placeholder="MM/DD/YYY" id="start-date" disabled/>
												      <div class="input-group-append">
												      	<button type="button"  class="btn btn-success btn-icon btn-edit btn-date" data-action="edit-date" disabled>-</button>
												      </div>
										     		 <input type="text" class="form-control text-due" id="end-date" name="due" placeholder="MM/DD/YYY" disabled/>
										     </div>
										  </div>
									   </div>
									<!--end::Input-->
								</div>
								<!--end::Product info-->
							</form>
							<!--end::Form-->
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
								<table class="table table-bordered table-hover table-sm" id="tbl_framing">
										<thead>
											<tr class="thead-light">
												<th colspan="8" class="text-left">FRAMING - MATERIALS</th>
											</tr>
											<tr class="thead-dark">
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
									 <table class="table table-bordered table-hover table-sm" id="tbl_mechanism">
										<thead>
											<tr class="thead-light">
												<th colspan="8" class="text-left">FRAMING - MATERIALS</th>
											</tr>
											<tr class="thead-dark">
												<th  style="width: 30%" class="text-center ">PARTICULAR</th>
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

									<table class="table table-bordered table-hover table-sm" id="tbl_finishing">
										<thead>
											<tr class="thead-light">
												<th colspan="8" class="text-left">FINISHING - MATERIALS</th>
											</tr>
											<tr class="thead-dark">
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
									<table class="table table-bordered table-hover table-sm"   id="tbl_sulihiya">
										<thead>
											<tr class="thead-light">
												<th colspan="8" class="text-left">SULIHIYA</th>
											</tr>
											<tr class="thead-dark">
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
										<table class="table table-bordered table-hover table-sm"  id="tbl_upholstery">
										<thead>
											<tr class="thead-light">
												<th colspan="8" class="text-left">UPHOLSTERY</th>
											</tr>
											<tr class="thead-dark">
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
									<table class="table table-bordered table-hover table-sm"  id="tbl_others">
										<thead>
											<tr class="thead-light">
												<th colspan="8" class="text-left">OTHERS</th>
											</tr>
											<tr class="thead-dark">
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
<div class="modal fade" id="ModalTalble" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white"><span id="text-table"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close text-white"></i>
                </button>
            </div>
            <div class="modal-body">
                 <div class="data-text" data-scroll="true" data-height="300"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-transparent-white font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


