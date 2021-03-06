	<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile">
			<!--begin::Logo-->
			<!-- <a href="index.html">
				<img alt="Logo" src="<?php echo base_url() ?>assets/media/logos/logo-letter-1.png" class="logo-default max-h-30px" />
			</a> -->
			<!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<button class="btn btn-icon btn-hover-transparent-white p-0 ml-3" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header header-fixed">
						<!--begin::Container-->
						<div class="container d-flex align-items-stretch justify-content-between">
							<!--begin::Left-->
							<div class="d-flex align-items-stretch mr-3">
								<!--begin::Header Logo-->
								<div class="header-logo">
									<!-- <a href="index.html">
										<img alt="Logo" src="<?php echo base_url() ?>assets/media/logos/logo-letter-9.png" class="logo-default max-h-40px" />
										<img alt="Logo" src="<?php echo base_url() ?>assets/media/logos/logo-letter-1.png" class="logo-sticky max-h-40px" />
									</a> -->
								</div>
								<!--end::Header Logo-->
								<!--begin::Header Menu Wrapper-->
								<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
									<!--begin::Header Menu-->
									<div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
										<!--begin::Header Nav-->
										<ul class="menu-nav">
											<li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here" data-menu-toggle="click" aria-haspopup="true">
												<a href="<?php echo base_url()."gh/designer/index";?>" class="menu-link">
													<span class="menu-text">Dashboard</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle mr-2">
													<span class="menu-text mr-2">Design </span>
													<span class="label label-rounded label-primary request_stocks_project">0</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
													<ul class="menu-subnav">
														<li class="menu-item" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/designer/design-for-stocks";?>" class="menu-link">
																<i class="menu-bullet menu-bullet-dot">
																	<span></span>
																</i>
																<span class="menu-text">For Stocks</span>
																<span class="label label-rounded label-warning request_stocks">0</span>
															</a>
														</li>
														<li class="menu-item" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/designer/design-for-project";?>" class="menu-link">
																<i class="menu-bullet menu-bullet-dot">
																	<span></span>
																</i>
																<span class="menu-text">For Project</span>
																<span class="label label-rounded label-warning request_project">0</span>
															</a>
														</li>
													</ul>
												</div>
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
													<span class="menu-text mr-2">Job Order</span>
													<span class="label label-rounded label-primary request_jo">0</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
													<ul class="menu-subnav">
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="menu-text">LIST OF ORDER</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/designer/joborder-stocks";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">For Stocks</span>
																			<span class="label label-rounded label-primary request_jo_stocks">0</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/designer/joborder-project";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">For Project</span>
																			<span class="label label-rounded label-primary request_jo_project">0</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="menu-text">CREATE JOB ORDER</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/designer/joborder-create-stocks";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">For Stocks</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/designer/joborder-create-project";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">For Project</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
													</ul>
												</div>
											</li>
										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
													<span class="menu-text mr-2">Request</span>
													<span class="label label-rounded label-primary request_preoder_customized">0</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
													<ul class="menu-subnav">
														<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/designer/request-pre-order";?>" class="menu-link">
																<span class="menu-text mr-2">Pre Order</span>
																<span class="label label-rounded label-primary request_pre_order_pending">0</span>
															</a>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/designer/request-customized";?>" class="menu-link">
																<span class="menu-text">For Customization</span>
																<span class="label label-rounded label-primary request_customized_pending">0</span>
															</a>
														</li>
													</ul>
												</div>
											</li>
										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
													<span class="menu-text mr-2">Request Materials</span>
													<span class="label label-rounded label-primary request_material_pending">0</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
													<ul class="menu-subnav">
														<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/designer/request-material-list";?>" class="menu-link ">
																<span class="menu-text">List of Material Request</span>
															</a>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/designer/request-material-create";?>" class="menu-link ">
																<span class="menu-text">Create Material Request</span>
															</a>
														</li>
													</ul>
												</div>
											</li>
										</ul>
										<!--end::Header Nav-->
									</div>
									<!--end::Header Menu-->
								</div>
								<!--end::Header Menu Wrapper-->
							</div>
							<!--end::Left-->
							<!--begin::Topbar-->
							<div class="topbar">
								<!--begin::Search-->
