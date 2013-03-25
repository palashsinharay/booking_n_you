<?php 
$user_session_info = $this->session->userdata('LOGGEDIN_USER');
?>
     
     <!--CONTENT SECTION START-->
     	<div id="content">
          	<div class="page_nav">
               		<p><a href="index.php"><?=$LANG['You are here']== NULL?'You are here':$LANG['You are here']?>:&nbsp;&nbsp;<a href="index.php"><?=$LANG['Home']== NULL?'Home':$LANG['Home']?></a><img src="images/arrow2.png" alt="" /><a href="<?php echo base_url().'user/my_account_home/';?>"><?=$LANG['My Account']== NULL?'My Account':$LANG['My Account']?> </a></p>
               </div>
          	<!--LEFT PANEL START-->
               	<div class="left_panel_02">
                    	<div class="blue_box">
                         	<div class="inner_nav">
                              	<ul>
	                                   	<li><img src="images/icon_10.png" alt="" /> <a href=<?php echo base_url().'user/my_account_home/';?>><?=$LANG['Home']== NULL?'Home':$LANG['Home']?></a></li>
                                        <li><img src="images/icon_11.png" alt="" /> <a href="<?php echo base_url().'user/my_booking_list';?>"><?=$LANG['My Booking']== NULL?'My Booking':$LANG['My Booking']?></a></li>
                                        <li class="select"><img src="images/icon_27.png" alt="" /> <a href="<?php echo base_url().'user/my_review_list';?>"><?=$LANG['My Review']== NULL?'My Review':$LANG['My Review']?></a></li>
                                        <li><img src="images/icon_12.png" alt="" /> <a href="<?php echo base_url().'user/my_account_my_info';?>"><?=$LANG['My Account']== NULL?'My Account':$LANG['My Account']?></a></li>
                                        <li><img src="images/icon_13.png" alt="" /> <a href="<?php echo base_url().'user/sign_out/';?>"><?=$LANG['Sign Out']== NULL?'Sign Out':$LANG['Sign Out']?></a></li>
                                   </ul>
                              </div>
                         </div>
                    </div>
               <!--LEFT PANEL END-->
			<script type="text/javascript">
			$(document).ready(function() {
			$('.review_tab_cont').filter(':gt(0)').hide();
			$('.review_tabing li')
				.unbind('click')
				.click(function () {
					var index = $('.review_tabing li').index($(this));
					$('.review_tab_cont').hide();
					$('.review_tab_cont').filter(':eq(' + index + ')').show();
				});
			});
			</script>
               <!--RIGHT PANEL START-->
               	<div class="right_panel_02">
                    	<div class="inner">
                         	<div class="inner_heading">
                              	<div class="left_part"><?php echo $LANG['My Review']== NULL?'My Review':$LANG['My Review'] ;?>
                                <?php 
                                if($this->session->flashdata('message')){
                                    echo '<span style="color:green; font-size:14px; padding-left:15px;">'.$this->session->flashdata('message').'</span>'; }                                
                                if($this->session->flashdata('error')){
                                    echo '<span style="color:red; font-size:14px; padding-left:15px;">'.$this->session->flashdata('error').'</span>'; }
                                ?>
                                </div>
                                   <div class="right_part"><a href="<?php echo base_url().'user/sign_out/';?>"><img src="images/icon_03.png" alt="" /> <?=$LANG['Sign Out']== NULL?'Sign Out':$LANG['Sign Out']?></a></div>
                                   <div class="clr"></div>
                              </div>
                              <div class="inner_cont">
                              	<div class="review_tabing">
                                   	<ul>
                                        	<li><img src="images/icon_30.png" alt="" /> <a href="javascript:void(0)">(<?php echo $booked_records;?>) <span><?=$LANG['Hotel']== NULL?'Hotel':$LANG['Hotel']?></a></span></a></li>
                                             <li><img src="images/icon_29.png" alt="" /> <a href="javascript:void(0)">(<?=$reviewed_records?>)<span><?=$LANG['Review']== NULL?'Review':$LANG['Review']?></span></a></li>
                                             <li><img src="images/icon_28.png" alt="" /><a href="javascript:void(0)">(<?php echo $booked_records - $reviewed_records; ?>)<span><?=$LANG['To Be reviewed']== NULL?'To Be reviewed':$LANG['To Be reviewed']?></span></a></li>
                                        </ul>
                                         <div class="clr"></div>
                                   </div>
                                   
                                   <div class="review_tab_cont">
                                   	<div class="place_box">
