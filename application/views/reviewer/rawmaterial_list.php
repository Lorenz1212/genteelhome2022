<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-rawmats-list">
  <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Raw Matarials</h2>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->
	<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Row-->
								<div class="row">
									<div class="col-xl-12">
										<!--begin::Nav Panel Widget 1-->
										<div class="card card-custom gutter-b">
											<div class="card-header card-header-tabs-line">
											        <div class="card-toolbar">
											            <ul class="nav nav-tabs nav-bold nav-tabs-line">
											                <li class="nav-item">
											                    <a class="nav-link active" data-toggle="tab" href="#stocks">
											                        <span class="nav-icon"><i class="la la-list-ul"></i></span>
											                        <span class="nav-text mr-2">Stocks</span>
											                    </a>
											                </li>
											                <li class="nav-item">
											                    <a class="nav-link" data-toggle="tab" href="#out-stocks">
											                        <span class="nav-icon"><i class="flaticon-exclamation-1"></i></span>
											                        <span class="nav-text mr-2">Out of Stocks</span>
											                    </a>
											                </li>
											                <li class="nav-item">
											                    <a class="nav-link" data-toggle="tab" href="#new-stocks">
											                        <span class="nav-icon"><i class="flaticon-truck"></i></span>
											                        <span class="nav-text mr-2">New Stocks</span>
											                    </a>
											                </li>
											                <li class="nav-item">
											                    <a class="nav-link" data-toggle="tab" href="#release-stocks">
											                        <span class="nav-icon"><i class="fas fa-angle-double-down"></i></span>
											                        <span class="nav-text mr-2">Release Stocks</span>
											                    </a>
											                </li>
											            </ul>
											        </div>
											    </div>
											<!--begin::Body-->
											<div class="card-body">
												<!--begin::Nav Content-->
												<div class="tab-content link" data-link="tbl_rawmats">
													<div class="tab-pane active" id="stocks" role="tabpanel">
														<table class="table table-bordered table-hover table-checkable" id="tbl_rawmats" >
															<thead>
																<tr>
																	<th>No.</th>
																	<th>ITEM</th>
																	<th>STOCKS</th>
																	<th>ALERT</th>
																	<th>ACTION</th>
																</tr>
															</thead>
														</table>
													</div>
													<div class="tab-pane" id="out-stocks" role="tabpanel">
														<table class="table table-bordered table-hover table-checkable" id="tbl_rawmats_outofstocks">
															<thead>
																<tr>
																	<th>No.</th>
																	<th>ITEM</th>
																	<th>STOCKS</th>
																	<th>ALERT</th>
																	<th>ACTION</th>
																</tr>
															</thead>
														</table>
													</div>
													<div class="tab-pane" id="new-stocks" role="tabpanel">
														<table class="table table-bordered table-hover table-checkable" id="tbl_rawmats_new">
															<thead>
																<tr>
																	<th>No.</th>
																	<th>ITEM</th>
																	<th>STOCKS</th>
																	<th>DATE</th>
																</tr>
															</thead>
														</table>
													</div>
													<div class="tab-pane" id="release-stocks" role="tabpanel">
														<table class="table table-bordered table-hover table-checkable" id="tbl_rawmats_release" >
															<thead>
																<tr>
																	<th>No.</th>
																	<th>ITEM</th>
																	<th>STOCKS</th>
																	<th>DATE</th>
																</tr>
															</thead>
														</table>
													</div>
												</div>
												<!--end::Nav Content-->
											</div>
											<!--end::Body-->
										</div>
										<!--begin::Nav Panel Widget 1-->
									</div>
								</div>
								<!--end::Row-->
							</div>
						</div>
						<!--end::Row-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Entry-->
			</div>
			<!--end::Content-->

<!-- Modal-->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" id="Update_Rawmats_Stocks" data-link="Update_Rawmats_Stocks">
            <div class="modal-body">
               <div class="form-group">
			    <label>ITEM <span class="text-danger">*</span></label>
			    <input type="hidden" class="form-control" name="id" />
			    <input type="text" class="form-control" name="item" disabled="" />
			   </div>
			   <div class="form-group">
			    <label>STOCKS <span class="text-danger">*</span></label>
			    <input type="text" class="form-control" name="stocks" id="release" autocomplete="off" />
			   </div>
			   <div class="form-group">
			    <label>Stocks Alert <span class="text-danger">*</span></label>
			    <input type="text" class="form-control" name="stocks_alert" id="alert"  autocomplete="off" />
			   </div>
			    <div class="form-group">
			    <label>STATUS <span class="text-danger">*</span></label>
			    <select type="text" class="form-control" name="status" >
			    	<option value="1">ACTIVE</option>
			    	<option value="2">INACTIVE</option>
			    </select>
			   </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary font-weight-bold">Save changes</button>
            </div>
        </div>
    </div>
</div>
