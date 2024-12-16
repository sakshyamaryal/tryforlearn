<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Certificate extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Certificate_model');
        $this->model=$this->Certificate_model;
        if($this->session->adminuserid == "")
        {
            redirect('account/admin_login');
    }
    if(check_permission($this->uri->segment('1'))=== false)
    {
      echo "SYSTEM EXITED ! You donot Have Permission.";exit();
    }
    }

    public function student()
    {
        $data=array(
            'title'=>'Student for Certification',
            'students'=>$this->model->get_student()

        );
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'student',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);

    }
    public function student_save()
    {
        $name=$this->input->post('name');
        $org=$this->input->post('org');
        $phone=$this->input->post('phone');
        $email=$this->input->post('email');
        $citizen=$this->input->post('citizen');
        if($name=="" || $org=="" || $email=="" || $phone=="" || $citizen =="")
        {
           $res = ["message"=>'invalid',"status"=>false];

           echo json_encode($res);
        }else
        {
            if($this->model->save_student()==true)
            {
                $res = ["message"=>'success',"status"=>true];

                 echo json_encode($res);

            }else
            {
                $res = ["message"=>'failed',"status"=>false];

                echo json_encode($res);

            }
        }
        
    }
     function getstudentbyId()
     {
         $data=$this->model->getstudentbyId();
         $res = ["message"=>'success',"status"=>true,"data"=>$data,'menu_students'=>$this->model->get_student()];

                 echo json_encode($res);
     }
     function student_update($id)
     {
        $name=$this->input->post('name');
        $org=$this->input->post('org');
        $email=$this->input->post('email');
        $phone=$this->input->post('phone');
        $citizen=$this->input->post('citizen');
        $order=$this->input->post('order');
        if($name=="" || $org=="" || $email=="" || $phone=="" || $citizen =="" || $order=="" )
        {
           $res = ["message"=>'invalid',"status"=>false];

           echo json_encode($res);
        }else
        {
            if($this->model->update_student($id)==true)
            {
                $res = ["message"=>'success',"status"=>true];

                 echo json_encode($res);

            }else
            {
                $res = ["message"=>'failed',"status"=>false];

                echo json_encode($res);

            }
        }
     }

     function delete_student()
     {
        if($this->model->delete_student()==true)
        {
            $res = ["message"=>'success',"status"=>true];

             echo json_encode($res);

        }else
        {
            $res = ["message"=>'failed',"status"=>false];

            echo json_encode($res);
        }

     }
   


   // Course Controller //


   public function course()
    {
        $data=array(
            'title'=>'Course for Certification',
            'courses'=>$this->model->get_course()

        );
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'course',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);

    }
    public function course_save()
    {
        $cname=$this->input->post('cname');
        $tname=$this->input->post('tname');
        $start=$this->input->post('start');
        $end=$this->input->post('end');
        $time=$this->input->post('time');
        if($cname=="" || $tname=="" || $end=="" || $start=="" || $time =="")
        {
           $res = ["message"=>'invalid',"status"=>false];

           echo json_encode($res);
        }else
        {
            if($this->model->save_course()==true)
            {
                $res = ["message"=>'success',"status"=>true];

                 echo json_encode($res);

            }else
            {
                $res = ["message"=>'failed',"status"=>false];

                echo json_encode($res);

            }
        }
        
    }
     function getcoursebyId()
     {
         $data=$this->model->getcoursebyId();
         $res = ["message"=>'success',"status"=>true,"data"=>$data,'menu_courses'=>$this->model->get_course()];

                 echo json_encode($res);
     }
     function course_update($id)
     {
        $cname=$this->input->post('cname');
        $tname=$this->input->post('tname');
        $start=$this->input->post('start');
        $time=$this->input->post('time');
        $end=$this->input->post('end');
        if($name=="" || $tname=="" || $start=="" || $end =="" || $time=="" )
        {
           $res = ["message"=>'invalid',"status"=>false];

           echo json_encode($res);
        }else
        {
            if($this->model->update_course($id)==true)
            {
                $res = ["message"=>'success',"status"=>true];

                 echo json_encode($res);

            }else
            {
                $res = ["message"=>'failed',"status"=>false];

                echo json_encode($res);

            }
        }
     }

     function delete_course()
     {
        if($this->model->delete_course()==true)
        {
            $res = ["message"=>'success',"status"=>true];

             echo json_encode($res);

        }else
        {
            $res = ["message"=>'failed',"status"=>false];

            echo json_encode($res);
        }

     }
   }
   

    

