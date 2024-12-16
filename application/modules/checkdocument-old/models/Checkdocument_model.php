<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkdocument_model extends CI_Model {
    
   function check()
   {
       $this->db->select('*');
       $this->db->from('s_certificate');
       $this->db->where('Document_Number',$this->input->post('dn'));
       $this->db->where('Citizenship',$this->input->post('dob'));
       $this->db->where('Phone',$this->input->post('ed'));
       $res=$this->db->get()->result_array();
       // if(count($res)>0){
       // return $res[0]['upload_file'];
       // }else{
       //  return false;
       // }
      

   }
   function gettrainee($id)
   {
       $this->db->select('*');
       $this->db->from('s_certificate');
       $this->db->where('Document_Number',$this->input->post('dn'));
       $this->db->where('Citizenship',$this->input->post('dob'));
       $this->db->where('Phone',$this->input->post('ed'));
       $res=$this->db->get()->result_array();
 
   }
}