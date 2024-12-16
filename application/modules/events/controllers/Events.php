<?php

class Events extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('events_model');
		$this->model = $this->events_model;
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
			'title' => 'List events',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_events ()
	{
		$events = $this->model->get_events();
		$final_data = array("resource" => $events);
		$final_data["total"] = $this->model->count_all_events();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	public function add ()
	{
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'title' => $_GET['models'][0]['title'],
			'body' => $_GET['models'][0]['body'],
			'happening_at' =>$_GET['models'][0]['happening_at'],
			'happening_date' =>$this->convert_date($_GET['models'][0]['happening_date']),
			'created_at' => date('Y-m-d'),
			'is_active' => $_GET['models'][0]['is_active'],
            'created_by' =>$this->session->userdata('adminuserid') ,

		);
		if ($this->model->saveevents($data_arr)>0) {

			$validator['success'] = true;
			$validator['messages'] = "events has been save";
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
			'happening_at' =>$_GET['models'][0]['happening_at'],
			'happening_date' =>$this->convert_date($_GET['models'][0]['happening_date']),
            'is_active' => $_GET['models'][0]['is_active'],

        );

        if ($this->model->updateevents($data_arr,$_GET['models'][0]['event_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "events has been updated";
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
		
		if ($this->model->updateevents($data_arr,$_GET['models'][0]['event_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "events has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	public function convert_date($date)
	{
		$old_date_timestamp = strtotime(substr($date, 0, 15));
		$new_date = date('Y-m-d  H:i:s', $old_date_timestamp);
		return $new_date;
	}
}