<?php 
if(!empty($pageDetails)){
foreach ($pageDetails as $row) {
?>                                       
									   
									   <div class="box_row">
                              				<div class="cell_01"><a href="<?php echo base_url().'hotel-details/'.$row['hotel_id'].'/'.str_replace(" ","-",mb_strtolower($row['name'], 'UTF-8'));?>">
                                            
                                           <?php if(!empty($row['thumbnail_url'])){?>
                                            <img src="<?php echo $row['thumbnail_url']; ?>" alt="" width="40" height="40" />
                                           <?php }else{?>
                                            <img src="<?php echo base_url() ?>images/no_image_thumb.jpg" alt="" width="40" height="40" />
                                            <?php }?>
                                            </a></div>
                                                  <div class="cell_02">
                                                       <h4 style="display: inline-block;"><div id="link_div"><a href="<?php echo base_url().'hotel-details/'.$row['hotel_id'].'/'.str_replace(" ","-",mb_strtolower($row['name'], 'UTF-8'));?>" id="hotel_link" ><?php echo $row['name'];?></a></div> 
                                                       <img src="images/<?=$row['star_rating']?>_stars.png" alt="" /></h4>
                                                       <!--<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="images/icon_02.png" alt="" /></div>-->
										<?php if(getBookingTime($row['hotel_id'])!=""){ ?>
										<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>:  <?php 
										echo getBookingTime($row['hotel_id']); ?> ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
										<?php } ?>													   
                                                      <!-- <div class="discrip">There are 10 people looking at this hotel.</div>-->
                                                  </div>
                                                  <div class="cell_03">
                                                       <?php  echo $row['currency']." ".$row['rate'];  ?>
                                                       
                                                  <?php if($row['review_score'] == NULL){ ?>
                                                       <span><a href="javascript:void(0);" onclick="show_dialog_review('post_review_box', '<?=$row['hotel_id']?>')" id="my_review_link">Post Review</a></span> 
                                                   <?php } ?>    
                                                  </div>
                              			</div>
                                         <div><ul class="pagination"><?php echo $pagination;?></ul></div>

<?php 
}
}else{
 echo $LANG['No Records Found']== NULL?'No Records Found':$LANG['No Records Found']; 
}
?>&nbsp;!
                                             
<!--                                             <div class="box_row">
                                                  <div class="cell_01"><a href="hotel_details.html"><img src="images/img_02.jpg" alt="" /></a></div>
                                                  <div class="cell_02">
                                                       <h4><a href="hotel_details.html">Radisson Blu Portman</a> <img src="images/rating_star.png" alt="" /></h4>
                                                       <p>Score from 160 reviews: Very good, 8.1 <img src="images/icon_01.png" alt="" /></p>
                                                       <div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="images/icon_02.png" alt="" /></div>
                                                       <div class="discrip">There are 10 people looking at this hotel.</div>
                                                  </div>
                                                  <div class="cell_03">
                                                       <span>from</span>
                                                       US$ 171.84
                                                  </div>
                                             </div>
                                             
                                             <div class="box_row">
                                                  <div class="cell_01"><a href="hotel_details.html"><img src="images/img_03.jpg" alt="" /></a></div>
                                                  <div class="cell_02">
                                                       <h4><a href="hotel_details.html">Best Western Premier </a> <img src="images/rating_star.png" alt="" /></h4>
                                                       <p>Score from 160 reviews: Very good, 8.1 <img src="images/icon_01.png" alt="" /></p>
                                                       <div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="images/icon_02.png" alt="" /></div>
                                                       <div class="discrip">There are 10 people looking at this hotel.</div>
                                                  </div>
                                                  <div class="cell_03">
                                                       <span>from</span>
                                                       US$ 85.02
                                                  </div>
                                             </div>
-->                                             
                                        </div>
                                        
                                        <div class="clr"></div>
                                        
                                   </div>
                                   <div class="review_tab_cont">
                                  		<div class="place_box">
