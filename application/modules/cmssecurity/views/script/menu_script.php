<script>

function load()
{ 
    let url="";
    let name=$('#name').val();
    let pname=$('#pmodule').val();
    let fname=$('#fname').val();
    let ficon=$('#font').val();
    let bar=$('#bar').val();
    let order=$('#order').val();
    let id=$('#id').val();
    
 if(name=="" || pname=="" || fname=="" || ficon=="" || bar =="" || order=="" )
 {
     alert("Please Input All Fields");


 }else
 {
     if(id!="")
     {
         url="<?php echo base_url() ?>cmssecurity/menu_update/"+id;
     }else{
       url= "<?php echo base_url('cmssecurity/menu_save') ?>";
     }

 
                       
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{name:name,pname:pname,fname:fname,ficon:ficon,bar:bar,order:order},
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
    url = "<?php echo base_url('cmssecurity/getmenubyId') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{id:val},
                                beforeSend: function () {
                                    $('#loader').show();
                                },
                               

                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    let bar="";
                                    let html_op="";
                                    if(res.status==true)
                                    { 	$('#id').val(res.data.module_id);
                                        $('#name').val(res.data.module_name);
                                        $('#fname').val(res.data.controller_fname);
                                        $('#font').val(res.data.fonticon);
                                        $('#order').val(res.data.display_order);
                                        $('#pmodule').html("");
                                        $('#bar').html("");
                                        if(res.data.parent_module=='0')
                                            {
                                                html_op += '<option value="0" selected>-----------</option>';



                                            }
                                        $.each(res.menu_modules, function(index, value) {
                                           
                                            if(value.module_id==res.data.parent_module){
                                                checked="selected";}
                                                else{checked="";
                                                }

                                            
                                            if(res.data.parent_module=='0')
                                            {

                                                html += '<option value="'+value.module_id+'">'+value.module_name+'</option>';


                                            }else{
                                            html += '<option value="'+value.module_id+'" '+checked+'>'+value.module_name+'</option>';
                                            }
                                              
                                          
                                        });
                                        if(res.data.bar_type=='1')
                                            {
                                                bar += '<option value="1" selected>Side Bar for Admin</option>';

                                                bar += '<option value="2">Top Bar for Frontend</option>';


                                            }else{
                                                bar += '<option value="1" >Side Bar for Admin</option>';

                                                 bar += '<option value="2" selected>Top Bar for Frontend</option>';
}

                                        $('#pmodule').append(html_op,html);
                                        $('#bar').append(bar);
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
                                        $('#fname').val("");
                                        $('#font').val("");
                                        $('#order').val("");
                                        $('#label').text("Add");
                                        $('#btnsubmit').show();
                                       $('#btnupdate').attr("style","display:none;");
                                       $('#bmodal').modal('hide');
                                        
}

function delete_form(val)
{
                    url = "<?php echo base_url('cmssecurity/delete_menu') ?>";
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