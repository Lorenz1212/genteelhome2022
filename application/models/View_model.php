<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
class View_model extends CI_Model
{  
    function View_DesingProject_Data($id){
        $query = $this->db->select('c.*,d.*,c.status as status,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,DATE_FORMAT(c.date_approved, "%M %d %Y %r") as date_approved,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.c_code', $id)->get();
        return $query->row();
    }
    function View_Profile($id){
        $query = $this->db->select('*')->from('tbl_users')->WHERE('id',$id)->get();
        $row = $query->row();  
        return $row;
    }
    function View_Salesorder_Update($id){
        $data = array();
         $rows = $this->db->select('u.*,s.*,r.*,s.id, 
            DATE_FORMAT(s.date_created, "%M %d %Y") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS name, 
            CONCAT(s.b_address, " ",s.b_city, " ",s.b_province) AS billing_address,
            CONCAT(s.s_address, " ",s.s_city, " ",s.s_province) AS shipping_address')
         ->from('tbl_cart_address as s')
         ->join('tbl_customer_online as u','u.id=s.customer','LEFT')
         ->join('tbl_region_shipping as r','r.id=s.region','LEFT')
         ->where('s.order_no',$id)->get()->row();

         $query =  $this->db->select('*,i.id,i.type,i.price,i.status,i.id,i.c_code,i.qty')
          ->from('tbl_cart_add as i')
          ->join('tbl_project_color as c','c.id=i.c_code','LEFT')
          ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
          ->where('i.type','In Stocks')->where('i.order_no',$rows->order_no)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                $data[] = array(
                         'id'  => $row->id,
                         'title' => $row->title,
                         'color'=> $row->c_name,
                         'qty' => $row->qty,
                         'price'=> $row->price,
                         'status'=> $row->status,
                         'type'=> $row->type);
               } 
           }
           return array('row'=>$rows,'id'=>$this->encryption->encrypt($rows->id),'data'=>$data);
    }
    function View_Supplier_Data($id){
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_supplier')->where('id',$this->encryption->decrypt($id))->get()->row();
        return $query;
    } 
    function View_Joborder_Data($id){
        $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
          ->from('tbl_project as p')
          ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
          ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
          ->join('tbl_users as u','u.id=p.production','LEFT')->where('p.production_no', $id)->get();
          return $query->row();
    }
    function View_Web_Company_Profile($id){
         $query = $this->db->select('*')->from('tbl_company_profile')->where('id',$id)->get();
          if(!$query){return false;}else{   return $query->row();}
    }
    function View_Web_Owner_Profile($id){
         $query = $this->db->select('*')->from('tbl_company_owner')->where('id',$id)->get();
         if(!$query){return false;}else{   return $query->row();}
    }

    //Sales 
      function View_Web_Voucher($id){
          $query = $this->db->select('*,DATE_FORMAT(date_from, "%m/%d/%Y") as date_from,DATE_FORMAT(date_to, "%m/%d/%Y") as date_to')->from('tbl_code_promo')->where('promo_code',$id)->get();
          if(!$query){return false;}else{   return $query->row();}
      }
      function View_Inpection_project($id){
        $data=array();
        $query = $this->db->select('*')->from('tbl_project_inspection')->where('production_no', $id)->get();
        foreach($query->result() as $row){
         $data[] = array('id' => $row->id,
                         'status'=>$row->status,
                         'images'=> $row->images);
        }  
         return $data;
      }
      function View_Inpection_Stocks($id){
         $data=array();
         $query = $this->db->select('*')->from('tbl_project_inspection')->where('production_no', $id)->get();
        foreach($query->result() as $row){
         $data[] = array('id' => $row->id,
                         'status'=>$row->status,
                         'images'=> $row->images);
        }  
         return $data;
      }
      function View_Joborder_Material($id){
         $data=array();
         $query = $this->db->select('*')->from('tbl_material_project as p')
         ->join('tbl_materials as m','m.id=p.item_no')
         ->where('p.production_no', $id)->get();
        foreach($query->result() as $row){
         $data[] = array('id' => $row->id,
                         'item'=>$row->item,
                         'qty'=> $row->total_qty,
                         'unit'=> $row->unit,
                         'remarks'=>$row->remarks);
        }  
         return $data;
      }
      function View_Joborder_Purchase($id){
         $data=array();
         $query = $this->db->select('*')->from('tbl_purchasing_project as p')
         ->join('tbl_materials as m','m.id=p.item_no')
         ->where('p.production_no', $id)->get();
        foreach($query->result() as $row){
         $data[] = array('id' => $row->id,
                         'item'=>$row->item,
                         'qty'=> $row->quantity,
                         'unit'=> $row->unit,
                         'remarks'=>$row->remarks);
        }  
         return $data;
      }
    function View_Joborder_Request_Stocks($id){
        $query = $this->db->select('*')->from('tbl_project as p')->join('tbl_project_color as c','c.id=p.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->where('p.production_no',base64_decode($id))->get()->row();
        return $query;
    }
     function View_Joborder_Request_Project($id){
        $query = $this->db->select('*')->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','d.id=c.project_no','LEFT')->where('p.production_no',base64_decode($id))->get()->row();
        return $query;
    }
   
}
?>
