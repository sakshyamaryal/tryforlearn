<script>
function get_modules()
{
    let moduleid=$('#pmodule').val();
    if(moduleid=='-1')
    {
        return false;
    }else
    {
                          $.ajax({
                                type: 'post',
                               
                                url: '<?php echo base_url();?>certificate/printModules',
                                data:{id:moduleid},
                                beforeSend: function () {
                                    $('#loader').show();
                                },
                               

                                success: function (response) {
                                    console.log(response);
                                    var res = jQuery.parseJSON(response);

                                    if(res.status==true)
                                    { 	

                                        $('#tbody').html("");
                                        $('#tbody').append(res.html);
                                        



                                    }
                                 $('#loader').hide();
                                
                                    }
                            });
    }
}

function set_permission(module_id,usertype)
{
    let mode="";
    if($('#check'+module_id+usertype).prop('checked')==true)
    {
        mode="insert";
       
    }else{
        mode="delete";
        }
        $.ajax({
                                type: 'post',
                               
                                url: '<?php echo base_url();?>certificate/change_permission',
                                data:{moduleid:module_id,usertype:usertype,mode:mode},
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