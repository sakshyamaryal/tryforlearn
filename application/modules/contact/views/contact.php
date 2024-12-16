<div class="container">
<div class="row">
<p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact </span></p>
</div>
</div>
<section class="contact-section">
<div class="container">
<div class="row d-flex mb-5 contact-info">
<div class="col-md-3 d-flex">
<div class="bg-light align-self-stretch box p-4 text-center">
<h3 class="mb-4">Address</h3>
<p><?= $basic->address;?></p>
</div>
</div>
<div class="col-md-3 d-flex">
<div class="bg-light align-self-stretch box p-4 text-center">
<h3 class="mb-4">Contact Number</h3>
<p><a href="tel://<?= $basic->phone;?>"><?= $basic->phone;?></a></p>
</div>
</div>
<div class="col-md-3 d-flex">
<div class="bg-light align-self-stretch box p-4 text-center">
<h3 class="mb-4">Email Address</h3>
<p><?= $basic->email;?></p>
</div>
</div>
<div class="col-md-3 d-flex">
<div class="bg-light align-self-stretch box p-4 text-center">
<h3 class="mb-4">Website</h3>
<p><a href="#"><?= base_url();?></a></p>
</div>
</div>
</div>
</div>
</section>
<section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
<div class="container">
<div class="row d-flex align-items-stretch no-gutters">
<div class="col-md-6 p-4 p-md-5 order-md-last bg-light">
<form action="#">
<div class="form-group">
<input type="text" id="name" class="form-control" placeholder="Your Name">
</div>
<div class="form-group">
<input type="text" id="email" class="form-control" placeholder="Your Email">
</div>
<div class="form-group">
<input type="text" id="subject" class="form-control" placeholder="Subject">
</div>
<div class="form-group">
<textarea name="" id="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
</div>
<div class="form-group">
<input type="button" id="btnsubmit" onclick="submit_quote()" value="Send Message" class="btn btn-primary py-3 px-5">
</div>
</form>
</div>
<div class="col-md-6 d-flex align-items-stretch">


<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3335.1486332038803!2d85.27993297280281!3d27.671964849455843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x527ca7931632ea36!2sTry%20For%20Learn%20Pvt.%20Ltd.!5e0!3m2!1sen!2snp!4v1599008920150!5m2!1sen!2snp" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
<!--<style>.mapouter{position:relative;text-align:right;height:500px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style>-->
</div></div>
</div>
</div>
</section>
<?php $this->load->view('script/contact_script'); ?>