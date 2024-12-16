<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Myprofile extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('myprofile_model','model');
		$this->load->model('comman/common_model','common_model');

		if($this->session->userdata('userid') == "")
        {
			$this->session->set_userdata('currentevent',$this->uri->segment('1'));
            redirect('studentlogin');
		}
		
		
    }

    function index()
    {
        $data=array(
            'title'=>'My Profile',
            'mode'=>'frontend',
          
        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'profile',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);

    }

    function getdetail()
    {
        $list=$this->model->getlist($this->session->userdata('userid'));
        $data['list']=$list;
        $html=$this->load->view('profiledetail',$data,true);
        echo json_encode(array('status'=>true,'message'=>'Success','html'=>$html));
        exit;
    }

    function showmodal()
    {
        $data['class']=$this->common_model->getRows('class',array('is_active'=>1),'*','classid');

        $list=$this->model->getlist($this->session->userdata('userid'));
        $data['st']=$list;
        $html=$this->load->view('form',$data,true);
        echo json_encode(array('status'=>true,'message'=>'Success','html'=>$html));
        exit;

    }
    function updatemyprofile()
    {
        $post=$_POST;
        $this->load->library('form_validation');
		$this->form_validation->set_rules('fname', ' Name', 'required');
		$this->form_validation->set_rules('cnum', ' Contact Number', 'required');
		$this->form_validation->set_rules('address', ' Address', 'required');
       
        if($post['email']!='')
        {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');


        }
        if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"success"=>false];

			echo json_encode($res);
			exit;
        }
        $filename='';
		if(!empty($_FILES['file']['name']))
		{
			$config['upload_path']   = './upload/student/'; 
		$config['allowed_types'] = 'gif|png|jpg|jpeg|PNG|JPG|JPEG'; 
		$config['max_size']      = '0'; //4048000
		$config['file_name'] = time();


      	$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		//var_dump($this->upload->data());exit;
		$data=$this->upload->data();
		$filename = $data['file_name'];

		}
        
        $data=array(
			
			'fullname'=>@$post['fname'],
			'email'=>@$post['email'],
			'phone'=>@$post['cnum'],
			'address'=>@$post['address'],
			
			

        );
        if($filename!='')
        $data['image']=$filename;
        $udata=array(
            'parents_detail'=>@$post['parent_detail'],
            'parents_number'=>@$post['parent_number'],
            'guardian_detail'=>@$post['institution'],
            'guardian_number'=>@$post['citizenship'],
            'extra'=>@$post['extra_information'],
        );
      
        $this->db->trans_begin();
       $this->common_model->update('users',$data,array('user_id'=>$this->session->userdata('userid')));
       $this->common_model->update('user_information',$udata,array('userid'=>$this->session->userdata('userid')));
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

                $validator['success'] = true;
                $validator['message'] = "Your Profile is Updated";
            } else {
                $validator['success'] = false;
                $validator['message'] = "Error while inserting the information into the database";
            }
            echo json_encode($validator);
    }
}