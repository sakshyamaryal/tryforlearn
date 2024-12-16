<?php

class Topic_model extends CI_Model
{
  function getsubjectchapter__($classid,$subjectid)
  {
    $sql="select * from chapter
     where classid=? and subjectid=? and is_active=1 order by priority";
    $res=$this->db->query($sql,array($classid,$subjectid))->result();
    return $res;
  }
    function getsubjectchapter($classid,$subjectid)
  {
    $join=$where='';
    if($this->session->userdata('adminusertype')!='1' && $this->session->userdata('adminusertype')!='2')
    {
      $join=' join usersubjectchapter_permission up on up.subjectid=c.subjectid and up.chapterid=c.chapterid';
      $where=' and up.chapterid!=0 and  up.userid='.$this->session->userdata('adminuserid');
    }
    $sql="select c.* from chapter c
    ".$join."
     where classid=? and c.subjectid=? and is_active=1 ".$where." order by priority";
    $res=$this->db->query($sql,array($classid,$subjectid))->result();
    return $res;
  }
}