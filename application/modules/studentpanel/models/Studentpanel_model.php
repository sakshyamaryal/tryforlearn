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
      if(isset($_POST['isapi']))
      {
        $userid=$this->input->get_request_header('Userid', True);
      }
      else
      {
        $userid=$this->session->userdata('userid');
      }
        $sql="select  id from student_enroll where userid=? and  end_date < ? and current_status=1 ";
        $query=$this->db->query($sql,array($userid,date('Y-m-d')));
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
      if(isset($_POST['isapi']))
      {
        $userid=$this->input->get_request_header('Userid', True);
      }
      else
      {
        $userid=$this->session->userdata('userid');
      }
        $sql="select distinct se.subjectid,se.classid, l.name as levelname,c.name as classname,s.subject_name  from student_enroll se
        join level l on l.level_id=se.levelid
        join class c on c.classid=se.classid
        join subject s on s.subject_id=se.subjectid

         where userid=? and   se.end_date >= ? and current_status=1  ".$where;
        
        $query=$this->db->query($sql,array($userid,date('Y-m-d')));
        //var_dump($this->db->last_query());exit;
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
        $sql="select contentid from content where type='default' and  chapterid=? and topicid=? and is_active=1 order by orderby";
        $res=$this->db->query($sql,array($_POST['chapter'],$_POST['topic']))->result();
       return $res;
    }
    function checksubject_subscription($classid,$subjectid)
    {
      if(isset($_POST['isapi']))
      {
        $userid=$this->input->get_request_header('Userid', True);
      }
      else
      {
        $userid=$this->session->userdata('userid');
      }
        $sql="select * from student_enroll se
       
         where userid=? and  classid=? and subjectid =? and   se.end_date >= ? and current_status=1 ";
         $query=$this->db->query($sql,array($userid,$classid,$subjectid,date('Y-m-d')));
         if($query->num_rows()>0)
         return $query->result();
         else
         return array();

    }
    function getexercise($post)
  {
    // $group="SELECT distinct e.groupid,g.groupname,g.perqnmark,g.fullmark from exercise e join questiongroup g on e.groupid=g.groupid where classid=? and subjectid=? and chapterid=? and is_subj_obj='Y' and e.is_active=1 and is_common='Y' order by groupname";
    // $res_group=$this->db->query($group,array(((int)@$post['class']>0)?$post['class']:0,((int)@$post['subject']>0)?$post['subject']:0,$post['chapter']))->result();
     $ques=[];

    // foreach($res_group as $key => $val)
    // {
    //   if((int)$val->groupid <='4')
    //   {
    //     $order=" order by rand()";

    //   }
    //   else 
    //   {
    //     $order='';
    //   }
    $order=" order by rand()";
      // $sql="select * from exercise where classid=? and subjectid=? and chapterid=? and groupid=? and is_subj_obj='Y' and is_active=1 and is_common='Y' ".$order." limit ".$post['no'];
      // $res=$this->db->query($sql,array(((int)@$post['class']>0)?$post['class']:0,((int)@$post['subject']>0)?$post['subject']:0,$post['chapter'],$val->groupid))->result();
      $sql="select * from exercise where classid=? and subjectid=? and chapterid=? and is_subj_obj='Y' and is_active=1 and is_common='Y' ".$order." limit ".$post['no'];
      $res=$this->db->query($sql,array(((int)@$post['class']>0)?$post['class']:0,((int)@$post['subject']>0)?$post['subject']:0,$post['chapter']))->result();
      
      $res_group[$key]->ques=$res;
      if(isset($_POST['isapi']))
      {
         foreach($res as $row)
         {
           $ques[$row->eid]=$row;
         }
      }
    //}
    // if(isset($_POST['isapi']))
    // return array_values($ques);
    // else
    // return $res_group;
    return array_values($ques);

  }
  function submitexerciseanswer($post)
  {
    $donetime=(float)$post['qntimer']-(float)$post['totaltimer'];
    if(isset($_POST['isapi']))
      {
        $userid=$this->input->get_request_header('Userid', True);
        $lang=$_POST['language'];
      }
      else
      {
        $userid=$this->session->userdata('userid');
        $lang=$this->session->userdata('language');
      }

    $eset=array(
      'studentid'=>$userid,
      
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
      'submitted_time'=>$donetime,
      'totaltimer'=>$post['qntimer'],
      'language'=>$lang,
      'createddate'=>date('Y-m-d H:i:s')
    );
    $this->db->trans_begin();
    $this->db->insert('studentexamset',$eset);
    $esetid=$this->db->insert_id();
   
    foreach($post['qid'] as $key => $val)
    {

     

    
    $data[]=array(
      'examsetid'=>$esetid,
      'student_id'=>$userid,
      'classid'=>((int)@$post['classid']>0)?$post['classid']:0,
      'subjectid'=>((int)@$post['subjectid']>0)?$post['subjectid']:0,
      'chapterid'=>((int)@$post['chapterid']>0)?$post['chapterid']:0,
      'levelid'=>$post['levelid'],
      'question_id'=>$post['qid'][$key],
      'submitted_answer'=>$post['answer'][$key],
      'exam_date'=>(@$post['isself']=='1')?date('Y-m-d'):@$post['qndate'],
      'submitted_time'=>$donetime,
      'isself'=>$post['isself'],
      'totaltimer'=>$post['qntimer'],
      'is_subj_obj'=>'S',
      'language'=>$lang
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

    $where='';
    if(isset($post['topicid']) && $post['topicid'] > 0)
    {
      $where .=" and topicid='".$post['topicid']."'";
    }
    if(isset($post['chapter']) && $post['chapter'] > 0)
    {
      $where .=" and chapterid='".$post['chapter']."'";
    }
    if(isset($post['eids']))
    {
      $where .=" and eid in (".$post['eids'].")";
    }
    // $group="SELECT distinct e.groupid,g.groupname,g.perqnmark,g.fullmark from exercise e join questiongroup g on e.groupid=g.groupid where classid=? and subjectid=?  and is_subj_obj='N' and e.is_active=1 and is_common='Y' $where order by groupname";
    // $res_group=$this->db->query($group,array(((int)@$post['class']>0)?$post['class']:0,((int)@$post['subject']>0)?$post['subject']:0))->result();
     $ques=[];
    // foreach($res_group as $key => $val)
    // {
    //   if((int)$val->groupid <='4')
    //   {
    //     $order=" order by rand()";

    //   }
    //   else 
    //   {
    //     $order='';
    //   } 
    $order=" order by rand()";
      
      // $sql="select * from exercise where classid=? and subjectid=? and groupid=? and is_subj_obj='N' and is_active=1 and is_common='Y' $where ".$order." limit ".$post['no'];
      // $res=$this->db->query($sql,array(((int)@$post['class']>0)?$post['class']:0,((int)@$post['subject']>0)?$post['subject']:0,$val->groupid))->result();
      $sql="select * from exercise where classid=? and subjectid=? and is_subj_obj='N' and is_active=1 and is_common='Y' $where ".$order." limit ".$post['no'];
      $res=$this->db->query($sql,array(((int)@$post['class']>0)?$post['class']:0,((int)@$post['subject']>0)?$post['subject']:0))->result();
     
      // // var_dump($this->db->last_query());
      foreach($res as $li =>$row)
       {
         $ans="select optionid,optionname,optionname_nep from exercise_option where eid=? and is_active=1 order by rand()";
         $ans_res=$this->db->query($ans,array($row->eid))->result();
         $res[$li]->ans=$ans_res;
         $res[$li]->groupname=$val->groupname;
         $ques[$row->eid]=$row;

       }
    //   $res_group[$key]->ques=$res;
    // }
    // if(isset($_POST['isapi']))
    // return array_values($ques);
    // else
    // return $res_group;
        return array_values($ques);


  }

  function submitquizanswer($post)
  {
    $sn=0;
    if(isset($_POST['isapi']))
    {
      $userid=$this->input->get_request_header('Userid', True);
      $lang=$_POST['language'];
    }
    else
    {
      $userid=$this->session->userdata('userid');
      $lang=$this->session->userdata('language');
    }

    // get wrong percentage as per subject 
    $penalty='0.2';
    if($post['subjectid'] > 0)
    {
      $sql="select penalty from subject where subject_id=?";
      $res=$this->db->query($sql,array($post['subjectid']))->row();

      if((int)$res->penalty > 0)
      {
        $penalty=$res->penalty;

      }


    }
   
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

      
                if($lang=='ENG')
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
                    $peransmark =(double)0-($penalty*$res->perqnmark);
                    $totalwrongans=(double)$totalwrongans+($penalty*$res->perqnmark);
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
      'student_id'=>$userid,
   
      'classid'=>((int)@$post['classid']>0)?$post['classid']:0,
      'subjectid'=>((int)@$post['subjectid']>0)?$post['subjectid']:0,
      'chapterid'=>((int)@$post['chapterid']>0)?$post['chapterid']:0,
      'levelid'=>$post['levelid'],
      'question_id'=>$val,
      'submitted_answer'=>(@$post['answer'.$val][0]!='')?$post['answer'.$val][0]:0,
      'obtained_marks'=>$peransmark,
      'exam_date'=>(@$post['isself']=='1')?date('Y-m-d'):@$post['qndate'],
      'submitted_time'=>$donetime,
      'isself'=>$post['isself'],
      'totaltimer'=>$post['qntimer'],
      'language'=>$lang,
      'is_subj_obj'=>'O'
    );
  }

  //var_dump($data);exit;
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
        'studentid'=>$userid,
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
        'submitted_time'=>$donetime,
        'language'=>$lang,
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
        $iu=array('qn'=>$qnarray,'ans'=>$ansarray,'totalmarks'=>$qnmark,'marks'=>number_format($mark,2),'percent'=>number_format($percent,2),
        //this is for popup instant result show
        'unattemptedques'=>$total-$totalattemptedques,
        'attemptedques'=>$totalattemptedques,
        'totalques'=>$total,
        'totalright'=>$totalcorrect,
        'totalwrong'=>$totalwrong,
        'correct'=>$right,
        'wrong'=>number_format($wrong,2),
        'total'=>number_format($right-$wrong,2),
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

  function getdatasets()
  {
    // $_POST['classid']=27;
    // $_POST['subjectid']=22;
    $sql="select setname,dm.setid from datasetmain dm join dataset ds on dm.setid=ds.setid 
          where classid=? and subjectid=? and dm.is_active='1' order by dm.setname";
      $res=$this->db->query($sql,array($_POST['classid'],$_POST['subjectid']));
      //echo $this->db->last_query();exit;
      if($res->num_rows() > 0)
      {
        return $res->result();
      }
      else
      {
        return array();
      }
  }

  function getdatasetinfo()
  {
    $qry="SELECT classid,subjectid,GROUP_CONCAT(eid) as eids
     from dataset ds 
     join dataset_exercise de on ds.setid=de.setid
     where ds.setid=? and de.isactive='1'
    ";
    $res=$this->db->query($sql,array($_POST['setid']));
    if($res->num_rows() > 0)
    {
      return $res->row();
    }
    else
    {
      return false;
    }
  }
    
}