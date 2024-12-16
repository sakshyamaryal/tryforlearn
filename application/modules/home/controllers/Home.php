<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Home extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('home_model');

        $this->model=$this->home_model;
		$this->load->model('comman/common_model','common_model');

    }
    function index() {

        $data=array(
            'title'=>'Try For Learn:: institute for the preparation',
            'mode'=>'frontend',
            'banner' =>$this->model->get_banner(),
            'category'=>$this->model->get_category(),
            'service'=>$this->model->get_service(),
            'staff'=>$this->model->get_staff(),
            'testimonial'=>$this->model->get_testomonial(),
            'image'=>$this->model->get_image()

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>false,
            'body'=>'home',
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
            $data['course']=$this->common_model->getRows('level',array('level_id'=>$this->input->post('course_id')),'*','name');
             $course= $data['course'][0];
             $subject="Course Enquiry for ".@$course->name;
           $message=$this->input->post('message');
           $message .='<br/><br/>Enquiry By:<br/>Name:'.$this->input->post('name').
           '<br/>Email: '.$this->input->post('email').
           '<br/>Phone: '.$this->input->post('phone').
           '<br/>Address: '.$this->input->post('address');
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
