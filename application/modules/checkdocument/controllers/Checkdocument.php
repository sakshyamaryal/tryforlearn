<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Checkdocument extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('checkdocument_model','model');
    }
    function index()
     {
        $data=array(
            'title'=>'Try For Learn : Validate your Document',
            'mode'=>'frontend',

        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>false,
            'body'=>'document',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);
  
            
    }
    function check()
    {
        if($this->input->post('dn')=="" || $this->input->post('cn')=="" || $this->input->post('phone')=="")
        {
            $res = ["message"=>'Please Input All Field',"status"=>false];

        }
       
        else
        {
            $file=$this->model->check($_POST);
             if($file !="")
             {
                $res = ["message"=>'You submitted "<b>'. $this->input->post('dn') .'</b>" exist in our record.',"status"=>true];

             }
             else
             {
                $res = ["message"=>'You submitted "<b>'. $this->input->post('dn') .'</b>" doesnot exist in our record.<br/>Please Recheck and Enter all detail correctly',"status"=>false];
             }
        }
        echo json_encode($res);
    }
    
    function viewcertificate()
    {
        $cert=$this->model->check($_GET);
        if(@$cert===false || @$cert['Name']=='')
        {
            echo 'Access Forbidden';
            exit;
        }

        $data=array(
            'title'=>'Try For Learn : Validate your Document',
            'mode'=>'frontend',
            'value'=>$this->model->check($_GET)
           
        );
        $this->load->view('generate',$data);
        
    }
    
    function downloadcertificate()
    {
        $cert=$this->model->check($_GET);
        if(@$cert===false || @$cert['Name']=='')
        {
            echo 'Access Forbidden';
            exit;
        }

        $data=array(
            'title'=>'Try For Learn : Validate your Document',
            'mode'=>'frontend',
            'value'=>$cert,
            'certificate'=>$this->model->getcertificate($cert['certificateid'])
           
        );
        // $html=$this->load->view('generate-pdf',$data,true);
        // $name=$_SERVER['DOCUMENT_ROOT'].'/upload/document/'.$_GET['dn'].'.pdf';
        // $myfile = fopen($name, "w+") or die("Unable to open file!");

        // fwrite($myfile, $html);
        // fclose($myfile);
        // redirect(base_url().'upload/document/'.$_GET['dn'].'pdf');
        
               $html=$this->load->view('certificate',$data,true);

              //load the view and saved it into $html variable

        //this is the PDF filename that user will get to download
        $pdfFilePath = 'TRYFORLEARN_CERTIFICATE_'.$_GET['dn'].'.pdf';
        $this->load->library('m_pdf');
         $this->m_pdf->pdf->AddPage('L');
        // $this->m_pdf->pdf->SetWatermarkImage(base_url().'upload/background/2.jpeg');
        //  $this->m_pdf->pdf->showWatermarkImage = true;
         // $this->m_pdf->pdf->SetDisplayMode(20);
        //  $this->m_pdf->pdf->SetDisplayPreferences('CenterWindow');
        $this->m_pdf->pdf->WriteHTML($html);
		
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D");  
        
    }
    
    function test()
    
    {
        $cert=$this->model->check($_GET);
        if(@$cert===false || @$cert['Name']=='')
        {
            echo 'Access Forbidden';
            exit;
        }

        $data=array(
            'title'=>'Try For Learn : Validate your Document',
            'mode'=>'frontend',
            'value'=>$cert,
            'certificate'=>$this->model->getcertificate($cert['certificateid'])
           
        );
        //var_Dump($data);exit;
       $html=$this->load->view('certificate',$data,true);
        
          $pdfFilePath = 'TRYFORLEARN_CERTIFICATE_'.$_GET['dn'].'.pdf';
        $this->load->library('m_pdf');
         $this->m_pdf->pdf->AddPage('L');
          $this->m_pdf->pdf->WriteHTML($html);
		
        $this->m_pdf->pdf->Output($pdfFilePath, "D"); 
        
    }

   
    
}
