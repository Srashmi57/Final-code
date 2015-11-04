<?php
echo $this->Html->script('bootstrap-datepicker');
echo $this->Html->css('datepicker');

echo $this->Html->css('jquery.treeview');
echo $this->Html->script('jquery.cookie');
echo $this->Html->script('jquery.treeview');

echo $this->Html->script('demo');

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
	//print_r($sub_cat_name);
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
		<div class="col-md-12 " style="background-color: #111;">
		<?php
		if($arrWebUserProfile['Users']['usertype_id']==3)
	{	
	   //echo "<p class='categorynote'> Note:- If you update categories, all the previously selected categories and subcatgories will be overwriiten with the new ones.</p>";
	}?>
			<form role="form" id="myprofile" class="myprofile" method="POST">
				<div class="row form-group">
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('firstname',array('label'=>'First name <span class="star">*</span>','class'=>'form-control validate[required,custom[onlyLetterSp]]','value'=>$arrWebUserProfile['Users']['user_fname']));
						?>
					</div>
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('lastname',array('label'=>'Last name <span class="star">*</span>','class'=>'form-control validate[required,custom[onlyLetterSp]]','value'=>$arrWebUserProfile['Users']['user_lname']));
						?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('mydisplayname',array('label'=>'Display Name <span class="star">*</span>','class'=>'form-control validate[required]','value'=>$arrWebUserProfile['Users']['user_display_name']));
						?>
					</div>
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('phonenumber',array('label'=>'Phone Number <span class="star">*</span>','class'=>'form-control validate[required]','value'=>$arrWebUserProfile['Users']['user_mobileno']));
						?>
					</div>
				</div>
				<div class="row form-group" >
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('usernationlity',array('label'=>'Nationality &nbsp;<span></span>','class'=>' validate[custom[onlyLetterSp]]  form-control','value'=>$arrWebUserProfile['Users']['user_nationality']));
						?>
					</div>         
					<div class="col-md-6">
						<?php   
							$options = array(''=>'Please Select Sex','male'=>'Male','female'=>'Female');
							echo $this->Form->input('userSex',array('label'=>'Sex <span class="star">*</span>','type'=>'select','options'=>$options,'class'=>'validate[required] form-control','value'=>$arrWebUserProfile['Users']['user_sex']));
						?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('birthdate', array('type' => 'text', 'escape' => false,'class' =>'form-control','value' => $birthdate ));
						?>
					</div>
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('biography', array('type' => 'textarea', 'escape' => false,'class' =>'form-control','value' => $arrWebUserProfile['Users']['user_biography'] ));
						?>
						</div>


					
				</div>
				
			
		
					<div class="row form-group" style="top:-100px;position:relative;">
				
						
						<div class="col-md-6 expandview" >
						<label  for="Name">Category <span class="star">*</span></label>
										
           
			<?php
			$arrSelectedValue=array();
			$arrSelectedsubValue=array();
			$arrSelectedsubsubValue =array();
			
			$catname ="";
				if(count($arr_userCategory)>0)
				{
						foreach($arr_userCategory as $value)
								{
								
									$arrSelectedValue[]=$value['UserCategory']['category_id'];
								
								
								}
				}
				if(count($arr_usersubCategory)>0)
				{
						foreach($arr_usersubCategory as $usersubcat)
							{
								 	$arrSelectedsubValue[]=$usersubcat['subcat']['subcategory_id'];									
							}
				}
				if(count($arr_usersubsubCategory)>0)
				{
						foreach($arr_usersubsubCategory as $usersubcat)
							{
								 	$arrSelectedsubsubValue[]=$usersubcat['subsubcat']['subsubcategory_id'];									
							}
				}
			?>
             
             
           <?php
		   if($arrWebUserProfile['Users']['usertype_id']==3)
	{?>
					<ul id="navigation">
		
	<?php
		foreach($arr_CategoryList as $usercatkey=> $usercat)
							{
									$valuecatid = $usercatkey;							
								if(in_array($usercatkey,$arrSelectedValue))
									{
									  $selected="checked='checked'";
									}
									else
									{
										$selected='';
									}
									$arr_subCategoryList = $this->Caldays->getsubcategories($valuecatid);
									
									?>
									
		<li><input type="checkbox"  name="artistcategory_list[]" datavalue="<?php echo $usercat?>" value="<?php echo $valuecatid;?>" <?php echo $selected;?> /><?php echo $usercat?>
		<ul>
		<?php
		foreach($arr_subCategoryList as $usersubcatkey=> $usersubcat)
							{
							
							if(in_array($usersubcatkey,$arrSelectedsubValue))
									{
									  $selected="checked='checked'";
									}
									else
									{
										$selected='';
									}
							$arr_subsubCategoryList = $this->Caldays->getsubsubcategories($usersubcatkey);
							?>
			
				<li>
				<input type="checkbox"  name="subcategory_list1[]" datavalue="<?php echo $usersubcatkey?>" value="<?php echo $usersubcatkey;?>" <?php echo $selected;?> /><?php echo $usersubcat?> 
				<ul>
				<?php
				foreach($arr_subsubCategoryList as $usersubsubcatkey=> $usersubsubcat)
							{
							if(in_array($usersubsubcatkey,$arrSelectedsubsubValue))
									{
									  $selected="checked='checked'";
									}
									else
									{
										$selected='';
									}
							?>
							<li><input type="checkbox"  name="subsubcategory_list1[]" datavalue="<?php echo $usersubsubcatkey?>" value="<?php echo $usersubsubcatkey;?>" <?php echo $selected;?> /><?php echo $usersubsubcat?> </li>
							<?php
							}
							?>
							
							</ul>
				
				</li>
				
<?php
}?>				
			</ul>	
		</li>
		
			
	
<?php
}?>
</ul>
<?php
}
else
{
?>
<dl class="dropdown_cat category_dropdown"> 
  
    <dt>
    <a href="javascript:void(0);">
      <span class="hida">Selected Categories</span>    
      <p class="multiSel"></p>  
    </a>
    </dt>
  
    <dd>
        <div class="mutliSelect">
            <ul>
			<?php
			$arrSelectedValue=array();
			$catname ="";
				if(count($arr_userCategory)>0)
				{
						foreach($arr_userCategory as $value)
								{
								
									$arrSelectedValue[]=$value['UserCategory']['category_id'];
								
								
								}
				}
				foreach($arr_CategoryList as $usercatkey=> $usercat)
							{
									$valuecatid = $usercatkey;							
								if(in_array($usercatkey,$arrSelectedValue))
									{
									  $selected="checked='checked'";
									}
									else
									{
										$selected='';
									}
							?>
                <li>
                    <input type="checkbox"  name="artistcategory_list[]" datavalue="<?php echo $usercat?>" value="<?php echo $valuecatid;?>" <?php echo $selected;?> /><?php echo $usercat?></li>
					<?php
					}?>
             
             
            </ul>
        </div>
    </dd>
 
</dl>
						
<?php

}
	?>				
       
						
					</div> 
					
					</div>
					
					
				<div class="row form-group">
					<div class="col-md-12 text-center">
						<?php 
							echo $this->Form->submit(__('Submit',true), array('class'=>'btn btn-success','onClick'=>'return validate(); '));
							$this->Form->end('');
						?>
					</div>
				</div>					
			</form>			
		</div>
	</div>
