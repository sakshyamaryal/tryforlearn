<style>
.note {
  background: #e4e6f7;
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
<div class="col-md-9 rightcontainer" style="margin-top:10px;">

    <div class="row">
    <div class="col-md-12 col-sm-12">
    <ul class="breadcrumb">
    <li><a href="<?=base_url();?>studentpanel">Home</a>
    </li>
    
    <li><a href="<?=base_url();?>mygrades"><?=$title;?> </a>
    </li>
    </ul>
    </div>
    </div>
<div class="row">
<div class="col-md-12 col-sm-12" style="margin-top:5px;" id="examwrapper">
   
 <?php if(count($list)<1)
 {
     echo '<p style="color:red;">No any exam given yet.!</p>';
 }
 else{
   ?> 
   <div class="row">
   <?php
 foreach($list as $key=> $row): 

?>
<div class="col-md-3 col-sm-3" style="margin-bottom: 18px;">

<div class="card" style="width: 21rem;">
  <div class="card-header">
    Class: <b><?= (@$row->classname!='')?$row->classname:''; ?></b>
   
    <br/>Course Type : <b><?= $row->levelname; ?></b>
    <br/> <small style="float:right">Date: <?= $row->examdate; ?>
    </small>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Exam Category: <?= $row->examcategory; ?></li>
    <li class="list-group-item">Top 10 Rank List: <br/>
    <?php foreach($row->rank as $val)
    {
      if($val->studentid==$this->session->userdata('userid'))
      $me=' (Me)';
       else
       $me='';
        echo '<b>'.$val->rank.') '.$val->fullname.' '.$me.'</b> <br/>';
    } ?>
    </li>
  </ul>
</div>



</div>



<?php endforeach ; }?>
</div>
</div>
</section>
<br/><br/>
<br/><br/>
<br/><br/>
