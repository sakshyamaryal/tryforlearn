<?php

class Gallery extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('gallery_model');
		$this->model = $this->gallery_model;
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
			'title' => 'List gallery',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}



	public function get_gallery ()
	{
		$gallerys = $this->model->get_gallery();
		$final_data = array("resource" => $gallerys);
		$final_data["total"] = $this->model->count_all_gallery();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	public function add ()
	{
		$data_arr = array(
			'title' => $_GET['models'][0]['title'],
			'image' => $_GET['models'][0]['gallerImages'],
			'is_active' => $_GET['models'][0]['is_active'],

		);


		if ($this->model->savegallery($data_arr) > 0) {

			$validator['success'] = true;
			$validator['messages'] = "gallery has been save";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while inserting the information into the database";
		}
		echo json_encode($validator);
	}



	public function update ()
	{

		$data_arr = array(
			'title' => $_GET['models'][0]['title'],
			'is_active' => $_GET['models'][0]['is_active'],
		);
		if ($this->model->updateGallery($data_arr, $_GET['models'][0]['gallery_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "gallery has been updated";
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

		if ($this->model->updateGallery($data_arr, $_GET['models'][0]['gallery_id'])) {

			$validator['success'] = true;
			$validator['messages'] = "gallery has been deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	public function removeImage ()
	{
        if($_POST['fileId'] && $_POST['fileId']!=null){
            $this->model->removeImage($_POST['fileId'],$_POST['fileNames']);
        }
		unlink("./upload/gallery/" . $_POST['fileNames']);
		echo json_encode($_POST['fileNames']);
	}
	public function removeUpImage(){

		$this->model->updateFileData();
		echo "";

	}

	public function updloadImage ()
	{
		$_FILES['userfile']['name'] = $_FILES['files']['name'];
		$_FILES['userfile']['type'] = $_FILES['files']['type'];
		$_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'];
		$_FILES['userfile']['error'] = $_FILES['files']['error'];
		$_FILES['userfile']['size'] = $_FILES['files']['size'];
		$config = array(
			'allowed_types' => '*',
			'max_size' => '1000000',
			'overwrite' => FALSE,
			'upload_path' => './upload/gallery',
		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload()) :
			$error = array('error' => $this->upload->display_errors());
			var_dump($error);
			exit;
		else :
			$final_files_data = $this->upload->data();
			$fileName = $final_files_data['file_name'];

            if($_POST['fileId'] && $_POST['fileId']!=null){
                $this->model->uploadImage($_POST['fileId'],$fileName);
            }


//			$this->model->updateFileName($fileName,$_POST['fileId']);
			echo json_encode($fileName);
		endif;

	}


}