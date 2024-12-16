<?php

class Video extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('video_model');
		$this->model = $this->video_model;
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
			'title' => 'List video',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_videos ()
	{
		$videos = $this->model->get_video();
		$final_data = array("resource" => $videos);
		$final_data["total"] = $this->model->count_all_video();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	public function add ()
	{

		$data_arr = array(
			'video_name' => $_GET['models'][0]['video_name'],
			'video_link' =>base_url().'upload/video/'.$_GET['models'][0]['video'],
			'is_active' => $_GET['models'][0]['is_active'],

		);

		if ($this->model->savevideo($data_arr) > 0) {

			$validator['success'] = true;
			$validator['messages'] = "video has been save";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while inserting the information into the database";
		}
		echo json_encode($validator);
	}



	public function update ()
	{

		$data_arr = array(
			'video_name' => $_GET['models'][0]['video_name'],
			'video_link' =>base_url().'upload/video/'. $_GET['models'][0]['video'],
			'is_active' => $_GET['models'][0]['is_active'],

		);

		if ($this->model->updatevideo($data_arr, $_GET['models'][0]['video_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "video has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	public function delete ()
	{

		$data_arr = array(
			'is_active' => 0,

		);

		if ($this->model->updatevideo($data_arr, $_GET['models'][0]['video_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "video has been deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	public function remove ()
	{

		unlink("./upload/video/" . $_POST['fileNames']);
		echo "";
	}

	public function upload ()
	{

		$fileParam = "video";
		$files = $_FILES[$fileParam];

		if (isset($files['name'])) {
			$error = $files['error'];
			if ($error == UPLOAD_ERR_OK) {

				$new_name = time() . $files['name'];
				$config = array(
					'upload_path' => './upload/video',
					'allowed_types' => "*",
					'overwrite' => TRUE,
				// 	'max_size' => "204800000",
//					'file_name' => $new_name
				);
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('video')) {
					$data = array('upload_data' => $this->upload->data());
					header('Content-Type: application/json');
					echo json_encode($files);
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


}