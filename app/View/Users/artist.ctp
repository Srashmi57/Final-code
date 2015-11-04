<script>

setCookie('currentaudio', '', 1);
console.log("Setting Cookies : currentaudio = " );
</script>
<?php 
echo $this->Html->css('bootstrap-fileupload');
echo $this->Html->script('bootstrap-fileupload');
echo $this->Html->css('bootstrap-editable');
echo $this->Html->script('bootstrap-editable.min');
echo $this->Html->script('common'); 
echo $this->Html->css('common');
echo $this->Html->script('jwplayer');
echo $this->Html->script('countartist');
?>

<?php
echo $this->Html->css('jRating.jquery');
echo $this->Html->script('jRating.jquery');

$txtfollow = $isloggedfollowed>0?'Unfollow':'Follow';

$txtlike = $isloggedlike>0?'Unlike':'Like';

$isloggedclass = $islogin>0?'':"disabled='disabled'";
$usertype_id = $arrUser_Profile['Users']['usertype_id'];
if($usertype_id==2)
		 {
			 $title= "ARTIST";
			 $artistclass = "";
			
			  $userclass = "style='display:none;'";
		 }
		 else
		 {
			 $title = "USER";
			 $artistclass = "style='display:none;'";
			  $userclass="";
		 }
		 
		 
?>


<div class="content" id="maincontent">

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="col-md-12" style="margin-bottom:20px;">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         	<?php echo $title;?> DETAILS 
        </a>
      </h4>
    </div>
   
      
        <div class="userinfo">
		
						<div class="col-md-6 artist-detail-maim">
                 <form name="frmwebuserprofpic" id="frmwebuserprofpic" method="post">
				<div class="row text-center">
                
                <div class="fileupload fileupload-new col-md-4" data-provides="fileupload">
                    <div class="fileupload-new ">
                    
                    <?php
						  $userfileimage = $arrUser_Profile['Users']['user_image'];
						 $userfileimagepath = Router::url('/', true).'assets/websiteuser/'.$userfileimage;
						if(file_exists("assets/websiteuser/".$userfileimage) && $userfileimage!="")
						{
							$imagepath = $userfileimagepath;
						}
						else
						{
							$imagepath = Router::url('/', true).'assets/default/user-icon-ap.png';
						}
                   ?>
                   <img src="<?php echo $imagepath;?>" height="170" width="170" />
				     <?php 
		
		if(trim($arrUser_Profile['Users']['user_moodmsg'])!='')
		{
		 $moodmsg = $arrUser_Profile['Users']['user_moodmsg'];?>
		 <div class="col-md-12"><?php echo $arrUser_Profile['Users']['user_moodmsg']; ?></div>
		 <?php
		}
		else
		{
			echo $moodmsg = '';
		}
		?>
                    </div>
                 
                </div>
			<div class="cms-bgloader-mask"></div>
			<div class="cms-bgloader"></div>
			
				<div class="col-md-8">
					<div class="col-md-4 row text-center follower-mar border-right"><button id="followbutton" class='btn btn-success' <?php echo $isloggedclass;?> type="button" onclick="return followartist(<?php echo $arrUser_Profile['Users']['user_id'];?>);"><?php echo $txtfollow;?></button></div>
					<div class="col-md-4 row text-center follower-mar border-right"> <button  class='btn btn-success' <?php echo $isloggedclass;?> type="button" onclick="return likeartist(<?php echo $arrUser_Profile['Users']['user_id'];?>);"> <span class="glyphicon glyphicon-thumbs-up"></span> <span id="likebutton"><?php echo $txtlike;?><span></button></div>
					
				</div>
				
				<div class="col-md-8">
				
				<div class="col-md-4 row text-center follower-mar border-right">
						<div class="col-md-12" id="followercount">
							<?php echo $followerscount; ?>
						</div>
						<div class="col-md-12">
							<ul id="navlist">
								<li><a href="javascript:void(0);"  id="listfollower"   <?php echo $followerscount>0? "onClick= 'return getfollowerslist(".$userid.")'":"";?>>Followers</a>
							
									<ul id="subnavlist">
									<?php 
									
									foreach($followersarray as $followfarray)
									{
										$user_fname = $followfarray['users']['user_fname'];
										$user_display_name = $followfarray['users']['user_display_name'];
										$user_lname = $followfarray['users']['user_lname'];
										if($user_display_name!="")
										{
											$username = $user_display_name;
										}
										else
										{
											$username = $user_fname." ".$user_lname;
										}
										$user_id = $followfarray['users']['user_id'];
										$usertype_id = $followfarray['users']['usertype_id'];
										$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';
									?>
									<li id="subactive"><a href="<?php echo $usertypehref;?>" ><?php echo $username;?></a></li>
									<?php 
									}
									echo $followerscount>count($followersarray)?"<li>and more</li>":'';
									?>
										</ul>
								</li>
							</ul>
						</div>
				</div>
				<div class="col-md-4 row text-center follower-mar border-right">
						<div class="col-md-12">
						
						<?php echo $cntArtistfollowing; ?>
						</div>
						<div class="col-md-12">
							<ul id="navlist">
								<li><a href="javascript:void(0);" <?php echo $cntArtistfollowing>0? "onClick= 'return getfollowinglist(".$userid.")'":"";?>>Following</a>
							
									<ul id="subnavlist">
									<?php 
									
									foreach($arrArtistfollowing as $arrayfollowing)
									{
										$user_fname = $arrayfollowing['users']['user_fname'];
										$user_lname = $arrayfollowing['users']['user_lname'];
										$user_display_name = $followfarray['users']['user_display_name'];
										if($user_display_name!="")
										{
											$username = $user_display_name;
										}
										else
										{
											$username = $user_fname." ".$user_lname;
										}
										$user_id = $arrayfollowing['users']['user_id'];
										$usertype_id = $arrayfollowing['users']['usertype_id'];
										$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';
									?>
									<li id="subactive"><a href="<?php echo $usertypehref;?>" ><?php echo $username;?></a></li>
									<?php 
									}
									echo $cntArtistfollowing>count($arrArtistfollowing)?"<li>and more</li>":'';
									?>
										</ul>
								</li>
							</ul>
						</div>
						</div>
						
						
						
				<div class="col-md-4 row text-center follower-mar">
					<div class="col-md-12" id="likecount">
						<?php echo $likescount; ?>
					</div>
					<div class="col-md-12">
							
							<ul id="navlist">
								<li><a href="javascript:void(0);" <?php echo $likescount>0? "onClick= 'return getlikelist(".$userid.")'":"";?>>Likes</a>
							
									<ul id="subnavlist">
									<?php 
									
									foreach($likesarray as $likeartistarray)
									{
										$user_fname = $likeartistarray['users']['user_fname'];
										$user_lname = $likeartistarray['users']['user_lname'];
										$user_display_name = $followfarray['users']['user_display_name'];
										if($user_display_name!="")
										{
											$username = $user_display_name;
										}
										else
										{
											$username = $user_fname." ".$user_lname;
										}
										$user_id = $likeartistarray['users']['user_id'];
										$usertype_id = $likeartistarray['users']['usertype_id'];
										$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';
									?>
									<li id="subactive"><a href="<?php echo $usertypehref;?>" ><?php echo $username;?></a></li>
									<?php 
									}
									echo $likescount>count($likesarray)?"<li>and more</li>":'';
									?>
										</ul>
								</li>
							</ul>
					
					
					
					</div>
					
					
				</div>
				
				</div>
             </form>
	</div>


