<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Users extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->model = $this->user_model;
		$this->load->model('comman/common_model','common_model');

		$this->load->model('package/package_model');
		$this->package = $this->package_model;
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
			'title' => 'List User',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);

	}

	public function student ()
	{
		$data = array(
			'title' => 'List Student',
		);
        $data['level']=$this->common_model->getRows('level',array('is_active'=>1,'is_payable'=>1),'*','level_id');

		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list-student',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}

	public function get_users ()
	{
		$users = $this->model->get_user();
		$final_data = array("resource" => $users);
		$final_data["total"] = $this->model->count_all_user();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}
	public function get_student ()
	{
		$users = $this->model->get_student();
		$final_data = array("resource" => $users);
		$final_data["total"] = $this->model->count_all_students();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}
	public function getUserType ()
	{
		$users = $this->model->getUserType();
		header('Content-Type: application/json');
		echo trim(json_encode($users));
	}


	function add ()
	{
		$validator = array('success' => false, 'messages' => array());
		if($this->input->post('userId')!='')
		{
			if ($this->model->save($this->input->post('userId'))) {
				$validator['success'] = true;
				$validator['messages'] = "User has been updating";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while updating the information into the database";
			}
		}
		else
		{
			if ($this->model->save($id = null)) {
				$validator['success'] = true;
				$validator['messages'] = "User has been save";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while inserting the information into the database";
			}

		}
		
		echo json_encode($validator);
	}

	function update ()
	{

		$validator = array('success' => false, 'messages' => array());
		if ($this->model->save($this->input->post('userId'))) {
			$validator['success'] = true;
			$validator['messages'] = "User has been updating";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while updating the information into the database";
		}
		echo json_encode($validator);
	}


	function delete ()
	{
		$validator = array('success' => false, 'messages' => array());
		if ($this->model->delete_user() == true) {
			$validator['success'] = true;
			$validator['messages'] = "User has been deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while deletion the information from the database";

		}
		echo json_encode($validator);
	}

	function update_student(){

		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'is_active' => $_GET['models'][0]['is_active'],
		);

		if ($this->model->updateUser($data_arr,$_GET['models'][0]['user_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "User Status has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	function approve_student(){

		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'is_approved' => 1,
			'is_emailverified'=>1
		);

		if ($this->model->updateUser($data_arr,$_POST['id'])) {

			$validator['success'] = true;
			$validator['messages'] = "User has been approved";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	function getclass()
	{
		$data=$this->common_model->getRows('class',array('is_active'=>1,'levelid'=>$_POST['levelid']),'*','classid');
		$html='<option value="-1">Select Class</option>';
		if (count($data)>0) {
		
			foreach($data as $key)
			{
				$html .="<option value='".$key->classid."'>".$key->name."</option>";
			}
             //var_dump($html);exit;
			$validator['success'] = true;
			$validator['html'] = $html;
			$validator['messages'] = "Data Available";
		} else {
			$validator['success'] = false;
			$validator['html'] = $html;
			$validator['messages'] = "No any Class Available";
		}
		echo json_encode($validator);
	}

	
	function getpackagerate()
	{
		$data=$this->common_model->getRows('subject',array('is_active'=>1,'subject_id'=>$_POST['subjectid']),'*,1monthsprice as onemonth,3monthsprice as threemonth,6monthsprice as sixmonth,1yearprice as oneyear','subject_id');
		$newdata=$data[0];
		$html='<option value="-1">Select Package</option>';
		$html .='<option value="'.$newdata->onemonth.'" data-val="1month">1 month Package [ '.$newdata->onemonth.' ]</option>';
		$html .='<option value="'.$newdata->threemonth.'" data-val="3month">3 month Package [ '.$newdata->threemonth.' ]</option>';
		$html .='<option value="'.$newdata->sixmonth.'" data-val="6month">6 month Package [ '.$newdata->sixmonth.' ]</option>';
		$html .='<option value="'.$newdata->oneyear.'" data-val="1year">1 year Package [ '.$newdata->oneyear.' ]</option>';
		

		$validator['success'] = true;
		$validator['html'] = $html;
		$validator['messages'] = "Data Available";
		echo json_encode($validator);
	}
	function subscribe()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userId[]', 'User Id', 'required');
		$this->form_validation->set_rules('class', 'Level', 'required|greater_than[0]');
		$this->form_validation->set_rules('classid', 'Class', 'required|greater_than[0]');
		$this->form_validation->set_rules('subjectid', 'Subject', 'required|greater_than[0]');
		$this->form_validation->set_rules('package', 'Package', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
		$data=$this->common_model->getRows('subject',array('is_active'=>1,'subject_id'=>$_POST['subjectid']),'*,1monthsprice as onemonth,3monthsprice as threemonth,6monthsprice as sixmonth,1yearprice as oneyear','subject_id');
		$newdata=$data[0];
		if($_POST['package']==$newdata->onemonth)
		{
			$feepackage='One Month';
			$enddate=date('Y-m-d', strtotime("+1 months", strtotime(date('Y-m-d'))));

		}
		else if($_POST['package']==$newdata->threemonth)
		{
			$feepackage='Three Month';
			$enddate =date('Y-m-d', strtotime("+3 months", strtotime(date('Y-m-d'))));

		}
		else if($_POST['package']==$newdata->sixmonth)
		{
			$feepackage='Six Month';
			$enddate =date('Y-m-d', strtotime("+6 months", strtotime(date('Y-m-d'))));

		}
		else if($_POST['package']==$newdata->oneyear)
		{
			$feepackage='One Year';
			$enddate =date('Y-m-d', strtotime("+1 year", strtotime(date('Y-m-d'))));

		}

		$this->db->trans_begin();

		$ids = explode(',', $_POST['userId']);

		foreach($ids as $id){

			$whereData = array('userid' => $id, 'levelid' => $_POST['class'], 'classid' => $_POST['classid'], 'subjectid' => $_POST['subjectid']);

			$oldData = $this->common_model->getRows('student_enroll', $whereData, '*', 'start_date desc');

			if(count($oldData) > 0){
				if(strtotime($oldData[0]->end_date) > strtotime(date('Y-m-d'))){
					if($_POST['package']==$newdata->onemonth)
					{
						$feepackage='One Month';
						$enddate=date('Y-m-d', strtotime("+1 months", strtotime($oldData[0]->end_date)));
					}
					else if($_POST['package']==$newdata->threemonth)
					{
						$feepackage='Three Month';
						$enddate =date('Y-m-d', strtotime("+3 months", strtotime($oldData[0]->end_date)));
					}
					else if($_POST['package']==$newdata->sixmonth)
					{
						$feepackage='Six Month';
						$enddate =date('Y-m-d', strtotime("+6 months", strtotime($oldData[0]->end_date)));
					}
					else if($_POST['package']==$newdata->oneyear)
					{
						$feepackage='One Year';
						$enddate =date('Y-m-d', strtotime("+1 year", strtotime($oldData[0]->end_date)));
					}
				}

				$updateData = array(
					'end_date' => $enddate,
					'current_status'=>1,
					'is_active'=>1
				);

				$enrollid = $oldData[0]->id;

				$this->common_model->update('student_enroll', $updateData, $whereData);

			}
			else{
				$insert_enroll=array(
					'userid'=>$id,
					'levelid'=>$_POST['class'],
					'classid'=>$_POST['classid'],
					'subjectid'=>$_POST['subjectid'],
					'start_date'=>date('Y-m-d'),
					'end_date'=>$enddate,
					'current_status'=>1,
					'is_active'=>1
				);
				$enrollid=$this->common_model->insert('student_enroll',$insert_enroll);
			}
			$sfee=array(
				'student_id'=>$id,
				'student_enroll_id'=>$enrollid,
				'levelid'=>$_POST['class'],
				'classid'=>$_POST['classid'],
				'subjectid'=>$_POST['subjectid'],
				'feepackage'=>$feepackage,
				'paid_amount'=>$_POST['package'],
				'paid_date'=>date('Y-m-d'),
				'is_paid'=>1,
				'issued_by'=>$this->session->adminuserid,
				'issued_date'=>date('Y-m-d'),
				'transactionid'=>0,
				'remarks'=>@$_POST['remarks'],
				'frompage'=>'STUDENTLIST-ADMIN'
			);
			$this->common_model->insert('student_fee',$sfee);
		}
		
		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
				$iu=0;
		}
		else
		{
				$this->db->trans_commit();
				$iu=1;
		}
		if ($iu>0) {

			$validator['type'] = 'success';
			$validator['message'] = "Success.";
		} else {
			$validator['type'] = false;
			$validator['message'] = "Something went wrong.";
        }
        echo json_encode($validator);
        exit;
	}

	function subscribed()
	{
		$data = array(
			'title' => 'Subscribed Student List',
			
		);
		$data['level']=$this->common_model->getRows('level',array('is_active'=>1,'is_payable'=>1),'*','level_id');

		$where='';
		if((int)@$_POST['class']>0)
		$where .=' and sf.levelid='.@$_POST['class'];

		if((int)@$_POST['classid']>0)
		$where .=' and sf.classid='.@$_POST['classid'];

		if((int)@$_POST['subjectid']>0)
		$where .=' and sf.subjectid='.@$_POST['subjectid'];

		$data['slist']=$this->model->getsubscribed($where);

       
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'subscribed',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}
	function deletestudent(){

		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'is_active' => 0,
			'is_emailverified'=>0
		);

		// $this->model->updateUser($data_arr,$_POST['id'])
		if ($this->model->delete_user()) {

			$validator['success'] = true;
			$validator['messages'] = "User Status has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

}
