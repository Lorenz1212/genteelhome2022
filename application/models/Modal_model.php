<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
class Modal_model extends CI_Model{  
    //Modal View
    function Modal_Design_Stocks_View($id){
        $query = $this->db->select('c.*,d.*')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->where('c.id', $this->encryption->decrypt($id))->get();
         return $query->row();
    }
    function Modal_Design_Project_View($id){
        $query = $this->db->select('c.*,d.*')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->where('c.id', $this->encryption->decrypt($id))->get();
         return $query->row();
    }

     function Modal_Joborder_Stocks_View($id){
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
          ->from('tbl_project as p')
           ->join('tbl_project_color as c','c.id=p.c_code','LEFT')
          ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
          ->join('tbl_users as u','u.id=p.production','LEFT')->where('p.production_no', $id)->get();
          return $query->row();
    } 
    function Modal_Joborder_Project_View($id){
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
          ->from('tbl_project as p')
          ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
          ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
          ->join('tbl_users as u','u.id=p.production','LEFT')->where('p.production_no', $id)->get();
          return $query->row();
    } 
     function Modal_JobOrder_Finished($id){
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
          ->from('tbl_project_finished as p')
          ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
          ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
          ->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.production_no', $id)->get();
          return $query->row();
    } 
    function Modal_Stocks_Rawmats_View($id){
        $row = $this->db->select('*')->from('tbl_materials')->WHERE('id',$id)->get()->row();
        return $row;
    }
    function Modal_Production_Stocks($id){
        $row = $this->db->select('*')->from('tbl_materials')->WHERE('id',$id)->get()->row();
        return $row;
    }
    function Modal_Stocks_SpareParts_View($id){
        $row = $this->db->select('*')->from('tbl_other_materials')->where('id',$id)->get()->row();
        return $row;
    }
    function Modal_Stocks_OfficeSupplies_View($id){
        $row = $this->db->select('*')->from('tbl_other_materials')->WHERE('id',$id)->get()->row(); 
        return $row;
    }
   
