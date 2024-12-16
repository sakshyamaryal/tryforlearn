
<style>
.privew{
    margin-bottom: 20px;
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
  
}
.questionsBox{
    display: block;
    border: solid 1px #e3e3e3;
    padding: 10px 20px 0px;
    box-shadow: inset 0 0 30px rgba(000,000,000,0.1), inset 0 0 4px rgba(255,255,255,1);
    border-radius: 3px;
    margin: 0 10px;
}
.questions{ margin-bottom: 15px;
    background: #007fbe;
    color: #FFF;
    font-size: 22px;
    padding: 8px 30px;
    font-weight: 300;
    margin: 0 -30px 10px;
    position: relative;}
    .answerList{
        margin-bottom: 15px;
    list-style: none;
    }
    .select{
        border-top-width: 0;
    padding: 3px 0;
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
    }
    .labels{
        border-color: blue;
    background: white;
    display: block;
    padding: 6px;
    border-radius: 6px;
    border: solid 1px #dde7e8;
    font-weight: 400;
    font-size: 13px;
    cursor: pointer;
    font-family: Arial, sans-serif;
    }
    .rdio{
        margin: 4px 0 0;
    margin-top: 1px\9;
    line-height: normal;
    
    }
    .selected {
  background:lightseagreen;
}
   

</style>
<div id="content" class="col-lg-10 col-sm-10">

<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?= $admin_base_url; ?>">Home</a>
        </li>
        <li>
            <a href="<?= base_url(); ?>studentexercise">Student Exercise</a>
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
                <h2><i class="fa fa-list"></i> <?= $title;?></h2>

            </div>
            <div class="box-content">
               <form method="post" id="marksform">
               <!-- Exam Start -->
               
<?php $grouptotal=0; foreach($exer as $key =>$val){
    $total=$val->perqnmark*count($val->ques);
    $grouptotal=$grouptotal+$total;
    if((int)$total>1)
    {
        $mark='marks';
    }
    else
    {
        $mark="mark";
    }
    ?>

<div class="row">
<div class="col-md-12" style="margin-top:7px;">
<h3 style="text-align:center;"><?=$val->groupname;?> ( <?=$val->perqnmark;?> X <?=count($val->ques);?> = <?=$total.' '.$mark;?>  )</h3>

<?php
$sn=0;
$timer=0;
foreach($val->ques as $list){
     $sn++;
     $timer +=$list->timing;
 ?>
<div class="privew">
<div class="questionsBox">
<div class="questions" >
<?=$sn; ?>.<span style="float:right" id="cogsaudio<?=$list->eid;?>">

</span>
<span class="qnread<?=$list->eid;?>"> <?php
if($val->language=='ENG')
echo $list->question;
else
echo $list->question_nep;
 ?> </span>

</div>
<div class="answerlist">

<input type="hidden" name="examid[]" value="<?=$list->examid;?>" />
<input type="hidden" name="setid[]" value="<?=$list->examsetid;?>" />
<textarea class="form-control" name="answer[]" placeholder="Write your answer here..">
<?=@$list->submitted_answer; ?>
</textarea><br/>
Mark: <input type="number" name="marks[]" value="<?=$list->obtained_marks;?>" min="0" max="100" step="0.5" class="form-control" style="width:100px">
</div>
                        
</div>
</div>
<br/>
<?php }  ?>


</div>
</div>
<?php } ?>

               <!-- Exam End -->
 <button type="submit" id="markbutton" class="btn btn-success">Submit</button>              
</form>           
               

            </div>
        </div>
    </div>
</div>







<script>
var base_url="<?= base_url();?>"
</script>
<?php $this->load->view('script/mark_script'); ?>

