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
		$this->session->set_userdata('levelname',$_GET['l']);

		$this->session->set_userdata('qtype',$qtype);

		if($showclass=='Y')
		{
			$data['class']=$this->common_model->getRows('class',array('is_active'=>1,'levelid'=>$getlevel),'*','classid');
            $data['chapter']=array();
		}else
		{
			$data['chapter']=$this->common_model->getRows('chapter',array('is_active'=>1,'levelid'=>$getlevel),'*','chaptername');

		}
		$data['examtype']=$this->common_model->getRows('examtype',array(),'*','examtypename');
		$data['levellist']=$this->common_model->getRows('level',array('is_active'=>1),'*','name');
		$data['dataset']=$this->common_model->getRows('datasetmain',array('is_active'=>1),'*','setname');


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
	public function addnew($classid,$subject,$chapter,$group,$examtype,$topic)
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
			'topicid'=>$topic,
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
			 'question_nep'=>(isset($_POST['copyfield']) && $_POST['copyfield']=='Y')?$_POST['question']:@$_POST['question_nep'],
			 'explanation_nep'=>(isset($_POST['copyfield']) && $_POST['copyfield']=='Y')?trim($_POST['explanation']):trim(@$_POST['explanation_nep']),
			 'is_timer'=>(@$_POST['istimer']!='')?$_POST['istimer']:'Y',
			 'timing'=>(@$_POST['timer']!='')?@$_POST['timer']:0,
			// 'is_common'=>(@$_POST['qndate']!='')?'N':'Y',
			 'is_common'=>((int)$_POST['examtypeid'] > 0)?'N':'Y',
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

			if(isset($_POST['topicid']) && (int)$_POST['topicid'] > 0)
				{
					$data['topicid']=$_POST['topicid'];
				}
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
						'optionname_nep'=>(isset($_POST['copyfield']) && $_POST['copyfield']=='Y')?$_POST['option'.$x]:$_POST['optionnep'.$x],

						'is_active'=>1
	
					);
					$optionid=$this->common_model->insert('exercise_option',$option);
					if($_POST['coption']==$x)
					{
						$correctoption=$optionid;
						$correctoption_nep=$optionid;
					}
					// if($_POST['coptionnep']==$x)
					// {
					// 	$correctoption_nep=$optionid;
					// }

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
				//$where['is_common']='N';
				//$where['is_common']='Y';
			$this->form_validation->set_rules('examtypeid', 'Examtype', 'required');
			}
			else
			{
				//$where['is_common']='Y';
				//$where['is_common']='N';
				$this->form_validation->set_rules('chapter', 'Chapter', 'required');

				if(isset($_POST['topic']) && (int)$_POST['topic'] > 0)
				{
					$where['topicid']=$_POST['topic'];
				}
	
			}

			if(isset($where['examtypeid']) && (int)$where['examtypeid'] > 0)
			{
				$where['is_common']='N';
			}
			else
			{
				$where['is_common']='Y';
			}
			$this->form_validation->set_rules('group', 'Group', 'required');
			
	
			if ($this->form_validation->run() == FALSE)
			{
				$res = ["message"=>validation_errors(),"type"=>false];
	
				echo json_encode($res);
				exit;
				
			}
			
			$exercise=$this->model->getexercise($where);
			//var_dump($this->db->last_query());exit;

			// if($this->session->userdata('adminusertype')=='9')
			// $exercise=$this->model->getexercise($where);
			// else
			// $exercise=$this->common_model->getRows('exercise',$where,'*','eid');
			$array = array();
		$sn=0;
		foreach($exercise as $key =>$val)
		{
			$sn++;
			$array[$key]['sn']=$sn.'<br/><input type="checkbox" name="replicateques[]" class="replicate" value="'.$val->eid.'" />';
			if($val->topicid > 0 && (int)$_POST['topic'] < 1)
			{
				$array[$key]['sn'].='<br/><span class="badge badge-success">Migrated</span>';

			}
			$array[$key]['question']=$val->question ;
			$array[$key]['explanation']=($val->explanation !='')?'<i class="fa fa-check"></i>':'' ;
			$array[$key]['chid']=$val->eid ;
			$array[$key]['is_subj_obj']=($val->is_subj_obj=='Y')?'Subjective' : 'Objective' ;
			$array[$key]['is_common']=($val->is_common=='Y')?'Yes' :'No<br/>'.$val->questiondate;
			$array[$key]['is_timer']=($val->is_timer=='N')?'No' :'Yes<br/>'.$val->timing;
			$array[$key]['chid']=$val->eid ;
			
			
			$array[$key]['action']=' ' ;
			if($this->session->userdata('adminusertype')=='1'|| 
			$this->session->userdata('adminusertype')=='2' || 
			$this->session->userdata('adminusertype')=='7' || 

			$this->session->userdata('adminusertype')=='8' || 
			$this->session->userdata('adminusertype')=='9'):
			$edit=' <a class="" href="'.base_url().'exercise/getbyid/'.$val->eid.' " style="color:black;" target="_blank" >
            <i class="fa fa-edit" title="Edit"></i>
            
            </a>';
			 if($this->session->userdata('adminusertype')=='7')
			 {
				$array[$key]['action']=$edit; 
			 }
			 else
			 {
				$array[$key]['action']=$edit.'  |
			
				<a class="" href="javascript:void(0)" onclick="delexercise('.$val->eid.' )" style="color:red;">
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
		$html=$this->load->view('exercisetable',$data,true);
		$res = ["message"=>'Exercise Table',"type"=>'success','html'=>$html];

		echo json_encode($res);
		exit;
	  }
        

	}
	public function ck_upload()
	{
		// Define file upload path 
$upload_dir = array( 
    'img'=> 'upload/question/', 
); 
 
// Allowed image properties  
$imgset = array( 
    'maxsize' => 20000, 
   // 'maxwidth' => 1024, 
   // 'maxheight' => 800, 
   // 'minwidth' => 10, 
   // 'minheight' => 10, 
    'type' => array('bmp', 'gif', 'jpg', 'jpeg', 'png','GIF', 'JPG', 'JPEG', 'PNG'), 
); 
 
// If 0, will OVERWRITE the existing file 
define('RENAME_F', 1); 
 
/** 
 * Set filename 
 * If the file exists, and RENAME_F is 1, set "img_name_1" 
 * 
 * $p = dir-path, $fn=filename to check, $ex=extension $i=index to rename 
 */ 
function setFName($p, $fn, $ex, $i){ 
    if(RENAME_F ==1 && file_exists($p .$fn .$ex)){ 
        return setFName($p, F_NAME .'_'. ($i +1), $ex, ($i +1)); 
    }else{ 
        return $fn .$ex; 
    } 
} 
 
$re = ''; 
if(isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1) { 
 
    define('F_NAME', preg_replace('/\.(.+?)$/i', '', basename($_FILES['upload']['name'])));   
 
    // Get filename without extension 
    $sepext = explode('.', strtolower($_FILES['upload']['name'])); 
    $type = end($sepext);    /** gets extension **/ 
     
    // Upload directory 
    $upload_dir = in_array($type, $imgset['type']) ? $upload_dir['img'] : $upload_dir['audio']; 
    $upload_dir = trim($upload_dir, '/') .'/'; 
 
    // Validate file type 
    if(in_array($type, $imgset['type'])){ 
        // Image width and height 
        list($width, $height) = getimagesize($_FILES['upload']['tmp_name']); 
 
        if(isset($width) && isset($height)) { 
            // if($width > $imgset['maxwidth'] || $height > $imgset['maxheight']){ 
            //     $re .= '\\n Width x Height = '. $width .' x '. $height .' \\n The maximum Width x Height must be: '. $imgset['maxwidth']. ' x '. $imgset['maxheight']; 
            // } 
 
            // if($width < $imgset['minwidth'] || $height < $imgset['minheight']){ 
            //     $re .= '\\n Width x Height = '. $width .' x '. $height .'\\n The minimum Width x Height must be: '. $imgset['minwidth']. ' x '. $imgset['minheight']; 
            // } 
 
            if($_FILES['upload']['size'] > $imgset['maxsize']*1000){ 
                $re .= '\\n Maximum file size must be: '. $imgset['maxsize']. ' KB.'; 
            } 
        } 
    }else{ 
        $re .= 'The file: '. $_FILES['upload']['name']. ' has not the allowed extension type.'; 
    } 
     
    // File upload path 
    $f_name = setFName($_SERVER['DOCUMENT_ROOT'] .'/'. $upload_dir, F_NAME, ".$type", 0); 
	$uploadpath = $upload_dir . $f_name; 
	

 
    // If no errors, upload the image, else, output the errors 
    if($re == ''){ 
        if(move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)) { 
            $CKEditorFuncNum = $_GET['CKEditorFuncNum']; 
            $url = base_url(). $upload_dir . $f_name; 
            $msg = F_NAME .'.'. $type .' successfully uploaded: \\n- Size: '. number_format($_FILES['upload']['size']/1024, 2, '.', '') .' KB'; 
            $re = in_array($type, $imgset['type']) ? "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>":'<script>var cke_ob = window.parent.CKEDITOR; for(var ckid in cke_ob.instances) { if(cke_ob.instances[ckid].focusManager.hasFocus) break;} cke_ob.instances[ckid].insertHtml(\' \', \'unfiltered_html\'); alert("'. $msg .'"); var dialog = cke_ob.dialog.getCurrent();dialog.hide();</script>'; 
        }else{ 
            $re = '<script>alert("Unable to upload the file'.$uploadpath.'")</script>'; 
        } 
    }else{ 
        $re = '<script>alert("Err.'. $re .'")</script>'; 
    } 
} 
 
