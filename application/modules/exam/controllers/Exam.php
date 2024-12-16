<?php

class Exam extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('Exam_model','model');
		$this->load->model('comman/common_model');
		$this->common = $this->common_model;
		if($this->session->adminuserid == "")
        {
            redirect('account/admin_login');
		}
		if(check_permission($this->uri->segment('1'))=== false)
		{
			echo "SYSTEM EXITED ! You donot Have Permission.";exit();
		}
	}

	public function index ()
	{
		$data = array(
			'title' => 'List Exam',
			'type'=>'sub'
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}
	public function mcq ()
	{
		$data = array(
			'title' => 'List Exam',
			'type'=>'obj'

		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_Exam ()
	{  
		if($_GET['t']=='sub')
		{
			$Exam = $this->model->get_Exam('sub');
			$final_data = array("resource" => $Exam);
			$final_data["total"] = $this->model->count_all_Exam('sub');
		}else{
			$Exam = $this->model->get_Exam('topic');
			$final_data = array("resource" => $Exam);
			$final_data["total"] = $this->model->count_all_Exam('topic');
		}
	
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	

	
	public function update ()
	{
	
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'obtained_marks'=>$_GET['models'][0]['obtained_marks'],
		

		);
		
		if ($this->model->updateService($data_arr,$_GET['models'][0]['student_exam_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "Exam has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}
  public function add()

  {
	$data=json_decode($_POST['postdata']);

	$obt_marks=0;
	  foreach($data as $val)
	  {
		  $obt_marks += $val->obtained_marks;

		
	  }
	  $data_insert=array(
		  'student_id'=>$data[0]->student_id,
		  'full_marks'=>$data[0]->full_marks,
		  'pass_marks'=>$data[0]->pass_marks,
		  'obtained_marks'=>$obt_marks,
		  'exam_date'=>$data[0]->exam_date,
		  'exam_type'=>$data[0]->exam_id,
		  'issued_by'=>$this->session->userdata('adminuserid'),
		  'issued_date'=>date('Y-m-d')
	  );
	  $reportdata=$this->model->makereport($data_insert);
		if ($reportdata != false) {
			 $this->model->update_exam_report($data,$reportdata);
			  

			$validator['success'] = true;
			$validator['messages'] = "Report has been generated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);

	 
  }
  function viewans()
  {
	$answer=$this->model->findans($this->input->post('id'));
	if ($answer != false) {
		 $validator['success'] = true;
		$validator['messages'] = "Answer Display";
		$validator['data'] = $answer;

	} else {
		$validator['success'] = false;
		$validator['messages'] = "No Data";
	}
	echo json_encode($validator);
  }
  
	

}