<?php 
if(!empty($pageDetails)){
foreach ($pageDetails as $row) {
     if($row['review_score'] != NULL){
?>                                       
                                       
                                       <div class="box_row">
                                              <div class="cell_01"><a href="<?php echo base_url().'hotel-details/'.$row['hotel_id'].'/'.str_replace(" ","-",mb_strtolower($row['name'], 'UTF-8'));?>">
                                            
                                           <?php if(!empty($row['thumbnail_url'])){?>
                                            <img src="<?php echo $row['thumbnail_url']; ?>" alt="" width="40" height="40" />
                                           <?php }else{?>
                                            <img src="<?php echo base_url() ?>images/no_image_thumb.jpg" alt="" width="40" height="40" />
                                            <?php }?>
                                            </a></div>
                                                  <div class="cell_02">
                                                       <h4 style="display: inline-block;"><div id="link_div"><a href="<?php echo base_url().'hotel-details/'.$row['hotel_id'].'/'.str_replace(" ","-",mb_strtolower($row['name'], 'UTF-8'));?>" id="hotel_link" ><?php echo $row['name'];?></a></div> 
                                                       <img src="images/<?=$row['hotel_id']?>_stars.png" alt="" /></h4>
										<?php if(getBookingTime($row['hotel_id'])!=""){ ?>
										<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>:  <?php 
										echo getBookingTime($row['hotel_id']); ?> ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
										<?php } ?>                                                       
                                                      <!-- <div class="discrip">There are 10 people looking at this hotel.</div>-->
                                                  </div>
                                                  <div class="cell_03">
                                                       <?php  echo $row['currency']." ".$row['rate'];  ?>
                                                  </div>
                                          </div>
                                          <div><ul class="pagination"><?php echo $pagination;?></ul></div>

<?php 
} }
}else{
 echo  $LANG['No Records Found']== NULL?'No Records Found':$LANG['No Records Found'];
}
?>&nbsp;!                                      
                                        
<!--                                        	 <div class="box_row">
                                                  <div class="cell_01"><a href="hotel_details.html"><img src="images/img_02.jpg" alt="" /></a></div>
                                                  <div class="cell_02">
                                                       <h4><a href="hotel_details.html">Radisson Blu Portman</a> <img src="images/rating_star.png" alt="" /></h4>
                                                       <p>Score from 160 reviews: Very good, 8.1 <img src="images/icon_01.png" alt="" /></p>
                                                       <div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="images/icon_02.png" alt="" /></div>
                                                       <div class="discrip">There are 10 people looking at this hotel.</div>
                                                  </div>
                                                  <div class="cell_03">
                                                       <span>from</span>
                                                       US$ 171.84
                                                  </div>
                                             </div>
                                             
                                             <div class="box_row">
                                                  <div class="cell_01"><a href="hotel_details.html"><img src="images/img_03.jpg" alt="" /></a></div>
                                                  <div class="cell_02">
                                                       <h4><a href="hotel_details.html">Best Western Premier </a> <img src="images/rating_star.png" alt="" /></h4>
                                                       <p>Score from 160 reviews: Very good, 8.1 <img src="images/icon_01.png" alt="" /></p>
                                                       <div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="images/icon_02.png" alt="" /></div>
                                                       <div class="discrip">There are 10 people looking at this hotel.</div>
                                                  </div>
                                                  <div class="cell_03">
                                                       <span>from</span>
                                                       US$ 85.02
                                                  </div>
                                             </div>-->
                                        
                                        </div>
                                        
                                        <div class="clr"></div>
                                        
                                   </div>
                                   <div class="review_tab_cont">
                                   	<div class="place_box">
