

 <script>
$(document).ready(function(){
	$("[rel^='lightbox']").prettyPhoto();
	//document.cookie = "currentaudio = ;";
 });
</script>

<?php 
	$flashplayerpath = Router::url('/', true)."js/jwplayer/player.swf";
	
	foreach($recentmedia as $mediarecent )	
	{			
		$days=0;
		$usermedia_id = $mediarecent['UserMedia']['usermedia_id'];
		$user_id = $mediarecent['UserMedia']['user_id'];
		$usermedia_path = Router::url('/', true).$mediarecent['UserMedia']['usermedia_path'];
		$thumbnail_path = Router::url('/', true)."files/medium/".$user_id."/".$mediarecent['UserMedia']['usermedia_title'];
		$vid_thumbnail_path = Router::url('/', true).$mediarecent['UserMedia']['video_thumbnail'];
		$usermedia_title = $mediarecent['UserMedia']['usermedia_title'];			
		$usermedia_name = $mediarecent['UserMedia']['usermedia_name'];
		$usermedia_type = $mediarecent['UserMedia']['usermedia_type'];
		$arraymediatype = explode('/',$usermedia_type);
		$userfname = $mediarecent['users']['user_fname'];
		$usermedia_date = $mediarecent['UserMedia']['usermedia_date'];
		$coverid = $mediarecent['UserMedia']['cover_id'];
		$categoryname = $mediarecent['category']['category_name'];
		$susubcategoryname = $mediarecent['subsubcategory']['subsubcategory_name'];
		$imageusermedia_path = $thumbnail_path;
		if($coverid>0)
		{
			//$imageusermedia_path = Router::url('/', true).$mediarecent['children']['UserMedia']['usermedia_path'];
			$thumbnail_path = Router::url('/', true)."files/medium/".$user_id."/".$mediarecent['children']['UserMedia']['usermedia_title'];
			$imageusermedia_path = $thumbnail_path;
			
			$pdfdefault = $thumbnail_path;
			 $audioimagepath = Router::url('/', true)."files/".$user_id."/".$mediarecent['children']['UserMedia']['usermedia_title'];;
			 $vid_thumbnail_path = Router::url('/', true)."files/".$user_id."/".$mediarecent['children']['UserMedia']['usermedia_title'];;
			$worddefault = $thumbnail_path;
			$thumbnail_path =Router::url('/', true)."files/medium/".$user_id."/".$mediarecent['UserMedia']['usermedia_title'];
		}
		else
		{
			$imageusermedia_path = $thumbnail_path;
			$audioimagepath = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.jpg";
			$pdfdefault = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.jpg";
			$worddefault = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.jpg";
		}
		
		$ext = pathinfo($mediarecent['UserMedia']['usermedia_title'], PATHINFO_EXTENSION);
		$audioextarray = array('mp3','wav','aiff','flac','MP3','WAV','AIFF','FLAC','m4a','M4A','f4a','F4A','aac','AAC','ogg','OGG','oga','OGA');
			$videoextarray = array('mp4','wav','mkv','flv','WAV','avi','3gp','MP4','MKV','FLV','AVI','3GP','mov','MOV','m4v','f4v','M4V','F4V','WebM','webm');
		$imageextarray = array('jpeg','jpg','png','JPEG','JPG','PNG','gif','GIF');
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
		$now = date('Y-m-d H:i:s');		
		$days	= $this->Caldays->checkdates($now,$usermedia_date);				
		$userlname = $mediarecent['users']['user_lname'];		
		if($mediarecent['users']['user_display_name']!="")
		{
			$username = $mediarecent['users']['user_display_name'];
		}
		else
		{
			$username = $userfname." ".$userlname;
		}
		$retuser_id = $mediarecent['users']['user_id'];	

		$loggeduserid = $this->Session->read('Auth.WebsitesUser.user_id');		
		?>
		<li class="col-md-3">
			<?php
			switch($mediatype)
			{
				case "image":
					?>
					     <a rel="lightbox[group]" href="<?php echo $thumbnail_path;?>"><img class="group1" src="<?php echo $imageusermedia_path;?>" title="Image Title"  style="height:210px;width:100%;"/></a>
					<?php
				break;	
				case "audio": 
				case "video":	
				$usermedia_path = Router::url('/', true).$mediarecent['UserMedia']['usermedia_path'];
				if($mediatype=="video")
					{
					  $audioimagepath = $vid_thumbnail_path;
					}
					
					?>	
					<div id='indexhome<?php echo $usermedia_id;?>' class='audiocheck'>Loading the player...</div>	
					<script type='text/javascript'>
						var playerInstance1 = jwplayer('indexhome<?php echo $usermedia_id;?>');
						
						playerInstance1.setup({
							flashplayer: '<?php echo $flashplayerpath;?>',
							file:'<?php echo $usermedia_path;?>',				
							'dock': 'false',
							'width': '100%', 'height': '100%',					 
							aspectratio: "4:3",
							image:'<?php echo $audioimagepath;?>',
							class:'thumbnail audiocheck',
							hide: true,
							'plugins': { 'viral-2': {'oncomplete':'False','onpause':'False','functions':'All'} }				  
						});
						playerInstance1.onPlay(function(e) {
							//alert('<?php echo $usermedia_id;?>');		
							var audioFile = getCookie("currentaudio");
							//alert(audioFile);
							if (audioFile != "" && audioFile !='indexhome<?php echo $usermedia_id;?>') {
								//alert('yes pause previous');
							//	alert(audioFile.indexOf("indexhome"));
							
								
									
								 
								 
									jwplayer(audioFile).pause();
								 
								
								
								
							//	alert('paused');
							}
							//document.cookie = 'currentaudio=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';	
							//setCookie("currentaudio", "<?php echo $usermedia_id;?>", 365);
							var cookieVal='indexhome<?php print($usermedia_id);?>';
							setCookie('currentaudio', cookieVal, 365);
							console.log("Setting Cookies : currentaudio = <?php echo $usermedia_id;?>" );
						});				
					</script>						
					<?php
				break;	
				case "pdf":  
					$url = Router::url('/', true).'websites/pdfReader/'.$usermedia_id;
					?>				
						<a href="<?php echo $url;?>"  target="_blank"><img src="<?php echo $pdfdefault;?>" style="height:210px;width:100%;" /></a> 
					<?php
				break;
				case "word": 
					?>
						<a target="_blank" href="http://docs.google.com/viewer?url=<?php echo $usermedia_path;?>"  ><img src="<?php echo $worddefault;?>" style="height:210px;width:100%;" /></a>
					<?php	
				break;
			}		
			?>				
			<div class="gallerytext">
				<div class="medianame">
					<?php 
						echo $this->Html->link($usermedia_name, array('controller'=>'users','action' => "art", $usermedia_id), array( 'id'=>'msg-name', 'escape' => false)); ?> <div class="pull-right"><?php echo $categoryname;?> <?php if($susubcategoryname!=""){echo " - <span class='subsubcat_name'>".$susubcategoryname."</sapn>";}?></div> &nbsp;
						
					<?php 
if($loggeduserid>0)
{					
						echo $this->Html->link(
						   $this->Html->tag('i', '', array('class' => 'fa fa-comments fa-1x')) ,
						   array('controller'=>'users','action' => 'artist',$retuser_id),
						   array('class' => 'button_class button comment_class', 'escape' => false)
						);
}
else
{
?>

<?php
			 echo $this->Form->button('<i class="fa fa-comments fa-1x"></i>', array('type'=>'button','onclick'=>"javascript:bootbox.alert('You need to login, to give comment');",'name'=>'comment', 'escape' => false)); 

			 ?>
			 
			 			 <?php

					
}

					?>
				</div>	
				<div class="socialmedia">
					<?php 
						echo $this->Html->link($username, array('controller'=>'users','action' => "artist", $retuser_id), array( 'id'=>'msg-name', 'escape' => false)); 
					?>
					<div class="social-network pull-right">
						<?php echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class', 'id'=>'facebook','value'=>'socialfacebook'.$usermedia_id, 'escape' => false)); 
						$strFURL = "https://www.facebook.com/sharer.php?u=".$usermedia_path."&t=".$usermedia_name."";
						echo $this->Form->hidden('',array('id'=>'socialfacebook'.$usermedia_id.'_process_url', 'value'=>$strFURL));
						?>
						<?php							
							echo $this->Form->button('<i class="fa fa-linkedin fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'linkedin','value'=>'sociallinkedin'.$usermedia_id)); 
							$strFURL = "http://www.linkedin.com/shareArticle?mini=true&url=".$usermedia_path."";
							echo $this->Form->hidden('',array('id'=>'sociallinkedin'.$usermedia_id.'_process_url', 'value'=>$strFURL));
													
						?>
						<?php							
							echo $this->Form->button('<i class="fa fa-google-plus fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'gmail', 'value'=>'socialgmail'.$usermedia_id)); 
							$strFURL = "https://plus.google.com/share?url=".$usermedia_path."&hl=en";
							echo $this->Form->hidden('',array('id'=>'socialgmail'.$usermedia_id.'_process_url', 'value'=>$strFURL));
						?>					
						<?php							
							echo $this->Form->button('<i class="fa fa-twitter fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'twitter', 'value'=>'socialtwitter'.$usermedia_id)); 
							$strFURL = "http://www.twitter.com/share?url=".$usermedia_path."&text=".$usermedia_name."";
							echo $this->Form->hidden('',array('id'=>'socialtwitter'.$usermedia_id.'_process_url', 'value'=>$strFURL));												
						?>					
					</div>
					<div class="publish-date"><?php echo $days; ?> </div>
				</div>
			</div>
		</li> <!--end thumb -->
		<?php
	}
?>