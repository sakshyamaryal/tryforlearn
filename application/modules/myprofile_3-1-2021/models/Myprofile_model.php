<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Myprofile_model extends CI_Model {

    function getlist($sid)
    {
        $sql="select * from users u
          join user_information ui on u.user_id=ui.userid
	
		where user_id=?";
        $res=$this->db->query($sql,array($sid))->row();
       // var_dump($this->db->last_query());exit;
		return $res;

    }
}
