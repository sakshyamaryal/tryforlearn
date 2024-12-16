<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Studentprofile_model extends CI_Model {

   
    function getProfile()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_id',$this->session->userdata('userid'));

    
        $query=$this->db->get();
        return $query->row();

    }
    
    function getExtra()
    {
        $this->db->select('*');
        $this->db->from('user_information');
        $this->db->where('userid',$this->session->userdata('userid'));

    
        $query=$this->db->get();
        return $query->row();

    }
    function update_profile()
    {
        $data=array
        (
            'fullname'=>$this->input->post('name'),
            'address'=>$this->input->post('address'),
            'phone'=>$this->input->post('phone'),
            'email'=>$this->input->post('email')
        );
        $this->db->where('user_id',$this->session->userdata('userid'));
        if($this->db->update('users',$data))
        {
            return true;
        }
        else
        {
               return false;
        }
    }

    function submit_data()
   {
    $data=array
    (
        
        'parents_detail'=>$this->input->post('pd'),
        'parents_number'=>$this->input->post('pn'),
        'guardian_detail'=>$this->input->post('gd'),
        'guardian_number'=>$this->input->post('gn'),
        'extra'=>$this->input->post('extra'),
        
      

    );
    $this->db->where('userid',$this->session->userdata('userid'));
    if($this->db->update('user_information',$data))
    {
        return true;
    }
    else
    {
        return false;
    }
   }

    
}