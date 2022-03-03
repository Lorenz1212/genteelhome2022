<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Print_controller extends CI_Controller 
{ 
	public function print_rawmats(){
		$this->load->view('reviewer/print_rawmaterials.php');
	}
	public function print_salesorder($id=null){
		$this->load->view('reviewer/print_salesorder.php');
	}
}
?>