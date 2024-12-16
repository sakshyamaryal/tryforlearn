<style>
    .loader{
        position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    opacity: .8;
    }
    .hide{
        display:none;
    }
    .show{
        display:block;
    }
    .blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: yellow;    }
    49%{    color: yellow; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: yellow;    }
}
</style>

<div class="navbar navbar-default" role="navigation">
    <div class="navbar-inner">
  
    <a class="navbar-brand" href="index.html">    <span><?= $header_title; ?></span></a>
  
    
    <div class="btn-group pull-right">
    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?= $adminusername; ?></span>
    <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
    <li class="divider"></li>
    <li><a href="<?=base_url();?>account/logout">Logout</a></li>
    </ul>
    </div>
    
    
   
   
    </li>
    
    </ul>
    </div>
    </div>
    
    <div class="ch-container">
    <div class="row">
    
    <div class="col-sm-2 col-lg-2">
     <a href="javascript:void(0)" class="showbar"><i class="fa fa-bars"></i></a>
    <div class="sidebar-nav">
        <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">
            </div>
        <ul class="nav nav-pills nav-stacked main-menu">
        <li class="nav-header">Main <span style="float:right"><a href="javascript:void(0)" class="minimize" style="cursor:pointer;"><i class="fa fa-minus fa-2x" title="Minimize"></i></a></span></li>
        <li><a class="ajax-link" href="<?=$admin_base_url;?>"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
        </li>
        <?php foreach($modules as $mod):?>
       <?php if(count($mod['submenu'])>0){ ?>
        <li class="accordion">
        <a href="#"><i class="<?= $mod['menu']['fonticon']; ?>"></i><span> <?= $mod['menu']['module_name']; ?></span><i class="fa fa-chevron-down" style="float: right;"></i></a>
        <ul class="nav nav-pills nav-stacked">
        <?php foreach($mod['submenu'] as $list): ?>
        <li><a href="<?= base_url().$list['controller_fname']; ?>"><i class="<?= $list['fonticon']; ?>"></i><span> <?= $list['module_name']; ?></span></a></li>
        <?php endforeach; ?>
         </ul>
        </li>
            <?php } else { ?>
                <li><a href="<?= base_url().$mod['menu']['controller_fname']; ?>"><i class="<?= $mod['menu']['fonticon']; ?>"></i><span> <?= $mod['menu']['module_name']; ?></span></a>
               </li>
            <?php } 
            endforeach; ?>
      
        
        </ul>
        </div>
    </div>
    </div>
    <div id="loader" >
            <img  src="<?=base_url();?>assets/admin/gif/loader.gif" class="loader">
    </div>
    <script>
    $('.showbar').hide();
    $('.minimize' ).click(function() {
        $('.sidebar-nav').hide();
        $('#content').removeClass("col-lg-10 col-sm-10");
        $('#content').addClass("col-lg-12 col-sm-12");
        $('.showbar').show();

    });
    $('.showbar' ).click(function() {
        $('.showbar').hide();
        $('.sidebar-nav').show();
        $('#content').removeClass("col-lg-12 col-sm-12");
        $('#content').addClass("col-lg-10 col-sm-10");
        

    });

        $('#loader').hide();
        $( document ).ready(function() {
   // console.log( "ready!" );
    $('#loader').hide();
   // $(".dataExport").click(function() {
        //var exportType = $(this).data('type');
       		
	//});
});
function printDiv() {
    $('.btn-toolbar').hide();
    $('.donotprint').hide();
         var data=document.getElementById("dataTable");
         var htmlToPrint = '' +
        '<style type="text/css">' +
        'table ,td,th {' +
        'border:1px solid #000;' +
        'table {border-collapse: collapse;width: 100%;}' +
        '}' +
        '</style>';
        htmlToPrint += data.outerHTML;
   var win = window.open('', '', 'height=700,width=700');
            win.document.write(htmlToPrint);
            win.document.close();
            win.print();
            $('.btn-toolbar').show();
            $('.donotprint').show();
       }

    </script>