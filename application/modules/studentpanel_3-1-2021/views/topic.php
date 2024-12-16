<style>
.note {
  background: #dadada;
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
  <li><a href="javascript:void(0)" data-val="<?= @$post['chapter']; ?>" data-chaptername="<?=@$post['chaptername']?>" class="gettopic<?= @$post['chapter']; ?>" onclick="gettopic(<?= @$post['chapter']; ?>)"><?=@$post['chaptername']?></a>
  </li>
</ul>
</div>

<div class="col-md-12">
<?php foreach($list as $lcourse): 

?>

<div class="note" onclick="getmenu(<?= $lcourse->topicid; ?>)">
<a href="javascript:void(0)" style="color:black;" data-val="<?= $lcourse->topicid; ?>" data-topicname="<?= $lcourse->topicname; ?>" class="getmenu<?= $lcourse->topicid; ?>" onclick="getmenu(<?= $lcourse->topicid; ?>)"><?= $lcourse->topicname; ?></a>
</div>




<?php endforeach ;?>
</div>
<br/>



