<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Contact extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('contact_model','model');

    }
    function index() {

        $data=array(
            'title'=>'Try For Learn : Contact us ',
            'mode'=>'frontend',
          

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>false,
            'body'=>'contact',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);


        
        
    }

    function submit_enquiry()
    {
        if($this->model->submit_enquiry())
        {
            $this->load->helper('email');
            $this->load->library('email');
            
            $this->email->set_mailtype("html");
           
             $subject=$this->input->post('subject');
           $message=$this->input->post('message');
           $message .='<br/><br/>Enquiry By:<br/>Name:'.$this->input->post('name').
           '<br/>Email: '.$this->input->post('email');
          $sent= send_email('try4learn@gmail.com',$subject,$message); //'try4learn@gmail.com'
            $res = ["message"=>'success',"status"=>true];

           echo json_encode($res);
        }else
        {
            $res = ["message"=>'failed',"status"=>false];

            echo json_encode($res);
        }

    }
}
