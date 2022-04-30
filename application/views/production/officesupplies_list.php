<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-officesupplies-list">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Raw Materials</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100 i-title"></span>
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
						<h3 class="card-label">List of <span class="i-title"></span></h3>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-hover table-checkable link" id="tbl_officesupplies" data-link="tbl_officesupplies" style="margin-top: 13px !important">
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
			</div>
			<!--end::Card-->
		</div>
	</div>
</div>
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
            <form class="form" id="Update_OfficeSupplies_Stocks" data-link="Update_OfficeSupplies_Stocks">
            <div class="modal-body">
               <div class="form-group">
			    <label>ITEM <span class="text-danger">*</span></label>
			    <input type="hidden" class="form-control" name="id" />
			    <input type="text" class="form-control" name="item" disabled=""/>
			   </div>
			   <div class="form-group">
			    <label>STOCKS <span class="text-danger">*</span></label>
			    <input type="text" class="form-control" name="stocks" id="release" disabled=""/>
			   </div>
			   <div class="form-group">
			    <label>Stocks Alert <span class="text-danger">*</span></label>
			    <input type="text" class="form-control" name="stocks_alert" id="alert" disabled=""/>
			   </div>
			    <div class="form-group" style="display: none;">
			    <label>STATUS <span class="text-danger">*</span></label>
			    <select type="text" class="form-control" name="status" disabled="">
			    	<option value="ACTIVE">ACTIVE</option>
			    	<option value="INACTIVE">INACTIVE</option>
			    </select>
			   </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
