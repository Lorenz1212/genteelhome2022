<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-return-finishproduct-view">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Return Product</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>

						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100">Request</span>
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
			<div class="col-xl-12">
				 <form class="form" data-link="Update_FinistProduct_Return">
						<div class="card card-custom gutter-b">
							<div class="card-header c-header">
							  <div class="card-title">
							  	<h3 class="card-label"></h3>
								  </div>
							 </div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-9">
										 <div class="form-group row">
											<div class="col-lg-6">
												<label>SALER ORDER</label>
													<select class="form-control" id="so"/>
														<option disabled="" selected="">SELECT S.O</option>
													</select>
												</div>
												<div class="col-lg-6">
												<label>COSTUMER NAME:</label>
												<input type="text" name="c_name" class="form-control" readonly="" />
											</div>
										</div>
									</div>
								</div>
								<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
									<div class="col-md-10">
										<div class="table-responsive">
											 <table class="table" id="tbl-return-finishproduct-request">
											</table>
										</div>
									</div>
								</div>
							</div>
					    </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>