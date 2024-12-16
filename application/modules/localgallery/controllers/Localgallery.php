<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Localgallery extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('localgallery_model','model');

    }
    function index() {

        $data=array(
            'title'=>'Try For Learn : Institution for Preparation; Gallery',
            'mode'=>'frontend',
          
            'gallery'=>$this->model->get_gallery(),
         

        );
        $view=array(
            'header'=>false,
            'sidebar'=>false,
            'body'=>'gallery',
            'footer'=>false

        );
       
        template($view,$data);


        
        
    }

   
}
