<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Studentpanel_model extends CI_Model {

   

    function get_unlock_course()
    {
        $this->db->select('*');
        $this->db->from('level');
        $this->db->where('is_payable',0);

        $this->db->where('is_active','1');
        $query=$this->db->get();
        return $query->result_array();
    }

    function get_subscription_course()
    {
        $sql='SELECT c.uni_program_id FROM `student_enroll` se left join subject s on s.subject_id=se.subject_id left join class_subject sc on s.subject_id=sc.subject_id left join class c on sc.class_id=c.class_id WHERE se.`userid` = ? AND ? between se.start_date and se.end_date and se.current_status=1 and se.is_active=1 group by c.uni_program_id';
        $query=$this->db->query($sql,array($this->session->userdata('userid'),date('Y-m-d')));
        
         return $res=$query->result_array();
    }

    function checksubscription()
    {
        $sql="select  id from student_enroll where userid=? and  end_date < ? and current_status=1 ";
        $query=$this->db->query($sql,array($this->session->userdata('userid'),date('Y-m-d')));
        if($query->num_rows()>0)
        {
            $data=$query->result();
           
            $this->db->trans_begin();
            foreach($data as $val)
            {
                $this->db->where('id',$val->id);
                $this->db->update('student_enroll',array('current_status'=>0));
               

            }
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
        return 0;
    }

    function getsubscription()
    {
      $where='';
      if((int)@$_POST['classid']>0)
      {
        $where=" and se.classid=".@$_POST['classid'];
      }
        $sql="select distinct se.subjectid,se.classid, l.name as levelname,c.name as classname,s.subject_name  from student_enroll se
        join level l on l.level_id=se.levelid
        join class c on c.classid=se.classid
        join subject s on s.subject_id=se.subjectid

         where userid=? and   se.end_date >= ? and current_status=1  ".$where;
        
        $query=$this->db->query($sql,array($this->session->userdata('userid'),date('Y-m-d')));
        if($query->num_rows()>0)
        {
            $data=$query->result();
            foreach($data as $key =>$val)
                {
                    $ch_sql="select count(chapterid)as total from chapter where classid=? and subjectid=? and is_active=1";
                    $res_ch=$this->db->query($ch_sql,array($val->classid,$val->subjectid))->row();
                    $data[$key]->totalchapter=((int)@$res_ch->total<1)?0:@$res_ch->total;
                    $t_sql="select count(t.topicid)as total  from topic t join chapter c on t.chapterid=c.chapterid 
                    where t.classid=? and t.subjectid=? and t.is_active=1 and c.is_active=1";
                    $res_t=$this->db->query($t_sql,array($val->classid,$val->subjectid))->row();
                    $data[$key]->totaltopic=((int)@$res_t->total<1)?0:@$res_t->total;
                }
           return $data;
        }
        return array();
    }
    function getfreecourse()
    {
      $sql="select   l.name as levelname,l.level_id  from level l
       where is_active=1 and is_payable=0 ";
        
        $query=$this->db->query($sql);
        if($query->num_rows()>0)
        {
            $data=$query->result();
            foreach($data as $key =>$val)
                {
                    $ch_sql="select count(chapterid)as total from chapter where levelid=? and is_active=1";
                    $res_ch=$this->db->query($ch_sql,array($val->level_id))->row();
                    $data[$key]->totalchapter=((int)@$res_ch->total<1)?0:@$res_ch->total;
                  
                }
           return $data;
        }
        return array();
    }
    function getchapter($classid,$subid)
    {
      $sql="select c.chapterid,chaptername,case when e.status is null then false else true end as status from chapter c
    
      left  join (select distinct chapterid,'t' as status from 
         exercise e where classid=? and subjectid=?)as e on e.chapterid=c.chapterid
  
  where c.classid=? and c.subjectid=? and is_active=1 order by priority";
      $res=$this->db->query($sql,array($classid,$subid,$classid,$subid))->result();
      foreach($res as $key =>$val)
      {
         
          $t_sql="select count(topicid)as total from topic where classid=? and subjectid=? and chapterid=? and is_active=1";
          $res_t=$this->db->query($t_sql,array($classid,$subid,$val->chapterid))->row();
          $res[$key]->totaltopic=((int)@$res_t->total<1)?0:@$res_t->total;
      }
      return $res;
    }
    function getfreechapter($levelid)
    {
      $sql="select c.chapterid,chaptername,case when e.status is null then false else true end as status from chapter c
    
      left  join (select distinct chapterid,'t' as status from 
         exercise e where levelid=?)as e on e.chapterid=c.chapterid
  
  where levelid=? and is_active=1 order by priority";
      $res=$this->db->query($sql,array($levelid,$levelid))->result();
      foreach($res as $key =>$val)
      {
         
          $t_sql="select count(topicid)as total from topic where  chapterid=? and is_active=1";
          $res_t=$this->db->query($t_sql,array($val->chapterid))->row();
          $res[$key]->totaltopic=((int)@$res_t->total<1)?0:@$res_t->total;
      }
      return $res;
    }
    function gettopic($type)
    {
      $where ="";
      if($type=='p')
      {
        $where ="   classid='".$_POST['class']."' and subjectid='".$_POST['subject']."' and ";
      }
      
      $sql="select topicid,topicname from topic 
      
      where ".$where." chapterid=? and is_active=1 order by priority";
     $res=$this->db->query($sql,array($_POST['chapter']))->result();
     return $res;
  
    }
    function getcontent($type)
    {
      $where ="";
      if($type=='p')
      {
        $where ="   classid='".$_POST['class']."' and subjectid='".$_POST['subject']."' and ";
      }
        $sql="select contentid from content where  chapterid=? and topicid=? and is_active=1 order by orderby";
        $res=$this->db->query($sql,array($_POST['chapter'],$_POST['topic']))->result();
       return $res;
    }
    function checksubject_subscription($classid,$subjectid)
    {
        $sql="select * from student_enroll se
       
         where userid=? and  classid=? and subjectid =? and   se.end_date >= ? and current_status=1 ";
         $query=$this->db->query($sql,array($this->session->userdata('userid'),$classid,$subjectid,date('Y-m-d')));
         if($query->num_rows()>0)
         return $query->result();
         else
         return array();

    }
    function getexercise($post)
  {
    $group="SELECT distinct e.groupid,g.groupname,g.perqnmark,g.fullmark from exercise e join questiongroup g on e.groupid=g.groupid where classid=? and subjectid=? and chapterid=? and is_subj_obj='Y' and e.is_active=1 and is_common='Y' order by groupname";
    $res_group=$this->db->query($group,array(((int)@$post['class']>0)?$post['class']:0,((int)@$post['subject']>0)?$post['subject']:0,$post['chapter']))->result();
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
      $sql="select * from exercise where classid=? and subjectid=? and chapterid=? and groupid=? and is_subj_obj='Y' and is_active=1 and is_common='Y' ".$order." limit ".$post['no'];
      $res=$this->db->query($sql,array(((int)@$post['class']>0)?$post['class']:0,((int)@$post['subject']>0)?$post['subject']:0,$post['chapter'],$val->groupid))->result();
      $res_group[$key]->ques=$res;
    }
    return $res_group;

  }
  function submitexerciseanswer($post)
  {
    $eset=array(
      'studentid'=>$this->session->userdata('userid'),
      
      'classid'=>((int)@$post['classid']>0)?$post['classid']:0,
      'subjectid'=>((int)@$post['subjectid']>0)?$post['subjectid']:0,
      'chapterid'=>((int)@$post['chapterid']>0)?$post['chapterid']:0,
      'levelid'=>$post['levelid'],
      'examtypeid'=>((int)@$post['examtypeid']>0)?$post['examtypeid']:0,

      'totalqn'=>count($post['qid']),
      'totalmark'=>$post['totalmark'],
      'examdate'=>date('Y-m-d'),
      'is_subj_obj'=>'S',
      'isself'=>(@$post['isself']=='1')?'Y':'N',
      'submitted_time'=>$post['totaltimer'],
      'totaltimer'=>$post['qntimer'],
      'language'=>$this->session->userdata('language'),
      'createddate'=>date('Y-m-d H:i:s')
    );
    $this->db->trans_begin();
    $this->db->insert('studentexamset',$eset);
    $esetid=$this->db->insert_id();
   
    foreach($post['qid'] as $key => $val)
    {

     

    
    $data[]=array(
      'examsetid'=>$esetid,
      'student_id'=>$this->session->userdata('userid'),
      'classid'=>((int)@$post['classid']>0)?$post['classid']:0,
      'subjectid'=>((int)@$post['subjectid']>0)?$post['subjectid']:0,
      'chapterid'=>((int)@$post['chapterid']>0)?$post['chapterid']:0,
      'levelid'=>$post['levelid'],
      'question_id'=>$post['qid'][$key],
      'submitted_answer'=>$post['answer'][$key],
      'exam_date'=>(@$post['isself']=='1')?date('Y-m-d'):@$post['qndate'],
      'submitted_time'=>$post['totaltimer'],
      'isself'=>$post['isself'],
      'totaltimer'=>$post['qntimer'],
      'is_subj_obj'=>'S',
      'language'=>$this->session->userdata('language')
    );
  }
   
    $this->db->insert_batch('studentexam',$data);
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

  
  function getquiz($post)
  {
    $group="SELECT distinct e.groupid,g.groupname,g.perqnmark,g.fullmark from exercise e join questiongroup g on e.groupid=g.groupid where classid=? and subjectid=? and chapterid=? and is_subj_obj='N' and e.is_active=1 and is_common='Y' order by groupname";
    $res_group=$this->db->query($group,array(((int)@$post['class']>0)?$post['class']:0,((int)@$post['subject']>0)?$post['subject']:0,$post['chapter']))->result();
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
      $sql="select * from exercise where classid=? and subjectid=? and chapterid=? and groupid=? and is_subj_obj='N' and is_active=1 and is_common='Y' ".$order." limit ".$post['no'];
      $res=$this->db->query($sql,array(((int)@$post['class']>0)?$post['class']:0,((int)@$post['subject']>0)?$post['subject']:0,$post['chapter'],$val->groupid))->result();
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

  function submitquizanswer($post)
  {
    $sn=0;
    // total right ans marks sum, qn marks
    $mark=$qnmark=0;

    $peransmark=0;

    // total wrong ans marks sum
    $totalwrongans=0;
    $qnarray=array();
    $ansarray=array();
    $esetid=get_Last_Id('setid','studentexamset');
    $donetime=(float)$post['qntimer']-(float)$post['totaltimer'];

    // total no.of ques
    $total=count($post['qid']);
    // total attempted ques
    $totalattemptedques=0;
   // totalattemptedrightans, totalattmepted wrong ans
     $totalcorrect=$totalwrong=0;
     
    foreach($post['qid'] as $key => $val)
    {
      array_push($qnarray,$val);
        $ansarray[$val]=@$post['answer'.$val][0];
      $sn++;
      $sql="SELECT correctoptionid,correctoptionid_nep,perqnmark FROM exercise e join questiongroup g on e.groupid=g.groupid where eid=?";
      $res=$this->db->query($sql,array($val))->row();
      $qnmark+=(double)$res->perqnmark;
     
                if($this->session->userdata('language')=='ENG')
            {
                $correctid=$res->correctoptionid;
            }
         
            else
            {
              $correctid=$res->correctoptionid_nep;


            }

                    if($correctid==@$post['answer'.$val][0])
                {
                  $mark=(double)($mark+$res->perqnmark);
                  $peransmark=$res->perqnmark;
                  $totalcorrect=$totalcorrect+1;
                }
                else if(@$post['answer'.$val][0]==null)
                {
                  // if($post['levelid']=='1' || $post['levelid']=='2')
                  // {
                  //   $peransmark =(double)0-(0.2*$res->perqnmark);
                  //   $totalwrongans=(double)$totalwrongans+(0.2*$res->perqnmark);
                  // }
                  // else 
                  // {
                  //   $peransmark=0;
                  // }
                  $peransmark=0;
                  $mark=$mark+0;
                }
                else
                {
                  
                //  $peransmark=0;
                  if($post['levelid']=='1' || $post['levelid']=='2')
                  {
                    $peransmark =(double)0-(0.2*$res->perqnmark);
                    $totalwrongans=(double)$totalwrongans+(0.2*$res->perqnmark);
                  }
                  else 
                  {
                    $peransmark=0;
                  }
                  $totalwrong=$totalwrong+1;

                }

                if($post['answer'.$val][0])
                {
                    $totalattemptedques=$totalattemptedques+1;
                }
    
    $data[]=array(
      'examsetid'=>$esetid,
      'student_id'=>$this->session->userdata('userid'),
   
      'classid'=>((int)@$post['classid']>0)?$post['classid']:0,
      'subjectid'=>((int)@$post['subjectid']>0)?$post['subjectid']:0,
      'chapterid'=>((int)@$post['chapterid']>0)?$post['chapterid']:0,
      'levelid'=>$post['levelid'],
      'question_id'=>$val,
      'submitted_answer'=>(@$post['answer'.$val][0]!='')?$post['answer'.$val][0]:0,
      'obtained_marks'=>$peransmark,
      'exam_date'=>(@$post['isself']=='1')?date('Y-m-d'):@$post['qndate'],
      'submitted_time'=>$post['totaltimer'],
      'isself'=>$post['isself'],
      'totaltimer'=>$post['qntimer'],
      'language'=>$this->session->userdata('language'),
      'is_subj_obj'=>'O'
    );
  }
  
  // total rightmarks, total wrong marks;
  $right=$mark;  $wrong=$totalwrongans;

   if(($mark-$totalwrongans)<0)
    {
      $mark=0;
    }
    else
    {
      $mark=$mark-$totalwrongans;
    }
      $eset=array(
        'setid'=>$esetid,
        'studentid'=>$this->session->userdata('userid'),
        'classid'=>((int)@$post['classid']>0)?$post['classid']:0,
        'subjectid'=>((int)@$post['subjectid']>0)?$post['subjectid']:0,
        'chapterid'=>((int)@$post['chapterid']>0)?$post['chapterid']:0,
        'levelid'=>$post['levelid'],
        'examtypeid'=>((int)@$post['examtypeid']>0)?$post['examtypeid']:0,
        'totalqn'=>count($post['qid']),
        'totalmark'=>$qnmark,
        'obtainedmark'=>$mark,
        'examdate'=>(@$post['isself']=='1')?date('Y-m-d'):@$post['qndate'],
        'is_subj_obj'=>'O',
        'isself'=>(@$post['isself']=='1')?'Y':'N',
        'totaltimer'=>$post['qntimer'],
        'submitted_time'=>$post['totaltimer'],
        'language'=>$this->session->userdata('language'),
        'createddate'=>date('Y-m-d H:i:s')
      );
      $this->db->trans_begin();
      $this->db->insert('studentexamset',$eset);
      
    $percent=($mark/$qnmark)*100;
    $this->db->insert_batch('studentexam',$data);
    if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
				$iu=0;
		}
		else
		{
				$this->db->trans_commit();
			$iu=array('qn'=>$qnarray,'ans'=>$ansarray,'totalmarks'=>$qnmark,'marks'=>$mark,'percent'=>$percent,
        //this is for popup instant result show
        'unattemptedques'=>$total-$totalattemptedques,
        'attemptedques'=>$totalattemptedques,
        'totalques'=>$total,
        'totalright'=>$totalcorrect,
        'totalwrong'=>$totalwrong,
        'correct'=>$right,
        'wrong'=>$wrong,
        'total'=>$right-$wrong,
        'time'=>$donetime);
    }
    return $iu;

  }

  function getattemptquiz($post)
  {
    $qn=implode(",", $post['qn']);
    $group="SELECT distinct e.groupid,g.groupname,g.perqnmark,g.fullmark from exercise e 
    join questiongroup g on e.groupid=g.groupid where eid in (".$qn.")";
    $res_group=$this->db->query($group)->result();
    foreach($res_group as $key => $val)
    {
      $sql="select * from exercise where  groupid=? and eid in (".$qn.")";
      $res=$this->db->query($sql,array($val->groupid))->result();
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
  function getexplanation()
  {
   $qry=  $this->db->select('explanation,explanation_nep')->from('exercise')->where('eid',$_POST['qid'])->get()->row();
   return $qry;
  }
    
}