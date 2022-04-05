<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-online-request">
	<div class="form" data-link="Create_Request_Pre_Order"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Online Order</h2>
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
			        <div class="card-toolbar">
			            <ul class="nav nav-tabs nav-bold nav-tabs-line">
			                <li class="nav-item">
			                    <a class="nav-link active" data-toggle="tab" href="#approved">
			                        <span class="nav-text">REQUEST FOR APPROVAL <span class="label label-rounded label-primary online_add_cart">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#shipping">
			                        <span class="nav-text">PRE ORDER <span class="label label-rounded label-warning pre_order_count">0</span></span>
			                    </a>
			                </li>
			            </ul>
			   		 </div>
			   		</div>
			    <div class="card-body link" data-link="tbl_onlineorder">
			        <div class="tab-content">
			            <div class="tab-pane fade show active" id="approved" role="tabpanel" aria-labelledby="approved">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_onlineorder_request" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>ORDER NO.</th>
										<th>CUSTOMER</th>
										<th>TYPE</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_preorder_request" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>ORDER NO.</th>
										<th>ITEM</th>
										<th>QUANTITY</th>
										<th>DATE</th>
										<th>STATUS</th>
									</tr>
								</thead>
							</table>
			            </div>

			        </div>
			    </div>
			</div>
	</div>
<!-- Modal-->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
        	<div class="modal-body">
							<div class="row">
								<div class="col-md-12 col-xxl-12">
									<table class="table table-borderless table1-size">
										<tr>
											<td colspan="4" class="text-center text-white td1-header font-size-h4 order_no">REQUEST ORDER</td>
										</tr>
										<tr>
											<td></br></td>
										</tr>
										<tr>
											<td class="td1-w-50"><b>Name :</b></td>
											<td class="td1-w-150 td1-border name"></td>
											<td class="text-right td1-w-100"><b>Date :</b></td>
											<td class="td1-w-150 td1-border date-order"></td>
										</tr>
										<tr>
											<td class="td1-w-50"><b>Billing Address :</b></td>
											<td class="td1-w-150 td1-border b_address"></td>
											<td class="text-right td1-w-100"><b>Mobile :</b></td>
											<td class="td1-w-150 td1-border ml-2 mobile"></td>
										</tr>
										<tr>
											<td class="td1-w-50 mr-2"><b>Shipping Address :</b></td>
											<td class="td1-w-150 td1-border s_address"></td>
											<td class="text-right td1-w-100 mr-2"><b>Email :</b></td>
											<td class="td1-w-150 td1-border email"></td>
										</tr>
									</table>
								</div>
							</div>
						</br>
							<div class="row">
								<div class="col-md-12 col-xxl-12">
									<table class="table-hover table-sm table1-fixed" id="kt_table_soa_item">
										<thead>
											<tr>
												<th class="text-center td1-border-1px">DESCRIPTION</th>
												<th class="text-center td1-border-1px">AMOUNT</th>
												<th class="text-center td1-border-1px">STATUS</th>
												<th class="text-center td1-border-1px">ACTION</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						
					</div>
					<div class="modal-footer">
						 <a type="button" class="btn btn-light-dark font-weight-bold"><i class="flaticon-file-1"></i> Create Sales Order</a>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

