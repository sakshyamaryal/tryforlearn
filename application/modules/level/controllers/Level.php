<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Level extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('level_model');
		$this->model = $this->level_model;
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

		$data = array(
			'title' => 'List Level',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);

	}

	public function get_level ()
	{
		$users = $this->model->get_level();
		$final_data = array("resource" => $users);
		$final_data["total"] = $this->model->count_all_level();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}



	function add ()
	{
		$validator = array('success' => false, 'messages' => array());
		if ($this->model->save($id = null)) {
			$validator['success'] = true;
			$validator['messages'] = "Level has been saved";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while inserting the information into the database";
		}
		echo json_encode($validator);
	}

	function update ()
	{

		$validator = array('success' => false, 'messages' => array());
		if ($this->model->save($this->input->post('level_id'))) {
			$validator['success'] = true;
			$validator['messages'] = "Level has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while updating the information into the database";
		}
		echo json_encode($validator);
	}


	function delete ()
	{
		$validator = array('success' => false, 'messages' => array());
		
		

		if ($this->model->delete_level()== true) {
			$validator['success'] = true;
			$validator['messages'] = "Level has been deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while deletion the information from the database";

		}
		echo json_encode($validator);
	}


}
