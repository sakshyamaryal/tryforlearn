<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Rank extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('rank_model','model');

		if($this->session->userdata('userid') == "")
        {
			$this->session->set_userdata('currentevent',$this->uri->segment('1'));
            redirect('studentlogin');
		}
		
		
    }

    function index()
    {
        $data=array(
            'title'=>'Rank',
            'mode'=>'frontend',
          
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
}