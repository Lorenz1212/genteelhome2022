<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-onlineorder-view">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5"><span id="request_id_update" data-id="<?php echo $id; ?>"></span>Online Order Request</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100 ">Request</span>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="card card-custom gutter-b">
					 <div class="form" data-link="Update_OnlineOrder"></div>
					<div class="card-header">
						 <div class="card-title">
					            <h3 class="card-label">Order No: <?php echo $id; ?></h3>
					  	 </div>
					 </div>
						<div class="card-body">
								<div class="form-group row">
								   <div class="col-lg-2">
									    <label>Order Date:</label>
									    <input type="text" class="form-control" id="date_order" disabled="" />
								   </div>
								   <div class="col-lg-3">
									    <label>Customer Name:</label>
									    <input type="text" class="form-control" id="c_name" disabled=""/>
								   </div>
								   <div class="col-lg-2">
									    <label>Mobile No:</label>
									    <input type="text" class="form-control" id="mobile" disabled=""/>
								   </div>
								   <div class="col-lg-3">
									    <label>Email Address:</label>
									    <input type="text" class="form-control" id="email" disabled=""/>
								   </div>
								    <div class="col-lg-2">
									    <label>Type:</label>
									    <input type="text" class="form-control" id="s_type" disabled=""/>
								   </div>
							    </div>
							    <div class="form-group row">
								   <div class="col-lg-3">
									    <label>Billing Address:</label>
									    <input type="text" class="form-control" id="b_address" disabled=""/></br>
									    <input type="text" class="form-control" id="b_city" disabled=""/>
								   </div>
								   <div class="col-lg-3">
									    <label>Shipping Address:</label>
									    <input type="text" class="form-control" id="s_address" disabled=""/>
									    </br>
									    <input type="text" class="form-control" id="s_city" disabled=""/>
								   </div>
								   <div class="col-lg-3">
									    <label>Downpayment:</label>
									    <div class="input-group">
									    	     <input type="hidden" name="order_no" value="<?php echo $id; ?>" />
								    			 <input class="form-control" name="downpayment" id="downpayment" />
										   <div class="input-group-append">
										      <button class="btn btn-secondary save" type="button" id="save_downpayment" data-action="downpayment">SAVE</button>
										     </div>
									    </div>
									    </br>
									    <div class="input-group">
								    			 <select class="form-control" name="vat" id="vat" >
								    			 	<option value="NONE VATABLE">NONE VATABLE</option>
								    			 	<option value="VATABLE">VATABLE</option>
								    			 </select>
										   <div class="input-group-append">
										      <button class="btn btn-secondary save" type="button" id="save_vat" data-action="vat">SAVE</button>
										     </div>
									    </div>
								   </div>
								   <div class="col-lg-3">
									    <label>Shipping Fee:</label>
									    <div class="input-group">
								    			 <input class="form-control" name="shipping_fee" id="shipping_fee" />
										   <div class="input-group-append">
										      <button class="btn btn-secondary save" type="button" id="save_shipping" data-action="shipping">SAVE</button>
										     </div>
									    </div>
								   </div>
							    </div>
							    <div class="row">
  									<div class="col-lg-3">
									    <label>Region:</label>
									    <input type="text" class="form-control" id="region" disabled=""/>
								   </div>
								   <div class="col-lg-3">
									    <label>Shipping Range:</label>
									    <input type="text" class="form-control" id="shipping_range" disabled=""/>
								   </div>
							    </div>
							</div>
						</div>
					</div>
			</div>
			<div class="col-xl-12">
				<div class="card card-custom gutter-b">
					<div class="card-header c-header">
						 <div class="card-title">
					            <h3 class="card-label">Item Orders</h3>
					  	 </div>
					 </div>
					 <div class="card-body">
							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="table-responsive">
										 <div class="table-responsive">
											<table class="table" id="tbl_onlineorder_view">
													<thead>
														<tr>
															<th class="pl-0 font-weight-bold text-muted text-uppercase">ITEM</th>
															<th class="pl-0 font-weight-bold text-muted text-uppercase">COLOR</th>
															<th class="text-center font-weight-bold text-muted text-uppercase">QTY</th>
															<th class="text-right font-weight-bold text-muted text-uppercase">PRICE</th>
															<th class="text-right font-weight-bold text-muted text-uppercase">Status</th>
															<th class="text-right font-weight-bold text-muted text-uppercase">ACTION</th>
														</tr>
						  							</thead>
												<tbody>
												</tbody>
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
	</div>
</div>
</div>