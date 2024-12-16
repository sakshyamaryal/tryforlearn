<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Startup extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('startup_model');
        $this->model=$this->startup_model;
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
        $startup=$this->model->get_startup();

        $data=array(
            'title'=>'Startup Details',
            'startup'=>$startup,
            'form_url'=>base_url().'startup/submit_form/'.$startup->id,
            'button_name'=>'Update',
            'button_class'=>'btn btn-success',

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
       if($this->model->delete_startup()==true)
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

        $this->form_validation->set_rules('name', 'startup Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');

        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('service', 'Service', 'required');
        $this->form_validation->set_rules('teacher', 'Teacher', 'required');
        $this->form_validation->set_rules('course', 'Course', 'required');
        $this->form_validation->set_rules('testomonial', 'Testomonial', 'required');
        $this->form_validation->set_rules('marketing', 'Marketing Line', 'required');

      

        if ($this->form_validation->run() == FALSE)
        {
            $error=validation_errors();
            $this->session->set_flashdata('error',$error);
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            $insert_id = $id;
            if($_FILES['cimage']['name']=='')
            {
                $fileName = $this->input->post('image');
            }
            else
            {
              @mkdir('./upload/company/'.$insert_id);
                $config['upload_path'] ='./upload/company/'.$insert_id.'/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->model('comman/common_model');

                $this->load->library('upload', $config);
               
                $this->upload->initialize($config);
                $this->upload->do_upload('cimage');
                $upload_data  = $this->upload->data();
                $fileName  = $upload_data['file_name'];
                $this->common_model->compress_image('./upload/company/'.$insert_id.'/'.$fileName, './upload/company/'.$insert_id.'/'.$fileName, 50);
            }

            if($id==null)
            {
                $valid= $this->model->save($id=false,$fileName);
    
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
                $valid= $this->model->save($id,$fileName);
    
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
