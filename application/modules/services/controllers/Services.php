<?php

class Services extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('Services_model');
		$this->model = $this->Services_model;
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
			'title' => 'List Services',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_services ()
	{
		$services = $this->model->get_services();
		$final_data = array("resource" => $services);
		$final_data["total"] = $this->model->count_all_services();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	public function add ()
	{
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'service_name' => $_GET['models'][0]['service_name'],
			'desc' => $_GET['models'][0]['desc'],
			'fonticon' => $_GET['models'][0]['fonticon'],
			'is_active' => $_GET['models'][0]['is_active'],

		);

		if ($this->model->saveService($data_arr)>0) {

			$validator['success'] = true;
			$validator['messages'] = "Service has been save";
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
			'service_name' => $_GET['models'][0]['service_name'],
			'desc' => $_GET['models'][0]['desc'],
			'fonticon' => $_GET['models'][0]['fonticon'],
			'is_active' => $_GET['models'][0]['is_active'],

		);
		
		if ($this->model->updateService($data_arr,$_GET['models'][0]['service_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "Service has been updated";
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

		$ids = $this->input->post('id') ? $this->input->post('id') : $_GET['models'][0]['service_id'];
		
		if ($this->model->updateService($data_arr,$ids)) {

			$validator['success'] = true;
			$validator['messages'] = "Service has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}
	

}