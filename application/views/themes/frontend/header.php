<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title><?=$title; ?></title>
    <link rel="icon" href="<?= base_url(); ?>assets/try.png"> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/open-iconic-bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/animate.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/aos.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/icomoon.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/style.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/frontend/css/bootstrap_4.min.css">

    <link href="<?= base_url(); ?>assets/frontend/css/fontawesome.min.css">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/> -->
    <!-- <script src="<?= base_url(); ?>assets/frontend/js/jquery.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
 <script type="text/javascript" src="<?=base_url();?>assets/admin/js/jquery.min.js" ></script>

    <script src="<?= base_url(); ?>assets/frontend/js/kitfont.js"></script>

</head>

<body>
    <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v8.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="108917343903056"
  theme_color="#ffc300"
  logged_in_greeting="Hello! Welcome to Try For Learn Pvt. Ltd. How can we help you?"
  logged_out_greeting="Hello! Welcome to Try For Learn Pvt. Ltd. How can we help you?">
      </div>
      
    <div class="py-2 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-3 px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md-3 pr-4 d-flex topper align-items-center .d-none .d-sm-block .d-sm-none .d-md-block">
                            <div class="icon bg-fifth mr-2 d-flex justify-content-center align-items-center"><span class="fa fa-map-marker"></span></div>
                            <span class="text" style="color:#fff;"><?=$basic->address; ?></span>
                        </div>
                        <div class="col-md-3 pr-4 d-flex topper align-items-center">
                            <div class="icon bg-secondary mr-2 d-flex justify-content-center align-items-center"><span class="fa fa-envelope"></span></div>
                            <span class="text">
                               <a href="mailto:<?=$basic->email; ?>" style="color:#fff;"> <?=$basic->email; ?></a></span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon bg-tertiary mr-2 d-flex justify-content-center align-items-center"><span class="fa fa-phone"></span></div>
                            <span class="text"> <a href="tel:<?=$basic->phone; ?>" style="color:#fff;"><?=$basic->phone; ?></a></span>
                        </div>
                         <!-- <?php if($this->session->userdata('userid')!=""): ?>
                          <a href="<?= base_url()?>studentpanel" class="nav-link" style="color:white;"> Dashboard</a>
                        
                    

                            <?php endif; ?> -->
                             
                     <div class="col-md-4 pr-4 d-flex topper align-items-center" style="color:#fff;">
                         
                       <?php if($userid=="") {?>
                           <a href="<?=base_url();?>userlogin"> <span class="text"> Login </span></a>
                           <?php } else 
                           
                           { ?>
                            <a href="<?=base_url();?>studentpanel"> <span class="text"> <?=$username;?> </span></a>

                                
                            
                         <?php  } ?>
                            &nbsp;|&nbsp;
                            <?php if($userid=="") {?>
                            <a href="<?=base_url();?>userregister"> <span class="text"> Register </span></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;
                          <a href="<?=base_url();?>trial" ><span class="text" >Trial Signup </span></a><sup style="color: #9f1111;">  Want a Free Trial ? </sup>
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