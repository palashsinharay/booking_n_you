<?php //include("header.php");
$user_session_info = $this->session->userdata('LOGGEDIN_USER');

// FETCHING USER DETAILS FROM DB 
/*echo"<pre>";
print_r($user_detail);
echo"</pre>";
echo $user_detail['email_address'];
*/
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
                              	<div class="left_part"><?=$LANG['Hello']== NULL?'Hello':$LANG['Hello']?> <?php if(!empty($user_session_info)){echo $user_detail['first_name']." ".$user_detail['last_name'];} else {echo "Guest"; } ?></div>
                                   <div class="right_part"> <?php if(!empty($user_session_info)){?><a href="<?php echo base_url().'user/sign_out/';?>"><img src="images/icon_03.png" alt="" /><?=$LANG['Sign Out']== NULL?'Sign Out':$LANG['Sign Out']?></a></a><?php } ?></div>
                                   <div class="clr"></div>
                              </div>
                              <div class="inner_cont">
                              	<p><?php echo $LANG['You can manage all of your profile information on these pages']== NULL?'You can manage all of your profile information on these pages':$LANG['You can manage all of your profile information on these pages']?>.</p>
                                   <ol>
                                   	<li><a href="<?php echo base_url().'user/my_booking_list';?>"><?php echo $LANG['My Bookings']== NULL?'My Bookings':$LANG['My Bookings'] ;?></a></li>
                                        <li><a href="<?php echo base_url().'user/my_review_list';?>"><?php echo $LANG['My Reviews']== NULL?'My Reviews':$LANG['My Reviews'] ;?></a></li>
                                        <li><a href="<?php echo base_url().'user/my_account_my_info';?>"><?php echo $LANG['My Account']== NULL?'My Account':$LANG['My Account'] ;?></a></li>
                                   </ol>
                                  <p class="top_margin10"><?=$LANG['By updating your profile you are agreeing with our']== NULL?'By updating your profile you are agreeing with our':$LANG['By updating your profile you are agreeing with our']?> <a href="<?php echo base_url().'home/terms_conditions'?>"><?=$LANG['Terms and Conditions']== NULL?'Terms and Conditions':$LANG['Terms and Conditions']?></a> <?=$LANG['and']== NULL?'and':$LANG['and']?>  <a href="<?php echo base_url().'home/privacy'?>"><?=$LANG['Privacy statement']== NULL?'Privacy statement':$LANG['Privacy statement']?></a>.</p>
                              </div>
							  
							  <div class="booking_list ">
							  
							  <div class="inner_cont">
							  <ol style="margin:0;">
							  <li style="list-style:none; background:none; padding:0;">
							  <?php if(!empty($pageDetails)){
							  ?>
							  </li>
							  </ol>
							  </div>
							  
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <thead>
							 <tr>
                            <th  colspan="7" align="center"><?=$LANG['Recent Bookings']== NULL?'Recent Bookings':$LANG['Recent Bookings']?></th>
                            </tr>
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
						<?php
						}else{ 
                        ?>
						<br/>
						<h3><?=$LANG['Have Not Booked any hotels yet']== NULL?'Have Not Booked any hotels yet':$LANG['Have Not Booked any hotels yet']?> ?  <a href=<?php echo base_url();?>><?=$LANG['Book Your Hotels']== NULL?'Book Your Hotels':$LANG['Book Your Hotels']?>.</a></h3> 
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

</body>
</html>
<?php
/*if(isset($_GET['user_id'])) echo "my_id ".$_GET['user_id'];
else echo "uppps";*/
?>