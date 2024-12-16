<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Report extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('comman/common_model','common_model');
		$this->load->model('report_model','model');
		$this->load->model('clas/class_model','classmodel');


		if($this->session->adminuserid == "")
        {
			$this->session->set_userdata('currentevent',$this->uri->segment('1'));
            redirect('account/admin_login');
		}
		if(check_permission($this->uri->segment('1'))=== false)
		{
			echo "SYSTEM EXITED ! You donot Have Permission.";exit();
		}
		
	}

	public function index ()
	{
		if(!$_GET['l'])
		{
			echo "SYSTEM EXITED";
			exit;
		}
		$getlevel=$this->classmodel->getlevel($_GET['l']);
		$this->session->set_userdata('levelid',$getlevel);
		
		$data = array(
			'title' => 'Report List',
		);
		if($_GET['l']=='p' || $_GET['l']=='i')
		$showclass='N';
		else
		$showclass='Y';

		if($showclass=='Y')
		{
			$data['class']=$this->common_model->getRows('class',array('is_active'=>1,'levelid'=>$getlevel),'*','classid');
		}
		$data['examtype']=$this->common_model->getRows('examtype',array(),'*','examtypeid');

		$data['showclass']=$showclass;
		$data['levelid']=$getlevel;
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
    }
    function getreport($type=false)
    {
        if($type=='true')
		{
        $this->load->library('form_validation');
		if($_POST['toshow']=='Y')
		{
			$this->form_validation->set_rules('class', 'Class', 'required|greater_than[0]');
		}
       
        $this->form_validation->set_rules('examtypeid', 'Exam Type', 'required');
        $this->form_validation->set_rules('examtype', 'Exam Category', 'required');
        if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
        }
        $list=$this->model->getreport($_POST);
        $array = array();
		$sn=0;
		foreach($list as $key =>$val)
		{
			$sn++;
			$array[$key]['sn']=$sn;
			$array[$key]['name']=$val->fullname.'<br/>Phone:'.$val->phone.'<br/>Email:'.$val->email ;
			$array[$key]['language']=$val->language ;
			$array[$key]['rank']=$val->rank ;
			$array[$key]['examdate']=$val->examdate ;
			$array[$key]['totalmark']=$val->totalmark ;
			$array[$key]['obtainedmark']=$val->obtainedmark ;
			$array[$key]['percent']=$val->percent ;
			
			$array[$key]['action']=' <a class="" target="_blank" href="'.base_url().'report/getreportpreview?rankid='.$val->id.'&studentid='.$val->studentid.'&levelid='.$val->levelid.'&examtypeid='.$val->examtypeid.'&is_subj_obj='.$val->is_subj_obj.'&classid='.$val->classid.'" style="color:black;"  >
            <i class="fa fa-eye" title="View"></i> View Report
            
            </a>  ' ;
		}
		
		print_r(json_encode(array('data' => $array)));
        }
        else 
        {
            $data['post']=$_POST;
            $html=$this->load->view('reporttable',$data,true);
            $res = ["message"=>'Report Table',"type"=>'success','html'=>$html];

            echo json_encode($res);
            exit;
        }
        
    }
    function syncreport()
    {
        
        $this->load->library('form_validation');
		if($_POST['toshow']=='Y')
		{
			$this->form_validation->set_rules('class', 'Class', 'required|greater_than[0]');
		}
       
        $this->form_validation->set_rules('examtypeid', 'Exam Type', 'required');
        $this->form_validation->set_rules('examtype', 'Exam Category', 'required');
        if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
        }
        $report=$this->model->syncrank($_POST);
        if($report===1)
        {
            $res = ["message"=>'Success',"type"=>'success'];

        }
        else
        {
            $res = ["message"=>'Success',"type"=>false];

        }

        echo json_encode($res);
        exit;
	}
	
	function getreportpreview()
	{
		$data['main']=$this->model->getreportmain($_GET);
		$data['report']=$this->model->getreportpreview($_GET);
		$this->load->view('report',$data);
	}
}