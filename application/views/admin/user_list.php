<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="user-list">
	<div class="subheader py-2 py-lg-12 subheader-transparent form" id="kt_subheader" data-link="Users">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Account Users</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100">Update</span>
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
						<h3 class="card-label">List of Users</h3>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-hover" id="tbl_user_list">
						<thead>
							<tr>
								<th>NO</th>
								<th>USERNAME</th>
								<th>NAME</th>
								<th>DATE</th>
								<th>STATUS</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<!--end::Card-->
		</div>
	</div>
</div>
<!-- Modal-->
<div class="modal fade" id="view-details-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form  id="Update_Users">
            <div class="modal-body">
                 <div class="form-group row">
					   <div class="col-lg-4">
					    	<label>FIRST NAME:</label>
					    	<input type="text" class="form-control fname" name="fname" placeholder="Enter full name"/>
					   </div>
					   <div class="col-lg-4">
					    	<label>LAST NAME:</label>
					    	<input type="text" class="form-control lname" name="lname" placeholder="Enter full name"/>
					   </div>
					   <div class="col-lg-4">
					    	<label>MIDDLE NAME:</label>
					    	<input type="text" class="form-control mname" name="mname" placeholder="Enter full name"/>
					   </div>
					</div>
					<div class="form-group">
										<label>ROLE : </label>
										    <div class="checkbox-inline">
										        <label class="checkbox">
										            <input type="checkbox" class="role" name="role[]" value="1" />
										            <span></span>
										            Designer
										        </label>
										        <label class="checkbox">
										            <input type="checkbox" class="role"  name="role[]" value="2"/>
										            <span></span>
										            Production
										        </label>
										        <label class="checkbox">
										            <input type="checkbox" class="role"  name="role[]" value="3"/>
										            <span></span>
										            Supervisor
										        </label>
										         <label class="checkbox">
										            <input type="checkbox" class="role" name="role[]" value="4"/>
										            <span></span>
										            Sales
										        </label>
										    </div>
										</div>
										<div class="form-group">
										    <div class="checkbox-inline">
										       	<label class="checkbox">
										            <input type="checkbox" class="role" name="role[]" value="5"/>
										            <span></span>
										            Inventory
										        </label>
										       <label class="checkbox">
										            <input type="checkbox" class="role" name="role[]" value="6"/>
										            <span></span>
										            Accounting
										        </label>
										       <label class="checkbox">
										            <input type="checkbox" class="role" name="role[]" value="7"/>
										            <span></span>
										            Web Modifier
										        </label>
										        <label class="checkbox">
										            <input type="checkbox" class="role" name="role[]" value="8"/>
										            <span></span>
										            Administrator
										        </label>
										    </div>
										</div>
            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
	                <button type="button" class="btn btn-primary font-weight-bold saves">Save changes</button>
	            </div>
        </form>
        </div>
    </div>
</div>
