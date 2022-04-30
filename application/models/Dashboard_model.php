<?php
class Dashboard_model extends CI_Model
{  
   //Fetch Data
    function designer_dashboard($id){        
        $request_stocks = $this->db->select('count(id) as id')->from('tbl_project_color')->where('type',1)->where('status', 1)->get()->row();  
        $approved_stocks = $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$id)->where('type',1)->where('status',2)->get()->row();
        $rejected_stocks =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$id)->where('type',1)->where('status', 3)->get()->row();

        $request_project = $this->db->select('count(id) as id')->from('tbl_project_color')->where('type',2)->where('status',1)->get()->row();  
        $approved_project =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$id)->where('type',2)->where('status',2)->get()->row();
        $rejected_project =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$id)->where('type',2)->where('status',3)->get()->row();

        $request_jo_stocks = $this->db->select('count(id) as id')->from('tbl_project')->where('type',1)->where('status',2)->get()->row();
        $request_jo_project = $this->db->select('count(id) as id')->from('tbl_project')->where('type',2)->where('status',2)->get()->row();

        $request_material_pending = $this->db->select('count(id) as id')->from('tbl_other_material_m_request')->where('status',1)->where('created_by',$id)->get()->row();
        $request_material_received = $this->db->select('count(id) as id')->from('tbl_other_material_m_received')->where('created_by',$id)->get()->row();
        $request_material_cancelled = $this->db->select('count(id) as id')->from('tbl_other_material_m_request')->where('status',3)->where('created_by',$id)->get()->row();


        $request_pre_order_pending = $this->db->select('count(id) as id')->from('tbl_cart_pre_order')->where('status',1)->get()->row();
        $request_pre_order_approved = $this->db->select('count(id) as id')->from('tbl_cart_pre_order')->where('status',2)->get()->row();
        $request_pre_order_rejected = $this->db->select('count(id) as id')->from('tbl_cart_pre_order')->where('status',3)->get()->row();

        $request_customized_pending = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','P')->get()->row();
        $request_customized_approved = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','A')->where('update_by',$id)->get()->row();

        $request_customized_rejected = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','R')->where('update_by',$id)->get()->row();

        $request_preoder_customized = intval($request_pre_order_pending->id+$request_customized_pending->id);
        $request_stocks_project = intval($request_stocks->id+$request_project->id);

        $data = array('request_stocks'  => $request_stocks->id,
                      'approved_stocks' => $approved_stocks->id,
                      'rejected_stocks' => $rejected_stocks->id,
                      'request_project' => $request_project->id,
                      'approved_project'=> $approved_project->id,
                      'rejected_project'=> $rejected_project->id,
                      'request_stocks_project'=>$request_stocks_project,
                      'request_jo_stocks'=>$request_jo_stocks->id,
                      'request_jo_project'=>$request_jo_project->id,
                      'request_jo_designer'=>intval($request_jo_stocks->id+$request_jo_project->id),
                      'request_material_pending'=>$request_material_pending->id,
                      'request_material_received'=>$request_material_received->id,
                      'request_material_cancelled'=>$request_material_cancelled->id,
                      'request_pre_order_pending'=>$request_pre_order_pending->id,
                      'request_pre_order_approved'=>$request_pre_order_approved->id,
                      'request_pre_order_rejected'=>$request_pre_order_rejected->id,
                      'request_customized_pending'=>$request_customized_pending->id,
                      'request_customized_approved'=>$request_customized_approved->id,
                      'request_customized_rejected'=>$request_customized_rejected->id,
                      'request_preoder_customized'=>$request_preoder_customized);
        return $data;   
  }
  function production_dashboard($id){        
    $request_jo_stocks = $this->db->select('count(id) as id')->from('tbl_project')->where('assigned',$id)->where('type',1)->where('status',2)->get()->row();
    $request_jo_project = $this->db->select('count(id) as id')->from('tbl_project')->where('assigned',$id)->where('type',2)->where('status',2)->get()->row();

    $request_sales_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('created_by',$id)->where('status','P')->get()->row();
    $request_sales_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('created_by',$id)->where('status','P')->get()->row();

    $sales_shipping_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('created_by',$id)->where('delivery',1)->get()->row();
    $sales_deliver_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('created_by',$id)->where('delivery',2)->get()->row();

    $sales_shipping_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('created_by',$id)->where('delivery',1)->get()->row();
    $sales_deliver_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('created_by',$id)->where('delivery',2)->get()->row();

    $data = array('request_jo_stocks'=>$request_jo_stocks->id,
                  'request_jo_project'=>$request_jo_project->id,
                  'request_jo_production'=>intval($request_jo_stocks->id+$request_jo_project->id),
                  'request_sales_stocks'=>$request_sales_stocks->id,
                  'request_sales_project'=>$request_sales_project->id,
                  'request_salesorder'=>intval($request_sales_project->id+$request_sales_stocks->id),
                  'sales_shipping_stocks'=>$sales_shipping_stocks->id,
                  'sales_deliver_stocks'=>$sales_deliver_stocks->id,
                  'sales_shipping_project'=>$sales_shipping_project->id,
                  'sales_deliver_project'=>$sales_deliver_project->id,
              );
    return $data; 
  } 
   function admin_dashboard(){   
      $request_stocks = $this->db->select('count(id) as id')->from('tbl_project_color')->where('type',1)->where('status', 1)->get()->row();  
      $approved_stocks = $this->db->select('count(id) as id')->from('tbl_project_color')->where('type',1)->where('status',2)->get()->row();
      $rejected_stocks =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('type',1)->where('status', 3)->get()->row();

      $request_project = $this->db->select('count(id) as id')->from('tbl_project_color')->where('type',2)->where('status',1)->get()->row();  
      $approved_project =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('type',2)->where('status',2)->get()->row();
      $rejected_project =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('type',2)->where('status',3)->get()->row();

      $request_sales_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('status','P')->get()->row();
      $approved_sales_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('status','A')->get()->row();
      $rejected_sales_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('status','R')->get()->row();

      $request_sales_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('status','P')->get()->row();
      $approved_sales_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('status','A')->get()->row();
      $rejected_sales_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('status','R')->get()->row();


      $stocks_inpection_pending = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',1)->where('status',1)->get()->row();
      $stocks_inpection_approved = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',1)->where('status',2)->get()->row();
      $stocks_inpection_rejected = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',1)->where('status',3)->get()->row();

      $project_inpection_pending = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',2)->where('status',1)->get()->row();
      $project_inpection_approved = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',2)->where('status',2)->get()->row();
      $project_inpection_rejected = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',2)->where('status',3)->get()->row();

      $total_request = intval($request_stocks->id+$request_project->id+$request_sales_stocks->id+$request_sales_project->id+$project_inpection_pending->id+$stocks_inpection_pending->id);
	    $data = array('request_stocks'  => $request_stocks->id,
                    'approved_stocks' => $approved_stocks->id,
                    'rejected_stocks' => $rejected_stocks->id,
                    'request_project' => $request_project->id,
                    'approved_project'=> $approved_project->id,
                    'rejected_project'=> $rejected_project->id,
                    'request_sales_stocks'=>$request_sales_stocks->id,
                    'approved_sales_stocks'=>$approved_sales_stocks->id,
                    'rejected_sales_stocks'=>$rejected_sales_stocks->id,
                    'request_sales_project'=>$request_sales_project->id,
                    'approved_sales_project'=>$approved_sales_project->id,
                    'rejected_sales_project'=>$rejected_sales_project->id,
                    'stocks_inpection_pending'=>$stocks_inpection_pending->id,
                    'stocks_inpection_approved'=>$stocks_inpection_approved->id,
                    'stocks_inpection_rejected'=>$stocks_inpection_rejected->id,
                    'project_inpection_pending'=>$project_inpection_pending->id,
                    'project_inpection_approved'=>$project_inpection_approved->id,
                    'project_inpection_rejected'=>$project_inpection_rejected->id,
                    'total_request'=>$total_request
              );
	        return $data;   
	}
   function superuser_dashboard(){       
    $customer_service_request = $this->db->select('count(id) as id')->from('tbl_service_request')->where('status','P')->get()->row();
    $customer_service_approved = $this->db->select('count(id) as id')->from('tbl_service_request')->where('status','A')->get()->row();
    $sales_shipping_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('delivery',1)->get()->row();
    $sales_deliver_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('delivery',2)->get()->row();

    $return_item_good = $this->db->select('count(id) as id')->from('tbl_return_item_warehouse')->where('status',1)->get()->row();
    $return_item_rejected = $this->db->select('count(id) as id')->from('tbl_return_item_warehouse')->where('status',2)->get()->row();

    $return_item_customer_repair = $this->db->select('count(id) as id')->from('tbl_return_item_customer')->where('status',1)->get()->row();
    $return_item_customer_good = $this->db->select('count(id) as id')->from('tbl_return_item_customer')->where('status',2)->get()->row();
    $return_item_customer_rejected = $this->db->select('count(id) as id')->from('tbl_return_item_customer')->where('status',3)->get()->row();

    $request_material_pending = $this->db->select('count(id) as id')->from('tbl_other_material_m_request')->where('status',1)->get()->row();
    $request_material_received = $this->db->select('count(id) as id')->from('tbl_other_material_m_received')->get()->row();
    $request_material_cancelled = $this->db->select('count(id) as id')->from('tbl_other_material_m_request')->where('status',3)->get()->row();

    $sales_shipping_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('delivery',1)->get()->row();
    $sales_deliver_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('delivery',2)->get()->row();

    $sales_shipping_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('delivery',1)->get()->row();
    $sales_deliver_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('delivery',2)->get()->row();

    $material_request_complete_stocks = $this->db->select('*')->from('tbl_material_release')->where('type',1)->get()->num_rows();

    $material_request_complete_project = $this->db->select('*')->from('tbl_material_release')->where('type',2)->get()->num_rows();

    $stocks = $this->db->select('count(p.production_no) as id')->from('tbl_material_project as m')
    ->join('tbl_project as p','m.production_no=p.production_no','LEFT')
    ->where('m.status',2)->where('p.type',1)->group_by('m.production_no')->get();
    $material_request_pending_stocks=0;
    foreach($stocks->result() as $row){
        if($row->id >= 0){
           $material_request_pending_stocks += 1;
        }
        
    }
    $project = $this->db->select('count(p.production_no) as id')->from('tbl_material_project as m')
    ->join('tbl_project as p','m.production_no=p.production_no','LEFT')
    ->where('m.status',2)->where('p.type',2)->group_by('m.production_no')->get();
    $material_request_pending_project=0;
    foreach($project->result() as $row){
        if($row->id >= 0){
            $material_request_pending_project += 1;
        }
    }

    $purchase_stocks_pending_query = $this->db->select('count(pr.production_no) as id')->from('tbl_purchasing_project as pr')
    ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
    ->where('pr.status',2)->where('p.type',1)->group_by('pr.production_no')->get();
    $purchase_stocks_pending=0;
    foreach($purchase_stocks_pending_query->result() as $row){
        if($row->id >= 0){
            $purchase_stocks_pending += 1;
        }
    }

    $purchase_stocks_approved_query = $this->db->select('count(pr.production_no) as id')->from('tbl_purchasing_project as pr')
    ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
    ->where('pr.status',4)->where('p.type',1)->group_by('pr.fund_no')->get();
    $purchase_stocks_approved=0;
    foreach($purchase_stocks_approved_query->result() as $row){
        if($row->id >= 0){
            $purchase_stocks_approved += 1;
        }
    }
    $purchase_project_pending_query = $this->db->select('count(pr.production_no) as id')->from('tbl_purchasing_project as pr')
    ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
    ->where('pr.status',2)->where('p.type',2)->group_by('pr.production_no')->get();
    $purchase_project_pending=0;
    foreach($purchase_project_pending_query->result() as $row){
        if($row->id >= 0){
            $purchase_project_pending += 1;
        }
    }

    $purchase_project_approved_query = $this->db->select('count(pr.production_no) as id')->from('tbl_purchasing_project as pr')
    ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
    ->where('pr.status',4)->where('p.type',2)->group_by('pr.fund_no')->get();
    $purchase_project_approved=0;
    foreach($purchase_project_approved_query->result() as $row){
        if($row->id >= 0){
            $purchase_project_approved += 1;
        }
    }

    $purchase_stocks_complete = $this->db->select('*')->from('tbl_purchase_received')->where('type',1)->get()->num_rows();
    $purchase_project_complete = $this->db->select('*')->from('tbl_purchase_received')->where('type',2)->get()->num_rows();
    

    $office=array();
    $spare=array();
    $rawmats =array();   
     $query_raw = $this->db->select('*')->from('tbl_materials')->get();
      if($query_raw !== FALSE && $query_raw->num_rows() > 0){
           foreach($query_raw->result() as $row){
              if($row->stocks <= $row->stocks_alert && $row->stocks_alert <= $row->stocks){
                   $rawmats[] = array('item'   => $row->item,
                                      'stocks' => $row->stocks);
              }
            }      
    }
     $query_office = $this->db->select('*')->from('tbl_other_materials')->where('type',2)->get();
      if($query_office !== FALSE && $query_office->num_rows() > 0){
           foreach($query_office->result() as $row){
             if($row->stocks <= $row->alert && $row->alert <= $row->stocks){
               $office[] = array(
                        'item'  => $row->item,
                        'stocks' => $row->stocks);
              }
            }      
         } 
      $query_spare = $this->db->select('*')->from('tbl_other_materials')->where('type',1)->get();
      if($query_spare !== FALSE && $query_spare->num_rows() > 0){
           foreach($query_spare->result() as $row){
             if($row->stocks <= $row->alert && $row->alert <= $row->stocks){
               $spare[] = array(
                        'item'  => $row->item,
                        'stocks' => $row->stocks);
              }
            }      
         }
      $total_request = intval($customer_service_request->id+$sales_shipping_stocks->id+$sales_shipping_project->id+$request_material_pending->id+$material_request_pending_stocks+$material_request_pending_project+$purchase_stocks_pending+$purchase_stocks_approved+$purchase_project_pending+$purchase_project_approved);
      $purchase_stocks = intval($purchase_stocks_pending+$purchase_stocks_approved);
      $purchase_project = intval($purchase_project_pending+$purchase_project_approved);
      $json_data = array( 'rawmats'      => $rawmats,
                          'office'       => $office,
                          'spare'        => $spare,
                          'customer_service_request'=> $customer_service_request->id,
                          'customer_service_approved'=> $customer_service_approved->id,
                          'return_item_good'=>$return_item_good->id,
                          'return_item_rejected'=>$return_item_rejected->id,
                          'return_item_customer_repair'=>$return_item_customer_repair->id,
                          'return_item_customer_good'=>$return_item_customer_good->id,
                          'return_item_customer_rejected'=>$return_item_customer_rejected->id,
                          'request_material_pending'=>$request_material_pending->id,
                          'request_material_received'=>$request_material_received->id,
                          'request_material_cancelled'=>$request_material_cancelled->id,
                          'request_sales_stocks'=>$sales_shipping_stocks->id,
                          'request_sales_project'=>$sales_shipping_project->id,
                          'sales_deliver_stocks'=>$sales_deliver_stocks->id,
                          'sales_deliver_project'=>$sales_deliver_project->id,
                          'material_request_complete_stocks'=>$material_request_complete_stocks,
                          'material_request_complete_project'=>$material_request_complete_project,
                          'material_request_pending_stocks'=>$material_request_pending_stocks,
                          'material_request_pending_project'=>$material_request_pending_project,
                          'purchase_stocks_pending'=>$purchase_stocks_pending,
                          'purchase_stocks_approved'=>$purchase_stocks_approved,
                          'purchase_project_pending'=>$purchase_project_pending,
                          'purchase_project_approved'=>$purchase_project_approved,
                          'purchase_stocks_complete'=>$purchase_stocks_complete,
                          'purchase_project_complete'=>$purchase_project_complete,
                          'purchase_stocks'=>$purchase_stocks,
                          'purchase_project'=>$purchase_project,
                          'total_request'=>$total_request
                          );
      return $json_data;   
  } 
  
   
  function sales_dashboard($id){
    $request_sales_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('created_by',$id)->where('status','P')->get()->row();
    $request_sales_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('created_by',$id)->where('status','P')->get()->row();

    $sales_shipping_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('created_by',$id)->where('delivery',1)->get()->row();
    $sales_deliver_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('created_by',$id)->where('delivery',2)->get()->row();

    $sales_shipping_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('created_by',$id)->where('delivery',1)->get()->row();
    $sales_deliver_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('created_by',$id)->where('delivery',2)->get()->row();

    $customer_service_request = $this->db->select('count(id) as id')->from('tbl_service_request')->where('status','R')->get()->row();

    $customer_service_approved = $this->db->select('count(id) as id')->from('tbl_service_request')->where('status','A')->get()->row();

    $online_add_cart = $this->db->select('count(id) as id')->from('tbl_cart_address')->where('status','REQUEST')->get()->row();

    $pre_order_count = $this->db->select('count(id) as id')->from('tbl_cart_pre_order')->where('status',1)->get()->row();

    $collection_count = $this->db->select('count(id) as id')->from('tbl_customer_deposite')->where('status','P')->get()->row();

    $request_customized_pending = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','P')->where('created_by',$id)->get()->row();
    $request_customized_approved = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','A')->where('created_by',$id)->get()->row();
    $request_customized_rejected = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','R')->where('created_by',$id)->get()->row();

    $request_inquiry_pending = $this->db->select('count(id) as id')->from('tbl_customer_inquiry')->where('status','P')->get()->row();
    $request_inquiry_approved = $this->db->select('count(id) as id')->from('tbl_customer_inquiry')->where('status','A')->where('update_by',$id)->get()->row();
     
    $customer_total_count = intval($request_customized_pending->id+$customer_service_request->id+$request_inquiry_pending->id);
    $data = array('request_sales_stocks'=>$request_sales_stocks->id,
                  'request_sales_project'=>$request_sales_project->id,
                  'request_salesorder'=>intval($request_sales_project->id+$request_sales_stocks->id),
                  'sales_shipping_stocks'=>$sales_shipping_stocks->id,
                  'sales_deliver_stocks'=>$sales_deliver_stocks->id,
                  'sales_shipping_project'=>$sales_shipping_project->id,
                  'sales_deliver_project'=>$sales_deliver_project->id,
                  'customer_service_request'=>$customer_service_request->id,
                  'customer_service_approved'=>$customer_service_approved->id,
                  'online_add_cart'=>$online_add_cart->id,
                  'pre_order_count'=>$pre_order_count->id,
                  'collection_count'=>$collection_count->id,
                  'request_customized_pending'=>$request_customized_pending->id,
                  'request_customized_approved'=>$request_customized_approved->id,
                  'request_customized_rejected'=>$request_customized_rejected->id,
                  'customer_total_count'=>$customer_total_count,
                  'request_inquiry_pending'=>$request_inquiry_pending->id,
                  'request_inquiry_approved'=>$request_inquiry_approved->id
              );
    return $data; 
  }

}
?>
