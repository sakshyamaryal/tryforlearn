<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Passwordreset_model extends CI_Model {

   
   
    function update()
    {
        if(isset($_POST['isapi']))
    {
      $userid=$this->input->get_request_header('Userid', True);
    }
    else
    {
      $userid=$this->session->userdata('userid');
    }
        $data=array
        (
            'password'=>md5($this->input->post('password')),
          
        );
        $this->db->where('user_id',$userid);
        if($this->db->update('users',$data))
        {
            return true;
        }
        else
        {
               return false;
        }
    }

   
    
}