<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Localgallery_model extends CI_Model {

   

    function get_gallery()
    {
        $this->db->select('*');
        $this->db->from('gallery');
        $this->db->where('is_active','1');
        $this->db->order_by('gallery_id','asc');
        $query=$this->db->get();
        return $query->result_array();
    }

    
}