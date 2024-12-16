<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Sevents extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('sevents_model','model');
        if($this->session->userid == "")
        {
            redirect('studentlogin');
        }

    }
    function index() {
      

        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
            'event'=>$this->model->get_event()
           
         );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'event',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);


        
        
    }

  
    
   
}
