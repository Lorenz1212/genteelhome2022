<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-collection">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Sales collection</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
					<button class="btn btn-light-success font-weight-bolder btn-sm" data-toggle="modal" data-target="#create-collection"><i class="flaticon-add-circular-button"></i> Create sales collection</button>
				</div>
		</div>
	</div>
<!--end::Subheader-->
	<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="card card-custom gutter-b">
					<div class="card-header card-header-tabs-line">
			        <div class="card-toolbar">
						<ul class="nav nav-tabs nav-bold nav-tabs-line">
			                <li class="nav-item">
			                    <a class="nav-link active" data-toggle="tab" href="#request">
			                    	<span class="nav-icon"><i class="flaticon-exclamation-1"></i></span>
			                        <span class="nav-text">Request <span class="label label-rounded label-warning collection_request">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#approved">
			                    	<span class="nav-icon"><i class="la la-check-circle"></i></span>
			                        <span class="nav-text">Approved <span class="label label-rounded label-primary collection_approved">0</span></span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#cancelled">
			                    	<span class="nav-icon"><i class="la la-times-circle-o"></i></span>
			                        <span class="nav-text">Cancelled <span class="label label-rounded label-danger collection_cancelled">0</span></span>
			                    </a>
			                </li>
			            </ul>
					</div>
			   	</div>
			    <div class="card-body">
						<div class="tab-content">
							<div class="tab-pane active" id="request" role="tabpanel">
								<table class="table table-bordered table-hover table-checkable" id="tbl_collection_request">
									<thead>
										<tr>
											<th>TRACKING NO</th>
											<th>CUSTOMER</th>
											<th>BANK</th>
											<th>AMOUNT</th>
											<th>DATE</th>
											<th>STATUS</th>
											<th>ACTION</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="tab-pane" id="approved" role="tabpanel">
								<table class="table table-bordered table-hover table-checkable" id="tbl_collection_approved">
									<thead>
										<tr>
											<th>TRACKING NO</th>
											<th>CUSTOMER</th>
											<th>BANK</th>
											<th>AMOUNT</th>
											<th>DATE</th>
											<th>STATUS</th>
											<th>ACTION</th>
										</tr>
									</thead>
								</table>
							</div>
										<div class="tab-pane" id="cancelled" role="tabpanel">
											<table class="table table-bordered table-hover table-checkable" id="tbl_collection_cancelled">
												<thead>
													<tr>
														<th>TRACKING NO</th>
														<th>CUSTOMER</th>
														<th>BANK</th>
														<th>AMOUNT</th>
														<th>DATE</th>
														<th>STATUS</th>
														<th>ACTION</th>
													</tr>
												</thead>
											</table>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        	 <div class="modal-header">
                <h5 class="modal-title"><span id="order_no"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
    	 	 <div class="modal-body">
    			<div class="form-group row">
				   <div class="col-lg-12">
				    <label>Customer:</label>
				    <input type="hidden" id="id" readonly="" />
				    <input type="text" id="customer" class="form-control" disabled="" />
				   </div>
				  </div>
				  <div class="form-group row">
				   <div class="col-lg-6">
				    <label>Email Address:</label>
				     <input type="email"  id="email" class="form-control" disabled=""/>
				   </div>
				   <div class="col-lg-6">
				    <label>Mobile No:</label>
				     <input type="text"  id="mobile" class="form-control" disabled=""/>
				   </div>
				  </div>
				   <div class="form-group row">
				   <div class="col-lg-12">
				    <label>Tracking No:</label>
				     <input type="text" id="order_nos" class="form-control" disabled=""/>
				   </div>
				  </div>
				  <div class="form-group row">
				   <div class="col-lg-6">
				    <label>Deposite Date:</label>
				     <input type="text" id="date_deposite" class="form-control" disabled=""/>
				   </div>
				   <div class="col-lg-6">
				    <label>Amount Deposite:</label>
				     <input type="text" id="amounts" class="form-control" disabled=""/>
				   </div>
				  </div>
				  <div class="form-group row">
				   <div class="col-lg-6">
				    <label>Deposited/ Transfered Bank:</label>
				    <input type="text" id="bank" class="form-control" disabled="" />
				   </div>
				   </div>
				  </div>
			 <div class="modal-footer">
			 	<button type="button" class="btn btn-success btn_action" id="Update_Deposit_Approved" data-id="0">APPROVED</button>
			 </div>
	    </div>
	</div>
</div>


<div class="modal fade" id="create-collection" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        	 <div class="modal-header">
                <h5 class="modal-title">Create Sales Collection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form class="form" id="Create_Deposit" data-link="Create_Deposit" enctype="multipart/form-data" accept-charset="utf-8">
            		<div class="form-group row">
            			<div class="col-lg-6">
						    <label>Firstname:</label>
						    <input type="text" name="firstname" class="form-control"  placeholder="Enter Firstname" autocomplete="off" />
					    </div>
					    <div class="col-lg-6">
						    <label>Lastname:</label>
						    <input type="text"  name="lastname" class="form-control" placeholder="Enter Lastname" autocomplete="off"/>
						</div>
            		</div>
            		 <div class="form-group row">
					   <div class="col-lg-6">
					    <label>Email Address:</label>
					     <input type="email"  name="email" class="form-control" placeholder="Enter your Email" autocomplete="off"/>
					   </div>
					   <div class="col-lg-6">
					    <label>Mobile No:</label>
					     <input type="text"  name="mobile" maxlength="11" class="form-control" placeholder="Enter your Mobile No" autocomplete="off"/>
					   </div>
					  </div>
					  <div class="form-group row">
					   <div class="col-lg-12">
					    <label>Tracking No:</label>
					     <input type="text"  name="order_no" class="form-control" placeholder="Enter your Tracking Number"  autocomplete="off"/>
					   </div>
					  </div>
					  <div class="form-group row">
					   <div class="col-lg-6">
					    <label>Deposite Date:</label>
					     <input type="date" name="date_deposite"  class="form-control" placeholder="MM/DD/YYYY" autocomplete="off"/>
					   </div>
					   <div class="col-lg-6">
					    <label>Amount Deposite:</label>
					     <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter your Mobile No"  autocomplete="off"/>
					   </div>
					  </div>
					  <div class="form-group row">
					   <div class="col-lg-6">
						    <label>Deposited/ Transfered Bank:</label>
						    <select type="text" name="bank" class="form-control">
	                            <option value="" disabled="" selected="">SELECT OPTION</option>
	                            <option value="BPI">BPI</option>
	                            <option value="BDO">BDO</option>
	                            <option value="PSBANK">PSBANK</option>
	                            <option value="METRO BANK">METRO BANK</option>
	                            <option value="CITI BANK">CITI BANK</option>
	                            <option value="CHINA BANK">CHINA BANK</option>
	                            <option value="PAYMAYA">PAYMAYA</option>
	                            <option value="GCASH">GCASH</option>
	                        </select>
					   </div>
						<div class="col-lg-6">
					    	 <label>Upload Deposit Slip:</label>
						     <input type="file" name="image" accept="image/*" required />
						</div>
					 </div>
				</form>
            </div>
       		<div class="modal-footer">
	 		<button type="button" class="btn btn-success Create_Deposit">Submit Form</button>
	 	</div>
    </div>
</div>
</div>

