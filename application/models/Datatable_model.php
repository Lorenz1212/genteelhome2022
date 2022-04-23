<?php
class Datatable_model extends CI_Model{  
    //Fetch Data
    
       function supplier_DataTable(){
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_supplier')->order_by('date_created','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
            $action = '<a href="'.base_url().'gh/'.$this->session->userdata('page').'/supplier_view/'.$this->encryption->encrypt($row->id).'" class="btn btn-sm btn-light-dark btn-icon"><i class="flaticon2-pen"></i></a>';
            if($row->status == 1){$status ='<span class="label label-lg label-light-primary label-inline">ACTIVE</span>';}else{$status='<span class="label label-lg label-light-danger label-inline">INACTIVE</span>';}
                   $data[] = array(
                            'name'         => $row->name,
                            'address'      => $row->address,
                            'mobile'       => $row->mobile,
                            'status'       => $status,
                            'date_created' => $row->date_created,
                            'action'       => $action);
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
     }

     function SupplierItem_DataTable($id){
        $query =   $this->db->select('s.id,s.amount,s.status,m.item,DATE_FORMAT(s.date_created, "%M %d %Y") as date_created')->from('tbl_supplier_item as s')->join('tbl_materials as m','m.id = s.item_no','LEFT')->where('s.supplier',$this->encryption->decrypt($id))->order_by('s.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" id="form-request" data-toggle="modal" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form-item"><i class="flaticon2-pen"></i></button>';
              if($row->status == 1){$status ='<span class="label label-lg label-light-primary label-inline">ACTIVE</span>';}else{$status='<span class="label label-lg label-light-danger label-inline">INACTIVE</span>';}
                $data[] = array(
                         'item'         => $row->item,
                         'price'        => $row->amount,
                         'status'       => $status,
                         'date_created' => $row->date_created,
                         'action'       => $action);
            }      
         }else{   
             $data =false;   
         }
         $json_data = array("data" =>$data); 
         return $data;
    }

    function Design_Stocks_Request_DataTable($user_id){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status=1 AND c.type=1 AND c.designer ='.$user_id.'')->order_by('c.date_approved','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';    
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><span class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</span></div></div></span>';
             $data[] = array(
                      'project_no'   => $row->project_no,
                      'image'        => $image,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Design_Stocks_Approved_DataTable($user_id){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status = 2 AND c.type =1 AND c.designer ='.$user_id.'')->order_by('c.date_created','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';    
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.' ('.$row->c_name.')"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="'.$row->c_name.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><span class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</span></div></div></span>';
             $data[] = array(
                      'project_no'   => $row->project_no,
                      'image'        => $image,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Design_Stocks_Rejected_DataTable($user_id){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status =3 AND c.type=1 AND c.designer ='.$user_id.'')->order_by('c.date_approved','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';    
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.' ('.$row->c_name.')"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="'.$row->c_name.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><span class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</span></div></div></span>';
             $data[] = array(
                      'project_no'   => $row->project_no,
                      'image'        => $image,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Design_Project_Request_DataTable($user_id){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status=1 AND c.type=2 AND c.designer ='.$user_id.'')->order_by('c.date_approved','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';    
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array(
                          'project_no'   => $row->project_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'action'       => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Design_Project_Approved_DataTable($user_id){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status =2 AND c.type=2 AND c.designer ='.$user_id.'')->order_by('c.date_created','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
              $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';    
             $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
             $data[] = array(
                      'project_no'   => $row->project_no,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Design_Project_Rejected_DataTable($user_id){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status=3 AND c.type=2 AND c.designer ='.$user_id.'')->order_by('c.date_approved','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
              $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';    
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array(
                          'project_no'   => $row->project_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'action'       => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }


   

        function RawMaterial_DataTable(){
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_materials')->order_by('id','DESC')->get();  
            if($query !== FALSE && $query->num_rows() > 0){
               foreach($query->result() as $row){
                $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-id="'.$row->id.'" id="form-request" data-toggle="modal" data-target="#exampleModal"><i class="la la-eye"></i></button>'; 
                    $data[] = array(
                             'no'           => $row->item_no,
                             'item'         => $row->item.' ('.$row->unit.')',
                             'price'        => number_format($row->price,2),
                             'date_created' => $row->date_created,
                             'action'       => $action);
                }      
             }else{   
                 $data =false;   
             }
             $json_data  = array("data" =>$data); 
             return $json_data;       
        }
       function SpareParts_DataTable(){
          $query =  $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_other_materials')->where('type',1)->order_by('id','DESC')->get();
          $data=array();
          if($query !== FALSE && $query->num_rows() > 0){
            $i=1;
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-id="'.$row->id.'" id="form-request" data-toggle="modal" data-target="#exampleModal"><i class="la la-eye"></i></button>'; 
                $data[] = array(
                         'no'           => $i,
                         'item'         => $row->item,
                         'date_created' => $row->date_created,
                         'action'       => $action);
                $i++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
       }
        function OfficeSupplies_DataTable(){
            $query =  $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_other_materials')->where('type',2)->order_by('id','DESC')->get();
          $data=array();
          if($query !== FALSE && $query->num_rows() > 0){
            $i=1;
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-id="'.$row->id.'" id="form-request" data-toggle="modal" data-target="#exampleModal"><i class="la la-eye"></i></button>'; 
                $data[] = array(
                         'no'           => $i,
                         'item'         => $row->item,
                         'date_created' => $row->date_created,
                         'action'       => $action);
                $i++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
       }
    function RawMaterial_Stocks_DataTable(){
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_materials')->order_by('item','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
            $unit =$row->unit.'(s)';
            if(!$row->unit){ $unit ="";}
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="la la-eye"></i></button>';
               $data[] = array(
                      'no'           => $row->item_no,
                      'item'         => $row->item.' - '.$unit,
                      'stocks'       => $row->stocks,
                      'stocks_alert' => $row->stocks_alert,
                      'action'       => $action,
                  );
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;     
     }
     function RawMaterial_OutStocks_DataTable(){
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_materials')->order_by('item','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
             $unit =$row->unit.'(s)';
            if(!$row->unit){ $unit ="";}
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="la la-eye"></i></button>';
                 if($row->stocks <= $row->stocks_alert && $row->stocks_alert <= $row->stocks){
                       $data[] = array(
                          'no'           => $row->item_no,
                          'item'         => $row->item.' - '.$unit,
                          'stocks'       => $row->stocks,
                          'stocks_alert' => $row->stocks_alert,
                          'action'       => $action );
                  }else{$data=false;}
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;     
     }
      function RawMaterial_New_DataTable(){
         $query = $this->db->select('*,m.item as item,
            DATE_FORMAT(n.date_created, "%M %d %Y %r") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS receiver')
         ->from('tbl_material_new as n')
         ->join('tbl_materials as m','m.id=n.item_no','LEFT')
         ->join('tbl_users as u','u.id=n.created_by','LEFT')
         ->order_by('n.date_created','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
             $unit =$row->unit.'(s)';
            if(!$row->unit){ $unit ="";}
               $data[] = array(
                      'receiver'     => $row->receiver,
                      'no'           => $row->item_no,
                      'item'         => $row->item.' - '.$unit,
                      'stocks'       => $row->stocks,
                      'date_created' => $row->date_created);
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;     
     }
     function RawMat_Production_Stocks_DataTable(){
         $query = $this->db->select('*')->from('tbl_materials')->order_by('id','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
             $unit =$row->unit.'(s)';
            if(!$row->unit){ $unit ="";}
             $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#exampleModal"><i class="la la-eye"></i></button>';
               $data[] = array(
                      'no'           => $row->item_no,
                      'item'         => $row->item.' - '.$unit,
                      'stocks'       => $row->production_stocks,
                      'action'       => $action);
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;     
     }
     function Production_Stocks_DataTable(){
         $query = $this->db->select('*')->from('tbl_materials')->order_by('item_no','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
             $unit =$row->unit.'(s)';
            if(!$row->unit){ $unit ="";}
            $data[] = array(
                      'no'           => $row->item_no,
                      'item'         => $row->item.' - '.$unit,
                      'stocks'       => $row->production_stocks);
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;     
     }
     function SpareParts_Stocks_DataTable(){
        $query = $this->db->select('*')->from('tbl_other_materials')->where('type',1)->order_by('id','DESC')->get();
        $data=array();
        if($query !== FALSE && $query->num_rows() > 0){
            $i=1;
           foreach($query->result() as $row){
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>';
               $data[] = array(
                      'no'           => $i,
                      'item'         => $row->item,
                      'stocks'       => $row->stocks,
                      'stocks_alert' => $row->alert,
                      'action'       => $action,
                  );
                $i++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  

     }
    function SpareParts_Outofstocks_DataTable(){
        $query = $this->db->select('*')->from('tbl_other_materials')->where('type',1)->order_by('id','DESC')->get();
        $data=array();
       if($query !== FALSE && $query->num_rows() > 0){
            $i=1;
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>';
                 if($row->stocks <= $row->alert && $row->alert <= $row->stocks){
                       $data[] = array(
                          'no'           => $i,
                          'item'         => $row->item,
                          'stocks'       => $row->stocks,
                          'stocks_alert' => $row->alert,
                          'action'       => $action );
                       $i++;
                  }
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;

     }
      function SpareParts_newstocks_DataTable(){
         $query = $this->db->select('*,DATE_FORMAT(n.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS receiver')->from('tbl_other_material_p_received as n')->join('tbl_materials as m','m.id=n.item_no','LEFT')->join('tbl_users as u','u.id=n.created_by','LEFT')->where('n.type',1)
         ->order_by('n.date_created','DESC')->get();
          $data=array();
        if($query !== FALSE && $query->num_rows() > 0){
            $i=1;
           foreach($query->result() as $row){
                $data[] = array(
                      'no'           => $i,
                      'receiver'     => $row->receiver,
                      'item'         => $row->item,
                      'stocks'       => $row->quantity,
                      'date_created' => $row->date_created);
                $i++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
   
     function OfficeSupplies_Stocks_DataTable(){
        $query = $this->db->select('*')->from('tbl_other_materials')->where('type',2)->order_by('id','DESC')->get();
        $data=array();
       if($query !== FALSE && $query->num_rows() > 0){
            $i=1;
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>';
                   $data[] = array(
                      'no'           => $i,
                      'item'         => $row->item,
                      'stocks'       => $row->stocks,
                      'stocks_alert' => $row->alert,
                      'action'       => $action );
                   $i++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
    function OfficeSupplies_Outofstocks_DataTable(){
        $query = $this->db->select('*')->from('tbl_other_materials')->where('type',2)->order_by('id','DESC')->get();
        $data=array();
       if($query !== FALSE && $query->num_rows() > 0){
            $i=1;
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>';
                 if($row->stocks <= $row->alert && $row->alert <= $row->stocks){
                       $data[] = array(
                          'no'           => $i,
                          'item'         => $row->item,
                          'stocks'       => $row->stocks,
                          'stocks_alert' => $row->alert,
                          'action'       => $action );
                       $i++;
                  }
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Purchase_Material_Stocks_Request_DataTable($user_id){
           $query = $this->db->select('d.*,c.*,p.*,
            CONCAT(u.firstname, " ",u.lastname) AS requestor,
             DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,
            (SELECT count(id) FROM tbl_purchasing_project WHERE status=2 AND production_no=p.production_no GROUP BY production_no) as status,
            c.image as image,c.c_image as c_image,d.title as title,c.c_name,p.production_no as production_no')
            ->from('tbl_project as p')
            ->join('tbl_project_color as c','c.id=p.c_code','LEFT')
            ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
            ->join('tbl_purchasing_project as pr','pr.production_no=p.production_no','LEFT')
            ->join('tbl_users as u','u.id=p.assigned','LEFT')
            ->where('pr.status',2)
            ->where('p.type',1)
            ->group_by('pr.production_no')
            ->order_by('p.date_created','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  {
                if($row->status == 0){
                    $data =false;   
                }else{
                   $action = '<button data-toggle="modal" data-target="#requestModal" id="form-request" data-id="'.$row->production_no.'" class="btn btn-sm btn-light-dark btn-shadow btn-icon" title="View Request"><i class="la la-eye"></i></button>';  
                   $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
                   $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                         $data[] = array(
                              'production_no'=> $row->production_no,
                              'image'        => $image,
                              'title'        => $title,
                              'requestor'    => $row->requestor, 
                              'date_created' => $row->date_created,
                              'status'       => $row->status,
                              'action'       => $action);
                }
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
     function Purchase_Material_Stocks_Inprogress_DataTable($user_id){
            $array = 'pr.type=1 AND pr.status=3 OR pr.status=4 AND pr.type=1';
            $query = $this->db->select('pr.*,p.*,d.*,c.*,pr.status as status,DATE_FORMAT(pr.latest_update, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
            ->from('tbl_purchasing_project as pr')->join('tbl_project as p','p.production_no=pr.production_no','LEFT')->join('tbl_project_color as c','c.id=p.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=p.production','LEFT')->where($array)->group_by('pr.fund_no')->order_by('pr.latest_update','DESC')->get(); 
          if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
               $action = '<button data-toggle="modal" data-target="#processModal" id="form-request-inprogress" data-id="'.$row->fund_no.'" class="btn btn-sm btn-light-dark btn-shadow btn-icon" title="View Request"><i class="la la-eye"></i></button>';  
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                if($row->status==3){$status ='<span class="label label-lg label-light-warning label-inline">Request</span>';
                }else if($row->status == 4){$status ='<span class="label label-lg label-light-primary label-inline">Approved </span>';}
              $data[] = array(
                          'production_no'=> $row->production_no,
                          'image'        => $image,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'status'       => $status,
                          'action'       => $action);

            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
     function Purchase_Material_Stocks_Complete_DataTable($user_id){
            $query =  $this->db->select('mp.*,p.*,d.*,c.*,
                m.item as item,s.name as name,mp.amount as amount,
                DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,
                CONCAT(u.firstname, " ",u.lastname) AS requestor')
            ->from('tbl_purchase_received as mp')
            ->join('tbl_materials as m','m.id=mp.item_no','LEFT')
            ->join('tbl_supplier as s','s.id=mp.supplier','LEFT')
            ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
            ->join('tbl_project_design as d','d.project_no=p.project_no','LEFT')
            ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
            ->join('tbl_users as u','u.id=p.production','LEFT')
            ->where('mp.type=1')
            ->where('mp.created_by',$user_id)
            ->order_by('mp.date_created','DESC')->get(); 
          if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row)  { 
                if($row->terms==1){$terms ='<span class="label label-lg label-light-primary label-inline">CASH</span>';
                }else if($row->terms == 2){$terms ='<span class="label label-lg label-light-primary label-inline">TERMS </span>';}

                     $data[] = array(
                          'production_no' => $row->production_no,
                          'item'          => $row->item,
                          'quantity'      => $row->quantity,
                          'amount'        => number_format($row->amount,2),
                          'supplier'      => $row->name,
                          'terms'         => $terms,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created);
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }

     function Purchase_Material_Project_Request_DataTable($user_id){
           $query = $this->db->select('d.*,c.*,p.*,
            CONCAT(u.firstname, " ",u.lastname) AS requestor,
             DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,
            (SELECT count(id) FROM tbl_purchasing_project WHERE status=2 AND type=2 AND production_no=p.production_no GROUP BY production_no) as status,c.image,d.title,p.production_no as production_no')
            ->from('tbl_project as p')
            ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
            ->join('tbl_project_color as c','d.id=c.project_no','LEFT')
            ->join('tbl_purchasing_project as pr','pr.production_no=p.production_no','LEFT')
            ->join('tbl_users as u','u.id=p.assigned','LEFT')
            ->where('pr.status',2)
            ->where('p.type',2)
            ->group_by('pr.production_no')
            ->order_by('p.date_created','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  {
                if($row->status == 0){
                    $data =false;   
                }else{
                   $action = '<button data-toggle="modal" data-target="#requestModal" id="form-request" data-id="'.$row->production_no.'" class="btn btn-sm btn-light-dark btn-shadow btn-icon" title="View Request"><i class="la la-eye"></i></button>';  
                   $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                         $data[] = array(
                              'production_no'=> $row->production_no,
                              'title'        => $title,
                              'requestor'    => $row->requestor, 
                              'date_created' => $row->date_created,
                              'status'       => $row->status,
                              'action'       => $action);
                }
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
    function Purchase_Material_Project_Inprogress_DataTable($user_id){
            $array = 'pr.type=2 AND pr.status=3 OR pr.status=4 AND pr.type=2';
            $query = $this->db->select('pr.*,p.*,d.*,c.*,c.image as image,d.title as title,pr.status as status,DATE_FORMAT(pr.latest_update, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
            ->from('tbl_purchasing_project as pr')
            ->join('tbl_project as p','p.production_no=pr.production_no','LEFT')
            ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
            ->join('tbl_project_color as c','d.id=c.project_no','LEFT')
            ->join('tbl_users as u','u.id=p.production','LEFT')
            ->where($array)->group_by('pr.fund_no')->order_by('pr.latest_update','DESC')
            ->get(); 
          if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
               $action = '<button data-toggle="modal" data-target="#processModal" id="form-request-inprogress" data-id="'.$row->fund_no.'" class="btn btn-sm btn-light-dark btn-shadow btn-icon" title="View Request"><i class="la la-eye"></i></button>';  
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                if($row->status==3){$status ='<span class="label label-lg label-light-warning label-inline">Request</span>';
                }else if($row->status == 4){$status ='<span class="label label-lg label-light-primary label-inline">Approved </span>';}
              $data[] = array(
                          'production_no'=> $row->production_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'status'       => $status,
                          'action'       => $action);

            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
    function Purchase_Material_Project_Complete_DataTable($user_id){
            $query =  $this->db->select('mp.*,p.*,d.*,c.*,
                m.item as item,s.name as name,mp.amount as amount,
                DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,
                CONCAT(u.firstname, " ",u.lastname) AS requestor')
            ->from('tbl_purchase_received as mp')
            ->join('tbl_materials as m','m.id=mp.item_no','LEFT')
            ->join('tbl_supplier as s','s.id=mp.supplier','LEFT')
            ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
            ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
            ->join('tbl_project_color as c','d.id=c.project_no','LEFT')
            ->join('tbl_users as u','u.id=p.production','LEFT')
            ->where('mp.type=2')
            ->where('mp.created_by',$user_id)
            ->order_by('mp.date_created','DESC')->get(); 
          if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row)  { 
                if($row->terms==1){$terms ='<span class="label label-lg label-light-primary label-inline">CASH</span>';
                }else if($row->terms == 2){$terms ='<span class="label label-lg label-light-primary label-inline">TERMS </span>';}
                     $data[] = array(
                          'production_no' => $row->production_no,
                          'item'          => $row->item,
                          'quantity'      => $row->quantity,
                          'amount'        => number_format($row->amount,2),
                          'supplier'      => $row->name,
                          'terms'         => $terms,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created);
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
    
      function Material_Request_Stocks_DataTable($user_id){       
            $query =  $this->db->select('mp.*,p.*,d.*,c.*,m.*,mp.status as status,
                DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,
                CONCAT(u.firstname, " ",u.lastname) AS requestor')
               ->from('tbl_material_project as mp')
               ->join('tbl_materials as m','mp.item_no=m.id','LEFT')
               ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
               ->join('tbl_project_color as c','p.c_code=c.id','LEFT')
               ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
               ->join('tbl_users as u','u.id=p.production','LEFT')
               ->where('mp.balance_quantity >', 0)->where('p.type',1)->group_by('mp.production_no')->order_by('mp.latest_update','DESC')->get(); 
         if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row)  
            {
               $action = ' <button data-toggle="modal" data-target="#modal-form" id="form-request-inprogress" data-id="'.$row->production_no.'" class="btn btn-icon btn-light-dark btn-hover-primark btn-sm mx-3" title="View Request"><i class="la la-eye"></i></button>';  
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                     $data[] = array(
                          'production_no' => $row->production_no,
                          'image'         => $image,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created,
                          'status'        => $row->status,
                          'action'        => $action);

            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     } 
    function Material_Complete_Stocks_DataTable($user_id){
         $query =  $this->db->select('*,
              mp.quantity as quantity,m.item,m.unit,
            DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS requestor')
        ->from('tbl_material_release as mp')
        ->join('tbl_materials as m','mp.item_no=m.id','LEFT')
        ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
        ->join('tbl_users as u','u.id=p.production','LEFT')->where('mp.type',1)
        ->order_by('mp.date_created','DESC')->get(); 
          if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
                    $unit = ($row->unit)?$row->unit:"";
                     $data[] = array( 'production_no' => $row->production_no,
                                      'item'          => $row->item,
                                      'quantity'      => $row->quantity .' ('.$unit.')',
                                      'requestor'     => $row->requestor,
                                      'date_created'  => $row->date_created);
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
    function Material_Request_Project_DataTable($user_id){       
            $query =  $this->db->select('mp.*,p.*,d.*,c.*,m.*,mp.status as status,
                DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,c.image,
                CONCAT(u.firstname, " ",u.lastname) AS requestor')
               ->from('tbl_material_project as mp')
               ->join('tbl_materials as m','mp.item_no=m.id','LEFT')
               ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
               ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
               ->join('tbl_project_color as c','d.id=c.project_no','LEFT')
               ->join('tbl_users as u','u.id=p.production','LEFT')
               ->where('mp.balance_quantity >', 0)->where('p.type',2)->group_by('mp.production_no')->order_by('mp.latest_update','DESC')->get(); 
         if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row)  {
               $action = ' <button data-toggle="modal" data-target="#modal-form" id="form-request-inprogress" data-id="'.$row->production_no.'" class="btn btn-icon btn-light-dark btn-hover-primark btn-sm mx-3" title="View Request"><i class="la la-eye"></i></button>';  
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                     $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created,
                          'status'        => $row->status,
                          'action'        => $action);

            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     } 
    function Material_Complete_Project_DataTable($user_id){
        $query =  $this->db->select('*,
            mp.quantity,m.item,m.unit,
            DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS requestor')
        ->from('tbl_material_release as mp')
        ->join('tbl_materials as m','mp.item_no=m.id','LEFT')
        ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
        ->join('tbl_users as u','u.id=p.production','LEFT')->where('mp.type',2)
        ->order_by('mp.date_created','DESC')->get(); 
          if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
                     $unit = ($row->unit)?$row->unit:"";
                     $data[] = array( 'production_no' => $row->production_no,
                                      'item'          => $row->item,
                                      'quantity'      => $row->quantity .' ('.$unit.')',
                                      'requestor'     => $row->requestor,
                                      'date_created'  => $row->date_created);
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
    function Joborder_Stocks_Request_DataTable($user_id){        
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project as p')->join('tbl_project_color as c','p.c_code=c.id','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.type',1)->where('p.status',2)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
                $action = '<a  href="'.base_url().'gh/'.$this->session->userdata('page').'/joborder-update-stocks?URI='.base64_encode($row->production_no).'" class="btn btn-sm btn-dark btn-icon"><i class="flaticon2-pen"></i></a>'; 
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'image'         => $image,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
     function Joborder_Stocks_Pending_DataTable($user_id){        
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
          ->from('tbl_project as p')
          ->join('tbl_project_color as c','p.c_code=c.id','LEFT')
          ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
          ->join('tbl_users as u','u.id=p.assigned','LEFT')
          ->where('p.type',1)->where('p.status',1)->where('p.assigned',$user_id)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
             $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->production_no.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>'; 
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'image'         => $image,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
        } 
        function Joborder_Stocks_Complete_DataTable($user_id){  
         $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_finished as p')
          ->join('tbl_project_color as c','p.c_code=c.id','LEFT')
          ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
          ->join('tbl_users as u','u.id=p.assigned','LEFT')
          ->where('p.type',1)->where('p.status',1)
          ->where('p.assigned',$user_id)
          ->order_by('p.date_created','DESC')->get();      
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'image'         => $image,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
        } 
         function Joborder_Stocks_Cancelled_DataTable($user_id){        
         $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_finished as p')
          ->join('tbl_project_color as c','p.c_code=c.id','LEFT')
          ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
          ->join('tbl_users as u','u.id=p.assigned','LEFT')
          ->where('p.type',1)->where('p.status',2)
          ->where('p.assigned',$user_id)
          ->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'image'         => $image,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
        } 
        function Joborder_Stocks_Production_DataTable($user_id){        
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.type',1)->where('p.status',2)->where('p.assigned',$user_id)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->production_no.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>'; 
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'image'         => $image,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
        function Joborder_Project_Request_DataTable($user_id){        
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.type',2)->where('p.status',2)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
                 $action = '<a  href="'.base_url().'gh/'.$this->session->userdata('page').'/joborder-update-project?URI='.base64_encode($row->production_no).'" class="btn btn-sm btn-light-dark btn-icon"><i class="flaticon2-pen"></i></a>'; 
                 $title = '<span style="width: 250px;"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"/></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
     function Joborder_Project_Pending_DataTable($user_id){        
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
          ->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.type',2)->where('p.status',1)->where('p.production',$user_id)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->production_no.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>'; 
                 $title = '<span style="width: 250px;"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array('production_no' => $row->production_no,
                                'title'         => $title,
                                'requestor'     => $row->requestor,
                                'qty'           => $row->unit,
                                'date_created'  => $row->date_created,
                                'status'        => $row->status,
                                'action'        => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
      } 
      function Joborder_Project_Complete_DataTable($user_id){        
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_finished as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.type',2)->where('p.status',1)->where('p.assigned',$user_id)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'image'         => $image,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
        } 
      function Joborder_Project_Cancelled_DataTable($user_id){        
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.type',2)->where('p.status',2)->where('c.designer',$user_id)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->production_no.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>'; 
                 $title = '<span style="width: 250px;"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
      } 
      function Joborder_Project_Production_DataTable($user_id){        
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.type',2)->where('p.status',2)->where('p.assigned',$user_id)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->production_no.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>'; 
                 $title = '<span style="width: 250px;"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"/></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
       function Joborder_Masterlist_Stocks_DataTable(){        
          $query = $this->db->select('p.*,c.*,d.*,p.status,c.image as image,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_finished as p')->join('tbl_project_color as c','c.id=p.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.type',1)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
              if($row->status==1){$status = '<span class="label label-lg label-light-success label-inline">Approved</span>';}else{$status ='<span class="label label-lg label-light-danger label-inline">Cancelled</span>';};
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'image'         => $image,
                          'title'         => $title,
                          'quantity'      => $row->unit,
                          'status'        => $status,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
      function Joborder_Masterlist_Project_DataTable(){        
          $query = $this->db->select('p.*,c.*,d.*,p.status,c.image,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_finished as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.type',2)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
                 $title = '<span style="width: 250px;"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
               if($row->status==1){$status = '<span class="label label-lg label-light-success label-inline">Approved</span>';}else{$status ='<span class="label label-lg label-light-danger label-inline">Cancelled</span>';};
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'quantity'      => $row->unit,
                          'status'        => $status,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
     function Joborder_Stocks_Supervisor_DataTable(){
         $query = $this->db->select('p.*,c.*,d.*,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project as p')->join('tbl_project_color as c','c.id=p.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.status !=',2)->where('p.type',1)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
              $action = '<button type="button" class="btn btn-icon btn-light-dark btn-hover-success btn-sm mx-3" data-toggle="modal" id="form-request" data-id="'.$row->production_no.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>';
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'image'         => $image,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created,
                          'status'        => $row->status,
                          'action'        => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Joborder_Project_Supervisor_DataTable(){
         $query = $this->db->select('p.*,c.*,d.*,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=p.assigned','LEFT')->where('p.status !=',2)->where('p.type',2)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
              $action = '<button type="button" class="btn btn-icon btn-light-dark btn-hover-success btn-sm mx-3" data-toggle="modal" id="form-request" data-id="'.$row->production_no.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>';
                 $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created,
                          'status'        => $row->status,
                          'action'        => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }

     function Salesorder_Stocks_Request_DataTable_Production($user_id){
        $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')->where('s.created_by', $user_id)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
            if($row->status == 'P'){$status='<span class="label label-lg label-light-primary label-inline">Request</span>';}
            else if($row->status == 'A'){$status = '<span class="label label-lg label-light-success label-inline">Approved</span>';}else{
                $status = '<span class="label label-lg label-light-danger label-inline">Cancelled</span>';}
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Stocks_Shipping_DataTable_Production($user_id){
        $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.delivery',1)
       ->where('s.created_by', $user_id)->order_by('s.date_created','DESC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Stocks_Delivered_DataTable_Production($user_id){
       $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.delivery',2)->where('s.created_by', $user_id)->order_by('s.date_created','DESC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }

     function Salesorder_Project_Request_DataTable_Production($user_id){
        $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')->where('s.created_by', $user_id)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
            if($row->status == 'P'){$status='<span class="label label-lg label-light-primary label-inline">Request</span>';}
            else if($row->status == 'A'){$status = '<span class="label label-lg label-light-success label-inline">Approved</span>';}else{
                $status = '<span class="label label-lg label-light-danger label-inline">Cancelled</span>';}
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Project_Shipping_DataTable_Production($user_id){
        $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.delivery',1)
       ->where('s.created_by', $user_id)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Project_Delivered_DataTable_Production($user_id){
       $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.delivery',2)->where('s.created_by', $user_id)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
      
    function Salesorder_Stocks_Request_DataTable_Admin($user_id){
       $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_users as u','u.id=s.created_by','LEFT')
       ->where('s.status','P')->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'created'     => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Stocks_Approved_DataTable_Admin($user_id){
       $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_users as u','u.id=s.created_by','LEFT')
       ->where('s.status','A')->where('s.update_by', $user_id)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'created'     => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Stocks_Rejected_DataTable_Admin($user_id){
       $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_users as u','u.id=s.created_by','LEFT')
       ->where('s.status','C')->where('s.update_by', $user_id)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                       'created'     => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
    function Salesorder_Project_Request_DataTable_Admin($user_id){
       $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_users as u','u.id=s.created_by','LEFT')
       ->where('s.status','P')->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'created'     => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Project_Approved_DataTable_Admin($user_id){
       $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_users as u','u.id=s.created_by','LEFT')
       ->where('s.status','A')->where('s.update_by', $user_id)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'created'      => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Project_Rejected_DataTable_Admin($user_id){
       $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_users as u','u.id=s.created_by','LEFT')
       ->where('s.status','C')->where('s.update_by', $user_id)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                       'created'     => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }


     function Salesorder_Stocks_Shipping_DataTable_Superuser($user_id){
        $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.delivery',1)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Stocks_Delivered_DataTable_Superuser($user_id){
       $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.delivery',2)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Project_Shipping_DataTable_Superuser($user_id){
        $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.delivery',1)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Project_Delivered_DataTable_Superuser($user_id){
       $data=false;
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.delivery',2)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }

     function Request_Material_List_Datatable($user_id){
           $data=false;
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_other_material_m_request')->where('status',1)->where('created_by',$user_id)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            $no = 1;
            foreach($query->result() as $row){
                if($row->type == 1){$type = 'Raw Materials';}else if($row->type==2){$type='Office & Janitorial Supplies';}else{$type ='Spare Parts';}
                 $data[] = array(
                          'no'  => $no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'type'=>$type,
                          'date_created'=> $row->date_created);
                 $no++; 
            } 
                
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Request_Material_Received_Datatable($user_id){
        $data=false;
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_other_material_m_received')->where('created_by',$user_id)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            $no = 1;
            foreach($query->result() as $row){
                if($row->type == 1){$type = 'Raw Materials';}else if($row->type==2){$type='Office & Janitorial Supplies';}else{$type ='Spare Parts';}
                 $data[] = array(
                          'no'  => $no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'type'=>$type,
                          'date_created'=> $row->date_created);
                  $no++; 
            } 
               
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Request_Material_Cancalled_Datatable($user_id){
        $data=false;
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_other_material_m_request')->where('status',3)->where('created_by',$user_id)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            $no = 1;
            foreach($query->result() as $row){
                if($row->type == 1){$type = 'Raw Materials';}else if($row->type==2){$type='Office & Janitorial Supplies';}else{$type ='Spare Parts';}
                 $data[] = array(
                          'no'  => $no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'type'=>$type,
                          'date_created'=> $row->date_created);
            } 
                $no++; 
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Request_Material_List_Superuser_Datatable(){
           $data=false;
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_other_material_m_request')->where('status',1)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            $no = 1;
            foreach($query->result() as $row){
                if($row->type == 1){$type = 'Raw Materials';}else if($row->type==2){$type='Office & Janitorial Supplies';}else{$type ='Spare Parts';}
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal"><i class="la la-eye"></i>
                        </button><button type="button" class="btn btn-sm btn-light-danger btn-icon btn-cancelled" data-id="'.$this->encryption->encrypt($row->id).'"><i class="flaticon2-trash"></i></button>'; 
                 $data[] = array(
                          'no'  => $no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'type'=>$type,
                          'date_created'=> $row->date_created,
                          'action'=>$action);
                 $no++; 
            } 
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Request_Material_Received_Superuser_Datatable(){
        $data=false;
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_other_material_m_received')->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            $no = 1;
            foreach($query->result() as $row){
                if($row->type == 1){$type = 'Raw Materials';}else if($row->type==2){$type='Office & Janitorial Supplies';}else{$type ='Spare Parts';}
                     $data[] = array('no'  => $no,
                              'item' => $row->item,
                              'quantity'=> $row->qty,
                              'type'=>$type,
                              'date_created'=> $row->date_created);
                      $no++; 
                }    
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Request_Material_Cancelled_Superuser_Datatable(){
        $data=false;
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_other_material_m_request')->where('status',3)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            $no = 1;
            foreach($query->result() as $row){
                if($row->type == 1){$type = 'Raw Materials';}else if($row->type==2){$type='Office & Janitorial Supplies';}else{$type ='Spare Parts';}
                 $data[] = array('no'  => $no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'type'=>$type,
                          'date_created'=> $row->date_created);
            } 
                $no++; 
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }





     function Return_Item_Good_DataTable_Superuser(){
           $data=false;
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_return_item_warehouse')->where('status',1)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            $no = 1;
            foreach($query->result() as $row){
            if($row->type == 1){$type = 'Raw Materials';}else if($row->type==2){$type='Office & Janitorial Supplies';}else{$type ='Spare Parts';}
                 $data[] = array(
                          'no'  => $no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'remarks' => $row->remarks,
                          'type'=>$type,
                          'date_created'=> $row->date_created);
            } 
                $no++; 
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Return_Item_Rejected_DataTable_Superuser(){
         $data=false;
          $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_return_item_warehouse')->where('status',2)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            $no = 1;
            foreach($query->result() as $row){
                if($row->type == 1){$type = 'Raw Materials';}else if($row->type==2){$type='Office & Janitorial Supplies';}else{$type ='Spare Parts';};
                 $data[] = array(
                          'no'  => $no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'remarks' => $row->remarks,
                          'type'=>$type,
                          'date_created'=> $row->date_created);
                } 
                $no++; 
            }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Return_Item_Repair_Customer_DataTable_Superuser(){
           $data=false;
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_return_item_customer')->where('status',1)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row){
                 $data[] = array(
                          'no'  => $row->so_no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'remarks' => $row->remarks,
                          'date_created'=> $row->date_created);
            } 
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Return_Item_Good_Customer_DataTable_Superuser(){
         $data=false;
          $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_return_item_customer')->where('status',2)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row){
                 $data[] = array(
                          'no'  => $row->so_no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'remarks' => $row->remarks,
                          'date_created'=> $row->date_created);
                } 
            }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
      function Return_Item_Rejected_Customer_DataTable_Superuser(){
         $data=false;
          $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_return_item_customer')->where('status',3)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row){
                 $data[] = array(
                          'no'  => $row->so_no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'remarks' => $row->remarks,
                          'date_created'=> $row->date_created);
                } 
            }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 


       function Users_DataTable(){
        $where = "status='ACTIVE' OR status='INACTIVE'";
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_users')->where($where)->order_by('date_created','DESC')->get();

            if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
            $action = '<button type="button" class="btn btn-sm btn-circle btn-primary btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="la la-eye"></i></button>';
               $fullname = $row->lastname.' '.$row->firstname;
               $data[] = array(
                      'no'           => $row->id,
                      'username'     => $row->username,
                      'name'         => $fullname,
                      'date_created'  => $row->date_created,
                      'status'       => $row->status,
                      'action'       => $action
                  );
            }  
             
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Material_Received_DataTable(){
        $query = $this->db->select('*,DATE_FORMAT(date_release, "%M %d %Y %r") as date_created')->from('tbl_material_release')->order_by('date_release','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
               $data[] = array(
                      'production_no' => $row->production_no,
                      'item'          => $row->item,
                      'quantity'      => $row->quantity,
                      'date_created'  => $row->date_created);
            }  
             
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
   


    //APPROVAL
   function Approval_Purchase_Request_DataTable($user_id){       
             $array = array();
             $query =  $this->db->select('d.*,c.*,mp.*,p.*,mp.status as status,
                CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(mp.date_approved1, "%M %d %Y %r") as date_created')
               ->from('tbl_purchasing_project as mp')
               ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
               ->join('tbl_project_design as d','d.project_no=p.project_no','LEFT')
               ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
               ->join('tbl_users as u', 'u.id=p.production','LEFT')
               ->where('mp.admin_status', 'REQUEST')->group_by('mp.production_no')
               ->order_by('mp.date_approved1','DESC')->get();  
            if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
               $action = ' <button data-toggle="modal" data-target="#requestModal" id="form-request" data-status="'.base64_encode('REQUEST').'"  data-id="'.base64_encode($row->request_id).'" class="btn btn-sm btn-circle btn-primary btn-icon" title="View Request"><i class="la la-eye"></i></button>';  
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.' ('.$row->c_name.')"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="'.$row->c_name.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                    if($row->status == 'COMPLETE'){$dates = $row->date_inprogress;
                    }else if($row->status == 'REJECTED'){$dates = $row->date_rejected;
                    }else if($row->status == 'PENDING'){$dates = $row->date_pending;
                    }else if($row->status == 'IN PROGRESS'){$dates = $row->date_inprogress;
                    }else if($row->status == 'PARTIAL'){$dates = $row->date_inprogress;
                    }else if($row->status == 'APPROVED1'){$dates = $row->date_approved1;}
                     $data[] = array(
                          'production_no' => $row->production_no,
                          'image'        => $image,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'qty'          => $row->balance,
                          'date_created' => $dates,
                          'action'       => $action);
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
     } 
     function Approval_Purchase_Approved_DataTable($user_id){       
             $array = array('mp.admin_status =' => 'APPROVED','mp.approver2' => $user_id);
             $query =  $this->db->select('d.*,c.*,mp.*,p.*,mp.status as status,
                CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(mp.date_inprogress, "%M %d %Y %r") as date_created')
               ->from('tbl_purchasing_project as mp')
               ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
               ->join('tbl_project_design as d','d.project_no=p.project_no','LEFT')
               ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
               ->join('tbl_users as u', 'u.id=p.production','LEFT')
               ->where($array)->group_by('mp.production_no')
               ->order_by('mp.date_inprogress','DESC')->get();  
            if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
               $action = ' <button data-toggle="modal" data-target="#requestModal" id="form-request" data-id="'.base64_encode($row->request_id).'" data-status="'.base64_encode('APPROVED').'" class="btn btn-sm btn-circle btn-primary btn-icon" title="View Request"><i class="la la-eye"></i></button>';  
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.' ('.$row->c_name.')"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="'.$row->c_name.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                    if($row->status == 'COMPLETE'){$dates = $row->date_inprogress;
                    }else if($row->status == 'REJECTED'){$dates = $row->date_rejected;
                    }else if($row->status == 'PENDING'){$dates = $row->date_pending;
                    }else if($row->status == 'IN PROGRESS'){$dates = $row->date_inprogress;
                    }else if($row->status == 'PARTIAL'){$dates = $row->date_inprogress;
                    }else if($row->status == 'APPROVED1'){$dates = $row->date_approved1;}
                     $data[] = array(
                          'production_no' => $row->production_no,
                          'image'         => $image,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->balance,
                          'date_created'  => $dates,
                          'action'        => $action);
            }  
             
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
     } 
     function Approval_Purchase_Rejected_DataTable($user_id){       
              $array = array('mp.status' => 'REJECTED', 'mp.approver2' => $user_id);  
              $date  = 'DATE_FORMAT(mp.date_rejected, "%M %d %Y %r") as date_created';
              $date_ = 'mp.date_rejected';
             $query =  $this->db->select('d.*,c.*,mp.*,p.*,mp.status as status,
                CONCAT(u.firstname, " ",u.lastname) AS requestor,DATE_FORMAT(mp.date_rejected, "%M %d %Y %r") as date_created')
               ->from('tbl_purchasing_project as mp')
               ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
               ->join('tbl_project_design as d','d.project_no=p.project_no','LEFT')
               ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
               ->join('tbl_users as u', 'u.id=p.production','LEFT')
               ->where($array)->group_by('mp.production_no')
               ->order_by('date_rejected','DESC')->get();  
            if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
               $action = ' <button data-toggle="modal" data-target="#requestModal" id="form-request" data-id="'.base64_encode($row->request_id).'" data-status="'.base64_encode('REJECTED').'" class="btn btn-sm btn-circle btn-primary btn-icon" title="View Request"><i class="la la-eye"></i></button>';  
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.' ('.$row->c_name.')"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="'.$row->c_name.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                    if($row->status == 'COMPLETE'){$dates = $row->date_inprogress;
                    }else if($row->status == 'REJECTED'){$dates = $row->date_rejected;
                    }else if($row->status == 'PENDING'){$dates = $row->date_pending;
                    }else if($row->status == 'IN PROGRESS'){$dates = $row->date_inprogress;
                    }else if($row->status == 'PARTIAL'){$dates = $row->date_inprogress;
                    }else if($row->status == 'APPROVED1'){$dates = $row->date_approved1;}
                     $data[] = array(
                          'production_no' => $row->production_no,
                          'image'        => $image,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'qty'          => $row->balance,
                          'date_created' => $dates,
                          'action'       => $action);
            }  
             
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
     } 
   function Approval_Inspection_Stocks_Request_DataTable(){
    $query = $this->db->select('*,c.image as image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_inspection as i')
    ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
    ->join('tbl_project_design as d','d.id=j.project_no','LEFT')
    ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
    ->join('tbl_users as u', 'u.id=i.created_by','LEFT')
    ->where('i.status',1)
    ->where('i.type',1)
    ->group_by('i.production_no')
    ->order_by('i.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
                $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->production_no).'" data-target="#modal-form"><i class="la la-eye"></i></button>';    
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><span class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</span></div></div></span>';
                 $data[] = array('production_no'=> $row->production_no,
                                 'image'        => $row->image,
                                 'title'        => $title,
                                 'qty'          => $row->qty,
                                 'requestor'    => $row->requestor,
                                 'date_created' => $row->date_created,
                                 'action'       => $action);
             }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
      }
      function Approval_Inspection_Stocks_Approved_DataTable($user_id){
        $query = $this->db->select('*,c.image as image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_inspection as i')
        ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
        ->join('tbl_project_design as d','d.id=j.project_no','LEFT')
        ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
        ->join('tbl_users as u', 'u.id=i.created_by','LEFT')
        ->where('i.status',2)
        ->where('i.type',1)
        ->group_by('i.ins_no')
        ->order_by('i.date_created','DESC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
                  foreach($query->result() as $row) {
                    $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->ins_no).'" data-target="#modal-form"><i class="la la-eye"></i></button>';    
                   $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
                   $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><span class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</span></div></div></span>';
                     $data[] = array('production_no'=> $row->production_no,
                                     'image'        => $row->image,
                                     'title'        => $title,
                                     'qty'          => $row->qty,
                                     'requestor'    => $row->requestor,
                                     'date_created' => $row->date_created,
                                     'action'       => $action);
                 }  
             }else{   
                 $data =false;   
             }
             $json_data  = array("data" =>$data); 
             return $json_data; 
          }
       function Approval_Inspection_Stocks_Rejected_DataTable($user_id){
         $query = $this->db->select('*,c.image as image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_inspection as i')
            ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
            ->join('tbl_project_design as d','d.id=j.project_no','LEFT')
            ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
            ->join('tbl_users as u', 'u.id=i.created_by','LEFT')
            ->where('i.status',3)
            ->where('i.type',1)
            ->group_by('i.ins_no')->order_by('i.date_created','DESC')->get();
                 if($query !== FALSE && $query->num_rows() > 0){
                      foreach($query->result() as $row) {
                        $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->ins_no).'" data-target="#modal-form"><i class="la la-eye"></i></button>';    
                       $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
                       $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><span class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</span></div></div></span>';
                         $data[] = array('production_no'=> $row->production_no,
                                         'image'        => $row->image,
                                         'title'        => $title,
                                         'qty'          => $row->qty,
                                         'requestor'    => $row->requestor,
                                         'date_created' => $row->date_created,
                                         'action'       => $action);
                     }  
                 }else{   
                     $data =false;   
                 }
                 $json_data  = array("data" =>$data); 
                 return $json_data; 
    }
   function Approval_Inspection_Project_Request_DataTable(){
    $query = $this->db->select('*,c.image as image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_inspection as i')
    ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
    ->join('tbl_project_design as d','d.id=j.project_no','LEFT')
    ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
    ->join('tbl_users as u', 'u.id=i.created_by','LEFT')
    ->where('i.status',1)
    ->where('i.type',1)
    ->group_by('i.production_no')
    ->order_by('i.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
               $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->decrypt($row->production_no).'" data-target="#requestModal" data-status="1"><i class="flaticon2-edit"></i></button>';  
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"/></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array('production_no'=> $row->production_no,
                                 'title'        => $title,
                                 'requestor'    => $row->requestor,
                                 'date_created' => $row->date_created,
                                 'action'       => $action);
             }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
      }
      function Approval_Inspection_Project_Approved_DataTable($user_id){
        $query = $this->db->select('*,c.image as image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_inspection as i')
        ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
        ->join('tbl_project_design as d','d.id=j.project_no','LEFT')
        ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
        ->join('tbl_users as u', 'u.id=i.created_by','LEFT')
        ->where('i.status',2)
        ->where('i.type',2)
        ->group_by('i.ins_no')
        ->order_by('i.date_created','DESC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
                  foreach($query->result() as $row) {
                   $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->decrypt($row->ins_no).'" data-target="#requestModal" data-status="2"><i class="flaticon2-edit"></i></button>';  
                   $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"/></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                     $data[] = array('production_no'=> $row->production_no,
                                     'title'        => $title,
                                     'requestor'    => $row->requestor,
                                     'date_created' => $row->date_created,
                                     'action'       => $action);
                 }  
             }else{   
                 $data =false;   
             }
             $json_data  = array("data" =>$data); 
             return $json_data; 
          }
       function Approval_Inspection_Project_Rejected_DataTable($user_id){
         $query = $this->db->select('*,c.image as image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_inspection as i')
            ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
            ->join('tbl_project_design as d','d.id=j.project_no','LEFT')
            ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
            ->join('tbl_users as u', 'u.id=i.created_by','LEFT')
            ->where('i.status',3)
            ->where('i.type',2)
            ->group_by('i.ins_no')->order_by('i.date_created','DESC')->get();
                 if($query !== FALSE && $query->num_rows() > 0){
                      foreach($query->result() as $row) {
                       $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->decrypt($row->ins_no).'" data-target="#requestModal" data-status="3"><i class="flaticon2-edit"></i></button>';  
                       $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"/></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                         $data[] = array('production_no'=> $row->production_no,
                                         'title'        => $title,
                                         'requestor'    => $row->requestor,
                                         'date_created' => $row->date_created,
                                         'action'       => $action);
                     }  
                 }else{   
                     $data =false;   
                 }
                 $json_data  = array("data" =>$data); 
                 return $json_data; 
    }
      function Approval_Request_Salesorder_DataTable(){
        $data =false;   
        $query=$this->db->select('*,s.status,DATE_FORMAT(s.date_order, "%M %d %Y %r") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS sales_person')
            ->from('tbl_salesorder as s')
            ->join('tbl_users as u','u.id=s.created_by','LEFT')
            ->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
            ->where('s.status', 1)->order_by('s.date_created','DESC')->get();
           if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
           $action = '<button type="button" class="btn btn-sm btn-circle btn-primary btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->so_no.'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'sales_person' => $row->sales_person,
                      'customer'     => $row->fullname,
                      'date_created' => $row->date_created,
                      'action'       => $action,
                  );
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 

     }
     function Approval_Approved_Salesorder_DataTable(){
       $data =false;   
       $query=$this->db->select('*,s.status,DATE_FORMAT(s.date_order, "%M %d %Y %r") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS sales_person')
            ->from('tbl_salesorder as s')
            ->join('tbl_users as u','u.id=s.created_by','LEFT')
            ->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
            ->where('s.status', 2)->order_by('s.date_created','DESC')->get();
           if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
           $action = '<button type="button" class="btn btn-sm btn-circle btn-primary btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->so_no.'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'sales_person' => $row->sales_person,
                      'customer'       => $row->fullname,
                      'date_created' => $row->date_created,
                      'action'       => $action,
                  );
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Approval_Rejected_Salesorder_DataTable(){
        $data =false;
        $query=$this->db->select('*,s.status,DATE_FORMAT(s.date_order, "%M %d %Y %r") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS sales_person')
            ->from('tbl_salesorder as s')
            ->join('tbl_users as u','u.id=s.created_by','LEFT')
            ->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
            ->where('s.status', 1)->order_by('s.date_created','DESC')->get();
           if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
           $action = '<button type="button" class="btn btn-sm btn-circle btn-primary btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->so_no.'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'sales_person' => $row->sales_person,
                      'customer'       => $row->fullname,
                      'date_created' => $row->date_created,
                      'action'       => $action,
                  );
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Approval_Design_Stocks_Request_DataTable($user_id){
        $array = array('c.p_status' => 'REQUEST');
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status=1 AND c.type=1')->order_by('c.date_created','ASC')->get();
        $data= array();
           if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
               $action = '<button type="button" class="btn btn-sm btn-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="la la-eye"></i></button>';    
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.' ('.$row->c_name.')"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="'.$row->c_name.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
             $data[] = array(
                      'project_no'   => $row->project_no,
                      'image'        => $image,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
             
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 

     }
      function Approval_Design_Stocks_Approved_DataTable($user_id){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,DATE_FORMAT(c.date_approved, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status=2 AND c.type=1 AND c.approver='.$user_id.'')->order_by('c.date_approved','ASC')->get();
            $data= array();
           if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
               $action = '<button type="button" class="btn btn-sm btn-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="la la-eye"></i></button>';    
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.' ('.$row->c_name.')"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="'.$row->c_name.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';

             $data[] = array(
                      'project_no'   => $row->project_no,
                      'image'        => $image,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
             
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 

     }
     function Approval_Design_Stocks_Rejected_DataTable($user_id){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,DATE_FORMAT(c.date_approved, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status=3 AND c.type=1 AND c.approver='.$user_id.'')->order_by('c.date_approved','ASC')->get();
            $data= array();
           if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row) {
               $action = '<button type="button" class="btn btn-sm btn-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="la la-eye"></i></button>';    
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.' ('.$row->c_name.')"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="'.$row->c_name.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';

             $data[] = array(
                      'project_no'   => $row->project_no,
                      'image'        => $image,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
             
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 

     }
       function Approval_Design_Project_Request_DataTable($user_id){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status=1 AND c.type=2')->order_by('c.date_created','ASC')->get();
        $data= array();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
               $action = '<button type="button" class="btn btn-sm btn-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="la la-eye"></i></button>';    
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array(
                          'project_no'   => $row->project_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Approval_Design_Project_Approved_DataTable($user_id){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status =2 AND c.type=2 AND c.approver ='.$user_id.'')->order_by('c.date_created','ASC')->get();
        $data= array();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
              $action = '<button type="button" class="btn btn-sm btn-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="la la-eye"></i></button>';    
             $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
             $data[] = array(
                      'project_no'   => $row->project_no,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Approval_Design_Project_Rejected_DataTable($user_id){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=c.designer')->where('c.status=3 AND c.type=2 AND c.approver ='.$user_id.'')->order_by('c.date_approved','ASC')->get();
        $data= array();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
              $action = '<button type="button" class="btn btn-sm btn-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="la la-eye"></i></button>';    
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array(
                          'project_no'   => $row->project_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }

    function Approval_UsersRequest_DataTable($status){
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_users')->where('status',$status)->order_by('date_created','DESC')->get();
        $data=array();
         if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
             $action = '<button type="button" class="btn btn-sm btn-circle btn-primary btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="la la-eye"></i></button>';
               $fullname = $row->lastname.' '.$row->firstname;
               $data[] = array(
                      'no'           => $row->id,
                      'username'     => $row->username,
                      'name'         => $fullname,
                      'date_created' => $row->date_created,
                      'status'       => $row->status,
                      'action'       => $action
                  );
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }


     //ACCOUNTING
     function Accounting_Purchase_Material_Stocks_Request(){
        $query =  $this->db->select('d.*,c.*,m.*,DATE_FORMAT(m.latest_update, "%M %d %Y") as date_created,
                     CONCAT(u.firstname, " ",u.lastname) AS requestor')
        ->from('tbl_purchasing_project as m')
        ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
        ->join('tbl_project_color as c','c.id=p.c_code','LEFT')
        ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
        ->join('tbl_users as u','u.id=m.supervisor','LEFT')
        ->where('m.status',3)->where('m.type',1)->group_by('m.fund_no')->get();  
         $data=array();
        if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row){
               $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->fund_no.'" data-target="#requestModalRequest"><i class="la la-eye"></i></button>';   
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                     $data[] = array(
                          'production_no'=> $row->production_no,
                          'image'        => $image,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'status'       => $row->status,
                          'action'       => $action);
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
     }
    
     function Accounting_Purchase_Material_Stocks_Approval($user_id){
      $query = $this->db->select('d.*,c.*,m.*,d.title,c.image as image,DATE_FORMAT(m.latest_update, "%M %d %Y") as date_created,
        CONCAT(u.firstname, " ",u.lastname) AS requestor')
        ->from('tbl_purchasing_project as m')
        ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
        ->join('tbl_project_color as c','c.id=p.c_code','LEFT')
        ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
        ->join('tbl_users as u','u.id=m.supervisor','LEFT')
        ->where('m.status',4)->where('m.type',1)->where('m.accounting',$user_id)->group_by('m.fund_no')->get();
         $data=array();
           if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-approval" data-id="'.$row->fund_no.'" data-target="#requestModalApproved"><i class="la la-eye"></i></button>';   
            $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
            $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
             $data[] = array(
                          'fund_no'      => $row->fund_no,
                          'production_no'=> $row->production_no,
                          'image'        => $image,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'action'       => $action);
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
          function Accounting_Purchase_Material_Stocks_Received($user_id){
        $query = $this->db->select('d.*,c.*,m.*,pc.*,DATE_FORMAT(m.date_created, "%M %d %Y") as date_created,
                     CONCAT(u.firstname, " ",u.lastname) AS requestor')
        ->from('tbl_purchase_received as m')->join('tbl_purchasing_project as pp','pp.id=m.pr_id','LEFT')
        ->join('tbl_pettycash as pc','pc.fund_no=pp.fund_no','LEFT')
        ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
        ->join('tbl_project_color as c','c.id=p.c_code','LEFT')
        ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
        ->join('tbl_users as u','u.id=m.created_by','LEFT')
        ->where('(pc.status=1 OR pc.status=2) AND pc.accounting='.$user_id.' AND pp.type=1')
        ->group_by('pp.fund_no')->get();
        $data = array();
           if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
            $action = ' <button data-toggle="modal" data-target="#requestModalReceived" id="form-received" data-id="'.$row->fund_no.'" class="btn btn-sm btn-dark btn-icon" title="View Request"><i class="la la-eye"></i></button>'; 
            $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
            $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
             $data[] = array(
                          'fund_no'      => $row->fund_no,
                          'production_no'=> $row->production_no,
                          'image'        => $image,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'status'       => $row->status,
                          'action'       => $action);
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
      function Accounting_Purchase_Material_Project_Request(){
        $query = $this->db->select('d.*,c.*,m.*,d.title,c.image as image,DATE_FORMAT(m.latest_update, "%M %d %Y") as date_created,
        CONCAT(u.firstname, " ",u.lastname) AS requestor')
        ->from('tbl_purchasing_project as m')
        ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
        ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
        ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
        ->join('tbl_users as u','u.id=m.supervisor','LEFT')
        ->where('m.status',3)->where('m.type',2)->group_by('m.fund_no')->get();  
        $data=array();
        if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row){
                $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->fund_no.'" data-target="#requestModalRequest"><i class="la la-eye"></i></button>';   
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                     $data[] = array(
                          'production_no'=> $row->production_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'status'       => $row->status,
                          'action'       => $action);
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
     }
      function Accounting_Purchase_Material_Project_Approval($user_id){
      $query = $this->db->select('d.*,c.*,m.*,d.title,c.image,DATE_FORMAT(m.latest_update, "%M %d %Y") as date_created,
        CONCAT(u.firstname, " ",u.lastname) AS requestor')
        ->from('tbl_purchasing_project as m')->join('tbl_project as p','p.production_no=m.production_no','LEFT')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_users as u','u.id=m.supervisor','LEFT')->where('m.status',4)->where('m.type',2)->where('m.accounting',$user_id)->group_by('m.fund_no')->get();
            $data=array();
           if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
             $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-approved" data-id="'.$row->fund_no.'" data-target="#requestModalApproved"><i class="la la-eye"></i></button>';
            $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
             $data[] = array(
                          'fund_no'      => $row->fund_no,
                          'production_no'=> $row->production_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'action'       => $action);
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Accounting_Purchase_Material_Project_Received($user_id){
        $query = $this->db->select('d.*,c.*,m.*,pc.*,DATE_FORMAT(m.date_created, "%M %d %Y") as date_created,
                     CONCAT(u.firstname, " ",u.lastname) AS requestor')
        ->from('tbl_purchase_received as m')->join('tbl_purchasing_project as pp','pp.id=m.pr_id','LEFT')
        ->join('tbl_pettycash as pc','pc.fund_no=pp.fund_no','LEFT')
        ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
        ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
        ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
        ->join('tbl_users as u','u.id=m.created_by','LEFT')
        ->where('(pc.status=1 OR pc.status=2) AND pc.accounting='.$user_id.' AND pp.type=2')
        ->group_by('pp.fund_no')->get();
        $data = array();
           if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
            $action = ' <button data-toggle="modal" data-target="#requestModalReceived" id="form-received" data-id="'.$row->fund_no.'" class="btn btn-sm btn-dark btn-icon" title="View Request"><i class="la la-eye"></i></button>'; 
            $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
             $data[] = array(
                          'fund_no'      => $row->fund_no,
                          'production_no'=> $row->production_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'status'       => $row->status,
                          'action'       => $action);
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }

     function Account_Report_Collection_Stocks_Daily($month,$year){
            $data =false;   $total_gross =0;$total_vat = 0;$total_amount = 0;
            if($month == false || $year == false){
                $date = "MONTH(date_deposite)=".date('m')." AND YEAR(date_deposite)=".date('Y')." AND status='A' AND type=1";
            }else{
                $date = "MONTH(date_deposite)=".$month." AND YEAR(date_deposite)=".$year." AND status='A' AND type=1";
            }   
            $query = $this->db->select('*,CONCAT(firstname, " ",lastname) AS customer,DATE_FORMAT(date_deposite, "%M %d %Y") as date_created,(SELECT SUM(amount) FROM tbl_customer_deposite WHERE '.$date.') as total_amount')->from('tbl_customer_deposite')->where($date)->order_by('date_deposite','ASC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 $gross = $row->amount / 1.12;
                 $vat = $row->amount - $gross;
                 $data[] = array(
                              'order_no'     => $row->order_no,
                              'si_no'        => $row->si_no,
                              'customer'     => $row->customer,
                              'bank'         => $row->bank,
                              'gross'        => number_format($gross,2),
                              'vat'          => number_format($vat,2),
                              'amount'       => number_format($row->amount,2),
                              'date_created' => $row->date_created);
                 $total_gross += $gross;
                 $total_vat += $vat;
                 $total_amount += $row->amount;
                }  
             }
             return array('row'=>$data,'total_gross'=>number_format($total_gross,2),'total_vat'=>number_format($total_vat,2),'total_amount'=>number_format($total_amount,2));
     }
       function Account_Report_Collection_Stocks_Weekly($month,$year){
             $data =false;  
             if($month == false || $year == false){
                $date = "MONTH(date_deposite)=".date('m')." AND YEAR(date_deposite)=".date('Y')." AND status='A' AND type=1";
            }else{
                $date = "MONTH(date_deposite)=".$month." AND YEAR(date_deposite)=".$year." AND status='A' AND type=1";
            }
            $query = $this->db->select('*,CONCAT(firstname, " ",lastname) AS customer,
                CONCAT("WEEK", " ",WEEK(date_deposite, 3) - WEEK(date_deposite - INTERVAL DAY(date_deposite)-1 DAY, 3) + 1)
                      as date_created,  SUM(amount) AS amount,
                    (SELECT SUM(amount) FROM tbl_customer_deposite WHERE '.$date.') as total_amount
                ')->from('tbl_customer_deposite')->where($date)->group_by('WEEK(date_deposite)')->order_by('WEEK(date_deposite)','ASC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 $gross = $row->amount / 1.12;
                 $vat = $row->amount - $gross;
                 $data[] = array('gross'=> number_format($gross,2),
                                 'vat'=> number_format($vat,2),
                                 'amount'=> number_format($row->amount,2),
                                 'date_created'=> $row->date_created);
                }  
             }
             return $data;
     }
     function Account_Report_Collection_Stocks_Monthly($month,$year){
           if($month == false || $year == false){$date = "YEAR(date_deposite)=".date('Y')." AND status='A' AND type=1";
            }else{$date = "YEAR(date_deposite)=".$year." AND status='A' AND type=1";}
            $data =false; $total_gross =0;$total_vat = 0;$total_amount = 0;  
            $query = $this->db->select('*,sum(amount) as amount,CONCAT(firstname, " ",lastname) AS customer,DATE_FORMAT(date_deposite, "%M") as date_created,
                (SELECT SUM(amount) FROM tbl_customer_deposite WHERE '.$date.') as total_amount')->from('tbl_customer_deposite')->where($date)->group_by('MONTH(date_deposite)')->order_by('date_deposite','ASC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row)  {
                 $gross = $row->amount / 1.12;
                 $vat = $row->amount - $gross;
                 $data[] = array(
                              'gross'        => number_format($gross,2),
                              'vat'          => number_format($vat,2),
                              'amount'       => number_format($row->amount,2),
                              'date_created' => $row->date_created);
                 $total_gross += $gross;
                 $total_vat += $vat;
                 $total_amount += $row->amount;
                }  
             }
             return array('row'=>$data,'total_gross'=>number_format($total_gross,2),'total_vat'=>number_format($total_vat,2),'total_amount'=>number_format($total_amount,2));
     }
      function Account_Report_Collection_Stocks_Yearly($year){
            $data =false;  $total_gross =0;$total_vat = 0;$total_amount = 0;
           if($year == false){$date = "YEAR(date_deposite)<=".date('Y')." AND status='A' AND type=1";}else{$date = "YEAR(date_deposite)<=".$year." AND status='A' AND type=1";}   
            $query = $this->db->select('*,sum(amount) as amount,CONCAT(firstname, " ",lastname) AS customer,DATE_FORMAT(date_deposite, "%Y") as date_created, sum(amount) as amount,
                (SELECT SUM(amount) FROM tbl_customer_deposite WHERE '.$date.') as total_amount')->from('tbl_customer_deposite')->where($date)->group_by('YEAR(date_deposite)')->order_by('YEAR(date_deposite)','DESC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row)  
                {
                 $gross = $row->amount / 1.12;
                 $vat = $row->amount - $gross;
                 $data[] = array(
                              'gross'        => number_format($gross,2),
                              'vat'          => number_format($vat,2),
                              'amount'       => number_format($row->amount,2),
                              'date_created' => $row->date_created);
                 $total_gross += $gross;
                 $total_vat += $vat;
                 $total_amount += $row->amount;
                }  
             }
            return array('row'=>$data,'total_gross'=>number_format($total_gross,2),'total_vat'=>number_format($total_vat,2),'total_amount'=>number_format($total_amount,2));
     }
     function Account_Report_Collection_Project_Daily($month,$year){
            $data =false;   $total_gross =0;$total_vat = 0;$total_amount = 0;
            if($month == false || $year == false){
                $date = "MONTH(date_deposite)=".date('m')." AND YEAR(date_deposite)=".date('Y')." AND status='A' AND type=2";
            }else{
                $date = "MONTH(date_deposite)=".$month." AND YEAR(date_deposite)=".$year." AND status='A' AND type=2";
            }   
            $query = $this->db->select('*,CONCAT(firstname, " ",lastname) AS customer,DATE_FORMAT(date_deposite, "%M %d %Y") as date_created,(SELECT SUM(amount) FROM tbl_customer_deposite WHERE '.$date.') as total_amount')->from('tbl_customer_deposite')->where($date)->order_by('date_deposite','ASC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 $gross = $row->amount / 1.12;
                 $vat = $row->amount - $gross;
                 $data[] = array(
                              'order_no'     => $row->order_no,
                              'si_no'        => $row->si_no,
                              'customer'     => $row->customer,
                              'bank'         => $row->bank,
                              'gross'        => number_format($gross,2),
                              'vat'          => number_format($vat,2),
                              'amount'       => number_format($row->amount,2),
                              'date_created' => $row->date_created);
                 $total_gross += $gross;
                 $total_vat += $vat;
                 $total_amount += $row->amount;
                }  
             }
             return array('row'=>$data,'total_gross'=>number_format($total_gross,2),'total_vat'=>number_format($total_vat,2),'total_amount'=>number_format($total_amount,2));
     }
       function Account_Report_Collection_Project_Weekly($month,$year){
             $data =false;  
             if($month == false || $year == false){
                $date = "MONTH(date_deposite)=".date('m')." AND YEAR(date_deposite)=".date('Y')." AND status='A' AND type=2";
            }else{
                $date = "MONTH(date_deposite)=".$month." AND YEAR(date_deposite)=".$year." AND status='A' AND type=2";
            }
            $query = $this->db->select('*,CONCAT(firstname, " ",lastname) AS customer,
                CONCAT("WEEK", " ",WEEK(date_deposite, 3) - WEEK(date_deposite - INTERVAL DAY(date_deposite)-1 DAY, 3) + 1)
                      as date_created,  SUM(amount) AS amount,
                    (SELECT SUM(amount) FROM tbl_customer_deposite WHERE '.$date.') as total_amount
                ')->from('tbl_customer_deposite')->where($date)->group_by('WEEK(date_deposite)')->order_by('WEEK(date_deposite)','ASC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 $gross = $row->amount / 1.12;
                 $vat = $row->amount - $gross;
                 $data[] = array('gross'=> number_format($gross,2),
                                 'vat'=> number_format($vat,2),
                                 'amount'=> number_format($row->amount,2),
                                 'date_created'=> $row->date_created);
                }  
             }
             return $data;
     }
     function Account_Report_Collection_Project_Monthly($month,$year){
           if($month == false || $year == false){$date = "YEAR(date_deposite)=".date('Y')." AND status='A' AND type=2";
            }else{$date = "YEAR(date_deposite)=".$year." AND status='A' AND type=2";}
            $data =false; $total_gross =0;$total_vat = 0;$total_amount = 0;  
            $query = $this->db->select('*,sum(amount) as amount,CONCAT(firstname, " ",lastname) AS customer,DATE_FORMAT(date_deposite, "%M") as date_created,
                (SELECT SUM(amount) FROM tbl_customer_deposite WHERE '.$date.') as total_amount')->from('tbl_customer_deposite')->where($date)->group_by('MONTH(date_deposite)')->order_by('date_deposite','ASC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row)  {
                 $gross = $row->amount / 1.12;
                 $vat = $row->amount - $gross;
                 $data[] = array(
                              'gross'        => number_format($gross,2),
                              'vat'          => number_format($vat,2),
                              'amount'       => number_format($row->amount,2),
                              'date_created' => $row->date_created);
                 $total_gross += $gross;
                 $total_vat += $vat;
                 $total_amount += $row->amount;
                }  
             }
             return array('row'=>$data,'total_gross'=>number_format($total_gross,2),'total_vat'=>number_format($total_vat,2),'total_amount'=>number_format($total_amount,2));
     }
      function Account_Report_Collection_Project_Yearly($year){
            $data =false;  $total_gross =0;$total_vat = 0;$total_amount = 0;
           if($year == false){$date = "YEAR(date_deposite)<=".date('Y')." AND status='A' AND type=2";}else{$date = "YEAR(date_deposite)<=".$year." AND status='A' AND type=2";}   
            $query = $this->db->select('*,sum(amount) as amount,CONCAT(firstname, " ",lastname) AS customer,DATE_FORMAT(date_deposite, "%Y") as date_created, sum(amount) as amount,
                (SELECT SUM(amount) FROM tbl_customer_deposite WHERE '.$date.') as total_amount')->from('tbl_customer_deposite')->where($date)->group_by('YEAR(date_deposite)')->order_by('YEAR(date_deposite)','DESC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row)  
                {
                 $gross = $row->amount / 1.12;
                 $vat = $row->amount - $gross;
                 $data[] = array(
                              'gross'        => number_format($gross,2),
                              'vat'          => number_format($vat,2),
                              'amount'       => number_format($row->amount,2),
                              'date_created' => $row->date_created);
                 $total_gross += $gross;
                 $total_vat += $vat;
                 $total_amount += $row->amount;
                }  
             }
            return array('row'=>$data,'total_gross'=>number_format($total_gross,2),'total_vat'=>number_format($total_vat,2),'total_amount'=>number_format($total_amount,2));
     }



     function Account_Report_Salesorder_Stocks_Daily($month,$year){
           if($month == false || $year == false){
                $date = "MONTH(s.date_order)=".date('m')." AND YEAR(s.date_order)=".date('Y')."";
            }else{
                $date = "MONTH(s.date_order)=".$month." AND YEAR(s.date_order)=".$year."";
            }
             $data =false;  
             $total_subtotal = 0;
             $total_vat = 0;
             $total_shippingfee = 0;
             $total_amount = 0;
             $query = $this->db->select('s.*,c.*,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')->join('tbl_users as u','u.id=s.created_by','LEFT')->where('s.status','A')->where($date)->order_by('s.date_order','ASC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                    $total =  $this->db->select('sum(amount) as subtotal')->from('tbl_salesorder_stocks_item')->where('so_no',$row->id)->get()->row();
                    $dis = 0;
                     if($row->discount !=0){$dis = floatval($row->discount/100);}
                    $discount = $total->subtotal*$dis;
                    $subtotal = $total->subtotal-$discount;
                    if($row->vat==1){$vat = $row->subtotal*0.12;$amount_due = floatval($total->subtotal - $row->downpayment + $row->shipping_fee + $vat);
                    }else{$vat = 0;$amount_due = floatval($total->subtotal - $row->downpayment + $row->shipping_fee);}
                     $data[] = array('si_no'      => $row->si_no,
                                    'customer'    => $row->fullname,
                                    'vat'         => $row->vat,
                                    'subtotal'    => number_format($total->subtotal,2),
                                    'vat'         => number_format($vat,2),
                                    'shipping_fee'=> number_format($row->shipping_fee,2),
                                    'amount_due'  => number_format($amount_due,2),
                                    'date_created'=> $row->date_created);
                    $total_subtotal +=$total->subtotal;
                    $total_vat +=$vat;
                    $total_shippingfee +=$row->shipping_fee;
                    $total_amount +=$amount_due;
                }  
             }

             $data_response = array('result'=>$data,
                                    'total_subtotal'=>number_format($total_subtotal,2),
                                    'total_vat'=>number_format($total_vat,2),
                                    'total_shippingfee'=>number_format($total_shippingfee,2),
                                    'total_amount'=>number_format($total_amount,2));
             return $data_response;
     }
       function Account_Report_Salesorder_Stocks_Weekly($month,$year){
             if($month == false || $year == false){$date = "MONTH(date_order)=".date('m')." AND YEAR(date_order)=".date('Y')."";}else{
                $date = "MONTH(date_order)=".$month." AND YEAR(date_order)=".$year."";}
             $data =false;  $total_subtotal = 0;$total_vat = 0;$total_shippingfee = 0;$total_amount = 0;
             $query = $this->db->select('*,CONCAT("WEEK", " ",WEEK(date_order, 3) - WEEK(date_order - INTERVAL DAY(date_order)-1 DAY, 3) + 1) as date_order')->from('tbl_salesorder_stocks')->where('status','A')->where($date)->group_by('WEEK(date_order)')->order_by('WEEK(date_order)','ASC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                    $total =  $this->db->select('sum(amount) as subtotal')->from('tbl_salesorder_stocks_item')->where('so_no',$row->id)->get()->row();
                    $dis = 0;
                     if($row->discount !=0){$dis = floatval($row->discount/100);}
                    $discount = $total->subtotal*$dis;
                    $subtotal = $total->subtotal-$discount;
                    if($row->vat==1){$vat = $row->subtotal*0.12;$amount_due = floatval($total->subtotal - $row->downpayment + $row->shipping_fee + $vat);
                    }else{$vat = 0;$amount_due = floatval($total->subtotal - $row->downpayment + $row->shipping_fee);}
                     $data[] = array('si_no'      => $row->si_no,
                                    'vat'         => $row->vat,
                                    'subtotal'    => number_format($total->subtotal,2),
                                    'vat'         => number_format($vat,2),
                                    'shipping_fee'=> number_format($row->shipping_fee,2),
                                    'amount_due'  => number_format($amount_due,2),
                                    'date_created'=> $row->date_order);
                }  
             }
             $data_response = array('result'=>$data);
             return $data_response;
     }
     function Account_Report_Salesorder_Stocks_Monthly($year){
        if($year == false){$date = "YEAR(date_order)=".date('Y')."";}else{$date = "YEAR(date_order)=".$year."";}
        $data =false;  $total_subtotal = 0;$total_vat = 0;$total_shippingfee = 0;$total_amount = 0;
         $query = $this->db->select('*,DATE_FORMAT(date_order, "%M") as date_order')->from('tbl_salesorder_stocks')->where('status','A')->where($date)->group_by('MONTH(date_order)')->order_by('MONTH(date_order)','ASC')->get();
            if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                    $total =  $this->db->select('sum(amount) as subtotal')->from('tbl_salesorder_stocks_item')->where('so_no',$row->id)->get()->row();
                    $dis = 0;
                     if($row->discount !=0){$dis = floatval($row->discount/100);}
                    $discount = $total->subtotal*$dis;
                    $subtotal = $total->subtotal-$discount;
                    if($row->vat==1){$vat = $row->subtotal*0.12;$amount_due = floatval($total->subtotal - $row->downpayment + $row->shipping_fee + $vat);
                    }else{$vat = 0;$amount_due = floatval($total->subtotal - $row->downpayment + $row->shipping_fee);}
                     $data[] = array('si_no'      => $row->si_no,
                                    'vat'         => $row->vat,
                                    'subtotal'    => number_format($total->subtotal,2),
                                    'vat'         => number_format($vat,2),
                                    'shipping_fee'=> number_format($row->shipping_fee,2),
                                    'amount_due'  => number_format($amount_due,2),
                                    'date_created'=> $row->date_order);
                    $total_subtotal +=$total->subtotal;
                    $total_vat +=$vat;
                    $total_shippingfee +=$row->shipping_fee;
                    $total_amount +=$amount_due;
                }  
             }
              $data_response = array('result'=>$data,
                                    'total_subtotal'=>number_format($total_subtotal,2),
                                    'total_vat'=>number_format($total_vat,2),
                                    'total_shippingfee'=>number_format($total_shippingfee,2),
                                    'total_amount'=>number_format($total_amount,2));
             return $data_response;
     }
      function Account_Report_Salesorder_Stocks_Yearly($year){
           if($year == false){$date = "YEAR(date_order)<=".date('Y')."";}else{$date = "YEAR(date_order)<=".$year."";} 
            $data =false;  
            $total_subtotal = 0;
            $total_vat = 0;
            $total_shippingfee = 0;
            $total_amount = 0;
            $query = $this->db->select('*,DATE_FORMAT(date_order, "%Y") as date_order')->from('tbl_salesorder_stocks')->where('status','A')->where($date)->group_by('YEAR(date_order)')->order_by('YEAR(date_order)','ASC')->get();
            if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                    $total =  $this->db->select('sum(amount) as subtotal')->from('tbl_salesorder_stocks_item')->where('so_no',$row->id)->get()->row();
                    $dis = 0;
                     if($row->discount !=0){$dis = floatval($row->discount/100);}
                    $discount = $total->subtotal*$dis;
                    $subtotal = $total->subtotal-$discount;
                    if($row->vat==1){$vat = $row->subtotal*0.12;$amount_due = floatval($total->subtotal - $row->downpayment + $row->shipping_fee + $vat);
                    }else{$vat = 0;$amount_due = floatval($total->subtotal - $row->downpayment + $row->shipping_fee);}
                    $data[] = array('si_no'       => $row->si_no,
                                    'vat'         => $row->vat,
                                    'subtotal'    => number_format($total->subtotal,2),
                                    'vat'         => number_format($vat,2),
                                    'shipping_fee'=> number_format($row->shipping_fee,2),
                                    'amount_due'  => number_format($amount_due,2),
                                    'date_created'=> $row->date_order);
                    $total_subtotal +=$total->subtotal;
                    $total_vat +=$vat;
                    $total_shippingfee +=$row->shipping_fee;
                    $total_amount +=$amount_due;
                }  
             }  
             $data_response = array('result'=>$data,
                                    'total_subtotal'=>number_format($total_subtotal,2),
                                    'total_vat'=>number_format($total_vat,2),
                                    'total_shippingfee'=>number_format($total_shippingfee,2),
                                    'total_amount'=>number_format($total_amount,2));
             return $data_response;
     }

    function Account_Report_Salesorder_Project_Daily($month,$year){
        if($month == false || $year == false){$date = "MONTH(s.date_order)=".date('m')." AND YEAR(s.date_order)=".date('Y')."";}else{$date = "MONTH(s.date_order)=".$month." AND YEAR(s.date_order)=".$year."";}
        $data =false;  $total_subtotal = 0;$total_vat = 0;$total_shippingfee = 0;$total_amount = 0;
         $query = $this->db->select('s.*,c.*,DATE_FORMAT(s.date_order, "%M %d %Y") as date_order')
          ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
          ->where('s.status','A')->where($date)->get();
            if($query !== FALSE && $query->num_rows() > 0){
                foreach($query->result() as $row){
                $lineup = json_decode($row->item,true);
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
                   $data[] = array('si_no'       => $row->si_no,
                                   'customer'    => $row->fullname,
                                   'vat'         => $row->vat,
                                   'subtotal'    => number_format($subtotal,2),
                                   'vat'         => number_format($vat,2),
                                   'shipping_fee'=> number_format($row->shipping_fee,2),
                                   'amount_due'  => number_format($amount_due,2),
                                   'date_created'=> $row->date_order);
                    $total_subtotal +=$subtotal;
                    $total_vat +=$vat;
                    $total_shippingfee +=$row->shipping_fee;
                    $total_amount +=$amount_due;
               }
           }
             $data_response = array('result'=>$data,
                                    'total_subtotal'=>number_format($total_subtotal,2),
                                    'total_vat'=>number_format($total_vat,2),
                                    'total_shippingfee'=>number_format($total_shippingfee,2),
                                    'total_amount'=>number_format($total_amount,2));
             return $data_response;

     }
     function Account_Report_Salesorder_Project_Weekly($month,$year){
        if($month == false || $year == false){$date = "MONTH(date_order)=".date('m')." AND YEAR(date_order)=".date('Y')."";}else{$date = "MONTH(date_order)=".$month." AND YEAR(date_order)=".$year."";}
        $data =false;  $total_subtotal = 0;$total_vat = 0;$total_shippingfee = 0;$total_amount = 0;
         $query = $this->db->select('*,CONCAT("WEEK", " ",WEEK(date_order, 3) - WEEK(date_order - INTERVAL DAY(date_order)-1 DAY, 3) + 1) as date_order')->from('tbl_salesorder_project')->where('status','A')->where($date)->group_by('WEEK(date_order)')->order_by('WEEK(date_order)','ASC')->get();
            if($query !== FALSE && $query->num_rows() > 0){
                foreach($query->result() as $row){
                $lineup = json_decode($row->item,true);
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
                   $data[] = array('si_no'       => $row->si_no,
                                   'vat'         => $row->vat,
                                   'subtotal'    => number_format($subtotal,2),
                                   'vat'         => number_format($vat,2),
                                   'shipping_fee'=> number_format($row->shipping_fee,2),
                                   'amount_due'  => number_format($amount_due,2),
                                   'date_created'=> $row->date_order);
                    $total_subtotal +=$subtotal;
                    $total_vat +=$vat;
                    $total_shippingfee +=$row->shipping_fee;
                    $total_amount +=$amount_due;
               }
           }
             $data_response = array('result'=>$data,
                                    'total_subtotal'=>number_format($total_subtotal,2),
                                    'total_vat'=>number_format($total_vat,2),
                                    'total_shippingfee'=>number_format($total_shippingfee,2),
                                    'total_amount'=>number_format($total_amount,2));
             return $data_response;

     }
      function Account_Report_Salesorder_Project_Monthly($year){
        if($year == false){$date = "YEAR(date_order)=".date('Y')."";}else{$date = "YEAR(date_order)=".$year."";}
        $data =false;  $total_subtotal = 0;$total_vat = 0;$total_shippingfee = 0;$total_amount = 0;
         $query = $this->db->select('*,DATE_FORMAT(date_order, "%M") as date_order')->from('tbl_salesorder_project')->where('status','A')->where($date)->group_by('MONTH(date_order)')->order_by('MONTH(date_order)','ASC')->get();
            if($query !== FALSE && $query->num_rows() > 0){
                foreach($query->result() as $row){
                $lineup = json_decode($row->item,true);
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
                   $data[] = array('si_no'       => $row->si_no,
                                   'vat'         => $row->vat,
                                   'subtotal'    => number_format($subtotal,2),
                                   'vat'         => number_format($vat,2),
                                   'shipping_fee'=> number_format($row->shipping_fee,2),
                                   'amount_due'  => number_format($amount_due,2),
                                   'date_created'=> $row->date_order);
                    $total_subtotal +=$subtotal;
                    $total_vat +=$vat;
                    $total_shippingfee +=$row->shipping_fee;
                    $total_amount +=$amount_due;
               }
           }
             $data_response = array('result'=>$data,
                                    'total_subtotal'=>number_format($total_subtotal,2),
                                    'total_vat'=>number_format($total_vat,2),
                                    'total_shippingfee'=>number_format($total_shippingfee,2),
                                    'total_amount'=>number_format($total_amount,2));
             return $data_response;

     }
      function Account_Report_Salesorder_Project_Yearly($year){
        if($year == false){$date = "YEAR(date_order)=".date('Y')."";}else{$date = "YEAR(date_order)=".$year."";}
        $data =false;  $total_subtotal = 0;$total_vat = 0;$total_shippingfee = 0;$total_amount = 0;
        $query = $this->db->select('*,DATE_FORMAT(date_order, "%Y") as date_order')->from('tbl_salesorder_project')->where('status','A')->where($date)->group_by('YEAR(date_order)')->order_by('YEAR(date_order)','ASC')->get();
            if($query !== FALSE && $query->num_rows() > 0){
                foreach($query->result() as $row){
                $lineup = json_decode($row->item,true);
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
                   $data[] = array('si_no'       => $row->si_no,
                                   'vat'         => $row->vat,
                                   'subtotal'    => number_format($subtotal,2),
                                   'vat'         => number_format($vat,2),
                                   'shipping_fee'=> number_format($row->shipping_fee,2),
                                   'amount_due'  => number_format($amount_due,2),
                                   'date_created'=> $row->date_order);
                    $total_subtotal +=$subtotal;
                    $total_vat +=$vat;
                    $total_shippingfee +=$row->shipping_fee;
                    $total_amount +=$amount_due;
               }
           }
             $data_response = array('result'=>$data,
                                    'total_subtotal'=>number_format($total_subtotal,2),
                                    'total_vat'=>number_format($total_vat,2),
                                    'total_shippingfee'=>number_format($total_shippingfee,2),
                                    'total_amount'=>number_format($total_amount,2));
             return $data_response;
     }
      function Account_Report_Project_Daily($year,$month){
            if($month == false || $year == false){
                $date = "MONTH(date_received)=".date('m')." AND YEAR(date_received)=".date('Y')."";
            }else{
                $date = "MONTH(date_received)=".$month." AND YEAR(date_received)=".$year."";
            }   
            $query = $this->db->select('*,DATE_FORMAT(date_received, "%M %d %Y") as date_created,
                 IF(update_pettycash=0, pettycash,update_pettycash) as pettycash,
                 (SELECT SUM(IF(update_pettycash = 0,  update_pettycash, pettycash)) FROM tbl_pettycash WHERE status="COMPLETE" AND '.$date.') as total_pettycash')->from('tbl_pettycash')->where($where)->where('status','COMPLETE')->where('type',1)->get();
              if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row)  {
                 $gross = $row->total_amount / 1.12;
                 $vat = $gross*0.12;
                 $total_vat = $row->total_gross*0.12;
                 $data[] = array(
                            'cashfund'          => $row->fund_no,
                            'pettycash'         => number_format($row->pettycash,2),
                            'change'            => number_format($row->actual_change,2),
                            'refund'            => number_format($row->refund,2),
                            'gross'             => number_format($gross,2),
                            'vat'               => number_format($vat,2),
                            'amount'            => number_format($row->total_amount,2),
                            'date_created'      => $row->date_created);
                }  
             }else{   
                 $data =false;   
             }
             $json_data  = array("data" =>$data); 
             return $json_data;
     }  
     function Account_Report_Project_Weekly($year,$month){
            if($month == false || $year == false){
                $where = array('MONTH(date_received)'=> date('m'), 'YEAR(date_received)'=> date('Y'));
                $date = "MONTH(date_received)=".date('m')." AND YEAR(date_received)=".date('Y')."";
            }else{
                $where = array('MONTH(date_received)'=>$month,'YEAR(date_received)'=> $year);
                $date = "MONTH(date_received)=".$month." AND YEAR(date_received)=".$year."";
            }   
            $query = $this->db->select('*,CONCAT("WEEK", " ",WEEK(date_received, 3) - WEEK(date_received - INTERVAL DAY(date_received)-1 DAY, 3) + 1)
                      as date_created,
                 IF(update_pettycash=0, update_pettycash,pettycash) as pettycash,
                 (SELECT sum(total_amount/1.12) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND '.$date.') as total_gross,
                 (SELECT sum(total_amount) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND  '.$date.') as total_grand,
                 (SELECT sum(actual_change) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND  '.$date.') as total_change,
                 (SELECT sum(refund) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND '.$date.') as total_refund,
                 (SELECT SUM(IF(update_pettycash = 0,  update_pettycash, pettycash)) FROM tbl_pettycash WHERE status="COMPLETE" AND '.$date.') as total_pettycash')->from('tbl_pettycash')->where($where)->where('status','COMPLETE')->where('type',1)->group_by('WEEK(date_received)')
                 ->order_by('WEEK(date_received)','ASC')->get();
              if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row)  
                {
                 $gross = $row->total_amount / 1.12;
                 $vat = $gross*0.12;
                 $total_vat = $row->total_gross*0.12;
                 $data[] = array(
                            'cashfund'          => $row->fund_no,
                            'production_no'     => $row->production_no,
                            'pettycash'         => number_format($row->pettycash,2),
                            'change'            => number_format($row->actual_change,2),
                            'refund'            => number_format($row->refund,2),
                            'gross'             => number_format($gross,2),
                            'vat'               => number_format($vat,2),
                            'amount'            => number_format($row->total_amount,2),
                            'total_pettycash'   => number_format($row->total_pettycash,2),
                            'total_change'      => number_format($row->total_change,2),
                            'total_refund'      => number_format($row->total_refund,2),
                            'total_gross'       => number_format($row->total_gross,2),
                            'total_vat'         => number_format($total_vat,2),
                            'total_amount'      => number_format($row->total_grand,2),
                            'date_created'      => $row->date_created);
                }  
             }else{   
                 $data =false;   
             }
             $json_data  = array("data" =>$data); 
             return $json_data;
     }
     function Account_Report_Project_Monthly($year,$month){
            if($month == false || $year == false){
                $where = array('MONTH(date_received)'=> date('m'), 'YEAR(date_received)'=> date('Y'));
                $date = "MONTH(date_received)=".date('m')." AND YEAR(date_received)=".date('Y')."";
            }else{
                $where = array('MONTH(date_received)'=>$month,'YEAR(date_received)'=> $year);
                $date = "MONTH(date_received)=".$month." AND YEAR(date_received)=".$year."";
            }   
            $query = $this->db->select('*, DATE_FORMAT(date_received, "%M") as date_created,
                 IF(update_pettycash=0, update_pettycash,pettycash) as pettycash,
                 (SELECT sum(total_amount/1.12) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND '.$date.') as total_gross,
                 (SELECT sum(total_amount) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND  '.$date.') as total_grand,
                 (SELECT sum(actual_change) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND  '.$date.') as total_change,
                 (SELECT sum(refund) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND '.$date.') as total_refund,
                 (SELECT SUM(IF(update_pettycash = 0,  update_pettycash, pettycash)) FROM tbl_pettycash WHERE status="COMPLETE" AND '.$date.') as total_pettycash')->from('tbl_pettycash')->where($where)->where('status','COMPLETE')->where('type',1)->group_by('MONTH(date_received)')
                 ->order_by('MONTH(date_received)','ASC')->get();
              if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row)  
                {
                 $gross = $row->total_amount / 1.12;
                 $vat = $gross*0.12;
                 $total_vat = $row->total_gross*0.12;
                 $data[] = array(
                            'cashfund'          => $row->fund_no,
                            'production_no'     => $row->production_no,
                            'pettycash'         => number_format($row->pettycash,2),
                            'change'            => number_format($row->actual_change,2),
                            'refund'            => number_format($row->refund,2),
                            'gross'             => number_format($gross,2),
                            'vat'               => number_format($vat,2),
                            'amount'            => number_format($row->total_amount,2),
                            'total_pettycash'   => number_format($row->total_pettycash,2),
                            'total_change'      => number_format($row->total_change,2),
                            'total_refund'      => number_format($row->total_refund,2),
                            'total_gross'       => number_format($row->total_gross,2),
                            'total_vat'         => number_format($total_vat,2),
                            'total_amount'      => number_format($row->total_grand,2),
                            'date_created'      => $row->date_created);
                }  
             }else{   
                 $data =false;   
             }
             $json_data  = array("data" =>$data); 
             return $json_data;
     }  
      function Account_Report_Project_Yearly($year){
            if($year == false){
                $where = array('YEAR(date_received) <='=> date('Y'));
                $date = "YEAR(date_received)<=".date('Y')."";
            }else{
                $where = array('YEAR(date_received)'=> $year);
                $date = "YEAR(date_received)<=".$year."";
            } 
            $query = $this->db->select('*, DATE_FORMAT(date_received, "%Y") as date_created,
                 IF(update_pettycash=0, update_pettycash,pettycash) as pettycash,
                 (SELECT sum(total_amount/1.12) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND '.$date.') as total_gross,
                 (SELECT sum(total_amount) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND  '.$date.') as total_grand,
                 (SELECT sum(actual_change) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND  '.$date.') as total_change,
                 (SELECT sum(refund) FROM tbl_pettycash WHERE status="COMPLETE" AND type=1 AND '.$date.') as total_refund,
                 (SELECT SUM(IF(update_pettycash = 0,  update_pettycash, pettycash)) FROM tbl_pettycash WHERE status="COMPLETE" AND '.$date.') as total_pettycash')->from('tbl_pettycash')->where($where)->where('status','COMPLETE')->where('type',1)->group_by('YEAR(date_received)')
                 ->order_by('YEAR(date_received)','ASC')->get();
              if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 $gross = $row->total_amount / 1.12;
                 $vat = $gross*0.12;
                 $total_vat = $row->total_gross*0.12;
                 $data[] = array(
                            'cashfund'          => $row->fund_no,
                            'production_no'     => $row->production_no,
                            'pettycash'         => number_format($row->pettycash,2),
                            'change'            => number_format($row->actual_change,2),
                            'refund'            => number_format($row->refund,2),
                            'gross'             => number_format($gross,2),
                            'vat'               => number_format($vat,2),
                            'amount'            => number_format($row->total_amount,2),
                            'total_pettycash'   => number_format($row->total_pettycash,2),
                            'total_change'      => number_format($row->total_change,2),
                            'total_refund'      => number_format($row->total_refund,2),
                            'total_gross'       => number_format($row->total_gross,2),
                            'total_vat'         => number_format($total_vat,2),
                            'total_amount'      => number_format($row->total_grand,2),
                            'date_created'      => $row->date_created);
                }  
             }else{$data =false;}
             $json_data  = array("data" =>$data); 
             return $json_data;
     }  
    function Account_Report_Income_Monthly($year,$month){
       if($year == false){
            $years = date('Y');
        }else{
            $years = $year;
        }
        $query_sales = $this->db->select('sum(IF(MONTH(date_position) = 1, amount,0)) as jan,sum(IF(MONTH(date_position) = 2, amount,0)) as feb,sum(IF(MONTH(date_position) = 3, amount,0)) as march,sum(IF(MONTH(date_position) = 4, amount,0)) as apr,sum(IF(MONTH(date_position) = 5, amount,0)) as may,sum(IF(MONTH(date_position) = 6, amount,0)) as june,sum(IF(MONTH(date_position) = 7, amount,0)) as july,sum(IF(MONTH(date_position) = 8, amount,0)) as aug,sum(IF(MONTH(date_position) = 9, amount,0)) as sept,sum(IF(MONTH(date_position) = 10,amount,0)) as oct,sum(IF(MONTH(date_position) = 11,amount,0)) as nov,sum(IF(MONTH(date_position) = 12,amount,0)) as decs,sum(amount) as year')->from('tbl_cash_position')->where('cat_id',1)->where('YEAR(date_position)',$years)->get();
        $row_sales = $query_sales->row();

        if($row_sales->jan){ $sales_jan = number_format($row_sales->jan,2);}else{ $sales_jan = '-';}
        if($row_sales->feb){ $sales_feb = number_format($row_sales->feb,2);}else{ $sales_feb = '-';}
        if($row_sales->march){ $sales_march = number_format($row_sales->march,2);}else{ $sales_march = '-';}
        if($row_sales->apr){ $sales_apr = number_format($row_sales->apr,2);}else{ $sales_apr = '-';}
        if($row_sales->may){ $sales_may = number_format($row_sales->may,2);}else{ $sales_may = '-';}
        if($row_sales->june){ $sales_june = number_format($row_sales->june,2);}else{ $sales_june = '-';}
        if($row_sales->july){ $sales_july = number_format($row_sales->july,2);}else{ $sales_july = '-';}
        if($row_sales->aug){ $sales_aug = number_format($row_sales->aug,2);}else{ $sales_aug = '-';}
        if($row_sales->sept){ $sales_sept = number_format($row_sales->sept,2);}else{ $sales_sept = '-';}
        if($row_sales->oct){ $sales_oct = number_format($row_sales->oct,2);}else{ $sales_oct = '-';}
        if($row_sales->nov){ $sales_nov = number_format($row_sales->nov,2);}else{ $sales_nov = '-';}
        if($row_sales->decs){ $sales_dec = number_format($row_sales->decs,2);}else{ $sales_dec = '-';}
        $data_array['year'] = $years;
        $data_array['sales'] = array('jan' => $sales_jan,'feb'=>$sales_feb,'march'=>$sales_march,'apr'=>$sales_apr,'may'=> $sales_may,'june'=>$sales_june,'july'=>$sales_july,'aug'=>$sales_aug,'sept'=>$sales_sept,'oct'=>$sales_oct,'nov'=>$sales_nov,'dec'=>$sales_dec,'year'=>number_format($row_sales->year,2));
        $where = array(1, 2, 15);
        $query = $this->db->select('name,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 01 AND YEAR(date_position) = '.$years.') AS total_jan,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 02 AND YEAR(date_position) = '.$years.') AS total_feb,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 03 AND YEAR(date_position) = '.$years.') AS total_march,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 04 AND YEAR(date_position) = '.$years.') AS total_apr,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 05 AND YEAR(date_position) = '.$years.') AS total_may,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 06 AND YEAR(date_position) = '.$years.') AS total_june,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 07 AND YEAR(date_position) = '.$years.') AS total_july,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 08 AND YEAR(date_position) = '.$years.') AS total_aug,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 09 AND YEAR(date_position) = '.$years.') AS total_sept,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 10 AND YEAR(date_position) = '.$years.') AS total_oct,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 11 AND YEAR(date_position) = '.$years.') AS total_nov,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND  MONTH(date_position) = 12 AND YEAR(date_position) = '.$years.') AS total_decs,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id NOT IN (1,2,15) AND YEAR(date_position) = '.$years.') AS year_grandtotal,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND YEAR(date_position) = '.$years.') AS year_total,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 01 AND YEAR(date_position) = '.$years.') AS jan,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 02 AND YEAR(date_position) = '.$years.') AS feb,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 03 AND YEAR(date_position) = '.$years.') AS march,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 04 AND YEAR(date_position) = '.$years.') AS apr,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 05 AND YEAR(date_position) = '.$years.') AS may,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 06 AND YEAR(date_position) = '.$years.') AS june,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 07 AND YEAR(date_position) = '.$years.') AS july,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 08 AND YEAR(date_position) = '.$years.') AS aug,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 09 AND YEAR(date_position) = '.$years.') AS sept,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 10 AND YEAR(date_position) = '.$years.') AS oct,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 11 AND YEAR(date_position) = '.$years.') AS nov,
            (SELECT sum(amount) FROM tbl_cash_position WHERE cat_id=tbl_category_income.id AND MONTH(date_position) = 12 AND YEAR(date_position) = '.$years.') AS decs')->from('tbl_category_income')->where_not_in('id',$where)->get();
         foreach($query->result() as $row){
            if($row->jan !=0){$jan= number_format((float)$row->jan,2);}else{$jan= '-';}
            if($row->feb !=0){$feb= number_format((float)$row->feb,2);}else{$feb= '-';}
            if($row->march !=0){$march= number_format((float)$row->march,2);}else{$march= '-';}
            if($row->apr !=0){$apr= number_format((float)$row->apr,2);}else{$apr= '-';}
            if($row->may !=0){$may= number_format((float)$row->may,2);}else{$may= '-';}
            if($row->june !=0){$june= number_format((float)$row->june,2);}else{$june= '-';}
            if($row->july !=0){$july= number_format((float)$row->july,2);}else{$july= '-';}
            if($row->aug !=0){$aug= number_format((float)$row->aug,2);}else{$aug= '-';}
            if($row->sept !=0){$sept= number_format((float)$row->sept,2);}else{$sept= '-';}
            if($row->oct !=0){$oct= number_format((float)$row->oct,2);}else{$oct= '-';}
            if($row->nov !=0){$nov= number_format((float)$row->nov,2);}else{$nov= '-';}
            if($row->decs !=0){$dec= number_format((float)$row->decs,2);}else{$dec= '-';}
            $total_sales_jan = $row_sales->jan-$row->total_jan;
            $total_sales_feb = $row_sales->feb-$row->total_feb;
            $total_sales_march = $row_sales->march-$row->total_march;
            $total_sales_apr = $row_sales->apr-$row->total_apr;
            $total_sales_may = $row_sales->may-$row->total_may;
            $total_sales_june = $row_sales->june-$row->total_june;
            $total_sales_july = $row_sales->july-$row->total_july;
            $total_sales_aug = $row_sales->sept-$row->total_aug;
            $total_sales_sept = $row_sales->aug-$row->total_sept;
            $total_sales_oct = $row_sales->oct-$row->total_oct;
            $total_sales_nov = $row_sales->nov-$row->total_nov;
            $total_sales_decs = $row_sales->decs-$row->total_decs;
            $year_sales_grandtotal = $row_sales->year-$row->year_grandtotal;
            if($total_sales_jan !=0){$total_jan= number_format((float)$total_sales_jan,2);}else{$total_jan= '-';}
            if($total_sales_feb !=0){$total_feb= number_format((float)$total_sales_feb,2);}else{$total_feb= '-';}
            if($total_sales_march !=0){$total_march= number_format((float)$total_sales_march,2);}else{$total_march= '-';}
            if($total_sales_apr !=0){$total_apr= number_format((float)$total_sales_apr,2);}else{$total_apr= '-';}
            if($total_sales_may !=0){$total_may= number_format((float)$total_sales_may,2);}else{$total_may= '-';}
            if($total_sales_june !=0){$total_june= number_format((float)$total_sales_june,2);}else{$total_june= '-';}
            if($total_sales_july !=0){$total_july= number_format((float)$total_sales_july,2);}else{$total_july= '-';}
            if($total_sales_aug !=0){$total_aug= number_format((float)$total_sales_aug,2);}else{$total_aug= '-';}
            if($total_sales_sept !=0){$total_sept= number_format((float)$total_sales_sept,2);}else{$total_sept= '-';}
            if($total_sales_oct !=0){$total_oct= number_format((float)$total_sales_oct,2);}else{$total_oct= '-';}
            if($total_sales_nov !=0){$total_nov= number_format((float)$total_sales_nov,2);}else{$total_nov= '-';}
            if($total_sales_decs !=0){$total_dec= number_format((float)$total_sales_decs,2);}else{$total_dec= '-';}
            if($row->year_total !=0){$year_total= number_format((float)$row->year_total,2);}else{$year_total= '-';}
            if($year_sales_grandtotal !=0){$year_grandtotal= number_format((float)$year_sales_grandtotal,2);}else{$year_grandtotal= '-';}
            $data_array['expenses'][] = array('name'=>$row->name,'jan'=> $jan,'feb' => $feb,'march'=>$march,'apr'=>$apr,'may'=>$may,'june'=>$june,'july'=>$july,'aug'=>$aug,'sept'=>$sept,'oct'=>$oct,'nov'=>$nov,'dec'=>$dec,'total_jan'=>$total_jan,'total_feb'=>$total_feb,'total_march'=>$total_march,'total_apr'=>$total_apr,'total_may'=>$total_may,'total_june'=>$total_june,'total_july'=>$total_july,'total_aug'=>$total_aug,'total_sept'=>$total_sept,'total_oct'=>$total_oct,'total_nov'=>$total_nov,'total_dec'=>$total_dec,'year_total'=>$year_total,'year_grandtotal'=>$year_grandtotal);
         }
        return $data_array;
    }   
    function Account_Report_Cashposition_Weekly($year,$month){
        error_reporting(0);
        if($month == false || $year == false){
            $start_date = date('Y-m-01');
            $data_month['month']  = date('F');
            $data_year['year'] = date('Y');
        }else{
            $start_date = date("Y-m", strtotime($year."-".$month))."-01";
            $data_month['month'] = date("F", mktime(0, 0, 0, $month, 10));
            $data_year['year'] = $year;
        }
       $start_time = strtotime($start_date);

       $month_beginning = date("Y-m-d", strtotime("-1 month", $beginning_date)); 

       $week1 = date("Y-m-d", strtotime("+1 week", $start_time)); 
       $week2 = date("Y-m-d", strtotime("+2 week", $start_time)); 
       $week3 = date("Y-m-d", strtotime("+3 week", $start_time)); 
       $week4 = date("Y-m-d", strtotime("+4 week", $start_time));
       
       $current     = strtotime($start_date);
       $first_week  = strtotime($week1);
       $second_week = strtotime($week2);
       $third_week  = strtotime($week3);
       $fourth_week = strtotime($week4);

       $data_week1 = array();
       $data_week2 = array();
       $data_week3 = array();
       $data_week4 = array();

       $data = array();

        while($current < $first_week ){
            $data_week1[] = date('Y-m-d', $current);
            $current = strtotime("+1 day", $current);
        }
        while($first_week < $second_week ) {
            $data_week2[] = date('Y-m-d', $first_week);
            $first_week = strtotime("+1 day", $first_week);
        }
        while($second_week < $third_week ) {
            $data_week3[] = date('Y-m-d', $second_week);
            $second_week = strtotime("+1 day", $second_week);
        }
        while($third_week <= $fourth_week ) {
            $third_week = strtotime("+1 day", $third_week);
            $data_week4[] = date('Y-m-d', $third_week);
        }

        $week4_start = date("Y-m-d", strtotime("+3 week", $start_time)); 
        $week4_end = date("Y-m-t", strtotime($start_date));
    
        $query_beginning1 = $this->db->select('sum(amount) as beginning')->from('tbl_cash_position')->where('type',2)->where('date_position < ',$start_date)->get();
        $row_beginning1 = $query_beginning1->row();

        $query_beginning2 = $this->db->select('sum(amount) as beginning')->from('tbl_cash_position')->where('type',1)->where('date_position < ',$start_date)->get();
        $row_beginning2 = $query_beginning2->row();

        $data['beginning'] = number_format($row_beginning1->beginning-$row_beginning2->beginning,2);

     
        $querless_week1 = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week1)->where('type',1)->get();
        $row_wk1_less = $querless_week1->row();
        $queryadd_week1 = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week1)->where('type',2)->get();
        $row_wk1_add = $queryadd_week1->row();

        $queryless_week2 = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week2)->where('type',1)->get();
        $row_wk2_less = $queryless_week2->row();

        $queryadd_week2 = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week2)->where('type',2)->get();
        $row_wk2_add = $queryadd_week2->row();

        $queryless_week3 = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week3)->where('type',1)->get();
        $row_wk3_less = $queryless_week3->row();
        $queryadd_week3 = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where_in('date_position',$data_week3)->where('type',2)->get();
        $row_wk3_add = $queryadd_week3->row();

        $queryless_week4 = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where('date_position BETWEEN "'.$week4_start.'" AND "'.$week4_end.'"')->where('type',1)->get();
        $row_wk4_less = $queryless_week4->row();
        $queryadd_week4 = $this->db->select('sum(amount) as amount')->from('tbl_cash_position')->where('date_position BETWEEN "'.$week4_start.'" AND "'.$week4_end.'"')->where('type',2)->get();
        $row_wk4_add = $queryadd_week4->row();


        $data['week1_less'] = number_format($row_wk1_less->amount,2);
        $data['week1_add'] = number_format($row_wk1_add->amount,2);

        $data['week2_less'] = number_format($row_wk2_less->amount,2);
        $data['week2_add'] = number_format($row_wk2_add->amount,2);

        $data['week3_less'] = number_format($row_wk3_less->amount,2);
        $data['week3_add'] = number_format($row_wk3_add->amount,2);

        $data['week4_less'] = number_format($row_wk4_less->amount,2);
        $data['week4_add'] = number_format($row_wk4_add->amount,2);

        $total_balanced1 = $row_beginning1->beginning - $row_beginning2->beginning + $row_wk1_add->amount - $row_wk1_less->amount;

        $total_balanced2 = $total_balanced1 +$row_wk2_add->amount - $row_wk2_less->amount;

        $total_balanced3 = $total_balanced2 +$row_wk3_add->amount - $row_wk3_less->amount;

        $total_balanced4 = $total_balanced3 +$row_wk4_add->amount - $row_wk4_less->amount;

        $data['balanced1'] =  number_format($total_balanced1,2);
        $data['balanced2'] =  number_format($total_balanced2,2);
        $data['balanced3'] =  number_format($total_balanced3,2);
        $data['balanced4'] =  number_format($total_balanced4,2);

        $query_week1 = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where_in('date_position',$data_week1)->get();
        foreach($query_week1->result() as $row){
            if($row->type == 1){
                 $data['week1_type1'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'count'         => $row->id,
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2),
                                                'cat_id'        => $row->cat_id,
                                                'type'          => $row->type);
            }else{
                 $data['week1_type2'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'count'         => $row->id,
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2),
                                                'cat_id'        => $row->cat_id,
                                                'type'          => $row->type);
            }
          
        }

         $query_week2 = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where_in('date_position',$data_week2)->get();
        foreach($query_week2->result() as $row){
             if($row->type == 1){
                 $data['week2_type1'][] = array( 'id'            => $this->encryption->encrypt($row->id),
                                                 'count'         => $row->id,
                                                 'date'          => $row->date_position,
                                                 'date_position' => $row->date_created,
                                                 'name'          => $row->name,
                                                 'amount'        => number_format($row->amount,2),
                                                 'cat_id'        => $row->cat_id,
                                                 'type'          => $row->type);
            }else{
                 $data['week2_type2'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'count'         => $row->id,
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2),
                                                'cat_id'        => $row->cat_id,
                                                'type'          => $row->type);
            }
        }
        $query_week3 = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where_in('date_position',$data_week3)->get();
        foreach($query_week3->result() as $row){
            if($row->type == 1){
                 $data['week3_type1'][] = array( 'id'            => $this->encryption->encrypt($row->id),
                                                 'count'         => $row->id,
                                                 'date'          => $row->date_position,
                                                 'date_position' => $row->date_created,
                                                 'name'          => $row->name,
                                                 'amount'        => number_format($row->amount,2),
                                                 'cat_id'        => $row->cat_id,
                                                 'type'          => $row->type);
            }else{
                 $data['week3_type2'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'count'         => $row->id,
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2),
                                                'cat_id'        => $row->cat_id,
                                                'type'          => $row->type);
            }
        }
        $query_week4 = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('date_position BETWEEN "'.$week4_start.'" AND "'.$week4_end.'"')->get();
        foreach($query_week4->result() as $row){
            if($row->type == 1){
                 $data['week4_type1'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'count'         => $row->id,
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2),
                                                'cat_id'        => $row->cat_id,
                                                'type'          => $row->type);
            }else{
                 $data['week4_type2'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'count'         => $row->id,
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2),
                                                'cat_id'        => $row->cat_id,
                                                'type'          => $row->type);
            }
        }
        return array_merge($data_month,$data_year,$data);
    }

      function Account_Report_Cashposition_Monthly($year){
        error_reporting(0);
        if($year == false){
            $year_filter = date('Y');
        }else{
            $year_filter = $year;
        }
        $data['year'] = $year_filter;
        $query = $this->db->select('
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND YEAR(date_position) < '.$year_filter.') as beginning_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND YEAR(date_position) < '.$year_filter.') as beginning_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "01" AND YEAR(date_position) = '.$year_filter.') as jan_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "01" AND YEAR(date_position) = '.$year_filter.') as jan_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "02" AND YEAR(date_position) = '.$year_filter.') as feb_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "02" AND YEAR(date_position) = '.$year_filter.') as feb_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "03" AND YEAR(date_position) = '.$year_filter.') as march_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "03" AND YEAR(date_position) = '.$year_filter.') as march_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "04" AND YEAR(date_position) = '.$year_filter.') as april_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "04" AND YEAR(date_position) = '.$year_filter.') as april_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "05" AND YEAR(date_position) = '.$year_filter.') as may_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "05" AND YEAR(date_position) = '.$year_filter.') as may_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "06" AND YEAR(date_position) = '.$year_filter.') as june_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "06" AND YEAR(date_position) = '.$year_filter.') as june_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "07" AND YEAR(date_position) = '.$year_filter.') as july_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "07" AND YEAR(date_position) = '.$year_filter.') as july_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "08" AND YEAR(date_position) = '.$year_filter.') as august_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "08" AND YEAR(date_position) = '.$year_filter.') as august_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "09" AND YEAR(date_position) = '.$year_filter.') as sept_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "09" AND YEAR(date_position) = '.$year_filter.') as sept_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "10" AND YEAR(date_position) = '.$year_filter.') as oct_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "10" AND YEAR(date_position) = '.$year_filter.') as oct_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "11" AND YEAR(date_position) = '.$year_filter.') as nov_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "11" AND YEAR(date_position) = '.$year_filter.') as nov_add,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=1 AND MONTH(date_position) = "12" AND YEAR(date_position) = '.$year_filter.') as dec_less,
                 (SELECT sum(amount) FROM tbl_cash_position WHERE type=2 AND MONTH(date_position) = "12" AND YEAR(date_position) = '.$year_filter.') as dec_add
                    ')->from('tbl_cash_position')->get();
        $row_balanced = $query->row();

        $jan_total_balanced   = $row_balanced->beginning_add - $row_beginning2->row_balanced_less + $row_balanced->jan_add - $row_balanced->jan_less;
        $feb_total_balanced   = $jan_total_balanced + $row_balanced->feb_add - $row_balanced->feb_less;
        $march_total_balanced = $feb_total_balanced + $row_balanced->march_add - $row_balanced->march_less;
        $april_total_balanced = $march_total_balanced + $row_balanced->april_add - $row_balanced->april_less;
        $may_total_balanced   = $april_total_balanced + $row_balanced->may_add - $row_balanced->may_less;
        $june_total_balanced  = $may_total_balanced + $row_balanced->june_add - $row_balanced->june_less;
        $july_total_balanced  = $june_total_balanced + $row_balanced->july_add - $row_balanced->july_less;
        $august_total_balanced= $july_total_balanced + $row_balanced->august_add - $row_balanced->august_less;
        $sept_total_balanced  = $august_total_balanced + $row_balanced->sept_add - $row_balanced->sept_less;
        $oct_total_balanced   = $sept_total_balanced + $row_balanced->oct_add - $row_balanced->oct_less;
        $nov_total_balanced   = $oct_total_balanced + $row_balanced->nov_add - $row_balanced->nov_less;
        $dec_total_balanced   = $nov_total_balanced + $row_balanced->dec_add - $row_balanced->dec_less;



        $data['beginning'] = number_format($row_balanced->beginning_add-$row_balanced->beginning_less,2);
        $data['jan_balanced'] = number_format($jan_total_balanced,2);  
        $data['jan_less_total'] = number_format($row_balanced->jan_less,2);
        $data['jan_add_total'] = number_format($row_balanced->jan_add,2);

        $data['feb_balanced'] = number_format($feb_total_balanced,2);  
        $data['feb_less_total'] = number_format($row_balanced->feb_less,2);
        $data['feb_add_total'] = number_format($row_balanced->feb_add,2);

        $data['march_balanced'] = number_format($march_total_balanced,2);  
        $data['march_less_total'] = number_format($row_balanced->march_less,2);
        $data['march_add_total'] = number_format($row_balanced->march_add,2);

        $data['april_balanced'] = number_format($april_total_balanced,2);  
        $data['april_less_total'] = number_format($row_balanced->april_less,2);
        $data['april_add_total'] = number_format($row_balanced->april_add,2);

        $data['may_balanced'] = number_format($may_total_balanced,2);  
        $data['may_less_total'] = number_format($row_balanced->may_less,2);
        $data['may_add_total'] = number_format($row_balanced->may_add,2);

        $data['june_balanced'] = number_format($june_total_balanced,2);  
        $data['june_less_total'] = number_format($row_balanced->june_less,2);
        $data['june_add_total'] = number_format($row_balanced->june_add,2);

        $data['july_balanced'] = number_format($july_total_balanced,2);  
        $data['july_less_total'] = number_format($row_balanced->july_less,2);
        $data['july_add_total'] = number_format($row_balanced->july_add,2);

        $data['august_balanced'] = number_format($august_total_balanced,2);  
        $data['august_less_total'] = number_format($row_balanced->august_less,2);
        $data['august_add_total'] = number_format($row_balanced->august_add,2);

        $data['sept_balanced'] = number_format($sept_total_balanced,2);  
        $data['sept_less_total'] = number_format($row_balanced->sept_less,2);
        $data['sept_add_total'] = number_format($row_balanced->sept_add,2);

        $data['oct_balanced'] = number_format($oct_total_balanced,2);  
        $data['oct_less_total'] = number_format($row_balanced->oct_less,2);
        $data['oct_add_total'] = number_format($row_balanced->oct_add,2);

        $data['nov_balanced'] = number_format($nov_total_balanced,2);  
        $data['nov_less_total'] = number_format($row_balanced->nov_less,2);
        $data['nov_add_total'] = number_format($row_balanced->nov_add,2);

        $data['dec_balanced'] = number_format($dec_total_balanced,2);  
        $data['dec_less_total'] = number_format($row_balanced->dec_less,2);
        $data['dec_add_total'] = number_format($row_balanced->dec_add,2);

        $query_jan = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "01" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_jan !== FALSE && $query_jan->num_rows() > 0){
            foreach($query_jan->result() as $row){
                if($row->type == 1){
                     $data['jan_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['jan_add'][] = array('id'        => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }

        $query_feb = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "02" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_feb !== FALSE && $query_feb->num_rows() > 0){
            foreach($query_feb->result() as $row){
                if($row->type == 1){
                     $data['feb_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['feb_add'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }

        $query_march = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "03" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_march !== FALSE && $query_march->num_rows() > 0){
            foreach($query_march->result() as $row){
                if($row->type == 1){
                     $data['march_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['march_add'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }

        $query_april = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "04" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_april !== FALSE && $query_april->num_rows() > 0){
            foreach($query_april->result() as $row){
                if($row->type == 1){
                     $data['april_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['april_add'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }

         $query_may = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "05" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_may !== FALSE && $query_may->num_rows() > 0){
            foreach($query_may->result() as $row){
                if($row->type == 1){
                     $data['may_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['may_add'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }
        $query_june = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "06" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_june !== FALSE && $query_june->num_rows() > 0){
            foreach($query_june->result() as $row){
                if($row->type == 1){
                     $data['june_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['june_add'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }

        $query_july = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "07" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_july !== FALSE && $query_july->num_rows() > 0){
            foreach($query_july->result() as $row){
                if($row->type == 1){
                     $data['july_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['july_add'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }

        $query_august = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "08" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_august !== FALSE && $query_august->num_rows() > 0){
            foreach($query_august->result() as $row){
                if($row->type == 1){
                     $data['august_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['august_add'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }

        $query_sept = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "09" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_sept !== FALSE && $query_sept->num_rows() > 0){
            foreach($query_sept->result() as $row){
                if($row->type == 1){
                     $data['sept_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['sept_add'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }

        $query_oct = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "10" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_oct !== FALSE && $query_oct->num_rows() > 0){
            foreach($query_oct->result() as $row){
                if($row->type == 1){
                     $data['oct_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['oct_add'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }

        $query_nov = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "11" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_nov !== FALSE && $query_nov->num_rows() > 0){
            foreach($query_nov->result() as $row){
                if($row->type == 1){
                     $data['nov_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['nov_add'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }

        $query_dec = $this->db->select('*,DATE_FORMAT(date_position, "%b - %e") as date_created,DATE_FORMAT(date_position, "%m/%d/%Y") as date_position')->from('tbl_cash_position')->where('MONTH(date_position) = "12" AND YEAR(date_position) = "'.$year_filter.'"')->get();
        if($query_dec !== FALSE && $query_dec->num_rows() > 0){
            foreach($query_dec->result() as $row){
                if($row->type == 1){
                     $data['dec_less'][] = array('id'           => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }else{
                     $data['dec_add'][] = array('id'            => $this->encryption->encrypt($row->id),
                                                'date'          => $row->date_position,
                                                'date_position' => $row->date_created,
                                                'name'          => $row->name,
                                                'amount'        => number_format($row->amount,2));
                }
            }
        }

        return array_merge($data);
    }
          
     function Account_Report_Production_Supplies($id){
             $query1 = $this->db->select('u.*,m.*,u.id as id,m.item as item,(u.total_qty*u.cost) as amount_costing,(u.production_quantity*u.cost) as amount_actual')->from('tbl_material_project as u')->join('tbl_materials as m','m.id=u.item_no','LEFT')->where('u.mat_type',1)->where('u.production_no',$id)->get();
                 if($query1 !== FALSE && $query1->num_rows() > 0){
                     foreach($query1->result() as $row){
                        $data_framing[] = array('id'     => $row->id,
                                                'item_no'=> $row->item_no,
                                                'item'   => $row->item,
                                                'qty'    => $row->total_qty,
                                                'unit'   => $row->unit,
                                                'cost'   =>  number_format($row->cost,2),
                                                'amount_costing'     =>  number_format($row->amount_costing,2),
                                                'production_quantity'=> $row->production_quantity,
                                                'amount_actual'      =>  number_format($row->amount_actual,2));
                     }
                 }else{
                    $data_framing = false;
                 }
             $query2 = $this->db->select('u.*,m.*,u.id as id,m.item as item,(u.total_qty*u.cost) as amount_costing,(u.production_quantity*u.cost) as amount_actual')->from('tbl_material_project as u')->join('tbl_materials as m','m.item_no=u.item_no','LEFT')->where('u.mat_type',2)->where('u.production_no',$id)->get();
               if($query2 !== FALSE && $query2->num_rows() > 0){  
                 foreach($query2->result() as $row){
                    $data_mechanism[] = array('id'     => $row->id,
                                            'item_no'=> $row->item_no,
                                            'item'   => $row->item,
                                            'qty'    => $row->total_qty,
                                            'unit'   => $row->unit,
                                            'cost'   =>  number_format($row->cost,2),
                                            'amount_costing'     =>  number_format($row->amount_costing,2),
                                            'production_quantity'=> $row->production_quantity,
                                            'amount_actual'      =>  number_format($row->amount_actual,2));
                 }
               }else{
                  $data_mechanism = false;            
               }
             $query3 = $this->db->select('u.*,m.*,u.id as id,m.item as item,(u.total_qty*u.cost) as amount_costing,(u.production_quantity*u.cost) as amount_actual')->from('tbl_material_project as u')->join('tbl_materials as m','m.item_no=u.item_no','LEFT')->where('u.mat_type',3)->where('u.production_no',$id)->get();
              if($query3 !== FALSE && $query3->num_rows() > 0){ 
                 foreach($query3->result() as $row){
                    $data_finishing[] = array('id'     => $row->id,
                                            'item_no'=> $row->item_no,
                                            'item'   => $row->item,
                                            'qty'    => $row->total_qty,
                                            'unit'   => $row->unit,
                                            'cost'   => number_format( $row->cost,2),
                                            'amount_costing'     =>  number_format($row->amount_costing,2),
                                            'production_quantity'=> $row->production_quantity,
                                            'amount_actual'      =>  number_format($row->amount_actual,2));
                 }
             }else{
                $data_finishing = false;
             }
             $query4 = $this->db->select('u.*,m.*,u.id as id,m.item as item,(u.total_qty*u.cost) as amount_costing,(u.production_quantity*u.cost) as amount_actual')->from('tbl_material_project as u')->join('tbl_materials as m','m.item_no=u.item_no','LEFT')->where('u.mat_type',4)->where('u.production_no',$id)->get();
             if($query4 !== FALSE && $query4->num_rows() > 0){ 
                 foreach($query4->result() as $row){
                    $data_sulihiya[] = array('id'     => $row->id,
                                            'item_no'=> $row->item_no,
                                            'item'   => $row->item,
                                            'qty'    => $row->total_qty,
                                            'unit'   => $row->unit,
                                            'cost'   =>  number_format($row->cost,2),
                                            'amount_costing'     =>  number_format($row->amount_costing,2),
                                            'production_quantity'=> $row->production_quantity,
                                            'amount_actual'      =>  number_format($row->amount_actual,2));
                 }
             }else{
                 $data_sulihiya = false;
             }
             $query5 = $this->db->select('u.*,m.*,u.id as id,m.item as item,(u.total_qty*u.cost) as amount_costing,(u.production_quantity*u.cost) as amount_actual')->from('tbl_material_project as u')->join('tbl_materials as m','m.item_no=u.item_no','LEFT')->where('u.mat_type',5)->where('u.production_no',$id)->get();
             if($query5 !== FALSE && $query5->num_rows() > 0){ 
                foreach($query5->result() as $row){
                    $data_upholstery[] =array('id'     => $row->id,
                                            'item_no'=> $row->item_no,
                                            'item'   => $row->item,
                                            'qty'    => $row->total_qty,
                                            'unit'   => $row->unit,
                                            'cost'   => number_format($row->cost,2),
                                            'amount_costing'     =>  number_format($row->amount_costing,2),
                                            'production_quantity'=> $row->production_quantity,
                                            'amount_actual'      =>  number_format($row->amount_actual,2));
                }
             }else{
                $data_upholstery = false;
             }
             $query6 = $this->db->select('u.*,m.*,u.id as id,m.item as item,(u.total_qty*u.cost) as amount_costing,(u.production_quantity*u.cost) as amount_actual')->from('tbl_material_project as u')->join('tbl_materials as m','m.item_no=u.item_no','LEFT')
             ->where('u.mat_type',6)->where('u.production_no',$id)->get();
              if($query6 !== FALSE && $query6->num_rows() > 0){ 
                     foreach($query6->result() as $row){
                        $data_others[] = array('id'     => $row->id,
                                            'item_no'=> $row->item_no,
                                            'item'   => $row->item,
                                            'qty'    => $row->total_qty,
                                            'unit'   => $row->unit,
                                            'cost'   =>  number_format($row->cost,2),
                                            'amount_costing'     =>  number_format($row->amount_costing,2),
                                            'production_quantity'=> $row->production_quantity,
                                            'amount_actual'      =>  number_format($row->amount_actual,2));
                    }
                }else{
                    $data_others = false;
                }
             $query = $this->db->select('*')->from('tbl_project')->where('production_no',$id)->get(); 
             $row = $query->row();
             $data_result = array('project'     => $row,
                                  'amount'      => number_format($row->amount,2),
                                  'labor'       => number_format($row->labor,2),
                                  'start'       => date('m/d/Y',strtotime($row->start_date)),
                                  'due'         => date('m/d/Y',strtotime($row->due_date)),
                                  'framing'     => $data_framing,
                                  'mechanism'   => $data_mechanism,
                                  'finishing'   => $data_finishing,
                                  'sulihiya'    => $data_sulihiya,
                                  'upholstery'  => $data_upholstery,
                                  'others'      => $data_others);
             return $data_result;
     }
 

     function Web_Banner_Data(){
         $query = $this->db->select('*')->from('tbl_website_banner')->order_by('type','ASC')->get(); 
             if($query !== FALSE && $query->num_rows() > 0){
               foreach($query->result() as $row)  {        
                    $data[] = array('id'             => $row->id,
                                    'web_no'         => $row->web_no,
                                    'title'          => $row->title,
                                    'sub_title'      => $row->sub_title,
                                    'image'          => $row->image,
                                    'type'           => $row->type,
                                    'status'         => $row->status,
                                    'date_created'   => $row->date_created);
                }
               }else{
                 $data = false;
               }
          return $data;
     }
     function Web_Product_DataTable(){
          $query = $this->db->select('*')->from('tbl_project_color as c')
          ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
          ->where('c.status',2)->where('c.type',1)
          ->order_by('c.project_no','ASC')->get();
          $data=array();
           if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
               if(!$row->d_status || $row->d_status == 'n/a'){
                  $status ='<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Not Display</span>';
               }else{
                  $status ='<span class="label label-lg label-light-success label-inline font-weight-bold py-4">Displayed</span>';
               }
               $action = '<button type="button" data-action="info" class="btn btn-sm btn-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->c_code.'" data-target="#modal-form"><i class="la la-eye"></i></button>';
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><span class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</span></div></div></span>';
             $data[] = array(
                      'c_code'       => $row->c_code,
                      'image'        => $image,
                      'title'        => $title,
                      'status'       => $status,
                      'action'       => $action);
            }  

        }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Web_Category_Data(){
        $query = $this->db->select('*')->from('tbl_category')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
             $name = '<div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 mr-2">
                            <a href="#" class="text-dark font-weight-bold text-hover-primary mb-1 font-size-lg">'.$row->cat_name.'</a>
                      </div>';  
             $data[] = array(
                      'id'           => $row->id,
                      'name'         => $name);
            }  
        }else{
            $data = false;
        }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Web_SubCategory_Data($id){
        $query = $this->db->select('*')->from('tbl_category_sub')->where('cat_id',$id)->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
            $name = '<div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 mr-2">
                            <a id="form-request" data-toggle="modal" data-target="#exampleModal" data-id="'.$row->id.'" data-action="sub_update" class="text-dark font-weight-bold text-hover-primary mb-1 font-size-lg">'.$row->sub_name.'</a>
                      </div>'; 
             $data[] = array(
                      'id'       => $row->id,
                      'name'     => $name);
            }  
        }else{
             $data = false;
        }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Web_ProductCategory_Data($id){
        $query = $this->db->select('*')->from('tbl_project_design')->where('sub_id',$id)->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
             $name = '<div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 mr-2">
                      <a id="form-request" data-toggle="modal" data-target="#exampleModal" data-id="'.$this->encryption->encrypt($row->id).'" data-action="product_update" class="text-dark font-weight-bold text-hover-primary mb-1 font-size-lg">'.$row->title.'</a>';
             $data[] = array(
                      'id'           => $this->encryption->encrypt($row->id),
                      'title'        => $name);
            }  
        }else{
             $data = false;
        }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
     function Web_Vouncher_DataTable(){
        $query =  $this->db->select('*,DATE_FORMAT(date_from, "%M %d %Y") as date_from,
             DATE_FORMAT(date_to, "%M %d %Y") as date_to,')->from('tbl_code_promo')->order_by('date_to','ASC')->get();
        $s = 1;
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
        
                $exp_date = strtotime($row->date_to);
                $now = new DateTime();
                $now = $now->format('Y-m-d');
                $now = strtotime($now);
                    if ($exp_date < $now) {
                    $action = '<button type="button" class="btn btn-sm btn-circle btn-primary btn-icon" disabled><i class="la la-eye"></i></button>';  
                        $status = '<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Already Expired</span>';
                        $query1 = $this->db->select('*')->from('tbl_code_promo')->where('id',$row->id)->get();
                        $row1 = $query1->row();
                        if(!$row1->status){
                            $data1 = array('status' => 'EXPIRED');
                            $this->db->where('id',$row->id);
                            $this->db->update('tbl_code_promo',$data1);  
                        }
                    } 
                    else if ($exp_date == $now) {
                     $action = '<button type="button" class="btn btn-sm btn-circle btn-primary btn-icon" disabled><i class="la la-eye"></i></button>';  
                        $status = '<span class="label label-lg label-light-warning label-inline font-weight-bold py-4">Will Expire Today</span>';
                        $query1 = $this->db->select('*')->from('tbl_code_promo')->where('id',$row->id)->get();
                        $row1 = $query1->row();
                        if(!$row1->status){
                           $data1 = array('status' => 'EXPIRED');
                           $this->db->where('id',$row->id);
                           $this->db->update('tbl_code_promo',$data1);  
                        }
                    }
                    else if ($exp_date > $now) {
                        $action = '<button type="button" class="btn btn-sm btn-circle btn-primary btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->promo_code.'" data-status="approved" data-target="#requestModal"><i class="la la-eye"></i></button>';  
                        $status = '<span class="label label-lg label-light-success label-inline font-weight-bold py-4">ACTIVE</span>';
                    }
             $dis = floatval(($row->discount*100)/1);
             $discount = $dis.'%';
             $data[] = array(
                      'no'           => $s,
                      'promo_code'   => $row->promo_code,
                      'discount'     => $discount,
                      'date_from'    => $row->date_from,
                      'date_to'      => $row->date_to,
                      'status'       => $status,
                      'action'       => $action);
                $s++;
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  
     }
     function Web_Shipping_DataTable(){
         $query = $this->db->select('*')->from('tbl_region_shipping')->order_by('id','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
              $action = '<button type="button" data-action="info" class="btn btn-sm btn-circle btn-primary btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="la la-eye"></i></button>';
             $data[] = array(
                      'id'                    => $row->id,
                      'region'                => $row->region,
                      'shipping_range'        => $row->shipping_range,
                      'action'                => $action);
            }  
        }else{
             $data = false;
        }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
      function Web_Interior_Data(){
        $query = $this->db->select('*')->from('tbl_interior_design')->get(); 
           if($query !== FALSE && $query->num_rows() > 0){
               foreach($query->result() as $row)  
               {        
                    $data[] = array('id'         => $row->id,
                                    'cat_id'     => $row->cat_id,
                                    'title'      => $row->project_name,
                                    'image'      => $row->image,
                                    'status'     => $row->status);
               }
               
             }else{
                 $data = false;
             }
            return $data;
     }
      function Web_Events_Data(){
        $query = $this->db->select('*')->from('tbl_events')->order_by('date_event','DESC')->get(); 
           if($query !== FALSE && $query->num_rows() > 0){
               foreach($query->result() as $row)  
               {        
                 $data[] = array('id'              => $row->id,
                                 'title'           => $row->title,
                                 'description'     => $row->description,
                                 'location'        => $row->location,
                                 'date_event'      => $row->date_event,
                                 'time_event'      => $row->time_event,
                                 'status'          => $row->status,
                                 'image'           => $row->image);
               }
               
             }else{
                 $data = false;
             }
            return $data;
     }
     function Web_Testimony_DataTable(){
         $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_customer_testimony')->order_by('id','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
            $no =1;
              foreach($query->result() as $row)  
            {
              $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/testimony/'.$row->image.'" alt="'.$row->name.'"></div>';
              $action = '<button type="button" class="btn btn-sm  btn-icon btn-dark btn-shadow btn-create" data-id="'.$this->encryption->encrypt($row->id).'" data-action="update" data-toggle="modal" data-target="#staticBackdrop"><i class="la la-eye icon-md"></i></button>
                         <button type="button" class="btn btn-sm btn-icon btn-danger btn-shadow btn-delete" data-id="'.$this->encryption->encrypt($row->id).'" data-action="delete"><i class="flaticon2-delete icon-md"></i></button>';
            $string = strip_tags($row->description);
            if (strlen($string) > 500) {
                // truncate string
                $stringCut = substr($string, 0, 80);
                $endPoint = strrpos($stringCut, ' ');
                //if the string doesn't contain any space then it will cut without word basis.
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
        }else{
             $data = false;
        }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }

     //sales
     function OnlineOrder_DataTable(){
         $data =false;   
       $query = $this->db->select('s.*,u.*,s.id,s.type,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.firstname, " ",u.lastname) AS customer')->from('tbl_cart_address as s')->join('tbl_customer_online as u','u.id=s.customer','LEFT')->where('s.status','REQUEST')->order_by('date_order','DESC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="flaticon2-pen"></i></button>';  
                $data[] = array(
                          'order_no'     => $row->order_no,
                          'customer'     => $row->customer,
                          'type'         => $row->type,
                          'date_order'   => $row->date_created,
                          'action'       => $action);

            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
      function Preorder_DataTable(){
        $data =false;   
        $query =  $this->db->select('*,i.id,i.status,i.c_code,i.qty, 
            DATE_FORMAT(i.date_created, "%M %d %Y") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_cart_pre_order as i')->join('tbl_project_color as c','c.id=i.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=i.created_by','LEFT')->where('i.status',1)->get();
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 if($row->status == 1){
                    $status = '<span class="label label-lg label-light-warning label-inline">Request</span>';
                 }else if($row->status == 2){
                    $status = '<span class="label label-lg label-light-success label-inline">Approved</span>';
                 }else{
                    $status = '<span class="label label-lg label-light-danger label-inline">Cancelled</span>';
                 }
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title.' ('.$row->c_name.')',
                             'qty'=>$row->qty,
                             'date_created'=>$row->date_created,
                             'action'=> $status);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Preorder_Request_DataTable(){
        $data =false;   
        $query =  $this->db->select('*,i.id,i.status,i.c_code,i.qty, 
            DATE_FORMAT(i.date_created, "%M %d %Y") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_cart_pre_order as i')->join('tbl_project_color as c','c.id=i.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=i.created_by','LEFT')->where('i.status',1)->get();
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>';  
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title.' ('.$row->c_name.')',
                             'qty'=>$row->qty,
                             'date_created'=>$row->date_created,
                             'action'=> $action);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Preorder_Approved_DataTable(){
        $data =false;   
        $query =  $this->db->select('*,i.id,i.status,i.c_code,i.qty, 
            DATE_FORMAT(i.date_created, "%M %d %Y") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_cart_pre_order as i')->join('tbl_project_color as c','c.id=i.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=i.created_by','LEFT')->where('i.status',2)->get();
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title.' ('.$row->c_name.')',
                             'qty'=>$row->qty,
                             'date_created'=>$row->date_created);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Preorder_Cancelled_DataTable(){
        $data =false;   
        $query =  $this->db->select('*,i.id,i.status,i.c_code,i.qty, 
            DATE_FORMAT(i.date_created, "%M %d %Y") as date_created,
            CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_cart_pre_order as i')->join('tbl_project_color as c','c.id=i.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=i.created_by','LEFT')->where('i.status',3)->get();
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title.' ('.$row->c_name.')',
                             'qty'=>$row->qty,
                             'date_created'=>$row->date_created);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
      function Coupon_DataTable(){
        $query =  $this->db->select('*,DATE_FORMAT(date_from, "%M %d %Y") as date_from,
             DATE_FORMAT(date_to, "%M %d %Y") as date_to,')->from('tbl_code_promo')->order_by('date_to','ASC')->get();
        $s = 1;
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
                $exp_date = strtotime($row->date_to);
                $now = new DateTime();
                $now = $now->format('Y-m-d');
                $now = strtotime($now);
                    if ($exp_date < $now) {
                    $action = '<button type="button" class="btn btn-sm btn-circle btn-success btn-icon" disabled><i class="la la-plus"></i></button>'; 
                        $status = '<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Already Expired</span>';
                        $query1 = $this->db->select('*')->from('tbl_code_promo')->where('id',$row->id)->get();
                        $row1 = $query1->row();
                        if(!$row1->status){
                            $data1 = array('status' => 'EXPIRED');
                            $this->db->where('id',$row->id);
                            $this->db->update('tbl_code_promo',$data1);  
                        }
                    } 
                    else if ($exp_date == $now) {
                    $action = '<button type="button" class="btn btn-sm btn-circle btn-success btn-icon" disabled><i class="la la-plus"></i></button>'; 
                        $status = '<span class="label label-lg label-light-warning label-inline font-weight-bold py-4">Will Expire Today</span>';
                        $query1 = $this->db->select('*')->from('tbl_code_promo')->where('id',$row->id)->get();
                        $row1 = $query1->row();
                        if(!$row1->status){
                           $data1 = array('status' => 'EXPIRED');
                           $this->db->where('id',$row->id);
                           $this->db->update('tbl_code_promo',$data1);  
                        }
                    }
                    else if ($exp_date > $now) {
                        $action = '<button type="button" class="btn btn-sm btn-circle btn-success btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->promo_code.'" data-status="approved" data-target="#requestModal" data-action="view"><i class="la la-plus"></i></button>';  
                        $status = '<span class="label label-lg label-light-success label-inline font-weight-bold py-4">ACTIVE</span>';
                    }
             $dis = floatval(($row->discount*100)/1);
             $discount = $dis.'%';
             $data[] = array(
                      'no'           => $s,
                      'promo_code'   => $row->promo_code,
                      'discount'     => $discount,
                      'date_from'    => $row->date_from,
                      'date_to'      => $row->date_to,
                      'status'       => $status,
                      'action'       => $action);
                $s++;
            }      
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  
     }
 
     function Customer_Concern_Request_Sales_DataTable($id){
         $data =false;   
        $query = $this->db->select('*,DATE_FORMAT(date_request, "%M %d %Y %r") as date_created')->from('tbl_service_request')->where('status','R')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           $s = 1;
           foreach($query->result() as $row){
             $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';  
             $data[] = array(
                      'no'           => $s,
                      'production_no'=> $row->production_no,
                      'customer'     => $row->customer,
                      'date_created' => $row->date_created,
                      'action'       => $action);
                $s++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  
     }
     function Customer_Concern_Approved_Sales_DataTable($id){
         $data =false;   
        $query = $this->db->select('*,DATE_FORMAT(date_request, "%M %d %Y %r") as date_created')->from('tbl_service_request')->where('status','A')->where('created_by',$id)->get();
        if($query !== FALSE && $query->num_rows() > 0){
           $s = 1;
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>'; 
             $data[] = array(
                      'no'           => $s,
                      'production_no'=> $row->production_no,
                      'customer'     => $row->customer,
                      'date_created' => $row->date_created,
                      'action'       => $action);
                $s++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  
     }
     function Customer_Concern_Request_Superuser_DataTable($id){
         $data =false;   
        $query = $this->db->select('*,DATE_FORMAT(date_request, "%M %d %Y %r") as date_created')->from('tbl_service_request')->where('status','P')->order_by('date_created','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           $s = 1;
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>'; 
             $data[] = array(
                      'no'           => $s,
                      'production_no'=> $row->production_no,
                      'customer'     => $row->customer,
                      'date_created' => $row->date_created,
                      'action'       => $action);
                $s++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  
     }
     function Customer_Concern_Approved_Superuser_DataTable($id){
         $data =false;   
        $query = $this->db->select('*,DATE_FORMAT(date_request, "%M %d %Y %r") as date_created')->from('tbl_service_request')->where('status','A')->where('created_by',$id)->order_by('latest_update','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           $s = 1; 
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';  
             $data[] = array(
                      'no'           => $s,
                      'production_no'=> $row->production_no,
                      'customer'     => $row->customer,
                      'date_created' => $row->date_created,
                      'action'       => $action);
                $s++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  
     }
       function Customized_Request_Sales_Datatable($id){
         $data =false;   
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_customized_request')->where('status','P')->where('created_by',$id)->order_by('date_created','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           $s = 1; 
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#customized-for-update"><i class="flaticon2-pen"></i></button>';  
             $data[] = array(
                      'no'           => $s,
                      'subject'      => $row->subject,
                      'date_created' => $row->date_created,
                      'action'       => $action);
                $s++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  
     }
    function Customized_Approved_Sales_Datatable($id){
        $data =false;   
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_customized_request')->where('status','A')->where('created_by',$id)->order_by('latest_update','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           $s = 1; 
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#customized-for-update"><i class="flaticon2-pen"></i></button>';  
             $data[] = array(
                      'no'           => $s,
                      'subject'      => $row->subject,
                      'date_created' => $row->date_created,
                      'action'       => $action);
                $s++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  
     }
       function Customized_Rejected_Sales_Datatable($id){
         $data =false;   
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_customized_request')->where('status','R')->where('created_by',$id)->order_by('latest_update','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           $s = 1; 
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#customized-for-update"><i class="flaticon2-pen"></i></button>';  
             $data[] = array(
                      'no'           => $s,
                      'subject'      => $row->subject,
                      'date_created' => $row->date_created,
                      'action'       => $action);
                $s++;
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  
     }




    function Customer_Collected_Request_DataTable(){
         $data=false;
        $query = $this->db->select('*,CONCAT(firstname, " ",lastname) AS customer,DATE_FORMAT(date_deposite, "%M %d %Y") as date_created')->from('tbl_customer_deposite')->where('status','P')->order_by('date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  
            {
             $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>'; 
             $data[] = array(
                          'so_no'        => $row->order_no,
                          'customer'     => $row->customer,
                          'bank'         => $row->bank,
                          'amount'       => number_format($row->amount,2),
                          'date'         => $row->date_created,
                          'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
    function Customer_Collected_Approved_DataTable(){
        $data =false;  
        $query = $this->db->select('*,CONCAT(firstname, " ",lastname) AS customer,DATE_FORMAT(date_deposite, "%M %d %Y") as date_created')->from('tbl_customer_deposite')->where('status','A')->order_by('date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
             $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>'; 
             $data[] = array(
                          'so_no'        => $row->order_no,
                          'customer'     => $row->customer,
                          'bank'         => $row->bank,
                          'amount'       => number_format($row->amount,2),
                          'date'         => $row->date_created,
                          'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
    function Customer_List_DataTable(){
         $query = $this->db->select('*,CONCAT(firstname, " ",lastname) AS customer,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_customer_online')->order_by('latest_update','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
            $i = 1;
         foreach($query->result() as $row)  
            {
             $action = '<button type="button" class="btn btn-sm btn-circle btn-primary btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal" data-action="update"><i class="la la-eye"></i></button>'; 
             if($row->status == 1){
                $status ='<span class="label label-lg label-light-success label-inline font-weight-bold py-4">Active</span>';
             }else{
                $status ='<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Inactive</span>';
             }
             $data[] = array(
                          'no'           => $i,
                          'name'         => $row->customer,
                          'mobile'       => $row->mobile,
                          'email'        => $row->email,
                          'status'       => $status,
                          'date_created' => $row->date_created,
                          'action'       => $action);
                 $i++;
            }  
         }else{   
             $data =false;   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
    function Pre_Order_Request_Datatable(){
        $data =false;   
        $query =  $this->db->select('*,i.id,i.qty, DATE_FORMAT(i.date_created, "%M %d %Y") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_cart_pre_order as i')->join('tbl_project_color as c','c.id=i.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=i.created_by','LEFT')->where('i.status',1)->order_by('i.date_created','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                  $action = '<button type="button" class="btn btn-sm btn-light-success btn-icon  btn-request" mr-2" data-status="2" data-id="'.$this->encryption->encrypt($row->id).'"><i class="flaticon2-check-mark"></i></button>
                  <button type="button" class="btn btn-sm btn-light-danger btn-icon btn-request" data-status="3" data-id="'.$this->encryption->encrypt($row->id).'"><i class="flaticon2-cancel-music"></i></button>';    
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title.' ('.$row->c_name.')',
                             'qty'=>$row->qty,
                              'requestor'=>$row->requestor,
                             'date_created'=>$row->date_created,
                             'action'=> $action);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
     function Pre_Order_Approved_Datatable($user_id){
       $data =false;   
        $query =  $this->db->select('*,i.qty, DATE_FORMAT(i.date_created, "%M %d %Y") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_cart_pre_order as i')->join('tbl_project_color as c','c.id=i.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=i.created_by','LEFT')->where('i.status',2)->where('i.update_by',$user_id)->order_by('i.latest_update','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){ 
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title.' ('.$row->c_name.')',
                             'qty'=>$row->qty,
                              'requestor'=>$row->requestor,
                             'date_created'=>$row->date_created);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
    function Pre_Order_Rejected_Datatable($user_id){
        $data =false;   
        $query =  $this->db->select('*,i.qty, DATE_FORMAT(i.date_created, "%M %d %Y") as date_created,CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_cart_pre_order as i')->join('tbl_project_color as c','c.id=i.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_users as u','u.id=i.created_by','LEFT')->where('i.status',3)->where('i.update_by',$user_id)->order_by('i.latest_update','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){ 
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title.' ('.$row->c_name.')',
                             'qty'=>$row->qty,
                             'requestor'=>$row->requestor,
                             'date_created'=>$row->date_created);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }


    function Customized_Request_Datatable(){
        $data =false;$no = 1;  
        $query = $this->db->select('*,p.id,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created, 
            CONCAT(u.firstname, " ",u.lastname) AS requestor')
        ->from('tbl_customized_request as p')
        ->join('tbl_users as u','u.id=p.created_by','LEFT')
        ->where('p.status','P')
        ->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';    
                 $data[] = array(
                          'no'           => $no,
                          'subject'      => $row->subject,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'action'       => $action);
                 $no++;
             }
         }
        $json_data  = array("data" =>$data); 
         return $json_data;
    }
     function Customized_Approved_Datatable($user_id){
        $data =false;$no = 1; 
        $query = $this->db->select('*,p.id,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created, CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_customized_request as p')->join('tbl_users as u','u.id=p.created_by','LEFT')->where('p.status','A')->where('p.update_by',$user_id)->order_by('p.latest_update','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';    
                $data[] = array(
                          'no'           => $no,
                          'subject'      => $row->subject,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'action'=>$action);
                $no++;
             }
         }
        $json_data  = array("data" =>$data); 
         return $json_data;
    }
    function Customized_Rejected_Datatable($user_id){
        $data =false;$no = 1;  
        $query = $this->db->select('*,p.id,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created, CONCAT(u.firstname, " ",u.lastname) AS requestor')->from('tbl_customized_request as p')->join('tbl_users as u','u.id=p.created_by','LEFT')->where('p.status','R')->where('p.update_by',$user_id)->order_by('p.latest_update','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';
                  $data[] = array(
                          'no'           => $no,
                          'subject'      => $row->subject,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'action'=>$action);
                $no++;
             }
         }
        $json_data  = array("data" =>$data); 
         return $json_data;
    }
    function Inquiry_Request_Sales_Datatable(){
        $data =false;$no = 1;  
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_customer_inquiry')->where('status','P')->order_by('date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';    
                   $data[] = array(
                          'no'           => $no,
                          'subject'      => $row->subject,
                          'customer'     => $row->fullname,
                          'email'        => $row->email,
                          'date_created' => $row->date_created,
                          'action'=>$action);
                $no++;
             }
         }
        $json_data  = array("data" =>$data); 
         return $json_data;
    }
     function Inquiry_Approved_Sales_Datatable($user_id){
        $data =false;$no = 1;  
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_customer_inquiry')->where('status','A')->where('update_by',$user_id)->order_by('latest_update','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#modal-form"><i class="flaticon2-pen"></i></button>';    
                  $data[] = array(
                          'no'           => $no,
                          'subject'      => $row->subject,
                          'customer'     => $row->fullname,
                          'email'        => $row->email,
                          'date_created' => $row->date_created,
                          'action'=>$action);
                $no++;
             }
         }
        $json_data  = array("data" =>$data); 
         return $json_data;
    }
    function Material_List_Supervisor($val){
        $data =false;
        $query = $this->db->select('*,p.id,m.item,m.production_stocks,m.unit')->from('tbl_material_project as p')->join('tbl_materials as m','m.id=p.item_no','LEFT')->where('p.production_no',$val)->order_by('p.id','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 $lock = "";
                 $icon ='flaticon-delete-1';
                 if($row->lock_status == 1){
                    $lock ='disabled';
                    $icon ='fas fa-lock';
                 } 
                 if($row->project_lock == 1){
                    $lock ='disabled'; 
                    $icon ='fas fa-lock';
                 }
                $unit =$row->unit.'(s)';
                if(!$row->unit){ $unit ="";}
                 $status = '<button  class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger btn_remove_material" data-id="'.$row->id.'" data-toggle="tooltip" data-theme="dark" '.$lock.'><i class="'.$icon.'"></i></button>';       
                 $item = '<a href="javascript:;" id="update-material-request" data-type="'.$row->mat_type.'" data-qty="'.$row->total_qty.'" data-name="'.$row->item.'" data-id="'.$row->id.'">'.$row->item.' - '.$unit.'</a>';
                 $qty = '<input type="text" class="form-control form-control-sm text-center quantity" placeholder="Enter Quantity" autocomplete="off"/>';
                 $action = '<button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success btn_material_request"  data-id="'.$row->id.'"><i class="flaticon2-fast-next"></i></button>';
                
                  $data[] = array(
                          'status'       => $status,
                          'item'         => $item,
                          'qty'          => $row->total_qty,
                          'balance'      => $row->balance_quantity,
                          'stocks'       => $row->production_stocks,
                          'input'        => $qty,
                          'action'       => $action);
             }
         }
        $json_data  = array("data" =>$data); 
        return $json_data;
    }
    function Purchased_List_Supervisor($val){
        $data =false;
         $query = $this->db->select('*,p.id,m.item,p.status,m.status')->from('tbl_purchasing_project as p')->join('tbl_materials as m','m.id=p.item_no','LEFT')->where('p.production_no',$val)->where('p.status',1)->order_by('p.id','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                    $unit =$row->unit.'(s)';
                if(!$row->unit){ $unit ="";}
                $status = '<button class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger btn_remove_purchased" data-id="'.$row->id.'"><i class="flaticon-delete-1"></i></button>';
                $item = '<a href="javascript:;" id="update-purchase-request"  data-id="'.$row->id.'">'.$row->item.'</a>';
                $action = '<button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success btn_purchased_request"  data-id="'.$row->id.'"><i class="flaticon2-fast-next"></i></button>';
                $remarks = '(<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="'.$row->remarks.'">Remarks</a>)';
                if(!$row->remarks){$remarks ="";}
                  $data[] = array(
                          'status'       => $status,
                          'item'         => $item,
                          'unit'         => $unit,
                          'qty'          => $row->quantity,
                          'remarks'      => $remarks,
                          'action'       => $action);
                }
        }
        return array("data" =>$data);
    }
    function Material_Used_List_Supervisor($val){
        $data =false;
        $query = $this->db->select('*,p.id,m.item,m.production_stocks')->from('tbl_material_project as p')->join('tbl_materials as m','m.id=p.item_no','LEFT')->where('p.production_no',$val)->order_by('p.id','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                $icon = '<i class="fas fa-lock-open"></i>';
                $title = 'Click to lock';
                $lock = "";
                if($row->lock_status == 1){
                    $icon = '<i class="fas fa-lock"></i>';
                    $title = 'Click to unlock';
                    $lock = "";
                }
                if($row->project_lock == 1){
                    $icon = '<i class="fas fa-lock"></i>';
                    $lock ='disabled';
                    $title = 'Permanent lock'; 
                 }
                $unit =$row->unit.'(s)';
                if(!$row->unit){ $unit ="";}
                 $status = '<button class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger btn_lock_material" data-id="'.$row->id.'"  data-toggle="tooltip" data-theme="dark" title="'.$title.'" '.$lock.'>'.$icon.'</button>';
                 $input = '<input type="text" class="form-control form-control-sm text-center quantity" placeholder="Enter Quantity" autocomplete="off"/>';    
                 $action = '<button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success btn_material_used"  data-m="1" data-id="'.$row->id.'"><i class="flaticon2-plus"></i></button>
                     <button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-danger btn-hover-danger btn_material_used"  data-m="2" data-id="'.$row->id.'"><i class="flaticon2-line"></i></button>';
                  $data[] = array(
                          'status'       => $status,
                          'item'         => $row->item.' - '.$unit,
                          'qty'          => $row->production_quantity,
                          'input'        => $input,
                          'action'       => $action);
             }
         }
        $json_data  = array("data" =>$data); 
        return $json_data;
    }
    
}
?>