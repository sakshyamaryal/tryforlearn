<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model','model');
        if($this->session->adminuserid == "")
        {
            redirect('account/admin_login');
        }
       

    }
    function index() {
        

        $data=array(
            'title'=>'Dashboard',
            'total_users'=>$this->model->getRows('users',array(),'count(user_id) as total'),
            'active_users'=>$this->model->getRows('users',array('is_active'=>1),'count(user_id) as total'),
            'inactive_users'=>$this->model->getRows('users',array('is_active'=>0),'count(user_id) as total'),
            'approve_users'=>$this->model->getRows('users',array('is_approved'=>1),'count(user_id) as total'),
            'unapprove_users'=>$this->model->getRows('users',array('is_approved'=>0),'count(user_id) as total'),

            'total_students'=>$this->model->getRows('users',array('user_type'=>3),'count(user_id) as total'),
            'active_students'=>$this->model->getRows('users',array('user_type'=>3,'is_active'=>1),'count(user_id) as total'),
            'inactive_students'=>$this->model->getRows('users',array('user_type'=>3,'is_active'=>0),'count(user_id) as total'),
            'approve_students'=>$this->model->getRows('users',array('user_type'=>3,'is_approved'=>1),'count(user_id) as total'),
            'unapprove_students'=>$this->model->getRows('users',array('user_type'=>3,'is_approved'=>0),'count(user_id) as total'),

            'total_programs'=>$this->model->getRows('level',array('is_active'=>1),'count(level_id) as total'),
            'total_category'=>$this->model->getRows('category',array('is_active'=>1),'count(category_id) as total'),
            'total_services'=>$this->model->getRows('service',array('is_active'=>1),'count(service_id) as total'),
            'total_events'=>$this->model->getRows('events',array('is_active'=>1),'count(event_id) as total'),
            'today_events'=>$this->model->getRows('events',array('happening_date'=>date('Y-m-d'),'is_active'=>0),'count(event_id) as total'),
            'total_notice'=>$this->model->getRows('notice',array('is_active'=>1),'count(notice_id) as total'),
            'today_notice'=>$this->model->getRows('notice',array('created_date'=>date('Y-m-d'),'is_active'=>0),'count(notice_id) as total'),

            
            'paid_fees'=>$this->model->getRows('student_fee',array('is_paid'=>1),'sum(paid_amount) as total'),
            'unpaid_fees'=>$this->model->getRows('student_fee',array('is_paid'=>0),'sum(paid_amount) as total'),
            'total_fees'=>$this->model->getRows('student_fee',array(),'sum(paid_amount) as total'),
            'c_paid_fees'=>$this->model->getRows('student_fee',array('is_paid'=>1),'count(paid_amount) as total'),
            'c_unpaid_fees'=>$this->model->getRows('student_fee',array('is_paid'=>0),'count(paid_amount) as total'),


        );
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'dashboard',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);


        
        
    }
}
