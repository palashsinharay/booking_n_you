<div id="content">	
<div class="page_nav">
               	<p></p>
               </div>
			<!--HOTEL RESERVATION START-->
               <div class="reservation">
               	<div class="tab">
                    	<a href="javascript:void(0);">1. <?php echo $LANG['Your room']== NULL?'Your room':$LANG['Your room'] ;?></a>
                         <a href="javascript:void(0);">2. <?php echo $LANG['Your details']== NULL?'Your details':$LANG['Your details'] ;?></a>
                         <a href="javascript:void(0);">3. <?php echo $LANG['Confirm booking']== NULL?'Confirm booking':$LANG['Confirm booking'] ;?></a>
                         <a href="javascript:void(0);" class="select">4. <?php echo $LANG['Booking complete']== NULL?'Booking complete':$LANG['Booking complete'] ;?></a>
                    </div>
                    <div class="heading">
                    	<div class="left_part"><?php echo $LANG['Your booking']== NULL?'Your booking':$LANG['Your booking'] ;?>&nbsp;<?php echo $LANG['details']== NULL?'details':$LANG['details'] ;?> </div>
                         <div class="right_part_new"><div class="fb-like" data-send="false" data-width="450" data-show-faces="false""></div></div>
                         <div class="clr"></div>
                    </div>
                    <div class="reservation_cont">
                    	<!--<div class="cell_01">-->
                        <div style="background-color:#fffff;margin:10px;padding:0;font-family:Arial,Helvetica,sans-serif">


