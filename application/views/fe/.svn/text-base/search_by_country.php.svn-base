<script>
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
});
function strpad00(s){
    s = s + '';
    if (s.length === 1) s = '0'+s;
    return s;
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
	var search_string = 'city='+city+'&state_province='+state+'&country='+country+'&checkin_date='+start_date+'&checkout_date='+end_date+'&amenity='+amenitylist+'&starrate='+starratelist+'&sortby='+sortby+'&propertytype='+propertytypelist+'&chaincode='+chaincodelist+'&pricerange='+pricerangelist+'&rooms='+numRooms+'&room_adults='+room_adults+'&room_childs='+room_childs;
	
	
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

/*==========start of world map===========*/
var world_map_visible = new Array();
function update_map_mouseover(area) {
	//alert(area);
	if (area) {
		if (world_map_visible[area] == "1") {
		} else {
			if (document.getElementById('world_map_' + area).style.display == "block") {

				world_map_visible[area] = "1";

			} else {

				world_map_visible[area] = "0";
				document.getElementById('world_map_' + area).style.display = "block";

			}
		}
	}
}
// World Map Mouseout Function
function update_map_mouseout(area) {

	if (area) {
		if (world_map_visible[area] == "1") {
		} else {
			world_map_visible[area] = "0";
			document.getElementById('world_map_' + area).style.display = "none";
		}
	}
}
// World Map OnClick Function
// World Map Save Function
/*==========end of world map===========*/
</script>

<link type="text/css" rel="stylesheet" href="css/themes/base/jquery.ui.all.css" />
<script type="text/javascript" src="js/jquery-1.7.1.js"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<script type="text/javascript" src="js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/ui/jquery.ui.tabs.js"></script>
<script>
jQuery(function() {
	/*$( "#continent" ).tabs({
	event: "mouseover"
	});*/
	var $tabs = jQuery('#continent').tabs(); // first tab selected
	$tabs.tabs('select', 3); // switch to third tab

});
</script>

<style type="text/css">
a.dp-choose-date {float: left;width: 25px;height: 25px;padding: 0;margin: 5px 3px 0;display: block;text-indent: -2000px;overflow: hidden;background: url("<?php echo base_url();?>images/calendar_icon.png") no-repeat; }
a.dp-choose-date.dp-disabled {background-position: 0 -20px;cursor: default;}
input.dp-applied {width: 140px;float: left;}
.text{ font-family : Verdana, Arial, Helvetica, sans-serif; font-size : 13px; color : #222222; }
a.text{ color: #0000aa; text-decoration: none; }
a.text:hover{ color: #222222; text-decoration: underline; }
.world_map {position: absolute;	left: 0px;}
</style>
<!--CONTENT SECTION START-->
     	<div id="content">
		<div class="page_nav">
               	<p><?php echo $LANG['You are here']== NULL?'You are here':$LANG['You are here'] ;?>:&nbsp;&nbsp;<a href="<?php echo base_url();?>"><?php echo $LANG['Home']== NULL?'Home':$LANG['Home'] ;?></a></a><img src="<?php echo base_url() ?>images/arrow2.png" alt="" /><a href="javascript:void(0);"><?php echo $LANG['Hotels in']== NULL?'Hotels in':$LANG['Hotels in'] ;?> <?php echo $country_coordinate["country_name"]; ?></a> <!--<span>[879 hotels]</span>--></p>
               </div>
          	<!--LEFT PANEL START-->
               <div class="left_panel">
			   <?php echo form_open_multipart('hotelsummaries/search_result',array("id"=>"search_result_form"));?>
               	<div id="search_box">
                    	<h3 style="font-size:17px;"><img src="<?php echo base_url();?>images/i_glass.png" alt="" /> <?php echo $LANG['Search Hotels in']== NULL?'Search Hotels in':$LANG['Search Hotels in'] ;?>  <?php echo $country_coordinate["country_name"]; ?></h3>
                         <div class="label_01">
                          <div id="div_err"></div>
                         	<p><?php echo $LANG['Where would you like to go']== NULL?'Where would you like to go':$LANG['Where would you like to go'] ;?>? </p>
                              <input type="text" name="txt_location" id="txt_location" onkeyup="get_location_name(this.value)" value=""  autocomplete="off" />
                            <input type="hidden" name="location_id" id="location_id"  />
                            <div id="suggestionsSearch" class="suggestionsBox2">
                            <div class="arrow_autocom">&nbsp;</div>
                            <!--<div class="suggestionList" id="autoSuggestionsListSearch" style="height:130px; overflow:auto;">&nbsp;</div>-->
                            <div class="suggestionList" id="autoSuggestionsListSearch">&nbsp;</div>
                            </div>
                            
                         </div>
                         <div class="clr"></div>
                         <div class="label_02 left">
                         	<p><?php echo $LANG['Check-In Date']== NULL?'Check-In Date':$LANG['Check-In Date'] ;?></p>
                              <div class="tlabel_01">
						 <input type="text" style="width: 88px;" class="date-pick dp-applied" id="start-date" name="start-date" readonly="readonly">						
                               </div>                                   
                         </div>
                         
                         <div class="label_02 right">
                         	<p><?php echo $LANG['Check-Out Date']== NULL?'Check-Out Date':$LANG['Check-Out Date'] ;?></p>
                              <div class="tlabel_01"> 
						<input type="text" style="width: 88px;" class="date-pick dp-applied" id="end-date" name="end-date" readonly="readonly">
                               </div>
                               <div id="div_err1"></div>                                     
                         </div>
                           <div id="div_err1"></div>
                         <div class="clr"></div>
                         <div class="row_heading">Rooms</div>
                         <div class="row_heading_new">Adults <span>( 18+ )</span></div>
                         <div class="row_heading_new">Children <span>( 0-17 )</span></div>
                         <div class="clr"></div>
                        <div id="room_option">
							 <div id="additional_row" class="additional_row" style="background:#9FC011">
								  <div class="row_cell">
                                  <?php echo $LANG['Rooms']== NULL?'Rooms':$LANG['Rooms'] ;?>:
									<select name="rooms2[]" id="rooms2"  style="width:50px; background: #FFFFFF;line-height: 16px;">
										<!--<option value="0">0</option>-->
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
									</select>
							 		 <script type="text/javascript">
                                        $(document).ready(function(arg) {
                                                  //$("body select").msDropDown(
                                              $("#rooms2").msDropDown();
                                              $("#rooms2").hide();
/*                                              $('#rooms2_msdd').css("background-image", "url(images/select_bg1.png)");
                                              $('#rooms2_msdd').css("background-repeat", "no-repeat");
									          $('#rooms2_msdd').css("background-position", "left");
                                              $('#rooms2_msdd').css("height", "24px"); 
                                              $('#rooms2_msdd').css("line-height", "22px");	 */
                                              
                                        })
                                   </script>
								  </div>
								  <div class="row_cell">
                                  <?php echo $LANG['Adults']== NULL?'Adults':$LANG['Adults'] ;?>:
								  <select name="adult2[]" id="adult2"  style="width:50px; background: #FFFFFF;line-height: 16px;">
								  		<!--<option value="0">0</option>-->
										<option value="1">1</option>
										<option value="2" selected>2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
									</select>
                                     <script type="text/javascript">
                                        $(document).ready(function(arg) {
                                                  //$("body select").msDropDown(
                                              $("#adult2").msDropDown();
                                              $("#adult2").hide();
/*                                              $('#adult2_msdd').css("background-image", "url(images/select_bg1.png)");
                                              $('#adult2_msdd').css("background-repeat", "no-repeat");
									          $('#adult2_msdd').css("background-position", "left");
                                              $('#adult2_msdd').css("height", "24px"); 
                                              $('#adult2_msdd').css("line-height", "22px");	 */
                                              
                                        })
                                   </script>
								  </div>
								  <div class="row_cell"><?php echo $LANG['Children']== NULL?'Children':$LANG['Children'] ;?>:
									<select name="child2[]" id="child2"  style="width:50px; background: #FFFFFF;line-height: 16px;">
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
									</select>
							 		 <script type="text/javascript">
                                        $(document).ready(function(arg) {
                                                  //$("body select").msDropDown(
                                              $("#child2").msDropDown();
                                              $("#child2").hide();
/*                                              $('#child2_msdd').css("background-image", "url(images/select_bg1.png)");
                                              $('#child2_msdd').css("background-repeat", "no-repeat");
									          $('#child2_msdd').css("background-position", "left");
                                              $('#child2_msdd').css("height", "24px"); 
                                              $('#child2_msdd').css("line-height", "22px");	*/ 
                                              
                                        })
                                   </script>
								  </div>
                                  
							 </div>
						</div>
                         <div class="label_04"><input type="checkbox" name="sp_dates" id="sp_dates"  /> <?php echo $LANG["I don't have specific dates yet"]== NULL?"I don't have specific dates yet":$LANG["I don't have specific dates yet"] ;?> </div>
                         <div class="label_05"><input class="button_01" type="button" value="<?=$LANG['Search']== NULL?'Search':$LANG['Search']?>"  name="search_button" onclick="send_url(this.form);"/></div> 
                         <div class="clr"></div>
                    </div>
                     <?php echo form_close();?>
                    <!--SEARCH BOX END-->
                    <div class="country_heading"><h3 style="background:url(<?php echo base_url() ?>country_flag/flags_thumb/<?php echo str_replace(' ','_',strtolower($country_coordinate["country_name"])); ?>.png) right no-repeat;"><?=$LANG['Featured Destinations in']== NULL?'Featured Destinations in':$LANG['Featured Destinations in']?>&nbsp;<?php echo $country_coordinate["country_name"]; ?></h3></div>
					
                    <?php foreach($All_City_From_Hotel as $City_From_Hotel) { if($City_From_Hotel->city != "") { ?>
                    <div class="place_box">
                    	<div class="picture">
                         	<img src="<?php echo base_url() ?>images/bg-2b.jpeg" alt="" />
                         	<h2><?php echo $City_From_Hotel->city; ?></h2>
                         </div>
                    	<div class="blue_box">
                    		<div class="box_row">
                              	<div class="cell_01">
								<?php 
                                if(!empty($City_From_Hotel->thumbnail_url)){?>
                                 <a  href="<?php echo base_url().'hotel-details/'.$City_From_Hotel->ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($City_From_Hotel->name, 'UTF-8'))?>"><img  src="<?php echo $City_From_Hotel->thumbnail_url;?>" width="40" height="40" alt="" title="" border="0"  /></a>
                               <?php }else{?> <a  href="<?php echo base_url().'hotel-details/'.$City_From_Hotel->ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($City_From_Hotel->name, 'UTF-8'))?>"><img  src="<?php echo base_url()?>images/no_image_thumb.jpg" width="40" height="40"  alt="" title="" border="0"  /></a><?php } ?>
								
								</div>
                                   <div class="cell_02">
                                   	<h4> 
									<a href="<?php echo base_url().'hotel-details/'.$City_From_Hotel->ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($City_From_Hotel->name, 'UTF-8'))?>"><?php echo $City_From_Hotel->name;?></a><img src="<?php echo base_url() ?>images/<?php echo str_replace(".","",$City_From_Hotel->star_rating)?>_stars.png" alt="" /></h4>
                                        <p><?php echo getReviewRating($City_From_Hotel->ean_hotel_id); ?></p>
                                        <!--<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="<?php echo base_url() ?>images/icon_02.png" alt="" /></div>-->
                                       
<?php if(getBookingTime($City_From_Hotel->ean_hotel_id)!=""){ ?>
										<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>:  <?php 
										echo getBookingTime($City_From_Hotel->ean_hotel_id); ?> ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
										<?php } ?>
										
									    <div class="discrip"><?php if($City_From_Hotel->view_counter) { ?><?php echo $LANG["There are"]== NULL?"There are":$LANG["There are"] ;?> <?php echo $City_From_Hotel->view_counter; ?> <?php echo $LANG["people looking at this hotel"]== NULL?"people looking at this hotel":$LANG["people looking at this hotel"] ;?>.<?php } ?></div>
                                   </div>
                                   <div class="cell_03">
                                   	<span>Single</span>
                                        <?php echo $City_From_Hotel->low_rate;?>
                                   </div>
                              </div>
                              <div class="clr"></div>
                              <div class="more_link"><a href="<?php echo base_url().'hotelsummaries/hotel_search_by_city/'.$City_From_Hotel->city.'/'.$country_codes?>"><?=$LANG['More']== NULL?'More':$LANG['More']?> <?=$LANG['Hotels']== NULL?'Hotels':$LANG['Hotels']?> <img src="<?php echo base_url();?>images/arrow.png" alt="" /></a></div>
                    	</div>
                    </div>
					<?php } } ?>
			  <!--LONDON END-->
               </div>
               <!--LEFT PANEL END-->

               <!--RIGHT PANEL START-->
               <div class="right_panel">
               	<div class="blue_box top_margin" style="min-height:260px;">
                    	<div class="viewed_box">
                         	<div class="heading_left"><?php echo $LANG["Your Viewed hotels in"]== NULL?"Your Viewed hotels in":$LANG["Your Viewed hotels in"] ;?> <?php echo $country_coordinate["country_name"]; ?></div>
                              <div class="heading_right"><a href="javascript:void(0);"><?=$LANG['Delete All']== NULL?'Delete All':$LANG['Delete All']?> <img src="<?php echo base_url() ?>images/icon_03.png" alt="" /></a></div>
                              
							  <?php if(count($Most_Viewed_Hotel) > 0) { foreach($Most_Viewed_Hotel as $Most_Viewed_Hotel_Data) {
							   ?>
                              <div class="view_row">
                              	<div class="cell_01">
								<?php 
                                if(!empty($Most_Viewed_Hotel_Data->thumbnail_url)){?>
                                <a  href="<?php echo base_url().'hotel-details/'.$Most_Viewed_Hotel_Data->ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($Most_Viewed_Hotel_Data->name, 'UTF-8'))?>"><img  src="<?php echo $Most_Viewed_Hotel_Data->thumbnail_url?>" alt="" title="" border="0"  /></a>
                               <?php }else{?> <a  href="<?php echo base_url().'hotel-details/'.$Most_Viewed_Hotel_Data->ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($Most_Viewed_Hotel_Data->name, 'UTF-8'))?>"><img  src="<?php echo base_url()?>images/no_image_thumb.jpg"  alt="" title="" border="0"  /></a><?php } ?>
                                </div>
								   <div class="cell_02">
                                   	<h5><a href="<?php echo base_url().'hotel-details/'.$Most_Viewed_Hotel_Data->ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($Most_Viewed_Hotel_Data->name, 'UTF-8'))?>"><?php echo $Most_Viewed_Hotel_Data->name;?></a></h5>
                                        <div class="rating"><img src="<?php echo base_url() ?>images/<?php echo str_replace(".","",$Most_Viewed_Hotel_Data->star_rating)?>_stars.png" alt="" /></div>
                                        <h6><?php echo $Most_Viewed_Hotel_Data->address1; ?><?php if($Most_Viewed_Hotel_Data->city != "") { echo ", ".$Most_Viewed_Hotel_Data->city; } ?><?php if($Most_Viewed_Hotel_Data->country != "") { echo ", ".$Most_Viewed_Hotel_Data->countryname; ?> <img src="country_flag/flags_thumb/<?php echo str_replace(" ","_",strtolower($Most_Viewed_Hotel_Data->countryname)); ?>.png" alt="" /><?php  } ?></h6>
                                        <p><?php echo getReviewRating($Most_Viewed_Hotel_Data->ean_hotel_id); ?></p>
										<?php if(getBookingTime($Most_Viewed_Hotel_Data->ean_hotel_id)!=""){ ?>
										<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>:  <?php 
										echo getBookingTime($Most_Viewed_Hotel_Data->ean_hotel_id); ?> ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
										<?php } ?>                                        
										
                                   </div>
                                   <div class="cell_03"><!--<a href="javascript:void(0);"><img src="<?php echo base_url() ?>images/icon_03.png" alt="" /></a>--></div>
                              </div>
                              <?php 
							  } } ?>
                              <div class="clr"></div>
                         </div>
                    </div>
                 <!--YOU VIEWED END-->
                   <div class="blue_box top_margin">
                   		<div class="map_section">
                         	<h4><?php echo $country_coordinate["country_name"]; ?> <?php echo $LANG['Overview']== NULL?'Overview':$LANG['Overview'] ;?> <img src="<?php echo base_url() ?>images/icon_05.png" alt="" /></h4>
                            <div class="map_box" id="map_canvas" style="height:317px;width:432px;"></div>
                            <?php
                            $latLang = getCountryLatitudeLongitude($country_coordinate["country_name"]);
                            $latitude = $latLang[0];
                            $longitude = $latLang[1];
                            ?>
                            <script language="javascript">
                            googleMap('<?php echo $latitude; ?>', '<?php echo $longitude; ?>', 6);
                            </script>                              
                              <h5><?php echo $LANG['Legend']== NULL?'Legend':$LANG['Legend'] ;?></h5>
                              <span><img src="<?php echo base_url() ?>images/icon_06.png" alt="" /> <?php echo $LANG['Hotel']== NULL?'Hotel':$LANG['Hotel'] ;?></span>
                              <span><img src="<?php echo base_url() ?>images/icon_07.png" alt="" /> <?php echo $LANG['Landmark']== NULL?'Landmark':$LANG['Landmark'] ;?></span>
                              <span><img src="<?php echo base_url() ?>images/icon_08.png" alt="" /> <?php echo $LANG['City']== NULL?'City':$LANG['City'] ;?></span>
                              <span><img src="<?php echo base_url() ?>images/icon_09.png" alt="" /> <?php echo $LANG['Airport']== NULL?'Airport':$LANG['Airport'] ;?></span>
                              <p><?php echo $LANG["Click these markers on the map for more detailed information"]== NULL?"Click these markers on the map for more detailed information":$LANG["Click these markers on the map for more detailed information"] ;?></p>
                              <div class="availability"><a href="javascript:void(0);"><?php echo $LANG["Show prices and availability for displayed hotels"]== NULL?"Show prices and availability for displayed hotels":$LANG["Show prices and availability for displayed hotels"] ;?></a></div>
                              <div class="clr"></div>
                              <div class="more_link"><a href="javascript:void(0);">More <img src="<?php echo base_url() ?>images/arrow.png" alt="" /></a></div>
                         </div>
                   </div>
                <!--MAP END-->
                	<?php
                    if(isset($Recently_Booked_Hotel_Id) && count($Recently_Booked_Hotel_Id)>0){
					?>
                	<div class="recent_book">
                    	<h4><?php echo $LANG["Recently booked in"]== NULL?"Recently booked in":$LANG["Recently booked in"] ;?> <?php echo $country_coordinate['country_name']; ?></h4>
                         <?
						 $this->load->model('Destination_model');
                         foreach($Recently_Booked_Hotel_Id as $Hotel_Id){
							 $HotelData = $this->Destination_model->hotel_by_id($Hotel_Id);
							 $to_Currency = $session->userdata('Currency_code');
							 $from_Currency = $HotelData['property_currency'];
							 $amount = $HotelData['low_rate'];
							 $low_rate = currency($from_Currency,$to_Currency,$amount); 
						 ?>
                         <div class="cont_row">
                         	<div class="left_box">
                              	<?php 
                                if(!empty($HotelData['thumbnail_url'])){?>
                                <a  href="<?php echo base_url().'hotel-details/'.$HotelData['ean_hotel_id'].'/'.str_replace(" ","-",mb_strtolower($HotelData['name'], 'UTF-8'))?>"><img  src="<?php echo $HotelData['thumbnail_url'];?>" width="90" height="90" alt="" title="" border="0"  /></a>
                               <?php }else{?> <a  href="<?php echo base_url().'hotel-details/'.$HotelData['ean_hotel_id'].'/'.str_replace(" ","-",mb_strtolower($HotelData['name'], 'UTF-8'))?>"><img  src="<?php echo base_url()?>images/no_image_thumb.jpg" width="90" height="90"  alt="" title="" border="0"  /></a><?php } ?>
                                   <span>Single</span> <?php echo getCurrencySymbol($to_Currency);?>  <?php echo $low_rate;?>
                              </div>
                              <div class="right_box">
                              	<h5><a href="<?php echo base_url().'hotel-details/'.$HotelData['ean_hotel_id'].'/'.str_replace(" ","-",mb_strtolower($HotelData['name'], 'UTF-8'))?>"><?php echo $HotelData["name"];?></a> </h5>
                                   <div class="rating"><img src="images/<?php echo str_replace(".","",$HotelData["star_rating"])?>_stars.png" alt="" /></div>
                                   <h6><?php echo $HotelData['address1'];?>, <?php echo $HotelData['city'];?></h6>
                                    <h6><a href="javascript:void(0)">Show Map</a></h6>
                                   <h6><?php echo getReviewRating($HotelData['ean_hotel_id']); ?></h6>
                                   <!--<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="<?php echo base_url() ?>images/icon_02.png" alt="" /></div>-->

<?php if(getBookingTime($HotelData['ean_hotel_id'])!=""){ ?>
										<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>:  <?php 
										echo getBookingTime($HotelData['ean_hotel_id']); ?> ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
										<?php } ?>                                  <!--<p>Hilton Garden Inn Saket is located in New Delhi's DLF Place, a 10-minute drive from Qutb Minar. It offers free Wi-Fi, an outdoor swimming pool, and rooms with large bay windows. </p>-->
                             		<div class="more_link"><a href="<?php echo base_url().'hotel-details/'.$HotelData['ean_hotel_id'].'/'.str_replace(" ","-",mb_strtolower($HotelData['name'], 'UTF-8'))?>">More <img src="<?php echo base_url() ?>images/arrow.png" alt="" /></a></div>
                              </div>
                         </div>
                         <?php
						 }
						 ?>
                       
                         <div class="clr"></div>
                    </div>
                    
                    <?php
                    }else{
					?>
                    <div class="recent_book">
                    <h4><?=$LANG['Recently no booking done in']== NULL?'Recently no booking done in':$LANG['Recently no booking done in']?>  <?php echo $country_coordinate['country_name']; ?></h4>
                    </div>
                    <?php
					}
					?>
                  <!--RECENT BOOKED END-->
                  <div class="facebook_box"><img src="<?php echo base_url() ?>images/facebook.jpg" alt="" /></div>
                  <!--FACE BOOK END-->
                  <div class="booking_box top_margin">
                  		<h3>
						<?php echo $LANG['Why use']== NULL?'Why use':$LANG['Why use'] ;?>  bookingandyou.com ?
						</h3>
                         <ul>
                         	<li>
                              	<h5><?php echo $LANG['Low Rates']== NULL?'Low Rates':$LANG['Low Rates'] ;?>></h5>
                                   <p><?php echo $LANG['No booking fees']== NULL?'No booking fees':$LANG['No booking fees'] ;?> <img src="<?php echo base_url() ?>images/bullet_01.png" alt="" />  <?php echo $LANG['Save money']== NULL?'Save money':$LANG['Save money'] ;?>!  <img src="<?php echo base_url() ?>images/bullet_01.png" alt="" />  <a href="javascript:void(0);"><?php echo $LANG['Best Price Guaranteed']== NULL?'Best Price Guaranteed':$LANG['Best Price Guaranteed'] ;?></a></p>
                              </li>
                              <li>
                              	<h5><?php echo $LANG['Over']== NULL?'Over':$LANG['Over'] ;?> 153,980 <?php echo $LANG['hotels worldwide']== NULL?'hotels worldwide':$LANG['hotels worldwide'] ;?> </h5>
                                   <p>30,000+ <?php echo $LANG['destinations']== NULL?'destinations':$LANG['destinations'] ;?> <img src="<?php echo base_url() ?>images/bullet_01.png" alt="" />  153,980 <?php echo $LANG['hotels worldwide']== NULL?'hotels worldwide':$LANG['hotels worldwide'] ;?> </p>
                              </li>
                              <li>
                              	<h5><?php echo $LANG['Satisfied guests']== NULL?'Satisfied guests':$LANG['Satisfied guests'] ;?></h5>
                                   <p><?php echo $LANG['More than']== NULL?'More than':$LANG['More than'] ;?> 200,000 <?php echo $LANG['room nights booked every day']== NULL?'room nights booked every day':$LANG['room nights booked every day'] ;?></p>
                              </li>
                              <li>
                              	<h5><?php echo $LANG['Unbiased hotel reviews']== NULL?'Unbiased hotel reviews':$LANG['Unbiased hotel reviews'] ;?></h5>
                                   <p>9,040,000 <?php echo $LANG['hotel reviews from real guests']== NULL?'hotel reviews from real guests':$LANG['hotel reviews from real guests'] ;?></p>
                              </li>
                              <li style="border:none">
                              	<h5><?php echo $LANG['We speak your language']== NULL?'We speak your language':$LANG['We speak your language'] ;?></h5>
                                   <p><?php echo $LANG['Website and customer service in English (US) and 40 other languages']== NULL?'Website and customer service in English (US) and 40 other languages':$LANG['Website and customer service in English (US) and 40 other languages'] ;?> </p>
                              </li>
                         </ul>
                  </div>  
                 <!--BOOKING END-->
                  <div class="blue_box top_margin">
                  	<div class="subscribe">
                    	<h4><?php echo $LANG['Save']== NULL?'Save':$LANG['Save'] ;?> 50% <?php echo $LANG['or more with us']== NULL?'or more with us':$LANG['or more with us'] ;?></h4>
                         <h4><?php echo $LANG['Subscribe to get exclusive offers']== NULL?'Subscribe to get exclusive offers':$LANG['Subscribe to get exclusive offers'] ;?></h4>
                         <label><?php echo $LANG['Your e-mail']== NULL?'Your e-mail':$LANG['Your e-mail'] ;?>:</label><input type="text" />
                         <input  type="submit" value="Subscribe" class="button_01 right" style=" margin-top:10px; margin-right:5px;" />
                         <div class="clr"></div>
                         
                    </div>
                  </div>
                 
               </div>
               <!--RIGHT PANEL END-->
               <div class="clr"></div>
               </div>