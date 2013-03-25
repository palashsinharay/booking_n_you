<?php //include("header.php");
$user_session_info = $this->session->userdata('LOGGEDIN_USER');
//-------------------- USER DETAIL ARRAY ------------------------------//
/*
echo"<pre>";
print_r($user_detail);
echo"</pre>";
//-------------------- USER LANGUAGE DETAIL ARRAY BY USER ID  ------------------------------//
echo"<pre>";
print_r($user_language_detail);
echo"</pre>";
*/
?>
<script type="text/javascript" >
//$(function() {
$(document).ready(function() {
$("#submit_button").click(function() {
/*alert($('.first_name').val());
alert($('.last_name').val());
alert($('.address').val());
alert($('.ph_no').val());
alert($('.address').val());
alert($('.id').val());
alert($('.language_select').val());
alert($('.city').val());
alert($('.country').val());*/
var form_data = {
first_name : $('.first_name').val(),
last_name : $('.last_name').val(),
address : $('.address').val(),
ph_no : $('.ph_no').val(),
id : $('.id').val(),
lang_id : $('.language_select').val(),
city : $('.city').val(),
country : $('.country').val(),
zip_code : $('.zip_code').val(),
ajax : '1'
}





			if($('.first_name').val()=='')
			{
			msg="Enter First Name !";
			$('.msg_div').html(msg);
			$('.msg_div').fadeIn(500).show();
			return false;
			}

           else if($('.last_name').val()=='')
			{
			msg="Enter Last Name !";
			$('.msg_div').html(msg);
			$('.msg_div').fadeIn(500).show();
			return false;
			}

else
{
				$.ajax({
				//url: "<?php //echo site_url('login/ajax_check'); ?>",
				url: "user/my_account_update",
				type: 'POST',
				async : false,
				data: form_data,
				success: function(msg) {
				//alert(msg);
				$('.msg_div').html(msg);
				}
				});
}

return false;
});
});

</script>



