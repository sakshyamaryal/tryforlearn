<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Certificate extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('comman/common_model','common_model');
        $this->load->model('Certificate_model','model');

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
		
		$data = array(
			'title' => 'Certificate List',
		);

		$view = array(
			'header' => 'themes/admin/header',
			'sidebar' => 'themes/admin/sidebar',
			'body' => 'list',
			'footer' => 'themes/admin/footer'
		);
		template($view, $data);
    }
    
    public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Certificate Title', 'required');
		$this->form_validation->set_rules('name', 'Certificate For', 'required');
		$this->form_validation->set_rules('ccontent', 'Certificate Text', 'required');
		$this->form_validation->set_rules('course', 'Course', 'required');
		$this->form_validation->set_rules('programdate', 'Program Date', 'required');
		if (empty($_FILES['file']['name']) && @$_POST['certificateid']<1
		)
		{
			$this->form_validation->set_rules('file', 'Image', 'required');
		}
		

		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
		}
         $data=array(
			 'name'=>$_POST['name'],
			 'title'=>$_POST['title'],
			 'content'=>$_POST['ccontent'],
			 'course'=>$_POST['course'],
			 'programdate'=>$_POST['programdate'],
			 'footer1'=>$_POST['footer1'],
			 'footer2'=>$_POST['footer2'],
			 'footer3'=>$_POST['footer3'],
			 'footer4'=>$_POST['footer4'],
			 
			 'is_active'=>1,
			 'created_at'=>date('Y-m-d H:i:s'),
			 'created_by'=>$this->session->userdata('adminuserid')
		 );
		 
			$uploadfile = $_FILES['file']['name'];

			$config['upload_path']   = './upload/certificatebg/'; 
		$config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG|PNG'; 
		$config['max_size']      = '0';
		//$config['file_name'] = 'content_'.time();


      	$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		//var_dump($this->upload->data());exit;
		$imgdata=$this->upload->data();
		$filename = $imgdata['file_name'];
		
		if(@$filename!='')
		$data['image']=$filename;
		
		
		if((int)$_POST['certificateid']>0)
		{
			$iu=$this->common_model->update('certificate',$data,array('certificateid'=>$_POST['certificateid']));

		}
		else
		{
			$iu=$this->common_model->insert('certificate',$data);
			

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
    
    
    public function getbyid()
    {
        
        $this->load->library('form_validation');
		$this->form_validation->set_rules('certificate', 'Certificate', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $ch=$this->common_model->getRows('certificate',array('is_active'=>1,'certificateid'=>$_POST['certificate']),'*','certificateid');
        $res = ["message"=>'Certificate List',"type"=>'success','content'=>$ch[0]];

        echo json_encode($res);
        exit;
    }
    public function delete()
    {
        $this->load->library('form_validation');
		$this->form_validation->set_rules('id[]', 'certificate', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$res = ["message"=>validation_errors(),"type"=>false];

			echo json_encode($res);
			exit;
			
        }
        $iu=$this->model->delete_certificate();
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

	
	
	  
    public function getcontentdata($type=false)
    {
		if($type=='true')
		{
        
        $content=$this->common_model->getRows('certificate',array('is_active'=>1),'*','certificateid');
		$array = array();
		$sn=0;
		foreach($content as $key =>$val)
		{
			$sn++;
			$array[$key]['sn']='<input type="checkbox" class="rowCheckBox" data-id="'. $val->certificateid .'" />' . $sn;
			$array[$key]['title']=$val->title ;
			$array[$key]['certficate']=$val->name ;
			$array[$key]['content']=$val->content ;
			$array[$key]['pdate']=$val->programdate ;
			$array[$key]['image']='<img src="'.base_url().'upload/certificatebg/'.$val->image.'" style="width:70%" >' ;
			$array[$key]['chid']=$val->certificateid ;
			
			$array[$key]['action']='
	 <a class="" href="javascript:void(0)" style="color:black;" onclick="getedit('.$val->certificateid.')" >
            <i class="fa fa-edit" title="Edit"></i>
            
            </a> |
			
			<a class="" href="javascript:void(0)" onclick="delcertificate('.$val->certificateid.')" style="color:red;">
            <i class="fa fa-trash" title="Delete"></i>
            
            </a>  ' ;
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
    'img'=> 'upload/certificatebg/', 
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
	
	
	 public function student()
    {
        $data=array(
            'title'=>'Student for Certification',
            'students'=>$this->model->get_student()

        );
     $data['certificate']=$this->common_model->getRows('certificate',array('is_active'=>1),'*','certificateid');
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'student',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);

    }
    public function student_save()
    {
        $name=$this->input->post('name');
        $org=$this->input->post('org');
         $doc=$this->input->post('doc');
        $title=$this->input->post('title');
        $phone=$this->input->post('phone');
        $email=$this->input->post('email');
        $citizen=$this->input->post('citizen');
      $certificateid=$this->input->post('cid');

        if($name=="" || $org=="" || $doc=="" || $title=="" || $email=="" || $phone=="" || $citizen =="" || $certificateid =="")
        {
           $res = ["message"=>'invalid',"status"=>false];

           echo json_encode($res);
        }else
        {
            if($this->model->save_student()==true)
            {
                $res = ["message"=>'success',"status"=>true];

                 echo json_encode($res);

            }else
            {
                $res = ["message"=>'failed',"status"=>false];

                echo json_encode($res);

            }
        }
        
    }
     function getstudentbyId()
     {
         $data=$this->model->getstudentbyId();
         $res = ["message"=>'success',"status"=>true,"data"=>$data,'menu_students'=>$this->model->get_student()];

                 echo json_encode($res);
     }
     function student_update($id)
     {
        $name=$this->input->post('name');
        $org=$this->input->post('org');
        $doc=$this->input->post('doc');
        $title=$this->input->post('title');
        $email=$this->input->post('email');
        $phone=$this->input->post('phone');
        $citizen=$this->input->post('citizen');
        $status=$this->input->post('status');
        if($name=="" || $org=="" || $doc=="" || $title=="" || $email=="" || $phone=="" || $citizen =="" || $status=="" )
        {
           $res = ["message"=>'invalid',"status"=>false];

           echo json_encode($res);
        }else
        {
            if($this->model->update_student($id)==true)
            {
                $res = ["message"=>'success',"status"=>true];

                 echo json_encode($res);

            }else
            {
                $res = ["message"=>'failed',"status"=>false];

                echo json_encode($res);

            }
        }
     }

     function delete_student()
     {
        if($this->model->delete_student()==true)
        {
            $res = ["message"=>'success',"status"=>true];

             echo json_encode($res);

        }else
        {
            $res = ["message"=>'failed',"status"=>false];

            echo json_encode($res);
        }

     }
	
}