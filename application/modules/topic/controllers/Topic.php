<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Topic extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('comman/common_model','common_model');
		$this->load->model('topic_model','model');
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
			'title' => 'Topic List',
		);
		if($_GET['l']=='p' || $_GET['l']=='i')
		$showclass='N';
		else
		$showclass='Y';

		if($showclass=='Y')
		{
			$data['class']=$this->common_model->getRows('class',array('is_active'=>1,'levelid'=>$getlevel),'*','classid');
            $data['chapter']=array();
		}else
		{
			$data['chapter']=$this->common_model->getRows('chapter',array('is_active'=>1,'levelid'=>$getlevel),'*','chaptername');

		}

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
    function getsubjectchapter()
	{
		$post=$_POST;
		if((int)$post['classid']<1)
		{
			echo(json_encode(array('type'=>'failure','message' => 'Please Select Valid Class')));
			exit;
		}
		if((int)$post['subjectid']<1)
		{
			echo(json_encode(array('type'=>'failure','message' => 'Please Select Valid Subject')));
			exit;
		}
        $sub=$this->model->getsubjectchapter($post['classid'],$post['subjectid']);
        
		$html=' <option>Please Select</option>';
		foreach($sub as $list)
		{
			$html .='<option value="'.$list->chapterid.'">'.$list->chaptername.'</option>';
		}
		echo(json_encode(array('type'=>'success','data' => $sub,'html'=>$html)));


    }
    public function save()
	{
		$this->load->library('form_validation');

		if($_POST['toshow']=='Y')
		{
		$this->form_validation->set_rules('class', 'Class', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		}
		$this->form_validation->set_rules('chapter', 'Chapter', 'required');
		$this->form_validation->set_rules('topicname', 'Topic Name', 'required');
		
		$this->form_validation->set_rules('priority', 'Priority', 'required');


		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
         $data=array(
			'classid'=>(@$_POST['class']!='')?@$_POST['class']:0,
			'subjectid'=>(@$_POST['subject']!='')?$_POST['subject']:0,
			 'chapterid'=>$_POST['chapter'],
			 'topicname'=>$_POST['topicname'],
			 'priority'=>$_POST['priority'],

			 'is_active'=>1,
			 'created_at'=>date('Y-m-d H:i:s'),
			 'created_by'=>$this->session->userdata('adminuserid')
		 );
		if($_POST['topicid']>0)
		{
			$iu=$this->common_model->update('topic',$data,array('topicid'=>$_POST['topicid']));

		}
		else
		{
			$iu=$this->common_model->insert('topic',$data);
			

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
    
    public function gettopic()
    {
		$this->load->library('form_validation');
		if($_POST['toshow']=='Y')
		{
		$this->form_validation->set_rules('class', 'Class', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		}
		$this->form_validation->set_rules('chapter', 'Chapter', 'required');
		

		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
		if($_POST['toshow']=='Y')
		{

			$where=array('is_active'=>1,'classid'=>$_POST['class'],'subjectid'=>$_POST['subject'],'chapterid'=>$_POST['chapter']);
		}else
		{
			$where=array('chapterid'=>$_POST['chapter']);

		}
        $data['topic']=$this->common_model->getRows('topic',$where,'*','priority');
        $html=$this->load->view('table',$data,true);

        $res = ["message"=>'Chapter List',"type"=>'success','response'=>$data['topic'],'html'=>$html];

        echo json_encode($res);
        exit;
        

    }
    public function getbyid()
    {
        
        $this->load->library('form_validation');
		$this->form_validation->set_rules('topic', 'Topic', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $ch=$this->common_model->getRows('topic',array('is_active'=>1,'topicid'=>$_POST['topic']),'*','topicname');
        $res = ["message"=>'Topic List',"type"=>'success','topic'=>$ch[0]];

        echo json_encode($res);
        exit;
    }
    public function delete()
    {
        $this->load->library('form_validation');
		$this->form_validation->set_rules('topic[]', 'Topic', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        // $iu=$this->common_model->update('topic',array('is_active'=>0),array('topicid'=>$_POST['topic']));
		$iu = $this->model->updateTopic($this->input->post('topic'));
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
	public function gettopicdata($type=false)
    {
		if($type=='true')
		{
			$this->load->library('form_validation');
			if($_POST['toshow']=='Y')
			{
			$this->form_validation->set_rules('class', 'Class', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			}
			$this->form_validation->set_rules('chapter', 'Chapter', 'required');
			
	
			if ($this->form_validation->run() == FALSE)
			{
				$res = ["message"=>validation_errors(),"type"=>false];
	
				echo json_encode($res);
				exit;
				
			}
			if($_POST['toshow']=='Y')
			{
	
				$where=array('is_active'=>1,'classid'=>$_POST['class'],'subjectid'=>$_POST['subject'],'chapterid'=>$_POST['chapter']);
			}else
			{
				$where=array('chapterid'=>$_POST['chapter']);
	
			}
			$topic=$this->common_model->getRows('topic',$where,'*','priority');	$array = array();
		$sn=0;
		foreach($topic as $key =>$val)
		{
			$sn++;
			$array[$key]['sn']='<input type="checkbox" class="rowCheckBox" data-id="'. $val->topicid .'" />'.$sn;
			$array[$key]['topic']=$val->topicname ;
			$array[$key]['chid']=$val->topicid ;
			
				$array[$key]['action']=' ' ;
			if($this->session->userdata('adminusertype')=='1'|| 
			$this->session->userdata('adminusertype')=='2' || 
			$this->session->userdata('adminusertype')=='7' || 

			$this->session->userdata('adminusertype')=='8' || 
			$this->session->userdata('adminusertype')=='9'):
			$edit=' <a class="" href="javascript:void(0)" style="color:black;" onclick="getedit('.$val->topicid.')" >
            <i class="fa fa-edit" title="Edit"></i>
            
            </a>';
			 if($this->session->userdata('adminusertype')=='7')
			 {
				$array[$key]['action']=$edit; 
			 }
			 else
			 {
				$array[$key]['action']=$edit.'  |
			
				<a class="" href="javascript:void(0)" onclick="delchapter('.$val->topicid.')" style="color:red;">
				<i class="fa fa-trash" title="Delete"></i>
				
				</a>  ' ;
				}
		endif;
		}
		
		print_r(json_encode(array('data' => $array)));
	}
	else
	{
		$data['post']=$_POST;
		 $html=$this->load->view('topictable',$data,true);
		 $res = ["message"=>'Topic Table',"type"=>'success','html'=>$html];

		 echo json_encode($res);
		 exit;
	}
        

    }
	
}