
<footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget">
                        <h2 class="ftco-heading-2" style="margin-top:0;">Have a Questions?</h2>
                        <div class="block-23">
                            <ul>
                                <li><span class="fa fa-map-marker"></span><span class="text"><?=$basic->address; ?></span></li>
                                <li><a href="#"><span class="fa fa-phone"></span><span class="text"><?=$basic->phone; ?></span></a></li>
                                <li><a href="#"><span class="fa fa-envelope"></span><span class="text"><?=$basic->email; ?></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
              
                <div class="col-md-6 col-lg-4">
                    <div class="ftco-footer-widget mb-5 ml-md-4">
                     
                      <h5 style="color: #fff;font-size: 22px;margin-top:0rem;">Our Payment Partner</h5>
                     <a href="https://www.khalti.com/app" target="_blank">
                     <img src="<?php echo base_url(); ?>public/img/khalti-white.png" alt="Khalti" style="width:100px;height:auto;"></a>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-5">
                   
                    <div class="ftco-footer-widget">
                        <h2 class="ftco-heading-2 mb-0" style="margin-top:0;">Connect With Us</h2>
                        <ul class="ftco-footer-social list-unstyled float-lft mt-3">
                            <li class="ftco-animate"><a href="https://www.twitter.com/try_for_learn/" target="_blank"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="https://www.facebook.com/tryforlearn" target="_blank"><span class="icon-facebook"></span></a></li>
                            
                            <li class="ftco-animate"><a href="https://www.youtube.com/tryforlearn/" target="_blank"><span class="icon-youtube"></span></a></li>
                            <li class="ftco-animate"><a href="https://www.instagram.com/tryforlearn"  target="_blank"><span class="icon-instagram"></span></a></li>
                            <li class="ftco-animate"><a href="https://wa.me/message/LUV5CPRNHHBZA1" target="_blank"> <span class="icon-whatsapp"></span></a></li>
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
        <h5 class="modal-title infotitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
     
      </div>
      <div class="modal-body infobody">
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

<div class="modal fade" id="successmodal" role="dialog" style="    margin-top: 100px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>
					
                    <div class="modal-body">
                       
						<div class="thank-you-pop">
							<img src="<?=base_url();?>assets/frontend/images/tick1.gif" alt="" style="width: 45%;margin-left: 125px;">
						  <p id="msg" style="color:green;text-align: center;font-size:16px;font-style:oblique;"></p>
							
 						</div>
                         
                    </div>
					
                </div>
            </div>
        </div>


        <div class="modal fade" id="errormodal" role="dialog" style="    margin-top: 100px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>
					
                    <div class="modal-body">
                       
						<div class="thank-you-pop">
							<img src="<?=base_url();?>assets/frontend/images/oops.gif" alt="" style="width: 45%;margin-left: 125px;">
						  <p id="errmsg" style="color:red;text-align: center;font-size:16px;font-style:oblique;"></p>
							
 						</div>
                         
                    </div>
					
                </div>
            </div>
        </div>

    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>

        <!-- Google Analytics -->
        <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131279540-3"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
            
              gtag('config', 'UA-131279540-3');
            </script>

        <!-- Google Analytics -->


    <script src="<?= base_url(); ?>assets/frontend/js/jquery-migrate-3.0.1.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/popper.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?=base_url();?>assets/frontend/js/bootstrap_3.41.min.js"></script> 

    <!-- <script src="<?= base_url(); ?>assets/frontend/js/bootstrap.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script> -->
    <script src="<?= base_url(); ?>assets/frontend/js/jquery.easing.1.3.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/jquery.waypoints.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/jquery.stellar.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/owl.carousel.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/jquery.magnific-popup.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/aos.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/jquery.animateNumber.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/scrollax.min.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/main.js" type="7bc5c9033436b1e8f8c4bf09-text/javascript"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <script src="<?= base_url(); ?>assets/frontend/js/rocketloader.min.js" data-cf-settings="7bc5c9033436b1e8f8c4bf09-|49" defer=""></script>
</body>


</html>
<?php $userid=$this->session->userdata('userid'); ?>
<script>
  jQuery(document).ready(function($) {
    //code...
    //toastr["info"]("Inconceivable!")


});
// window.setInterval(function(){
//   /// call your function here
 
//   let userid='<?php // echo $userid; ?>';
//   //console.log(userid);
//     if(userid == null || userid == '')
//   {
//       return false;
//   }else{
//     loadnotification();
//   countnotification();
//   displaynotification();
//   }
  
// }, 1000);


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
$(document).on('click', '.minimizeit', function() {
    $('.leftcontainer').hide();
    $('.rightcontainer').removeClass('col-md-9').removeClass('col-md-8');
    $('.rightcontainer').prepend('<span class="maximizeit" style="cursor:pointer"><i class="fa fa-bars"></i></span>');
    $('.rightcontainer').addClass('col-md-12');
})

$(document).on('click', '.maximizeit', function() {
    $('.leftcontainer').show();

    $('.maximizeit').remove();
    $('.rightcontainer').removeClass('col-md-12');
    $('.rightcontainer').addClass('col-md-9');
})
   </script>
