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
			jQuery("#form1").validationEngine('attach');
		});
	</script>	
<div id="content">	
<div class="page_nav">
               	<p><?php echo $LANG['You are here']== NULL?'You are here':$LANG['You are here'] ;?>:&nbsp;&nbsp;<a href="<?php echo base_url(); ?>"><?php echo $LANG['Home']== NULL?'Home':$LANG['Home'] ;?></a>
				<?php if(!empty($country_name)) { ?><img src="<?php echo base_url(); ?>images/arrow2.png" alt="" />
				<?php echo $LANG['Hotels in']== NULL?'Hotels in':$LANG['Hotels in'] ;?>
                <a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$country.'/'.str_replace(" ","-",mb_strtolower($country_name, 'UTF-8'));?>"><?php echo $country_name;?></a><?php } ?>
				<?php if($state_province != "") { ?><img src="<?php echo base_url(); ?>images/arrow2.png" alt="" /><a href="javascript:void(0);"> <?php echo $state_province; ?></a> <?php } if($city != "") {?>
                <a href="<?php echo base_url().'hotelsummaries/hotel_search_by_city/'.$city.'/'.$country;?>"><?php echo $city;?></a>
                 <?php } if($name != "") { ?> <!--<span>[17 hotels]</span>-->  <img src="<?php echo base_url(); ?>images/arrow2.png" alt="" /> <a href="javascript:void(0);"><?php echo $name; ?>, <?php echo $city; } ?></a></p>
               </div>

			
			
			
			<!--HOTEL RESERVATION START-->
               <div class="reservation">
               <div class="tab">
			<a href="javascript:void(0);">1. <?php echo $LANG['Your room']== NULL?'Your room':$LANG['Your room'] ;?></a>
			 <a href="javascript:void(0);">2.  <?php echo $LANG['Your details']== NULL?'Your details':$LANG['Your details'] ;?></a>
			 <a href="javascript:void(0);" class="select">3. <?php echo $LANG['Confirm booking']== NULL?'Confirm booking':$LANG['Confirm booking'] ;?></a>
			 <a href="javascript:void(0);">4. <?php echo $LANG['Booking complete']== NULL?'Booking complete':$LANG['Booking complete'] ;?></a>
				</div>
                    
                    <div class="heading">
                    	<div class="left_part"><?php echo $LANG['Your booking']== NULL?'Your booking':$LANG['Your booking'] ;?></div>
                         <div class="right_part_new"><div class="fb-like" data-send="false" data-width="450" data-show-faces="false"></div></div>
                         <div class="clr"></div>
                    </div>
                    <div class="reservation_cont">
                    	<div class="cell_01">
								<?php 
                                if(!empty($HotelimageData[0]['url'])){?>
                                <img src="<?php echo $HotelimageData[0]['url']; ?>" alt="" width="170" height="170" />
                               <?php }else{?>
                                <img src="<?php echo base_url(); ?>images/no_image_thumb.jpg" alt="" width="170" height="170" />
                                <?php }?>
                                </div>
                         <div class="cell_02">
                         	<h5><?php //print_r($Hotel_Data);?><?php echo $name;?>, <?php echo $city;?><img src="<?php echo base_url(); ?>images/<?php echo str_replace(".","",$star_rating)?>_stars.png" alt="" /></h5>
				  <p><?php echo $address1;?>, <?php if($postal_code != 0) { echo $postal_code; } ?>,<?php echo $city; ?>
				  <!--34B , Belvedere Road , Alipore Kolkata 700027, Kolkata--> <!--<a href="#">Show Map</a>--></p>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                               <tr>
                                  <td width="16%"><?php echo $LANG['Check-In Date']== NULL?'Check-In Date':$LANG['Check-In Date'] ;?>:</td>
                                  <td width="84%"><?php echo $search_checkin_date_formatted;?></td>
                                </tr>
                                <tr>
                                  <td><?php echo $LANG['Check-Out Date']== NULL?'Check-Out Date':$LANG['Check-Out Date'] ;?>:</td>
                                  <td><?php echo $search_checkout_date_formatted;?><!--Monday, August 15, 2011--></td>
                                </tr>
                                <tr>
                                  <td>For </td>
                                  <td><?php echo $no_of_nights;?> <?php echo $LANG['nights']== NULL?'nights':$LANG['nights'] ;?>, <?php echo $session->userdata('booking_no_of_rooms');?> <?php echo $LANG['Rooms']== NULL?'Rooms':$LANG['Rooms'] ;?> , <?php echo $session->userdata('booking_no_of_people');?> <?php echo $LANG['people']== NULL?'people':$LANG['people'] ;?></td>
                                </tr>
                              </table>
						<div class="price"><?php echo $LANG['Total Price']== NULL?'Total Price':$LANG['Total Price'] ;?> : <span><?php echo($session->userdata('Currency_code').' '.number_format($session->userdata('booking_total'),2));?></span></div> 
                              <div class="cell_04"><a href="javascript:void(0);"><?php echo $LANG['Booking Conditions']== NULL?'Booking Conditions':$LANG['Booking Conditions'] ;?></a></div>
                              <div class="clr"></div>
                              <p><?php echo $LANG['TAX']== NULL?'TAX':$LANG['TAX'] ;?> (15.15%) <?php echo $LANG['not included']== NULL?'not included':$LANG['not included'] ;?></p>
                         </div>
                         <div class="cell_03"><img src="<?php echo base_url() ?>images/icon_21.png" alt="" /> <?php echo $LANG['Best Price Guaranteed']== NULL?'Best Price Guaranteed':$LANG['Best Price Guaranteed'] ;?> </div>
                    </div>
                    <div class="clr"></div>
					
					
					
					<form name="form1" id="form1" action="<?php echo base_url().'booking/booking_confirm/'.$hotel_id ?>" method="post">
					<input type="hidden" name="no_of_rooms" id="no_of_rooms" value="<?php echo $session->userdata('booking_no_of_rooms');?>" />
                    <input type="hidden" name="no_of_people" id="no_of_people" value="<?php echo $session->userdata('booking_no_of_people');?>" />
                    <input type="hidden" name="total" id="total" value="<?php echo $session->userdata('booking_total');?>" />
                    <input type="hidden" name="rateKey" id="rateKey" value="<?php echo $session->userdata('booking_rateKey');?>" />
                    <input type="hidden" name="rateCode" id="rateCode" value="<?php echo $session->userdata('booking_rateCode');?>" />
        			<input type="hidden" name="roomTypeCode" id="roomTypeCode" value="<?php echo $session->userdata('booking_roomTypeCode');?>" />
                    <input type="hidden" name="fname" id="fname" value="<?php echo $session->userdata('booking_fname');?>" />
                    <input type="hidden" name="lname" id="lname" value="<?php echo $session->userdata('booking_lname');?>" />
                    <input type="hidden" name="email" id="email" value="<?php echo $session->userdata('booking_email');?>" />
                    <input type="hidden" name="password" id="password" value="<?php echo $session->userdata('user_password');?>" />
                    <input type="hidden" name="guest_name[]" id="guest_name" value="<?php echo $session->userdata('booking_guest_name');?>" />
                    <div class="comment"><?php echo $LANG['Good news! With this room you get FREE cancellation before']== NULL?'Good news! With this room you get FREE cancellation before':$LANG['Good news! With this room you get FREE cancellation before'] ;?> August 9, 2013! </div>
                    <h2><?php echo $LANG['Your details']== NULL?'Your details':$LANG['Your details'] ;?></h2>
                    <label><?=$LANG['First name']== NULL?'First name':$LANG['First name']?></label><div class="comment_cell_02"><?php echo $session->userdata('booking_fname');?></div>
                    <div class="clr"></div>
                    <label><?=$LANG['Last name']== NULL?'Last name':$LANG['Last name']?></label><div class="comment_cell_02"><?php echo $session->userdata('booking_lname');?></div>
                    <div class="clr"></div>
                    <label><?=$LANG['Email']== NULL?'Email':$LANG['Email']?></label><div class="comment_cell_02"><?php echo $session->userdata('booking_email');?></div>
                    <div class="clr"></div>
                     <label><?=$LANG['Address']== NULL?'Address':$LANG['Address']?> </label><input name="address" id="address" type="text" class="validate[required] text-input" value="<?php echo @$_POST['address'];?>"/>
			
                    <div class="clr"></div>
                    <label><?=$LANG['City']== NULL?'City':$LANG['City']?></label><input name="city" id="city" type="text" class="validate[required] text-input" value="<?php echo @$_POST['city'];?>"/>
                    <div class="clr"></div>
                    <label><?=$LANG['ZipCode']== NULL?'ZipCode':$LANG['ZipCode']?></label><input name="zip" type="text" value="<?php echo @$_POST['zip'];?>"/>
                    <div class="clr"></div>
                    <label><?=$LANG['Country']== NULL?'Country':$LANG['Country']?></label>
                    <div class="comment_cell_country text_box">
								<select name="country" id="country" class="validate[required]" style="width:100%;">
                                <?php echo makeOptionCountry('','');?>
                                </select>
						 	<script type="text/javascript">
							$(document).ready(function(arg) {
									  //$("body select").msDropDown(
								  $("#country").msDropDown();
								  $("#country").hide();
                                  //$('#country_msdd').css("background-image", "url(images/select_bg4.png)");
                                  //$('#country_msdd').css("background-repeat", "no-repeat");
                                  //$('#person_msdd').css("background-position", "left");
                                  $('#country_msdd .borderRadiusTp span.arrow').css("background", "none");
								  $('#country_msdd #country_titleText').css("margin-top", "0");
								  $('#country_msdd').css("height", "24px"); 
								  $('#country_msdd').css("line-height", "14px");	 
								  
							})
					   		</script>
					   </div>
                    <div class="clr"></div>
                    <label><?=$LANG['Telephone']== NULL?'Telephone':$LANG['Telephone']?></label> <input name="phone" id="phone" type="text" class="validate[required,custom[phone]] text-input" value="<?php echo @$_POST['phone'];?>"/><div class="comment_cell"><?=$LANG['So the host can reach you']== NULL?'So the host can reach you':$LANG['So the host can reach you']?></div>
                    <div class="clr"></div>
                    <label><?=$LANG['Credit Card Type']== NULL?'Credit Card Type':$LANG['Credit Card Type']?></label>
                    <div class="comment_cell_crType text_box">
                    

                    <select name="credit_card" id="credit_card" class="" style="width:100%;">
                     <option value="AX">American Express</option>
                     <option value="VI">Visa</option>
                     <option value="CA">Master Card</option>
                     <option value="E">Electron</option>
                     <option value="T">Carta Si</option>
                     <option value="DC">DINERS CLUB INTERNATIONAL</option>
                    </select>

					 <script type="text/javascript">
					   $(document).ready(function(arg) {
								 //$("body select").msDropDown(
							 $("#credit_card").msDropDown();
							 $("#credit_card").hide();
                             //$('#credit_card').css("background-image", "url(images/select_bg4.png)");
                             $('#credit_card_msdd .borderRadiusTp span.arrow').css("background", "none");
							 //$('#credit_card_msdd').css("background-repeat", "no-repeat");
							 //$('#credit_card_msdd').css("background-position", "left");
							 $('#credit_card_msdd').css("height", "24px"); 
							 $('#credit_card_msdd').css("line-height", "14px");	 
							 
					   })
					  </script>
                        </div>
                    <label><?php echo $LANG['Credit Card Number']== NULL?'Credit Card Number':$LANG['Credit Card Number'] ;?></label><input name="credit_card_no" id="credit_card_no" type="text" class="validate[required] text-input" value="<?php echo @$_POST['credit_card_no'];?>"/>
			
                    <div class="clr"></div>
                    <label><?php echo $LANG['Card Holder Name']== NULL?'Card Holder Name':$LANG['Card Holder Name'] ;?></label><input name="card_holder_name" id="card_holder_name" type="text" class="validate[required] text-input" value="<?php echo @$_POST['card_holder_name'];?>"/>
			 <div class="clr"></div>
                    <label><?php echo $LANG['Expiry Date']== NULL?'Expiry Date':$LANG['Expiry Date'] ;?></label>
                    <div class="comment_cell_date text_box"> 
                    <select name="date_box" id="date_box" class="validate[required]" style="width:100%;">
                    <?php
                    for($k=1; $k<13; $k++){
					?>
                                    <option><?php echo $k;?></option>
                     <?php
                     }
					 ?>               
                                </select>
					 <script type="text/javascript">
                              $(document).ready(function(arg) {
                                        //$("body select").msDropDown(
                                    $("#date_box").msDropDown();
                                    $("#date_box").hide();
                                   // $('#date_box_msdd').css("background-image", "url(images/select_bg3.png)");
                                    $('#date_box_msdd .borderRadiusTp span.arrow').css("background", "none");
                                    //$('#date_box_msdd').css("background-repeat", "no-repeat");
                                    //$('#date_box_msdd').css("background-position", "left");
                                    $('#date_box_msdd').css("height", "24px"); 
                                    $('#date_box_msdd').css("line-height", "14px");	 
                                    $('#date_box_msdd').css("width", "88px");
                              })
                         </script>
                     </div>
                    
                     <div class="comment_cell_year text_box"> 
                    <select name="year_box" id="year_box" class="validate[required]" style="width:100%;">
							<?php
                            $year = date('Y');
							$j=10;
							for($i=0; $i<$j; $i++){
                            ?>
                                    <option><?php echo ($year+$i);?></option>
                            <?php
							}
							?>
                                </select>
					 <script type="text/javascript">
                              $(document).ready(function(arg) {
                                        //$("body select").msDropDown(
                                    $("#year_box").msDropDown();
                                    $("#year_box").hide();
                                    //$('#year_box_msdd').css("background-image", "url(images/select_bg3.png)");
                                    $('#year_box_msdd .borderRadiusTp span.arrow').css("background", "none");                      
                                    //$('#year_box_msdd').css("background-repeat", "no-repeat");
                                    //$('#year_box_msdd').css("background-position", "left");
                                    $('#year_box_msdd').css("height", "24px"); 
                                    $('#year_box_msdd').css("line-height", "14px");	 
                                    $('#year_box_msdd').css("width", "88px");
                              })
                         </script>
                         </div>
                   
                     <label  style="width:75px;"><?php echo $LANG['CVC Code']== NULL?'CVC Code':$LANG['CVC Code'] ;?></label>
                     <input type="text" name="cvccode" id="cvccode" class="validate[required] text-input" value="<?php echo @$_POST['cvccode'];?>" style="width:100px;" />
                    <div class="clr"></div>
               	<label>&nbsp;</label><input name="submit_button" type="submit" value="Continue" class="button_01 left" style="margin-top:10px;" /> 
				
				</form>
				
				
                    <div class="clr"></div>
               </div>
               <!--HOTEL RESERVATION END-->
               <div class="clr"></div>
