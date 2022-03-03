<?php
class Dashboard_model extends CI_Model
{  
   //Fetch Data
   function admin_dashboard()
   {        
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
     $query_cs =  $this->db->select('count(id) as id')->from('tbl_service_request')->where('s_status', 'PENDING')->get();  
     $row_cs = $query_cs->row();

     $query_pr =  $this->db->select('count(id) as id')->from('tbl_purchasing_project')->where('status', 'PENDING')->get();  
     $row_pr = $query_pr->row();

     $query_mr =  $this->db->select('count(id) as id')->from('tbl_material_project')->where('status', 'PENDING')->get();  
     $row_mr = $query_mr->row();

     $query_user =  $this->db->select('count(id) as id')->from('tbl_users')->where('status', 'PENDING')->get();  
     $row_user = $query_user->row();

     $query_sd =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('status', 'DELIVERED')->get();  
     $row_sd = $query_sd->row();

     $query_sop =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('status', 'REQUEST')->get();  
     $row_sop = $query_sop->row();

     $query_sr =  $this->db->select('count(id) as id')->from('tbl_salesorder_return')->where('status', 'REJECTED')->get();  
     $row_sr = $query_sr->row();

     $query_sg =  $this->db->select('count(id) as id')->from('tbl_salesorder_return')->where('status', 'GOOD')->get();  
     $row_sg = $query_sg->row();

    $office=array();
    $spare=array();
    $rawmats =array();   
     $query_raw = $this->db->select('*')->from('tbl_materials')->get();
      if($query_raw !== FALSE && $query_raw->num_rows() > 0){
           foreach($query_raw->result() as $row){
              if($row->stocks <= $row->stocks_alert && $row->stocks_alert <= $row->stocks){
                   $rawmats[] = array('item'   => $row->item,
                                      'stocks' => $row->stocks_alert);
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
                              'spare'        => $spare,
                              'pr'           => $row_pr->id,
                              'mr'           => $row_mr->id,
                              'sd'           => $row_sd->id,
                              'sg'           => $row_sg->id,
                              'sop'          => $row_sg->id,
                              'cs'           => $row_cs->id);
          return $json_data;   
  } 
  function designer_dashboard($id){        
     $array = array('i.type'=>'REQUEST', 'c.designer'=> $id);
     $query_on =  $this->db->select('count(i.id) as id')->from('tbl_cart_add as i')->join('tbl_project_color as c','c.c_code=i.c_code','LEFT')->where($array)->get();
     $row_on = $query_on->row();

     $query_da =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$id)->where('status', 2)->get();  
     $row_da = $query_da->row();

     $query_dr =  $this->db->select('count(id) as id')->from('tbl_project_color')->where('designer',$id)->where('status', 3)->get();  
     $row_dr = $query_dr->row();

     $query_mr =  $this->db->select('count(id) as id')->from('tbl_project')->where('status', 2)->get();  
     $row_mr = $query_mr->row();

     $query_sc =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('type','customized')->where('status', 'REQUEST')->get();  
     $row_sc = $query_sc->row();

     $query_sr =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('type','request')->where('status', 'REQUEST')->get();  
     $row_sr = $query_sr->row();

     $query_ia =  $this->db->select('count(id) as id')->from('tbl_product_inspection')->where('created_by',$id)->where('status', 2)->get();  
     $row_ia = $query_ia->row();

     $query_irr =  $this->db->select('count(id) as id')->from('tbl_product_inspection')->where('created_by',$id)->get();  
     $row_irr = $query_irr->row();
     $data = array(   'da'           => $row_da->id,
                      'dr'           => $row_dr->id,
                      'mr'           => $row_mr->id,
                      'sc'           => $row_sc->id,
                      'sr'           => $row_sr->id,
                      'ia'           => $row_ia->id,
                      'ir'           => $row_irr->id,
                      'on'           => $row_on->id);
     $json_data = array('data'=>$data);
     return $json_data;   
  }
   function production_dashboard($id){        
     $query_p =  $this->db->select('count(id) as id')->from('tbl_project')->where('status', 'REQUEST')->get();  
     $row_p = $query_p->row();

     $query_sc =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('sales_person',$id)->where('type','customized')->where('status', 'PENDING')->get();  
     $row_sc = $query_sc->row();

     $query_ss =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('sales_person',$id)->where('type','request')->where('status', 'PENDING')->get();  
     $row_ss = $query_ss->row();

     $query_ia =  $this->db->select('count(id) as id')->from('tbl_product_inspection')->where('created_by',$id)->where('status', 'APPROVED')->get();  
     $row_ia = $query_ia->row();

     $query_ir =  $this->db->select('count(id) as id')->from('tbl_product_inspection_approved')->where('inspector',$id)->where('status', 'REJECTED')->get();  
     $row_ir = $query_ir->row();

     $query_irr =  $this->db->select('count(id) as id')->from('tbl_product_inspection_rejected')->where('inspector',$id)->get();  
     $row_irr = $query_irr->row();

     $query_sd =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('sales_person',$id)->where('status', 'DELIVERED')->get();  
     $row_sd = $query_sd->row();

     $query_sop =  $this->db->select('count(id) as id')->from('tbl_salesorder')->where('sales_person',$id)->where('status', 'REQUEST')->get();  
     $row_sop = $query_sop->row();

     $ir = floatval($row_ir->id + $row_irr->id);

     $data[] = array( 'sc'           => $row_sc->id,
                      'ss'           => $row_ss->id,
                      'pr'           => $row_p->id,
                      'ia'           => $row_ia->id,
                      'ir'           => $ir,
                      'sd'           => $row_sd->id,
                      'so'           => $row_sop->id);
     $json_data = array('data'=>$data);
     return $json_data;   
  } 
  function sales_dashboard(){
     $query_or =  $this->db->select('count(id) as id')->from('tbl_cart_address')->where('status', 'REQUEST')->get();  
     $row_or = $query_or->row();

     $query_cr =  $this->db->select('count(id) as id')->from('tbl_customer_customize')->where('status', 'REQUEST')->get();  
     $row_cr = $query_cr->row();

     $query_cs =  $this->db->select('count(id) as id')->from('tbl_service_request')->where('status', 'REQUEST')->get();  
     $row_cs = $query_cs->row();

    $data[] = array('or'     => $row_or->id,
                    'cr'     => $row_cr->id,
                    'cs'     => $row_cs->id);
     $json_data = array('data'=>$data);
     return $json_data;
  }
  function accounting_dashboard(){
     $query_stocks =  $this->db->select('count(id) as id')->from('tbl_purchase_stocks as m')->where('status','PENDING')->where('fund_no IS NULL')->get();  
     $row_s = $query_stocks->row();
     $query_project =  $this->db->select('count(id) as id')->from('tbl_purchasing_project')->where('c_status','REQUEST')->where('fund_no IS NULL')->group_by('request_id')->get();  
     $row_p = $query_project->row();

    $data[] = array('p'  => $row_p->id,
                    's'  => $row_s->id);
     $json_data = array('data'=>$data);
     return $json_data;
  }
}
?>
