<?php
//date_default_timezone_set('Europe/London');
$search_checkin_date = $session->userdata('search_checkin_date');
$search_checkout_date = $session->userdata('search_checkout_date');
$search_city = $session->userdata('search_city');

$start_date = date('m-d-Y');
$end_date = date('m-d-Y', strtotime(date('Y-m-d').' +1 Weekday'));

$rooms 		 = $session->userdata('rooms');
$room_adults = $session->userdata('room_adults');
$room_childs = $session->userdata('room_childs');
?>
<script language="javascript">
var img_root_path = '<?php echo base_url(); ?>';
var root_path = '<?php echo base_url(); ?>';

function get_location_name(inputString) {
		var p = $("#txt_location");
		var offset = p.offset();
		if(inputString.length>1) {	
			var opt_location = $("#txt_location").val();
			$.post("<?php echo base_url()?>location/ajax_autocomplete_location/"+opt_location+"/", {queryString: "" + inputString + ""}, function(data){
					if(data.length >0) {
					
						$('#suggestionsSearch').show();
						$('#autoSuggestionsListSearch').html(data);
						$('#suggestionsSearch').css('left',offset.left);
					}
					else
					{
						$('#suggestionsSearch').hide();
					}
				});
			}
			else
				$('#suggestionsSearch').hide();	
} 
function business_fill(thisValue) {
		var b=new Array();
		b["&amp;"]="&";
		b["&quot;"]='"';
		b["&#039;"]="'";
		b["&lt;"]="<";
		b["&gt;"]=">";
		var r;
		for(var i in b){
			r=new RegExp(i,"g");
			thisValue = thisValue.replace(r,b[i]);
		}
		var prop_val = thisValue.split('^');		
		
		$('#location_id').val(prop_val[1]);
		$('#txt_location').val(prop_val[0]);
		$('#suggestionsSearch').hide();
		
}
function send_url(frm) {
    var search_location = document.getElementById('txt_location').value;
    var b_valid=true;
    var s_err="";
    var s_err1="";
    if(search_location == "") 
    {
        s_err +='<div style="font-size:12px;color:#B30000;font-weight: bold;">Please enter the location to start searching.</div>';
        b_valid=false;
    }
     if(document.getElementById('sp_dates').checked == false && document.getElementById('start-date').value == "")
    {
        s_err1 +='<div style="font-size:12px;color:#B30000;">Please enter checkin and checkout dates.</div>';
        b_valid=false;
    }
    
    var split_location = search_location.split(",");
    //alert(split_location.length);
    if(split_location.length == 3) {
        var city = split_location[0];
        var state = split_location[1];
        var country = split_location[2];
    } else if(split_location.length == 2) {
        var city = split_location[0];        
        var state = "All";
        var country = split_location[1];
    } else {
        var city = split_location[0];
        var state = "All";
        var country = "All";
    }
    
    if(document.getElementById('start-date').value != "") {
        var start_date = document.getElementById('start-date').value;
    } else {
        var start_date = '<?php echo date("m-d-Y"); ?>';
    }
    
    if(document.getElementById('end-date').value != "") {
        var end_date = document.getElementById('end-date').value;
    } else {
        var end_date = "<?php echo date('m-d-Y', strtotime(date("Y-m-d").' +1 Weekday')); ?>";
    }
    
    if(frm == "0") {
        var sortby = '0';  
    } else if(frm == "1") {
        var sortby = '1'; 
    }else if(frm == "2") {
        var sortby = '2'; 
    }else if(frm == "3") {
        var sortby = '3'; 
    }else if(frm == "5") {
        var sortby = '5'; 
    }else if(frm == "7") {
        var sortby = '7'; 
    }else {
        var sortby = '4';  
    }  
    
    
    var amenitylist = "All";
    var starratelist = "All";
    var propertytypelist = "All";
    var chaincodelist = "All";
    var pricerangelist = "All";
	var numRooms    = document.getElementById('rooms2').value;
    var room_adults = document.getElementById('adult2').value;
    var room_childs = document.getElementById('child2').value;      
    
    var    search_string = 'city='+city+'&state_province='+state+'&country='+country+'&checkin_date='+start_date+'&checkout_date='+end_date+'&amenity='+amenitylist+'&starrate='+starratelist+'&sortby='+sortby+'&propertytype='+propertytypelist+'&chaincode='+chaincodelist+'&pricerange='+pricerangelist+'&rooms='+numRooms+'&room_adults='+room_adults+'&room_childs='+room_childs;
    
    
    if(!b_valid)
    {
        $(function()
        {
            $("#div_err").html(s_err).show("slow");
            $("#div_err1").html(s_err1).show("slow");
        });
    }
    else{
     window.location = '<?php echo base_url(); ?>hotelsummaries/search_result/'+search_string;    
    }
}
</script>
<script type="text/javascript" charset="utf-8">
$(function(){
	$('.date-pick').datePicker({clickInput:true})
	$('#start-date').bind(
		'dpClosed',
		function(e, selectedDates)
		{
			var d = selectedDates[0];
			if (d) {
					d = new Date(d);
					console.log(d);
					d.setDate(d.getDate() + 1);
					
					var mth = (d.getMonth() + 1);
					//var mth = ((d.getMonth().length+1) === 1)? (d.getMonth()+1) : '0' + (d.getMonth()+1);
					var day = d.getDate();
					//var day = ((d.getDate().length) === 1)? (d.getDate()) : '0' + (d.getDate());
					var yr = d.getFullYear();
					
					$('#end-date').val( strpad00(mth)+ '-' + strpad00(day) + '-' + yr );
					$('#end-date').dpSetStartDate(d.addDays(0).asString())
				}
		}
	);
	$('#end-date').bind(
		'dpClosed',
		function(e, selectedDates)
		{
			var d = selectedDates[0];
			if (d) {
				d = new Date(d);
				$('#start-date').dpSetEndDate(d.addDays(-1).asString());
			}
		}
	);
	
	$('#checkin-date').bind(
		'dpClosed',
		function(e, selectedDates)
		{
			var d = selectedDates[0];
			if (d) {
				d = new Date(d);
				$('#checkout-date').dpSetStartDate(d.addDays(1).asString());
			}
		}
	);
	$('#checkout-date').bind(
		'dpClosed',
		function(e, selectedDates)
		{
			var d = selectedDates[0];
			if (d) {
				d = new Date(d);
				$('#checkin-date').dpSetEndDate(d.addDays(-1).asString());
			}
		}
	);
});

