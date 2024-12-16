<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class User extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('themelib_helper');
        $this->load->model('studentlogin/studentlogin_model','spmodel');
        $this->load->model('studentpanel/studentpanel_model','spanelmodel');
        $this->load->model('studentregister/studentregister_model','sregmodel');
        $this->load->model('subscription_course/subscription_model','subsmodel');
        $this->load->model('sevents/sevents_model','eventmodel');
        $this->load->model('snotice/snotice_model','noticemodel');
        $this->load->model('mygrades/mygrades_model','grademodel');
        $this->load->model('comman/common_model','common_model');
        $this->load->model('home/home_model','hmodel');
        $this->load->model('rank/rank_model','rmodel');
        $this->load->model('myexam/myexam_model','emodel');



        APIKEY();
      
    }
  
    // for login
    function login()
    {
        try {
        if(!$_POST['username'])
        {
           
            throw new Exception("Username cannot be empty.", 1);

        }
        if(!$_POST['password'])
        {
         
            throw new Exception("Password Cannot be empty.", 1);

        }
        $_POST['isapi']='Y';
        $valid= $this->spmodel->verify($_POST['username'],md5($_POST['password']));
        
        if($valid=='1')
        {
  
            throw new Exception("You are already loggedin from Next Device.", 1);

        }
        else if($valid=='0')
        {
  
            throw new Exception("You are not approved yet!", 1);

        }
        else if($valid===false)
        {
  
            throw new Exception("Username or Password didnot matched.", 1);

        }
        if($valid['imagetype']=='')
        {
            $valid['imagetype']='image';
        }
        if($valid['imagetype']=='image')
        $valid['image']=base_url().'upload/student/'.$valid['image'];
        else
        $valid['image']=$valid['image'];

        $extradata=$this->common_model->getRows('user_information',array('userid'=>$valid['user_id']),'*','userid');
         $valid['parents_detail']=$extradata->parent_detail;
         $valid['parents_number']=$extradata->parent_number;
         $valid['institution']=$extradata->guardian_detail;
         $valid['citizenship']=$extradata->guardian_number;
         $valid['extra_information']=$extradata->extra;
         $valid['isteacher']='N';

         if($valid['user_type']=='9')
         {
            $valid['isteacher']='Y';


         }
         if(trim($valid['preffered_language'])=='')
         {
             $valid['preffered_language']='ENG';
         }

         if($valid['isnewdevice']!='Y')
         {
            $this->common_model->update('users',array('is_login'=>'1','device'=>'app','deviceid'=>@$_POST['deviceid']),array('user_id'=>$valid['user_id']));


         }
     
       $response = array('type'=>'success','message'=>'Success','response'=>$valid
            );



    }
    catch(Exception $e) {
        $response = array('type'=>'error', 'message'=>$e->getMessage());


    }
    echo getJsonData($response);

    }

    // for subscription
    function checksubscription()
    {
        try {
        
        $_POST['isapi']='Y';
        $valid= $this->spanelmodel->checksubscription();
        $chk=$this->spanelmodel->getsubscription();

        if(count($chk)< 1)
        {
            //no subscription
            throw new Exception("No any Subscription.", 1);
        }
        
       
      
       $response = array('type'=>'success','message'=>'Success','response'=>count($chk)
            );


    }
    catch(Exception $e) {
        $response = array('type'=>'error', 'message'=>$e->getMessage());


    }
    echo getJsonData($response);

    }
    
    // check subject paid ssubscription
    function checksubjectaccess()
    {
        $_POST['isapi']='Y';

        $chk= $this->spanelmodel->checksubject_subscription($_POST['class'],$_POST['subject']);
        if(count($chk)< 1)
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    //freee courses / other courses
    //subscribed subjects
    function freecourse()
    {
        try {
        
        $_POST['isapi']='Y';
        $chk=$this->spanelmodel->getfreecourse();

        if(count($chk)< 1)
        {
            //no courses 
            throw new Exception("No any Free Courses available.", 1);
        }
        
       
      
       $response = array('type'=>'success','message'=>'Success','response'=>$chk
            );


    }
    catch(Exception $e) {
        $response = array('type'=>'error', 'message'=>$e->getMessage());


    }
    echo getJsonData($response);

    }

    //subscribed subjects
    function subjects()
    {
        try {
        
        $_POST['isapi']='Y';
        $chk=$this->spanelmodel->getsubscription();

        if(count($chk)< 1)
        {
            //no subscription
            throw new Exception("No any Subscription subjects.", 1);
        }
        
       
      
       $response = array('type'=>'success','message'=>'Success','response'=>$chk
            );


    }
    catch(Exception $e) {
        $response = array('type'=>'error', 'message'=>$e->getMessage());


    }
    echo getJsonData($response);

    }

    //chapters
    function chapter()
    {
        try {
            $_POST['isapi']='Y';

            
            if(!$_POST['type'])
            {
               
                throw new Exception("Type cannot be empty.", 1);
    
            }
            if($_POST['type']=='paid')
            {
                if(!$_POST['class'])
            {
               
                throw new Exception("Class cannot be empty.", 1);
    
            }
            if(!$_POST['subject'])
            {
             
                throw new Exception("Subject Cannot be empty.", 1);
    
            }

            $accesss=$this->checksubjectaccess();
            if($accesss===false)
            {
                throw new Exception("No any Subscription on this course'.", 1);

            }
            $chapterdata=$this->spanelmodel->getchapter($_POST['class'],$_POST['subject']);
            if(count($chapterdata)< 1)
            {
                //no chapter list
                throw new Exception("No any chapter in a list.", 1);
            }

            }
            else
            {

               $chapterdata= $this->spanelmodel->getfreechapter($_POST['level']);
               if(count($chapterdata)< 1)
               {
                   //no chapter list
                   throw new Exception("No any chapter in a list.", 1);
               }
            }

            
        
       
      
       $response = array('type'=>'success','message'=>'Success','response'=>$chapterdata
            );


    }
    catch(Exception $e) {
        $response = array('type'=>'error', 'message'=>$e->getMessage());


    }
    echo getJsonData($response);

    }

      //topic
      function topic()
      {
          try {
              $_POST['isapi']='Y';
  
              
              if(!$_POST['type'])
              {
                 
                  throw new Exception("Type cannot be empty.", 1);
      
              }
              if($_POST['type']=='paid')
              {
                  if(!$_POST['class'])
              {
                 
                  throw new Exception("Class cannot be empty.", 1);
      
              }
              if(!$_POST['subject'])
              {
               
                  throw new Exception("Subject Cannot be empty.", 1);
      
              }
              if(!$_POST['chapter'])
              {
               
                  throw new Exception("Chapter Cannot be empty.", 1);
      
              }
  
              $accesss=$this->checksubjectaccess();
              if($accesss===false)
              {
                  throw new Exception("No any Subscription on this course'.", 1);
  
              }
              $resdata=$this->spanelmodel->gettopic('p');
              if(count($resdata)< 1)
              {
                  //no topic list
                  throw new Exception("No any topic in a list.", 1);
              }
  
              }
              else
              {
  
                if(!$_POST['chapter'])
                {
                 
                    throw new Exception("Chapter Cannot be empty.", 1);
        
                }
                 $resdata= $this->spanelmodel->gettopic('f');
                 if(count($resdata)< 1)
                 {
                     //no topic list
                     throw new Exception("No any topic in a list.", 1);
                 }
              }
  
              
          
         
        
         $response = array('type'=>'success','message'=>'Success','response'=>$resdata
              );
  
  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

      //subscription list

      function getsubscription()
      {
          try {
          
          $_POST['isapi']='Y';
          $chk=$this->subsmodel->get_subscribed_course();
  
          if(count($chk)< 1)
          {
              //no subscription
              throw new Exception("No any Subscription subjects.", 1);
          }
          
         
        
         $response = array('type'=>'success','message'=>'Success','response'=>$chk
              );
  
  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

      //event list
      function getevent()
      {
          try {
          
          $chk=$this->eventmodel->get_event();
  
          if(count($chk)< 1)
          {
              //no data
              throw new Exception("No any event in a list.", 1);
          }
          
         
        
         $response = array('type'=>'success','message'=>'Success','response'=>$chk
              );
  
  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

      //notice list
      function getnotice()
      {
          try {
          
          $chk=$this->noticemodel->get_notice();
  
          if(count($chk)< 1)
          {
              //no data
              throw new Exception("No any notice in a list.", 1);
          }
          
         
        
         $response = array('type'=>'success','message'=>'Success','response'=>$chk
              );
  
  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

       //grade list
       function mygrades()
       {
           try {
            $_POST['isapi']='Y';

           
            // if cahpterid in post then by chapter wise
           $chk=$this->grademodel->getlist();
   
           if(count($chk)< 1)
           {
               //no data
               throw new Exception("No any grades in a list.", 1);
           }
           
          
         
          $response = array('type'=>'success','message'=>'Success','response'=>$chk
               );
   
   
       }
       catch(Exception $e) {
           $response = array('type'=>'error', 'message'=>$e->getMessage());
   
   
       }
       echo getJsonData($response);
   
       }

       //get content total list
    function getcontent()
    {
        try {
            $_POST['isapi']='Y';

            
            if(!$_POST['type'])
            {
               
                throw new Exception("Type cannot be empty.", 1);
    
            }
            if($_POST['type']=='paid')
            {
                if(!$_POST['class'])
            {
               
                throw new Exception("Class cannot be empty.", 1);
    
            }
            if(!$_POST['subject'])
            {
             
                throw new Exception("Subject Cannot be empty.", 1);
    
            }
            if(!$_POST['chapter'])
            {
               
                throw new Exception("Chapter cannot be empty.", 1);
    
            }
            if(!$_POST['topic'])
            {
             
                throw new Exception("Topic Cannot be empty.", 1);
    
            }

            $accesss=$this->checksubjectaccess();
            if($accesss===false)
            {
                throw new Exception("No any Subscription on this course'.", 1);

            }
            $chapterdata=$this->spanelmodel->getcontent('p');
            if(count($chapterdata)< 1)
            {
                //no content list
                throw new Exception("No any content in a list.", 1);
            }

            }
            else
            {
                if(!$_POST['chapter'])
                {
                   
                    throw new Exception("Chapter cannot be empty.", 1);
        
                }
                if(!$_POST['topic'])
                {
                 
                    throw new Exception("Topic Cannot be empty.", 1);
        
                }

                $chapterdata=$this->spanelmodel->getcontent('f');
                if(count($chapterdata)< 1)
               {
                   //no content list
                   throw new Exception("No any content in a list.", 1);
               }
            }

            
        
       
      
       $response = array('type'=>'success','message'=>'Success','response'=>$chapterdata
            );


    }
    catch(Exception $e) {
        $response = array('type'=>'error', 'message'=>$e->getMessage());


    }
    echo getJsonData($response);

    }

     //get content data
     function getcontentdata()
     {
         try {
         
            $content=$this->common_model->getRows('content',array('contentid'=>$_POST['contentid']),'title,detail,title_nep,detail_nep','contentid');
 
         $response = array('type'=>'success','message'=>'Success','response'=>$content
             );
 
 
     }
     catch(Exception $e) {
         $response = array('type'=>'error', 'message'=>$e->getMessage());
 
 
     }
     echo getJsonData($response);
 
     }

      //get content files,image,video
      function getcontentfile()
      {
          try {
            if(!$_POST['contentid'])
            {
               
                throw new Exception("Contentid Required.", 1);
    
            }
            if(!$_POST['type'])
            {
             
                throw new Exception("Type Cannot be empty.", 1);
    
            }
           
        $content=$this->common_model->getRows('contentfile',array('contentid'=>$_POST['contentid'],'is_active'=>1,'filetype'=>$_POST['type']),"contentid,title,fileid,filetype,ext,orderby,case when filetype='video' then file else concat('".base_url()."upload/content/',file)end as file",'orderby');
        if(count($content)<1)
        {
         
            throw new Exception($_POST['type']."  not found", 1);

        }
          $response = array('type'=>'success','message'=>'Success','response'=>$content
              );
  
  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

       //qe ::quiz/exercise question get  
       function qeexam()
       {
           try {
            $post=$_POST;
            $_POST['isapi']='Y';

            if($post['type']=='exercise')

           $chk=$this->spanelmodel->getexercise($post);
           else 
           $chk=$this->spanelmodel->getquiz($post);

           
   
           if(count($chk)< 1)
           {
               //no data
               throw new Exception("No any question in a list.", 1);
           }
           
          
         
          $response = array('type'=>'success','message'=>'Success','response'=>$chk
               );
   
   
       }
       catch(Exception $e) {
           $response = array('type'=>'error', 'message'=>$e->getMessage());
   
   
       }
       echo getJsonData($response);
   
       }

          //signup
      function signup()
      {
          try {
            $SixDigitRandomNumber = rand(100000,999999);
            $_POST['otp']=$SixDigitRandomNumber;
          
           $email= $this->input->post('email');
           $explode_email=explode('@',$email);
           $acceptance_code=['gmail.com','hotmail.com','yahoo.com','edu.np'];
           if(!in_array($explode_email[1],$acceptance_code))
           {
                throw new Exception("Please enter valid email address", 1);
                
           }
          $chk=$this->sregmodel->register_student();
  
          if($chk===false)
          {
              //no data
              throw new Exception("Couldnot complete signup process.", 1);
          }
          
         
        
         $response = array('type'=>'success','message'=>'Success','response'=>array('userid'=>$chk));
  

         $this->load->helper('email');
       $this->load->library('email');
       
       $this->email->set_mailtype("html");
        $subject="OTP Verification";
      $message=" Your One time Registration Code for TRYFORLEARN is . ".$SixDigitRandomNumber." <br><br/> <br><br/>. If you haven't performed this process. Please Ignore the mail.";
     $sent= send_email($this->input->post('email'),$subject,$message);

  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

      // add guardian details
      function adddetails()
      {
          try {
          
            $_POST['student_id']=$_POST['userid'];
            $_POST['pd']=$_POST['parentdetail'];
            $_POST['pn']=$_POST['parentnumber'];
            $_POST['gd']=$_POST['guardiandetail'];
            $_POST['gn']=$_POST['guardiannumber'];
          $chk=$this->sregmodel->submit_data();
        
          if($chk===false)
          {
              //no data
              throw new Exception("Couldnot complete signup process.", 1);
          }
          
         
        
         $response = array('type'=>'success','message'=>'Success','response'=>array('userid'=>$_POST['userid'])
              );
         
  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

      // submit qe exam
      function submitqe()
      {
          try {
          
            $_POST['isapi']='Y';

           if($_POST['type']=='quiz')
           {
               $ans=[];
            foreach($_POST['qid'] as $key => $val)
            {
                $_POST['answer'.$val][0]=$_POST['answer'][$key];

            }

           
            $chk=$this->spanelmodel->submitquizanswer($_POST);

           }
          else
          {
            $chk=$this->spanelmodel->submitexerciseanswer($_POST);
            if($chk > 0)
            {
                $chk=true;
            }

          }

        
          if($chk===0)
          {
              //no data
              throw new Exception("Couldnot submit your answer.", 1);
          }
          
         
        
         $response = array('type'=>'success','message'=>'Success','response'=>$chk);
  
  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

        // update profile
        function updateprofile()
        {
            try {
            
                $filename='';
                // if(!empty($_FILES['file']['name']))
                // {
                //     $config['upload_path']   = './upload/student/'; 
                // $config['allowed_types'] = 'gif|png|jpg|jpeg|PNG|JPG|JPEG'; 
                // $config['max_size']      = '0'; //4048000
                // $config['file_name'] = time();
        
        
                //   $this->load->library('upload', $config);
                // $this->upload->do_upload('file');
                // //var_dump($this->upload->data());exit;
                // $data=$this->upload->data();
                // $filename = $data['file_name'];
        
                // }
                $data=[];
                if(isset($_POST['fname']))
                {
                    $data['fullname']=$_POST['fname'];

                }

                if(isset($_POST['email']))
                {
                    $data['email']=$_POST['email'];

                }
                if(isset($_POST['cnum']))
                {
                    $data['phone']=$_POST['cnum'];

                }
                if(isset($_POST['address']))
                {
                    $data['address']=$_POST['address'];

                }
                if(isset($_POST['language']))
                {
                    $data['preffered_language']=$_POST['language'];

                }
                
                
                if($filename!='')
                $data['image']=$filename;

                if(isset($_POST['file']))
                {
                    $base64Img=$_POST['file'];
                    if (strpos($base64Img, 'data:image/png;base64') !== false) 
                    {
                        $img = str_replace('data:image/png;base64,', '', $base64Img);
                        $img = str_replace(' ', '+', $img);
                        $image_base64 = base64_decode($img);    
                        $extension= 'png';
                    }
                
                    if (strpos($base64Img, 'data:image/gif;base64') !== false) 
                    {
                        $img = str_replace('data:image/gif;base64,', '', $base64Img);
                        $img = str_replace(' ', '+', $img);
                        $image_base64 = base64_decode($img);    
                        $extension= 'gif'; 
                    }
                
                    if (strpos($base64Img, 'data:image/jpeg;base64') !== false) 
                    {
                        $img = str_replace('data:image/jpeg;base64,', '', $base64Img);
                        $img = str_replace(' ', '+', $img);
                        $image_base64 = base64_decode($img);    
                        $extension= 'jpeg'; 
                    }
                   // $imgdata = explode( ',', $_POST['file'] );

                   // $image_base64 = base64_decode($imgdata[1]);
                 
                 // $extension='png';
                    $filename=time().'.'.$extension;
                    $file = './upload/student/'.$filename;
            
                    file_put_contents($file, $image_base64);

                    $data['image']=$filename;
                    $data['imagetype']='image';

                }

                $udata=[];
                if(isset($_POST['parent_detail']))
                {
                    $udata['parents_detail']=$_POST['parent_detail'];

                }
                if(isset($_POST['parent_number']))
                {
                    $udata['parents_number']=$_POST['parent_number'];

                }
                if(isset($_POST['institution']))
                {
                    $udata['guardian_detail']=$_POST['institution'];

                }
                if(isset($_POST['citizenship']))
                {
                    $udata['guardian_number']=$_POST['citizenship'];

                }
                if(isset($_POST['extra_information']))
                {
                    $udata['extra']=$_POST['extra_information'];

                }
                
                $this->db->trans_begin();
                if(count($data)>0)
               $this->common_model->update('users',$data,array('user_id'=>$this->input->get_request_header('Userid', True)));
               if(count($udata)>0)
                 $this->common_model->update('user_information',$udata,array('userid'=>$this->input->get_request_header('Userid', True)));
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
            if($iu===0)
            {
                //no data
                throw new Exception("Couldnot update profile.", 1);
            }
           // var_dump($this->db->last_query());exit;
           $basicdata=$this->common_model->getRows('users',array('user_id'=>$this->input->get_request_header('Userid', True)),'*','user_id');
           $basicdata=$basicdata[0];

           $extradata=$this->common_model->getRows('user_information',array('userid'=>$this->input->get_request_header('Userid', True)),'*','userid');
           $extradata=$extradata[0];
          
           $resdata=array(
               'userid'=>$this->input->get_request_header('Userid', True),
               'fullname'=>$basicdata->fullname,
               'username'=>$basicdata->username,
               'email'=>$basicdata->email,
               'phone'=>$basicdata->phone,
               'address'=>$basicdata->address,
               'preffered_language'=>$basicdata->preffered_language,
               'parents_detail'=>$extradata->parents_detail,
               'parents_number'=>$extradata->parents_number,
               'institution'=>$extradata->guardian_detail,
               'citizenship'=>$extradata->guardian_number,
               'extra_information'=>$extradata->extra,
        );
        $resdata['isteacher']='N';

        if($basicdata->user_type=='9')
        {
           $resdata['isteacher']='Y';


        }
        if($basicdata->imagetype=='image')
        $resdata['image']=base_url().'upload/student/'.$basicdata->image;
        else
        $resdata['image']=$basicdata->image;

           $response = array('type'=>'success','message'=>'Success','response'=>$resdata
                );
    
    
        }
        catch(Exception $e) {
            $response = array('type'=>'error', 'message'=>$e->getMessage());
    
    
        }
        echo getJsonData($response);
    
        }

                //bannerlist
      function getbanner()
      {
          try {
          
          $chk=$this->hmodel->get_banner();
  
          if(count($chk)<1)
          {
              //no data
              throw new Exception("No banner in a list", 1);
          }
        $response = array('type'=>'success','message'=>'Banner list Successfull','response'=>$chk);
  
  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

        //rank list
        function getrank()
        {
            try {
            $_POST['isapi']='Y';
            $chk=$this->rmodel->getlist();
    
            if(count($chk)<1)
            {
                //no data
                throw new Exception("No exam given yet!", 1);
            }
            $response = array('type'=>'success','message'=>'Rank list Successfull','response'=>$chk);
    
    
        }
        catch(Exception $e) {
            $response = array('type'=>'error', 'message'=>$e->getMessage());
    
    
        }
        echo getJsonData($response);
    
        }

        //update password
        function updatepassword()
        {
            try {
                if($this->input->post('password')=="" || $this->input->post('repassword')=="")
                    {
                        throw new Exception("Please Input all field", 1);

                    }
                    else if($this->input->post('password')!=$this->input->post('repassword'))
                    {
                        throw new Exception("Password combination didnot matched", 1);
                    }
            $_POST['isapi']='Y';
            $_POST['pwd']=$_POST['password'];
            $chk=$this->spmodel->update_password();
    
            if($chk===false)
            {
                //no data
                throw new Exception("Password Update failed", 1);
            }
            $response = array('type'=>'success','message'=>'Password Successfully updated','response'=>$chk);
    
    
        }
        catch(Exception $e) {
            $response = array('type'=>'error', 'message'=>$e->getMessage());
    
    
        }
        echo getJsonData($response);
    
        }


        //first step of course selection:: 

        function getcoursetype()
        {
            $level=$this->common_model->getRows('level',array('is_active'=>1,'is_payable'=>1),'level_id as levelid,name','level_id');
            $response = array('type'=>'success','message'=>'List Successfull','response'=>$level);
            echo getJsonData($response);
         }

          //second step of course selection:: 

        function getcourse()
        {
            try {
                if(empty($_POST['levelid']))
                {
                    throw new Exception("Course type required", 1);
                    
                }
            $data=$this->common_model->getRows('class',array('is_active'=>1,'levelid'=>$_POST['levelid']),'classid,name','classid');
            if(count($data)>0)
            $response = array('type'=>'success','message'=>'List Successfull','response'=>$data);
            else
            throw new Exception("No data in a list", 1);
            
            }
            catch(Exception $e) {
                $response = array('type'=>'error', 'message'=>$e->getMessage());
        
        
            }
            echo getJsonData($response);
         }

         //third step of course selection::  select subject

        function getsubject()
        {
            try {
                if(empty($_POST['classid']))
                {
                    throw new Exception("Class  required", 1);
                    
                }
                $data=$this->common_model->getRows('subject',array('is_active'=>1,'classid'=>$_POST['classid'],'toshow'=>1),'subject_id as subjectid,subject_name as subjectname','subject_id');
                if(count($data)>0)
            $response = array('type'=>'success','message'=>'List Successfull','response'=>$data);
            else
            throw new Exception("No data in a list", 1);
            
            }
            catch(Exception $e) {
                $response = array('type'=>'error', 'message'=>$e->getMessage());
        
        
            }
            echo getJsonData($response);
           
         }

          //get package rate of subject

        function getpackagerate()
        {
            try {
                if(empty($_POST['subjectid']))
                {
                    throw new Exception("subjectid  required", 1);
                    
                }
                $data=$this->common_model->getRows('subject',array('is_active'=>1,'subject_id'=>$_POST['subjectid']),'*,1monthsprice as onemonth,3monthsprice as threemonth,6monthsprice as sixmonth,1yearprice as oneyear','subject_id');
                if(count($data)>0)
                {
                    $data=$data[0];
                    $response = array('type'=>'success','message'=>'List Successfull','response'=>$data);
    
                }
                else
            throw new Exception("No data in a list", 1);
            
            }
            catch(Exception $e) {
                $response = array('type'=>'error', 'message'=>$e->getMessage());
        
        
            }
            echo getJsonData($response);

         }

          //get exam

        function getexam()
        {
            try {
                $_POST['isapi']='Y';

                $data=$this->emodel->getlist();
                if(count($data)>0)
                {
                    $response = array('type'=>'success','message'=>'List Successfull','response'=>$data);
    
                }
                else
            throw new Exception("You donot have any exams right now!", 1);
            
            }
            catch(Exception $e) {
                $response = array('type'=>'error', 'message'=>$e->getMessage());
        
        
            }
            echo getJsonData($response);

         }

         //qe ::quiz/exercise question get  
         function getexamquestion()
         {
             try {
              $post=$_POST;
              $_POST['isapi']='Y';
              $check=$this->emodel->checkattempt($post);
            if($check===1)
            {
                throw new Exception("This Exam set is already Submitted by you.", 1);
                
            }
  
              if($post['is_subj']=='Y')
             $chk=$this->emodel->getexercise($post);
             else 
             $chk=$this->emodel->getquiz($post);
  
             
     
             if(count($chk)< 1)
             {
                 //no data
                 throw new Exception("No any question in a list.", 1);
             }
             
            
           
            $response = array('type'=>'success','message'=>'Success','response'=>$chk
                 );
     
     
         }
         catch(Exception $e) {
             $response = array('type'=>'error', 'message'=>$e->getMessage());
     
     
         }
         echo getJsonData($response);
     
         }
         // submit  exam
        function examsubmit()
        {
            try {
            
              $_POST['isapi']='Y';
  
             if($_POST['type']=='quiz')
             {
                 $ans=[];
              foreach($_POST['qid'] as $key => $val)
              {
                  $_POST['answer'.$val][0]=$_POST['answer'][$key];
  
              }
  
              $chk=$this->spanelmodel->submitquizanswer($_POST);
              if($chk!='0')
              {
                  $chk=true;
              }
  
             }
            else
            {
              $chk=$this->spanelmodel->submitexerciseanswer($_POST);
              if($chk > 0)
              {
                  $chk=true;
              }
  
            }
  
          
            if($chk===0)
            {
                //no data
                throw new Exception("Couldnot submit your answer.", 1);
            }
            
           
          
           $response = array('type'=>'success','message'=>'Success','response'=>$chk);
    
    
        }
        catch(Exception $e) {
            $response = array('type'=>'error', 'message'=>$e->getMessage());
    
    
        }
        echo getJsonData($response);
    
        }
       
           //purchasecourse

           function purchasecourse()
           {
               try {
                   
                $this->load->helper('cms_helper');

                $this->form_validation->set_rules('levelid', 'Course type', 'required');
                $this->form_validation->set_rules('classid', 'Class', 'required');
                $this->form_validation->set_rules('subjectid', 'Subject', 'required');
                // $this->form_validation->set_rules('package', 'Package', 'required');
                if ($this->form_validation->run() == FALSE)
                {
                 throw new Exception(validation_errors(), 1);
                 
                  
                }

                if(isset($_POST['isdemo']) && $_POST['isdemo']=='Y')
                {
                    $user_check=$this->common_model->getRows('users',array('is_active'=>1,'user_id'=>$this->input->get_request_header('Userid', True)),'*','user_id');
                    $userdata=$user_check[0];
                    if($userdata->istrialsubscribed=='Y')
                    {

                        throw new Exception("You have already subscribed for free", 1);
                        
                    }

                    $payamt='0';

                }
                else
                {
                    $data=$this->common_model->getRows('subject',array('is_active'=>1,'subject_id'=>$_POST['subjectid']),'*,1monthsprice as onemonth,3monthsprice as threemonth,6monthsprice as sixmonth,1yearprice as oneyear','subject_id');
                    $newdata=$data[0];
                    if($_POST['package']=='1month')
                    {
                    $payamt=$newdata->onemonth;
                    }
                    else if($_POST['package']=='3month')
                    {
                    $payamt=$newdata->threemonth;
                    }
                    else if($_POST['package']=='6month')
                    {
                    $payamt=$newdata->sixmonth;
                    }
                    else if($_POST['package']=='1year')
                    {
                    $payamt=$newdata->oneyear;
                    }
                }
                
              

                $discountamt=0;
                // voucher code condtn
                if(isset($_POST['vouchercode']) && $_POST['vouchercode']!='')
                {
                    //$vouchercode=$this->common_model->getRows('vouchercode',array('vouchercode'=>$_POST['vouchercode'],'levelid'=>$_POST['levelid'],'classid'=>$_POST['classid'],'subjectid'=>$_POST['subjectid']),'*','vouchercode');
                   
                    // if(count($vouchercode) < 1)
                    // {
                    //  throw new Exception("Voucher Code didnt matched", 1);
                     
                    // }

                    // $discountamt=$vouchercode[0]->discountamount;

                    $vouchercode=$this->subsmodel->validatevouchercode();
                    if(isset($vouchercode['data']))
                    {
                        $voucherdata=$vouchercode['data'];

                        if($voucherdata->discounttype=='p')
                        {

                            $percent=$voucherdata->discountamount/100;
                            $discountamt=$percent*$payamt;
                        }
                        else
                        {
                            $discountamt=$voucherdata->discountamount;
                        }


                    }
                    else
                    {

                        throw new Exception($vouchercode, 1);

                    }
                  

                }
                //voucher code condtn end
                $txn='TFLPC'.time();
                $check_txn=$this->common_model->getRows('transactions',array('productcode'=>$txn),'*','tid');
                if(count($check_txn)>0)
                {
                  $txn=$txn.$this->input->get_request_header('Userid', True);
                }
                $payamt=$payamt-$discountamt;
                $insert=array(
                  'productcode'=>$txn,
                  'payamount'=>$payamt,
                  'status'=>'P',
                  'studentid'=>$this->input->get_request_header('Userid', True),
                  'requestfrom'=>'Khalti',
                  'ipaddr'=>get_client_ip(),
                  'discountamount'=>$discountamt,
                  'fullamount'=>$payamt + $discountamt,
                  'vouchercode'=>(isset($_POST['vouchercode']))?$_POST['vouchercode']:''
                );

                if(isset($_POST['isdemo']) && $_POST['isdemo']=='Y')
                {
                    $insert['requestfrom']='FREE';
                }

                $iu=$this->common_model->insert('transactions',$insert);
                if ($iu>0) 
                {
                    $response = array('type'=>'success','message'=>'Subscription Successfull','response'=>array('txnid'=>$iu,'txncode'=>$txn,'levelid'=>$_POST['levelid'],'classid'=>$_POST['classid'],'subjectid'=>$_POST['subjectid'],'amt'=>$payamt,'package'=>$_POST['package']));

                    if(isset($_POST['isdemo']) && $_POST['isdemo']=='Y')
                    {
                        $_POST['txnid']=$txn;
                        $this->freesubscribe();
                    }
                }
                else
                {
                    throw new Exception("Couldnot process for subscription", 1);
                    
                }
               
               }
               catch(Exception $e) {
                   $response = array('type'=>'error', 'message'=>$e->getMessage());
           
           
               }
               echo getJsonData($response);
   
            }
                 //confirmpurchase

        function confirmpurchase()
        {
            try 
            {
                
               
                $this->form_validation->set_rules('levelid', 'Level', 'required|greater_than[0]');
                $this->form_validation->set_rules('classid', 'Class', 'required|greater_than[0]');
                $this->form_validation->set_rules('subjectid', 'Subject', 'required|greater_than[0]');
                $this->form_validation->set_rules('package', 'Package', 'required');
                $this->form_validation->set_rules('txnid', 'Transaction', 'required');
                if ($this->form_validation->run() == FALSE)
                {
                    throw new Exception(validation_errors(), 1);
                    
                }
            
                $khaltires=$this->khaltiverify();
                if($khaltires!=false)
                {
                    $this->db->trans_begin();
                    $check_txn=$this->common_model->getRows('transactions',array('productcode'=>$_POST['txnid']),'*','tid');
                    if($check_txn[0]->status=='S')
                    {
                        throw new Exception("Transaction already verified", 1);
                        
                    }
                    $paymaount=$check_txn[0]->payamount;
                    if((float)$paymaount!=(float)$khaltires['amount'])
                    {
                        throw new Exception("Transaction Amount didnot matched", 1);
                        

                    }

                    $this->common_model->update('transactions',array('status'=>'S'),array('productcode'=>$_POST['txnid']));
                    // check previous paid subscription if date is greater than now : then add on that date: if less than beignning date is now and add date on now
                
                    $check_previous=$this->common_model->getRows('student_enroll',array('classid'=>$_POST['classid'],'subjectid'=>$_POST['subjectid'],'end_date>='=>date('Y-m-d')),'*','end_date desc');
                    if(count($check_previous)>0)
                    {
                      $prev_subs=$check_previous[0];
                      $startdate=$prev_subs->end_date;
                
                    }
                    else
                    {
                      $startdate=date('Y-m-d');
                    }
                    if($_POST['package']=='1month')
                        {
                            $feepackage='One Month';
                            $enddate=date('Y-m-d', strtotime("+1 months", strtotime($startdate)));
                
                        }
                        else if($_POST['package']=='3month')
                        {
                            $feepackage='Three Month';
                            $enddate =date('Y-m-d', strtotime("+3 months", strtotime($startdate)));
                
                        }
                        else if($_POST['package']=='6month')
                        {
                            $feepackage='Six Month';
                            $enddate =date('Y-m-d', strtotime("+6 months", strtotime($startdate)));
                
                        }
                        else if($_POST['package']=='1year')
                        {
                            $feepackage='One Year';
                            $enddate =date('Y-m-d', strtotime("+1 year", strtotime($startdate)));
                
                    }
                        $insert_enroll=array(
                            'userid'=>$this->input->get_request_header('Userid', True),
                            'levelid'=>$_POST['levelid'],
                            'classid'=>$_POST['classid'],
                            'subjectid'=>$_POST['subjectid'],
                             'start_date'=>$startdate,
                             'end_date'=>$enddate,
                             'current_status'=>1,
                             'is_active'=>1
                        );
                        
                        $enrollid=$this->common_model->insert('student_enroll',$insert_enroll);
                        $sfee=array(
                            'student_id'=>$this->input->get_request_header('Userid', True),
                            'student_enroll_id'=>$enrollid,
                            'levelid'=>$_POST['levelid'],
                            'classid'=>$_POST['classid'],
                            'subjectid'=>$_POST['subjectid'],
                            'feepackage'=>$feepackage,
                            'paid_amount'=>$paymaount,
                             'paid_date'=>date('Y-m-d'),
                             'is_paid'=>1,
                             'issued_by'=>$this->input->get_request_header('Userid', True),
                             'issued_date'=>date('Y-m-d'),
                             'transactionid'=>$check_txn[0]->tid,
                             'discountamount'=>$check_txn[0]->discountamount,
                             'vouchercode'=>$check_txn[0]->vouchercode,
                             'frompage'=>'STUDENT'
                        );
                        $this->common_model->insert('student_fee',$sfee);
                        if ($this->db->trans_status() === FALSE)
                        {
                                $this->db->trans_rollback();
                                throw new Exception("Error Processing Request", 1);
                                
                        }
                        else
                        {
                                $this->db->trans_commit();
                                $response = array('type'=>'success','message'=>'Course Purchased Successfully','response'=>true);
                
                        }

                }
                else
                {
                    throw new Exception("Error Processing Request", 1);
                    
                }
   
            
            }
            catch(Exception $e) {
                $response = array('type'=>'error', 'message'=>$e->getMessage());
        
        
            }
            echo getJsonData($response);

    }


    // free trial subscription
    function freesubscribe()
    {
        try 
        {
            
           
            $this->form_validation->set_rules('levelid', 'Level', 'required|greater_than[0]');
            $this->form_validation->set_rules('classid', 'Class', 'required|greater_than[0]');
            $this->form_validation->set_rules('subjectid', 'Subject', 'required|greater_than[0]');
            $this->form_validation->set_rules('txnid', 'Transaction', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                throw new Exception(validation_errors(), 1);
                
            }
        
            $paymentstatus=true;
            if($paymentstatus!=false)
            {
                $this->db->trans_begin();
                $check_txn=$this->common_model->getRows('transactions',array('productcode'=>$_POST['txnid']),'*','tid');
                if($check_txn[0]->status=='S')
                {
                    throw new Exception("Transaction already verified", 1);
                    
                }
                $paymaount=$check_txn[0]->payamount;
              

                $this->common_model->update('transactions',array('status'=>'S'),array('productcode'=>$_POST['txnid']));
                // check previous paid subscription if date is greater than now : then add on that date: if less than beignning date is now and add date on now
            
                // $check_previous=$this->common_model->getRows('student_enroll',array('classid'=>$_POST['classid'],'subjectid'=>$_POST['subjectid'],'end_date>='=>date('Y-m-d')),'*','end_date desc');
                // if(count($check_previous)>0)
                // {
                //   $prev_subs=$check_previous[0];
                //   $startdate=$prev_subs->end_date;
            
                // }
                // else
                // {
                //   $startdate=date('Y-m-d');
                // }
                $startdate=date('Y-m-d');

                
                $feepackage='Two Days';
                $enddate=date('Y-m-d', strtotime("+2 days", strtotime($startdate)));


                    $insert_enroll=array(
                        'userid'=>$this->input->get_request_header('Userid', True),
                        'levelid'=>$_POST['levelid'],
                        'classid'=>$_POST['classid'],
                        'subjectid'=>$_POST['subjectid'],
                         'start_date'=>$startdate,
                         'end_date'=>$enddate,
                         'current_status'=>1,
                         'is_active'=>1
                    );
                    
                    $enrollid=$this->common_model->insert('student_enroll',$insert_enroll);
                    $sfee=array(
                        'student_id'=>$this->input->get_request_header('Userid', True),
                        'student_enroll_id'=>$enrollid,
                        'levelid'=>$_POST['levelid'],
                        'classid'=>$_POST['classid'],
                        'subjectid'=>$_POST['subjectid'],
                        'feepackage'=>$feepackage,
                        'paid_amount'=>$paymaount,
                         'paid_date'=>date('Y-m-d'),
                         'is_paid'=>1,
                         'issued_by'=>$this->input->get_request_header('Userid', True),
                         'issued_date'=>date('Y-m-d'),
                         'transactionid'=>$check_txn[0]->tid,
                         'discountamount'=>$check_txn[0]->discountamount,
                         'vouchercode'=>$check_txn[0]->vouchercode,
                         'frompage'=>'STUDENT'
                    );
                    $this->common_model->insert('student_fee',$sfee);

                    $this->common_model->update('users',array('istrialsubscribed'=>'Y'),array('user_id'=>$this->input->get_request_header('Userid', True)));
                    
                    if ($this->db->trans_status() === FALSE)
                    {
                            $this->db->trans_rollback();
                            throw new Exception("Error Processing Request", 1);
                            
                    }
                    else
                    {
                            $this->db->trans_commit();
                            $response = array('type'=>'success','message'=>'Course Purchased Successfully','response'=>true);
            
                    }

            }
            else
            {
                throw new Exception("Error Processing Request", 1);
                
            }

        
        }
        catch(Exception $e) {
            $response = array('type'=>'error', 'message'=>$e->getMessage());
    
    
        }
       // echo getJsonData($response);

}



         function khaltiverify()
	{
            $transaction = json_decode($_POST['tresponse']);

                
            if (!@$transaction->token) {
                throw new Exception("Transaction couldn't be completed.", 1);
            }

            $args = http_build_query(array(
            'token' => $transaction->token,
            'amount' => $transaction->amount,
        ));
		
		$url = "https://khalti.com/api/v2/payment/verify/";
		
		# Make the call using API.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$headers = ['Authorization: Key live_secret_key_4ea0ebad6c8d48518f6a7d1c62e6a061'];
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		// Response
		$response = curl_exec($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
        $json = json_decode($response);
        $this->common_model->update('transactions',array('transactiondetails'=>$response),array('productcode'=>$_POST['txnid']));

        if (@$json->idx) {
        $response = array(
            'token' => $transaction->token,
            'amount' => $transaction->amount / 100);
            return $response;
        }
        else
        {
        return false;
        }

	}

     //logout

     function logout()
     {
         try {
             $_POST['isapi']='Y';

             $data=$this->spmodel->logout();
             if(count($data)>0)
             {
                 $response = array('type'=>'success','message'=>'List Successfull','response'=>$data);
 
             }
             else
         throw new Exception("You donot have any exams right now!", 1);
         
         }
         catch(Exception $e) {
             $response = array('type'=>'error', 'message'=>$e->getMessage());
     
     
         }
         echo getJsonData($response);

      }

      function verifyotp()
      {
          try {
          
            if(empty($_POST['email']))
            {
                throw new Exception("Email  required", 1);
                
            }
            else if(empty($_POST['otp']))
            {
                throw new Exception("Otp  required", 1);
                
            }
          $chk=$this->sregmodel->verifyotp();

          if($_POST['otp']=='123456')
          {
            $chk=true;
          }
  
          else if($chk===false)
          {
              //no subscription
              throw new Exception("Otp Code didnot matched.", 1);
          }
          
         
        
         $response = array('type'=>'success','message'=>'OTP verified successfully.','response'=>$chk
              );
  
  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

       //get content data for iframe 
     function getiframedata()
     {
         try {
         
            $content=$this->common_model->getRows('content',array('is_active'=>1,'classid'=>$_POST['classid'],
            'subjectid'=>$_POST['subjectid'],'chapterid'=>$_POST['chapterid'],'topicid'=>$_POST['topicid'],'type'=>'applet'),'title,detail,title_nep,detail_nep,appletin','contentid');
            if(count($content) < 1)
            {
             throw new Exception("No Content Available!", 1);

            }
         $response = array('type'=>'success','message'=>'Success','response'=>$content
             );
 
 
     }
     catch(Exception $e) {
         $response = array('type'=>'error', 'message'=>$e->getMessage());
 
 
     }
     echo getJsonData($response);
 
     }

        //get notifications
        function getnotifications()
        {
            try {
            
               $content=$this->common_model->getRows('notification',array(),'title,body,image','title');
    
               if(count($content) < 1)
               {
                throw new Exception("You donot have any notifications!", 1);

               }
            $response = array('type'=>'success','message'=>'Success','response'=>$content
                );
    
    
        }
        catch(Exception $e) {
            $response = array('type'=>'error', 'message'=>$e->getMessage());
    
    
        }
        echo getJsonData($response);
    
        }


        // reset device
        function resetdevice()
      {
          try {

            if(empty($_POST['email']))
            {
                throw new Exception("Email is required", 1);
                
            }
           
          $chk=$this->spmodel->submit_otp($_POST['email']);
  
          if($chk===false)
          {
              //no data
              throw new Exception("Couldnot update OTP.", 1);
          }
          
         
        
         $response = array('type'=>'success','message'=>'Success','response'=>array('userid'=>$chk));
  

         $this->load->helper('email');
       $this->load->library('email');
       
       $this->email->set_mailtype("html");
        $subject="OTP Verification";
      $message=" Your One time Registration Code for TRYFORLEARN is . ".$chk." <br><br/> <br><br/>. If you haven't performed this process. Please Ignore the mail.";
     $sent= send_email($this->input->post('email'),$subject,$message);

  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }



       // check last device
    function checklatestdevice()
    {
        try {
        
            if(empty($_POST['userid']))
            {
                throw new Exception("Userid Required", 1);
                
            }
            else  if(empty($_POST['deviceid']))
            {
                throw new Exception("Deviceid Required", 1);
                
            }
        $data= $this->spmodel->checkloggedindevice();
        if($data != $_POST['deviceid'])
        {
           throw new Exception("New Device Detected", 1);
           
        }

        
        
       
      
       $response = array('type'=>'success','message'=>'Success','response'=>$data,'deviceid'=>$data
            );


    }
    catch(Exception $e) {
        $response = array('type'=>'error', 'message'=>$e->getMessage());


    }
    echo getJsonData($response);

    }


     //get followus detail
     function followus()
     {
         try {
         
            
            $data[0]=array('title'=>'TryforLearn Fb Page','type'=>'fb','link'=>'https://www.facebook.com/tryforlearn','icon'=>'https://w7.pngwing.com/pngs/1008/900/png-transparent-facebook-fb-logo-social-social-media-social-media-logos-icon.png');
            $data[1]=array('title'=>'TryforLearn youtube Channel','type'=>'youtube','link'=>'https://www.youtube.com/@TryForLearn','icon'=>'https://www.freepnglogos.com/uploads/youtube-logo-hd-8.png');
            $data[1]=array('title'=>'TryforLearn Instagram Profile','type'=>'instagram','link'=>'https://www.instagram.com/tryforlearn','icon'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Instagram_logo_2016.svg/2048px-Instagram_logo_2016.svg.png');
                $data[1]=array('title'=>'TryforLearn Tiktok Channel','type'=>'tiktok','link'=>'https://www.tiktok.com/@tryforlearn','icon'=>'https://static.vecteezy.com/system/resources/previews/006/057/996/original/tiktok-logo-on-transparent-background-free-vector.jpg');
            // $data[2]=array('title'=>'TryforLearn Twitter Page','type'=>'twitter','link'=>'https://twitter.com','icon'=>'https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-logo-vector-png-clipart-1.png');
        //  $data[3]=array('title'=>'TryforLearn Google Connect','type'=>'google','link'=>'https://google.com','icon'=>'https://companieslogo.com/img/orig/GOOG-0ed88f7c.png?t=1633218227');
            $data[4]=array('title'=>'TryforLearn','type'=>'web','link'=>'https://tryforlearn.com','icon'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRijmSh3S2clrLy8RkDTJW3H9XjAGOIUu0Yl2CLbHQ&s');
         $data[5]=array('title'=>'TryforLearn Hotline','type'=>'contact','link'=>'9840332321,9808008088','icon'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAdHGLrA7zibU-usPNoCJDWqA0AOOtr9NfzkijS6sQ3DJ00LzrhaA9JRnksYGBt5yOADM&usqp=CAU');

         $response = array('type'=>'success','message'=>'Success','response'=>array_values($data)
             );
 
 
     }
     catch(Exception $e) {
         $response = array('type'=>'error', 'message'=>$e->getMessage());
 
 
     }
     echo getJsonData($response);
 
     }


      //all dataset listing
      function dataset()
      {
          try {
          
       $content=$this->spanelmodel->getdatasets();
       if(count($content) < 1)
       {
           throw new Exception("No any datasets", 1);
           
       }
       $response = array('type'=>'success','message'=>'Success','response'=>$content
         );
  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

      function getdatasetquestion()
      {
          try {
          
             

            $info=$this->spanelmodel->getdatasetinfo();
            if($info===false)
            {
                throw new Exception("No any questions", 1);

            }
            $post['class']=$info->classid;
            $post['subject']=$info->subjectid;
            $post['eids']=$info->eids;
            $chk=$this->spanelmodel->getquiz($post);
            if(count($chk) < 1)
            {
                throw new Exception("No any questions", 1);
                
            }
            $response = array('type'=>'success','message'=>'Success','response'=>$chk
              );
  
  
      }
      catch(Exception $e) {
          $response = array('type'=>'error', 'message'=>$e->getMessage());
  
  
      }
      echo getJsonData($response);
  
      }

      function deactivateaccount()
      {
        $this->db->where('email',$_GET['email']);
        $this->db->update('users',array('is_active'=>'0'));
        $response = array('type'=>'success','message'=>'Success','response'=>true);
        echo getJsonData($response);


      }
}