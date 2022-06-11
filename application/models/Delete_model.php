<?php
class Delete_model extends CI_Model
{  
   function Delete_Web_Project_Image($id){        
      $query = $this->db->select('*')->from('tbl_project_image')->where('id',$id)->get();
      $row = $query->row();
      unlink("./assets/images/finishproduct/product/".$row->images);
      $this->db->where('id',$id);
	  $this->db->delete('tbl_project_image');
   } 
   function Delete_Web_Project_Gallery($id){        
      $query = $this->db->select('*')->from('tbl_project_gallery')->where('id',$id)->get();
      $row = $query->row();
      unlink("./assets/images/finishproduct/product/".$row->g_images);
      $this->db->where('id',$id);
      $this->db->delete('tbl_project_gallery');
   } 
   function Delete_Web_Cart($id){        
      $this->db->where('id',$id);
      $this->db->delete('tbl_cart_add');
   } 
   function Delete_Collection($id){        
      $this->db->where('id',$id);
      $this->db->delete('tbl_cart_collection');
   } 
    function Delete_Web_Interior_Image($id){        
      $query = $this->db->select('*')->from('tbl_interior_image')->where('id',$id)->get();
      $row = $query->row();
      unlink("./assets_website/images/".$row->images);
      $this->db->where('id',$id);
      $this->db->delete('tbl_interior_image');
   } 
   function Delete_Cash_Position($id){
      $decrypt_id = $this->encryption->decrypt($id);
      $this->db->where('id',$decrypt_id);
      $this->db->delete('tbl_cash_position');
   }
   function Delete_Testimony($id){
      $query = $this->db->select('*')->from('tbl_customer_testimony')->where('id',$this->encryption->decrypt($id))->get();
      $row = $query->row();
      unlink("./assets/images/testimony/".$row->image);
      $this->db->where('id',$this->encryption->decrypt($id));
      $this->db->delete('tbl_customer_testimony');
       $data =array();  
       $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y') as date_created FROM tbl_customer_testimony");
      if($query){
           $no =1;
           foreach($query->result() as $row){
           $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/testimony/'.$row->image.'" alt="'.$row->name.'"></div>';
           $action = '
           <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 btn-create" data-id="'.$this->encryption->encrypt($row->id).'" data-action="update" data-toggle="modal" data-target="#staticBackdrop"><i class="la la-eye"></i></button>
                      <button type="button" class="btn btn-sm btn-icon btn-light btn-hover-danger btn-delete" data-id="'.$this->encryption->encrypt($row->id).'" data-action="delete"><i class="la la-trash"></i></button>';
            $string = strip_tags($row->description);
             if (strlen($string) > 500) {
                   $stringCut = substr($string, 0, 80);
                   $endPoint = strrpos($stringCut, ' ');
                   $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                   $string .= '... <a class="btn-create" data-id="'.$this->encryption->encrypt($row->id).'" data-action="update" data-toggle="modal" data-target="#staticBackdrop">Read More</a>';
               }
             $data[] = array('no'               => $no,
                            'image'             => $image,
                            'name'              => $row->name,
                            'description'       => $string,
                            'date_created'      => $row->date_created,
                            'action'            => $action);
             $no++;
            }  
      }
      return array('status' => 'error','data'=>$data);
   }
   function Delete_Inspection_Image($id){
      $query = $this->db->select('*')->from('tbl_project_inspection')->where('id',$id)->get();
      $row = $query->row();
      unlink("./assets/images/inspection/".$row->images);
      $this->db->where('id',$id);
      $this->db->delete('tbl_project_inspection');
      return array('type'=>'success','message'=>'Remove Successfully','id'=>$row->id);
   }
   function Delete_Material_Request_Supervisor($id){
      $this->db->where('id',$id);
      $this->db->delete('tbl_material_project');
      return true;
   }
   function Delete_Purchase_Request_Supervisor($id){
      $this->db->where('id',$id);
      $this->db->delete('tbl_purchasing_project');
      return true;
   }
   function Delete_Purchased_Transaction($fund_no,$id){
      $data_item = false;
      $data = false;
      $row_m = $this->db->select('*')->from('tbl_purchase_transactions')->where('id',$id)->get()->row();
      if($row_m){
         $row_p = $this->db->select('*')->from('tbl_purchasing_project')->where('fund_no',$fund_no)->where('item_no',$row_m->item_no)->get()->row();
         $balanced = $row_p->balance + $row_m->quantity;
         $this->db->where('id',$row_p->id);
         $result = $this->db->update('tbl_purchasing_project',array('balance'=>$balanced));
         if($result){
            $this->db->where('id',$id);
            $result = $this->db->delete('tbl_purchase_transactions');
            if($result){

              $querys = $this->db->select('t.amount,s.name,m.item,m.unit,t.payment,t.quantity,t.id')->from('tbl_purchase_transactions as t')->join('tbl_supplier as s','s.id=t.supplier','LEFT')->join('tbl_materials as m','m.id=t.item_no')->where('t.fund_no',$fund_no)->order_by('t.latest_update','DESC')->get();
              if($querys){
                foreach($querys->result() as $row){
                    ($row->unit)?$unit = $row->unit.'(s)':$unit = "";
                    ($row->payment == 1)?$terms = 'Cash':$terms ='Terms';
                        $data[] = array('id'=>$row->id,
                                        'item'=> $row->item.' '.$unit,
                                        'supplier'=>$row->name,
                                        'payment'=>$terms,
                                        'quantity'=>$row->quantity,
                                        'amount'=>number_format($row->amount,2));
                  } 
               }
               $query = $this->db->select('pr.*,pr.balance,m.id ,m.unit,m.item,pr.quantity,pr.remarks,pr.amount')->from('tbl_purchasing_project as pr')->join('tbl_materials as m','m.id=pr.item_no','LEFT')->where('pr.fund_no',$fund_no)->get();
                if($query){  
                    foreach($query->result() as $row){
                         ($row->unit)?$unit = $row->unit.'(s)':$unit = "";
                           $data_item[] = array('id'=> $row->id,'item'=> $row->item.' '.$unit.' - '.$row->balance);
                    } 
                }
               return array('type'=>'error','status'=>'Remove Item','row'=>$data,'material'=>$data_item);
            }else{
               return array('status'=>false);
            }
         }else{
            return array('status'=>false);
         }
         
      }else{
         return array('status'=>false);
      }
   }
   function Delete_Purchased_Transaction_Inventory($fund_no,$id){
      $data_item = false;
      $data = false;
      $row_m = $this->db->select('*')->from('tbl_other_material_p_transaction')->where('id',$id)->get()->row();
      if($row_m){
         $row_p = $this->db->select('*')->from('tbl_other_material_p_request as t')
         ->join('tbl_other_material_p_header as o','t.id=o.pr_id','LEFT')
         ->where('o.fund_no',$fund_no)->where('t.item_no',$row_m->item_no)->where('t.type',$row_m->type)->get()->row();
         $balanced = $row_p->balance + $row_m->quantity;
         $this->db->where('id',$row_p->id);
         $result = $this->db->update('tbl_other_material_p_request',array('balance'=>$balanced));
         if($result){
            $this->db->where('id',$id);
            $result = $this->db->delete('tbl_other_material_p_transaction');
            if($result){

               $query = $this->db->select('*,s.name,t.item,t.payment,t.quantity,t.id')->from('tbl_other_material_p_transaction as t')->join('tbl_supplier as s','s.id=t.supplier','LEFT')->where('t.fund_no',$fund_no)->order_by('t.latest_update','DESC')->get();
                if($query){
                     foreach($query->result() as $row){
                         ($row->payment == 1)?$terms = 'Cash':$terms ='Terms';
                             $data[] = array('id'=>$row->id,
                                             'item'=> $row->item,
                                             'supplier'=>$row->name,
                                             'payment'=>$terms,
                                             'quantity'=>$row->quantity,
                                             'amount'=>number_format($row->amount,2));
                       } 
                }
               $query = $this->db->select('*')->from('tbl_other_material_p_request')->where('pr_id',$row_b->id)->get();
                if($query){  
                    foreach($query->result() as $row){
                           $data_item[] = array('id'=> $row->item_no,'item'=> $row->item.' - '.$row->balance);
                    } 
                }
               
               return array('type'=>'error','status'=>'Remove Item','row'=>$data,'material'=>$data_item);
            }else{
               return array('status'=>false);
            }
         }else{
            return array('status'=>false);
         }
         
      }else{
         return array('status'=>false);
      }
   }
}
?>
