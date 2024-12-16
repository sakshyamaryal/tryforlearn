<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permission_model extends CI_Model {
    public function subject_permission()
    {  
        $this->db->select('*');
        $this->db->from('usersubjectchapter_permission');
        $query=$this->db->get();
        $res= $query->result_array();
        $data=array();
        foreach($res as $val){
            $data[$val['subjectid']."_".$val['userid']]='1';
        }
        return $data;
    }
    function manage_subjectpermission()
    {
        if($this->input->post('mode')=='insert')
        {
           $data=array(
               'userid'=>$this->input->post('userid'),
               'subjectid'=>$this->input->post('subjectid')
           );
           $this->db->insert('usersubjectchapter_permission',$data);
           return true;

        }else{
           $this->db->where('userid',$this->input->post('userid'));
           $this->db->where('subjectid',$this->input->post('subjectid'));

           $this->db->delete('usersubjectchapter_permission');
           return true;

        }
    }
    public function chapter_permission()
    {  
        $this->db->select('*');
        $this->db->from('usersubjectchapter_permission');
        $query=$this->db->get();
        $res= $query->result_array();
        $data=array();
        foreach($res as $val){
            $data[$val['chapterid']."_".$val['subjectid']."_".$val['userid']]='1';
        }
        return $data;
    }
    function manage_chapterpermission()
    {
        if($this->input->post('mode')=='insert')
        {
           $data=array(
               'userid'=>$this->input->post('userid'),
               'subjectid'=>$this->input->post('subjectid'),
               'chapterid'=>$this->input->post('chapterid')
           );
           $this->db->insert('usersubjectchapter_permission',$data);
           return true;

        }else{
           $this->db->where('userid',$this->input->post('userid'));
           $this->db->where('subjectid',$this->input->post('subjectid'));
           $this->db->where('chapterid',$this->input->post('chapterid'));

           $this->db->delete('usersubjectchapter_permission');
           return true;

        }
    }
    
}