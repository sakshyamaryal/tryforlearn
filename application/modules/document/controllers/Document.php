<?php

class Document extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('document_model');
		$this->model = $this->document_model;
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
			'title' => 'List Document',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_documents ()
	{
		$documents = $this->model->get_document();
		$final_data = array("resource" => $documents);
		$final_data["total"] = $this->model->count_all_document();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	public function add ()
	{

		
		$data_arr = array(
			'document_no' => $_GET['models'][0]['document_no'],
			'student_id' => $_GET['models'][0]['student_id'],
			'student_dob' =>$_GET['models'][0]['student_dob'],
// 			'student_dob' =>$this->convert($_GET['models'][0]['student_dob']),

			'exam_date' => $this->convert($_GET['models'][0]['exam_date']),
			'issued_by' => $this->session->userdata('adminuserid'),
			'upload_file' => $_GET['models'][0]['propertyLogo'],
			'issued_date' => date('Y-m-d'),

		);

		if ($this->model->savedocument($data_arr) > 0) {

			$validator['success'] = true;
			$validator['messages'] = "Document has been save";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while inserting the information into the database";
		}
		echo json_encode($validator);
	}



	public function update ()
	{

		$data_arr = array(
			'document_no' => $_GET['models'][0]['document_no'],
			'student_id' => $_GET['models'][0]['student_id'],
			'student_dob' =>$_GET['models'][0]['student_dob'],

			'exam_date' => $this->convert($_GET['models'][0]['exam_date']),
			'issued_by' => $this->session->userdata('adminuserid'),
			'upload_file' => $_GET['models'][0]['propertyLogo'],
			'issued_date' => date('Y-m-d'),


		);
	
		if ($this->model->updatedocument($data_arr, $_GET['models'][0]['document_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "Document has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	public function delete ()
	{

// 		$data_arr = array(
// 			'is_active' => 0,

// 		);

// 		if ($this->model->updatedocument($data_arr, $_GET['models'][0]['document_id'])) {
        $this->db->where('document_id', $_GET['models'][0]['document_id']);

		if ($this->db->delete('document')) {

			$validator['success'] = true;
			$validator['messages'] = "D has been deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	public function removeImage ()
	{

		unlink("./upload/document/" . $_POST['fileNames']);
		echo "";
	}

	public function image ()
	{
		$fileParam = "fileUpload";
		$files = $_FILES[$fileParam];

		if (isset($files['name'])) {
			$error = $files['error'];
			if ($error == UPLOAD_ERR_OK) {

				$new_name = time();
				$config = array(
					'upload_path' => './upload/document',
					'allowed_types' => "gif|jpg|png|jpeg|pdf|GIF|PNG|JPG|JPEG|PDF",
					'overwrite' => TRUE,
					'max_size' => "4048000",
				//	'max_height' => "2000",
				//	'max_width' => "2000",
					'file_name' => $new_name
				);
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileUpload')) {
					$data = array('upload_data' => $this->upload->data());
					header('Content-Type: application/json');
					//echo json_encode($files);
					$type=explode("image/", $files['type']);
					echo json_encode(array('name'=>$data['upload_data']['file_name']));
//					$filename = $data['upload_data']['file_name'];
//					return $filename;
				} else {
					$error = array('error' => $this->upload->display_errors());
					return $error;
				}
			} else {
				echo "Error code " . $error;
			}
		}


		// Return an empty string to signify success
		echo "";
	}
  public  function convert($chkdt) {
	 
	 $month = substr($chkdt,4,3);
	 if($month == 'Jan') $month = '01';
	 else if($month == 'Feb') $month = '02';
	 else if($month == 'Mar') $month = '03';
	 else if($month == 'Apr') $month = '04';
	 else if($month == 'May') $month = '05';
	 else if($month == 'Jun') $month = '06';
	 else if($month == 'Jul') $month = '07';
	 else if($month == 'Aug') $month = '08';
	 else if($month == 'Sep') $month = '09';
	 else if($month == 'Oct') $month = '10';
	 else if($month == 'Nov') $month = '11';
	 else if($month == 'Dec') $month = '12';
	 
	 $date = substr($chkdt,7,3);
	 $year = substr($chkdt,10,5);
	 $finaldt = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
	 return $finaldt;
  }

}