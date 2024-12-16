<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model {

   

    function get_detail($module,$submodule)
    {
        $path=$module."/".$submodule;
        $this->db->select('*');
        $this->db->from('page');
        $this->db->where('page_name',$path);

        $this->db->where('is_active','1');
        $query=$this->db->get();
        return $query->row();
    }

    
}