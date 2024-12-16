<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Snotice extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('snotice_model','model');
        if($this->session->userid == "")
        {
            redirect('studentlogin');
        }

    }
    function index() {
      

        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
            'notice'=>$this->model->get_notice()
           
         );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'notice',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);


        
        
    }

  
    
   
}