<!-- 								<div class="dropdown">
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-hover-transparent-white btn-lg btn-dropdown mr-1">
											<span class="svg-icon svg-icon-xl">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
														<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
													</g>
												</svg>
											</span>
										</div>
									</div>
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
										<div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
											<form method="get" class="quick-search-form">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<span class="svg-icon svg-icon-lg">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24" />
																		<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
																	</g>
																</svg>
															</span>
														</span>
													</div>
													<input type="text" class="form-control" placeholder="Search..." />
													<div class="input-group-append">
														<span class="input-group-text">
															<i class="quick-search-close ki ki-close icon-sm text-muted"></i>
														</span>
													</div>
												</div>
											</form>
											<div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
										</div>
									</div>
								</div> -->
								<!--end::Search-->
								<!--begin::Notifications-->
<!-- 								<div class="dropdown">
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse pulse-primary">
											<span class="svg-icon svg-icon-xl">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
														<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
													</g>
												</svg>
											</span>
											<span class="pulse-ring"></span>
										</div>
									</div>
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
										<form>
											<div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(<?php echo base_url() ?>assets/media/misc/bg-1.jpg)">
												<h4 class="d-flex flex-center rounded-top">
													<span class="text-white">User Notifications</span>
													<span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">23 new</span>
												</h4>
												<ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
													<li class="nav-item">
														<a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications">Alerts</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-toggle="tab" href="#topbar_notifications_events">Events</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs">Logs</a>
													</li>
												</ul>
											</div>
											<div class="tab-content">
												<div class="tab-pane active show p-8" id="topbar_notifications_notifications" role="tabpanel">
													<div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300" data-mobile-height="200">
														<div class="d-flex align-items-center mb-6">
															<div class="symbol symbol-40 symbol-light-primary mr-5">
																<span class="symbol-label">
																	<span class="svg-icon svg-icon-lg svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
																				<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
																			</g>
																		</svg>
																	</span>
																</span>
															</div>
															<div class="d-flex flex-column font-weight-bold">
																<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Cool App</a>
																<span class="text-muted">Marketing campaign planning</span>
															</div>
														</div>

														<div class="d-flex align-items-center mb-6">
															<div class="symbol symbol-40 symbol-light-success mr-5">
																<span class="symbol-label">
																	<span class="svg-icon svg-icon-lg svg-icon-success">
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z" fill="#000000" fill-rule="nonzero" transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
																				<path d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z" fill="#000000" opacity="0.3" />
																			</g>
																		</svg>
																	</span>
																</span>
															</div>
															<div class="d-flex flex-column font-weight-bold">
																<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Bruk Fitness</a>
																<span class="text-muted">Web Design &amp; Development</span>
															</div>
														</div>
													</div>
													<div class="d-flex flex-center pt-7">
														<a href="#" class="btn btn-light-primary font-weight-bold text-center">See All</a>
													</div>
												</div>
												<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
													<div class="navi navi-hover scroll my-4" data-scroll="true" data-height="300" data-mobile-height="200">
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-line-chart text-success"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">New report has been received</div>
																	<div class="text-muted">23 hrs ago</div>
																</div>
															</div>
														</a>
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-paper-plane text-danger"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">Finance report has been generated</div>
																	<div class="text-muted">25 hrs ago</div>
																</div>
															</div>
														</a>
													</div>
												</div>
												<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
													<div class="d-flex flex-center text-center text-muted min-h-200px">All caught up!
													<br />No new notifications.</div>
												</div>
											</div>
										</form>
									</div>
								</div> -->
								<!--end::Notifications-->
								<!--begin::Quick Actions-->
