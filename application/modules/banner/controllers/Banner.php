<?php

class Banner extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('banner_model');
		$this->model = $this->banner_model;
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
			'title' => 'List Banner',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_banners ()
	{
		$banners = $this->model->get_banner();
		$final_data = array("resource" => $banners);
		$final_data["total"] = $this->model->count_all_banner();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	public function add ()
	{
		$data_arr = array(
			'banner_name' => $_GET['models'][0]['banner_name'],
			'desc' => $_GET['models'][0]['desc'],
			'image' => $_GET['models'][0]['propertyLogo'],
			'is_active' => $_GET['models'][0]['is_active'],

		);

		if ($this->model->saveBanner($data_arr) > 0) {

			$validator['success'] = true;
			$validator['messages'] = "banner has been save";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while inserting the information into the database";
		}
		echo json_encode($validator);
	}



	public function update ()
	{

		$data_arr = array(
			'banner_name' => $_GET['models'][0]['banner_name'],
			'desc' => $_GET['models'][0]['desc'],
			'image' => $_GET['models'][0]['propertyLogo'],
			'is_active' => $_GET['models'][0]['is_active'],

		);

		if ($this->model->updateBanner($data_arr, $_GET['models'][0]['banner_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "banner has been updated";
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

		$ids = $this->input->post('id') ? $this->input->post('id') : $_GET['models'][0]['banner_id'];

		if ($this->model->updateBanner($data_arr, $ids)) {

			$validator['success'] = true;
			$validator['messages'] = "banner has been deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	public function removeImage ()
	{

		unlink("./upload/banner/" . $_POST['fileNames']);
		echo "";
	}

	public function image ()
	{
		$fileParam = "fileUpload";
		$files = $_FILES[$fileParam];

		if (isset($files['name'])) {
			$error = $files['error'];
			if ($error == UPLOAD_ERR_OK) {

				$new_name = time() . $files['name'];
				$config = array(
					'upload_path' => './upload/banner',
					'allowed_types' => "gif|jpg|png|jpeg|pdf",
					'overwrite' => TRUE,
					'max_size' => "2048000",
				// 	'max_height' => "2000",
				// 	'max_width' => "2000",
//					'file_name' => $new_name
				);
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileUpload')) {
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