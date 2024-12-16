<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>certificate</title>
</head>
<style>
    body{
        background: url('<?php echo base_url(); ?>upload/background/2.jpeg');
        background-repeat: no-repeat;
        background-size:cover;
        width:100%;
        height:auto;
        text-align: center;
        

    }
    .container-box{
        position: relative;
        padding:3rem;
    }
    .top-header-left{
        position: absolute;
        left:10%;
        top:15%;

    }
    .top-header-left img{
        width: 120px;
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
        font-size:2.4rem;
        color:#2d5898;
        margin-bottom: 0;
    }
    .row-box .title p{
        
        margin-top: 0;
    }
    .certificate-title::before{
        content:'';
        background: url('<?php echo base_url(); ?>upload/background/printable2.png');
        background-repeat: no-repeat;

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
          top: -25%;
        left: -50%;
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
</style>
<body>
    <div class="container-box">
        <div class="top-header-left">
            <img src="logo.png" alt="">
        </div>
        <div class="top-header-right">
            <p><small>Reg. no. : <b>218590/75/076</b>, &nbsp; Pan no. : <b>609569333</b></small></p>
        </div>
        <div class="row-box">
            <div class="title">
                <h1>Try For Learn Pvt. Ltd.</h1>
                <p>Kirtipur - 09, Kathmandu</p>
            </div>
            <div class="certificate-title">
                <h2>Certificate of Participation</h2>
            </div>
        </div>
        <div class="row-box2">
            <p><strong>Certificate No. : 7584875</strong></p>
            <p class="main-text">This is to Certify that <br> Mr./Mrs. <b>Gopal Tamang</b> <br>From <b>Soft Cherry Pvt. Ltd.</b> <br>has actively participated as a learner of <span class="course"> <strong>36 hour Math Lab with Zero Cost and Geogebra++</strong></span> Conducted By TFL team <br>on <strong>2077-04-31 to 2077-05-17. </strong> <br>
            <span style="font-size:1rem;">Citizenship No. of Participant: <b>13244/1235</b></span></p>
        </div>
        <div class="row-box3">
            <div class="footer-main">
                <div class="signee">
                    <div class="signature">
                        <img src="<?php echo base_url(); ?>upload/sign/sign1.png" alt="">
                    </div>
                    <div class="detail">
                        <span>-------------------------</span>
                        <span>Mr. Janak Singh Karki</span>
                        <span>Managing Director</span>
                        <span>Try For Learn Pvt. Ltd.</span>
                    </div>  
                </div>
                <div class="signee">
                    <div class="signature">
                        <img src="<?php echo base_url(); ?>upload/sign/sign2.png" alt="">
                    </div>
                    <div class="detail">
                        <span>-------------------------</span>
                        <span>Prof. Uma Nath Pandey</span>
                        <span>Chief Guest</span>
                        <span>Chairman, Mathematics & <br>Computer Science Education Committee, FOE, TU</span>
                    </div>  
                </div>
                <div class="signee">
                    <div class="signature">
                        <img src="<?php echo base_url(); ?>upload/sign/sign3.png" alt="">
                    </div>
                    <div class="detail">
                        <span>-------------------------</span>
                        <span>Mr. Abatar Subedi</span>
                        <span>Special Guest</span>
                        <span>President, MEC, Bagmati Province</span>
                    </div>  
                </div>
                <div class="signee">
                    <div class="signature">
                        <img src="<?php echo base_url(); ?>upload/sign/sign4.png" alt="">
                    </div>
                    <div class="detail">
                        <span>-------------------------</span>
                        <span>Mr. Hari Narayan Upadhyaya</span>
                        <span>Masters of Trainer of Trainers</span>
                        <!-- <span>Try For Learn Pvt. Ltd.</span> -->
                    </div>  
                </div>
            </div>
            <div class="footer-notice">
                <p>This document is only valid when it is verified by <a href="#">www.tryforlearn.com</a>  or <a href="#">www.tryforlearn.com.np</a></p>
            </div>
        </div>
        <center class="row no-print">
                <div class="col-xs-12">
                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                </div>
        </center>
        
    </div>

</body>
</html>