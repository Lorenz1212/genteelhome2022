<style type="text/css">
.table-scroll tbody {
  display: block;
  max-height: 300px;
  overflow-y: scroll;
}

.table-scroll thead, table tbody tr {
  display: table;
  width: 100%;
  table-layout: fixed;
}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-dashboard-superuser">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Dashboard</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
					</div>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->


	<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row">
			<div class="col-xl-4 col-md-4">
					   <div class="card card-custom gutter-b">
					   			<div class="card-header">
					   				<div class="card-title"><h4>Raw Materials</h4></div>
					   			</div>
					   			<div class="card-body">
					   				<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 400px">
						   				<table class="table table-bordered" id="table_rawmats">
													<thead>
															<tr>
																<th>Item Name</th>
															</tr>
													</thead>
													<tbody>
													</tbody>
											</table>
										</div>
					   			</div>
					   </div>
			</div>		
			<div class="col-xl-4 col-md-4">
					   <div class="card card-custom gutter-b">
					   			<div class="card-header">
					   				<div class="card-title"><h4>Office and Janitorial Supplies</h4></div>
					   			</div>
					   			<div class="card-body">
					   				<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 400px">
						   				<table class="table table-bordered" id="table_office">
													<thead>
														<tr>
															<th>Item Name</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
											</table>
										</div>
					   			</div>
					   </div>
			</div>	
			<div class="col-xl-4 col-md-4">
					   <div class="card card-custom gutter-b">
					   			<div class="card-header">
					   				<div class="card-title"><h4>Spare Parts</h4></div>
					   			</div>
					   			<div class="card-body">
					   				<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 400px">
						   				<table class="table table-bordered" id="table_supplies">
													<thead>
														<tr>
															<th>Item Name</th>
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
		<!--end::Row-->

		</div>
		<!--end::Dashboard-->
	</div>
	<!--end::Container-->
</div>
<!--end::Entry-->