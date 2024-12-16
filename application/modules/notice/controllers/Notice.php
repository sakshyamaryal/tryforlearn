<?php

class Notice extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('notice_model');
		$this->model = $this->notice_model;
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
			'title' => 'List notice',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_notice ()
	{
		$notice = $this->model->get_notice();
		$final_data = array("resource" => $notice);
		$final_data["total"] = $this->model->count_all_notice();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	public function add ()
	{
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'title' => $_GET['models'][0]['title'],
			'body' => $_GET['models'][0]['body'],
			'created_date' => date('Y-m-d'),
			'is_active' => $_GET['models'][0]['is_active'],
            'created_by' =>$this->session->userdata('adminuserid') ,

		);

		if ($this->model->saveNotice($data_arr)>0) {

			$validator['success'] = true;
			$validator['messages'] = "Notice has been save";
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
            'title' => $_GET['models'][0]['title'],
            'body' => $_GET['models'][0]['body'],
            'is_active' => $_GET['models'][0]['is_active'],

        );

        if ($this->model->updateNotice($data_arr,$_GET['models'][0]['notice_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "Notice has been updated";
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
		
		if ($this->model->updateNotice($data_arr,$_GET['models'][0]['notice_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "Notice has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}
	

}