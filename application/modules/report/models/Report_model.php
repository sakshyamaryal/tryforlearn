<?php

class Report_model extends CI_Model
{
    function getreport($post)
    {
        $where='';
        if($post['toshow']=='Y')
		{
            $where=" and classid='".$post['class']."'";
		}
        $sql="select r.*,u.fullname,u.phone,u.email from rank r 
           join users u on u.user_id=r.studentid
           where r.levelid=? and examtypeid=? and is_subj_obj=?".$where;
         $res=$this->db->query($sql,array($this->session->userdata('levelid'),$post['examtypeid'],$post['examtype']));
         if($res->num_rows()>0)
         return $res->result();
         else
         return array();  
    }

    function syncrank($post)
    {
        $this->db->trans_begin();
        if($post['toshow']=='Y')
		{
            $this->db->where('classid',$post['class']);

		}
        $this->db->where('levelid',$post['levelid']);
        $this->db->where('examtypeid',$post['examtypeid']);
        $this->db->where('is_subj_obj',$post['examtype']);
        $this->db->delete('rank');
        
        $where='';
        if($post['toshow']=='Y')
		{
            $where=" and classid='".$post['class']."'";
		}
        $sql="select sum(totalmark) as totalmark,sum(obtainedmark) as total,is_subj_obj,levelid,classid,examtypeid,
        studentid,examdate,language from studentexamset
        where levelid=? and examtypeid=? and is_subj_obj=?".$where." 
         group by studentid order by total desc"
       
        ;
        //examtypeid,levelid,is_subj_obj,
      $res=$this->db->query($sql,array($this->session->userdata('levelid'),$post['examtypeid'],$post['examtype']));
      if($res->num_rows()>0)
      {
        $result= $res->result();
        $rank=0;
        foreach($result as $key => $val)
        {
            $rank++;
           $insert[]=array(
               'studentid'=>$val->studentid,
               'levelid'=>$val->levelid,
               'classid'=>$val->classid,
               'examtypeid'=>$val->examtypeid,
               'totalmark'=>$val->totalmark,
               'obtainedmark'=>$val->total,
               'percent'=>(float)($val->total/$val->totalmark)*100,
               'is_subj_obj'=>$val->is_subj_obj,
               'language'=>$val->language,
               'rank'=>$rank,
               'examdate'=>$val->examdate,

           );
         
        }
        $this->db->insert_batch('rank',$insert);
        if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
				$iu=0;
		}
		else
		{
				$this->db->trans_commit();
				$iu=1;
    }
    return $iu;

      }
      return 1;
   

       
    }

    function getreportpreview($post)
    {
       
        $sql="select se.*,c.name as classname,subject_name from studentexamset se
        
        left join class c on c.classid=se.classid
        left join subject s on s.subject_id=se.subjectid
        where se.levelid=?  and examtypeid=? and is_subj_obj=? and studentid=? and se.classid=? 
        ";
         $res=$this->db->query($sql,array($post['levelid'],$post['examtypeid'],$post['is_subj_obj'],$post['studentid'],$post['classid']));
      if($res->num_rows()>0)
      {
        return $res=$res->result();
      }
      else 
      return array();
    }
    function getreportmain($post)
    {
        $sql="select se.*,u.fullname,u.email,u.phone,u.address,l.name as levelname,examtypename,fullmarks,passmarks from rank se
        join users u on u.user_id=se.studentid
        join level l on level_id=se.levelid
        join examtype e on e.examtypeid=se.examtypeid
        where id=? 
        ";
         $res=$this->db->query($sql,array($post['rankid']));
      if($res->num_rows()>0)
      {
        return $res=$res->row();
      }
      else 
      return array();

    }
}