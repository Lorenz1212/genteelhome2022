<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Appinfo {
        protected $CI;
        public function __construct() {
            $this->CI =& get_instance();    
            $this->CI->load->library('encryption');  
            $this->CI->load->helper('array');

            //Admin Login Background
            $this->admin_bg = base_url('assets/media/bg/bg-1.jpg');
            $this->admin_color = " ";

            //Member Login Background
            $this->member_bg = base_url('assets/media/bg/bg-1.jpg');
            $this->member_color = " ";

            //EMAIL SET UP
            $this->protocol = 'smtp';
            $this->smtp_host = 'ssl://smtp.gmail.com';
            $this->smtp_port = '465';
            $this->smtp_user = 'britsbrots@gmail.com';
            $this->smtp_pass = 'llqvytzgzeivgfeg';
            $this->mailtype = 'html';
            $this->charset = 'iso-8859-1';
            $this->web_email ='lorenzcabreros@gmail.com';
            $this->web_url_forgotpassword = base_url().'authentication/forgot_password';

            //Creator
            $this->created_by = 'Lorenz Cabreros';
            $this->creator_fb = 'https://www.facebook.com/lorenz1212';
            
            //SESSION
            $this->sess_name = "GENTEELHOMES";

            //Company
            $this->app_company = 'Genteel Homes';
            $this->app_year = '2022';
            $this->app_location ='Sta. Rosa, Laguna';

            //LOGO
            $this->email_logo = base_url('images/logo/logo-email.png'); 
            $this->app_logo =  base_url('images/logo/logo-small.png');
        }
        public function sess_name(){return $this->sess_name;}

        //EMAIL SET UP
        public function smtp_host(){return $this->smtp_host;}
        public function smtp_port(){return $this->smtp_port;}
        public function smtp_user(){return $this->smtp_user;}
        public function smtp_pass(){return $this->smtp_pass;}
        public function mailtype(){return $this->mailtype;}
        public function charset(){return $this->charset;}

        public function web_url_forgotpassword(){return $this->web_url_forgotpassword;}    

        public function email_logo(){return $this->email_logo;}
        public function app_location(){return $this->web_location;}
        public function web_email(){return $this->web_email;}
        public function protocol(){return $this->protocol;}
       
        
        //Creator
        public function created_by(){return $this->created_by;}
        public function creator_fb(){return $this->creator_fb;}
         

        //Background
        public function admin_bg(){ return $this->admin_bg;}
        public function admin_color(){ return $this->admin_color;}
        public function member_bg(){ return $this->member_bg;}
        public function member_color(){ return $this->member_color;}

        //Web
        public function app_logo(){return $this->app_logo;}
        public function app_company(){return $this->app_company;}
        public function app_year(){return $this->app_year;}
        public function creative($role=false){
             $data = json_decode($this->CI->encryption->decrypt($this->CI->input->cookie($this->sess_name.'_designer_user', TRUE)),TRUE);
            if($data){return element($this->sess_name.$role, $data);}else{return false;}
        }
        public function production($role=false){
             $data = json_decode($this->CI->encryption->decrypt($this->CI->input->cookie($this->sess_name.'_production_user', TRUE)),TRUE);
             if($data){return element($this->sess_name.$role, $data);}else{return false;}
        }
        public function supervisor($role=false){
             $data = json_decode($this->CI->encryption->decrypt($this->CI->input->cookie($this->sess_name.'_supervisor_user', TRUE)),TRUE);
             if($data){return element($this->sess_name.$role, $data);}else{return false;}
        }
        public function sales($role=false){
             $data = json_decode($this->CI->encryption->decrypt($this->CI->input->cookie($this->sess_name.'_sales_user', TRUE)),TRUE);
             if($data){return element($this->sess_name.$role, $data);}else{return false;}
        }
        public function superuser($role=false){
             $data = json_decode($this->CI->encryption->decrypt($this->CI->input->cookie($this->sess_name.'_superuser_user', TRUE)),TRUE);
             if($data){return element($this->sess_name.$role, $data);}else{return false;}
        }
        public function accounting($role=false){
             $data = json_decode($this->CI->encryption->decrypt($this->CI->input->cookie($this->sess_name.'_accounting_user', TRUE)),TRUE);
             if($data){return element($this->sess_name.$role, $data);}else{return false;}
        }
        public function webmodifier($role=false){
             $data = json_decode($this->CI->encryption->decrypt($this->CI->input->cookie($this->sess_name.'_webmodifier_user', TRUE)),TRUE);
             if($data){return element($this->sess_name.$role, $data);}else{return false;}
        }
        public function admin($role=false){
             $data = json_decode($this->CI->encryption->decrypt($this->CI->input->cookie($this->sess_name.'_admin_user', TRUE)),TRUE);
             if($data){return element($this->sess_name.$role, $data);}else{return false;}
        }

}
?>