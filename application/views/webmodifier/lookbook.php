<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Look book</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<button type="button" class="btn btn-white font-weight-bold py-3 px-6 mr-3 create-lookbook">Create New Lookbook</button>
				<button type="button" class="btn btn-white font-weight-bold py-3 px-6 create-new-category">Create New Category</button>
			</div>
		</div>
	</div>
	<!--end::Subheader-->
<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">
				<div class="card card-custom">
					 <div class="card-header card-header-tabs-line">
			        <div class="card-toolbar">
			            <ul class="nav nav-tabs nav-bold nav-tabs-line">
			               
			                <li class="nav-item">
			                    <a class="nav-link active" data-toggle="tab" data-name="approved" href="#lookbook">
			                        <span class="nav-icon"><i class="flaticon-list-3"></i></span>
			                        <span class="nav-text">Lookbook</span>
			                    </a>
			                </li>
			                 <li class="nav-item">
			                    <a class="nav-link" data-toggle="tab" data-name="request" href="#category">
			                        <span class="nav-icon"><i class="flaticon-layers"></i></span>
			                        <span class="nav-text">Category</span>
			                    </a>
			                </li>
			            </ul>
			        </div>
			    </div>
					<div class="card-body">
						<div class="tab-content">
					        <div class="tab-pane show active" id="lookbook" role="tabpanel" aria-labelledby="lookbook">
								<table class="table table-bordered table-hover" id="tbl_lookbooks">
									<thead>
										<tr>
											<th>IMAGE</th>
											<th>TITLE</th>
											<th>CATEGORY</th>
											<th>DATE CREATED</th>
											<th>STATUS</th>
											<th>ACTION</th>
										</tr>
									</thead>
								</table>
							</div>
							 <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category">
								<table class="table table-bordered table-hover" id="tbl_lookbook_categories">
									<thead>
										<tr>
											<th>CATEGORY</th>
											<th>DATE CREATED</th>
											<th>STATUS</th>
											<th>ACTION</th>
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
<!--end::Content-->

<!-- Modal-->
<div class="modal fade" id="create-lookbook-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="max-height: 100%;
overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Lookbook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form class="form" id="create-lookbook-form" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="row justify-content-center">
					<div class="col-xl-10 col-xxl-10">
						<!--begin::Group-->
							<div class="form-group row">
									<div class="col-lg-12 col-xl-12">
										<label><h3>Upload Image</h3></label>
										<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
											<img class="images mx-auto d-block img-thumbnail z-depth-3 image-create" id="blah" alt="image" src="<?php echo base_url('assets/images/lookbook/default.jpg') ?>" style="width: 700px;height: 270px;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast"/>
										</div>
										 <input type="file" value="" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" id="image" name="image">
									</div>
								</div>
									<div class="form-group">
											<label>Title</label>
											<input type="text" class="form-control" name="title" required="" autocomplete="off"/>
									</div>
									<div class="form-group">
										<label>CATEGORY</label>
										<select class="form-control category" name="cat_id" required="" >
											<option value="">SELECT CATEGORY</option>
										</select>
									</div>
							</div>
						</div>
						</form>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary font-weight-bold btn-create-lookbook">Submit</button>
		            </div>
		        </div>
		    </div>
		</div>
<div class="modal fade" id="update-lookbook-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="max-height: 100%;
overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Lookbook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form class="form" id="update-lookbook-form" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="row justify-content-center">
					<div class="col-xl-10 col-xxl-10">
						<!--begin::Group-->
							<div class="form-group row">
									<div class="col-lg-12 col-xl-12">
										<label><h3>BANNER</h3> image size(1140 x 660)</label>
										<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
											<img class="images mx-auto d-block img-thumbnail z-depth-3 image-update" id="blah" alt="image" src="<?php echo base_url('assets/images/banner/default.png') ?>" style="width: 700px;height: 270px;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast"/>
										</div>
										 <input type="file" value="" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" id="image" name="image">
									</div>
								</div>
									<div class="form-group">
											<label>Title</label>
											<input type="text" class="form-control title-update" name="title" required="" autocomplete="off"/>
									</div>
									<div class="form-group">
										<label>CATEGORY</label>
										<select class="form-control category category-update" name="cat_id" required="" >
											<option value="">SELECT CATEGORY</option>
										</select>
									</div>
							</div>
						</div>
						</form>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary font-weight-bold btn-update-lookbook">Save changes</button>
		            </div>
		        </div>
		    </div>
		</div>