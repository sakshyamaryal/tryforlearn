<?php

class Fees extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('Fees_model','model');
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
			'title' => 'List Fees',
			'filter_fee'=>false
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_fees ()
	{
		$fees = $this->model->get_fees();
		$final_data = array("resource" => $fees);
		$final_data["total"] = $this->model->count_all_fees();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}

	public function unpaid_fee ()
	{
		$data = array(
			'title' => 'List Unpaid Fees',
			'filter_fee'=>true
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_unpaidfees ()
	{
		$fees = $this->model->get_unpaidfees();
		$final_data = array("resource" => $fees);
		$final_data["total"] = $this->model->count_all_unpaidfees();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	

	
	public function update ()
	{
	
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'issued_by'=>$this->session->userdata('adminuserid'),
			'issued_date'=>date('Y-m-d'),
			'is_paid'=>($_GET['models'][0]['paid_amount']==$_GET['models'][0]['pay_amount']) ? 1 : 0,
			'paid_amount' => $_GET['models'][0]['paid_amount'],
			'paid_date' => ($_GET['models'][0]['paid_date']!='0000-00-00')?$_GET['models'][0]['paid_date']:date('Y-m-d'),
		

		);
		
		if ($this->model->updateService('student_fee',$data_arr,array('student_fee_id'=>$_GET['models'][0]['student_fee_id']))) {

			$validator['success'] = true;
			$validator['messages'] = "Fee has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	public function activate_course ()
	{
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'current_status'=>'1',
			'start_date'=>date('Y-m-d'),
			'end_date'=>date('Y-m-d', strtotime('+1 month'))

		);
		
		if ($this->model->updateService('student_enroll',$data_arr,array('id'=>$_POST['se']))) {

			$validator['success'] = true;
			$validator['messages'] = "Fee has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	

}