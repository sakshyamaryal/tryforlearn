<?php

class Exercise_model extends CI_Model
{

    function getexercise($where)
    {
        unset($where['is_active']);
        $where['e.is_active']=1;
         $this->db->select('e.*');
         $this->db->from('exercise e');
         $this->db->join('users u','u.user_id=e.created_by','left');
         $this->db->where($where);
         $res=$this->db->get();
       //  var_Dump($this->db->last_query());exit;
         return $res->result();
    }
    function getqnbyid($id)
    {
        $sql="select * from exercise where eid=?";
       $res= $this->db->query($sql,array($id))->row();
        $sql1="select * from exercise_option where eid=? order by optionid";
        $res1=$this->db->query($sql1,array($id))->result();
        $i=0;
        foreach($res1 as $row)
        {
            $i++;
            $name='option'.$i;
            $nepname='option'.$i.'_nep';

            $res->$name=$row->optionname;
            $res->$nepname=$row->optionname_nep;
        }
        return $res;
    }
    function copyquestion()
    {
       $post=$_POST;
       $ques=implode(',',$post['qid']);
       $sql="select * from exercise where eid in (".$ques.")";
       $res=$this->db->query($sql)->result();
       $this->db->trans_begin();

       foreach($res as $val)
       {
         $insert=array(
             'levelid'=>$val->levelid,
             'classid'=>$val->classid,
             'subjectid'=>$val->subjectid,
             'chapterid'=>$val->chapterid,
             'groupid'=>$val->groupid,
             'examtypeid'=>$post['etype'],
             'is_subj_obj'=>$val->is_subj_obj,
             'question'=>$val->question,
             'explanation'=>$val->explanation,
             'correctoption'=>$val->correctoption,
             'correctoptionid'=>$val->correctoptionid,
             'question_nep'=>$val->question_nep,
             'explanation_nep'=>$val->explanation_nep,
             'correctoption_nep'=>$val->correctoption_nep,
             'correctoptionid_nep'=>$val->correctoptionid_nep,
             'is_timer'=>$val->is_timer,
             'timing'=>$val->timing,
             'is_common'=>'N',
             'questiondate'=>$post['qdate'],
             'is_active'=>1,
             'created_at'=>date('Y-m-d H:i:s'),
			 'created_by'=>$this->session->userdata('adminuserid')

         );
         $this->db->insert('exercise',$insert);
          $eid=$this->db->insert_id();
          if($val->is_subj_obj='N')
          {
              $anssql="select * from exercise_option where eid=?";
              $res_Ans=$this->db->query($anssql,array($val->eid))->result();
              foreach($res_Ans as $key)
              {
                  $option=array(
                      'eid'=>$eid,
                      'optionname'=>$key->optionname,
                      'optionname_nep'=>$key->optionname_nep,
                      'is_active'=>1

                  );
                  $this->db->insert('exercise_option',$option);
                  $ansid=$this->db->insert_id();
                  if($key->optionid==$val->correctoptionid)
                  {
                      $this->db->where('eid',$eid);
                      $this->db->update('exercise',array('correctoptionid'=>$ansid));
                  }
                  if($key->optionid==$val->correctoptionid_nep)
                  {
                      $this->db->where('eid',$eid);
                      $this->db->update('exercise',array('correctoptionid_nep'=>$ansid));
                  }
              }
          }
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

    function replicatequestion()
    {
       $post=$_POST;
       $ques=implode(',',$post['qid']);
       $sql="select * from exercise where eid in (".$ques.")";
       $res=$this->db->query($sql)->result();
       $this->db->trans_begin();

       foreach($res as $val)
       {
         $insert=array(
             'levelid'=>$post['levelid'],
             'classid'=>(isset($post['classid']) && $post['classid']>0)?$post['classid']:0,
             'subjectid'=>(isset($post['subjectid']) && $post['subjectid']>0)?$post['subjectid']:0,
             'chapterid'=>(isset($post['chapterid']) && $post['chapterid']>0)?$post['chapterid']:-1,
             'topicid'=>(isset($post['topicid']) && $post['topicid']>0)?$post['topicid']:0,
             'groupid'=>$post['groupid'],
             'examtypeid'=>(isset($post['examtype']) && $post['examtype']>0)?$post['examtype']:0,
             'is_subj_obj'=>$val->is_subj_obj,
             'question'=>$val->question,
             'explanation'=>$val->explanation,
             'correctoption'=>$val->correctoption,
             'correctoptionid'=>$val->correctoptionid,
             'question_nep'=>$val->question_nep,
             'explanation_nep'=>$val->explanation_nep,
             'correctoption_nep'=>$val->correctoption_nep,
             'correctoptionid_nep'=>$val->correctoptionid_nep,
             'is_timer'=>$val->is_timer,
             'timing'=>$val->timing,
             'is_common'=>$val->is_common,
             'questiondate'=>$post['replicatedate'],
             'is_active'=>1,
             'created_at'=>date('Y-m-d H:i:s'),
			 'created_by'=>$this->session->userdata('adminuserid')

         );
         $this->db->insert('exercise',$insert);
          $eid=$this->db->insert_id();
          if($val->is_subj_obj='N')
          {
              $anssql="select * from exercise_option where eid=?";
              $res_Ans=$this->db->query($anssql,array($val->eid))->result();
              foreach($res_Ans as $key)
              {
                  $option=array(
                      'eid'=>$eid,
                      'optionname'=>$key->optionname,
                      'optionname_nep'=>$key->optionname_nep,
                      'is_active'=>1

                  );
                  $this->db->insert('exercise_option',$option);
                  $ansid=$this->db->insert_id();
                  if($key->optionid==$val->correctoptionid)
                  {
                      $this->db->where('eid',$eid);
                      $this->db->update('exercise',array('correctoptionid'=>$ansid));
                  }
                  if($key->optionid==$val->correctoptionid_nep)
                  {
                      $this->db->where('eid',$eid);
                      $this->db->update('exercise',array('correctoptionid_nep'=>$ansid));
                  }
              }
          }
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

    function migratequestion()
    {

        $post=$_POST;
        $ques=implode(',',$post['qid']);
        $sql="update  exercise set topicid=?,groupid=? where eid in (".$ques.")";
        $res=$this->db->query($sql,array($post['topicid'],$post['migrategroup']));
        return $res;
    }

    function addindataaset()
    {

        
       $post=$_POST;
       $ques=implode(',',$post['qid']);
       $sql="select * from exercise where eid in (".$ques.")";
       $res=$this->db->query($sql)->result();
       $this->db->trans_begin();

       $main=[];
       foreach($res as $val)
       {

        if(empty($main))
        {

            $main=array(
                'classid'=>$val->classid,
                'subjectid'=>$val->subjectid,
                'setid'=>$post['dataset'],
                'isactive'=>'1',
                'createdat'=>date('Y-m-d H:i:s'),
                'createdby'=>$this->session->userdata('adminuserid')
            );

            $this->db->insert('dataset',$main);
            $dsid=$this->db->insert_id();

        }
     
         $insert[]=array(
          
            'setid'=>$post['dataset'],
            'dsid'=>$dsid,
            'eid'=>$val->eid,
             'isactive'=>1,
          

         );
          
       }
       $this->db->insert_batch('dataset_exercise',$insert);

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