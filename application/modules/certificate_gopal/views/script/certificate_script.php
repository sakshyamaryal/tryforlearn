<script>

function load()
{ 
    let url="";
    let id=$('#id').val();
    let cname=$('#cname').val();
    let issue=$('#issue').val();
    let text=$('#text').val();
    let background=$('#background').val();
    let footer1=$('#footer1').val();
    let footer2=$('#footer2').val();
    let footer3=$('#footer3').val();
    let footer4=$('#footer4').val();
    

 
 if(cname=="" || issue=="" || text=="" || background=="" || footer1 =="" || footer2 =="" || footer3 =="" || footer4 =="" )
 {
     alert("Please Input All Fields");


 }else
 {
     if(id!="")
     {
         url="<?php echo base_url() ?>certificate/certificate_update/"+id;
     }else{
       url= "<?php echo base_url('certificate/certificate_save') ?>";
     }
        $.ajax({
        type: 'post',                      
        url: url,
        data:{cname:cname,issue:issue, text:text, background:background, footer1:footer1, footer2:footer2, footer3:footer3, footer4:footer4 },
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
    // let checked="";
    url = "<?php echo base_url('certificate/getcertificatebyId') ?>";
    $.ajax({
         type: 'post',
                               
        url: url,
        data:{id:val},
        beforeSend: function () {
             $('#loader').show();
         },
                               

        success: function (response) {
            var res = jQuery.parseJSON(response);
            // let status="";
            let html_op="";
            if(res.status==true)
            { 	$('#id').val(res.data.CE_ID);
                 $('#cname').val(res.data.Certificate_Name);
                 $('#text').val(res.data.Certificate_Text);
                 $('#issue').val(res.data.Date_of_issue);
                 $('#background').val(res.data.Background);
                 $('#footer1').val(res.data.Footer1);
                 $('#footer2').val(res.data.Footer2);
                 $('#footer3').val(res.data.Footer3);
                 $('#footer4').val(res.data.Footer4);

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
    $('#cname').val("");
    $('#text').val("");
    $('#issue').val("");
    $('#background').val("");
    $('#footer1').val("");
    $('#footer2').val("");
    $('#footer3').val("");
    $('#footer4').val("");

    $('#label').text("Add");
    $('#btnsubmit').show();
    $('#btnupdate').attr("style","display:none;");
    $('#bmodal').modal('hide');
                                        
}

function delete_form(val)
{ 
    url = "<?php echo base_url('certificate/delete_certificate') ?>";
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