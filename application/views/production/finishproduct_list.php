<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-finishproduct-list">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Finish Products</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100 i-title"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<div class="container">
			<div class="card card-custom">
				<div class="card-header">
					<div class="card-title">
						<span class="card-icon">
							<i class="flaticon2-psd text-primary"></i>
						</span>
						<h3 class="card-label">List of <span class="i-title"></span></h3>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-hover table-checkable link" id="tbl_finishproduct" data-link="tbl_finishproduct" style="margin-top: 13px !important">
						<thead>
							<tr>
								<th>NO</th>
								<th>IMAGE</th>
								<th>TITLE</th>
								<th>QTY</th>
								<th>ALERT</th>
								<th>ACTION</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
			 <div class="modal-header">
                <h5 class="modal-title"><span id="project_no"></span> - ( COLOR CODE: <span id="c_code"></span>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form class="form" data-link="Update_Approval_Designed">
            	<div class="row justify-content-center">
					<div class="col-xl-12 col-xxl-6">
			        	<div class="row">
							<div class="col-lg-6 col-xl-6">
								<div class="form-group">
									<label class="col-xl-3 col-lg-3 col-form-label text-left">Image</label>
									<div class="col-lg-3 col-xl-3">
										<div class="image-input image-input-outline" id="design_image">
											<a id="image_href" target="_blank">
											  <img class="image-input-wrapper" src="" id="image"/>
										    </a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-xl-6">
								<div class="form-group">
									<label class="col-xl-3 col-lg-3 col-form-label text-left">Specifications</label>
									<div class="col-lg-3 col-xl-3">
										<div class="image-input image-input-outline" id="docs">
											<a id="docs_href" target="_blank">
											<img class="image-input-wrapper" src="<?php echo base_url();?>assets/images/design/project_request/docx/default.jpg" />
										    </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					  	  <div class="row">
						 	  <div class="col-lg-12 col-xl-12">
								 <div class="form-group">
									   <label>PALLETE COLOR</label>
									    <div class="input-group">
									     <input type="text" class="form-control form-control-solid form-control-lg" id="c_name" disabled/>
									     <div class="input-group-append" style="padding-left: 10px;">
									     	<a id="cimage_href" target="_blank">
										      <img class="images mx-auto d-block img-thumbnail z-depth-3" id="c_image" style="width:50;height:45px;"/>
										    </a>
									       </div>
									    </div>
								  </div>
							 </div>
						</div>
						<div class="form-group">
							   <label>ITEM</label>
							   <input class="form-control" id="title" disabled />
					  	 </div>
					  	  <div class="form-group">
							    <label>STOCKS <span class="text-danger">*</span></label>
							    <input type="text" class="form-control" name="stocks" id="release" disabled="" />
						  </div>
						  <div class="form-group">
							    <label>Stocks Alert <span class="text-danger">*</span></label>
							    <input type="text" class="form-control" name="stocks_alert" id="alert" disabled="" />
						 </div>
					</div>
				</div>
				<div class="modal-footer">
					 
	            </div>
            </div>
        </form>
        </div>
    </div>
</div>