function check_dates_validation(){
	if(document.getElementById('checkin-date').value != '' && document.getElementById('checkout-date').value != ''){
	 document.form_check_booking.submit();
	}
}
function check_no_rooms(id){
	var numRm = document.getElementById('room' + id ).value;
	//alert(numRm.charAt(0));
	if(numRm.charAt(0) != 0){
			$('.borderRadius').css({'border':'none'});
			document.form_booking.submit();
		}else{
			//alert(chks.charAt(0));
			$('.borderRadius').css({'border':'none'});
			document.getElementById('room' + id + '_msdd').style.border = '2px solid red';
			//alert('Please select one or more rooms you want to book');	
			return false;
		}	
}






/*$(document).ready(function(){
  $(".zoom_image").hover(function(e){
  							// alert("calling");$.each	
                             $("#loadarea_new").show(2000);
                             $("#loadarea_new").offset({left:e.pageX,top:e.pageY});

                             })
  $(".zoom_image").mouseout(function(e){
  							// alert("calling");	
                             $("#loadarea_new").hide();
                             })							 
})
*/
</script> 


<!-- Ativando o jQuery lightBox plugin -->
   
 		
<style type="text/css">
	/* located in demo.css and creates a little calendar icon
	 * instead of a text link for "Choose date"
	 */
	a.dp-choose-date {
		float: left;
		width: 25px;
		height: 25px;
		padding: 0;
		margin: 5px 3px 0;
		display: block;
		text-indent: -2000px;
		overflow: hidden;
		background: url("<?php echo base_url();?>images/calendar_icon.png") no-repeat; 
	}
	a.dp-choose-date.dp-disabled {
		background-position: 0 -20px;
		cursor: default;
	}
	/* makes the input field shorter once the date picker code
	 * has run (to allow space for the calendar icon
	 */
	input.dp-applied {
		width: 140px;
		float: left;
	}