     function Modal_SalesOrder_Stocks($id){
          $id = $this->encryption->decrypt($id);
          $data=array();
          $dis = 0; 
          $query =  $this->db->select('s.*,i.*,c.*,d.*,s.id,s.status,s.so_no,sc.*,CONCAT(u.firstname, " ",u.lastname) AS sales_person,DATE_FORMAT(s.date_order, "%M %d %Y") as date_order,(SELECT sum(amount) FROM tbl_salesorder_stocks_item WHERE so_no=s.id) as subtotal')
          ->from('tbl_salesorder_stocks_item as i')
          ->join('tbl_salesorder_stocks as s','i.so_no=s.id','LEFT')
          ->join('tbl_project_color as c','c.id=i.c_code','LEFT')
          ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
          ->join('tbl_salesorder_customer as sc','sc.id=s.customer','LEFT')
          ->join('tbl_users as u','u.id=s.created_by','LEFT')
          ->WHERE('s.id',$id)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                    if($row->discount !=0){
                        $dis = floatval($row->discount/100);
                    }
                    $discount = $row->subtotal*$dis;
                    $subtotal = $row->subtotal-$discount;
                    if($row->vat==1){
                        $vat = $row->subtotal*0.12;
                        $amount_due = floatval($subtotal - $row->downpayment + $row->shipping_fee + $vat);
                    }else{
                        $vat = 0;
                        $amount_due = floatval($subtotal - $row->downpayment + $row->shipping_fee); 
                    }
                $item = $row->qty.' '.$row->unit.' '.$row->title.' ('.$row->c_name.')';
                $data[] = array(
                         'id'           => $this->encryption->encrypt($row->id),
                         'so_no'		=> $row->so_no,
                         'si_no'        => $row->si_no,
                         'sales_order'	=> $row->sales_person,
                         'customer'     => $row->fullname,
                         'mobile'       => $row->mobile,
                         'address'      => $row->address,
                         'item'         => $item,
                         'vat_status'   => $row->vat,
                         'amount'       => number_format($row->amount,2),
                         'subtotal'     => number_format($row->subtotal,2),
                         'total'        => number_format($row->subtotal+$vat,2),
                         'discount'     => $row->discount,
                         'subtotal'     => number_format($row->subtotal,2),
                         'shipping_fee' => number_format($row->shipping_fee,2),
                         'downpayment'  => number_format($row->downpayment,2),
                         'amount_due'   => number_format($amount_due,2),
                         'vat'          => number_format($vat,2),
                         'date_order'   => $row->date_order,
                         'delivery'     => $row->delivery,
                         'status'       => $row->status
                     );
               } 
               return $data;
           }
    }
    function Modal_SalesOrder_Project($id){
      $id = $this->encryption->decrypt($id);
      $dis = 0; 
      $row =  $this->db->select('s.*,sc.*,s.id,DATE_FORMAT(s.date_order, "%M %d %Y") as date_order')
      ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as sc','sc.id=s.customer','LEFT')
      ->join('tbl_users as u','u.id=s.created_by','LEFT')->WHERE('s.id',$id)->get()->row();
            $lineup = json_decode($row->item,true);
            $data_array['item'] = $lineup;
            $subtotal = array_sum(array_column($lineup,'amount'));
            if($row->discount !=0){
                $dis = floatval($row->discount/100);
            }
            $discount = $subtotal*$dis;
            $subtotal_grand = $subtotal-$discount;
            if($row->vat==1){
                $vat = $subtotal*0.12;
                $amount_due = floatval($subtotal_grand - $row->downpayment + $row->shipping_fee + $vat);
            }else{
                $vat = 0;
                $amount_due = floatval($subtotal_grand - $row->downpayment + $row->shipping_fee); 
            }
            $data['soa'] = array(
                     'id'           => $this->encryption->encrypt($row->id),
                     'so_no'        => $row->so_no,
                     'si_no'        => $row->si_no,
                     'customer'     => $row->fullname,
                     'mobile'       => $row->mobile,
                     'address'      => $row->address,
                     'vat_status'   => $row->vat,
                     'subtotal'     => number_format($subtotal,2),
                     'discount'     => $row->discount,
                     'subtotal'     => number_format($subtotal,2),
                     'shipping_fee' => number_format($row->shipping_fee,2),
                     'downpayment'  => number_format($row->downpayment,2),
                     'amount_due'   => number_format($amount_due,2),
                     'vat'          => number_format($vat,2),
                     'date_order'   => $row->date_order,
                     'delivery'     => $row->delivery,
                     'status'       => $row->status
                 );
           return array_merge($data,$data_array);
    }
   
     function Modal_SupplierItem_View($id){
          $this->db->select('ss.id as ss_id,ss.price as ss_price,ss.status as ss_status,m.item as m_item,DATE_FORMAT(ss.date_created, "%M %d %Y") as ss_date_created')->from('tbl_supplier_item as ss')->join('tbl_materials as m','m.id = ss.item','LEFT')->where('ss.id',$id);
         $query = $this->db->get();
         return $query->row();
    }
    function Modal_Designer_Customization($id){
        $row = $this->db->select('*')->from('tbl_salesorder')->WHERE('so_no',$id)->get()->row();
        return $row;
    }
    function Modal_Users($id){
        $row = $this->db->select('*')->from('tbl_users')->WHERE('id',$id)->get()->get();
        return $row;
    }
    function Modal_RawMaterial_view($id){
         $query = $this->db->select('*')->from('tbl_materials')->WHERE('id',$id)->get();
         return $query->row();
    }
     function Modal_Other_Materials_view($id,$type){
         $row = $this->db->select('*')->from('tbl_other_materials')->where('id',$id)->where('type',$type)->get()->row();
        return $row;
      }
     function Modal_OfficeSupplies_Request($id){
             $query =$this->db->select('*,o.status as status,CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(o.date_created, "%M %d %Y") as date_created')->from('tbl_office_janitorial_request as o')->join('tbl_users as u','u.id=o.requestor','LEFT')->WHERE('o.request_id',$id)->get();
            if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                if($row->status == 'REQUEST'){
                    $qty = $row->qty;
                }else{
                    $qty = $row->balance;
                }
                $data[] = array(
                         'id'           => $row->id,
                         'request_id'   => $row->request_id,
                         'requestor'    => $row->requestor,
                         'item'         => $row->item,
                         'quantity'     => $row->qty,
                         'balance'      => $qty,
                         'remarks'      => $row->remarks,
                         'status'       => $row->status,
                         'date_created' => $row->date_created
                     );
               } 
               return $data;}
    }
    function Modal_SpareParts_Request($id){
         $query =$this->db->select('*,o.status as status,CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(o.date_created, "%M %d %Y") as date_created')->from('tbl_spares_request as o')->join('tbl_users as u','u.id=o.requestor','LEFT')->WHERE('o.request_id',$id)->get();
             if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                if($row->status == 'REQUEST'){
                    $qty = $row->qty;
                }else{
                    $qty = $row->balance;
                }
                $data[] = array(
                         'id'           => $row->id,
                         'request_id'   => $row->request_id,
                         'requestor'    => $row->requestor,
                         'item'         => $row->item,
                         'quantity'     => $row->qty,
                         'balance'      => $qty,
                         'remarks'      => $row->remarks,
                         'status'       => $row->status,
                         'date_created' => $row->date_created
                     );
               } 
               return $data;}
    }
    function Modal_Approval_Inspection_Project_View($id,$status){
        $query = $this->db->select('*,c.image as image,i.images as i_images,i.remarks as remarks,i.status as status,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_inspection as i')
        ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
        ->join('tbl_project_design as d','d.id=j.project_no','LEFT')
        ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
        ->join('tbl_users as u', 'u.id=i.created_by','LEFT')
        ->where('i.status',$status)
        ->where('i.production_no',$this->encryption->decrypt($id))->get();
         if(!$query){return false;}else{  
               foreach($query->result() as $row){
                $data[] = array(
                         'id'           => $row->id,
                         'production_no'=> $row->production_no,
                         'title'        => $row->title,
                         'qty'          => $row->qty,
                         'c_name'       => $row->c_name,
                         'c_image'      => $row->c_image,
                         'image'        => $row->image,
                         'i_images'     => $row->i_images,
                         'remarks'      => $row->remarks,
                         'status'       => $row->status,
                         'date_created' => $row->date_created);
               } 
               return $data;}
         return  $query->row();
    }
    function Modal_Approval_Inspection_Stocks_View($id,$status){
        $query = $this->db->select('*,c.image as image,i.images as i_images,i.remarks as remarks,i.status as status,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_inspection as i')
        ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
        ->join('tbl_project_color as c','c.id=j.project_no','LEFT')
        ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
        ->join('tbl_users as u', 'u.id=i.created_by','LEFT')
        ->where('i.status',$status)
        ->where('i.production_no',$this->encryption->decrypt($id))->get();
         if(!$query){return false;}else{  
               foreach($query->result() as $row){
                $data[] = array(
                         'id'           => $row->id,
                         'production_no'=> $row->production_no,
                         'title'        => $row->title,
                         'c_name'       => $row->c_name,
                         'qty'          => $row->qty,
                         'c_name'       => $row->c_name,
                         'c_image'      => $row->c_image,
                         'image'        => $row->image,
                         'i_images'     => $row->i_images,
                         'remarks'      => $row->remarks,
                         'status'       => $row->status,
                         'date_created' => $row->date_created);
               } 
               return $data;}
         return  $query->row();
    }
    function Modal_Approval_Purchase_View($id,$status){
          $array = array('pp.admin_status =' => $status, 'pp.request_id' => $id);
          $status1 = 'request_id = "'.$id.'" AND admin_status = "'.$status.'"';
          $query = $this->db->select('d.*,c.*,pp.*,pp.unit as units,pp.remarks as remakrs,pp.id as id,p.production_no as production_no,p.unit as unit,pp.item as item,pp.quantity as quantity,pp.balance_quantity as balance,pp.status as status,pp.remarks as remarks,CONCAT(u.firstname, " ",u.lastname) AS production,DATE_FORMAT(pp.latest_update, "%M %d %Y %r") as date_created,(SELECT sum(amount ) FROM tbl_purchasing_project WHERE '.$status1.') as total')
            ->from('tbl_purchasing_project as pp')->join('tbl_project as p','p.production_no=pp.production_no','LEFT')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=pp.supervisor','LEFT')->WHERE($array)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                $data[] = array(
                         'id'           => $row->id,
                         'production_no'=> $row->production_no,
                         'production'   => $row->production,
                         'unit'         => $row->unit,
                         'title'        => $row->title,
                         'c_name'       => $row->c_name,
                         'item'         => $row->item,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance,
                         'units'        => $row->units,
                         'amount'       => number_format($row->amount,2),
                         'total'        => number_format($row->total,2),
                         'remarks'      => $row->remarks,
                         'status'       => $row->status,
                         'remakrs'      => $row->remarks,
                         'date_created' => $row->date_created);
               } 
               return $data;}
    }
     function Modal_Purchase_Stocks_View($id){
          $query = $this->db->select('p.*,r.status as status,DATE_FORMAT(r.date_created, "%M %d %Y %r") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS purchaser')
          ->from('tbl_purchase_stocks as p')
          ->join('tbl_request_id as r','r.request_id=p.request_id','LEFT')
          ->join('tbl_users as u','u.id=r.purchaser','LEFT')
          ->where('p.request_id', $id)->get();  
           if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                if($row->remarks == 'rawmats'){
                     $type = 'Raw Material';
                }else if($row->remarks == 'office'){
                    $type = 'Office & Janitorial Supplies';
                }else if($row->remarks == 'production'){
                    $type = 'Production Supplies/Spare Parts';
                }
                $data[] = array(
                         'id'           => $row->id,
                         'request_id'   => $row->request_id,
                         'purchaser'    => $row->purchaser,
                         'item'         => $row->item,
                         'quantity'     => $row->qty,
                         'balance'      => $row->balance,
                         'unit'         => $row->unit,
                         'amount'       => number_format($row->amount,2),
                         'type'         => $type,
                         'status'       => $row->status,
                         'date_created' => $row->date_created);
               } 
               return $data;}
    }
      function Modal_Purchase_Stocks_Complete_View($id){
          $query = $this->db->select('p.*,r.status as status,DATE_FORMAT(r.date_created, "%M %d %Y %r") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS purchaser')
          ->from('tbl_purchase_stocks_received as p')
          ->join('tbl_request_id as r','r.request_id=p.request_id','LEFT')
          ->join('tbl_users as u','u.id=r.purchaser','LEFT')
          ->where('p.fund_no', $id)->get();  
           if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                $data[] = array(
                         'id'           => $row->id,
                         'request_id'   => $row->request_id,
                         'purchaser'    => $row->purchaser,
                         'item'         => $row->item,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance,
                         'unit'         => $row->unit,
                         'amount'       => number_format($row->amount,2),
                         'status'       => $row->status,
                         'date_created' => $row->date_created);
               } 
               return $data;}
    }

     function Modal_Purchase_Stocks_Request_View($id){
         $query =  $this->db->select('d.*,c.*,pr.id as id,p.production_no as production_no,
            IFNULL(m.unit," ") as unit,m.item as item,pr.quantity as quantity,pr.balance_quantity as balance,
            pr.status as status,pr.remarks as remarks,CONCAT(u.firstname, " ",u.lastname) AS production,
            DATE_FORMAT(pr.date_created, "%M %d %Y %r") as date_created')
         ->from('tbl_purchasing_project as pr')
         ->join('tbl_materials as m','m.id=pr.item_no','LEFT')
         ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
         ->join('tbl_project_color as c','c.id=p.c_code','LEFT')
         ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
         ->join('tbl_users as u','u.id=p.assigned','LEFT')
         ->WHERE('pr.status=2 AND pr.production_no="'.$id.'" AND pr.fund_no IS NULL')->get(); 
            foreach($query->result() as $row){
                $data[] = array('id'    => $row->id,
                         'production_no'=> $row->production_no,
                         'title'        => $row->title,
                         'c_name'       => $row->c_name,
                         'item'         => $row->item,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance,
                         'unit'         => $row->unit,
                         'status'       => $row->status,
                         'remarks'      => $row->remarks,
                         'production'   => $row->production,
                         'date_created' => $row->date_created);
              
            }
            return $data;
     }
     function Modal_Purchase_Stocks_Inprogress_View($id){
        $query =  $this->db->select('d.*,c.*,pr.*,IFNULL(m.unit," ") as unit,pr.id as id,p.production_no as production_no,
            m.item as item,pr.quantity as quantity,pr.remarks as remarks,CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(pr.date_created, "%M %d %Y %r") as date_created,(SELECT count(status) from tbl_purchasing_project WHERE status=3 AND type=1 AND fund_no="'.$id.'") as status_request,(SELECT count(status) from tbl_purchasing_project WHERE status=4 AND type=1 AND fund_no="'.$id.'") as status_approved')
         ->from('tbl_purchasing_project as pr')
         ->join('tbl_materials as m','m.id=pr.item_no','LEFT')
         ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
         ->join('tbl_project_color as c','c.id=p.c_code','LEFT')
         ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
         ->join('tbl_users as u','u.id=p.assigned','LEFT')
         ->where('pr.fund_no',$id)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                $data[] = array('id'        => $row->id,
                         'production_no'    => $row->production_no,
                         'unit'             => $row->unit,
                         'title'            => $row->title,
                         'c_name'           => $row->c_name,
                         'item'             => $row->item,
                         'quantity'         => $row->quantity,
                         'balance'          => $row->balance_quantity,
                         'remarks'          => $row->remarks,
                         'requestor'        => $row->requestor,
                         'status_request'   => $row->status_request,
                         'status_approved'  => $row->status_approved,
                         'date_created'     => $row->date_created);
               } 
               return $data;
           }
      }

      function Modal_Purchase_Project_Request_View($id){
         $query =  $this->db->select('d.*,c.*,pr.id as id,p.production_no as production_no,
            IFNULL(m.unit," ") as unit,m.item as item,pr.quantity as quantity,pr.balance_quantity as balance,
            pr.status as status,pr.remarks as remarks,CONCAT(u.firstname, " ",u.lastname) AS production,
            DATE_FORMAT(pr.date_created, "%M %d %Y %r") as date_created')
         ->from('tbl_purchasing_project as pr')
         ->join('tbl_materials as m','m.id=pr.item_no','LEFT')
         ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
         ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
         ->join('tbl_project_color as c','d.id=c.project_no','LEFT')
         ->join('tbl_users as u','u.id=p.assigned','LEFT')
         ->WHERE('pr.status=2 AND pr.production_no="'.$id.'" AND pr.fund_no IS NULL')->get(); 
            foreach($query->result() as $row){
                $data[] = array('id'    => $row->id,
                         'production_no'=> $row->production_no,
                         'title'        => $row->title,
                         'item'         => $row->item,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance,
                         'unit'         => $row->unit,
                         'status'       => $row->status,
                         'remarks'      => $row->remarks,
                         'production'   => $row->production,
                         'date_created' => $row->date_created);
              
            }
            return $data;
    }
     function Modal_Purchase_Project_Inprogress_View($id){
        $query =  $this->db->select('d.*,c.*,pr.*,IFNULL(m.unit," ") as unit,pr.id as id,p.production_no as production_no,
            m.item as item,pr.quantity as quantity,pr.remarks as remarks,CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(pr.date_created, "%M %d %Y %r") as date_created,(SELECT count(status) from tbl_purchasing_project WHERE status=3 AND type=2 AND fund_no="'.$id.'") as status_request,(SELECT count(status) from tbl_purchasing_project WHERE status=4 AND type=2 AND fund_no="'.$id.'") as status_approved')
         ->from('tbl_purchasing_project as pr')
         ->join('tbl_materials as m','m.id=pr.item_no','LEFT')
         ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
         ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
         ->join('tbl_project_color as c','d.id=c.project_no','LEFT')
         ->join('tbl_users as u','u.id=p.assigned','LEFT')
         ->where('pr.fund_no',$id)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                $data[] = array('id'        => $row->id,
                         'production_no'    => $row->production_no,
                         'unit'             => $row->unit,
                         'title'            => $row->title,
                         'item'             => $row->item,
                         'quantity'         => $row->quantity,
                         'balance'          => $row->balance_quantity,
                         'remarks'          => $row->remarks,
                         'requestor'        => $row->requestor,
                         'status_request'   => $row->status_request,
                         'status_approved'  => $row->status_approved,
                         'date_created'     => $row->date_created);
               } 
               return $data;
           }
      }
    
    

      function Modal_Material_Request_Complete_View($id){
         $query =  $this->db->select('d.*,c.*,pp.*,pp.production_no as production_no,
            p.unit as unit,pp.item as item,pp.quantity as quantity,CONCAT(u.firstname, " ",u.lastname) AS production,
            DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created')
         ->from('tbl_material_release as pp')
         ->join('tbl_project as p','p.production_no=pp.production_no','LEFT')
         ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
         ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
         ->join('tbl_users as u','u.id=p.production','LEFT')
         ->WHERE('pp.production_no',$id)->get(); 
           if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                $data[] = array(
                         'id'           => $row->id,
                         'production_no'=> $row->production_no,
                         'unit'         => $row->unit,
                         'title'        => $row->title,
                         'c_name'       => $row->c_name,
                         'item'         => $row->item,
                         'quantity'     => $row->quantity,
                         'production'   => $row->production,
                         'date_created' => $row->date_created);
               } 
               return $data;
           }
         }
    function Modal_Purchase_Approval_View($id,$status){
         $query = $this->db->select('pp.unit as units,pp.id as id,pp.amount as amount,p.production_no as production_no,p.title as title,p.unit as unit,pp.item as item,pp.quantity as quantity,pp.balance_quantity as balance,pp.status as status,pp.delivery as delivery,pp.type as type,pp.remarks as remarks, CONCAT(u.firstname, " ",u.lastname) AS approver1, CONCAT(uu.firstname, " ",uu.lastname) AS approver2,CONCAT(uuu.firstname, " ",uuu.lastname) AS receiver,CONCAT(uuuu.firstname, " ",uuuu.lastname) AS production,DATE_FORMAT(pp.date_pending, "%M %d %Y %r") as date_pending,DATE_FORMAT(pp.date_created, "%M %d %Y %r") as date_created,DATE_FORMAT(pp.date_complete, "%M %d %Y %r") as date_complete,DATE_FORMAT(pp.date_rejected, "%M %d %Y %r") as date_rejected,DATE_FORMAT(pp.date_inprogress, "%M %d %Y %r") as date_inprogress,DATE_FORMAT(pp.date_approved1, "%M %d %Y %r") as date_approved1,(SELECT sum(amount ) FROM tbl_purchasing_project WHERE production_no = "'.$id.'" AND status = "'.$status.'") as total')->from('tbl_purchasing_project as pp')->join('tbl_project as p','p.production_no=pp.production_no','LEFT')->join('tbl_users as u','u.id=pp.approver1','LEFT')->join('tbl_users as uu','uu.id=pp.approver2','LEFT')->join('tbl_users as uuu','uuu.id=pp.receiver','LEFT')->join('tbl_users as uuuu','uuuu.id=p.production','LEFT')->WHERE('pp.production_no',$id)->WHERE('pp.status',$status)->get(); 
               if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                $data[] = array(
                         'id'           => $row->id,
                         'production_no'=> $row->production_no,
                         'unit'         => $row->unit,
                         'title'        => $row->title,
                         'item'         => $row->item,
                         'amount'       => number_format($row->amount,2),
                         'total'        => number_format($row->total,2),
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance,
                         'units'          => $row->units,
                         'type'           => $row->type,
                         'status'         => $row->status,
                         'delivery'       => $row->delivery,
                         'remarks'        => $row->remarks,
                         'approver1'      => $row->approver1,
                         'approver2'      => $row->approver2,
                         'receiver'       => $row->receiver,
                         'production'     => $row->production,
                         'date_created'   => $row->date_created,
                         'date_pending'   => $row->date_pending,
                         'date_complete'  => $row->date_complete,
                         'date_inprogress'=> $row->date_inprogress,
                         'date_rejected'  => $row->date_rejected,
                         'date_approved1' => $row->date_approved1
                     );
               } 
               return $data;
         }
     }

         //ACCOUNTING
         function Modal_Accounting_Purchase_Material_Stocks_Request($id){
               $query = $this->db->select('pr.*,p.*,c.*,d.*,m.unit,pr.id,pr.amount,p.production_no,m.item,pr.quantity as quantity,pr.status,CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(pr.latest_update, "%M %d %Y %r") as date_created,(SELECT sum(amount) FROM tbl_purchasing_project WHERE fund_no = "'.$id.'" AND status=3 AND type=1) as total')->from('tbl_purchasing_project as pr')->join('tbl_materials as m','pr.item_no=m.id','LEFT')->join('tbl_project as p','p.production_no=pr.production_no','LEFT')->join('tbl_project_color as c','c.id=p.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=pr.supervisor','LEFT')->where('pr.status',3)->where('pr.type',1)->where('pr.fund_no',$id)->get(); 
               if(!$query){return false;}else{  
               foreach($query->result() as $row){
                 if($row->unit){$unit = '('.$row->unit.')';}else{$unit="";}
                    $data[] = array('id'  => $row->id,
                     'production_no'  => $row->production_no,
                     'fund_no'        => $row->fund_no,
                     'unit'           => $unit,
                     'title'          => $row->title,
                     'c_name'         => $row->c_name,
                     'item'           => $row->item,
                     'amount'         => number_format($row->amount,2),
                     'total'          => number_format($row->total,2),
                     'quantity'       => $row->quantity,
                     'status'         => $row->status,
                     'requestor'      => $row->requestor,
                     'date_created'   => $row->date_created);
               } 
               return $data;
         }
     }
          function Modal_Accounting_Purchase_Material_Stocks_Approved($id){
                $query = $this->db->select('pr.*,p.*,c.*,d.*,pc.*,pr.id,pr.amount,p.production_no,m.unit,m.item ,pr.quantity,pr.status as status,CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(pc.date_created, "%M %d %Y %r") as date_created,(SELECT sum(amount) FROM tbl_purchasing_project WHERE fund_no= "'.$id.'") as total')
                    ->from('tbl_purchasing_project as pr')
                    ->join('tbl_materials as m','pr.item_no=m.id','LEFT')
                    ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
                    ->join('tbl_project_color as c','c.id=p.c_code','LEFT')
                    ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
                    ->join('tbl_pettycash as pc','pc.fund_no=pr.fund_no','LEFT')
                    ->join('tbl_users as u','u.id=pr.supervisor','LEFT')->WHERE('pr.fund_no',$id)->get(); 
               if(!$query){return false;}else{  
               foreach($query->result() as $row){
                 if($row->unit){$unit = '('.$row->unit.')';}else{$unit="";}
                       $data[] = array('id'             => $row->id,
                                       'fund_no'        => $row->fund_no,
                                       'production_no'  => $row->production_no,
                                       'unit'           => $unit,
                                       'title'          => $row->title,
                                       'c_name'         => $row->c_name,
                                       'item'           => $row->item,
                                       'pettycash'      => number_format($row->pettycash,2),
                                       'updatecash'     => number_format($row->update_pettycash,2),
                                       'amount'         => number_format($row->amount,2),
                                       'total'          => number_format($row->total,2),
                                       'quantity'       => $row->quantity,
                                       'requestor'      => $row->requestor,
                                       'date_created' => $row->date_created);
               } 
               return $data;
         }
    }
    function Modal_Accounting_Purchase_Received_Stocks($id){
        $query = $this->db->select('*,d.title,m.unit,c.c_name,pp.id,pp.amount,pc.fund_no,pp.production_no,pp.quantity,pc.status,CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(pp.date_created, "%M %d %Y %r") as date_created,(SELECT sum(amount) FROM tbl_purchase_received WHERE pr_id=pr.id) as total')
                    ->from('tbl_purchase_received as pp')
                    ->join('tbl_materials as m','m.id=pp.item_no','LEFT')
                    ->join('tbl_supplier as s','s.id=pp.supplier','LEFT')
                    ->join('tbl_purchasing_project as pr','pr.id=pp.pr_id','LEFT')
                    ->join('tbl_project as p','p.production_no=pp.production_no','LEFT')
                    ->join('tbl_project_color as c','p.c_code=c.id','LEFT')
                    ->join('tbl_project_design as d','c.project_no=d.id','LEFT')
                    ->join('tbl_pettycash as pc','pc.fund_no=pr.fund_no','LEFT')
                    ->join('tbl_users as u','u.id=pp.created_by','LEFT')->WHERE('pc.fund_no',$id)->get(); 
            if(!$query){return false;}else{  
               foreach($query->result() as $row){    
                if($row->unit){$unit = '('.$row->unit.')';}else{$unit="";}
                 if($row->terms==1){$terms ='<span class="label label-lg label-light-primary label-inline">CASH</span>';
                }else if($row->terms == 2){$terms ='<span class="label label-lg label-light-primary label-inline">TERMS </span>';} 
                       $data[] = array('id'             => $row->id,
                                       'fund_no'        => $row->fund_no,
                                       'production_no'  => $row->production_no,
                                       'unit'           => $unit,
                                       'title'          => $row->title,
                                       'c_name'         => $row->c_name,
                                       'item'           => $row->item,
                                       'pettycash'      => number_format($row->pettycash,2),
                                       'updatecash'     => number_format($row->update_pettycash,2),
                                       'amount'         => number_format($row->amount,2),
                                       'total'          => number_format($row->total,2),
                                       'actual_change'  => number_format($row->actual_change,2),
                                       'refund'         => number_format($row->refund,2),
                                       'quantity'       => $row->quantity,
                                       'requestor'      => $row->requestor,
                                       'supplier'       => $row->name,
                                       'type'           => $terms,
                                       'date_created'   => $row->date_created);
               } 
               return $data;
         }
    }


     function Modal_Accounting_Purchase_Material_Project_Request($id){
               $query = $this->db->select('pr.*,p.*,c.*,d.*,m.unit,pr.id,pr.amount,p.production_no,m.item,pr.quantity as quantity,pr.status,CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(pr.latest_update, "%M %d %Y %r") as date_created,(SELECT sum(amount) FROM tbl_purchasing_project WHERE fund_no = "'.$id.'" AND status=3 AND type=2) as total')->from('tbl_purchasing_project as pr')
               ->join('tbl_materials as m','pr.item_no=m.id','LEFT')
               ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
               ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
               ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
               ->join('tbl_users as u','u.id=pr.supervisor','LEFT')
               ->where('pr.status',3)->where('pr.type',2)
               ->where('pr.fund_no',$id)->get(); 
               if(!$query){return false;}else{  
               foreach($query->result() as $row){
                if($row->unit){$unit = '('.$row->unit.')';}else{$unit="";}
                    $data[] = array('id'  => $row->id,
                     'production_no'  => $row->production_no,
                     'fund_no'        => $row->fund_no,
                     'unit'           => $unit,
                     'title'          => $row->title,
                     'item'           => $row->item,
                     'amount'         => number_format($row->amount,2),
                     'total'          => number_format($row->total,2),
                     'quantity'       => $row->quantity,
                     'status'         => $row->status,
                     'requestor'      => $row->requestor,
                     'date_created'   => $row->date_created);
               } 
               return $data;
         }
     }

       function Modal_Accounting_Purchase_Material_Project_Approved($id){
                $query = $this->db->select('pr.*,p.*,c.*,d.*,pc.*,pr.id,pr.amount,p.production_no,m.unit,m.item ,pr.quantity,pr.status as status,CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(pc.date_created, "%M %d %Y %r") as date_created,(SELECT sum(amount) FROM tbl_purchasing_project WHERE fund_no= "'.$id.'") as total')
                    ->from('tbl_purchasing_project as pr')
                    ->join('tbl_materials as m','pr.item_no=m.id','LEFT')
                    ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
                    ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
                    ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
                    ->join('tbl_pettycash as pc','pc.fund_no=pr.fund_no','LEFT')
                    ->join('tbl_users as u','u.id=pr.supervisor','LEFT')->WHERE('pr.fund_no',$id)->get(); 
               foreach($query->result() as $row){
                 if($row->unit){$unit = '('.$row->unit.')';}else{$unit=" ";}
                       $data[] = array('id'             => $row->id,
                                       'fund_no'        => $row->fund_no,
                                       'production_no'  => $row->production_no,
                                       'unit'           => $unit,
                                       'title'          => $row->title,
                                       'item'           => $row->item,
                                       'pettycash'      => number_format($row->pettycash,2),
                                       'updatecash'     => number_format($row->update_pettycash,2),
                                       'amount'         => number_format($row->amount,2),
                                       'total'          => number_format($row->total,2),
                                       'quantity'       => $row->quantity,
                                       'requestor'      => $row->requestor,
                                       'date_created' => $row->date_created);
               } 
               return $data;
    }
    function Modal_Accounting_Purchase_Received_Project($id){
        $query = $this->db->select('*,d.title,m.unit,c.c_name,pp.id,pp.amount,pc.fund_no,pp.production_no,pp.quantity,pc.status,CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(pp.date_created, "%M %d %Y %r") as date_created,(SELECT sum(amount) FROM tbl_purchase_received WHERE pr_id=pr.id) as total')
                    ->from('tbl_purchase_received as pp')
                    ->join('tbl_materials as m','m.id=pp.item_no','LEFT')
                    ->join('tbl_supplier as s','s.id=pp.supplier','LEFT')
                    ->join('tbl_purchasing_project as pr','pr.id=pp.pr_id','LEFT')
                    ->join('tbl_project as p','p.production_no=pp.production_no','LEFT')
                    ->join('tbl_project_design as d','p.project_no=d.id','LEFT')
                     ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
                    ->join('tbl_pettycash as pc','pc.fund_no=pr.fund_no','LEFT')
                    ->join('tbl_users as u','u.id=pp.created_by','LEFT')->WHERE('pc.fund_no',$id)->get(); 
            if(!$query){return false;}else{  
               foreach($query->result() as $row){   
                if($row->unit){$unit = '('.$row->unit.')';}else{$unit="";}  
                 if($row->terms==1){$terms ='<span class="label label-lg label-light-primary label-inline">CASH</span>';
                }else if($row->terms == 2){$terms ='<span class="label label-lg label-light-primary label-inline">TERMS </span>';} 
                       $data[] = array('id'             => $row->id,
                                       'fund_no'        => $row->fund_no,
                                       'production_no'  => $row->production_no,
                                       'unit'           => $unit,
                                       'title'          => $row->title,
                                       'item'           => $row->item,
                                       'pettycash'      => number_format($row->pettycash,2),
                                       'updatecash'     => number_format($row->update_pettycash,2),
                                       'amount'         => number_format($row->amount,2),
                                       'total'          => number_format($row->total,2),
                                       'actual_change'  => number_format($row->actual_change,2),
                                       'refund'         => number_format($row->refund,2),
                                       'quantity'       => $row->quantity,
                                       'requestor'      => $row->requestor,
                                       'supplier'       => $row->name,
                                       'type'           => $terms,
                                       'date_created'   => $row->date_created);
               } 
               return $data;
         }
    }






















    

     function Modal_Accounting_Purchase_Stocks_Request($id){
               $array = array('pp.status' => 'PENDING','pp.fund_no' => NULL,'pp.request_id'=>$id);
               $query = $this->db->select('pp.*,CONCAT(u.firstname, " ",u.lastname) AS requestor,
                       DATE_FORMAT(pp.date_created, "%M %d %Y %r") as date_created,
                       (SELECT sum(amount) FROM tbl_purchase_stocks WHERE request_id = "'.$id.'" AND status = "PENDING" AND fund_no IS NULL) as total')
                    ->from('tbl_purchase_stocks as pp')
                    ->join('tbl_users as u','u.id=pp.purchaser','LEFT')->WHERE($array)->get(); 
               if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                       $data[] = array(
                                     'id'             => $row->id,
                                     'request_id'     => $row->request_id,
                                     'item'           => $row->item,
                                     'amount'         => number_format($row->amount,2),
                                     'total'          => number_format($row->total,2),
                                     'quantity'       => $row->qty,
                                     'balance'        => $row->balance,
                                     'units'          => $row->unit,
                                     'type'           => $row->type,
                                     'status'         => $row->status,
                                     'requestor'      => $row->requestor,
                                     'date_approved1' => $row->date_created);
               } 
               return $data;
         }
       
    }
      function Modal_Accounting_Purchase_Stocks_Approved($id){
               $array = array('pp.fund_no' => $id);
               $query = $this->db->select('pp.*,c.*,pp.id as id,pp.status as status,CONCAT(u.firstname, " ",u.lastname) AS requestor,
                       DATE_FORMAT(pp.date_received, "%M %d %Y %r") as date_received,
                       (SELECT sum(amount) FROM tbl_purchase_stocks WHERE fund_no= "'.$id.'") as total')
                    ->from('tbl_purchase_stocks as pp')
                    ->join('tbl_pettycash as c','c.fund_no=pp.fund_no','LEFT')
                    ->join('tbl_users as u','u.id=pp.purchaser','LEFT')->WHERE($array)->get(); 
               if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {
                       $data[] = array('id'             => $row->id,
                                       'fund_no'        => $row->fund_no,
                                       'request_id'     => $row->request_id,
                                       'item'           => $row->item,
                                       'pettycash'      => number_format($row->pettycash,2),
                                       'updatecash'     => number_format($row->update_pettycash,2),
                                       'amount'         => number_format($row->amount,2),
                                       'total'          => number_format($row->total,2),
                                       'quantity'       => $row->qty,
                                       'balance'        => $row->balance,
                                       'units'          => $row->unit,
                                       'type'           => $row->type,
                                       'requestor'      => $row->requestor,
                                       'date_received'  => $row->date_received);
               } 
               return $data;
         }
    }
    function Modal_Accounting_Purchase_Stocks_Received($id){
               $array = array('c.fund_no' => $id);
               $query = $this->db->select('pp.*,c.*,
                    CONCAT(u.firstname, " ",u.lastname) AS requestor,
                    DATE_FORMAT(c.date_created, "%M %d %Y") as date_created,
                       (SELECT sum(amount) FROM tbl_purchase_stocks_received WHERE fund_no= "'.$id.'") as total')
                    ->from('tbl_purchase_stocks_received as pp')
                    ->join('tbl_pettycash as c','c.fund_no=pp.fund_no','LEFT')
                    ->join('tbl_users as u','u.id=pp.purchaser','LEFT')->where($array)->get(); 
               if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               {        
                       $data[] = array('id'             => $row->id,
                                       'fund_no'        => $row->fund_no,
                                       'request_id'     => $row->request_id,
                                       'item'           => $row->item,
                                       'pettycash'      => number_format($row->pettycash,2),
                                       'updatecash'     => number_format($row->update_pettycash,2),
                                       'amount'         => number_format($row->amount,2),
                                       'total'          => number_format($row->total,2),
                                       'actual_change'  => number_format($row->actual_change,2),
                                       'refund'         => number_format($row->refund,2),
                                       'quantity'       => $row->quantity,
                                       'balance'        => $row->balance,
                                       'units'          => $row->unit,
                                       'requestor'      => $row->requestor,
                                       'supplier'       => $row->supplier,
                                       'type'           => $row->payment,
                                       'date_created'   => $row->date_created);
               } 
               return $data;
         }
    }
    function Modal_Accounting_Other_Expenses($id){
           $query = $this->db->select('*, DATE_FORMAT(date_expenses, "%m/%d/%Y") as date_expenses')->from('tbl_other_expenses')->WHERE('id',$id)->get(); 
           $row = $query->row();
            $data[] = array('cat_id'        => $row->cat_id,
                            'id'            => $row->id,
                            'amount'        => number_format($row->amount,2),
                            'date_expenses' => $row->date_expenses,
                            'description'   => $row->description);
           return $data;
    }
    function Modal_Accounting_Category_Expenses($id){
           $query = $this->db->select('*')->from('tbl_category_expenses')->where('id',$id)->get(); 
           return $query->row();
    }
    function Modal_Accounting_Income_Statement($id){
           $query = $this->db->select('*,DATE_FORMAT(date_income, "%m/%d/%Y") as date_income')->from('tble_income_statement')->WHERE('id',$id)->get(); 
           $row = $query->row();
            $data[] = array('income_id'        => $row->income_id,
                            'id'            => $row->id,
                            'amount'        => number_format($row->amount,2),
                            'date_income'   => $row->date_income,
                            'description'   => $row->description);
           return $data;
    }
    function Modal_Accounting_Category_Income_List(){
           $query = $this->db->select('*')->from('tbl_category_income')->get(); 
           foreach($query->result() as $row){
                 $data[] = array('id'   => $this->encryption->encrypt($row->id),
                                 'count' => $row->id,
                                 'name' => $row->name);
            }
           return $data;
    }
    function Modal_Accounting_Category_Income($id){
           $query = $this->db->select('*')->from('tbl_category_income')->WHERE('id',$id)->get();
           $row = $query->row(); 
           $data[] = array('id' => $this->encryption->encrypt($row->id),
                           'name' => $row->name);
           return $data;
    }

    function Modal_Delivery_Stocks_Data($id){
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



    //WebModifier
    function Modal_Web_Banner($id){
        $query = $this->db->select('*')->from('tbl_website_banner')->WHERE('id',$id)->get(); 
        if(!$query){return false;}else{return $query->row();}
    }
     function Modal_Web_Product_Data($id){
       $query1 = $this->db->select('*')->from('tbl_category_sub')->where('id',$id)->get();
       $row1 = $query1->row();
       $query = $this->db->select('*')->from('tbl_project_design')->where('sub_id IS NULL')->get();

                if($query !== FALSE && $query->num_rows() > 0){
                      foreach($query->result() as $row)  
                    {
                     $data[] = array(
                                 'id'           => $row->id,
                                 'title'        => $row->title);
                    }  
                }else{
                     $data = false;
                }
               $json = array('data'     => $data,
                             'sub_id'   => $row1->id,
                             'sub_name' => $row1->sub_name);
               return $json;
    }
      function Modal_Web_Product_Color_Data($id){
       $query = $this->db->select('*')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->where('c.project_no',$this->encryption->decrypt($id))->get();
                if($query !== FALSE && $query->num_rows() > 0){
                    foreach($query->result() as $row)  {
                     $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-45 symbol-light mr-3"><div class="symbol-label">
                    <img class="h-75" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.' ('.$row->c_name.')"></div></div>
                    <div class="symbol symbol-45 symbol-light mr-3"><div class="symbol-label">
                    <img class="h-75" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="'.$row->c_name.'"></div></div>
                    <a  class="symbol symbol-45 symbol-light mr-3"><div class="symbol-label">
                    <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><div>
                    <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a>
                </div></div></div></a></span>';  
                     $data[] = array(
                                 'id'           => $row->id,
                                 'title'        => $title);
                    }  
                }else{
                     $data = false;
                }
               return $data;
    }
    function Modal_Web_Category($id){
         $query = $this->db->select('*')->from('tbl_category')->WHERE('id',$id)->get(); 
        if(!$query){return false;}else{return $query->row();}
    }
    function Modal_Web_SubCategory_Data($id){
        $query = $this->db->select('s.*,c.*,s.id as id')->from('tbl_category_sub as s')
        ->join('tbl_category as c','s.cat_id=c.id','LEFT')
        ->WHERE('s.id',$id)->get(); 
        if(!$query){return false;}else{return $query->row();}
    }
    function Modal_Web_ProductDetails_Data($id){
        $query = $this->db->select('c.*,s.*,c.id as id')->from('tbl_project_design as c')
        ->join('tbl_category_sub as s','c.sub_id=s.id','LEFT')
        ->WHERE('c.id',$this->encryption->decrypt($id))->get(); 
        if(!$query){return false;}else{return $query->row();}
    }
    function Modal_Web_Design_View($id){
        $query1 = $this->db->select('c.*,d.*,d.cat_id as cat_id,d.sub_id as sub_id,c.project_no as project_no,c.status as status,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,DATE_FORMAT(c.date_approved, "%M %d %Y %r") as date_approved,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer') ->where('c.c_code', $id)->get();
        $row1 = $query1->row();
        $query = $this->db->select('*')->from('tbl_project_image')->where('c_code', $id)->get();
           if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row)  
            {
             $data[] = array('id' => $row->id,
                             'images'=> $row->images);
            }  
        }else{
             $data = false;
        }
        $json = array('data'=>$data,
                      'c_price' => number_format($row1->c_price,2),
                      'row' =>  $row1);
         return $json;
    }
     function Modal_Web_Design_Gallery($id){
        $query1 = $this->db->select('*')->from('tbl_project_color')->where('c_code', $id)->get();
        $row1 = $query1->row();
        $query = $this->db->select('*')->from('tbl_project_gallery')->where('c_code', $id)->get();
           if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row)  
            {
             $data[] = array('id' => $row->id,
                             'images'=> $row->g_images);
            }  
        }else{
             $data = false;
        }
        $json = array('data'=>$data,
                      'row' =>  $row1);
         return $json;
    }
     function Modal_Shipping_View($id){
        $query = $this->db->select('*')->from('tbl_region_shipping')->WHERE('id',$id)->get(); 
        if(!$query){return false;}else{return $query->row();}
    }
    function Modal_Web_Interior($id){
        $query = $this->db->select('*')->from('tbl_interior_design')->WHERE('id',$id)->get(); 
        if(!$query){return false;}else{return $query->row();}
    }
    function Modal_Web_Events($id){
        $query = $this->db->select('*,DATE_FORMAT(date_event, "%m/%d/%Y") as date_event')->from('tbl_events')->WHERE('id',$id)->get(); 
        if(!$query){return false;}else{return $query->row();}
    }
     function Modal_Web_Interior_Image($id){
        $query = $this->db->select('*')->from('tbl_interior_design')->WHERE('id',$id)->get(); 
        $row1 = $query->row();

        $query1 = $this->db->select('*')->from('tbl_interior_image')->where('in_id',$row1->id)->get();
         if($query1 !== FALSE && $query1->num_rows() > 0){
           foreach($query1->result() as $row)
            {   
                
                $data[] = array('id' => $row->id,'image'=> $row->images);
            }      
         }else{$data =false;}
          
          $json = array('data'     => $data,
                        'row'      => $row1);
         return $json;
    }

     function Modal_OnlineOrder($id){
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
                
                if($row->vat == 'VATABLE'){
                    $vat = $row->total*0.12;
                    $grandtotal = floatval($row->total - $row->downpayment + $row->shipping_fee + $vat);
                }else{
                   $vat = 0;
                   $grandtotal = floatval($row->total - $row->downpayment + $row->shipping_fee); 
                }
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
                         'shipping_fee' => $row->shipping_fee,
                         'title'        => $row->title,
                         'color'        => $row->color,
                         'qty'          => $row->qty,
                         'status'       => $row->status,
                         'c_price'      => $row->c_price,
                         'type'         => $row->type,
                         'price'        => number_format($row->price,2),
                         'total'        => number_format($row->total+$vat,2),
                         'discount'     => $row->discount,
                         'subtotal'     => number_format($row->subtotal,2),
                         'downpayment'  => number_format($row->downpayment,2),
                         'grandtotal'   => number_format($grandtotal,2),
                         'vat'          => number_format($vat,2),
                         'status'       => $row->status,
                         'date_order'   => $row->date_order);
               } 
               return $data;}
    }
    function Modal_Voucher_Customer($id){
          $query_c = $this->db->select('*')->from('tbl_code_promo')->where('promo_code',$id)->get();
          $row_c = $query_c->row();

          $query = $this->db->select('*')->from('tbl_customer_online')->get();
          if(!$query){return false;}else{  
               foreach($query->result() as $row)  
               { 
                 $query1 = $this->db->select('*')->from('tbl_customer_promo')->where('customer',$row->id)->where('promo_code',$id)->get();
                 $row1 = $query1->row();
                 if(!$row1){
                    $username = 'N/A';
                    $action = 'none';
                 }else{
                    $query_user = $this->db->select('*,CONCAT(firstname, " ",lastname) AS user')->from('tbl_users')->where('id',$row1->user_id)->get();
                    $row_user = $query_user->row();
                    $username = $row_user->user;
                    $action = 'ok';
                 }
                 $fullname = $row->firstname.' '.$row->lastname;
                 $data[] = array('id'       =>$row->id,
                                 'username' => $username,
                                 'fullname' => $fullname,
                                 'action'   => $action);
               }
               $json_data = array('data'=>$data,'voucher'=>$id,'discount'=>$row_c->discount);
               return $json_data;}
    }
    function Modal_Customer_Concern($id){
         $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created,')
         ->from('tbl_service_request')
         ->where('id',$id)->get();
         if(!$query){return false;}else{return $query->row();}
    }
     function Modal_Inquiry_View($id){
         $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')
         ->from('tbl_contact_us')
         ->where('id',$id)->get();
         if(!$query){return false;}else{return $query->row();}
    }
    function Modal_Customer_Collection($id){
         $query = $this->db->select('*,FORMAT(amount,"#,###,##0.###\,###") as amount,CONCAT(firstname, " ",lastname) AS customer,DATE_FORMAT(date_deposite, "%M %d %Y") as date_created')->from('tbl_customer_deposite')->where('id',$id)->get();
         if(!$query){return false;}else{return $query->row();}
    }
    function Modal_Customer_View($id){
         $query = $this->db->select('*')->from('tbl_customer_online')->where('id',$id)->get();
         if(!$query){return false;}else{return $query->row();}
    }
    function Modal_Testimony_View($id){
         $query = $this->db->select('*')->from('tbl_customer_testimony')->where('id',$this->encryption->decrypt($id))->get();
         if(!$query){return false;}else{return $query->row();}
    }
    function Modal_Joborder_Stocks_Supervisor($id){
    $query = $this->db->select('p.*,c.*,d.*,c.image as image,
        p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,
        CONCAT(u.firstname, " ",u.lastname) AS requestor')
    ->from('tbl_project as p')
     ->join('tbl_project_color as c','c.id=p.c_code','LEFT')
    ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
    ->join('tbl_users as u','u.id=p.production','LEFT')
    ->where('p.production_no', $id)->get();
        $row = $query->row();
        $m_query = $this->db->select('*,p.id as id,m.item as item,p.status as status')->from('tbl_material_project as p')
                ->join('tbl_materials as m','m.id=p.item_no')
                ->where('p.production_no',$id)->order_by('p.id','DESC')->get();
        if($m_query !== FALSE && $m_query->num_rows() > 0){
            foreach($m_query->result() as $m_row){
                $data_m[] = array('id'       => $m_row->id,
                                  'item_no'  => $m_row->item_no,
                                  'item'     => $m_row->item,
                                  'stocks'   => $m_row->production_stocks,
                                  'quantity' => $m_row->total_qty,
                                  'balance'  => $m_row->balance_quantity,
                                  'p_qty'    => $m_row->production_quantity,
                                  'status'   => $m_row->status);
            }
        }else{
            $data_m = false;
        }
        $p_query = $this->db->select('*,p.id as id,m.item as item,p.status as status')->from('tbl_purchasing_project as p')->join('tbl_materials as m','m.id=p.item_no')->where('p.production_no',$id)->where('p.status',1)->order_by('p.id','ASC')->get();
        if($p_query !== FALSE && $p_query->num_rows() > 0){
            foreach($p_query->result() as $p_row){
                if(!$p_row->unit){
                    $unit ="";
                }else{
                    $unit =$p_row->unit;
                }
                $data_p[] = array('id'       => $p_row->id,
                                  'item'     => $p_row->item,
                                  'unit'     => $unit,
                                  'quantity' => $p_row->quantity,
                                  'remarks'  => $p_row->remarks,
                                  'status'   => $p_row->status);
            }
        }else{$data_p = false;}


        $data_array = array('row' => $row,
                            'material' => $data_m,
                            'purchase' => $data_p);
        return $data_array;
    }
    function Modal_Joborder_Project_Supervisor($id){
    $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
    ->from('tbl_project as p')
    ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
    ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
    ->join('tbl_users as u','u.id=p.production','LEFT')
    ->where('p.production_no', $id)->get();
        $row = $query->row();
        $m_query = $this->db->select('*,p.id as id,m.item as item,p.status as status')->from('tbl_material_project as p')
                ->join('tbl_materials as m','m.id=p.item_no')
                ->where('p.production_no',$id)->order_by('p.id','DESC')->get();
        if($m_query !== FALSE && $m_query->num_rows() > 0){
            foreach($m_query->result() as $m_row){
                $data_m[] = array('id'       => $m_row->id,
                                  'item_no'  => $m_row->item_no,
                                  'item'     => $m_row->item,
                                  'stocks'   => $m_row->production_stocks,
                                  'quantity' => $m_row->total_qty,
                                  'balance'  => $m_row->balance_quantity,
                                  'p_qty'    => $m_row->production_quantity,
                                  'status'   => $m_row->status);
            }
        }else{
            $data_m = false;
        }
        $p_query = $this->db->select('*,p.id as id,m.item as item,p.status as status, IFNULL(m.unit," ") AS unit')->from('tbl_purchasing_project as p')->join('tbl_materials as m','m.id=p.item_no')->where('p.production_no',$id)->where('p.status',1)->order_by('p.id','ASC')->get();
        if($p_query !== FALSE && $p_query->num_rows() > 0){
            foreach($p_query->result() as $p_row){
                $data_p[] = array('id'       => $p_row->id,
                                  'item'     => $p_row->item,
                                  'unit'     => $p_row->unit,
                                  'quantity' => $p_row->quantity,
                                  'remarks'  => $p_row->remarks,
                                  'status'   => $p_row->status);
            }
        }else{$data_p = false;}


        $data_array = array('row' => $row,
                            'material' => $data_m,
                            'purchase' => $data_p);
        return $data_array;
    }
     function Modal_Material_Request_Supervisor($id){
        $m_query = $this->db->select('*,DATE_FORMAT(p.date_created, "%M %d %Y %r") as  date_created')
        ->from('tbl_material_release as p')->join('tbl_materials as m','m.id=p.item_no','LEFT')
        ->where('p.production_no',$id)->order_by('p.date_created','DESC')->get();
        if($m_query !== FALSE && $m_query->num_rows() > 0){
            $no = 1;
            foreach($m_query->result() as $m_row){
                $data_m[] = array('no'       => $no,
                                  'item'     => $m_row->item,
                                  'quantity' => $m_row->quantity,
                                  'date_release' => $m_row->date_created);
                $no++;
            }
        }else{
            $data_m = false;
        }
        $data_array = array('material' => $data_m);
        return $data_array;
    }
      function Modal_Purchased_Request_Supervisor($id){
        $p_query = $this->db->select('*,DATE_FORMAT(p.date_created, "%M %d %Y %r") as  date_created')->from('tbl_purchasing_project as p')->join('tbl_materials as m','m.id=p.item_no','LEFT')->where('p.production_no',$id)->where('p.status !=',2)->order_by('p.date_created','DESC')->get();
        if($p_query !== FALSE && $p_query->num_rows() > 0){
             $no = 1;
            foreach($p_query->result() as $p_row){
                $data_p[] = array('no'       => $no,
                                  'item'     => $p_row->item,
                                  'quantity' => $p_row->quantity,
                                  'date_created'   => $p_row->date_created);
                $no++;
            }
        }else{
            $data_m = false;
        }
        $data_array = array('purchased' => $data_p);
        return $data_array;
    }
    function Modal_Material_Used_Supervisor($id){
    $p_query = $this->db->select('*,DATE_FORMAT(p.latest_update, "%M %d %Y %r") as  date_created')->from('tbl_material_project as p')
    ->join('tbl_materials as m','m.id=p.item_no','LEFT')->where('p.production_no',$id)->where('p.production_quantity >', 0)->order_by('date_created','DESC')->get();
        if($p_query !== FALSE && $p_query->num_rows() > 0){
             $no = 1;
            foreach($p_query->result() as $p_row){
                $data_p[] = array('no'       => $no,
                                  'item'     => $p_row->item,
                                  'quantity' => $p_row->production_quantity,
                                  'date_created' => $p_row->date_created);
                $no++;
            }
        }else{
            $data_p = false;
        }
        $data_array = array('used' => $data_p);
        return $data_array;
    }
    function Modal_Material_Request_Stocks_View($id){
          $query = $this->db->select('mp.*,p.*,d.*,c.*,m.*,mp.status,mp.id,mp.remarks,m.unit,mp.quantity,DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_material_project as mp')->join('tbl_materials as m','mp.item_no=m.id','LEFT')->join('tbl_project as p','p.production_no=mp.production_no','LEFT')->join('tbl_project_color as c','p.c_code=c.id','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=p.production','LEFT')->where('p.production_no',$id)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                $data[] = array(
                         'id'           => $this->encryption->encrypt($row->id),
                         'production_no'=> $row->production_no,
                         'production'   => $row->production,
                         'unit'         => ($row->unit)?$row->unit:"",
                         'title'        => $row->title,
                         'c_name'       => $row->c_name,
                         'item'         => $row->item,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance_quantity,
                         'remarks'      => $row->remarks,
                         'requestor'    => $row->requestor,
                         'date_created' => $row->date_created);
               } 
               return $data;}
    }
    function Modal_Material_Request_Project_View($id){
          $query = $this->db->select('mp.*,p.*,d.*,c.*,m.*,mp.status,mp.id,mp.remarks,m.unit,mp.quantity,DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
           ->from('tbl_material_project as mp')->join('tbl_materials as m','mp.item_no=m.id','LEFT')
           ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
           ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
           ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
           ->join('tbl_users as u','u.id=p.production','LEFT')->where('p.production_no',$id)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                $data[] = array(
                         'id'           => $this->encryption->encrypt($row->id),
                         'production_no'=> $row->production_no,
                         'production'   => $row->production,
                         'unit'         => ($row->unit)?$row->unit:"",
                         'title'        => $row->title,
                         'item'         => $row->item,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance_quantity,
                         'remarks'      => $row->remarks,
                         'requestor'    => $row->requestor,
                         'date_created' => $row->date_created);
               } 
               return $data;}
    }
}
?>