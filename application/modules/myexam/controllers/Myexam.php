<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Myexam extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('myexam_model','model');

		if($this->session->userdata('userid') == "")
        {
			$this->session->set_userdata('currentevent',$this->uri->segment('1'));
            redirect('studentlogin');
		}
		
		
    }

    function index()
    {
        $data=array(
            'title'=>'Exam',
            'mode'=>'frontend',
          
        );
       $data['list']=$this->model->getlist();
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'exam',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);

    }

    function getquestion()
    {

        $post=$_POST;
        $check=$this->model->checkattempt($post);
        if($check===1)
        {
            echo json_encode(array('status'=>false,'message'=>'Already Submitted.','html'=>'<strong style="color:red;">This Exam set is already Submitted by you.</strong>'));
            exit;  
        }
        $data['post']=$post;

        if($post['is_subj']=='Y')
        {
            $data['exer']=$this->model->getexercise($post);
            $html=$this->load->view('studentpanel/exam',$data,true);

        }
        else
        {
           
            $data['exer']=$this->model->getquiz($post);
            $html=$this->load->view('studentpanel/quiz',$data,true);
        }
        echo json_encode(array('status'=>true,'message'=>'Success','data'=>$data['exer'],'html'=>$html));
        exit; 
    }
    
}