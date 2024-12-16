<script>

function load()
{ 
    let url="";
    let cname=$('#cname').val();
    let tname=$('#tname').val();
    let start=$('#start').val();
    let end=$('#end').val();
    let time=$('#time').val();
    let id=$('#id').val();

 
 if(cname=="" || tname=="" || start=="" || end=="" || time =="" )
 {
     alert("Please Input All Fields");


 }else
 {
     if(id!="")
     {
         url="<?php echo base_url() ?>certificate/course_update/"+id;
     }else{
       url= "<?php echo base_url('certificate/course_save') ?>";
     }
        $.ajax({
        type: 'post',                      
        url: url,
        data:{cname:cname,tname:tname,start:start,end:end,time:time,},
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
    url = "<?php echo base_url('certificate/getcoursebyId') ?>";
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
            { 	$('#id').val(res.data.C_ID);
                 $('#cname').val(res.data.Name);
                 $('#tname').val(res.data.Teacher);
                 $('#start').val(res.data.Start);
                 $('#end').val(res.data.End);
                 $('#time').val(res.data.Duration);

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
    $('#tname').val("");
    $('#start').val("");
    $('#end').val("");
    $('#time').val("");
    $('#label').text("Add");
    $('#btnsubmit').show();
    $('#btnupdate').attr("style","display:none;");
    $('#bmodal').modal('hide');
                                        
}

function delete_form(val)
{ 
    url = "<?php echo base_url('certificate/delete_course') ?>";
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