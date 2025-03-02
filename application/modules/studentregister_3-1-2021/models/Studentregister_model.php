<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Studentregister_model extends CI_Model {
    
   function register_student()
   {
       $data=array
       (
           'fullname'=>$this->input->post('name'),
           'address'=>$this->input->post('address'),
           'phone'=>$this->input->post('phone'),
           'email'=>$this->input->post('email'),
           'preffered_language'=>$this->input->post('langauge'),
           'username'=>$this->input->post('username'),
           'password'=>md5($this->input->post('password')),
           'user_type'=>3,
           'is_active'=>1,
           'is_approved'=>0,
           'is_login'=>0


       );
       if($this->db->insert('users',$data))
       {
           $insertid=$this->db->insert_id();
           $data1=array('userid'=>$insertid);
           $this->db->insert('user_information',$data1);
           return $insertid;
       }
       else
       {
           return false;
       }
   }

   function submit_data()
   {
    $data=array
    (
        'userid'=>$this->input->post('student_id'),
        'parents_detail'=>$this->input->post('pd'),
        'parents_number'=>$this->input->post('pn'),
        'guardian_detail'=>$this->input->post('gd'),
        'guardian_number'=>$this->input->post('gn'),
        'extra'=>$this->input->post('extra'),
        
      

    );
    $this->db->where('userid',$this->input->post('student_id'));
    if($this->db->update('user_information',$data))
    {
        $this->session->set_userdata('stid',"");
        return true;
    }
    else
    {
        return false;
    }
   }

   function get_program_UNI()
   {
       $this->db->select('*');
       $this->db->from('university');
     
       $this->db->where('is_active','1');
       $res= $this->db->get();
       return $res->result_array();
   }
   function get_program_SCH()
   {
    $this->db->select('*');
    $this->db->from('class');
    $this->db->where('uni_program_id',null);

    $this->db->where('is_active','1');
    $res= $this->db->get();
    return $res->result_array();

   }

   function get_program_REA()
   {
    $this->db->select('*');
    $this->db->from('class');

    $this->db->where('uni_program_id','-1');
    $this->db->where('is_active','1');
    $res= $this->db->get();
    return $res->result_array();

   }
    function get_sprogram_UNI($id)
    {
        $this->db->select('*');
        $this->db->from('uni_program');
        $this->db->where('university_id',$id);
    
        $this->db->where('is_active','1');
        $res= $this->db->get();
        return $res->result_array();

    }
    function get_sprogram_SCH($id)
    {

     $this->db->select('subject.subject_id,subject.subject_name,subject.monthly_price,subject.yearly_price');
     $this->db->from('class_subject');
     $this->db->join('subject','subject.subject_id=class_subject.subject_id','left');
     $this->db->where('class_id',$id);
 
     $this->db->where('subject.is_active','1');
     $res= $this->db->get();
     return $res->result_array();
 
    }
    function get_sprogram_REA($id)
    {

     $this->db->select('subject.subject_id,subject.subject_name,subject.monthly_price,subject.yearly_price');
     $this->db->from('class_subject');
     $this->db->join('subject','subject.subject_id=class_subject.subject_id','left');
     $this->db->where('class_id',$id);
 
     $this->db->where('subject.is_active','1');
     $res= $this->db->get();
     return $res->result_array();
 
    }

    function get_SCIDprogram_UNI($id)
    {
        $this->db->select('*');
        $this->db->from('class');
    
        $this->db->where('uni_program_id',$id);
        $this->db->where('is_active','1');
        $res= $this->db->get();
        return $res->result_array();
    
    }
    
    function get_unisubprogram_UNI($id)
    {
        $this->db->select('subject.subject_id,subject.subject_name,subject.monthly_price,subject.yearly_price');
        $this->db->from('class_subject');
        $this->db->join('subject','subject.subject_id=class_subject.subject_id','left');
        $this->db->where('class_id',$id);
    
        $this->db->where('subject.is_active','1');
        $res= $this->db->get();
        return $res->result_array();
    
    }

    function student_enroll($st_id,$subject_id)
    {
        $data=array
        (
            'userid'=>$st_id,
            'subject_id'=>$subject_id,
            'start_date'=>date('Y-m-d'),
            // 'end_date'=>date('Y-m-d', strtotime('+1 month')),
            'end_date'=>date('Y-m-d', strtotime('+3 days')),

            'current_status'=>'0',
            'is_active'=>'1'

        );

        $this->db->insert('student_enroll',$data);
        $id= $this->db->insert_id();
        $data1=array
        (
            'student_id'=>$st_id,
            'student_enroll_id'=>$id,
            'subject_id'=>$subject_id,
            'fee_month'=>date('m'),
            'pay_amount'=>$this->get_amt($subject_id),
            'pay_date'=>date('Y-m-d'),

        );
        $this->db->insert('student_fee',$data1);
        return true;

    }
    function get_amt($id)
    {
        $this->db->select('monthly_price');
        $this->db->from('subject');
        $this->db->where('subject_id',$id);
        $res=$this->db->get();
        return $res->row()->monthly_price;

    }

    function verifyemail($email)
    {
     $data=array
     (
         'is_approved'=>1,
         'is_emailverified'=>1,
       
       
     );
     $this->db->where('email',$email);
     if($this->db->update('users',$data))
     {
         return true;
     }
     else
     {
         return false;
     }
    }
}