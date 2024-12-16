<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Dataset extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('dataset_model','model');
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
		$data = array(
			'title' => 'List Dataset',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_group ()
	{
		$group = $this->model->get_group();
		$final_data = array("resource" => $group);
		$final_data["total"] = $this->model->count_all_group();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	public function add ()
	{
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'setname' => $_GET['models'][0]['setname'],
			'title' => $_GET['models'][0]['title'],
			
			'is_active' =>1,

		);

		if ($this->model->savegroup($data_arr)>0) {

			$validator['success'] = true;
			$validator['messages'] = "Dataset has been saved";
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
			'setname' => $_GET['models'][0]['setname'],
			'title' => $_GET['models'][0]['title'],
			
			'is_active' =>1,

		);
		
		if ($this->model->updategroup($data_arr,$_GET['models'][0]['groupid'])) {

			$validator['success'] = true;
			$validator['messages'] = "Dataset has been updated";
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
		
		if ($this->model->updategroup($data_arr,$_GET['models'][0]['groupid'])) {

			$validator['success'] = true;
			$validator['messages'] = "Dataset has been deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}
	
	

}