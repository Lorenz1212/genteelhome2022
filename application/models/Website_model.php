<?php
class Website_model extends CI_Model{  
   //Fetch Data
    private function move_to_folder1($image,$tmp,$path){
         $newfilename=  'IMG'.date('YmdHisu').'-'.preg_replace('/[@\;\" "\()]+/', '', $image);
         $path_folder = $path.$newfilename;
         copy($tmp, $path_folder);
         return $newfilename;
    }
    function notification($userid){
         $query = $this->db->select('count(id) as id')->from('tbl_cart_add')->where('customer',$userid)->where('status','cart')->get()->row();
         return $query->id;
    }
   function registration($firstname,$lastname,$email,$password){
      $this->db->select('*')->from('tbl_customer_online')->where('email',$email)->get();
      $row = $query->row();
      if(!$row){
            $data = array('email'      => $email,
                    'password'   => md5($password),
                    'firstname'  => $firstname,
                    'lastname'   => $lastname,
                    'status'     => 1,
                    'date_created'  => date('Y-m-d H:i:s'));
             $this->db->insert('tbl_customer_online',$data);
      }else{
         $data = array('password'   => md5($password),
                       'firstname'  => $firstname,
                       'lastname'   => $lastname,
                       'status'     => 1,
                       'latest_update'  => date('Y-m-d H:i:s'));
          $this->db->where('id',$row->id);
          $this->db->update('tbl_customer_online',$data);
      }
      
   }
   function change_password($email,$password){
          $data = array('password'   => md5($password));
          $this->db->where('email',$email);
          $this->db->update('tbl_customer_online',$data);
   }
   function forgotpassword($from,$message,$id){
      $data = array(   'customer_id'   => $id,
                       'email'         => $from,
                       'hash'          => $message,
                       'date_created'  => date('Y-m-d H:i:s'));
      $this->db->insert('tbl_customer_forgotpassword',$data);
   }
   function header(){        
        $query = $this->db->select('*,s.id as id')->from('tbl_category as c')
        ->join('tbl_category_sub as s','s.cat_id=c.id','LEFT')->where('c.status','ACTIVE')
        ->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row)
            {
                $data[] = array(
                    'sub_id'   => $row->id,
                    'cat_name' => $row->cat_name,
                    'sub_name' => $row->sub_name);
            }      
         }else{$data =false;}
         return $data;

   }
   function account($id){
     $query = $this->db->select('*')->from('tbl_customer_online as c')
     ->join('tbl_region_shipping as r','c.region=r.id','LEFT')
     ->where('c.id',$id)->get();
     return $query->row();
   }
   function footer(){        
      $userid = $this->session->userdata('userId');
      $project_query = $this->db->select('cd.*,c.*,d.*,cd.id as id,d.id as project_no')->from('tbl_cart_add as cd')
      ->join('tbl_project_design as d','d.id=cd.project_no','LEFT')
      ->join('tbl_project_color as c','c.c_code=cd.c_code','LEFT')
      ->where('cd.customer',$userid)->where('cd.status','cart')->order_by('cd.id','DESC')->get();
       if($project_query !== FALSE && $project_query->num_rows() > 0){
           foreach($project_query->result() as $row)
            {
                $query2 = $this->db->select('*')->from('tbl_project_image')->where('project_no',$row->project_no)->where('c_code',$row->c_code)
                  ->limit(1)->get(); $row2 = $query2->row();
                if(!$row2){$images = 'default.png';}else{$images = $row2->images;}
                $data[] = array(
                  'id'         => $row->id,
                  'project_no' => $row->project_no,
                  'title'      => $row->title,
                  'c_code'     => $row->c_code,
                  'c_name'     => $row->c_name,
                  'c_price'    => $row->c_price,
                  'price'      => number_format($row->price,2),
                  'qty'        => $row->qty,
                  'images'     => $images);
            }      
         }else{$data =false;}

      $count_query = $this->db->select('count(id) as count')->from('tbl_cart_add')
      ->where('customer',$userid)->where('status','cart')->get();

      $query = $this->db->select('*')->from('tbl_company_profile')->get();
      $json = array('data'=>$data,
                    'row' =>$query->row(),
                    'count' => $count_query->row());
      return $json;
   }
   function index(){
        $query = $this->db->select('*')->from('tbl_project_design')->where('cat_id IS NOT NULL')->where('d_status', 'DISPLAYED')->order_by('popular','DESC')->limit(6)->get();
           if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
                $query2 = $this->db->select('*')->from('tbl_project_color as c')
               ->join('tbl_project_image as i','c.c_code=i.c_code','LEFT')
               ->where('c.display_status','displayed')
               ->where('c.project_no',$row->id)
               ->limit(1)->get();
               $row2 = $query2->row();

               $data[] = array(
                  'id'         => $row->id,
                  'project_no' => $row->id,
                  'title'      => $row->title,
                  'images'     => $row2->images,
                  'c_code'     => $row2->c_code);
            }      
         }else{$data =false;}

         $query1 = $this->db->select('*,DATE_FORMAT(date_event, "%M %d %Y") as date_event')->from('tbl_events')->where('status','ACTIVE')->order_by('date_event','DESC')->limit(3)->get();
           if($query1 !== FALSE && $query1->num_rows() > 0){
           foreach($query1->result() as $row1)
            {
               $event[] = array(
                  'id'              => $row1->id,
                  'title'           => $row1->title,
                  'description'     => $row1->description,
                  'location'     => $row1->location,
                  'date_event'      => $row1->date_event,
                  'time_event'      => $row1->time_event,
                  'image'           => $row1->image);
            }      
         }else{$event =false;}


         $json = array('data'     => $data,
                       'event'    => $event);
         return $json;
   }
    function events(){
         $query1 = $this->db->select('*,DATE_FORMAT(date_event, "%M %d %Y") as date_event')->from('tbl_events')->where('status','ACTIVE')->order_by('date_event','DESC')->get();
           if($query1 !== FALSE && $query1->num_rows() > 0){
           foreach($query1->result() as $row1)
            {
               $event[] = array(
                  'id'              => $row1->id,
                  'title'           => $row1->title,
                  'description'     => $row1->description,
                  'location'        => $row1->location,
                  'date_event'      => $row1->date_event,
                  'time_event'      => $row1->time_event,
                  'image'           => $row1->image);
            }      
         }else{$event =false;}

         $json = array('event'    => $event);
         return $json;
   }
   function product_list($id,$action){
            if($action == 'all'){
                $sub_name = null;
                $cat_name = 'ALL PRODUCT';
                $query = $this->db->select('d.*,c.*,s.*,d.id as id')->from('tbl_project_design as d')
               ->join('tbl_category as c','c.id=d.cat_id','LEFT')
               ->join('tbl_category_sub as s','s.id=d.sub_id','LEFT')
               ->where('d.d_status', 'DISPLAYED')
               ->where('d.sub_id IS NOT NULL')->get();
            }else if($action == 'category'){
                $query1 = $this->db->select('*')->from('tbl_category')->where('cat_name',$id)->get();
               $row1 = $query1->row();
               $cat_name = $row1->cat_name;
               $sub_name = null;
               $array = array('d.cat_id'=> $row1->id);

               $query = $this->db->select('d.*,c.*,s.*,d.id as id')->from('tbl_project_design as d')
               ->join('tbl_category as c','c.id=d.cat_id','LEFT')
               ->join('tbl_category_sub as s','s.id=d.sub_id','LEFT')
               ->where('d.d_status', 'DISPLAYED')
               ->where($array)->get();
            }else if($action == 'subcaterogy'){
               $query1 = $this->db->select('*,s.id as id')->from('tbl_category_sub as s')
                ->join('tbl_category as c','s.cat_id=c.id','LEFT')->where('s.sub_name',$id)->get();
               $row1 = $query1->row();
               $cat_name = $row1->cat_name;
               $sub_name = $row1->sub_name;
               $array = array('d.sub_id'=> $row1->id);
                $query = $this->db->select('d.*,c.*,s.*,d.id as id')->from('tbl_project_design as d')
               ->join('tbl_category as c','c.id=d.cat_id','LEFT')
               ->join('tbl_category_sub as s','s.id=d.sub_id','LEFT')
               ->where('d.d_status', 'DISPLAYED')
               ->where('d.sub_id',$row1->id)->get();
            }
       
           if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
               $query2 = $this->db->select('*')->from('tbl_project_color as c')
               ->join('tbl_project_image as i','c.c_code=i.c_code','LEFT')
               ->where('c.project_no',$row->id)
               ->where('c.display_status','displayed')
               ->limit(1)->get();
               $row2 = $query2->row();

               if(!$row2->images){
                  $images = 'default.png';
               }else{
                    $images = $row2->images;
               }

               $data[] = array(
                  'id'         => $row->id,
                  'project_no' => $row->id,
                  'title'      => $row->title,
                  'images'     => $images,
                  'c_code'     => $row2->c_code);
            }      
         }else{$data =false;}
         $json = array('data'     => $data,
                       'cat_name' => $cat_name,
                       'sub_name' => $sub_name,
                       'action'   => $action);
         return $json;
   }
     function product_arrival(){
           $query = $this->db->select('d.*,c.*,s.*,d.id as id')->from('tbl_project_design as d')->join('tbl_category as c','c.id=d.cat_id','LEFT')->join('tbl_category_sub as s','s.id=d.sub_id','LEFT')->where('d.d_status', 'DISPLAYED')->order_by('d.date_display','DESC')->get();
           if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row)
            {  
               $date = date('Y-m-d',strtotime('+30 days',strtotime($row->date_display)));
               if($date == date('Y-m-d')){
                    $data = false;
               }else{
                    $query2 = $this->db->select('*')->from('tbl_project_color as c')
                   ->join('tbl_project_image as i','c.c_code=i.c_code','LEFT')
                   ->where('c.project_no',$row->id)
                   ->where('c.display_status','displayed')
                   ->limit(1)->get();
                   $row2 = $query2->row();
                   if(!$row2->images){
                      $images = 'default.png';
                   }else{
                        $images = $row2->images;
                   }
                   $data[] = array(
                      'id'         => $row->id,
                      'project_no' => $row->project_no,
                      'title'      => $row->title,
                      'images'     => $images,
                      'c_code'     => $row2->c_code);
               }
               
            }      
         }else{$data =false;}
         $json = array('data'=> $data);
         return $json;
   }
     function product_stocks(){
           $query = $this->db->select('d.*,c.*,s.*,d.id as id')->from('tbl_project_design as d')
           ->join('tbl_project_color as pc','d.id=pc.project_no','LEFT')
           ->join('tbl_category as c','c.id=d.cat_id','LEFT')
           ->join('tbl_category_sub as s','s.id=d.sub_id','LEFT')
           ->where('d.d_status', 'DISPLAYED')
            ->where('pc.stocks <', '1')->group_by('pc.project_no')
           ->get();
           if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row)
            {  
            $query2 = $this->db->select('*')->from('tbl_project_color as c')->join('tbl_project_image as i','c.c_code=i.c_code','LEFT')->where('c.project_no',$row->id)->where('c.display_status','displayed')->limit(1)->get();
            $row2 = $query2->row();
                   if(!$row2->images){
                      $images = 'default.png';
                   }else{
                        $images = $row2->images;
                   }
                   $data[] = array(
                      'id'         => $row->id,
                      'project_no' => $row->project_no,
                      'title'      => $row->title,
                      'images'     => $images,
                      'c_code'     => $row2->c_code);
               
            }      
         }else{$data =false;}
         $json = array('data'=> $data);
         return $json;
   }
   function product_collection($userid){
           $query = $this->db->select('cc.*,d.*,c.*,s.*,d.id as id')
           ->from('tbl_cart_collection as cc')
           ->join('tbl_project_design as d','d.id=cc.project_no','LEFT')
           ->join('tbl_project_color as pc','d.id=pc.project_no','LEFT')
           ->join('tbl_category as c','c.id=d.cat_id','LEFT')
           ->join('tbl_category_sub as s','s.id=d.sub_id','LEFT')
           ->where('d.d_status', 'DISPLAYED')
           ->where('cc.customer',$userid)
           ->get();
           if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row)
            {  
                    $query2 = $this->db->select('*')->from('tbl_project_color as c')
                   ->join('tbl_project_image as i','c.c_code=i.c_code','LEFT')
                   ->where('c.project_no',$row->id)
                   ->where('c.display_status','displayed')
                   ->limit(1)->get();
                   $row2 = $query2->row();
                   if(!$row2->images){
                      $images = 'default.png';
                   }else{
                        $images = $row2->images;
                   }
                   $data[] = array(
                      'id'         => $row->id,
                      'project_no' => $row->id,
                      'title'      => $row->title,
                      'images'     => $images,
                      'c_code'     => $row2->c_code);
               
            }      
         }else{$data =false;}
         $json = array('data'=> $data);
         return $json;
   }
   function product_modal($id){
      $query = $this->db->select('*')->from('tbl_project_design')->where('id',$id)->limit(1)->get();
      $row1 = $query->row();
      $query1 = $this->db->select('*')->from('tbl_project_color')->where('project_no',$id)->where('display_status','displayed')->get();
        if($query1 !== FALSE && $query1->num_rows() > 0){
        foreach($query1->result() as $row){
               $data[] = array(
                  'id'          => $row->id,
                  'stocks'      => $row->stocks,
                  'c_code'      => $row->c_code,
                  'c_name'      => $row->c_name,
                  'c_price'     => $row->c_price,
                  'c_image'     => $row->c_image);
         }      
         }else{$data =false;}
          $json = array('data'      => $data,
                        'title'     => $row1->title,
                        'project_no'=> $row1->id);
         return $json;
   }
   function product_image_modal($id){
      $query1 = $this->db->select('*')->from('tbl_project_color')->where('c_code',$id)->get();
      $row1 = $query1->row();
      $query = $this->db->select('*')->from('tbl_project_image')->where('c_code',$id)->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row)
           {
               $data[] = array(
                  'id'          => $row->id,
                  'images'      => $row->images,
                  'c_code'      => $row->c_code);
         }      
         }else{$data =false;}
          $json = array('data'      => $data,
                        'price'     => number_format($row1->c_price,2));
         return $json;
   }
   function product_gallery($id){
      $query = $this->db->select('*')->from('tbl_project_image')->where('c_code',$id)->get();
        if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row)
           {
               $data[] = array('images'=> $row->images);
         }      
         }else{$data =false;}
          $json = array('data' => $data);
         return $json;
   }
   function product_details($id){
      if(!$this->session->userdata('userId')){
         $collection = false;
      }else{
         $query_collection = $this->db->select('*')->from('tbl_cart_collection')->where('project_no',$id)->where('customer',$this->session->userdata('userId'))->get();
         $row_c = $query_collection->row();
         if(!$row_c){
            $collection = false; 
         }else{
            $collection = $row_c->id;
         }
      }
      $query = $this->db->select('*,d.id as project_no')->from('tbl_project_design as d')
      ->join('tbl_category_sub as s','d.sub_id=s.id','LEFT')
      ->join('tbl_category as c','d.cat_id=c.id','LEFT')
      ->where('d.id',$id)->limit(1)->get();
      $row1 = $query->row();
      $query1 = $this->db->select('*')->from('tbl_project_color')->where('project_no',$id)->where('display_status','displayed')->get();
      if($query1 !== FALSE && $query1->num_rows() > 0){
           foreach($query1->result() as $row)
          {
                   $data[] = array(
                      'id'          => $row->id,
                      'stocks'      => $row->stocks,
                      'c_code'      => $row->c_code,
                      'c_name'      => $row->c_name,
                      'c_price'     => number_format($row->c_price,2),
                      'c_image'     => $row->c_image);
          }      
      }else{$data =false;}
          $json = array('data'       => $data,
                        'tearsheet'  => $row1->tearsheet,
                        'title'      => $row1->title,
                        'project_no' => $row1->project_no,
                        'sub_name'   => $row1->sub_name,
                        'cat_name'   => $row1->cat_name,
                        'collection' => $collection);
      return $json;
   }
   function Cart_Product($userid){
      $query = $this->db->select('cd.*,c.*,d.*,cd.id as id,c.c_code as code')
      ->from('tbl_cart_add as cd')
      ->join('tbl_project_color as c','c.id=cd.c_code','LEFT')
      ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
      ->where('cd.customer',$userid)->where('cd.status','cart')->order_by('cd.id','DESC')->get();
       if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
                $query2 = $this->db->select('*')->from('tbl_project_image')->where('c_code',$row->code)
                  ->limit(1)->get(); $row2 = $query2->row();
                if(!$row2){$images = 'default.png';}else{$images = $row2->images;}
                $data[] = array(
                  'id'         => $row->id,
                  'project_no' => $row->project_no,
                  'title'      => $row->title,
                  'c_code'     => $row->c_code,
                  'c_name'     => $row->c_name,
                  'c_price'    => $row->c_price,
                  'price'      => number_format($row->price,2),
                  'qty'        => $row->qty,
                  'images'     => $images);
            }      
         }else{$data =false;}
         return $data;
   }

   function CheckOut_Product($userid){
       $data =false;
      $query = $this->db->select('cd.*,c.*,d.*,cd.id,c.c_code as code,(SELECT sum(price) FROM tbl_cart_add WHERE customer='.$userid.' AND status="process") as total')->from('tbl_cart_add as cd')
      ->join('tbl_project_color as c','c.id=cd.c_code','LEFT')
      ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
      ->where('cd.customer',$userid)->where('cd.status','process')->order_by('cd.id','DESC')->get();
       if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){
                $query2 = $this->db->select('*')->from('tbl_project_image')->where('c_code',$row->code)
                  ->limit(1)->get(); $row2 = $query2->row();
                if(!$row2){$images = 'default.png';}else{$images = $row2->images;}
                $data[] = array(
                  'id'=> $row->id,
                  'project_no' => $row->project_no,
                  'title'      => $row->title,
                  'c_code'     => $row->c_code,
                  'c_name'     => $row->c_name,
                  'c_price'    => $row->c_price,
                  'total'      => $row->total,
                  'price'      => number_format($row->price,2),
                  'qty'        => $row->qty,
                  'images'     => $images);
            }      
         }
         return $data;
   }
   function Coupon_Promo($id){
      $array = array('c.customer'=>$id,'c.status'=>'not use');
      $query = $this->db->select('c.*,p.*,c.id as id,c.promo_code as promo_code')->from('tbl_customer_promo as c')
      ->join('tbl_code_promo as p','p.promo_code=c.promo_code','LEFT')
      ->where($array)->where('p.status IS NULL')->get();
       if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){ 
                $exp_date = strtotime($row->date_to);
                $now = new DateTime();
                $now = $now->format('Y-m-d');
                $now = strtotime($now);
                if ($exp_date < $now || $exp_date == $now) {
                    $query1 = $this->db->select('*')->from('tbl_code_promo')->where('promo_code',$row->promo_code)->get();
                    $row1 = $query1->row();
                    if(!$row1->status){
                        $data1 = array('status' => 'EXPIRED');
                        $this->db->where('promo_code',$row->promo_code);
                        $this->db->update('tbl_code_promo',$data1);  
                    }
                } 
                $data[] = array(
                  'id'         => $row->id,
                  'promo_code' => $row->promo_code,
                  'description'=> $row->description,
                  'discount'   => $row->discount,
                  'date_from'  => $row->date_from,
                  'date_to'    => $row->date_to);
            }      
         }else{$data =false;}
         return $data;
   }
    function interior_list($id){
         if($id == 'RESIDENTIAL PROJECTS'){
            $category = 1;
         }else if($id == 'COMMERICIAL PROJECTS'){
            $category = 2;
         }else if($id == 'EXPERIENCES'){
            $category = 3;
         }
         $query = $this->db->select('*')->from('tbl_interior_design')->where('status','ACTIVE')->where('cat_id',$category)->get();
         if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row)
            {
                $data[] = array(
                  'id'           => $row->id,
                  'project_name' => $row->project_name,
                  'image'        => $row->image);
            }      
         }else{$data =false;}
          
          $json = array('data' => $data,
                        'category' => $id);
         return $json;
   }
    function interior_detail($id){
          $query = $this->db->select('*')->from('tbl_interior_design')->where('project_name',$id)->get();
          $row1 = $query->row();
             if($row1->cat_id == 1){
                $category = 'RESIDENTIAL PROJECTS';
             }else if($row1->cat_id == 2){
                $category = 'COMMERICIAL PROJECTS';
             }else if($row1->cat_id == 3){
                $category = 'EXPERIENCES';
             }
         $query = $this->db->select('*')->from('tbl_interior_image')->where('in_id',$row1->id)->get();
         if($query !== FALSE && $query->num_rows() > 0){
           foreach($query->result() as $row){   
                $data[] = array(
                  'id'           => $row->id,
                  'image'        => $row->images);
            }      
         }else{$data =false;}
          
          $json = array('data'        => $data,
                        'category'    => $category,
                        'project_name'=>$id,
                        'row'         => $row1);
         return $json;
   }
   function About_Us(){
     $query = $this->db->select('*')->from('tbl_company_owner')->get();
     $sql = $this->db->select('*')->from('tbl_company_profile')->get();
     $json = array('owner' => $query->row(),
                   'company' => $sql->row());
     return $json;
   }

   //Create
   function Create_Product_Cart($id,$c_name,$qty,$order){
        $row = $this->db->select('*,c.id,c.c_code as c_code')->from('tbl_project_color as c')->join('tbl_project_design as d','d.id=c.project_no','LEFT')->where('c.c_name',$c_name)->get()->row();

        $row1 = $this->db->select('*')->from('tbl_project_image')->where('c_code',$row->c_code)->limit(1)->get()->row();
        if(!$row1){$images = 'default.png';}else{$images = $row1->images;}

        $row_cart = $this->db->select('*')->from('tbl_cart_add')->where('customer='.$id.' AND c_code='.$row->id.' AND status="cart"')->get()->row();
        if(!$row_cart){
          $total = floatval($qty * $row->c_price);
          $data = array(  'customer'     => $id,
                          'c_code'       => $row->id,
                          'qty'          => $qty,
                          'price'        => $total,
                          'status'       => 'cart',
                          'type'         => $order,
                          'date_created' => date('Y-m-d H:i:s'));
           $this->db->insert('tbl_cart_add',$data);
           $last_id = $this->db->insert_id();
           $json = array('id'      => $last_id,
                         'images'  => $images,
                         'qty'     => $qty,
                         'c_name'  => $row->c_name,
                         'total'   => $total,
                         'c_price' => number_format($total,2),
                         'title'   => $row->title,
                         'action'  => 'create');
        }else{
          $qty_total = $row_cart->qty + $qty;
          $total = $qty_total*$row->c_price;

          $data = array('qty'          => $qty_total,
                        'price'        => $total,
                        'date_created' => date('Y-m-d H:i:s'));
          $this->db->where('id',$row_cart->id);
          $this->db->update('tbl_cart_add',$data);
          $json = array('id'      => $row_cart->id,
                        'qty'     => $qty_total,
                        'total'   => $total,
                        'c_price' => number_format($total,2),
                        'action'  => 'update');
        }
        return $json;

   }
   function Create_Product_Collection($id,$c_name){
        $query = $this->db->select('*,d.id as project_no')
        ->from('tbl_project_color as c')
        ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
        ->where('c.c_name',$c_name)->get();
        $row = $query->row();

        $query1 = $this->db->select('*')->from('tbl_cart_collection')->where('project_no',$row->project_no)->where('customer',$id)->limit(1)->get();
        $row1 = $query1->row();
        if(!$row1){
          $data = array('project_no'  => $row->project_no,
                        'customer'    => $id,
                        'date_created'=> date('Y-m-d H:i:s'));
          $this->db->insert('tbl_cart_collection',$data);
          $last_id = $this->db->insert_id();
          return $last_id = $this->db->insert_id();  
        }else{
            return $row1->id;  
        }
   }
  function Create_Deposit($firstname,$lastname,$mobile,$email,$order_no,$date_deposite,$amount,$bank){
            if($image){$images = $this->move_to_folder1($image,$tmp,$path_image);}else{$images='default.jpg';}
             $si_no ="";
             $type ="";
            $row = $this->db->select('*')->from('tbl_salesorder_stocks')->where('so_no',$order_no)->get()->row();
            if($row){
                $si_no = $row->si_no;
                $type = 1;
            }else{
                $row1 = $this->db->select('*')->from('tbl_salesorder_project')->where('so_no',$order_no)->get()->row();
                if($row1){
                   $si_no = $row1->si_no;
                   $type = 2;
                }
            }
           $data = array('order_no' => $order_no,
                        'si_no'=> $si_no,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'mobile'=> $mobile,
                        'email'=> $email,
                        'date_deposite'=> date('Y-m-d',strtotime($date_deposite)),
                        'amount'=> $amount,
                        'bank'=> $bank,
                        'image'=> $images,
                        'status' => 'P',
                        'type'=>$type);
           if(!$si_no){
                return array('status'=>'error');
           }else{
                $this->db->insert('tbl_customer_deposite',$data);
                return array('status'=>'success');
           }
  }
  function Create_Email($name,$subject,$comment,$email){
    $query = $this->db->select('*')->from('tbl_smtp_setup')->get();
    $row = $query->row();
    if($row->status == 'ACTIVE'){
       $config = Array(
             'protocol'  => $row->protocol,
             'smtp_host' => $row->smtp_host,
             'smtp_port' => $row->smtp_port,
             'smtp_user' => $row->smtp_user, 
             'smtp_pass' => $row->smtp_pass, 
             'mailtype'  => $row->mailtype,
             'charset'  => 'iso-8859-1',
             'wordwrap'  => TRUE
          );
          $this->load->library('email', $config);
          $this->email->set_newline("\r\n");
          $this->email->from($email);
          $this->email->to($row->email);
          $this->email->subject($subject);
          $this->email->message($comment);
          $this->email->send();
    }
    $data = array('name'    => $name,
                  'email'   => $email,
                  'subject' => $subject,
                  'comment' => $comment,
                  'date_created' => date('Y-m-d H:i:s'));
    $this->db->insert('tbl_contact_us',$data);
  }
    function Create_Service($firstname,$lastname,$mobile,$email,$production_no,$comment,$order_no,$service_image,$service_tmp,$path_service,$receipt_image,$receipt_tmp,$path_receipt){
          $status = false;
          $row = $this->db->select('*')->from('tbl_project')->where('production_no',$production_no)->get()->row();
            if($row){
                 $row = $this->db->select('*')->from('tbl_salesorder_stocks')->where('so_no',$order_no)->get()->row();
                 if(!$row){
                    $row = $this->db->select('*')->from('tbl_salesorder_project')->where('so_no',$order_no)->get()->row();
                    if(!$row){
                       return array('status'=>'error1'); 
                    }else{
                        $status = true;
                    }
                 }else{
                    $status = true;
                 }
            }else{
               return array('status'=>'error');
            }
          if($status == true){
              if($service_image){$image_service = $this->move_to_folder1($service_image,$service_tmp,$path_service);}else{$images="default.jpg";}
              if($receipt_image){$image_receipt = $this->move_to_folder1($receipt_image,$receipt_tmp,$path_receipt);}else{$images="default.jpg";}        $data = array('production_no'  => $production_no,
                                'so_no'          => $order_no,
                                'customer'       => $firstname.' '.$lastname,
                                'mobile'         => $mobile,
                                'email'          => $email,
                                'concern'        => $comment,
                                'receipt'        => $image_receipt,
                                'image'          => $image_service);
                    $this->db->insert('tbl_service_request',$data); 
                    return array('status'=>'success'); 
          }
  }

   function Update_Product_Cart($id,$qty,$total){
      $data=array('qty' => $qty,
                 'price'=> $total);
      $this->db->where('id',$id);
      $this->db->update('tbl_cart_add',$data);
   }
   function Update_Cart_Process($id){
      $data=array('status' => 'process');
      $this->db->where('id',$id);
      $this->db->update('tbl_cart_add',$data);
   }
   function Update_Cart_Product($id){
      $data=array('status' => 'cart');
      $this->db->where('id',$id);
      $this->db->update('tbl_cart_add',$data);
   }
   function Update_Cart_CheckOut($id,$b_address,$b_city,$b_province,$s_address,$s_city,$s_province,$order_date,$shipping_date,$order_no,$coupons,$subtotal,$total,$discount,$type,$region){
        $cart = array('order_no' => $order_no,
                      'status'   =>'checkout');
        $this->db->where('customer',$id);
        $this->db->where('status','process');
        $this->db->update('tbl_cart_add',$cart);

        $promo = array('order_no'=>$order_no,
                       'status'=>'used');
        $this->db->where('customer',$id);
        $this->db->where('promo_code',$coupons);
        $this->db->update('tbl_customer_promo',$promo);

        $insert = array('customer'      => $id,
                        'order_no'      => $order_no,
                        'promo_no'      => $coupons,
                        'b_address'     => $b_address,
                        'b_city'        => $b_city,
                        'b_province'    => $b_province,
                        's_address'     => $s_address,
                        's_city'        => $s_city,
                        's_province'    => $s_province,
                        'region'        => $region,
                        'subtotal'      => $subtotal,
                        'discount'      => $discount,
                        'total'         => $total,
                        'type'          => $type,
                        'status'        => 'REQUEST',
                        'date_created'  => date('Y-m-d H:i:s'),
                        'date_order'    => $order_date,
                        'date_shipping' => $shipping_date);
        $this->db->insert('tbl_cart_address',$insert);
   }
    function Update_Password($id,$password){
        $data = array('password' => md5($password));
        $this->db->where('id',$id);
        $this->db->update('tbl_customer_online',$data);
    }
    function Update_Account($id,$firstname,$lastname,$address,$city,$province,$region,$mobile){
        $data = array('firstname' => $firstname,
                      'lastname'  => $lastname,
                      'mobile'    => $mobile,
                      'address'   => $address,
                      'city'      => $city,
                      'province'  => $province,
                      'region'    => $region);
        $this->db->where('id',$id);
        $this->db->update('tbl_customer_online',$data);
    }
}
?>