</div>
<?php 
	echo $this->element('changepass');
?>

<script type='text/javascript'>
$('#birthdate').datepicker({endDate: '+0d',
        autoclose: true});
			var total=0;
			 var updateselctedarry = new Array();
			 var updatesubsubselctedarry = new Array();
		$('.updateprofile .dropdown_subcat dt a').on('click', function () {
		
          $('.updateprofile .dropdown_subcat dd ul').slideToggle('fast');
      });
	  $('.updateprofile .dropdown_subcat dd ul li a').on('click', function () {
          $('.updateprofile .dropdown_subcat dd ul').hide();
      });
	  
	  	$('.updateprofile .dropdown_subsubcat dt a').on('click', function () {
		
          $('.updateprofile .dropdown_subsubcat dd ul').slideToggle('fast');
      });
	  $('.updateprofile .dropdown_subsubcat dd ul li a').on('click', function () {
          $('.updateprofile .dropdown_subsubcat dd ul').hide();
      });
	  
	  	$('.updateprofile .dropdown_cat dt a').on('click', function () {
		
          $('.updateprofile .dropdown_cat dd ul').slideToggle('fast');
      });
	  $('.updateprofile .dropdown_cat dd ul li a').on('click', function () {
          $('.updateprofile .dropdown_cat dd ul').hide();
      });
	  
	  $(".updateprofile .dropdown_cat input:checkbox:checked").each(function(){ updateselctedarry.push($(this).val()); });
		$('.updateprofile .dropdown_cat .mutliSelect input[type=checkbox]').on('click', function () { 
		
		
			  if ($(this).is(':checked')) {
			  
			if(updateselctedarry.length>4)
			{
				
				bootbox.alert("Select only five Category");
				$(this).checked = false ;
				return false;
			}
			updateselctedarry.push($(this).val());
				$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/getupdateSubcategoriesList/"+updateselctedarry,
			
			cache: false,
			success: function(data)
			{
				var items = [];
				var count=0;
			
				$('.lblsubcat').css('display','block');
				  $('.userdynasubcat').html(data); 
				
				$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); 
				 
			}
	});
			
             
		}
		else
		{
			if(updateselctedarry.length<=1)
				{
				 bootbox.alert("Please select atleast one category");
				  return false;
					
				}
			  for(var i = updateselctedarry.length - 1; i >= 0; i--) {
							
					
						
								if(updateselctedarry[i] === $(this).val()) {
								   updateselctedarry.splice(i, 1);
								}
							
			}
			
					  $.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/getupdateSubcategoriesList/"+updateselctedarry,
			
			cache: false,
			success: function(data)
			{
				var items = [];
				var count=0;
			
			
				  $('.userdynasubcat').html(data); 
				
				$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); 
				 
			}
	});
		}
		});

		
			  $(".updateprofile .dropdown_subcat input:checkbox:checked").each(function(){ updatesubsubselctedarry.push($(this).val()); });
		$('.updateprofile .dropdown_subcat .mutliSelect input[type=checkbox]').on('click', function () { 
		
	
			  if ($(this).is(':checked')) {
			  
			if(updatesubsubselctedarry.length>4)
			{
				
				bootbox.alert("Select only five subcategory");
				$(this).checked = false ;
				return false;
			}
			updatesubsubselctedarry.push($(this).val());
				$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/getupdateSubSubcategoriesList/"+updatesubsubselctedarry,
			
			cache: false,
			success: function(data)
			{
				var items = [];
				var count=0;
			
				$('.lblsubcat').css('display','block');
				  $('.userdynasubsubcat').html(data); 
				
				$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); 
				 
			}
	});
			
             
		}
	});
		
</script>