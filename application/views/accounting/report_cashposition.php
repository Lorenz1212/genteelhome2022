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
									<a class="nav-link py-2 px-4" id="action" data-action="income-statement" data-toggle="tab" href="#income-statement">Income Statement</a>
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
											  <div class="input-group-append">
										     	<button type="button" class="btn btn-dark" data-toggle="modal" id="form-income" data-action="create" data-target="#formIncome">ADD NEW</button>
									     </div>
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
<div class="modal fade" id="formIncome" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel">Cash Position</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<div class="row">
            		<div class="col-xl-12">
		                <div class="form-group">
						    <label class="text-white">Name</label>
						    <input type="text" class="form-control form-control-lg" name="name" autocomplete="off"/>
					    </div>
				    </div>
			    </div>
			    <div class="row">
            		<div class="col-xl-6">
		                <div class="form-group">
						    <label class="text-white">Amount</label>
						    <input type="text" class="form-control form-control-lg" name="amount" id="amount"  placeholder="0.00" autocomplete="off" />
					    </div>
				    </div>
				    <div class="col-xl-6">
		                <div class="form-group">
						    <label class="text-white">Date</label>
						    <input type="text" class="form-control form-control-lg" id="date_position" name="date_position"  placeholder="mm/dd/YYYY" readonly="" autocomplete="off"/>
					    </div>
				    </div>
			    </div>
			     <div class="row">
            		<div class="col-xl-12">
		                <div class="form-group">
						    <label class="text-white">Select Credit or Debit</label>
						    <select class="form-control form-control-lg" name="type">
								<option value="1" selected>Credit</option>
								<option value="2">Debit</option>
							</select>
					    </div>
				    </div>
			    </div>
			      <div class="row">
            		<div class="col-xl-12">
		                <div class="form-group">
						    <label class="text-white">Categories</label>
						    <select class="form-control form-control-lg" name="cat_id" >
						    	<?php 
							       $query = $this->db->select('*')->from('tbl_category_income')->get();
						    		foreach($query->result() as $row){
						    			echo '<option value="'.$row->id.'">'.$row->name.'</option>';
						    		}
						    	?>
						    </select>
					    </div>
				    </div>
			    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success font-weight-bold save" data-action="create">Save changes</button>
            </div>
        </div>
    </div>
</div>