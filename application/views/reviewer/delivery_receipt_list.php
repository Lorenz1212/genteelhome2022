<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-sales-delivery">
	<div class="subheader py-2 py-lg-12 subheader-transparent form" data-link="Create_Delivery_Receipt" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Delivery Receipt (D.R)</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<button  class="btn btn-light-success font-weight-bolder btn-sm create-delivery-receipt-modal" ><i class="flaticon-add-circular-button"></i> Create Delivery Receipt</button>
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
			                    <a class="nav-link active" data-toggle="tab" href="#request">
			                    	<span class="nav-icon"><i class="flaticon-exclamation-1"></i></span>
			                        <span class="nav-text">Request <span class="label label-rounded label-warning sales_delivery_pending">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#shipping">
			                    	<span class="nav-icon"><i class="flaticon-truck"></i></span>
			                        <span class="nav-text">To Ship <span class="label label-rounded label-primary sales_delivery_ship">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#received">
			                    	<span class="nav-icon"><i class="flaticon-bus-stop"></i></span>
			                        <span class="nav-text">To Receive <span class="label label-rounded label-info sales_delivery_received">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#completed">
			                    	<span class="nav-icon"><i class="flaticon-clipboard"></i></span>
			                        <span class="nav-text">Completed <span class="label label-rounded label-success sales_delivery_completed">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#cancelled">
			                    	<span class="nav-icon"><i class="la la-times-circle-o"></i></span>
			                        <span class="nav-text">Cancelled <span class="label label-rounded label-danger sales_delivery_cancelled">0</span></span>
			                    </a>
			                </li>
			            </ul>
			   		 </div>
			   		</div>
			    <div class="card-body link" data-link="tbl_sales_delivery_superuser">
			        <div class="tab-content">
			            <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request">
			                <table class="table table-bordered table-hover" id="tbl_delivery_request" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>DR #.</th>
										<th>CUSTOMER</th>
										<th>EMAIL</th>
										<th>MOBILE</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover" id="tbl_delivery_shipping" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>DR #.</th>
										<th>CUSTOMER</th>
										<th>EMAIL</th>
										<th>MOBILE</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="received" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover" id="tbl_delivery_received" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>DR #.</th>
										<th>CUSTOMER</th>
										<th>EMAIL</th>
										<th>MOBILE</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover" id="tbl_delivery_completed" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>DR #.</th>
										<th>CUSTOMER</th>
										<th>EMAIL</th>
										<th>MOBILE</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover" id="tbl_delivery_cancelled" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>DR #.</th>
										<th>CUSTOMER</th>
										<th>EMAIL</th>
										<th>MOBILE</th>
										<th>DATE</th>
										<th>ACTION</th>
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
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
        	<div class="modal-body">
							<div class="row">
								<div class="col-md-7 col-xl-8 col-xxl-8">
									<span class="text-dark text-right d-flex flex-column pad-r">
										<span>124 FIL-AM HIGHWAY TRINIDAD VILLAGE</span>
										<span>CALIBUTBUT BACOLOR PAMPANGA</span>
										<span>0917 134 0983</span>
										<span>finance@genteelhome.co</span>
									</span>
								</div>
								<div class="col-md-3 col-xl-3 col-xxl-3">
									<img src="<?php echo base_url()?>assets/images/logo/logo-so.jpg" class="image1-size-r" alt="">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12 col-xxl-12">
									<table class="table1-size">
										<tr>
											<td colspan="4" class="text-center text-white td1-header">Delivery Receipt</td>
										</tr>
										<tr>
											<td></br></td>
										</tr>
										<tr>
											<td class="td1-w-50"><b>Delivered to :</b></td>
											<td class="td1-w-150 td1-border sold-to"></td>
											<td class="text-center td1-w-100"> <b>Date :</b></td>
											<td class="td1-w-150 td1-border date-order"></td>
										</tr>
										<tr>
											<td class="td1-w-50"><b>Address :</b></td>
											<td class="td1-w-150 td1-border address"></td>
											<td></td>
											<td class="td1-w-150 td1-border so_no"></td>
										</tr>
									</table>
								</div>
							</div>
						</br>
							<div class="row">
								<div class="col-md-12 col-xxl-12">
									<table class="table1-fixed" id="kt_table_soa_item">
										<thead>
											<tr>
												<th class="text-center td1-border-1px">DESCRIPTION</th>
												<th class="text-center td1-border-1px">QTY</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						
					</div>
					<div class="modal-footer">
						<a class="btn btn-light-dark font-weight-bold btn-icon btn-print"  type="button"><i class="flaticon2-printer"></i></a>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create-delivery-receipt-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
	        		<div class="modal-header">
		                <h5 class="modal-title text-dr">Create D.R</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <i aria-hidden="true" class="ki ki-close"></i>
		                </button>
		            </div>
        			<div class="modal-body">
						<div class="row">
							<div class="col-xl-4">
								 <div class="form-group">
								    <label>Item <span class="text-danger">*</span></label>
								    <select class="form-control" id="item" name="item"></select>
								 </div>
							</div>
							<div class="col-xl-2">
								 <div class="form-group">
								    <label>Quantity <span class="text-danger">*</span></label>
								    <input type="text" class="form-control qty" name="qty" placeholder="0"/>
								 </div>
							</div>
							<div class="col-xl-4">
								<div class="form-group">
								    <button class="btn btn-light-dark mt-8 btn-add" type="button"><i class="la la-plus-circle"></i> Add item</button>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-12">
								<div class="tableFixHead">
								<table class="table table-hover table-sm" id="tbl_delivery_breakdown">
									<thead>
										<tr>
											<th class="text-center">Description</th>
											<th class="text-center">Quantity</th>
											<th class="text-center"></th>	
										</tr>
									</thead>
									<tbody></tbody>
								</table>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-dark Create_Delivery_Receipt">Submit</button>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>


