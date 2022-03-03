<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-customer">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap form" data-link="Customer">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Customer List</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
					<button class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2" data-toggle="modal" id="form-request" data-action="create" data-target="#requestModal">Add Customer</button>
			</div>
		</div>
	</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
			<div class="container">
				<div class="card card-custom gutter-b">
					 <div class="card-header">
					 </div>
					 <div class="card-body">
					  <table class="table table-bordered table-hover table-checkable link" id="tbl_customer_list" data-link="tbl_customer_list" style="margin-top: 13px !important">
						<thead>
							<tr>
								<th>No</th>
								<th>CUSTOMER</th>
								<th>MOBILE NO</th>
								<th>EMAIL</th>
								<th>DATE</th>
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
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        	 <div class="modal-header">
                <h5 class="modal-title"><span id="order_no"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
    	 	 <div class="modal-body">
    			<div class="form-group row">
				   <div class="col-lg-6">
				    <label>First Name:</label>
				    	<input type="text" class="form-control" name="firstname" autocomplete="off" />
				   </div>
				   <div class="col-lg-6">
				    	<label>Last Name:</label>
				    	<input type="text" class="form-control" name="lastname" autocomplete="off" />
				   </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-lg-6">
					     <label>Email Address:</label>
					     <input type="email" class="form-control email-focus" name="email" autocomplete="off" />
					     <span class="text-danger"></span>
				   </div>
				   <div class="col-lg-6">
				      <label>Mobile No:</label>
				      <input type="text" class="form-control" name="mobile" autocomplete="off" />
				   </div>
				  </div>
				  <div class="form-group row">
				   <div class="col-lg-12">
				     <label>Address:</label>
				     <input type="text" class="form-control" name="address" autocomplete="off" />
				   </div>
				   <div class="col-lg-6">
				     <label>City:</label>
				     <input type="text" class="form-control" name="city" autocomplete="off" />
				   </div>
				   <div class="col-lg-6">
				     <label>Province:</label>
				     <input type="text" class="form-control" name="province" autocomplete="off" />
				   </div>
				      <div class="col-lg-12">
				    	 <label>Region:</label>
					      <select type="text"  class="form-control region-option"  name="region">
					 	  </select>
				      </div>
				  </div>
			   </div>
			 <div class="modal-footer">
			 	<button type="button" class="btn btn-success save" data-action="create">SAVE</button>
			 </div>
	    </div>
	</div>
</div>
