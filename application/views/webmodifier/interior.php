<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-interior-list">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Interior Design</h2>
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
				<button type="button" class="btn btn-white font-weight-bold py-3 px-6" id="form-request" data-toggle="modal" data-target="#exampleModal" data-action="Create">Add Interior Design</button>
			</div>
		</div>
	</div>
	<!--end::Subheader-->
<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row" id="interior"></div>
		</div>
	</div>
</div>
<!--end::Content-->

<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="max-height: 100%;
overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Interior Design</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" id="Create_Update_Interior" data-link="Create_Update_Interior" enctype="multipart/form-data" accept-charset="utf-8">
    		<input type="hidden" name="previous_image"/>
    		<input type="hidden" name="previous_bg"/>
			<input type="hidden" name="id"/>
			<input type="hidden" name="page"/>
            <div class="modal-body">
				<div class="row justify-content-center">
					<div class="col-xl-10 col-xxl-10">
						<!--begin::Group-->
							<div class="form-group row">
								<div class="col-lg-12 col-xl-12">
									<label><h3>BACKGROUND</h3> image size(810 x 460)</label>
									<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
										<img class="background-image mx-auto d-block img-thumbnail z-depth-3" id="bg" alt="image" style="width: 700px;height: 300px;"/>
									</div>
									 <input type="file" value="" onchange="document.getElementById('bg').src = window.URL.createObjectURL(this.files[0])" id="bg_image" name="bg_image">
								</div>
							</div>
							<div class="form-group row">
									<div class="col-lg-12 col-xl-12">
										<label><h3>BANNER</h3> image size(1140 x 660)</label>
										<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
											<img class="images mx-auto d-block img-thumbnail z-depth-3" id="blah" alt="image" style="width: 700px;height: 300px;"/>
										</div>
										 <input type="file" value="" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" id="image" name="image">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-lg-8">
										<label>Title</label>
										<input type="text" class="form-control form-control-solid form-control-lg" name="title" required="" />
								    </div>
								    <div class="col-lg-4">
										<label>Status</label>
										<select class="form-control form-control-solid form-control-lg" name="status" required="">
											<option value="" selected disabled>SELECT CATEGORY</option>
											<option value="ACTIVE">ACTIVE</option>
											<option value="INACTIVE">INACTIVE</option>
										</select>
								    </div>
								    <div class="col-lg-8">
										<label>PROJECT CATEGORY</label>
										<select class="form-control form-control-solid form-control-lg" name="cat_id" required="">
											<option value="">SELECT CATEGORY</option>
											<option value="1">RESIDENTIAL PROJECT</option>
											<option value="2">COMMERCIAL PROJECT</option>
											<option value="3">EXPERIENCES</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-lg-12">
										<label>Description</label>
										<div id="description" class="description"></div>
									</div>
								</div>
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

<!-- <div class="modal fade" id="PhotoModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="project_name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" data-link="Create_Update_Interior" enctype="multipart/form-data" accept-charset="utf-8">
				<input type="hidden" name="id"/>
           		<div class="modal-body">
					<div class="row">
					  	<div class="col-lg-4 col-xl-4">
						  	  <div class="form-group">
							    <label>Status</label>
								    <div class="input-group">
								     <select class="form-control" id="status" name="status">
								   		<option value="">SELECT STATUS</option>
								   		<option value="ACTIVE">ACTIVE</option>
								   		<option value="INACTIVE">INACTIVE</option>
								   </select>
								   <div class="input-group-append">
								      <button class="btn btn-secondary save" type="button" id="save_status">SAVE</button>
								     </div>
							    </div>
						   </div>
					  	</div>
					  	<div class="col-lg-4 col-xl-4">
							  <div class="form-group">
							    <label>Upload Photo</label>
								   <div class="input-group">
								     <input type="text" class="form-control form-control-solid upfile1g" id="customFileg" style="cursor:pointer;" readonly="" />
								     <input type="file" value="" accept=".png, .jpg, .jpeg" onchange="document.getElementById('customFileg').value = window.URL.createObjectURL(this.files[0])" id="imagefileg" name="gallery" style="display:none"/>
								   <div class="input-group-append">
								      <button class="btn btn-secondary save" type="button" id="save_gallery">SAVE</button>
								     </div>
							    </div>
						   </div>
					  	</div>
				  	</div>
				  <div class="row" id="divgallery" style="height: 500px;">
				  	</div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
       		</form>
        </div>
    </div>
</div> -->