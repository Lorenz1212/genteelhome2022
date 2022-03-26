<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-customer-concern-list">
	<div class="form" data-link="Update_Approval_Concern"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Customer Concern</h2>
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
			                    <a class="nav-link active" data-toggle="tab" href="#shipping">
			                        <span class="nav-text mr=2">Request</span>
			                        <span class="label label-rounded label-warning customer_request_count">0</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#delivered">
			                        <span class="nav-text">Approved</span>
			                        <span class="label label-rounded label-success customer_approved_count">0</span>
			                    </a>
			                </li>
			            </ul>
			   		 </div>
			   	</div>
			    <div class="card-body link" data-link="tbl_service_request_superuser">
			        <div class="tab-content">
			            <div class="tab-pane fade show active" id="shipping" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_service_request" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>SERIAL NO</th>
										<th>CUSTOMER</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			                <table class="table table-bordered table-hover table-checkable" id="tbl_service_approved" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>SERIAL NO</th>
										<th>CUSTOMER</th>
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
</div>
</div>
<!-- Modal-->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CUSTOMER CONCERN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="form" data-link="Update_Approval_Concern"></div>
            <div class="modal-body">
               <div class="row">
               	   <div class="col-xl-6">
	            		 <div class="form-group">
					    	<label>CUSTOMER NAME<span class="text-danger">*</span></label>
						    <input type="text" class="form-control"   id="customer" name="customer" disabled="" />
				   		</div>
			   		</div>
			   		 <div class="col-xl-6">
	            		 <div class="form-group">
					    	<label>DATE<span class="text-danger">*</span></label>
						    <input type="text" class="form-control" id="date_created" name="date_created" disabled="" />
				   		</div>
			   		</div>
            	</div>
            	<div class="row">
               	   <div class="col-xl-6">
	            		 <div class="form-group">
					    	<label>MOBILE NAME<span class="text-danger">*</span></label>
						    <input type="text" class="form-control" id="mobile" name="mobile" disabled="" />
				   		</div>
			   		</div>
			   		<div class="col-xl-6">
	            		 <div class="form-group">
					    	<label>EMAIL ADDRESS<span class="text-danger">*</span></label>
						    <input type="text" class="form-control" id="email" name="email" disabled="" />
				   		</div>
			   		</div>
			   		
            	</div>
            	<div class="row">
			   		<div class="col-xl-6">
	            		 <div class="form-group">
						    <a id="receipt" target="_blank" />( View Receipt )</a>
						    <a id="image" target="_blank" />( View Image )</a>
				   		</div>
			   		</div>
            	</div>
               <div class="form-group">
			    	<label>J.O NO. <span class="text-danger">*</span></label>
				    <input type="text" class="form-control"   id="production_no" name="production_no" disabled="" />
			   </div>
			   <div class="form-group">
				    <label>Reason <span class="text-danger">*</span></label>
				    <textarea type="text" class="form-control" id="concern" name="concern" rows="4" disabled></textarea>
			   </div>

            </div>
            <div class="modal-footer" id="btn_action">
            	
            </div>
        </div>
    </div>
</div>
