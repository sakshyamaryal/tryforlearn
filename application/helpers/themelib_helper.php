<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
     function template($view,$data)
    {
        // echo 'Site is temporarily down.Please Contact your administrator.';
        // exit;
        
        $ci =& get_instance();
        if(isset($data['mode']) && $data['mode']=='frontend')
        {
            if($ci->session->userdata('name')!=null)
            {
                $name=$ci->session->userdata('name');
            }
            else{
                $name="";
            }
            if($ci->session->userdata('userid')!=null)
            {
                $userid=$ci->session->userdata('userid');
            }
            else{
                $userid="";
            }
        $data['header_title']="TRY FOR LEARN";
        $data['footer_title']="Softcherry Pvt. Ltd.";
        $data['href']="http://www.softcherry.com.np";
        $data['username']=$name;
        $data['userid']=$userid;
        $data['modules']=bar_category();
        $data['package_name']=package();
        $data['basic']=basic_info();
        }
        else
        {

        
        $data['header_title']="TRY FOR LEARN";
        $data['footer_title']="Softcherry Pvt. Ltd.";
        $data['href']="http://www.softcherry.com.np";
        $data['admin_base_url']=base_url()."dashboard";
        $data['adminusername']=$ci->session->userdata('adminname');
        $data['adminuserid']=$ci->session->userdata('adminuserid');
        $data['modules']=get_modules();
        }
        $content="";

        if($view['header']!=false){
        $content  = $ci->load->view($view['header'], $data);
        }
        if($view['sidebar']!=false){
        $content  = $ci->load->view($view['sidebar'], $data);
        }
        $content .= $ci->load->view($view['body'], $data);
        if($view['footer']!=false){
        $content .= $ci->load->view($view['footer'], $data);
        }

        return $content;
    }

    function get_modules()
    {
        $ci =& get_instance();
         $userid=$ci->session->userdata('adminusertype');
        $sql="select m.* from modules_permission mp left join modules m on mp.module_id=m.module_id where mp.userid=? and is_active='1' and m.parent_module='0' and m.bar_type='1' order by display_order asc";
        $res=$ci->db->query($sql,array($ci->session->userdata('adminusertype')));
        $result=$res->result_array();
        $data=array();
        foreach ($result as $val)
        {
            $sql1="select m.* from modules_permission mp left join modules m on mp.module_id=m.module_id where mp.userid=? and is_active='1' and m.parent_module=? and m.bar_type='1' order by display_order asc";
            $res1=$ci->db->query($sql1,array($ci->session->userdata('adminusertype'),$val['module_id']));
            $result1=$res1->result_array();
            $data[]=array
            (
                'menu'=>$val,
                'submenu'=>$result1

            );

            



        }
    //var_dump($data);exit();
        //return $result;
        return $data;

       
    }

    function basic_info()
    {
        $ci =& get_instance();
        $sql="select * from about_us where id='1' and is_active='1'";
        $res=$ci->db->query($sql);
        $result=$res->row();
        return $result;

    }
    function bar_category()
    {
        $ci =& get_instance();
        
        $sql="select m.* from modules_permission mp left join modules m on mp.module_id=m.module_id where mp.userid='3' and is_active='1' and m.parent_module='0' and m.bar_type='2' order by display_order asc";
        $res=$ci->db->query($sql);
        $result=$res->result_array();
        $data=array();
        foreach ($result as $val)
        {
            $sql1="select m.* from modules_permission mp left join modules m on mp.module_id=m.module_id where mp.userid='3' and is_active='1' and m.parent_module=? and m.bar_type='2' order by display_order asc";
            $res1=$ci->db->query($sql1,array($val['module_id']));
            $result1=$res1->result_array();
            $data[]=array
            (
                'menu'=>$val,
                'submenu'=>$result1

            );
          }

     
          return $data;

    }

   
    function package()
    {
        $ci =& get_instance();
        $sql="select * from level where is_active='1'";
        $res=$ci->db->query($sql);
        $result=$res->result_array();
        return $result;

    }

    function get_Last_Id($field,$table)
    {
        $nextid=1;
        $ci =& get_instance();
        $sql="SELECT MAX(".$field.") as lastid FROM ".$table;
        $res=$ci->db->query($sql);
        $result=$res->row();
        if($result->lastid==null)
        {
            $nextid=$nextid;
        }
        else
        {
               $nextid=$result->lastid+$nextid;
        }
        return $nextid;

    }


  function get_real_ipaddr()
{
if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
$ip=$_SERVER['HTTP_CLIENT_IP'];
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
else
$ip=$_SERVER['REMOTE_ADDR'];
return $ip;

}
function check_permission($keyword)
{        $ci =& get_instance();
        $sql="select * from modules_permission mp left join modules m on m.module_id=mp.module_id where mp.userid=? and m.controller_fname like '%".$keyword."%'
        ";
        $res=$ci->db->query($sql,array($ci->session->userdata('adminusertype')));
        $result=$res->result();
        return (count($result)>0)? true:false;
        

    }


  function findMacAddress(){
        ob_start();  
system('ipconfig /all');  
$mycomsys=ob_get_contents();  
ob_clean();  
$find_mac = "Physical";  
$pmac = strpos($mycomsys, $find_mac);  
$macaddress=substr($mycomsys,($pmac+36),17);  
return $macaddress;  

}
function send_email($to_email,$subject,$message)
{ 
    $ci =& get_instance();
     $from_email = 'info@tryforlearn.com';

    $subject ="$subject";
   $message = "$message" ;
   


    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.zoho.com',
      'smtp_port' => '465', // 465
      'smtp_user' => $from_email, // change it to your email
      'smtp_pass' => '@012+z02aGJak1', // change it to your password
    
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE,
      'newline' => "\r\n"
       
      
       );
       $ci->load->library('email');

    $ci->email->initialize($config);
    //send mail
    $ci->email->from($from_email, 'Try for Learn'); //Mydomain- - Sender name
    $ci->email->to($to_email);
    $ci->email->subject($subject);
    $ci->email->message($message);
    //
   if ($ci->email->send()) {
return true; }
else {
    echo 'Please Contact Server Administration';exit;
 //return false;
 //var_dump($ci->email->print_debugger());exit;
} 



}
function APIKEY()
{
    $ci =& get_instance();
    $header=$ci->input->request_headers();
    $path= current_url();
    $explode=explode('user/',$path);
    if(isset($explode[1]) && $explode[1]=='deactivateaccount')
    {
        return true;
    }


    if($header['Apikey']=='b2c122d0794640bd949b9d6b6bb4bb99')
    {
        
        return true;
    }
    else
    {
        header('Content-Type: application/json');
        echo json_encode(array('type'=>'error','message'=>'Invalid Api Key.'));
        exit;
    }
}
function getJsonData($response = false){

    try{
        header('Content-Type: application/json');

        if($response['type']=='error'){
            throw new Exception($response['message']);
        }        	
   
    }
    catch(Exception $e){
    $response = array('type'=>'error', 'message'=>$e->getMessage());        	
    }
    return json_encode($response);
}


  
?>