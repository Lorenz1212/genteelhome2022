<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-joborder-stocks-supervisor">
	 <div class="form" data-link="Joborder_Supervisor_Stocks"></div>
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Job Order For Stocks</h2>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
			<div class="card card-custom gutter-b">
			    <div class="card-header card-header-tabs-line">
			        <div class="card-toolbar">
			            <ul class="nav nav-tabs nav-bold nav-tabs-line">
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab"  href="#request" data-name="request">
			                        <span class="nav-text">Request</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#complete" data-name="complete">
			                        <span class="nav-text">Complete</span>
			                    </a>
			                </li>
			                 <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" href="#cancelled" data-name="cancelled">
			                        <span class="nav-text">Cancelled</span>
			                    </a>
			                </li>
			            </ul>
			        </div>
			    </div>
			    <div class="card-body">
			        <div class="tab-content">
			            <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
			               	<table class="table table-bordered table-hover table-checkable link" id="tbl_joborder_supervisor" data-link="tbl_joborder_stocks" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>TITLE</th>
										<th>QTY</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			               <table class="table table-bordered table-hover table-checkable" id="tbl_joborder_complete" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>TITLE</th>
										<th>QTY</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
									</tr>
								</thead>
							</table>
			            </div>
			            <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
			               <table class="table table-bordered table-hover table-checkable" id="tbl_joborder_cancelled" style="margin-top: 13px !important">
								<thead>
									<tr>
										<th>NO</th>
										<th>TITLE</th>
										<th>QTY</th>
										<th>REQUESTOR</th>
										<th>DATE</th>
									</tr>
								</thead>
							</table>
			            </div>
			        </div>
			    </div>
			</div>
			<!--end::Card-->
		</div>
	</div>
