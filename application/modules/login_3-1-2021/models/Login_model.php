<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    function verify($username, $password) 
    {
        
        $sql="SELECT * FROM users WHERE username = ? AND password = ? and user_type !='3'  limit 1 ";
        $query=$this->db->query($sql,array($username,$password));
        $result = $query->row_array();
        if ($query->num_rows() > 0)
        {  
            if($result['is_login']=='1'){
                return 1;
            } else{
            $data=array(
                'is_login'=>'1',
                'login_datetime'=>date('Y-m-d H:i:s',strtotime('+2 hour +20 minutes',strtotime(date('Y-m-d H:i:s'))))
            );
            $this->db->where('username',$username);
            $this->db->update('users',$data);
            $this->session->set_userdata('adminuserid',$result['user_id']);
            $this->session->set_userdata('adminusertype',$result['user_type']);
            $this->session->set_userdata('adminname',$result['fullname']);
            $this->session->set_userdata('adminusername',$result['username']);
            $this->session->set_userdata('adminemail',$result['email']);
            return 2;
        }
        }
        else 
        {
            return false;
        }
    }
    function logout()
    {
        $data=array(
            'is_login'=>'0'
        );
        $this->db->where('user_id',$this->session->userdata('adminuserid'));
        $this->db->update('users',$data);
        $this->session->set_userdata('adminuserid',"");
        $this->session->set_userdata('adminusertype',"");
        $this->session->set_userdata('adminname',"");
        $this->session->set_userdata('adminusername',"");
        $this->session->set_userdata('adminemail',"");
        return true;

    }
    
    function autologout()
    {
        $sql="select user_id from users  where ? > login_datetime and is_login=1";
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
}