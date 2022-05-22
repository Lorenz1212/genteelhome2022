<?php 
class Accounting_model extends CI_Model{  

	function Reports_Projectmonitoring($type,$val,$val1){
		switch ($type) {
			case "fetch_project_monitoring_joborder":{
				$query = $this->db->query("SELECT * FROM tbl_project ORDER BY production_no DESC"); 
		     	if($query){
		     		 $data=array();
		              foreach($query->result() as $row)  {
				             $data[] = array('id'=> $row->id,
				                      		 'production_no'=> $row->production_no);
		               }  
		              return $data; 
		        }else{
		        	return false;
		        }
				break;
			}
			case "fetch_project_monitoring_type":{
				$id = $this->encryption->decrypt($val);
				$type = $val1;
				$row = $this->db->query("SELECT * FROM tbl_project WHERE id='$id'")->row();
				if($row){
					$production_no = $row->production_no;
					$query = $this->db->query("SELECT *,(SELECT CONCAT(item,' ',unit) FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name FROM tbl_material_project WHERE production_no='$production_no' AND mat_type='$type'");
					if($query){
						foreach($query->result() as $row){
							$data[]=array('id'=>$row->id,
										  'item'=>$row->item_name);
						}
						return $data;
					}else{
						return false;
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_project_monitoring_material":{
				$row = $this->db->query("SELECT * FROM tbl_material_project WHERE id='$val'")->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}
			case 'fetch_project_monitoring':{
			 $data_info=array();
             $data_framing=array();
             $data_mechanism=array();
             $data_finishing=array();
             $data_sulihiya=array();
             $data_upholstery =array();
             $data_others=array();
             $row = $this->db->query("SELECT *,DATE_FORMAT(start_date, '%M %d %Y') as start_date_name,DATE_FORMAT(due_date, '%M %d %Y') as due_date_name FROM tbl_project WHERE id='$val'")->row();
             $data_info['id']=$this->encryption->encrypt($row->id);
             $data_info['info']=$row;
             $production_no = $row->production_no;
             $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=1");
                 if($query){
                     foreach($query->result() as $row){
                        $data_framing['framing'][] = $row;
                     }
                 }
            $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=2");
                 if($query){
                     foreach($query->result() as $row){
                        $data_mechanism['mechanism'][] = $row;
                     }
                 }
            $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=3");
                 if($query){
                     foreach($query->result() as $row){
                        $data_finishing['finishing'][] = $row;
                     }
                 }
             $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=4");
                 if($query){
                     foreach($query->result() as $row){
                        $data_sulihiya['sulihiya'][] = $row;
                     }
                 }
            $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=5");
                 if($query){
                     foreach($query->result() as $row){
                        $data_upholstery['upholstery'][] = $row;
                     }
                 }
            $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=6");
                 if($query){
                     foreach($query->result() as $row){
                        $data_others['others'][] = $row;
                     }
                 }                  
            return array_merge($data_info,$data_framing,$data_mechanism,$data_finishing,$data_sulihiya,$data_upholstery,$data_others);
			break;
			}
			default:
			return false;
			break;
		}
    }
    function Submit_Report_Projectmontoring($type,$customer,$address,$amount,$labor,$start,$end,$id){
       switch($type){
       	case"edit_project_monitoring_details":{
       		$id = $this->encryption->decrypt($id);
       		$amount = floatval(str_replace(',', '', $amount));
       		$labor = floatval(str_replace(',', '', $labor));
       		$start_date =  date('Y-m-d',strtotime($start));
       		$end_date =  date('Y-m-d',strtotime($end));
       		$data = array(
			        'customer' => $customer,
			        'address' => $address,
			        'amount' => $amount,
			        'labor' => $labor,
			        'start_date' => $start_date,
			        'due_date'=> $end_date);
			$result = $this->db->where('id', $id)->update('tbl_project', $data);
			if($result){
				return array('type'=>'success','message'=>'Save Changes');
			}else{
				return array('type'=>'info','message'=>'Nothing Changes');
			}
       		break;
       	}
       }
    }
     function Submit_Report_Projectmontoring_Material($type,$id,$quantity_costing,$cost){
       switch($type){
       	case "edit_project_monitoring_materials":{
       		$cost = floatval(str_replace(',', '', $cost));
       		$data = array(
			        'total_qty' => $quantity_costing,
			        'cost' => $cost);
			$result = $this->db->where('id', $id)->update('tbl_material_project', $data);
			if($result){
				return array('type'=>'success','message'=>'Save Changes');
			}else{
				return array('type'=>'info','message'=>'Nothing Changes');
			}
       		break;
       	}

       }
    }


}