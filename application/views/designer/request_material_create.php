<style type="text/css">
.table-scroll tbody {
  display: block;
  max-height: 400px;
  overflow-y: scroll;
}

.table-scroll thead, table tbody tr {
  display: table;
  width: 100%;
  table-layout: fixed;
}
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-request-material-create">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Create Material Request</h2>
				</div>
			</div>
		</div>
	</div>

<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-xxl-3 col-md-3">
				<div class="card card-custom gutter-b">
				    <div class="card-header card-header-tabs-line">
				        <div class="card-toolbar">
				            <div class="card-title">
									<h3 class="card-label">Materials</h3>
							 </div>
				        </div>
				    </div>
			   		<div class="card-body">
			   			<form class="form" id="Create_Request_Material" data-link="Create_Request_Material" accept-charset="utf-8"  enctype="multipart/form-data">
			       		 <div class="row">
			       		 	<div class="col-lg-12 col-xl-12 col-md-12">
							    <div class="form-group">
								   <label>Type</label>
									   <select class="form-control form-control-solid form-control-lg selectpicker" data-live-search="true" name="type"/>
									     <option value="" disabled="" selected="">Select Type</option>
									     <option value="1">Raw Materials</option>
									     <option value="2">Office & Janitorial Supplies</option>
									     <option value="3">Spare Parts</option>
									  </select>
								</div>
							</div>
						 	  <div class="col-lg-12 col-xl-12 col-md-12">
							    <div class="form-group">
								   <label>ITEM</label>
									   <select class="form-control form-control-solid form-control-lg"  id="item" name="item_no"/>
									     <option value="" disabled="" selected="">Select Item</option>
									  </select>
								</div>
							</div>	

							<div class="col-lg-12 col-xl-12 col-md-12">
								 <div class="form-group">
								   <label>QTY</label>
								   <input type="number" min="1" class="form-control form-control-solid form-control-lg" name="qty" placeholder="Enter Quantity" autocomplete="off" required/>
							    </div>
							</div>
							<div class="col-lg-12 col-xl-12 col-md-12">
								<div class="form-group">
									<button type="button" class="btn btn-dark font-weight-bold btn-lg btn-square add_item">Add Item</button>
								</div>
							</div>
						</div>
						

			        </div>
			    </div>
			    <div class="row">
					<div class="col-lg-12 col-xl-12 col-md-12">
						<div class="card card-custom gutter-b">
							<button type="button" class="btn btn-light-success font-weight-bold btn-lg btn-square Create_Request_Material">SUBMIT REQUEST</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-xxl-8 col-md-8">
				<div class="row">
								<div class="col-xl-12 col-xxl-12 col-md-12">
									<div class="card card-custom gutter-b">
									    <div class="card-header card-header-tabs-line">
									       <div class="card-title">
												<h3 class="card-label">Material List</h3>
											</div>
									    </div>
								   		<div class="card-body">
								       		<table class="table table-scroll" id="kt_material_table">
												<thead>
													<tr>
														<th class="text-left">ITEM</th>
														<th class="text-right">QTY</th>
														<th class="text-right">TYPE</th>
														<th class="text-right">ACTION</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
								        </div>
								    </div>
								</div>
							</div>
						</div>		
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>