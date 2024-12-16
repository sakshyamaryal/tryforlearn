<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Examtype extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('examtype_model','model');
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
			'title' => 'List examtype',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_examtype ()
	{
		$examtype = $this->model->get_examtype();
		$final_data = array("resource" => $examtype);
		$final_data["total"] = $this->model->count_all_examtype();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	public function add ()
	{
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'examtypename' => $_GET['models'][0]['examtypename'],
			'fullmarks' => $_GET['models'][0]['fullmarks'],
			'passmarks' => $_GET['models'][0]['passmarks'],


		);

		if ($this->model->saveexamtype($data_arr)>0) {

			$validator['success'] = true;
			$validator['messages'] = "examtype has been saved";
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
			'examtypename' => $_GET['models'][0]['examtypename'],
			'fullmarks' => $_GET['models'][0]['fullmarks'],
			'passmarks' => $_GET['models'][0]['passmarks'],

		);
		
		if ($this->model->updateexamtype($data_arr,$_GET['models'][0]['examtypeid'])) {

			$validator['success'] = true;
			$validator['messages'] = "examtype has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	public function delete(){
		$validator = array('success' => false, 'messages' => array());
		// $data_arr = array(
		// 	'is_active' => 0,

		// );
		//$this->model->updateexamtype($data_arr,$_GET['models'][0]['examtypeid']);
		$this->db->where('examtypeid',$_GET['models'][0]['examtypeid']);
		
		if ($this->db->delete('examtype')) {

			$validator['success'] = true;
			$validator['messages'] = "examtype has been deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}
	
	
	

}