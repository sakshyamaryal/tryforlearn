<script>
  $( "#level" ).change(function() {
    let levelid=$(this).val();
                    $.ajax({
						url: '<?= base_url(); ?>permission/getclass/',
						type: 'POST',
                        data: {levelid:levelid},
                        beforeSend: function () {
                                    $('#loader').show();
                                },
						success: function (res) {
                            $('#loader').hide();
						let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#class').empty();
                                $('#class').html(response.html);
                               
								
							} else {
                                $('#class').empty();
								//toastr.error(response.message, {timeOut: 5000})
							}
						}

					});

});
$( "#class" ).change(function() {
    let classid=$('#class').val();
                    $.ajax({
						url: '<?= base_url(); ?>chapter/getsubject/',
						type: 'POST',
                        data: {classid:classid},
                        beforeSend: function () {
                                    $('#loader').show();
                                },
						success: function (res) {
                            $('#loader').hide();
						let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#subject').empty();
                                $('#subject').html(response.html);
                               
                                 
								
							} else {
                                $('#subject').empty();
								//toastr.error(response.message, {timeOut: 5000})
							}
						}

					});

});

$( "#cogsform" ).submit(function( event ) {
     
     event.preventDefault();
    
                  $.ajax({
                     url: '<?= base_url(); ?>permission/getchapterdata',
                     type: 'POST',
                     data: $( "#cogsform" ).serialize(),
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#tbl').empty();
                                $('#tbl').html(response.html);
                               
                                
								
							} else {
                                $('#tbl').empty();
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });

     });
     function set_permission(userid,subjectid,chapterid)
{
    let mode="";
    if($('#check'+userid+subjectid+chapterid).prop('checked')==true)
    {
        mode="insert";
       
    }else{
        mode="delete";
        }
        $.ajax({
                                type: 'post',
                               
                                url: '<?php echo base_url();?>permission/change_chapterpermission',
                                data:{userid,subjectid,chapterid,mode},
                                beforeSend: function () {
                                    $('#loader').show();
                                },
                               

                                success: function (response) {
                                    console.log(response);
                                    var res = jQuery.parseJSON(response);

                                    if(res.status==true)
                                    { 	

                                    //alert("success");
                                      }
                                 $('#loader').hide();
                                
                                    }
                            });
}
</script>