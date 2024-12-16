<script>
function update()
{

   
    let name=$('#name').val();
    let address=$('#address').val();
    let phone=$('#phone').val();
    let email=$('#email').val();
    if(name == "" || address == "" || phone == "" || email == "")
    {
        $('.modal-title').html("Error");
        let html="<div class='alert alert-danger'>Please Input All Fields</div>"
        $('.modal-body').html(html);
        $('#infomodal').modal('toggle');
        $('#infomodal').modal('show');
        setTimeout(function(){
        $('#infomodal').modal('hide');
        }, 1250);
    }
    else
    {
        url = "<?php echo base_url('studentprofile/update') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{name,address,phone,email},
                               
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    if(res.status==true)
                                    { 
                                        $('.modal-title').html("Success");
                                        let html="<div class='alert alert-success'>"+res.message+"</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 2000);
                                        
                                      
                                    }
                                    else if(res.status==false)
                                    {
                                        $('.modal-title').html("Error");
                                        let html="<div class='alert alert-danger'>"+res.message+"</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 1500); 
                                    }
                                    else
                                    {
                                        $('.modal-title').html("Error");
                                        let html="<div class='alert alert-danger'>Network Error</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 1500);
                                    }
                                }
                            });
    }
}

function modalshow()
{
    $('#updateextra').modal('show');
    $('#success').html("");
    $('#error').html("");
}
function update_extra()
{

    let pd=$('#pd').val();
    let pn=$('#pn').val();
    let gd=$('#gd').val();
    let gn=$('#gn').val();
    let extra=$('#extra').val();
    if(pd == "" || pn == "" || gd == "" || gn == "")
    {
        $('.modal-title').html("Error");
        let html="<div class='alert alert-danger'>Please Input All Fields</div>"
        $('.modal-body').html(html);
        $('#infomodal').modal('toggle');
        $('#infomodal').modal('show');
        setTimeout(function(){
        $('#infomodal').modal('hide');
        }, 1250);
    }
    else
    {
        url = "<?php echo base_url('studentprofile/update_extrainfo') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{pd,pn,gd,gn,extra},
                               
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    if(res.status==true)
                                    { 
                                        $('#success').html(res.message);
                                       
                                      
                                    }
                                    else if(res.status==false)
                                    {
                                        $('#error').html(res.message);
                                    }
                                    else
                                    {
                                        $('#error').html(res.message);
                                    }
                                }
                            });
    }
}
</script>