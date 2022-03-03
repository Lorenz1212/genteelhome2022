<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-table="data-material-used">
	<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
		<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex flex-column">
					<h2 class="text-white font-weight-bold my-2 mr-5">Production Supplies</h2>
					<div class="d-flex align-items-center font-weight-bold my-2">
						<a href="#" class="opacity-75 hover-opacity-100">
							<i class="flaticon2-shelter text-white icon-1x"></i>
						</a>
						<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
						<span class="text-white text-hover-white opacity-75 hover-opacity-100">Uses</span>
					</div>
				</div>
			</div>
		</div>
</div>
<!--end::Subheader-->
<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<form class="form"  data-link="Create_MaterialUsed">
			  <div class="card card-custom">
				 <div class="card-header">
				  <div class="card-title">
			            <span class="card-icon">
			                <i class="flaticon2-chat-1 text-primary"></i>
			            </span>
			            <select type="text" class="form-control" id="joborder" name="production_no"><option value="" disabled="" selected="">SELECT JOB ORDER</option></select>
				  </div>
				        <div class="card-toolbar">
				            <button type="submit" id="Create_MaterialUsed" class="btn btn-sm btn-success font-weight-bold"><i class="flaticon2-cube"></i> Submit</button>
				        </div>
				 </div>
				 <div class="card-body">
				 	<div class="row">
				 		<div class="col-xl-4 col-md-4">
				 			<div class="form-group">
					 			<label>ITEM</label>
					 			<input type="text" class="form-control" id="title" disabled="">
				 			</div>
				 		</div>
				 		<div class="col-xl-4 col-md-4">
				 			<div class="form-group">
					 			<label>PALLETE COLOR</label>
					 			<input type="text" class="form-control" id="c_name" disabled="">
				 			</div>
				 		</div>
				 	</div>
				 	<div class="row justify-content-center">
				 		<div class="col-xl-12 col-xxl-7">
				   			<table class="table" id="tbl-material-used"></table>
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