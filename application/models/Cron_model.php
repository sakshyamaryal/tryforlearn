<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cron_model extends CI_Model {

    function change_Status()
    {
        $this->db->select('*');
        $this->db->from('student_video');
        $this->db->where('end_date',date('Y-m-d'));
        $res=$this->db->get()->result_array();
        if(count($res)> 0)
        {
            foreach($res as $data)
            {
                $update=array (
                    'start_date'=>date('Y-m-d'),
                    'end_date'=>date('Y/m/d', strtotime('+7 days', strtotime(date('Y-m-d')))),

                    'perhitcount'=>0,
                    'is_llocked'=>0

                );
                $this->db->where('student_id',$data['student_id']);
                $this->db->where('videofile_id',$data['videofile_id']);
                $this->db->update('student_video',$update);
            }
        }

    }

    function logout()
    {
        $sql="select user_id,login_datetime from users where is_login=1 and DATE_ADD(login_datetime, INTERVAL 3 HOUR) >=? ";
        $res=$this->db->query($sql,array(date('Y-m-d H:i:s')))->result();
        if(count($res)>0)
        {
            foreach($res as $datal)
            {
                $data=array('is_login=0');
                $this->db->where('user_id',$datal->user_id);
                $this->db->update('users',$data);

            }
        }
        return true;
    }
}