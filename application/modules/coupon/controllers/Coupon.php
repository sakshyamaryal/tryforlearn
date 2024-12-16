<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Coupon extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('coupon_model','model');
		$this->load->model('comman/common_model','common_model');

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
			'title' => 'List Coupon',
		);
		$data['levellist']=$this->common_model->getRows('level',array('is_active'=>1),'*','name');

		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);

	}

	public function get_coupon ()
	{
		$users = $this->model->get_coupon();
		$final_data = array("resource" => $users);
		$final_data["total"] = $this->model->count_all_coupon();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}
	
	

	function add ()
	{
		$validator = array('success' => false, 'messages' => array());
		if ($this->model->save($id = null)) {
			$validator['success'] = true;
			$validator['messages'] = "Coupon has been saved";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while inserting the information into the database";
		}
		echo json_encode($validator);
	}

	function update ()
	{
		

		$validator = array('success' => false, 'messages' => array());
		if ($this->model->save($this->input->post('vouchercodeid'))) {
			$validator['success'] = true;
			$validator['messages'] = "Coupon has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while updating the information into the database";
		}
		echo json_encode($validator);
	}


	function delete ()
	{
		$validator = array('success' => false, 'messages' => array());
		
		

		if ($this->model->delete_coupon()== true) {
			$validator['success'] = true;
			$validator['messages'] = "Coupon has been deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while deletion the information from the database";

		}
		echo json_encode($validator);
	}


}
