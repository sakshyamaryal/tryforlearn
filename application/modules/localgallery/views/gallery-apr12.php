<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=$title; ?></title>
  <link rel="icon" href="http://www.tryforlearn.com/assets/try.png"> 

	<meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.11/css/lightgallery.css">
      <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/animate.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/aos.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/icomoon.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/style.css">
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/fontawesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
	




	<style>
		body {


  font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif
}

.small {
  font-size: 11px;
  color: #999;
  display: block;
  margin-top: -10px
}

.cont {
  text-align: center;
}

.page-head {
  padding: 60px 0;
  text-align: center;
}

.page-head .lead {
  font-size: 18px;
  font-weight: 400;
  line-height: 1.4;
  margin-bottom: 50px;
  margin-top: 0;
}

.btn {
  -moz-user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 2px;
  cursor: pointer;
  display: inline-block;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.42857;
  margin-bottom: 0;
  padding: 6px 12px;
  text-align: center;
  vertical-align: middle;
  white-space: nowrap;
  text-decoration: none;
}

.btn-lg {
  border-radius: 2px;
  font-size: 18px;
  line-height: 1.33333;
  padding: 10px 16px;
}

.btn-primary:hover {
  background-color: #fff;
  color: #152836;
}

.btn-primary {
  background-color: #152836;
  border-color: #0e1a24;
  color: #ffffff;
}

.btn-primary {
  border-color: #eeeeee;
  color: #eeeeee;
  transition: color 0.1s ease 0s, background-color 0.15s ease 0s;
}

.page-head h1 {
  font-size: 42px;
  margin: 0 0 20px;
  /*color: #FFF;*/
  position: relative;
  display: inline-block;
}

.page-head h1 .version {
  bottom: 0;
  color: #ddd;
  font-size: 11px;
  font-style: italic;
  position: absolute;
  width: 58px;
  right: -58px;
}

.demo-gallery > ul {
  margin-bottom: 0;
  padding-left: 15px;
}

.demo-gallery > ul > li {
  margin-bottom: 15px;
  width: 180px;
  display: inline-block;
  margin-right: 15px;
  list-style: outside none none;
}

.demo-gallery > ul > li a {
  border: 3px solid #FFF;
  border-radius: 3px;
  display: block;
  overflow: hidden;
  position: relative;
  float: left;
}

.demo-gallery > ul > li a > img {
  -webkit-transition: -webkit-transform 0.15s ease 0s;
  -moz-transition: -moz-transform 0.15s ease 0s;
  -o-transition: -o-transform 0.15s ease 0s;
  transition: transform 0.15s ease 0s;
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  height: 100%;
  width: 100%;
}

.demo-gallery > ul > li a:hover > img {
  -webkit-transform: scale3d(1.1, 1.1, 1.1);
  transform: scale3d(1.1, 1.1, 1.1);
}

.demo-gallery > ul > li a:hover .demo-gallery-poster > img {
  opacity: 1;
}

.demo-gallery > ul > li a .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.1);
  bottom: 0;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  -webkit-transition: background-color 0.15s ease 0s;
  -o-transition: background-color 0.15s ease 0s;
  transition: background-color 0.15s ease 0s;
}

.demo-gallery > ul > li a .demo-gallery-poster > img {
  left: 50%;
  margin-left: -10px;
  margin-top: -10px;
  opacity: 0;
  position: absolute;
  top: 50%;
  -webkit-transition: opacity 0.3s ease 0s;
  -o-transition: opacity 0.3s ease 0s;
  transition: opacity 0.3s ease 0s;
}

.demo-gallery > ul > li a:hover .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.5);
}

.demo-gallery .justified-gallery > a > img {
  -webkit-transition: -webkit-transform 0.15s ease 0s;
  -moz-transition: -moz-transform 0.15s ease 0s;
  -o-transition: -o-transform 0.15s ease 0s;
  transition: transform 0.15s ease 0s;
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  height: 100%;
  width: 100%;
}

.demo-gallery .justified-gallery > a:hover > img {
  -webkit-transform: scale3d(1.1, 1.1, 1.1);
  transform: scale3d(1.1, 1.1, 1.1);
}

.demo-gallery .justified-gallery > a:hover .demo-gallery-poster > img {
  opacity: 1;
}

.demo-gallery .justified-gallery > a .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.1);
  bottom: 0;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  -webkit-transition: background-color 0.15s ease 0s;
  -o-transition: background-color 0.15s ease 0s;
  transition: background-color 0.15s ease 0s;
}

.demo-gallery .justified-gallery > a .demo-gallery-poster > img {
  left: 50%;
  margin-left: -10px;
  margin-top: -10px;
  opacity: 0;
  position: absolute;
  top: 50%;
  -webkit-transition: opacity 0.3s ease 0s;
  -o-transition: opacity 0.3s ease 0s;
  transition: opacity 0.3s ease 0s;
}

