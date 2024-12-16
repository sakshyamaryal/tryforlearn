<?php  

$url=base_url().'fckeditor/fckeditor.php';
include('./fckeditor/fckeditor.php');
$sBasePath = base_url() . 'fckeditor/';
$oFCKeditor = new FCKeditor('question');
$oFCKeditor->BasePath = $sBasePath;

$oFCKeditor1 = new FCKeditor('explanation');
$oFCKeditor1->BasePath = $sBasePath;

$oFCKeditor2 = new FCKeditor('option1');
$oFCKeditor2->BasePath = $sBasePath;

$oFCKeditor3 = new FCKeditor('option2');
$oFCKeditor3->BasePath = $sBasePath;

$oFCKeditor4 = new FCKeditor('option3');
$oFCKeditor4->BasePath = $sBasePath;

$oFCKeditor5 = new FCKeditor('option4');
$oFCKeditor5->BasePath = $sBasePath;

$oFCKeditorqnep = new FCKeditor('question_nep');
$oFCKeditorqnep->BasePath = $sBasePath;

$oFCKeditorexnep = new FCKeditor('explanation_nep');
$oFCKeditorexnep->BasePath = $sBasePath;

$oFCKeditoropta = new FCKeditor('optionnep1');
$oFCKeditoropta->BasePath = $sBasePath;
$oFCKeditoroptb = new FCKeditor('optionnep2');
$oFCKeditoroptb->BasePath = $sBasePath;
$oFCKeditoroptc = new FCKeditor('optionnep3');
$oFCKeditoroptc->BasePath = $sBasePath;
$oFCKeditoroptd = new FCKeditor('optionnep4');
$oFCKeditoroptd->BasePath = $sBasePath;



?>
 
<div id="content" class="col-lg-10 col-sm-10">

    <div>
    <ul class="breadcrumb">
    <li>
    <a href="<?= $admin_base_url; ?>">Home</a>
    </li>
    <li>
    <a href="<?= base_url(); ?>exercise">Exercise</a>
    </li>
    <li>
    <a href="#"><?= $title;?></a>
    </li>
    </ul>
    </div>
    <div class=" row">
    <div class="box col-md-12">
<div class="box-inner">
<div class="box-header well" data-original-title="">
<h2><i class="fa fa-plus"></i> <?= $title;?></h2>

</div>
<div class="box-content">
<b style="color:green;"><?php echo $this->session->flashdata('msg'); ?></b><br/>

Note: <bold style="color:red;">* Fields are Required.</bold>
<form id="expform" method="post" action="<?=base_url();?>exercise/save">
<?php if(isset($sm)){?>
       
<input type="hidden" id="id" name="id" value="<?=@$sm->eid;?>" />
 <?php  } ?>
 <input type="hidden"  name="classid" value="<?=@$classid;?>" />
 <input type="hidden"  name="subjectid" value="<?=@$subjectid;?>" />
 <input type="hidden"  name="chapterid" value="<?=@$chapterid;?>" />
 <input type="hidden" name="groupid" value="<?=@$groupid;?>" />
 <input type="hidden" name="examtypeid" value="<?=@$examtype;?>" />

 <div class="row">
 <div class="col-md-2">
 <label>
 Question Type<sup style="color:red;">*</sup>
  </label>
                    <select id="qntype" name="qntype" class="form-control" data-val="<?=(@$sm->is_subj_obj!='')?@$sm->is_subj_obj:'Y';?>" onchange="switchobj()">
                    <option value="Y" <?php if(@$sm->is_subj_obj=='Y'){echo 'selected';}else echo '';?>>Subjective</option>
                    <option value="N" <?php if(@$sm->is_subj_obj=='N'){echo 'selected';}else echo '';?>>Objective</option>
          
                    </select>
  </div>
  <?php if((int)@$chapterid<1): ?>
    <div class="col-md-2 ">
  <label>
 Date<sup style="color:red;">*</sup>
  </label>
  <input type="date"  class="form-control" placeholder="" name="qndate" id="qndate" value="<?=(@$sm->questiondate!='') ? $sm->questiondate :date('Y-m-d');?>">

  </div>
  <?php endif;?>
  <!-- <div class="col-md-2">
 <label>
 Is For All Date<sup style="color:red;">*</sup>
  </label>
                    <select id="fordate" name="fordate" class="form-control" data-val="<?=(@$sm->is_common!='')?@$sm->is_common:'Y';?>" onchange="switchdate()" >
                    <option value="Y"  <?php if(@$sm->is_common=='Y'){echo 'selected';}else echo '';?>>Yes</option>

                    <option value="N" <?php if(@$sm->is_common=='N'){echo 'selected';}else echo '';?>>No</option>

          
                    </select>
  </div> -->
  <!-- <div class="col-md-2 hidedate">
  <label>
 Date<sup style="color:red;">*</sup>
  </label>
  <input type="date"  class="form-control" placeholder="" name="qndate" id="qndate" value="<?=(@$sm->questiondate!='') ? $sm->questiondate :date('Y-m-d');?>">

  </div> -->
  <!-- <div class="col-md-2">
 <label>
 Is Timer?<sup style="color:red;">*</sup>
  </label>
                    <select id="istimer" name="istimer" class="form-control" data-val="<?=(@$sm->is_timer!='')?@$sm->is_timer:'Y';?>" onchange="switchtimer()">
                    <option value="Y"  <?php if(@$sm->is_timer=='Y'){echo 'selected';}else echo '';?>>Yes</option>
                    <option value="N" <?php if(@$sm->is_timer=='N'){echo 'selected';}else echo '';?>>No</option>
          
                    </select>
  </div> -->

  <div class="col-md-2 ">
  <label>
 Timer In Minute.<sup style="color:red;">*</sup>
  </label>
  <input type="number"  class="form-control" placeholder="" name="timer" id="timer" min="0" value="<?=(@$sm->timing!='') ? $sm->timing :'1';?>">

  </div>
 
 </div>
 <div class="row">
   
  
  <div class="col-md-12">
  <label>
 Question<sup style="color:red;">*</sup>
  </label>
   <?php