</div>


		
	<div class="col-md-6 artist-detail-maim">
		
        
      
        <?php
         
        
         $profileUrl = Router::url(array('controller'=>'users','action'=>'myprofile'),true);?>
			
		
		
      
				<div class="col-md-12 artist-profile">
				<div class="col-md-3">Name</div>
				<div class="col-md-9"><?php echo ucfirst($arrUser_Profile['Users']['user_fname']);?> <?php echo ucfirst($arrUser_Profile['Users']['user_lname']);?></div>
			
				</div>
				<div class="col-md-12 artist-profile" <?php echo $userclass;?>>
				<div class="col-md-3">Email</div>
				<div class="col-md-3"><?php echo $arrUser_Profile['Users']['user_emailid'];?></div>
				<div class="col-md-3">Mobile Number</div>
				<div class="col-md-3"><?php echo $arrUser_Profile['Users']['user_mobileno'];?></div>
				</div>
                
                <div class="col-md-12 artist-profile" <?php echo $artistclass; ?>>
				<div class="col-md-3">Category</div>
				<div class="col-md-7">
				<?php
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
                
				<div class="col-md-12 artist-profile">
				<div class="col-md-3">Age</div>
				<div class="col-md-3">	<?php 
				
					if($arrUser_Profile['Users']['user_birth']=="0000-00-00")
					{
						$age = "";
						$birthdate="";
						
					}
					else
					{
						$now = date('Y-m-d H:i:s');
						
						$age	= $this->Caldays->GetUserAge($now,$arrUser_Profile['Users']['user_birth']);
						
						$birthdate = date('d M Y',strtotime($arrUser_Profile['Users']['user_birth']));
					}
						
					?>
					<?php echo $age;?></div>
				<div class="col-md-3">Sex</div>
				<div class="col-md-3"><?php echo ucfirst($arrUser_Profile['Users']['user_sex']);?></div>
				</div>
				<div class="col-md-12 artist-profile">
				<div class="col-md-3">Biography</div>
				<div class="col-md-6"><?php echo $arrUser_Profile['Users']['user_biography'];?></div>
				
				</div>
	 

	</div>

	<div class="clear"></div>
	</div>
	</div>

