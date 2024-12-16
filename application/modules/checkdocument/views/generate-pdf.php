<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= @$value['Name']; ?> - TRYFORLEARN Certificate</title>
</head>
<style>
    body{
        text-align: center;
        margin:0;
        background: url('<?php echo base_url(); ?>upload/background/2.jpeg');
        background-image-resize:5;
        background-position:top center;
        background-repeat:no-repeat;
        background-size:cover;
    }

     .main-text{
        font-size: 1.4rem;
        line-height: 1.8rem;
    }
    .signature{
        width:130px;
        height: 50px;

    }
    .detail{
        vertical-align: top;
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
    table{
    	text-align:center;
    }
    .title-h1{
    	font-size:2.8rem;
        color:#2d5898;
        margin-bottom: 0;
    }
    .title-p{
    	margin-top: 0;
    }
    .certificate-box{
    	position: relative;
    	padding:2rem;
    }

    .sign-box{
        position:relative;
    }
    .sign-box img{
        position:absolute;
        top:50%;
    }
</style>
<body style="">
	<!--<TABLE style="background: url('<?php echo base_url(); ?>upload/background/2.jpeg');width:100%;height:auto;background-size:cover;padding:3rem;" >-->
	
				<TABLE style="width:100%; padding-top:-10px;" > 
					<TR>
						<TD colspan="3" style="text-align:right;">
							<small>Reg. no. : <b>218590/75/076</b></small>
						</TD>
					</TR>
					<TR>
						<TD style="width:15%;" rowspan="2">
							<img src="<?php echo base_url(); ?>upload/sign/logo.png" alt="" style="width:130px;">
						</TD>
						<TD  style="">
							<h1 class="title-h1">Try For Learn Pvt. Ltd.</h1>
							<p class="title-p">Kirtipur -09, Kathmandu</p>
						</TD>
						<TD  style="width:15%;"></TD>
					</TR>
					<TR>
						<!-- <TD></TD> -->
						<TD style="vertical-align: top;">
							<DIV class="certificate-box">
								<!--<DIV class="certificate-title">-->
								<!--	<h2>Certificate of Participation</h2>-->
								<!--</DIV>-->
								<DIV class="certificate-bg">
									
									<img src="<?php echo base_url(); ?>upload/background/printable2.png" alt="" style="width:60%;display:none;">
								</DIV>
							</DIV>
							
						</TD>
						<TD></TD>
					</TR>
					<TR>
					    <!--<TD></TD>-->
						<TD colspan="2" style="text-align:left;"><strong>Certificate No: <?= @$value['Document_Number']; ?></strong></TD>
						<TD></TD>
					</TR>
				</TABLE>
			
				<TABLE class="TABLE-body" style="width:100%;">
					<TR>
						<TD style="width:15%;"></TD>
						<TD>
							<p class="main-text">This is to Certify that <br><?= @$value['Title']; ?> <b><?= @$value['Name']; ?></b> <br>From <b><?= @$value['Organization']; ?></b> <br>has actively participated as a learner of <span class="course"> <strong>36 hours Math Lab with Zero Cost and Geogebra++</strong></span> Mathematics Teachers' Training Conducted By TFL team <br>on <strong>2077-04-31 to 2077-05-17. </strong></p>
						</TD>
						<TD style="width:15%;"></TD>
					</TR>
					<TR>
						<!--<TD></TD>-->
						<TD colspan="3" style="text-align:left;">Citizenship No. of Participant: <b><?= @$value['Citizenship']; ?></b></TD>
						<!--<TD></TD>-->
					</TR>
				</TABLE>

				<TABLE style="margin-top:1rem;width:100%;padding-top:20px;">
		
				<TR style="">
					<TD style="vertical-align:top;">
						<DIV class="detail">
						    <img class="signature" src="<?php echo base_url(); ?>upload/sign/sign1.png" alt=""><br>
						       -----------------------<br>
		                       Janak Singh Karki <br>
		                       Managing Director <br>
		                        Try For Learn Pvt. Ltd.
		                    </DIV> 
						
					</TD>
					<TD style="vertical-align:top;">
						<DIV class="detail">
						    <img class="signature" src="<?php echo base_url(); ?>upload/sign/sign2.png" alt=""><br>
						    -----------------------<br>
		                        Prof. Uma Nath Pandey<br>
		                        Chief Guest<br>
		                        Chairman, <br>
                        Mathematics & 
                        Computer Science Education <br>
                        Subject Committee, FOE, TU
		                    </DIV>  
					</TD>
					<TD style="vertical-align:top;">
						<DIV class="detail">
						    <img class="signature" src="<?php echo base_url(); ?>upload/sign/sign3.png" alt=""><br>
						    -----------------------<br>
		                      Abatar Subedi<br>
		                      Special Guest<br>
		                      President, <br>
                        Council for Mathematics Education, <br>
                        Bagmati Province
		                    </DIV>
					</TD>
					<TD style="vertical-align:top;">
						<DIV class="detail">
						    <img class="signature" src="<?php echo base_url(); ?>upload/sign/sign4.png" alt=""><br>
						    -----------------------<br>
		                      Hari Narayan Upadhyaya<br>
		                       Math Lab Facilitator <br>
		                       Masters of Trainer of Trainers 
		                    </DIV>  
					</TD>
				</TR>
				<!--<TR style="margin-top:1rem;">-->
				<!--	<TD colspan="4" style="padding-top:26px;">-->
				<!--		<p style="color:red;">-->
						    <!--<strong>NOTE: </strong>-->
				<!--		    This document is only valid when it is verified by <a href="https://www.tryforlearn.com">www.tryforlearn.com</a>  or <a href="https://www.tryforlearn.com">www.tryforlearn.com.np</a></p>-->
				<!--	</TD>-->
				<!--</TR>-->
			</TABLE>
			
	
</body>

</html>
