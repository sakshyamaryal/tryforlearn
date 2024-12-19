<?php

class Chapter_model extends CI_Model
{
  
  function getsubject($classid)
  {
    $join=$where='';
    if($this->session->userdata('adminusertype')!='1' && $this->session->userdata('adminusertype')!='2')
    {
      $join=' join usersubjectchapter_permission up on up.subjectid=s.subject_id';
      $where=' and up.chapterid=0 and up.userid='.$this->session->userdata('adminuserid');
    }
    
    $sql="select s.subject_id,s.subject_name from subject s
        ".$join."
     where classid=? and is_active=1 ".$where."  order by subject_name";
    $res=$this->db->query($sql,array($classid))->result();
    return $res;
  }

  function getchapter($where)
  {
    $this->db->order_by('priority');
    $this->db->select('c.*');
    $this->db->from('chapter c');
    if($_POST['toshow']=='Y'):
    if($this->session->userdata('adminusertype')!='1' && $this->session->userdata('adminusertype')!='2')
    {
      $this->db->join('usersubjectchapter_permission up','up.chapterid=c.chapterid and up.subjectid=c.subjectid');
      $this->db->where('up.chapterid!=',0);
      $this->db->where('userid',$this->session->userdata('adminuserid'));
    }
    endif;
    $this->db->where($where);
    $qry=$this->db->get();
   // var_dump($this->db->last_query());exit;
    if($qry->num_rows()>0)
    return $qry->result();
    else
    return array();

  }

  public function updateChapter ($id)
	{
    $data = array(
      'is_active' => 0
    );
		$this->db->where_in('chapterid', $id);
		if ($this->db->update('chapter', $data)) {
			return 1;
		} else {
			return 0;
		}
	}
}