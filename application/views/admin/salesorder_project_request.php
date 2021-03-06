<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-salesorder-project">
	<div class="form" data-link="Update_Salesorder_Project_Request"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Sales Order For Project</h2>
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
			                    	<span class="nav-icon"><i class="flaticon-exclamation-1"></i></span>
			                        <span class="nav-text">REQUEST <span class="label label-rounded label-warning request_sales_project">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#shipping">
			                    	<span class="nav-icon"><i class="flaticon-list-3"></i></span>
			                        <span class="nav-text">APPROVED <span class="label label-rounded label-success approved_sales_project">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#delivered">
			                    	<span class="nav-icon"><i class="flaticon2-cross"></i></span>
			                        <span class="nav-text">REJECTED <span class="label label-rounded label-danger rejected_sales_project">0</span></span>
			                    </a>
			                </li>
			            </ul>
			   		 </div>
			   		</div>
			    <div class="card-body link" data-link="tbl_salesorder_project_request_admin">
			        <div class="tab-content">
			            <div class="tab-pane fade show active" id="approved" role="tabpanel" aria-labelledby="approved">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_salesorder_approved" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>SO NO.</th>
										<th>CUSTOMER</th>
										<th>CREATED BY</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_salesorder_shipping" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>SO NO.</th>
										<th>CUSTOMER</th>
										<th>CREATED BY</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_salesorder_delivered" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>SO NO.</th>
										<th>CUSTOMER</th>
										<th>CREATED BY</th>
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
								<div class="col-md-8 col-xl-8 col-xxl-8">
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
											<td colspan="4" class="text-center text-white td1-header">BILLING STATEMENT</td>
										</tr>
										<tr>
											<td></br></td>
										</tr>
										<tr>
											<td class="td1-w-50"><b>Sold to :</b></td>
											<td class="td1-w-150 td1-border sold-to"></td>
											<td class="text-center td1-w-100"> <b>Date :</b></td>
											<td class="td1-w-150 td1-border date-order"></td>
										</tr>
										<tr>
											<td class="td1-w-50"><b>TIN :</b></td>
											<td class="td1-w-150 td-border"></td>
											<td></td>
											<td></td>
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
												<th class="text-center td1-border-1px">AMOUNT</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
									</br>
									<table class="table1-fixed td1-padding">
											<tr class="tr1-discount">
											</tr>
											<tr>
												<td class="text-right text-success">DOWNPAYMENT :</td>
												<td class="text-right text-success"><div style="float:left;">???</div><div class="td-downpayment" style="float:right;"><div></td>
											</tr>
											<tr class="tr-shipping">
											</tr>
											<tr>
												<td class="text-right text-danger">AMOUNT DUE <span class="vat-included"></span> :</td>
												<td class="text-right text-danger"><div style="float:left;">???</div><div class="td-amountdue" style="float:right;"><div></td>
											</tr>
									</table>
								</div>
							</div>
					</div>
					<div class="modal-footer modal-approval">
							<button class="btn btn-danger btn-shadow btn-sm mr-2 btn-status-save" data-status="C">Reject</button>
							<button class="btn btn-success btn-shadow btn-sm mr-2 btn-status-save" data-status="A">Approve</button>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

