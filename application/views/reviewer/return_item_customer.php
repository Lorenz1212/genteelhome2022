<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-return-item-customer">
		<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
			<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
				<div class="d-flex align-items-center flex-wrap mr-1">
					<div class="d-flex flex-column">
						<h2 class="text-white font-weight-bold my-2 mr-5">Return Item from Customer</h2>
					</div>
				</div>
			</div>
		</div>
<!--end::Subheader-->e
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
			<div id="accordionExample7">
			<div class="card card-custom gutter-b">
				<div class="card-header"  id="headingOne7">
					<div class="card-title" data-toggle="collapse" data-target="#collapseOne7">
							<div class="card-toolbar">
								<button type="button" class="btn btn-light-primary font-weight-bolder" ><i class="la la-plus"></i>Add New Return Item</button>
							</div>
						</div>
					</div>
					<div id="collapseOne7" class="collapse" data-parent="#accordionExample7">
						<div class="card-body">
							<div class="d-flex">
								<div class="flex-grow-1">
									<!--begin::Content-->
									<div class="d-flex justify-content-center px-8 my-lg-5 px-lg-5">
										<div class="col-xl-12 col-xxl-12 col-md-8">
										<form class="form" id="Create_Return_Item_Customer" data-link="Create_Return_Item_Customer">
											<div class="row">
												<div class="col-xl-2">
													<div class="form-group">
														  <label>SO No.</label>
														  <input class="form-control form-control-solid" name="so_no"/>
														   <span 4="form-text text-muted">Please enter so no</span>
													  </div>
												</div>
											  <div class="col-lg-3">
												 <div class="form-group">
												   <label>ITEM</label>
												  	<select class="form-control" id="item" name="item_no"></select>
												   <span class="form-text text-muted">Please enter your item</span>
												  </div>
												</div>
												<div class="col-lg-2">
												  <div class="form-group">
												   <label>Quantity</label>
												   <input type="number" min="1" class="form-control form-control-solid" placeholder="Input Quantity...." name="qty" autocomplete="off" />
												   <span class="form-text text-muted">Please enter your quantity</span>
												  </div>
												</div>
												<div class="col-xl-2">
													<div class="form-group">
													   <label>Status</label>
													   	<select class="form-control" name="status">
													   		<option value="1">Repair</option>
													   		<option value="2">Good</option>
													   		<option value="3">Rejected</option>
													   	</select>
													   <span class="form-text text-muted">Please enter your item</span>
													  </div>
												</div>
											  <div class="col-lg-3">
												  <div class="form-group">
												   <label>Remarks</label>
												   <textarea class="form-control" name="remarks"></textarea>
												   <span class="form-text text-muted">Please enter your declared price</span>
												  </div>
												</div>
											</div>
											<div class="d-flex justify-content-between border-top mt-5 pt-3">
												<div>
													<button type="button"  class="btn btn-sm btn-success font-weight-bolder text-uppercase px-9 py-4 Create_Return_Item_Customer">Save</button>
												</div>
											</div>
										</form>
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
			    <div class="card-header card-header-tabs-line">
			        <div class="card-toolbar">
			            <ul class="nav nav-tabs nav-bold nav-tabs-line">
			            	<li class="nav-item">
			                    <a class="nav-link active" data-toggle="tab" href="#repair">
			                        <span class="nav-text">Repair</span>
			                        <span class="label label-rounded label-primary return_item_customer_repair">0</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#shipping">
			                        <span class="nav-text mr=2">Good</span>
			                        <span class="label label-rounded label-success return_item_customer_good">0</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#delivered">
			                        <span class="nav-text">Rejected</span>
			                        <span class="label label-rounded label-danger return_item_customer_rejected">0</span>
			                    </a>
			                </li>
			            </ul>
			   		 </div>
			   	</div>
			    <div class="card-body link" data-link="tbl_return_item_customer_superuser">
			        <div class="tab-content">
			        	<div class="tab-pane fade show active" id="repair" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_return_item_repair" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>ITEM</th>
										<th>QUANTITY</th>
										<th>REMARKS</th>
										<th>DATE</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_return_item_good" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>ITEM</th>
										<th>QUANTITY</th>
										<th>REMARKS</th>
										<th>DATE</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_return_item_rejected" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>ITEM</th>
										<th>QUANTITY</th>
										<th>REMARKS</th>
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
