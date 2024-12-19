<?php if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Subscription_model extends CI_Model
{

  function get_subscribed_course()
  {
    if (isset($_POST['isapi'])) {
      $userid = $this->input->get_request_header('Userid', True);
    } else {
      $userid = $this->session->userdata('userid');
    }
    $this->db->select('student_enroll.*,subject.subject_name,level.name as levelname,class.name as classname');
    $this->db->select('DATE_FORMAT(start_date, "%W , %M %e %Y") as sdate');
    $this->db->select('DATE_FORMAT(end_date, "%W , %M %e %Y") as edate');
    $this->db->select('DATE_FORMAT(posteddate, "%W , %M %e %Y") as pdate');
    $this->db->from('student_enroll');
    $this->db->join('subject', 'subject.subject_id=student_enroll.subjectid');
    $this->db->join('class', 'class.classid=student_enroll.classid');
    $this->db->join('level', 'level.level_id=student_enroll.levelid');
    $this->db->where('userid', $userid);
    $this->db->order_by('start_date', 'desc');
    $res = $this->db->get()->result_array();
    return $res;
  }



  function validatevouchercode()
  {
    // first check if this user has used this voucher before or not
    // get vouchercode detail with validating validity date
    // check if quota of limit qty exceeded or not

    $maxlimit = 0;
    $sql = "select * from transactions where studentid=? and vouchercode=? and status='S'";
    $res = $this->db->query($sql, array($this->input->get_request_header('Userid', True), $_POST['vouchercode']));
    if (($res->num_rows()) > 0) {
      return 'Voucher Already Used Before';
    } else {

      // get vouchercode detail with validating validity date
      $sql = "SELECT * FROM vouchercode 
        WHERE vouchercode = ? 
        AND levelid = ? 
        AND classid = ? 
        AND packagetype = ? 
        AND isactive = 1
        AND ? BETWEEN ? AND validtill";
      $res = $this->db->query($sql, array(
        $_POST['vouchercode'],
        $_POST['class'],
        $_POST['classid'],
        $_POST['package'],
        date('Y-m-d'), // Today's date to check if within the range
        date('Y-m-d')  // Starting date for the range (today's date)
      ));


      if (($res->num_rows()) < 1) {
        return 'Voucher code didnt matched';


      } else if (($res->num_rows()) == '1') {
        $voucherdata = $res->row();

        if ($voucherdata->subjectid == $_POST['subjectid']) {
          //subjectid matched
          $maxlimit = $res->row()->maxlimit;

        } else if ($voucherdata->subjectid == '0') {
          //all subjectid case, no need to comapre subject
          $maxlimit = $res->row()->maxlimit;

        } else {
          return 'Voucher Code didnt matched';
        }
      } else {

        $sql = $sql . " and subjectid=?";
        $res = $this->db->query($sql, array($_POST['vouchercode'], $_POST['levelid'], $_POST['classid'], date('Y-m-d'), date('Y-m-d'), $_POST['subjectid']));

        if (($res->num_rows()) < 1) {
          return 'Voucher code didnt matched';
        } else {
          $voucherdata = $res->row();

          // matched
          $maxlimit = $res->row()->maxlimit;

        }

      }

      $loggedInUser = $this->session->userdata('userid');
      if($res->row()->for_gender != 'N'){
        $this->db->select('user_id, gender');
        $this->db->from('users');
        $this->db->where(array('user_id' => $loggedInUser));
        $genderData = $this->db->get();
        // $genderUser = $genderData->num_rows();

        if(!$genderData->row()->gender){
          return 'Please update your gender in profile.';
        }
        else if($genderData->row()->gender != $res->row()->for_gender){
          return 'Not eligible gender';
        }

      }

      if($res->row()->for_disabled == 'Y'){
        $this->db->select('user_id, is_differently_abled, is_disability_approved');
        $this->db->from('users');
        $this->db->where(array('user_id' => $loggedInUser, 'is_differently_abled' => 'Y'));
        $disabledData = $this->db->get();
        $disabledUser = $disabledData->num_rows();

        if($disabledUser < 1){
          return 'Not eligible';
        }
        else if($disabledData->row()->is_differently_abled == 'Y' && $disabledData->row()->is_disability_approved == 'N'){
          return 'Disability verification pending. Not eligible until verified.';
        }

      }


      if ($maxlimit > 0) {

        // check if quota of limit qty exceeded or not
        $sql = "select count(*) as total from transactions where vouchercode=? and status='S'";
        $res = $this->db->query($sql, array($_POST['vouchercode']))->row();
        $total = $res->total;

        if ($total < $maxlimit) {

          return array('data' => $voucherdata);


        } else {
          return 'Voucher Code limit exceeded.';
        }
      }


    }

  }


}