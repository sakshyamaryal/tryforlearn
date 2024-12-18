<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Studentregister extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('studentregister_model');
        $this->model=$this->studentregister_model;
    }
    function index($type='normal') {
        if(!empty($this->session->userdata('userid')))
            {
                    redirect(base_url());
            }else{

                $data=array(
                    'title'=>'Try for Learn Pvt. Ltd.',
                    'mode'=>'frontend',
                    'form_url'=>base_url().'studentregister/submit',
                    'type'=>$type
                   
                   
        
                );
                $view=array(
                    'header'=>'themes/frontend/header',
                    'sidebar'=>false,
                    'body'=>'register',
                    'footer'=>'themes/frontend/footer'
        
                );
               
                template($view,$data);

            
            }
    }

    function submit()
    {
        

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'FullName', 'required');
        $this->form_validation->set_rules('address', 'Address ', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[10]|is_unique[users.phone]');
        $this->form_validation->set_rules('email', 'Email Address ', 'required|valid_email|is_unique[users.email]');

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('repassword', ' Re Password', 'required|min_length[6]|matches[password]');
      

        if ($this->form_validation->run() == FALSE)
        {
            $error=validation_errors();
            $this->session->set_flashdata('error',$error);
            $this->index();
        }
        else
        {
          $email= $this->input->post('email');
          $explode_email=explode('@',$email);
          $acceptance_code=['gmail.com','hotmail.com','yahoo.com','edu.np'];
          if(!in_array($explode_email[1],$acceptance_code))
          {
            $error='Please enter valid email address';
            $this->session->set_flashdata('error',$error);
            $this->index();
            exit;
               
          }
          
          $submit= $this->model->register_student();

          if($submit!=false)
          {
            
            $this->load->helper('email');
            $this->load->library('email');
            
            $this->email->set_mailtype("html");
             $subject="Email Verification";
           $message=" Click this Link to Verify Your Email. <br><br/><a href='".base_url()."studentregister/verify?email=".$this->input->post('email')."'>Verify Email </a> <br><br/> If you haven't performed this process. Please Ignore the mail.";
          $edata['link']=$message;
          $edata['post']=$_POST;
          $message=$this->load->view('verifyuserregistrationemail',$edata,true);
          $sent= send_email($this->input->post('email'),$subject,$message);
          // var_dump($sent);exit();
            $this->session->set_flashdata('error',"");
           // $this->session->set_flashdata('success',"You are Registered. Few More Details To know Who You Are. Please Fill the Form.");
           $this->session->set_flashdata('success',"Please Verify your Email.");
            $this->session->set_userdata('stid',$submit);
            $data['msg']='Your username is '.$_POST['username'].'<br/>Please Verify your Email. Verification Link is sent to your Email Account.<br/>Did not get a Email? <a href="'.base_url().'studentregister/resendverification/'.$this->input->post('email').'">Resend Verfication Link</a>';
            $data['mode']='frontend';
            $view=array(
              'header'=>'themes/frontend/header',
              'sidebar'=>false,
              'body'=>'success',
              'footer'=>'themes/frontend/footer'
  
          );
         
          template($view,$data);

            //$this->course_enroll_form($submit);
          }
          else
          {
            $this->session->set_flashdata('error',"Something Went Wrong !");
            $this->session->set_flashdata('success',"");
            $this->index();
          }
        }
    }
    public function basic_detail_form($student_id)
    {
      if($student_id!=$this->session->userdata('stid'))
      {
       $this->session->set_flashdata('error',"Network Error");
       redirect(base_url().'studentregister');
      }
        $data=array(
            'title'=>'TRYFORLEARN',
            'mode'=>'frontend',
            'student_id'=>$student_id,
            'secondary_button'=>true,
               
           

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>false,
            'body'=>'basic_detail',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);

    }
    public function course_enroll_form($student_id)
    {

           if($student_id!=$this->session->userdata('stid'))
           {
            $this->session->set_flashdata('error',"Network Error");
            redirect(base_url().'studentregister');
           }
         
      
        $data=array(
            'title'=>'TRYFORLEARN',
            'mode'=>'frontend',
            'student_id'=>$student_id,
            'form_url'=>base_url().'studentregister/submit_course_enroll/'.$student_id
               
           

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>false,
            'body'=>'course_enroll_form',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);

    }

    public function submit_basic_detail_form()
    {
      $pd=$this->input->post('pd');
      $pn=$this->input->post('pn');
      $gd=$this->input->post('gd');
      $gn=$this->input->post('gn');

      if($pd=="" || $pn =="" || $gd=="" || $gn=="")
      {
        $res = ["message"=>'Please Input All Fields',"status"=>false];

       
      }
      else
      {
          $data=$this->model->submit_data();

          if($data==true)
          {
            $res = ["message"=>'Success',"status"=>true];

          }
          else{
            $res = ["message"=>'Failed',"status"=>false];

          }
      }
      echo json_encode($res);


      
        

    }
    
    public function get_program()
    {
      $pid=$this->input->post('pid');
      $id=$this->input->post('id');
      if($pid=='UNI')
      {
        $data=$this->model->get_program_UNI();
        $html=$this->get_prgrm_HTML($data,$id,$pid);

      }else if($pid== 'SCH')
      {
        $data=$this->model->get_program_SCH();
        $html=$this->get_prgrm_HTML($data,$id,$pid);


      }
      else if($pid=='REA')
      {
        $data=$this->model->get_program_REA();
        $html=$this->get_prgrm_HTML($data,$id,$pid);


      }

      $res = ["message"=>'success',"status"=>true,"html"=>$html,"data"=>$data];
      echo json_encode($res);


    }
    public function get_prgrm_HTML($data,$pid,$type)
    {

      $html="";
      $html .='
      <div class="form-group">
        <select class="form-control" id="sid'.$pid.'"  name="sid" onchange="get_class('.$pid.')">
        <option value="-1">Please Select</option>';
      if($type=='UNI')
      {
       
           foreach($data as $val)
           {
            $html .='<option value="'.$val['university_id'].'">'.$val['name'].'</option>';
           }  
                
                
      }
      else if($type=='SCH')
      {
       
           foreach($data as $val)
           {
            $html .='<option value="'.$val['class_id'].'">'.$val['class_name'].'</option>';
           }  
                
                
      }
      else if($type=='REA')
      {
       
           foreach($data as $val)
           {
            $html .='<option value="'.$val['class_id'].'">'.$val['class_name'].'</option>';
           }  
                
                
      }
      $html .='</select></div>';
      return $html;
      
    }
    public function get_sprogram()
    {
      $fid=$this->input->post('fid');
      $pid=$this->input->post('pid');
      $id=$this->input->post('id');
      if($fid=='UNI')
      {
        $data=$this->model->get_sprogram_UNI($pid);
        $html=$this->get_sprgrm_HTML($data,$id,$fid);

      }else if($fid== 'SCH')
      {
        $data=$this->model->get_sprogram_SCH($pid);
        $html=$this->get_sprgrm_HTML($data,$id,$fid);


      }
      else if($fid=='REA')
      {
        $data=$this->model->get_sprogram_REA($pid);
        $html=$this->get_sprgrm_HTML($data,$id,$fid);


      }


      $res = ["message"=>'success',"status"=>true,"html"=>$html,"data"=>$data];
      echo json_encode($res);


    }
    public function get_sprgrm_HTML($data,$pid,$type)
    {

      $html="";
      $html .='
      <div class="form-group">
        <select class="form-control" id="scid'.$pid.'"  name="scid" onchange="get_course('.$pid.')">
        <option value="-1">Please Select</option>';
      if($type=='UNI')
      {
       
           foreach($data as $val)
           {
            $html .='<option value="'.$val['univ_program_id'].'">'.$val['program_name'].'</option>';
           }  
                
                
      }
      else if($type=='SCH')
      {
       
           foreach($data as $val)
           {
            $html .='<option value="'.$val['subject_id'].'" data-m="'.$val['monthly_price'].'" data-y="'.$val['yearly_price'].'">'.$val['subject_name'].'</option>';
           }  
                
                
      }
      else if($type=='REA')
      {
       
           foreach($data as $val)
           {
            $html .='<option value="'.$val['subject_id'].'" data-m="'.$val['monthly_price'].'" data-y="'.$val['yearly_price'].'">'.$val['subject_name'].'</option>';
           }  
                
                
      }
      $html .='</select></div>';
      return $html;
      
    }
    public function get_scprogram()
    {
      $scid=$this->input->post('scid');
      $id=$this->input->post('id');
     
        $data=$this->model->get_SCIDprogram_UNI($scid);
        $html=$this->get_SCIDprgrm_HTML($data,$id);

     

      $res = ["message"=>'success',"status"=>true,"html"=>$html,"data"=>$data];
      echo json_encode($res);


    }
    public function get_SCIDprgrm_HTML($data,$pid)
    {

      $html="";
      $html .='
      <div class="form-group">
        <select class="form-control" id="cuniid'.$pid.'"  name="cuniid" onchange="get_uni_subj('.$pid.')">
        <option value="-1">Please Select</option>';
    
           foreach($data as $val)
           {
            $html .='<option value="'.$val['class_id'].'">'.$val['class_name'].'</option>';
           }  
                
                
    
      $html .='</select></div>';
      return $html;
      
    }

    public function get_unisubprogram()
    {
      $scid=$this->input->post('scid');
      $id=$this->input->post('id');
     
        $data=$this->model->get_unisubprogram_UNI($scid);
        $html=$this->get_unisubprgrm_HTML($data,$id);

     

      $res = ["message"=>'success',"status"=>true,"html"=>$html,"data"=>$data];
      echo json_encode($res);


    }
    public function get_unisubprgrm_HTML($data,$pid)
    {

      $html="";
      $html .='
      <div class="form-group">
        <select class="form-control" id="unisid'.$pid.'"  name="unisid">
        <option value="-1">Please Select</option>';
    
        foreach($data as $val)
        {
         $html .='<option value="'.$val['subject_id'].'" data-m="'.$val['monthly_price'].'" data-y="'.$val['yearly_price'].'">'.$val['subject_name'].'</option>';
        } 
                
                
    
      $html .='</select></div>';
      return $html;
      
    }

    function submit_course_enroll($st_id)
    {
      if($this->input->post('pid')=='UNI')
      {
        $subject_id=$this->input->post('unisid');
      }
      else{
        $subject_id=$this->input->post('scid');
      }
      
      if($subject_id=="")
      {
        $this->session->set_flashdata('success',"");
        $this->session->set_flashdata('error',"No Subject Choosen");
        $this->course_enroll_form($st_id);

      }
      else
      {
        $this->model->student_enroll($st_id,$subject_id);
        $this->session->set_flashdata('error',"");
            $this->session->set_flashdata('success',"Your selected Course has been registered. Few More Details To know Who You Are. Please Fill the Form.");
              $this->basic_detail_form($st_id);
      }
    }

    public function verify()
    {
     
        $data=$this->model->verifyemail($_GET['email']);
     $data1=array(
          'title'=>'TRYFORLEARN',
          'mode'=>'frontend'
        
             
         

      );
      $data1['msg']='Your Email Account Has Been Verified. Now you can login to TRYFORLEARN ';

      $view=array(
          'header'=>'themes/frontend/header',
          'sidebar'=>false,
          'body'=>'success',
          'footer'=>'themes/frontend/footer'

      );
     
      template($view,$data1);
    }

    public function resendverification($email)
    {
        
      $this->load->helper('email');
      $this->load->library('email');
      
      $this->email->set_mailtype("html");
      $headers .= "MIME-Version: 1.0\r\n";
       $subject="Email Verification";
     // $message=" Click this Link to Verify Your Email. <br><br/><a href='".base_url()."studentregister/verify?email=".$email."'>Verify Email </a> <br><br/>. If you haven't performed this process. Please Ignore the mail.";
       $message="<html><body>";
                 $message.='<div style=margin:1rem;padding:1rem;text-align:center;background:#f7f3f3;border-radius: 1rem;" text-align="center"><center>';
                 $message.='<img src="https://www.tryforlearn.com/assets/try.png" alt="logo" width="100px" height="auto">';
                 $message.='<h4>Click this Link to Verify Your Email</h4>';
                $message.="<h1>"."<a href='".base_url()."studentregister/verify?email=".$email."'>Verify Email </a>"."</h1>";
                 $message.='<hr width="70%">';
                 $message.='<p margin-top="2rem"> If you have not performed this process. Please Ignore the mail.';
                 $message.='<hr width="70%">';
                 $message.='<p margin-top="">&copy; 2020 Try For Learn Pvt. Ltd.</p>';

                  $message.="<center></div>";
                 $message.="</body></html>";
    $sent= send_email($email,$subject,$message);
    // var_dump($sent);exit();
      $this->session->set_flashdata('error',"");
     // $this->session->set_flashdata('success',"You are Registered. Few More Details To know Who You Are. Please Fill the Form.");
     $this->session->set_flashdata('success',"Please Verify your Email.");
      $this->session->set_userdata('stid',$submit);
      $data['msg']='<h2>As per your Request. We have resend verification link to your Email Account.<br/>Did not get a Email? <br>
      <a href="'.base_url().'studentregister/resendverification/'.$email.'" >Resend Verfication Link</a></h2>';
       $view=array(
        'header'=>'themes/frontend/header',
        'sidebar'=>false,
        'body'=>'success',
        'footer'=>'themes/frontend/footer'

    );
   
    template($view,$data);
    }
   
}
