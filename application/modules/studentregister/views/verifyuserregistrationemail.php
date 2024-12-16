<!DOCTYPE html >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0">    <!-- So that mobile webkit will display zoomed in -->
    <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->

    <title><?=$title;?></title>
    <style type="text/css">

        /* Resets: see reset.css for details */
        .ReadMsgBody { width: 100%; background-color: #ebebeb;}
        .ExternalClass {width: 100%; background-color: #ebebeb;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
        body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
        body {margin:0; padding:0;}
        table {border-spacing:0;}
        table td {border-collapse:collapse;}
        .yshortcuts a {border-bottom: none !important;}


        /* Constrain email width for small screens */
        @media screen and (max-width: 600px) {
            table[class="container"] {
                width: 95% !important;
            }
        }

        /* Give content more room on mobile */
        @media screen and (max-width: 480px) {
            td[class="container-padding"] {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }
        }

    </style>
</head>
<body style="margin:0; padding:10px 0;" bgcolor="#ebebeb" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<br>

<!-- 100% wrapper (grey background) -->
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#ebebeb">
    <tr>
        <td align="center" valign="top" bgcolor="#ebebeb" style="background-color: #ebebeb;">

            <!-- 600px container (white background) -->
            <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" bgcolor="#ffffff">
                <tr>
                    <td class="container-padding" bgcolor="#ffffff" style="background-color: #ffffff; padding-left: 30px; padding-right: 30px; font-size: 14px; line-height: 20px; font-family: Helvetica, sans-serif; color: #333;">
                        <br>

                        <!-- ### BEGIN CONTENT ### -->

                        <div style="border-bottom: 1px solid #ccc; font-size: 14px; padding-left: 6px; padding-top: 6px; padding-bottom: 6px; line-height: 20px; font-family: Helvetica, sans-serif; color: #333;">
                            <img src="<?=base_url();?>assets/try.png" style="width: 25%;" /><br>
                            email: <a style="color:#000; text-decoration: underline;" href="mailto:<?= $basic->email ;?>"><?= $basic->email ;?></a><br>
                            website: <a style="color:#000; text-decoration: underline;" href="<?=base_url();?>"><?=base_url();?></a>
                        </div>
                        <br>

                        Dear <?php if(isset($post['name'])) { echo $post['name']; }?>,<br><br>
                       
                        
                       <?php if(isset($link)) { echo $link; }?>
 
                     
                       
                 
                       

                      
                        <br><br>

                        Warmest Regards<br>Administration Department - <?= $title; ?>
                        <br><br>

                        <em style="font-style:italic; font-size: 12px; color: #aaa;">Customer Support: <a href="mailto:<?=$basic->email;?>"><?=$basic->email;?></a></em>
                        <br><br>

                        <em style="font-style:italic; font-size: 12px; color: #aaa;">Prevent emails like this from winding up in your email spam folder, please place <strong><?=$basic->email;?></strong> in your Safe Sender’s list.</em>
                        <br><br>

                        <em style="font-style:italic; font-size: 12px; color: #aaa;">You're receiving this email because you've opted in to receive emails from <a href="<?=base_url();?>"><?=$title;?></a></em>
                        <br><br>
                        <!-- ### END CONTENT ### -->
                    </td>
                </tr>
            </table>
            <!--/600px container -->

        </td>
    </tr>
</table>
<!--/100% wrapper-->
<br>
<br>
</body>
</html>

