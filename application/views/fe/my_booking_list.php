<?php //include("header.php");
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
                                        <li class="select"><img src="images/icon_11.png" alt="" /> <a href="<?php echo base_url().'user/my_booking_list';?>"><?=$LANG['My Booking']== NULL?'My Booking':$LANG['My Booking']?></a></li>
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
                                   <div class="right_part"><a href="<?php echo base_url().'user/sign_out/';?>"><img src="images/icon_03.png" alt="" /><?=$LANG['Sign Out']== NULL?'Sign Out':$LANG['Sign Out']?> </a></div>
                                   <div class="clr"></div>
                              </div>
                              <div class="inner_cont">
                              	<div class="change_password">
                                <!-- <div class="view_all"><a href="<?php echo base_url()?>user/my_account_my_booking_all">View List</a></div>-->
								<form name="my_booking" id="my_booking" action="<?php echo base_url()?>user/my_booking_list" method="post">
                                   <p><?=$LANG['Sign in here to manage a single booking']== NULL?'Sign in here to manage a single booking':$LANG['Sign in here to manage a single booking']?>, <?=$LANG['access driving directions and travel tools']== NULL?'access driving directions and travel tools':$LANG['access driving directions and travel tools']?>.</p>
                                   <label> <?=$LANG['Itinerary Number']== NULL?'Itinerary Number':$LANG['Itinerary Number']?></label><input type="text" name="txt_itinerary_id" id="txt_itinerary_id"/>
                                   <div class="clr"></div>
                                   <label><?=$LANG['Confirmation Number']== NULL?'Confirmation Number':$LANG['Confirmation Number']?></label><input type="text" name="txt_confirmation_number" id="txt_confirmation_number"/>
                                    <div class="clr"></div>
                                   <label></label><input type="submit" value="Submit" class="button_01 left" style="margin-top:12px;" />
									<!--<input type="button" value="Submit" class="button_01 left" style="margin-top:12px;" id="my_booking_button" />								   -->
                                   <div class="clr"></div>
								</form>
                                   <p class="top_margin"><?=$LANG['You can find your booking number and PIN code in your confirmation email. Lost your confirmation email']== NULL?'You can find your booking number and PIN code in your confirmation email. Lost your confirmation email':$LANG['You can find your booking number and PIN code in your confirmation email. Lost your confirmation email']?> ? <a href="javascript:void(0);"><?=$LANG['Click here']== NULL?'Click here':$LANG['Click here']?></a></p>
                                   <p class="top_margin"><?=$LANG['Do you want to cancel your booking']== NULL?'Do you want to cancel your booking':$LANG['Do you want to cancel your booking']?> ? <a href="<?php echo base_url()?>booking/booking_cancel"><?=$LANG['Click here']== NULL?'Click here':$LANG['Click here']?></a></p>
                                   <p class="top_margin10"><?=$LANG['By updating your profile you are agreeing with our']== NULL?'By updating your profile you are agreeing with our':$LANG['By updating your profile you are agreeing with our']?> <a href="<?php echo base_url().'home/terms_conditions'?>"><?=$LANG['Terms and Conditions']== NULL?'Terms and Conditions':$LANG['Terms and Conditions']?></a> <?=$LANG['and']== NULL?'and':$LANG['and']?>  <a href="<?php echo base_url().'home/privacy'?>"><?=$LANG['Privacy statement']== NULL?'Privacy statement':$LANG['Privacy statement']?></a>.</p>
                              </div>
                           </div>
                           	<div class="booking_list">
							<?php if(!empty($pageDetails)){ 
							?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <thead>
                            <tr>
                            <th  colspan="2" align="left"><?=$LANG['Name']== NULL?'Name':$LANG['Name']?></th>
                            <th><?=$LANG['Check In']== NULL?'Check In':$LANG['Check In']?></th>
                            <th><?=$LANG['Check Out']== NULL?'Check Out':$LANG['Check Out']?></th>
                            <th><?=$LANG['Max']== NULL?'Max':$LANG['Max']?></th>
                            <th><?=$LANG['No. of Room']== NULL?'No. of Room':$LANG['No. of Room']?></th>
                            <th align="right" width="60"><?=$LANG['Rate']== NULL?'Rate':$LANG['Rate']?></th>
                            </tr>
                            </thead>
                            <tbody>								   
                
							<?php 
                            foreach ($pageDetails as $row) {
                            ?>     
                        <tr>
                        <td width="60">                    
                        <?php if(!empty($row['thumbnail_url'])){?>
                        <img src="<?php echo $row['thumbnail_url']; ?>" alt="" width="40" height="40" />
                        <?php }else{?>
                        <img src="<?php echo base_url() ?>images/no_image_thumb.jpg" alt="" width="40" height="40" />
                        <?php }?>
                        </td>
                        <td width="180">
                        <h5><a href="<?php echo base_url().'hotel-details/'.$row['hotel_id'].'/'.str_replace(" ","-",mb_strtolower($row['name'], 'UTF-8'));?>"><?php echo $row['name'];?></a></h5>
                        <p><?php echo $row['address1'];?></p>
                        </td>
                        <td align="center"><?php   echo $row['check_in'];	?></td>
                        <td align="center"><?php   echo $row['check_out']; ?></td>
                        <td align="center"><?php   echo $row['max_person'];?> Persons</td>
                        <td align="center"><?php   echo $row['no_of_rooms'];?></td>
                        <td align="right"><span><?php echo $row['currency'];?> <?php echo $row['rate'];?></span></td>
                        </tr>              
                     
                        <?php 
                        }
                        ?>     
                        </tbody>
                        </table>
                        <div><ul class="pagination"><?php echo $pagination;?></ul></div>
						<?php
						} 
                        ?> 
                 </div>
                         </div>
                    </div>
               <!--RIGHT PANEL END-->
               <div class="clr"></div>
               
          </div>
     <!--CONTENT SECTION END-->
     
     </div>
     
 <?php //include("footer.php");?>