<?php 
if(!empty($pageDetails)){
foreach ($pageDetails as $row) {
     if($row['review_score'] == NULL){
?>                                       
                                       
                                       <div class="box_row">
                                              <div class="cell_01"><a href="<?php echo base_url().'hotel-details/'.$row['hotel_id'].'/'.str_replace(" ","-",mb_strtolower($row['name'], 'UTF-8'));?>">
                                            
                                           <?php if(!empty($row['thumbnail_url'])){?>
                                            <img src="<?php echo $row['thumbnail_url']; ?>" alt="" width="40" height="40" />
                                           <?php }else{?>
                                            <img src="<?php echo base_url() ?>images/no_image_thumb.jpg" alt="" width="40" height="40" />
                                            <?php }?>
                                            </a></div>
                                                  <div class="cell_02">
                                                       <h4 style="display: inline-block;"><div id="link_div"><a href="<?php echo base_url().'hotel-details/'.$row['hotel_id'].'/'.str_replace(" ","-",mb_strtolower($row['name'], 'UTF-8'));?>" id="hotel_link" ><?php echo $row['name'];?></a></div> 
                                                       <img src="images/<?=$row['star_rating']?>_stars.png" alt="" /></h4>
										<?php if(getBookingTime($row['hotel_id'])!=""){ ?>
										<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>:  <?php 
										echo getBookingTime($row['hotel_id']); ?> ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
										<?php } ?>													   
                                                       <!--<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="images/icon_02.png" alt="" /></div>-->
                                                      <!-- <div class="discrip">There are 10 people looking at this hotel.</div>-->
                                                  </div>
                                                  <div class="cell_03">
                                                       <?php  echo $row['currency']." ".$row['rate'];  ?>   
                                                       <span><a href="javascript:void(0);" onclick="show_dialog_review('post_review_box', '<?php echo $row['hotel_id']; ?>' )" id="my_review_link">Post Review</a></span>                                                                                   
                                                  </div>
                                          </div>
                                          <div><ul class="pagination"><?php echo $pagination;?></ul></div>

<?php 
} }
}else{
 echo $LANG['No Records Found']== NULL?'No Records Found':$LANG['No Records Found']; 
}
?>&nbsp;!                                            
<!--                                        	<div class="box_row">
                              				<div class="cell_01"><a href="hotel_details.html"><img src="images/img_01.jpg" alt="" /></a></div>
                                                  <div class="cell_02">
                                                       <h4><a href="hotel_details.html">May Fair Hotel</a> <img src="images/rating_star.png" alt="" /></h4>
                                                       <div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="images/icon_02.png" alt="" /></div>
                                                       <div class="discrip">There are 10 people looking at this hotel.</div>
                                                  </div>
                                                  <div class="cell_03">
                                                       US$ 171.84
                                                       <span><a href="javascript:void(0);" onclick="show_dialog('post_review_box')" id="my_review_link">Post Review</a></span>
                                                  </div>
                              			</div>-->
                                        
                                        </div>
                                        
                                        <div class="clr"></div>
                                   </div>
                              
                                   
                                   <p class="top_margin"><?=$LANG['By updating your profile you are agreeing with our']== NULL?'By updating your profile you are agreeing with our':$LANG['By updating your profile you are agreeing with our']?> <a href="<?php echo base_url().'home/terms_conditions'?>"><?=$LANG['Terms and Conditions']== NULL?'Terms and Conditions':$LANG['Terms and Conditions']?></a> <?=$LANG['and']== NULL?'and':$LANG['and']?> <a href="<?php echo base_url().'home/privacy'?>"><?php echo $LANG['Privacy statement']== NULL?'Privacy statement':$LANG['Privacy statement'] ;?></a>.</p>
                              
                              
                              </div>
                         </div>
                    </div>
               <!--RIGHT PANEL END-->
               <div class="clr"></div>
          </div>
     <!--CONTENT SECTION END-->
     
     </div>
 
 
 <!--  /******************************** Post Review BOX START *****************************************************/ -->  
 
     <div id="post_review_box" class="signin_box" style="display:none; position:absolute; width:320px;">
     <div class="close_btn"><a href="javascript:void(0)" onclick="hide_dialog()"><img src="images/close_btn.png" alt="" /></a></div>
	    <form action="<?=base_url()?>user/my_review_list" method="post" name="frm_review" id="frm_review">
	    <h3 style="border-bottom: 2px solid #D8E6F9; margin-bottom: 10px;">Post Review</h3>
        <div id="review_msg" style="display:none; padding-left:66px; color:red;"></div>
        <label style="margin-top: 0px;width: 85px;">Rating : </label>
        <div class="basic" data="12_1"></div>
        <div class="clr" style="height: 10px;"></div>
        <input type="hidden" name="rating" id="rating" value="" >
        <input type="hidden" name="hotel_id" id="hotel_id" value="" >
        <label style="width: 85px;">Comments : </label>
		<textarea name="review_comments" value="" class="username" rows="2" cols="26"></textarea>
        <div class="clr"></div>
        <label style="width: 85px;">&nbsp;</label><input type="button" value="Submit" class="button_01 left" style="margin-top:15px;" id="submit_post_review" onclick="check_rating(); return false;"/>
		<div class="clr"></div>
		</form>
     </div>
	 
<!--  /******************************** Post Review BOX END *****************************************************/ --> 
<link rel="stylesheet" href="<?=base_url()?>css/rating/jRating.jquery.css" type="text/css" />
<script type="text/javascript" src="<?=base_url()?>js/rating/jRating.jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.basic').jRating();
});

var dialog = null;
function show_dialog_review (divid, hotelid)
{
    $('#hotel_id').val(hotelid);
    if(!dialog) dialog = null;
    dialog = new ModalDialog ("#" + divid);
    dialog.show();
}
function check_rating(){
    var rating = null;
    var rating = $('#rating').val();
    if( rating == ''){
        $('#review_msg').css({'display':'block'});   
        $('#review_msg').html("Please enter a rating.");   
        return false;            
    }else{
        $('#frm_review').submit();
        $('#frm_review').reset();
        return true;         
    }
}
</script>