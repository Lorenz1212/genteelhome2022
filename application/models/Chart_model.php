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
	public function Fetch_Options($type,$option){
        $data_gensales=array();
        $data_payout=array();
        $month = $this->TODAY_DATE("month");
		$monthname = $this->TODAY_DATE("monthname");
		$year = $this->TODAY_DATE("year");
		$data_default['default']=$year;
        switch($type){
            case 'all_options': { 
                    $result = $this->db->select('YEAR(date_position) as year')->from('tbl_cash_position')->where('date_position IS NOT NULL')->group_by('YEAR(date_position)')->order_by('YEAR(date_position)','ASC')->get();
					if($result){
						foreach ($result->result() as $row) {
						   	$data_gensales['gensales'][] = array('year'=>$row->year);	
						}
					}
					// $sql="SELECT YEAR(date_position) as year FROM tbl_cash_position WHERE date_position IS NOT NULL  GROUP BY YEAR(date_position) ORDER BY YEAR(date_position) ASC";   
     //                $result = $this->db->query($sql);
					// if($result){
					// 	foreach ($result->result() as $row) {
					// 	   	$data_payout['payout'][] = array('year'=>$row->year);	
					// 	}
					// }
					return array_merge($data_gensales,$data_default);
	                break;
	               }
            case 'chart1_options': { 
                    if($option == 'DAY'){
                    	 $result = $this->db->select('YEAR(date_position) as year, MONTHNAME(date_position) as monthname, MONTH(date_position) as month')->from('tbl_cash_position')->where('date_position IS NOT NULL')->group_by('YEAR(date_position), MONTH(date_position)')->order_by('YEAR(date_position), MONTH(date_position)','ASC')->get()->result();
                    }else{
                      $result = $this->db->select('YEAR(date_position) as year')->from('tbl_cash_position')->where('date_position IS NOT NULL')->group_by('YEAR(date_position)')->order_by('YEAR(date_position)','ASC')->get()->result();
                    }
                    if($result){
                        return $result;
                    }else{
                        if($option =='DAY'){
	                    	$data_default['default']=array(
	                    		'month'=>$month,
	                    		'monthname'=>$monthname,
	                    		'year'=>$year
	                    	);
	                    	return $data_default;
	                    }else{
	                    	return $data_default; 
	                    }
                    }
                    break; 
            }
            // case 'chart2_options': { 
            //         if($option == 'DAY'){
            //           $sql="SELECT YEAR(date_update) as year, MONTHNAME(date_update) as monthname, MONTH(date_update) as month FROM tbl_payout_details WHERE date_update IS NOT NULL GROUP BY YEAR(date_update), MONTH(date_update) ORDER BY YEAR(date_update), MONTH(date_update) ASC";
            //         }else{
            //           $sql="SELECT YEAR(date_update) as year FROM tbl_payout_details WHERE date_update IS NOT NULL GROUP BY YEAR(date_update) ORDER BY YEAR(date_update) ASC";   
            //         }
            //         $result = $this->db->query($sql);
            //         if($result){
            //             return $result;
            //         }else{
            //             if($option =='DAY'){
	           //          	$data_default['default']=array(
	           //          		'month'=>$month,
	           //          		'monthname'=>$monthname,
	           //          		'year'=>$year
	           //          	);
	           //          	return $data_default;
	           //          }else{
	           //          	return $data_default; 
	           //          }
            //         }
            //         break; 
            //  }

			default: 
	            return false;
	            break;
        }
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

			// case 'chart2':{
			// 	if($option == "DAY"){
   //                  $data = explode('-', $year);
   //                   $newmonth = $data[1];
   //                   $newyear = $data[0];
   //                   $sql ="SELECT MONTHNAME(date_position) as label_month, $option(date_position) as options,  SUM(amount) as gensales  FROM 	tbl_cash_position WHERE YEAR(date_position) = '$newyear' AND MONTH(date_position) = '$newmonth' GROUP BY DATE(date_position) ORDER BY MONTH(date_position), $option(date_position)";
   //                 }else if($option == "WEEK"){

   //                  $sql ="SELECT MONTHNAME(date_position) as label_month, WEEK(date_position, 4) as options, SUM(amount) as gensales  FROM 	tbl_cash_position WHERE YEAR(date_position) = '$year' GROUP BY WEEK(date_position, 4) ORDER BY WEEK(date_update, 4)";

   //                 }else if($option == "MONTH"){
   //                  $sql ="SELECT MONTHNAME(date_position) as label_month, MONTH(date_position) as options, SUM(amount) as gensales  FROM 	tbl_cash_position WHERE YEAR(date_position) = '$year' GROUP BY MONTH(date_position) ORDER BY MONTH(date_position), MONTH(date_position)";
   //                 }

			// 	$result = $this->db->query($sql);
			// 	if(!$result){
			// 		return false;
			// 	}else{
			// 		return $result;
			// 	}
			// 	break;
			// }
			// case 'chart3':{
			// 	 $sql="SELECT COUNT(code_package) AS bronze ,(SELECT COUNT(code_package) FROM tbl_code_details WHERE code_package='2') AS silver,(SELECT COUNT(code_package) FROM tbl_code_details WHERE code_package='3') AS gold,(SELECT COUNT(code_package) FROM tbl_code_details WHERE code_package='4') AS bronze_free,(SELECT COUNT(code_package) FROM tbl_code_details WHERE code_package='5') AS silver_free,(SELECT COUNT(code_package) FROM tbl_code_details WHERE code_package='6') AS gold_free FROM tbl_code_details WHERE code_package='1'; ";
			// 	$result = $this->db->query($sql);
			// 	if(!$result){
			// 		return false;
			// 	}else{
			// 		return $result;
			// 	}
			// 	break;
			// }
			default:
				return false;
				break;
		}
	}

}
?>