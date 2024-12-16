<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Studentprofile extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('studentprofile_model','model');
        if($this->session->userid == "")
        {
            redirect('studentlogin');
        }

    }
    function index() {
      

        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
            'profile'=>$this->model->getProfile(),
            'extra'=>$this->model->getExtra(),
           
          
         

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'profile',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);


        
        
    }

    function update()
    {
        if($this->input->post('name')=="" || $this->input->post('address')=="" ||  $this->input->post('phone')=="" || $this->input->post('email')=="")
        {
            $res = ["message"=>'Please Input All Field',"status"=>false];

        }
        else
        {
             if($this->model->update_profile()==true)
             {
                  $this->session->set_userdata('name',$this->input->post('name'));
                    $this->session->set_userdata('email',$this->input->post('email'));
                $res = ["message"=>'Successfully Updated',"status"=>true];

             }
             else
             {
                $res = ["message"=>'Network Error',"status"=>true];
             }
        }
        echo json_encode($res);
    }
    public function update_extrainfo()
    {
      $pd=$this->input->post('pd');
      $pn=$this->input->post('pn');
      $gd=$this->input->post('gd');
      $gn=$this->input->post('gn');

      if($pd=="" || $pn =="" || $gd=="" || $gn=="")
      {
        $res = ["message"=>'Please Input All Fields',"status"=>false];

       
      }
      else
      {
          $data=$this->model->submit_data();

          if($data==true)
          {
            $res = ["message"=>'Success',"status"=>true];

          }
          else{
            $res = ["message"=>'Failed',"status"=>false];

          }
      }
      echo json_encode($res);


      
        

    }
   
}
