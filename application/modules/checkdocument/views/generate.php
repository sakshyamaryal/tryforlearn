<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>certificate</title>
</head>
<style>
    body{
        /*background: url('<?php echo base_url(); ?>upload/background/2.jpeg');*/
        /*background-repeat: no-repeat;*/
        /*background-size:cover;*/
        width:100%;
        height:auto;
        text-align: center;
        margin:0;

    }
    .container-box{
        position: relative;
        padding:2rem;
    }
    .top-header-left{
        position: absolute;
        left:10%;
        /*top:10%;*/

    }
    .top-header-left img{
        width: 130px;
    }
    .top-header-right{
        position: absolute;
        right:8%;
        top:4%;

    }
    .container-box .row-box{
        margin-top:2rem;
    }
    .row-box .title h1{
        font-size:2.8rem;
        color:#2d5898;
        margin-bottom: 0;
    }
    .row-box .title p{
        
        margin-top: 0;
    }
    .certificate-title{
        margin:2rem;
        position:relative;
        z-index:5;
    }
    .certificate-title-before{
        position: absolute;
        z-index: 2;
        left: 50%;
        top:24%;
        /*top:50%;*/
        /* right: 50%; */
        transform: translate(-50%, -50%);
    }
    .row-box2{
        width:70%;
        margin:2px auto;

    }
    .main-text{
        font-size: 1.4rem;
    line-height: 1.8rem;
    }
    .footer-main{
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-around;
    }
    .footer-main .signee{
        text-align: center;

    }
    .signee .detail{
        display: flex;
        flex-wrap: nowrap;
        flex-direction: column;
    }
    .signature{
        position: relative;
          top: -50%;
        left: -30%;
    }
    .signature img{
        width:130px;
        height: auto;
        position: absolute;
        content:'';

    }
    .detail span{
        text-align: center;
    }
    .row-box3{
        margin-top: 3rem;
    }
    .footer-notice{
        margin-top: 2rem;
        line-height: 2rem;
        bottom:0;
        color:#d61c1c;
    }
    .course{
        color:red;
    }
    .img-print{
        position:absolute;
        width:100%;
    }
  
</style>  

<body>
    <div class="img-print">
        <img src="<?php echo base_url(); ?>upload/background/2.jpeg" style="width:100%;">
    </div>
    <div class="container-box">
        <div class="top-header-left">
            <img src="<?php echo base_url(); ?>upload/sign/logo.png" alt="">
        </div>
        <div class="top-header-right">
            <p style="">Reg. no. : <b>218590/75/076</b> &nbsp; 
            <!--Pan no. : <b>609569333</b>-->
            </p>
        </div>
        <div class="row-box">
            <div class="title">
                <h1>Try For Learn Pvt. Ltd.</h1>
                <p style="font-size:1.4rem;">Kirtipur - 09, Kathmandu</p>
            </div>
            <div class="cert-tit">
            <div class="certificate-title">
                <h2>Certificate of Participation</h2>
            </div>
            <div class="certificate-title-before">
                <img src="<?php echo base_url(); ?>upload/background/printable.png" style="width:80%;">
            </div>
            </div>
            
        </div>
        <div class="row-box2">
            <p style="text-align:left;margin-left:-70px;"><strong>Certificate No. : <?= @$value['Document_Number']; ?></strong></p>
            <p class="main-text">This is to Certify that <br><?= @$value['Title']; ?> <b><?= @$value['Name']; ?></b> <br>From <b><?= @$value['Organization']; ?></b> <br>has actively participated as a learner of <span class="course"> <strong>36 hours Math Lab with Zero Cost and Geogebra++</strong></span> Mathematics Teachers' Training Conducted By TFL team <br>on <strong>2077-04-31 to 2077-05-17. </strong> <br></p>
            <p style="text-align:left;margin-left:-70px;">
            <span style="font-size:1rem;">Citizenship No. of Participant: <b><?= @$value['Citizenship']; ?></b></span></p>
        </div>
        <div class="row-box3">
            <div class="footer-main">
                <div class="signee">
                    <div class="signature" style="top:-30%;left:-35%;">
                        <img src="<?php echo base_url(); ?>upload/sign/sign1.png" alt="">
                    </div>
                    <div class="detail">
                        <span>-------------------------</span>
                        <span>Janak Singh Karki</span>
                        <span>Managing Director</span>
                        <span>Try For Learn Pvt. Ltd.</span>
                    </div>  
                </div>
                <div class="signee">
                    <div class="signature" style="top:-30%;left:-20%;">
                        <img src="<?php echo base_url(); ?>upload/sign/sign2.png" alt="">
                    </div>
                    <div class="detail">
                        <span>-------------------------</span>
                        <span>Prof. Uma Nath Pandey</span>
                        <span>Chief Guest</span>
                        <span>Chairman, <br>
                        Mathematics & 
                        Computer Science Education <br>
                        Subject Committee, FOE, TU</span>
                    </div>  
                </div>
                <div class="signee">
                    <div class="signature" style="top:-30%;">
                        <img src="<?php echo base_url(); ?>upload/sign/sign3.png" alt="">
                    </div>
                    <div class="detail">
                        <span>-------------------------</span>
                        <span>Abatar Subedi</span>
                        <span>Special Guest</span>
                        <span>President, <br>
                        Council for Mathematics Education, <br>
                        Bagmati Province</span>
                    </div>  
                </div>
                <div class="signee">
                    <div class="signature">
                        <img src="<?php echo base_url(); ?>upload/sign/sign4.png" alt="">
                    </div>
                    <div class="detail">
                        <span>-------------------------</span>
                        <span>Hari Narayan Upadhyaya</span>
                        <span>Math Lab Facilitator</span>
                        <span>Masters of Trainer of Trainers </span>
                        <!-- <span>Try For Learn Pvt. Ltd.</span> -->
                    </div>  
                </div>
            </div>
            <div class="footer-notice" style="margin-top:5rem;">
                <p>This document is only valid when it is verified by <a href="#">www.tryforlearn.com</a>  or <a href="#">www.tryforlearn.com.np</a></p>
            </div>
        </div>
        <center class="row no-print">
                <div class="col-xs-12">
                    <button class="btn btn-default" id="btn-clicked" onclick="printing();"><i class="fa fa-print"></i> Print</button>
                </div>
        </center>
    </div>
    <script>
    function printing(){
         document.getElementById("btn-clicked").style.display = "none";
          window.print();
    }
   
       
    </script>

</body>
</html>