<?php 




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
                              	<div class="left_part"><?=$LANG['Edit My Account']== NULL?'Edit My Account':$LANG['Edit My Account']?></div>
                                   <div class="right_part"><a href="<?php echo base_url().'user/sign_out/';?>"><img src="images/icon_03.png" alt="" /> <?=$LANG['Sign Out']== NULL?'Sign Out':$LANG['Sign Out']?></a></div>
                                   <div class="clr"></div>
                              </div>
                              <div class="inner_cont">
                                   <div class="clr"></div>
								    <div class="msg_myaccount_edit">
								   <span class="success_msg_myaccount" style="display:none"></span>
								   <span class="msg_div" style="color:red;"></span>
								   </div>
                                   <div id="div1">
                                        <div class="account_row">
                                             <p><?=$LANG['We’ll use this information to complete your future bookings']== NULL?'We’ll use this information to complete your future bookings':$LANG['We’ll use this information to complete your future bookings']?>. </p>
                                        </div>
										
										<?php echo form_open(base_url().'user/my_account_update','my_account_form');?>
										<?php //form_hidden('id', 'id'); 
										//echo form_hidden(array('name'=>'id','value'=>$user_session_info['user_id'],'class'=>'id textbox'));
										?>
										<input type="hidden" name="id" value="<?php echo $user_session_info['user_id'];?>" class="id"/>
                                         <div class="account_row">
                                             <p><?=$LANG['First name']== NULL?'First name':$LANG['First name']?> :</p>
											 <?=form_input(array('name'=>'first_name','value'=>$user_detail['first_name'],'class'=>'first_name textbox'))?>
                                             
                                         </div>
                                         <div class="account_row">
                                             <p><?=$LANG['Last name']== NULL?'Last name':$LANG['Last name']?> :</p>
											 <?=form_input(array('name'=>'last_name','value'=>$user_detail['last_name'],'class'=>'last_name textbox'))?>
                                            
                                         </div>
                                         <div class="account_row">
                                             <p><?=$LANG['Email']== NULL?'Email':$LANG['Email']?> :</p>
                                             <input type="text" name="email_address" id="email_address" value="<?php echo $user_detail['email_address'];?>" readonly/>
                                         </div>
                                         <div class="account_row">
                                             <p><?=$LANG['Address']== NULL?'Address':$LANG['Address']?> :</p>
											  <?=form_input(array('name'=>'address','value'=>$user_detail['address'],'class'=>'address textbox'))?>
                                             
                                         </div>
                                             
                                         </div>										 

										<div class="account_row">
                                             <p><?=$LANG['City']== NULL?'City':$LANG['City']?> :</p>
											  <?=form_input(array('name'=>'city','value'=>$user_detail['city'],'class'=>'city textbox'))?>
                                             
                                         </div>		
										 
										<div class="account_row">
                                             <p><?=$LANG['ZipCode']== NULL?'ZipCode':$LANG['ZipCode']?> :</p>
											  <?=form_input(array('name'=>'zip_code','value'=>$user_detail['zip_code'],'class'=>'zip_code textbox'))?>
                                             
                                         </div>		
										 

    								  <div class="account_row">
                                             <p><?=$LANG['Country']== NULL?'Country':$LANG['Country']?> :</p>
												<div class="comment_cell_country text_box">
												<select name="country" id="country" class="country" style="width:35%;">
												<?php echo makeOptionCountry('',$user_detail['country_code']);?>
												</select>
												<script type="text/javascript">
												$(document).ready(function(arg) {
												//$("body select").msDropDown(
												$("#country").msDropDown();
												$("#country").hide();
												//$('#country_msdd').css("background-image", "url(images/select_bg4.png)");
												//$('#country_msdd').css("background-repeat", "no-repeat");
												//$('#person_msdd').css("background-position", "left");
												/*$('#country_msdd .borderRadiusTp span.arrow').css("background", "none");
												$('#country_msdd #country_titleText').css("margin-top", "0");
												$('#country_msdd').css("height", "24px"); 
												$('#country_msdd').css("line-height", "14px");	 */
												
												 $('#person_msdd').css("background-image", "url(images/select_bg2.png)");
												 $('#person_msdd').css("background-repeat", "no-repeat");
												 $('#person_msdd').css("background-position", "left");
												 $('#person_msdd').css("height", "24px"); 
												 $('#person_msdd').css("line-height", "22px");
												
												})
												</script>
												</div>
										</div>	
										

										 								 
                                         <div class="account_row">
                                             <p><?=$LANG['Language']== NULL?'Language':$LANG['Language']?> :</p>
											 <?php
											 if(isset($user_language_detail['lng_id']) && !empty($user_language_detail['lng_id']))
											 { 
												$this->User_model->get_selected_language($user_language_detail['lng_id']);
											 }
											 else
											 {
											 	$this->User_model->get_selected_language('en_US');
											 }	
											//if(!empty($user_session_info)){echo $user_language_detail['language'];}
											?>
											  
                                              <script type="text/javascript">
                                                     $(document).ready(function(arg) {
                                                                 //$("body select").msDropDown(
                                                             $("#person").msDropDown();
                                                             $("#person").hide();
															 
															 
															 $('#person_msdd').css("background-image", "url(images/select_bg2.png)");
                                                             $('#person_msdd').css("background-repeat", "no-repeat");
                                                             $('#person_msdd').css("background-position", "left");
                                                             $('#person_msdd').css("height", "24px"); 
                                                             $('#person_msdd').css("line-height", "22px");	 
                                                             
                                                       })

													   
													   
                                                  </script>
                                            <div class="clr"></div>
                                         </div>
                                         <div class="account_row">
                                             <p><?=$LANG['Telephone']== NULL?'Telephone':$LANG['Telephone']?></p>
											  <?=form_input(array('name'=>'ph_no','value'=>$user_detail['ph_no'],'class'=>'ph_no textbox'))?>

                                         </div>
                                        <input  type="submit" value="Save" class="button_01" style="margin-top:10px;"  id="submit_button"/>
							<input  type="button" value="Cancel" class="button_01" style="margin-top:10px;"  id="cancel_button" onclick="window.location.href='<?php echo base_url().'user/my_account_my_info/';?>'"/>
										<?=form_close("\n")?>
                                       <p class="top_margin"><?=$LANG['By updating your profile you are agreeing with our']== NULL?'By updating your profile you are agreeing with our':$LANG['By updating your profile you are agreeing with our']?> <a href="<?php echo base_url().'home/terms_conditions'?>"><?=$LANG['Terms and Conditions']== NULL?'Terms and Conditions':$LANG['Terms and Conditions']?></a> <?=$LANG['and']== NULL?'and':$LANG['and']?> <a href="<?php echo base_url().'home/privacy'?>"><?php echo $LANG['Privacy statement']== NULL?'Privacy statement':$LANG['Privacy statement'] ;?></a>.</p>
                                   </div>
                              <!--TAB 1 END-->
                              
                              
                              </div>
                         </div>
                    </div>
               <!--RIGHT PANEL END-->
               <div class="clr"></div>
          </div>
     <!--CONTENT SECTION END-->
     
     </div>
	 
     
<?php //include("footer.php");?>