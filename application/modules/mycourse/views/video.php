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

<h3>Video Materials</h3>
<div class="row">

<?php foreach($vid as $data): 
 
    ?>
    <button class="collapsible"><?= $data['file_name'] ; ?></button>
    <div  class="content">
 
 <?php ?>

 <video width="800" height="400" controls controlsList="nodownload" preload="none"  onclick="count(<?=$data['file_id'];?>)">
  <source src="<?=base_url();?>upload/topic/<?= $data['file'] ; ?>" >
  </video>  


</div>
 
 <?php endforeach ;?>
 <?php foreach($othervid as $data1): 
 
 $sid = session_id();
 $path=$data1['link_video'];
 $hash = md5($path.$sid);
$_SESSION[$hash] = $path;
 ?>
 <button class="collapsible"><?= $data1['file_name'] ; ?></button>
 <div  class="content">

<?php ?>

<video width="800" height="400" controls controlsList="nodownload"  onclick="count(<?=$data1['file_id'];?>)" preload="none">
<source src="<?= $data1['link_video'] ; ?>" >
</video>  


</div>

<?php endforeach ;?>
</div><br><br/>
 
</div>

</div>
</div>
</section>
<?php $this->load->view('script/topic_script'); ?>









 






