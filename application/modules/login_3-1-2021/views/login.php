<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<title>Admin Login</title>

<link href="<?=base_url();?>themes/admin/css/bootstrap-cerulean.min.css" rel="stylesheet">
<link href="<?=base_url();?>themes/admin/css/charisma-app.css" rel="stylesheet">
<link href='<?=base_url();?>themes/admin/bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
<link href='<?=base_url();?>themes/admin/bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
<link href='<?=base_url();?>themes/admin/bower_components/chosen/chosen.min.css' rel='stylesheet'>
<link href='<?=base_url();?>themes/admin/bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
<link href='<?=base_url();?>themes/admin/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
<link href='<?=base_url();?>themes/admin/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
<link href='<?=base_url();?>themes/admin/css/jquery.noty.css' rel='stylesheet'>
<link href='<?=base_url();?>themes/admin/css/noty_theme_default.css' rel='stylesheet'>
<link href='<?=base_url();?>themes/admin/css/elfinder.min.css' rel='stylesheet'>
<link href='<?=base_url();?>themes/admin/css/elfinder.theme.css' rel='stylesheet'>
<link href='<?=base_url();?>themes/admin/css/jquery.iphone.toggle.css' rel='stylesheet'>
<link href='<?=base_url();?>themes/admin/css/uploadify.css' rel='stylesheet'>
<link href='<?=base_url();?>themes/admin/css/animate.min.css' rel='stylesheet'>

<script src="<?=base_url();?>themes/admin/bower_components/jquery/jquery.min.js"></script>


<link rel="shortcut icon" href="<?=base_url();?>themes/admin/img/favicon.ico">
</head>
<body>
<div class="ch-container">
<div class="row">
<div class="row">
<div class="col-md-12 center login-header">
<h2>Admin Panel</h2>
</div>

</div>
<div class="row">
<div class="well col-md-5 center login-box">
<div class="alert alert-info">
Enter System Credentials.
<b style="color:red;"><?=$this->session->flashdata('error')?></b>
</div>
<form class="form-horizontal" action="<?=base_url();?>login/authenticate" method="post">
<fieldset>
<div class="input-group input-group-lg">
<span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
<input type="text" class="form-control" placeholder="Username" name="username">
</div>
<div class="clearfix"></div><br>
<div class="input-group input-group-lg">
<span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
<input type="password" class="form-control" placeholder="Password" name="password">
</div>

<div class="clearfix"></div>
<p class="center col-md-5">
<button type="submit" class="btn btn-primary">Login</button>
</p>
</fieldset>
</form>
</div>

</div>
</div>
</div>

<script src="<?=base_url();?>themes/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?=base_url();?>themes/admin/js/jquery.cookie.js"></script>

<script src='<?=base_url();?>themes/admin/bower_components/moment/min/moment.min.js'></script>
<script src='<?=base_url();?>themes/admin/bower_components/fullcalendar/dist/fullcalendar.min.js'></script>

<script src='<?=base_url();?>themes/admin/js/jquery.dataTables.min.js'></script>

<script src="<?=base_url();?>themes/admin/bower_components/chosen/chosen.jquery.min.js"></script>

<script src="<?=base_url();?>themes/admin/bower_components/colorbox/jquery.colorbox-min.js"></script>

<script src="<?=base_url();?>themes/admin/js/jquery.noty.js"></script>

<script src="<?=base_url();?>themes/admin/bower_components/responsive-tables/responsive-tables.js"></script>

<script src="<?=base_url();?>themes/admin/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>

<script src="<?=base_url();?>themes/admin/js/jquery.raty.min.js"></script>

<script src="<?=base_url();?>themes/admin/js/jquery.iphone.toggle.js"></script>

<script src="<?=base_url();?>themes/admin/js/jquery.autogrow-textarea.js"></script>

<script src="<?=base_url();?>themes/admin/js/jquery.uploadify-3.1.min.js"></script>

<script src="<?=base_url();?>themes/admin/js/jquery.history.js"></script>

<script src="<?=base_url();?>themes/admin/js/charisma.js"></script>
</body>

</html>