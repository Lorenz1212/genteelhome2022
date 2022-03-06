<?php 
class Chart_model extends CI_Model{  
	private function TODAY_DATE($get){
	     date_default_timezone_set('Asia/Manila');
	     if($get == "date"){$now = date("Y-m-d");}
	     else if($get == "time"){$now = date("H:i");}
	     else if($get == "month"){$now = date("m");}
	     else if($get == "monthname"){$now = date("F");}
	     else if($get == "year"){$now = date("Y");}
	     else if($get == "day"){$now = date("D");}
	     else if($get == "thisdate"){$now = date("m/d/Y");}
	     return $now;
   }
	public function Fetch_Chart($type,$option,$year,$month){
		$data_label=array();
		$data_year=array();
		switch ($type) {
			case 'chart1':{
	               	$result = $this->db->select('MONTHNAME(date_position) as label_month, MONTH(date_position) as options')->from('tbl_cash_position')->where('YEAR(date_position)',$year)->group_by('MONTH(date_position)')->order_by('MONTH(date_position), MONTH(date_position)')->get()->result();
		                   foreach($result as $row){
		                   	$gensales = $this->db->select('SUM(amount) as amount')->from('tbl_cash_position')->where('YEAR(date_position)',$year)->where('MONTH(date_position)',$row->options)->where('type',2)->get()->row();
		                   	$expenses = $this->db->select('SUM(amount) as amount')->from('tbl_cash_position')->where('YEAR(date_position)',$year)->where('MONTH(date_position)',$row->options)->where('type',1)->get()->row();
		                   	$debit = $this->db->select('SUM(amount) as amount')->from('tbl_cash_position')->where('YEAR(date_position) =',$year)->where('MONTH(date_position) <',$row->options)->where('type',2)->get()->row();
		                   	$credit = $this->db->select('SUM(amount) as amount')->from('tbl_cash_position')->where('YEAR(date_position) =',$year)->where('MONTH(date_position) <',$row->options)->where('type',1)->get()->row();
		                   		$data_label['label'][] = array(
							                   			'label_month'=>$row->label_month,
							                   			'options'=>$row->options,
							                   			'gensales'=>$gensales->amount,
							                   			'expenses'=>$expenses->amount,
							                   			'beginning'=>floatval($debit->amount-$credit->amount));
		                   }
                   	$year_gensales = $this->db->select('SUM(amount) as amount')->from('tbl_cash_position')->where('YEAR(date_position)',$year)->where('type',2)->group_by('YEAR(date_position)')->get()->row();
                   	$year_expenses = $this->db->select('SUM(amount) as amount')->from('tbl_cash_position')->where('YEAR(date_position)',$year)->where('type',1)->group_by('YEAR(date_position)')->get()->row();
                   	$year_credit = $this->db->select('SUM(amount) as amount')->from('tbl_cash_position')->where('YEAR(date_position) <',$year)->where('type',1)->get()->row();
                   	$year_debit = $this->db->select('SUM(amount) as amount')->from('tbl_cash_position')->where('YEAR(date_position) <',$year)->where('type',2)->get()->row();
                   	$data_year['year'] = array('total_gensales'=>$year_gensales->amount,
	       										 'total_expenses'=> $year_expenses->amount,
	       										 'total_debit'=>$year_debit->amount,
	       										 'total_credit'=> $year_credit->amount);

                    return array_merge($data_label,$data_year);

				break;
			}

			case 'chart2':{
	           $start_date = date("Y-m", strtotime($year."-".$month))."-01";
	           $data_month['month'] = date("F", mktime(0, 0, 0, $month, 10));
	           $data_year['year'] = $year;
		       $start_time = strtotime($start_date);

		       $week1 = date("Y-m-d", strtotime("+1 week", $start_time)); 
		       $week2 = date("Y-m-d", strtotime("+2 week", $start_time)); 
		       $week3 = date("Y-m-d", strtotime("+3 week", $start_time)); 
		       $week4 = date("Y-m-d", strtotime("+4 week", $start_time));
		       
		       $current     = strtotime($start_date);
		       $first_week  = strtotime($week1);
		       $second_week = strtotime($week2);
		       $third_week  = strtotime($week3);
		       $fourth_week = strtotime($week4);

		       $data_week1 = array();
		       $data_week2 = array();
		       $data_week3 = array();
		       $data_week4 = array();
		       $data_expenses = array();
		       $data_sales = array();
		        while($current < $first_week ){
		            $data_week1[] = date('Y-m-d', $current);
		            $current = strtotime("+1 day", $current);
		        }
		        while($first_week < $second_week ) {
		            $data_week2[] = date('Y-m-d', $first_week);
		            $first_week = strtotime("+1 day", $first_week);
		        }
		        while($second_week < $third_week ) {
		            $data_week3[] = date('Y-m-d', $second_week);
		            $second_week = strtotime("+1 day", $second_week);
		        }
		        while($third_week <= $fourth_week ) {
		            $third_week = strtotime("+1 day", $third_week);
		            $data_week4[] = date('Y-m-d', $third_week);
		        }
		        $week4_start = date("Y-m-d", strtotime("+3 week", $start_time)); 
       			$week4_end = date("Y-m-t", strtotime($start_date));

				$row_wk1_less = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week1)->where('type',1)->get()->row();
		        $row_wk2_less = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week2)->where('type',1)->get()->row();
		        $row_wk3_less = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week3)->where('type',1)->get()->row();
		        $row_wk4_less = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where('date_position BETWEEN "'.$week4_start.'" AND "'.$week4_end.'"')->where('type',1)->get()->row();
		       
