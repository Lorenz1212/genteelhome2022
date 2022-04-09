<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-pre-order-request">
	<div class="form" data-link="Update_Pre_Order_Request"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Pre Order</h2>
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
			                        <span class="nav-text">REQUEST<span class="label label-rounded label-warning request_pre_order_pending">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link " data-toggle="tab" href="#approved">
			                        <span class="nav-icon"><i class="flaticon-list-3"></i></span>
			                        <span class="nav-text">APPROVED <span class="label label-rounded label-success request_pre_order_approved">0</span></span>
			                    </a>
			                </li>
			                 <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#rejected">
			                        <span class="nav-icon"><i class="flaticon-cancel"></i></span>
			                        <span class="nav-text">REJECTED <span class="label label-rounded label-danger request_pre_order_rejected">0</span></span>
			                    </a>
			                 </li>
			            </ul>
			        </div>
			    </div>
			    <div class="card-body">
			        <div class="tab-content link" data-link="tbl_preoder">
			        	 <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request">
			               <table class="table table-bordered table-hover table-checkable " id="tbl_preoder_request"  style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>ORDER NO.</th>
										<th>ITEM</th>
										<th>QUANTITY</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			        	 <div class="tab-pane fade " id="approved" role="tabpanel" aria-labelledby="approved">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_preoder_approved" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>ORDER NO.</th>
										<th>ITEM</th>
										<th>QUANTITY</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
									</tr>
								</thead>
							</table>
			            </div>
			           
			            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_preoder_rejected" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>ORDER NO.</th>
										<th>ITEM</th>
										<th>QUANTITY</th>
										<th>REQUESTOR</th>
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

