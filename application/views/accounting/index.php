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
            <div class="col-lg-8 col-xl-8 col-md-8">
                <div class="card card-custom gutter-b">
                    <div class="card-header  d-flex align-items-center justify-content-between"> 
                        <div class="card-title">
                            <span class="svg-icon svg-icon-primary svg-icon-2-5x mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <rect fill="#000000" opacity="0.3" x="17" y="4" width="3" height="13" rx="1.5"/>
                                        <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"/>
                                        <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                                        <rect fill="#000000" opacity="0.3" x="7" y="11" width="3" height="6" rx="1.5"/>
                                    </g>
                                </svg>
                            </span>
                            <h4 class="card-label text-dark-75">Generated Sales & Expenses</h4>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist" id="chart2_li">
                         <!--        
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link py-2 px-4 active" data-toggle="tab" tba_option1 data-id="MONTH">
                                        <span class="nav-text font-size-sm">Month</span>
                                    </a>
                                </li> -->
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
             <div class="col-lg-4 col-xl-4 col-md-4">
                <!--begin::Mixed Widget 17-->
                                        <div class="card card-custom gutter-b card-stretch">
                                            <!--begin::Header-->
                                            <div class="card-header border-0 pt-5">
                                                <div class="card-title font-weight-bolder">
                                                    <div class="card-label">Yearly Sales & Expenses Stats</div>
                                                </div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body p-0 d-flex flex-column">
                                                <!--begin::Items-->
                                                <div class="flex-grow-1 card-spacer">
                                                    <div class="row  mt-5 mb-10">
                                                        <!--begin::Item-->
                                                        <div class="col">
                                                            <div class="d-flex align-items-center mr-2">
                                                                <!--begin::Symbol-->
                                                                <div class="symbol symbol-45 symbol-light-success mr-4 flex-shrink-0">
                                                                    <div class="symbol-label">
                                                                        <span class="svg-icon svg-icon-lg svg-icon-success">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                                                    <rect fill="#000000" opacity="0.3" transform="translate(11.646447, 12.853553) rotate(-315.000000) translate(-11.646447, -12.853553) " x="10.6464466" y="5.85355339" width="2" height="14" rx="1"/>
                                                                                    <path d="M8.1109127,8.90380592 C7.55862795,8.90380592 7.1109127,8.45609067 7.1109127,7.90380592 C7.1109127,7.35152117 7.55862795,6.90380592 8.1109127,6.90380592 L16.5961941,6.90380592 C17.1315855,6.90380592 17.5719943,7.32548256 17.5952502,7.8603687 L17.9488036,15.9920967 C17.9727933,16.5438602 17.5449482,17.0106003 16.9931847,17.0345901 C16.4414212,17.0585798 15.974681,16.6307346 15.9506913,16.0789711 L15.6387276,8.90380592 L8.1109127,8.90380592 Z" fill="#000000" fill-rule="nonzero"/>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--end::Symbol-->
                                                                <!--begin::Title-->
                                                                <div>
                                                                    <div class="font-size-h4 text-dark-75 font-weight-bolder total-gensales">0</div>
                                                                    <div class="font-size-sm text-muted font-weight-bold mt-1">Sales</div>
                                                                </div>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="col">
                                                            <div class="d-flex align-items-center mr-2">
                                                                <!--begin::Symbol-->
                                                                <div class="symbol symbol-45 symbol-light-danger mr-4 flex-shrink-0">
                                                                    <div class="symbol-label">
                                                                        <span class="svg-icon svg-icon-lg svg-icon-danger">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                                                    <rect fill="#000000" opacity="0.3" transform="translate(11.646447, 12.146447) rotate(-225.000000) translate(-11.646447, -12.146447) " x="10.6464466" y="5.14644661" width="2" height="14" rx="1"/>
                                                                                    <path d="M15.5961941,8.6109127 C15.5961941,8.05862795 16.0439093,7.6109127 16.5961941,7.6109127 C17.1484788,7.6109127 17.5961941,8.05862795 17.5961941,8.6109127 L17.5961941,17.0961941 C17.5961941,17.6315855 17.1745174,18.0719943 16.6396313,18.0952502 L8.50790332,18.4488036 C7.95613984,18.4727933 7.48939965,18.0449482 7.46540994,17.4931847 C7.44142022,16.9414212 7.86926539,16.474681 8.42102887,16.4506913 L15.5961941,16.1387276 L15.5961941,8.6109127 Z" fill="#000000" fill-rule="nonzero"/>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--end::Symbol-->
                                                                <!--begin::Title-->
                                                                <div>
                                                                    <div class="font-size-h4 text-dark-75 font-weight-bolder total-expenses">0</div>
                                                                    <div class="font-size-sm text-muted font-weight-bold mt-1">Expenses</div>
                                                                </div>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                        <!--end::Widget Item-->
                                                    </div>
                                                    <div class="row">
                                                        <!--begin::Item-->
                                                        <div class="col">
                                                            <div class="d-flex align-items-center mr-2">
                                                                <!--begin::Symbol-->
                                                                <div class="symbol symbol-45 symbol-light-warning mr-4 flex-shrink-0">
                                                                    <div class="symbol-label">
                                                                        <span class="svg-icon svg-icon-lg svg-icon-warning">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                                                        <rect fill="#000000" opacity="0.3" transform="translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) " x="12" y="8.8817842e-16" width="2" height="12" rx="1"/>
                                                                                        <path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) "/>
                                                                                        <rect fill="#000000" opacity="0.3" transform="translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) " x="10" y="12" width="2" height="12" rx="1"/>
                                                                                        <path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) "/>
                                                                                    </g>
                                                                                </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--end::Symbol-->
                                                                <!--begin::Title-->
                                                                <div>
                                                                    <div class="font-size-h4 text-dark-75 font-weight-bolder total-beginning">0</div>
                                                                    <div class="font-size-sm text-muted font-weight-bold mt-1">Beginning</div>
                                                                </div>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="col">
                                                            <div class="d-flex align-items-center mr-2">
                                                                <!--begin::Symbol-->
                                                                <div class="symbol symbol-45 symbol-light-primary mr-4 flex-shrink-0">
                                                                    <div class="symbol-label">
                                                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Barcode-read.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                                                    <rect fill="#000000" opacity="0.3" transform="translate(6.000000, 11.000000) rotate(-180.000000) translate(-6.000000, -11.000000) " x="5" y="5" width="2" height="12" rx="1"/>
                                                                                    <path d="M8.29289322,14.2928932 C8.68341751,13.9023689 9.31658249,13.9023689 9.70710678,14.2928932 C10.0976311,14.6834175 10.0976311,15.3165825 9.70710678,15.7071068 L6.70710678,18.7071068 C6.31658249,19.0976311 5.68341751,19.0976311 5.29289322,18.7071068 L2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 C2.68341751,13.9023689 3.31658249,13.9023689 3.70710678,14.2928932 L6,16.5857864 L8.29289322,14.2928932 Z" fill="#000000" fill-rule="nonzero"/>
                                                                                    <rect fill="#000000" opacity="0.3" transform="translate(18.000000, 13.000000) scale(1, -1) rotate(-180.000000) translate(-18.000000, -13.000000) " x="17" y="7" width="2" height="12" rx="1"/>
                                                                                    <path d="M20.2928932,5.29289322 C20.6834175,4.90236893 21.3165825,4.90236893 21.7071068,5.29289322 C22.0976311,5.68341751 22.0976311,6.31658249 21.7071068,6.70710678 L18.7071068,9.70710678 C18.3165825,10.0976311 17.6834175,10.0976311 17.2928932,9.70710678 L14.2928932,6.70710678 C13.9023689,6.31658249 13.9023689,5.68341751 14.2928932,5.29289322 C14.6834175,4.90236893 15.3165825,4.90236893 15.7071068,5.29289322 L18,7.58578644 L20.2928932,5.29289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(18.000000, 7.500000) scale(1, -1) translate(-18.000000, -7.500000) "/>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--end::Symbol-->
                                                                <!--begin::Title-->
                                                                <div>
                                                                    <div class="font-size-h4 text-dark-75 font-weight-bolder total-net">0</div>
                                                                    <div class="font-size-sm text-muted font-weight-bold mt-1">Net</div>
                                                                </div>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                        <!--end::Item-->
                                                    </div>
                                                </div>
                                                <!--end::Items-->
                                                <!--begin::Chart-->
                                                <!-- <div id="kt_mixed_widget_17_chart" class="card-rounded-bottom" data-color="primary" style="height: 200px"></div> -->
                                                <!--end::Chart-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Mixed Widget 17-->
            </div>
            <div class="col-lg-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header  d-flex align-items-center justify-content-between"> 
                        <div class="card-title">
                            <span class="svg-icon svg-icon-primary svg-icon-2-5x mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                                        <path d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    </g>
                                </svg>
                            </span>
                            <h4 class="card-label text-dark-75">Weekly Sales & Expenses Line Graph</h4>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist" id="chart2_li">
                                 <li class="nav-item">
                                        <select class="form-control form-control-sm" id="chart2_months">
                                            <option value="1">JANUARY</option>
                                            <option value="2">FEBRUARY</option>
                                            <option value="3">MARCH</option>
                                            <option value="4">APRIL</option>
                                            <option value="5">MAY</option>
                                            <option value="6">JUNE</option>
                                            <option value="7">JULY</option>
                                            <option value="8">AUGUST</option>
                                            <option value="9">SEPTEMBER</option>
                                            <option value="10">OCTOBER</option>
                                            <option value="11">NOVEMBER</option>
                                            <option value="12">DECEMBER</option>
                                        </select>
                                </li>
                                <li class="nav-item">
                                        <select class="form-control form-control-sm" id="chart2_year">
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
            <div class="col-lg-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header  d-flex align-items-center justify-content-between"> 
                        <div class="card-title">
                            <span class="svg-icon svg-icon-primary svg-icon-2-5x mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z" fill="#000000"/>
                                    </g>
                                </svg>
                            </span>
                            <h4 class="card-label text-dark-75">Expenses</h4>
                        </div>
                         <div class="card-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist" id="chart2_li">
                                 <li class="nav-item">
                                        <select class="form-control form-control-sm" id="chart3_months">
                                            <option value="1">JANUARY</option>
                                            <option value="2">FEBRUARY</option>
                                            <option value="3">MARCH</option>
                                            <option value="4">APRIL</option>
                                            <option value="5">MAY</option>
                                            <option value="6">JUNE</option>
                                            <option value="7">JULY</option>
                                            <option value="8">AUGUST</option>
                                            <option value="9">SEPTEMBER</option>
                                            <option value="10">OCTOBER</option>
                                            <option value="11">NOVEMBER</option>
                                            <option value="12">DECEMBER</option>
                                        </select>
                                </li>
                                <li class="nav-item">
                                        <select class="form-control form-control-sm" id="chart3_year">
                                        </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart3" >
                            <div class="banner_wrapper">
                              <div class="banner_loader" style="height: 365px !important;"></div>
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