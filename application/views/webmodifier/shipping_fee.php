<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-shipping">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Shipping Range</h2>
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
						<div class="col-xl-12 col-md-12">
							<!--begin::List Widget 16-->
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-header border-0 pt-7">
									<h3 class="card-title font-weight-bolder text-dark">List of Region</h3>
								</div>
								<div class="card-body pt-2">
									<table class="table table-bordered table-hover table-checkable link" id="tbl_shipping"  data-link="tbl_shipping">
											<thead>
												<tr>
													<th>REGION NAME</th>
													<th>SHIPPING RANGE</th>
													<th>ACTION</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
									</table>
								</div>
							</div>
							<!--end::List Widget 13-->
						</div>

					</div>
					<!--end::Row-->
				</div>
			</div>
		</div>
	<!--end::Content-->

<!-- Modal-->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<div class="form" data-link="Update_Shipping_Range"></div>
            	<div class="row justify-content-center">
					<div class="col-xl-12 col-xxl-6">
						 <div class="form-group">
							   <label>REGION</label>
							   <input type="hidden" id="id"/>
							   <input class="form-control" id="region" disabled />
					  	  </div>
						  <div class="form-group">
							   <label>SHIPPING RANGE</label>
							   <input class="form-control" id="shipping_range" placeholder="Ex. 1,000-1,500" />
						  </div>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save" class="btn btn-success font-weight-bolder ml-sm-auto my-1">UPDATE</button>
            </div>
        </div>
    </div>
</div>