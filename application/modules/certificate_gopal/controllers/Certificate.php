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

    //index controller start
    public function index()
    {
        $data=array(
            'title'=>'Manage Certification',
            // 'load_img'=>base_url().'index/load_img'.$startup->id,
            'trainee'=>$this->model->get_certificate()

        );
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'index',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);

    }


    // function load_img($id=false){
    //         $insert_id = $id;
    //         if($_FILES['cimage']['name']=='')
    //         {
    //             $fileName = $this->input->post('image');
    //         }
    //         else
    //         {
    //           @mkdir('./upload/background/'.$insert_id);
    //             $config['upload_path'] ='./upload/background/'.$insert_id.'/';
    //             $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //             $this->load->model('comman/common_model');

    //             $this->load->library('upload', $config);
               
    //             $this->upload->initialize($config);
    //             $this->upload->do_upload('cimage');
    //             $upload_data  = $this->upload->data();
    //             $fileName  = $upload_data['file_name'];
    //             $this->common_model->compress_image('./upload/background/'.$insert_id.'/'.$fileName, './upload/background/'.$insert_id.'/'.$fileName, 50);
    //         }

    //         if($id==null)
    //         {
    //             $valid= $this->model->save($id=false,$fileName);
    
    //             if($valid==true)
    //             {
    //                 $this->session->set_flashdata('success','Saved Successfully');
        
                   
    //                 redirect($_SERVER['HTTP_REFERER']);
    //             }
    //             else
    //             {
    //                 $this->session->set_flashdata('error','Something Went Wrong. Please Try Again.');
    //                 redirect($_SERVER['HTTP_REFERER']);
    //             }

    //         }
    //         else
    //         {
    //             $valid= $this->model->save($id,$fileName);
    
    //             if($valid==true)
    //             {
    //                 $this->session->set_flashdata('success','Updated Successfully');
        
                   
    //                 redirect($_SERVER['HTTP_REFERER']);
    //             }
    //             else
    //             {
    //                 $this->session->set_flashdata('error','Something Went Wrong. Please Try Again.');
    //                 redirect($_SERVER['HTTP_REFERER']);
    //             }
    //         }
       
    // }


    public function certificate_save()
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
     function getcertificatebyId()
     {
         $data=$this->model->getcertificatebyId();
         $res = ["message"=>'success',"status"=>true,"data"=>$data,'menu_students'=>$this->model->get_certificate()];

                 echo json_encode($res);
     }
     function certificate_update($id)
     {
        $name=$this->input->post('name');
        $org=$this->input->post('org');
        $email=$this->input->post('email');
        // $title=$this->input->post('title');
        // $doc=$this->input->post('doc');
        $phone=$this->input->post('phone');
        $citizen=$this->input->post('citizen');
        $order=$this->input->post('order');
        if($name=="" || $org=="" || $email=="" || $phone=="" || $citizen =="" || $order=="" )
        {
           $res = ["message"=>'invalid',"status"=>false];

           echo json_encode($res);
        }else
        {
            if($this->model->update_certificate($id)==true)
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

     function delete_certificate()
     {
        if($this->model->delete_certificate()==true)
        {
            $res = ["message"=>'success',"status"=>true];

             echo json_encode($res);

        }else
        {
            $res = ["message"=>'failed',"status"=>false];

            echo json_encode($res);
        }

     }

    //index controller end

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
         $doc=$this->input->post('doc');
        $title=$this->input->post('title');
        $phone=$this->input->post('phone');
        $email=$this->input->post('email');
        $citizen=$this->input->post('citizen');
        if($name=="" || $org=="" || $doc=="" || $title=="" || $email=="" || $phone=="" || $citizen =="")
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
        $doc=$this->input->post('doc');
        $title=$this->input->post('title');
        $email=$this->input->post('email');
        $phone=$this->input->post('phone');
        $citizen=$this->input->post('citizen');
        $status=$this->input->post('status');
        if($name=="" || $org=="" || $doc=="" || $title=="" || $email=="" || $phone=="" || $citizen =="" || $status=="" )
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
        if($cname=="" || $tname=="" || $start=="" || $end =="" || $time=="")
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







   // end main  
}
   

    

