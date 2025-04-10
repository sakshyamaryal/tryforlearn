<script>
$('#btnshowform').click(function(e){
     let classid=$('#class_rojesh').val();
     let subject=$('#subject').val();
     let chapter=$('#chapter').val();
     let topic=$('#topic').val();
     let group=$('#group').val();
     let examtype=$('#examtypeid').val();
     console.log(examtype);
     if(parseInt(classid)<'1' && parseInt(subject)<'1' && parseInt(chapter)<'1' && parseInt(group)<'1')
     {
        toastr.error('Please Select All Field', {timeOut: 5000});
        return false;

     }
     var link='<?=base_url();?>exercise/addnew/'+classid+'/'+subject+'/'+chapter+'/'+group+'/'+examtype+'/'+topic;

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
   $('#replicatemodal').modal('hide');
   $('#datasetmodal').modal('hide');
   
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

     $( "#class_rojesh" ).change(function() {
    let classid=$('#class_rojesh').val();
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
    let classid=$('#class_rojesh').val();
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

$(document).on('click','#btnreplicate',function(e)
{
  
    var count=0;
    $("input[name='replicateques[]']:checked").each(function ()
        {
            count ++;
        });
     if(count<1)
     {
        toastr.error('Select Atleast One Question', {timeOut: 5000});
        return false;

     }  

     $('#replicatemodal').modal('show');
    
})

$(document).on('change','#coursetype',function(e){
    let coursetype=$('#coursetype').val();
    if(coursetype=='-1')
    {
        $('#replicateclass').empty();
        $('#replicatesubject').empty();
        $('#replicatechapter').empty();
        $('#replicatetopic').empty();
    }
    else if(coursetype=='4' || coursetype=='5')
    {
        $('.replicateclass').hide();
        $('.replicatesubject').hide();
        $('.replicatechapter').show();
        $('.replicatetopic').show();

        $.ajax({
						url: '<?= base_url(); ?>exercise/getchapterdropdown/',
						type: 'POST',
                        data: {coursetype},
                        beforeSend: function () {
                                    $('#loader').show();
                                },
						success: function (res) {
                            $('#loader').hide();
						let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#replicatchapter').empty();
                                $('#replicatechapter').html(response.html);
                               
                                 
								
							} else {
                                $('#replicatechapter').empty();
								//toastr.error(response.message, {timeOut: 5000})
							}
						}

					});

    }
    else
    {
        $('.replicateclass').show();
        $('.replicatesubject').show();
        $('.replicatechapter').hide();
        $('.replicatetopic').hide();
        $.ajax({
                     url: '<?= base_url(); ?>exercise/getclassdropdown',
                     type: 'POST',
                     data: {coursetype},
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#replicateclass').empty();
                                $('#replicateclass').html(response.html);
                               

                               
							} else {
								//toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });

    }
})

$(document).on('change','#replicateclass',function(e){
    let classid=$(this).val();
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
                                $('#replicatesubject').empty();
                                $('#replicatesubject').html(response.html);
                               
                                 
								
							} else {
                                $('#replicatesubject').empty();
								//toastr.error(response.message, {timeOut: 5000})
							}
						}

					});

    
})


$(document).on('change','#replicatesubject',function(e){
    let qtype=$('#qtype').val();
    if(qtype=='N')
    {
        $('.replicatechapter').hide();

    }
    else
    {
        $('.replicatechapter').show();

        let classid=$('#replicateclass').val();
    let subjectid=$('#replicatesubject').val();
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
                                $('#replicatchapter').empty();
                                $('#replicatechapter').html(response.html);
                               
                                 
								
							} else {
                                $('#replicatechapter').empty();
								//toastr.error(response.message, {timeOut: 5000})
							}
						}

					});
    
    }

    
})


$(document).on('change','#replicatechapter',function(e){
    let qtype=$('#qtype').val();
    if(qtype=='N')
    {
        $('.replicatetopic').hide();

    }
    else
    {
        $('.replicatetopic').show();

        let classid=$('#replicateclass').val();
    let subjectid=$('#replicatesubject').val();
    let chapterid=$(this).val();
                    $.ajax({
						url: '<?= base_url(); ?>exercise/gettopicdropdown/',
						type: 'POST',
                        data: {classid,subjectid,chapterid},
                        beforeSend: function () {
                                    $('#loader').show();
                                },
						success: function (res) {
                            $('#loader').hide();
						let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#replicatetopic').empty();
                                $('#replicatetopic').html(response.html);
                               
                                 
								
							} else {
                                $('#replicatetopic').empty();
								//toastr.error(response.message, {timeOut: 5000})
							}
						}

					});
    
    }

    
})