</style>
	<!--CONTENT SECTION START-->
     	<div id="content">
		<div class="page_nav">
               	<p><?=$LANG['You are here']== NULL?'You are here':$LANG['You are here']?>:&nbsp;&nbsp;<a href="<?php echo base_url(); ?>"><?=$LANG['Home']== NULL?'Home':$LANG['Home']?></a>
				<?php if(!empty($country_name)) { ?><img src="<?php echo base_url(); ?>images/arrow2.png" alt="" />
				<?=$LANG['Hotels in']== NULL?'Hotels in':$LANG['Hotels in']?>
                <a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$country.'/'.str_replace(" ","-",mb_strtolower($country_name, 'UTF-8'));?>"><?php echo $country_name;?></a><?php } ?>
				<?php if($state_province != "") { ?><img src="<?php echo base_url(); ?>images/arrow2.png" alt="" /><a href="javascript:void(0);"> <?php echo $state_province; ?></a> <?php } if($city != "") {?>
                <a href="<?php echo base_url().'hotelsummaries/hotel_search_by_city/'.$city.'/'.$country;?>"><?php echo $city;?></a>
                 <?php } if($name != "") { ?> <!--<span>[17 hotels]</span>-->  <img src="<?php echo base_url(); ?>images/arrow2.png" alt="" /> <a href="javascript:void(0);"><?php echo $name; ?>, <?php echo $city; } ?></a></p>
               </div>
          	<!--LEFT PANEL START-->
               	<div class="left_panel_02">
                    <!--HOTEL SEARCH START-->
					<?php echo form_open_multipart('hotelsummaries/search_result',array("id"=>"search_result_form"));?>
                    	<div class="hetel_search">
                             <h3 style="font-size:17px;"><img src="<?php echo base_url(); ?>images/i_glass.png" alt="" /> <?=$LANG['Search Hotels']== NULL?'Search Hotels':$LANG['Search Hotels']?></h3>
                             <p><?=$LANG['Where']== NULL?'Where':$LANG['Where']?> ?</p> 
                             <?php
							 $Location = "";
							 if($search_city != "") { if($Location == "") { $Location = $search_city; } else { $Location = $Location.",".$search_city; } }
							// if($search_state != "") { if($Location == "") { $Location = $search_state; } else { $Location = $Location.",".$search_state; } }
							 if(isset($search_countryname) && $search_countryname != "") { if($Location == "") { $Location = $search_countryname; } else { $Location = $Location.",".$search_countryname; } }
							 $Location = str_ireplace("%20"," ",$Location);
							 ?>
							 <input type="text" name="txt_location" id="txt_location" onkeyup="get_location_name(this.value)" value="<?php echo $Location;?>"  autocomplete="off" />
                            <input type="hidden" name="location_id" id="location_id"  />
                            <div id="suggestionsSearch" class="suggestionsBox2" style="display:none;">
                            <div class="arrow_autocom" style="height:2px;">&nbsp;</div>
                            <!--<div class="suggestionList" id="autoSuggestionsListSearch" style="height:130px; overflow:auto;">&nbsp;</div>-->
                            <div class="suggestionList" id="autoSuggestionsListSearch">&nbsp;</div>
                            </div>
                              <div class="clr"></div>
                              <p class="top_margin10"><?=$LANG['Check-In Date']== NULL?'Check-In Date':$LANG['Check-In Date']?></p>
                              <div class="select_box" style="width:130px;">
								<input type="text" style="width: 88px;" class="date-pick dp-applied" id="start-date" name="start-date" value="<?php echo $search_checkin_date; ?>" readonly="readonly">
                               </div>
                                <div class="select_box"></div>                                   
                               <div class="clr"></div>
                               <p class="top_margin10"><?=$LANG['Check-Out Date']== NULL?'Check-Out Date':$LANG['Check-Out Date']?></p>
                              <div class="select_box" style="width:130px;">
                              <input type="text" style="width: 88px;" class="date-pick dp-applied" id="end-date" name="end-date" value="<?php echo $search_checkout_date; ?>" readonly="readonly">
                               </div>
                                <div class="select_box"></div>                                   
                                <div class="clr"></div>
                               
                                 <p class="margin_10_tb"><span style="padding-left:2px;"><?=$LANG['Rooms']== NULL?'Rooms':$LANG['Rooms']?></span><span style="margin-left:5px; padding-left:15px;"><?=$LANG['Adults']== NULL?'Adults':$LANG['Adults']?></span><span style="margin-left:20px; padding-left:13px;"><?=$LANG['Children']== NULL?'Children':$LANG['Children']?></span></p>
                                 <div class="clr"></div>
                                <p>
                                  <select name="rooms2[]" id="rooms2" style="width:50px; float:left; background: #FFFFFF;">
										<option value="1" <?php if($rooms == 1){echo "Selected";}?>>1</option>
										<option value="2" <?php if($rooms == 2){echo "Selected";}?>>2</option>
										<option value="3" <?php if($rooms == 3){echo "Selected";}?>>3</option>
										<option value="4" <?php if($rooms == 4){echo "Selected";}?>>4</option>
										<option value="5" <?php if($rooms == 5){echo "Selected";}?>>5</option>
										<option value="6" <?php if($rooms == 6){echo "Selected";}?>>6</option>
										<option value="7" <?php if($rooms == 7){echo "Selected";}?>>7</option>
										<option value="8" <?php if($rooms == 8){echo "Selected";}?>>8</option>
										<option value="9" <?php if($rooms == 9){echo "Selected";}?>>9</option>
										<option value="10" <?php if($rooms == 10){echo "Selected";}?>>10</option>
									</select>
                                    
                                    
                                
                                 <select name="adult2[]" id="adult2" style="width:50px; float:left; margin-left:10px;background: #FFFFFF;">
								  		<!--<option value="0" <?php if($room_adults == 0){echo "Selected";}?>>0</option>-->
										<option value="1" <?php if($room_adults == 1){echo "Selected";}?>>1</option>
										<option value="2" <?php if($room_adults == 2){echo "Selected";}?>>2</option>
										<option value="3" <?php if($room_adults == 3){echo "Selected";}?>>3</option>
										<option value="4" <?php if($room_adults == 4){echo "Selected";}?>>4</option>
										<option value="5" <?php if($room_adults == 5){echo "Selected";}?>>5</option>
										<option value="6" <?php if($room_adults == 6){echo "Selected";}?>>6</option>
										<option value="7" <?php if($room_adults == 7){echo "Selected";}?>>7</option>
										<option value="8" <?php if($room_adults == 8){echo "Selected";}?>>8</option>
										<option value="9" <?php if($room_adults == 9){echo "Selected";}?>>9</option>
										<option value="10" <?php if($room_adults == 10){echo "Selected";}?>>10</option>
									</select>
                                   
                                    
                                    <select name="child2[]" id="child2" style="width:50px; float:left; margin-left:20px;background: #FFFFFF;">
										<option value="0" <?php if($room_childs == 0){echo "Selected";}?>>0</option>
										<option value="1" <?php if($room_childs == 1){echo "Selected";}?>>1</option>
										<option value="2" <?php if($room_childs == 2){echo "Selected";}?>>2</option>
										<option value="3" <?php if($room_childs == 3){echo "Selected";}?>>3</option>
										<option value="4" <?php if($room_childs == 4){echo "Selected";}?>>4</option>
										<option value="5" <?php if($room_childs == 5){echo "Selected";}?>>5</option>
										<option value="6" <?php if($room_childs == 6){echo "Selected";}?>>6</option>
										<option value="7" <?php if($room_childs == 7){echo "Selected";}?>>7</option>
										<option value="8" <?php if($room_childs == 8){echo "Selected";}?>>8</option>
										<option value="9" <?php if($room_childs == 9){echo "Selected";}?>>9</option>
										<option value="10" <?php if($room_childs == 10){echo "Selected";}?>>10</option>
									</select>
                                    <script type="text/javascript">
                                        $(document).ready(function(arg) {
                                              $("#rooms2").msDropDown();                                              
                                              $("#adult2").msDropDown();                                              
                                              $("#child2").msDropDown();                                              
                                        })                                    
                                    </script>
                                     </p>   
                                 <!--<h6>Room-2 <span>1 Adults</span> <span>0 Children</span></h6>
                                 <h6><a href="javascript:void(0);"  onclick="show_div()"><?=$LANG['Change Selection']== NULL?'Change Selection':$LANG['Change Selection']?></a></h6> 
                                 <h6><a href="javascript:void(0);"><?=$LANG['Clear Selection']== NULL?'Clear Selection':$LANG['Clear Selection']?></a></h6> -->
                              <div class="clr"></div>
                               <p class="top_margin"><input type="checkbox" name="sp_dates" id="sp_dates"  /> <?=$LANG["I don't have specific dates yet"]== NULL?"I don't have specific dates yet":$LANG["I don't have specific dates yet"]?>  </p> 
                               <input type="button" value="<?php echo $LANG['Search']== NULL?'Search':$LANG['Search'] ;?>" class="button_01 top_margin" name="search_button" onclick="send_url(this.form);" />

                         </div>
					  <?php echo form_close();?>
                   <!--HOTEL SEARCH END-->
                  
                  <!--MAP START-->
                      <div class="blue_box filter">
                        	<h3><?=$LANG['Map']== NULL?'Map':$LANG['Map']?></h3>
                            <div class="inner_box" id="map_canvas" style="height:210px; width:222px;"></div>
                            <script language="javascript">
                                googleMap('<?php echo $latitude; ?>', '<?php echo $longitude; ?>', 14);
                            </script>                            
                         <div class="more_link"><?php echo $LANG['Show']== NULL?'Show':$LANG['Show']; ?> "<?php echo $name; ?>" <?php echo $LANG['on a map of']== NULL?'on a map of':$LANG['on a map of']; ?> <?php echo $city; ?></div>
                         <div class="more_link"><a href="javascript:void(0);"><?php echo insertStaticWord('Print Map'); ?></a></div>
                      </div> 
                 <!--MAP END-->
                 <!--IN AND AROUND-->
                 <?php //var_dump($airport);
				 if($monument!=NULL || $stadium!=NULL || $airport!=NULL){ ?>     
                      <div class="blue_box filter">
                      	<h3><?php echo $LANG['In and around']== NULL?'In and around':$LANG['In and around'] ;?> <img src="<?php echo base_url(); ?>images/icon_05.png" alt="" /></h3>
                        <div class="inner_box">
                         <?php if($monument!=NULL){?>	
                            <h6><?php echo $LANG['Monuments or landmarks']== NULL?'Monuments or landmarks':$LANG['Monuments or landmarks'] ;?></h6>
                            <?php
                            foreach ($monument as $value) {
                             ?>
                            <p><a href="javascript:void(0);"><?php echo $value['region_name'];?></a></p>
                            <?php
                                }                            
                            ?>
     
                         <?php } ?>   
                            <?php if($stadium!=NULL){?>
                            <h6>Stadiums or Arenas</h6>
                            <?php
                            foreach ($stadium as $value) {
                             ?>
                              
                              <p><a href="javascript:void(0);"><?php echo $value['region_name'];?></a></p>
                              <?php
                                }                            
                            ?>
                            <?php } ?>  
                              <?php if($airport!=NULL){?>
                              <h6><?php echo $LANG['Airport']== NULL?'Airport':$LANG['Airport'] ;?></h6>
                              <p><a href="javascript:void(0);"><?php echo $airport;?></a></p>
                             <?php } ?> 
                         </div>
                      </div>  
                  <?php } ?>
              <!--MY VIEWED HOTEL-->
					<?php if((count($User_View_cookie_data) > 0) && ($User_View_cookie_data != "")) { ?>
                      <div class="blue_box filter">
                        	<h3><?=$LANG['My Viewed Hotels']== NULL?'My Viewed Hotels':$LANG['My Viewed Hotels']?></h3>
                         <div class="inner_box">
						 <?php foreach($User_View_cookie_data as $My_Viewed_Val) { ?>
						 
                         	<div class="viewed_row">
                              	<div class="img_box">
								<?php 
                                if(!empty($My_Viewed_Val->thumbnail_url)){?>
                                <a  href="<?php echo base_url().'hotel-details/'.$My_Viewed_Val->ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($My_Viewed_Val->name, 'UTF-8'))?>"><img  src="<?php echo $My_Viewed_Val->thumbnail_url?>" width="40" height="40" alt="" title="" border="0"  /></a>
                               <?php }else{?> <a  href="<?php echo base_url().'hotel-details/'.$My_Viewed_Val->ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($My_Viewed_Val->name, 'UTF-8'))?>"><img  src="<?php echo base_url()?>images/no_image_thumb.jpg" width="40" height="40" alt="" title="" border="0"  /></a><?php } ?>
								</div>
                                   <div class="text_box">
									<a class="close_btn" href="<?php echo base_url().'hotelsummaries/delete_user_viewed_hotel/'.$My_Viewed_Val->ean_hotel_id?>" onclick="alert('Are you sure you want to delete the hotel from your viewlist')"><img  src="<?php echo base_url(); ?>images/icon_03.png" alt="delete" title="delete"  /></a>
                                        <h5><a href="<?php echo base_url().'hotel-details/'.$My_Viewed_Val->ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($My_Viewed_Val->name, 'UTF-8'))?>"><?php echo $My_Viewed_Val->name;?></a></h5>
                                        <div><img src="<?php echo base_url(); ?>images/<?php echo str_replace(".","",$My_Viewed_Val->star_rating)?>_stars.png" alt="" /></div>
                                   	<p>
									<?php if($My_Viewed_Val->address1 != ""){ echo $My_Viewed_Val->address1; } ?><?php if($My_Viewed_Val->city != "") { echo ", ".$My_Viewed_Val->city; } ?><?php if($My_Viewed_Val->country != "") { echo ", ".$My_Viewed_Val->countryname;} ?><?php if($My_Viewed_Val->postal_code != "") { echo ", ".$My_Viewed_Val->postal_code; }?>
									<!--<br /><a href="javascript:void(0);" ><em><?=$LANG['Show Map']== NULL?'Show Map':$LANG['Show Map']?></em></a>-->
                                    </p>
                                        <div class="review"><?php echo getReviewRating($My_Viewed_Val->ean_hotel_id); ?></div>
                                        <!--<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="<?php echo base_url(); ?>images/icon_02.png" alt="" /></div>-->
										<?php if(getBookingTime($My_Viewed_Val->ean_hotel_id)!=""){ ?>
										<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>:  <?php 
										echo getBookingTime($My_Viewed_Val->ean_hotel_id); ?> ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
										<?php } ?>										
                                   </div>
                                   <div class="clr"></div>
                              </div>
							<?php } ?>
                              <div class="delete_all"><a href="javascript:void(0);"> <?php echo $LANG['Delete All']== NULL?'Delete All':$LANG['Delete All'] ;?><img alt="" src="<?php echo base_url(); ?>images/icon_03.png"></a></div>
                         </div>
                      </div>
                      <?php } ?>
                 <!--RECENT BOOKED-->
                 
                 	
					<?php
                    if(isset($Recently_Booked_Hotel_Id) && count($Recently_Booked_Hotel_Id)>0){
                    ?>
                    <div class="blue_box filter">
                    	<h3 style=" line-height:22px;"><?=$LANG['Recently booked in']== NULL?'Recently booked in':$LANG['Recently booked in']?> <?php echo $search_city;?> </h3>
                    	 <?
						 $this->load->model('Destination_model');
                         foreach($Recently_Booked_Hotel_Id as $Hotel_Id){
							 $HotelData = $this->Destination_model->hotel_by_id($Hotel_Id);
							 if(count($HotelData) > 0){
							 //print_r($HotelData); die();
							 $to_Currency = $session->userdata('Currency_code');
							 $from_Currency = $HotelData['property_currency'];
							 $amount = $HotelData['low_rate'];
							 $low_rate = currency($from_Currency,$to_Currency,$amount); 
						 ?>
                        <div class="recent_book">
                         	<div class="img_cell">
							<?php 
                                if(!empty($HotelData['thumbnail_url'])){?>
                                <a  href="<?php echo base_url().'hotel-details/'.$HotelData['ean_hotel_id'].'/'.str_replace(" ","-",mb_strtolower($HotelData['name'], 'UTF-8'));
								?>"><img  src="<?php echo $HotelData['thumbnail_url'];?>" width="40" height="40" alt="" title="" border="0"  /></a>
                               <?php }else{?> <a  href="<?php echo base_url().'hotel-details/'.$HotelData['ean_hotel_id'].'/'.str_replace(" ","-",mb_strtolower($HotelData['name'], 'UTF-8')) ?>"><img  src="<?php echo base_url()?>images/no_image_thumb.jpg" width="40" height="40"  alt="" title="" border="0"  /></a><?php } ?>
                                   </div>
                              <div class="text_cell" style="padding-left:6px;">
                              	<h5><a href="<?php echo base_url().'hotel-details/'.$HotelData['ean_hotel_id'].'/'.str_replace(" ","-",mb_strtolower($HotelData['name'], 'UTF-8'))?>"><?php echo $HotelData["name"];?></a> <img src="images/<?php echo str_replace(".","",$HotelData["star_rating"])?>_stars.png" alt="" /></h5>
                                   <!--<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="<?php echo base_url(); ?>images/icon_02.png" alt="" /></div>-->
								   
										<?php if(getBookingTime($HotelData['ean_hotel_id'])!=""){ ?>
										<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>:  <?php 
										echo getBookingTime($HotelData['ean_hotel_id']); ?> ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
										<?php } ?>								   
								   
                              </div>
                         </div>
                         <?php
						 } }
						 ?>
                       
                         <div class="clr"></div>
                         </div>
                     <?php
					}else{/*
					 ?>   
                    <div class="blue_box filter">
                    <h3 style=" line-height:22px; color:#F00;"><?php echo $LANG['Recently no booking done in']== NULL?'Recently no booking done in':$LANG['Recently no booking done in'] ;?> <?php echo $search_city;?> </h3>
                     <div class="clr"></div>
                    </div>
                    <?php
					*/}
					?>
                  <!--RECENT BOOKED END-->
                 <!--FACEBOOK LIKE--> 
                      <!-- <div class="blue_box filter">
                         <div class="facebook_like">
                              <h4><div class="fb-like"></div></h4>
                         </div>
                       </div> -->
                    </div>
               <!--LEFT PANEL END-->

               <!--RIGHT PANEL START-->
               	<div class="right_panel_02">
                    	<div class="hotel_details">
                         	<!--<h3><img src="<?php echo base_url(); ?>images/icon_23.png" alt="" /> <a href="search_by_city.html"><?php //echo insertStaticWord('Back to search results'); ?></a></h3>-->
							
						

                              <div class="section_01">
                              	<h5><?php echo $name; ?> <img src="<?php echo base_url(); ?>images/<?php echo str_replace(".","",$star_rating)?>_stars.png" alt="" /></h5>
                                  <!-- <div class="btn_box"><input type="button" value="Book Now" class="button_01" onClick="parent.location='#code'" /></div>-->
                                   <h6><?php echo $address1; ?> <?php echo $city; ?> <?php if($postal_code != 0) { echo $postal_code; } ?>, <?php if($country) { echo $country; } ?> <a href="javascript:void(0);" onclick="show_map('google_big_map_for_hotel');" ><?=$LANG['Show Map']== NULL?'Show Map':$LANG['Show Map']?></a></h6>
                                <!--<img src="<?php echo base_url(); ?>images/facebook_like.jpg" alt="" />-->
								<div class="fb-like"></div>
                              </div>
                              <div class="review_tab">
                              	<ul>
                                   	<li><a class="select" href="javascript:void(0);"><?=$LANG['Info and availability']== NULL?'Info and availability':$LANG['Info and availability']?></a></li>
                                        <li><a href="javascript:void(0);"><?=$LANG['Guest Reviews']== NULL?'Guest Reviews':$LANG['Guest Reviews']?></a></li>
                                   </ul>
                                   <div class="clr"></div>
                              </div>
                              <div class="hotel_descrip">
							  
                              	<div class="left_section" id="loadarea">
							<?php if(count($HotelimageData) > 0) { $cnt_Imgloop = 1; foreach($HotelimageData as $Hotel_Bigimage_Data) { if($cnt_Imgloop == 1) { ?><img src="<?php echo $Hotel_Bigimage_Data['url']; ?>" alt="" width="170" height="170" /><?php } else { break; } $cnt_Imgloop++; } }  else { ?><img src="<?php echo base_url(); ?>images/no_image.jpg" alt="" /><?php } ?>														                               
							    </div>
                              
							  	<!--<div id="loadarea_new" style="width:170px; position:absolute; display:none; height:170px; border:#000 solid 2px; background:#fff;">
							<?php if(count($HotelimageData) > 0) { $cnt_Imgloop = 1; foreach($HotelimageData as $Hotel_Bigimage_Data) { if($cnt_Imgloop == 1) { ?><img src="<?php echo $Hotel_Bigimage_Data['url']; ?>" alt="" width="170" height="170" /><?php } else { break; } $cnt_Imgloop++; } }  else { ?><img src="<?php echo base_url(); ?>images/no_image.jpg" alt="" /><?php } ?>														                               
							    </div>-->
								
                                   <div class="right_section">
                                    <!--<div class="review_tag"><h5>Pleasant, 6.9 </h5> Score from <a href="javascript:void(0);">16 reviews</a></div>-->
                                   	<div class="review_tag"><?php echo getReviewRatingSearchResult($hotel_id); ?></div>
                                        <div id="gallery">
                                        <ul>
										<?php if(count($HotelimageData) > 0) { foreach($HotelimageData as $Hotel_image_Data) { ?>
                                        	<li ><a href="<?php echo $Hotel_image_Data['url']; ?>" onclick="return false;" class="preview" ><img src="<?php echo $Hotel_image_Data['thumbnail_url']; ?>" alt="" class="zoom_image" /></a></li>
										<?php } } else { ?>
											 <img src="<?php echo base_url(); ?>images/no_image_thumb.jpg" alt="" />
										<?php } ?>
                                        </ul>
                                        </div>
                                        <div class="clr"></div>                                       
                                   </div>
                                   <div class="clr"></div>
                                   <p class="top_margin10"><?php echo $property_description; ?></p>
                              	
                                   <div class="facility">
                                   	<div class="cell_01"><img src="<?php echo base_url(); ?>images/icon_24.png" alt="" />&nbsp;&nbsp;<img src="<?php echo base_url(); ?>images/icon_25.png" alt="" />&nbsp;&nbsp;This hotel offers free parking & free wi-fi </div>
                                        <div class="cell_02"><?=$LANG['Hotel Rooms']== NULL?'Hotel Rooms':$LANG['Hotel Rooms']?>:&nbsp;&nbsp;<?php echo getNumberOfRoom($hotel_id); ?> </div>
                                   </div>
                              	<div class="clr"></div>
								
								<?php
                                 if(count(@$hotel_details->RoomRateDetailsList->RoomRateDetails) > 0 && is_array(@$hotel_details->RoomRateDetailsList->RoomRateDetails)) {
								?>
                              	<h2><?php echo $LANG['Available']== NULL?'Available':$LANG['Available'] ;?></h2>
                                <?php
								/* }
								if(isset($no_of_nights) && $no_of_nights > 0) {*/
								?>
                              	<h6 class="top_margin10"><?=$LANG['Available rooms from']== NULL?'Available rooms from':$LANG['Available rooms from']?> <span style="color:#057DD7;"><?php echo $session->userdata('search_checkin_date');?></span> <?=$LANG['to']== NULL?'to':$LANG['to']?> <span style="color:#057DD7;"><?php echo $session->userdata('search_checkout_date');?></span>  <?=$LANG['for']== NULL?'for':$LANG['for']?> <?php echo $no_of_nights;?> <?=$LANG['nights']== NULL?'nights':$LANG['nights']?>  <!--<a href="javascript:void(0);" onclick=""><?php //echo insertStaticWord('Change Dates'); ?></a>--></h6>
                                <?php
								}else{
								?>
                                <!--<h6 class="top_margin10">-->
                                <!--<form name="form_check_booking" action="<?php echo base_url().'hotel-details/'.$hotel_id.'/'.str_replace(" ","-",mb_strtolower($name, 'UTF-8')); ?>" method="post">
                                <div id="code">
                                <table border="0" cellpadding="0" cellspacing="5" style="width:100%;">
                                <tr>
                                <td width="15%"><?=$LANG['Check-In Date']== NULL?'Check-In Date':$LANG['Check-In Date']?></td>
                                <td width="20%"><input type="text" style="width:88px; border:1px solid #cccccc; margin-top:8px;" class="date-pick dp-applied" id="checkin-date" name="checkin-date" ></td>
                                <td width="15%"><?=$LANG['Check-Out Date']== NULL?'Check-Out Date':$LANG['Check-Out Date']?></td>
                                <td width="20%"><input type="text" style="width:88px; border:1px solid #cccccc; margin-top:8px;" class="date-pick dp-applied" id="checkout-date" name="checkout-date"></td>
                                <td width="30%" align="left"><input type="submit"  name="check_availability" id="check_availability" value="Check Availability" class="button_03" onclick="check_dates_validation()"></td>
                                </tr>
                                </table>
                                </div>
                                </form>-->
                                
                               <?php }?>
								<div>
                                  
                                   <div class="search_box">
                                   <!--<div class="active_pan" style="display:block;">
                                   <h6>Prices are per room/unit with 2 guests. <a href="<?php echo base_url(); ?>"><?=$LANG['Change your search']== NULL?'Change your search':$LANG['Change your search']?></a></h6>
									</div>-->
                                    
                                    <div class="form_pan" style="display:none;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                    <tr>
                                    <td colspan="7"><strong><?=$LANG['Please enter dates below']== NULL?'Please enter dates below':$LANG['Please enter dates below']?>.</strong></td>
                                    </tr>
                                    </thead>
                                      <tr>
                                        <td width="15%"><?=$LANG['Check-in']== NULL?'Check-in':$LANG['Check-in']?>:</td>
                                        <td width="15%"><?=$LANG['Check-out']== NULL?'Check-out':$LANG['Check-out']?>:</td>
                                        <td width="10%"><?=$LANG['Rooms']== NULL?'Rooms':$LANG['Rooms']?>:</td>
                                        <td width="12%" valign="bottom"></td>
                                        <td width="10%"><?=$LANG['Adults']== NULL?'Adults':$LANG['Adults']?>:</td>
                                        <td width="10%"><?=$LANG['Children']== NULL?'Children':$LANG['Children']?>:</td>
                                        <td width="12%" rowspan="2" valign="bottom">
                                        <input type="button" value="Search" class="button_03" />
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><input type="text" name="textfield" id="textfield" /></td>
                                        <td><input type="text" name="textfield" id="textfield" /></td>
                                        <td><select name="adult" id="adult">
                                        	 <option>0</option>
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                          </select></td>
                                        <td><strong>Room 1</strong></td>
                                        <td><select name="adult" id="adult">
                                        	<option>0</option>
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                          </select></td>
                                        <td><select name="adult" id="adult">
                                        	<option>0</option>
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                          </select></td>
                                      </tr>
                                    </table>
                                   
                                    </div>
				
									</div>
									
                                     <?php
									   $cnt_rooms = 1;
									   if(count(@$hotel_details->RoomRateDetailsList->RoomRateDetails) > 0 && is_array(@$hotel_details->RoomRateDetailsList->RoomRateDetails)) { 
								   		$cnt_rooms = 1; 
										?>
                                    
									<form name="form_booking" action="<?php echo base_url().'booking/index/'.$hotel_id.'/'.str_replace(" ","-",mb_strtolower($name, 'UTF-8'));
									?>" method="post">
                                   <!-- ==== -->
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td colspan="2">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                  <tr>
                                    <th width="310" align="left"><?=$LANG['Room Type']== NULL?'Room Type':$LANG['Room Type']?></th>
                                                                       <th><?=$LANG['Conditions']== NULL?'Conditions':$LANG['Conditions']?></th>
                                                                       <th><?=$LANG['Max']== NULL?'Max':$LANG['Max']?></th>
                                                                       <th width="60"><?=$LANG['Rate for']== NULL?'Rate for':$LANG['Rate for']?> <?php echo $no_of_nights;?><?=$LANG['Nights']== NULL?'Nights':$LANG['Nights']?></th>
                                                                       <th width="89"><?=$LANG['No. rooms']== NULL?'No. rooms':$LANG['No. rooms']?></th>
                                                                       <th width="70" >&nbsp;</th>
                                  </tr>
                                   </thead>
                                </table>
                                
                                    </td>
                                  </tr>
                                 
                                  <!--<tr><td align="center"><span style="font-size:11px; font-weight:bold;color:#F00;"><?=$LANG['Please select one or more rooms you want to book but not of multiple room types']== NULL?'Please select one or more rooms you want to book but not of multiple room types':$LANG['Please select one or more rooms you want to book but not of multiple room types']?></span></td></tr>-->
                                  <tr>
                                    <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:none;">
                                  <tbody>
                                   <?php
								    //print_r($hotel_details->RoomRateDetailsList->RoomRateDetails);exit;
										foreach($hotel_details->RoomRateDetailsList->RoomRateDetails as $Hotel_roomtype_Data) { 
										$roomDescription = explode('-',@$Hotel_roomtype_Data->roomDescription);
										$roomType  = $roomDescription[0];
										if(isset($roomDescription[1])){
										$condition  = "Special conditions <br/>".$roomDescription[1];
										}else{
											$condition = "Special conditions ";
										}
										$roomTypeCode = $Hotel_roomtype_Data->roomTypeCode;
										$thumbNailUrl  = getthumbNailUrl($hotel_id, $roomTypeCode);
										
								   ?>
                                    <tr>
                                       <td valign="top" width="300">
                                       
                                       		<div class="img_box">
                                            <?php
                                            if(!empty($thumbNailUrl)){
											?>
                                            <a href="<?php echo $thumbNailUrl; ?>" class="preview" onclick="return false;"><img width="60" height="60" title="" border="0"   src="<?php echo $thumbNailUrl; ?>" alt="" /></a> <!--<img src="<?php echo base_url(); ?>images/icon_26.png" class="plus" />--></a>
                                            <?php
											}else{
											?>
                                            <img  src="<?php echo base_url()?>images/no_image_thumb.jpg" width="60" height="60"  alt="" title="" border="0"  />
                                            <?php
											}
											?>
                                            </div>
                                             <div class="text_box">
                                             	<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>images/arrow_right.png" alt="" /></a> <?php echo $roomType;?>
                                                  
                                                  <p><?=$LANG['Prices are per room for']== NULL?'Prices are per room for':$LANG['Prices are per room for']?> <?= $no_of_nights ?> <?=$LANG['nights']== NULL?'nights':$LANG['nights']?></p>												  
                                                  <!--<p><span>Not included in room price: 15.15 % TAX!</span></p>-->
                                             </div>
                                       </td>
                                       <td valign="top" class="green"><?php echo $condition;?> <img src="<?php echo base_url(); ?>images/icon_05.png" alt="" /></td>
                                       <td valign="top"><img src="<?php echo base_url(); ?>images/icon_22.png" alt="" /></td>
                                       <td valign="top" class="green" width="60"><?php echo $session->userdata('Currency_code').' '.$Hotel_roomtype_Data->RateInfo->ChargeableRateInfo->{'@total'}; ?></td>
                                      <?php
                                            if($Hotel_roomtype_Data->currentAllotment > 0){
											?>
                                       <td valign="top" width="89">
                                       		
                                            <select name="room[]" id="room<?php echo $cnt_rooms; ?>" style="width:89px;" >
											<?php
                                            for($i=0; $i<=$Hotel_roomtype_Data->currentAllotment; $i++) :
                                            ?>
                                                  <option value="<?php echo $i.'&'.$Hotel_roomtype_Data->rateKey.'&'.$Hotel_roomtype_Data->rateCode.'&'.$Hotel_roomtype_Data->roomTypeCode.'&'.$Hotel_roomtype_Data->RateInfo->ChargeableRateInfo->{'@total'};?>"><?php echo $i;?></option>
                                            <?php
                                            endfor;
                                            ?>
									  	</select>
                                        <script type="text/javascript">
										  $(document).ready(function(arg) {
													//$("body select").msDropDown(
												$("#room<?php echo $cnt_rooms; ?>").msDropDown();
												$("#room<?php echo $cnt_rooms; ?>").hide();
												$('#room<?php echo $cnt_rooms; ?>_msdd').css("background-image", "url(<?php echo base_url(); ?>images/select_bg3.png)");
												$('#room<?php echo $cnt_rooms; ?>_msdd').css("background-repeat", "no-repeat");
												$('#room<?php echo $cnt_rooms; ?>_msdd').css("height", "24px"); 
												$('#room<?php echo $cnt_rooms; ?>_msdd').css("line-height", "22px");	 
												
										  })
										  </script>
                                          </td>
                                           <?php
                                        }else{ ?>
                                       <td valign="top" width="89"><span style="color:#F00; font-size:11px;">No current allotment</span></td>
                                       <?php }?> 
                                      
                                        <td valign="top" align="center"><input type="button" name="book_now" id="book_now<?php echo $cnt_rooms; ?>" value="<?php echo $LANG['Book Now']== NULL?'Book Now':$LANG['Book Now'] ;?>" class="button_03" onClick="check_no_rooms('<?php echo $cnt_rooms; ?>');" /></td>
                                       <?php $cnt_rooms++; 
										}
									   ?>
                                       </tr>
                                         <div class="clr"></div>
                                      
                                                                                 
                                            </tbody>
                                            </table></td>
                                               <?php
                                           /* if($Hotel_roomtype_Data->currentAllotment > 0){
											?>
                                                <td valign="top" align="center" style="border-top:1px solid #D8E6F9;border-left: 1px solid #D8E6F9;"><input type="button" name="book_now" id="book_now" value="<?php echo $LANG['Book Now']== NULL?'Book Now':$LANG['Book Now'] ;?>" class="button_03" onClick="check_no_rooms();" /></td>
                                             <?php
											}*/
											 ?>
                                              </tr>
                                            </table>
                                               <!-- ==== --> 
                                    <input type="hidden" name="room_counts" value="<?php echo ($cnt_rooms-1);?>" />
								   </form>
								   <?php
									}else{
									?>
                                    <h2 style="color:#F00; font-size:14px; font-weight:bold;">No rooms available in this dates.Please change your dates</h2>
                                    <?php
									}
									?>
							   </div>
                             <!--AVAILABLE END-->      
                                   <h2><span><?=$LANG['Best price']== NULL?'Best price':$LANG['Best price']?>. <?=$LANG['We guarantee it']== NULL?'We guarantee it':$LANG['We guarantee it']?>. </span></h2>
                                   <h2><?=$LANG['Hotel Facilities']== NULL?'Hotel Facilities':$LANG['Hotel Facilities']?></h2>
                                   <?php if(count($HotelRoomAttributeLinkData) > 0) { ?>
                                   <div class="policy_row">
                                   	<div class="left_cell"><?=$LANG['Room Amenities']== NULL?'Room Amenities':$LANG['Room Amenities']?></div>
                                        <div class="right_cell">
                                        	<p><?php $Room_amenity = ''; foreach($HotelRoomAttributeLinkData as $Hotel_Ramenity_Data){ if(!empty($Hotel_Ramenity_Data['attribute_id'])){ if($Room_amenity == '') { $Room_amenity = $Hotel_Ramenity_Data['attribute_desc']; } else { $Room_amenity = $Room_amenity." , ".$Hotel_Ramenity_Data['attribute_desc']; } } } echo $Room_amenity; ?>.</p>
                                        </div>
                                   </div>
								   <?php } ?>
                                   <?php if(count($HotelPropertyAttributeLinkData) > 0) { ?>
								   <div class="policy_row">
                                   	<div class="left_cell"><?=$LANG['Property Amenities']== NULL?'Property Amenities':$LANG['Property Amenities']?></div>
                                        <div class="right_cell">
                                        <p><?php $Property_amenity = ''; foreach($HotelPropertyAttributeLinkData as $Hotel_Pamenity_Data){ if(!empty($Hotel_Pamenity_Data['attribute_id'])){ if($Property_amenity == '') { $Property_amenity = $Hotel_Pamenity_Data['attribute_desc']; } else { $Property_amenity = $Property_amenity." , ".$Hotel_Pamenity_Data['attribute_desc']; } } } echo $Property_amenity; ?>.</p>
                                        </div>
                                   </div>
                                   <?php } /*if($HoteldetailData['Hoteldetail']['driving_directions'] != "") { ?>
                                   <div class="policy_row">
                                   	<div class="left_cell"><?php echo insertStaticWord('Driving Directions'); ?></div>
                                        <div class="right_cell">
                                        	<p><?php echo html_entity_decode($HoteldetailData['Hoteldetail']['driving_directions']); ?>. </p>
                                        </div>
                                   </div>
								   <?php }*/ ?>
                                    <div class="clr"></div> 
                                    
                                   <h2><?=$LANG['Hotel Policies & Fees']== NULL?'Hotel Policies & Fees':$LANG['Hotel Policies & Fees']?></h2>
                                   <?php if($policy_description != "") { ?>
                                   <div class="policy_row">
                                   	<div class="left_cell"><?=$LANG['Policies']== NULL?'Policies':$LANG['Policies']?></div>
                                        <div class="right_cell">
                                        	<p><?php echo $policy_description; ?>. </p>
                                        </div>
                                   </div>
									<?php } if($check_in_time != "") { ?>
                                   <div class="policy_row">
                                   	<div class="left_cell"><?=$LANG['Check-in']== NULL?'Check-in':$LANG['Check-in']?></div>
                                        <div class="right_cell">
                                        	<p><?php echo $check_in_time; ?>.</p>
                                        </div>
                                   </div>
								   <?php } if($check_out_time != "") { ?>
                                   <div class="policy_row">
                                   	<div class="left_cell"><?=$LANG['Check-out']== NULL?'Check-out':$LANG['Check-out']?></div>
                                        <div class="right_cell">
                                        	<p><?php echo $check_out_time; ?> </p>
                                        </div>
                                   </div>
								   <?php } /*if($HoteldetailData['Hoteldetail']['deposit_credit_cards_accepted'] != "") { ?>
                                   <div class="policy_row">
                                   	<div class="left_cell"><?php echo insertStaticWord('Accepted credit cards'); ?></div>
                                        <div class="right_cell">
                                        	<p><?php echo $HoteldetailData['Hoteldetail']['deposit_credit_cards_accepted']; ?>. </p>
                                        </div>
                                   </div>
                                   <?php }*/ if($recreation_description != "") { ?>
                                   <div class="policy_row">
                                   	<div class="left_cell"><?=$LANG['Recreation']== NULL?'Recreation':$LANG['Recreation']?></div>
                                        <div class="right_cell">
                                        	<p><?php echo $recreation_description; ?>. </p>
                                        </div>
                                   </div>
                                   <?php } if($dining_description != "") { ?>
                                   <div class="policy_row">
                                   	<div class="left_cell"><?=$LANG['Dining']== NULL?'Dining':$LANG['Dining']?></div>
                                        <div class="right_cell">
                                        	<p><?php echo $dining_description; ?>. </p>
                                        </div>
                                   </div>
                                   <?php } if($spa_description != "") { ?>
                                   <div class="policy_row">
                                   	<div class="left_cell"><?=$LANG['Spa']== NULL?'Spa':$LANG['Spa']?></div>
                                        <div class="right_cell">
                                        	<p><?php echo $spa_description; ?>. </p>
                                        </div>
                                   </div>
                                   <?php } ?>
                                  <div class="clr"></div>
                                  <h2><?=$LANG['We Guarantee']== NULL?'We Guarantee':$LANG['We Guarantee']?></h2>
                                  <ul>
                                  		<li><img src="<?php echo base_url(); ?>images/arrow.png" alt="" /> <?=$LANG['Booking is safe']== NULL?'Booking is safe':$LANG['Booking is safe']?>. </li>
                                    <li><img src="<?php echo base_url(); ?>images/arrow.png" alt="" /> <?=$LANG['Your privacy is protected']== NULL?'Your privacy is protected':$LANG['Your privacy is protected']?>. </li>
                                    <li><img src="<?php echo base_url(); ?>images/arrow.png" alt="" /> <?=$LANG['No booking fees']== NULL?'No booking fees':$LANG['No booking fees']?>.</li>
                                    <li><img src="<?php echo base_url(); ?>images/arrow.png" alt="" /> <?=$LANG['No Reservation Fee']== NULL?'No Reservation Fee':$LANG['No Reservation Fee']?>.</li>
                                </ul>
                                   <div class="privacy_link"><?=$LANG['By updating your profile you are agreeing with our']== NULL?'By updating your profile you are agreeing with our':$LANG['By updating your profile you are agreeing with our']?> <a href="<?php echo base_url().'terms_conditions'?>"><?=$LANG['Terms and Conditions']== NULL?'Terms and Conditions':$LANG['Terms and Conditions']?></a> <?=$LANG['and']== NULL?'and':$LANG['and']?>  <a href="<?php echo base_url().'privacy'?>"><?=$LANG['Privacy statement']== NULL?'Privacy statement':$LANG['Privacy statement']?></a>.</div>
                              	
                                   <!--<div class="paging top_margin">
                                   	<a class="left" href="javascript:void(0);"><img src="<?php echo base_url(); ?>images/arrow4.png" alt="" /> <?php echo insertStaticWord('Previous'); ?></a> <a class="right" href="javascript:void(0);"><?=$LANG['Next']== NULL?'Next':$LANG['Next']?> <img src="<?php echo base_url(); ?>images/arrow.png" alt="" /></a>
                                   	<div class="clr"></div>
                                   </div>
                                   <h3 class="paging top_margin"><?php /*echo site_url( img("../images/icon_23.png", array("alt" =>"More Hotels","title" =>"More Hotels","border"=>"0"))." ".insertStaticWord('Back to search results'), array("controller" =>"hotelsummaries", "action" => "hotel_search_by_city", "id" => $Hotel_Data['city'],"country" => $Hotel_Data['country'], "title" => "city", "ext" => "html"), array(), '', false);*/ ?></h3>-->
                              	
                              </div>
                              <div class="clr"></div>
                              
                         </div>
                    </div>
               <!--RIGHT PANEL END-->
               <div class="clr"></div>
               </div>

<!-- GOOGLE MAP FOR A PARTICULER HOTEL START -->               
<div id="google_big_map_for_hotel" class="signin_box" style="display: none; position:absolute; width:80%; height:80%;">
     <div class="close_btn"><a href="javascript:void(0)" onclick="hide_dialog()"><img src="images/close_btn.png" alt="" /></a></div>
          <h3><?php echo $name; ?> <img src="<?php echo base_url(); ?>images/<?php echo str_replace(".","",$star_rating)?>_stars.png" alt="" /></h3>
          <p><?php if($My_Viewed_Val->address1 != ""){ echo $My_Viewed_Val->address1; } ?><?php if($My_Viewed_Val->city != "") { echo ", ".$My_Viewed_Val->city; } ?><?php if($My_Viewed_Val->country != "") { echo ", ".$My_Viewed_Val->countryname;} ?><?php if($My_Viewed_Val->postal_code != "") { echo ", ".$My_Viewed_Val->postal_code; }?>
          </p>
    <div class="inner_box" id="map_canvas_big" style="position:fixed; height:87%; width:99%; margin-top:10px; border:2px solid #0275DD;"></div>                                          
</div>
<script language="javascript">
function show_map (id)
{
    if(!dialog) dialog = null;
    dialog = new ModalDialog ("#"+id);
    dialog.show();    
    googleMapBig('<?php echo $latitude; ?>', '<?php echo $longitude; ?>', 14);
}    
</script>
<!-- GOOGLE MAP FOR A PARTICULER HOTEL END   -->            