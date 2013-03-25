<script type="text/javascript">
$(document).ready(function() {

/*###########################################My booking form CODE Start##########################################*/ 
$('#my_booking_button').click(function() {
/*var form_data = {
booking_number : $('.booking_number').val(),
pincode : $('.pincode').val(),
ajax : '1'
};
if($('.booking_number').val()=='' || $('.pincode').val()=='' )
{
		
		msg="Both Fields are Mandatory!!";
	    alert(msg);
		
	
	
}
else
{
		$.ajax({
		url: "user/my_account_my_booking2",
		type: 'POST',
		async : false,
		data: form_data
		success: function(msg) {
		alert(msg);
		}
		});
}
return false;
});
*//*########################################### My booking form CODE End ##########################################*/ 



});

</script>

<?php //include("header.php");
$user_session_info = $this->session->userdata('LOGGEDIN_USER'); 
?>

     
     <!--CONTENT SECTION START-->
     	<div id="content">
          	<div class="page_nav">
               	<p><?php echo $LANG['You are here']== NULL?'You are here':$LANG['You are here'] ;?>:&nbsp;&nbsp;<a href="index.php">Home</a><img src="images/arrow2.png" alt="" /><a href="my_account_home.php"><?php echo $LANG['My Account']== NULL?'My Account':$LANG['My Account'] ;?> </a></p>
               </div>
          	<!--LEFT PANEL START-->
               	<div class="left_panel_02">
                    	<div class="blue_box">
                         	<div class="inner_nav">
                              	<ul>
	                                   	<li class="select"><img src="images/icon_10.png" alt="" /> <a href=<?php echo base_url().'user/my_account_home/';?>><?=$LANG['Home']== NULL?'Home':$LANG['Home']?></a></li>
                                        <li><img src="images/icon_11.png" alt="" /> <a href="<?php echo base_url().'user/my_booking_list';?>"><?=$LANG['My Booking']== NULL?'My Booking':$LANG['My Booking']?></a></li>
                                        <li><img src="images/icon_27.png" alt="" /> <a href="<?php echo base_url().'user/my_review_list';?>"><?=$LANG['My Review']== NULL?'My Review':$LANG['My Review']?></a></li>
                                        <li><img src="images/icon_12.png" alt="" /> <a href="<?php echo base_url().'user/my_account_my_info';?>"><?=$LANG['My Account']== NULL?'My Account':$LANG['My Account']?></a></li>
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
                              	<div class="left_part"><?=$LANG['My Bookings']== NULL?'My Bookings':$LANG['My Bookings']?></div>
                                   <div class="right_part"><a href="<?php echo base_url().'user/sign_out/';?>"><img src="images/icon_03.png" alt="" /> <?=$LANG['Sign Out']== NULL?'Sign Out':$LANG['Sign Out']?></a></div>
                                   <div class="clr"></div>
                              </div>
                              <div class="inner_cont">
                              	<div class="change_password">
								 <?php //echo form_open_multipart('user/my_account_my_booking2',array("id"=>"search_result_form"));?>
								<form name="my_booking" id="my_booking" action="<?php echo base_url()?>user/my_account_my_booking2" method="post">
                                   <div class="view_all"><a href="<?php echo base_url()?>user/my_account_my_booking_all"><?=$LANG['View List']== NULL?'View List':$LANG['View List']?></a></div>
                                   <p><?=$LANG['Sign in here to manage a single booking, access driving directions and travel tools']== NULL?'Sign in here to manage a single booking, access driving directions and travel tools':$LANG['Sign in here to manage a single booking, access driving directions and travel tools']?>.</p>
                                   <label><?=$LANG['Booking Number']== NULL?'Booking Number':$LANG['Booking Number']?>/label><!--<input type="text" name="booking_number" id="booking_number"/>--><?=form_input(array('name'=>'booking_number','value'=>'','class'=>'booking_number textbox'))?>
                                   <div class="clr"></div>
                                   <label>PIN Code</label><!--<input type="text" name="pincode" id="pincode"/>--><?=form_input(array('name'=>'pincode','value'=>'','class'=>'pincode textbox'))?>                                   <div class="clr"></div>
                                   <label></label><input type="submit" value="Submit" class="button_01 left" style="margin-top:12px;" />
									<!--<input type="button" value="Submit" class="button_01 left" style="margin-top:12px;" id="my_booking_button" />								   -->
                                   <div class="clr"></div>
							 
							</form>
                                   <p class="top_margin"><?=$LANG['You can find your booking number and PIN code in your confirmation email. Lost your confirmation email']== NULL?'You can find your booking number and PIN code in your confirmation email. Lost your confirmation email':$LANG['You can find your booking number and PIN code in your confirmation email. Lost your confirmation email']?>? <a href="javascript:void(0);"><?=$LANG['Click Here']== NULL?'Click Here':$LANG['Click Here']?></a></p>
                                   <p class="top_margin10"><?=$LANG['By updating your profile you are agreeing with our']== NULL?'By updating your profile you are agreeing with our':$LANG['By updating your profile you are agreeing with our']?> <a href="terms_conditions.php"><?=$LANG['Terms and Conditions']== NULL?'Terms and Conditions':$LANG['Terms and Conditions']?></a> <?=$LANG['and']== NULL?'and':$LANG['and']?> <a href="privacy.php"><?=$LANG['Privacy Statement']== NULL?'Privacy Statement':$LANG['Privacy Statement']?></a>.</p>
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