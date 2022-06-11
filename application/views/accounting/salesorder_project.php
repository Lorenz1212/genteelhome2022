<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-salesorder-project">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Sales Order (Project)</h2>
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
			                    <a class="nav-link active" data-toggle="tab" href="#request">
			                    	<span class="nav-icon"><i class="flaticon-exclamation-1"></i></span>
			                        <span class="nav-text">Request <span class="label label-rounded label-warning sales_project_pending">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#approved">
			                    	<span class="nav-icon"><i class="la la-check-circle"></i></span>
			                        <span class="nav-text">Approved <span class="label label-rounded label-primary sales_project_approved">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#completed">
			                    	<span class="nav-icon"><i class="flaticon-clipboard"></i></span>
			                        <span class="nav-text">Completed <span class="label label-rounded label-success sales_project_completed">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#cancelled">
			                    	<span class="nav-icon"><i class="la la-times-circle-o"></i></span>
			                        <span class="nav-text">Cancelled <span class="label label-rounded label-danger sales_project_cancelled">0</span></span>
			                    </a>
			                </li>
			            </ul>
			   		 </div>
			   		</div>
			    <div class="card-body link" data-link="tbl_salesorder_project">
			        <div class="tab-content">
			            <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request">
			                <table class="table table-bordered table-hover" id="tbl_salesorder_request">
								<thead>
									<tr>
										<th>Trans #.</th>
										<th>CUSTOMER</th>
										<th>MOBILE</th>
										<th>EMAIL</th>
										<th>DATE ORDER</th>
										<th>TERMS</th>
										<th>STATUS</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved">
			                <table class="table table-bordered table-hover" id="tbl_salesorder_approved">
								<thead>
									<tr>
										<th>Trans #.</th>
										<th>CUSTOMER</th>
										<th>MOBILE</th>
										<th>EMAIL</th>
										<th>DATE ORDER</th>
										<th>TERMS</th>
										<th>STATUS</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed">
			                <table class="table table-bordered table-hover" id="tbl_salesorder_completed">
								<thead>
									<tr>
										<th>Trans #.</th>
										<th>CUSTOMER</th>
										<th>MOBILE</th>
										<th>EMAIL</th>
										<th>DATE ORDER</th>
										<th>TERMS</th>
										<th>STATUS</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			             <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled">
			                <table class="table table-bordered table-hover" id="tbl_salesorder_cancelled">
								<thead>
									<tr>
										<th>Trans #.</th>
										<th>CUSTOMER</th>
										<th>MOBILE</th>
										<th>EMAIL</th>
										<th>DATE ORDER</th>
										<th>TERMS</th>
										<th>STATUS</th>
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
											<td class="td1-w-150 td1-border tin"></td>
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
											<tr class="tr-discount">
											</tr>
											<tr>
												<td class="text-right text-success">DOWNPAYMENT <span class="td-date-downpayment"></span> :</td>
												<td class="text-right text-success"><div style="float:left;">₱</div><div class="td-downpayment" style="float:right;"><div></td>
											</tr>
											<tr class="tr-shipping">
											</tr>
											<tr>
												<td class="text-right text-danger">AMOUNT DUE <span class="vat-included"></span> :</td>
												<td class="text-right text-danger"><div style="float:left;">₱</div><div class="td-amountdue" style="float:right;"><div></td>
											</tr>
									</table>
								</div>
							</div>
						
					</div>
					<div class="modal-footer">
						 <button class="btn btn-light-dark font-weight-bold btn-icon btn-print"  type="button"><i class="flaticon2-printer"></i></button>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

