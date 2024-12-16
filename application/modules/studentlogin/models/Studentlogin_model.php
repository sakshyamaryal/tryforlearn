<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Studentlogin_model extends CI_Model {
    
    function verify($username, $password) 
    {
        
        $sql="SELECT user_id,user_id as userid,fullname,username,email,preffered_language,refferalcode,address,phone,image,is_emailverified,is_login,deviceid,istemp,istrialsubscribed FROM users WHERE username = ? AND password = ? and user_type in ('3', '9')   limit 1 ";
        $query=$this->db->query($sql,array($username,$password));
        $result = $query->row_array();
        //var_dump($this->db->last_query());exit;
        if ($query->num_rows() > 0)
        {  
            if(isset($_POST['isapi']))
            {
                $result['isnewdevice']='N';
                if(isset($_POST['deviceid']) && $_POST['deviceid']!='' && $result['deviceid']!=''  && $_POST['deviceid']!=$result['deviceid'])
                {
                    $result['isnewdevice']='Y';
                    return $result;
                }
                else if($result['is_login']=='1'){
                    return 1;
                } 
                // else if($result['is_approved']=='0'){
                //     return 0;
                // } 
                // else if($result['is_emailverified']=='0'){
                //     return 0;
                // } 
                else
                return $result;

            }
            else
            {
                if($result['is_login']=='1'){
                    return 1;
                } 
                else if($result['is_approved']=='0'){
                    return 0;
                } 
                else if($result['is_emailverified']=='0'){
                    return 0;
                } 
                else{
                $data=array(
                    'is_login'=>'1',
                    'login_datetime'=>date('Y-m-d H:i:s',strtotime('+2 hour +20 minutes',strtotime(date('Y-m-d H:i:s'))))
                );
                $this->db->where('username',$username);
                $this->db->update('users',$data);
                $this->session->set_userdata('userid',$result['user_id']);
                $this->session->set_userdata('usertype',$result['user_type']);
                $this->session->set_userdata('istemp',$result['istemp']);
                $this->session->set_userdata('istrialsubscribed',$result['istrialsubscribed']);
                $this->session->set_userdata('name',$result['fullname']);
                $this->session->set_userdata('username',$result['username']);
                $this->session->set_userdata('email',$result['email']);
                $this->session->set_userdata('language',$result['preffered_language']);
                $this->session->set_userdata('refferalcode',$result['refferalcode']);
                return 2;
            }

            }
           
        }
        else 
        {
            return false;
        }
    }
    function logout()
    {
        if(isset($_POST['isapi']))
        {
            $data=array(
                'is_login'=>'0'
    
            );
            $this->db->where('user_id',$this->input->get_request_header('Userid', True));
            $this->db->update('users',$data);
            return true;
        }
        else
        {

        
        $data=array(
            'is_login'=>'0'

        );
        $this->db->where('user_id',$this->session->userdata('userid'));
        $this->db->update('users',$data);
        $this->session->set_userdata('userid',"");
        $this->session->set_userdata('usertype',"");
        $this->session->set_userdata('name',"");
        $this->session->set_userdata('username',"");
        $this->session->set_userdata('email',"");
            return true;
        }
    }
    function getSingleRow($where)
    {
        $this->db->select('*');
        $this->db->where($where);
        
       $res= $this->db->get('users')->result();
       return (count($res)>0)?$res[0] : '0';
    }

    function submit_otp($email)
    {
        $otp_code=mt_rand(100000,999999);
        $datetime=date('Y-m-d h:i'); 

        $data=array(
            'otp_code'=>$otp_code,
            'otp_datetime'=>$datetime
        );
        if(isset($_POST['deviceid']))
        {
            $data['deviceid']=$_POST['deviceid'];
        }
        $this->db->where('email',$email);
       return ($this->db->update('users',$data))?  $otp_code : false;
        
    }
    function update_password()
    { 

        $data=array(
            'is_emailverified'=>1,
            'otp_code'=>"",
            'password'=>md5($this->input->post('pwd'))
            
        );
        $this->db->where('email',$this->input->post('email'));
       return ($this->db->update('users',$data))?  true : false;

    }
     
    function autologout()
    {
        $sql="select user_id from users  where ? > login_datetime and is_login=1 and device='web'";
        $res=$this->db->query($sql,array(date('Y-m-d H:i:s')))->result();
        if(count($res)>0)
        {
            foreach($res as $datal)
            {
                $data=array('is_login'=>0);
                $this->db->where('user_id',$datal->user_id);
                $this->db->update('users',$data);

            }
        }
        return true;
    }

    function checkloggedindevice()
    {
        $sql="select deviceid from users where user_id=?";
        $res=$this->db->query($sql,array($_POST['userid']))->row();
        if(trim($res->deviceid)=='')
        {
            $this->db->where('user_id',$_POST['userid']);
            $this->db->update('users',array('deviceid'=>$_POST['deviceid']));
            return $_POST['deviceid'];
        }
        else
        {
            return $res->deviceid;
        }
    }

   
}