<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">List of banners</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<button type="button" class="btn btn-white font-weight-bold py-3 px-6" data-toggle="modal" data-target="#create-banner-modal" data-action="Create">Create New Banner</button>
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
						<table class="table table-bordered table-hover" id="tbl_banners">
							<thead>
								<tr>
									<th>IMAGE</th>
									<th>TITLE</th>
									<th>SUB TITLE</th>
									<th>DATE CREATED</th>
									<th>SLIDE</th>
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
<div class="modal fade" id="create-banner-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form class="form" id="Create-banner-form" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="row justify-content-center">
					<div class="col-xl-10 col-xxl-10">
					<div class="form-group row">
						<div class="col-lg-12 col-xl-12">
							<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
								<img class="images mx-auto d-block img-thumbnail z-depth-3" src="<?php echo base_url('assets/images/banner/default.png') ?>" id="blah" alt="image" style="width: 700px;height: 200px;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast;"/>
							</div>
						
							 <input type="file" class="imagesss" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" id="image" name="image">
							 <span class="form-text text-success">Photo (max 1600x1200)</span>
						</div>
							</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Title</label>
											<input type="text" class="form-control" name="title" autocomplete="off"/>
										    </div>
								    	</div>
								    <div class="col-lg-12">
								    	<div class="form-group">
											<label>Sub title (optional)</label>
											<input type="text" class="form-control" name="sub_title" autocomplete="off"/>
										</div>
								    </div>
								    <div class="col-lg-12">
								    	<div class="form-group">
											<label>Slide</label>
											<select class="form-control" name="slide">
												<option value="OFF" selected>OFF</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						</form>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary font-weight-bold btn-create-banner">Submit</button>
		            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view-banner-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	<form class="form" id="update-banner-form" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="row justify-content-center">
					<div class="col-xl-10 col-xxl-10">
						<!--begin::Group-->
					<div class="form-group row">
						<div class="col-lg-12 col-xl-12">
							<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
								<img class="images mx-auto d-block img-thumbnail z-depth-3 edit-image" id="change-image" alt="image" style="width: 700px;height: 200px;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast;"/>
							</div>
						
							 <input type="file" class="imagesss image-update" onchange="document.getElementById('change-image').src = window.URL.createObjectURL(this.files[0])" id="image" name="image">
							 <span class="form-text text-success">Photo (max 1600x1200)</span>
						</div>
							</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Title (optional)</label>
											<input type="text" class="form-control title" name="title" autocomplete="off"/>
										    </div>
								    	</div>
								    <div class="col-lg-12">
								    	<div class="form-group">
											<label>Sub title (optional)</label>
											<input type="text" class="form-control sub_title" name="sub_title" autocomplete="off"/>
										</div>
								    </div>
								    <div class="col-lg-12">
								    	<div class="form-group">
											<label>Slide</label>
											<select class="form-control slide" name="slide">
												<option value="OFF" selected>OFF</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary font-weight-bold btn-update-banner">Save changes</button>
		            </div>
        </div>
    </div>
</div>