.demo-gallery .justified-gallery > a:hover .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.5);
}

.demo-gallery .video .demo-gallery-poster img {
  height: 48px;
  margin-left: -24px;
  margin-top: -24px;
  opacity: 0.8;
  width: 48px;
}

.demo-gallery.dark > ul > li a {
  border: 3px solid #04070a;
}
	</style>

</head>
<body>

    <div class="py-2 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-3 px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md-5 pr-4 d-flex topper align-items-center">
                            <div class="icon bg-fifth mr-2 d-flex justify-content-center align-items-center"><span class="icon-map"></span></div>
                            <span class="text"><?=$basic->address; ?></span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon bg-secondary mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text">
                               <a href="#"></a> <?=$basic->email; ?></a></span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon bg-tertiary mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text"> <?=$basic->phone; ?></span>
                        </div>
                    
                     <div class="col-md pr-4 d-flex topper align-items-center" style="color:#fff;">
                       <?php if($userid=="") {?>
                           <a href="<?=base_url();?>studentlogin"> <span class="text"> Login </span></a>
                           <?php } else 
                           { echo $username;
                            
                           } ?>
                            &nbsp;|&nbsp;
                            <?php if($userid=="") {?>
                            <a href="<?=base_url();?>studentregister"> <span class="text"> Register </span></a>
                            <?php } else 
                           { ?>
                             <a href="<?=base_url();?>studentlogin/logout"> <span class="text"> Logout </span></a>
                          <?php  } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
        <div class="container d-flex align-items-center">
            <a class="navbar-brand" href="<?= base_url(); ?>">Try For Learn</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">

                <ul class="navbar-nav ml-auto">
                    <style>
                        .dropdown-submenu {
                            position: relative;
                        }

                        .dropdown-submenu>.dropdown-menu {
                            top: 0;
                            left: 100%;
                            margin-top: -6px;
                            margin-left: -1px;
                            -webkit-border-radius: 0 6px 6px 6px;
                            -moz-border-radius: 0 6px 6px;
                            border-radius: 0 6px 6px 6px;
                        }

                        .dropdown-submenu:hover>.dropdown-menu {
                            display: block;
                        }

                        .dropdown-submenu>a:after {
                            display: block;
                            content: " ";
                            float: right;
                            width: 0;
                            height: 0;
                            border-color: transparent;
                            border-style: solid;
                            border-width: 5px 0 5px 5px;
                            border-left-color: #ccc;
                            margin-top: 5px;
                            margin-right: -10px;
                        }

                        .dropdown-submenu:hover>a:after {
                            border-left-color: #fff;
                        }

                        .dropdown-submenu.pull-left {
                            float: none;
                        }

                        .dropdown-submenu.pull-left>.dropdown-menu {
                            left: -100%;
                            margin-left: 10px;
                            -webkit-border-radius: 6px 0 6px 6px;
                            -moz-border-radius: 6px 0 6px 6px;
                            border-radius: 6px 0 6px 6px;
                        }
                    </style>
                        <?php if($this->session->userdata('userid')!=""): ?>
                            <li class="nav-item"><a href="<?= base_url()?>studentpanel" class="nav-link"> Dashboard</a></li>

                            <?php endif; ?>
            
                    <?php foreach($modules as $mod):?>
   <?php if(count($mod['submenu'])>0){ ?>
    <li class="nav-item dropdown">
                          <a class="dropdown-toggle nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?= $mod['menu']['module_name']; ?>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

    <?php foreach($mod['submenu'] as $list): ?>
    <a class="dropdown-item" data-parent="<?= $mod['menu']['module_name']; ?>" data-sub="<?= $list['module_name']; ?>" href="<?= base_url().$list['controller_fname']; ?>"><?= $list['module_name']; ?></a>
    <?php endforeach; ?>
    </div> 
     </li>
        <?php } else { ?>

           <li class="nav-item"><a href="<?= base_url().$mod['menu']['controller_fname']; ?>" class="nav-link"> <?= $mod['menu']['module_name']; ?></a></li>

        <?php } 
        endforeach; ?>
    
        

                  

                </ul>

            </div>
        </div>
    </nav>

	<div class="cont">
  <div class="page-head">
    <!--<h1><?= $title; ?></h1>-->
    <h1>Our Gallery</h1>
    <p class="lead">Some of our memories</p>


  <div class="demo-gallery">
    <ul id="lightgallery">
        <?php foreach($gallery as $list): ?>
      <li data-responsive="<?= base_url();?>upload/gallery/<?= $list['image'];?>" data-src="<?= base_url();?>upload/gallery/<?= $list['image'];?>"
      >
        <a href="<?= base_url();?>upload/gallery/<?= $list['image'];?>">
          <img class="img-responsive" src="<?= base_url();?>upload/gallery/<?= $list['image'];?>">
         
        </a>
      </li>
      <?php endforeach;?>
     
    </ul>
    <!-- <span class="small">Click on any of the images to see lightGallery</span> -->
  </div>
