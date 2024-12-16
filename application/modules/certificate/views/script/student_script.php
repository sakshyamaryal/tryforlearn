<script>

function load()
{ 
    let url="";
    let name=$('#name').val();
    let org=$('#org').val();
    let title=$('#title').val();
    let doc=$('#doc').val();
    let phone=$('#phone').val();
    let email=$('#email').val();
    let status=$('#status').val();
    let citizen=$('#citizen').val();
    let id=$('#id').val();
    let cid=$('#certificateid').val();

 
 if(name=="" || org=="" || phone=="" || email=="" || status =="" || citizen=="" || title =="" || doc==""  || cid=="" || cid=="-1")
 {
     alert("Please Input All Fields");


 }else
 {
     if(id!="")
     {
         url="<?php echo base_url() ?>certificate/student_update/"+id;
     }else{
       url= "<?php echo base_url('certificate/student_save') ?>";
     }
        $.ajax({
        type: 'post',                      
        url: url,
        data:{name:name,org:org,phone:phone,email:email,status:status,citizen:citizen,title:title, doc:doc,cid:cid},
        beforeSend: function () {
             $('#loader').show();
        },
                               
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status==true)
            { 	
                location.reload();
            }
            $('#loader').hide();                    
        }
    });
 }
}

function edit_form(val)
{
    let html="";
    let checked="";
    url = "<?php echo base_url('certificate/getstudentbyId') ?>";
    $.ajax({
         type: 'post',
                               
        url: url,
        data:{id:val},
        beforeSend: function () {
             $('#loader').show();
         },
                               

        success: function (response) {
            var res = jQuery.parseJSON(response);
            let status="";
            let html_op="";
            if(res.status==true)
            { 	$('#id').val(res.data.SC_ID);
                 $('#name').val(res.data.Name);
                 $('#org').val(res.data.Organization);
                 $('#title').val(res.data.Title);
                 $('#doc').val(res.data.Document_Number);
                 $('#phone').val(res.data.Phone);
                 $('#email').val(res.data.Email);
                 $('#citizen').val(res.data.Citizenship);
                 $('#certificateid').val(res.data.certificateid)
                 // $('#pmodule').html("");
                 $('#status').html("");
                
                 // $.each(res.students, function(index, value) {
                                           
                 //    if(value.SC_ID==res.data.parent_module){
                 //         checked="selected";}
                 //    else{checked=""; }

                                            
                    // if(res.data.parent_module=='0')
                    // {

                    //      html += '<option value="'+value.module_id+'">'+value.module_name+'</option>';


                    // }else{
                    //  html += '<option value="'+value.module_id+'" '+checked+'>'+value.module_name+'</option>';
                    //  }
                                              
                                          
                 // });
                 if(res.data.Status=='1')
                    {
                        status += '<option value="1" selected>Active</option>';

                        status += '<option value="0">Inactive</option>';


                    }else{
                        status += '<option value="1" >Active</option>';

                            status += '<option value="0" selected>Inactive</option>';
                    }

                 $('#pmodule').append(html_op,html);
                $('#status').append(status);
                 $('#label').text("Edit");

                $('#btnsubmit').hide();
                $('#btnupdate').attr("style","display");
                $('#bmodal').modal('toggle');
                $('#bmodal').modal('show');



             }
            $('#loader').hide();
                                
             }
    });

}

function clear_ever()
{
    $('#id').val("");
    $('#name').val("");
    $('#phone').val("");
    $('#title').val("");
    $('#doc').val("");
    $('#email').val("");
    $('#org').val("");
    $('#citizen').val("");
    $('#label').text("Add");
    $('#btnsubmit').show();
    $('#btnupdate').attr("style","display:none;");
    $('#bmodal').modal('hide');
                                        
}

function delete_form(val)
{ 
    url = "<?php echo base_url('certificate/delete_student') ?>";
    $.ajax({
         type: 'post',
                               
        url: url,
        data:{id:val},
         beforeSend: function () {
            $('#loader').show();
         },
                               

        success: function (response) {
             var res = jQuery.parseJSON(response);

            if(res.status==true)
            { 
                  location.reload();

             }
             $('#loader').hide();


          }
    });

}
</script>