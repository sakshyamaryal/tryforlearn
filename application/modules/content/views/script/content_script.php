<script>
$('#videorow').hide();

$('#filerow').hide();

                                CKEDITOR.editorConfig = function (config) {
                                    config.language = 'es';
                                    config.uiColor = '#F7B42C';
                                    config.height = 300;
                                    config.toolbarCanCollapse = true;
                                    config.autoGrow_onStartup=true;
                                    config.enterMode=CKEDITOR.ENTER_BR;
                                   config.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';
                                  




                                };
function CKupdate() {
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
        CKEDITOR.instances[instance].setData('');
    }
}
$('#btnshowform').click(function(e){
     let classid=$('#class').val();
     let subject=$('#subject').val();
     let chapter=$('#chapter').val();
     let topic=$('#topic').val();
     if(parseInt(classid)<'1' && parseInt(subject)<'1' && parseInt(chapter)<'1' && parseInt(topic)<'1')
     {
        toastr.error('Please Select Class, Subject , Chapter and Topic', {timeOut: 5000});
        return false;

     }
     $('#title').val('');
      $('#contentid').val('0');
      CKupdate();
      if (CKEDITOR) {
    if (CKEDITOR.instances['description']) {
        CKEDITOR.instances['description'].destroy();
        }
         if (CKEDITOR.instances['descriptionnep']) {
        CKEDITOR.instances['descriptionnep'].destroy();
        }
    }
    $('#description').val('');
        $('#descriptionnep').val('');


      CKEDITOR.replace('description' ,{
							filebrowserUploadUrl: '<?=base_url();?>content/ck_upload',
							filebrowserUploadMethod: 'form',
                            fullPage: true,
    allowedContent: true,
    autoGrow_onStartup: true,
    enterMode: CKEDITOR.ENTER_BR
						});
						      CKEDITOR.replace('descriptionnep',{
							filebrowserUploadUrl: '<?=base_url();?>content/ck_upload',
							filebrowserUploadMethod: 'form',
                            fullPage: true,
    allowedContent: true,
    autoGrow_onStartup: true,
    enterMode: CKEDITOR.ENTER_BR
						});

     $('.modal-title').html('Add Content');

    $('#chaptermodal').modal('show');

});
$('.modalhide').click(function(){
   $('#chaptermodal').modal('hide');
   $('#filemodal').modal('hide');
   $('#viewfilemodal').modal('hide');
});
$( "#cogsform" ).submit(function( event ) {
     
     event.preventDefault();
    
                  $.ajax({
                     url: '<?= base_url(); ?>content/getcontentdata',
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
$( "#chapter" ).change(function() {
    let classid=$('#class').val();
    let subjectid=$('#subject').val();
    let chapterid=$('#chapter').val();
                    $.ajax({
						url: '<?= base_url(); ?>content/gettopic/',
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
function submitcontent()
{
        for (instance in CKEDITOR.instances)
    CKEDITOR.instances[instance].updateElement();
   

    $.ajax({
                     url: '<?= base_url(); ?>content/save',
                     type: 'POST',
                     data: $( "#addform" ).serialize()+'&'+$( "#cogsform" ).serialize(),
                     //+'&description='+$('#description').html()
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#title').val('');
                                $('#titlenep').val('');
                                $('#type').val('default');

                                $('#orderby').val('1');
                                // if($('#contentid').val()!='0')
                                // {
                                // toastr.success(response.message+'<br/>Please Click View to Refresh', {timeOut: 5000})

                                // }
                                // else
                                // {
                                //     toastr.success(response.message, {timeOut: 5000})

                                // }
                                       CKupdate();
                            if (CKEDITOR) {
                            if (CKEDITOR.instances['description']) {
                                CKEDITOR.instances['description'].destroy();
                                }
                                if (CKEDITOR.instances['descriptionnep']) {
                                CKEDITOR.instances['descriptionnep'].destroy();
                                }
                            }
                            $('#description').val('');
                            $('#descriptionnep').val('');

                            CKEDITOR.replace('description',{
							filebrowserUploadUrl: '<?=base_url();?>content/ck_upload',
							filebrowserUploadMethod: 'form',
							fullPage: true,
    allowedContent: true,
    autoGrow_onStartup: true,
    enterMode: CKEDITOR.ENTER_BR
						});
                            CKEDITOR.replace('descriptionnep',{
							filebrowserUploadUrl: '<?=base_url();?>content/ck_upload',
							filebrowserUploadMethod: 'form',
							fullPage: true,
    allowedContent: true,
    autoGrow_onStartup: true,
    enterMode: CKEDITOR.ENTER_BR
						});
                                
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
                     url: '<?= base_url(); ?>content/getbyid',
                     type: 'POST',
                     data: {content:chid},
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
							    $('#chaptermodal').modal('show');

                                $('.modal-title').html('Edit Content');
                                $('#title').val(response.content.title);
                                $('#titlenep').val(response.content.title_nep);
                                $('#type').val(response.content.type);
                                $('#appletin').val(response.content.appletin);
                                $('#orderby').val(response.content.orderby);
                                $('#contentid').val(response.content.contentid);
                             
                                if (CKEDITOR) {
                            if (CKEDITOR.instances['description']) {
                                CKEDITOR.instances['description'].destroy();
                                }
                                if (CKEDITOR.instances['descriptionnep']) {
                                CKEDITOR.instances['descriptionnep'].destroy();
                                }
                            }


                                // $('#testdata').html(response.content.detail);
                                //  $('#descriptionnep').val(response.content.detail_nep);

                           // console.log(response.content.detail)
                            
                                CKEDITOR.replace('description',{
							filebrowserUploadUrl: '<?=base_url();?>content/ck_upload',
							filebrowserUploadMethod: 'form',
							fullPage: true,
    allowedContent: true,
    autoGrow_onStartup: true,
    enterMode: CKEDITOR.ENTER_BR
						});
                                CKEDITOR.replace('descriptionnep',{
							filebrowserUploadUrl: '<?=base_url();?>content/ck_upload',
							filebrowserUploadMethod: 'form',
							
							fullPage: true,
    allowedContent: true,
    autoGrow_onStartup: true,
    enterMode: CKEDITOR.ENTER_BR
						});
				// 		$("#testdata").html(response.content.detail);
				// 		console.log(response.content.deta)
						  CKEDITOR.instances['description'].setData(response.content.detail);
						  CKEDITOR.instances['descriptionnep'].setData(response.content.detail_nep);

                                // $('#chaptermodal').modal('show');

                               
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
                     url: '<?= base_url(); ?>content/delete',
                     type: 'POST',
                     data: {content:chid},
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                              //  $('#ch'+chid).remove();
                                toastr.success(response.message, {timeOut: 5000})

                                $('#btnsubmit').trigger('click');
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });
}
function addfile(id)
{
    $('#filecontentid').val(id);
    $('#filemodal').modal('show');

}
function change_type(val)
{
    if(val=='1')
    {
        $('#videorow').hide();

        $('#filerow').show();
    }
    else
    {
        $('#filerow').hide();

        $('#videorow').show();

    }
}
function submitfile()
{
    var radioValue = $("input[name='fradio']:checked").val();
   let contentid= $('#filecontentid').val();
   let title= $('#filetitle').val();
   let orderby= $('#fileorderby').val();
   var link='';
   var onlyForApp = $('#onlyForApp').is(':checked') ? 'Y': 'N';

     var file ='';
    if(radioValue=='video')
    {
         link=$('#link').val();

        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
         var match = link.match(regExp);
         
         if (match && match[2].length == 11) {
            var newembedded= match[2];
            link='https://www.youtube.com/embed/'+newembedded;

         }
         else{
            toastr.error('Video URL Not supported', {timeOut: 5000})

             return false;
         }
    }else
    {
         file = $('#file');
        var fileupload = file[0].files[0];
       
    }
            var formData = new FormData();

        formData.append('file', (file=='') ? '' : fileupload);
        formData.append('contentid', contentid);
        formData.append('title', title);
        formData.append('orderby', orderby);
        formData.append('filetype', radioValue);
        formData.append('link', link);
        formData.append('onlyForApp', onlyForApp);
        $.ajax({
                     url: '<?= base_url(); ?>content/addfile',
                     type: 'POST',
                     dataType: 'json',
                    contentType: false,
                    processData: false,
                     data: formData,
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (response) {
                        $('#loader').hide();
                        $("#addfileform")[0].reset();
                       
                        //console.log(response);
							if (response.type == 'success') {
                                
                                toastr.success(response.message, {timeOut: 5000})

                               
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });

}
function viewcontent(id)
{
    $.ajax({
                     url: '<?= base_url(); ?>content/viewfile',
                     type: 'POST',
                     data: {content:id},
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#viewfilebody').empty();
                                $('#viewfilebody').html(response.html);
                                $('.inlineeditqn').hide();
                                $('.savebtn').hide();

                                $('#viewfilemodal').modal('show');
                               
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });
}
function delfile(chid)
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
           "<button type='button' class='btn btn-danger' onclick='deletecfile("+chid+")'>Yes</button>&nbsp;&nbsp;"+
           "<button type='button' class='btn btn-default'>No</button>")

}
function deletecfile(chid)
{
    $.ajax({
                     url: '<?= base_url(); ?>content/deletefile',
                     type: 'POST',
                     data: {fileid:chid},
                     beforeSend: function () {
                        $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#filelist'+chid).remove();
                                toastr.success(response.message, {timeOut: 5000})

                               
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });
}
function editfile(id)
{
    $('.fileqn'+id).hide();

    $('.inlineeditqn'+id).show();
    $('.editbtn'+id).hide();

$('.savebtn'+id).show();
}
function updatefile(id)
{
    let title=$('#filetitle'+id).val();
    let orderby=$('#fileorderby'+id).val();
    let onlyForApp=$('#onlyForAppUp'+id).is(':checked') ? 'Y' : 'N';
    $.ajax({
                     url: '<?= base_url(); ?>content/updatefile',
                     type: 'POST',
                     data: {id,title,orderby,onlyForApp},
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

function getpreview(id)
{
   var type= $('#fileview'+id).data('type');
   var src= $('#fileview'+id).attr('data');
   console.log(src);
   var title=$('.fileqn'+id).html();
   $('#myModalLabel').text(title);
   if(type=='file')
    {
        $('#mypreviewbody').html('<iframe id="mydocxiframe" style="width:100%;height:400px;" src="https://docs.google.com/viewer?url='+src+'&embedded=true" frameborder="0"></iframe>');
		$('#mydocxiframe').on('load', () => {
			$('.waittime').hide();
        });
       

    }else if(type=='video')
    {
        $('.waittime').hide();

        
        $('#mypreviewbody').html('<iframe width="750" height="450" src="'+src+'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
        
    }
    $('#preview-modal').modal('show');
}


</script>