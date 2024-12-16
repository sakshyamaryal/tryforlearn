<script>
$('#btnshowform').click(function(e){
     let classid=$('#class').val();
     let subject=$('#subject').val();
     if(parseInt(classid)<'1' && parseInt(subject)<'1')
     {
        toastr.error('Please Select Class and Subject', {timeOut: 5000});
        return false;

     }
     $('#chaptername').val('');
      $('#chapterid').val('0');
     $('.modal-title').html('Add Chapter');

    $('#chaptermodal').modal('show');

});
$('.modalhide').click(function(){
   $('#chaptermodal').modal('hide');
});
$( "#cogsform" ).submit(function( event ) {
     
     event.preventDefault();
    
                  $.ajax({
                     url: '<?= base_url(); ?>chapter/getchapterdata',
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
function submitchapter()
{
    $.ajax({
                     url: '<?= base_url(); ?>chapter/save',
                     type: 'POST',
                     data: $( "#addform" ).serialize()+'&'+$( "#cogsform" ).serialize(),
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#chaptername').val('');
                            $('#priority').val('');

                                // if($('#chapterid').val()!='0')
                                // {
                                // toastr.success(response.message+'<br/>Please Click View to Refresh', {timeOut: 5000})

                                // }
                                // else
                                // {
                                //     toastr.success(response.message, {timeOut: 5000})

                                // }
                                toastr.success(response.message, {timeOut: 5000})
                                $('#btnsubmit').trigger('click');

                               
                                
								
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });
}
function getedit(chid)
{
    $.ajax({
                     url: '<?= base_url(); ?>chapter/getbyid',
                     type: 'POST',
                     data: {chapter:chid},
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('.modal-title').html('Edit Chapter');
                                $('#chaptername').val(response.chapter.chaptername);
                                $('#chapterid').val(response.chapter.chapterid);
                                 $('#priority').val(response.chapter.priority);

                                $('#chaptermodal').modal('show');

                               
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });

}
function delchapter(chid)
{
    toastr.options = {
          "positionClass" : "toast-top-center",
          "closeButton" : false,
          "newestOnTop" : false,
          "showDuration" : "300",
          "hideDuration" : "1000",
          "timeOut" : "5000",
          "extendedTimeOut" : "1000",
          "showEasing" : "swing",
          "hideEasing" : "linear",
          "showMethod" : "fadeIn",
          "hideMethod" : "fadeOut"
         }
   Command: toastr["warning"]
           ("Are you Sure You want to Delete this?<br /><br />"+
           "<button type='button' class='btn btn-danger' onclick='delthis("+chid+")'>Yes</button>&nbsp;&nbsp;"+
           "<button type='button' class='btn btn-default'>No</button>")

}
function delthis(chid)
{
    $.ajax({
                     url: '<?= base_url(); ?>chapter/delete',
                     type: 'POST',
                     data: {chapter:chid},
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                               // $('#ch'+chid).remove();
                                toastr.success(response.message, {timeOut: 5000})
                                $('#btnsubmit').trigger('click');
                               
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });
}
</script>