// Render HTML output 
@header('Content-type: text/html; charset=utf-8'); 
echo $re;
	}

	function getclassdropdown()
	{
		$data=$this->common_model->getRows('class',array('is_active'=>1,'levelid'=>$_POST['coursetype']),'*','classid');
		$html='<option value="-1">Please Select</option>';
		foreach($data as $li)
		{
			$html .="<option value='".$li->classid."'>".$li->name."</option>";
		}
		echo json_encode(array('type'=>'success','html'=>$html));

	}
	function getchapterdropdown()
	{
		$data=$this->common_model->getRows('chapter',array('is_active'=>1,'levelid'=>$_POST['coursetype']),'*','chaptername');
		$html='<option value="-1">Please Select</option>';
		foreach($data as $li)
		{
			$html .="<option value='".$li->chapterid."'>".$li->chaptername."</option>";
		}
		echo json_encode(array('type'=>'success','html'=>$html));

	}

	function replicatequestions()
	{
		$copyques=$this->model->replicatequestion();
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

	function gettopicdropdown()
	{
		$data=$this->common_model->getRows('topic',array('is_active'=>1,'chapterid'=>$_POST['chapterid']),'*','priority');
		$html='<option value="-1">Please Select</option>';
		foreach($data as $li)
		{
			$html .="<option value='".$li->topicid."'>".$li->topicname."</option>";
		}
		echo json_encode(array('type'=>'success','html'=>$html));

	}

	function migrateques()
	{
		$copyques=$this->model->migratequestion();
		if ($copyques>0) {

			$validator['type'] = 'success';
			$validator['message'] = "Successfully Migrated.";
		} else {
			$validator['type'] = false;
			$validator['message'] = "Something went wrong.";
        }
        echo json_encode($validator);
        exit;
	}

	function addindataset()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('qid[]', 'Question', 'required');
		$this->form_validation->set_rules('dataset', 'Data set', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
		$copyques=$this->model->addindataaset();
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
	
	
}