<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Page extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('page_model','model');
        

    }
    function index() {
        $module=$_GET['mod'];
        $submodule=$_GET['sub'];

        $data=array(
            'title'=>'Try For Learn : Institution for Preparation ',
            'mode'=>'frontend',
            'br1'=>$module,
            'br2'=>$submodule,
          
            'details'=>$this->model->get_detail($module,$submodule),
         

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>false,
            'body'=>'page',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);


        
        
    }

   
}
