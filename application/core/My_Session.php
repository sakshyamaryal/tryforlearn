<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Session extends CI_Session {

public function __construct() {
    parent::__construct();
}

function sess_destroy() {
    $ci =& get_instance();
    if($ci->session->userdata('userid')!=null)
    {
        $user=$ci->session->userdata('userid');
    }
    else if($ci->session->userdata('adminuserid')!=null)
    {
        $user=$ci->session->userdata('adminuserid');
    }
    $ci->db->where('user_id',$user);
    $ci->db->update('users', array('is_login'=>0));

    //call the parent 
    parent::sess_destroy();
}

}