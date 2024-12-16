<script>
$( "#pwdrequest" ).click(function() {
    $('.modal-title').html("Password Reset Form");
        let html="<form id='formreset' method='post'><div class='row'><div class='col-md-12'><input id='email' name='email' placeholder='Enter associated Email Address' class='form-control' /></div></div><br/><div class='row'><div class='col-md-6'><button type='button' class='btn btn-primary' id='btnsubmit' onclick='submit_click()'>Submit</button></div></div></form>";
        $('.modal-body').html(html);
        $('#infomodal').modal('toggle');
        $('#infomodal').modal('show');
});
         
         function submit_click()
         {
             let data=$('#formreset').serialize();
             url = "<?php echo base_url('studentlogin/submit_email') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:data,
                                beforeSend: function () {
                                    $('.modal-title').html("Reset Password");
                                        let html="<div class='alert alert-warning'>Processing...</p></div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('show');
                                },
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    if(res.status==true)
                                    { 
                                        $('.modal-title').html("Success");
                                        let html="<div class='alert alert-success'>"+
                                       "Please Check Your Inbox!</div><br/>"+
                                       "<form id='formotp' method='post'><div class='row'>"+
                                       "<div class='col-md-12'><input id='email' type='hidden' "+
                                       "name='email' value='"+res.email+"'>"+
                                       "<input type='hidden' id='otp' name='otp' placeholder='Enter OTP CODE' "+
                                       "class='form-control' />"+
                                       "<input class='otpinput' style='margin-left: 60px;' max-length='1' type='numeric' id='digit-1' name='digit-1' data-next='digit-2' onkeydown='otpinput(1)' />"+
                                        "<span class='splitter'>&ndash;</span>"+
                                        "<input class='otpinput' type='numeric' max-length='1' id='digit-2' name='digit-2' data-next='digit-3' data-previous='digit-1' onkeydown='otpinput(2)' />"+
                                        "<span class='splitter'>&ndash;</span>"+
                                        "<input class='otpinput' type='numeric' max-length='1' id='digit-3' name='digit-3' data-next='digit-4' data-previous='digit-2' onkeydown='otpinput(3)' />"+
                                        "<span class='splitter'>&ndash;</span>"+
                                        "<input class='otpinput' type='numeric' max-length='1' id='digit-4' name='digit-4' data-next='digit-5' data-previous='digit-3' onkeydown='otpinput(4)' />"+
                                        "<span class='splitter'>&ndash;</span>"+
                                        "<input class='otpinput' type='numeric' max-length='1' id='digit-5' name='digit-5' data-next='digit-6' data-previous='digit-4' onkeydown='otpinput(5)' />"+
                                        "<span class='splitter'>&ndash;</span>"+
                                        "<input class='otpinput' type='numeric' max-length='1' id='digit-6' name='digit-6' data-previous='digit-5' onkeydown='otpinput(6)' />"+
                                        "<div id='otp_validate'></div>"+
                                       "</div></div><br/><div class='row'>"+
                                       "<div class='col-md-6' style='margin-left: 170px;'><button type='button' "+
                                       "class='btn btn-primary' id='btnsubmit' onclick='submit_otp()'>"+
                                       "Submit</button></div></div></form>";
                                        $('.modal-body').html(html);
                                       
                                       
                                      
                                    }
                                    else if(res.status==false)
                                    {
                                        $('.modal-title').html("Error");
                                        let html="<div class='alert alert-danger'>"+res.message+"</div>"
                                        $('.modal-body').html(html);
                                       
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 1500); 
                                    }
                                    else
                                    {
                                        $('.modal-title').html("Error");
                                        let html="<div class='alert alert-danger'>Network Error</div>"
                                        $('.modal-body').html(html);
                                     
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 1500);
                                    }
                                }
                            });

         }
         function submit_otp()
         {
             var otp=$("#otp").val();
            if(otp.length !=6)
		{
			$('#otp_validate').html('<span style="color:red;">Please Enter 6 Digit OTP Code.</span>');
			return false;
		}
             let data=$('#formotp').serialize();
             url = "<?php echo base_url('studentlogin/submit_otp') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:data,
                               
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    if(res.status==true)
                                    { 
                                        $('.modal-title').html("Success");
                                        let html="<form id='formpwd' method='post'><div class='row'><div class='col-md-12'><input id='email' name='email' value='"+res.email+"' type='hidden'><input id='pwd' type='password' name='pwd' placeholder='Enter Password' class='form-control' /></div></div><br/><div class='row'><div class='col-md-12'><input id='repwd' type='password' name='repwd' placeholder='Re Enter Password' class='form-control' /></div></div><br/><div class='row'><div class='col-md-6'><button type='button' class='btn btn-primary' id='btnsubmit' onclick='submit_pwd()'>Submit</button></div></div></form>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                      
                                      
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

         function submit_pwd()
         {
             let data=$('#formpwd').serialize();
             url = "<?php echo base_url('studentlogin/submit_newpwd') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:data,
                               
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    if(res.status==true)
                                    { 
                                        $('.modal-title').html("Success");
                                        let html="<div class='alert alert-success'>Password Reset Success.</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                      
                                      
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
        

	function otpbind()
	{

		let digit1=$('#digit-1').val();
		let digit2=$('#digit-2').val();
		let digit3=$('#digit-3').val();
		let digit4=$('#digit-4').val();
		let digit5=$('#digit-5').val();
		let digit6=$('#digit-6').val();
		let otp=digit1+digit2+digit3+digit4+digit5+digit6;
		if(otp.length !=6)
		{
			$('#otp_validate').html('<span style="color:red;">Please Enter 6 Digit OTP Code.</span>');
			return false;
		}
		else
		{
			$('#otp_validate').html('');
			$('#otp').val(otp);
		}
    }
    function otpinput(num)
    {
        $('#digit-1,#digit-2,#digit-3,#digit-4,#digit-5,#digit-6').attr('maxlength', 1);

        var thiscode=$('#digit-'+num);
        thiscode.on('keyup', function(e) {
			var parent = $(thiscode.parent());
			
			if(e.keyCode === 8 || e.keyCode === 37) {
				var prev = parent.find('input#' + thiscode.data('previous'));
				
				if(prev.length) {
					$(prev).select();
				}
			} else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
				var next = parent.find('input#' + thiscode.data('next'));
				
				if(next.length) {
					$(next).select();
				} else {
					if(parent.data('autosubmit')) {
						parent.submit();
					}
				}
            }
            if(num=='6')
            {
                otpbind()
            }
		});
           
    }


</script>