<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

    function get_banner()
    {
   
        $sql="select banner_id,banner_name as title,`desc` as description,concat('".base_url()."upload/banner/',image) as image
             from banner where is_active=1 order by banner_id desc";
             $query=$this->db->query($sql);
        return $query->result_array();
    }

   
    function get_category()
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('is_active','1');
        $this->db->order_by('category_id','asc');
        $query=$this->db->get();
        return $query->result_array();
    }

    function get_service()
    {
        $this->db->select('*');
        $this->db->from('service');
        $this->db->where('is_active','1');
        $this->db->order_by('service_id','asc');
        $query=$this->db->get();
        return $query->result_array();
    }

    function get_staff()
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('is_active','1');
        $this->db->order_by('staff_id','asc');
        $query=$this->db->get();
        return $query->result_array();
    }

    function get_testomonial()
    {
        $this->db->select('*');
        $this->db->from('testomonial');
        $this->db->where('is_active','1');
        $this->db->order_by('testomonial_id','asc');
        $query=$this->db->get();
        return $query->result_array();
    }

    function get_image()
    {
        $this->db->select('*');
        $this->db->from('gallery');
        $this->db->where('is_active','1');
        $this->db->order_by('gallery_id','desc');
        $this->db->limit(4);
        $query=$this->db->get();
        return $query->result_array();
    }

    function submit_enquiry()
    {
        $data=array(
            'fullname'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
            'phone'=>$this->input->post('phone'),
            'address'=>$this->input->post('address'),
            'course_id'=>$this->input->post('course_id'),
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