<style type="text/css">
.table-scroll tbody {
  display: block;
  max-height: 460px;
  overflow-y: scroll;
}

.table-scroll thead, table tbody tr {
  display: table;
  width: 100%;
  table-layout: fixed;
}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-category">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Category</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Set Up</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end::Subheader-->
<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">
				<!--begin::Row-->
					<div class="row">
						<div class="col-xl-4">
							<!--begin::List Widget 16-->
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-header border-0 pt-7">
									<h3 class="card-title font-weight-bolder text-dark">CATEGORY</h3>
								</div>
								<div class="card-body pt-2">
									<table class="table table-scroll" id="Table_Category">
											<thead>
												<tr>
													<th>NAME</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
									</table>
								</div>
							</div>
							<!--end::List Widget 13-->
						</div>
						<div class="col-xl-4">
							<!--begin::List Widget 17-->
							<div class="card card-custom card-stretch gutter-b">
									<div class="card-header border-0 pt-7">
									<h3 class="card-title font-weight-bolder text-dark">SUB CATEGORY</h3>
									<div class="card-toolbar">
							            <button type="button" class="btn btn-sm btn-dark font-weight-bold" id="form-request" data-toggle="modal" data-target="#exampleModal" data-id="0" data-action="sub_caterogy">
							                <i class="flaticon2-cube"></i> CREATE
							            </button>
							        </div>
								</div>
								<div class="card-body pt-4">
										<table class="table table-scroll" id="Table_Subcategory">
												<thead>
													<tr>
														<th>NAME</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
												</tbody>
										</table>
									<div>
								</div>
							</div>
						</div>
							<!--end::List Widget 17-->
						</div>
						<div class="col-xl-4">
							<!--begin::List Widget 18-->
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-header border-0 pt-7">
									<h3 class="card-title font-weight-bolder text-dark">PRODUCT</h3>
								</div>
								<div class="card-body pt-1">
									<table class="table table-scroll" id="Table_ProductCategory">
											<thead>
												<tr>
													<th>NAME</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
									</table>
								</div>
							</div>
							<!--end::List Widget 18-->
						</div>
					</div>
					<!--end::Row-->
				</div>
			</div>
		</div>
	<!--end::Content-->

<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" id="Create_SubCategory" data-link="Create_SubCategory" enctype="multipart/form-data" accept-charset="utf-8">
	            <div class="modal-body">
					<div class="row justify-content-center">
						<div class="col-xl-6 col-xxl-6">
								 <div id="form_data"></div>
							</div>
						</div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-dark font-weight-bold type">Save changes</button>
		            </div>
       		</form>	
        </div>
    </div>
</div>

<div class="modal fade" id="ProductModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="subid" style="display:none;"></span><span id="subname"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
           </div>
        <div class="modal-body">
			<div class="row justify-content-center" >
				<div class="col-xl-12 col-xxl-12">
					<form class="form" data-link="Create_ProductCategory">
						<table class="table table-scroll" id="Table_Product">
									<thead>
										<tr>
											<th>NAME</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									</tbody>
							</table>
						</form>		
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<div class="modal fade" id="ProductModalView" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
        <div class="modal-body">
			<div class="row justify-content-center" >
				<div class="col-xl-12 col-xxl-12">
						<table class="table table-scroll" id="Table_Product_View">
							<thead>
								<tr>
									<th>NAME</th>
									<th></th>
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
