<table class="table table-striped table-bordered  responsive" style="width: 90%;" id="dataTable" data-filename="contentlist" data-cols="[0,1,2]">
<thead>
<tr>
<!-- <th class="my-th" rowspan="3">S.N.</th> -->
<th class="my-th" style="text-align:center;">S.N.</th>
<th class="my-th" style="text-align:center;">Title</th>
<th class="my-th" style="text-align:center;">File</th>
<th class="my-th" style="text-align:center;">Order By</th>
<th class="my-th donotprint" style="text-align:center;">Action</th>


</tr>

</thead>
<tbody id="tbody">
<?php $sn=0; foreach($content as $list) : $sn++?>
<tr id="filelist<?=$list->fileid;?>">
<td><?= $sn; ?></td>
<td>
<div class=" fileqn fileqn<?=$list->fileid;?>"><?= $list->title;?></div>
<div class="inlineeditqn inlineeditqn<?=$list->fileid;?>">
<input type="hidden" id="filecid<?=$list->fileid;?>" name="filecid" value="<?=$list->fileid;?>" />

<input type="text" id="filetitle<?=$list->fileid;?>" name="filetitle" value="<?=$list->title;?>" />
</div>
</td>
<td>
<?php if($list->filetype=='image'){
    echo '<i class="fa fa-gallery"></i> <img   data-type="'.$list->filetype.'" data="'.$list->file.'" src="'.base_url().'upload/content/'.$list->file.'" style="cursor:pointer;width:25%;" />';

}
else if($list->filetype=='video')
{
    echo '<i class="fa fa-video"></i> <a href="javascript:void(0)" id="fileview'.$list->fileid.'" data-type="'.$list->filetype.'" data="'.$list->file.'" onclick="getpreview('.$list->fileid.')">Preview</a>';


}
else if($list->filetype='file')
{
  if(strtolower($list->ext)=='pdf')
  {
    $link=base_url().'assets/pdf.jpg';
  }else if(strtolower($list->ext)=='doc' || strtolower($list->ext)=='docx')
  {
    $link=base_url().'assets/word.png';
  }else if(strtolower($list->ext)=='ppt' || strtolower($list->ext)=='pptx')
  {
    $link=base_url().'assets/powerpoint.png';
  }else if(strtolower($list->ext)=='xls' || strtolower($list->ext)=='xlsx')
  {
    $link=base_url().'assets/excel.png';
  }
  echo '<img style="width:10%" src="'.$link.'"/>&nbsp;<a href="javascript:void(0)" id="fileview'.$list->fileid.'" data-type="'.$list->filetype.'"  data="'.$list->file.'" onclick="getpreview('.$list->fileid.')">Preview</a>';

}
?>
</td>
<td>
<div class=" fileqn fileqn<?=$list->fileid;?>"><?= $list->orderby;?></div>
<div class="inlineeditqn inlineeditqn<?=$list->fileid;?>">
<input type="number" id="fileorderby<?=$list->fileid;?>" name="fileorderby" value="<?=$list->orderby;?>" />
</div>
</td>

<td class="center donotprint">

	 <a class="editbtn editbtn<?=$list->fileid;?>" href="javascript:void(0)" style="color:black;" onclick="editfile(<?=$list->fileid;?>)" >
            <i class="fa fa-edit" title="Edit"></i>
            
    </a>
    <a class="btn btn-success savebtn savebtn<?=$list->fileid;?>" onclick="updatefile(<?=$list->fileid;?>)">Submit</a>
     |
			
			<a class="" href="javascript:void(0)" onclick="delfile(<?=$list->fileid;?>)" style="color:red;">
            <i class="fa fa-trash" title="Delete"></i>
            
            </a> 
   
   
    
    </td>

</tr>
<?php endforeach; ?>


</tbody>
</table>






   