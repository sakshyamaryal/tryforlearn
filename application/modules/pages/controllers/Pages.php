<?php

class Pages extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('pages_model');
		$this->model = $this->pages_model;
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
			'title' => 'List Pages',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}

	public function add ()
	{
		$data = array(
			'title' => 'Add Page',
			'form_url' => base_url() . 'course/submit_form',
			'button_name' => 'Submit',
			'button_class' => 'btn btn-primary'

		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'add',
			'footer' => 'themes/admin/footer'
		);

		template($view, $data);
	}

	public function get_pages ()
	{
		$pages = $this->model->get_page();
		$final_data = array("resource" => $pages);
		$final_data["total"] = $this->model->count_all_page();
		header('Content-Type: application/json');
		echo trim(json_encode($final_data));
	}


	public function addPage ()
	{
		$fileName = '';
		if ($_FILES['files']["name"] != "") {
			$fileName = $this->common->uploadImage('files');
		} else {
			$fileName = '';
		}
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'page_name' => $_POST['pageName'],
			'description' => $_POST['description'],
			'long_desc' => $_POST['description'],
			'image' => $fileName,
			'is_active' => $_POST['status'],

		);

		if ($this->model->savePage($data_arr)>0) {

			$validator['success'] = true;
			$validator['messages'] = "Page has been save";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while inserting the information into the database";
		}
		echo json_encode($validator);
	}

	function edit($id)
	{
		$data=array(
			'title'=>'Edit Page',
			'page'=>$this->model->getPageById($id)

		);
		$view=array(
			'header'=>'themes/admin/header',
			'sidebar'=>'themes/admin/sidebar',
			'body'=>'edit',
			'footer'=>'themes/admin/footer'
		);
		template($view,$data);
	}

	public function updatePage ()
	{

		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
			'page_name' => $_POST['pageName'],
			'description' => $_POST['description'],
			'long_desc' => $_POST['description'],
			'is_active' => $_POST['status'],

		);
		if ($this->model->updatePage($data_arr,$_POST['id'])) {

			$validator['success'] = true;
			$validator['messages'] = "Page has been updated";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}

	public function uploadImage ()
	{
		if ($_FILES['files']["name"] != "") {
			$fileName = $this->common->uploadImage('files');
		} else {
			$fileName = '';
		}
		$this->model->updateImage($_POST['pageId'],$fileName);

		$files = array();
		$files[] = array('name' => $_FILES['files']['name'], 'size' => $_FILES['files']['type'], 'extension' => $_FILES['files']['size']);
		header('Content-Type: application/json');
		echo json_encode($files);
	}

	public function removeImage ()
	{
		unlink("./upload/page/".$_POST['fileNames']);
		$fileName = '';
//		$this->model->updateImage($_POST['pageId'],$fileName);
		$files = array();
		$files[] = array('name' => $_POST['fileNames']);
		header('Content-Type: application/json');
		echo json_encode($files);
	}
	function delete ()
	{
		$validator = array('success' => false, 'messages' => array());
		$data_arr = array(
		
			'is_active' =>0,

		);
		

		if ($this->model->updatePage($data_arr,$_POST['id'])) {

			$validator['success'] = true;
			$validator['messages'] = "Page has been deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while upding the information into the database";
		}
		echo json_encode($validator);
	}
}