<?php //include("header.php"); 
if($_POST)
{
/*echo"<pre>";
print_r($booking);
echo"</pre>";
*/

/*echo"<pre>";
print_r($hotel);
echo"</pre>";*/

/*echo "<pre>";
print_r($all_hotels);
echo "</pre>";*/

       if(!empty($booking))
	   {

		$id							=	$booking['id'];
		$user_id					=	$booking['user_id'];		
		$hotel_id					=	$booking['hotel_id'];
		$check_in					=	$booking['check_in'];
		$check_in_arr				=	explode(" ",$check_in);
		$check_in_date				=	$check_in_arr[0];
		$check_in_date_arr			=	explode("-",$check_in_date);
		$check_in_year				=	$check_in_date_arr[0];
		$check_in_month				=	$check_in_date_arr[1];
		$check_in_day				=	$check_in_date_arr[2];
		$check_in_day_converted		=	$check_in_day."/".$check_in_month."/".$check_in_year;
		$check_in_time				=	$check_in_arr[1];	
		$check_out					=	$booking['check_out'];
		$check_out_arr				=	explode(" ",$check_out);
		$check_out_date				=	$check_out_arr[0];
		$check_out_date_arr			=	explode("-",$check_out_date);
		$check_out_year				=	$check_out_date_arr[0];
		$check_out_month			=	$check_out_date_arr[1];
		$check_out_day				=	$check_out_date_arr[2];
		$check_out_day_converted	=	$check_out_day."/".$check_in_month."/".$check_in_year;
		$check_out_time				=	$check_out_arr[1];	
		$max						=	$booking['max'];
		$no_of_rooms				=	$booking['no_of_rooms'];
		$rate						=	$booking['rate'];
        $hotel_id                   =   $booking['hotel_id'];
               
	
		
		if(!empty($hotel))
		{	
			$hotel_id					=	$hotel['hotel_id'];
			$name						=	$hotel['name'];
			$address1					=	$hotel['address1'];		
			$city						=	$hotel['city'];
			$postal_code				=	$hotel['postal_code'];
			$thumb_nail_url				=	$hotel['thumb_nail_url'];

			$thumb_nail_url             =   $hotel['thumb_nail_url']; 	
			$full_url 					=	'http://media.expedia.com/'.$thumb_nail_url;	
		}	
	
	}
}
 ?>
     <!--CONTENT SECTION START-->
     	<div id="content">
          	<div class="page_nav">
               	<p>You are here:&nbsp;&nbsp;<a href="javascript:void(0);">Home</a><img src="images/arrow2.png" alt="" /><a href="javascript:void(0);">My Profile </a></p>
               </div>
          	<!--LEFT PANEL START-->
               	<div class="left_panel_02">
                    	<div class="blue_box">
                         	<div class="inner_nav">
                              	<ul>
	                                   	<li class="select"><img src="images/icon_10.png" alt="" /> <a href=<?php echo base_url().'user/my_account_home/';?>>Home</a></li>
                                        <li><img src="images/icon_11.png" alt="" /> <a href="<?php echo base_url().'user/my_account_my_booking';?>">My Booking</a></li>
                                        <li><img src="images/icon_27.png" alt="" /> <a href="<?php echo base_url().'user/my_review_list';?>">My Review</a></li>
                                        <li><img src="images/icon_12.png" alt="" /> <a href="<?php echo base_url().'user/my_account_my_info';?>">My Account</a></li>
                                        <li><img src="images/icon_13.png" alt="" /> <a href="<?php echo base_url().'user/sign_out/';?>">Sign Out</a></li>
                                   </ul>
                              </div>
                         </div>
                    </div>
               <!--LEFT PANEL END-->

               <!--RIGHT PANEL START-->
               	<div class="right_panel_02">
                    	<div class="inner">
                         	<div class="inner_heading">
                              	<div class="left_part">My Bookings</div>
                                   <div class="right_part"><a href="<?php echo base_url().'user/sign_out/';?>"><img src="images/icon_03.png" alt="" /> Sign Out</a></div>
                                   <div class="clr"></div>
                              </div>
                              <div class="inner_cont">
                              	<div class="view_all"><a href="<?php echo base_url().'user/my_account_my_booking_all';?>">Back</a></div>
                              <p>You currently have  bookings associated with this account.</p>
                                   <p>To manage any bookings you have made, please visit</p>
                                
                              <div class="booking_list">
							   <?php if(!empty($booking)){?>  
                              	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                   <thead>
                                     <tr>
                                       <th  colspan="2" align="left">Name</th>
                                       <th>Chack In</th>
                                       <th>Chack Out</th>
                                       <th>Max</th>
                                       <th>No. of Room</th>
                                       <th align="right" width="60">Rate</th>
                                     </tr>
                                    </thead>
                                    <tbody>
                                     <tr>
                                       <td width="60">
									   		<?php if($thumb_nail_url!=''){?>
									   		<a href="<?php echo base_url().'hotel-details/'.$hotel_id.'/'.strtolower(str_replace(' ', '-', $name));?>"><img src="<?php echo $full_url;?>" alt="" /></a>
											<?php  }else { ?>
											<img src="images/no-image-icon.jpg" alt="" />
											<?php } ?>
									   </td>
                                       <td width="180">
									   
			   
                                       		<h5><a href="<?php echo base_url().'hotel-details/'.$hotel_id.'/'.strtolower(str_replace(' ', '-', $name));?>"><?php echo $name;?></a></h5>
                                       		<p><?php echo $address1?> ,<?php echo $city;?> <?php echo $postal_code;?>, <?php echo $city;?></p>
                                       </td>
                                       <td align="center"><?php echo $check_in_day_converted;?></td>
                                       <td align="center"><?php echo $check_out_day_converted;?></td>
                                       <td align="center"><?php echo $max;?> Persons</td>
                                       <td align="center"><?php echo $no_of_rooms;?></td>
                                       <td align="right"><span>INR <?php //echo $rate;?></span></td>
                                     </tr>
                                     </tbody>
                                   </table>
									<?php }else{ ?>
										<h3>No Records Found !!</h3>
                              <?php } ?>
                              </div>
                                   
                                   <p>By updating your profile you are agreeing with our <a href="javascript:void(0);">Terms and Conditions</a> and <a href="javascript:void(0);">Privacy Statement</a>.</p>
                              
                              
                              </div>
                         </div>
                    </div>
               <!--RIGHT PANEL END-->
               <div class="clr"></div>
          </div>
     <!--CONTENT SECTION END-->
     
     </div>
     
 <?php //include("footer.php");?>