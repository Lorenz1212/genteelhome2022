<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<style type="text/css">
 body {
      -webkit-print-color-adjust: exact;
    }
	.pad1-r{
    padding-left: 0px;
  }
  .table1-size{
    width: 100%;
  }
  .table1-fixed{
    table-layout: fixed ;
    width: 100%;
  }
  .td1-header{
    background-color:#b9a08c;
    height: 30px;
  }
  .td1-w-50{
    width: 50px;
  }
  .td1-w-100{
    width:100px;
  }
  .td1-w-150{
    width:150px;
    padding-right:50px;
  }
  .td1-border{
    border-bottom: 1.4px solid black;
  }
  .td1-border-1px{
    border: 1px solid black;
    padding-left: 5px;
    padding-right: 5px;
  }
  .td1-padding td, th{
    padding-left: 5px;
    padding-right: 5px;
  }
  .image1-size-r{
    width: 350px;
    height: 145px;
  }

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  .image1-size-r{
    width: 150px;
    height: 110px;
  }
} 

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
 	.image1-size-r{
    width: 210px;
    height: 115px;
  }
} 

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
  .image1-size-r{
    width: 350px;
    height: 145px;
  }
}  
@media print {
	.image1-size-r{
    width: 300px;
    height: 145px;
  }
    @page {
        margin-left: .5em;
        margin-right: .6em;
        size: A4;
    }
}
</style>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Genteel Home</title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo/logo.jpg" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div id="kt_content" data-table="data-salesorder-stocks-print"></div>
	<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xl-8 col-xxl-8">
				<span class="text-dark text-right d-flex flex-column pad-r">
					<span>124 FIL-AM HIGHWAY TRINIDAD VILLAGE</span>
					<span>CALIBUTBUT BACOLOR PAMPANGA</span>
					<span>0917 134 0983</span>
					<span>finance@genteelhome.co</span>
				</span>
			</div>
			<div class="col-md-3 col-xl-3 col-xxl-3">
				<img src="<?php echo base_url()?>assets/images/logo/logo-so.jpg" class="image1-size-r" alt="">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12 col-xxl-12">
				<table class="table1-size">
					<tr>
						<td colspan="4" class="text-center text-white td1-header">BILLING STATEMENT</td>
					</tr>
					<tr>
						<td></br></td>
					</tr>
					<tr>
						<td class="td1-w-50"><b>Sold to :</b></td>
						<td class="td1-w-150 td1-border sold-to"></td>
						<td class="text-center td1-w-100"> <b>Date :</b></td>
						<td class="td1-w-150 td1-border date-order"></td>
					</tr>
					<tr>
						<td class="td1-w-50"><b>TIN :</b></td>
						<td class="td1-w-150 td1-border tin"></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td class="td1-w-50"><b>Address :</b></td>
						<td class="td1-w-150 td1-border address"></td>
						<td></td>
						<td class="td1-w-150 td1-border so_no"></td>
					</tr>
				</table>
			</div>
		</div>
	</br>
		<div class="row">
			<div class="col-md-12 col-xxl-12">
				<table class="table1-fixed" id="kt_table_soa_item">
					<thead>
					<tr>
						<th class="text-center td1-border-1px">DESCRIPTION</th>
						<th class="text-center td1-border-1px">AMOUNT</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				</br>
				<table class="table1-fixed td1-padding">
						<tr class="tr-discount">
						</tr>
						<tr>
							<td class="text-right text-success">DOWNPAYMENT <span class="td-date-downpayment"></span> :</td>
							<td class="text-right text-success"><div style="float:left;">₱</div><div class="td-downpayment" style="float:right;"><div></td>
						</tr>
						<tr class="tr-shipping">
						</tr>
						<tr>
							<td class="text-right text-danger">AMOUNT DUE <span class="vat-included"></span> :</td>
							<td class="text-right text-danger"><div style="float:left;">₱</div><div class="td-amountdue" style="float:right;"><div></td>
						</tr>
				</table>
			</div>
		</div>
	</div>
</body>
<script type='text/javascript'>
var baseURL = "<?php echo base_url();?>";
</script>
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<script src="<?php echo base_url(); ?>assets/plugins/global/plugins.bundle.js"  type='text/javascript'></script>
<script src="<?php echo base_url(); ?>assets/plugins/custom/prismjs/prismjs.bundle.js"  type='text/javascript'></script>
<script src="<?php echo base_url(); ?>assets/js/scripts.bundle.js"  type='text/javascript'></script>
<script src="<?php echo base_url(); ?>assets/js/pages/my-script.js"  type='text/javascript'></script>
<script type="text/javascript">
$(document).ready(function(){
      setTimeout(function(){
          window.print();
      }, 1000);
       window.onafterprint = window.close;
 })	
</script> 
</html>