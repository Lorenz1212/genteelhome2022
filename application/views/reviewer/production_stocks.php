<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-production-stocks">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Production Stocks</h2>
				</div>
			</div>
		</div>
	</div>
<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="card card-custom gutter-b">
			<div class="card-header">
				<div class="card-title">
						<span class="card-icon">
							<i class="flaticon2-psd text-primary"></i>
						</span>
						<h3 class="card-label">List of Materials</h3>
					</div>
				</div>
				<div class="card-body">
					<!--begin: Datatable-->
						<table class="table table-bordered table-hover table-checkable link" id="tbl_production_stocks" data-link="tbl_production_stockss" style="margin-top: 13px !important">
							<thead>
								<tr>
									<th>NO</th>
									<th>ITEM</th>
									<th>STOCKS</th>
									<th>ACTION</th>
								</tr>
							</thead>
						</table>
					<!--end: Datatable-->
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" id="Update_Production" data-link="Update_Production">
	            <div class="modal-body">
					 <div class="form-group">
						<label>ITEM</label>
						   <input type="hidden" name="id">
						   <input type="text" class="form-control form-control-solid" placeholder="Enter Item" id="items" name="item" disabled="" />
					</div>	
					<div class="form-group">
						<label>Stocks</label>
						   <input type="text" class="form-control form-control-solid" placeholder="Enter Stocks" id="stocks" name="stocks"/>
					</div>	
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary font-weight-bold type">Save changes</button>
	            </div>
       		</form>
        </div>
    </div>
</div>