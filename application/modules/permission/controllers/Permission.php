<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Permission extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('permission_model','model');
        $this->load->model('comman/common_model','common_model');

        if($this->session->adminuserid == "")
        {
            redirect('account/admin_login');
		}
		if(check_permission($this->uri->segment('1'))=== false)
		{
			echo "SYSTEM EXITED ! You donot Have Permission.";exit();
		}
    }

function subject()
    {
        $data=array(
            'title'=>'Subject Permission',
            'level'=>$this->common_model->getRows('level',array('is_active'=>1,'is_payable'=>'1'),'*','name')
            );
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'subject',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);
    }
function getclass()
    {
        $class=$this->common_model->getRows('class',array('is_active'=>1,'levelid'=>$_POST['levelid']),'*','classid');

        $html=' <option>Please Select</option>';
        foreach($class as $list)
        {
            $html .='<option value="'.$list->classid.'">'.$list->name.'</option>';
        }
        echo(json_encode(array('type'=>'success','data' => $sub,'html'=>$html)));
    }
    function getsubjectdata()
    {
       //,'user_type'=>'7','user_type'=>'8'
       $data=$this->common_model->getRows('users',"is_active=1 and user_type in('7','8','9')",'*','fullname');        $subject=$this->common_model->getRows('subject',array('is_active'=>1,'classid'=>$_POST['class']),'*','subject_name');
        $permission=$this->model->subject_permission();
        $html='               <table class="table table-striped table-bordered  responsive">
        <thead>
        <tr>
        <th class="my-th">S.N.</th>
        <th class="my-th">Teacher</th>';
       foreach($subject as $val) : 
        
        $html.='<th class="my-th">'.$val->subject_name.'</th>';
         endforeach; 
        
         $html.='</tr>
        </thead>
        <tbody id="tbody">
        ';
        $check="";
        $sn=0;
        $q='"';
        foreach($data as $val)
        { 
            $sn++;
            $html .= "<tr>
                    <td>".$sn."</td>
                    <td>".$val->fullname."</td>";
                    foreach($subject as $res)
                    { if(isset($permission[$res->subject_id."_".$val->user_id])){
                        if($permission[$res->subject_id."_".$val->user_id]=='1') {
                            $check="checked";
                        }else{
                            $check="";
                        }
                    }else{
                        $check="";
                    }
                    
                        
                        $html .="<td><input type='checkbox' id='check".$val->user_id.$res->subject_id."' onclick='set_permission(".$val->user_id.",".$res->subject_id.")' ".$check."></td>";

                    }

                    $html .="<tr>";
        }
        $html .='</tbody>
        </table>';
        $res = ["message"=>'success',"type"=>'success',"html"=>$html];

        echo json_encode($res);
    }

    function change_subjectpermission()
    {
        $this->model->manage_subjectpermission();
         $res = ["message"=>'success',"status"=>true];

         echo json_encode($res);
    }
    function chapter()
    {
        $data=array(
            'title'=>'Chapter Permission',
            'level'=>$this->common_model->getRows('level',array('is_active'=>1,'is_payable'=>'1'),'*','name')
            );
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'chapter',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);
    }
    function getchapterdata()
    {
       //,'user_type'=>'7','user_type'=>'8'
       $data=$this->common_model->getRows('users',"is_active=1 and user_type in('7','8','9')",'*','fullname');        $chapter=$this->common_model->getRows('chapter',array('is_active'=>1,'classid'=>$_POST['class'],'subjectid'=>$_POST['subject']),'*','priority');
        $permission=$this->model->chapter_permission();
        $html='               <table class="table table-striped table-bordered  responsive">
        <thead>
        <tr>
        <th class="my-th">S.N.</th>
        <th class="my-th">Teacher</th>';
       foreach($chapter as $val) : 
        
        $html.='<th class="my-th">'.$val->chaptername.'</th>';
         endforeach; 
        
         $html.='</tr>
        </thead>
        <tbody id="tbody">
        ';
        $check="";
        $sn=0;
        $q='"';
        foreach($data as $val)
        { 
            $sn++;
            $html .= "<tr>
                    <td>".$sn."</td>
                    <td>".$val->fullname."</td>";
                    foreach($chapter as $res)
                    { if(isset($permission[$res->chapterid."_".$res->subjectid."_".$val->user_id])){
                        if($permission[$res->chapterid."_".$res->subjectid."_".$val->user_id]=='1') {
                            $check="checked";
                        }else{
                            $check="";
                        }
                    }else{
                        $check="";
                    }
                    
                        
                        $html .="<td><input type='checkbox' id='check".$val->user_id.$res->subjectid.$res->chapterid."' onclick='set_permission(".$val->user_id.",".$res->subjectid.",".$res->chapterid.")' ".$check."></td>";

                    }

                    $html .="<tr>";
        }
        $html .='</tbody>
        </table>';
        $res = ["message"=>'success',"type"=>'success',"html"=>$html];

        echo json_encode($res);
    }

    function change_chapterpermission()
    {
        $this->model->manage_chapterpermission();
         $res = ["message"=>'success',"status"=>true];

         echo json_encode($res);
    }
}
