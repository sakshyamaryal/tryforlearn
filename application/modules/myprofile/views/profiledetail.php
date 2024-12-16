<span style="float:right">
<button id="btnedit" type="button" class="btn btn-success" onclick="editmyprofile()"><i class="fa fa-edit"></i> Edit</button>
</span>
<center>
                      
                    <img style="margin-left: 86px;" src="<?=base_url();?>upload/student/<?=@$list->image?>" onerror="this.onerror=null;this.src='<?=base_url().'assets/frontend/images/dummy.png';?>'" name="<?=@$list->fname.' '.@$list->lname;?> " alt="<?=@$list->fname.' '.@$list->lname;?> " width="140" height="140" border="0" class="img-circle">
                    <h3 class="media-heading"><?=@$list->fullname;?> </h3>
                    <span><strong>Username: </strong>    
                    <span class="label label-warning"><?=@$list->username;?></span>
                    </span>
                    <br/>
                    <span><strong>Contact Num: </strong>    
                    <span class="label label-warning"><?=@$list->phone;?></span>
                    </span><br/>
                  
                    
                    <span><strong>Preffered Language: </strong>    
                    <span class="label label-warning"><?=@$list->preffered_language;?></span>
                    </span>
                    <br/>
                    <span><strong>Email: </strong>    
                    <span class="label label-warning"><?=@$list->email;?></span>
                    </span>
                    <br/>
                    <span><strong>Refferal code: </strong>    
                    <span class="label label-warning"><?=@$list->refferalcode;?></span>
                    </span>
                   
                    
                    
                    </center>
                    <hr>
                    <center>
                     <div class="row">
                     <div class="col-md-2 col-sm-2">
                      <label>Parents Detail</label>
                      <p><?=@$list->parents_detail;?></p>
                     </div>
                    
                     <div class="col-md-2 col-sm-2">
                      <label>Parents Number</label>
                      <p><?=@$list->parents_number;?></p>
                     </div>
                     <div class="col-md-2 col-sm-2">
                      <label>Institution</label>
                      <p><?=@$list->guardian_detail;?></p>
                     </div>
                     <div class="col-md-2 col-sm-2">
                      <label>Citizenship Number</label>
                      <p><?=@$list->guardian_number;?></p>
                     </div>
                     <div class="col-md-4 col-sm-4">
                      <label>Full Address</label>
                      <p><?=@$list->address;?></p>
                     </div>
                     </div>
                    </center>
                    <hr>
                    <center>
                    <p class="text-left"><strong>Bio: </strong><br>
                    <?=@$list->extra;?>
                    </p>                    <br>
                    </center>