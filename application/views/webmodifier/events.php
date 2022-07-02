<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Featured</h2>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<button type="button" class="btn btn-white font-weight-bold py-3 px-6" data-toggle="modal" data-target="#create-events-modal" data-action="Create">Create New Featured</button>
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
						<table class="table table-bordered table-hover" id="tbl_events">
							<thead>
								<tr>
									<th>IMAGE</th>
									<th>TITLE</th>
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
<div class="modal fade" id="create-events-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Featured</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	  <form class="form" id="create-event-form" enctype="multipart/form-data" accept-charset="utf-8">
							<div class="form-group">
								<div class="col-lg-12 col-xl-12">
									<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
										<img class="images mx-auto d-block img-thumbnail z-depth-3 image-create" src="<?php echo base_url('assets/images/events/default.jpg');?>" id="blah" alt="image" style="width: 480px;height: 300px;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast;"/>
									</div>
									 <input type="file" value="" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" id="image" name="image">
									  <span class="form-text text-danger">Photo (max 400x400)</span>
								</div>
							</div>
							<div class="form-group">
									<label>Title</label>
									<input type="text" class="form-control" name="title" autocomplete="off"/>
								</div>
								<div class="form-group">
									<label>Date Posting</label>
									<input type="date" class="form-control" id="date_event" name="date_event" placeholder="MM/DD/YYYY" autocomplete="off" required/>
								</div>
								<div class="form-group">
									<label>Description</label>
									<textarea class="form-control" name="description" rows="5" autocomplete="off" required></textarea>
								</div>
							</form>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary font-weight-bold btn-create-events">Submit</button>
		            </div>
		        </div>
		    </div>
		</div>
<div class="modal fade" id="update-events-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Featured</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            	  <form class="form" id="update-events-form" enctype="multipart/form-data" accept-charset="utf-8">
							<div class="form-group">
								<div class="col-lg-12 col-xl-12">
									<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">
										<img class="images mx-auto d-block img-thumbnail z-depth-3 image-update" src="<?php echo base_url('assets/images/events/default.jpg');?>" id="blah" alt="image" style="width: 480px;height: 300px;image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;image-rendering: -webkit-optimize-contrast;"/>
									</div>
									 <input type="file" value="" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" id="image" name="image">
									  <span class="form-text text-danger">Photo (max 400x400)</span>
								</div>
							</div>
							<div class="form-group">
									<label>Title</label>
									<input type="text" class="form-control title" name="title" required autocomplete="off"/>
								</div>
								<div class="form-group">
									<label>Date Posting</label>
									<input type="date" class="form-control date-event" id="date_event" name="date_event" placeholder="MM/DD/YYYY" autocomplete="off" required/>
								</div>
								<div class="form-group">
									<label>Description</label>
									<textarea class="form-control description-update" name="description" rows="5" autocomplete="off" required></textarea>
								</div>
							</form>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary font-weight-bold btn-update-events">Save changes</button>
		            </div>
		        </div>
		    </div>
		</div>