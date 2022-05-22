<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="reports-sale-order">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Summary of Sales Order</h2>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->
<div class="d-flex flex-column-fluid">
	<div class="container">
				<div class="card card-custom gutter-b">
					<div class="card-header border-0 pt-10">
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
								<li class="nav-item mr-6">
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
					<div class="card-body pt-3 pb-0 mt-n3">
						<div class="tab-content" id="myTabTables12">
							<div class="tab-pane fade show active" id="day" role="tabpanel" aria-labelledby="day">
								<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 540px">
									<table class="table table-hover tables-striped" id="tbl_salesorder_daily">
										<thead>
											<tr class="table-success">
												<th>DATE</th>
												<th>NAME</th>
												<th>SALES ORDER</th>
												<th class="text-right">DOWNPAYMENT</th>
												<th class="text-right">SUBTOTAL</th>
												<th class="text-right">DISCOUNT</th>
												<th class="text-right">VAT(Output Tax)</th>
												<th class="text-right">SHIPPING FEE</th>
												<th class="text-right">TOTAL</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot></tfoot>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="weekly" role="tabpanel" aria-labelledby="weekly">
								<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 540px">
									<table class="table table-vertical-center table-hover tables-striped" id="tbl_salesorder_weekly">
										<thead>
											<tr>
												<th colspan="7" class="text-center">WEEKLY REPORT</th>
											</tr>
											<tr class="table-success">
												<th>WEEKS</th>
												<th class="text-right">DOWNPAYMENT</th>
												<th class="text-right">SUBTOTAL</th>
												<th class="text-right">DISCOUNT</th>
												<th class="text-right">VAT(Output Tax)</th>
												<th class="text-right">SHIPPING FEE</th>
												<th class="text-right">TOTAL</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot></tfoot>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="monthly">
								<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 540px">
									<table class="table table-vertical-center table-hover tables-striped" id="tbl_salesorder_monthly">
										<thead>
											<tr>
												<th colspan="7" class="text-center">MONTHLY REPORT</th>
											</tr>
											<tr class="table-success">
												<th>MONTH</th>
												<th class="text-right">DOWNPAYMENT</th>
												<th class="text-right">SUBTOTAL</th>
												<th class="text-right">DISCOUNT</th>
												<th class="text-right">VAT(Output Tax)</th>
												<th class="text-right">SHIPPING FEE</th>
												<th class="text-right">TOTAL</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot></tfoot>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="yearly" role="tabpanel" aria-labelledby="yearly">
								<div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 540px">
									<table class="table table-vertical-center table-hover tables-striped" id="tbl_salesorder_yearly">
										<thead>
											<tr>
												<th colspan="7" class="text-center">YEARLY REPORT</th>
											</tr>
											<tr class="table-success">
												<th>YEARS</th>
												<th class="text-right">DOWNPAYMENT</th>
												<th class="text-right">SUBTOTAL</th>
												<th class="text-right">DISCOUNT</th>
												<th class="text-right">VAT(Output Tax)</th>
												<th class="text-right">SHIPPING FEE</th>
												<th class="text-right">TOTAL</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot></tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>