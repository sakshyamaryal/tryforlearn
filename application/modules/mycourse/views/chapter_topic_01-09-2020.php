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




.modal-fullscreen {
  padding: 0 !important;
  
}
.modal-dialog {
    width: 100%;
    max-width:-webkit-fill-available;
    height: 100%;
    margin: 0;
    padding: 0;
  }
  
  .modal-content {
    height: auto;
    min-height: 100%;
    border: 0 none;
    border-radius: 0;
  }
  

</style>
<div class="col-md-8" style="margin-top:10px;">

<h3>Chapter With Topic</h3>
<div class="row">

<?php foreach($data as $ch): 
 
    ?>
    <button class="collapsible"><?=$ch['chapter']['chapter_name'];?></button>
    <div  class="content">
  <?php foreach($ch['topic'] as $topic): 
 
 ?>

   <a href="javascript:void(0)" onclick="show_files(<?= $topic['topic_id']; ?>)"><i class="fa fa-folder"></i> <?= $topic['topic_name']; ?></a><br><br/>
  


<?php endforeach ;?>
</div>
 
 <?php endforeach ;?>
</div><br><br/>
 
</div>

</div>
</div>
</section>

<div class="modal modal-fullscreen" tabindex="-1" role="dialog" id="topicmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Documents & Files</h5>&nbsp;&nbsp;&nbsp;<b><a href="<?=base_url();?>enrollexam/mcq">MCQ Test</a></b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

     
      </div>
      <div class="modal-body" id="topicbody">
      </div>
      
    </div>
  </div>
</div>

<?php $this->load->view('script/topic_script'); ?>



