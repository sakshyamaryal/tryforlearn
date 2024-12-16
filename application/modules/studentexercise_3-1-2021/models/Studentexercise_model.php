<?php

class Studentexercise_model extends CI_Model
{
  function getexerciselist($post)
  {
    
    $where=$sts="";
    if($post['isself']=='N')
    {
    $where .=" and examtypeid ='".$post['examtypeid']."'";
    }
    else
    {
      $where .=" and chapterid='".$post['chapter']."'";
    }

    if(isset($post['examtype']) && $post['examtype']!='-1')
    $where .=" and is_subj_obj ='".$post['examtype']."'";

    if(isset($post['status']))
    {
       if($post['status']=='S')
       {
         $where .=" and setid > 0";
         $sts=" and setid > 0";
       }else if($post['status']=='O')
       {
        $sts=" and setid is null";
       }
       
    }

    if(isset($post['toshow']) && $post['toshow']=='Y')
    {
      $where .=" and se.classid='".$post['class']."'   and se.subjectid='".$post['subject']."'";
    }

    $sql="select s.user_id,s.fullname,s.phone,s.email,t.* from users s 

    left join ( select setid,is_subj_obj,case when is_subj_obj='S' then 'Subjective' else 'Objective' end as
     examcategory, case when isself='Y' then 'Self Practise' else 'Exam' end as examtype, 
     case when setid is null then 'No Record' else 'Submitted' end as status,examdate,
      totalqn,totalmark,obtainedmark,se.studentid,se.totaltimer,se.submitted_time from studentexamset se where levelid=? and  isself=? 
      ".$where."
      order by examdate desc,createddate desc ) t on t.studentid=s.user_id 
      where user_type=3 ".$sts." order by examdate desc, fullname asc";
     $res=$this->db->query($sql,array($post['levelid'],$post['isself']))->result();
     
     return $res;
  }

  function getexercise($id,$type)
  {
    $group="SELECT distinct e.groupid,g.groupname,g.perqnmark,g.fullmark,se.language from 
      studentexam se
       join exercise e  on se.question_id=e.eid
    join questiongroup g on e.groupid=g.groupid where 
    se.examsetid=?
      order by groupname";
      $res_group=$this->db->query($group,array($id))->result();
      foreach($res_group as $key => $val)
      {
        $sql="select e.*,se.submitted_answer,se.obtained_marks,se.examid,se.examsetid from
        studentexam se
        join  exercise  e on se.question_id=e.eid
        where se.examsetid=? ";
        $res=$this->db->query($sql,array($id))->result();
        $res_group[$key]->ques=$res;
      }
      return $res_group;

  }

  function getquiz($id,$type)
    {
      $group="SELECT distinct e.groupid,g.groupname,g.perqnmark,g.fullmark,se.language from studentexam se
      join exercise e  on se.question_id=e.eid
   join questiongroup g on e.groupid=g.groupid where 
   se.examsetid=? order by groupname";
      $res_group=$this->db->query($group,array($id))->result();
      foreach($res_group as $key => $val)
      {
        $sql="select e.*,se.submitted_answer,se.obtained_marks from
        studentexam se
        join  exercise  e on se.question_id=e.eid
        where se.examsetid=? ";
        $res=$this->db->query($sql,array($id))->result();
        foreach($res as $li =>$row)
        {
          $ans="select optionid,optionname,optionname_nep from exercise_option where eid=? and is_active=1 order by rand()";
          $ans_res=$this->db->query($ans,array($row->eid))->result();
          $res[$li]->ans=$ans_res;
        }
       $res_group[$key]->ques=$res;
      }
      return $res_group;
  
    }

    function updatemark($post)
    {
      $this->db->trans_begin();
      $total=0;
      $setid=0;
      foreach($post['examid'] as $key => $val)
    {
      $setid=$post['setid'][$key];
      $total=$total+(double)$post['marks'][$key];

      $update=array(
        'obtained_marks'=>$post['marks'][$key]
      );
      $this->db->where('examid',$val);
      $this->db->update('studentexam',$update);
    }
    $this->db->where('setid',$setid);
    $this->db->update('studentexamset',array('obtainedmark'=>$total));
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
}