</div>


<div class="artistupload">


<?php
if(count($artistmediaDetails)>0)
{?>
	<div class="col-md-8 media-details">
		
		
		
		<?php echo $this->element('view_artist_details'); ?>
			
	
		
		
	</div>
<?php
}
	if(count($uploadedmediadata)>0)
	{?>

	<div class="col-md-4 top-performer">
					  <div class="top-performer-text">
                  	 <span class="performer-icon">
                   	 <img src="<?php echo Router::url('/',true)?>images/performer.png"/></span>
                 	  Artist Chart
                	</div>
					 <?php 
					 $count=0;
					$retmediarating=0;
						$mediarating_id=0;
			
					 foreach($uploadedmediadata as $mediadata)
					 {
					 
					  $usermedia_id = $mediadata['UserMedia']['usermedia_id'];
					  $usermedia_path = Router::url('/', true).$mediadata['UserMedia']['usermedia_path'];
					  $usermedia_title = $mediadata['UserMedia']['usermedia_title'];
					  $usermedia_name = $mediadata['UserMedia']['usermedia_name'];
					  $usermedia_type = $mediadata['UserMedia']['usermedia_type'];
					  $arraymediatype = explode('/',$usermedia_type);
						 $retuser_id = $mediadata['UserMedia']['user_id'];
						
						//media rating 
					 $mediadata['0']['avgrate'];
						
						$count++;
						$retmediarating=0;
						if(count($mediadata['children'])>0)
						{
										
							$retmediarating = $mediadata['children']['0']['media_rating'];
							$retmediarating = $retmediarating>0?$retmediarating:0;
							$mediarating_id = $mediadata['children']['MediaRating']['mediarating_id'];
						}
						if(($islogin>0)&&($retuser_id==$islogin))
						{
							$isDisabled=1;
							$votedisable='true';
						}
						else if(($islogin>0)&&$retmediarating>0)
						{
							$isDisabled=1;
							$votedisable=false;
						}
						else if($islogin>0)
						{
							$isDisabled=0;
							$votedisable=false;
						}
						else
						{
							$isDisabled=1;
							$votedisable='true';
						}
						if(round($mediadata[0]['avgrate']*70)>100)
						{
							$finalrate = 100;
						}
						else
						{
							$finalrate = round($mediadata[0]['avgrate']*70);
						}
						
					?>
						  <div class="performer-info">
						 
							  <div class="col-md-1 play">
							   <a  class="artistmediatitle" id="<?php echo  $usermedia_id;?>">
							   <?php echo $count;?>
							  </a>
								 </div>
								 <div class="col-md-7 infotext">
								 <div class="col-md-9">
									<div class="row">
										<a class="artistmediatitle" id="<?php echo  $usermedia_id;?>" ><?php echo  $usermedia_name;?></a>
									 </div>
								 </div>
								
								</div>
								 <div class="col-md-3 rating">
								<div id="jRate<?php echo $usermedia_id;?>" <?php echo $isloggedclass; ?> data-average="<?php echo $finalrate;?>" data-id="<?php echo $mediarating_id;?>">
								<script type="text/javascript">
								var umid =  <?php echo $usermedia_id?>;
								var checkvariable=0;
								var login = <?php echo $islogin>0?1:0?>;
								 if(login==0)
											{
									 $("#jRate<?php echo $usermedia_id;?>").jRating({
									  step:false,
									  length : 5,
									  nbRates : 3,
									   bigStarsPath:'<?php echo Router::url('/',true);?>icons/stars.png',
									  showRateInfo:false,
									  
									  canRateAgain : false,
									 onClick : function(element,rate) {
										bootbox.alert('Please login to do rate');
										}	
									});
											}
											else
											{
												 $("#jRate<?php echo $usermedia_id;?>").jRating({
													  step:true,
													  length : 5,
													  phpPath:'<?php echo Router::url('/',true);?>users/saveuserrating/'+umid+'/'+checkvariable,
													  nbRates : 3,
													  sendRequest:false,
													   bigStarsPath:'<?php echo Router::url('/',true);?>icons/stars.png',
													  showRateInfo:false,
													  canRateAgain : true,
													  isDisabled:'<?php echo $votedisable;?>',
													  onClick:function(element,rate){
													
													 	
													var isDisabled  = <?php echo $isDisabled?>;
													
													if(isDisabled>0)
													{
													
													bootbox.confirm("New vote will outcast their earlier vote?", function(result) {
													
													if(result){
													$.ajax({
															url: '<?php echo Router::url('/',true);?>users/saveuserrating/<?php echo $usermedia_id;?>',
															type: 'post',
															 data: {'rate': rate},
															 dataType:'json',
															success: function (data) {
															bootbox.alert(data.message)
															}
														});
													}
												}); 
													}
													else
													{
													
													$.ajax({
															url: '<?php echo Router::url('/',true);?>users/saveuserrating/<?php echo $usermedia_id;?>',
															type: 'post',
															 data: {'rate': rate},
															 dataType:'json',
															success: function (data) {
															bootbox.alert(data.message)
															}
														});
													}									
																							 
													  },
														onSuccess : function(data){
													  
															alert(data.message)
														  },
														  onError : function(){
															alert('Error : please retry');
														  }
													});
									}
									
									
								
				</script>
								</div>
								<div class="clear"></div>
								
							  </div>
							 </div>
						 
						   <?php 
						   }?>
						   
						 </div>

	<?php
	}?>
					 </div>
		</div>	
