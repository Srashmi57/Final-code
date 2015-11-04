    <!-- End Header Tag -->
	
	<div class="modal fade" id="artistLogin" >
  <div class="modal-dialog">
    <div class="modal-content">
         
      <form name="artistlogin" id="artistlogin" method="post">
      <div class="modal-header">
	  
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="60" height="50px"></button>
        <h4 class="modal-title">ARTIST LOGIN</h4>
      </div>
			  <div class="modal-body artistLogin">
        
					<div class="errormsg"></div>
						  <div class="form-group col-sm-12 col-md-offset-2">
								<label  for="inputEmail3" class="col-sm-3 control-lable">Email: <span class="star">*</span> </label>
								<div class="col-sm-6">
								<input type="email" class="form-control validate[required,[funcCall[validateEmail]]]" id="txtusername" name="txtusername" />
								<input type="hidden" name="usertypeid" id="usertypeid" value="2"/>
								</div>
							</div>
							
								<div class="form-group col-sm-12 col-md-offset-2">
								<label  for="inputPassword3" class="col-sm-3 control-lable">Password: <span class="star">*</span></label>
								<div class="col-sm-6">
								<input type="password"  id="txtpassword" name="txtpassword" class="form-control validate[required]" />
								</div> 
								</div>
							
							  <div class="col-sm-12 col-md-offset-4">
							  <div class="col-sm-offset col-sm-6">
							  <p><a href="javascript:void(0);" class="showmodalPassword">I forgot my password ?</a></p>
							  </div>
							  </div>
							  
							  <div class="form-group col-sm-12 col-md-offset-4">
							  <div class="col-sm-offset col-sm-6">
							  <button type="submit" class="btn btn-primary btn-lg btn-block submit-button" onclick="return loginValidation('artist');" id="addItem">SUBMIT</button>
							  </div>
							  </div>
							  
							  <div class="form-group col-sm-12 col-md-offset-4">
							  <div class="col-sm-offset col-sm-3" style="padding-right:0;">
							  <label >Create an account</label>
							  </div>
							  <div class="col-sm-offset col-sm-3">
							  <a class="btn btn-primary btn-lg btn-block register-button showartistmodal" id="showmainrgmodal" href="javascript:void(0);" >REGISTER</a>
							  </div>
							  </div>
							
				</div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
                <span>Login using social networks</span>
        <div class="social-network popup-social">
                  <?php echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'artistfacebook', 'escape' => false)); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","facebook",'2'));
												echo $this->Form->hidden('',array('id'=>'artistfacebook_process_url', 'value'=>$strFURL));?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-linkedin fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'artistlinkedin')); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","linkedin",'2'));
												echo $this->Form->hidden('',array('id'=>'artistlinkedin_process_url', 'value'=>$strFURL));
												
                    ?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-google-plus fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'artistgmail')); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","gmail",'2'));
												echo $this->Form->hidden('',array('id'=>'artistgmail_process_url', 'value'=>$strFURL));
												
                    ?>
                </div>
			</div>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>