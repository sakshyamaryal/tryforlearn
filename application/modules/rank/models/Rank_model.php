<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rank_model extends CI_Model {

    function getlist()
    {
      if(isset($_POST['isapi']))
    {
      $userid=$this->input->get_request_header('Userid', True);
    }
    else
    {
      $userid=$this->session->userdata('userid');
    }
        $rank="select
        examtypeid, case when is_subj_obj='S' then 'Subjective' else 'Objective' end as examcategory,
        r.levelid,r.classid,l.name as levelname,c.name as classname,is_subj_obj,examdate
        from rank r
        join level l on l.level_id=r.levelid
        left join class c on c.classid=r.classid
        where studentid=?
        group by examtypeid,r.levelid,r.classid,is_subj_obj ";
        $result=$this->db->query($rank,array($userid))->result();
        
        foreach($result as $key => $val)
        {
            $sql="select rank,studentid,u.fullname from rank r join users u on r.studentid=u.user_id
                  where examtypeid=? and levelid=? and classid=? and is_subj_obj=? order by rank asc limit 10";
             $res=$this->db->query($sql,array($val->examtypeid,$val->levelid,$val->classid,$val->is_subj_obj))->result();
             $result[$key]->rank=$res;     

        }
      return $result;

    }
}
