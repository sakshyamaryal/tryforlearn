<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Studentexercise extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('comman/common_model','common_model');
		$this->load->model('studentexercise_model','model');
		$this->load->model('clas/class_model','classmodel');


		if($this->session->adminuserid == "")
        {
			$this->session->set_userdata('currentevent',$this->uri->segment('1'));
            redirect('account/admin_login');
		}
		if(check_permission($this->uri->segment('1'))=== false)
		{
			echo "SYSTEM EXITED ! You donot Have Permission.";exit();
		}
		
	}

	public function index ()
	{
		if(!$_GET['l'])
		{
			echo "SYSTEM EXITED";
			exit;
		}
		$getlevel=$this->classmodel->getlevel($_GET['l']);
		$this->session->set_userdata('levelid',$getlevel);
		
		$data = array(
			'title' => 'Student Exercise List',
		);
		if($_GET['l']=='p' || $_GET['l']=='i')
		$showclass='N';
		else
		$showclass='Y';

		if($showclass=='Y')
		{
			$data['class']=$this->common_model->getRows('class',array('is_active'=>1,'levelid'=>$getlevel),'*','classid');
            $data['chapter']=array();
		}else
		{
			$data['chapter']=$this->common_model->getRows('chapter',array('is_active'=>1,'levelid'=>$getlevel),'*','chaptername');

		}
		$data['examtype']=$this->common_model->getRows('examtype',array(),'*','examtypeid');

		$data['showclass']=$showclass;
		$data['levelid']=$getlevel;
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}
	
	

	function getexercises()
	{
		$this->load->library('form_validation');
		if($_POST['toshow']=='Y')
		{
			$this->form_validation->set_rules('class', 'Class', 'required|greater_than[0]');
			$this->form_validation->set_rules('subject', 'Subject', 'required|greater_than[0]');
		}
       
		$this->form_validation->set_rules('isself', 'Exam Category', 'required');
		if($_POST['isself']=='Y')
		{
			$this->form_validation->set_rules('chapter', 'Chapter', 'required|greater_than[0]');

		}	
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
		}
		$post=$_POST;
		$data['row']=$this->model->getexerciselist($post);
		$html=$this->load->view('table',$data,true);
		$res = ["type"=>'success','message'=>'Data Avaialble','html'=>$html,'data'=>$data['row']];

		echo json_encode($res);

	}

	function viewans($id,$type)
	{
		$data = array(
			'title' => 'Verify Answer',
		);
		if($type=='S')
        {
            $data['exer']=$this->model->getexercise($id,$type);
           $viewer='exam';

        }
        else
        {
            $data['exer']=$this->model->getquiz($id,$type);
            $viewer='quiz';
		}
		//var_dump($data['exer']);exit;
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => $viewer,
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
      
	}

	function updatemark()
	{
		$iu=$this->model->updatemark($_POST);

		if ($iu>0) {

			$validator['type'] = 'success';
			$validator['message'] = "Success";
		} else {
			$validator['type'] = false;
			$validator['message'] = "Something went wrong.";
		}
		echo json_encode($validator);
		exit;
	}
 
    
	
}