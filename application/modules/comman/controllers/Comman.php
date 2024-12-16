<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Comman extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('common_model','model');
    }

    function get_notification()
    {
        $notification=$this->model->get_notification();
        if(count($notification)>0)
        {
           $res = ["message"=>'New Notification',"status"=>true,"data"=>$notification,"date"=>date('Y-m-d h:i:s')];

        }
        else
        {
           $res = ["message"=>'No Notification',"status"=>false,"date"=>date('Y-m-d h:i:s')];
        }
   
   echo json_encode($res);
    }
    function count_notification()
    {
        $notification=$this->model->count_notification();
       
           $res = ["message"=>'success',"status"=>true,"data"=>$notification];

        
   
   echo json_encode($res);
    }

    function display_notification()
    {
        $notification=$this->model->get_weekly_notification();
        if(count($notification)>0)
        {
           $res = ["message"=>'New Notification',"status"=>true,"data"=>$notification];

        }
        else
        {
           $res = ["message"=>'No Notification',"status"=>false];
        }
   
   echo json_encode($res);
    }

    function update_status()
    {
        $notification=$this->model->update_status();
        if($notification==true)
        {
           $res = ["message"=>'updated',"status"=>true];

        }
        else
        {
           $res = ["message"=>'Error',"status"=>false];
        }
   
   echo json_encode($res);
    }
}