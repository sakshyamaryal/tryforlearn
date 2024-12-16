<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mygrades extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('mygrades_model','model');

		if($this->session->userdata('userid') == "")
        {
			$this->session->set_userdata('currentevent',$this->uri->segment('1'));
            redirect('studentlogin');
		}
		
		
    }

    function index()
    {
        $data=array(
            'title'=>'My Grades',
            'mode'=>'frontend',
            'x'=>0
          
        );
       $data['list']=$this->model->getlist();
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'grades',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);

    }
    function getbytopic()
    {
        $data['list']=$this->model->getlist();
        $data['x']=1;

        $html=$this->load->view('grades',$data,true);
        echo json_encode(array('status'=>true,'html'=>$html));

    }
}