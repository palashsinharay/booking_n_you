<link type="text/css" rel="stylesheet" href="css/validationEngine.jquery.css" />
<script type="text/javascript" src="js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="js/languages/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script>jQuery.noConflict();</script>
<script>
jQuery(document).ready(function(){
	jQuery("#form1").validationEngine('attach');
});
</script>	
<div id="content">	
<div class="page_nav">
               	<p><?php echo $LANG['You are here']== NULL?'You are here':$LANG['You are here'] ;?>:&nbsp;&nbsp;<a href="<?php echo base_url(); ?>"><?php echo $LANG['Home']== NULL?'Home':$LANG['Home'] ;?></a>
				<?php if(!empty($country_name)) { ?><img src="<?php echo base_url(); ?>images/arrow2.png" alt="" />
				<?php echo $LANG['Hotels in']== NULL?'Hotels in':$LANG['Hotels in'] ;?>
                <a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$country.'/'.str_replace(" ","-",mb_strtolower($country_name, 'UTF-8'));
				?>"><?php echo $country_name;?></a><?php } ?>
				<?php if($state_province != "") { ?><img src="<?php echo base_url(); ?>images/arrow2.png" alt="" /><a href="javascript:void(0);"> <?php echo $state_province; ?></a> <?php } if($city != "") {?>
                <a href="<?php echo base_url().'hotelsummaries/hotel_search_by_city/'.$city.'/'.$country;?>"><?php echo $city;?></a>
                 <?php } if($name != "") { ?> <!--<span>[17 hotels]</span>-->  <img src="<?php echo base_url(); ?>images/arrow2.png" alt="" /> <a href="javascript:void(0);"><?php echo $name; ?>, <?php echo $city; } ?></a></p>
               </div>



	<!--HOTEL RESERVATION START-->
   <div class="reservation">
	<div class="tab">
			<a href="javascript:void(0);">1. <?php echo $LANG['Your room']== NULL?'Your room':$LANG['Your room'] ;?></a>
			 <a href="javascript:void(0);" class="select">2.  <?php echo $LANG['Your details']== NULL?'Your details':$LANG['Your details'] ;?></a>
			 <a href="javascript:void(0);">3. <?php echo $LANG['Confirm booking']== NULL?'Confirm booking':$LANG['Confirm booking'] ;?></a>
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
            <!--<img src="images/img_19.jpg" alt="" />--></div>
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
					  <td><?php echo $LANG['for']== NULL?'for':$LANG['for'] ;?></td>
					  <td><?php echo $no_of_nights;?> <?php echo $LANG['nights']== NULL?'nights':$LANG['nights'] ;?>, <?php echo $no_of_rooms;?> <?php echo $LANG['Rooms']== NULL?'Rooms':$LANG['Rooms'] ;?> , <?php echo $no_of_people;?> <?php echo $LANG['people']== NULL?'people':$LANG['people'] ;?></td>
					</tr>
				  </table>
					<div class="price"><?php echo $LANG['Total Price']== NULL?'Total Price':$LANG['Total Price'] ;?> : <span>  <?php echo $session->userdata('Currency_code');?> <?php echo number_format($total,2)?></span></div>
				  <div class="cell_04"><a href="javascript:void(0);"><?php echo $LANG['Booking Conditions']== NULL?'Booking Conditions':$LANG['Booking Conditions'] ;?></a></div>
				  <div class="clr"></div>
				  <p><?php echo $LANG['TAX']== NULL?'TAX':$LANG['TAX'] ;?> (15.15%) <?php echo $LANG['not included']== NULL?'not included':$LANG['not included'] ;?></p>
			 </div>
			 <div class="cell_03"><img src="<?php echo base_url(); ?>images/icon_21.png" alt="" /><?php echo $LANG['Best Price Guaranteed']== NULL?'Best Price Guaranteed':$LANG['Best Price Guaranteed'] ;?>  </div>
		</div>
		<div class="clr"></div>
		<div class="comment"><?php echo $LANG['Good news! With this room you get FREE cancellation before']== NULL?'Good news! With this room you get FREE cancellation before':$LANG['Good news! With this room you get FREE cancellation before'] ;?> August 9, 2013! <?php //echo $LANG['not included']== NULL?'not included':$LANG['not included'] ;?></div>
        <?php if(isset($session->userdata['LOGGEDIN_USER']['is_logged_in']) != 1){ ?>  
		 <div  id="ab1" style="cursor:pointer;color:#0C91E6;font-size:14px;text-align: right;margin-top:10px;" >Already have an account</div>
							<script>
                            $(document).ready(function() { 
								$('#ab1').click(function(){
								//$('#ab1').html("Want to create a new account? ")
								$('#as3').show();
								$('#as2').hide();
								$( '#pay_type3').removeAttr( "disabled" );
                           	 })
                            });
                           </script>
		<?php }?>
		<div id="as2">
            <form name="form1" id="form1" action="<?php echo base_url().'booking/index/'.$hotel_id.'/'.str_replace(" ","-",mb_strtolower($name, 'UTF-8')); ?>" method="post">
            <input type="hidden" name="no_of_rooms" id="no_of_rooms" value="<?php echo $no_of_rooms;?>" />
            <input type="hidden" name="no_of_people" id="no_of_people" value="<?php echo $no_of_people;?>" />
            <input type="hidden" name="total" id="total" value="<?php echo $total;?>" />
            <input type="hidden" name="rateKey" id="rateKey" value="<?php echo $rateKey;?>" />
            <input type="hidden" name="rateCode" id="rateCode" value="<?php echo $rateCode;?>" />
            <input type="hidden" name="roomTypeCode" id="roomTypeCode" value="<?php echo $roomTypeCode;?>" />
			<h2><?php echo $LANG['Your details']== NULL?'Your details':$LANG['Your details'] ;?></h2>
           <?php if(isset($session->userdata['LOGGEDIN_USER']['is_logged_in']) != 1){ ?>            
			<label><?php echo $LANG['First name']== NULL?'First name':$LANG['First name'] ;?></label><input name="fname" id="fname" type="text" class="validate[required] text-input" value="<?php echo @$_POST['fname'];?>"/>
			<div class="clr"></div>
			<label><?php echo $LANG['Last name']== NULL?'Last name':$LANG['Last name'] ;?></label><input name="lname" id="lname" type="text" class="validate[required] text-input" value="<?php echo @$_POST['lname'];?>"/>
			<div class="clr"></div>
			<label><?php echo $LANG['Email Address']== NULL?'Email Address':$LANG['Email Address'] ;?></label><input name="email" id="email" type="text" class="validate[required, custom[email]] text-input" value="<?php echo @$_POST['email'];?>"/><div class="comment_cell"><?php echo $LANG["You'll receive a confirmation email"]== NULL?"You'll receive a confirmation email":$LANG["You'll receive a confirmation email"] ;?></div>
			<div class="clr"></div>
			 <label><?php echo $LANG['Confirm email address']== NULL?'Confirm email address':$LANG['Confirm email address'] ;?></label><input name="confirm_email" id="confirm_email" class="validate[required,equals[email]] " type="text" value="<?php echo @$_POST['confirm_email'];?>"/>
			<div class="clr"></div>
            <label><?php echo $LANG['Password']== NULL?'Password':$LANG['Password'] ;?></label><input name="password" id="password" type="password" class="validate[required] text-input" value="<?php echo @$_POST['password'];?>"/>
            <div class="clr"></div>
			<?php } else {?>
            
            <label><?php echo $LANG['First name']== NULL?'First name':$LANG['First name'] ;?></label><input name="fname" readonly="readonly" id="fname" type="text" class="validate[required] text-input" value="<?php echo $session->userdata['LOGGEDIN_USER']['user_first_name']; ?>"/>
            <div class="clr"></div>
            <label><?php echo $LANG['Last name']== NULL?'Last name':$LANG['Last name'] ;?></label></label><input name="lname" readonly="readonly" id="lname" type="text" class="validate[required] text-input" value="<?php echo $session->userdata['LOGGEDIN_USER']['user_last_name'];?>"/>
            <div class="clr"></div>
            <label><?php echo $LANG['Email Address']== NULL?'Email Address':$LANG['Email Address'] ;?></label><input name="email" readonly="readonly" id="email" type="text" class="validate[required, custom[email]] text-input" value="<?php echo $session->userdata['LOGGEDIN_USER']['user_email_address'];?>"/><div class="comment_cell"><?php echo $LANG["You'll receive a confirmation email"]== NULL?"You'll receive a confirmation email":$LANG["You'll receive a confirmation email"] ;?></div>
            <div class="clr"></div>  
            <input name="confirm_email" id="confirm_email" class="validate[required,equals[email]] " type="hidden" value="<?php echo $session->userdata['LOGGEDIN_USER']['user_email_address'];?>"/>          
            <?php } ?>
			<!--<label>Room</label><div class="descrip_cell">
				<h6> Standard Twin Room - <span>FREE cancellation before August 9, 2011</span></h6>
				 <label style="margin-left:0px;">Full Guest Name</label><input name="guest_name" value="<?php echo @$_POST['guest_name'];?>" type="text"/>
				 <div class="clr"></div>
				 <h6>Max people<span style="margin-left:25px;">2 Guests</span></h6>
				 <h6>Smoking<span style="margin-left:40px;">Non Smoking Only</span></h6>
			</div>-->
             <label>&nbsp;</label>
                    	<div class="descrip_cell">
                              <h6><span><strong><?php echo $LANG['Room']== NULL?'Room':$LANG['Room'] ;?>:</strong></span> <?php echo $LANG['Suite']== NULL?'Suite':$LANG['Suite'] ;?> - <?php echo $LANG['Special conditions']== NULL?'Special conditions':$LANG['Special conditions'] ;?> / <?php echo $LANG['Breakfast included']== NULL?'Breakfast included':$LANG['Breakfast included'] ;?></h6>
                              <div class="clr"></div>
                              <?php
                              for($i=0; $i<$no_of_rooms; $i++){
							  ?>
                              <div class="descrip_cell">
                              <div class="left" style="width:250px;">
                              	<h5><?php echo $LANG['Full Guest Name']== NULL?'Full Guest Name':$LANG['Full Guest Name'] ;?></h5>
                              	<input name="guest_name[]" value="First name , Last name" onfocus="this.value=''" onblur="if(this.value==''){this.value='First name , Last name';}" type="text" style="float:none; margin-top:5px; font-size:11px; color:#666;"/>
                              </div>
                              <div class="left" style="width:140px;margin-left:10px;">
                              	<h5><?php echo $LANG['Max persons']== NULL?'Max persons':$LANG['Max persons'] ;?></h5>
                                   <h6>2 <?php echo $LANG['Guests']== NULL?'Guests':$LANG['Guests'] ;?></h6>
                              </div>
                              <div class="left" style="width:140px;margin-left:10px;" >
                              	<h5><?php echo $LANG['Smoking']== NULL?'Smoking':$LANG['Smoking'] ;?></h5>
                                   <h6><?php echo $LANG['Non Smoking Only']== NULL?'Non Smoking Only':$LANG['Non Smoking Only'] ;?></h6>
                              </div>
                              </div>
                              <?php }?>
                              <div class="clr"></div>
                    	</div>
			<div class="clr"></div>
			<label><?php echo $LANG['Special Requests']== NULL?'Special Requests':$LANG['Special Requests'] ;?></label> <textarea name="special_request"><?php echo @$_POST['special_request'];?></textarea><div class="comment_cell"><?php echo $LANG['Please write your requests in English or in the language of the hotel']== NULL?'Please write your requests in English or in the language of the hotel':$LANG['Please write your requests in English or in the language of the hotel'] ;?>. </div>
			<div class="clr"></div>
		<label>&nbsp;</label><input name="submit_button" type="submit" value="<?php echo $LANG['Continue']== NULL?'Continue':$LANG['Continue'] ;?>" class="button_01 left" style="margin-top:10px;" /> 
		</form>
		</div>
        <div  id="as3" style="display:none;">
        <script>
       $(document).ready(function() { 
        $("#form_login1").submit(function(){  
			var b_valid=true;
			var s_err="";
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			
			if($.trim($("#txt_username").val())== '')
			{
					s_err +='<div class="error_massage"><strong>Please provide username.</strong></div>';
					b_valid=false;
			  
			}
		   if($.trim($("#txt_password").val())== '')
			{
					s_err +='<div class="error_massage"><strong>Please provide password.</strong></div>';
					b_valid=false;
			 }
			if($.trim($("#txt_username").val())!= '' && $.trim($("#txt_password").val())!= '')
			{
				var txt_username = $.trim($("#txt_username").val());
				var txt_password = $.trim($("#txt_password").val());
				//alert(txt_username);    
				$.ajax({
						type: "POST",
						async: false,
						url: '<?php echo base_url()?>'+'user/login_check_booking',
						data: "s_username="+txt_username+"&s_password="+txt_password,
						success: function(msg){
							if(msg)
							{
							   document.location.reload(true);
							   
						   }
						}
					});
			}
			 if(!b_valid)
			{
				var destination = $('#div_err').offset().top;
				$("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination }, 1500, function() {});
				$("#div_err").html(s_err).show("slow");
			}       
			return b_valid;
		}); 
	 });
      </script>
        <form name="form_login1" id="form_login1" action=""  method="post" enctype="multipart/form-data">
        <h2> <?php echo $LANG['Your Login details']== NULL?'Your Login details':$LANG['Your Login details'] ;?></h2>
         <div id="div_err"></div>
        <label><?php echo $LANG['Email']== NULL?'Email':$LANG['Email'] ;?></label><input name="txt_username" id="txt_username" type="text"  value=""/>
       
			<div class="clr"></div>
			<label><?php echo $LANG['Password']== NULL?'Password':$LANG['Password'] ;?></label><input name="txt_password" id="txt_password" type="password" value=""/>
			<div class="clr"></div>
            <label>&nbsp;</label><input type="submit" value="Sign In" class="button_01 left" style="margin-top:15px;"  />
		  <div class="clr"></div>
        </form>
        </div>
		<div class="clr"></div>
   </div>
   <!--HOTEL RESERVATION END-->
   <div class="clr"></div>
  </div>