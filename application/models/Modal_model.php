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
          $query =  $this->db->select('s.*,i.*,c.*,d.*,s.id,s.status,s.so_no,sc.*,s.tin as tin_no,CONCAT(u.firstname, " ",u.lastname) AS sales_person,DATE_FORMAT(s.date_order, "%M %d %Y") as date_order,(SELECT sum(amount) FROM tbl_salesorder_stocks_item WHERE so_no=s.id) as subtotal')->from('tbl_salesorder_stocks_item as i')->join('tbl_salesorder_stocks as s','i.so_no=s.id','LEFT')->join('tbl_project_color as c','c.id=i.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_salesorder_customer as sc','sc.id=s.customer','LEFT')->join('tbl_users as u','u.id=s.created_by','LEFT')->where('s.id',$id)->get();
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
                         'tin'          => $row->tin_no,
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
                         'date_downpayment'=> date('m/d/Y',strtotime($row->date_downpayment)),
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
      $row =  $this->db->select('s.*,s.tin as tin_no,sc.*,s.id,DATE_FORMAT(s.date_order, "%M %d %Y") as date_order')
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
                     'tin'          => $row->tin_no,
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
                     'date_downpayment'=> date('m/d/Y',strtotime($row->date_downpayment)),
                     'delivery'     => $row->delivery,
                     'status'       => $row->status
                 );
           return array_merge($data,$data_array);
    }
   
    function Modal_Supplier_View($id){
          $row = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as ss_date_created')->from('tbl_supplier')->where('id',$this->encryption->decrypt($id))->get()->row();
         return $row;
    }
    function Modal_Supplier_Item_Update_View($id){
         $row = $this->db->select('*')->from('tbl_supplier_item')->where('id',$this->encryption->decrypt($id))->get()->row();
         return $row;
    }
    function Modal_Supplier_Item_View($id){
          $data = false;
          $query = $this->db->select('*,mp.id,mp.amount')->from('tbl_supplier_item as mp')->join('tbl_materials as m','mp.item_no=m.id','LEFT')->where('mp.supplier',$id)->order_by('mp.id','ASC')->get();
               foreach($query->result() as $row){
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="edit-item-view" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#edit-item"><i class="flaticon2-pen"></i></button>';    
                  ($row->unit)?$unit = $row->unit.'(s)':$unit = "";
                $data[] = array('item'   => $row->item.' - '.$unit,
                                'amount' => number_format($row->amount,2),
                                'action' => $action);
           }
         $json_data  = array("data" =>$data); 
         return $json_data;  
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
         $row =  $this->db->select('d.*,c.*,p.production_no,
            CONCAT(u.firstname, " ",u.lastname) AS production,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created')
         ->from('tbl_project as p')->join('tbl_project_color as c','c.id=p.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->WHERE('p.production_no',$id)->get()->row(); 
        return $row;
     }
     function Modal_Purchase_Request_List_View($id){
         $data = false;
         $query =  $this->db->select('pr.id as id,IFNULL(m.unit," ") as unit,m.item ,pr.quantity,pr.balance,
            pr.status as status,pr.remarks as remarks')
         ->from('tbl_purchasing_project as pr')->join('tbl_materials as m','m.id=pr.item_no','LEFT')
         ->WHERE('pr.status=2 AND pr.production_no="'.$id.'" AND pr.fund_no IS NULL')->get(); 
            foreach($query->result() as $row){
                 if($row->remarks){$remarks = '(<a href="javascript:;" data-container="body"  data-theme="dark" data-toggle="tooltip" data-placement="top" title="'.$row->remarks.'">Remarks</a>)';}
                ($row->unit)?$unit = $row->unit.'(s)':$unit = "";
                $data[] = array('item'         => $row->item.' '.$unit,
                                'quantity'     => $row->quantity,
                                'balance'      => $row->balance,
                                'remarks'      => $remarks);
              
            }
        return array("data" =>$data);  
     }
     function Modal_Purchase_Request_Estimate_View($id){
        $data = false;
        $query =  $this->db->select('pr.id,m.unit,m.item ,pr.quantity,pr.balance,
            pr.status as status,pr.remarks as remarks')->from('tbl_purchasing_project as pr')->join('tbl_materials as m','m.id=pr.item_no','LEFT')->WHERE('pr.status=2 AND pr.production_no="'.$id.'" AND pr.fund_no IS NULL')->get(); 
        foreach($query->result() as $row){
            $action = '<input type="text" class="form-control form-control-sm text-center td-amount" data-id="'.$row->id.'" placeholder="Input Estimate Amount....."/>';
             ($row->unit)?$unit = $row->unit.'(s)':$unit = "";
            $data[] = array('item'         => $row->item.' '.$unit,
                            'quantity'     => $row->quantity,
                            'balance'      => $row->balance,
                            'input'        => $action);
          
        }
         return array("data" =>$data);   
     }

     function Modal_Purchase_Stocks_Inprogress_View($id){
        $row =  $this->db->select('d.*,c.*,p.production_no,pr.fund_no,pr.status,
            CONCAT(u.firstname, " ",u.lastname) AS production,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created')
         ->from('tbl_project as p')->join('tbl_project_color as c','c.id=p.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')
         ->join('tbl_users as u','u.id=p.assigned','LEFT')
         ->join('tbl_purchasing_project as pr','p.production_no=pr.production_no','LEFT')
         ->where('pr.fund_no',$id)->get()->row(); 
         return $row;
      }

      function Modal_Purchase_Inprogress_View($id){
        $data = false;
        $query =  $this->db->select('pr.*,pr.id ,m.unit,m.item,pr.quantity,pr.remarks,pr.amount')->from('tbl_purchasing_project as pr')->join('tbl_materials as m','m.id=pr.item_no','LEFT')->where('pr.fund_no',$id)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                if($row->remarks){$remarks = '(<a href="javascript:;" data-container="body"  data-theme="dark" data-toggle="tooltip" data-placement="top" title="'.$row->remarks.'">Remarks</a>)';}
                ($row->unit)?$unit = $row->unit.'(s)':$unit = "";
                $data[] = array('id'       => $row->id,
                                'item'    => $row->item.' '.$unit,
                                'quantity'=> $row->quantity,
                                'amount'  => number_format($row->amount,2),
                                'balance' => $row->balance,
                                'remarks' => $remarks);
               } 
           }
            return array("data" =>$data);   
      }

      function Modal_Purchase_Project_Request_View($id){
          $row =  $this->db->select('d.*,c.*,p.production_no,
            CONCAT(u.firstname, " ",u.lastname) AS production,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created')
         ->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->WHERE('p.production_no',$id)->get()->row(); 
        return $row;
    }
     function Modal_Purchase_Project_Inprogress_View($id){
        $row =  $this->db->select('d.*,c.*,p.production_no,pr.fund_no,pr.status,
            CONCAT(u.firstname, " ",u.lastname) AS production,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created')
         ->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')
         ->join('tbl_users as u','u.id=p.assigned','LEFT')
         ->join('tbl_purchasing_project as pr','p.production_no=pr.production_no','LEFT')
         ->where('pr.fund_no',$id)->get()->row(); 
         return $row;
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
         $query = $this->db->select('pp.unit as units,pp.id as id,pp.amount as amount,p.production_no as production_no,p.title as title,p.unit as unit,pp.item as item,pp.quantity as quantity,pp.balance as balance,pp.status as status,pp.delivery as delivery,pp.type as type,pp.remarks as remarks, CONCAT(u.firstname, " ",u.lastname) AS approver1, CONCAT(uu.firstname, " ",uu.lastname) AS approver2,CONCAT(uuu.firstname, " ",uuu.lastname) AS receiver,CONCAT(uuuu.firstname, " ",uuuu.lastname) AS production,DATE_FORMAT(pp.date_pending, "%M %d %Y %r") as date_pending,DATE_FORMAT(pp.date_created, "%M %d %Y %r") as date_created,DATE_FORMAT(pp.date_complete, "%M %d %Y %r") as date_complete,DATE_FORMAT(pp.date_rejected, "%M %d %Y %r") as date_rejected,DATE_FORMAT(pp.date_inprogress, "%M %d %Y %r") as date_inprogress,DATE_FORMAT(pp.date_approved1, "%M %d %Y %r") as date_approved1,(SELECT sum(amount ) FROM tbl_purchasing_project WHERE production_no = "'.$id.'" AND status = "'.$status.'") as total')->from('tbl_purchasing_project as pp')->join('tbl_project as p','p.production_no=pp.production_no','LEFT')->join('tbl_users as u','u.id=pp.approver1','LEFT')->join('tbl_users as uu','uu.id=pp.approver2','LEFT')->join('tbl_users as uuu','uuu.id=pp.receiver','LEFT')->join('tbl_users as uuuu','uuuu.id=p.production','LEFT')->WHERE('pp.production_no',$id)->WHERE('pp.status',$status)->get(); 
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
        $data = array();
         $rows = $this->db->select('u.*,s.*,r.*,s.id, 
            DATE_FORMAT(s.date_created, "%M %d %Y") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS name, 
            CONCAT(s.b_address, " ",s.b_city, " ",s.b_province) AS billing_address,
            CONCAT(s.s_address, " ",s.s_city, " ",s.s_province) AS shipping_address')
         ->from('tbl_cart_address as s')
         ->join('tbl_customer_online as u','u.id=s.customer','LEFT')
         ->join('tbl_region_shipping as r','r.id=s.region','LEFT')->where('s.id',$this->encryption->decrypt($id))->get()->row();

         $query =  $this->db->select('*,i.id,i.type,i.price,i.status,i.id,i.c_code,i.qty')
          ->from('tbl_cart_add as i')
          ->join('tbl_project_color as c','c.id=i.c_code','LEFT')
          ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
          ->where('i.order_no',$rows->order_no)->get();
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
           return array('row'=>$rows,'data'=>$data);
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
         $query = $this->db->select('*,DATE_FORMAT(date_request, "%M %d %Y") as date_created')->from('tbl_service_request')->where('id',$this->encryption->decrypt($id))->get()->row();
            return $query;
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
    $query = $this->db->select('p.*,c.*,d.*,c.image,p.status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project as p')->join('tbl_project_color as c','c.id=p.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=p.production','LEFT')->where('p.production_no', $id)->get()->row();
        return $query;
    }
    function Modal_Joborder_Project_Supervisor($id){
    $query = $this->db->select('p.*,c.*,d.*,c.image,p.status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=p.production','LEFT')->where('p.production_no', $id)->get()->row();
        return $query;
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
        $p_query = $this->db->select('*,DATE_FORMAT(p.date_created, "%M %d %Y %r") as  date_created')->from('tbl_purchasing_project as p')->join('tbl_materials as m','m.id=p.item_no','LEFT')->where('p.production_no',$id)->where('p.status !=',1)->order_by('p.date_created','DESC')->get();
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
       $rows = $this->db->select('*,c.image,d.title,c.c_name,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
           ->from('tbl_project as p')->join('tbl_project_color as c','c.id=p.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=p.production','LEFT')->where('p.production_no',$id)->get()->row();
        $count = $this->db->select('*')->from('tbl_material_project ')->where('production_no',$id)->where('status',4)->get()->num_rows();
        return array('row'=>$rows,'count'=>$count);
    }
    function Modal_Material_Request_Project_View($id){
       $rows = $this->db->select('*,c.image,d.title,c.c_name,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
           ->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=p.production','LEFT')->where('p.production_no',$id)->get()->row();
        $count = $this->db->select('*')->from('tbl_material_project ')->where('production_no',$id)->where('status',4)->get()->num_rows();
        return array('row'=>$rows,'count'=>$count);
    }
    function Modal_Material_Request_List_View($id){
          $data = false;
          $query = $this->db->select('*,mp.status,mp.id,mp.remarks,m.unit,mp.quantity,mp.remarks')
           ->from('tbl_material_project as mp')->join('tbl_materials as m','mp.item_no=m.id','LEFT')->where('mp.production_no',$id)->where('mp.status!=1')->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                 $remarks = "";
                 if($row->remarks){$remarks = '(<a href="javascript:;" data-container="body"  data-theme="dark" data-toggle="tooltip" data-placement="top" title="'.$row->remarks.'">Remarks</a>)';}
                ($row->unit)?$unit = $row->unit.'(s)':$unit = "";

                $data[] = array(
                         'item'         => $row->item.' - '.$unit,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance_quantity,
                         'remarks'      => $remarks);
               } 
           }
           return array('data'=>$data);
    }
    function Modal_Material_Request_Accept_View($id){
          $data = false;
          $query = $this->db->select('*,mp.status,mp.id,mp.remarks,m.unit,mp.quantity,mp.remarks')
           ->from('tbl_material_project as mp')->join('tbl_materials as m','mp.item_no=m.id','LEFT')->where('mp.production_no',$id)->where('mp.status',2)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                ($row->unit)?$unit = $row->unit.'(s)':$unit = "";
                $remove = '<button type="button" class="btn btn btn-light-danger font-weight-bold btn-icon btn-shadow btn-xs btn-status" data-container="body" data-theme="dark" data-toggle="tooltip" data-placement="top" data-id="'.$this->encryption->encrypt($row->id).'"  title="Cancel Item"><i class="flaticon2-trash"></i></button>';
                $action = '<button type="button" class="btn btn btn-light-dark font-weight-bold btn-icon btn-shadow btn-xs btn-save" data-id="'.$this->encryption->encrypt($row->id).'" data-container="body" data-theme="dark" data-toggle="tooltip" data-placement="top" title="Submit Request"><i class="flaticon2-fast-next blink_me"></i></button>';

                $input = '<input type="number" min="0" class="form-control form-control-solid form-control-sm text-center" placeholder="0"/>';

                $data[] = array(
                         'remove'       => $remove,
                         'item'         => $row->item.' - '.$unit,
                         'balance'      => $row->balance_quantity,
                         'stocks'       => $row->stocks,
                         'input'        => $input,
                         'action'       => $action);
               } 
           }
           return array('data'=>$data);
    }
    function Modal_Material_Request_Cancel_View($id){
          $data = false;
          $query = $this->db->select('*,mp.status,mp.id,mp.remarks,m.unit,mp.quantity,DATE_FORMAT(mp.date_cancelled, "%M %d %Y %r") as date_created')
           ->from('tbl_material_project as mp')->join('tbl_materials as m','mp.item_no=m.id','LEFT')->where('mp.production_no',$id)->where('mp.status',4)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-status-request" data-id="'.$this->encryption->encrypt($row->id).'" >Return to request</button>';    
                  ($row->unit)?$unit = $row->unit.'(s)':$unit = "";
                $data[] = array(
                         'id'           => $this->encryption->encrypt($row->id),
                         'item'         => $row->item.' - '.$unit,
                         'quantity'     => $row->quantity,
                         'balance'      => $row->balance_quantity,
                         'date_created' => $row->date_created,
                         'action'       => $action);
               } 
           }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Modal_Request_Material($id){
        $row = $this->db->select('*')->from('tbl_other_material_m_request')->where('id',$this->encryption->decrypt($id))->get()->row();
        return array('row'=>$row,'id'=>$this->encryption->encrypt($row->id));
    }
    function Modal_Customized_View($id){
        $row = $this->db->select('*')->from('tbl_customized_request')->where('id',$this->encryption->decrypt($id))->get()->row();
        return array('row'=>$row,'id'=>$this->encryption->encrypt($row->id));
    }
    function Modal_Inquiry_View($id){
         $row = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_customer_inquiry')->where('id',$this->encryption->decrypt($id))->get()->row();
          return array('row'=>$row,'id'=>$this->encryption->encrypt($row->id));
    }
}
?>