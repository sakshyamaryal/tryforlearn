<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Exercise extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('comman/common_model','common_model');
		$this->load->model('exercise_model','model');
		$this->load->model('clas/class_model','classmodel');

		if($this->session->adminuserid == "")
        {
			//for live
			//$result = substr($_SERVER['REQUEST_URI'],1);

			$result = substr($_SERVER['REQUEST_URI'], 6);

			$this->session->set_userdata('currentevent',$result);
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
			'title' => 'Exercise List',
		);
        $data['group']=$this->common_model->getRows('questiongroup',array('is_active'=>1),'*','groupname');
		if($_GET['l']=='p' || $_GET['l']=='i')
		$showclass='N';
		else
		$showclass='Y';

		if(@$_GET['t']=='N')
		$qtype='N';
		else
		$qtype='Y';

		if($showclass=='Y')
		{
			$data['class']=$this->common_model->getRows('class',array('is_active'=>1,'levelid'=>$getlevel),'*','classid');
            $data['chapter']=array();
		}else
		{
			$data['chapter']=$this->common_model->getRows('chapter',array('is_active'=>1,'levelid'=>$getlevel),'*','chaptername');

		}
		$data['examtype']=$this->common_model->getRows('examtype',array(),'*','examtypename');


		$data['showclass']=$showclass;
		$data['levelid']=$getlevel;
		$data['qtype']=$qtype;
		$this->session->set_userdata('qtype',$qtype);

		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
	}
	public function addnew($classid,$subject,$chapter,$group,$examtype)
	{
		// $this->load->helper('ckeditor_helper');

		// $this->load->library('CKEditor');
		//  $this->load->library('CKFinder');
		//  $this->ckeditor->basePath = base_url().'assets/ckeditor/';
	
		// $this->ckeditor->config['width'] = '1030px';
		// $this->ckeditor->config['height'] = '300px';
 
 		// //Add Ckfinder to Ckeditor
 		// $this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/'); 
		$data = array(
			'title' => 'Add Exercise ',
			'classid'=>$classid,
			'subjectid'=>$subject,
			'chapterid'=>$chapter,
			'groupid'=>$group,
			'examtype'=>$examtype
		);
       
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'exercise',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);

	}
  
    public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('qntype', 'Type', 'required');
		//$this->form_validation->set_rules('fordate', 'Is For Date', 'required');
		//$this->form_validation->set_rules('istimer', 'IS Timer', 'required');
		$this->form_validation->set_rules('question', 'Question', 'required');
		if($this->input->post('qntype')=='N')
		{
			$this->form_validation->set_rules('option1', 'Atleast Two Option', 'required');
			$this->form_validation->set_rules('option2', 'Atleast Two Option', 'required');

		}

		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
         $data=array(
			
			 'is_subj_obj'=>$_POST['qntype'],
			 'question'=>$_POST['question'],
			 'explanation'=>trim($_POST['explanation']),
			 'question_nep'=>@$_POST['question_nep'],
			 'explanation_nep'=>trim(@$_POST['explanation_nep']),
			 'is_timer'=>(@$_POST['istimer']!='')?$_POST['istimer']:'Y',
			 'timing'=>(@$_POST['timer']!='')?@$_POST['timer']:0,
			 'is_common'=>(@$_POST['qndate']!='')?'N':'Y',
			 'questiondate'=>(@$_POST['qndate']!='')?@$_POST['qndate']:date('Y-m-d'),
			 'is_active'=>1,
			 'created_at'=>date('Y-m-d H:i:s'),
			 'created_by'=>$this->session->userdata('adminuserid')
		 );
		 $this->db->trans_begin();
		if($_POST['id']>0)
		{
			$this->common_model->update('exercise',$data,array('eid'=>$_POST['id']));
			$iu=$_POST['id'];
			$this->common_model->delete('exercise_option',array('eid'=>$iu));


		}
		else
		{
			$data['levelid']=$this->session->userdata('levelid');

			$data['classid']=(@$_POST['classid']!='')?@$_POST['classid']:0;
			$data['subjectid']=(@$_POST['subjectid']!='')?@$_POST['subjectid']:0;
			$data['chapterid']=(@$_POST['chapterid']!='')?@$_POST['chapterid']:0;
			$data['groupid']=$_POST['groupid'];
			$data['examtypeid']=(@$_POST['examtypeid']!='')?@$_POST['examtypeid']:0;
			$iu=$this->common_model->insert('exercise',$data);
			

		}
		if($_POST['qntype']=='N')
		{
			$correctoption=$correctoption_nep=0;
			for ($x = 1; $x <= 4; $x++) {
				if(strlen(trim($_POST['option'.$x]))>0)
				{
					$option=array(
						'eid'=>$iu,
						'optionname'=>$_POST['option'.$x],
						'optionname_nep'=>$_POST['optionnep'.$x],

						'is_active'=>1
	
					);
					$optionid=$this->common_model->insert('exercise_option',$option);
					if($_POST['coption']==$x)
					{
						$correctoption=$optionid;
					}
					if($_POST['coptionnep']==$x)
					{
						$correctoption_nep=$optionid;
					}

				}
				
				

			}
			$this->common_model->update('exercise',array('correctoption'=>$_POST['coption'],'correctoptionid'=>$correctoption,'correctoption_nep'=>$_POST['coptionnep'],'correctoptionid_nep'=>$correctoption_nep),array('eid'=>$iu));
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
			$validator['message'] = "Success";
			$validator['link']=$_SERVER['HTTP_REFERER'];
		} else {
			$validator['type'] = false;
			$validator['message'] = "Something went wrong.";
		}
		// $this->session->set_flashdata('msg',$validator['message']);
		// redirect($_SERVER['HTTP_REFERER']);

		 echo json_encode($validator);
		 exit;

    }
    
    public function getexercise()
    {
		$where=array('is_active'=>1,'chapterid'=>$_POST['chapter'],'groupid'=>$_POST['group'],'levelid'=>$this->session->userdata('levelid'));

		$this->load->library('form_validation');
		if($_POST['toshow']=='Y')
		{
			$where=array('is_active'=>1,'classid'=>$_POST['class'],'subjectid'=>$_POST['subject'],'chapterid'=>$_POST['chapter'],'groupid'=>$_POST['group'],'levelid'=>$this->session->userdata('levelid'));
		$this->form_validation->set_rules('class', 'Class', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		}
		if($_POST['qtype']=='N')
		{
			unset($where['chapterid']);
			$where['examtypeid']=$_POST['examtypeid'];
			$where['is_common']='N';
		$this->form_validation->set_rules('examtypeid', 'Examtype', 'required');
		}
		else
		{
			$where['is_common']='Y';
			$this->form_validation->set_rules('chapter', 'Chapter', 'required');

		}
		$this->form_validation->set_rules('group', 'Group', 'required');
		

		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $data['exercise']=$this->common_model->getRows('exercise',$where,'*','eid');
        $html=$this->load->view('table',$data,true);

        $res = ["message"=>'Exercise List',"type"=>'success','response'=>$data['topic'],'html'=>$html];

        echo json_encode($res);
        exit;
        

    }
    public function getbyid($id)
    {
// 		$this->load->helper('ckeditor_helper');

// 		$this->load->library('CKEditor');
// 		 $this->load->library('CKFinder');
// 		 $this->ckeditor->basePath = base_url().'assets/ckeditor/';
	
// 		$this->ckeditor->config['width'] = '1030px';
// 		$this->ckeditor->config['height'] = '300px';
		
//  //Add Ckfinder to Ckeditor
//  	$this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/'); 
		$qdata=$this->model->getqnbyid($id);
		//var_dump($qdata);exit;
		$data = array(
			'title' => 'Add Exercise ',
			'sm'=>$qdata,
			
		);
       
		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'exercise',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
        
       
        
    }
    public function delete()
    {
        $this->load->library('form_validation');
		$this->form_validation->set_rules('exercise', 'Exercise', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $iu=$this->common_model->update('exercise',array('is_active'=>0),array('eid'=>$_POST['exercise']));
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
	public function copyquestion()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('qid[]', 'Question', 'required');
		$this->form_validation->set_rules('etype', 'Exam Type', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
		$copyques=$this->model->copyquestion();
		if ($copyques>0) {

			$validator['type'] = 'success';
			$validator['message'] = "Successfully Generated.";
		} else {
			$validator['type'] = false;
			$validator['message'] = "Something went wrong.";
        }
        echo json_encode($validator);
        exit;

	}
	public function getexercisedata($type=false)
    {
		if($type=='true')
		{
			$this->load->library('form_validation');
			if($_POST['toshow']=='Y')
			{
				$where=array('is_active'=>1,'classid'=>$_POST['class'],'subjectid'=>$_POST['subject'],'chapterid'=>$_POST['chapter'],'groupid'=>$_POST['group'],'levelid'=>$this->session->userdata('levelid'));
			$this->form_validation->set_rules('class', 'Class', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			}
			if($_POST['qtype']=='N')
			{
				unset($where['chapterid']);
				$where['examtypeid']=$_POST['examtypeid'];
				$where['is_common']='N';
			$this->form_validation->set_rules('examtypeid', 'Examtype', 'required');
			}
			else
			{
				$where['is_common']='Y';
				$this->form_validation->set_rules('chapter', 'Chapter', 'required');
	
			}
			$this->form_validation->set_rules('group', 'Group', 'required');
			
	
			if ($this->form_validation->run() == FALSE)
			{
				$res = ["message"=>validation_errors(),"type"=>false];
	
				echo json_encode($res);
				exit;
				
			}
			$exercise=$this->common_model->getRows('exercise',$where,'*','eid');$array = array();
		$sn=0;
		foreach($exercise as $key =>$val)
		{
			$sn++;
			$array[$key]['sn']=$sn;
			$array[$key]['question']=$val->question ;
			$array[$key]['explanation']=$val->explanation ;
			$array[$key]['chid']=$val->eid ;
			$array[$key]['is_subj_obj']=($val->is_subj_obj=='Y')?'Subjective' : 'Objective' ;
			$array[$key]['is_common']=($val->is_common=='Y')?'Yes' :'No<br/>'.$val->questiondate;
			$array[$key]['is_timer']=($val->is_timer=='N')?'No' :'Yes<br/>'.$val->timing;
			$array[$key]['chid']=$val->eid ;
			
			$array[$key]['action']='<a class="" href="'.base_url().'exercise/getbyid/'.$val->eid.' " style="color:black;" target="_blank" >
            <i class="fa fa-edit" title="Edit"></i>
            
            </a> |
			
			<a class="" href="javascript:void(0)" onclick="delexercise('.$val->eid.' )" style="color:red;">
            <i class="fa fa-trash" title="Delete"></i>
            
            </a>  ' ;
		}
		
		print_r(json_encode(array('data' => $array)));
	}
	  else
	  {
		$data['post']=$_POST;
		$html=$this->load->view('exercisetable',$data,true);
		$res = ["message"=>'Exercise Table',"type"=>'success','html'=>$html];

		echo json_encode($res);
		exit;
	  }
        

    }
	
}