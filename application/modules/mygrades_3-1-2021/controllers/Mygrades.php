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
          
        );
       $data['list']=$this->model->getlist($this->curryear);
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'grades',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);

    }
}