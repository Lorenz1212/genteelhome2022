<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-cashfund">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Summary of Cash Fund </h2>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
		

	<!--begin::Advance Table: Widget 7-->
				<div class="card card-custom gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<div class="card-toolbar">
							<ul class="nav nav-pills nav-pills-sm nav-dark-75">
								<li class="nav-item">
									<a class="nav-link py-2 px-4 active" id="action" data-action="daily" data-toggle="tab" href="#day">Day</a>
								</li>
								<li class="nav-item">
									<a class="nav-link py-2 px-4" id="action" data-action="weekly" data-toggle="tab" href="#weekly">Week</a>
								</li>
								<li class="nav-item">
									<a class="nav-link py-2 px-4" id="action" data-action="monthly" data-toggle="tab" href="#monthly">Month</a>
								</li>
								<li class="nav-item">
									<a class="nav-link py-2 px-4" id="action" data-action="yearly" data-toggle="tab" href="#yearly">Yearly</a>
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
										<button type="button" class="btn btn-success" id="search_collection" data-action="daily"><i class="la la-search"></i> SEARCH</button>
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
								<!--begin::Table-->
								<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 540px">
									<table class="table  table-vertical-center"  id="tbl_cashfund_daily">
										<thead>
											<tr class="table-success">
												<th>DATE</th>
												<th>Trans #</th>
												<th>Cash Fund</th>
												<th class="text-right">Change</th>
												<th class="text-right">Refund</th>
												<th class="text-right">Amount</th>
												<th class="text-right">Vat(Output Tax)</th>
												<th class="text-right">Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Tap pane-->
							<!--begin::Tap pane-->
							<div class="tab-pane fade" id="weekly" role="tabpanel" aria-labelledby="weekly">
								<!--begin::Table-->
								<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 540px">
									<table class="table table-vertical-center"  id="tbl_cashfund_weekly">
										<thead>
											<tr class="table-success">
												<th>WEEKLY</th>
												<th>Cash Fund</th>
												<th class="text-right">Change</th>
												<th class="text-right">Refund</th>
												<th class="text-right">Amount</th>
												<th class="text-right">Vat(Output Tax)</th>
												<th class="text-right">Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Tap pane-->
							<!--begin::Tap pane-->
							<div class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="monthly">
								<!--begin::Table-->
								<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 540px">
									<table class="table  table-vertical-center"  id="tbl_cashfund_monthly">
										<thead>
											<tr class="table-success">
												<th>MONTH</th>
												<th>Cash Fund</th>
												<th class="text-right">Change</th>
												<th class="text-right">Refund</th>
												<th class="text-right">Amount</th>
												<th class="text-right">Vat(Output Tax)</th>
												<th class="text-right">Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Tap pane-->
							<!--begin::Tap pane-->
							<div class="tab-pane fade" id="yearly" role="tabpanel" aria-labelledby="yearly">
								<!--begin::Table-->
								<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 540px">
									<table class="table  table-vertical-center"  id="tbl_cashfund_yearly">
										<thead>
											<tr class="table-success">
												<th>YEAR</th>
												<th>Cash Fund</th>
												<th class="text-right">Change</th>
												<th class="text-right">Refund</th>
												<th class="text-right">Amount</th>
												<th class="text-right">Vat(Output Tax)</th>
												<th class="text-right">Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
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