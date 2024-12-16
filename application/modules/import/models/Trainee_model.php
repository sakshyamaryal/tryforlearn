<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trainee_model extends CI_Model {
    function getcertname($name)
    {
        $sql="select certificateid from certificate where name like '%".$name."%' ";
        $res=$this->db->query($sql);
        if($res->num_rows() > 0)
        {
            $result=$res->row();
            return $result->certificateid;
        }
        else
        return 0;
    }
}