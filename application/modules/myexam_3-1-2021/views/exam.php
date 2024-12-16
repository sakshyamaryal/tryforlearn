<style>
.note {
  background: #e4e6f7;
  border: 1px solid #728dbd;
  padding: 1rem;
  margin-top: 10px;
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
<div class="col-md-9" style="margin-top:10px;">

    <div class="row">
    <div class="col-md-12 col-sm-12">
    <ul class="breadcrumb">
    <li><a href="<?=base_url();?>studentpanel">Home</a>
    </li>
    
    <li><a href="<?=base_url();?>myexam"><?=$title;?> </a>
    </li>
    </ul>
    </div>
    </div>
<div class="row">
<div class="col-md-12 col-sm-12" style="margin-top:5px;" id="examwrapper">
   
<?php if(count($list)<1)
 {
     echo '<p style="color:red;">No any exam for today.!</p>';
 }
 
 foreach($list as $key=> $row): 

?>

<div class="note">
<a href="javascript:void(0)" style="color:black;" data-val="<?= $row->questiondate; ?>" data-issubj="<?= $row->is_subj_obj; ?>" data-classid="<?= $row->classid;?>" data-subjectid="<?= $row->subjectid;?>" data-chapterid="<?= $row->chapterid;?>" data-levelid="<?= $row->levelid;?>" data-examtypeid="<?= $row->examtypeid;?>"  class="getexam<?= $key; ?>" onclick="getexam(<?= $key; ?>)">Exam Of  <b><?= $row->levelname; ?></b> <?php if(@$row->subject_name !='')  echo '&nbsp;&nbsp; Subject: '.$row->subject_name;   else echo ''; ?>
&nbsp;&nbsp;<small>Exam Type: <?=$row->examtypename;?></small> </a>

<small style="float:right">Exam Date: <?=$row->questiondate;?></small>
</div>




<?php endforeach ;?>
</div>
</div>
</section>
<br/><br/>
<br/><br/>
<br/><br/>

<script>
var base_url='<?php  echo base_url();?>';
</script>
<?php $this->load->view('script/exam_script');?>

