<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-voucher-list">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Voucher</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Set Up</a>
					</div>
				</div>
			</div>
			<div class="d-flex align-items-center">
					<button type="button" class="btn btn-white font-weight-bold py-3 px-6" data-toggle="modal" id="form-request" data-id="0" data-action="create" data-target="#requestModal"><i class="ki ki-plus text-success"></i> Create Voucher</button>
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
						</div>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover table-checkable link" id="tbl_voucher" data-link="tbl_voucher" style="margin-top: 13px !important">
							<thead>
								<tr>
									<th>NO</th>
									<th>VOUCHER NO</th>
									<th>DISCOUNT</th>
									<th>DATE FROM</th>
									<th>DATE TO</th>
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
	<!--end::Content-->

<!-- Modal-->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
					 <div class="modal-header">
		                <h5 class="modal-title"></h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <i aria-hidden="true" class="ki ki-close"></i>
		                </button>
		             </div>
		             <form class="form" id="Create_Update_Voucher" data-link="Create_Update_Voucher">
	            	<div class="modal-body">
						  <div class="form-group row">
						   <div class="col-lg-12">
							    <label>Voucher Code:</label>
							    <input type="hidden"  id="action" readonly=""/>
							    <input type="text" class="form-control" id="voucher" name="voucher" readonly="" />
						   </div>
						   <div class="col-lg-12">
							    <label>Discount</label>
							    <input type="text" class="form-control" id="discount" name="discount" placeholder="Enter Discount %" required="" autocomplete="off" />
						   </div>
						   <div class="col-lg-6">
							    <label>Date From</label>
							    <input type="text" class="form-control" id="date_from" name="date_from" required=""  autocomplete="off"/>
						   </div>
						   <div class="col-lg-6">
							    <label>Date To</label>
							    <input type="text" class="form-control" id="date_to" name="date_to" required=""  autocomplete="off"/>
						   </div>
						  </div>
					</div>
					<div class="modal-footer">
						<button type="submit"  class="btn btn-success">Save</button>
					</div>
				</div>
				</form>
	    	</div>
	  	</div>
  	</div>
</div>

