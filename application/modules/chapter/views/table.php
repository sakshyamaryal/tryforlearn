<table class="table table-striped table-bordered  responsive" style="width: 90%;" id="dataTable" data-filename="chapterlist" data-cols="[0,1]">
<thead>
<tr>
<!-- <th class="my-th" rowspan="3">S.N.</th> -->
<th class="my-th" style="text-align:center;">S.N.</th>
<th class="my-th" style="text-align:center;">Chapter</th>
<th class="my-th donotprint" style="text-align:center;">Action</th>


</tr>

</thead>
<tbody id="tbody">
<?php $sn=0; foreach($chapter as $list) : $sn++?>
<tr id="ch<?=$list->chapterid;?>">
<td><?= $sn; ?></td>
<td><?= $list->chaptername;?></td>
<td class="center donotprint">
	 <a class="" href="javascript:void(0)" style="color:black;" onclick="getedit(<?=$list->chapterid;?>)" >
            <i class="fa fa-edit" title="Edit"></i>
            
            </a> |
			
			<a class="" href="javascript:void(0)" onclick="delchapter(<?=$list->chapterid;?>)" style="color:red;">
            <i class="fa fa-trash" title="Delete"></i>
            
            </a> 
   
   
    
    </td>

</tr>
<?php endforeach; ?>


</tbody>
</table>






   