
    <div class="col-md-4 top-performer">
               		<div class="performer-text">
                  	 <span class="performer-icon">
                   	 <img src="<?php echo Router::url('/',true)?>images/performer1.png"/></span>
                 	   Top Performer
                	</div>
                    <div class="clear"></div>
					<?php
					$count=0;
				if(count($averagemedia)>0)
				{
					foreach($averagemedia as $avgmedia)
					{
						$count++;
						$starpath = $count==1? Router::url('/',true).'icons/orange-star.png':Router::url('/',true).'icons/starwhite.png';
						$usermedia_id = $avgmedia['UserMedia']['usermedia_id'];
						$category_image = $avgmedia['cat']['category_small_image'];
						if(isset($avgmedia['subcat']['category_name']))
						{
							$category_name = $avgmedia['subcat']['category_name'];
							
						}
						else if(isset($avgmedia['subsubcat']['category_name']))
						{
							$category_name = $avgmedia['subsubcat']['category_name'];
						}
						else
						{
							$category_name = $avgmedia['cat']['category_name'];
						}
					
						if(round($avgmedia[0]['avgrate']*80)>100)
						{
							$finalrate= 100;
						}
						else
						{
							$finalrate = round($avgmedia[0]['avgrate']*70);
						}
					?>

							<div class="performer-info <?php echo $count==1?'active':'';?>">
									<div class="col-md-1 playtext">
								<?php echo $count;?>
											</div>
										
									<div class="col-md-8 infotext">
										<div class="col-md-9">
												<div class="row">
												<a class="mediatitle" id="<?php echo  $usermedia_id;?>" ><?php echo $avgmedia['UserMedia']['usermedia_name'];?></a>
												</div> 
												<div class="row artistname">
												<a href="<?php echo Router::url('/',true)."users/artist/".$avgmedia['users']['user_id']; ?>"><?php 
												if($avgmedia['users']['user_display_name']!="")
												{
												echo $avgmedia['users']['user_display_name'];
												}
												else
												{
													echo  	$avgmedia['users']['user_fname'];
												}											
												?></a>
												</div>
										</div>
											
								</div>
								<div class="col-md-2">
											<img src="<?php echo Router::url('/',true)."assets/category/".$category_image;?>"/>
											</div>
											
							
							</div>
							
					 <?php
				    }
				}
				else
				{
				  echo "<div class='top-performer-screensaver'>";
					echo "<img src='".Router::url('/',true)."/assets/default/top-performer-screensaver.png'/>";
					echo "</div>";
				}?>
										 
			 </div>

<script type="text/javascript">
$(".mediatitle").on('click',function()
{
   var uploadedmediaid = $(this).attr('id');
   
				
				
				$(".gallry-details").html("");
    $('.performer-info').removeClass('active');
	$(this).parents('.performer-info').addClass('active');
	
	$('.cms-bgloader-mask').show();//show loader mask
	  $('.cms-bgloader').show(); //show loading image
   	$.ajax({ 
			type: "GET",
			url: strGlobalSiteBasePath+"users/getAvgartistmedia/"+uploadedmediaid+"/<?php echo $this->request->params['action']; ?>",
			dataType: 'json',
			data:"",
			cache:false,
			success: function(data)
			{
			
				if(data.status == "success")
				{
				
					$('.gallry-details').html(data.content);
					//$('#contact_loaded').val('1');
					$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); //show loading image
					
				}
				else
				{
					alert("fail");
				}
			}
	});
});
</script>