<div class="content d-flex flex-column flex-column-fluid form" id="kt_content" data-table="data-cashposition" data-link="Cash_Position">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Cash Position</h2>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
				<div class="card card-custom gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<div class="card-toolbar">
							<ul class="nav nav-pills nav-pills-sm nav-dark-75">
								<li class="nav-item">
									<a class="nav-link py-2 px-4 active" id="action" data-action="weekly" data-toggle="tab" href="#day">Weekly</a>
								</li>
								<li class="nav-item">
									<a class="nav-link py-2 px-4" id="action" data-action="monthly" data-toggle="tab" href="#monthly">Monthly</a>
								</li>
								<li class="nav-item">	
									<div class="form-group mb-2">
									     <div class="input-group">
										     <div class="input-group-prepend">
										     	<span class="input-group-text" id="month_alert">MONTH</span></div>
										    	<select class="form-control" name="month" style="width:10%;"></select>
										     <div class="input-group-append">
										     	<span class="input-group-text" id="year_alert">YEAR</span></div>
										     <select class="form-control" name="year" style="width:10%;"></select>
										     <div class="input-group-append">
										     	<button type="button" class="btn btn-success" id="search" data-action="weekly">SEARCH</button></div>
										     <div class="input-group-append">
										     	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">EXPORT</button>
										     <div class="dropdown-menu">
											     <div role="separator" class="dropdown-divider" style="background-color:blue;"></div>
											    	<a href="#" class="dropdown-item"><span class="navi-icon"><i class="icon-md la la-file-excel-o"></i></span><span class="navi-text">Excel</span></a>
													<a href="#" class="dropdown-item"><span class="navi-icon"><i class="icon-md la la-file-pdf-o"></i></span><span class="navi-text"> PDF</span></a>
												</div>
											</div>
								     </div>
								</li>
							</ul>
						</div>
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark">Summary of Cash Position</span>
						</h3>
						
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body pt-2 pb-0 mt-n3">
						<div class="tab-content mt-5" id="myTabTables12">
						<!--begin::Tap pane-->
							<div class="tab-pane fade show active" id="day" role="tabpanel" aria-labelledby="day">
								<!--begin::Table-->
								<div class="view">
  									<div class="wrapper" id="tbl_cashposition_weekly">
									</div>
								</div>
							</br>
								<!--end::Table-->
							</div>
							<!--end::Tap pane-->
							<!--begin::Tap pane-->
							<div class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="monthly" he>
								<!--begin::Table-->
								<div class="view">
									<div class="wrapper" id="tbl_cashposition_monthly"></div>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Tap pane-->
						</div>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Advance Table Widget 7-->
		</div>
	</div>
</div>