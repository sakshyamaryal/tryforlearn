<style>
.home-slider .owl-stage-outer,.home-slider .owl-stage-outer .owl-stage, .home-slider .owl-stage-outer .owl-stage .owl-item {
    height: 100% !important;
}
</style>
<section class="home-slider owl-carousel">
      <?php foreach($banner as $banr) : ?>
        <div class="slider-item position-relative" style="background-image:url(<?= $banr['image']; ?>); height: 100% !important;">
            <!--<div class="overlay"></div>-->
            <div class="position-absolute top-0 left-0 h-100 w-100 home-overlay" style="background:#0C0C0C99;">
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                        <div class="col-md-8 text-center ftco-animate">
                            <h1 class="mb-4 text-center text-white"><?= $banr['title']; ?></h1> <h3 class="text-center text-white"><?= $banr['description']; ?> sdgksbdkjfhbweg</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <?php endforeach; ?>

</section>
    <section class="ftco-services ftco-no-pb">
        <div class="container-wrap">
            <div class="row no-gutters mr-0">
             <?php foreach($category as $cat) : ?>
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-primary">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center" style="margin-top: 36px!important;">
                            <span class="<?= $cat['fonticon']; ?>"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading"><?= $cat['category_name'] ?></h3>
                            <p><?= $cat['desc'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
         
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pt ftc-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-5 order-md-last wrap-about py-5 wrap-about bg-light">
                    <div class="text px-4 ftco-animate">
                        <h2 class="mb-4">Welcome to <?= $basic->name; ?></h2>
                        <p><?= $basic->description; ?></p>
                        <p><a href="#" class="btn btn-secondary px-4 py-3">Read More</a></p>
                    </div>
                </div>
                <div class="col-md-7 wrap-about py-5 pr-md-4 ftco-animate">
                    <h2 class="mb-4">What We Offer</h2>
                    <p><?= $basic->service; ?></p>
                    <div class="row mt-5">
                    <?php foreach($service as $list): ?>
                        <div class="col-lg-12 col-md-12">
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
    <section class="ftco-intro" style="background-image: url(<?php echo base_url(); ?>/assets/frontend/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h2>Signup for Online Courses</h2>
                    <p class="mb-0"><?= $basic->marketing_ling; ?></p>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <p class="mb-0"><a href="<?= base_url();?>studentregister" class="btn btn-secondary px-4 py-3">Take a Course</a></p>
                </div>
            </div>
        </div>
    </section>
    <!--<section class="ftco-section ftco-no-pb">-->
    <!--    <div class="container">-->
    <!--        <div class="row justify-content-center mb-5 pb-2">-->
    <!--            <div class="col-md-8 text-center heading-section ftco-animate">-->
    <!--                <h2 class="mb-4"><span>Certified</span> Teachers</h2>-->
    <!--                <p><?= $basic->teacher; ?></p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--        <?php foreach($staff as $val): ?>-->
    <!--            <div class="col-md-6 col-lg-3 ftco-animate">-->
    <!--                <div class="staff">-->
    <!--                    <div class="img-wrap d-flex align-items-stretch">-->
    <!--                        <div class="img align-self-stretch" style="background-image: url(<?= base_url();?>upload/staff/<?= $val['staff_id']; ?>/<?= $val['image']; ?>);"></div>-->
    <!--                    </div>-->
    <!--                    <div class="text pt-3 text-center">-->
    <!--                        <h3><?= $val['staff_name'];?></h3>-->
    <!--                        <span class="position mb-2"><?= $val['designation'];?></span>-->
    <!--                        <div class="faded">-->
    <!--                            <p><?= $val['desc'];?></p>-->
                             
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        <?php endforeach; ?>-->
              
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-8 text-center heading-section ftco-animate">
                    <h2 class="mb-4"><span>Our</span> Courses</h2>
                    <p><?= $basic->course; ?></p>
                </div>
            </div>
            <div class="row">
              <?php foreach($package_name as $data): ?>
                <div class="col-md-6 course d-lg-flex ftco-animate">
                    <div class="text bg-light p-4 col-md-12">
                        <h3><a href="#"><?= $data['name'] ?></a></h3>
                        <!--<small>Short Description:</small>-->
                        <p><?= $data['description'] ?></p>
                       
                    </div>
                </div>
             <?php endforeach; ?>
              
            </div>
        </div>
    </section>
    <style>
        .testimony-section .owl-stage .active{
            opacity: 1 !important;
        }
    </style>

    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-12 text-center heading-section ftco-animate">
                    <h2 class="mb-4"><span style="color: #1eaaf1;">What Parents</span> Say About Us</h2>
              
          
            <div class="row ftco-animate justify-content-center">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        <?php foreach($testimonial as $data): ?>
                            <div class="item">
                                <div class="testimony-wrap d-flex align-items-center">
                                    <!-- <div class="user-img mr-4" style="background-image: url(<?= base_url();?>upload/testomonial/<?= $data['testomonial_id']; ?>/<?= $data['image']; ?>)">
                                    </div> -->
                                    <div class="user-img mr-4" style="background-image: url(<?= base_url();?>upload/testimonial/<?= $data['image']; ?>); aspect-ratio:1;">
                                    </div>
                                    <div class="text ml-2 bg-light d-flex gap-5" style="padding: 16px;width: fit-content; border-radius:8px; gap:44px;min-height:100px;">
                                        <span class="quote d-flex align-items-center justify-content-center" style="position:static ; opacity:1">
                                            <i class="fa fa-quote-left" style="font-size: 55px; color: #1eaaf1;"></i>
                                        </span>
                                        <div>
                                            <p><?= $data['desc']; ?></p>
                                            <p class="name"><?= $data['fullname']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ; ?>
                      
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-consult ftco-no-pt ftco-no-pb mt-5" style="background-image: url(images/bg_5.jpg); margin-bottom: 40px" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-12 py-5 px-md-5 bg-primary">
                    <div class="heading-section heading-section-white ftco-animate mb-5">
                        <h2 class="mb-4 text-center">Request A Quote</h2>
                    </div>
                    <form action="#" class="appointment-form ftco-animate">
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="name"  id="name" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <div class="form-field">
                                    <div class="select-wrap">
                                        
                                        <select name="course_id" id="course_id" class="form-control">
                                            <option value="-1" style="background:black;">Select Your Course </option>
                                            <?php foreach($package_name as $data): ?>
                                            <option style="background:black;" value="<?= $data['level_id'] ;?>"><?= $data['name'] ;?></option>
                                            <?php endforeach; ?>
                                         
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" cols="30" rows="2" class="form-control" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            
                            <div class="form-group ml-md-4 d-flex justify-content-center" style="">
                                <input type="button" id="btnquote" onclick="submit_quote()" value="Request A Quote" class="btn btn-secondary py-3 px-4" style="width: fit-content;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <style>
        .carousel-gallery .owl-dots .owl-dot.active{
            background: #1eaaf1 !important;
        }
        .carousel-gallery .owl-dots{
            margin-top: 24px;
            margin-bottom: 36px;
        }
    </style>
    <section class="ftco-gallery">
        
        <div class="heading-section ftco-animate mb-5">
            <h2 class="mb-4 text-center"><span style="color: #1eaaf1;">Our</span> Memories</h2>
        </div>
        <!-- <div class="container-wrap">

            <div class="row no-gutters mr-0">
                <?php foreach($image as $img): ?>

                <div class="col-md-3 ftco-animate">
                    <a href="<?=base_url();?>upload/gallery/<?= $img['image'] ?>" class="gallery image-popup img d-flex align-items-center" style="background-image: url('<?=base_url();?>upload/gallery/<?= $img['image'] ?>');">
                    </a>
                </div>
                 <?php endforeach; ?>
             
            </div>
        </div> -->
        <div class="container">
            <div class="row">
            <div class="carousel-gallery owl-carousel">
                        <?php foreach($image as $img): ?>
                            <div class="item">
                                <div class="testimony-wrap d-flex align-items-center">
                                    <a href="<?=base_url();?>upload/gallery/<?= $img['image'] ?>" class="gallery image-popup img d-flex align-items-center" style="background-image: url('<?=base_url();?>upload/gallery/<?= $img['image'] ?>'); width:100%">
                                        <!--<div class="icon mb-4 d-flex align-items-center justify-content-center">-->
                                        <!--</div>-->
                                    </a>
                                </div>
                            </div>
                        <?php endforeach ; ?>
                      
                    </div>
            </div>
        </div>
    </section>


    <?php $this->load->view('script/home_script.php'); ?>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
    $(document).ready(function(){
        $(".carousel-testimony").owlCarousel({
            items: 3,  // Number of visible items
            loop: false, // Prevent infinite scrolling
            autoplay: false, // Stop automatic scrolling
            nav: true, // Enable navigation arrows
            dots: true // Enable pagination dots
        });
    });

    </script> -->
    <script>
$(document).ready(function () {
    $(".carousel-testimony").owlCarousel({
        autoplay: true,
        loop: true,
        items: 1,
        margin: 30,
        stagePadding: 0,
        nav: false,
        navText: [
            '<span class="ion-ios-arrow-back"></span>',
            '<span class="ion-ios-arrow-forward"></span>',
        ],
        responsive: { 0: { items: 1 }, 600: { items: 1 }, 1000: { items: 2 } },
    });
});
$(document).ready(function () {
    $(".carousel-gallery").owlCarousel({
        autoplay: true,
        loop: true,
        items: 1,
        margin: 30,
        stagePadding: 0,
        nav: false,
        navText: [
            '<span class="ion-ios-arrow-back"></span>',
            '<span class="ion-ios-arrow-forward"></span>',
        ],
        responsive: { 0: { items: 1 }, 600: { items: 1 }, 1000: { items: 3 } },
    });
});

    </script>