<style>
.note {
  background: #e0e0bb;
  border: 1px solid #728dbd;
  padding: 1rem;
}
ul.breadcrumb {
  padding: 10px 16px;
  list-style: none;
  background-color: #eee;
}
ul.breadcrumb li {
  display: inline;
  font-size: 18px;
}
ul.breadcrumb li+li:before {
  padding: 8px;
  color: black;
  content: "/\00a0";
}
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}
ul.breadcrumb li a:hover {
  color: #01447e;
  text-decoration: underline;
}

</style>
<div class="col-md-12 col-sm-12">
<ul class="breadcrumb">
<?php if($mode=='paid')
{ ?>
<li><a href="javascript:void(0)" onclick="showsubject()"><?=@$post['classname']?></a>
  </li>
 
  <li><a href="javascript:void(0)" data-classid="<?=@$post['class']?>" data-classname="<?=@$post['classname']?>" data-val="<?= @$post['subject']; ?>" data-subjectname="<?=@$post['subjectname']?>" class="getchapter<?= @$post['subject']; ?>" onclick="getchapter(<?= @$post['subject']; ?>)"><?=@$post['subjectname']?></a>
  </li>
<?php }else { ?>
  <li><a href="javascript:void(0)" data-type="f" data-val="<?= $post['level']; ?>" data-levelname="<?= $post['levelname']; ?>"  class="getchapter<?= $post['level']; ?>" onclick="getchapter(<?= @$post['level']; ?>)"><?=@$post['levelname']?></a>
  </li>
  <?php  } ?>
</ul>
</div>
<div class="col-md-12 col-sm-12 tabquizdetail">
<div class="col-md-12 ">
  <a href="javascript:void(0)" style="float:right;margin:5px;" id="startquiz" class="startgame"  data-val="subjectquiz"><i class="fa fa-play"></i> Play Subject Quiz</a>&nbsp;&nbsp;
  <a href="javascript:void(0)" style="float:right;margin:5px;" id="getdatasetmodal" class="getdatasetmodal"  data-val="subjectquiz"><i class="fa fa-play"></i> Play Model Quiz</a>&nbsp;&nbsp;
</div>
<div class="row quiznumber hide " >
    <div class="col-md-6 col-sm-6">
      <label style="color:red">Please Select Number Of Question to Attempt<br/>
      <!-- <small>Note: No. of Question will be per Group</small> -->
    </label>
      
      </div>
        <div class="col-md-4 col-sm-4">
        <select id="optqtype" class="form-control">
        <option value="">Select No.of Questions</option>
        <option value="5">5 Questions</option>
        <option value="10">10 Questions</option>
        <option value="20">20 Questions</option>
        <option value="30">30 Questions</option>
        </select>
        </div>
             
</div>
<br/>

<div class="col-md-12">
<?php foreach($list as $lcourse): 

?>


<div class="note" onclick="gettopic(<?= $lcourse->chapterid; ?>)">
<a href="javascript:void(0)" style="color:black;" data-val="<?= $lcourse->chapterid; ?>" data-chaptername="<?= $lcourse->chaptername; ?>" class="gettopic<?= $lcourse->chapterid; ?>" onclick="gettopic(<?= $lcourse->chapterid; ?>)"><?= $lcourse->chaptername; ?></a>
<small style="float:right">Total Topics: <?=$lcourse->totaltopic;?>
<?php if($lcourse->status=='1'){ echo '&nbsp;&nbsp;<i class="fa fa-check"></i>'; }else{ echo ''; } ?>

</small>

</div>




<?php endforeach ;?>
</div>

</div>
<br/>
<br/>
<br/>
<br/>

<?php $this->load->view('setmodal');?>
<script>
  $('.startgame').click(function(e){
    $('.quiznumber').removeClass('hide');
  
});
$('#optqtype').change(function(e){
  
  var type=$('.startgame').data('val');
  var opt=$('#optqtype').val();
  prepareForRefresh();


  beginexercise(opt,type);
});
var refresh_prepare = 1;
function prepareForRefresh()
{
  //console.log('refresh record');
	if( refresh_prepare > 0 )
	{
		// Turn refresh detection on so that if this
		// page gets quickly loaded, we know it's a refresh
		var today = new Date();
		var now = today.getUTCSeconds();
		document.cookie = 'SHTS=' + now + ';';
    document.cookie = 'SHTSP=' + escape(base_url) + ';';
	}
	else
	{
		// Refresh detection has been disabled
		document.cookie = 'SHTS=;';
		document.cookie = 'SHTSP=;';
	}
}
</script>