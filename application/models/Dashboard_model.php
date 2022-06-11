<?php
class Dashboard_model extends CI_Model
{  
    public function __construct(){
          parent::__construct();
          if($this->appinfo->creative('_DESIGNER_ID') != false){
            $this->user_id = $this->appinfo->creative('_DESIGNER_ID');
          }else if($this->appinfo->production('_PRODUCTION_ID') != false){
            $this->user_id = $this->appinfo->production('_PRODUCTION_ID');
          }else if($this->appinfo->supervisor('_SUPERVISOR_ID') != false){
            $this->user_id = $this->appinfo->supervisor('_SUPERVISOR_ID');
          }else if($this->appinfo->sales('_SALES_ID') != false){
            $this->user_id = $this->appinfo->sales('_SALES_ID');
          }else if($this->appinfo->superuser('_SUPERUSER_ID') != false){
            $this->user_id = $this->appinfo->superuser('_SUPERUSER_ID');
          }else if($this->appinfo->accounting('_ACCOUNTING_ID') != false){
           $this->user_id = $this->appinfo->accounting('_ACCOUNTING_ID');
          }else if($this->appinfo->webmodifier('_WEBMODIFIER_ID') != false){
            $this->user_id = $this->appinfo->webmodifier('_WEBMODIFIER_ID');
          }else if($this->appinfo->admin('_ADMIN_ID') != false){
            $this->user_id = $this->appinfo->admin('_ADMIN_ID');
          }
    }
   //Fetch Data
    function designer_dashboard(){        
        $request_stocks = $this->db->select('*')->from('tbl_project_color')->where('type',1)->where('status', 1)->get()->num_rows();  
        $approved_stocks = $this->db->select('*')->from('tbl_project_color')->where('designer',$this->user_id)->where('type',1)->where('status',2)->get()->num_rows();
        $rejected_stocks =  $this->db->select('*')->from('tbl_project_color')->where('designer',$this->user_id)->where('type',1)->where('status', 3)->get()->num_rows();

        $request_project = $this->db->select('count(id) as id')->from('tbl_project_color')->where('type',2)->where('status',1)->get()->row();  
        $approved_project =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$this->user_id)->where('type',2)->where('status',2)->get()->row();
        $rejected_project =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$this->user_id)->where('type',2)->where('status',3)->get()->row();

        $request_jo_stocks = $this->db->select('count(id) as id')->from('tbl_project')->where('type',1)->where('status',4)->get()->row();
        $request_jo_project = $this->db->select('count(id) as id')->from('tbl_project')->where('type',2)->where('status',4)->get()->row();

        $request_material_pending = $this->db->select('count(id) as id')->from('tbl_other_material_m_request')->where('status',1)->where('created_by',$this->user_id)->get()->row();
        $request_material_received = $this->db->select('count(id) as id')->from('tbl_other_material_m_received')->where('created_by',$this->user_id)->get()->row();
        $request_material_cancelled = $this->db->select('count(id) as id')->from('tbl_other_material_m_request')->where('status',3)->where('created_by',$this->user_id)->get()->row();


        $request_pre_order_pending = $this->db->select('count(id) as id')->from('tbl_cart_pre_order')->where('status',1)->get()->row();
        $request_pre_order_approved = $this->db->select('count(id) as id')->from('tbl_cart_pre_order')->where('status',2)->get()->row();
        $request_pre_order_rejected = $this->db->select('count(id) as id')->from('tbl_cart_pre_order')->where('status',3)->get()->row();

        $request_customized_pending = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','P')->get()->row();
        $request_customized_approved = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','A')->where('update_by',$this->user_id)->get()->row();

        $request_customized_rejected = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','R')->where('update_by',$this->user_id)->get()->row();

        $request_preoder_customized = intval($request_pre_order_pending->id+$request_customized_pending->id);
        $request_stocks_project = intval($request_stocks+$request_project->id);

        $data = array('request_stocks'  => $request_stocks,
                      'approved_stocks' => $approved_stocks,
                      'rejected_stocks' => $rejected_stocks,
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
  function production_dashboard(){        
    $request_jo_stocks = $this->db->select('*')->from('tbl_project')->where('assigned',$this->user_id)->where('type',1)->where('status',4)->get()->num_rows();
    $request_jo_project = $this->db->select('*')->from('tbl_project')->where('assigned',$this->user_id)->where('type',2)->where('status',4)->get()->num_rows();

    $sales_stocks_pending = $this->db->select('*')->from('tbl_salesorder_stocks')->where('created_by',$this->user_id)->where('status','PENDING')->get()->num_rows();
    $sales_project_pending = $this->db->select('*')->from('tbl_salesorder_project')->where('created_by',$this->user_id)->where('status','PENDING')->get()->num_rows();

    $sales_stocks_approved = $this->db->select('*')->from('tbl_salesorder_stocks')->where('created_by',$this->user_id)->where('status','APPROVED')->get()->num_rows();
    $sales_project_approved = $this->db->select('*')->from('tbl_salesorder_project')->where('created_by',$this->user_id)->where('status','APROVED')->get()->num_rows();

    $sales_stocks_completed = $this->db->select('*')->from('tbl_salesorder_stocks')->where('created_by',$this->user_id)->where('status','COMPLETED')->get()->num_rows();
    $sales_project_completed = $this->db->select('*')->from('tbl_salesorder_project')->where('created_by',$this->user_id)->where('status','COMPLETED')->get()->num_rows();

    $sales_stocks_cancelled = $this->db->select('*')->from('tbl_salesorder_project')->where('created_by',$this->user_id)->where('status','CANCELLED')->get()->num_rows();
    $sales_project_cancelled = $this->db->select('*')->from('tbl_salesorder_project')->where('created_by',$this->user_id)->where('status','CANCELLED')->get()->num_rows();

    $total_request_purchase  = intval($request_jo_stocks+$request_jo_project);
    $total_salesoder_request = intval($sales_stocks_pending+$sales_project_pending);

    $data = array('request_jo_stocks'=>$request_jo_stocks,
                  'request_jo_project'=>$request_jo_project,
                  'request_jo_production'=>$total_request_purchase,
                  'sales_stocks_pending'=>$sales_stocks_pending,
                  'sales_project_pending'=>$sales_project_pending,
                  'sales_stocks_approved'=>$sales_stocks_approved,
                  'sales_project_approved'=>$sales_project_approved,
                  'sales_stocks_completed'=>$sales_stocks_completed,
                  'sales_project_completed'=>$sales_project_completed,
                  'sales_stocks_cancelled'=>$sales_stocks_cancelled,
                  'sales_project_cancelled'=>$sales_project_cancelled,
                  'total_salesoder_request'=>$total_salesoder_request
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


      $stocks_inpection_pending_query = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',1)->where('status',1)->group_by('production_no')->get();
        $stocks_inpection_pending=0;
        foreach($stocks_inpection_pending_query->result() as $row){
            if($row->id >= 0){
               $stocks_inpection_pending += 1;
            }
        }
      $stocks_inpection_approved_query = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',1)->where('status',2)->group_by('ins_no')->get();
        $stocks_inpection_approved=0;
        foreach($stocks_inpection_approved_query->result() as $row){
            if($row->id >= 0){
               $stocks_inpection_approved += 1;
            }
        }
        $stocks_inpection_rejected_query = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',1)->where('status',3)->group_by('ins_no')->get();
        $stocks_inpection_rejected=0;
        foreach($stocks_inpection_rejected_query->result() as $row){
            if($row->id >= 0){
               $stocks_inpection_rejected += 1;
            }
        }

        $project_inpection_pending_query = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',2)->where('status',1)->group_by('production_no')->get();
        $project_inpection_pending=0;
        foreach($project_inpection_pending_query->result() as $row){
            if($row->id >= 0){
               $project_inpection_pending += 1;
            }
        }
      $project_inpection_approved_query = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',2)->where('status',2)->group_by('ins_no')->get();
        $project_inpection_approved=0;
        foreach($project_inpection_approved_query->result() as $row){
            if($row->id >= 0){
               $project_inpection_approved += 1;
            }
        }
        $project_inpection_rejected_query = $this->db->select('count(id) as id')->from('tbl_project_inspection')->where('type',2)->where('status',3)->group_by('ins_no')->get();
        $project_inpection_rejected=0;
        foreach($project_inpection_rejected_query->result() as $row){
            if($row->id >= 0){
               $project_inpection_rejected += 1;
            }
        }

      $total_request = intval($request_stocks->id+$request_project->id+$request_sales_stocks->id+$request_sales_project->id+$project_inpection_pending+$stocks_inpection_pending);
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
                    'stocks_inpection_pending'=>$stocks_inpection_pending,
                    'stocks_inpection_approved'=>$stocks_inpection_approved,
                    'stocks_inpection_rejected'=>$stocks_inpection_rejected,
                    'project_inpection_pending'=>$project_inpection_pending,
                    'project_inpection_approved'=>$project_inpection_approved,
                    'project_inpection_rejected'=>$project_inpection_rejected,
                    'total_request'=>$total_request
              );
	        return $data;   
	}
   function superuser_dashboard(){       
    $customer_service_request = $this->db->select('count(id) as id')->from('tbl_service_request')->where('status','P')->get()->row();
    $customer_service_approved = $this->db->select('count(id) as id')->from('tbl_service_request')->where('status','A')->get()->row();

    $return_item_good = $this->db->select('count(id) as id')->from('tbl_return_item_warehouse')->where('status',1)->get()->row();
    $return_item_rejected = $this->db->select('count(id) as id')->from('tbl_return_item_warehouse')->where('status',2)->get()->row();

    $return_item_customer_repair = $this->db->select('count(id) as id')->from('tbl_return_item_customer')->where('status',1)->get()->row();
    $return_item_customer_good = $this->db->select('count(id) as id')->from('tbl_return_item_customer')->where('status',2)->get()->row();
    $return_item_customer_rejected = $this->db->select('count(id) as id')->from('tbl_return_item_customer')->where('status',3)->get()->row();

    $request_material_pending = $this->db->select('count(id) as id')->from('tbl_other_material_m_request')->where('status',1)->get()->row();
    $request_material_received = $this->db->select('count(id) as id')->from('tbl_other_material_m_received')->get()->row();
    $request_material_cancelled = $this->db->select('count(id) as id')->from('tbl_other_material_m_request')->where('status',3)->get()->row();

    $material_request_complete_stocks = $this->db->select('*')->from('tbl_material_release')->where('type',1)->get()->num_rows();

    $material_request_complete_project = $this->db->select('*')->from('tbl_material_release')->where('type',2)->get()->num_rows();

    $sales_delivery_pending = $this->db->select('*')->from('tbl_sales_delivery_header')->where('status','PENDING')->get()->num_rows();
    $sales_delivery_ship = $this->db->select('*')->from('tbl_sales_delivery_header')->where('status','TO-SHIP')->get()->num_rows();
    $sales_delivery_received = $this->db->select('*')->from('tbl_sales_delivery_header')->where('status','TO-RECEIVED')->get()->num_rows();
    $sales_delivery_completed = $this->db->select('*')->from('tbl_sales_delivery_header')->where('status','COMPLETED')->get()->num_rows();
    $sales_delivery_cancelled = $this->db->select('*')->from('tbl_sales_delivery_header')->where('status','CANCELLED')->get()->num_rows();


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
      $total_request = intval($customer_service_request->id+$request_material_pending->id+$material_request_pending_stocks+$material_request_pending_project+$purchase_stocks_pending+$purchase_stocks_approved+$purchase_project_pending+$purchase_project_approved);
      $purchase_stocks = intval($purchase_stocks_pending+$purchase_stocks_approved);
      $purchase_project = intval($purchase_project_pending+$purchase_project_approved);
      $json_data = array( 'rawmats'  => $rawmats,
                          'office' => $office,
                          'spare' => $spare,
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
                          'sales_delivery_pending'=>$sales_delivery_pending,
                          'sales_delivery_ship'=>$sales_delivery_ship,
                          'sales_delivery_received'=>$sales_delivery_received,
                          'sales_delivery_completed'=>$sales_delivery_completed,
                          'sales_delivery_cancelled'=>$sales_delivery_cancelled,
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
  
   
  function sales_dashboard(){
    $sales_stocks_pending = $this->db->select('*')->from('tbl_salesorder_stocks')->where('created_by',$this->user_id)->where('status','PENDING')->get()->num_rows();
    $sales_project_pending = $this->db->select('*')->from('tbl_salesorder_project')->where('created_by',$this->user_id)->where('status','PENDING')->get()->num_rows();

    $sales_stocks_approved = $this->db->select('*')->from('tbl_salesorder_stocks')->where('created_by',$this->user_id)->where('status','APPROVED')->get()->num_rows();
    $sales_project_approved = $this->db->select('*')->from('tbl_salesorder_project')->where('created_by',$this->user_id)->where('status','APROVED')->get()->num_rows();

    $sales_stocks_completed = $this->db->select('*')->from('tbl_salesorder_stocks')->where('created_by',$this->user_id)->where('status','COMPLETED')->get()->num_rows();
    $sales_project_completed = $this->db->select('*')->from('tbl_salesorder_project')->where('created_by',$this->user_id)->where('status','COMPLETED')->get()->num_rows();

    $sales_stocks_cancelled = $this->db->select('*')->from('tbl_salesorder_stocks')->where('created_by',$this->user_id)->where('status','CANCELLED')->get()->num_rows();
    $sales_project_cancelled = $this->db->select('*')->from('tbl_salesorder_project')->where('created_by',$this->user_id)->where('status','CANCELLED')->get()->num_rows();

    $customer_service_request = $this->db->select('count(id) as id')->from('tbl_service_request')->where('status','R')->get()->row();

    $customer_service_approved = $this->db->select('count(id) as id')->from('tbl_service_request')->where('status','A')->get()->row();

    $online_add_cart = $this->db->select('count(id) as id')->from('tbl_cart_address')->where('status','REQUEST')->get()->row();

    $pre_order_count = $this->db->select('count(id) as id')->from('tbl_cart_pre_order')->where('status',1)->get()->row();

    $sales_collection_request = $this->db->select('*')->from('tbl_customer_deposite')->where('status','P')->get()->num_rows();
    $sales_collection_approved = $this->db->select('*')->from('tbl_customer_deposite')->where('status','A')->get()->num_rows();
    $sales_collection_cancelled = $this->db->select('*')->from('tbl_customer_deposite')->where('status','C')->get()->num_rows();

    $request_customized_pending = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','P')->where('created_by',$this->user_id)->get()->row();
    $request_customized_approved = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','A')->where('created_by',$this->user_id)->get()->row();
    $request_customized_rejected = $this->db->select('count(id) as id')->from('tbl_customized_request')->where('status','R')->where('created_by',$this->user_id)->get()->row();

    $request_inquiry_pending = $this->db->select('count(id) as id')->from('tbl_customer_inquiry')->where('status','P')->get()->row();
    $request_inquiry_approved = $this->db->select('count(id) as id')->from('tbl_customer_inquiry')->where('status','A')->where('update_by',$this->user_id)->get()->row();
     
    $customer_total_count = intval($request_customized_pending->id+$customer_service_request->id+$request_inquiry_pending->id);
     $total_salesoder_request = intval($sales_stocks_pending+$sales_project_pending);
    $data = array('sales_stocks_pending'=>$sales_stocks_pending,
                  'sales_project_pending'=>$sales_project_pending,
                  'sales_stocks_approved'=>$sales_stocks_approved,
                  'sales_project_approved'=>$sales_project_approved,
                  'sales_stocks_completed'=>$sales_stocks_completed,
                  'sales_project_completed'=>$sales_project_completed,
                  'sales_stocks_cancelled'=>$sales_stocks_cancelled,
                  'sales_project_cancelled'=>$sales_project_cancelled,
                  'total_salesoder_request'=>$total_salesoder_request,
                  'customer_service_request'=>$customer_service_request->id,
                  'customer_service_approved'=>$customer_service_approved->id,
                  'online_add_cart'=>$online_add_cart->id,
                  'pre_order_count'=>$pre_order_count->id,
                  'request_customized_pending'=>$request_customized_pending->id,
                  'request_customized_approved'=>$request_customized_approved->id,
                  'request_customized_rejected'=>$request_customized_rejected->id,
                  'customer_total_count'=>$customer_total_count,
                  'request_inquiry_pending'=>$request_inquiry_pending->id,
                  'request_inquiry_approved'=>$request_inquiry_approved->id,
                  'sales_collection_request'=>$sales_collection_request,
                  'sales_collection_approved'=>$sales_collection_approved,
                  'sales_collection_cancelled'=>$sales_collection_cancelled
              );
    return $data; 
  }
  function accounting_dashboard(){
    $purchase_stocks_pending = $this->db->select('*')->from('tbl_purchasing_project as m')
      ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
      ->where('m.status',3)->where('p.type',1)->group_by('m.fund_no')->get()->num_rows();

    $purchase_project_pending = $this->db->select('*')->from('tbl_purchasing_project as m')
      ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
      ->where('m.status',3)->where('p.type',2)->group_by('m.fund_no')->get()->num_rows();

    $purchase_stocks_received = $this->db->select('*')->from('tbl_purchase_received as m')
           ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
           ->where('m.status',1)->where('p.type',1)->group_by('m.fund_no')->get()->num_rows();    
    $purchase_project_received = $this->db->select('*')->from('tbl_purchase_received as m')
           ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
           ->where('m.status',1)->where('p.type',1)->group_by('m.fund_no')->get()->num_rows();  

    $sales_stocks_pending = $this->db->select('*')->from('tbl_salesorder_stocks')->where('status','PENDING')->get()->num_rows();
    $sales_project_pending = $this->db->select('*')->from('tbl_salesorder_project')->where('status','PENDING')->get()->num_rows();

    $sales_stocks_approved = $this->db->select('*')->from('tbl_salesorder_stocks')->where('status','APPROVED')->get()->num_rows();
    $sales_project_approved = $this->db->select('*')->from('tbl_salesorder_project')->where('status','APROVED')->get()->num_rows();

    $sales_stocks_completed = $this->db->select('*')->from('tbl_salesorder_stocks')->where('status','COMPLETED')->get()->num_rows();
    $sales_project_completed = $this->db->select('*')->from('tbl_salesorder_project')->where('status','COMPLETED')->get()->num_rows();

    $sales_stocks_cancelled = $this->db->select('*')->from('tbl_salesorder_stocks')->where('status','CANCELLED')->get()->num_rows();
    $sales_project_cancelled = $this->db->select('*')->from('tbl_salesorder_project')->where('status','CANCELLED')->get()->num_rows();

    $sales_collection_request = $this->db->select('*')->from('tbl_customer_deposite')->where('status','P')->get()->num_rows();
    $sales_collection_approved = $this->db->select('*')->from('tbl_customer_deposite')->where('status','A')->get()->num_rows();
    $sales_collection_cancelled = $this->db->select('*')->from('tbl_customer_deposite')->where('status','C')->get()->num_rows();

    $other_purchased_request = $this->db->select('*')->from('tbl_other_material_p_header')->where('status','PENDING')->get()->num_rows();
    $other_purchased_approved = $this->db->select('*')->from('tbl_other_material_p_header')->where('a_status','APPROVED')->get()->num_rows();

    $total_purchase_stocks = intval($purchase_stocks_pending+$purchase_stocks_received);
    $total_purchase_project = intval($purchase_project_pending+$purchase_project_received);
    $total_purchase = intval($purchase_stocks_pending+$purchase_project_pending+$purchase_stocks_received+$purchase_project_received);
    $total_request = intval($purchase_stocks_pending+$purchase_project_pending+$purchase_stocks_received+$purchase_project_received+$other_purchased_request+$other_purchased_approved);
    $total_salesoder_request = intval($sales_stocks_pending+$sales_project_pending);
    $other_purchased_total = intval($other_purchased_request+$other_purchased_approved);

    $data = array('purchase_stocks_pending'=>$purchase_stocks_pending,
                  'purchase_project_pending'=>$purchase_project_pending,
                  'purchase_stocks_received'=>$purchase_stocks_received,
                  'purchase_project_received'=>$purchase_project_received,
                  'sales_stocks_pending'=>$sales_stocks_pending,
                  'sales_project_pending'=>$sales_project_pending,
                  'sales_stocks_approved'=>$sales_stocks_approved,
                  'sales_project_approved'=>$sales_project_approved,
                  'sales_stocks_completed'=>$sales_stocks_completed,
                  'sales_project_completed'=>$sales_project_completed,
                  'sales_stocks_cancelled'=>$sales_stocks_cancelled,
                  'sales_project_cancelled'=>$sales_project_cancelled,
                  'total_purchase_stocks'=>$total_purchase_stocks,
                  'total_purchase_project'=>$total_purchase_project,
                  'total_purchase'=>$total_purchase,
                  'total_request'=>$total_request,
                  'total_salesoder_request'=>$total_salesoder_request,
                  'other_purchased_request'=>$other_purchased_request,
                  'other_purchased_approved'=>$other_purchased_approved,
                  'other_purchased_total'=>$other_purchased_total,
                  'sales_collection_request'=>$sales_collection_request,
                  'sales_collection_approved'=>$sales_collection_approved,
                  'sales_collection_cancelled'=>$sales_collection_cancelled);
     return $data; 
  }

}
?>
