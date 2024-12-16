<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Checkdocument extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('checkdocument_model','model');
    }
    function index()
     {
        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
           
           
           

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>false,
            'body'=>'document',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);

      
            
    }
    function check()
    {
        if($this->input->post('dn')=="" || $this->input->post('dob')=="" || $this->input->post('ed')=="")
        {
            $res = ["message"=>'Please Input All Field',"status"=>false];

        }
       
        else
        {
            $file=$this->model->check();
             if($file !="")
             {
                $res = ["message"=>'You submitted "<b>'. $this->input->post('dn') .'</b>" exist in our Database.',"status"=>true,"file"=>$file];

             }
             else
             {
                $res = ["message"=>'You submitted "<b>'. $this->input->post('dn') .'</b>" doesnot exist in our Database.',"status"=>false];
             }
        }
        echo json_encode($res);
    }

   
    
}
