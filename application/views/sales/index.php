
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-dashboard-sales">
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
	<!--begin::Container-->
	<div class="container">
		<!--begin::Dashboard-->
		<!--begin::Row-->
		<div class="row">
			<div class="col-xl-4 col-md-4">
				<div class="card card-custom card-stretch gutter-b card wave wave-animate-fast wave-success">
					<!--begin::Header-->
					<div class="card-header border-0">
						<h3 class="card-title font-weight-bolder text-dark">Notification</h3>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body pt-0">
						<div class="d-flex align-items-center mb-9 bg-light-warning rounded p-5">
							<span class="svg-icon svg-icon-warning mr-5">
								<span class="svg-icon svg-icon-lg">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									        <rect x="0" y="0" width="24" height="24"/>
									        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
									        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
									        <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
									        <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
									    </g>
									</svg>
								</span>
							</span>
							<div class="d-flex flex-column flex-grow-1 mr-2">
								<a href="<?php echo base_url()."gh/sales/online-order?".base64_encode('urlstatus=material request')."";?>" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Online Order Request</a>
							</div>
							<span class="font-weight-bolder text-warning py-1 font-size-lg" id="mr">0</span>
						</div>
						<div class="d-flex align-items-center bg-light-success rounded p-5 mb-9">
							<span class="svg-icon svg-icon-success mr-5">
								<span class="svg-icon svg-icon-lg">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
										</g>
									</svg>
								</span>
							</span>
							<div class="d-flex flex-column flex-grow-1 mr-2">
								<a href="<?php echo base_url()."gh/designer/collection";?>" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Collection Request</a>
							</div>
							<span class="font-weight-bolder text-success py-1 font-size-lg" id="sc">0</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-md-8">
				<div class="row">
					<div class="col-xl-12 col-md-12">
						<!--begin::Mixed Widget 10-->
						<div class="card card-custom gutter-b" >
							<!--begin::Body-->
							<div class="card-body d-flex align-items-center justify-content-between flex-wrap">
									<div class="card card-custom mb-12">
										<div class="card-body rounded p-0 d-flex" style="background-color:#DAF0FD;">
											<div class="d-flex flex-column flex-lg-row-auto w-auto w-lg-350px w-xl-450px w-xxl-500px p-10 p-md-20">
												<h1 class="font-weight-bolder text-dark">WELCOME</h1>
												<div class="font-size-h4 mb-8"><?php echo $this->session->userdata('fullname') ?></div>
											</div>
											<img class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover" src="<?php echo base_url()?>assets/media/svg/illustrations/progress.svg"></img>
										</div>
									</div>
						</div>
							<!--end::Body-->
						</div>
						<!--end::Mixed Widget 10-->
					</div>
				</div>
			</div>
		</div>
		<!--end::Row-->
		</div>
	</div>
</div>
<!--end::Entry-->