<table class="table table-striped table-bordered  responsive" style="width: 90%;" id="dataTable" data-filename="studentexerciselist" data-cols="[0,1,2,3,4,5]">
<thead>
<tr>
<!-- <th class="my-th" rowspan="3">S.N.</th> -->
<th class="my-th" style="text-align:center;">S.N.</th>
<th class="my-th" style="text-align:center;">Student Name</th>
<th class="my-th" style="text-align:center;">Exam Date</th>
<th class="my-th" style="text-align:center;">Exam Type</th>
<th class="my-th" style="text-align:center;">No.Of Ques</th>
<th class="my-th" style="text-align:center;">Status</th>
<th class="my-th donotprint" style="text-align:center;">Action</th>


</tr>

</thead>
<tbody id="tbody">
<?php $sn=0; foreach($row as $list) : $sn++?>
<tr id="ch<?=$list->setid;?>">
<td><?= $sn; ?></td>
<td><?= $list->fullname.'<br/>Phone: '.$list->phone.' '.'Email: '.$list->email;?></td>
<td><?= $list->examdate; ?>
<?php if((float)$list->totaltimer>0):?>
<br/>
Submitted In:<br/> <?= number_format((float)($list->submitted_time/60),3).'/'. number_format((float)($list->totaltimer/60),3).'(min.)' ;?>
<?php endif; ?>
 </td>
<td>Exam Category: <?= $list->examcategory; ?><br/>Exam On: <?= $list->examtype; ?></td>
<td><?= $list->totalqn; ?></td>
<td><?php if($list->setid!=''){
echo '<div class="alert alert-success">Submitted<br/>Mark: '.$list->obtainedmark.'/'.$list->totalmark.'</div>';}else
echo '<div class="alert alert-danger">No Record</div>';
 ?></td>

<td class="center donotprint">
<?php if($list->setid!=''){ ?>
 	 <a class="" href="<?=base_url();?>studentexercise/viewans/<?=$list->setid;?>/<?=$list->is_subj_obj;?>" style="color:black;" target="_blank" >
            <i class="fa fa-eye" title="View Answer"></i> View Answer
            
            </a> 
   
    <?php } ?>
    </td>

</tr>
<?php endforeach; ?>


</tbody>
</table>






   