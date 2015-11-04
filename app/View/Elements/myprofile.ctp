<?php
echo $this->Html->script('bootstrap-datepicker');
echo $this->Html->css('datepicker');
?>

<script type="text/javascript">

function validate()
{		

	var isValidated = jQuery('#myprofile').validationEngine('validate');
	
	if(isValidated == false)
		{
			return false;
		}
}		


 
  
	</script>
<?php 
	//print("<pre>");
	//print_r($arrWebUserProfile);
	//exit;
	if($arrWebUserProfile['Users']['usertype_id']==2)
		{
		
		  $strcss ="";
		  $stratrist="style='display:none'";
		}
		else
		{
		  $strcss = "style='display:none'";
		   $stratrist = "";
		}
		if($arrWebUserProfile['Users']['user_birth']=="0000-00-00")
		{
		  $birthdate ="";
		}
		else
		{
		  $birthdate = date('m/d/Y',strtotime($arrWebUserProfile['Users']['user_birth']));
		}
	
?>
	
<div class="container" id="maincontent">
<div class="updateprofile">

<div class="modal-header"><h4 class="modal-title">UPDATE YOUR PROFILE</h4></div>
					<!-- main -->	
					<div class="col-md-12 modal-body">
                        
                        <form role="form" id="myprofile" class="myprofile" method="POST">
						<div class="row form-group">
                            <div class="col-md-6">
								<?php echo $this->Form->input('firstname',array('label'=>'First name &nbsp;<span></span>','class'=>'form-control validate[required,custom[onlyLetterSp]]','value'=>$arrWebUserProfile['Users']['user_fname']));?>
                                </div>
                                <div class="col-md-6">
								<?php echo $this->Form->input('lastname',array('label'=>'Last name &nbsp;<span></span>','class'=>'form-control validate[required,custom[onlyLetterSp]]','value'=>$arrWebUserProfile['Users']['user_lname']));?>
                                </div>
                        </div>
                         <div class="row form-group">
								<div class="col-md-6">
										<?php echo $this->Form->input('displayname',array('label'=>'Display Name &nbsp;<span></span>','class'=>'form-control validate[required]','value'=>$arrWebUserProfile['Users']['user_display_name']));?>
                                </div>
                              <div class="col-md-6">
									<?php echo $this->Form->input('phonenumber',array('label'=>'Phone Number &nbsp;<span></span>','class'=>'form-control validate[required]','value'=>$arrWebUserProfile['Users']['user_mobileno']));?>
                             </div>
                    							
						 </div>
						
                              
                         
                        <div class="row form-group" >
						    
					 <div class="col-md-6">
									<?php echo $this->Form->input('usernationlity',array('label'=>'Nationality &nbsp;<span></span>','class'=>' validate[custom[onlyLetterSp]]  form-control','value'=>$arrWebUserProfile['Users']['user_nationality']));?>
                         </div>
                         
                         <div class="col-md-6">
						 <?php   
						 $options = array(''=>'Please Select Sex','male'=>'Male','female'=>'Female');
						 echo $this->Form->input('userSex',array('label'=>'Sex &nbsp;<span></span>','type'=>'select','options'=>$options,'class'=>'validate[required] form-control','value'=>$arrWebUserProfile['Users']['user_sex']));
?>
								</div>
								
								
						 </div>
				
                        <div class="row form-group">
						<div class="col-md-6">
									<?php echo $this->Form->input('birthdate', array('type' => 'text', 'escape' => false,'class' =>'form-control','value' => $birthdate ));?>
                         </div>
						  <div class="col-md-6 " >
					  
					  
					  
				 <label  for="Name">Category</label>
		
				<?php

				echo $this->Form->input('artistcategory_list',array('label'=>false,'type'=>'select','options'=>$arr_CategoryList,'class'=>'validate[required,funcCall[ifSelectNotEmpty]] selectpicker form-control category-dropdown','multiple'=>'multiple' , 'data-max-options' => "5"));
			echo "<label> Registered Categories</label>: ";
				$count=0;
				foreach($arr_userCategory as $usercat)
				{
					$count++;
					$catname	= $usercat['cat']['category_name'];
					if(count($arr_userCategory)==$count)
					{
						$catname = $catname.". ";
					}
					else
					{	$catname = $catname.", ";
						
					}
					echo $catname;
				}
				
?>
                        </div>
                        
                        
						 </div>
						 <div class="row form-group">
							   <div class="col-md-6">
										<?php echo $this->Form->input('biography', array('type' => 'textarea', 'escape' => false,'class' =>'form-control','value' => $arrWebUserProfile['Users']['user_biography'] ));?>
							 </div>
						 </div>
						
						<div class="row form-group">
								<div class="col-md-12 text-center">
								<?php echo $this->Form->submit(__('Submit',true), array('class'=>'btn btn-success','onClick'=>'return validate(); '));
						            $this->Form->end('');?>
								</div>
						</div>
						
						
						</form>
						
						
					</div>
                    </div>
            </div>



<?php echo $this->element('changepass');?>
 <script type="text/javascript">
$('#birthdate').datepicker({});

</script>