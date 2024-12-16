<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Package extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('package_model');
        $this->model=$this->package_model;
        if($this->session->adminuserid == "")
        {
            redirect('account/admin_login');
        }
        if(check_permission($this->uri->segment('1'))=== false)
		{
			echo "SYSTEM EXITED ! You donot Have Permission.";exit();
		}

    }
    function index() {

        $data=array(
            'title'=>'List Package',
            'package'=>$this->model->get_package()

        );
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'list',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);


        
        
    }

    function add()
    {
        $data=array(
            'title'=>'Add Package',
            'form_url'=>base_url().'package/submit_form',
            'button_name'=>'Submit',
            'button_class'=>'btn btn-primary'

        );
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'add',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);
    }

    function edit($id)
    {
        $data=array(
            'title'=>'Edit Package',
            'form_url'=>base_url().'package/submit_form/'.$id,
            'button_name'=>'Update',
            'button_class'=>'btn btn-success',
            'package'=>$this->model->getById($id)

        );
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'add',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);

    }

    function delete()
    {
       if($this->model->delete_package()==true)
       {
           $res = ["message"=>'success',"status"=>true];

            echo json_encode($res);

       }else
       {
           $res = ["message"=>'failed',"status"=>false];

           echo json_encode($res);

       }

    }
    

    function submit_form($id=false)
    {
        $name = $this->input->post('name');
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Package Name', 'required');
        $this->form_validation->set_rules('descp', 'Package Description', 'required');
       
      

        if ($this->form_validation->run() == FALSE)
        {
            $error=validation_errors();
            $this->session->set_flashdata('error',$error);
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            if($id==null)
            {
                $valid= $this->model->save($id=false);
    
                if($valid==true)
                {
                    $this->session->set_flashdata('success','Saved Successfully');
        
                   
                    redirect($_SERVER['HTTP_REFERER']);
                }
                else
                {
                    $this->session->set_flashdata('error','Something Went Wrong. Please Try Again.');
                    redirect($_SERVER['HTTP_REFERER']);
                }

            }
            else
            {
                $valid= $this->model->save($id);
    
                if($valid==true)
                {
                    $this->session->set_flashdata('success','Updated Successfully');
        
                   
                    redirect($_SERVER['HTTP_REFERER']);
                }
                else
                {
                    $this->session->set_flashdata('error','Something Went Wrong. Please Try Again.');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
       
    }
    }
}
