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
                    $sql="SELECT YEAR(date_position) as year FROM tbl_cash_position WHERE date_position IS NOT NULL  GROUP BY YEAR(date_position) ORDER BY YEAR(date_position) ASC";   
                    $result = $this->db->query($sql);
					if($result){
						foreach ($result->result() as $row) {
						   	$data_gensales['gensales'][] = array('year'=>$row->year);	
						}
					}
					$sql="SELECT YEAR(date_position) as year FROM tbl_cash_position WHERE date_position IS NOT NULL  GROUP BY YEAR(date_position) ORDER BY YEAR(date_position) ASC";   
                    $result = $this->db->query($sql);
					if($result){
						foreach ($result->result() as $row) {
						   	$data_payout['payout'][] = array('year'=>$row->year);	
						}
					}
					return array_merge($data_gensales,$data_payout,$data_default);
	                break;
	               }
            case 'chart1_options': { 
                    if($option == 'DAY'){
                      $sql="SELECT YEAR(date_position) as year, MONTHNAME(date_position) as monthname, MONTH(date_position) as month FROM tbl_cash_position WHERE date_position IS NOT NULL GROUP BY YEAR(date_position), MONTH(date_position) ORDER BY YEAR(date_position), MONTH(date_position) ASC";
                    }else{
                      $sql="SELECT YEAR(date_position) as year FROM tbl_cash_position WHERE date_position IS NOT NULL GROUP BY YEAR(date_position) ORDER BY YEAR(date_position) ASC";   
                    }
                    $result = $this->db->query($sql);
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
            case 'chart2_options': { 
                    if($option == 'DAY'){
                      $sql="SELECT YEAR(date_update) as year, MONTHNAME(date_update) as monthname, MONTH(date_update) as month FROM tbl_payout_details WHERE date_update IS NOT NULL GROUP BY YEAR(date_update), MONTH(date_update) ORDER BY YEAR(date_update), MONTH(date_update) ASC";
                    }else{
                      $sql="SELECT YEAR(date_update) as year FROM tbl_payout_details WHERE date_update IS NOT NULL GROUP BY YEAR(date_update) ORDER BY YEAR(date_update) ASC";   
                    }
                    $result = $this->db->query($sql);
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

			default: 
	            return false;
	            break;
        }
	}
	public function Fetch_Chart($type,$option,$year,$month){
		switch ($type) {
			case 'chart1':{
				if($option == "DAY"){
                    $data = explode('-', $year);
                     $newmonth = $data[1];
                     $newyear = $data[0];
                     $sql ="SELECT MONTHNAME(date_position) as label_month, $option(date_position) as options,  SUM(amount) as gensales  FROM tbl_cash_position WHERE YEAR(date_position) = '$newyear' AND MONTH(date_position) = '$newmonth' GROUP BY DATE(date_position) ORDER BY MONTH(date_position), $option(date_position)";
                   }else if($option == "WEEK"){

                    $sql ="SELECT MONTHNAME(date_position) as label_month, WEEK(date_position, 4) as options, SUM(amount) as gensales  FROM tbl_cash_position WHERE YEAR(date_position) = '$year' GROUP BY WEEK(date_position, 4) ORDER BY WEEK(date_position, 4)";

                   }else if($option == "MONTH"){
                    $sql ="SELECT MONTHNAME(date_position) as label_month, MONTH(date_position) as options, SUM(amount) as gensales  FROM 	tbl_cash_position WHERE YEAR(date_position) = '$year' GROUP BY MONTH(date_position) ORDER BY MONTH(date_position), MONTH(date_position)";
                   }

				$result = $this->db->query($sql);
				if(!$result){
					return false;
				}else{
					return $result;
				}
				break;
			}

			case 'chart2':{
				if($option == "DAY"){
                    $data = explode('-', $year);
                     $newmonth = $data[1];
                     $newyear = $data[0];
                     $sql ="SELECT MONTHNAME(date_position) as label_month, $option(date_position) as options,  SUM(amount) as gensales  FROM 	tbl_cash_position WHERE YEAR(date_position) = '$newyear' AND MONTH(date_position) = '$newmonth' GROUP BY DATE(date_position) ORDER BY MONTH(date_position), $option(date_position)";
                   }else if($option == "WEEK"){

                    $sql ="SELECT MONTHNAME(date_position) as label_month, WEEK(date_position, 4) as options, SUM(amount) as gensales  FROM 	tbl_cash_position WHERE YEAR(date_position) = '$year' GROUP BY WEEK(date_position, 4) ORDER BY WEEK(date_update, 4)";

                   }else if($option == "MONTH"){
                    $sql ="SELECT MONTHNAME(date_position) as label_month, MONTH(date_position) as options, SUM(amount) as gensales  FROM 	tbl_cash_position WHERE YEAR(date_position) = '$year' GROUP BY MONTH(date_position) ORDER BY MONTH(date_position), MONTH(date_position)";
                   }

				$result = $this->db->query($sql);
				if(!$result){
					return false;
				}else{
					return $result;
				}
				break;
			}
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