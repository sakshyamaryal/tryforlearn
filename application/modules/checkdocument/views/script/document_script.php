<script>
    function check_document()
    {
        let dn=$('#dn').val();
        let cn=$('#cn').val();
        let phone=$('#phone').val();
        url = "<?php echo base_url('checkdocument/check') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{dn,cn,phone},
                               
                               
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
                                        }, 2200);
                                        $('#showfile').html('<a target="_blank" href="<?= base_url();?>checkdocument/downloadcertificate?dn='+dn+'&cn='+cn+'&phone='+phone+'"><i class="fa fa-file-alt"></i> Download Certificate From Here</a><br><br/>');
                                        
                                      
                                    }
                                    else if(res.status==false)
                                    {  $('#showfile').html('');

                                        $('.modal-title').html("Error");
                                        let html="<div class='alert alert-danger'>"+res.message+"</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 2500); 

                                    }
                                    else
                                    {
                                        $('#showfile').html('');
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
</script>