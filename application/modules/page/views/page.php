<div class="container">
<div class="row">
<p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <?php if($br1 !=""): ?> <span><?=$br1;?> </span><?php endif;?> <?php if($br2 !=""): ?><i class="ion-ios-arrow-forward"></i> <span><?=$br2;?> </span><?php endif;?></p>
</div>
</div>
<section class=" ftco-no-pt ftc-no-pb">
<div class="container">
<div class="row">
<div class="col-md-12 order-md-last  py-5 " style="margin:2px auto;">
<div class="text px-4 ftco-animate">
<!--<p><img src="<?=base_url();?>upload/page/<?= $basic->image; ?>"  class="img-fluid" /></p>-->
<?php if($details->image!=''): ?>
<p><img src="<?=base_url();?>upload/page/<?= $details->image; ?>"  class="img-fluid" /></p>
<?php endif;?>
</div>
</div>

</div>
</div>
</section>
<div class="container">
<div class="row">
<div class="col-md-12">
<?= $details->long_desc;?>
</div>
</div>
</div>
<br><br/>

