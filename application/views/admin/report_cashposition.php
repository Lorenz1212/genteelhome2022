<div class="content d-flex flex-column flex-column-fluid form" id="kt_content" data-table="reports-cashposition" data-link="Cash_Position">
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
									<a class="nav-link py-2 px-4" id="action" data-action="income-statement" data-toggle="tab" href="#income-statement">Income Statement</a>
								</li>
								<li class="nav-item mr-2">
									<div class="form-group">
										<select class="form-control" name="month"></select>
									</div>
								</li>
								<li class="nav-item mr-2">
									<div class="form-group">
										<select class="form-control" name="year"></select>
									</div>
								</li>
								<li class="nav-item">
									<div class="form-group">
										<button type="button" class="btn btn-success" id="search" data-action="daily"><i class="la la-search"></i> SEARCH</button>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body pt-2 pb-0 mt-n3">
						<div class="tab-content mt-5" id="myTabTables12">
						<!--begin::Tap pane-->
							<div class="tab-pane fade show active" id="day" role="tabpanel" aria-labelledby="day">
								<div class="view">
  									<div class="wrapper" id="tbl_cashposition_weekly"></div>
								</div>
							</div>
							<!--end::Tap pane-->
							<!--begin::Tap pane-->
							<div class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="monthly">
								<div class="view">
									<div class="wrapper" id="tbl_cashposition_monthly"></div>
								</div>
							</div>
							<!--end::Tap pane-->
							<!--begin::Tap pane-->
							<div class="tab-pane fade" id="income-statement" role="tabpanel" aria-labelledby="income-statement">
								<div class="table-responsive">
									<table class="table table-vertical-center" id="tbl_income_monthly">
									</table>
								</div>
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