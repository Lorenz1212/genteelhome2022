<?php
class Dashboard_model extends CI_Model
{  
   //Fetch Data
    function designer_dashboard($id){        
        $request_stocks = $this->db->select('count(id) as id')->from('tbl_project_color')->where('type',1)->where('status', 1)->get()->row();  
        $approved_stocks = $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$id)->where('type',1)->where('status',1)->get()->row();
        $rejected_stocks =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$id)->where('type',1)->where('status', 3)->get()->row();
        $request_project = $this->db->select('count(id) as id')->from('tbl_project_color')->where('type',2)->where('status',1)->get()->row();  
        $approved_project =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$id)->where('type',2)->where('status',1)->get()->row();
        $rejected_project =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$id)->where('type',2)->where('status',3)->get()->row();

        $request_jo_stocks = $this->db->select('count(id) as id')->from('tbl_project')->where('type',1)->where('status',2)->get()->row();
        $request_jo_project = $this->db->select('count(id) as id')->from('tbl_project')->where('type',2)->where('status',2)->get()->row();

        $request_material_pending = $this->db->select('count(id) as id')->from('tbl_other_material_m_request')->where('status',1)->where('created_by',$id)->get()->row();
        $request_material_received = $this->db->select('count(id) as id')->from('tbl_other_material_m_received')->where('created_by',$id)->get()->row();
        $request_material_cancelled = $this->db->select('count(id) as id')->from('tbl_other_material_m_request')->where('status',3)->where('created_by',$id)->get()->row();

        $data = array('request_stocks'  => $request_stocks->id,
                      'approved_stocks' => $approved_stocks->id,
                      'rejected_stocks' => $rejected_stocks->id,
                      'request_project' => $request_project->id,
                      'approved_project'=> $approved_project->id,
                      'rejected_project'=> $rejected_project->id,
                      'request_jo_stocks'=>$request_jo_stocks->id,
                      'request_jo_project'=>$request_jo_project->id,
                      'request_jo_designer'=>intval($request_jo_stocks->id+$request_jo_project->id),
                      'request_material_pending'=>$request_material_pending->id,
                      'request_material_received'=>$request_material_received->id,
                      'request_material_cancelled'=>$request_material_cancelled->id);
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
     $query_sales =  $this->db->select('sum(i.balance_price) as sales')->from('tbl_salesorder_item as i')
     ->join('tbl_salesorder as s','s.so_no=i.so_no','LEFT')->where('s.status', 'DELIVERED')->get();  
     $row_sales = $query_sales->row();
	   $data[] = array('pd' 	   => $row_pd->id,
      				 'pr' 	         => $row_pr->id,
      				 'ir' 	         => $row_ir->id,
      				 'so' 	         => $row_so->id,
      				 'user' 	       => $row_user->id,
      				 'customer'     => $row_c->id,
                     'sr'           => $row_sr->id,
                     'sd'           => $row_sd->id,
                     'sg'           => $row_sg->id,
                     'sales'        => number_format($row_sales->sales,2));
	        $json_data = array('data'=>$data);
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
      $total_request = intval($customer_service_request->id+$sales_shipping_stocks->id+$sales_shipping_project->id+$request_material_pending->id);
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

    $pre_order_count = $this->db->select('count(id) as id')->from('tbl_cart_address')->where('status','R')->get()->row();

    $collection_count = $this->db->select('count(id) as id')->from('tbl_customer_deposite')->where('status','P')->get()->row();

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
                  'collection_count'=>$collection_count->id
              );
    return $data; 
  }

}
?>