</div>

<footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget mb-5">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text"><?=$basic->address; ?></span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text"><?=$basic->phone; ?></span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span class="text"><?=$basic->email; ?></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
              
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget mb-5 ml-md-4">
                     
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget mb-5 ml-md-4">
                      
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                   
                    <div class="ftco-footer-widget mb-5">
                        <h2 class="ftco-heading-2 mb-0">Connect With Us</h2>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>
                        Copyright &copy;
                        <script type="7bc5c9033436b1e8f8c4bf09-text/javascript">
                        document.write(new Date().getFullYear());
                        </script> All rights reserved | Designed & Developed By <a href="<?= $href; ?>" target="_blank"><?= $footer_title ;?></a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <div class="modal" tabindex="-1" role="dialog" id="infomodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
     
      </div>
      <div class="modal-body">
      </div>
      
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="ansmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ansheadermodal">
        <h5 class="modal-title ansmodaltitle"></h5>
     
      </div>
      <div class="modal-body ansmodalbody">
      </div>
      
    </div>
  </div>
</div>
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.11/js/lightgallery-all.min.js"></script> -->

    <!-- <script src="<?= base_url(); ?>assets/frontend/js/jquery.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>


    <script src="<?= base_url(); ?>assets/frontend/js/jquery-migrate-3.0.1.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="<?= base_url(); ?>assets/frontend/js/popper.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/bootstrap.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/jquery.easing.1.3.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/jquery.waypoints.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/jquery.stellar.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/owl.carousel.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/jquery.magnific-popup.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/aos.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/jquery.animateNumber.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/scrollax.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/main.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="http://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="7bc5c9033436b1e8f8c4bf09-|49" defer=""></script>
<script>
   $(document).ready(function() {
  $('#lightgallery').lightGallery({
    pager: true
  });
});
 </script>
<?php $userid=$this->session->userdata('userid'); ?>
<script>
  
  jQuery(document).ready(function($) {
    //code...
    //toastr["info"]("Inconceivable!")


});
window.setInterval(function(){
  /// call your function here
 
  let userid='<?= $userid; ?>';
  //console.log(userid);
    if(userid == null || userid == '')
  {
      return false;
  }else{
    loadnotification();
  countnotification();
  displaynotification();
  }
  
}, 1000);


function loadnotification()
{                     
                     url = "<?php echo base_url('comman/get_notification') ?>";
                            $.ajax({
                                type: 'get',
                               
                                url: url,
                               
                               
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                   
                                    if(res.status==true)
                                    { 
                                        $.each(res.data, function( index, value ) {
                                            toastr["info"](value.title+"&nbsp;&nbsp;&nbsp;&nbsp;<small>"+value.posted_date+"</small>")
                                            });
                                        
                                    }
                                }
                            });

}
function countnotification()
{                     
                     url = "<?php echo base_url('comman/count_notification') ?>";
                            $.ajax({
                                type: 'get',
                               
                                url: url,
                               
                               
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                   
                                    if(res.status==true)
                                    { 
                                        $(".p1").attr("data-count",res.data);
                                        
                                    }
                                }
                            });

}

function displaynotification()
{                     
                     url = "<?php echo base_url('comman/display_notification') ?>";
                            $.ajax({
                                type: 'get',
                               
                                url: url,
                               
                               
                               
                                success: function (response) {
                                    let html="";
                                    let link="";
                                    var res = jQuery.parseJSON(response);
                                   
                                    if(res.status==true)
                                    { 
                                        $.each(res.data, function( index, value ) {
                                            if(value.keytype=="notice")
                                            {
                                                link=1;

                                            }
                                            else
                                            {
                                                link=2;
                                            }
                                            if(value.is_seen==1)
                                            {
                                                sts="color:black;";

                                            }
                                            else
                                            {
                                                sts="color:blue;";
                                            }

                                            html +='<li ><a href="javascript:void(0)" onclick="update_status('+value.id+','+link+')" style="'+sts+'">&nbsp;'+value.title+'&nbsp;&nbsp;<small>'+value.posted_date+'</small>&nbsp;</a></li>'
                                            });
                                            $('#notimenu').html(html);
                                        
                                    }
                                }
                            });

}

function update_status(val,keytype)
{
    
    if(keytype===1)
                                            {
                                                link="<?=base_url();?>snotice";

                                            }
                                            else
                                            {
                                                link="<?=base_url();?>sevents";
                                            }
    url = "<?php echo base_url('comman/update_status') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{val},
                               
                               
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                   
                                    if(res.status==true)
                                    { 
                                      console.log("true");                                        
                                    }
                                    window.location.href=link;

                                }
                            });
}
   </script>


</body>
</html>