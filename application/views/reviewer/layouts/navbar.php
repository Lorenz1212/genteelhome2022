	<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile">
			<!--begin::Logo-->
		<!-- 	<a href="index.html">
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
			<div class="d-flex flex-row flex-column-fluid page">
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<div id="kt_header" class="header header-fixed">
						<div class="container d-flex align-items-stretch justify-content-between">
							<div class="d-flex align-items-stretch mr-3">
								<!--begin::Header Logo-->
<!-- 								<div class="header-logo">
									<a href="index.html">
										<img alt="Logo" src="<?php echo base_url() ?>assets/media/logos/logo-letter-9.png" class="logo-default max-h-40px" />
										<img alt="Logo" src="<?php echo base_url() ?>assets/media/logos/logo-letter-1.png" class="logo-sticky max-h-40px" />
									</a>
								</div> -->
								<!--end::Header Logo-->
								<!--begin::Header Menu Wrapper-->
								<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
									<!--begin::Header Menu-->
									<div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
										<!--begin::Header Nav-->
										<ul class="menu-nav">
											<li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here" data-menu-toggle="click" aria-haspopup="true">
												<a href="<?php echo base_url()."gh/superuser/index";?>" class="menu-link">
													<span class="menu-text">Dashboard</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
													<span class="menu-text mr-2">Request</span>
													<span class="label label-rounded label-primary request_count">0</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
													<ul class="menu-subnav">
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="menu-text">Purchase Request</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/superuser/purchase-request-stocks";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text mr-2">For Stocks</span>
																			<span class="label label-rounded label-primary purchase_stocks">0</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/superuser/purchase-request-project";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">For Project</span>
																			<span class="label label-rounded label-primary purchase_project">0</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="menu-text">Material Request</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/superuser/material-request-stocks";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">For Stocks</span>
																			<span class="label label-rounded label-primary material_request_pending_stocks">0</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/superuser/material-request-project";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text mr-2">For Project</span>
																			<span class="label label-rounded label-primary material_request_pending_project">0</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
															<a  href="<?php echo base_url()."gh/superuser/customer-concern";?>" class="menu-link">
																<span class="menu-text mr-2">Customer Concern</span>
																<span class="label label-rounded label-primary customer_concern_count">0</span>
															</a>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
															<a  href="<?php echo base_url()."gh/superuser/request-material-stocks";?>" class="menu-link">
																<span class="menu-text mr-2">Request Material For Stocks</span>
																<span class="label label-rounded label-primary request_material_pending">0</span>
															</a>
														</li>
													</ul>
												</div>
											</li>
											<!-- <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
													<span class="menu-text">Purchase For Stocks</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
													<ul class="menu-subnav">
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/superuser/purchase-stocks";?>" class="menu-link">
																<span class="menu-text">List of Stocks Request</span>
															</a>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/superuser/purchase-stocks-create";?>" class="menu-link">
																<span class="menu-text">Create Purchase Request</span>
															</a>
														</li>
													</ul>
												</div>
											</li> -->
											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
												<a href="<?php echo base_url()."gh/superuser/delivery-receipt-list";?>" class="menu-link">
														<span class="menu-text">Delivery Receipt</span>
														<span class="menu-desc"></span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
														<span class="menu-text">Job Order Master List</span>
														<span class="menu-desc"></span>
														<i class="menu-arrow"></i>
													</a>
													<div class="menu-submenu menu-submenu-classic menu-submenu-left">
														<ul class="menu-subnav">
														<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/superuser/joborder-masterlist-stocks";?>" class="menu-link">
																<span class="menu-text">For Stocks</span>
															</a>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/superuser/joborder-masterlist-project";?>" class="menu-link">
																<span class="menu-text">For Project</span>
															</a>
														</li>
													</ul>
												</div>
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
														<span class="menu-text">Return Item</span>
														<span class="menu-desc"></span>
														<i class="menu-arrow"></i>
													</a>
													<div class="menu-submenu menu-submenu-classic menu-submenu-left">
														<ul class="menu-subnav">
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/superuser/return-item-warehouse"?>" class="menu-link">
																<span class="menu-text">Return Item to Warehouse</span>
															</a>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/superuser/return-item-customer"?>" class="menu-link">
																<span class="menu-text">Return Item From Customer</span>
															</a>
														</li>
													</ul>
												</div>
											</li>

											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
													<span class="menu-text">Inventory</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
													<ul class="menu-subnav">
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="menu-text">Raw Material</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/superuser/rawmaterials";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">LIST</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/superuser/rawmaterial_create";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">CREATE</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
													<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="menu-text">Spare Parts</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/superuser/spareparts"?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">LIST</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/superuser/spareparts-create";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">CREATE</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
													<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="menu-text">Office & Janitorial Supplies</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/superuser/officesupplies";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">LIST</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="<?php echo base_url()."gh/superuser/officesupplies-create";?>" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">CREATE</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a  href="<?php echo base_url()."gh/superuser/supplier";?>" class="menu-link">
																<span class="menu-text">Supplier</span>
															</a>
														</li>
													</ul>
												</div>
											</li>
										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
													<span class="menu-text">Users Management</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
													<ul class="menu-subnav">
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/superuser/users?".base64_encode('urlstatus=pending')."";?>" class="menu-link ">
																<span class="menu-text">LIST</span>
															</a>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
															<a href="<?php echo base_url()."gh/superuser/user_create?".base64_encode('urlstatus=pending')."";?>" class="menu-link">
																<span class="menu-text">ADD NEW USER</span>
															</a>
														</li>
													</ul>
												</div>
											</li>
											<?php if($this->session->userdata('voucher') == 2) {
												echo '<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
														<a href="'.base_url().'gh/reviewer/voucher" class="menu-link">
															<span class="menu-text">Voucher</span>
														</a>
													</li>';}
											?>
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
								<!--begin::User-->
								<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item">
										<div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_user_toggle">
											<span class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
											<span class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4"><?php echo $this->session->userdata('fullname'); ?></span>
											<span class="symbol symbol-35">
												<span class="symbol-label text-white font-size-h5 font-weight-bold bg-white-o-30"><?php echo $this->session->userdata('letter'); ?></span>
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