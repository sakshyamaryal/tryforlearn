<style>
.collapsible {
  background-color: #007bff;
    color: white;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    margin-bottom: 5px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.collapsible:after {
  content: '\002B';
  color: white;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2212";
}

.content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}



</style>
<div class="col-md-8" style="margin-top:10px;">

<h3>Class With Subject</h3>
<div class="row">

<?php foreach($data as $ch): 
 
    ?>
    <button class="collapsible"><?=$ch['class']['class_name'];?></button>
    <div  class="content">
  <?php foreach($ch['subject'] as $sub): 
 
 ?>

   <a href="<?=base_url();?>mycourse/get_topic/<?= $sub['class_sub_id']; ?>" ><i class="fa fa-book"></i> <?= $sub['subject_name']; ?></a><br><br/>
  


<?php endforeach ;?>
</div>
 
 <?php endforeach ;?>
</div><br><br/>
 
</div>

</div>
</div>
</section>



<?php $this->load->view('script/topic_script'); ?>