<!-- 								<div class="dropdown">
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1">
											<span class="svg-icon svg-icon-xl">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
														<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
														<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
														<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
													</g>
												</svg>
											</span>
										</div>
									</div>
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
										<div class="d-flex flex-column flex-center py-10 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(<?php echo base_url() ?>vendor/media/misc/bg-1.jpg)">
											<h4 class="text-white font-weight-bold">Quick Actions</h4>
											<span class="btn btn-success btn-sm font-weight-bold font-size-sm mt-2">23 tasks pending</span>
										</div>
										<div class="row row-paddingless">
											<div class="col-6">
												<a href="#" class="d-block py-10 px-5 text-center bg-hover-light border-right border-bottom">
													<span class="svg-icon svg-icon-3x svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<path d="M4.3618034,10.2763932 L4.8618034,9.2763932 C4.94649941,9.10700119 5.11963097,9 5.30901699,9 L15.190983,9 C15.4671254,9 15.690983,9.22385763 15.690983,9.5 C15.690983,9.57762255 15.6729105,9.65417908 15.6381966,9.7236068 L15.1381966,10.7236068 C15.0535006,10.8929988 14.880369,11 14.690983,11 L4.80901699,11 C4.53287462,11 4.30901699,10.7761424 4.30901699,10.5 C4.30901699,10.4223775 4.32708954,10.3458209 4.3618034,10.2763932 Z M14.6381966,13.7236068 L14.1381966,14.7236068 C14.0535006,14.8929988 13.880369,15 13.690983,15 L4.80901699,15 C4.53287462,15 4.30901699,14.7761424 4.30901699,14.5 C4.30901699,14.4223775 4.32708954,14.3458209 4.3618034,14.2763932 L4.8618034,13.2763932 C4.94649941,13.1070012 5.11963097,13 5.30901699,13 L14.190983,13 C14.4671254,13 14.690983,13.2238576 14.690983,13.5 C14.690983,13.5776225 14.6729105,13.6541791 14.6381966,13.7236068 Z" fill="#000000" opacity="0.3" />
																<path d="M17.369,7.618 C16.976998,7.08599734 16.4660031,6.69750122 15.836,6.4525 C15.2059968,6.20749878 14.590003,6.085 13.988,6.085 C13.2179962,6.085 12.5180032,6.2249986 11.888,6.505 C11.2579969,6.7850014 10.7155023,7.16999755 10.2605,7.66 C9.80549773,8.15000245 9.45550123,8.72399671 9.2105,9.382 C8.96549878,10.0400033 8.843,10.7539961 8.843,11.524 C8.843,12.3360041 8.96199881,13.0779966 9.2,13.75 C9.43800119,14.4220034 9.7774978,14.9994976 10.2185,15.4825 C10.6595022,15.9655024 11.1879969,16.3399987 11.804,16.606 C12.4200031,16.8720013 13.1129962,17.005 13.883,17.005 C14.681004,17.005 15.3879969,16.8475016 16.004,16.5325 C16.6200031,16.2174984 17.1169981,15.8010026 17.495,15.283 L19.616,16.774 C18.9579967,17.6000041 18.1530048,18.2404977 17.201,18.6955 C16.2489952,19.1505023 15.1360064,19.378 13.862,19.378 C12.6999942,19.378 11.6325049,19.1855019 10.6595,18.8005 C9.68649514,18.4154981 8.8500035,17.8765035 8.15,17.1835 C7.4499965,16.4904965 6.90400196,15.6645048 6.512,14.7055 C6.11999804,13.7464952 5.924,12.6860058 5.924,11.524 C5.924,10.333994 6.13049794,9.25950479 6.5435,8.3005 C6.95650207,7.34149521 7.5234964,6.52600336 8.2445,5.854 C8.96550361,5.18199664 9.8159951,4.66400182 10.796,4.3 C11.7760049,3.93599818 12.8399943,3.754 13.988,3.754 C14.4640024,3.754 14.9609974,3.79949954 15.479,3.8905 C15.9970026,3.98150045 16.4939976,4.12149906 16.97,4.3105 C17.4460024,4.49950095 17.8939979,4.7339986 18.314,5.014 C18.7340021,5.2940014 19.0909985,5.62999804 19.385,6.022 L17.369,7.618 Z" fill="#000000" />
															</g>
														</svg>
													</span>
													<span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Accounting</span>
													<span class="d-block text-dark-50 font-size-lg">eCommerce</span>
												</a>
											</div>
											<div class="col-6">
												<a href="#" class="d-block py-10 px-5 text-center bg-hover-light border-bottom">
													<span class="svg-icon svg-icon-3x svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<path d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z" fill="#000000" opacity="0.3" />
																<path d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z" fill="#000000" />
															</g>
														</svg>
													</span>
													<span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Administration</span>
													<span class="d-block text-dark-50 font-size-lg">Console</span>
												</a>
											</div>
											<div class="col-6">
												<a href="#" class="d-block py-10 px-5 text-center bg-hover-light border-right">
													<span class="svg-icon svg-icon-3x svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000" />
																<path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3" />
															</g>
														</svg>
													</span>
													<span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Projects</span>
													<span class="d-block text-dark-50 font-size-lg">Pending Tasks</span>
												</a>
											</div>
											<div class="col-6">
												<a href="#" class="d-block py-10 px-5 text-center bg-hover-light">
													<span class="svg-icon svg-icon-3x svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
															</g>
														</svg>
													</span>
													<span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Customers</span>
													<span class="d-block text-dark-50 font-size-lg">Latest cases</span>
												</a>
											</div>
										</div>
									</div>
								</div> -->
								<!--end::Quick Actions-->
								<!--begin::My Cart-->
