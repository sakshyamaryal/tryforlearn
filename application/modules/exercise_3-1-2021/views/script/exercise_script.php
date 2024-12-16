<script>
$('#btnshowform').click(function(e){
     let classid=$('#class').val();
     let subject=$('#subject').val();
     let chapter=$('#chapter').val();
     let group=$('#group').val();
     let examtype=$('#examtypeid').val();
     console.log(examtype);
     if(parseInt(classid)<'1' && parseInt(subject)<'1' && parseInt(chapter)<'1' && parseInt(group)<'1')
     {
        toastr.error('Please Select All Field', {timeOut: 5000});
        return false;

     }
     var link='<?=base_url();?>exercise/addnew/'+classid+'/'+subject+'/'+chapter+'/'+group+'/'+examtype;

     window.open(link, '_blank');

});
function getchecked()
{
    $("input[type=checkbox]").prop('checked', true);
  
}
function trimques()
{
    $('#exammodal').modal('show');
}
$('.modalhide').click(function(){
   $('#exammodal').modal('hide');
   
});

function submitques()
{
    var etype=$('#examtype').val();
    var qdate=$('#qdate').val();
    var qid=[];
    var count=0;
    $("input[name='selected[]']:checked").each(function ()
        {
            count ++;
            qid.push($(this).val());
        });
     if(count<1)
     {
        toastr.error('Select Atleast One Question', {timeOut: 5000});
        return false;

     }  
     $.ajax({
                     url: '<?= base_url(); ?>exercise/copyquestion',
                     type: 'POST',
                     data: {etype,qid,qdate},
                     beforeSend: function () {
                         $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                toastr.success(response.message, {timeOut: 5000})

                               
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 }); 
}
$( "#cogsform" ).submit(function( event ) {
     
     event.preventDefault();
    
                  $.ajax({
                     url: '<?= base_url(); ?>exercise/getexercisedata',
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

function delexercise(chid)
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
                     url: '<?= base_url(); ?>exercise/delete',
                     type: 'POST',
                     data: {exercise:chid},
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