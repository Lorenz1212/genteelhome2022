<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Genteel Home</title>
	<meta name="description" content="Updates and statistics" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="https://keenthemes.com/metronic" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="<?php echo base_url(); ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/imageview.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo/logo.jpg" />
</head>
<body>
	<div class="d-flex flex-column-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-xl-8 col-xxl-8">
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
						<td class="td1-w-150 td1-border"></td>
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
							<td class="text-right text-success">DOWNPAYMENT :</td>
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
	</div>
</body>
 <script type="text/javascript">
         window.onafterprint = window.close;
         window.print();
      </script>
</html>