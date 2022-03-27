<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="form" data-link="Create_Joborder_Inpection_Stocks_Image"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Request Material</h2>
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
			                        <span class="nav-text mr-2">List of Request</span>
			                        <span class="label label-rounded label-primary request_material_pending">0</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#complete">
			                        <span class="nav-text">Recieved</span>
			                         <span class="label label-rounded label-success request_material_received">0</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#cancelled">
			                        <span class="nav-text">Cancelled</span>
			                         <span class="label label-rounded label-danger tbl_request_material_cancelled">0</span>
			                    </a>
			                </li>
			            </ul>
			        </div>
			    </div>
			    <div class="card-body">
			        <div class="tab-content link" data-link="tbl_request_material">
			            <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
			               	<table class="table table-bordered table-hover table-checkable " id="tbl_request_material_list"  style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>ITEM</th>
										<th>QTY</th>
										<th>TYPE</th>
										<th>DATE</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_request_material_received" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>ITEM</th>
										<th>QTY</th>
										<th>TYPE</th>
										<th>DATE</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_request_material_cancelled" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>ITEM</th>
										<th>QTY</th>
										<th>TYPE</th>
										<th>DATE</th>
									</tr>
								</thead>
							</table>
			            </div>


			        </div>
			    </div>
			</div>
			<!--end::Card-->
		</div>
	</div>
</div>
<!-- Modal-->

		