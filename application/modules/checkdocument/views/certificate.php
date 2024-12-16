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
        background: url('<?php echo base_url(); ?>upload/certificatebg/<?=$certificate->image;?>');
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
						<TD style="vertical-align: top;text-align:center;">
							<DIV class="certificate-box">
							
								<DIV class="certificate-bg" style="position: relative;">
									
									<h2 style="position:absolute;margin-top:12%;z-index: 1;left:38%;
									text-align:center !important;z-index:2;
									">
										<!-- Certificate of Appreciation -->
										<?= @$certificate->title; ?>
									</h2>

									
									<!-- <h2 style="font">Certificate of Appreciation</h2> -->
									<img src="<?php echo base_url(); ?>upload/background/printable.png" alt="" style="width:60%;z-index:1;">
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
							<p class="main-text">
							    <?php 
							    $phrase  = $certificate->content;
                                    $search = ["{{title}}","{{name}}", "{{school}}", "{{course}}","{{date}}"];
                                    $replace   = [$value['Title'],$value['Name'],$value['Organization'], $certificate->course,$certificate->programdate];
                                    
                                    $content = str_replace($search, $replace, $phrase);
                                    ?>
							    <?=$content; ?>
							    </p>
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
						     <?=$certificate->footer1; ?>
		                    </DIV> 
						
					</TD>
					<TD style="vertical-align:top;">
						<DIV class="detail">
						    <?=$certificate->footer2; ?>

		                    </DIV>  
					</TD>
					<TD style="vertical-align:top;">
						<DIV class="detail">
						    	<?=$certificate->footer3; ?>

		                    </DIV>
					</TD>
					<TD style="vertical-align:top;">
						<DIV class="detail">
						    <?=$certificate->footer4; ?>
 
		                    </DIV>  
					</TD>
				</TR>
			
			</TABLE>
			
	
</body>

</html>
