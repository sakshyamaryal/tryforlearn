
<div class="col-md-8" style="margin-top:10px;">

<h3>Subscription Course</h3>
<div class="row">

<?php foreach($lock_course as $lcourse): 
 $name="";
  if($lcourse['uni_program_id']===null)
  {
      $name="School Course";
  }
  else if($lcourse['uni_program_id']=='-1')
  {
    $name="Reasoning Course";
  }
  else{
    $name="University Course";
  }
    ?>
 
  <div class="col-md-4">
  <a href="<?=base_url();?>mycourse?subscribed=<?= $lcourse['uni_program_id'];?>">
        <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?=base_url();?>assets/frontend/images/book.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text"><b><?= $name; ?></b></p>
        </div>
        </div>
    </a>
  </div>

  
 
 <?php endforeach ;?>
</div><br><br/>
 <h3>Free Course</h3>
<div class="row">
<?php foreach($unlock_course as $course): ?>
 
  <div class="col-md-4">
      <a href="<?=base_url();?>mycourse?level=<?= $course['level_id']; ?>">
        <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?=base_url();?>assets/frontend/images/book.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text"><b><?= $course['name']; ?></b></p>
        </div>
        </div>
       </a>
  </div>

  
 
 <?php endforeach ;?>
 
 </div><br><br/>
</div>

</div>
</div>
</section>



