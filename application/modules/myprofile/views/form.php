
               
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
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <label>Gender <span style="color:red;">(You can't change your gender once selected)</span></label>
                            
                            <?php if(empty(@$st->is_differently_abled)) { ?>
                            <select class="form-control" name="gender" id="gender">
                                <option value="">Select</option>
                                <option value="M" <?php if(@$st->gender == 'M') echo 'selected'; ?>>Male</option>
                                <option value="F" <?php if(@$st->gender == 'F') echo 'selected'; ?>>Female</option>
                            </select>
                            <?php }
                            else{ ?>
                                <input class="form-control" value="<?=@$st->gender?>" disabled>
                            <?php } ?>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            
                            <label>Is Differently Abled</label>
                            <?php if(@$st->is_differently_abled == 'N') { ?>
                                <select class="form-control" name="is_differently_abled" id="is_differently_abled" >
                                    <option value="Y" <?php if(@$st->is_differently_abled == 'Y') echo 'selected'; ?>>Yes</option>
                                    <option value="N" <?php if(@$st->is_differently_abled == 'N') echo 'selected'; ?>>No</option>
                                </select>
                            <?php }
                            else{ ?>
                                <input class="form-control" value="Y" disabled>
                            <?php } ?>
                            
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <label>Is Disability Approved</label>
                            <select class="form-control" name="is_disability_approved" id="is_disability_approved" disabled>
                                <option value="Y" <?php if(@$st->is_disability_approved == 'Y') echo 'selected'; ?>>Yes</option>
                                <option value="N" <?php if(@$st->is_disability_approved == 'N') echo 'selected'; ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                    
                        <div class="col-md-12 col-sm-12">

                            <label>Document or certificate(PDF / Word / Image) <span style="color:red">Specially for Differently Abled</span></label>

                            <?php
                            if (!empty(@$st->user_verification_file)) {
                                $file_url = @$st->user_verification_file;
                            } else {
                                $file_url = '';
                            }
                            ?>

                            <?php if (!empty($file_url)): ?>
                                <a href="<?= base_url(); ?>upload/student/<?= $file_url; ?>" target="_blank">
                                    view previous file
                                </a>
                            <?php endif; ?>

                            <input type="file" name="file_url" id="verification_file_url">
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