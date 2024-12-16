<script>
    function submit_quote()
    {
        let name=$('#name').val();
        let email=$('#email').val();
        let subject=$('#subject').val();
       
        let message=$('#message').val();

        if(name=="" || email=="" || subject==""  || message=="")
        { 
            $('.modal-title').html("Error");
            let html="<div class='alert alert-danger'>All Input Fields Are Required.</div>"
            $('.modal-body').html(html);
            $('#infomodal').modal('toggle');
            $('#infomodal').modal('show');
            setTimeout(function(){
            $('#infomodal').modal('hide');
            }, 1500);
           
            return false;

        }

        
        url = "<?php echo base_url('contact/submit_enquiry') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{name,email,subject,message},
                               
                                beforeSend: function () {
                                    $('.modal-title').html("Message Status");
                                        let html="<div class='alert alert-warning'>Please Wait your message is being sent...</p></div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('show');
                                },

                                success: function (response) {
                                    var res = jQuery.parseJSON(response);

                                    if(res.status==true)
                                    { 
                                        $('.modal-title').html("Success");
                                        let html="<div class='alert alert-success'>Your Queries has been submitted.<p>We will Get back to You Soon !. Thank you.</p></div>"
                                        $('.modal-body').html(html);
                                       
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 2000);

                                        $('#name').val("");
                                        $('#email').val("");
                                        $('#subject').val("");
                                       
                                        $('#message').val("");

                                    }


                                }
                            });
    }
</script>