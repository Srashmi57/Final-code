<?php 
	$count=0;
	$retmediarating=0;
	$mediarating_id=0;			
	$isloggedclass = $islogin>0?'':"disabled='disabled'";
	$cmtclass = $islogin>0?'':"display:none";
	if(count($artistmediaDetails)>0)
	{
		$category_name = $artistmediaDetails[0]['cat']['category_name'];
		$retuser_id = $artistmediaDetails[0]['UserMedia']['user_id'];
		$pdfdefault = Router::url('/', true)."assets/default/pdf-gallery-thumb.png";
		$worddefault = Router::url('/', true)."assets/default/word_thumb.png";
		$retcover_id = $artistmediaDetails[0]['UserMedia']['cover_id'];
		$imageusermedia_path = Router::url('/', true).$artistmediaDetails[0]['UserMedia']['usermedia_path'];
		$retuser_id = $artistmediaDetails[0]['UserMedia']['user_id'];
		if($retuser_id==$islogin)
		{
			$likedisable="style='display:none;'";
		}
		else
		{
			$likedisable="";
		}
		if($retcover_id>0)
		{
			$imageusermedia_path = Router::url('/', true).$artistmediaDetails[0]['usermedia_cover']['usermedia_path'];
			$thumbnail_path = Router::url('/', true)."files/medium/".$retuser_id."/".$artistmediaDetails[0]['usermedia_cover']['usermedia_title'];
			$imagepath = $thumbnail_path;
			$pdfdefault = $thumbnail_path;
			$worddefault = $thumbnail_path;
		}
		else
		{
			$imagepath = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default.png";
			$pdfdefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default.png";
			$worddefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default.png";
			$thumbnail_path = Router::url('/', true)."files/large/".$retuser_id."/".$artistmediaDetails[0]['UserMedia']['usermedia_title'];
			$imageusermedia_path = Router::url('/', true).$artistmediaDetails[0]['UserMedia']['usermedia_path'];
		}			
		if(($islogin>0)&&($retuser_id==$islogin))
		{
			$medialikestatus = "disabled='disabled;'";
		}
		else if($islogin>0)
		{
			$medialikestatus='';
		}
		else
		{
			$medialikestatus="disabled='disabled;'";
		}
		if(($islogin>0)&&($retuser_id==$islogin))
		{
			$isDisabled=1;
			
			$votedisable='true';
		}
		else if(($islogin>0)&&$viewmediarateing>0)
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
		?>
		<div class="col-md-12">
			<div id="video-tag">
				<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_name'];?>(<?php echo $category_name;?>)
				<?php 
					$flashplayerpath = Router::url('/', true)."js/jwplayer/player.swf";
				?>
				<div id="jRate_index<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id'];?>" <?php echo $isloggedclass; ?> data-average="<?php echo $viewmediarateing;?>" data-id="<?php echo $viewmediarateid;?>" class="jRate_index">
					<script type="text/javascript">
						var umid =  <?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id']?>;
						var login = <?php echo $islogin>0?1:0?>;
						if(login==0)
						{
							$("#jRate_index<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id'];?>").jRating({
								step:false,
								length : 5,
								nbRates : 3,
								bigStarsPath:'<?php echo Router::url('/',true);?>icons/whitestar.png',
								showRateInfo:false,
								canRateAgain : false,
								onClick : function(element,rate) {
									bootbox.alert('Please login to do rate');
								}	
							});
						}
						else
						{		
							$("#jRate_index<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id'];?>").jRating({
								step:true,
								length : 5,
								phpPath:'<?php echo Router::url('/',true);?>users/saveuserrating/'+umid,
								nbRates : 3,
								sendRequest:false,
								bigStarsPath:'<?php echo Router::url('/',true);?>icons/whitestar.png',
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
													url: '<?php echo Router::url('/',true);?>users/saveuserrating/<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id'];?>',
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
											url: '<?php echo Router::url('/',true);?>users/saveuserrating/<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id'];?>',
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
				<?php 	
					$ext = pathinfo($artistmediaDetails[0]['UserMedia']['usermedia_title'], PATHINFO_EXTENSION);
					$audioextarray = array('mp3','wav','aiff','flac','MP3','WAV','AIFF','FLAC');
					$videoextarray = array('mp4','mkv','flv','avi','3gp','MP4','MKV','FLV','AVI','3GP');
					$imageextarray = array('jpeg','jpg','png','JPEG','JPG','PNG',);
					$pdfarray = array('pdf','PDF');
					$docxarray = array('docx','doc','DOCX','DOC');
					if (in_array($ext, $audioextarray))
					{
					   $mediatype = 'audio';
					}
					else if (in_array($ext, $videoextarray))
					{
					   $mediatype = 'video';
					}
					else if (in_array($ext, $imageextarray))
					{
					   $mediatype = 'image';
					}
					else if (in_array($ext, $pdfarray))
					{
					   $mediatype = 'pdf';
					}
					else if (in_array($ext, $docxarray))
					{
					   $mediatype = 'word';
					}				
					switch($mediatype)
					{
						case "image":
							?>  
								<a class="thumbnail" rel="lightbox[group]" href="<?php echo $imageusermedia_path;?>"><img class="group1" src="<?php echo $thumbnail_path;?>" title="Image Title" /></a>
							<?php
						break;						 
						case "pdf": 
							$url = Router::url('/', true).'websites/pdfReader/'.$usermedia_id;
							?>
								<a href="<?php echo $url;?>" class="thumbnail" target="_blank"><img src="<?php echo $pdfdefault; ?>" /></a> 
							<?php	
						break;
						case "word":  
							?>
								<a href="http://docs.google.com/viewer?url=<?php echo $worddefault;?>" class="thumbnail" target="_blank"><img src="<?php echo Router::url('/', true);?>assets/default/word-gallery-thumb.png" /></a> 
							<?php	
						break;
						case "audio": 
							?>	
					<div id='testindexaudio' style="position: relative; height: 170px;">Loading the player...</div>	
					
			<script type="text/javascript">
					jwplayer('testindexaudio').setup({
					  flashplayer: '<?php echo $flashplayerpath;?>',
					  file:'<?php echo Router::url('/',true).$artistmediaDetails[0]['UserMedia']['usermedia_path'];?>',
					  height: 247,
					  width:400,
					  image:'<?php echo $imagepath;?>',
					  class:'thumbnail',
					   hide: true,
					  'plugins': { 'viral-2': {'oncomplete':'False','onpause':'False','functions':'All'} }
					   })

					</script>					
				<?php
					break;
					case "video":
							$oembed_endpoint = 'http://vimeo.com/api/oembed';
							$video_url = $artistmediaDetails[0]['UserMedia']['usermedia_path'];

							$json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width=100%%&height=100%';
							$xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url) . '&width=100%%&height=100%';
							if(@file_get_contents($json_url))
							{
								App::import('Controller', 'App');
							$AppCont = new AppController;
							// Load in the oEmbed XML
							$oembed = simplexml_load_string($AppCont->curl_get($xml_url));
							
								echo html_entity_decode($oembed->html) ;
						
							}
							else
							{							 
								?>
									<a href="javascript:void(0);" class="thumbnail" target="_blank"><img src="<?php echo Router::url('/', true);?>assets/default/video-gallery-thumb.png" /></a> 
								<?php
							}
							break;	
								
							}
							?>
								
                              
                    </div>
                            <div class="col-md-12 comment-section">
							   <div class="media"><a class="media-left" href="#"><img src="<?php echo Router::url('/',true)?>images/chat-icon.png" alt="..."></a>
                                		<div class="media-body">
                                			<h4 class="media-heading">Comments <div class="likemedia_new" <?php echo $likedisable;?> >
						<button   onclick="<?php echo $islogin>0?'return likemedia('.$artistmediaDetails[0]['UserMedia']['usermedia_id'].');':"bootbox.alert('Please Login to do like');"?>" type="button" class="btn btn-success" > <span class="glyphicon glyphicon-thumbs-up"></span> <span id="likemediabutton"> <?php echo $mediatext;?></span></button>
					  </div></h4>
                                	</div>
									
									<div class="media row" id="addcomment" style="<?php echo $cmtclass;?>">
	   	 <form name="frmartistcomment" id="frmartistcomment" method="post">

								<div class="form-group">
								
								<div class="col-sm-12">
							<textarea name="txtcomment" id="txtcomment" class="form-control validate[required]" rows="3"></textarea>
							<input type="hidden" name="usermediaid" id="usermediaid" value="<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id']?>"/>
								</div> 
								</div>
						
			<div class="col-md-3 pull-right">
			
			  
							  <button type="submit" class="btn btn-success" onclick="return fnsavecomment();" id="addItem">SUBMIT</button>
				 
			
      </div>	
	 </form>
	 </div>
                                </div>
                              <?php
	foreach($artistmediaDetails['children'] as $usercomments)
	{
	$usercomment = $usercomments['MediaComment']['usermedia_comment'];
	$mediacomment_id = $usercomments['MediaComment']['mediacomment_id'];
	$retusertype_id = $usercomments['Users']['usertype_id'];
	$retuser_id = $usercomments['Users']['user_id'];
	 $user_image = $usercomments['Users']['user_cropped_image'];
	 $user_fname = $usercomments['Users']['user_fname'];
	 $user_lname = $usercomments['Users']['user_lname'];
	 $user_display_name = $usercomments['Users']['user_display_name'];
	 if($user_display_name!="")
	 {
		$displayname = $usercomments['Users']['user_display_name'];
	 }
	 else
	 {
		$displayname =  $user_fname." ".$user_lname;
	 }
	 
	 
	 
	$user_imagepath = "assets/websiteuser/".$user_image;
	if(file_exists($user_imagepath)&&$user_image!='')
	{
	  $retuser_imagepath =  Router::url('/',true).$user_imagepath;
	  $imagecircle='img-circle';
	}
	else
	{
		$retuser_imagepath =  Router::url('/',true)."images/user-comment.png";
		 $imagecircle = '';
	}
	if($retusertype_id==2)
	{
	   $link= Router::url('/',true)."users/artist/".$retuser_id;
	}
	else
	{
		$link="javascript:void(0)";
	}
		?>
	<div class="media col-md-12" id="comment<?php echo $mediacomment_id;?>">
				<a href="<?php echo $link;?>" class="media-left"><img alt="..." src="<?php echo $retuser_imagepath;?>" height="25px" width="28px" class="<?php echo $imagecircle; ?>"></a>
				
                  	<div class="media-body">
                           <h4 class="media-text"><?php echo $usercomment;?></h4>
						  
						   <?php
						   if($retuser_id == $islogin)
						   {?>
							<p><span class="pull-left" <?php echo $isloggedclass;?>><a onClick="return deletecomment(<?php echo $mediacomment_id;?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>&nbsp;<a  href="javascript:void(0);" onClick="return updatecomment(<?php echo $mediacomment_id;?>);"><i class="fa fa-edit"></i></a></span><a href="<?php echo $link;?>"></a></p>
						   <?php
						   }?>
						   <span class='pull-right'><a href="<?php echo $link;?>"><?php echo $displayname; ?></a></span>
                	</div>
		</div>
				  <?php
	}
	?>
                                </div>
                                
                                 
    </div>
	<?php
	}
	else
	{
	 echo "<div class='video--player-screensaver'>";
    echo "<img src='".Router::url('/',true)."/assets/default/video--player-screensaver.png'/>";
    echo "</div>";
	}?>
                            
                           
                            
                            
      
                     
                  
