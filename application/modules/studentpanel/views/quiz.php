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
    /*padding: 10px 20px 0px;*/
    box-shadow: inset 0 0 30px rgba(000,000,000,0.1), inset 0 0 4px rgba(255,255,255,1);
    border-radius: 3px;
    margin: 0 10px;
}
.questions span{
    word-break: break-all;
}
.questions{ 
	margin-bottom: 15px;
    background: #007fbe;
    color: #FFF;
    font-size: 22px;
    padding: 8px 20px;
    font-weight: 300;
    /*margin: 0 -30px 10px;*/
    position: relative;
    display:flex;

}
    /* .answerList{
        margin-bottom: 15px;
    list-style: none;
    } */
    .answerList{
        margin-bottom: 15px;
    list-style: none;
    margin-right:20px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-column-gap: 1rem;
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
  color:#fff;
}
   

</style>
<?php if(count($exer)<1)
{
    echo '<p style="color:red">No any Quiz Questions.</p>';
 
}else
{
 ?>
 
<form method="post" id="answerform">
<input type="hidden"  name="type" value="quiz"/>

<input type="hidden"  name="classid" value="<?= $post['class']; ?>"/>
<input type="hidden"  name="subjectid" value="<?= $post['subject']; ?>"/>
<input type="hidden"  name="chapterid" value="<?= $post['chapter']; ?>"/>


 <input type="hidden" id="totaltimer" name="totaltimer" />
 <input type="hidden" id="qntimer" name="qntimer" />
<strong id="timer" style="color:red;"></strong>

<?php
echo '<div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 2px;">';
    for ($i = 0; $i < count($exer); $i++) {
        echo '<div class="btn btn-danger btn-quiz-answered-'.($i+1).'" onclick="javascript:void(0);">' . ($i + 1) . '</div>';
    }
echo '</div>';
?>


<?php //foreach($exer as $key =>$val){
    // $total=$val->perqnmark*count($val->ques);
    // if((double)$total>1)
    // {
    //     $mark='marks';
    // }
    // else
    // {
    //     $mark="mark";
    // }
    ?>

<div class="row">
<div class="col-md-12 col-sm-12" style="margin-top:7px;">

<?php
$sn=0;
$timer=0;

foreach($exer as $list){
     $sn++;
     if($list->examtypeid==0 || $list->examtypeid==8)
    $timer +=$list->timing;
 ?>
<div class="privew">
<div class="questionsBox">
<div class="questions" >
<?=$sn; ?>.
<!-- <span style="order:3;margin-left:2rem;">
<a  href="javascript:void(0)" style="color:yellow" onclick="explanation(<?=$list->eid;?>)" >
<i class="fa fa-exclamation-circle"></i></a>
</span> -->
<span class="qnread<?=$list->eid;?>">
<?php
if($this->session->userdata('language')=='ENG')
echo
$list->question;
else
echo $list->question_nep; ?>
 </span>

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
<input type="hidden" name="qnmark[]" value="<?=$val->perqnmark;?>" />
<ul class="answerList" >
<?php $i=0; $anstotal=count($list->ans) ; foreach($list->ans as $row){ $i++; ?>
<li class="select">
<label class="labels" for="answerGroup_0" id="q_answerlabel<?=$sn; ?><?=$i;?><?=$list->eid;?>" onclick="get_visibility(<?=$sn; ?>,<?=$i;?>,<?=$list->eid;?>)" style="display:flex;">
<input type="radio" name="answer<?=$list->eid;?>[]" value="<?= $row->optionid; ?>" 
id="q_answer<?=$sn; ?><?=$i;?><?=$list->eid;?>"   data-at="<?=$anstotal;?>"
class="rdio" onclick="get_visibility(<?=$sn; ?>,<?=$i;?>,<?=$list->eid;?>)"> &nbsp;<?=$i;?>. &nbsp;
<?php if($this->session->userdata('language')=='ENG')
echo
$row->optionname;
else
echo $row->optionname_nep; ?> 
<span class="float-right" style="visibility:hidden; " id="tick<?=$sn; ?><?=$i;?><?=$list->eid;?>">
<i class="fa fa-check"></i></span>
 </label>
</li>
<?php } ?>
</ul>
</div>
                        
</div>
</div>
<br/>
<?php // }  ?>


</div>
</div>
<?php } ?>
<button type="button" class="btn btn-success" id="btnsubmit" style="width:200px;" onclick="submit_answer('q')">Submit</button>

<br/>
<br/><br/>
</form>
<br/>
<br/>
<br/><br/>
<br/>
<br/>
<br/>
<br/><br/>
<script>
var timeleft = <?= $timer; ?>;

// REMOVE FROM MINUTES TO SECOND::
// timeleft=parseFloat(timeleft*60);

// NOW FROM DB IN SECOND TIMER IS RECEIVED
timeleft=parseFloat(timeleft);

$('#qntimer').val(timeleft);


// if(timeleft>0)
// {
//     var downloadTimer = setInterval(function(){
//   document.getElementById("timer").innerHTML = timeleft + " seconds remaining";
// $('#totaltimer').val(timeleft);
//   timeleft -= 1;
//   if(timeleft <= 0){
//     clearInterval(downloadTimer);
//     document.getElementById("timer").innerHTML = "Finished";
//     $('#totaltimer').val(0);

//     submit_answer('q');
//   }
// }, 1000);
// }

if (timeleft > 0) {

    var downloadTimer = setInterval(function() {
        var formattedTime = formatTime(timeleft);

        document.getElementById("timer").innerHTML = formattedTime + " remaining";
        $('#totaltimer').val(timeleft);


        timeleft -= 1;

        if (timeleft <= 0) {
            clearInterval(downloadTimer);
            document.getElementById("timer").innerHTML = "Finished";
            $('#totaltimer').val(0);
            submit_answer('q');
        }
    }, 1000); 
}

function formatTime(seconds) {
    var hours = Math.floor(seconds / 3600);
    var minutes = Math.floor((seconds % 3600) / 60);
    var remainingSeconds = seconds % 60;

    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    remainingSeconds = remainingSeconds < 10 ? '0' + remainingSeconds : remainingSeconds;

    return hours + ':' + minutes + ':' + remainingSeconds;
}

function get_visibility(val,ansid,qid)
{
    let at=$('#q_answer'+val+ansid+qid).attr("data-at");
    for(a = 1; a <= at; a++) 
   {
    $('#q_answer'+val+a+qid).prop('checked',false);

    $('#q_answerlabel'+val+a+qid).removeClass('selected');
    $('#tick'+val+a+qid).attr('style','visibility: hidden');
   }
   
    $('#q_answer'+val+ansid+qid).prop('checked',true);
    $('#q_answerlabel'+val+ansid+qid).addClass('selected');
    $('#tick'+val+ansid+qid).attr('style','visibility: true;  margin-left: 2rem;');
   
    $('.btn-quiz-answered-' + val).attr('style', 'visibility: visible; background-color: lightseagreen;');

}

</script>
<?php } ?>