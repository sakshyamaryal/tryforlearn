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
	public function get_classes_by_level()
	{
			$level_id = $this->input->get('level_id');
			$classes = $this->model->get_classes_by_level($level_id); // See model below
			echo json_encode($classes);
	}
	public function get_subjects_by_class()
	{
			$class_id = $this->input->get('class_id');
			$subjects = $this->model->get_subjects_by_class($class_id); // See model below
			echo json_encode($subjects);
	}

// 	public function datasetdata()
// {
//     // $class_id = $this->input->post('classid');
//     // $subject_id = $this->input->post('subjectid');

//     // $this->load->model('Dataset_model');
// 		// $data = $this->Dataset_model->get_filtered_datasets($class_id, $subject_id);
	
// 		// $response = [];
// 		// $sn = 1;
//     // foreach ($data as $item) {
//     //     $response[] = [
//     //         'sn' => $sn++,  // Serial number
//     //         'name' => $item->setname,  // Accessing object property using "->"
//     //         'title' => $item->title,
//     //         'is_active' => $item->is_active,  // Accessing object property
//     //         'order' => $item->order,  // Accessing object property
//     //         'action' => '<button class="btn btn-sm btn-primary edit-action">Edit</button>'  // Example of action buttons
//     //     ];
//     // }
// 		// echo json_encode(['data' => $response]);
// 		$data['post']=$_POST;
// 		$html=$this->load->view('dataset-table',$data, true);
// 		$res = ["message"=>'Exercise Table',"type"=>'success','html'=>$html];

// 		echo json_encode($res);
// 		exit;
// }
	public function datasetdata()
	{
		// Load input values
		// $class_id = $this->input->post('class_id');
		// $subject_id = $this->input->post('subject_id');

		$class_id = $this->input->post('class');
		$subject_id = $this->input->post('subject');
		// Load model if not already loaded
		$this->load->model('Dataset_model');

		// Get filtered datasets
		$datasets = $this->Dataset_model->get_filtered_datasets($class_id, $subject_id);
		$response = [];
		$sn = 1;

    foreach ($datasets as $item) {
			$response[] = [
					'sn' => $sn++,
					'name' => $item->setname,
					'title' => $item->title,
					'order' => $item->order,
					'action' => '<button class="btn btn-sm btn-primary edit-action" data-id="'.$item->setid.'">Edit</button>'
			];
	}

	echo json_encode(['data' => $response]);
		exit;
	}

}