function replicatequestion()
{
    let levelid=$('#coursetype').val();
    let classid=$('#replicateclass').val();
    let subjectid=$('#replicatesubject').val();
    let chapterid=$('#replicatechapter').val();
    let topicid=$('#replicatetopic').val();
    let examtype=$('#replicateexamtype').val();
    let groupid=$('#replicategroup').val();
    let replicatedate=$('#replicatedate').val();

    var qid=[];
    var count=0;
    $("input[name='replicateques[]']:checked").each(function ()
        {
            count ++;
            qid.push($(this).val());
        });

        $.ajax({
						url: '<?= base_url(); ?>exercise/replicatequestions/',
						type: 'POST',
                        data: {levelid,classid,subjectid,chapterid,topicid,qid,examtype,groupid,replicatedate},
                        beforeSend: function () {
                                    $('#loader').show();
                                },
						success: function (res) {
                            $('#loader').hide();
						let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                toastr.success(response.message, {timeOut: 5000})
                                $('#replicatemodal').modal('hide');
								
							} else {
								toastr.error(response.message, {timeOut: 5000})
							}
						}

					});
}

$( "#chapter" ).change(function() {
    let classid=$('#class_rojesh').val();
    let subjectid=$('#subject').val();
    let chapterid=$('#chapter').val();
                    $.ajax({
						url: '<?= base_url(); ?>exercise/gettopicdropdown/',
						type: 'POST',
                        data: {classid,subjectid,chapterid},
                        beforeSend: function () {
                                    $('#loader').show();
                                },
						success: function (res) {
                            $('#loader').hide();
						let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#topic').empty();
                                $('#topic').html(response.html);
                               
                                 
								
							} else {
                                $('#topic').empty();
								//toastr.error(response.message, {timeOut: 5000})
							}
						}

					});

});

$(document).on('click','#btnmigrate',function(e){
    e.preventDefault;
    let topicid=$('#topic').val();
    let migrategroup=$('#migrategroup').val();

var qid=[];
var count=0;
$("input[name='replicateques[]']:checked").each(function ()
    {
        count ++;
        qid.push($(this).val());
    });

    $.ajax({
                    url: '<?= base_url(); ?>exercise/migrateques/',
                    type: 'POST',
                    data: {qid,topicid,migrategroup},
                    beforeSend: function () {
                                $('#loader').show();
                            },
                    success: function (res) {
                        $('#loader').hide();
                    let response=jQuery.parseJSON(res);
                        if (response.type == 'success') {
                            toastr.success(response.message, {timeOut: 5000});
                            $('#btnsubmit').trigger('click');

                            
                        } else {
                            toastr.error(response.message, {timeOut: 5000})
                        }
                    }

                });
})


// $(document).on('click','#btndataset',function(e)
// {
  
//     var count=0;
//     $("input[name='replicateques[]']:checked").each(function ()
//         {
//             count ++;
//         });
//      if(count<1)
//      {
//         toastr.error('Select Atleast One Question', {timeOut: 5000});
//         return false;

//      }  

//      $('#datasetmodal').modal('show');
    
// })

// Triggered when the 'Add in Datasets' button is clicked
$('#btndataset').on('click', function() {
    var class_id = $('#class_rojesh').val(); // Get the selected class_id

    // Check if class_id is valid
    if (class_id == '-1') {
        alert('Please select a class');
        return;
    }

    // Send an AJAX request to get the datasets based on the class_id
    $.ajax({
        url: '<?= base_url("exercise/get_filtered_datasets"); ?>', // Replace with your controller and method
        type: 'GET',
        data: { class_id: class_id },
        success: function(response) {
            console.log(response); // Log the response to verify its structure
            
            // Ensure the response is parsed into a proper JavaScript object (in case it's a string)
            if (typeof response === 'string') {
                try {
                    response = JSON.parse(response); // Manually parse if it's a string
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    return;
                }
            }

            // Clear the previous options in the select dropdown
            $('#dataset').empty();
            
            // Check if the response is an array of datasets
            if (Array.isArray(response) && response.length > 0) {
                // Loop through the datasets and populate the dropdown
                $.each(response, function(index, dataset) {
                    console.log(dataset);  // Log each dataset to verify its properties
                    
                    // Handle escaped characters in the 'guideline' field, if necessary
                    if (dataset.guideline && typeof dataset.guideline === 'string') {
                        dataset.guideline = dataset.guideline.replace(/\\"/g, '"'); // Remove escape characters
                    }
                    
                    // Create an option element for each dataset
                    var option = $('<option>', {
                        value: dataset.setid,  // Set the value as the setid
                        text: dataset.setname + ' (' + dataset.title + ')'  // Text to display in the dropdown
                    });
                    
                    // Append the option to the select dropdown
                    $('#dataset').append(option);
                });
            } else {
                // If no datasets are available, add a placeholder option
                $('#dataset').append('<option value="">No datasets available</option>');
            }
            
            // Show the modal
            $('#datasetmodal').modal('show');
        },

        error: function() {
            alert('Error fetching datasets');
        }
    });
});

function submitdatasetques()
{

    var dataset=$('#dataset').val();
    var qid=[];
    var count=0;
    $("input[name='replicateques[]']:checked").each(function ()
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
                     url: '<?= base_url(); ?>exercise/addindataset',
                     type: 'POST',
                     data: {dataset,qid},
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
</script>