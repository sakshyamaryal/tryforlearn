<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class About extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('about_model','model');

    }
    function index() {

        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
          
            'service'=>$this->model->get_service(),
         

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>false,
            'body'=>'about',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);


        
        
    }

   
}
