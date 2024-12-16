<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Clas extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('class_model');
		$this->model = $this->class_model;
		
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
		$getlevel=$this->model->getlevel($_GET['l']);
		$this->session->set_userdata('levelid',$getlevel);
		$data = array(
			'title' => 'List class',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_class ()
	{
		$class = $this->model->get_class();
		$final_data = array("resource" => $class);
		$final_data["total"] = $this->model->count_all_class();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	public function add ()
	{
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'levelid'=>$this->session->userdata('levelid'),
			'name' => $_GET['models'][0]['name'],
		
			'is_active' => 1,

		);

		if ($this->model->saveclass($data_arr)>0) {

			$validator['success'] = true;
			$validator['messages'] = "class has been saved";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while inserting the information into the database";
		}
		echo json_encode($validator);
	}

	
	public function update ()
	{
	
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'name' => $_GET['models'][0]['name'],
			
			'is_active' =>1,

		);
		
		if ($this->model->updateclass($data_arr,$_GET['models'][0]['classid'])) {

			$validator['success'] = true;
			$validator['messages'] = "class has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	public function delete(){
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'is_active' => 0,

		);
		
		if ($this->model->updateclass($data_arr,$_GET['models'][0]['classid'])) {

			$validator['success'] = true;
			$validator['messages'] = "class has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}
	

}