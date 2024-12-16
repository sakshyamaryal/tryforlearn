<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Studentpanel extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('studentpanel_model','model');
        $this->load->model('comman/common_model','common_model');

        if($this->session->userid == "")
        {
            redirect('studentlogin');
        }

    }
    function index__() {
      

        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
            'unlock_course'=>$this->model->get_unlock_course(),
            'lock_course'=>$this->model->get_subscription_course(),
           
          
         

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'panel',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);


        
        
    }
    function index($type=false) {
        $this->session->set_userdata('mode','paid');


        // Check USER SUBSCRIPTION EXPIRED OR NOT :: IF EXPIRED THEN CHANGE STATUS

        $check_subscription=$this->model->checksubscription();

        // CHECK IF USER HAS PAID COURSE OR NOT :: IF YES THEN TRUE ELSE REDIRECT SUBSCRIPTION PAGE
        $chk=$this->model->getsubscription();

        if(count($chk)<1)
        {
            redirect(base_url().'subscription_course');
        }
        
        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
           
        );
        $data['type']=$type;
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'panel',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);

        
    }
    function allcourses() {
        $this->session->set_userdata('mode','free');

      
        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
           
        );
        $data['type']='free';
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'panel',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);

        
    }
    function getsubject()
    {
        $data['course']=$this->model->getsubscription();
        $data['type']='paid';
        $html=$this->load->view('subject',$data,true);
        echo json_encode(array('status'=>true,'message'=>'Success','data'=>$data['course'],'html'=>$html));
        exit;

    }
    function getfreecourse()
    {
        $data['course']=$this->model->getfreecourse();
        $data['type']='free';
        $html=$this->load->view('subject',$data,true);
        echo json_encode(array('status'=>true,'message'=>'Success','data'=>$data['course'],'html'=>$html));
        exit;
    }
    function getchapter()
    {
        if((int)@$_POST['class']>0)
        {
            $chk= $this->model->checksubject_subscription($_POST['class'],$_POST['subject']);
            if(count($chk)<1)
            { 
                 echo json_encode(array('status'=>false,'message'=>'No Subscription on this course'));
             exit;
     
            }
             $data['list']=$this->model->getchapter($_POST['class'],$_POST['subject']);
             $data['mode']='paid';

        }
        else
        {
            $data['list']=$this->model->getfreechapter($_POST['level']);
            $data['mode']='free';


        }
    
        $data['post']=$_POST;
        $html=$this->load->view('chapter',$data,true);
        echo json_encode(array('status'=>true,'message'=>'Success','data'=>$data['list'],'html'=>$html));
        exit;

    }
    function gettopic()
    {
        if((int)@$_POST['class']>0)
        {
        $chk= $this->model->checksubject_subscription($_POST['class'],$_POST['subject']);
        if(count($chk)<1)
        { 
             echo json_encode(array('status'=>false,'message'=>'No Subscription on this course'));
         exit;
 
        }
        $data['list']=$this->model->gettopic('p');
        $data['mode']='paid';

        }
        else
        {
            $data['list']=$this->model->gettopic('f');
            $data['mode']='free';


        }
      
        $data['post']=$_POST;
        $html=$this->load->view('topic',$data,true);
        echo json_encode(array('status'=>true,'message'=>'Success','data'=>$data['list'],'html'=>$html));
        exit;

    }
    function getcontent()
    {
        if((int)@$_POST['class']>0)
        {
        $chk= $this->model->checksubject_subscription($_POST['class'],$_POST['subject']);
        if(count($chk)<1)
        { 
             echo json_encode(array('status'=>false,'message'=>'No Subscription on this course'));
         exit;
 
        }
        $type='p';
        $dtype='paid';
      }
      else
        {
            $type='f';
            $dtype='free';


        }
        $list=$this->model->getcontent($type);
        
        foreach($list as $k => $v) { $data[] = "$v->contentid"; }
        $listid= implode(',', $data);
        $data['post']=$_POST;
        $data['mode']=$dtype;
      $content=$this->common_model->getRows('content',array('contentid'=>$list[0]->contentid),'*','contentid');
    //   if($content[0]->detail=='')
    //   $content[0]->detail=  $content[0]->detail_nep;

    //   if($content[0]->detail_nep=='')
    //   $content[0]->detail_nep=  $content[0]->detail;

      if($this->session->userdata('language')=='NEP')
      {
          $content[0]->title=  $content[0]->title_nep;
          $content[0]->detail=  $content[0]->detail_nep;
      }
    

      $data['content']=$content[0];
      $data['listid']=$listid;
      
        $html=$this->load->view('contentwrapper',$data,true);
        echo json_encode(array('status'=>true,'message'=>'Success','list'=>$data['listid'],'contentid'=>$list[0]->contentid,'data'=>$list,'html'=>$html));
        exit; 
    }
    function changecontent()
    {
         $post=$_POST;
        $content=$this->common_model->getRows('content',array('contentid'=>$post['id']),'title,detail,title_nep,detail_nep','contentid');
        // if($content[0]->detail=='')
        // $content[0]->detail=  $content[0]->detail_nep;
  
        // if($content[0]->detail_nep=='')
        // $content[0]->detail_nep=  $content[0]->detail;
       // var_dump($content);exit;
        
        if($this->session->userdata('language')=='NEP')
        {
            $content[0]->title=  $content[0]->title_nep;
            $content[0]->detail=  $content[0]->detail_nep;
        }

        echo json_encode(array('status'=>true,'message'=>'Success','content'=>$content[0]));
        exit; 
    }
    function getcontentfile()
    {
        $post=$_POST;
        if($post['type']=='f')
        {
            $data['type']='file';

        }
        else if($post['type']=='v')
        {
            $data['type']='video';

        }
        else if($post['type']=='i')
        {
            $data['type']='image';

        }
        $data['list']=$this->common_model->getRows('contentfile',array('contentid'=>$post['id'],'is_active'=>1,'filetype'=>$data['type']),'*','orderby');
        if(count($data['list'])===0)
        {
            echo json_encode(array('status'=>false,'message'=>'<p style="color:red;">No any reference files.</p>'));
            exit;  
        }
        $html=$this->load->view('content',$data,true);

        echo json_encode(array('status'=>true,'message'=>'Success','html'=>$html));
        exit; 

    }
    function getexercise()
    {
        $post=$_POST;
        $data['post']=$post;
        if($post['type']=='exercise')
        {
            
            $data['exer']=$this->model->getexercise($post);
            $html=$this->load->view('exam',$data,true);

        }
        else
        {
            if($_POST['type']=='dataset')
            {
                $_POST['setid']=$_POST['no'];

               $info= $this->model->getdatasetinfo();
               $post['eids']=$info->eids;

            }
            $data['exer']=$this->model->getquiz($post);
            $html=$this->load->view('quiz',$data,true);
        }
        echo json_encode(array('status'=>true,'message'=>'Success','data'=>$data['exer'],'html'=>$html));
        exit; 


    }

    function submitanswer()
    {
        $post=$_POST;
       
        if($post['type']=='exercise')
        {
         $submit=$this->model->submitexerciseanswer($post);
         if($submit===1)
         {
              if($post['from']=='exam')
              {
                  $msg='Your answer has been submitted. Thank you.';
              }
              else
              {
                  $msg='Your answer has been submitted. Thank you.<br/>Practise again ?';
              }
             echo json_encode(array('status'=>true,'message'=>'<p style="color:green;">'.$msg.'</p>'));
             exit; 
         }
         else
         {
             echo json_encode(array('status'=>false,'message'=>'<p style="color:green;">Something went wrong.</p>'));
             exit; 
         }
        }
        else
        {
            $submit=$this->model->submitquizanswer($post);
            if($submit!=0)
            {
                if($submit['percent']<40)
                {
                    $remark='Well Try ';
                }else if($submit['percent']>40 && $submit['percent']<60)
                {
                    $remark='Wow Great Job ';
                }
                else if($submit['percent']>60 && $submit['percent']<70)
                {
                    $remark='Marvelous ';
                }
                else if($submit['percent']>70 && $submit['percent']<80)
                {
                    $remark='Wow Amazing ';
                }
                else if($submit['percent']>80 && $submit['percent']<90)
                {
                    $remark='Superb, Near to Vicotry ';
                }
                else if($submit['percent']>90)
                {
                    $remark='Bravo !! Outstanding Performance';
                }
                else{
                    $remark='Better Luck Next Time';
                }
                if($post['from']=='exam')
              {
                  $msg='<b style="color:green;">'.$remark.' '.$this->session->userdata('fullname').' !</b>';
              }
              else
              {
                  $msg='<b style="color:green;">'.$remark.' '.$this->session->userdata('fullname').' !</b><br/><p ><input type="hidden" id="viewquizans" value="'.base64_encode(serialize($submit)).'"  ><button type="button" class="btn btn-default" style="color:cornflowerblue" id="viewans" onclick="verifyans()" >Verify Answer Here</button> </p><p style="color:blue">Play Again ?</p>';
              }

              $scoretbl='<table style="width:100%">
              <tr>
                <th style="border: 1px solid black;
                border-collapse: collapse;  padding: 10px;
                text-align: left;">Content</th>
                <th style="border: 1px solid black;
                border-collapse: collapse;  padding: 10px;
                text-align: left;">Remarks</th> 
                
              </tr>
              <tr>
                <td style="border: 1px solid black;
                border-collapse: collapse;padding: 10px;
                text-align: left;">Total No.of Ques</td>
                <td style="border: 1px solid black;
                border-collapse: collapse;padding: 10px;
                text-align: right;">'.$submit['totalques'].'</td>
              
              </tr>
              <tr>
              <td style="border: 1px solid black;
              border-collapse: collapse;padding: 10px;
              text-align: left;">Total No.of Attempted Ques</td>
              <td style="border: 1px solid black;
              border-collapse: collapse;padding: 10px;
              text-align: right;">'.$submit['attemptedques'].'</td>
            
            </tr>
            <tr>
            <td style="border: 1px solid black;
            border-collapse: collapse;padding: 10px;
            text-align: left;">Total No.of UnAttempted Ques</td>
            <td style="border: 1px solid black;
            border-collapse: collapse;padding: 10px;
            text-align: right;">'.$submit['unattemptedques'].'</td>
          
          </tr>
          <tr>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: left;">Total No.of Correct Answer</td>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: right;">'.$submit['totalright'].'</td>
        
        </tr>
          <tr>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: left;">Total No.of Wrong Answer</td>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: right;">'.$submit['totalwrong'].'</td>
          
          </tr>
          <tr>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: left;">Total Time</td>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: right;">'.$post['qntimer'].' seconds</td>
      
          </tr>
          <tr>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: left;">Total Submitted Time</td>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: right;">'.$submit['time'].' seconds</td>
  
          </tr>
          <tr>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: left;">Total Obtained Score</td>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: right;">'.$submit['correct'].'</td>
  
          </tr>
          <tr>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: left;">Total Penalty Score</td>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: right;">'.$submit['wrong'].'</td>
  
          </tr>
          <tr>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: left;">Grand Total Score</td>
          <td style="border: 1px solid black;
          border-collapse: collapse;padding: 10px;
          text-align: right;">'.$submit['total'].'</td>
  
          </tr>
              
            </table>';
                echo json_encode(array('status'=>true,'message'=>$msg,'reportable'=>$scoretbl,'ispractise'=>(@$post['isself']=='1')?'Y':'N'));
                exit; 
            }
            else
            {
                echo json_encode(array('status'=>false,'message'=>'<p style="color:green;">Something went wrong.</p>'));
                exit; 
            }

        }
       

    }
    function verifyanswer()
    {
        $decode_value = unserialize(base64_decode($_POST['qn']));
        $data['exer']=$this->model->getattemptquiz($decode_value);
        $data['ans']=$decode_value['ans'];
        $html=$this->load->view('quizanswer',$data,true);
        
        echo json_encode(array('status'=>true,'message'=>'Success','data'=>$data['exer'],'html'=>$html));
        exit; 

    }
    function getexplanation()
    {
        $exp=$this->model->getexplanation();
        if($this->session->userdata('language')=='NEP')
        {
            $expl=$exp->explanation_nep;
        }
        else
        {
            $expl=$exp->explanation;

        }
        $html='<div class="row">
              <div class="col-md-12">
              '.$expl.'
              </div>
        </div>';
        echo json_encode(array('status'=>true,'message'=>'Success','html'=>$html));
        exit; 
    }

    function getdatamodel()
    {
        $data=$this->model->getdatasets();
        if(count($data) > 0)
        {
            $html='<div class="row">';
            foreach($data as $li)
            {
                $html .='<div class="col-md-12">';
                $html .='<a href="javascript:void(0)" class="selectdatasets" data-id="'.$li->setid.'">'.$li->setname.'</a>';
                $html .='</div>';
            }
            $html .='</div>';
            echo json_encode(array('status'=>true,'message'=>'Success','data'=>$data,'html'=>$html));

        }
        else
        echo json_encode(array('status'=>false,'message'=>'No data','data'=>$data));


    }

   
}
