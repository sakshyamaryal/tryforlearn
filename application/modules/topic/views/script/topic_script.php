<script>
$('#btnshowform').click(function(e){
     let classid=$('#class').val();
     let subject=$('#subject').val();
     let chapter=$('#chapter').val();
     if(parseInt(classid)<'1' && parseInt(subject)<'1' && parseInt(chapter)<'1')
     {
        toastr.error('Please Select Class, Subject and Chapter', {timeOut: 5000});
        return false;

     }
     $('#topicname').val('');
      $('#topicid').val('0');
     $('.modal-title').html('Add Topic');

    $('#chaptermodal').modal('show');

});
$('.modalhide').click(function(){
   $('#chaptermodal').modal('hide');
});
$( "#cogsform" ).submit(function( event ) {
     
     event.preventDefault();
    
                  $.ajax({
                     url: '<?= base_url(); ?>topic/gettopicdata',
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
$( "#subject" ).change(function() {
    let classid=$('#class').val();
    let subjectid=$('#subject').val();
                    $.ajax({
						url: '<?= base_url(); ?>topic/getsubjectchapter/',
						type: 'POST',
                        data: {classid,subjectid},
                        beforeSend: function () {
                                    $('#loader').show();
                                },
						success: function (res) {
                            $('#loader').hide();
						let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#chapter').empty();
                                $('#chapter').html(response.html);
                               
                                 
								
							} else {
                                $('#chapter').empty();
								//toastr.error(response.message, {timeOut: 5000})
							}
						}

					});

});
function submittopic()
{
    $.ajax({
                     url: '<?= base_url(); ?>topic/save',
                     type: 'POST',
                     data: $( "#addform" ).serialize()+'&'+$( "#cogsform" ).serialize(),
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#topicname').val('');
                               $('#priority').val('');

                                // if($('#topicid').val()!='0')
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
                     url: '<?= base_url(); ?>topic/getbyid',
                     type: 'POST',
                     data: {topic:chid},
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('.modal-title').html('Edit Topic');
                                $('#topicname').val(response.topic.topicname);
                                $('#topicid').val(response.topic.topicid);
                            $('#priority').val(response.topic.priority);

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
                     url: '<?= base_url(); ?>topic/delete',
                     type: 'POST',
                     data: {topic:chid},
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                //$('#ch'+chid).remove();
                                toastr.success(response.message, {timeOut: 5000})
                                $('#btnsubmit').trigger('click');
                               
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });
}
</script>