<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mygrades_model extends CI_Model {

    function getlist()
    {
        $where='';
        if(isset($_POST['chapterid']))
        {
            $where=" and ses.chapterid='".$_POST['chapterid']."'";
        }
        if(isset($_POST['subjectid']))
        {
            $where=" and ses.subjectid='".$_POST['subjectid']."'";
        }
        if(isset($_POST['isapi']))
      {
        $userid=$this->input->get_request_header('Userid', True);
      }
      else
      {
        $userid=$this->session->userdata('userid');
      }
        $sql="select case when is_subj_obj='S' then 'Subjective' else 'Objective' end as examcategory,
              case when isself='Y' then 'Self Practise' else 'Exam' end as examtype,totalqn,totalmark,obtainedmark,examdate,
              s.subject_name,c.chaptername,totaltimer,submitted_time,l.name as levelname,isself
              from studentexamset ses 
               left join subject s on ses.subjectid=s.subject_id
               left join chapter c on ses.chapterid=c.chapterid
               join level l on l.level_id=ses.levelid
               where ses.is_active=1 and ses.studentid=? ".$where." order by examdate desc,createddate desc";
        $res=$this->db->query($sql,array($userid));
        //var_dump($this->db->last_query());exit;
        if($res->num_rows()>0)
        return $res->result();
        else
        return array();
    }
}
