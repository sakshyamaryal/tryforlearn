
               
                    <form method="post" id="updateform">
					<div class="modal-body" >
                    <div class="row">
                   
                    <div class="col-md-4 col-sm-4">
                    <label>Full Name</label>
                    <input type="text" name="fname" id="fname" value="<?=@$st->fullname;?>" class="form-control" autofocus/>
                    </div>
                    <div class="col-md-4 col-sm-4">
                    <label>Email Address</label>
                    <input type="email" name="email" id="email" value="<?=@$st->email;?>" class="form-control" disabled/>
                    </div>
                    <div class="col-md-4 col-sm-4">
                    <?php if(@$st->image!=null){$imgurl=$st->image;}else{$imgurl='dummy.png';} ?>
                   
                   <img src="<?=base_url();?>upload/student/<?=$imgurl;?>" style="width:25%" id="simage" name="simage"/>
                   <input type="file" name="upload" id="file">

                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4 col-sm-4">
                    <label>Contact Number</label>
                    <input type="text" name="cnum" id="cnum" value="<?=@$st->phone;?>" class="form-control" disabled/>
                    </div>
                    
                    <div class="col-md-4 col-sm-4">
                    <label>Address</label>
                    <input type="address" name="address" id="address" value="<?=@$st->address;?>" class="form-control"/>
                    </div>
                 
                    <div class="col-md-4 col-sm-4">
                    <label>Parent Detail</label>
                    <input type="text" name="parent_detail" id="parent_detail" value="<?=@$st->parents_detail;?>" class="form-control"/>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-4 col-sm-4">
                    <label>Parent Number</label>
                    <input type="numer" name="parent_number" id="parent_number" value="<?=@$st->parents_number;?>" class="form-control"/>
                    </div>
                    <div class="col-md-4 col-sm-4">
                    <label>Institution</label>
                    <input type="text" name="institution" id="institution" value="<?=@$st->guardian_detail;?>" class="form-control"/>
                    </div>
                    <div class="col-md-4 col-sm-4">
                    <label>CItizenship Number</label>
                    <input type="text" name="citizenship" id="citizenship" value="<?=@$st->guardian_number;?>" class="form-control"/>
                    </div>
                    </div>
                    

                    <div class="row">
                    
                    <div class="col-md-12 col-sm-12">
                    <label>Extra Information</label>
                    <textarea name="extra_information" id="extra_information"  class="form-control"><?=@$st->extra;?></textarea>
                    </div>
                    
                    </div>
                    <div class="row">
                    
                    <div class="col-md-12 col-sm-12">
                    <label>Preffered Language</label>
                    <select class="form-control" id="language" name="language">
                     <option value="ENG" <?php if(@$st->preffered_language=='ENG')echo 'selected';?>>English</option>
                     <option value="NEP" <?php if(@$st->preffered_language=='NEP')echo 'selected';?>>Nepali</option>
                    </select>
                    </div>
                    
                    </div>

				


					</div>
					<div class="modal-footer">
						
						<button id="btnupdate" type="button" class="btn btn-success" onclick="updatemyprofile()"><i class="fa fa-save"></i> Update</button>
					</div>
                    </form>
                    
                    <script>
                     $("#file").change(function() {
                    readURL(this);
                    });
                    </script>