
<div class="row" >

<?php
$total=count($list);
 foreach($list as $key=> $lcourse): 

if($type=='file'){
?>

<div class="col-md-3 col-sm-3" style="margin-top:10px;">
<?=$lcourse->title;?><br/>

  <?php if(strtolower($lcourse->ext)=='pdf')
  {
    $link=base_url().'assets/pdf.jpg';
  }else if(strtolower($lcourse->ext)=='doc' || strtolower($lcourse->ext)=='docx')
  {
    $link=base_url().'assets/word.png';
  }else if(strtolower($lcourse->ext)=='ppt' || strtolower($lcourse->ext)=='pptx')
  {
    $link=base_url().'assets/powerpoint.png';
  }else if(strtolower($lcourse->ext)=='xls' || strtolower($lcourse->ext)=='xlsx')
  {
    $link=base_url().'assets/excel.png';
  }
  echo '<img style="width:10%" src="'.$link.'"/>&nbsp;';
?>
<a href="javascript:void(0)" data-key="<?=$key;?>" data-val="<?= $lcourse->fileid; ?>"
 data-title="<?= $lcourse->title; ?>"  data-file="<?= $lcourse->file; ?>" data-type="<?=$type;?>"
 data-ext="<?= $lcourse->ext; ?>" id="cf_1_<?= $key; ?>" 
  onclick="previewselected(<?= $key; ?>,1,<?=$total;?>)">Preview </a>  |  <a href="<?=base_url();?>upload/content/<?= $lcourse->file; ?>">Download</a>



<?php } 
else if($type=='video')
{ ?>
<div class="col-md-3 col-sm-3" style="margin-top:10px;">
<?=$lcourse->title;?><br/>
<i class="fa fa-video"></i>&nbsp;
<a href="javascript:void(0)" data-key="<?=$key;?>" data-val="<?= $lcourse->fileid; ?>"
 data-title="<?= $lcourse->title; ?>"  data-file="<?= $lcourse->file; ?>" data-type="<?=$type;?>"
 data-ext="<?= $lcourse->ext; ?>" id="cf_2_<?= $key; ?>" 
  onclick="previewselected(<?= $key; ?>,2,<?=$total;?>)">Preview </a>


<?php } 
else if($type=='image')
{ ?>
<div class="col-md-3 col-sm-3" style="margin-top:10px;">
<?=$lcourse->title;?><br/>
<img style="width:20%" src="<?=base_url();?>upload/content/<?=$lcourse->file;?>"/>&nbsp;
<a href="javascript:void(0)" data-key="<?=$key;?>" data-val="<?= $lcourse->fileid; ?>"
 data-title="<?= $lcourse->title; ?>"  data-file="<?= $lcourse->file; ?>" data-type="<?=$type;?>"
 data-ext="<?= $lcourse->ext; ?>" id="cf_3_<?= $key; ?>" 
  onclick="previewselected(<?= $key; ?>,3,<?=$total;?>)">Preview </a>


<?php }
?>
</div>
<?php

endforeach ;?>
</div>



