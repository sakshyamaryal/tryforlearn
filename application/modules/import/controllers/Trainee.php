<?php

class Trainee extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('comman/common_model');
		$this->load->model('trainee_model','model');
		$this->common = $this->common_model;
		ini_set('display_errors',1);
		if($this->session->adminuserid == "")
        {
            redirect('account/admin_login');
		}
		$this->load->library('Excel');


	}

	public function index ()
	{
		$data = array(
			'title' => 'Upload Data',
		);
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'trainee',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
    }
    function importtraineedata()
    {
        $formlink='<a href="'.base_url().'/import/trainee">Return to Import Data</a>';
		$this->db->trans_begin();

		if(isset($_FILES["file"]["name"]))
		{
		$path = $_FILES["file"]["tmp_name"];
		$object = PHPExcel_IOFactory::load($path);
		$i=0;
		foreach($object->getWorksheetIterator() as $worksheet)
		{
			$highestRow = $worksheet->getHighestRow();
			$highestColumn = $worksheet->getHighestColumn();
			$name=$worksheet->getCellByColumnAndRow(1, 2)->getValue();
			

			$cid=$this->model->getcertname($name);
			if((int)$cid < 1)
			{
				echo 'Couldnot Find Certificate Name<br/>'.$formlink;
				exit;
			}
		
		
			for($row=2; $row<=$highestRow; $row++)
			{
				if(@$worksheet->getCellByColumnAndRow(2, $row)->getValue()!='')
				{
                $i++;
				$qs[]=array(
					'certificateid'=>$cid,
					'Title'=>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
					'Name'=>$worksheet->getCellByColumnAndRow(3, $row)->getValue(),
					'Organization'=>$worksheet->getCellByColumnAndRow(4, $row)->getValue(),
					'Phone'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
					'Email'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
					'Citizenship'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
					'Document_Number'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
					'Status'=>'1'
					
				  );
				}
				 
			}
        }
        $this->db->insert_batch('s_certificate',$qs);

		if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				echo 'Couldnot Submit Data<br/>'.$formlink;
				exit;
			}
			else
			{
				$this->db->trans_commit();
				echo $i.' Data Saved Successfully<br/>'.$formlink;
				exit;
			}
		} 
		else
		{
			echo 'No file choosen<br/>'.$formlink;
			exit;
		}
    }
}