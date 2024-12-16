<div class="container">
<div class="row">
<p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About us </span></p>
</div>
</div>
<section class=" ftco-no-pt ftc-no-pb">
<div class="container">
<div class="row">
<div class="col-md-5 order-md-last wrap-about py-5 wrap-about bg-light">
<div class="text px-4 ftco-animate">
<h2 class="mb-4">Welcome to <?= $basic->name; ?></h2>
<p><img src="<?=base_url();?>upload/company/1/<?= $basic->image; ?>" height="300" width="500" /></p>
</div>
</div>
<div class="col-md-7 wrap-about py-5 pr-md-4 ftco-animate">
<h2 class="mb-4">What We Offer</h2>
<p><?= $basic->service; ?></p
>
<div class="row mt-5">
<?php foreach($service as $list): ?>
                        <div class="col-lg-6">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="<?= $list['fonticon']; ?>"></span></div>
                                <div class="text">
                                    <h3><?= $list['service_name']; ?></h3>
                                    <p><?= $list['desc']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>




</div>
</div>
</div>
</div>
</section>
<div class="container">
<div class="row">
<div class="col-md-12">
<?= $basic->extra;?>
</div>
</div>
</div>
<br><br/>
