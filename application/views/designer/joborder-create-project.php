<style type="text/css">
.table-scroll tbody {
  display: block;
  max-height: 400px;
  overflow-y: scroll;
}

.table-scroll thead, table tbody tr {
  display: table;
  width: 100%;
  table-layout: fixed;
}
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-jobeorder-create-project">
	<div class="subheader py-2 py-lg-12 subheader-transparent form" id="kt_subheader" data-link="Create_Joborder_Project">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Create Job Order For Project</h2>
				</div>
			</div>
		</div>
	</div>

<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-xxl-3 col-md-3">
				<div class="card card-custom gutter-b">
				    <div class="card-header card-header-tabs-line">
				        <div class="card-toolbar">
				            <div class="card-title">
									<h3 class="card-label">Job Order</h3>
							 </div>
				        </div>
				    </div>
			   		<div class="card-body">
			   			<form  accept-charset="utf-8"  enctype="multipart/form-data">
			       		 <div class="row">
						 	  <div class="col-lg-12 col-xl-12 col-md-12">
							    <div class="form-group">
								   <label>Project</label>
								   <div class="input-group">
									   <select class="form-control form-control-solid form-control-lg selectpicker" data-live-search="true" id="project_no" name="project_no" required />
									     <option value="" disabled="" selected="">Select Project</option>
									     <?php 
												  $query = $this->db->select('*')->from('tbl_project_design')->where('type',2)->where('project_status','APPROVED')->get();
												  foreach($query->result() as $row){
												  	 echo '<option value="'.$this->encryption->encrypt($row->id).'">'.$row->title.'</option>';
												  }
											?>
									  </select>
									   <div class="input-group-append" style="padding-left: 10px;">
									   		<a class="btn btn-light-dark font-weight-bold btn-sm btn-shadow btn-square" id="docs_href" data-toggle="tooltip" data-theme="dark" title="View Specification"><i class="flaticon2-paper"></i></a>
									   </div>
									</div>
								</div>
							</div>
								<div class="col-lg-6 col-xl-6 col-md-6">
										<button type="button" class="btn btn-light-dark font-weight-bold btn-sm btn-square btn-request" data-action="Material Request">Material Request</button>
									</div>
									<div class="col-lg-6 col-xl-6 col-md-6">
										<button type="button" class="btn btn-light-dark font-weight-bold btn-sm btn-square btn-request" data-action="Purchase Request">Purchase Request</button>
									</div>
								</div>
			        </div>
			    </div>
			    <div class="row">
					<div class="col-lg-12 col-xl-12 col-md-12">
						<div class="card card-custom gutter-b">
							<button type="button" class="btn btn-light-success font-weight-bold btn-lg btn-square Create_Joborder_Project">SUBMIT JOB ORDER</button>
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
									<h3 class="card-label card-label-title">Material Request</h3>
								</div>
								<div class="card-toolbar">
						            <button type="button" class="btn btn-sm btn-dark btn-shadow font-weight-bold btn-submit" data-action="Material Request">
						                <i class="flaticon2-plus"></i> Add Request
						            </button>
						        </div>
						    </div>
					   		<div class="card-body">
								       		<div class="row">
								       			<div class="col-xl-3 col-xxl-3 col-md-3" id="special-select">
								       		 	  	<div class="form-group">
													   <label>SPECIAL OPTION</label>
													   <select class="form-control" name="special_option" id="special-option"/>
													   	<option value="1">COMMON ITEM</option>
													   	<option value="2">SPECIAL ITEM</option>
													   </select>
													</div>
							       		 	 	</div>
							       		 	 	<div class="col-xl-4 col-xxl-4 col-md-4" id="special-item">
								       		 	  	<div class="form-group">
													   <label>SPECIAL ITEM:</label>
													   <input type="text" class="form-control form-control-solid special" id="special_item" name="special_item" />
													   <span class="form-text text-muted">Please enter your item</span>
													</div>
							       		 	 	</div>
								       		    <div class="col-xl-4 col-xxl-4 col-md-4" id="item-select">	
									       			<div class="form-group">
														<label>ITEM</label>
															<select class="form-control form-control-md selectpicker" data-live-search="true" name="item">
																<?php 
																	$query = $this->db->select('*,(stocks+production_stocks) as stocks')->from('tbl_materials')->where('status',1)->order_by('date_created','ASC')->get();
																	    if(!$query){return false;}else{ 
																	        foreach($query->result() as $row){  
																	        	if(!$row->unit){$unit = "";}else{$unit = $row->unit.'(s)';}
																	        	echo '<option value="'.$row->id.'">('.$row->stocks.') '.$row->item.' - '.$unit.'</option>'; 
																	        }  
																	    }
																?>
															</select>
													</div>
												</div>
												<div class="col-xl-2 col-xxl-2 col-md-2">
													<div class="form-group">
														<label>QTY</label>
														<input type="number" min="1" class="form-control form-control-solid form-control-md" id="quantity" name="qty" value="1" autocomplete="off"/>
													</div>
												</div>
												<div class="col-xl-3 col-xxl-3 col-md-3" id="type-select">
													<div class="form-group">
														<label>TYPE</label>
														<select class="form-control form-control-solid form-control-md" name="type">
															<option value="1">FRAMING - MATERIALS</option>
															<option value="2">MECHANISM</option>
															<option value="3">FINISHING - MATERIALS</option>
															<option value="4">SULIHIYA</option>
															<option value="5">UPHOLSTERY</option>
															<option value="6">OTHERS</option>
														</select>
													</div>
												</div>
												<div class="col-xl-3 col-xxl-3 col-md-3">
													<div class="form-group">
														<label>REMARKS</label>
														 <textarea class="form-control" id="remarks" rows="3" placeholder="Description"></textarea>
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
												<h3 class="card-label">Material List</h3>
											</div>
									    </div>
								   		<div class="card-body">
								       		<table class="table table-scroll" id="kt_material_table">
												<thead>
													<tr>
														<th class="text-left text-muted text-uppercase">ITEM</th>
														<th class="text-left text-muted text-uppercase">QTY</th>
														<th class="text-center text-muted text-uppercase">TYPE</th>
														<th class="text-right text-muted text-uppercase">ACTION</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
								        </div>
								    </div>
								</div>
								<div class="col-xl-12 col-xxl-12 col-md-12">
									<div class="card card-custom gutter-b">
									    <div class="card-header card-header-tabs-line">
									       <div class="card-title">
												<h3 class="card-label">Purchase List</h3>
											</div>
									    </div>
								   		<div class="card-body">
							       			<table class="table table-scroll" id="kt_purchased_table">
												<thead>
												 	<tr>
														<th class="text-left text-muted text-uppercase">ITEM</th>
														<th class="text-left text-muted text-uppercase">QTY</th>
														<th class="text-center text-muted text-uppercase">REMARKS</th>
														<th class="text-right text-muted text-uppercase">ACTION</th>
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
			</form>
		</div>
	</div>
</div>