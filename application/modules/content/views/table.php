<table class="table table-striped table-bordered  responsive" style="width: 90%;" id="dataTable" data-filename="contentlist" data-cols="[0,1]">
<thead>
<tr>
<!-- <th class="my-th" rowspan="3">S.N.</th> -->
<th class="my-th" style="text-align:center;">S.N.</th>
<th class="my-th" style="text-align:center;">Content</th>
<th class="my-th" style="text-align:center;">Order</th>
<th class="my-th donotprint" style="text-align:center;">Action</th>


</tr>

</thead>
<tbody id="tbody">
<?php $sn=0; foreach($content as $list) : $sn++?>
<tr id="ch<?=$list->contentid;?>">
<td><?= $sn; ?></td>
<td><?= $list->title;?></td>
<td><?= $list->orderby;?></td>
<td class="center donotprint">
<a class="" href="javascript:void(0)" style="color:blue;" onclick="viewcontent(<?=$list->contentid;?>)" >
            <i class="fa fa-eye" title="View Content"></i>
            
            </a> |
			
			<a class="" href="javascript:void(0)" onclick="addfile(<?=$list->contentid;?>)" style="color:green;">
            <i class="fa fa-plus" title="Add Content"></i>
            
            </a>  |
	 <a class="" href="javascript:void(0)" style="color:black;" onclick="getedit(<?=$list->contentid;?>)" >
            <i class="fa fa-edit" title="Edit"></i>
            
            </a> |
			
			<a class="" href="javascript:void(0)" onclick="delchapter(<?=$list->contentid;?>)" style="color:red;">
            <i class="fa fa-trash" title="Delete"></i>
            
            </a> 
   
   
    
    </td>

</tr>
<?php endforeach; ?>


</tbody>
</table>






   