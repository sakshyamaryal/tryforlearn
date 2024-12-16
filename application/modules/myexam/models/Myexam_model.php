<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Myexam_model extends CI_Model {

    function getlist()
    {
      if(isset($_POST['isapi']) && $_POST['isapi']=='Y')
      {
        $userid=$this->input->get_request_header('Userid', True);
        $refferalcode=$_POST['refferalcode'];
      }
      else
      {
        $userid=$this->session->userdata('userid');
        $refferalcode=$this->session->userdata('refferalcode');
      }

       // FINAL EXAM QUES ON THAT PARTICULAR DAY AND OTHER QUES SET FOR PRACTICE GIVEN TO ALL DATE
$wherearray=array($userid,date('Y-m-d'),$userid);
        $sql="SELECT s.subject_name,e.questiondate,is_subj_obj,e.classid,e.subjectid,e.levelid,
        l.name as levelname,e.examtypeid,examtypename FROM `exercise` e
         join level l on l.level_id=e.levelid 
         left join subject s on s.subject_id=e.subjectid
         join examtype et on et.examtypeid=e.examtypeid
         join student_enroll se on se.subjectid=s.subject_id
        where is_common='N' and e.is_active=1  and e.questiondate!='' and e.examtypeid!=8
        and userid=?
        group by examtypeid,questiondate,`is_subj_obj`,levelid,classid,subjectid
        union all
        SELECT s.subject_name,e.questiondate,is_subj_obj,e.classid,e.subjectid,e.levelid,
        l.name as levelname,e.examtypeid,examtypename FROM `exercise` e
         join level l on l.level_id=e.levelid 
         left join subject s on s.subject_id=e.subjectid
         join examtype et on et.examtypeid=e.examtypeid
         join student_enroll se on se.subjectid=s.subject_id

        where is_common='N' and e.is_active=1  and e.questiondate=? and e.examtypeid=8
        and userid=?
        group by examtypeid,questiondate,`is_subj_obj`,levelid,classid,subjectid
        union all
        SELECT s.subject_name,e.questiondate,is_subj_obj,e.classid,e.subjectid,e.levelid,
        l.name as levelname,e.examtypeid,examtypename FROM `exercise` e
         join level l on l.level_id=e.levelid 
         left join subject s on s.subject_id=e.subjectid
         join examtype et on et.examtypeid=e.examtypeid
        where is_common='N' and e.is_active=1  and l.is_payable=0
        group by examtypeid,questiondate,`is_subj_obj`,levelid,classid,subjectid
        ";
        if($refferalcode!='')
        {
          $sql .="union all SELECT s.subject_name,e.questiondate,is_subj_obj,e.classid,e.subjectid,e.levelid,
          l.name as levelname,e.examtypeid,examtypename FROM `exercise` e
           join level l on l.level_id=e.levelid 
           left join subject s on s.subject_id=e.subjectid
           join examtype et on et.examtypeid=e.examtypeid
           join student_enroll se on se.subjectid=s.subject_id
           join users u on e.created_by=u.user_id
          where is_common='N' and e.is_active=1  and e.questiondate!='' and e.examtypeid!=8
          and userid=? and refferalcode=?
          group by examtypeid,questiondate,`is_subj_obj`,levelid,classid,subjectid
          union all
          SELECT s.subject_name,e.questiondate,is_subj_obj,e.classid,e.subjectid,e.levelid,
          l.name as levelname,e.examtypeid,examtypename FROM `exercise` e
           join level l on l.level_id=e.levelid 
           left join subject s on s.subject_id=e.subjectid
           join examtype et on et.examtypeid=e.examtypeid
           join student_enroll se on se.subjectid=s.subject_id
           join users u on e.created_by=u.user_id

          where is_common='N' and e.is_active=1  and e.questiondate=? and e.examtypeid=8
          and userid=? and refferalcode=?
          group by examtypeid,questiondate,`is_subj_obj`,levelid,classid,subjectid
          union all
          SELECT s.subject_name,e.questiondate,is_subj_obj,e.classid,e.subjectid,e.levelid,
          l.name as levelname,e.examtypeid,examtypename FROM `exercise` e
           join level l on l.level_id=e.levelid 
           left join subject s on s.subject_id=e.subjectid
           join examtype et on et.examtypeid=e.examtypeid
          where is_common='N' and e.is_active=1  and l.is_payable=0
          group by examtypeid,questiondate,`is_subj_obj`,levelid,classid,subjectid";
          array_push($wherearray,$userid,$refferalcode,date('Y-m-d'),$userid,$refferalcode);
        }
        $res=$this->db->query($sql,$wherearray); 
      //  echo $this->db->last_query();exit;
        if($res->num_rows()>0)
        return $res->result();
        else
        return array();
    }
    function checkattempt($post)
    {
      if(isset($_POST['isapi']) && $_POST['isapi']=='Y')
      {
        $userid=$this->input->get_request_header('Userid', True);
      }
      else
      {
        $userid=$this->session->userdata('userid');
      }
      if($post['is_subj']=='Y')
      {
        $post['is_subj']='S';
      }
      else
      {
        $post['is_subj']='O';
      }
      $sql="select * from studentexamset where studentid=? and  levelid=? and examtypeid=? and
      classid=? and subjectid=?  and examdate=? and is_subj_obj=?  ";
      $res=$this->db->query($sql,array($userid,$post['level'],$post['examtypeid'],$post['class'],$post['subject'],$post['date'],$post['is_subj']));
      //var_dump($this->db->last_query());exit;
      if($res->num_rows()>0)
      return 1;
      else
      return 0;
    }
    function getexercise($post)
    {
      $group="SELECT distinct e.groupid,g.groupname,g.perqnmark,g.fullmark from exercise e join 
      questiongroup g on e.groupid=g.groupid where levelid=? and examtypeid=? and
      classid=? and subjectid=?  and questiondate=? and is_subj_obj=? and e.is_active=1 and is_common='N'
       order by groupname";
      $res_group=$this->db->query($group,array($post['level'],$post['examtypeid'],$post['class'],$post['subject'],$post['date'],$post['is_subj']))->result();
      $ques=[];

      foreach($res_group as $key => $val)
      {
        
          if($val->groupid!='4')
          {
            $order=" order by rand()";

          }
          else 
          {
            $order='';
          } 
        $sql="select * from exercise where levelid=? and examtypeid=? and classid=? and subjectid=?  and questiondate=? and groupid=? and is_subj_obj=? and is_active=1 and is_common='N'  ".$order;
        $res=$this->db->query($sql,array($post['level'],$post['examtypeid'],$post['class'],$post['subject'],$post['date'],$val->groupid,$post['is_subj']))->result();
        $res_group[$key]->ques=$res;
        if(isset($_POST['isapi']))
        {
           foreach($res as $row)
           {
             $ques[$row->eid]=$row;
           }
        }

      }
      if(isset($_POST['isapi']))
      return array_values($ques);
      else
      return $res_group;
  
    }
    function getquiz($post)
    {
      $group="SELECT distinct e.groupid,g.groupname,g.perqnmark,g.fullmark from exercise e join 
      questiongroup g on e.groupid=g.groupid where levelid=? and examtypeid=? and
      classid=? and subjectid=? and questiondate=? and is_subj_obj=? and e.is_active=1 and is_common='N'
       order by groupname";
      $res_group=$this->db->query($group,array($post['level'],$post['examtypeid'],$post['class'],$post['subject'],$post['date'],$post['is_subj']))->result();
      $ques=[];


      foreach($res_group as $key => $val)
      {
        if($val->groupid!='4')
          {
            $order=" order by rand()";

          }
          else 
          {
            $order='';
          } 
        $sql="select * from exercise where  levelid=? and examtypeid=? and classid=? and subjectid=?  and questiondate=? and groupid=? and is_subj_obj=? and is_active=1 and is_common='N'  ".$order;
        $res=$this->db->query($sql,array($post['level'],$post['examtypeid'],$post['class'],$post['subject'],$post['date'],$val->groupid,$post['is_subj']))->result();
        foreach($res as $li =>$row)
        {
          $ques[$row->eid]=$row;

          $ans="select optionid,optionname,optionname_nep from exercise_option where eid=? and is_active=1 order by rand()";
          $ans_res=$this->db->query($ans,array($row->eid))->result();
          $res[$li]->ans=$ans_res;
        }
       $res_group[$key]->ques=$res;
      }
      if(isset($_POST['isapi']))
      return array_values($ques);
      else
      return $res_group;
  
    }

}