<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    // function verify($username, $password) 
    // {
        
    //     $sql="SELECT * FROM users WHERE username = ? AND password = ? and user_type !='3'  limit 1 ";
    //     $query=$this->db->query($sql,array($username,$password));
    //     $result = $query->row_array();
    //     if ($query->num_rows() > 0)
    //     {  
    //         if($result['is_login']=='1' && $result['user_type']!='9'){
    //             return 1;
    //         } else{
    //         $data=array(
    //             'is_login'=>'1',
    //             'login_datetime'=>date('Y-m-d H:i:s',strtotime('+2 hour +20 minutes',strtotime(date('Y-m-d H:i:s'))))
    //         );
    //         $this->db->where('username',$username);
    //         $this->db->update('users',$data);
    //         $this->session->set_userdata('adminuserid',$result['user_id']);
    //         $this->session->set_userdata('adminusertype',$result['user_type']);
    //         $this->session->set_userdata('adminname',$result['fullname']);
    //         $this->session->set_userdata('adminusername',$result['username']);
    //         $this->session->set_userdata('adminemail',$result['email']);
    //         return 2;
    //     }
    //     }
    //     else 
    //     {
    //         return false;
    //     }
    // }
    public function verify($username, $password)
{
    // SQL query to fetch user by username and password, excluding user type 3 (likely students)
    $sql = "SELECT * FROM users WHERE username = ? AND password = ? AND user_type != '3' LIMIT 1";
    $query = $this->db->query($sql, array($username, $password));
    $result = $query->row_array();

    // Check if the query returned a valid user
    if ($query->num_rows() > 0) {
        // If the user is a super admin (user_type == 1)
        if ($result['user_type'] == 1) {
            // Super admins can login from multiple devices, so create a unique session identifier
            $sessionToken = md5(uniqid(rand(), true));  // Generate a unique session token

            // Store this session token in the session data
            $this->session->set_userdata('session_token', $sessionToken);

            // Set other session variables
            $this->session->set_userdata('adminuserid', $result['user_id']);
            $this->session->set_userdata('adminusertype', $result['user_type']);
            $this->session->set_userdata('adminname', $result['fullname']);
            $this->session->set_userdata('adminusername', $result['username']);
            $this->session->set_userdata('adminemail', $result['email']);
            
            return 2;  // Super admin successfully logged in
        }
        else {
            // If the user is not a super admin, check if they are already logged in from another device
            if ($result['is_login'] == '1' && $result['user_type'] != '9') {
                return 1;  // User is already logged in on another device
            } else {
                // Regular user: Set user as logged in
                $data = array(
                    'is_login' => '1',
                    'login_datetime' => date('Y-m-d H:i:s', strtotime('+2 hour +20 minutes', strtotime(date('Y-m-d H:i:s'))))
                );
                
                // Update the user's login status in the database
                $this->db->where('username', $username);
                $this->db->update('users', $data);

                // Set session data
                $this->session->set_userdata('adminuserid', $result['user_id']);
                $this->session->set_userdata('adminusertype', $result['user_type']);
                $this->session->set_userdata('adminname', $result['fullname']);
                $this->session->set_userdata('adminusername', $result['username']);
                $this->session->set_userdata('adminemail', $result['email']);

                return 2;  // Regular user successfully logged in
            }
        }
    } else {
        return false;  // Invalid username or password
    }
}

public function getUserByUsername($username)
{
    // Query to fetch user by username
    $sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
    $query = $this->db->query($sql, array($username));
    
    // Return the user data as an associative array
    return $query->row_array();
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