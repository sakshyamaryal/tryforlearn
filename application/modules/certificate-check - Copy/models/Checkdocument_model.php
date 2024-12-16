<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkdocument_model extends CI_Model {
    
   function check()
   {
       $this->db->select('upload_file');
       $this->db->from('document');
       $this->db->where('document_no',$this->input->post('dn'));
       $this->db->where('student_dob',$this->input->post('dob'));
       $this->db->where('exam_date',$this->input->post('ed'));
       $res=$this->db->get()->result_array();
       if(count($res)>0){
       return $res[0]['upload_file'];
       }else{
        return false;
       }
      

   }
}