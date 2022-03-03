<?php
class Email_model extends CI_Model
{  

   //Fetch Data
   public function email($type,$from,$subject,$message,$name)
   {        
      $query =  $this->db->select('*')->from('tbl_company_profile')->where('id',1)->get();
      $row = $query->row();
      $query = $this->db->select('*')->from('tbl_smtp_setup')->where('id',1)->get();
      $row = $query->row();
      $config = Array(
             'protocol'  => $row->protocol,
             'smtp_host' => $row->smtp_host,
             'smtp_port' => $row->smtp_port,
             'smtp_user' => $row->smtp_user, 
             'smtp_pass' => $row->smtp_pass, 
             'mailtype'  => $row->mailtype,
             'charset'   => $row->charset);
       switch($type){
           	 case "verification_code":{
                   $message = '<div style="background-color:#f2f3f5;padding:20px">
                      <div style="max-width:600px;margin:0 auto"> 
                          <div style="background:#fff;font:14px sans-serif;color:#686f7a;border-top:4px solid #42B9D3;margin-bottom:20px">        
                              <div style="padding:0px 30px">        
                                  <div style="font-size:16px;line-height:1.5em;border-bottom:1px solid #f2f3f5;padding-bottom:10px;margin-bottom:20px">        
                                      <p style="margin: 0;"><a style="text-decoration:none;color:#000"></a> Hi '.ucfirst($name).',</p>        
                                      <p style="margin: 0;"><a style="text-decoration:none;color:#000"></a>Confirmation Code : '.$message.'</p>                 
                                      <p style="text-align:center;"><a style="text-decoration:none;color:#000"></a><b>Genteel Home Support Team</b></p>        
                                  </div>
                                  <div style="font:11px sans-serif;color:#686f7a">
                                  <p style="margin: 0;">© 2021. Genteel Home</p>        
                                  </div>        
                              </div>  
                          </div>
                      </div>
                  </div>';
           	 break;}
             case "user_forgotpassword":{
                   $message = '<div style="background-color:#f2f3f5;padding:20px">
                      <div style="max-width:600px;margin:0 auto"> 
                          <div style="background:#fff;font:14px sans-serif;color:#686f7a;border-top:4px solid #42B9D3;margin-bottom:20px">        
                              <div style="padding:0px 30px">        
                                  <div style="font-size:16px;line-height:1.5em;border-bottom:1px solid #f2f3f5;padding-bottom:10px;margin-bottom:20px">        
                                      <p style="margin: 0;"><a style="text-decoration:none;color:#000"></a> Hi '.ucfirst($name).',</p>        
                                      <p style="margin: 0;"><a style="text-decoration:none;color:#000"></a>Confirmation Code : '.$message.'</p>                 
                                      <p style="text-align:center;"><a style="text-decoration:none;color:#000"></a><b>Genteel Home Support Team</b></p>        
                                  </div>
                                  <div style="font:11px sans-serif;color:#686f7a">
                                  <p style="margin: 0;">© 2021. Genteel Home</p>        
                                  </div>        
                              </div>  
                          </div>
                      </div>
                  </div>';
             break;
             }
             case "Customer_forgotpassword":{
                   $message = '<div style="background-color:#f2f3f5;padding:20px">
                      <div style="max-width:600px;margin:0 auto"> 
                          <div style="background:#fff;font:14px sans-serif;color:#686f7a;border-top:4px solid #42B9D3;margin-bottom:20px">        
                              <div style="padding:0px 30px">        
                                  <div style="font-size:16px;line-height:1.5em;border-bottom:1px solid #f2f3f5;padding-bottom:10px;margin-bottom:20px">        
                                      <p style="margin: 0;"><a style="text-decoration:none;color:#000"></a> Hi '.ucfirst($name).',</p>        
                                      <p style="margin: 0;"><a style="text-decoration:none;color:#000"></a>Confirmation Code : '.$message.'</p>                 
                                      <p style="text-align:center;"><a style="text-decoration:none;color:#000"></a><b>Genteel Home Support Team</b></p>        
                                  </div>
                                  <div style="font:11px sans-serif;color:#686f7a">
                                  <p style="margin: 0;">© 2021. Genteel Home</p>        
                                  </div>        
                              </div>  
                          </div>
                      </div>
                  </div>';
             break;
             }
             case "contuct_us":{
                
             break;
             }
       }
      
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");
      $this->email->from($row->email);
      $this->email->to($from);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()) {
        return true; 
      }else{
        return false; 
      }
	} 
}
?>
