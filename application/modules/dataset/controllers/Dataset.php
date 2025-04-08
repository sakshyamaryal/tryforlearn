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
		$this->load->model('dataset/Dataset_model');
    $datasets = $this->Dataset_model->get_all_datasets();  // Fetch all datasets initially
    $data['datasets'] = $datasets;
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
	// public function datasetdata()
	// {
	// 	// Load input values
	// 	// $class_id = $this->input->post('class_id');
	// 	// $subject_id = $this->input->post('subject_id');

	// 	$class_id = $this->input->post('class_id');
	// 	$subject_id = $this->input->post('subject_id');
	// 	// Load model if not already loaded
	// 	$this->load->model('Dataset_model');

	// 	// Get filtered datasets
	// 	$datasets = $this->Dataset_model->get_filtered_datasets($class_id, $subject_id);
	// 	$data = [];
	// 	$sn = 1;

  //   foreach ($datasets as $item) {
	// 		$data[] = [
	// 				'sn' => $sn++,
	// 				'name' => $item->setname,
	// 				'title' => $item->title,
	// 				'order' => $item->order,
	// 				'action' => '<button class="btn btn-sm btn-primary edit-action" data-id="'.$item->setid.'">Edit</button>'
	// 		];
	// }

	// echo json_encode(['data' => $data]);
	// }

	public function datasetdata()
	{
			$classid = $this->input->post('class');
			$subjectid = $this->input->post('subject');
	
			$this->load->model('dataset/Dataset_model'); // load model in HMVC format
	
			$datasets = $this->Dataset_model->get_filtered_datasets($classid, $subjectid); // adjust method if needed
	
			if ($datasets) {
					$html = $this->load->view('dataset-table', ['datasets' => $datasets], TRUE); // View path is relative inside the module
					echo json_encode(['type' => 'success', 'html' => $html]);
			} else {
					echo json_encode(['type' => 'error', 'message' => 'No datasets found.']);
			}
	}

	public function delete_individual_dataset() {
		$this->load->model('dataset_model');
		$setid = $this->input->post('setid');  // Get the dataset ID from the POST request

		if (empty($setid)) {
				echo json_encode(['type' => 'error', 'message' => 'Invalid dataset ID.']);
				return;
		}

		$result = $this->dataset_model->delete_dataset_by_id($setid);  // Call the model function

		if ($result) {
				echo json_encode(['type' => 'success', 'message' => 'Dataset deleted successfully.']);
		} else {
				echo json_encode(['type' => 'error', 'message' => 'Failed to delete dataset.']);
		}
}
public function delete_selected_datasets()
{
    $setids = $this->input->post('setids');
    
    if (!empty($setids)) {
        $this->load->model('dataset_model'); // Load your dataset model
        $result = $this->dataset_model->delete_selected_datasets($setids);
        
        if ($result) {
            echo json_encode(['type' => 'success', 'message' => 'Datasets deleted successfully.']);
        } else {
            echo json_encode(['type' => 'error', 'message' => 'Error occurred while deleting datasets.']);
        }
    } else {
        echo json_encode(['type' => 'error', 'message' => 'No datasets selected.']);
    }
}

public function save_dataset()
{
    $this->load->model('dataset_model');

    $levelid = $this->input->post('course');
    $subject_id = $this->input->post('subject');

    // ✅ Validate that subject belongs to the selected level (course)
    $subject = $this->db->get_where('subject', [
        'subject_id' => $subject_id,
        'levelid' => $levelid
    ])->row();

    if (!$subject) {
        echo json_encode([
            'status' => 'error',
            'message' => 'The selected subject does not belong to the selected course.'
        ]);
        return;
    }

    // ✅ Prepare insert data
    $data = array(
        'class_id' => $this->input->post('class'),
        'subject_id' => $subject_id,
        'setname' => $this->input->post('setname'),
        'title' => $this->input->post('title'),
        'order' => $this->input->post('order'),
        'is_active' => 1
    );

    // ✅ Insert
    $inserted = $this->dataset_model->insert_dataset($data);

    if ($inserted) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to insert dataset']);
    }
}



	


}