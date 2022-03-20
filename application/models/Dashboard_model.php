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
       
        $data = array('request_stocks'  => $request_stocks->id,
                      'approved_stocks' => $approved_stocks->id,
                      'rejected_stocks' => $rejected_stocks->id,
                      'request_project' => $request_project->id,
                      'approved_project'=> $approved_project->id,
                      'rejected_project'=> $rejected_project->id,
                      'request_jo_stocks'=>$request_jo_stocks->id,
                      'request_jo_project'=>$request_jo_project->id,
                      'request_jo_designer'=>intval($request_jo_stocks->id+$request_jo_project->id));
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
     $query_pr =  $this->db->select('count(id) as id')->from('tbl_purchasing_project')->where('status', 'APPROVED1')->get();  
     $row_pr = $query_pr->row();
     $query_ir =  $this->db->select('count(id) as id')->from('tbl_product_inspection_approved')->where('status', 'PENDING')->get();  
     $row_ir = $query_ir->row();
     $query_pd =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('status', 1)->get();  
     $row_pd = $query_pd->row();
     $query_so =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('status', 'REQUEST FOR APPROVAL')->get();  
     $row_so = $query_so->row();
     $query_user =  $this->db->select('count(id) as id')->from('tbl_users')->where('status', 'PENDING')->get();  
     $row_user = $query_user->row();
     $query_c =  $this->db->select('count(id) as id')->from('tbl_customer_online')->get();  
     $row_c = $query_c->row();
     $query_sd =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('status', 'DELIVERED')->get();  
     $row_sd = $query_sd->row();
     $query_sr =  $this->db->select('count(id) as id')->from('tbl_salesorder_item_return')->where('status', 'REJECTED')->get();  
     $row_sr = $query_sr->row();
     $query_sg =  $this->db->select('count(id) as id')->from('tbl_salesorder_item_return')->where('status', 'GOOD')->get();  
     $row_sg = $query_sg->row();

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
   function superuser_dashboard()
   {       
     // $query_cs =  $this->db->select('count(id) as id')->from('tbl_service_request')->where('s_status', 'PENDING')->get();  
     // $row_cs = $query_cs->row();

     // $query_pr =  $this->db->select('count(id) as id')->from('tbl_purchasing_project')->where('status', 'PENDING')->get();  
     // $row_pr = $query_pr->row();

     // $query_mr =  $this->db->select('count(id) as id')->from('tbl_material_project')->where('status', 'PENDING')->get();  
     // $row_mr = $query_mr->row();

     // $query_user =  $this->db->select('count(id) as id')->from('tbl_users')->where('status', 'PENDING')->get();  
     // $row_user = $query_user->row();

     // $query_sd =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('status', 'DELIVERED')->get();  
     // $row_sd = $query_sd->row();

     // $query_sop =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('status', 'REQUEST')->get();  
     // $row_sop = $query_sop->row();

     // $query_sr =  $this->db->select('count(id) as id')->from('tbl_salesorder_return')->where('status', 'REJECTED')->get();  
     // $row_sr = $query_sr->row();

     // $query_sg =  $this->db->select('count(id) as id')->from('tbl_salesorder_return')->where('status', 'GOOD')->get();  
     // $row_sg = $query_sg->row();

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

          $json_data = array( 'rawmats'      => $rawmats,
                              'office'       => $office,
                              'spare'        => $spare);
                              // 'pr'           => $row_pr->id,
                              // 'mr'           => $row_mr->id,
                              // 'sd'           => $row_sd->id,
                              // 'sg'           => $row_sg->id,
                              // 'sop'          => $row_sg->id,
                              // 'cs'           => $row_cs->id);
          return $json_data;   
  } 
  
   
  function sales_dashboard($id){
     $request_sales_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('created_by',$id)->where('status','P')->get()->row();
    $request_sales_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('created_by',$id)->where('status','P')->get()->row();

    $sales_shipping_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('created_by',$id)->where('delivery',1)->get()->row();
    $sales_deliver_stocks = $this->db->select('count(id) as id')->from('tbl_salesorder_stocks')->where('created_by',$id)->where('delivery',2)->get()->row();

    $sales_shipping_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('created_by',$id)->where('delivery',1)->get()->row();
    $sales_deliver_project = $this->db->select('count(id) as id')->from('tbl_salesorder_project')->where('created_by',$id)->where('delivery',2)->get()->row();

    $data = array('request_sales_stocks'=>$request_sales_stocks->id,
                  'request_sales_project'=>$request_sales_project->id,
                  'request_salesorder'=>intval($request_sales_project->id+$request_sales_stocks->id),
                  'sales_shipping_stocks'=>$sales_shipping_stocks->id,
                  'sales_deliver_stocks'=>$sales_deliver_stocks->id,
                  'sales_shipping_project'=>$sales_shipping_project->id,
                  'sales_deliver_project'=>$sales_deliver_project->id,
              );
    return $data; 
  }

}
?>
