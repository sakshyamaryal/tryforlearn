<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Content extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('comman/common_model','common_model');
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
			'title' => 'Content List',
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
			$data['chapter']=$this->common_model->getRows('chapter',array('is_active'=>1,'levelid'=>$getlevel),'*','priority');

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
    function gettopic()
	{
		$post=$_POST;
		$where=array('is_active'=>1,'chapterid'=>$post['chapterid']);
		if($post['toshow']=='Y')
		{
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
		$where=array('is_active'=>1,'classid'=>$post['classid'],
		'subjectid'=>$post['subjectid'],'chapterid'=>$post['chapterid']
		);
	    }
		if((int)$post['chapterid']<1)
		{
			echo(json_encode(array('type'=>'failure','message' => 'Please Select Valid Chapter')));
			exit;
		}
		$sub=$this->common_model->getRows('topic',$where,'*','priority');
			//var_dump($this->db->last_query());exit;

		$html=' <option>Please Select</option>';
		foreach($sub as $list)
		{
			$html .='<option value="'.$list->topicid.'">'.$list->topicname.'</option>';
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
		$this->form_validation->set_rules('topic', 'Topic', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
// 			$this->form_validation->set_rules('description', 'Description', 'required');
// 		$this->form_validation->set_rules('descriptionnep', 'Description in Nepali', 'required');
		

		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
         $data=array(
			 'levelid'=>$this->session->userdata('levelid'),
			 'classid'=>(@$_POST['class']!='')?@$_POST['class']:0,
			'subjectid'=>(@$_POST['subject']!='')?$_POST['subject']:0,
			 'chapterid'=>$_POST['chapter'],
			 'topicid'=>$_POST['topic'],
			 'title'=>$_POST['title'],
			 		 'title_nep'=>$_POST['titlenep'],
			 'detail'=>$_POST['description'],
			 'detail_nep'=>(isset($_POST['checkbox_copy']) && $_POST['checkbox_copy']=='Y')?$_POST['description']:$_POST['descriptionnep'],
			 'orderby'=>(@$_POST['orderby']!='')?$_POST['orderby']:0,
			 'type'=>(@$_POST['type']=='applet')?'applet':'default',
			 'appletin'=>$_POST['appletin'],
			 'is_active'=>1,
			 'created_at'=>date('Y-m-d H:i:s'),
			 'created_by'=>$this->session->userdata('adminuserid')
		 );
		if((int)$_POST['contentid']>0)
		{
			$iu=$this->common_model->update('content',$data,array('contentid'=>$_POST['contentid']));

		}
		else
		{
			$iu=$this->common_model->insert('content',$data);
			

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
    
    public function getcontent()
    {
		$this->load->library('form_validation');
		$where=array('is_active'=>1,'chapterid'=>$_POST['chapter'],'topicid'=>$_POST['topic']);
		if($_POST['toshow']=='Y')
		{
		$where=array('is_active'=>1,'classid'=>$_POST['class'],'subjectid'=>$_POST['subject'],'chapterid'=>$_POST['chapter'],'topicid'=>$_POST['topic']);

		$this->form_validation->set_rules('class', 'Class', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		}
		$this->form_validation->set_rules('chapter', 'Chapter', 'required');
		$this->form_validation->set_rules('topic', 'Topic', 'required');
		

		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $data['content']=$this->common_model->getRows('content',$where,'*','orderby');
        $html=$this->load->view('table',$data,true);

        $res = ["message"=>'Content List',"type"=>'success','response'=>$data['content'],'html'=>$html];

        echo json_encode($res);
        exit;
        

    }
    public function getbyid()
    {
        
        $this->load->library('form_validation');
		$this->form_validation->set_rules('content', 'Content', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $ch=$this->common_model->getRows('content',array('is_active'=>1,'contentid'=>$_POST['content']),'*','contentid');
        $res = ["message"=>'Content List',"type"=>'success','content'=>$ch[0]];

        echo json_encode($res);
        exit;
    }
    public function delete()
    {
        $this->load->library('form_validation');
		$this->form_validation->set_rules('content', 'Content', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $iu=$this->common_model->update('content',array('is_active'=>0),array('contentid'=>$_POST['content']));
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
	function addfile()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contentid', 'Content', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('filetype', 'Filetype', 'required');
		if($this->input->post('filetype')=='video')
		{
			$this->form_validation->set_rules('link', 'Link', 'required');

		}
		else
		{
				if (empty($_FILES['file']['name']))
			{
				$this->form_validation->set_rules('file', 'Image', 'required');
			}

		}
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}

		$post=$_POST;
		
		$insertdata=array(
			'contentid'=>$post['contentid'],
			'title'=>$post['title'],
			'orderby'=>(@$post['orderby']!='')?$post['orderby']:0,
			'file'=>$post['link'],
			'filetype'=>$post['filetype'],
			'is_active'=>1,
			'created_at'=>date('Y-m-d H:i:s'),
			'created_by'=>$this->session->userdata('adminuserid')

		);
		if($post['filetype']=='file')
		{
			$uploadfile = $_FILES['file']['name'];

			$config['upload_path']   = './upload/content/'; 
		$config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG|PNG|pdf|PDF|doc|DOC|docx|DOCX|xls|xlsx|ppt|pptx|XLS|XLSX|PPT|PPTX'; 
		$config['max_size']      = '0';
		$config['file_name'] = 'content_'.time();


      	$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		//var_dump($this->upload->data());exit;
		$data=$this->upload->data();
		$filename = $data['file_name'];
		$insertdata['file']=$filename;
		$allowed = array('gif','png','jpg','jpeg','PNG','JPG','JPEG');

		$ext = pathinfo($uploadfile, PATHINFO_EXTENSION);
		if (in_array($ext, $allowed)) {
			$insertdata['filetype']='image';
		}
		$insertdata['ext']=$ext;
		}
		$iu=$this->common_model->insert('contentfile',$insertdata);
		if ($iu>0) {

			$validator['type'] = 'success';
			$validator['message'] = "Success.";
		} else {
			$validator['type'] = false;
			$validator['message'] = "Something went wrong.";
        }
        echo json_encode($validator);
        exit;


	}

	function viewfile()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('content', 'Content', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
		$data['content']=$this->common_model->getRows('contentfile',array('is_active'=>1,'contentid'=>$_POST['content']),'*','orderby');
        $html=$this->load->view('filetable',$data,true);

        $res = ["message"=>'File List',"type"=>'success','response'=>$data['content'],'html'=>$html];

        echo json_encode($res);
        exit;
        
		

	}
	public function deletefile()
    {
        $this->load->library('form_validation');
		$this->form_validation->set_rules('fileid', 'File', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $iu=$this->common_model->update('contentfile',array('is_active'=>0),array('fileid'=>$_POST['fileid']));
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
	public function updatefile()
    {
        $this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('orderby', 'Orderby', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $iu=$this->common_model->update('contentfile',array('title'=>$_POST['title'],'orderby'=>$_POST['orderby']),array('fileid'=>$_POST['id']));
        if ($iu>0) {

			$validator['type'] = 'success';
			$validator['message'] = "Successfully Updated.Close and View again to See Changes";
		} else {
			$validator['type'] = false;
			$validator['message'] = "Something went wrong.";
        }
        echo json_encode($validator);
        exit;


	}
	public function getcontentdata($type=false)
    {
		if($type=='true')
		{
			$this->load->library('form_validation');
			$where=array('is_active'=>1,'chapterid'=>$_POST['chapter'],'topicid'=>$_POST['topic']);
			if($_POST['toshow']=='Y')
			{
			$where=array('is_active'=>1,'classid'=>$_POST['class'],'subjectid'=>$_POST['subject'],'chapterid'=>$_POST['chapter'],'topicid'=>$_POST['topic']);
	
			$this->form_validation->set_rules('class', 'Class', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			}
			$this->form_validation->set_rules('chapter', 'Chapter', 'required');
			$this->form_validation->set_rules('topic', 'Topic', 'required');
			
	
			if ($this->form_validation->run() == FALSE)
			{
				$res = ["message"=>validation_errors(),"type"=>false];
	
				echo json_encode($res);
				exit;
				
			}
			$content=$this->common_model->getRows('content',$where,'*','orderby');
		$array = array();
		$sn=0;
		foreach($content as $key =>$val)
		{
			$sn++;
			$array[$key]['sn']=$sn;
			$array[$key]['content']=$val->title ;
			$array[$key]['order']=$val->orderby ;
			$array[$key]['chid']=$val->contentid ;
			
		$array[$key]['action']='<a class="" href="javascript:void(0)" style="color:blue;" onclick="viewcontent('.$val->contentid.' )" >
            <i class="fa fa-eye" title="View Content"></i>
            
            </a> |
			
			<a class="" href="javascript:void(0)" onclick="addfile('.$val->contentid.' )" style="color:green;">
            <i class="fa fa-plus" title="Add Content"></i>
            
            </a>   ' ;
			if($this->session->userdata('adminusertype')=='1'|| 
			$this->session->userdata('adminusertype')=='2' || 
			$this->session->userdata('adminusertype')=='7' || 

			$this->session->userdata('adminusertype')=='8' || 
			$this->session->userdata('adminusertype')=='9'):
			$edit=' |
			<a class="" href="javascript:void(0)" style="color:black;" onclick="getedit('.$val->contentid.' )" >
				   <i class="fa fa-edit" title="Edit"></i>
				   
				   </a>';
			 if($this->session->userdata('adminusertype')=='7')
			 {
				$array[$key]['action'] .=$edit; 
			 }
			 else
			 {
				$array[$key]['action'] .=$edit.'  |
			
				<a class="" href="javascript:void(0)" onclick="delchapter('.$val->contentid.' )" style="color:red;">
				<i class="fa fa-trash" title="Delete"></i>
				
				</a>    ' ;
				}
		endif;
		}
		
		print_r(json_encode(array('data' => $array)));
	}
	else
	{
		$data['post']=$_POST;
		$html=$this->load->view('contenttable',$data,true);
		$res = ["message"=>'Content Table',"type"=>'success','html'=>$html];

		echo json_encode($res);
		exit;
	}
        

    }
		public function ck_upload()
	{
		// Define file upload path 
$upload_dir = array( 
    'img'=> 'upload/content/', 
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
}