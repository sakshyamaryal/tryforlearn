<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Studentlogin extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('studentlogin_model');
        $this->model=$this->studentlogin_model;
    }
    function index() {
      $this->model->autologout();
        if(!empty($this->session->userdata('userid')))
            {
                    redirect(base_url());
            }else{

                $data=array(
                    'title'=>'Try for Learn Pvt. Ltd.',
                    'mode'=>'frontend',
                    'form_url'=>base_url().'studentlogin/authenticate'
                   
                   
        
                );
                $view=array(
                    'header'=>'themes/frontend/header',
                    'sidebar'=>false,
                    'body'=>'login',
                    'footer'=>'themes/frontend/footer'
        
                );
               
                template($view,$data);

            
            }
    }

    function authenticate()
    {
            $username = $this->input->post('username');
            $password= md5($this->input->post('password'));
            $this->load->helper(array('form', 'url'));

            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required'
            );
          

            if ($this->form_validation->run() == FALSE)
            {
                $error=validation_errors();
                $this->session->set_flashdata('error',$error);
                $this->index();
            }
            else
            {
              $valid= $this->model->verify($username,$password);
        
            if($valid==2)
            {
               
                redirect(base_url().'studentpanel');
            }else if($valid==1)
            {
                $this->session->set_flashdata('error','Your account Is Already Logged In from Another Device');
                $this->index();

            }
            else if($valid==0)
            {
               
                // $this->session->set_flashdata('error','You are not a Valid Student');
                 $this->session->set_flashdata('error','Invalid Username OR Password. Please Try Again.');
                $this->index();

            }
            else
            {
                $this->session->set_flashdata('error','Invalid Username OR Password. Please Try Again.');
                $this->index();
            }
        }
    }
    function logout()
    {
       $data=$this->model->logout();
      
       $this->session->set_flashdata('success','You have logged out Successfully.');
   

       redirect(base_url());

    }
    function submit_email()
    {
        $email=$this->input->post('email');
   
      if($email=="")
      {
        $res = ["message"=>'Please Input All Fields',"status"=>false];

       
      }
      else
      {
          $data=$this->model->getSingleRow(array('email'=>$email,'is_active'=>'1'));
          
         

          if($data != '0')
          {
              $submitcode=$this->model->submit_otp($email);
             
              $this->load->helper('email');
                $this->load->library('email');
                
                $this->email->set_mailtype("html");
                 $mail_data['otp']=$submitcode;
                 $subject="Password Reset";
               $message=" Your OTP CODE is: ".$submitcode." .<br/><br/> If you haven't performed this process. Please Ignore the mail.";
               send_email($email,$subject,$message);
            $res = ["message"=>'Success',"status"=>true,"email"=>$email];

          }
          else{
            $res = ["message"=>'No Associated Email on Our Server.',"status"=>false];

          }
      }
      echo json_encode($res);
    }

    function submit_otp()
    {
        $email=$this->input->post('email');
        $otp=$this->input->post('otp');
   
      if($email=="" || $otp=="")
      {
        $res = ["message"=>'Please Input All Fields',"status"=>false];

       
      }
      else
      {
          $data=$this->model->getSingleRow(array('email'=>$email,'otp_code'=>$otp));
         

          if($data != '0')
          {
              
            $res = ["message"=>'Success',"status"=>true,"email"=>$email];

          }
          else{
            $res = ["message"=>'OTP Validation failed.',"status"=>false];

          }
      }
      echo json_encode($res);
    }
    function submit_newpwd()
    {
        $email=$this->input->post('email');
        $pwd=$this->input->post('pwd'); $repwd=$this->input->post('repwd');
   
      if($email=="" || $pwd=="" || $repwd=="")
      {
        $res = ["message"=>'Please Input All Fields',"status"=>false];

       
      }
      else
      {
          $data=$this->model->update_password();
         

          if($data != false)
          {
              
            $res = ["message"=>'Success',"status"=>true];

          }
          else{
            $res = ["message"=>'Couldnot Submit Password.',"status"=>false];

          }
      }
      echo json_encode($res);
    }
}