		        $row_wk1_add = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week1)->where('type',2)->get()->row();
		        $row_wk2_add = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week2)->where('type',2)->get()->row();
		        $row_wk3_add = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week3)->where('type',2)->get()->row();
		        $row_wk4_add = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where('date_position BETWEEN "'.$week4_start.'" AND "'.$week4_end.'"')->where('type',2)->get()->row();

		        if(!$row_wk1_less->amount){$week1_less = 0;}else{$week1_less = $row_wk1_less->amount;}
		        if(!$row_wk2_less->amount){$week2_less = 0;}else{$week2_less = $row_wk2_less->amount;}
		        if(!$row_wk3_less->amount){$week3_less = 0;}else{$week3_less = $row_wk3_less->amount;}
		        if(!$row_wk4_less->amount){$week4_less = 0;}else{$week4_less = $row_wk4_less->amount;}

		        if(!$row_wk1_add->amount){$week1_add = 0;}else{$week1_add = $row_wk1_add->amount;}
		        if(!$row_wk2_add->amount){$week2_add = 0;}else{$week2_add = $row_wk2_add->amount;}
		        if(!$row_wk3_add->amount){$week3_add = 0;}else{$week3_add = $row_wk3_add->amount;}
		        if(!$row_wk4_add->amount){$week4_add = 0;}else{$week4_add = $row_wk4_add->amount;}
		        $data_expenses['expenses'] = array('week1_less'=>$week1_less,
						    					   'week2_less'=>$week2_less,
						    					   'week3_less'=>$week3_less,
						    					   'week4_less'=>$week4_less);
		        $data_sales['sales'] = array('week1_add'=>$week1_add,
		    						'week2_add'=>$week2_add,
		    						'week3_add'=>$week3_add,
		    						'week4_add'=>$week4_add);
				return array_merge($data_expenses,$data_sales);
				break;
			}
			case 'chart3':{
				 $data_array=array();
				 $query = $this->db->select('*')->from('tbl_category_income')->where_not_in('id',[1,2,15])->get()->result();
				 foreach($query as $row){
				 	$expenses = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where('cat_id',$row->id)->where('YEAR(date_position)',$year)->where('MONTH(date_position)',$month)->get()->row();
				 	if(!$expenses->amount){$amount = 0;}else{$amount =$expenses->amount;}
				 	$data_array[] = array('name'=>$row->name,
				 						  'amount'=>$amount);
				 }
				return $data_array;
				break;
			}
			default:
				return false;
				break;
		}
	}

}
?>