</div>
<!-- Modal-->
<div class="modal fade" id="requestModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
            	<div class="card card-custom gutter-b">
            		<div class="card-header card-header-tabs-line">
		            		<div class="card-toolbar">
		            			<ul class="nav nav-tabs nav-tabs-line  nav-tabs-inverse justify-content-center">
									<li class="nav-item">
										<a  class="nav-link active" data-toggle="tab" href="#details">
											<span class="nav-icon"><i class="flaticon-grid-menu"></i></span>
                       						<span class="nav-text">Details</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#material">
											<span class="nav-icon"><i class="flaticon-list-1"></i></span>
                       						<span class="nav-text">Material Request</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#purchase">
											<span class="nav-icon"><i class="flaticon-list-1"></i></span>
                       						<span class="nav-text">Purchase Request</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#used">
											<span class="nav-icon"><i class="flaticon-edit-1"></i></span>
                       						<span class="nav-text">Material Used</span>
										</a>
									</li>
								</ul>
		            		</div>
		            		<div class="card-title">
					            <h3 class="card-label" id="project_no"></h3>
					        </div>
		            	</div>
						<div class="card-body">
							<div class="tab-content">
							<div class="tab-pane active" id="details" role="tabpanel" style="height:300px">
										<div class="row justify-content-center p-10">
											<div class="col-xl-10 col-xxl-10 col-md-10">
												<div class="row">
													<div class="col-lg-5 col-xl-5 col-md-5">
														<div class="form-group">
															<div class="image-input image-input-outline" id="design_image">
																  <img class="image-input-wrapper image" id="myImg" style="width: 250px;height: 250px;object-fit: cover;" />
															</div>
														</div>
													</div>
													<div class="col-lg-7 col-xl-7 col-md-7">
														<div class="row">
															<div class="col-lg-12 col-xl-12 col-md-12">
																<div class="form-group">
															    <label>Specification</label>
																	 <div class="input-group">
																	    	 <div class="input-group-append">
																	      <a target="_blank" data-toggle="tooltip" data-theme="dark" title="View Tearsheet" class="btn  btn-light-dark btn-icon docs_href"><i class="flaticon-eye"></i></a>
																	     </div>
																	     <input type="text" class="form-control form-control-solid docs docs-click" placeholder="Click Here...." style="cursor:pointer;" disabled/>
																    </div>
														  		</div>
															</div>
															<div class="col-lg-12 col-xl-12 col-md-12">
																<div class="form-group">
															   		<label>Project Name</label>
														   			<input class="form-control" id="title" disabled />
														  		</div>
															</div>
															<div class="col-lg-6 col-xl-6 col-md-6">
																 <div class="form-group">
																	   <label>PALLETE COLOR</label>
																	   <div class="input-group">
																	   		 <input type="text" class="form-control form-control-solid form-control-lg" id="c_name" name="cname_update"/>
																       <div class="input-group-append" style="padding-left: 10px;">
																	      	<img class="images mx-auto d-block img-thumbnail z-depth-3 c_image" id="myImg" src="<?php echo base_url();?>assets/images/design/project_request/images/default.jpg " style="width:50;height:45px;"/>
																       </div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-xl-6 col-md-6">
																<div class="form-group">
															   		<label>Unit</label>
														   			<input class="form-control" id="unit" disabled />
														  		</div>
															</div>
														</div>		
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="material" role="tabpanel" style="height:360px">
									<div class="mb-10">
							            <a href="#" id="form-add" class="btn btn-dark btn-shadow font-weight-bold mr-2" data-toggle="modal" data-target="#add-material-request" data-action="material-create">
							                <i class="flaticon2-plus"></i> Add Material
							            </a>
						        	</div>
									    <table class="table table-sm" id="tbl_material">
											<thead>
												<tr>
													<th></th>
													<th>ITEM</th>
													<th class="text-center">QTY</th>
													<th class="text-center">PREVIOUS</th>
													<th class="text-center">STOCKS</th>
													<th class="text-center">INPUT REQUEST</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
								</div>
								<div class="tab-pane" id="purchase" role="tabpanel" style="height:360px">
									<div class="mb-10">
							            <a href="#" id="form-add" class="btn btn-dark btn-shadow font-weight-bold mr-2" data-toggle="modal" data-target="#add-purchase-request" data-action="purchased-create"><i class="flaticon2-plus"></i> Add Material</a>
							            <a href="#" id="form-purchased" class="btn btn-dark btn-shadow font-weight-bold mr-2" data-toggle="modal" data-target="#ModalTalble"><i class="flaticon2-plus"></i> View Request</a>
						        	</div>
									    <table class="table table-sm" id="tbl_puchased">
											<thead>
												<tr>
													<th></th>
													<th>ITEM</th>
													<th class="text-center">QTY</th>
													<th class="text-center">UNIT</th>
													<th class="text-center">REMARKS</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
								</div>
								<div class="tab-pane" id="used" role="tabpanel" style="height:360px">
								    <table class="table table-sm" id="tbl_material_used">
										<thead>
											<tr>
												<th></th>
												<th class="text-center">ITEM</th>
												<th class="text-center">QTY</th>
												<th class="text-center">INPUT MATERIAL USE</th>
												<th></th>
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
		            <div class="modal-footer">
		            	 <button type="button" class="btn btn-light-dark" data-dismiss="modal" aria-label="Close">
		                   Close
		                </button>
		            </div>
		        </div>
		    </div>
		</div>
