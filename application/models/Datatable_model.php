<?php
class Datatable_model extends CI_Model{  
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
       function supplier_DataTable(){
        $data =array(); 
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_supplier')->order_by('id','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
             $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'"><i class="flaticon2-pen"></i></button>';    
            if($row->status == 1){$status ='<span class="label label-lg label-light-primary label-inline">ACTIVE</span>';}else{$status='<span class="label label-lg label-light-danger label-inline">INACTIVE</span>';}
                   $data[] = array(
                            'name'         => $row->name,
                            'address'      => $row->address,
                            'mobile'       => $row->mobile,
                            'status'       => $status,
                            'date_created' => $row->date_created,
                            'action'       => $action);
            }      
         }
         return array("data" =>$data);     
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
             $data =array();    
         }
         $json_data = array("data" =>$data); 
         return $data;
    }

    function Design_Stocks_Request_DataTable(){
         $query = $this->db->query("SELECT *, DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
            (SELECT title FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS title,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_color.designer) AS requestor FROM tbl_project_color WHERE status=1 AND type=1 AND designer=".$this->user_id."");
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
                $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-stocks" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-eye"></i></button>
                        <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm edit-stocks" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-pencil-square-o"></i></button>';
               $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
             $data[] = array(
                      'id'=>$row->id,
                      'project_no'   => $row->c_code,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Design_Stocks_Approved_DataTable(){
       $query = $this->db->query("SELECT *, DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
            (SELECT title FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS title,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_color.designer) AS requestor FROM tbl_project_color WHERE status=2 AND type=1");
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
               $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-stocks" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-eye"></i></button>
                        <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm edit-stocks" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-pencil-square-o"></i></button>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
             $data[] = array(
                      'id'=>$row->id,
                      'project_no'   => $row->c_code,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Design_Stocks_Rejected_DataTable(){
        $query = $this->db->query("SELECT *, DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
            (SELECT title FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS title,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_color.designer) AS requestor FROM tbl_project_color WHERE status=3 AND type=1");
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
               $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-stocks" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-eye"></i></button>
                        <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm remarks-stocks" data-name="'.$row->title.'" data-id="'.$row->remark.'"><i class="flaticon2 flaticon2-document"></i></button>';  
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
             $data[] = array(
                      'id'=>$row->id,
                      'project_no'   => $row->c_code,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Design_Project_Request_DataTable(){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_administrator as u','u.id=c.designer')->where('c.status=1 AND c.type=2 AND c.designer ='.$this->user_id.'')->order_by('c.date_approved','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
               $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-project" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-eye"></i></button>
                        <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm edit-project" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-pencil-square-o"></i></button>';
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array(
                          'id'=>$row->id,
                          'project_no'   => $row->project_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'action'       => $action);
            }  
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Design_Project_Approved_DataTable(){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_administrator as u','u.id=c.designer')->where('c.status =2 AND c.type=2 AND c.designer ='.$this->user_id.'')->order_by('c.date_created','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
             $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-project" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-eye"></i></button>
                        <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm edit-project" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-pencil-square-o"></i></button>';     
             $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
             $data[] = array(
                      'id'=>$row->id,
                      'project_no'   => $row->project_no,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }
    function Design_Project_Rejected_DataTable(){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_administrator as u','u.id=c.designer')->where('c.status=3 AND c.type=2 AND c.designer ='.$this->user_id.'')->order_by('c.date_approved','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
              $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-project" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-eye"></i></button>
                        <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm remarks-project" data-name="'.$row->title.'" data-id="'.$row->remark.'"><i class="flaticon2 flaticon2-document"></i></button>';    
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="'.$row->title.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array(
                          'id'=>$row->id,
                          'project_no'   => $row->project_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'action'       => $action);
            }  
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
    }

    function RawMaterial_DataTable(){
       $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_materials')->order_by('id','DESC')->get();  
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-id="'.$row->id.'" id="form-request"><i class="la la-eye"></i></button>'; 
                if(!$row->unit){$unit = " ";}else{$unit = ' ('.$row->unit.')';}
                $data[] = array(
                         'no'           => $row->item_no,
                         'item'         => $row->item.$unit,
                         'price'        => number_format($row->price,2),
                         'date_created' => $row->date_created,
                         'action'       => $action);
            }      
         }else{   
             $data =array();    
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
             ($row->unit)?$unit = ' '.$row->unit.'(s)':$unit = "";
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="la la-eye"></i></button>';
               $data[] = array(
                      'no'           => $row->item_no,
                      'item'         => $row->item.$unit,
                      'stocks'       => $row->stocks,
                      'stocks_alert' => $row->stocks_alert,
                      'action'       => $action,
                  );
            }      
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;     
     }
     function RawMaterial_OutStocks_DataTable(){
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_materials')->order_by('item','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
             ($row->unit)?$unit = ' '.$row->unit.'(s)':$unit = "";
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="la la-eye"></i></button>';
                 if($row->stocks <= $row->stocks_alert && $row->stocks_alert <= $row->stocks){
                       $data[] = array(
                          'no'           => $row->item_no,
                          'item'         => $row->item.$unit,
                          'stocks'       => $row->stocks,
                          'stocks_alert' => $row->stocks_alert,
                          'action'       => $action );
                  }else{$data=array(); }
            }      
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;     
     }
      function RawMaterial_New_DataTable(){
         $query = $this->db->select('*,m.item,
            DATE_FORMAT(n.date_created, "%M %d %Y %r") as date_created')->from('tbl_material_new as n')->join('tbl_materials as m','m.id=n.item_no','LEFT')->order_by('n.date_created','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
             ($row->unit)?$unit = ' '.$row->unit.'(s)':$unit = "";
               $data[] = array(
                      'no'           => $row->item_no,
                      'item'         => $row->item.$unit,
                      'stocks'       => $row->qty,
                      'date_created' => $row->date_created);
            }      
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;     
     }
     function RawMaterial_Release_DataTable(){
         $query = $this->db->select('*,m.item,DATE_FORMAT(n.date_created, "%M %d %Y %r") as date_created')->from('tbl_material_release as n')->join('tbl_materials as m','m.id=n.item_no','LEFT')->order_by('n.date_created','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
             ($row->unit)?$unit = ' '.$row->unit.'(s)':$unit = "";
               $data[] = array(
                      'no'           => $row->item_no,
                      'item'         => $row->item.$unit,
                      'stocks'       => $row->quantity,
                      'date_created' => $row->date_created);
            }      
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;     
     }

     function RawMat_Production_Stocks_DataTable(){
         $query = $this->db->select('*')->from('tbl_materials')->order_by('id','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
           ($row->unit)?$unit = ' '.$row->unit.'(s)':$unit = "";
             $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#exampleModal"><i class="la la-eye"></i></button>';
               $data[] = array(
                      'no'           => $row->item_no,
                      'item'         => $row->item.$unit,
                      'stocks'       => $row->production_stocks,
                      'action'       => $action);
            }      
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;     
     }
     function Production_Stocks_DataTable(){
         $query = $this->db->select('*')->from('tbl_materials')->order_by('item_no','ASC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
            ($row->unit)?$unit = ' '.$row->unit.'(s)':$unit = "";
            $data[] = array(
                      'no'           => $row->item_no,
                      'item'         => $row->item.$unit,
                      'stocks'       => $row->production_stocks);
            }      
         }else{   
             $data =array();    
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
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_other_material_p_received')->where('type =',3)->order_by('id','DESC')->get();
        $data=array();
       if($query !== FALSE && $query->num_rows() > 0){
            $i=1;
           foreach($query->result() as $row){
                   $data[] = array(
                      'no'           => $i,
                      'item'         => $row->item,
                      'stocks'       => $row->quantity,
                      'date_created' => $row->date_created);
                   $i++;
            }      
         }
         $json_data  = array("data" =>$data);
         return $json_data;
     }
     function SpareParts_release_DataTable(){
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_other_material_m_received')->where('type =',3)->order_by('id','DESC')->get();
        $data=array();
       if($query !== FALSE && $query->num_rows() > 0){
            $i=1;
           foreach($query->result() as $row){
                   $data[] = array(
                      'no'           => $i,
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
     function OfficeSupplies_newstocks_DataTable(){
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_other_material_p_received')->where('type =',2)->order_by('id','DESC')->get();
        $data=array();
       if($query !== FALSE && $query->num_rows() > 0){
            $i=1;
           foreach($query->result() as $row){
                   $data[] = array(
                      'no'           => $i,
                      'item'         => $row->item,
                      'stocks'       => $row->quantity,
                      'date_created' => $row->date_created);
                   $i++;
            }      
         }
         $json_data  = array("data" =>$data);
         return $json_data;
     }
     function OfficeSupplies_release_DataTable(){
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_other_material_m_received')->where('type =',2)->order_by('id','DESC')->get();
        $data=array();
       if($query !== FALSE && $query->num_rows() > 0){
            $i=1;
           foreach($query->result() as $row){
                   $data[] = array(
                      'no'           => $i,
                      'item'         => $row->item,
                      'stocks'       => $row->quantity,
                      'date_created' => $row->date_created);
                   $i++;
            }      
         }
         $json_data  = array("data" =>$data);
         return $json_data;
     }

     function Purchase_Material_Stocks_Request_DataTable(){
          $data =array();   
          $sql = "SELECT *, (SELECT  DATE_FORMAT(date_created, '%M %d %Y %r') FROM tbl_project WHERE production_no=tbl_purchasing_project.production_no) as date_created,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator a LEFT JOIN tbl_project p ON a.id=p.assigned WHERE p.production_no=tbl_purchasing_project.production_no) as requestor, 
            (SELECT c_name FROM tbl_project_color c LEFT JOIN tbl_project p ON p.c_code=c.id WHERE p.production_no=tbl_purchasing_project.production_no) as c_name, 
            (SELECT image FROM tbl_project_color c LEFT JOIN tbl_project p ON p.c_code=c.id WHERE p.production_no=tbl_purchasing_project.production_no) as image, 
             (SELECT c_image FROM tbl_project_color c LEFT JOIN tbl_project p ON p.c_code=c.id WHERE p.production_no=tbl_purchasing_project.production_no) as c_image,
            (SELECT title FROM tbl_project_design c LEFT JOIN tbl_project p ON p.project_no=c.id WHERE p.production_no=tbl_purchasing_project.production_no) as title 
            FROM tbl_purchasing_project WHERE status =2 AND type=1 GROUP BY production_no";
             $query = $this->db->query($sql);
          if($query){
              foreach($query->result() as $row)  {
                   $action = '<button data-toggle="modal" data-target="#requestModal" id="form-request" data-id="'.$row->production_no.'" class="btn btn-sm btn-light-dark btn-shadow btn-icon" title="View Request"><i class="la la-eye"></i></button>';  
                   $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';

                         $data[] = array(
                              'production_no'=> $row->production_no,
                              'title'        => $title,
                              'requestor'    => $row->requestor, 
                              'date_created' => $row->date_created,
                              'action'       => $action);
     
            }      
         }
         return array("data" =>$data);
    }
     function Purchase_Material_Stocks_Inprogress_DataTable(){
            $sql = "SELECT *, 
            (SELECT  DATE_FORMAT(date_created, '%M %d %Y %r') FROM tbl_project WHERE production_no=tbl_purchasing_project.production_no) as date_created,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator a LEFT JOIN tbl_project p ON a.id=p.assigned WHERE p.production_no=tbl_purchasing_project.production_no) as requestor, 
            (SELECT c_name FROM tbl_project_color c LEFT JOIN tbl_project p ON p.c_code=c.id WHERE p.production_no=tbl_purchasing_project.production_no) as c_name, 
            (SELECT image FROM tbl_project_color c LEFT JOIN tbl_project p ON p.c_code=c.id WHERE p.production_no=tbl_purchasing_project.production_no) as image, 
             (SELECT c_image FROM tbl_project_color c LEFT JOIN tbl_project p ON p.c_code=c.id WHERE p.production_no=tbl_purchasing_project.production_no) as c_image,
            (SELECT title FROM tbl_project_design c LEFT JOIN tbl_project p ON p.project_no=c.id WHERE p.production_no=tbl_purchasing_project.production_no) as title 
            FROM tbl_purchasing_project WHERE status IN (3,4,5) AND type=1 GROUP BY fund_no";
            $query = $this->db->query($sql);
          if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
               $action = '<button data-toggle="modal" data-target="#processModal" id="form-request-inprogress" data-id="'.$row->fund_no.'" class="btn btn-sm btn-light-dark btn-shadow btn-icon" title="View Request"><i class="la la-eye"></i></button>';  
              $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';

                if($row->status==3){$status ='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Pending</span></span>';
                }else if($row->status == 4){$status ='<span style="width: 112px;"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Approved</span></span>';}else if($row->status == 5){$status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Complete</span></span>';}
                $production_no = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->production_no.'</span><span class="text-muted font-weight-bold">'.$row->fund_no.'</span>';
              $data[] = array(
                          'production_no'=> $production_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'status'       => $status,
                          'action'       => $action);

            }      
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
     function Purchase_Material_Stocks_Complete_DataTable(){
             $user_id = $this->user_id;
        $sql = "SELECT *,
          DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
          DATE_FORMAT(terms_start, '%M %d %Y') as terms_start,
          DATE_FORMAT(terms_end, '%M %d %Y') as terms_end,
         (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator a LEFT JOIN tbl_project p ON a.id=p.assigned WHERE p.production_no=tbl_purchase_received.production_no) as requestor, 
         (SELECT item FROM tbl_materials WHERE id=tbl_purchase_received.item_no) as item,
         (SELECT unit FROM tbl_materials WHERE id=tbl_purchase_received.item_no) as unit,
         (SELECT name FROM tbl_supplier WHERE id=tbl_purchase_received.item_no) as supplier
         FROM tbl_purchase_received WHERE type=1 AND created_by='$user_id'";
          $query = $this->db->query($sql);
          if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row)  { 
                if($row->payment==1){$terms ='<span style="width: 112px;" class="d-block"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Cash</span></span>';
                }else if($row->payment == 2){$terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';}
            $production_no = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->production_no.'</span><span class="text-muted font-weight-bold">'.$row->fund_no.'</span>';
                     ($row->unit)?$unit = ' '.$row->unit.'(s)':$unit = "";
                     $data[] = array(
                          'production_no' => $row->production_no,
                          'item'          => $row->item.$unit,
                          'quantity'      => $row->quantity,
                          'amount'        => number_format($row->amount,2),
                          'supplier'      => $row->supplier,
                          'terms'         => $terms,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created);
            }      
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }

     function Purchase_Material_Project_Request_DataTable(){
         $sql = "SELECT *, (SELECT  DATE_FORMAT(date_created, '%M %d %Y %r') FROM tbl_project WHERE production_no=tbl_purchasing_project.production_no) as date_created,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator a LEFT JOIN tbl_project p ON a.id=p.assigned WHERE p.production_no=tbl_purchasing_project.production_no) as requestor,  
            (SELECT image FROM tbl_project_color c LEFT JOIN tbl_project p ON p.project_no=c.project_no WHERE p.production_no=tbl_purchasing_project.production_no) as image, 
            (SELECT title FROM tbl_project_design c LEFT JOIN tbl_project p ON p.project_no=c.id WHERE p.production_no=tbl_purchasing_project.production_no) as title 
            FROM tbl_purchasing_project WHERE status =2 AND type=2 GROUP BY production_no";
             $query = $this->db->query($sql);
          if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  {
                if($row->status == 0){
                    $data =array();    
                }else{
                   $action = '<button data-toggle="modal" data-target="#requestModal" id="form-request" data-id="'.$row->production_no.'" class="btn btn-sm btn-light-dark btn-shadow btn-icon" title="View Request"><i class="la la-eye"></i></button>';  
                   $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
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
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
    function Purchase_Material_Project_Inprogress_DataTable(){
          $sql = "SELECT *, 
            (SELECT  DATE_FORMAT(date_created, '%M %d %Y %r') FROM tbl_project WHERE production_no=tbl_purchasing_project.production_no) as date_created,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator a LEFT JOIN tbl_project p ON a.id=p.assigned WHERE p.production_no=tbl_purchasing_project.production_no) as requestor, 
            (SELECT image FROM tbl_project_color c LEFT JOIN tbl_project p ON p.project_no=c.project_no WHERE p.production_no=tbl_purchasing_project.production_no) as image, 
            (SELECT title FROM tbl_project_design c LEFT JOIN tbl_project p ON p.project_no=c.id WHERE p.production_no=tbl_purchasing_project.production_no) as title 
            FROM tbl_purchasing_project WHERE status IN (3,4,5) AND type=2 GROUP BY fund_no";
             $query = $this->db->query($sql);
          if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
               $action = '<button data-toggle="modal" data-target="#processModal" id="form-request-inprogress" data-id="'.$row->fund_no.'" class="btn btn-sm btn-light-dark btn-shadow btn-icon" title="View Request"><i class="la la-eye"></i></button>';  
              $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
                if($row->status==3){$status ='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Pending</span></span>';
                }else if($row->status == 4){$status ='<span style="width: 112px;"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Approved</span></span>';}else if($row->status == 5){$status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Complete</span></span>';}
                $production_no = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->production_no.'</span><span class="text-muted font-weight-bold">'.$row->fund_no.'</span>';
              $data[] = array(
                          'production_no'=> $production_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'status'       => $status,
                          'action'       => $action);
            }      
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
    function Purchase_Material_Project_Complete_DataTable(){
        $user_id = $this->user_id;
        $sql = "SELECT *,
          DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
          DATE_FORMAT(terms_start, '%M %d %Y') as terms_start,
          DATE_FORMAT(terms_end, '%M %d %Y') as terms_end,
         (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator a LEFT JOIN tbl_project p ON a.id=p.assigned WHERE p.production_no=tbl_purchase_received.production_no) as requestor, 
         (SELECT item FROM tbl_materials WHERE id=tbl_purchase_received.item_no) as item,
         (SELECT unit FROM tbl_materials WHERE id=tbl_purchase_received.item_no) as unit,
         (SELECT name FROM tbl_supplier WHERE id=tbl_purchase_received.item_no) as supplier
         FROM tbl_purchase_received WHERE type=2 AND created_by='$user_id'";
          $query = $this->db->query($sql);
          if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row)  { 
                if($row->payment==1){$terms ='<span style="width: 112px;" class="d-block"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Cash</span></span>';
                }else if($row->payment == 2){$terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';}
            $production_no = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->production_no.'</span><span class="text-muted font-weight-bold">'.$row->fund_no.'</span>';
                   ($row->unit)?$unit = ' '.$row->unit.'(s)':$unit = "";
                     $data[] = array(
                          'production_no' => $row->production_no,
                          'item'          => $row->item.$unit,
                          'quantity'      => $row->quantity,
                          'amount'        => number_format($row->amount,2),
                          'supplier'      => $row->supplier,
                          'terms'         => $terms,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created);
            }      
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
    
      function Material_Request_Stocks_DataTable(){       
            $query =  $this->db->select('mp.*,p.*,d.*,c.*,m.*,mp.status as status,
                DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,
                CONCAT(u.fname, " ",u.lname) AS requestor')
               ->from('tbl_material_project as mp')
               ->join('tbl_materials as m','mp.item_no=m.id','LEFT')
               ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
               ->join('tbl_project_color as c','p.c_code=c.id','LEFT')
               ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
               ->join('tbl_administrator as u','u.id=p.production','LEFT')
               ->where('mp.balance_quantity >', 0)->where('p.type',1)->group_by('mp.production_no')->order_by('mp.latest_update','DESC')->get(); 
         if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row)  
            {
               $action = ' <button data-toggle="modal" data-target="#modal-form" id="form-request-inprogress" data-id="'.$row->production_no.'" class="btn btn-icon btn-light-dark btn-hover-primark btn-sm mx-3" title="View Request"><i class="la la-eye"></i></button>';  
              $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                     $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created,
                          'status'        => $row->status,
                          'action'        => $action);

            }      
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     } 
    function Material_Complete_Stocks_DataTable(){
         $query =  $this->db->select('*,mp.production_no,
              mp.quantity as quantity,m.item,m.unit,
            DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,
            CONCAT(u.fname, " ",u.lname) AS requestor')
        ->from('tbl_material_release as mp')
        ->join('tbl_materials as m','mp.item_no=m.id','LEFT')
        ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
        ->join('tbl_administrator as u','u.id=p.production','LEFT')->where('mp.type',1)
        ->order_by('mp.date_created','DESC')->get(); 
          if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
                    ($row->unit)?$unit = ' '.$row->unit.'(s)':$unit = "";
                     $data[] = array( 'production_no' => $row->production_no,
                                      'item'          => $row->item.$unit,
                                      'quantity'      => $row->quantity,
                                      'requestor'     => $row->requestor,
                                      'date_created'  => $row->date_created);
            }      
         }else{   
              $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
    function Material_Request_Project_DataTable(){       
            $query =  $this->db->select('mp.*,p.*,d.*,c.*,m.*,mp.status as status,
                DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,c.image,
                CONCAT(u.fname, " ",u.lname) AS requestor')
               ->from('tbl_material_project as mp')
               ->join('tbl_materials as m','mp.item_no=m.id','LEFT')
               ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
               ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
               ->join('tbl_project_color as c','d.id=c.project_no','LEFT')
               ->join('tbl_administrator as u','u.id=p.production','LEFT')
               ->where('mp.balance_quantity >', 0)->where('p.type',2)->group_by('mp.production_no')->order_by('mp.latest_update','DESC')->get(); 
         if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row)  {
               $action = ' <button data-toggle="modal" data-target="#modal-form" id="form-request-inprogress" data-id="'.$row->production_no.'" class="btn btn-icon btn-light-dark btn-hover-primark btn-sm mx-3" title="View Request"><i class="la la-eye"></i></button>';  
              $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
                     $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created,
                          'status'        => $row->status,
                          'action'        => $action);

            }      
         }else{   
              $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     } 
    function Material_Complete_Project_DataTable(){
        $query =  $this->db->select('*,
            mp.quantity,m.item,m.unit,
            DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,
            CONCAT(u.fname, " ",u.lname) AS requestor')
        ->from('tbl_material_release as mp')
        ->join('tbl_materials as m','mp.item_no=m.id','LEFT')
        ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
        ->join('tbl_administrator as u','u.id=p.production','LEFT')->where('mp.type',2)
        ->order_by('mp.date_created','DESC')->get(); 
          if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
                      ($row->unit)?$unit = ' '.$row->unit.'(s)':$unit = "";
                     $data[] = array( 'production_no' => $row->production_no,
                                      'item'          => $row->item.$unit,
                                      'quantity'      => $row->quantity,
                                      'requestor'     => $row->requestor,
                                      'date_created'  => $row->date_created);
            }      
         }else{   
              $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }
    function Joborder_Stocks_Request_DataTable(){
          $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
             (SELECT c_name FROM tbl_project_color WHERE id=tbl_project.c_code) as c_name,
             (SELECT image FROM tbl_project_color WHERE id=tbl_project.c_code) as image,
             (SELECT c_image FROM tbl_project_color WHERE id=tbl_project.c_code) as c_image,
             (SELECT title FROM tbl_project_design WHERE id=tbl_project.project_no) as title,
             (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project.assigned) as requestor
             FROM tbl_project WHERE type=1 AND status=4");

         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
             $action = '<a  href="'.base_url().'gh/designer/joborder-update-stocks?URI='.base64_encode($row->production_no).'" class="btn btn-sm btn-dark btn-icon"><i class="flaticon2-pen"></i></a>'; 
              $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
             $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
     function Joborder_Stocks_Pending_DataTable(){   
         $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
             (SELECT c_name FROM tbl_project_color WHERE id=tbl_project.c_code) as c_name,
             (SELECT image FROM tbl_project_color WHERE id=tbl_project.c_code) as image,
             (SELECT c_image FROM tbl_project_color WHERE id=tbl_project.c_code) as c_image,
             (SELECT title FROM tbl_project_design WHERE id=tbl_project.project_no) as title,
             (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project.assigned) as requestor
             FROM tbl_project WHERE type=1 AND status=1 AND assigned='".$this->user_id."'");

         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
             $action = '<button type="button" class="btn btn-sm btn-dark btn-icon" id="form-request" data-id="'.$row->production_no.'"><i class="flaticon2-pen"></i></button>'; 
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
              $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
        } 
        function Joborder_Stocks_Complete_DataTable(){  
         $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
             (SELECT c_name FROM tbl_project_color WHERE id=tbl_project_finished.c_code) as c_name,
             (SELECT image FROM tbl_project_color WHERE id=tbl_project_finished.c_code) as image,
             (SELECT c_image FROM tbl_project_color WHERE id=tbl_project_finished.c_code) as c_image,
             (SELECT title FROM tbl_project_design WHERE id=tbl_project_finished.project_no) as title,
             (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_finished.assigned) as requestor
             FROM tbl_project_finished WHERE type=1 AND status=1 AND assigned='".$this->user_id."'");   
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created);
            }  
         }else{   
              $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
        } 
         function Joborder_Stocks_Cancelled_DataTable(){        
        $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
             (SELECT c_name FROM tbl_project_color WHERE id=tbl_project_finished.c_code) as c_name,
             (SELECT image FROM tbl_project_color WHERE id=tbl_project_finished.c_code) as image,
             (SELECT c_image FROM tbl_project_color WHERE id=tbl_project_finished.c_code) as c_image,
             (SELECT title FROM tbl_project_design WHERE id=tbl_project_finished.project_no) as title,
             (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_finished.assigned) as requestor
             FROM tbl_project_finished WHERE type=1 AND status=1 AND assigned='".$this->user_id."'"); 
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
             $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created);
            }  
         }else{   
              $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
        } 
        function Joborder_Stocks_Production_DataTable(){ 
         $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
             (SELECT c_name FROM tbl_project_color WHERE id=tbl_project.c_code) as c_name,
             (SELECT image FROM tbl_project_color WHERE id=tbl_project.c_code) as image,
             (SELECT c_image FROM tbl_project_color WHERE id=tbl_project.c_code) as c_image,
             (SELECT title FROM tbl_project_design WHERE id=tbl_project.project_no) as title,
             (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project.assigned) as requestor
             FROM tbl_project WHERE type=1 AND status=4 AND assigned='".$this->user_id."'");       

         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->production_no.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>'; 
                $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
            $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
        function Joborder_Project_Request_DataTable(){  
             $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
             (SELECT image FROM tbl_project_color WHERE project_no=tbl_project.project_no) as image,
             (SELECT title FROM tbl_project_design WHERE id=tbl_project.project_no) as title,
             (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project.assigned) as requestor
             FROM tbl_project WHERE type=2 AND status=4");       
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
                 $action = '<a  href="'.base_url().'gh/designer/joborder-update-project?URI='.base64_encode($row->production_no).'" class="btn btn-sm btn-light-dark btn-icon"><i class="flaticon2-pen"></i></a>'; 
                 $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
             $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
     function Joborder_Project_Pending_DataTable(){        
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')
          ->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_administrator as u','u.id=p.assigned','LEFT')->where('p.type',2)->where('p.status',1)->where('p.production',$this->user_id)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" id="form-request" data-id="'.$row->production_no.'"><i class="flaticon2-pen"></i></button>'; 
                 $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
                 $data[] = array('production_no' => $row->production_no,
                                'title'         => $title,
                                'requestor'     => $row->requestor,
                                'qty'           => $row->unit,
                                'date_created'  => $row->date_created,
                                'status'        => $row->status,
                                'action'        => $action);
            }  
         }else{   
            $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
      } 
      function Joborder_Project_Complete_DataTable(){        
           $user_id = $this->user_id;
           $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
               (SELECT image FROM tbl_project_color WHERE project_no=tbl_project_finished.project_no) as image,
               (SELECT title FROM tbl_project_design WHERE id=tbl_project_finished.project_no) as title,
               (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_finished.assigned) as requestor
               FROM tbl_project_finished WHERE status=1 AND type=2 AND assigned='$user_id'");  
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created);
            }  
         }else{   
             $data =array();
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
        } 
      function Joborder_Project_Cancelled_DataTable(){      
        $user_id = $this->user_id;
       $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
           (SELECT image FROM tbl_project_color WHERE project_no=tbl_project_finished.project_no) as image,
           (SELECT title FROM tbl_project_design WHERE id=tbl_project_finished.project_no) as title,
           (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_finished.assigned) as requestor
           FROM tbl_project_finished WHERE status=2 AND type=2 AND assigned='$user_id'");  
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->production_no.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>'; 
                $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
             $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
      } 
      function Joborder_Project_Production_DataTable(){        
          $query = $this->db->select('p.*,c.*,d.*,c.image as image,p.status as status,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_administrator as u','u.id=p.assigned','LEFT')->where('p.type',2)->where('p.status',4)->where('p.assigned',$this->user_id)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$row->production_no.'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>'; 
                $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created,
                          'action'        => $action);
            }  
         }else{   
             $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
       function Joborder_Masterlist_Stocks_DataTable(){        
          $query = $this->db->select('p.*,c.*,d.*,p.status,c.image as image,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_finished as p')->join('tbl_project_color as c','c.id=p.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_administrator as u','u.id=p.assigned','LEFT')->where('p.type',1)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
              if($row->status==1){$status = '<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Complete</span></span>';}else{$status ='<span style="width: 112px;"><span class="label label-danger label-dot mr-2"></span><span class="font-weight-bold text-danger">Cancelled</span></span>';};
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
             $data =array();   
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
      function Joborder_Masterlist_Project_DataTable(){        
          $query = $this->db->select('p.*,c.*,d.*,p.status,c.image,DATE_FORMAT(p.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_finished as p')->join('tbl_project_design as d','d.id=p.project_no','LEFT')->join('tbl_project_color as c','d.id=c.project_no','LEFT')->join('tbl_administrator as u','u.id=p.assigned','LEFT')->where('p.type',2)->order_by('p.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
               if($row->status==1){$status = '<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Complete</span></span>';}else{$status ='<span style="width: 112px;"><span class="label label-danger label-dot mr-2"></span><span class="font-weight-bold text-danger">Cancelled</span></span>';};
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
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     } 
     function Joborder_Stocks_Supervisor_DataTable(){
         $data =array();    
         $query = $this->db->query("SELECT *,
            DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
           (SELECT image FROM tbl_project_color WHERE id=tbl_project.c_code) as image,
           (SELECT title FROM tbl_project_design WHERE id=tbl_project.project_no) as title,
           (SELECT c_image FROM tbl_project_color WHERE id=tbl_project.c_code) as c_image,
           (SELECT c_name FROM tbl_project_color WHERE id=tbl_project.c_code) as c_name,
           (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project.assigned) as requestor
           FROM tbl_project WHERE status !=4 AND type=1"); 
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
              $action = '<button type="button" class="btn btn-icon btn-light-dark btn-hover-success btn-sm mx-3" id="form-request" data-id="'.$row->production_no.'"><i class="flaticon2-pen"></i></button>';
            $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'qty'           => $row->unit,
                          'date_created'  => $row->date_created,
                          'status'        => $row->status,
                          'action'        => $action);
            }  
         }
         return array("data" =>$data); 
     }
     function Joborder_Stocks_Cancelled_Supervisor_DataTable(){
          $data =array();   
          $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
           (SELECT image FROM tbl_project_color WHERE project_no=tbl_project_finished.c_code) as image,
           (SELECT title FROM tbl_project_design WHERE id=tbl_project_finished.project_no) as title,
           (SELECT c_image FROM tbl_project_color WHERE id=tbl_project_finished.c_code) as c_image,
           (SELECT c_name FROM tbl_project_color WHERE id=tbl_project_finished.c_code) as c_name,
           (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_finished.assigned) as requestor
           FROM tbl_project_finished WHERE status=2 AND type=1");        
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                    $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                     $data[] = array(
                              'production_no' => $row->production_no,
                              'title'         => $title,
                              'qty'           => $row->unit,
                              'requestor'     => $row->requestor,
                              'date_created'  => $row->date_created);
                }  
         }
         return array("data" =>$data);
      } 
      function Joborder_Stocks_Completed_Supervisor_DataTable(){
         $data =array();   
         $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
           (SELECT image FROM tbl_project_color WHERE project_no=tbl_project_finished.c_code) as image,
           (SELECT title FROM tbl_project_design WHERE id=tbl_project_finished.project_no) as title,
           (SELECT c_image FROM tbl_project_color WHERE id=tbl_project_finished.c_code) as c_image,
           (SELECT c_name FROM tbl_project_color WHERE id=tbl_project_finished.c_code) as c_name,
           (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_finished.assigned) as requestor
           FROM tbl_project_finished WHERE status=1 AND type=1");             
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){ 
                   $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                     $data[] = array(
                              'production_no' => $row->production_no,
                              'title'         => $title,
                              'qty'           => $row->unit,
                              'requestor'     => $row->requestor,
                              'date_created'  => $row->date_created);
                }  
         }
         return array("data" =>$data);
      } 
     function Joborder_Project_Supervisor_DataTable(){
         $data =array();  
         $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
           (SELECT image FROM tbl_project_color WHERE project_no=tbl_project.project_no) as image,
           (SELECT title FROM tbl_project_design WHERE id=tbl_project.project_no) as title,
           (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project.assigned) as requestor
           FROM tbl_project WHERE status !=4 AND type=2"); 
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
              $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-icon btn-light-dark btn-hover-success btn-sm mx-3" id="form-request" data-id="'.$row->production_no.'"  data-toggle="tooltip" data-theme="dark" title="View details"><i class="flaticon2-pen"></i></button></div>';
             $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
                 $data[] = array(
                          'production_no' => $row->production_no,
                          'title'         => $title,
                          'requestor'     => $row->requestor,
                          'date_created'  => $row->date_created,
                          'status'        => $row->status,
                          'action'        => $action);
            }  
         }
         return array("data" =>$data); 
     }
      function Joborder_Project_Cancelled_Supervisor_DataTable(){
          $data =array();   
          $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
           (SELECT image FROM tbl_project_color WHERE project_no=tbl_project_finished.project_no) as image,
           (SELECT title FROM tbl_project_design WHERE id=tbl_project_finished.project_no) as title,
           (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_finished.assigned) as requestor
           FROM tbl_project_finished WHERE status=2 AND type=2");        
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                    $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
                     $data[] = array(
                              'production_no' => $row->production_no,
                              'title'         => $title,
                              'requestor'     => $row->requestor,
                              'date_created'  => $row->date_created);
                }  
         }
         return array("data" =>$data); 
      } 
      function Joborder_Project_Completed_Supervisor_DataTable(){
          $data =array();   
         $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
           (SELECT image FROM tbl_project_color WHERE project_no=tbl_project_finished.project_no) as image,
           (SELECT title FROM tbl_project_design WHERE id=tbl_project_finished.project_no) as title,
           (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_finished.assigned) as requestor
           FROM tbl_project_finished WHERE status=1 AND type=2");             
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                    $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a  class="text-muted font-weight-bold text-hover-primary"></a></div></div></div></span>';
                     $data[] = array(
                              'production_no' => $row->production_no,
                              'title'         => $title,
                              'requestor'     => $row->requestor,
                              'date_created'  => $row->date_created);
                }  
         }
         return array("data" =>$data); 
      } 

     function Salesorder_Stocks_Request_DataTable_Production(){
        $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')->where('s.created_by', $this->user_id)->where('s.status','PENDING')->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $status='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Request</span></span>';
           $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         return array("data" =>$data); 
     }
     function Salesorder_Stocks_Approved_DataTable_Production(){
        $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.status','APPROVED')->where('s.created_by', $this->user_id)->order_by('s.latest_update','DESC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $status='<span style="width: 112px;"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Approved</span></span>';
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'"data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
            $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         return array("data" =>$data); 
     }
     function Salesorder_Stocks_Completed_DataTable_Production(){
       $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.status','COMPLETED')->where('s.created_by', $this->user_id)->order_by('s.latest_update','DESC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
             $status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Completed</span></span>';
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
              $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         return array("data" =>$data); 
     }
     function Salesorder_Stocks_Cancelled_DataTable_Production(){
       $data=array(); 
       $user_id = $this->user_id;
       $query = $this->db->query("SELECT *, DATE_FORMAT(date_order, '%M %d %Y') as date_created,
        (SELECT fullname FROM tbl_salesorder_customer WHERE id=tbl_salesorder_stocks.customer) as fullname
        FROM tbl_salesorder_stocks WHERE status='CANCELLED' AND created_by='$user_id'");
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $status='<span style="width: 112px;"><span class="label label-danger label-dot mr-2"></span><span class="font-weight-bold text-danger">Cancelled</span></span>';
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button><button type="button" class="btn btn-sm btn-light-dark btn-icon btn-remarks" data-remarks="'.$row->remarks.'"  data-trans="'.$row->so_no.'" data-toggle="tooltip" data-theme="dark" title="Remarks"><i class="la la-comment"></i></button></div>';  
              $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         return array("data" =>$data); 
     }

     function Salesorder_Project_Request_DataTable_Production(){
        $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')->where('s.status','PENDING')->where('s.created_by', $this->user_id)->order_by('s.date_created','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
            $status='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Request</span></span>';
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         return array("data" =>$data);
     }
     function Salesorder_Project_Approved_DataTable_Production(){
        $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.status','APPROVED')
       ->where('s.created_by', $this->user_id)->order_by('s.latest_update','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
            $status='<span style="width: 112px;"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Approved</span></span>';  
             $data[] = array(
                       'so_no'       => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         return array("data" =>$data);
     }
     function Salesorder_Project_Completed_DataTable_Production(){
       $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.status','COMPLETED')->where('s.created_by', $this->user_id)->order_by('s.latest_update','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>'; 
            $status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Completed</span></span>';   
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }

     function Salesorder_Project_Cancelled_DataTable_Production(){
       $data=array(); 
        $query = $this->db->query("SELECT *, DATE_FORMAT(date_order, '%M %d %Y') as date_created,
        (SELECT fullname FROM tbl_salesorder_customer WHERE id=tbl_salesorder_project.customer) as fullname
        FROM tbl_salesorder_project WHERE status='CANCELLED' AND created_by='$user_id'");
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
             $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button><button type="button" class="btn btn-sm btn-light-dark btn-icon btn-remarks" data-remarks="'.$row->remarks.'"  data-trans="'.$row->so_no.'" data-toggle="tooltip" data-theme="dark" title="Remarks"><i class="la la-comment"></i></button></div>';  
             $status='<span style="width: 112px;"><span class="label label-danger label-dot mr-2"></span><span class="font-weight-bold text-danger">Cancelled</span></span>';   
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }

     function Salesorder_Stocks_Request_DataTable_Accounting(){
        $data=array(); 
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(date_order, '%M %d %Y') as date_created,
            DATE_FORMAT(terms_start, '%M %d %Y') as terms_start,
            DATE_FORMAT(terms_end, '%M %d %Y') as terms_end,
            (SELECT fullname FROM tbl_salesorder_customer WHERE id=tbl_salesorder_stocks.customer) as fullname FROM tbl_salesorder_stocks WHERE status='PENDING'");
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
                $terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';

            $status='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Request</span></span>';
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-approved" data-id="'.$this->encryption->encrypt($row->id).'" data-trans="'.$row->so_no.'"  data-status="APPROVED" data-toggle="tooltip" data-theme="dark" title="Move to approve"><i class="la la-check"></i></button>
                    <button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-cancelled" data-id="'.$this->encryption->encrypt($row->id).'" data-trans="'.$row->so_no.'" data-status="CANCELLED" data-toggle="tooltip" data-theme="dark" title="Cancel"><i class="la la-remove"></i></button>
                    <button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'terms'        => $terms,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         return array("data" =>$data); 
     }
     function Salesorder_Stocks_Approved_DataTable_Accounting(){
       $data=array(); 
       $query = $this->db->query("SELECT *,
        DATE_FORMAT(date_order, '%M %d %Y') as date_created,
        DATE_FORMAT(terms_start, '%M %d %Y') as terms_start,
        DATE_FORMAT(terms_end, '%M %d %Y') as terms_end,
        (SELECT fullname FROM tbl_salesorder_customer WHERE id=tbl_salesorder_stocks.customer) as fullname FROM tbl_salesorder_stocks WHERE status='APPROVED'");
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
                $terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';
            $status='<span style="width: 112px;"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Approved</span></span>';
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-approved" data-id="'.$this->encryption->encrypt($row->id).'" data-trans="'.$row->so_no.'" data-status="COMPLETED" data-toggle="tooltip" data-theme="dark" title="Move to complete"><i class="la la-check"></i></button>
                <button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-cancelled" data-id="'.$this->encryption->encrypt($row->id).'" data-trans="'.$row->so_no.'" data-status="CANCELLED" data-toggle="tooltip" data-theme="dark" title="Cancel"><i class="la la-remove"></i></button>
                <button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
            $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'date_created' => $row->date_created,
                      'terms'        => $terms,
                      'status'       => $status,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Stocks_Completed_DataTable_Accounting(){
       $data=array(); 
      $query = $this->db->query("SELECT *,
        DATE_FORMAT(date_order, '%M %d %Y') as date_created,
        DATE_FORMAT(terms_start, '%M %d %Y') as terms_start,
        DATE_FORMAT(terms_end, '%M %d %Y') as terms_end,
        (SELECT fullname FROM tbl_salesorder_customer WHERE id=tbl_salesorder_stocks.customer) as fullname FROM tbl_salesorder_stocks WHERE status='COMPLETED'");
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
                $terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';
             $status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Completed</span></span>';
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button>';  
              $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'terms'        => $terms,
                      'status'       => $status,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         return array("data" =>$data); 
     }
     function Salesorder_Stocks_Cancelled_DataTable_Accounting(){
        $data=array(); 
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(date_order, '%M %d %Y') as date_created,
        DATE_FORMAT(terms_start, '%M %d %Y') as terms_start,
        DATE_FORMAT(terms_end, '%M %d %Y') as terms_end,
        (SELECT fullname FROM tbl_salesorder_customer WHERE id=tbl_salesorder_stocks.customer) as fullname FROM tbl_salesorder_stocks WHERE status='CANCELLED'");
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';
            $status='<span style="width: 112px;"><span class="label label-danger label-dot mr-2"></span><span class="font-weight-bold text-danger">Cancelled</span></span>';
           $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button><button type="button" class="btn btn-sm btn-light-dark btn-icon btn-remarks" data-remarks="'.$row->remarks.'"  data-trans="'.$row->so_no.'" data-toggle="tooltip" data-theme="dark" title="Remarks"><i class="la la-comment"></i></button></div>';  
              $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'terms'        => $terms,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         return array("data" =>$data); 
     }

     function Salesorder_Project_Request_DataTable_Accounting(){
       $data=array(); 
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(date_order, '%M %d %Y') as date_created,
        DATE_FORMAT(terms_start, '%M %d %Y') as terms_start,
        DATE_FORMAT(terms_end, '%M %d %Y') as terms_end,
        (SELECT fullname FROM tbl_salesorder_customer WHERE id=tbl_salesorder_project.customer) as fullname FROM tbl_salesorder_project WHERE status='PENDING'");

      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-approved" data-id="'.$this->encryption->encrypt($row->id).'"data-trans="'.$row->so_no.'"  data-status="APPROVED" data-toggle="tooltip" data-theme="dark" title="Move to approve"><i class="la la-check"></i></button>
                    <button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-cancelled" data-id="'.$this->encryption->encrypt($row->id).'" data-trans="'.$row->so_no.'" data-status="CANCELLED" data-toggle="tooltip" data-theme="dark" title="Cancel"><i class="la la-remove"></i></button>
                    <button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
            $status='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Request</span></span>';
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'terms'        => $terms,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Project_Approved_DataTable_Accounting(){
        $data=array(); 
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(date_order, '%M %d %Y') as date_created,
        DATE_FORMAT(terms_start, '%M %d %Y') as terms_start,
        DATE_FORMAT(terms_end, '%M %d %Y') as terms_end,
        (SELECT fullname FROM tbl_salesorder_customer WHERE id=tbl_salesorder_project.customer) as fullname FROM tbl_salesorder_project WHERE status='APPROVED'");
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
             $terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-approved" data-id="'.$this->encryption->encrypt($row->id).'" data-trans="'.$row->so_no.'" data-status="COMPLETED" data-toggle="tooltip" data-theme="dark" title="Move to complete"><i class="la la-check"></i></button>
                    <button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-cancelled" data-id="'.$this->encryption->encrypt($row->id).'" data-trans="'.$row->so_no.'" data-status="CANCELLED" data-toggle="tooltip" data-theme="dark" title="Cancel"><i class="la la-remove"></i></button>
                    <button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'"  data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
            $status='<span style="width: 112px;"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Approved</span></span>';  
             $data[] = array(
                       'so_no'       => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'terms'        => $terms,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Salesorder_Project_Completed_DataTable_Accounting(){
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(date_order, '%M %d %Y') as date_created,
        DATE_FORMAT(terms_start, '%M %d %Y') as terms_start,
        DATE_FORMAT(terms_end, '%M %d %Y') as terms_end,
        (SELECT fullname FROM tbl_salesorder_customer WHERE id=tbl_salesorder_project.customer) as fullname FROM tbl_salesorder_project WHERE status='COMPLETED'");
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
              $terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>'; 
            $status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Completed</span></span>';   
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'terms'        => $terms,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }

     function Salesorder_Project_Cancelled_DataTable_Accounting(){
       $data=array(); 
       $query = $this->db->query("SELECT *,
        DATE_FORMAT(date_order, '%M %d %Y') as date_created,
        DATE_FORMAT(terms_start, '%M %d %Y') as terms_start,
        DATE_FORMAT(terms_end, '%M %d %Y') as terms_end,
        (SELECT fullname FROM tbl_salesorder_customer WHERE id=tbl_salesorder_project.customer) as fullname FROM tbl_salesorder_project WHERE status='CANCELLED'");
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
             $terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button><button type="button" class="btn btn-sm btn-light-dark btn-icon btn-remarks" data-remarks="'.$row->remarks.'" data-trans="'.$row->so_no.'" data-toggle="tooltip" data-theme="dark" title="Remarks"><i class="la la-comment"></i></button></div>';  
             $status='<span style="width: 112px;"><span class="label label-danger label-dot mr-2"></span><span class="font-weight-bold text-danger">Cancelled</span></span>';   
             $data[] = array(
                      'so_no'        => $row->so_no,
                      'customer'     => $row->fullname,
                      'mobile'       => $row->mobile,
                      'email'        => $row->email,
                      'status'       => $status,
                      'terms'        => $terms,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }













      
    function Salesorder_Stocks_Request_DataTable_Admin(){
       $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_administrator as u','u.id=s.created_by','LEFT')
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
     function Salesorder_Stocks_Approved_DataTable_Admin(){
       $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_administrator as u','u.id=s.created_by','LEFT')
       ->where('s.status','A')->where('s.update_by', $this->user_id)->order_by('s.date_created','ASC')->get();
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
     function Salesorder_Stocks_Rejected_DataTable_Admin(){
       $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')
       ->from('tbl_salesorder_stocks as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_administrator as u','u.id=s.created_by','LEFT')
       ->where('s.status','C')->where('s.update_by', $this->user_id)->order_by('s.date_created','ASC')->get();
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
    function Salesorder_Project_Request_DataTable_Admin(){
       $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_administrator as u','u.id=s.created_by','LEFT')
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
     function Salesorder_Project_Approved_DataTable_Admin(){
       $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_administrator as u','u.id=s.created_by','LEFT')
       ->where('s.status','A')->where('s.update_by', $this->user_id)->order_by('s.date_created','ASC')->get();
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
     function Salesorder_Project_Rejected_DataTable_Admin(){
       $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,s.status,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')
       ->from('tbl_salesorder_project as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->join('tbl_administrator as u','u.id=s.created_by','LEFT')
       ->where('s.status','CANCELLED')->where('s.update_by', $this->user_id)->order_by('s.date_created','ASC')->get();
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







      function Sales_Delivery_Request_DataTable_Superuser(){
       $data=array(); 
       $query = $this->db->select('*,s.id,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_sales_delivery_header as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.status','PENDING')->order_by('s.date_order','ASC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-approved" data-id="'.$this->encryption->encrypt($row->id).'" data-dr="'.$row->dr_no.'"  data-status="TO-SHIP" data-toggle="tooltip" data-theme="dark" title="Move to ship"><i class="la la-check"></i></button>
                    <button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-cancelled" data-id="'.$this->encryption->encrypt($row->id).'" data-dr="'.$row->dr_no.'" data-status="CANCELLED" data-toggle="tooltip" data-theme="dark" title="Cancel"><i class="la la-remove"></i></button>
                    <button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
             $trans_num = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->dr_no.'</span><span class="text-muted font-weight-bold">'.$row->so_no.'</span>';  
             $data[] = array(
                      'so_no'        => $trans_num,
                      'customer'     => $row->fullname,
                      'email'        => $row->email,
                      'mobile'       => $row->mobile,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }

      function Sales_Delivery_Ship_DataTable_Superuser(){
        $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_sales_delivery_header as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.status','TO-SHIP')->order_by('s.date_created','DESC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-approved" data-id="'.$this->encryption->encrypt($row->id).'" data-dr="'.$row->dr_no.'"  data-status="TO-RECEIVED" data-toggle="tooltip" data-theme="dark" title="Move to receive"><i class="la la-check"></i></button>
                    <button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-cancelled" data-id="'.$this->encryption->encrypt($row->id).'" data-dr="'.$row->dr_no.'" data-status="CANCELLED" data-toggle="tooltip" data-theme="dark" title="Cancel"><i class="la la-remove"></i></button>
                    <button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
             $trans_num = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->dr_no.'</span><span class="text-muted font-weight-bold">'.$row->so_no.'</span>';  
             $data[] = array(
                      'so_no'        => $trans_num,
                      'customer'     => $row->fullname,
                      'email'        => $row->email,
                      'mobile'       => $row->mobile,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
      function Sales_Delivery_Received_DataTable_Superuser(){
       $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_sales_delivery_header as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.status','TO-RECEIVED')->order_by('s.latest_update','DESC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
             $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-approved" data-id="'.$this->encryption->encrypt($row->id).'" data-dr="'.$row->dr_no.'"  data-status="COMPLETED" data-toggle="tooltip" data-theme="dark" title="Move to complete"><i class="la la-check"></i></button>
                     <button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2 btn-cancelled" data-id="'.$this->encryption->encrypt($row->id).'" data-dr="'.$row->dr_no.'" data-status="CANCELLED"><i class="la la-remove"></i></button>
                    <button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button></div>';
             $trans_num = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->dr_no.'</span><span class="text-muted font-weight-bold">'.$row->so_no.'</span>';  
             $data[] = array(
                      'so_no'        => $trans_num,
                      'customer'     => $row->fullname,
                      'email'        => $row->email,
                      'mobile'       => $row->mobile,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Sales_Delivery_Completed_DataTable_Superuser(){
        $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_sales_delivery_header as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.status','COMPLETED')->order_by('s.latest_update','DESC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button>';
             $trans_num = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->dr_no.'</span><span class="text-muted font-weight-bold">'.$row->so_no.'</span>';  
             $data[] = array(
                      'so_no'        => $trans_num,
                      'customer'     => $row->fullname,
                      'email'        => $row->email,
                      'mobile'       => $row->mobile,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Sales_Delivery_Cancelled_DataTable_Superuser(){
       $data=array(); 
       $query = $this->db->select('s.*,c.*,s.id,DATE_FORMAT(s.date_order, "%M %d %Y") as date_created')
       ->from('tbl_sales_delivery_header as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
       ->where('s.status','CANCELLED')->order_by('s.latest_update','DESC')->get();
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-sm btn-light-dark btn-icon mr-2" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal" data-toggle="tooltip" data-theme="dark" title="View details"><i class="la la-eye"></i></button>
                <button type="button" class="btn btn-sm btn-light-dark btn-icon btn-remarks" data-id="'.$this->encryption->encrypt($row->id).'" data-dr="'.$row->dr_no.'" data-remarks="'.$row->remarks.'";><i class="la la-comment"></i></button></div>';
             $trans_num = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->dr_no.'</span><span class="text-muted font-weight-bold">'.$row->so_no.'</span>';  
             $data[] = array(
                      'so_no'        => $trans_num,
                      'customer'     => $row->fullname,
                      'email'        => $row->email,
                      'mobile'       => $row->mobile,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }



     
















     function Request_Material_List_Datatable(){
           $data=array(); 
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_other_material_m_request')->where('status',1)->where('created_by',$this->user_id)->order_by('id','DESC')->get();
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
     function Request_Material_Received_Datatable(){
        $data=array(); 
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_other_material_m_received')->where('created_by',$this->user_id)->order_by('id','DESC')->get();
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
     function Request_Material_Cancalled_Datatable(){
        $data=array(); 
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_other_material_m_request')->where('status',3)->where('created_by',$this->user_id)->order_by('id','DESC')->get();
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
           $data=array(); 
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
        $data=array(); 
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
        $data=array(); 
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
           $data=array(); 
           $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_return_item_warehouse')->where('status',1)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            $no = 1;
            foreach($query->result() as $row){
                $no++; 
            if($row->type == 1){$type = 'Raw Materials';}else if($row->type==2){$type='Office & Janitorial Supplies';}else{$type ='Spare Parts';}
                 $data[] = array(
                          'no'  => $no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'remarks' => $row->remarks,
                          'type'=>$type,
                          'date_created'=> $row->date_created);
            } 
                
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Return_Item_Rejected_DataTable_Superuser(){
         $data=array(); 
          $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y") as date_created')->from('tbl_return_item_warehouse')->where('status',2)->order_by('id','DESC')->get();
          if($query !== FALSE && $query->num_rows() > 0){
            $no = 1;
            foreach($query->result() as $row){
                $no++; 
                if($row->type == 1){$type = 'Raw Materials';}else if($row->type==2){$type='Office & Janitorial Supplies';}else{$type ='Spare Parts';};
                 $data[] = array(
                          'no'  => $no,
                          'item' => $row->item,
                          'quantity'=> $row->qty,
                          'remarks' => $row->remarks,
                          'type'=>$type,
                          'date_created'=> $row->date_created);
                } 
                
            }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Return_Item_Repair_Customer_DataTable_Superuser(){
           $data=array(); 
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
         $data=array(); 
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
         $data=array(); 
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
        $query = $this->db->select('*,DATE_FORMAT(date_registration , "%M %d %Y %r") as date_created')->from('tbl_administrator')->order_by('date_registration','DESC')->get();
            if($query !== FALSE && $query->num_rows() > 0){
                $count = 0;
              foreach($query->result() as $row){
                $stat ='';
                if($row->status==1){
                    $stat ='checked';
                }
                 $action = '<div class="d-flex flex-row">
                                        <div class="dropdown dropdown-inline">
                                            <a href="javascript:;" id="dropdownMenuButton" class="btn btn-icon btn-light btn-hover-primary btn-sm m-1" data-toggle="dropdown" aria-expanded="true">
                                                    <i class="la la-cog"></i>
                                                    </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="z-index: 9999;">
                                                <ul class="nav nav-hoverable flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="javascript:;">
                                                            <i class="nav-icon la la-leaf"></i>
                                                            <span class="nav-text">Status</span>
                                                            <span class="switch switch-sm switch-icon">
                                                                <label>
                                                                    <input type="checkbox" class="update_user_status" '.$stat.' data-id="'.$this->encryption->encrypt($row->id).'"><span></span>
                                                                </label>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <a href="javascript:;" class="btn btn-icon btn-light btn-hover-primary btn-sm m-1 view-details" data-id="'.$this->encryption->encrypt($row->id).'" title="View Details">
                                            <i class="la la-eye"></i>
                                        </a>
                                    </div>';
            $status = array(0=>array('state'=>'Inactive','color'=>'danger'),
                            1=>array('state'=>'Active','color'=>'success'));
            $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
            $image = '<span style="width: 250px;"><div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-2"><img class="" id="myImg" src="'.base_url().'assets/images/profile/'.$row->profile_img.'" alt="photo"></div>'. $row->username.'</span>';
               $fullname = $row->lname.' '.$row->fname;
               ++$count;
               $data[] = array(
                      'count'        => $count,
                      'username'     => $image,
                      'fullname'     => $fullname,
                      'date_created' => $row->date_created,
                      'status'       => $status_data,
                      'action'       => $action
                  );
            }  
             
         }else{   
             $data =array();    
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
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
     }
   


    //APPROVAL
   function Approval_Purchase_Request_DataTable(){       
             $array = array();
             $query =  $this->db->select('d.*,c.*,mp.*,p.*,mp.status as status,
                CONCAT(u.fname, " ",u.lname) AS requestor,
                DATE_FORMAT(mp.date_approved1, "%M %d %Y %r") as date_created')
               ->from('tbl_purchasing_project as mp')
               ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
               ->join('tbl_project_design as d','d.project_no=p.project_no','LEFT')
               ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
               ->join('tbl_administrator as u', 'u.id=p.production','LEFT')
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
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
     } 
     function Approval_Purchase_Approved_DataTable(){       
             $array = array('mp.admin_status =' => 'APPROVED','mp.approver2' => $this->user_id);
             $query =  $this->db->select('d.*,c.*,mp.*,p.*,mp.status as status,
                CONCAT(u.fname, " ",u.lname) AS requestor,
                DATE_FORMAT(mp.date_inprogress, "%M %d %Y %r") as date_created')
               ->from('tbl_purchasing_project as mp')
               ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
               ->join('tbl_project_design as d','d.project_no=p.project_no','LEFT')
               ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
               ->join('tbl_administrator as u', 'u.id=p.production','LEFT')
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
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
     } 
     function Approval_Purchase_Rejected_DataTable(){       
              $array = array('mp.status' => 'REJECTED', 'mp.approver2' => $this->user_id);  
              $date  = 'DATE_FORMAT(mp.date_rejected, "%M %d %Y %r") as date_created';
              $date_ = 'mp.date_rejected';
             $query =  $this->db->select('d.*,c.*,mp.*,p.*,mp.status as status,
                CONCAT(u.fname, " ",u.lname) AS requestor,DATE_FORMAT(mp.date_rejected, "%M %d %Y %r") as date_created')
               ->from('tbl_purchasing_project as mp')
               ->join('tbl_project as p','p.production_no=mp.production_no','LEFT')
               ->join('tbl_project_design as d','d.project_no=p.project_no','LEFT')
               ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
               ->join('tbl_administrator as u', 'u.id=p.production','LEFT')
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
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
     } 
   function Approval_Inspection_Stocks_Request_DataTable(){
    $query = $this->db->select('*,i.id,c.image as image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_inspection as i')
    ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
    ->join('tbl_project_design as d','d.id=j.project_no','LEFT')
    ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
    ->join('tbl_administrator as u', 'u.id=j.assigned','LEFT')
    ->where('i.status',1)
    ->where('i.type',1)
    ->group_by('i.production_no')
    ->order_by('i.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
                $action = '<button type="button" class="btn btn-light btn-hover-success btn-icon btn-sm mr-2 btn-approved" data-id="'.$this->encryption->encrypt($row->production_no).'" data-name="'.$row->title.'" data-status="2"><i class="la la-check"></i>
                </button><button type="button" class="btn btn-light btn-hover-danger btn-icon btn-sm mr-2 btn-cancelled" data-id="'.$this->encryption->encrypt($row->production_no).'" data-name="'.$row->title.'" data-status="3"><i class="la la-remove"></i></button>
                <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-stocks" data-id="'.$this->encryption->encrypt($row->production_no).'" ><i class="la la-eye"></i></button>';  
                $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                 $data[] = array('production_no'=> $row->production_no,
                                 'title'        => $title,
                                 'requestor'    => $row->requestor,
                                 'date_created' => $row->date_created,
                                 'action'       => $action);
             }  
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
      }
      function Approval_Inspection_Stocks_Approved_DataTable(){
        $query = $this->db->select('*,c.image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_inspection as i')
        ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
        ->join('tbl_project_design as d','d.id=j.project_no','LEFT')
        ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
        ->join('tbl_administrator as u', 'u.id=i.production','LEFT')
        ->where('i.status',2)
        ->where('i.type',1)
        ->group_by('i.ins_no')
        ->order_by('i.date_created','DESC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
                  foreach($query->result() as $row) {
                  $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-stocks-approved" data-id="'.$this->encryption->encrypt($row->production_no).'" data-trans="'.$this->encryption->encrypt($row->ins_no).'" ><i class="la la-eye"></i></button>';   
                  $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                     $data[] = array('production_no'=> $row->production_no,
                                     'title'        => $title,
                                     'requestor'    => $row->requestor,
                                     'date_created' => $row->date_created,
                                     'action'       => $action);
                 }  
             }else{   
                 $data =array();    
             }
             $json_data  = array("data" =>$data); 
             return $json_data; 
          }
       function Approval_Inspection_Stocks_Rejected_DataTable(){
         $query = $this->db->select('*,c.image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_inspection as i')
            ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
            ->join('tbl_project_design as d','d.id=j.project_no','LEFT')
            ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
            ->join('tbl_administrator as u', 'u.id=i.production','LEFT')
            ->where('i.status',3)
            ->where('i.type',1)
            ->group_by('i.ins_no')->order_by('i.date_created','DESC')->get();
                 if($query !== FALSE && $query->num_rows() > 0){
                      foreach($query->result() as $row) {
                       $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-stocks-approved" data-id="'.$this->encryption->encrypt($row->production_no).'" data-trans="'.$this->encryption->encrypt($row->ins_no).'" ><i class="la la-eye"></i></button>
                        <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm remarks-stocks" data-name="'.$row->title.'" data-remarks="'.$row->remarks.'"><i class="flaticon2 flaticon2-document"></i></button>';   
                       $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                         $data[] = array('production_no'=> $row->production_no,
                                         'title'        => $title,
                                         'requestor'    => $row->requestor,
                                         'date_created' => $row->date_created,
                                         'action'       => $action);
                     }  
                 }else{   
                     $data =array();    
                 }
                 $json_data  = array("data" =>$data); 
                 return $json_data; 
    }
   function Approval_Inspection_Project_Request_DataTable(){
    $query = $this->db->select('*,c.image as image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_inspection as i')->join('tbl_project as j','i.production_no=j.production_no','LEFT')->join('tbl_project_design as d','d.id=j.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_administrator as u', 'u.id=i.production','LEFT')->where('i.status',1)->where('i.type',2)->group_by('i.production_no')->order_by('i.date_created','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
                $action = '<button type="button" class="btn btn-light btn-hover-success btn-icon btn-sm mr-2 btn-approved" data-id="'.$this->encryption->encrypt($row->production_no).'" data-name="'.$row->title.'" data-status="2"><i class="la la-check"></i>
                </button><button type="button" class="btn btn-light btn-hover-danger btn-icon btn-sm mr-2 btn-cancelled" data-id="'.$this->encryption->encrypt($row->production_no).'" data-name="'.$row->title.'" data-status="3"><i class="la la-remove"></i></button>
                <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-project" data-id="'.$this->encryption->encrypt($row->production_no).'" ><i class="la la-eye"></i></button>';    
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"/></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                 $data[] = array('production_no'=> $row->production_no,
                                 'title'        => $title,
                                 'requestor'    => $row->requestor,
                                 'date_created' => $row->date_created,
                                 'action'       => $action);
             }  
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 
      }
      function Approval_Inspection_Project_Approved_DataTable(){
        $query = $this->db->select('*,c.image as image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_inspection as i')->join('tbl_project as j','i.production_no=j.production_no','LEFT')->join('tbl_project_design as d','d.id=j.project_no','LEFT')->join('tbl_project_color as c','c.project_no=d.id','LEFT')->join('tbl_administrator as u', 'u.id=i.production','LEFT')->where('i.status',2)->where('i.type',2)->group_by('i.ins_no')->order_by('i.date_created','DESC')->get();
             if($query !== FALSE && $query->num_rows() > 0){
                  foreach($query->result() as $row) {
                   $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-project-approved" data-id="'.$this->encryption->encrypt($row->production_no).'" data-trans="'.$this->encryption->encrypt($row->ins_no).'" ><i class="la la-eye"></i></button>';  
                   $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"/></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                     $data[] = array('production_no'=> $row->production_no,
                                     'title'        => $title,
                                     'requestor'    => $row->requestor,
                                     'date_created' => $row->date_created,
                                     'action'       => $action);
                 }  
             }else{   
                 $data =array();    
             }
             $json_data  = array("data" =>$data); 
             return $json_data; 
          }
       function Approval_Inspection_Project_Rejected_DataTable(){
         $query = $this->db->select('*,c.image as image,DATE_FORMAT(i.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_inspection as i')
            ->join('tbl_project as j','i.production_no=j.production_no','LEFT')
            ->join('tbl_project_design as d','d.id=j.project_no','LEFT')
            ->join('tbl_project_color as c','c.project_no=d.id','LEFT')
            ->join('tbl_administrator as u', 'u.id=i.production','LEFT')
            ->where('i.status',3)
            ->where('i.type',2)
            ->group_by('i.ins_no')->order_by('i.date_created','DESC')->get();
                 if($query !== FALSE && $query->num_rows() > 0){
                      foreach($query->result() as $row) {
                       $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-project-approved" data-id="'.$this->encryption->encrypt($row->production_no).'" data-trans="'.$this->encryption->encrypt($row->ins_no).'" ><i class="la la-eye"></i></button>
                        <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm remarks-project" data-name="'.$row->title.'" data-remarks="'.$row->remarks.'"><i class="flaticon2 flaticon2-document"></i></button>';
                       $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"/></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div></div></div></span>';
                         $data[] = array('production_no'=> $row->production_no,
                                         'title'        => $title,
                                         'requestor'    => $row->requestor,
                                         'date_created' => $row->date_created,
                                         'action'       => $action);
                     }  
                 }else{   
                     $data =array();    
                 }
                 $json_data  = array("data" =>$data); 
                 return $json_data; 
    }
      function Approval_Request_Salesorder_DataTable(){
        $data =array();    
        $query=$this->db->select('*,s.status,DATE_FORMAT(s.date_order, "%M %d %Y %r") as date_created,
            CONCAT(u.fname, " ",u.lname) AS sales_person')
            ->from('tbl_salesorder as s')
            ->join('tbl_administrator as u','u.id=s.created_by','LEFT')
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
       $data =array();    
       $query=$this->db->select('*,s.status,DATE_FORMAT(s.date_order, "%M %d %Y %r") as date_created,
            CONCAT(u.fname, " ",u.lname) AS sales_person')
            ->from('tbl_salesorder as s')
            ->join('tbl_administrator as u','u.id=s.created_by','LEFT')
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
        $data =array(); 
        $query=$this->db->select('*,s.status,DATE_FORMAT(s.date_order, "%M %d %Y %r") as date_created,
            CONCAT(u.fname, " ",u.lname) AS sales_person')
            ->from('tbl_salesorder as s')
            ->join('tbl_administrator as u','u.id=s.created_by','LEFT')
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
     function Approval_Design_Stocks_Request_DataTable(){
        $query = $this->db->query("SELECT *, DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
            (SELECT title FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS title,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_color.designer) AS requestor FROM tbl_project_color WHERE status=1 AND type=1");
            $data= array();
           if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
                $action = '<button type="button" class="btn btn-light btn-hover-success btn-icon btn-sm mr-2 btn-approved" data-id="'.$this->encryption->encrypt($row->id).'" data-name="'.$row->title.'" data-status="2"><i class="la la-check"></i></button>
               <button type="button" class="btn btn-light btn-hover-danger btn-icon btn-sm mr-2 btn-cancelled" data-id="'.$this->encryption->encrypt($row->id).'" data-name="'.$row->title.'" data-status="3"><i class="la la-remove"></i></button>
                <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-stocks" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button>';        
              $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
             $data[] = array(
                      'project_no'=> $row->c_code,
                      'title'=> $title,
                      'requestor' => $row->requestor,
                      'date_created' => $row->date_created,
                      'action' => $action);
            }  
             
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 

     }
      function Approval_Design_Stocks_Approved_DataTable(){
        $query = $this->db->query("SELECT *, DATE_FORMAT(date_approved, '%M %d %Y %r') as date_created,
            (SELECT title FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS title,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_color.designer) AS requestor FROM tbl_project_color WHERE status=2 AND type=1");
            $data= array();
           if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
               $action = ' <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-stocks" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button>';    
              $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
             $data[] = array(
                      'project_no'   => $row->c_code,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
             
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 

     }
     function Approval_Design_Stocks_Rejected_DataTable(){
        $query = $this->db->query("SELECT *, DATE_FORMAT(date_approved, '%M %d %Y %r') as date_created,
            (SELECT title FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS title,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_color.designer) AS requestor FROM tbl_project_color WHERE status=3 AND type=1");
            $data= array();
           if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row) {
            $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-stocks" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-eye"></i></button>
                        <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm remarks-stocks" data-name="'.$row->title.'" data-remarks="'.$row->remark.'"><i class="flaticon2 flaticon2-document"></i></button>';     
             $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
             $data[] = array(
                      'project_no'   => $row->c_code,
                      'title'        => $title,
                      'requestor'    => $row->requestor,
                      'date_created' => $row->date_created,
                      'action'       => $action);
            }  
             
         }
         $json_data  = array("data" =>$data); 
         return $json_data; 

     }
       function Approval_Design_Project_Request_DataTable(){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_administrator as u','u.id=c.designer')->where('c.status=1 AND c.type=2')->order_by('c.date_created','ASC')->get();
        $data= array();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
               $action = '
               <button type="button" class="btn btn-light btn-hover-success btn-icon btn-sm mr-2 btn-approved" data-id="'.$this->encryption->encrypt($row->id).'" data-name="'.$row->title.'" data-status="2"><i class="la la-check"></i></button>
               <button type="button" class="btn btn-light btn-hover-danger btn-icon btn-sm mr-2 btn-cancelled" data-id="'.$this->encryption->encrypt($row->id).'" data-name="'.$row->title.'" data-status="3"><i class="la la-remove"></i></button>
                <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-project" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button>';    
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
    function Approval_Design_Project_Approved_DataTable(){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_administrator as u','u.id=c.designer')->where('c.status =2 AND c.type=2')->order_by('c.date_created','ASC')->get();
        $data= array();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
              $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-project" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button>';    
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
    function Approval_Design_Project_Rejected_DataTable(){
        $query = $this->db->select('c.*,d.*,c.id as id,c.status as status,d.title as title,DATE_FORMAT(c.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_administrator as u','u.id=c.designer')->where('c.status=3 AND c.type=2')->order_by('c.date_approved','ASC')->get();
        $data= array();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row) {
               $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-project" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-eye"></i></button>
                        <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm remarks-project" data-name="'.$row->title.'" data-remarks="'.$row->remark.'"><i class="flaticon2 flaticon2-document"></i></button>'; 
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

    function Approval_UsersRequest_DataTable(){
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_administrator')->order_by('date_created','DESC')->get();
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
     function Accounting_Purchase_Material_Stocks(){
        $query =  $this->db->select('d.*,c.*,m.*,DATE_FORMAT(m.latest_update, "%M %d %Y") as date_created,m.status,
                     CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_purchasing_project as m')
        ->join('tbl_project as p','p.production_no=m.production_no','LEFT')->join('tbl_project_color as c','c.id=p.c_code','LEFT')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->join('tbl_administrator as u','u.id=m.purchaser','LEFT')->where_in('m.status',array(3,4,5))->where('p.type',1)->group_by('m.fund_no')->get();  
         $data=array();
        if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row){
                 if($row->status==3){$status ='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Request</span></span>';
                }else if($row->status == 4){$status ='<span style="width: 112px;"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Approved</span></span>';}else if($row->status == 5){$status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Completed</span></span>';}
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" id="view-request-form" data-id="'.$this->encryption->encrypt($row->fund_no).'"><i class="flaticon2-pen"></i></button>';   
                 $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
               $production_no = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->production_no.'</span><span class="text-primary font-weight-bold">'.$row->fund_no.'</span>';
                     $data[] = array(
                          'production_no'=> $production_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'status'       => $status,
                          'action'       => $action);
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;   
     }
    
          function Accounting_Purchase_Material_Stocks_Received(){
           $query = $this->db->select('d.*,c.*,m.*,m.status,
            DATE_FORMAT(m.date_created, "%M %d %Y") as date_created,
            CONCAT(u.fname, " ",u.lname) AS requestor')
           ->from('tbl_purchase_received as m')
           ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
           ->join('tbl_project_color as c','c.id=p.c_code','LEFT')
           ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
           ->join('tbl_administrator as u','u.id=m.purchaser','LEFT')
           ->where('p.type',1)->group_by('m.fund_no')->order_by('m.date_created')->get();  
             $data=array();
            if($query !== FALSE && $query->num_rows() > 0){
                foreach($query->result() as $row){
                     if($row->status==1){$status ='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Request</span></span>';
                     }else if($row->status == 2){$status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Completed</span></span>';}
                     $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" id="view-received-form" data-id="'.$this->encryption->encrypt($row->fund_no).'"><i class="flaticon2-pen"></i></button>';     
                    $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                   $production_no = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->production_no.'</span><span class="text-primary font-weight-bold">'.$row->fund_no.'</span>';
                if($row->payment==1){$terms ='<span style="width: 112px;" class="d-block"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Cash</span></span>';
                }else if($row->payment == 2){$terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';} 
                         $data[] = array(
                              'production_no'=> $production_no,
                              'title'        => $title,
                              'requestor'    => $row->requestor,
                              'date_created' => $row->date_created,
                              'status'       => $status,
                              'action'       => $action);
                }      
             }
             $json_data  = array("data" =>$data); 
             return $json_data; 
     }
      function Accounting_Purchase_Material_Project_Request(){
      $query =  $this->db->select('d.*,c.*,m.*,m.status,DATE_FORMAT(m.latest_update, "%M %d %Y") as date_created,
                     CONCAT(u.fname, " ",u.lname) AS requestor')
        ->from('tbl_purchasing_project as m')
        ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
        ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
        ->join('tbl_project_color as c','d.id=c.project_no','LEFT')
        ->join('tbl_administrator as u','u.id=m.purchaser','LEFT')
        ->where_in('m.status',array(3,4,5))->where('p.type',2)->group_by('m.fund_no')->get();  
         $data=array();
        if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row){
                 if($row->status==3){$status ='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Request</span></span>';
                }else if($row->status == 4){$status ='<span style="width: 112px;"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Approved</span></span>';}else if($row->status == 5){$status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Completed</span></span>';}
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" id="view-request-form" data-id="'.$this->encryption->encrypt($row->fund_no).'"><i class="flaticon2-pen"></i></button>';   
               $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
               $production_no = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->production_no.'</span><span class="text-primary font-weight-bold">'.$row->fund_no.'</span>';
                     $data[] = array(
                          'production_no'=> $production_no,
                          'title'        => $title,
                          'requestor'    => $row->requestor,
                          'date_created' => $row->date_created,
                          'status'       => $status,
                          'action'       => $action);
            }      
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  
     }
     function Accounting_Purchase_Material_Project_Received(){
      $query = $this->db->select('d.*,c.*,m.*,m.status,
            DATE_FORMAT(m.date_created, "%M %d %Y") as date_created,
            CONCAT(u.fname, " ",u.lname) AS requestor')
           ->from('tbl_purchase_received as m')
           ->join('tbl_project as p','p.production_no=m.production_no','LEFT')
           ->join('tbl_project_design as d','d.id=p.project_no','LEFT')
           ->join('tbl_project_color as c','d.id=c.project_no','LEFT')
           ->join('tbl_administrator as u','u.id=m.purchaser','LEFT')
           ->where('p.type',2)->group_by('m.fund_no')->order_by('m.date_created')->get();  
             $data=array();
            if($query !== FALSE && $query->num_rows() > 0){
                foreach($query->result() as $row){
                     if($row->status==1){$status ='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Request</span></span>';
                     }else if($row->status == 2){$status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Completed</span></span>';}
                    $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" id="view-received-form" data-id="'.$this->encryption->encrypt($row->fund_no).'"><i class="flaticon2-pen"></i></button>';     
                   $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'"></div><div class="ml-3"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></span>';
                   $production_no = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->production_no.'</span><span class="text-primary font-weight-bold">'.$row->fund_no.'</span>';
                if($row->payment==1){$terms ='<span style="width: 112px;" class="d-block"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Cash</span></span>';
                }else if($row->payment == 2){$terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';} 
                         $data[] = array(
                              'production_no'=> $production_no,
                              'title'        => $title,
                              'requestor'    => $row->requestor,
                              'date_created' => $row->date_created,
                              'status'       => $status,
                              'action'       => $action);
                }      
             }
             $json_data  = array("data" =>$data); 
             return $json_data;
     }

     function Account_Report_Collection_Daily($month,$year){
           $data =false;
            if($month == false || $year == false){
                $date = "MONTH(date_collect)=".date('m')." AND YEAR(date_collect)=".date('Y')."";
            }else{
                $date = "MONTH(date_collect)=".$month." AND YEAR(date_collect)=".$year."";
            }
            $query = $this->db->query("SELECT *,DATE_FORMAT(date_collect, '%M %d %Y') as date_created FROM tbl_sales_collection WHERE ".$date." ORDER BY date_collect ASC");   
             if($query){
                 foreach($query->result() as $row){
                     $gross = $row->amount / 1.12;
                     $vat = $row->amount - $gross;
                     $data[] = array(
                                  'so_no'        => $row->so_no,
                                  'customer'     => $row->customer,
                                  'bank'         => $row->bank,
                                  'gross'        => round($gross,2),
                                  'vat'          => round($vat,2),
                                  'amount'       => round($row->amount,2),
                                  'date_created' => $row->date_created);
                    }  
             }
             return $data;
     }
       function Account_Report_Collection_Weekly($month,$year){
             $data =false;
             $date = "MONTH(date_collect)=".$month." AND YEAR(date_collect)=".$year."";
             if($month == false || $year == false){
                $date = "MONTH(date_collect)=".date('m')." AND YEAR(date_collect)=".date('Y')."";
            }
            $query = $this->db->query("SELECT *,SUM(amount) AS amount,CONCAT(STR_TO_DATE(CONCAT(YEARWEEK(date_collect, 2), ' Sunday'), '%X%V %W'),' / ',STR_TO_DATE(CONCAT(YEARWEEK(date_collect, 2), ' Sunday'), '%X%V %W') + INTERVAL 6 DAY) AS date_created FROM tbl_sales_collection WHERE ".$date." GROUP BY YEARWEEK(date_collect, 2) ORDER BY YEARWEEK(date_collect, 2) ASC");
             if($query){
                 foreach($query->result() as $row){
                    $date_split = explode("/",$row->date_created);
                    $date_1 = date('M d, Y',strtotime($date_split[0]));
                    $date_2 = date('M d, Y',strtotime($date_split[1]));
                    $date_order =   $date_1.' - '. $date_2;
                     $gross = $row->amount / 1.12;
                     $vat = $row->amount - $gross;
                     $data[] = array('gross'=> round($gross,2),
                                     'vat'=> round($vat,2),
                                     'amount'=> round($row->amount,2),
                                     'date_created'=> $date_order);
                    }  
             }
             return $data;
     }
     function Account_Report_Collection_Monthly($month,$year){
           if($month == false || $year == false){$date = "YEAR(date_collect)=".date('Y')."";
            }else{$date = "YEAR(date_collect)=".$year."";}
           $data =false;
           $query = $this->db->query("SELECT *,SUM(amount) AS amount,DATE_FORMAT(date_collect, '%M') as date_created FROM tbl_sales_collection WHERE ".$date." GROUP BY MONTH(date_collect) ORDER BY MONTH(date_collect) ASC");
             if($query){
                 foreach($query->result() as $row)  {
                     $gross = $row->amount / 1.12;
                     $vat = $row->amount - $gross;
                     $data[] = array(
                                  'gross'        => round($gross,2),
                                  'vat'          => round($vat,2),
                                  'amount'       => round($row->amount,2),
                                  'date_created' => $row->date_created);
                }  
             }
             return $data;
     }
      function Account_Report_Collection_Yearly($year){
           $data =false;
           if($year == false){$date = "YEAR(date_collect)<=".date('Y')."";}else{$date = "YEAR(date_collect)<=".$year."";} 
            $query = $this->db->query("SELECT *,SUM(amount) AS amount,DATE_FORMAT(date_collect, '%Y') as date_created FROM tbl_sales_collection WHERE ".$date." GROUP BY YEAR(date_collect) ORDER BY YEAR(date_collect) ASC");  
             if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 $gross = $row->amount / 1.12;
                 $vat = $row->amount - $gross;
                 $data[] = array(
                              'gross'        => round($gross,2),
                              'vat'          => round($vat,2),
                              'amount'       => round($row->amount,2),
                              'date_created' => $row->date_created);
                }  
             }
            return $data;
     }



    function Account_Report_Salesorder_Daily($month,$year){
        if($month == false || $year == false){
            $date = "MONTH(s.date_order)=".date('m')." AND YEAR(s.date_order)=".date('Y')."";
        }else{
            $date = "MONTH(s.date_order)=".$month." AND YEAR(s.date_order)=".$year."";
        }
        $data =false; 
         $query = $this->db->select('s.*,c.*,DATE_FORMAT(s.date_order, "%M %d %Y") as date_order')
          ->from('tbl_salesorder_completed as s')->join('tbl_salesorder_customer as c','c.id=s.customer','LEFT')
          ->where($date)->order_by('s.date_order','DESC')->get();
            if($query !== FALSE && $query->num_rows() > 0){
                foreach($query->result() as $row){
                   $data[] = array('so_no'       => $row->so_no,
                                   'customer'    => $row->fullname,
                                   'vat'         => $row->vat,
                                   'discount'    => $row->discount,
                                   'downpayment' => $row->downpayment,
                                   'subtotal'    => $row->subtotal,
                                   'shipping_fee'=> $row->shipping_fee,
                                   'amount_due'  => $row->total_amount,
                                   'date_created'=> $row->date_order);
               }
           }
             return $data;

     }
     function Account_Report_Salesorder_Weekly($month,$year){
        $data =false; 
        if($month == false || $year == false){
            $date = "MONTH(date_order)=".date('m')." AND YEAR(date_order)=".date('Y')."";
        }else{
            $date = "MONTH(date_order)=".$month." AND YEAR(date_order)=".$year."";
        }
        $query = $this->db->query("SELECT *,SUM(vat) AS vat, SUM(discount) AS discount,SUM(downpayment) AS downpayment,SUM(subtotal) AS subtotal,SUM(shipping_fee) AS shipping_fee,SUM(total_amount) AS total_amount,
            CONCAT(STR_TO_DATE(CONCAT(YEARWEEK(date_order, 2), ' Sunday'), '%X%V %W'),' / ',STR_TO_DATE(CONCAT(YEARWEEK(date_order, 2), ' Sunday'), '%X%V %W') + INTERVAL 6 DAY) AS date_order FROM tbl_salesorder_completed WHERE ".$date." GROUP BY YEARWEEK(date_order, 2) ORDER BY YEARWEEK(date_order, 2) ASC");
            if($query){
                foreach($query->result() as $row){
                  $date_split = explode("/",$row->date_order);
                  $date_1 = date('M d, Y',strtotime($date_split[0]));
                  $date_2 = date('M d, Y',strtotime($date_split[1]));
                  $date_order =   $date_1.' - '. $date_2;
                   $data[] = array('so_no'       => $row->so_no,
                                   'vat'         => $row->vat,
                                   'discount'    => $row->discount,
                                   'downpayment' => $row->downpayment,
                                   'subtotal'    => $row->subtotal,
                                   'shipping_fee'=> $row->shipping_fee,
                                   'amount_due'  => $row->total_amount,
                                   'date_created'=> $date_order);
               }
           }
             return $data;

     }
      function Account_Report_Salesorder_Monthly($year){
        if($year == false){$date = "YEAR(date_order)=".date('Y')."";}else{$date = "YEAR(date_order)=".$year."";}
        $data =false;
         $query = $this->db->query("SELECT *,SUM(vat) AS vat, SUM(discount) AS discount,SUM(downpayment) AS downpayment,SUM(subtotal) AS subtotal,SUM(shipping_fee) AS shipping_fee,SUM(total_amount) AS total_amount,
            DATE_FORMAT(date_order, '%M') as date_order FROM tbl_salesorder_completed WHERE ".$date." GROUP BY MONTH(date_order) ORDER BY MONTH(date_order) ASC");
             if($query){
                foreach($query->result() as $row){
                   $data[] = array('so_no'       => $row->so_no,
                                   'vat'         => $row->vat,
                                   'discount'    => $row->discount,
                                   'downpayment' => $row->downpayment,
                                   'subtotal'    => $row->subtotal,
                                   'shipping_fee'=> $row->shipping_fee,
                                   'amount_due'  => $row->total_amount,
                                   'date_created'=> $row->date_order);
               }
            }
             return $data;

     }
      function Account_Report_Salesorder_Yearly($year){
        if($year == false){$date = "YEAR(date_order)=".date('Y')."";}else{$date = "YEAR(date_order)=".$year."";}
        $data =false;
        $query = $this->db->query("SELECT *,SUM(vat) AS vat, SUM(discount) AS discount,SUM(downpayment) AS downpayment,SUM(subtotal) AS subtotal,SUM(shipping_fee) AS shipping_fee,SUM(total_amount) AS total_amount,
            DATE_FORMAT(date_order, '%Y') as date_order
            FROM tbl_salesorder_completed WHERE ".$date." GROUP BY YEAR(date_order) ORDER BY YEAR(date_order) ASC");
            if($query !== FALSE && $query->num_rows() > 0){
                foreach($query->result() as $row){
                   $data[] = array('si_no'       => $row->so_no,
                                   'vat'         => $row->vat,
                                   'discount'    => $row->discount,
                                   'downpayment' => $row->downpayment,
                                   'subtotal'    => $row->subtotal,
                                   'shipping_fee'=> $row->shipping_fee,
                                   'amount_due'  => $row->total_amount,
                                   'date_created'=> $row->date_order);
               }
           }
          return $data;
     }
      function Account_Report_Project_Daily($year,$month){
            if($month == false || $year == false){
                $date = "MONTH(date_received)=".date('m')." AND YEAR(date_received)=".date('Y')."";
            }else{
                $date = "MONTH(date_received)=".$month." AND YEAR(date_received)=".$year."";
            }   
            $data =false;
            $query = $this->db->select('*,DATE_FORMAT(date_received, "%M %d %Y") as date_created')
                ->from('tbl_pettycash')->where($date)->where('status',2)->order_by('date_received','ASC')->get();
              if($query){
             foreach($query->result() as $row)  {
                 $gross = $row->total_amount / 1.12;
                 $vat = $gross*0.12;
                 $data[] = array(
                            'fund_no'           => $row->fund_no,
                            'pettycash'         => round($row->pettycash,2),
                            'change'            => round($row->actual_change,2),
                            'refund'            => round($row->refund,2),
                            'gross'             => round($gross,2),
                            'vat'               => round($vat,2),
                            'amount'            => round($row->total_amount,2),
                            'date_created'      => $row->date_created);
                }  
             }
             return $data;
     }  
     function Account_Report_Project_Weekly($year,$month){
            if($month == false || $year == false){
                $date = "MONTH(date_received)=".date('m')." AND YEAR(date_received)=".date('Y')." AND status=2";
            }else{
                $date = "MONTH(date_received)=".$month." AND YEAR(date_received)=".$year." AND status=2";
            }
           $data =false; 
            $query = $this->db->query("SELECT *,sum(pettycash) as pettycash,sum(actual_change) as actual_change,sum(refund) as refund, CONCAT(STR_TO_DATE(CONCAT(YEARWEEK(date_received, 2), ' Sunday'), '%X%V %W'),' / ',STR_TO_DATE(CONCAT(YEARWEEK(date_received, 2), ' Sunday'), '%X%V %W') + INTERVAL 6 DAY) AS date_received, sum(total_amount) as amount FROM tbl_pettycash WHERE ".$date." GROUP BY YEARWEEK(date_received,2) ORDER BY  YEARWEEK(date_received,2) ASC");
            if($query){
             foreach($query->result() as $row){
                  $date_split = explode("/",$row->date_received);
                  $date_1 = date('M d, Y',strtotime($date_split[0]));
                  $date_2 = date('M d, Y',strtotime($date_split[1]));
                  $date_order =   $date_1.' - '. $date_2;
                 $gross = $row->amount / 1.12;
                 $vat = $gross*0.12;
                 $data[] = array(
                            'pettycash'         => round($row->pettycash,2),
                            'change'            => round($row->actual_change,2),
                            'refund'            => round($row->refund,2),
                            'gross'             => round($gross,2),
                            'vat'               => round($vat,2),
                            'amount'            => round($row->amount,2),
                            'date_created'      => $date_order);
                }  
             }
             return $data;
     }
     function Account_Report_Project_Monthly($year,$month){
            if($month == false || $year == false){
                $date = "MONTH(date_received)<=".date('m')." AND YEAR(date_received)=".date('Y')." AND status=2";
            }else{
                $date = "MONTH(date_received)<=".$month." AND YEAR(date_received)=".$year." AND status=2";
            }
            $data =false;
            $query = $this->db->query("SELECT *,sum(pettycash) as pettycash,sum(actual_change) as actual_change,sum(refund) as refund,sum(total_amount) as amount,DATE_FORMAT(date_received, '%M') as date_created FROM tbl_pettycash WHERE ".$date." GROUP BY MONTH(date_received) ORDER BY  MONTH(date_received) ASC");
              if($query){
             foreach($query->result() as $row){
                 $gross = $row->amount / 1.12;
                 $vat = $gross*0.12;
                 $data[] = array(
                            'pettycash'         => round($row->pettycash,2),
                            'change'            => round($row->actual_change,2),
                            'refund'            => round($row->refund,2),
                            'gross'             => round($gross,2),
                            'vat'               => round($vat,2),
                            'amount'            => round($row->amount,2),
                            'date_created'      => $row->date_created);
                }  
             }
             return $data;
     }  
      function Account_Report_Project_Yearly($year){
            if($year == false){
                $date = "YEAR(date_received)<=".date('Y')." AND status=2";
            }else{
                $date = "YEAR(date_received)<=".$year." AND status=2";            
            }
            $data =false;
            $query = $this->db->query("SELECT *,sum(pettycash) as pettycash,sum(actual_change) as actual_change,sum(refund) as refund,sum(total_amount) as amount,DATE_FORMAT(date_received, '%Y') as date_created FROM tbl_pettycash WHERE ".$date." GROUP BY YEAR(date_received) ORDER BY  YEAR(date_received) ASC");
              if($query){
             foreach($query->result() as $row){
                 $gross = $row->amount / 1.12;
                 $vat = $gross*0.12;
                 $data[] = array(
                            'pettycash'         => round($row->pettycash,2),
                            'change'            => round($row->actual_change,2),
                            'refund'            => round($row->refund,2),
                            'gross'             => round($gross,2),
                            'vat'               => round($vat,2),
                            'amount'            => round($row->amount,2),
                            'date_created'      => $row->date_created);
                }  
             }
             return $data;
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
        $data_categories=array();
        $query = $this->db->select('*')->from('tbl_category_income')->where('status !=',3)->get();
        if($query){
            foreach($query->result() as $row){
                $data_categories['categories'][]=array('id'=>$row->id,'name'=>$row->name);
            }
        }
        return array_merge($data_month,$data_year,$data,$data_categories);
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
                 $data =array();   
               }
          return $data;
     }
     function Web_Product_DataTable(){
        $query = $this->db->query("SELECT *,(SELECT title FROM tbl_project_design WHERE id=tbl_project_color.project_no) as title,
            (SELECT d_status FROM tbl_project_design WHERE id=tbl_project_color.project_no) as d_status 
            FROM tbl_project_color WHERE status=2 AND type=1");    
          $data=array();
           if($query->num_rows() > 0){
              foreach($query->result() as $row){
               if(!$row->d_status ||$row->d_status == 'n/a'){$status ='<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Not Display</span>';}else{
                  $status ='<span class="label label-lg label-light-success label-inline font-weight-bold py-4">Displayed</span>';}
               $action = '<button type="button" data-action="info" class="btn btn-sm btn-dark btn-shadow btn-icon view-product" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-eye"></i></button>';
                 $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
                 $data[] = array(
                          'id'=>$row->id,
                          'c_code'       => $row->c_code,
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
            $data =array();   
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
             $data =array();   
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
             $data =array();   
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
             $data =array();   
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
                 $data =array();   
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
                 $data =array();   
             }
            return $data;
     }


     //sales
     function OnlineOrder_DataTable(){
       $data =array();   
       $query = $this->db->query("SELECT *,(SELECT CONCAT(firstname, ' ',lastname) FROM tbl_customer_online WHERE id=tbl_cart_address.customer) as customer,DATE_FORMAT(date_order, '%M %d %Y') as date_created FROM tbl_cart_address WHERE status='REQUEST'");
      if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row){
            $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-status="approved" data-target="#requestModal"><i class="flaticon2-pen"></i></button>';  
                $data[] = array(
                          'order_no'     => $row->order_no,
                          'customer'     => $row->customer,
                          'type'         => $row->type,
                          'date_created'   => $row->date_created,
                          'action'       => $action);

            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
      function Preorder_DataTable(){
        $data =array();
        $user_id = $this->user_id;
        $query = $this->db->query("SELECT *,(SELECT CONCAT(d.title, ' (',c.c_name,')') FROM tbl_project_color c LEFT JOIN  tbl_project_design d ON d.id=c.project_no WHERE c.id=tbl_cart_pre_order.c_code) as title,DATE_FORMAT(date_created, '%M %d %Y') as date_created FROM tbl_cart_pre_order WHERE status=1 AND created_by='$user_id'");    
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
                             'title' => $row->title,
                             'qty'=>$row->qty,
                             'date_created'=>$row->date_created,
                             'action'=> $status);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Preorder_Request_DataTable(){
        $data =array();
        $query = $this->db->query("SELECT *,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_cart_pre_order.created_by) as requestor,
            (SELECT CONCAT(d.title, ' (',c.c_name,')') FROM tbl_project_color c LEFT JOIN  tbl_project_design d ON d.id=c.project_no WHERE c.id=tbl_cart_pre_order.c_code) as title,DATE_FORMAT(date_created, '%M %d %Y') as date_created FROM tbl_cart_pre_order WHERE status=1");
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon" data-toggle="modal" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>';  
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title,
                             'qty'=>$row->qty,
                             'date_created'=>$row->date_created,
                             'action'=> $action);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Preorder_Approved_DataTable(){
        $data =array();
        $user_id = $this->user_id;    
        $query = $this->db->query("SELECT *,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_cart_pre_order.created_by) as requestor,
            (SELECT CONCAT(d.title, ' (',c.c_name,')') FROM tbl_project_color c LEFT JOIN  tbl_project_design d ON d.id=c.project_no WHERE c.id=tbl_cart_pre_order.c_code) as title,DATE_FORMAT(date_created, '%M %d %Y') as date_created FROM tbl_cart_pre_order WHERE status=2 AND update_by='$user_id'");
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title,
                             'qty'=>$row->qty,
                             'date_created'=>$row->date_created);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
     }
     function Preorder_Cancelled_DataTable(){
        $data =array();
        $user_id = $this->user_id;
        $query = $this->db->query("SELECT *,
            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_cart_pre_order.created_by) as requestor,
            (SELECT CONCAT(d.title, ' (',c.c_name,')') FROM tbl_project_color c LEFT JOIN  tbl_project_design d ON d.id=c.project_no WHERE c.id=tbl_cart_pre_order.c_code) as title,DATE_FORMAT(date_created, '%M %d %Y') as date_created FROM tbl_cart_pre_order WHERE status=3 AND update_by='$user_id'");
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title,
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
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;  
     }
 
     function Customer_Concern_Request_Sales_DataTable($id){
         $data =array();    
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
         $data =array();    
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
         $data =array();    
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
         $data =array();    
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
       function Customized_Request_Sales_Datatable(){
        $data =array();    
        $user_id = $this->user_id;
        $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created FROM tbl_customized_request WHERE status='P' AND created_by='$user_id'");
        if($query){
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
    function Customized_Approved_Sales_Datatable(){
        $data =array();    
        $user_id = $this->user_id;
        $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created FROM tbl_customized_request WHERE status='A' AND created_by='$user_id'");
        if($query){
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
       function Customized_Rejected_Sales_Datatable(){
        $data =array();    
        $user_id = $this->user_id;
        $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created FROM tbl_customized_request WHERE status='R' AND created_by='$user_id'");
        if($query){
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

     function Collected_Request_DataTable_Sales(){
         $data=array(); 
         $query = $this->db->query("SELECT *,CONCAT(firstname, ' ',lastname) AS customer,DATE_FORMAT(date_deposite, '%M %d %Y') as date_created  FROM tbl_customer_deposite WHERE status='P'");
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row) {
             $status='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Request</span></span>';  
             $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-details" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button></div>';
            $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/deposit/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->customer.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->bank.'</a></div></div></div></span>';
             $data[] = array(
                          'so_no'        => $row->order_no,
                          'customer'     => $title,
                          'amount'       => number_format($row->amount,2),
                          'date'         => $row->date_created,
                          'status'       => $status,
                          'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
    function Collected_Approved_DataTable_Sales(){
        $data =array();   
        $query = $this->db->query("SELECT *,CONCAT(firstname, ' ',lastname) AS customer,DATE_FORMAT(date_deposite, '%M %d %Y') as date_created  FROM tbl_customer_deposite WHERE status='A'");
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
             $status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Approved</span></span>';  
             $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-details" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button>'; 
             $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/deposit/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->customer.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->bank.'</a></div></div></div></span>';
             $data[] = array(
                          'so_no'        => $row->order_no,
                          'customer'     => $title,
                          'amount'       => number_format($row->amount,2),
                          'date'         => $row->date_created,
                          'status'       => $status,
                          'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
     function Collected_Cancelled_DataTable_Sales(){
        $data =array();   
        $query = $this->db->query("SELECT *,CONCAT(firstname, ' ',lastname) AS customer,DATE_FORMAT(date_deposite, '%M %d %Y') as date_created  FROM tbl_customer_deposite WHERE status='C'");
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
             $status='<span style="width: 112px;"><span class="label label-danger label-dot mr-2"></span><span class="font-weight-bold text-danger">Cancelled</span></span>';  
            $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-details" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button> <button type="button" class="btn btn-sm btn-light-dark btn-icon btn-remarks" data-remarks="'.$row->remarks.'"  data-trans="'.$row->order_no.'" data-toggle="tooltip" data-theme="dark" title="Remarks"><i class="la la-comment"></i></button>'; 
            $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/deposit/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->customer.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->bank.'</a></div></div></div></span>';
             $data[] = array(
                          'so_no'        => $row->order_no,
                          'customer'     => $title,
                          'amount'       => number_format($row->amount,2),
                          'date'         => $row->date_created,
                          'status'       => $status,
                          'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }




    function Collected_Request_DataTable_Accounting(){
         $data=array(); 
         $query = $this->db->query("SELECT *,CONCAT(firstname, ' ',lastname) AS customer,DATE_FORMAT(date_deposite, '%M %d %Y') as date_created  FROM tbl_customer_deposite WHERE status='P'");
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row) {
             $status='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Request</span></span>';  
             $action = '<div class="d-flex flex-row"><button type="button" class="btn btn-light btn-hover-success btn-icon btn-sm mr-2 btn-approved" data-trans="'.$row->order_no.'" data-id="'.$this->encryption->encrypt($row->id).'" data-status="A"><i class="la la-check"></i>
                </button><button type="button" class="btn btn-light btn-hover-danger btn-icon btn-sm mr-2 btn-cancelled" data-trans="'.$row->order_no.'" data-id="'.$this->encryption->encrypt($row->id).'" data-status="C"><i class="la la-remove"></i></button>
                <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-details" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button></div>';
            $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/deposit/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->customer.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->bank.'</a></div></div></div></span>';
             $data[] = array(
                          'so_no'        => $row->order_no,
                          'customer'     => $title,
                          'amount'       => number_format($row->amount,2),
                          'date'         => $row->date_created,
                          'status'       => $status,
                          'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
    function Collected_Approved_DataTable_Accounting(){
        $data =array();   
        $query = $this->db->query("SELECT *,CONCAT(firstname, ' ',lastname) AS customer,DATE_FORMAT(date_deposite, '%M %d %Y') as date_created  FROM tbl_customer_deposite WHERE status='A'");
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
             $status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Approved</span></span>';  
             $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-details" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button>'; 
             $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/deposit/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->customer.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->bank.'</a></div></div></div></span>';
             $data[] = array(
                          'so_no'        => $row->order_no,
                          'customer'     => $title,
                          'amount'       => number_format($row->amount,2),
                          'date'         => $row->date_created,
                          'status'       => $status,
                          'action'       => $action);
            }  
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
     function Collected_Cancelled_DataTable_Accounting(){
        $data =array();   
        $query = $this->db->query("SELECT *,CONCAT(firstname, ' ',lastname) AS customer,DATE_FORMAT(date_deposite, '%M %d %Y') as date_created  FROM tbl_customer_deposite WHERE status='C'");
         if($query !== FALSE && $query->num_rows() > 0){
         foreach($query->result() as $row)  {
             $status='<span style="width: 112px;"><span class="label label-danger label-dot mr-2"></span><span class="font-weight-bold text-danger">Cancelled</span></span>';  
            $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-details" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button> <button type="button" class="btn btn-sm btn-light-dark btn-icon btn-remarks" data-remarks="'.$row->remarks.'"  data-trans="'.$row->order_no.'" data-toggle="tooltip" data-theme="dark" title="Remarks"><i class="la la-comment"></i></button>'; 
            $title = '<span style="width: 250px;"><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/deposit/'.$row->image.'" alt="photo"></div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->customer.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->bank.'</a></div></div></div></span>';
             $data[] = array(
                          'so_no'        => $row->order_no,
                          'customer'     => $title,
                          'amount'       => number_format($row->amount,2),
                          'date'         => $row->date_created,
                          'status'       => $status,
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
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
    function Pre_Order_Request_Datatable(){
        $data =array();    
        $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y') as date_created,
         (SELECT CONCAT(d.title, ' (',c.c_name,')') FROM tbl_project_color c LEFT JOIN tbl_project_design d ON d.id=c.project_no WHERE c.id=tbl_cart_pre_order.c_code) as title,
         (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_cart_pre_order.created_by) as requestor
         FROM tbl_cart_pre_order WHERE status=1");
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                  $action = '<button type="button" class="btn btn-sm btn-light-success btn-icon  btn-approved mr-2" data-name="'.$row->order_no.'" data-status="2" data-id="'.$this->encryption->encrypt($row->id).'"><i class="flaticon2-check-mark"></i></button>
                  <button type="button" class="btn btn-sm btn-light-danger btn-icon btn-cancelled" data-status="3" data-name="'.$row->order_no.'" data-id="'.$this->encryption->encrypt($row->id).'"><i class="flaticon2-cancel-music"></i></button>';    
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title,
                             'qty'=>$row->qty,
                              'requestor'=>$row->requestor,
                             'date_created'=>$row->date_created,
                             'action'=> $action);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
     function Pre_Order_Approved_Datatable(){
       $data =array();
         $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y') as date_created,
         (SELECT CONCAT(d.title, ' (',c.c_name,')') FROM tbl_project_color c LEFT JOIN tbl_project_design d ON d.id=c.project_no WHERE c.id=tbl_cart_pre_order.c_code) as title,
         (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_cart_pre_order.created_by) as requestor
         FROM tbl_cart_pre_order WHERE status=2");    

          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){ 
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title,
                             'qty'=>$row->qty,
                              'requestor'=>$row->requestor,
                             'date_created'=>$row->date_created);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }
    function Pre_Order_Rejected_Datatable(){
        $data =array();    
        $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y') as date_created,
         (SELECT CONCAT(d.title, ' (',c.c_name,')') FROM tbl_project_color c LEFT JOIN tbl_project_design d ON d.id=c.project_no WHERE c.id=tbl_cart_pre_order.c_code) as title,
         (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_cart_pre_order.created_by) as requestor
         FROM tbl_cart_pre_order WHERE status=3"); 
          if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){ 
                   $data[] = array(
                             'order_no'=>$row->order_no,
                             'title' => $row->title,
                             'qty'=>$row->qty,
                             'requestor'=>$row->requestor,
                             'date_created'=>$row->date_created);
                }  
             }
         $json_data  = array("data" =>$data); 
         return $json_data;
    }


    function Customized_Request_Datatable(){
        $data =array(); $no = 1;  
        $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,(SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_customized_request.created_by) as requestor FROM tbl_customized_request WHERE status='P'");
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                $action = '<button type="button" class="btn btn-light btn-hover-success btn-icon btn-sm mr-2 btn-approved" data-name="'.$row->subject.'" data-id="'.$this->encryption->encrypt($row->id).'" data-status="A"><i class="la la-check"></i>
                </button><button type="button" class="btn btn-light btn-hover-danger btn-icon btn-sm mr-2 btn-cancelled" data-name="'.$row->subject.'" data-id="'.$this->encryption->encrypt($row->id).'" data-status="R"><i class="la la-remove"></i></button>
                <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-details" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button>';

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
     function Customized_Approved_Datatable(){
        $data =array(); $no = 1; 
        $user_id = $this->user_id;
        $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,(SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_customized_request.created_by) as requestor FROM tbl_customized_request WHERE status='A' AND update_by='$user_id'");
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                $action = ' <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-details" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button>';    
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
    function Customized_Rejected_Datatable(){
        $data =array(); $no = 1;  
        $user_id = $this->user_id;
        $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,(SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_customized_request.created_by) as requestor FROM tbl_customized_request WHERE status='R' AND update_by='$user_id'");
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                 $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-details" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="la la-eye"></i></button>
                 <button type="button" class="btn btn-sm btn-light-dark btn-icon btn-remarks" data-remarks="'.$row->remarks.'"  data-name="'.$row->subject.'" data-toggle="tooltip" data-theme="dark" title="Remarks"><i class="la la-comment"></i></button>';
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
        $data =array(); $no = 1;  
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
     function Inquiry_Approved_Sales_Datatable(){
        $data =array(); $no = 1;  
        $query = $this->db->select('*,DATE_FORMAT(date_created, "%M %d %Y %r") as date_created')->from('tbl_customer_inquiry')->where('status','A')->where('update_by',$this->user_id)->order_by('latest_update','DESC')->get();
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
        $data =array(); 
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
                 $item = '<a href="javascript:;" id="update-material-request" data-order="'.$row->production_no.'" data-type="'.$row->mat_type.'" data-qty="'.$row->total_qty.'" data-name="'.$row->item.'" data-id="'.$row->id.'">'.$row->item.' - '.$unit.'</a>';
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
        $data =array(); 
         $query = $this->db->select('*,p.id,m.item,p.status,m.status')->from('tbl_purchasing_project as p')->join('tbl_materials as m','m.id=p.item_no','LEFT')->where('p.production_no',$val)->where('p.status',1)->order_by('p.id','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                    $unit =$row->unit.'(s)';
                if(!$row->unit){ $unit ="";}
                $status = '<button class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger btn_remove_purchased" data-id="'.$row->id.'"><i class="flaticon-delete-1"></i></button>';
                $item = '<a href="javascript:;" id="update-purchase-request" data-order="'.$row->production_no.'"  data-id="'.$row->id.'">'.$row->item.'</a>';
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
        $data =array(); 
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

    function Other_purchase_inventory_Request(){
        $data =array();
        $query = $this->db->select('*,o.id,DATE_FORMAT(o.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_other_material_p_header as o')
        ->join('tbl_administrator as u','u.id=o.purchaser','LEFT')
        ->where('o.status','PENDING')->order_by('o.date_created','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row){
                $status = '<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">REQUEST</span></span>';
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'""><i class="flaticon2-pen"></i></button>';
                $data[] = array('trans_no'=>$row->request_no,
                              'requestor'=>$row->requestor,
                              'date_created'=>$row->date_created,
                              'status'=>$status,
                              'action'=>$action);
            }
        }
        $json_data  = array("data" =>$data); 
        return $json_data;
    }
    function Other_purchase_inventory_Inprogress(){
        $data =array();
        $query = $this->db->select('*,o.id,o.status,DATE_FORMAT(o.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_other_material_p_header as o')
        ->join('tbl_administrator as u','u.id=o.purchaser','LEFT')
        ->where_in('o.status',['APPROVED','COMPLETED'])->order_by('o.date_created','DESC')->get();
        if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row){
                if($row->status=='APPROVED'){$status ='<span style="width: 112px;"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Approved</span></span>';
                }else if($row->status == 'COMPLETED'){$status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Complete</span></span>';}
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" id="view-inprogress" data-id="'.$this->encryption->encrypt($row->id).'""><i class="flaticon2-pen"></i></button>';
                $trans_no = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->request_no.'</span><span class="text-primary font-weight-bold">'.$row->fund_no.'</span>';
                $data[] = array('trans_no'=>$trans_no,
                              'requestor'=>$row->requestor,
                              'date_created'=>$row->date_created,
                              'status'=>$status,
                              'action'=>$action);
            }
        }
        $json_data  = array("data" =>$data); 
        return $json_data;
    }
    function Purchase_Material_Inventory_Complete_DataTable(){
            $query =  $this->db->select('mp.*,mp.item ,s.name,mp.amount,DATE_FORMAT(mp.date_created, "%M %d %Y %r") as date_created,DATE_FORMAT(mp.terms_start, "%M %d %Y") as terms_start,DATE_FORMAT(mp.terms_end, "%M %d %Y") as terms_end')
            ->from('tbl_other_material_p_received as mp')
            ->join('tbl_supplier as s','s.id=mp.supplier','LEFT')
            ->where('mp.created_by',$this->user_id)
            ->order_by('mp.date_created','DESC')->get(); 
          if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row)  { 
                if($row->payment==1){$terms ='<span style="width: 112px;" class="d-block"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Cash</span></span>';
                }else if($row->payment == 2){$terms ='<span style="width: 112px;" class="d-block"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Terms</span></span>
                    <span class="font-weight-bold d-block">From: '.$row->terms_start.'</span>
                    <span class="font-weight-bold">To: '.$row->terms_end.'</span>';}
                     $data[] = array(
                          'trans_no'      => $row->fund_no,
                          'item'          => $row->item,
                          'quantity'      => $row->quantity,
                          'amount'        => number_format($row->amount,2),
                          'supplier'      => $row->name,
                          'terms'         => $terms,
                          'date_created'  => $row->date_created);
            }      
         }else{   
             $data =array();    
         }
         $json_data  = array("data" =>$data); 
         return $json_data;    
    }

    function Other_purchase_inventory_Request_Accounting(){
        $data =array();
        $query = $this->db->select('*,o.id,o.status,DATE_FORMAT(o.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_other_material_p_header as o')
        ->join('tbl_administrator as u','u.id=o.purchaser','LEFT')
        ->where_in('o.status',['PENDING','APPROVED','COMPLETED'])->order_by('o.date_created')->get();
        if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row){
                if($row->status=='PENDING'){$status ='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Request</span></span>';
                }else if($row->status == 'APPROVED'){$status ='<span style="width: 112px;"><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">Approved</span></span>';}else if($row->status == 'COMPLETED'){$status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Complete</span></span>';}
               $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" data-toggle="modal" id="view-request-form" data-id="'.$this->encryption->encrypt($row->id).'" data-target="#requestModal"><i class="flaticon2-pen"></i></button>';
               $trans_no = $row->request_no;
               if($row->fund_no){
                 $trans_no = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->request_no.'</span><span class="text-primary font-weight-bold">'.$row->fund_no.'</span>';
               }
                $data[] = array('trans_no'=>$trans_no,
                              'requestor'=>$row->requestor,
                              'date_created'=>$row->date_created,
                              'status'=>$status,
                              'action'=>$action);
            }
        }
        $json_data  = array("data" =>$data); 
        return $json_data;
    }
    function Other_purchase_inventory_received_Accounting(){
        $data =array();
        $query = $this->db->select('*,o.id,o.status,DATE_FORMAT(o.date_created, "%M %d %Y %r") as date_created,CONCAT(u.fname, " ",u.lname) AS requestor')->from('tbl_other_material_p_header as o')
        ->join('tbl_administrator as u','u.id=o.purchaser','LEFT')
        ->where_in('o.a_status',['APPROVED','COMPLETED'])->order_by('o.date_created')->get();
        if($query !== FALSE && $query->num_rows() > 0){
            foreach($query->result() as $row){
                if($row->a_status=='APPROVED'){$status ='<span style="width: 112px;"><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">Pending</span></span>';
                }else if($row->a_status == 'COMPLETED'){$status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Complete</span></span>';}

                $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" id="view-received-form" data-id="'.$this->encryption->encrypt($row->id).'"><i class="flaticon2-pen"></i></button>';
                $trans_no = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row->request_no.'</span><span class="text-primary font-weight-bold">'.$row->fund_no.'</span>';
                $data[] = array('trans_no'=>$trans_no,
                                'requestor'=>$row->requestor,
                                'date_created'=>$row->date_created,
                                'status'=>$status,
                                 'action'=>$action);
            }
        }
        $json_data  = array("data" =>$data); 
        return $json_data;
    }
    function Cashpostion_Category_Accounting(){
        $data =array();   
        $query = $this->db->select('*')->from('tbl_category_income')->where('status',0)->order_by('id','DESC')->get();
         if($query !== FALSE && $query->num_rows() > 0){
             foreach($query->result() as $row){
                $action = '<button type="button" class="btn btn-sm btn-light-dark btn-shadow btn-icon" id="view-update-form" data-name="'.$row->name.'" data-id="'.$this->encryption->encrypt($row->id).'"><i class="flaticon2-pen"></i></button>';
                $data[] = array('name'=>$row->name,
                                'action'=>$action);
             }
         }
        $json_data  = array("data" =>$data); 
        return $json_data;
    }
      function Supplier_Item_View($id){
          $data = false;
          $query = $this->db->select('*')->from('tbl_supplier_item as mp')->where('supplier',$this->encryption->decrypt($id))->order_by('id','ASC')->get();
               foreach($query->result() as $row){
                 $action = '<button type="button" class="btn btn-sm btn-light-dark btn-icon"  id="edit-item-view" data-id="'.$this->encryption->encrypt($row->id).'" ><i class="flaticon2-pen"></i></button>';    
                $data[] = array('item'   => $row->item,
                                'amount' => number_format($row->amount,2),
                                'action' => $action);
           }
         $json_data  = array("data" =>$data); 
         return $json_data;  
    }

    
}
?>