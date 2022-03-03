<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-banner-list">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Banner</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Set Up</a>
					</div>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<button type="button" class="btn btn-white font-weight-bold py-3 px-6" id="form-request" data-toggle="modal" data-target="#exampleModal" data-action="Create">Add New Slide</button>
			</div>
		</div>
	</div>
	<!--end::Subheader-->
<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row" id="banner"></div>
		</div>
	</div>
</div>
<!--end::Content-->

<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" id="Create_Update_Banner" data-link="Create_Update_Banner" enctype="multipart/form-data" accept-charset="utf-8">
            		<input type="hidden" name="previous_image"/>
					<input type="hidden" name="id"/>
					<input type="hidden" name="page"/>
					<input type="hidden" name="web_no"/>
            <div class="modal-body">
				<div class="row justify-content-center">
					<div class="col-xl-10 col-xxl-10">
						<!--begin::Group-->
					<div class="form-group row">
						<div class="col-lg-12 col-xl-12">
							<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
								<img class="images mx-auto d-block img-thumbnail z-depth-3" id="blah" alt="image" style="width: 700px;height: 300px;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast;"/>
							</div>
						
							 <input type="file" class="imagesss" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" id="image" name="image">
							 <span class="form-text text-success">Photo (max 1600x1200)</span>
						</div>
							</div>
								<div class="form-group row">
									<!-- <div class="col-lg-8">
									<label>Title</label>
									<input type="text" class="form-control form-control-solid form-control-lg" name="title" autocomplete="off"/>
								    </div> -->
								    <div class="col-lg-4">
									<label>Slide</label>
									<select class="form-control form-control-solid form-control-lg" name="type">
										<option value="none">Hide</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
									</div>
								</div>
								<!-- <div class="form-group row">
									<div class="col-lg-12">
									<label>Description</label>
									<textarea id="kt-tinymce-1" class="tox-target"></textarea>
									</div>
								</div> -->
								
							</div>
						</div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary font-weight-bold type">Save changes</button>
		            </div>
       		</form>
        </div>
    </div>
</div>