<!-- 								<div class="dropdown">
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1">
											<span class="svg-icon svg-icon-xl">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
														<path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
													</g>
											</span>
										</div>
									</div>
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-xl dropdown-menu-anim-up">
										<form>
											<div class="d-flex align-items-center py-10 px-8 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(<?php echo base_url() ?>vendor/media/misc/bg-1.jpg)">
												<span class="btn btn-md btn-icon bg-white-o-15 mr-4">
													<i class="flaticon2-shopping-cart-1 text-success"></i>
												</span>
												<h4 class="text-white m-0 flex-grow-1 mr-3">My Cart</h4>
												<button type="button" class="btn btn-success btn-sm">2 Items</button>
											</div>
											<div class="scroll scroll-push" data-scroll="true" data-height="250" data-mobile-height="200">
												<div class="d-flex align-items-center justify-content-between p-8">
													<div class="d-flex flex-column mr-2">
														<a href="#" class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">iBlender</a>
														<span class="text-muted">Best kichen gadget in 2020</span>
														<div class="d-flex align-items-center mt-2">
															<span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 350</span>
															<span class="text-muted mr-1">for</span>
															<span class="font-weight-bold mr-2 text-dark-75 font-size-lg">5</span>
															<a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
																<i class="ki ki-minus icon-xs"></i>
															</a>
															<a href="#" class="btn btn-xs btn-light-success btn-icon">
																<i class="ki ki-plus icon-xs"></i>
															</a>
														</div>
													</div>
													<a href="#" class="symbol symbol-70 flex-shrink-0">
														<img src="<?php echo base_url() ?>vendor/media/stock-600x400/img-1.jpg" title="" alt="" />
													</a>
												</div>
												<div class="separator separator-solid"></div>
												<div class="d-flex align-items-center justify-content-between p-8">
													<div class="d-flex flex-column mr-2">
														<a href="#" class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">SmartCleaner</a>
														<span class="text-muted">Smart tool for cooking</span>
														<div class="d-flex align-items-center mt-2">
															<span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 650</span>
															<span class="text-muted mr-1">for</span>
															<span class="font-weight-bold mr-2 text-dark-75 font-size-lg">4</span>
															<a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
																<i class="ki ki-minus icon-xs"></i>
															</a>
															<a href="#" class="btn btn-xs btn-light-success btn-icon">
																<i class="ki ki-plus icon-xs"></i>
															</a>
														</div>
													</div>
													<a href="#" class="symbol symbol-70 flex-shrink-0">
														<img src="<?php echo base_url() ?>vendor/media/stock-600x400/img-2.jpg" title="" alt="" />
													</a>
												</div>
												<div class="separator separator-solid"></div>
												<div class="d-flex align-items-center justify-content-between p-8">
													<div class="d-flex flex-column mr-2">
														<a href="#" class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">CameraMax</a>
														<span class="text-muted">Professional camera for edge cutting shots</span>
														<div class="d-flex align-items-center mt-2">
															<span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 150</span>
															<span class="text-muted mr-1">for</span>
															<span class="font-weight-bold mr-2 text-dark-75 font-size-lg">3</span>
															<a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
																<i class="ki ki-minus icon-xs"></i>
															</a>
															<a href="#" class="btn btn-xs btn-light-success btn-icon">
																<i class="ki ki-plus icon-xs"></i>
															</a>
														</div>
													</div>
													<a href="#" class="symbol symbol-70 flex-shrink-0">
														<img src="<?php echo base_url() ?>vendor/media/stock-600x400/img-3.jpg" title="" alt="" />
													</a>
												</div>
												<div class="separator separator-solid"></div>
												<div class="d-flex align-items-center justify-content-between p-8">
													<div class="d-flex flex-column mr-2">
														<a href="#" class="font-weight-bold text-dark text-hover-primary">4DPrinter</a>
														<span class="text-muted">Manufactoring unique objects</span>
														<div class="d-flex align-items-center mt-2">
															<span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 1450</span>
															<span class="text-muted mr-1">for</span>
															<span class="font-weight-bold mr-2 text-dark-75 font-size-lg">7</span>
															<a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
																<i class="ki ki-minus icon-xs"></i>
															</a>
															<a href="#" class="btn btn-xs btn-light-success btn-icon">
																<i class="ki ki-plus icon-xs"></i>
															</a>
														</div>
													</div>
													<a href="#" class="symbol symbol-70 flex-shrink-0">
														<img src="<?php echo base_url() ?>vendor/media/stock-600x400/img-4.jpg" title="" alt="" />
													</a>
												</div>
											</div>
											<div class="p-8">
												<div class="d-flex align-items-center justify-content-between mb-4">
													<span class="font-weight-bold text-muted font-size-sm mr-2">Total</span>
													<span class="font-weight-bolder text-dark-50 text-right">$1840.00</span>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-7">
													<span class="font-weight-bold text-muted font-size-sm mr-2">Sub total</span>
													<span class="font-weight-bolder text-primary text-right">$5640.00</span>
												</div>
												<div class="text-right">
													<button type="button" class="btn btn-primary text-weight-bold">Place Order</button>
												</div>
											</div>
										</form>
									</div>
								</div> -->
								<!--end::My Cart-->
								<!--begin::Quick panel-->
