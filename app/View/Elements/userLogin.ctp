	<div class="modal fade" id="userLogin">
  <div class="modal-dialog">
    <div class="modal-content">
         
      <form name="userlogin" id="userlogin" method="post">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="60" height="50px"></button>
        <h4 class="modal-title">USER LOGIN</h4>
      </div>
			  <div class="modal-body">
                
					<div class="errormsg"></div>
						  <div class="form-group col-sm-12 col-md-offset-2">
						
								<label  for="inputEmail3" class="col-sm-3 control-lable">Email: <span class="star">*</span> </label>
								<div class="col-sm-6">
								<input type="email" class="form-control validate[required,[funcCall[validateEmail]]]" id="txtusername" name="txtusername" />
								<input type="hidden" name="usertypeid" id="usertypeid" value="3"/>
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
							  <button type="submit" class="btn btn-primary btn-lg btn-block submit-button" onclick="return loginValidation('user');" id="addItem">SUBMIT</button>
							  </div>
							  </div>
							  
							  <div class="form-group col-sm-12 col-md-offset-4">
							  <div class="col-sm-offset col-sm-3" style="padding-right:0;">
							  <label id="showmodalregister">Create an account</label>
							  </div>
							  <div class="col-sm-offset col-sm-3">
							  <a class="btn btn-primary btn-lg btn-block register-button showusermodal" href="javascript:void(0);" >REGISTER</a>
							  </div>
							  </div>
							
				</div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
                <span>Login using social networks</span>
        <div class="social-network popup-social">
                 		<?php echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'userloginfacebook', 'escape' => false)); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","facebook",'3'));
												echo $this->Form->hidden('',array('id'=>'userloginfacebook_process_url', 'value'=>$strFURL));?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-linkedin fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'userloginlinkedin')); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","linkedin",'3'));
												echo $this->Form->hidden('',array('id'=>'userloginlinkedin_process_url', 'value'=>$strFURL));
												
                    ?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-google-plus fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'userlogingmail')); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","gmail",'3'));
												echo $this->Form->hidden('',array('id'=>'userlogingmail_process_url', 'value'=>$strFURL));
												
                    ?>
                </div>
			</div>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>