<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function getRows($table,$where,$select)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);

        $query=$this->db->get();
      
        return $query->row();
       
    }
   
}