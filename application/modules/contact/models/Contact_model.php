<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model {

    function submit_enquiry()
    {
        $data=array(
            'fullname'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
            'subject'=>$this->input->post('subject'),
          
            'message'=>$this->input->post('message'),
           
            'is_seen'=>'0'
        );
        if($this->db->insert('enquiry_form',$data))
        {
            return true;
        }
        else{
            return false;
        }
    }
}