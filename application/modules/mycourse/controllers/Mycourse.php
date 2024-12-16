<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Mycourse extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('mycourse_model','model');
        if($this->session->userid == "")
        {
            redirect('studentlogin');
        }

    }
    function index() {
        $level=@$_GET['level'];
        $subscribed=@$_GET['subscribed'];
        if($level != null)
        {
            
        $data=$this->model->get_chapter($level);
        $view='topic';
        }
        else
        {
            if($subscribed!='1')
            {
                $data=$this->model->get_Uni();
                $view='program';
            }
            else if($subscribed=='-1')
            {
                $data=$this->model->get_class($subscribed);
                $view='subject';
            }
            else
            {
                $data=$this->model->get_class($subscribed=null);
                $view='subject';

            }

        }
      

        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
            'data'=>$data,
            
           
           
          
         

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>$view,
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);


        
        
    }

    function get_file()
    {
        if($this->input->post('topic_id')=="" )
        {
            $res = ["message"=>'Cannot Get',"status"=>false];

        }
       
        else
        {
             if(count($data=$this->model->get_file())>0)
             {
                 $html="";
                 foreach($data as $d)
                 {
                     $file_exp=explode(".",$d['file']);
                    if($file_exp[1]=='pdf')
                    {
                        $preview='&nbsp;&nbsp;&nbsp;<a href='.base_url().'upload/topic/'.$d['file'].' target="_blank">Preview</a>';
                    }
                    else{
                        $preview='';
                    }
                     $html .='<a href='.base_url().'upload/topic/'.$d['file'].' download><i class="fa fa-download"></i>'.$d['file_name'].'</a>'.$preview.'<br><br/>';


                 }
                $res = ["message"=>'success',"status"=>true,"data"=>$data,"html"=>$html,"topicid"=>$this->input->post('topic_id')];

             }
             else
             {
                $res = ["message"=>'No Materials',"status"=>false,"html"=>"","topicid"=>$this->input->post('topic_id')];
             }
            
             if(count($vid=$this->model->get_video($this->input->post('topic_id'))))
             {
                 $html1="";
                 foreach($vid as $data)
                 {
                     $html1 .='<a href='.base_url().'mycourse/playvideo/?vid='.$data['file'].'&fid='.$data['file_id'].'><i class="fa fa-video"></i> '.$data['file_name'].' </a><br><br/>';

                 }
                $res1 = ["message"=>'success',"status"=>true,"data-vid"=>$vid,"html1"=>$html1,"topicid"=>$this->input->post('topic_id')];

             }
             else
             {
                $res1 = ["message"=>'No Video',"status"=>false,"html1"=>"","topicid"=>$this->input->post('topic_id')];
             }
             if(count($other_vid=$this->model->get_other_link_video($this->input->post('topic_id'))))
             {
                 $html2="";
                 foreach($other_vid as $data)
                 {
                     $html2 .='<a href='.base_url().'mycourse/playvideo/?link='.$data['link_video'].'&fid='.$data['file_id'].'><i class="fa fa-video"></i> '.$data['file_name'].'</a><br><br/>';

                 }
                $res2 = ["message"=>'success',"status"=>true,"data-vid2"=>$other_vid,"html2"=>$html2,"topicid"=>$this->input->post('topic_id')];

             }
             else
             {
                $res2 = ["message"=>'No Video',"status"=>false,"html2"=>"","topicid"=>$this->input->post('topic_id')];
             }
             if(count($content=$this->model->get_content())>0)
             {
                 $html3="";
                 foreach($content as $cont)
                 {
                     $html3 .='<a href='.base_url().'mycourse/getcontent/'.$cont['content_id'].'><i class="fa fa-file-signature"> </i> '.$cont['title'].'</a><br><br/>';

                 }
                $res3 = ["message"=>'success',"status"=>true,"data"=>$content,"html3"=>$html3,"topicid"=>$this->input->post('topic_id')];

             }
             else
             {
                $res3 = ["message"=>'No Content',"html3"=>"","status"=>false,"topicid"=>$this->input->post('topic_id')];
             }

             
           
        }
        
        echo json_encode(array_merge($res,$res1,$res2,$res3));
    }

    function get_topic($id)
    {
        $data=$this->model->get_topic($id);

        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
            'data'=>$data,
            
             );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'chapter_topic',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);
    }
    function get_subject($id)
    {
        $data=$this->model->get_subject($id);

        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
            'data'=>$data,
            
             );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'subject',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);
    }

    function vmaterial()
    {
        
        $vid=$this->model->get_video($_GET['tid']);
        $other_vid=$this->model->get_other_link_video($_GET['tid']);

        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
            'vid'=>$vid,
            'othervid'=>$other_vid
            
             );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'video',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);
    }
    function get_v()
    {
        $link=$_SESSION[$_GET['l']];
        
        return base_url().'upload/topic/'.$link;
    }

    function insert_count()
    {
        $data=$this->model->insert_count($this->input->post('id'));
        if($data==true)
             {
                $res = ["message"=>'success',"status"=>true];

             }
             else
             {
                $res = ["message"=>'Network Error',"status"=>false];
             }
             echo json_encode($res);
    }

    function playvideo()
    {
        $vid=@$_GET['vid'];
        $link=@$_GET['link'];
        $fid=@$_GET['fid'];
       $insrt= $this->model->insert_count($fid);
       if($insrt >= 5)
       {
           echo "QUOTA EXCEEDED !";
           exit();
       }

        if($vid != null)
        {
            $video=base_url().'upload/topic/'.$vid ;
            
        }
        else
        {
            $video=$link ;
        }

        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
            'vid'=>$video,
            
            
             );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'playvideo',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);
      
    }

    function getcontent($id)
    {
        $data=array(
            'title'=>'Try for Learn Pvt. Ltd.',
            'mode'=>'frontend',
            'data'=>$this->model->gettopic_content($id),
              );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'content',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);
    }
   
}
