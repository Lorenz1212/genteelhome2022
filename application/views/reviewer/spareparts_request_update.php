<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-spareparts-request-view">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5"><span id="request_id_update" data-id="<?php echo $id; ?>"></span>Office & Janitorial Supplies Request</h2>
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
				 <form class="form" data-link="Update_SpareParts_Request">
				 		<input type="hidden" name="request_id" value="<?php echo $id ?>">
						<div class="card card-custom gutter-b">
							<div class="card-header c-header">
							  <div class="card-title">
							  	<h3 class="card-label">REQUEST ID: <?php echo $id; ?></h3>
								  </div>
							 </div>
							<div class="card-body p-0">
								<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
									<div class="col-md-9">
										<div class="table-responsive">
											 <table class="table" id="tbl-sprareparts-Request">
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