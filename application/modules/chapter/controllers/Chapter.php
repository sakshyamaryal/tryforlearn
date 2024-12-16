<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Chapter extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('comman/common_model','common_model');
		$this->load->model('chapter_model','model');
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
			'title' => 'Chapter List',
		);
        $data['class']=$this->common_model->getRows('class',array('is_active'=>1,'levelid'=>$getlevel),'*','classid');
		if($_GET['l']=='p' || $_GET['l']=='i')
		$showclass='N';
		else
		$showclass='Y';

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
    function getsubject()
	{
		$post=$_POST;
		
		if((int)$post['classid']<1)
		{
			echo(json_encode(array('type'=>'failure','message' => 'Please Select Valid Class')));
			exit;
		}

        $sub=$this->model->getsubject($post['classid']);
        
		$html=' <option>Please Select</option>';
		foreach($sub as $list)
		{
			$html .='<option value="'.$list->subject_id.'">'.$list->subject_name.'</option>';
		}
		echo(json_encode(array('type'=>'success','data' => $sub,'html'=>$html)));


    }
    public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('class', 'Class', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('chaptername', 'Chapter Name', 'required');
		$this->form_validation->set_rules('priority', 'Priority', 'required');

		
		if($_POST['toshow']=='Y')
		{
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
	  }
         $data=array(
			 'levelid'=>$_POST['levelid'],
			 'classid'=>(@$_POST['class']!='')?@$_POST['class']:0,
			 'subjectid'=>(@$_POST['subject']!='')?$_POST['subject']:0,
			 'chaptername'=>$_POST['chaptername'],
		     'priority'=>$_POST['priority'],

			 'is_active'=>1,
			 'created_at'=>date('Y-m-d H:i:s'),
			 'created_by'=>$this->session->userdata('adminuserid')
		 );
		if($_POST['chapterid']>0)
		{
			$iu=$this->common_model->update('chapter',$data,array('chapterid'=>$_POST['chapterid']));

		}
		else
		{
			$iu=$this->common_model->insert('chapter',$data);
			

		}
		if ($iu>0) {

			$validator['type'] = 'success';
			$validator['message'] = "Success";
		} else {
			$validator['type'] = false;
			$validator['message'] = "Something went wrong.";
		}
		$this->session->set_flashdata('msg',$validator['message']);
		
		 echo json_encode($validator);
		 exit;

    }
    
    public function getchapter()
    {
        $this->load->library('form_validation');
		$this->form_validation->set_rules('class', 'Class', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		
		if($_POST['toshow']=='Y')
		{
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
        $where=array('is_active'=>1,'classid'=>$_POST['class'],'subjectid'=>$_POST['subject']);
	   }
	   else
	   {
         $where=array('is_active'=>1,'levelid'=>$_POST['levelid']);
	   }
	   $data['chapter']=$this->common_model->getRows('chapter',$where,'*','chaptername');
        $html=$this->load->view('table',$data,true);

        $res = ["message"=>'Chapter List',"type"=>'success','response'=>$data['chapter'],'html'=>$html];

        echo json_encode($res);
        exit;
        

    }
    public function getbyid()
    {
        
        $this->load->library('form_validation');
		$this->form_validation->set_rules('chapter', 'Chapter', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $ch=$this->common_model->getRows('chapter',array('is_active'=>1,'chapterid'=>$_POST['chapter']),'*','chaptername');
        $res = ["message"=>'Chapter List',"type"=>'success','chapter'=>$ch[0]];

        echo json_encode($res);
        exit;
    }
    public function delete()
    {
        $this->load->library('form_validation');
		$this->form_validation->set_rules('chapter', 'Chapter', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $iu=$this->common_model->update('chapter',array('is_active'=>0),array('chapterid'=>$_POST['chapter']));
        if ($iu>0) {

			$validator['type'] = 'success';
			$validator['message'] = "Successfully Removed.";
		} else {
			$validator['type'] = false;
			$validator['message'] = "Something went wrong.";
        }
        echo json_encode($validator);
        exit;


    }
	public function getchapterdata($type=false)
    {
		if($type=='true')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('class', 'Class', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			
			if($_POST['toshow']=='Y')
			{
			if ($this->form_validation->run() == FALSE)
			{
				$res = ["message"=>validation_errors(),"type"=>false];
	
				echo json_encode($res);
				exit;
				
			}
			$where=array('is_active'=>1,'classid'=>$_POST['class'],'subjectid'=>$_POST['subject']);
		   }
		   else
		   {
			 $where=array('is_active'=>1,'levelid'=>$_POST['levelid']);
		   }
		  // $chapter=$this->common_model->getRows('chapter',$where,'*','priority');
		  $chapter=$this->model->getchapter($where);

		$array = array();
		$sn=0;
		foreach($chapter as $key =>$val)
		{
			$sn++;
			$array[$key]['sn']=$sn;
			$array[$key]['chapter']=$val->chaptername ;
			$array[$key]['chid']=$val->chapterid ;
			$array[$key]['action']='';
			$array[$key]['action']='';
			if($this->session->userdata('adminusertype')=='1'|| 
			$this->session->userdata('adminusertype')=='2' || 
			$this->session->userdata('adminusertype')=='7' || 

			$this->session->userdata('adminusertype')=='8' || 
			$this->session->userdata('adminusertype')=='9'):
			$edit=' <a class="" href="javascript:void(0)" style="color:black;" onclick="getedit('.$val->chapterid.')" >
            <i class="fa fa-edit" title="Edit"></i>
            
            </a>';
			 if($this->session->userdata('adminusertype')=='7')
			 {
				$array[$key]['action']=$edit; 
			 }
			 else
			 {
				$array[$key]['action']=$edit.'  |
			
					<a class="" href="javascript:void(0)" onclick="delchapter('.$val->chapterid.')" style="color:red;">
					<i class="fa fa-trash" title="Delete"></i>
					
					</a> ' ;
				}
		endif;
		}
		
		print_r(json_encode(array('data' => $array)));
	 }
	 else 
	 {
		 $data['post']=$_POST;
		 $html=$this->load->view('chaptertable',$data,true);
		 $res = ["message"=>'Chapter Table',"type"=>'success','html'=>$html];

		 echo json_encode($res);
		 exit;
	 }

    }
}