if(isset($sm)&& $sm->question!=''):
                                            
  $oFCKeditor->Value = $sm->question;
endif;

$oFCKeditor->Width = '100%';
$oFCKeditor->Height = '300';

$oFCKeditor->Create();
?>    
  </div>
 

 </div>
 <div class="row">
   
  
  <div class="col-md-12">
  <label>
 Question (Nepali)
  </label>
  <?php
if(isset($sm)&& $sm->question_nep!=''):
                                            
  $oFCKeditorqnep->Value = $sm->question_nep;
endif;

$oFCKeditorqnep->Width = '100%';
$oFCKeditorqnep->Height = '300';

$oFCKeditorqnep->Create();
?>   
  </div>
 

 </div>
 <div class="row">
   
  
   <div class="col-md-12">
   <label>
  Explanation 
   </label>
   <?php
 if(isset($sm)&& $sm->explanation!=''):
                                             
   $oFCKeditor1->Value = $sm->explanation;
 endif;
 
 $oFCKeditor1->Width = '100%';
 $oFCKeditor1->Height = '300';
 
 $oFCKeditor1->Create();
 ?>   
   </div>
  
 
  </div>
  <div class="row">
   
  
   <div class="col-md-12">
   <label>
  Explanation (nepali)
   </label>
   <?php
 if(isset($sm)&& $sm->explanation_nep!=''):
                                             
   $oFCKeditorexnep->Value = $sm->explanation_nep;
 endif;
 
 $oFCKeditorexnep->Width = '100%';
 $oFCKeditorexnep->Height = '300';
 
 $oFCKeditorexnep->Create();
 ?>   
   </div>
  
 
  </div>
  <div class="row obj">
   
  
   <div class="col-md-6">
   <label>
  Option A
   </label>
   <?php
 if(isset($sm)&& $sm->option1!=''):
                                             
   $oFCKeditor2->Value = $sm->option1;
 endif;
 
 $oFCKeditor2->Width = '100%';
 $oFCKeditor2->Height = '300';
 
 $oFCKeditor2->Create();
 ?>   
   </div>
   <div class="col-md-6">
   <label>
  Option B
   </label>
   <?php
 if(isset($sm)&& $sm->option2!=''):
                                             
   $oFCKeditor3->Value = $sm->option2;
 endif;
 
 $oFCKeditor3->Width = '100%';
 $oFCKeditor3->Height = '300';
 
 $oFCKeditor3->Create();
 ?>   
   </div>
  
 
  </div>
  <div class="row obj">
   
  
   <div class="col-md-6">
   <label>
  Option C
   </label>
   <?php
 if(isset($sm)&& $sm->option3!=''):
                                             
   $oFCKeditor4->Value = $sm->option3;
 endif;
 
 $oFCKeditor4->Width = '100%';
 $oFCKeditor4->Height = '300';
 
 $oFCKeditor4->Create();
 ?>   
   </div>
   <div class="col-md-6">
   <label>
  Option D
   </label>
   <?php
 if(isset($sm)&& $sm->option4!=''):
                                             
   $oFCKeditor5->Value = $sm->option4;
 endif;
 
 $oFCKeditor5->Width = '100%';
 $oFCKeditor5->Height = '300';
 
 $oFCKeditor5->Create();
 ?>   
   </div>
  
 
  </div>
  <div class="row obj">
   
  
   <div class="col-md-6">
   <label>
  Option A (nepali)
   </label>
   <?php
 if(isset($sm)&& $sm->option1_nep!=''):
                                             
   $oFCKeditoropta->Value = $sm->option1_nep;
 endif;
 
 $oFCKeditoropta->Width = '100%';
 $oFCKeditoropta->Height = '300';
 
 $oFCKeditoropta->Create();
 ?>   
   </div>
   <div class="col-md-6">
   <label>
  Option B (nepali)
   </label>
   <?php
 if(isset($sm)&& $sm->option2_nep!=''):
                                             
   $oFCKeditoroptb->Value = $sm->option2_nep;
 endif;
 
 $oFCKeditoroptb->Width = '100%';
 $oFCKeditoroptb->Height = '300';
 
 $oFCKeditoroptb->Create();
 ?>   
   </div>
  
 
  </div>
  <div class="row obj">
   
  
   <div class="col-md-6">
   <label>
  Option C (nepali)
   </label>
   <?php
 if(isset($sm)&& $sm->option3_nep!=''):
                                             
   $oFCKeditoroptc->Value = $sm->option3_nep;
 endif;
 
 $oFCKeditoroptc->Width = '100%';
 $oFCKeditoroptc->Height = '300';
 
 $oFCKeditoroptc->Create();
 ?>   
   </div>
   <div class="col-md-6">
   <label>
  Option D (nepali)
   </label>
   <?php
 if(isset($sm)&& $sm->option4_nep!=''):
                                             
   $oFCKeditoroptd->Value = $sm->option4_nep;
 endif;
 
 $oFCKeditoroptd->Width = '100%';
 $oFCKeditoroptd->Height = '300';
 
 $oFCKeditoroptd->Create();
 ?>   
   </div>
  
 
  </div>
 <div class="row obj">
 <div class="col-md-2">
 <select id="coption" name="coption" class="form-control">
 <option value="1" <?php if(@$sm->correctoption=='1'){echo 'selected';}else echo '';?>>option A</option>
 <option value="2" <?php if(@$sm->correctoption=='2'){echo 'selected';}else echo '';?>>option B</option>
 <option value="3" <?php if(@$sm->correctoption=='3'){echo 'selected';}else echo '';?>>option C</option>
 <option value="4" <?php if(@$sm->correctoption=='4'){echo 'selected';}else echo '';?>>option D</option>
 </select>
 </div>
 <div class="col-md-2">
 <select id="coptionnep" name="coptionnep" class="form-control">
 <option value="1" <?php if(@$sm->correctoption_nep=='1'){echo 'selected';}else echo '';?>>option A (nepali)</option>
 <option value="2" <?php if(@$sm->correctoption_nep=='2'){echo 'selected';}else echo '';?>>option B (nepali)</option>
 <option value="3" <?php if(@$sm->correctoption_nep=='3'){echo 'selected';}else echo '';?>>option C (nepali)</option>
 <option value="4" <?php if(@$sm->correctoption_nep=='4'){echo 'selected';}else echo '';?>>option D (nepali)</option>
 </select>
 </div>
 </div>
  
  <hr>

  <div class="row">
 <div class="col-md-5">
 </div>
 <div class="col-md-4">
 <button type="submit" class="btn btn-success" id="btnsave" > <?php if(isset($sm)){
       echo 'Update';

   }else {echo 'Submit';} ?></button>
 </div>
 
</div>
<hr>

</form>

</div>
</div>
</div>
</div>
<script>
 $('document').ready(function(e){
 
 let qtype=$('#qntype').data('val');
           
 changebj(qtype);

 let fordate=$('#fordate').data('val');
 //changedate(fordate);

 let timer=$('#istimer').data('val');
           
 //changetimer(timer);
});
function switchobj()
{
    let qtype=$('#qntype').val();
           
           changebj(qtype);
}
function changebj(qtype)
{
    if(qtype=='Y')
    {
        $('.obj').hide();
    } 
    else
    {
        $('.obj').show();

    }    
}

function switchdate()
{
    let date=$('#fordate').val();
           
           changedate(date);
}
function changedate(date)
{
    if(date=='Y')
    {
        $('.hidedate').hide();
    } 
    else
    {
        $('.hidedate').show();

    }    
}

function switchtimer()
{
    let timer=$('#istimer').val();
           
           changetimer(timer);
}
function changetimer(istimer)
{
    if(istimer=='N')
    {
        $('.hidetimer').hide();
    } 
    else
    {
        $('.hidetimer').show();

    }    
}
</script>

   
   