<div class="modal fade" id="add-material-request" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white"><span id="text-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close text-white"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="Create_Material_request">
                	<div class="row">
				 		 <div class="col-lg-12 col-xl-12">
				 			<div class="form-group">
						 		<label class="text-white item-p">ITEM</label>
						 		<select class="form-control" name="item_add">
						 			<?php 
						 				$query = $this->db->select('*')->from('tbl_materials')->where('status',1)->get();
						 				if($query){
						 					foreach($query->result() as $row){
						 						echo '<option value="'.$row->id.'">'.$row->item.'</option>';
						 					}
						 				}else{
						 					echo '<option>No Material Available</option>';
						 				}
						 			?>
						 		</select>
				 			 </div>
					 	</div>
					 	<div class="col-lg-6 col-xl-6">
				 			<div class="form-group">
						 		<label class="text-white item-p">QTY</label>
						 		<input type="number" min="1" class="form-control quantity" name="qty_add" autocomplete="off"/>
				 			 </div>
					 	</div>
					 	<div class="col-lg-6 col-xl-6">
				 			<div class="form-group">
						 		<label class="text-white item-p">TYPE</label>
						 		<select class="form-control" name="type_add">
						 			<option value="" selected="" disabled="">SELECT TYPE</option>
									<option value="1">FRAMING - MATERIALS</option>
									<option value="2">MECHANISM</option>
									<option value="3">FINISHING - MATERIALS</option>
									<option value="4">SULIHIYA</option>
									<option value="5">UPHOLSTERY</option>
									<option value="6">OTHERS</option>
						 		</select>
				 			 </div>
					 	</div>
					 </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-transparent-white font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-transparent-success font-weight-bold mr-2 Create_Material_request">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-purchase-request" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white"><span id="text-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close text-white"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="Create_Purchase_request">
                	<div class="row">
                		 <div class="col-lg-12 col-xl-12">
				 			<div class="form-group">
						 		<label class="text-white">ITEM</label>
						 		<select class="form-control item-status" name="status_add_p">
						 			<option value="1">COMMON</option>
						 			<option value="2">SPECIAL</option>
						 		</select>
				 			 </div>
					 	</div>
					 	 <div class="col-lg-6 col-xl-6">
				 			<div class="form-group">
						 		<label class="text-white">ITEM</label>
						 		<input type="text" class="form-control" name="special_add_p" autocomplete="off"/>
				 			 </div>
					 	</div>
					 	<div class="col-lg-6 col-xl-6">
				 			<div class="form-group">
						 		<label class="text-white">UNIT</label>
						 		<input type="text" class="form-control" name="unit_add_p" placeholder="E.g. PCS/PC,KILO,GAL,etc" autocomplete="off"/>
				 			 </div>
					 	</div>
				 		 <div class="col-lg-12 col-xl-12">
				 			<div class="form-group">
						 		<label class="text-white">ITEM</label>
						 		<select class="form-control" name="item_add_p">
						 			<?php 
						 				$query = $this->db->select('*')->from('tbl_materials')->where('status',1)->get();
						 				if($query){
						 					foreach($query->result() as $row){
						 						echo '<option value="'.$row->id.'">'.$row->item.'</option>';
						 					}
						 				}else{
						 					echo '<option>No Material Available</option>';
						 				}
						 			?>
						 		</select>
				 			 </div>
					 	</div>
					 	<div class="col-lg-12 col-xl-12">
				 			<div class="form-group">
						 		<label class="text-white item-p">QTY</label>
						 		<input type="number" min="1" class="form-control quantity" name="qty_add_p" autocomplete="off"/>
				 			 </div>
					 	</div>
					 	<div class="col-lg-12 col-xl-12">
				 			<div class="form-group">
						 		<label class="text-white item-p">REMARKS</label>
						 		<textarea class="form-control" name="remarks_add_p"></textarea>
				 			 </div>
					 	</div>
					 </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-transparent-white font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-transparent-success font-weight-bold mr-2 Create_Purchase_request">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-material-request" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white text-name-m"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close text-white"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="Update_Material_request">
                	<div class="row">
                		<div class="col-lg-12 col-xl-12">
                			<div class="form-group"><label class="text-white item-p">QTY</label>
                				<input type="text" class="form-control" name="qty_update_m" value="" autocomplete="off"/>
                			</div>
                		</div>
                	</div>
                	<div class="row">
                		<div class="col-lg-12 col-xl-12">
                			<div class="form-group"><label class="text-white">TYPE</label>
                				<select class="form-control" name="type_update_m">
									<option value="1">FRAMING - MATERIALS</option>
									<option value="2">MECHANISM</option>
									<option value="3">FINISHING - MATERIALS</option>
									<option value="4">SULIHIYA</option>
									<option value="5">UPHOLSTERY</option>
									<option value="6">OTHERS</option>
						 		</select>
                			</div>
                		</div>
                	</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-transparent-white font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-transparent-success font-weight-bold mr-2 Update_Material_request">Save</button>
            </div>
        </div>
    </div>
</div>
		
<div class="modal fade" id="edit-purchase-request" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white text-name"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close text-white"></i>
                </button>
            </div>
            <div class="modal-body">
                 <form id="Update_Purchase_request">
                 	<div class="row">
                 		<div class="col-lg-12 col-xl-12">
                 			<div class="form-group">
                 				<label class="text-white item-p">QTY</label>
                 				<input type="text" class="form-control" name="qty_update_p" value="" autocomplete="off"/>
                 			</div>
                 		</div>
                 	</div>
                 	<div class="row">
                 		<div class="col-lg-12 col-xl-12">
                 			<div class="form-group">
                 				<label class="text-white item-p">Remark</label>
                 				<textarea class="form-control" name="remarks_update_p" rows="4" autocomplete="off"></textarea>
                 			</div>
                 		</div>
                 	</div>
                 </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-transparent-white font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-transparent-success font-weight-bold mr-2 Update_Purchase_request">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalTalble" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white"><span id="text-table"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close text-white"></i>
                </button>
            </div>
            <div class="modal-body">
                 <div class="data-table" data-scroll="true" data-height="300"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-transparent-white font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


