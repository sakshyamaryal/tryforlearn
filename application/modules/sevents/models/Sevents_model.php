<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sevents_model extends CI_Model {

   function get_event()
   {
       $this->db->select('*');
       $this->db->select('DATE_FORMAT(created_at, "%W , %M %e %Y") as cdate');
       $this->db->select('DATE_FORMAT(happening_date, "%W , %M %e %Y  %h:%i:%s %p") as edate');
       $this->db->from('events');
       $this->db->where('is_active','1');
       $this->db->order_by('created_at','desc');
       $res=$this->db->get()->result_array();
       return $res;
   }
   
}