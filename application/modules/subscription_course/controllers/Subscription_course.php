<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Subscription_course extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('subscription_model','model');
        $this->load->model('studentregister/studentregister_model','st_model');
        $this->load->model('comman/common_model','common_model');

        if($this->session->userid == "")
        {
            redirect('studentlogin');
        }

    }
    function index() {
      

        $data=array(
            'title'=>'Try for Learn Pvt.Ltd.',
            'mode'=>'frontend',
            'course'=>$this->model->get_subscribed_course(),
            'form_url'=>base_url().'subscription_course/submit_course_enroll/'.$this->session->userdata('userid'),
            'istemp'=>$this->session->userdata('istemp'),
            'istrialsubscribed'=>$this->session->userdata('istrialsubscribed'),

           
         );
         $data['level']=$this->common_model->getRows('level',array('is_active'=>1,'is_payable'=>1),'*','level_id');

        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'list',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);


        
        
    }
    function getclass()
    {
      $data=$this->common_model->getRows('class',array('is_active'=>1,'levelid'=>$_POST['levelid']),'*','classid');
      $html='<option value="-1">Select Class</option>';
      if (count($data)>0) {
      
        foreach($data as $key)
        {
          $html .="<option value='".$key->classid."'>".$key->name."</option>";
        }
               //var_dump($html);exit;
        $validator['success'] = true;
        $validator['html'] = $html;
        $validator['messages'] = "Data Available";
      } else {
        $validator['success'] = false;
        $validator['html'] = $html;
        $validator['messages'] = "No any Class Available";
      }
      echo json_encode($validator);
    }
  
    
    function getpackagerate()
    {
      $data=$this->common_model->getRows('subject',array('is_active'=>1,'subject_id'=>$_POST['subjectid']),'*,1monthsprice as onemonth,3monthsprice as threemonth,6monthsprice as sixmonth,1yearprice as oneyear','subject_id');
      $newdata=$data[0];
      $html='<option value="-1">Select Package</option>';
      $html .='<option value="1month">1 month Package [ Rs. '.$newdata->onemonth.' ]</option>';
      $html .='<option value="3month">3 month Package [ Rs. '.$newdata->threemonth.' ]</option>';
      $html .='<option value="6month">6 month Package [ Rs. '.$newdata->sixmonth.' ]</option>';
      $html .='<option value="1year">1 year Package [ Rs. '.$newdata->oneyear.' ]</option>';
      
  
      $validator['success'] = true;
      $validator['html'] = $html;
      $validator['messages'] = "Data Available";
      echo json_encode($validator);
    }
    function getsubject()
    {
      $post=$_POST;
      
      if((int)$post['classid']<1)
      {
        echo(json_encode(array('type'=>'failure','message' => 'Please Select Valid Class')));
        exit;
      }
  
           $data=$this->common_model->getRows('subject',array('is_active'=>1,'classid'=>$_POST['classid'],'toshow'=>1),'*','subject_id');

          
      $html=' <option>Please Select</option>';
      foreach($data as $list)
      {
        $html .='<option value="'.$list->subject_id.'">'.$list->subject_name.'</option>';
      }
      echo(json_encode(array('type'=>'success','data' => $sub,'html'=>$html)));
  
  
      }

      function purchasecourse()
      {
        $isdemo='N';
        if($this->session->userdata('istemp')=='Y' && $this->session->userdata('istrialsubscribed')=='N')
        {
          $isdemo='Y';
        }
        $this->load->library('form_validation');
        $this->load->helper('cms_helper');
        $this->form_validation->set_rules('class', 'Course type', 'required');
        $this->form_validation->set_rules('classid', 'Class', 'required');
        $this->form_validation->set_rules('subjectid', 'Subject', 'required');
        if($isdemo=='N')
        {
          $this->form_validation->set_rules('package', 'Package', 'required');

        }
        if ($this->form_validation->run() == FALSE)
        {
          $res = ["message"=>validation_errors(),"type"=>false];

          echo json_encode($res);
          exit;
          
        }

        if($isdemo=='N')
        {

        
          $data=$this->common_model->getRows('subject',array('is_active'=>1,'subject_id'=>$_POST['subjectid']),'*,1monthsprice as onemonth,3monthsprice as threemonth,6monthsprice as sixmonth,1yearprice as oneyear','subject_id');
          $newdata=$data[0];
          if($_POST['package']=='1month')
          {
            $payamt=$newdata->onemonth;
          }
          else if($_POST['package']=='3month')
          {
            $payamt=$newdata->threemonth;
          }
          else if($_POST['package']=='6month')
          {
            $payamt=$newdata->sixmonth;
          }
          else if($_POST['package']=='1year')
          {
            $payamt=$newdata->oneyear;
          }
        
        }
        else
        {
          $payamt='0';
        }

        if((int)$payamt<1  && $isdemo=='N')
        {
          $res = ["message"=>'Sorry! Could not process Now.',"type"=>false];

          echo json_encode($res);
          exit;
        }

        $discountamt=0;
                // voucher code condtn
                if(isset($_POST['vouchercode']) && $_POST['vouchercode']!='')
                {
                    //$vouchercode=$this->common_model->getRows('vouchercode',array('vouchercode'=>$_POST['vouchercode'],'levelid'=>$_POST['levelid'],'classid'=>$_POST['classid'],'subjectid'=>$_POST['subjectid']),'*','vouchercode');
                   
                    // if(count($vouchercode) < 1)
                    // {
                    //  throw new Exception("Voucher Code didnt matched", 1);
                     
                    // }

                    // $discountamt=$vouchercode[0]->discountamount;

                    // $vouchercode=$this->subsmodel->validatevouchercode();
                    // upper modal not registered in constructer
                    $vouchercode=$this->model->validatevouchercode();
                    
                    if(isset($vouchercode['data']))
                    {
                        $voucherdata=$vouchercode['data'];

                        if($voucherdata->discounttype=='p')
                        {

                            $percent=$voucherdata->discountamount/100;
                            $discountamt=$percent*$payamt;
                        }
                        else
                        {
                            $discountamt=$voucherdata->discountamount;
                        }


                    }
                    else
                    {

                        throw new Exception($vouchercode, 1);

                    }
                  

                }
                //voucher code condtn end

        $txn='TFLPC'.time();
        $check_txn=$this->common_model->getRows('transactions',array('productcode'=>$txn),'*','tid');
        if(count($check_txn)>0)
        {
          $txn=$txn.$this->session->userdata('userid');
        }

        $payamt=$payamt-$discountamt;

        $insert=array(
          'productcode'=>$txn,
          'payamount'=>$payamt,
          'status'=>'P',
          'studentid'=>$this->session->userdata('userid'),
          'requestfrom'=>'Khalti',
          'ipaddr'=>get_client_ip(),'discountamount'=>$discountamt,
          'fullamount'=>$payamt + $discountamt,
          'vouchercode'=>(isset($_POST['vouchercode']))?$_POST['vouchercode']:''
        );

        if($isdemo=='Y')
        {
          $insert['requestfrom']='FREE';
        }
        $iu=$this->common_model->insert('transactions',$insert);
        if ($iu>0) {
          $validator['res']=array('txnid'=>$iu,'txncode'=>$txn,'levelid'=>$_POST['class'],'classid'=>$_POST['classid'],'subjectid'=>$_POST['subjectid'],'amt'=>$payamt,'package'=>$_POST['package']);

          $validator['type'] = 'success';
          $validator['message'] = "Success.";
        } else {
          $validator['type'] = false;
          $validator['message'] = "Something went wrong.";
            }
            echo json_encode($validator);
            if($isdemo=='Y')
            {
              $_POST['txnid']=$iu;
              $_POST['levelid']=$_POST['class'];
              $this->confirmsubscribtion();
            }
            exit;
      }
      function updatetransaction()
      {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('txncode', 'Transaction', 'required');
        if ($this->form_validation->run() == FALSE)
        {
          $res = ["message"=>validation_errors(),"type"=>false];
    
          echo json_encode($res);
          exit;
          
        }
        $iu=$this->common_model->update('transactions',array('token'=>$_POST['token']),array('productcode'=>$_POST['txn']));
        if ($iu>0) {

          $validator['type'] = 'success';
          $validator['message'] = "Success.";
        } else {
          $validator['type'] = false;
          $validator['message'] = "Something went wrong.";
            }
            echo json_encode($validator);


      }
      function confirmsubscribtion()
	{

        $isdemo='N';
        if($this->session->userdata('istemp')=='Y' && $this->session->userdata('istrialsubscribed')=='N')
        {
          $isdemo='Y';
          $_POST['amt']='0';
        }
		$this->load->library('form_validation');
		$this->form_validation->set_rules('levelid', 'Level', 'required|greater_than[0]');
		$this->form_validation->set_rules('classid', 'Class', 'required|greater_than[0]');
		$this->form_validation->set_rules('subjectid', 'Subject', 'required|greater_than[0]');
    if($isdemo=='N')
    {
      $this->form_validation->set_rules('package', 'Package', 'required');

    }
		$this->form_validation->set_rules('txnid', 'Transaction', 'required');
		$this->form_validation->set_rules('amt', 'Amount', 'required');
    
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
	
	
    $this->db->trans_begin();
    $this->common_model->update('transactions',array('status'=>'S'),array('tid'=>$_POST['txnid']));
    // check previous paid subscription if date is greater than now : then add on that date: if less than beignning date is now and add date on now

    $check_previous=$this->common_model->getRows('student_enroll',array('classid'=>$_POST['classid'],'subjectid'=>$_POST['subjectid'],'end_date>='=>date('Y-m-d')),'*','end_date desc');
    if(count($check_previous)>0)
    {
      $prev_subs=$check_previous[0];
      $startdate=$prev_subs->end_date;

    }
    else
    {
      $startdate=date('Y-m-d');
    }

    if($isdemo=='N')
    {

    
    if($_POST['package']=='1month')
		{
			$feepackage='One Month';
			$enddate=date('Y-m-d', strtotime("+1 months", strtotime($startdate)));

		}
		else if($_POST['package']=='3month')
		{
			$feepackage='Three Month';
			$enddate =date('Y-m-d', strtotime("+3 months", strtotime($startdate)));

		}
		else if($_POST['package']=='6month')
		{
			$feepackage='Six Month';
			$enddate =date('Y-m-d', strtotime("+6 months", strtotime($startdate)));

		}
		else if($_POST['package']=='1year')
		{
			$feepackage='One Year';
			$enddate =date('Y-m-d', strtotime("+1 year", strtotime($startdate)));

    }

   }
   else
   {
    $feepackage='Two Days';
			$enddate =date('Y-m-d', strtotime("+2 days", strtotime($startdate)));
   }
		$insert_enroll=array(
			'userid'=>$this->session->userdata('userid'),
			'levelid'=>$_POST['levelid'],
			'classid'=>$_POST['classid'],
			'subjectid'=>$_POST['subjectid'],
			 'start_date'=>$startdate,
			 'end_date'=>$enddate,
			 'current_status'=>1,
			 'is_active'=>1
		);
		
		$enrollid=$this->common_model->insert('student_enroll',$insert_enroll);
		$sfee=array(
			'student_id'=>$this->session->userdata('userid'),
			'student_enroll_id'=>$enrollid,
			'levelid'=>$_POST['levelid'],
			'classid'=>$_POST['classid'],
			'subjectid'=>$_POST['subjectid'],
			'feepackage'=>$feepackage,
			'paid_amount'=>$_POST['amt'],
			 'paid_date'=>date('Y-m-d'),
			 'is_paid'=>1,
			 'issued_by'=>$this->session->userdata('userid'),
			 'issued_date'=>date('Y-m-d'),
			 'transactionid'=>$_POST['txnid'],
			 'frompage'=>'STUDENT'
		);
		$this->common_model->insert('student_fee',$sfee);

    if($isdemo=='Y')
    {
      $this->common_model->update('users',array('istrialsubscribed'=>'Y'),array('user_id'=>$this->session->userdata('userid')));

    }
		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
				$iu=0;
		}
		else
		{
				$this->db->trans_commit();
				$iu=1;
		}
		if ($iu>0) {

			$validator['type'] = 'success';
			$validator['message'] = "Success.";

      if($isdemo=='Y')
      {
        $this->session->set_userdata('istrialsubscribed','Y');
  
      }

		} else {
			$validator['type'] = false;
			$validator['message'] = "Something went wrong.";
        }

        if($isdemo=='N')
        {
          echo json_encode($validator);
          exit;
        }
        
  }
  function updatetoken()
  {
    
    $iu=$this->common_model->update('transactions',array('token'=>$_POST['token'],'paidamount'=>$_POST['newamt']),array('tid'=>$_POST['txnid']));
    if ($iu>0) {

			$validator['type'] = 'success';
			$validator['message'] = "Success.";
		} else {
			$validator['type'] = false;
			$validator['message'] = "Something went wrong.";
        }
        echo json_encode($validator);

  }
  function khaltiverify()
	{
		
		$args = http_build_query(array(
			'token' => $_POST['token'],
			'amount'  => $_POST['amt']
		));
		
		$url = "https://khalti.com/api/v2/payment/verify/";
		
		# Make the call using API.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$headers = ['Authorization: Key live_secret_key_4ea0ebad6c8d48518f6a7d1c62e6a061'];
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		// Response
		$response = curl_exec($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		echo $response;

	}

    function submit_course_enroll($st_id)
    {
      if($this->input->post('pid1')=='UNI')
      {
        $subject_id=$this->input->post('unisid');
      }
      else{
        $subject_id=$this->input->post('scid');
      }
      
      if($subject_id=="")
      {
        $this->session->set_flashdata('success',"");
        $this->session->set_flashdata('error',"No Subject Choosen");
        redirect(base_url()."subscription_course");

      }
      else
      {
        $this->st_model->student_enroll($st_id,$subject_id);
        $this->session->set_flashdata('error',"");
            $this->session->set_flashdata('success',"Your selected Course has been registered.Please wait for the approval");
            redirect(base_url()."subscription_course");
        }
    }

  
    
   
}
