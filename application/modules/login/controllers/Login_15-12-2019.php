<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->model=$this->login_model;
    }
    function index() {
        if(!empty($this->session->userdata('adminuserid')))
            {
                    redirect(base_url()."dashboard");
            }else{

            
        $this->load->view('login');
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
                $this->load->view('login');
            }
            else
            {
              $valid= $this->model->verify($username,$password);
        
            if($valid==2)
            {
               
                redirect(base_url()."dashboard");
            }else if($valid==1)
            {
                $this->session->set_flashdata('error','Your account Is Already Logged In from Another Device');
                $this->load->view('login');

            }
            else
            {
                $this->session->set_flashdata('error','Invalid Email ID OR Password. Please Try Again.');
                $this->load->view('login');
            }
        }
    }
    function logout()
    {
       $data=$this->model->logout();
      
       $this->session->set_flashdata('success','You have logged out Successfully.');
   

       redirect(base_url()."account/admin_login");

    }
}
