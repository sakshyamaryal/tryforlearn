<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Cron_jobs extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('cron_model','model');
    }
    function index()
    {
        var_dump('true');exit();
    }
     
    function refresh_video_lock()
    {
       
        $this->model->change_Status();
        return true;

    }
    function auto_logout()
    { var_dump('here');exit();
        $this->model->logout();
        return true;
    }
}