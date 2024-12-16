
<a href="javascript:void(0)" id="checks" onclick="getchecked()" ><i class="fa fa-check" title="Check all" style="    border-width: 1px;border-style: solid; cursor: pointer;"></i></a> &nbsp;
<a href="javascript:void(0)" style="cursor:pointer;" title="Copy Question" onclick="trimques()" id="trimschedule"><i class="fa fa-cogs fa-2x"></i></a>
</span>

<table class="table table-striped table-bordered  responsive" style="width: 90%;" id="dataTable" data-filename="exerciselist" data-cols="[0,1,2,3,4,5]">
<thead>
<tr>
<!-- <th class="my-th" rowspan="3">S.N.</th> -->
<th class="my-th" style="text-align:center;">S.N.</th>
<th class="my-th" style="text-align:center;">Question</th>
<th class="my-th" style="text-align:center;">Explanation</th>
<th class="my-th" style="text-align:center;">IS Subj/Obj</th>
<th class="my-th" style="text-align:center;">Is For All Date</th>
<th class="my-th" style="text-align:center;">Is Timer</th>
<th class="my-th donotprint" style="text-align:center;">Action</th>


</tr>

</thead>
<tbody id="tbody">
<?php $sn=0; foreach($exercise as $list) : $sn++?>
<tr id="ch<?=$list->eid;?>">
<td><?= $sn; ?><br/>
<input type="checkbox" name="selected[]" value="<?=$list->eid;?>" />
</td>
<td><?= $list->question;?></td>
<td><?= $list->explanation;?></td>
<td><?php  if($list->is_subj_obj=='Y'){echo 'Subjective';}else{echo'Objective';};?></td>
<td><?php  if($list->is_common=='Y'){echo 'Yes';}else{echo'No<br/>'.$list->questiondate;};?></td>
<td><?php  if($list->is_timer=='N'){echo 'No';}else{echo'Yes<br/>'.$list->timing;};?></td>
<td class="center donotprint">
	 <a class="" href="<?=base_url();?>exercise/getbyid/<?=$list->eid;?>" style="color:black;" target="_blank" >
            <i class="fa fa-edit" title="Edit"></i>
            
            </a> |
			
			<a class="" href="javascript:void(0)" onclick="delexercise(<?=$list->eid;?>)" style="color:red;">
            <i class="fa fa-trash" title="Delete"></i>
            
            </a> 
   
   
    
    </td>

</tr>
<?php endforeach; ?>


</tbody>
</table>






   