<!-- 								<div class="topbar-item">
									<div class="btn btn-icon btn-hover-transparent-white btn-lg mr-1" id="kt_quick_panel_toggle">
										<span class="svg-icon svg-icon-xl">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
													<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
												</g>
											</svg>
										</span>
									</div>
								</div> -->
								<!--end::Quick panel-->
								<!--begin::Languages-->
<!-- 								<div class="dropdown">
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1">
											<img class="h-20px w-20px rounded-sm" src="<?php echo base_url() ?>assets/media/svg/flags/226-united-states.svg" alt="" />
										</div>
									</div>
									<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
										<ul class="navi navi-hover py-4">
											<li class="navi-item">
												<a href="#" class="navi-link">
													<span class="symbol symbol-20 mr-3">
														<img src="<?php echo base_url() ?>assets/media/svg/flags/226-united-states.svg" alt="" />
													</span>
													<span class="navi-text">English</span>
												</a>
											</li>
										</ul>
									</div>
								</div> -->
								<!--end::Languages-->
								<!--begin::User-->
								<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item">
										<div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_user_toggle">
											<span class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
											<span class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4"><?php echo $this->appinfo->creative('_DESIGNER_FNAME') ?></span>
											<span class="symbol symbol-35">
												<?php 
												echo ($this->appinfo->creative('_DESIGNER_PROFILE')=="default.png") ? '<span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30 text-uppercase">'.$this->appinfo->creative('_DESIGNER_FNAME')[0].'</span>' : '<div class="symbol-label" style="background-image:url('.base_url().'assets/images/profile/'.$this->appinfo->creative('_DESIGNER_PROFILE').')"></div>';
												?>
											</span>
										</div>
									</div>
									<!--end::Toggle-->
								</div>
								<!--end::User-->
							</div>
							<!--end::Topbar-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->