<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Interior Design</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<button type="button" class="btn btn-white font-weight-bold py-3 px-6" data-toggle="modal" data-target="#create-interior-modal" data-action="Create">Create New Interior Design</button>
			</div>
		</div>
	</div>
	<!--end::Subheader-->
<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">
				<div class="card card-custom">
					<div class="card-header">
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover" id="tbl_interiors">
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
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
<!--end::Content-->

<!-- Modal-->
<div class="modal fade" id="create-interior-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="max-height: 100%;
overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Interior Design</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form class="form" id="create-interior-form" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="row justify-content-center">
					<div class="col-xl-10 col-xxl-10">
						<!--begin::Group-->
							<div class="form-group row">
								<div class="col-lg-12 col-xl-12">
									<label><h3>BACKGROUND</h3> image size(810 x 460)</label>
									<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
										<img class="background-image mx-auto d-block img-thumbnail z-depth-3 bg-update" id="bg" alt="image" src="<?php echo base_url('assets/images/banner/default.png') ?>" style="width: 700px;height: 250px;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast;"/>
									</div>
									 <input type="file" value="" onchange="document.getElementById('bg').src = window.URL.createObjectURL(this.files[0])" id="bg_image" name="bg_image">
								</div>
							</div>
							<div class="form-group row">
									<div class="col-lg-12 col-xl-12">
										<label><h3>BANNER</h3> image size(1140 x 660)</label>
										<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
											<img class="images mx-auto d-block img-thumbnail z-depth-3 image-update" id="blah" alt="image" src="<?php echo base_url('assets/images/banner/default.png') ?>" style="width: 700px;height: 250px;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast"/>
										</div>
										 <input type="file" value="" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" id="image" name="image">
									</div>
								</div>
									<div class="form-group">
											<label>Title</label>
											<input type="text" class="form-control" name="project_name" required="" autocomplete="off"/>
									</div>
									<div class="form-group">
										<label>CATEGORY</label>
										<select class="form-control" name="cat_id" required="" >
											<option value="">SELECT CATEGORY</option>
											<option value="1">RESIDENTIAL PROJECT</option>
											<option value="2">COMMERCIAL PROJECT</option>
										</select>
									</div>
									<div class="form-group">
											<label>Description</label>
											<div id="description" class="description description-create"></div>
									</div>
							</div>
						</div>
						</form>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary font-weight-bold btn-create-interior">Save changes</button>
		            </div>
		        </div>
		    </div>
		</div>
<div class="modal fade" id="update-interior-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="max-height: 100%;
overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Interior Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form class="form" id="update-interior-form" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="row justify-content-center">
					<div class="col-xl-10 col-xxl-10">
						<!--begin::Group-->
							<div class="form-group row">
								<div class="col-lg-12 col-xl-12">
									<label><h3>BACKGROUND</h3> image size(810 x 460)</label>
									<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
										<img class="background-image mx-auto d-block img-thumbnail z-depth-3 edit-image-bg" id="bg-update" alt="image" style="width: 700px;height: 200px;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast;"/>
									</div>
									 <input type="file" value="" onchange="document.getElementById('bg-update').src = window.URL.createObjectURL(this.files[0])" id="bg_image" name="bg_image">
								</div>
							</div>
							<div class="form-group row">
									<div class="col-lg-12 col-xl-12">
										<label><h3>BANNER</h3> image size(1140 x 660)</label>
										<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
											<img class="images mx-auto d-block img-thumbnail z-depth-3 edit-image" id="image-update" alt="" style="width: 700px;height: 200px;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast;"/>
										</div>
										 <input type="file" value="" onchange="document.getElementById('image-update').src = window.URL.createObjectURL(this.files[0])" id="image" name="image">
									</div>
								</div>
								<div class="form-group">
										<label>Title</label>
										<input type="text" class="form-control project_name" name="project_name" required="" autocomplete="off" />
									</div>
									<div class="form-group">
										<label>CATEGORY</label>
										<select class="form-control cat_id" name="cat_id" required="">
											<option value="">SELECT CATEGORY</option>
											<option value="1">RESIDENTIAL PROJECT</option>
											<option value="2">COMMERCIAL PROJECT</option>
										</select>
									</div>
									<div class="form-group">
											<label>Description</label>
											<div id="description" class="description description-update"></div>
									</div>
							</div>
						</div>
						</form>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary font-weight-bold btn-update-interior">Save changes</button>
		            </div>
		        </div>
		    </div>
		</div>
