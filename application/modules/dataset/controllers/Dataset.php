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
	public function get_datasets()
{
    $course_id = $this->input->get('course_id');
    $class_id = $this->input->get('class_id');

    $datasets = $this->model->get_datasets($course_id, $class_id); // See model below
    echo json_encode($datasets);
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

    // Get data from POST request
    $levelid = $this->input->post('course');
    $subject_id = $this->input->post('subject');
    $time_period = $this->input->post('add_time_period'); // Get the time_period from form input

    // Validate that subject belongs to the selected level (course)
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

    // Prepare data for insertion
    $data = array(
        'class_id' => $this->input->post('class'),
        'subject_id' => $subject_id,
        'setname' => $this->input->post('add_setname'),
        'title' => $this->input->post('add_title'),
        'order' => $this->input->post('add_order'),
        'time_period' => $time_period, // Save the time period
        'is_active' => 1,
				'guideline' => $this->input->post('guideline')
    );

    // Insert dataset into the database
    $inserted = $this->dataset_model->insert_dataset($data);

    if ($inserted) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to insert dataset']);
    }
}

public function get_dataset_details()
{
    $setid = $this->input->get('setid');  // Get the setid from the URL parameter
    
    // Fetch dataset details
    $this->load->model('Dataset_model', 'dataset_model');
    $dataset = $this->dataset_model->get_dataset_by_id($setid);
    $questions = $this->dataset_model->get_questions_by_setid($setid);
    
    if ($dataset) {
        // Return dataset details as JSON
        echo json_encode([
            'status' => 'success',
            'data' => $dataset,
						'questions' => $questions
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Dataset not found.'
        ]);
    }
}

// Update dataset details
public function update_dataset() {
	$data = $this->input->post(); // Get all POST data from the form
	$this->load->model('Dataset_model');

	// Validate and sanitize the data
	$setname = $this->input->post('edit-setname');
	$title = $this->input->post('edit-title');
	$order = $this->input->post('edit-order');
	$time_period = $this->input->post('edit-time_period');
	$guidelinesInput = $this->input->post('guideline');
	$guidelines = is_array($guidelinesInput) ? implode("\n", $guidelinesInput) : $guidelinesInput;

	// Perform the update operation in your database
	$updated = $this->Dataset_model->update_dataset($data['setid'], $setname, $title, $order, $time_period, $guidelines);

	// If update is successful
	if ($updated) {
			echo json_encode(['status' => 'success']);
	} else {
			echo json_encode(['status' => 'error']);
	}
}

public function remove_question_from_dataset() {
	$eid = $this->input->post('eid');
	$setid = $this->input->post('setid');

	$this->load->model('Dataset_model');
	$removed = $this->Dataset_model->delete_question_from_dataset($setid, $eid);

	if ($removed) {
			echo json_encode(['status' => 'success']);
	} else {
			echo json_encode(['status' => 'error']);
	}
}


}