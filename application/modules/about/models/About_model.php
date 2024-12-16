<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class About_model extends CI_Model {

   

    function get_service()
    {
        $this->db->select('*');
        $this->db->from('service');
        $this->db->where('is_active','1');
        $this->db->order_by('service_id','asc');
        $query=$this->db->get();
        return $query->result_array();
    }

    
}