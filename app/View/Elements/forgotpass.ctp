 <div class="modal fade" id="modalforgotpassword">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="frmforgotpassword" id="frmforgotpassword" method="post">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="60" height="50px"></button>
        <h4 class="modal-title">Forgot Password</h4>
      </div>
      <div class="modal-body">
	  
			<div id="forgoterrormsg"></div>
      
       <div class="form-group col-sm-12 col-md-offset-2">
								<label  for="Email" class="col-sm-2 control-lable">Email: <span class="star">*</span></label>
								<div class="col-sm-6">
								 <input type="email" name="txtUsername" id="txtUsername" class="form-control validate[required] custom[email]" placeholder="Email"/>
								</div>
							</div>
							<div class="col-sm-12 col-md-offset-4">
							  <div class="col-sm-offset col-sm-6">
							  <p><a href="javascript:void(0);" class="showLogin">Login</a></p>
							  </div>
							  </div>
                            <div class="form-group col-sm-12 col-md-offset-4">
							  <div class="col-sm-offset col-sm-6">
							  <button type="submit" class="btn btn-primary btn-lg btn-block submit-button" onclick="return fnforgotpassword();" id="addItem">SUBMIT</button>
							  </div>
							  </div>
     
                </div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
			</div>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>