<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-dashboard-accounting">
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
<div class="d-flex flex-column-fluid">
   <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header  d-flex align-items-center justify-content-between"> 
                        <div class="card-title">
                            <span class="svg-icon svg-icon-primary svg-icon-2-5x mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M18.5,11 L5.5,11 C4.67157288,11 4,11.6715729 4,12.5 L4,13 L8.58578644,13 C8.85100293,13 9.10535684,13.1053568 9.29289322,13.2928932 L10.2928932,14.2928932 C10.7456461,14.7456461 11.3597108,15 12,15 C12.6402892,15 13.2543539,14.7456461 13.7071068,14.2928932 L14.7071068,13.2928932 C14.8946432,13.1053568 15.1489971,13 15.4142136,13 L20,13 L20,12.5 C20,11.6715729 19.3284271,11 18.5,11 Z" fill="#000000"/>
                                        <path d="M5.5,6 C4.67157288,6 4,6.67157288 4,7.5 L4,8 L20,8 L20,7.5 C20,6.67157288 19.3284271,6 18.5,6 L5.5,6 Z" fill="#000000"/>
                                    </g>
                                </svg>
                            </span>
                            <h4 class="card-label text-dark-75">Generated Sales & Expenses</h4>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist" id="chart2_li">
                                
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link py-2 px-4 active" data-toggle="tab" tba_option1 data-id="MONTH">
                                        <span class="nav-text font-size-sm">Month</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link py-2 px-4" data-toggle="tab" tba_option1 data-id="WEEK">
                                        <span class="nav-text font-size-sm">Week</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link py-2 px-4" data-toggle="tab" tba_option1 data-id="DAY">
                                        <span class="nav-text font-size-sm">Day</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                        <select class="form-control form-control-sm" id="chart1_options">
                                        </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart1" >
                            <div class="banner_wrapper">
                              <div class="banner_loader" style="height: 365px !important;"></div>
                            </div> 
                            <!-- <div class="animated-background" style="height: 100%"></div> -->
                        </div>
                        <!--end::Chart-->
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header  d-flex align-items-center justify-content-between"> 
                        <div class="card-title">
                            <span class="svg-icon svg-icon-primary svg-icon-2-5x mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M18.5,11 L5.5,11 C4.67157288,11 4,11.6715729 4,12.5 L4,13 L8.58578644,13 C8.85100293,13 9.10535684,13.1053568 9.29289322,13.2928932 L10.2928932,14.2928932 C10.7456461,14.7456461 11.3597108,15 12,15 C12.6402892,15 13.2543539,14.7456461 13.7071068,14.2928932 L14.7071068,13.2928932 C14.8946432,13.1053568 15.1489971,13 15.4142136,13 L20,13 L20,12.5 C20,11.6715729 19.3284271,11 18.5,11 Z" fill="#000000"/>
                                        <path d="M5.5,6 C4.67157288,6 4,6.67157288 4,7.5 L4,8 L20,8 L20,7.5 C20,6.67157288 19.3284271,6 18.5,6 L5.5,6 Z" fill="#000000"/>
                                    </g>
                                </svg>
                            </span>
                            <h4 class="card-label text-dark-75">Payout<!-- : <span class="text-primary">0</span> credits --> </h4>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist" id="chart2_li">
                                
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link py-2 px-4 active" data-toggle="tab" tba_option2 data-id="MONTH">
                                        <span class="nav-text font-size-sm">Month</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link py-2 px-4" data-toggle="tab" tba_option2 data-id="WEEK">
                                        <span class="nav-text font-size-sm">Week</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link py-2 px-4" data-toggle="tab" tba_option2 data-id="DAY">
                                        <span class="nav-text font-size-sm">Day</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                        <select class="form-control form-control-sm" id="chart2_options">
                                        </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart2" >
                            <div class="banner_wrapper">
                              <div class="banner_loader" style="height: 365px !important;"></div>
                            </div> 
                            <!-- <div class="animated-background" style="height: 100%"></div> -->
                        </div>
                        <!--end::Chart-->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-custom gutter-b">
                    <div class="card-header  d-flex align-items-center justify-content-between"> 
                        <div class="card-title">
                            <span class="svg-icon svg-icon-primary svg-icon-2-5x mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M18.5,11 L5.5,11 C4.67157288,11 4,11.6715729 4,12.5 L4,13 L8.58578644,13 C8.85100293,13 9.10535684,13.1053568 9.29289322,13.2928932 L10.2928932,14.2928932 C10.7456461,14.7456461 11.3597108,15 12,15 C12.6402892,15 13.2543539,14.7456461 13.7071068,14.2928932 L14.7071068,13.2928932 C14.8946432,13.1053568 15.1489971,13 15.4142136,13 L20,13 L20,12.5 C20,11.6715729 19.3284271,11 18.5,11 Z" fill="#000000"/>
                                        <path d="M5.5,6 C4.67157288,6 4,6.67157288 4,7.5 L4,8 L20,8 L20,7.5 C20,6.67157288 19.3284271,6 18.5,6 L5.5,6 Z" fill="#000000"/>
                                    </g>
                                </svg>
                            </span>
                            <h4 class="card-label text-dark-75">CODE<!-- : <span class="text-primary">0</span> credits --> </h4>
                        </div>
                        <!-- <div class="card-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist" id="chart2_li">
                                
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link py-2 px-4 active" data-toggle="tab" tba_option3 data-id="MONTH">
                                        <span class="nav-text font-size-sm">Month</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link py-2 px-4" data-toggle="tab" tba_option3 data-id="WEEK">
                                        <span class="nav-text font-size-sm">Week</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link py-2 px-4" data-toggle="tab" tba_option3 data-id="DAY">
                                        <span class="nav-text font-size-sm">Day</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                        <select class="form-control form-control-sm" id="chart3_options">
                                        </select>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart3" >
                            <div class="banner_wrapper">
                              <div class="banner_loader" style="height: 200px !important;"></div>
                            </div> 
                            <!-- <div class="animated-background" style="height: 100%"></div> -->
                        </div>
                        <!--end::Chart-->
                    </div>
                </div>
            </div>         
            
                    </div>
                </div>
        	</div>
    	</div>
	</div>
</div>