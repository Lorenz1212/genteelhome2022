<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-customer-concern-list">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Customer's Concern</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100">Service</span>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
			<div class="card card-custom">
				<div class="card-header">
					<div class="card-title">
						<span class="card-icon">
							<i class="flaticon2-psd text-primary"></i>
						</span>
						<h3 class="card-label">List of Concerns</h3>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-hover table-checkable link" id="tbl_service_request" data-link="tbl_service_request" style="margin-top: 13px !important">
						<thead>
							<tr>
								<th>NO</th>
								<th>SERIAL NO</th>
								<th>CUSTOMER</th>
								<th>DATE</th>
								<th>STATUS</th>
								<th>ACTION</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<!--end::Card-->
		</div>
	</div>
</div>
<!-- Modal-->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				    <input type="hidden" class="form-control" id="id" name="id" />
				    <input type="text" class="form-control"   id="production_no" name="production_no" disabled="" />
			   </div>
			   <div class="form-group">
				    <label>Reason <span class="text-danger">*</span></label>
				    <textarea type="text" class="form-control" id="concern" name="concern" rows="4"></textarea>
			   </div>

            </div>
            <div class="modal-footer" id="btn_action1">
            	
            </div>
        </div>
    </div>
</div>
