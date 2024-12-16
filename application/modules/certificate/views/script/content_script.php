<script>
getdata();

    CKEDITOR.editorConfig = function (config) {
                                    config.language = 'es';
                                    config.uiColor = '#F7B42C';
                                    config.height = 300;
                                    config.toolbarCanCollapse = true;

                                };

function CKupdate() {

    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].destroy();

        //  CKEDITOR.instances[instance].updateElement();
        //  CKEDITOR.instances[instance].setData('');
    }
}
$('#btnshowform').click(function(e){
    
     $('#name').val('');
      $('#certificateid').val('0');
      CKupdate();
   
     $('#ccontent').val('');
     CKEDITOR.replace('ccontent' ,{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
    $('#footer1').val('');
    CKEDITOR.replace('footer1',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
    $('#footer2').val('');
    CKEDITOR.replace('footer2',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
    $('#footer3').val('');
    CKEDITOR.replace('footer3',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
    $('#footer4').val('');
    CKEDITOR.replace('footer4',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});

     $('.modal-title').html('Add Certificate');

    $('#chaptermodal').modal('show');

});
$('.modalhide').click(function(){
   $('#chaptermodal').modal('hide');

});
function getdata()
{
    $.ajax({
                     url: '<?= base_url(); ?>certificate/getcontentdata',
                     type: 'POST',
                     data: {},
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
}

 
function submitcontent()
{
    for (instance in CKEDITOR.instances)
    CKEDITOR.instances[instance].updateElement();

var form_data = new FormData($('form')[0]);

    $.ajax({
                     url: '<?= base_url(); ?>certificate/save',
                     type: 'POST',
                     //dataType: 'json',
                    contentType: false,
                    processData: false,
                     data:form_data,
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                // $('#name').val('');
                                // $('#programdate').val('');
                                // $('#course').val('');
                                $('form')[0].reset;
                              
                                CKupdate();
                          
                                $('#ccontent').val('');
                                CKEDITOR.replace('ccontent',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
                                $('#footer1').val('');
                                CKEDITOR.replace('footer1',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
                                $('#footer2').val('');
                                CKEDITOR.replace('footer2',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
                                $('#footer3').val('');
                                CKEDITOR.replace('footer3',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
                                $('#footer4').val('');
                                CKEDITOR.replace('footer4',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
                                
                                toastr.success(response.message, {timeOut: 5000})
                                  getdata();
								
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });
}
function getedit(chid)
{
    $.ajax({
                     url: '<?= base_url(); ?>certificate/getbyid',
                     type: 'POST',
                     data: {certificate:chid},
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('.modal-title').html('Edit Content');
                                $('#name').val(response.content.name);
                                $('#title').val(response.content.title);
                                $('#programdate').val(response.content.programdate);
                                $('#course').val(response.content.course);

                                $('#certificateid').val(response.content.certificateid);
                                CKupdate();
                                $('#ccontent').val(response.content.content);
                                CKEDITOR.replace('ccontent',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
                                $('#footer1').val(response.content.footer1);
                                CKEDITOR.replace('footer1',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
                                $('#footer2').val(response.content.footer2);
                                CKEDITOR.replace('footer2',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
                                $('#footer3').val(response.content.footer3);
                                CKEDITOR.replace('footer3',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});
                                $('#footer4').val(response.content.footer4);
                                CKEDITOR.replace('footer4',{
							filebrowserUploadUrl: '<?=base_url();?>certificate/ck_upload',
							filebrowserUploadMethod: 'form'
						});


                                $('#chaptermodal').modal('show');

                               
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });

}
function delcertificate(chid)
{
    $.ajax({
                     url: '<?= base_url(); ?>certificate/delete',
                     type: 'POST',
                     data: {certificate:chid},
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                $('#ch'+chid).remove();
                                toastr.success(response.message, {timeOut: 5000})

                               
							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });

}



</script>