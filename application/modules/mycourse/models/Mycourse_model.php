<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mycourse_model extends CI_Model {

   
function get_chapter($id)
{
    $this->db->select('*');
    $this->db->from('subject');
    $this->db->where('level_id',$id);
    $res=$this->db->get()->result_array();
    $data=array();
    foreach($res as $result)
    {
        $this->db->select('*');
        $this->db->from('topic');
        $this->db->where('subject_id',$result['subject_id']);
                $this->db->where('chapter_id',0);

        $res1=$this->db->get()->result_array();
        
            $data[] = array
            ("chapter" => $result,
                
              
                  "topic" => $res1);
        
    }
    return $data;

}
function get_class($subscribed)
{
    
    // $this->db->select('*');
    // $this->db->from('class');
    // $this->db->where('uni_program_id',$subscribed);
    // $res=$this->db->get()->result_array();
    if($subscribed==null)
    {
        $where=" and  uni_program_id is null";
    }
    else
    {
        $where=" and  uni_program_id ='".$subscribed."'";


    }

    $sql='SELECT c.uni_program_id,c.class_id,c.class_name FROM `student_enroll` se left join subject s on s.subject_id=se.subject_id left join class_subject sc on s.subject_id=sc.subject_id left join class c on sc.class_id=c.class_id WHERE se.`userid` = ? AND ? between se.start_date and se.end_date '.$where.' and se.current_status=1 and se.is_active=1 group by c.class_id order by class_name';
    $query=$this->db->query($sql,array($this->session->userdata('userid'),date('Y-m-d')));
    $res=$query->result_array();
    $data=array();
    foreach($res as $result)
    {
        // $this->db->select('subject.subject_id,subject.subject_name');
        // $this->db->from('class_subject');
        // $this->db->join('subject','class_subject.subject_id=subject.subject_id','left');
        // $this->db->where('class_id',$result['class_id']);
        //$res1=$this->db->get()->result_array();
        $sql1='SELECT s.subject_id,s.subject_name,sc.class_sub_id FROM `student_enroll` se left join subject s on s.subject_id=se.subject_id left join class_subject sc on s.subject_id=sc.subject_id  WHERE se.`userid` = ? AND ? between se.start_date and se.end_date and sc.class_id =? and se.current_status=1 and se.is_active=1 group by s.subject_id';
        $query1=$this->db->query($sql1,array($this->session->userdata('userid'),date('Y-m-d'),$result['class_id']));
        $res1=$query1->result_array();
       

        
            $data[] = array
            ("class" => $result,
                
              
                  "subject" => $res1);
        
    }
    return $data;

}

function get_Uni()
{
    // $this->db->select('*');
    // $this->db->from('university');
    // $this->db->where('is_active','1');
    // $res=$this->db->get()->result_array();

    $sql='SELECT u.university_id,u.name FROM `student_enroll` se left join subject s on s.subject_id=se.subject_id left join class_subject sc on s.subject_id=sc.subject_id left join class c on sc.class_id=c.class_id left join uni_program up on up.univ_program_id=c.uni_program_id left join university u on u.university_id=up.university_id WHERE se.`userid` = ? AND ? between se.start_date and se.end_date and se.current_status=1 and se.is_active=1 and c.uni_program_id is not null and u.university_id is not null group by u.university_id';
    $query=$this->db->query($sql,array($this->session->userdata('userid'),date('Y-m-d')));
    $res=$query->result_array();

    
    $data=array();
    foreach($res as $result)
    {
        // $this->db->select('*');
        // $this->db->from('uni_program');
        // $this->db->where('university_id',$result['university_id']);
        // $res1=$this->db->get()->result_array();
        $sql1='SELECT up.univ_program_id,up.program_name FROM `student_enroll` se left join subject s on s.subject_id=se.subject_id left join class_subject sc on s.subject_id=sc.subject_id left join class c on sc.class_id=c.class_id left join uni_program up on up.univ_program_id=c.uni_program_id WHERE se.`userid` = ? AND ? between se.start_date and se.end_date and se.current_status=1 and se.is_active=1 and up.university_id =? and c.uni_program_id is not null';
        $query1=$this->db->query($sql1,array($this->session->userdata('userid'),date('Y-m-d'),$result['university_id']));
        $res1=$query1->result_array();

      
            $data[] = array
            ("uni" => $result,
                
              
                  "program" => $res1);
        
    }
    return $data;
    
}

    function get_subscription_course()
    {
        $sql='SELECT c.uni_program_id FROM `student_enroll` se left join subject s on s.subject_id=se.subject_id left join class_subject sc on s.subject_id=sc.subject_id left join class c on sc.class_id=c.class_id WHERE se.`userid` = ? AND ? between se.start_date and se.end_date and se.current_status=1 and se.is_active=1 group by c.uni_program_id';
        $query=$this->db->query($sql,array($this->session->userdata('userid'),date('Y-m-d')));
        
         return $res=$query->result_array();
    }

    function get_file()
    {
    $this->db->select('*');
    $this->db->from('file');
    $this->db->where('topic_id',$this->input->post('topic_id'));
    $this->db->where('is_video',0);
    //$this->db->where('link_video is null or link_video =""');
    $res=$this->db->get()->result_array();
    return $res;
    }

    function get_topic($id)
    {
        $this->db->select('*');
        $this->db->from('chapter');
        $this->db->where('class_sub_id',$id);
        $res=$this->db->get()->result_array();
        $data=array();
        foreach($res as $result)
        {
            $this->db->select('*');
            $this->db->from('topic');
            $this->db->where('chapter_id',$result['chapter_id']);
            $res1=$this->db->get()->result_array();
            
                $data[] = array
                ("chapter" => $result,
                    
                  
                      "topic" => $res1);
            
        }
        return $data;
    }
    function get_subject($id)
    {
        $sql='SELECT c.uni_program_id,c.class_id,c.class_name FROM `student_enroll` se left join subject s on s.subject_id=se.subject_id left join class_subject sc on s.subject_id=sc.subject_id left join class c on sc.class_id=c.class_id WHERE se.`userid` = ? AND ? between se.start_date and se.end_date and  uni_program_id= ? and se.current_status=1 and se.is_active=1';
    $query=$this->db->query($sql,array($this->session->userdata('userid'),date('Y-m-d'),$id));
    $res=$query->result_array();
    $data=array();
    foreach($res as $result)
    {
      
        $sql1='SELECT s.subject_id,s.subject_name,sc.class_sub_id FROM `student_enroll` se left join subject s on s.subject_id=se.subject_id left join class_subject sc on s.subject_id=sc.subject_id  WHERE se.`userid` = ? AND ? between se.start_date and se.end_date and sc.class_id =? and se.current_status=1 and se.is_active=1';
        $query1=$this->db->query($sql1,array($this->session->userdata('userid'),date('Y-m-d'),$result['class_id']));
        $res1=$query1->result_array();
       

        
            $data[] = array
            ("class" => $result,
                
              
                  "subject" => $res1);
        
    }
    return $data;

    }

    function get_video($id)
    {
        $sql="SELECT * FROM `file` LEFT JOIN `student_video` 
        ON `student_video`.`videofile_id`=`file`.`file_id` WHERE 
        `topic_id` = ? AND (`is_video` = 1 and (`link_video` IS null or link_video='')) AND (`is_llocked` =0 or `is_llocked`is null) 
        ";
        $res=$this->db->query($sql,array($id))->result_array();
    // $this->db->select('*');
    // $this->db->from('file');
    // $this->db->join('student_video','student_video.videofile_id=file.file_id','left');
    // $this->db->where('topic_id',$id);
    // $this->db->where('is_video',1);
    // $this->db->where('is_llocked = 0 or is_llocked = "" ');
    // $this->db->where('link_video',null);

    // $res=$this->db->get()->result_array();
    //var_dump($this->db->last_query());exit();
    return $res;
    }
    function get_other_link_video($id)
    {
    $this->db->select('*');
    $this->db->from('file');
    $this->db->where('topic_id',$id);
    $this->db->where('is_video',1);
    $this->db->where('link_video !=""');
    $res=$this->db->get()->result_array();
    return $res;
    }

    function insert_count($id)
    {
        $st_id=$this->session->userdata('userid');
        $this->db->select('perhitcount');
        $this->db->from('student_video');
        $this->db->where('student_id',$st_id);
        $this->db->where('videofile_id',$id);
        $res=$this->db->get()->row_array();
        $count=0;
        if($res['perhitcount']>0)
        {
            $count=$res['perhitcount'];
       
            if($count>='5')
            {
                $this->db->where('student_id',$st_id);
                $this->db->where('videofile_id',$id);
                $this->db->update('student_video',array('is_llocked'=>1));
                return $count;
            }
           
            
            $count=$count + 1;
            $data=array
            (
                
                'perhitcount'=>$count,
                
            );
            $this->db->where('student_id',$st_id);
            $this->db->where('videofile_id',$id);
            $this->db->update('student_video',$data);
            return $count;
        }
        else
        {
            $count=1;
            $data=array
            (
                'student_id'=>$st_id,
                'videofile_id'=>$id,
                'start_date'=>date('Y-m-d'),
                'end_date'=>date('Y/m/d', strtotime('+7 days', strtotime(date('Y-m-d')))),
                'perhitcount'=>$count,
                'is_llocked'=>0
            );
            $this->db->insert('student_video',$data);
                return $count;
        }
     return true;
    }
    function get_content()
    {
    $this->db->select('*');
    $this->db->from('content');
    $this->db->where('topic_id',$this->input->post('topic_id'));
    $this->db->where('is_active',1);
    $res=$this->db->get()->result_array();
    return $res;
    }

    function gettopic_content($id)
    {
        $this->db->select('*');
    $this->db->from('content');
    $this->db->where('content_id',$id);
    $res=$this->db->get()->row();
    return $res;
    }
    
}