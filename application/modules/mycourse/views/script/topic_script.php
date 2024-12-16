<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}

function show_files(topic_id)
{
      let tname=$('#topic'+topic_id).attr("data");
 $('#tname').html(tname);
  url = "<?php echo base_url('mycourse/get_file') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{topic_id},
                               
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    console.log("html3"+res.html3);
                                     console.log("html2"+res.html2);
                                     console.log("html1"+res.html1);
                                     console.log("html"+res.html);


                                    if(res.html !="" || res.html1 !="" || res.html2 !=""  || res.html3 !=""  )
                                    { 
                                      //let html ="<a href='<?=base_url();?>mycourse/vmaterial?tid="+res.topicid+"'><i class='fa fa-folder'></i> Videos</a>";

                                        $('#topicbody').html(res.html3 + res.html + res.html1 + res.html2);
                                        
                                        $('#topicmodal').modal('toggle');
                                        $('#topicmodal').modal('show');
                                       
                                        
                                      
                                    }
                                    else if(res.status==false)
                                    {
                                        
                                        let html="<div class='alert alert-danger'>"+res.message+"</div>";
                                        // html +="<a href='<?=base_url();?>mycourse/vmaterial?tid="+res.topicid+"'><i class='fa fa-folder'></i> Videos</a>";

                                        $('#topicbody').html(html);
                                        $('#topicmodal').modal('toggle');
                                        $('#topicmodal').modal('show');
                                       
                                    }
                                    else
                                    {
                                       alert("Network Error");
                                    }
                                }
                            });
    
}

function count(id)
{
  url = "<?php echo base_url('mycourse/insert_count') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{id},
                               
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    if(res.status==true)
                                    { 
                                      console.log(res.message);
   }
                                    else if(res.status==false)
                                    {
                                        
                                       console.log(res.message);
                                       
                                    }
                                
                                }
                            });
}
</script>