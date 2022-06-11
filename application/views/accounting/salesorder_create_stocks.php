
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-salesorder-create-stocks">
	<div class="form" data-link="Create_Salesorder_Stocks"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Create Sales Order For Stocks</h2>
				</div>
			</div>
		</div>
	</div>
<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row" id="Create_Salesorder_Stocks_Form">
			<div class="col-xl-3 col-xxl-3 col-md-3">
			    <div class="row">
					<div class="col-lg-12 col-xl-12 col-md-12">
						<div class="card card-custom gutter-b">
							    <div class="card-header card-header-tabs-line">
							        <div class="card-toolbar">
							            <div class="card-title">
												<h3 class="card-label">Customer Info</h3>
										 </div>
							        </div>
							    </div>
						   		<div class="card-body">
						       		 <div class="row">
									 	  <div class="col-lg-12 col-xl-12 col-md-12">
									 	  	    <div class="form-group row">
													<label>Date order</label>
													<input type="date" class="form-control form-control-lg" name="date_created" />
												</div>
											    <div class="form-group row">
												    <label>Customer Name</label>
												    	<div class="input-group">
												     		<input type="text" class="form-control form-control-lg" name="fullname" data-id="" autocomplete="off"/>
												    	 <div class="input-group-append">
												     		 <button type="button" class="btn btn-primary btn-icon btn-lg" data-toggle="modal" data-target="#search"><i class="flaticon2-search-1 icon-m"></i></button>
												     	  </div>
												   </div>
												</div>
												<div class="form-group row">
													<label>Email Address</label>
													<input type="email" class="form-control form-control-lg" name="email" placeholder="@example.com" autocomplete="off" />
												</div>
												<div class="form-group row">
													<label>Mobile No</label>
													<input type="text" class="form-control form-control-lg" name="mobile" placeholder="+639" autocomplete="off"/>
												</div>
												<div class="form-group row">
													<label>TIN No</label>
													<input type="text" class="form-control form-control-lg" name="tin" autocomplete="off"/>
												</div>
												<div class="form-group row">
													<label>Address</label>
													<textarea class="form-control" name="address" rows="3"></textarea>
												</div>

												
												
										 </div>
									</div>
						        </div>
						   </div>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-xxl-8 col-md-8">
				<div class="row">
					<div class="col-xl-12 col-xxl-12 col-md-12 ">
						<div class="card card-custom gutter-b">
						    <div class="card-header card-header-tabs-line">
						       <div class="card-title">
									<h3 class="card-label card-label-title">Input Product</h3>
								</div>
								<div class="card-toolbar">
						            <button type="button" class="btn btn-sm btn-dark btn-shadow font-weight-bold btn-submit" data-action="Product Table">
						                <i class="flaticon2-plus"></i> Add Item
						            </button>
						        </div>
						    </div>
					   		<div class="card-body">
								       		<div class="row">
								       		    <div class="col-xl-5 col-xxl-5 col-md-5">	
									       			<div class="form-group">
														<label>DESCRIPTION</label>
														 <select class="form-control form-control-solid form-control-lg selectpicker" data-live-search="true" id="project_no" name="project_no" required />
														     <option value="" disabled="" selected="">Select Item</option>
														       <?php 
																  $query = $this->db->select('*')->from('tbl_project_design')->where('type',1)->where('project_status','APPROVED')->get();
																  foreach($query->result() as $row){
																  	 echo '<option value="'.$this->encryption->encrypt($row->id).'">'.$row->title.'</option>';
																  }
																?>
														  </select>
													</div>
												</div>
												<div class="col-lg-5 col-xl-5 col-md-5">
													 <div class="form-group">
														   <label>Pallet Color</label>
														     <select type="text" class="form-control form-control-solid" id="c_code" name="c_code" required >
														     	<option value="" disabled="" selected>Select Pallet Color</option>
														     </select>
													  </div>
												</div>
												 <div class="col-xl-2 col-xxl-2 col-md-2">	
									       			<div class="form-group">
														<label>Quantity</label>
														<input type="number" min="1" name="qty" class="form-control qty" placeholder="0" />
													</div>
												</div>
												<div class="col-xl-4 col-xxl-4 col-md-4">	
									       			<div class="form-group">
														<label>UNIT (e.i PC,Kilo, etc)</label>
														<input type="text" name="unit" class="form-control" />
													</div>
												</div>
												<div class="col-xl-4 col-xxl-4 col-md-4">	
									       			<div class="form-group">
														<label>AMOUNT</label>
														<input type="text" name="amount" class="form-control" placeholder="0.00" />
													</div>
												</div>
								       		</div>

								        </div>
								    </div>
								</div>
								<div class="col-xl-12 col-xxl-12 col-md-12">
									<div class="card card-custom gutter-b">
									    <div class="card-header card-header-tabs-line">
									       <div class="card-title">
												<h3 class="card-label">Product Breakdown</h3>
											</div>
									    </div>
								   		<div class="card-body">
								   			<div class="row">
								   				<div class="col-xl-12 col-xxl-12 col-md-12">
										   			<div class="tableFixHead">
										       			<table class="table table-hover table-sm" id="kt_product_breakdown_table">
															<thead>
																<tr>
																	<th class="text-left">DESCRIPTION</th>
																	<th class="text-center">QUANTITY</th>
																	<th class="text-center">UNIT</th>
																	<th class="text-right">AMOUNT</th>
																	<th class="text-center">ACTION</th>
																</tr>
															</thead>
														<tbody>
														</tbody>
													   </table>
													   <div class="cart-empty-page m-0">
														</div>
													</div>
												</div>
											</div>
											<div class="row mt-2">
				      		  					<div class="col-xl-12 col-md-12">
													<div class="separator separator-dashed separator-border-2 separator-dark"></div>
												</div>
											</div>
											<div class="row mt-2">
													<div class="col-xl-5 col-md-5">
													<div class="border-bottom border-color-1 border-dotted-bottom">
                                                    <div class="p-3" id="pay-with-cod">
											               <h4>Payment date terms</h4>
                                                    </div>
                                                    <div class="border-top border-color-1 border-dotted-top bg-dark-lighter">
                                                        <div class="p-4 bg-gray-100">
                                                        	<form id="terms_condition">
	                                                            <div class="form-group row">
																	<label class="col-4 col-form-label">Date From</label>
																	<div class="col-8">
																		<input class="form-control form-control-sm" type="date" name="terms_start">
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-4 col-form-label">Date To</label>
																	<div class="col-8">
																		<input class="form-control form-control-sm" type="date" name="terms_end">
																	</div>
																</div>
															</form>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
												<div class="col-xl-7 col-xxl-7 col-md-7">
																<div class="row mb-2">
																	<div class="col-xl-6 col-xxl-6 col-md-6">
																		<label class="checkbox checkbox-outline checkbox-success mt-2 text-dark-75 font-weight-bolder">
														                    <input type="checkbox" name="checkbox-status" data-status="downpayment" />
														                    <span class="mr-2"></span>
														                    <div id="date-text-downpayment"> </div>
														                </label>
																	</div>
																	<div class="col-xl-6 col-xxl-6 col-md-6">
																		<input type="text" class="form-control form-control-sm" name="downpayment" placeholder="0.00" disabled />
																	</div>
																</div>
																<div class="row mb-2">
																	<div class="col-xl-6 col-xxl-6 col-md-6">
																		<label class="checkbox checkbox-outline checkbox-success mt-2 text-dark-75 font-weight-bolder">
														                    <input type="checkbox" name="checkbox-status" data-status="shipping_fee" />
														                    <span class="mr-2"></span>
														                     Shipping Fee:
														                </label>
																	</div>
																	<div class="col-xl-6 col-xxl-6 col-md-6">
																		<input type="text" class="form-control form-control-sm" name="shipping_fee" placeholder="0.00" disabled/>
																	</div>
																</div>
																<div class="row mb-2">
																	<div class="col-xl-6 col-xxl-6 col-md-6">
																		<label class="checkbox checkbox-outline checkbox-success mt-2 text-dark-75 font-weight-bolder">
														                    <input type="checkbox" name="checkbox-status" data-status="discount" />
														                    <span class="mr-2"></span>
														                     Discount (%):
														                </label>
																	</div>
																	<div class="col-xl-6 col-xxl-6 col-md-6">
																		<input type="text" class="form-control form-control-sm" name="discount" id="discount" placeholder="0.00%" autocomplete="off" disabled/>
																	</div>
																</div>
																<div class="row mb-5">
																	<div class="col-xl-6 col-xxl-6 col-md-6">
																		<span class="text-dark-75 font-weight-bolder ml-8">Vat :</span>
																	</div>
																	<div class="col-xl-6 col-xxl-6 col-md-6">
																		<select class="form-control form-control-sm" name="vat">
																			<option value="1">Vatable</option>
																			<option value="2">W/o Vat</option>
																		</select>
																	</div>
																</div>
																<div class="row mb-2">
																	<div class="col-xl-4 col-xxl-4 col-md-4">
		
																	</div>
																	<div class="col-xl-8 col-xxl-8 col-md-8">
																		<button type="button" class="btn btn-outline-success btn-lg btn-block btn-create-submit">SUBMIT SALES ORDER</button>
																	</div>
																</div>
																
															</div>
														</div>
												</div>
											</div>


								        </div>
								    </div>
								</div>
							</div>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="search"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Existing Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                   <div class="form-group">
				     	<select class="form-control  select2" id="customer-option" name="customer">
				      		<option value="" selected="selected" disabled="">SEARCH.....</option>
				     	</select>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold search">Search...</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_downpayment" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group row">
					<label>Date of downpayment</label>
					<input type="date" class="form-control form-control-solid form-control-lg" name="date_downpayment"/>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary font-weight-bold save-downpayment">Save</button>
            </div>
        </div>
    </div>
</div>
