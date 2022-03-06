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
    function View_Supplier_Data($id){
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_supplier')->where('id',$this->encryption->decrypt($id))->get()->row();
        return $query;
    } 
    function View_SO_Data($id){
        $query = $this->db->select('*,i.id as id,i.price as price,c.c_name as c_name,s.c_name as costumer')->from('tbl_salesorder_item as i')
        ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
        ->join('tbl_project_design as d','d.id=i.project_no','LEFT')
        ->join('tbl_salesorder as s','s.so_no=i.so_no','LEFT')
        ->where('i.so_no',$id)->get();
           if(!$query){return false;}else{ 
            foreach($query->result() as $row){  
            $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-45 symbol-light mr-3"><div class="symbol-label">
                <img class="h-75" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.' ('.$row->c_name.')"></div></div>
                <div class="symbol symbol-45 symbol-light mr-3"><div class="symbol-label">
                <img class="h-75" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="'.$row->c_name.'"></div></div>
                <a  class="symbol symbol-45 symbol-light mr-3"><div class="symbol-label">
                <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><div>
                <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a>
                </div></div></div></a></span>';  

              $data[] = array('id'              => $row->id,
                              'c_code'          => $row->c_code,
                              'costumer'        => $row->costumer,
                              'title'           => $title,
                              'c_name'          => $row->c_name,
                              'qty'             => $row->qty,
                              'balance'         => $row->balance,
                              'price'           => number_format($row->price,2),
                              'total_amount'    => number_format($row->total_amount,2),
                              'balance_price'   => number_format($row->balance_price,2));
            }  
            return $data;   
        }
    }
    function View_Inspection_Data($id){
        $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
          ->from('tbl_project_inspection as p')
          ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
          ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
          ->join('tbl_users as u','u.id=p.production','LEFT')->where('p.ins_no', $id)->get();
         return $query->row();
    }
    function View_Joborder_Data($id){
        $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
          ->from('tbl_project as p')
          ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
          ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
          ->join('tbl_users as u','u.id=p.production','LEFT')->where('p.production_no', $id)->get();
          return $query->row();
    }
    function View_Return_Item_Data($id){
        $query = $this->db->select('*')->from('tbl_material_project')->where('production_no',$id)->get();
        if(!$query){return false;}else{ 
            foreach($query->result() as $row)  
            {  
              $data[] = array('id'            => $row->id,
                              'production_no' => $row->production_no,
                              'item'          => $row->item,
                              'qty'           => $row->total_qty,
                              'unit'          => $row->unit);
            }  
            return $data;   
        }
    }
    function View_MaterialUsed_Data($id){
        $query = $this->db->select('d.*,c.*,m.*,m.item_no as item_no,m.item as item')->from('tbl_material_project as mp')
        ->join('tbl_materials as m','m.item=mp.item','LEFT')
        ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
        ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
        ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
        ->where('mp.production_no',$id)->get();
        if(!$query){return $data = false;}else{ 
            foreach($query->result() as $row)  
            {  
              $data[] = array('id'            => $row->id,
                              'title'         => $row->title,
                              'c_name'        => $row->c_name,
                              'item_no'       => $row->item_no,
                              'item'          => $row->item,
                              'qty'           => $row->stocks);
            }  
            return $data;   
        }
    }
    function View_Project_Data($id){
          $this->db->select('d.*,c.*,pp.*,p.*,pp.*,pp.unit as unit,pp.id as id')
          ->from('tbl_purchasing_project as pp')
          ->join('tbl_project as p','p.production_no=pp.production_no','LEFT')
          ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
          ->join('tbl_project_color as c','c.project_no=d.id','LEFT')->WHERE('p.production_no',$id);
           $query = $this->db->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                $data[] = array(
                         'id'            => $row->id,
                         'project_no'    => $row->project_no,
                         'production_no' => $row->production_no,
                         'unit'          => $row->unit,
                         'title'         => $row->title,
                         'c_name'         => $row->c_name,
                         'item'          => $row->item,
                         'quantity'      => $row->quantity,
                         'balance'       => $row->balance,
                         'total_quantity'=>$row->total_quantity,
                         'unit'          => $row->unit,
                         'type'          => $row->type,
                         'remakrs'       => $row->remarks);
               } 
               return $data;}
    }
     function View_Project_Process_Data($id){
          $this->db->select('p.*,d.*,c.*,pp.*,pp.id as id,p.project_no as project_no,p.production_no as production_no,p.unit as unit,pp.item as item,pp.quantity as quantity,pp.balance_quantity as balance,pp.status as status,pp.delivery as delivery,pp.total_quantity as total_quantity,pp.type as type,pp.remarks as remarks')->from('tbl_purchasing_project as pp')->join('tbl_project as p','p.production_no=pp.production_no','LEFT')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=pp.approver1','LEFT')->join('tbl_users as uu','uu.id=pp.approver2','LEFT')->join('tbl_users as uuu','uuu.id=pp.receiver','LEFT')->WHERE('pp.fund_no',$id);
           $query = $this->db->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                if(!$row->total_quantity){
                    $total_quantity = 0;
                }else{
                   $total_quantity = $row->total_quantity;
                }
                $data[] = array(
                         'id'           => $row->id,
                         'item_no'      => $row->item_no,
                         'project_no'   => $row->project_no,
                         'production_no'=> $row->production_no,
                         'fund_no'      => $row->fund_no,
                         'unit'         => $row->unit,
                         'title'        => $row->title,
                         'item'         => $row->item,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance,
                         'total_quantity'=>$total_quantity,
                         'type'         => $row->type,
                         'status'       => $row->status,
                         'delivery'     => $row->delivery,
                         'remakrs'      => $row->remarks);
               } 
               return $data;
           }
    }
    function View_Purchase_Stocks_Process($id){
                   $query = $this->db->select('p.*,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS purchaser')
          ->from('tbl_purchase_stocks as p')
          ->join('tbl_users as u','u.id=p.purchaser','LEFT')
          ->where('p.request_id', $id)->get();

           if(!$query){return false;}else{  
                foreach($query->result() as $row)  
                {
                if($row->remarks == 'rawmats'){
                     $remarks = 'Raw Material';
                }else if($row->remarks == 'office'){
                    $remarks = 'Office & Janitorial Supplies';
                }else if($row->remarks == 'production'){
                    $remarks = 'Production Supplies/Spare Parts';
                }
                $data[] = array(
                         'id'           => $row->id,
                         'request_id'   => $row->request_id,
                         'purchaser'    => $row->purchaser,
                         'fund_no'      => $row->fund_no,
                         'item'         => $row->item,
                         'quantity'     => $row->qty,
                         'total_qty'    => $row->total_qty,
                         'balance'      => $row->balance,
                         'unit'         => $row->unit,
                         'remarks'      => $remarks,
                         'amount'       => number_format($row->amount,2),
                         'type'         => $row->type,
                         'status'       => $row->status,
                         'date_created' => $row->date_created);
               } 
               return $data;
           }
    }
    function View_Material_Request_Data($id){
         $query =  $this->db->select('p.*,pp.*,d.*,c.*,m.stocks as stocks,pp.unit as units,pp.id as id,p.project_no as project_no,p.production_no as production_no,p.unit as unit,pp.item as item,pp.quantity as quantity,pp.balance_quantity as balance,p.status as status')->from('tbl_material_project as pp')->join('tbl_materials as m','m.item=pp.item','LEFT')->join('tbl_project as p','p.production_no=pp.production_no','LEFT')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->where('pp.status !=','COMPLETE')->where('p.production_no',$id)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                $data[] = array(
                         'id'           => $row->id,
                         'item_no'      => $row->item_no,
                         'project_no'   => $row->project_no,
                         'production_no'=> $row->production_no,
                         'unit'         => $row->unit,
                         'title'        => $row->title,
                         'c_name'       => $row->c_name,
                         'item'         => $row->item,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance,
                         'units'        => $row->units,
                         'stocks'       => $row->stocks,
                         'status'       => $row->status,
                         'warehouse_status' => $row->warehouse_status);
               } 
               return $data;
           }
    }
   
    function View_Delivery_Data($id){
        $query = $this->db->select('*')->from('tbl_purchase_delivery')->where('delivery_no',$id)->get();
               if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                $data[] = array(
                         'id'           => $row->id,
                         'item'         => $row->item,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance,
                         'status'       => $row->status);
               } 
               return $data;
           }
    }
    function View_Delivery_Stocks_Data($id){
        $query = $this->db->select('*')->from('tbl_purchase_stocks_delivery')->where('delivery_no',$id)->get();
               if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                $data[] = array(
                         'id'           => $row->id,
                         'item'         => $row->item,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance,
                         'status'       => $row->status);
               } 
               return $data;
           }
    }
  
    function View_Officesupplier_Request_Data($id){
        $query = $this->db->select('*,o.id as id,o.status as status')->from('tbl_office_janitorial_request as o')
        ->join('tbl_office_janitorial as j','j.item=o.item','LEFT')
        ->where('o.request_id',$id)->get();
               if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                $data[] = array(
                         'id'           => $row->id,
                         'item'         => $row->item,
                         'stocks'       => $row->stocks,
                         'quantity'     => $row->qty,
                         'balance'      => $row->balance,
                         'status'       => $row->status);
               } 
               return $data;
           }
    }

     function View_Spareparts_Request_Data($id){
        $query = $this->db->select('*,o.id as id,o.status as status')->from('tbl_spares_request as o')
        ->join('tbl_spares as j','j.item=o.item','LEFT')
        ->where('o.request_id',$id)->get();
               if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                $data[] = array(
                         'id'           => $row->id,
                         'item'         => $row->item,
                         'stocks'       => $row->stocks,
                         'quantity'     => $row->qty,
                         'balance'      => $row->balance,
                         'status'       => $row->status);
               } 
               return $data;
           }
    }
    function View_SalesOrder_Data($id){
         $query = $this->db->select('*')->from('tbl_salesorder')->where('so_no',$id)->get();
          if(!$query){return false;}else{   return $query->row();}
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
      function View_OnlineOrder($id){
          $query =  $this->db->select('s.*,i.*,c.*,d.*,uu.*,r.*,d.title as title,c.c_name as color,s.status as status,
            i.price as price,i.type as type,i.id as item_id,s.type as s_type,
            CONCAT(u.firstname, " ",u.lastname) AS sales_person,
            CONCAT(uu.firstname, " ",uu.lastname) AS customer,
            DATE_FORMAT(s.date_order, "%M %d %Y") as date_order')
          ->from('tbl_cart_add as i')
          ->join('tbl_cart_address as s','i.order_no=s.order_no','LEFT')
          ->join('tbl_project_design as d','d.id=i.project_no','LEFT')
          ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
          ->join('tbl_users as u','u.id=s.sales','LEFT')
          ->join('tbl_customer_online as uu','uu.id=s.customer','LEFT')
          ->join('tbl_region_shipping as r','r.id=s.region','LEFT')
          ->WHERE('s.order_no',$id)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                $grandtotal = floatval($row->total - $row->downpayment + $row->shipping_fee);
                $data[] = array(
                         'item_id'      => $row->item_id,
                         'order_no'     => $row->order_no,
                         'sales_order'  => $row->sales_person,
                         's_type'       => $row->s_type,
                         'c_name'       => $row->customer,
                         'mobile'       => $row->mobile,
                         'email'        => $row->email,
                         'b_address'    => $row->b_address,
                         'b_city'       => $row->b_city,
                         'b_province'   => $row->b_province,
                         's_address'    => $row->s_address,
                         's_city'       => $row->s_city,
                         's_province'   => $row->s_province,
                         'region'       => $row->region,
                         'shipping_range' => $row->shipping_range,
                         'shipping_fee' => number_format($row->shipping_fee,2),
                         'title'        => $row->title,
                         'color'        => $row->color,
                         'qty'          => $row->qty,
                         'status'       => $row->status,
                         'c_price'      => $row->c_price,
                         'type'         => $row->type,
                         'vat'          => $row->vat,
                         'price'        => number_format($row->price,2),
                         'total'        => number_format($row->total,2),
                         'discount'     => $row->discount,
                         'subtotal'     => number_format($row->subtotal,2),
                         'downpayment'  => number_format($row->downpayment,2),
                         'grandtotal'   => number_format($grandtotal,2),
                         'status'       => $row->status,
                         'date_order'   => $row->date_order);
               } 
               return $data;}
         }
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
   
}
?>
