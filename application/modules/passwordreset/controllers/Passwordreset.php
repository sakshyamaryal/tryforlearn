<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Passwordreset extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('passwordreset_model','model');
        if($this->session->userid == "")
        {
            redirect('studentlogin');
        }
        

    }
    function index() {
      

        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
           
           
          
         

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'reset',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);


        
        
    }

    function update()
    {
        if($this->input->post('password')=="" || $this->input->post('repassword')=="")
        {
            $res = ["message"=>'Please Input All Field',"status"=>false];

        }
        else if($this->input->post('password')!=$this->input->post('repassword'))
        {
            $res = ["message"=>'Password Did not Matched',"status"=>false];
        }
        else
        {
             if($this->model->update()==true)
             {
                $res = ["message"=>'Password has been reset',"status"=>true];

             }
             else
             {
                $res = ["message"=>'Network Error',"status"=>true];
             }
        }
        echo json_encode($res);
    }
    
   
}
