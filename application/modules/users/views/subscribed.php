
<div id="content" class="col-lg-10 col-sm-10">

<div>
<ul class="breadcrumb">
<li>
<a href="<?= $admin_base_url; ?>">Home</a>
</li>
<li>
<a href="#"><?= $title;?></a>
</li>
</ul>
</div>
<?php echo $this->session->flashdata('msg'); ?>
<div class=" row">
<div class="box col-md-12">
<div class="box-inner">
<div class="box-header well" data-original-title="">
<h2><i class="fa fa-list"></i> <?= $title;?></h2>

</div>
<div class="box-content">
<form method="post" action="<?=base_url();?>users/subscribed">
<div class="row">
<div class="col-md-2">Course Type:
<select id="class" name="class" class="form-control" style="cursor:pointer;" >
<option value='-1'>Please Select </option>

    <?php foreach($level as $list):?>
        <option value="<?=$list->level_id;?>"><?=$list->name;?></option>
    <?php endforeach; ?>
    </select>
</div>
<div class="col-md-2">Level:
<select id="classid" name="classid" class="form-control" style="cursor:pointer;">
<option value='-1'>Please Select </option>
</select>	
</div>
<div class="col-md-2">Subject:
<select id="subjectid" name="subjectid" class="form-control" style="cursor:pointer;">
<option value='-1'>Please Select </option>
</select>	
</div>
<div class="col-md-2" style="    margin-top: 18px;">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>
<br>

<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="dataTable" data-filename="expenses" data-cols="[0,1,2,3,4,5,6,7]">
<thead>
<tr>
<th class="my-th">S.N.</th>
<th class="my-th">Student Name</th>
<th class="my-th">Course Type</th>
<th class="my-th">Level</th>
<th class="my-th">Subject</th>
<th class="my-th">Feepackage</th>
<th class="my-th">Coupon</th>
<th class="my-th">Paid Date</th>
<th class="my-th">Remarks</th>


</tr>
</thead>
<tbody>
<?php $sn=0; foreach($slist as $key): $sn++; ?>
<tr>
<td><?= $sn ; ?></td>
<td><?= @$key->fullname.'<br/>Phone: '.@$key->phone.'<br/>Email: '.@$key->email ; ?></td>
<td><?= @$key->levelname ; ?></td>
<td><?= @$key->classname ; ?></td>
<td><?= @$key->subject_name ; ?></td>
<td><?= @$key->feepackage.'<br/>Amount: Rs. '.number_format(@$key->paid_amount,2) ; ?></td>
<td><?= @$key->vouchercode.'<br/>Amount: Rs. '.number_format(@$key->discountamount,2) ; ?></td>
<td><?= @$key->paid_date ; ?></td>
<td><?= @$key->remarks ; ?></td>

</tr>
<?php endforeach ;?>


</tbody>
</table>
</div>
</div>
</div>
</div>

<script>
$("#class").on("change", function (e) {
			
			$.ajax({
				url: '<?= base_url(); ?>users/getclass',
				type: 'POST',
				data: {levelid: $(this).val()},
				success: function (response) {
					var response = jQuery.parseJSON(response);
					if (response.success == true) {
						$('#classid').empty();
						$('#classid').html(response.html);
					} else {
						$('#classid').empty();
						$('#classid').html(response.html);

						toastr.error(response.messages, {timeOut: 5000})
					}
				}

			});
              
        });
$("#classid").on("change", function (e) {
    
    $.ajax({
        url: '<?= base_url(); ?>chapter/getsubject',
        type: 'POST',
        data: {classid: $(this).val()},
        success: function (response) {
            var response = jQuery.parseJSON(response);
                $('#subjectid').empty();
                $('#subjectid').html(response.html);
        }

    });
        
});       
</script>
