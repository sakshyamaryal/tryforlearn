<script>
    function submit_quote()
    {
        let name=$('#name').val();
        let email=$('#email').val();
        let phone=$('#phone').val();
        let address=$('#address').val();
        let course_id=$('#course_id').val();
        let message=$('#message').val();

        if(name=="" || email=="" || phone==""  || address=="" || course_id=="" || course_id=="-1" || message=="")
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

        
        url = "<?php echo base_url('home/submit_enquiry') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{name:name,email:email,phone:phone,address:address,course_id:course_id,message:message},
                                beforeSend: function () {
                                    $('.modal-title').html("Sent Query");
                                        let html="<div class='alert alert-warning'>Please Wait your query is being sent...</p></div>"
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
                                        $('#phone').val("");
                                        $('#address').val("");
                                        $('#course_id').prop('selectedIndex', 0);
                                        $('#message').val("");

                                    }


                                }
                            });
    }
</script>