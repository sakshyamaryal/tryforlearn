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
<form id="expform" method="post" >
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
  <textarea  name="question" id="question"  class="form-control"><?= @$sm->question;?></textarea> 

   
  </div>
 

 </div>
 <div class="row">
   
  
  <div class="col-md-12">
  <label>
 Question (Nepali)
  </label>
  <textarea  name="question_nep" id="question_nep"  class="form-control"><?= @$sm->question_nep;?></textarea> 


  </div>
 

 </div>
 <div class="row">
   
  
   <div class="col-md-12">
   <label>
  Explanation 
   </label>
   <textarea  name="explanation" id="explanation"  class="form-control"><?= @$sm->explanation;?></textarea> 


   </div>
  
 
  </div>
  <div class="row">
   
  
   <div class="col-md-12">
   <label>
  Explanation (nepali)
   </label>
   <textarea  name="explanation_nep" id="explanation_nep"  class="form-control"><?= @$sm->explanation_nep;?></textarea> 

 
   </div>
  
 
  </div>
  <div class="row obj">
   
  
   <div class="col-md-6">
   <label>
  Option A
   </label>
   <textarea  name="option1" id="option1"  class="form-control"><?= @$sm->option1;?></textarea> 

 
   </div>
   <div class="col-md-6">
   <label>
  Option B
   </label>
   <textarea  name="option2" id="option2"  class="form-control"><?= @$sm->option2;?></textarea> 

   </div>
  
 
  </div>
  <div class="row obj">
   
  
   <div class="col-md-6">
   <label>
  Option C
   </label>
   <textarea  name="option3" id="option3"  class="form-control"><?= @$sm->option3;?></textarea> 

   </div>
   <div class="col-md-6">
   <label>
  Option D
   </label>
   <textarea  name="option4" id="option4"  class="form-control"><?= @$sm->option4;?></textarea> 

   </div>
  
 
  </div>
  <div class="row obj">
   
  
   <div class="col-md-6">
   <label>
  Option A (nepali)
   </label>
   <textarea  name="optionnep1" id="optionnep1"  class="form-control"><?= @$sm->option1_nep;?></textarea> 

   </div>
   <div class="col-md-6">
   <label>
  Option B (nepali)
   </label>
   <textarea  name="optionnep2" id="optionnep2"  class="form-control"><?= @$sm->option2_nep;?></textarea> 

   </div>
  
 
  </div>
  <div class="row obj">
   
  
   <div class="col-md-6">
   <label>
  Option C (nepali)
   </label>
   <textarea  name="optionnep3" id="optionnep3"  class="form-control"><?= @$sm->option3_nep;?></textarea> 

   </div>
   <div class="col-md-6">
   <label>
  Option D (nepali)
   </label>
   <textarea  name="optionnep4" id="optionnep4"  class="form-control"><?= @$sm->option4_nep;?></textarea> 

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
 <button type="button" class="btn btn-success" id="btnsave" onclick="submitdata()"> <?php if(isset($sm)){
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
function CKupdate() {
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
        CKEDITOR.instances[instance].setData('');
    }
}

//CKupdate();

 CKEDITOR.replace('question');
 CKEDITOR.replace('question_nep');

 CKEDITOR.replace('explanation');
 CKEDITOR.replace('explanation_nep');




 CKEDITOR.replace('option1');
 CKEDITOR.replace('option2');
 CKEDITOR.replace('option3');
 CKEDITOR.replace('option4');

 
 CKEDITOR.replace('optionnep1');
 CKEDITOR.replace('optionnep2');
 CKEDITOR.replace('optionnep3');
 CKEDITOR.replace('optionnep4');

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

function submitdata()
{
    for (instance in CKEDITOR.instances)
    CKEDITOR.instances[instance].updateElement();
    $.ajax({
                     url: '<?= base_url(); ?>exercise/save',
                     type: 'POST',
                     data: $( "#expform" ).serialize(),
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                             
                                toastr.success(response.message, {timeOut: 5000})
                                window.setTimeout(function(){

                                        window.location.href = response.link;

                                }, 1000);

							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });
}
</script>

   
   