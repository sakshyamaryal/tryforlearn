<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snotice_model extends CI_Model {

   function get_notice()
   {
      $sql='SELECT title,body,DATE_FORMAT(created_date, "%W , %M %e %Y") as cdate FROM notice where is_active=1
      UNION
      select title,body,DATE_FORMAT(created_date, "%W , %M %e %Y") as cdate from notification
      where is_active=1
      order by cdate desc';
      $res=$this->db->query($sql)->result_array();
       return $res;
   }
   
   

   
    
}