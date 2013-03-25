<?php //include("header.php");
$user_session_info = $this->session->userdata('LOGGEDIN_USER');
?>
<link type="text/css" rel="stylesheet" href="css/validationEngine.jquery.css" />
<script type="text/javascript" src="js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="js/languages/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>

<script>jQuery.noConflict();</script>
<script>
		jQuery(document).ready(function(){
			//alert('hello')
			// binds form submission and fields to the validation engine
			//jQuery("#form1").validationEngine('attach', {promptPosition : "centerRight", autoPositionUpdate : true});
			jQuery("#my_booking_cancel").validationEngine('attach');
		});
	</script>	
     
     <!--CONTENT SECTION START-->
     	<div id="content">
          	<div class="page_nav">
               	<p><?php echo $LANG['You are here']== NULL?'You are here':$LANG['You are here'] ;?>:&nbsp;&nbsp;<a href="index.php"><?php echo $LANG['Home']== NULL?'Home':$LANG['Home'] ;?></a><img src="images/arrow2.png" alt="" /><a href="my_account_home.php"> <?php echo $LANG['My Account']== NULL?'My Account':$LANG['My Account'] ;?></a></p>
               </div>
          	<!--LEFT PANEL START-->
               	<div class="left_panel_02">
                    	<div class="blue_box">
                         	<div class="inner_nav">
                              		<ul>
	                                   	<li><img src="images/icon_10.png" alt="" /> <a href=<?php echo base_url().'user/my_account_home/';?>><?=$LANG['Home']== NULL?'Home':$LANG['Home']?></a></li>
                                        <li><img src="images/icon_11.png" alt="" /> <a href="<?php echo base_url().'user/my_booking_list';?>"><?=$LANG['My Booking']== NULL?'My Booking':$LANG['My Booking']?></a></li>
                                        <li><img src="images/icon_27.png" alt="" /> <a href="<?php echo base_url().'user/my_review_list';?>"><?=$LANG['My Review']== NULL?'My Review':$LANG['My Review']?></a></li>
                                        <li class="select"><img src="images/icon_12.png" alt="" /> <a href="<?php echo base_url().'user/my_account_my_info';?>"><?=$LANG['My Account']== NULL?'My Account':$LANG['My Account']?></a></li>
                                        <li><img src="images/icon_13.png" alt="" /> <a href="<?php echo base_url().'user/sign_out/';?>"><?=$LANG['Sign Out']== NULL?'Sign Out':$LANG['Sign Out']?></a></li>
                                   </ul>
                              </div>
                         </div>
                    </div>
               <!--LEFT PANEL END-->

               <!--RIGHT PANEL START-->
               	<div class="right_panel_02">
                    	<div class="inner">
                         	<div class="inner_heading">
                              	<div class="left_part"><?php echo $LANG['Cancel My Booking']== NULL?'Cancel My Booking':$LANG['Cancel My Booking'] ;?></div>
                                   <div class="right_part"><a href="<?php echo base_url().'user/sign_out/';?>"><img src="images/icon_03.png" alt="" /> <?=$LANG['Sign Out']== NULL?'Sign Out':$LANG['Sign Out']?></a></div>
                                   <div class="clr"></div>
                              </div>
                              <div class="inner_cont">
<?php if($this->session->flashdata('message')){
                                    echo '<span style="color:red; font-size:14px; padding-left:0px; padding-right:131px;">'.$this->session->flashdata('message').'</span>'; } ?>								
                              	
								<div class="change_password">
								<form name="my_booking_cancel" id="my_booking_cancel" action="<?php echo base_url()?>booking/booking_cancel" method="post">
                                   <label> <?php echo $LANG['Your Itinerary Number']== NULL?'Your Itinerary Number':$LANG['Your Itinerary Number'] ;?></label><input type="text" name="txt_itinerary_id" id="txt_itinerary_id" class="validate[required] text-input" />
                                   <div class="clr"></div>
                                   <label><?php echo $LANG['Confirmation Number']== NULL?'Confirmation Number':$LANG['Confirmation Number'] ;?></label><input type="text" name="txt_confirmation_number" id="txt_confirmation_number" class="validate[required] text-input" />
                                    <div class="clr"></div>
                                    <label><?php echo $LANG['Email']== NULL?'Email':$LANG['Email'] ;?></label><input type="text" name="txt_email" id="txt_email" value="<?php echo $user_session_info['user_email_address'];?>" class="validate[required, custom[email]] text-input"  readonly/>
                                    <div class="clr"></div>
                                    <label><?php echo $LANG['Cancellation Reason']== NULL?'Cancellation Reason':$LANG['Cancellation Reason'] ;?></label>
                                     <textarea name="txt_reason_cancel" style="margin:12px;outline: medium none;padding:12px;"></textarea><div class="comment_cell"><?php echo $LANG['Please write your reason for cancellation of the booking']== NULL?'Please write your reason for cancellation of the booking':$LANG['Please write your reason for cancellation of the booking'] ;?>. </div>
                                    <div class="clr"></div>
                                   <label></label><input type="submit" value="Submit" class="button_01 left" style="margin-top:12px;" />
                                   <div class="clr"></div>
								</form>
                              </div>
                           </div>
                           	
                         </div>
                    </div>
               <!--RIGHT PANEL END-->
               <div class="clr"></div>
               
          </div>
     <!--CONTENT SECTION END-->
     
     </div>
     
 <?php //include("footer.php");?>