<div style="width:100%">
<?php
$booking_result_data =  $session->userdata('booking_result'); 
if(isset($booking_result_data['itinerary_number']) && $booking_result_data['itinerary_number'] != ''){
?>
<table cellpadding="0" cellspacing="0" width="100%">
    <tbody><tr>
        <td>
        <div style="background:#faf4cd;margin:10px 0; border:1px solid #333; padding:10px">
            <table cellpadding="0" cellspacing="0" width="96%">
                <tbody><tr>
                    <td>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody><tr>

                            <td align="left" valign="top" width="70">
                            <?php
                            if(!empty($thumnailUrl)){
							?>
                            <img src="<?php echo $thumnailUrl;?>" alt="<?php echo $booking_result_data['hotelName'];?>" height="64" width="64">
                            <?php
							}else{
							?>
                            <img src="<?php echo base_url()?>images/no_image_thumb.jpg" alt="<?php echo $booking_result_data['hotelName'];?>" height="64" width="64">
                            <?php
							}
							?>
</td>
                            <td valign="top">
                            <font style="font:bold 16px arial" color="#000000" face="arial" size="3"><?php echo $booking_result_data['hotelName'];?></font>
                            <br>                                    
                            <img src="images/rating_star.png" alt="5" height="14" vspace="3" width="70">
                            <br>
                            <font style="font:normal 11px arial" color="#000000" face="arial" size="1"> <?php echo $booking_result_data['hotelAddress'];?> </font>
                            </td>
                        </tr>
                    </tbody></table>
                    </td>
                    <td align="right" valign="top">
                        
                    </td>
                </tr>
            </tbody></table>
            </div>

            <div style="background:#faf4cd;border: #333 1px solid;margin:10px 0;padding:10px">
                <p style="line-height:18px;font-size:16px;margin:0 0 20px 0;font-weight:bold;padding:0"><?php echo $LANG['YOUR RESERVATION HAS BEEN BOOKED']== NULL?'YOUR RESERVATION HAS BEEN BOOKED':$LANG['YOUR RESERVATION HAS BEEN BOOKED'] ;?>!</p>
                <table border="0" cellpadding="0" cellspacing="0" width="96%">
                        <tbody><tr>
                            <td valign="top">    <font style="font:bold 12px arial" color="#000000" face="arial" size="2"><?php echo $LANG['Your Itinerary Number']== NULL?'Your Itinerary Number':$LANG['Your Itinerary Number'] ;?>:</font>
</td>
                            <td valign="top">    <font style="font:bold 16px arial" color="#000000" face="arial" size="2"><?php echo $booking_result_data['itinerary_number'];?></font>
</td>
                        </tr>
                        <tr>

                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    <tr>
                        <td valign="top"><font style="font:bold 12px arial" color="#000000" face="arial" size="2"><?php //echo $LANG['Next']== NULL?'Next':$LANG['Next'] ;?><?php echo $LANG['Confirmation Number']== NULL?'Confirmation Number':$LANG['Confirmation Number'] ;?>(s):</font>
                        </td>
                        <td valign="top">    <font style="font:bold 12px arial" color="#000000" face="arial" size="2">
                                        	<?php echo $booking_result_data['confirmation_numbers'];?>
                                        	<?php echo $LANG['Guests']== NULL?'Guests':$LANG['Guests'] ;?>:
                                        	<?php echo $booking_result_data['firstName'].' '.$booking_result_data['lastName'];?> <br>
                                        	</font>
                        </td>
                    </tr>
                 </tbody></table>
                 <p style="margin:10px 0;padding:0"><font style="font:normal 11px arial" color="#000000" face="arial" size="1"><?php echo $LANG['Please refer to your itinerary number above if you contact Customer Service for any reason']== NULL?'Please refer to your itinerary number above if you contact Customer Service for any reason':$LANG['Please refer to your itinerary number above if you contact Customer Service for any reason'] ;?>.</font>
</p>
            </div>
            <div style="border:#333 1px solid;padding:10px 0;margin:0">
                <div style="background:#cccccc;border:#333 1px solid;border-bottom:#333 1px solid;margin:0 0 5px 0;padding:5px;font:bold 16px arial"><?php echo $LANG['RESERVATION DETAILS']== NULL?'RESERVATION DETAILS':$LANG['RESERVATION DETAILS'] ;?></div>
                <div style="margin:10px">
                    <table style="margin-top:15px" border="0" cellpadding="0" cellspacing="0" width="96%">
                        <tbody><tr>
                            <td style="padding-bottom:10px;padding-right:10px" width="50%">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td valign="top" width="70"><font style="font:normal 13px arial" color="#000000" face="arial" size="2"><?php echo $LANG['Check-in']== NULL?'Check-in':$LANG['Check-in'] ;?>:</font>
</td>
                                        <td style="line-height:12px" valign="top"><font style="font:bold 13px arial" color="#000000" face="arial" size="2"><?php echo $booking_result_data['arrivalDate'];?></font></td>
                                    </tr>
                                </tbody></table>
                            </td>
                            <td valign="top" width="50%"><font style="font:normal 12px arial" color="#000000" face="arial" size="2"><?php echo $booking_result_data['numberOfAdults'];?> <?php echo $LANG['Adults']== NULL?'Adults':$LANG['Adults'] ;?>, <?php echo $booking_result_data['numberOfChildren'];?> <?php echo $LANG['Children']== NULL?'Children':$LANG['Children'] ;?></font></td>
                        </tr>
                        <tr>
                            <td style="padding-right:10px" valign="top" width="50%">

                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td valign="top" width="70"><font style="font:normal 13px arial" color="#000000" face="arial" size="2"><?php echo $LANG['Check-out']== NULL?'Check-out':$LANG['Check-out'] ;?>:</font></td>
                                        <td style="line-height:12px" valign="top"><font style="font:bold 13px arial" color="#000000" face="arial" size="2"><?php echo $booking_result_data['departureDate'];?></font></td>
                                    </tr>
                                </tbody></table>
                            </td>

                            <td style="line-height:12px" valign="top" width="50%">
                                        <font style="font:normal 12px arial" color="#000000" face="arial" size="2"><?php echo $booking_result_data['roomDescription'];?></font><br>
                                        <font style="font:bold 11px arial" color="#000000" face="arial" size="1"><?php echo $LANG['Guests']== NULL?'Guests':$LANG['Guests'] ;?>:<?php echo $booking_result_data['firstName'].' '.$booking_result_data['lastName'];?></font>
                                    <div style="margin:10px 0"></div>
                        </td></tr>
                    </tbody></table>
    <div style="margin:10px 0;border-top:#333 1px solid"></div>
                    <table border="0" cellpadding="0" cellspacing="0" width="96%">

                        <tbody><tr>
                            <td style="padding-right:10px" valign="top" width="50%">
                                <table style="margin:0 0 10px 0" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td>
                                             <font style="font:bold 14px arial" color="#000000" face="arial" size="2"><?php echo $LANG['Rates per Room']== NULL?'Rates per Room':$LANG['Rates per Room'] ;?></font><br>
                                               <font style="font:normal 10px arial" color="#000000" face="arial" size="1">(<?php echo $LANG['excluding tax recovery charges and service fees']== NULL?'excluding tax recovery charges and service fees':$LANG['excluding tax recovery charges and service fees'] ;?>)</font>
                                            <div style="margin:10px 20px">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody></table>


    <div style="margin:10px 0;border-top:#333 1px solid"></div>

                                <table style="margin:0 0 10px 0" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    	<tbody><tr>
                                        	<td>
                                                    <font style="font:bold 12px arial" color="#000000" face="arial" size="2"><?php echo $LANG['Tax Recovery Charges']== NULL?'Tax Recovery Charges':$LANG['Tax Recovery Charges'] ;?> <?php echo $LANG['and']== NULL?'and':$LANG['and'] ;?><br> <?php echo $LANG['Service Fees']== NULL?'Service Fees':$LANG['Service Fees'] ;?></font>

                                        </td>
                                        <td align="right" valign="top">
                                                <font style="font:normal 12px arial" color="#000000" face="arial" size="2"><?php echo $booking_result_data['currencyCode'];?> <?php echo $booking_result_data['tax_amount'];?></font>
                                                <font style="font:normal 11px arial;color:#999999" color="#999999" face="arial" size="1"><?php //echo $LANG['USD']== NULL?'USD':$LANG['USD'] ;?></font><br>
                                        </td>
                                    </tr>
                                </tbody></table>

    <div style="margin:10px 0;border-top:#333 1px solid"></div>

                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td>
                                            <font style="font:normal 12px arial" color="#000000" face="arial" size="2"><?php echo $LANG['Total Charges']== NULL?'Total Charges':$LANG['Total Charges'] ;?></font>
<br>

                                            
                                            <br>
    <font style="font:normal 10px arial" color="#000000" face="arial" size="1">
 
 <?php echo $LANG['The above charges to your credit card were made by Travelscape, LLC. To view our full Terms & Conditions, please go to our page']== NULL?'The above charges to your credit card were made by Travelscape, LLC. To view our full Terms & Conditions, please go to our page':$LANG['The above charges to your credit card were made by Travelscape, LLC. To view our full Terms & Conditions, please go to our page'] ;?>
		
</font>
                                        </td>
                                        <td align="right" valign="top">
                                                <font style="font:bold 12px arial" color="#000000" face="arial" size="2"><?php echo $booking_result_data['currencyCode'].''.$booking_result_data['total'];?></font>

                                                <font style="font:normal 11px arial;color:#999999" color="#999999" face="arial" size="1"><?php //echo $LANG['USD']== NULL?'USD':$LANG['USD'] ;?></font>
<br>
                                        </td>
                                    </tr>

                                </tbody></table><br>
                            </td>
                            <!--<td valign="top" width="50%">

                                    <font style="font:bold 14px arial" color="#000000" face="arial" size="2">Payment Information</font>

                                <table style="margin:10px 0" border="0" cellpadding="3" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td>    <font style="font:normal 12px arial" color="#000000" face="arial" size="2">Payment Method:</font>
</td>
                                        <td align="right">    <font style="font:bold 12px arial" color="#000000" face="arial" size="2">Visa</font>
</td>
                                    </tr>
                                    <tr>
                                        <td>    <font style="font:normal 12px arial" color="#000000" face="arial" size="2">Card Number:</font>
</td>
                                        <td align="right">    <font style="font:bold 12px arial" color="#000000" face="arial" size="2">************1111</font>
</td>
                                    </tr>
                                    <tr>

                                        <td>    <font style="font:normal 12px arial" color="#000000" face="arial" size="2">Amount Charged:</font>

                                        </td><td align="right">    <font style="font:bold 12px arial" color="#000000" face="arial" size="2">$214.06</font>

                                            <font style="font:normal 11px arial;color:#999999" color="#999999" face="arial" size="1">USD</font>
</td>
                                    </tr>
                                    <tr>
                                        <td>    <font style="font:normal 12px arial" color="#000000" face="arial" size="2">Balance Due:</font>

                                        </td><td align="right">    <font style="font:bold 12px arial" color="#000000" face="arial" size="2">$0.00</font>

                                            <font style="font:normal 11px arial;color:#999999" color="#999999" face="arial" size="1">USD</font>
</td>
                                    </tr>
                                </tbody></table>

                                    <font style="font:bold 14px arial" color="#000000" face="arial" size="2">Billing Information</font>

                                <table style="margin:10px 0" border="0" cellpadding="3" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td>    <font style="font:normal 12px arial" color="#000000" face="arial" size="2">Billing Name:</font>
</td>
                                        <td align="right">    <font style="font:bold 12px arial" color="#000000" face="arial" size="2">Kafil&nbsp;Siddiqui</font>
</td>

                                    </tr>
                                    <tr>
                                        <td valign="top">    <font style="font:normal 11px arial" color="#000000" face="arial" size="2">Billing Address:</font>

                                        </td><td align="right">    <font style="font:normal 11px arial" color="#000000" face="arial" size="2">       travelnow
<br>
        Kolkata&nbsp;NU&nbsp;700019<br>
</font>
</td>
                                    </tr>
                                    <tr>
                                        <td>    <font style="font:normal 11px arial" color="#000000" face="arial" size="2">Phone Number:</font>

                                        </td><td align="right">    <font style="font:normal 11px arial" color="#000000" face="arial" size="2">033689856</font>
</td>
                                    </tr>
                                    <tr>
                                        <td>    <font style="font:normal 11px arial" color="#000000" face="arial" size="2">Email Address:</font>

                                        </td><td align="right">    <font style="font:normal 11px arial" color="#000000" face="arial" size="2"><a href="mailto:kafils@gmail.com" target="_blank">kafils@gmail.com</a></font>
</td>
                                    </tr>
                                </tbody></table>
                            </td>-->
                        </tr>
                    </tbody></table>
                </div>


    <div style="background:#cccccc;border-top:#3331px solid;border-bottom:#333 1px solid;margin:0 0 5px 0;padding:5px;font:bold 12px arial"><?php echo $LANG['Cancellation']== NULL?'Cancellation':$LANG['Cancellation'] ;?>&nbsp;<?php echo $LANG['Policy']== NULL?'Policy':$LANG['Policy'] ;?></div>
        <p style="line-height:1.25;font:normal 11px arial;margin:0 7px 7px 7px;padding:0"><?php echo $booking_result_data['cancellationPolicy'];?></p>
                
    <div style="margin:10px 0;border-top:#333 1px solid"></div>
                        <p style="line-height:1.25;font:normal 11px arial;margin:0 7px 7px 7px;padding:0"></p>

                

            </div>
        </td>
    </tr>
</tbody></table>

<?php
}else{
?>
 <div style="border:1px dashed red; background:#fcfccc; font-size:13px; color:red; font-weight:bold; padding:5px; width:100%;">bookingandyou.com unable to process your booking request<br />
<?php echo $booking_result_data['error'];?>
</div>
<?php
}
?>
<div class="yj6qo"></div><div class="adL">

</div></div><div class="adL">

</div></div>
                      
         <div class="cell_02">
              <div class="clr"></div>
         </div>
    </div>
    <div class="clr"></div>
    <div class="clr"></div>
</div>
<!--HOTEL RESERVATION END-->
<div class="clr"></div>
</div>