</div>		
			<script>
			 function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
	console.log(getCookie("currentaudio"));
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

</script>	
 <div class="recentupload wow fadeInUp">
	<p>RECENT UPLOADS</p>
</div>

 <div class="recentgallery">
			
			 <ul class="thumbnails" > 
			 <?php echo $this->element('recentuploads'); ?>
			 </ul>
	</div>
 </div>	
<script type="text/javascript">
$(".artistmediatitle").on('click',function()
{
   var uploadedmediaid = $(this).attr('id');
   $('.cms-bgloader-mask').show();//show loader mask
	  $('.cms-bgloader').show(); //show loading image
   	$.ajax({ 
			type: "GET",
			url: strGlobalSiteBasePath+"users/getartistmedia/"+uploadedmediaid+"/<?php echo $showedit;?>",
			dataType: 'json',
			data:"",
			cache:false,
			success: function(data)
			{
			 $('.cms-bgloader-mask').hide();//show loader mask
	  $('.cms-bgloader').hide(); //show loading image
				if(data.status == "success")
				{
			
					
					$('.tabloader').hide();
					$('.media-details').html(data.content);
					//$('#contact_loaded').val('1');
				}
				else
				{
					alert("fail");
				}
			}
	});
});


function fnaddComment(user_mediaid)
{
	 $('.cms-bgloader-mask').show();//show loader mask
	  $('.cms-bgloader').show(); //show loading image
	$.ajax({ 
			type: "GET",
			url: strGlobalSiteBasePath+"users/getartistmedianame/"+user_mediaid,
			dataType: 'json',
			data:"",
			cache:false,
			success: function(data)
			{
				 $('.cms-bgloader-mask').hide();//show loader mask
	  $('.cms-bgloader').hide(); //show loading image
				if(data.status == "success")
				{
				
			
					$("#artistmediatitle").text(data.content);
					$("#usermediaid").val(user_mediaid);
					$("#txtcomment").val('');
					$("#commentmodal").modal('show');
				}
				else
				{
					alert("fail"); 
				}
			}
	});
	

}

</script>
<?php echo $this->element('commentmodal');?>
<?php echo $this->Html->script('modal'); ?>
<?php echo $this->element('mainmodallogin'); ?>
<?php echo $this->element('userLogin'); ?>
<?php echo $this->element('artistLogin'); ?>
<?php echo $this->element('forgotpass'); ?>
<?php echo $this->element('changepass'); ?>
<?php echo $this->element('artistregister'); ?>
<?php echo $this->element('userregister'); ?>
<?php echo $this->element('mainmodalregister'); ?>
<?php echo $this->element('followermodel'); ?>
<?php echo $this->element('followingmodel'); ?>
<?php echo $this->element('likemodel'); ?>
<?php echo $this->element('updatecommentmodal'); ?>