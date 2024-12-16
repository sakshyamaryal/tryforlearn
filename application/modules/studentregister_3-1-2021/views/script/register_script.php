<script>
function submit(student_id)
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
        url = "<?php echo base_url('studentregister/submit_basic_detail_form') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{pd,pn,gd,gn,extra,student_id},
                               
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    if(res.status==true)
                                    { 
                                        $('.modal-title').html("Success");
                                        let html="<div class='alert alert-success'>Your request has been submitted successfully. Please verify your e-mail and wait for approval.Thank you for joining with us.</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 10000);
                                        window.setTimeout(function(){
                                        window.location.href ='<?= base_url(); ?>';
                                        },15000);
                                      
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
function skip()
{
                                   $('.modal-title').html("Success");
                                        let html="<div class='alert alert-success'>Your request has been submitted and add all info later compulsory</p></div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 2000);
                                        window.setTimeout(function(){
                                        window.location.href ='<?= base_url(); ?>';
                                        },1000);
  
}
   
</script>