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
    display: flex;
}
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
        display:flex;
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
  /*background:lightseagreen;*/
  background:#20b239;
  color:#fff;
}
.bothselected {
  background:#20b239;
  color:#fff;
}
.submitans {
  /*background:#ff5e00;*/
  background:#ff2f2fab;
  color:#fff;
}
   

</style>
<form method="post" id="answerform">
<button type="button" class="btn btn-default" style="width:200px;" onclick="restorequiz('q')">Go Back</button>


<?php foreach($exer as $key =>$val){
    $total=$val->perqnmark*count($val->ques);
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
foreach($val->ques as $list){
     $sn++;
 ?>
<div class="privew">
<div class="questionsBox">
<div class="questions" >
<?=$sn; ?>.<span style="order:3;margin-left:2rem;">
<a  href="javascript:void(0)" style="color:yellow" onclick="explanation(<?=$list->eid;?>)" >
<i class="fa fa-exclamation-circle"></i></a>
</span>
<span class="qnread<?=$list->eid;?>"> 
<?php if($this->session->userdata('language')=='ENG')
echo
$list->question;
else
echo $list->question_nep;  ?>
</span>

</div>
<div class="answerlist">
<input type="hidden" name="qid[]" value="<?=$list->eid;?>" />
<input type="hidden" name="qnmark[]" value="<?=$val->perqnmark;?>" />
<ul class="answerList" >
<?php $i=0; $anstotal=count($list->ans) ;
 foreach($list->ans as $row){ 
    $i++;
if($row->optionid==$ans[$list->eid])
{
    $class1="submitans";
}
else
{
    $class1='';

}
if($this->session->userdata('language')=='ENG')
{
    $list->correctoptionid=$list->correctoptionid;
}
else
{
    $list->correctoptionid=$list->correctoptionid_nep;
}
if($list->correctoptionid==$row->optionid  && $list->correctoptionid==$ans[$list->eid])
{
    $style="visibility:true";
    $class="bothselected";
    $class1="";
    
    
}else  if($list->correctoptionid==$row->optionid)
{
    $style="visibility:true";
    $class="selected";
    
    
}
else
{
    $style="visibility:hidden";
    $class='';

}
     ?>
<li class="select">
<label class="labels <?=$class;?> <?=$class1;?>" for="answerGroup_0" id="q_answerlabel<?=$sn; ?><?=$i;?><?=$list->eid;?>" style="display:flex;">
<input type="radio" name="answer<?=$list->eid;?>[]" value="<?= $row->optionid; ?>" 
id="q_answer<?=$sn; ?><?=$i;?><?=$list->eid;?>"   data-at="<?=$anstotal;?>"
class="rdio" > &nbsp;<?=$i;?>. &nbsp;
<?php if($this->session->userdata('language')=='ENG')
echo
$row->optionname;
else
echo $row->optionname_nep; ?> 
<span class="float-right" style="margin-top:-30px; <?=$style;?>" id="tick<?=$sn; ?><?=$i;?><?=$list->eid;?>">
<i class="fa fa-check" ></i></span>
 </label>
</li>
<?php } ?>
</ul>
</div>
                        
</div>
</div>
<br/>
<?php }  ?>


</div>
</div>
<?php } ?>
<button type="button" class="btn btn-default" style="width:200px;" onclick="restorequiz('q')">Go Back</button>
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


</script>