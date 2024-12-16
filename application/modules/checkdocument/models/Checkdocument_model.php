<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkdocument_model extends CI_Model {
    
   function check($post)
   {
       $this->db->select('*');
       $this->db->from('s_certificate');
       $this->db->where('Document_Number',$post['dn']);
       $this->db->where('Citizenship',$post['cn']);
       $this->db->where('Phone',$post['phone']);
       $res=$this->db->get()->result_array();
       if(count($res)>0){
       return $res[0];
       }else{
        return false;
       }
      

   }
   function getcertificate($id)
   {
       $this->db->select('*');
       $this->db->from('certificate');
       $this->db->where('certificateid',$id);
       
       $res=$this->db->get();
       if($res->num_rows()>0){
       return $res->row();
       }else{
        return false;
       }
       
   }
}