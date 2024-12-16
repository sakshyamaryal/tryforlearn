<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Subject extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('subject_model');
		$this->load->model('clas/class_model','classmodel');
		$this->model = $this->subject_model;
		if($this->session->adminuserid == "")
        {
            redirect('account/admin_login');
		}
		if(check_permission($this->uri->segment('1'))=== false)
		{
			echo "SYSTEM EXITED ! You donot Have Permission.";exit();
		}


	}

	function index ()
	{
		if(!$_GET['l'])
		{
			echo "SYSTEM EXITED";
			exit;
		}
		$getlevel=$this->classmodel->getlevel($_GET['l']);
		$this->session->set_userdata('levelid',$getlevel);

		$data = array(
			'title' => 'List Subject',
			'class'=>$this->model->getclass($getlevel)
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);

	}

	public function get_subject ()
	{
		$users = $this->model->get_subject();
		$final_data = array("resource" => $users);
		$final_data["total"] = $this->model->count_all_subject();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}
	

	public function get_class ()
	{
		$data = $this->model->getclass($this->session->userdata('levelid'));
		$res = ["message"=>'success',"status"=>true,"data"=>$data];
		echo (json_encode($res));

	}



	function add ()
	{
		$validator = array('success' => false, 'messages' => array());
		if ($this->model->save($id = null)) {
			$validator['success'] = true;
			$validator['messages'] = "Subject has been saved";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while inserting the information into the database";
		}
		echo json_encode($validator);
	}

	function update ()
	{
		

		$validator = array('success' => false, 'messages' => array());
		if ($this->model->save($this->input->post('subject_id'))) {
			$validator['success'] = true;
			$validator['messages'] = "Subject has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while updating the information into the database";
		}
		echo json_encode($validator);
	}


	function delete ()
	{
		$validator = array('success' => false, 'messages' => array());
		
		

		if ($this->model->delete_subject()== true) {
			$validator['success'] = true;
			$validator['messages'] = "Subject has been deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while deletion the information from the database";

		}
		echo json_encode($validator);
	}


}
