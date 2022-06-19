<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="category-list">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Categories</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<button type="button" class="btn btn-success btn-shadow font-weight-bold py-3 px-6 dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add New</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			        <a class="dropdown-item create-new-category" href="javascript:;" ><i class="flaticon2-plus icon-sm mr-2"></i> Add Category</a>
			        <a class="dropdown-item create-new-sub-category" href="javascript:;"><i class="flaticon2-plus icon-sm mr-2"></i> Add Sub Category</a>
			    </div>
			</div>
		</div>
	</div>
	<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="card card-custom card-stretch gutter-b">
						<div class="card-header  pt-7">
							
						</div>
						<div class="card-body pt-2">
							<table class="table table-hover" id="tbl_category">
								<thead>
									<tr>
										<th>IMAGE</th>
										<th>NAME</th>
										<th>DATE CREATED</th>
										<th>STATUS</th>
										<th>ACTION</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
						
<div id="view-sub-cateogy-modal" class="modal" style="overflow:auto;" aria-modal="false" role="dialog">
<div class="modal-dialog modal-xl">
	<div class="modal-content">
		<div class="modal-header py-5">
			<h5 class="modal-title cat-name"></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<i aria-hidden="true" class="ki ki-close"></i>
			</button>
		</div>
		<div class="modal-body">
				<div class="row">
					<div class="col-xl-12">
						<table class="table table-hover" id="tbl_sub_category">
							<thead>
								<tr>
									<th>Name</th>
									<th>Date Created</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>