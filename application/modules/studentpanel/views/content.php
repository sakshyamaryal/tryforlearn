
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
<a href="javascript:void(0)" data-key="<?=$key;?>" data-val="<?= $lcourse->fileid; ?>" data-title="<?= $lcourse->title; ?>"  data-file="<?= $lcourse->file; ?>" data-type="<?=$type;?>"
 data-ext="<?= $lcourse->ext; ?>" id="cf_1_<?= $key; ?>" 
  onclick="previewselected(<?= $key; ?>,1,<?=$total;?>)">Preview </a>  |  <a href="<?=base_url();?>upload/content/<?= $lcourse->file; ?>">Download</a>



<?php } 
else if($type == 'video') { 
  // extract YouTube video ID from embed URL
  $youtubeId = ''; 
  if (strpos($lcourse->file, 'embed/') !== false) {
      $parts = explode('embed/', $lcourse->file);
      if (isset($parts[1])) {
          $youtubeId = explode('?', $parts[1])[0];
      }
  }
?>
  <div class="col-md-4 col-sm-6" style="margin-top:10px;">
      <div style="position: relative; cursor: pointer;" onclick="previewselected(<?= $key; ?>, 2, <?=$total;?>)">
          <!-- Thumbnail Image -->
          <img src="https://img.youtube.com/vi/<?= $youtubeId; ?>/hqdefault.jpg" 
               alt="<?= $lcourse->title; ?>" 
               class="img-fluid" 
               style="width:100%; border-radius:10px;">

          <!-- Play icon -->
          <div style="position: absolute; top: 50%; left: 50%; transform:translate(-50%, -50%); font-size: 48px; color: white;">
              <i class="fa fa-play-circle"></i>
          </div>
      </div>

      <input type="hidden" id="cf_2_<?= $key; ?>" 
             data-file="<?= $lcourse->file; ?>" 
             data-title="<?= $lcourse->title; ?>">
      
      <div style="text-align:center; margin-top:5px;"><?= $lcourse->title; ?></div>
  </div>
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

<script>
// function previewselected(key, type, total) {
//     var fileElement = document.getElementById('cf_2_' + key);
//     var file = fileElement.getAttribute('data-file');

//     var embedUrl = ""; 

//     if (file.includes("youtube.com") || file.includes("youtu.be")) {
//         // Convert YouTube URL to embeddable format
//         if (file.includes("watch?v=")) {
//             embedUrl = file.replace("watch?v=", "embed/");
//         } else {
//             // if already shortened like youtu.be/xxxx
//             var videoId = file.split("/").pop();
//             embedUrl = "https://www.youtube.com/embed/" + videoId;
//         }
//     } else {
//         // else normal video file (e.g., mp4)
//         embedUrl = file;
//     }

//     var iframeHtml = '<iframe width="100%" height="450" src="' + embedUrl + '?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

//     document.getElementById('mypreviewbody').innerHTML = iframeHtml;

//     $('.waittime').hide(); // Hide loading text if needed
//     $('#preview-modal').modal('show');
// }

// function clearPreview() {
//     document.getElementById('mypreviewbody').innerHTML = "";
// }

$('#preview-modal').on('hidden.bs.modal', function () {
    // When modal is closed, clear the iframe to stop the video
    $('#mypreviewbody').html('');
});

</script>

