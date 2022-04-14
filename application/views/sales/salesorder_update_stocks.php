<style type="text/css">
	.table-scroll tbody {
	  display: block;
	  max-height: 430px;
	  overflow-y: scroll;
	}
	.table-scroll thead, table tbody tr {
	  display: table;
	  width: 100%;
	  table-layout: fixed;
	}
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-salesorder-update-stocks">
	<div class="form" data-link="Update_Salesorder_Stocks"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Create Sales Order For Stocks</h2>
				</div>
			</div>
		</div>
	</div>
<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row" id="Create_Salesorder_Stocks_Form">
			<div class="col-xl-3 col-xxl-3 col-md-3">
			    <div class="row">
					<div class="col-lg-12 col-xl-12 col-md-12">
						<div class="card card-custom gutter-b">
							    <div class="card-header card-header-tabs-line">
							        <div class="card-toolbar">
							            <div class="card-title">
												<h3 class="card-label">Customer Info</h3>
										 </div>
							        </div>
							    </div>
						   		<div class="card-body">
						       		 <div class="row">
									 	  <div class="col-lg-12 col-xl-12 col-md-12">
									 	  	    <div class="form-group row">
													<label>Date</label>
													<input type="text" class="form-control form-control-lg" name="date_created" disabled />
												</div>
											    <div class="form-group row">
												    <label>Customer Name</label>
												     <input type="text" class="form-control form-control-lg" name="fullname" data-id="" autocomplete="off" disabled />
												</div>
												<div class="form-group row">
													<label>Email Address</label>
													<input type="email" class="form-control form-control-lg" name="email" placeholder="@example.com" autocomplete="off" disabled/>
												</div>
												<div class="form-group row">
													<label>Mobile No</label>
													<input type="text" class="form-control form-control-lg" name="mobile" placeholder="+639" autocomplete="off" disabled/>
												</div>
												<div class="form-group row">
													<label>Address</label>
													<textarea class="form-control" name="address" rows="3" disabled></textarea>
												</div>
												<div class="form-group row">
													<label>Downpayment</label>
													<input type="text" class="form-control form-control-solid form-control-lg" name="downpayment" placeholder="0.00" />
												</div>
												<div class="form-group row">
													<label>Date of downpayment</label>
													<input type="date" class="form-control form-control-solid form-control-lg" name="date_downpayment"/>
												</div>
												<div class="form-group row">
													<div class="col-lg-5 col-xl-5 col-md-5">
													<label>Discount (%)</label>
													<input type="text" class="form-control form-control-solid form-control-lg" name="discount" id="discount" placeholder="0.00%" autocomplete="off"/>
													</div>
													<div class="col-lg-7 col-xl-7 col-md-7">
														<label>Vat</label>
														<select class="form-control form-control-lg" name="vat">
															<option value="1">Vatable</option>
															<option value="2">W/o Vat</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label>Shipping Fee</label>
													<input type="text" class="form-control form-control-solid form-control-lg" name="shipping_fee" placeholder="0.00" />
												</div>
										 </div>
									</div>
									 <div class="row">
										 	<div class="col-lg-12 col-xl-12 col-md-12 text-center">
											<button type="button" class="btn btn-dark font-weight-bold btn-lg btn-square btn-create-submit">SUBMIT SALES ORDER</button>
											</div>
										</div>
						        </div>
						   </div>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-xxl-8 col-md-8">
				<div class="row">
								<div class="col-xl-12 col-xxl-12 col-md-12">
									<div class="card card-custom gutter-b">
									    <div class="card-header card-header-tabs-line">
									       <div class="card-title">
												<h3 class="card-label">Product Breakdown</h3>
											</div>
									    </div>
								   		<div class="card-body">
								   			<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 737px">
								       			<table class="table table-scroll table-sm" id="kt_product_breakdown_table">
													<thead>
														<tr>
															<th class="text-left text-muted text-uppercase">DESCRIPTION</th>
															<th class="text-center text-muted text-uppercase">QUANTITY</th>
															<th class="text-right  text-muted text-uppercase">AMOUNT</th>
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
			</div>
		</div>
	</div>
</div>