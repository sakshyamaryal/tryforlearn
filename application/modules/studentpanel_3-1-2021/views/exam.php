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
.questions{ 
    margin-bottom: 15px;
    background: #007fbe;
    color: #FFF;
    font-size: 22px;
    padding: 8px 30px;
    font-weight: 300;
    margin: -20px -23px 10px;
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
<?php if(count($exer)<1)
{
    echo '<p style="color:red">No any Exercises.</p>';
 
}else
{
 ?>
<form method="post" id="answerform">
<input type="hidden"  name="type" value="exercise"/>

<input type="hidden"  name="classid" value="<?= $post['class']; ?>"/>
<input type="hidden"  name="subjectid" value="<?= $post['subject']; ?>"/>
<input type="hidden"  name="chapterid" value="<?= $post['chapter']; ?>"/>
 <input type="hidden" id="totaltimer" name="totaltimer" />
 <input type="hidden" id="qntimer" name="qntimer" />
 <input type="hidden" id="totalmark" name="totalmark" />
<strong id="timer" style="color:red;"></strong>

<?php $grouptotal=0; foreach($exer as $key =>$val){
    $total=$val->perqnmark*count($val->ques);
    $grouptotal=$grouptotal+$total;
    if((double)$total>1)
    {
        $mark='marks';
    }
    else
    {
        $mark="mark";
    }
    ?>

<div class="row">
<div class="col-md-12 col-sm-12" style="margin-top:7px;">
<h3 style="text-align:center;"><?=$val->groupname;?> ( <?=$val->perqnmark;?> X <?=count($val->ques);?> = <?=$total.' '.$mark;?>  )</h3>

<?php
$sn=0;
$timer=0;
foreach($val->ques as $list){
     $sn++;
     if($list->examtypeid==0 || $list->examtypeid==8)
     $timer +=$list->timing;
 ?>
<div class="privew">
<div class="questionsBox">
<div class="questions" >
<?=$sn; ?>.
<span style="float:right">
<a  href="javascript:void(0)" style="color:yellow" onclick="explanation(<?=$list->eid;?>)" >
<i class="fa fa-exclamation-circle"></i></a>
</span>
<span class="qnread<?=$list->eid;?>" style="display:inline-block;"> <?php
if($this->session->userdata('language')=='ENG')
echo
$list->question;
else
echo $list->question_nep;
 ?> </span>

</div>
<div class="answerlist">
<input type="hidden"  name="isself" value="<?= ($list->is_common=='Y')?1:0 ;?>"/>
<input type="hidden"  name="levelid" value="<?= $list->levelid; ?>"/>
<input type="hidden"  name="examtypeid" value="<?= $list->examtypeid; ?>"/>
<?php if($list->is_common=='N')
{ ?>
<input type="hidden"  name="qndate" value="<?=@$list->questiondate;?>"/>
<?php } ?>
<input type="hidden" name="qid[]" value="<?=$list->eid;?>" />
<textarea class="form-control" name="answer[]" placeholder="Write your answer here..">
</textarea><br/>
</div>
                        
</div>
</div>
<br/>
<?php }  ?>


</div>
</div>
<?php } ?>
<button type="button" class="btn btn-success" id="btnsubmit" style="width:200px;" onclick="submit_answer('e')">Submit</button>

</form>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<script>
var timeleft = <?= $timer; ?>;
var totalmark = '<?= $grouptotal; ?>';
$('#totalmark').val(totalmark);
timeleft=parseFloat(timeleft);
$('#qntimer').val(timeleft);

if(timeleft>0)
{
var downloadTimer = setInterval(function(){
  document.getElementById("timer").innerHTML = timeleft + " seconds remaining";
$('#totaltimer').val(timeleft);
  timeleft -= 1;
  if(timeleft <= 0){
    clearInterval(downloadTimer);
    document.getElementById("timer").innerHTML = "Finished";
    $('#totaltimer').val(0);

    submit_answer('e');
  }
}, 1000);

}

</script>
<?php } ?>