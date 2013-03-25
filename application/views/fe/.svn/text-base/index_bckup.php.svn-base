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
$(function()
{
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
function strpad00(s)
{
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
    } else if(frm == "7") {
        var sortby = '7'; 
    }else if(frm == "3") {
        var sortby = '3'; 
    }else if(frm == "2") {
        var sortby = '2'; 
    }else {
        var sortby = '4';  
    }          
    
	var amenitylist = "All";
	var starratelist = "All";
	var propertytypelist = "All";
	var chaincodelist = "All";
	var pricerangelist = "All";
	var room_adults = document.getElementById('adult2').value;
	var room_childs = document.getElementById('child2').value;  
            
    var    search_string = 'city='+city+'&state_province='+state+'&country='+country+'&checkin_date='+start_date+'&checkout_date='+end_date+'&amenity='+amenitylist+'&starrate='+starratelist+'&sortby='+sortby+'&propertytype='+propertytypelist+'&chaincode='+chaincodelist+'&pricerange='+pricerangelist+'&room_adults='+room_adults+'&room_childs='+room_childs;
	
	
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
function setNumRooms(x) {
        numRooms = x;
        for (i = 0; i < x; i++) {
          if (adultsPerRoom[i] == null) {
            adultsPerRoom[i] = 2;
          }
          if (childrenPerRoom[i] == null) {
            childrenPerRoom[i] = 0;
          }
        }
        refresh();
      }
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
               	<p><?php echo $LANG['You are here']== NULL?'You are here':$LANG['You are here'] ;?>:&nbsp;&nbsp;<a href="<?php echo base_url();?>"><?php echo $LANG['Home']== NULL?'Home':$LANG['Home'] ;?></a></p>
               </div>
          	<!--LEFT PANEL START-->
               <div class="left_panel">
               <?php echo form_open_multipart('hotelsummaries/search_result',array("id"=>"search_result_form"));?>
               	<div id="search_box">
                    	<h3><img src="<?php echo base_url();?>images/i_glass.png" alt="" /> <?php echo $LANG['Search Hotels']== NULL?'Search Hotels':$LANG['Search Hotels'] ;?></h3>
                         <div class="label_01">
                          <div id="div_err"></div>
                         	<p><?php echo $LANG['Where']== NULL?'Where':$LANG['Where'] ;?>?</p>
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
                         <div class="row_heading"><?php echo $LANG['Rooms']== NULL?'Rooms':$LANG['Rooms'] ;?></div>
                         <div class="row_heading_new"><?php echo $LANG['Adults']== NULL?'Adults':$LANG['Adults'] ;?> <span>( 18+ )</span></div>
                         <div class="row_heading_new"><?php echo $LANG['Children']== NULL?'Children':$LANG['Children'] ;?> <span>( 0-17 )</span></div>
                         <div class="clr"></div>
                        <div id="room_option">
							 <div id="hot-search-params"></div>
						</div>
                         
                         <div class="clr"></div>
                         <!--<h6><a href="javascript:void(0);">+<?php echo $LANG['Add another room']== NULL?'Add another room':$LANG['Add another room'] ;?></a></h6>-->
                         <div class="label_04"><input type="checkbox" name="sp_dates" id="sp_dates"  /> <?php echo $LANG["I don't have specific dates yet"]== NULL?"I don't have specific dates yet":$LANG["I don't have specific dates yet"] ;?> </div>
                         <div class="label_05"><input class="button_01" type="button" value="Search"  name="search_button" onclick="send_url(this.form);" /></div> 
                         <div class="clr"></div>
                    </div>
                    <?php echo form_close();?>
                    <!--SEARCH BOX END-->
                     <?php if(count($Featured_Destination) > 0) { 
                    foreach($Featured_Destination as $All_Featured_Destination) { 
                    $this->load->model('Destination_model');
					$city =  $All_Featured_Destination['city'];
                    $country =  $All_Featured_Destination['country_code'];
                    $HotelData = $this->Destination_model->hotel_by_city($city); 
                    //print_r($HotelData);
                    ?>
                    <div class="place_box">
                    	<div class="picture">
                         	<img src="<?php echo base_url()?>hotel_destination_images/aspect_image/photo_thumbnail485_138/<?php echo $All_Featured_Destination['destination_img']; ?>" alt="" />
                         	<h2><?php echo $city; ?></h2>
                         </div>
                    	<div class="blue_box">
                        <?php
                        $cnt=0;
                        foreach($HotelData as $HotelDataVal){
							
							$to_Currency = $session->userdata('Currency_code');
							$from_Currency = $HotelDataVal['property_currency'];
							$amount = $HotelDataVal['low_rate'];
							/*if($to_Cur == 'default'){
								$to_Currency = $from_Currency;
							}else{
								$to_Currency = $to_Cur;
							}*/
							$low_rate = currency($from_Currency,$to_Currency,$amount); 
                        ?>
                    		<div class="box_row">
                              	<div class="cell_01">
                                
                                 <?php 
                                if(!empty($HotelDataVal['thumbnail_url'])){?>
                                <a  href="<?php echo base_url().'hotel-details/'.$HotelDataVal['ean_hotel_id'].'/'.convert_accented_characters(strtolower($HotelDataVal['name']),'-')?>"><img  src="<?php echo $HotelDataVal['thumbnail_url'];?>" width="40" height="40" alt="" title="" border="0"  /></a>
                               <?php }else{?> <a  href="<?php echo base_url().'hotel-details/'.$HotelDataVal['ean_hotel_id'].'/'.convert_accented_characters(strtolower($HotelDataVal['name']),'-')?>"><img  src="<?php echo base_url()?>images/no_image_thumb.jpg" width="40" height="40"  alt="" title="" border="0"  /></a><?php } ?>
                                </div>
                                   <div class="cell_02">
                                   	<h4><a href="<?php echo base_url().'hotel-details/'.$HotelDataVal['ean_hotel_id'].'/'.convert_accented_characters(strtolower($HotelDataVal['name']),'-')?>"><?php echo $HotelDataVal["name"];?></a> <img src="images/<?php echo str_replace(".","",$HotelDataVal["star_rating"])?>_stars.png" alt="" /></h4>
                                    <!--<p><a href="javascript:void(0);">Score from 160 reviews: Very good, 8.1</a> </p>-->         
                                        <p><?php echo getReviewRating($HotelDataVal['ean_hotel_id']); ?></p>
                                        <!--<div class="booking">Latest booking: 3 minutes ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>-->
                                        <div class="discrip"><?php echo $LANG['There are']== NULL?'There are':$LANG['There are'] ;?> <?php echo $HotelDataVal['view_counter']; ?> <?php echo $LANG['people looking at this hotel']== NULL?'people looking at this hotel':$LANG['people looking at this hotel'] ;?>.</div>
                                   </div>
                                   <div class="cell_03">
                                   	<span><?php echo $LANG['from']== NULL?'from':$LANG['from'] ;?></span>
                                        <?php echo $to_Currency;?> <?php echo $low_rate;?>
                                   </div>
                              </div>
                              <?php
							$cnt++;
							}
							?>
                              
                              <div class="clr"></div>
                              <div class="more_link"><a href="<?php echo base_url().'hotelsummaries/hotel_search_by_city/'.$city.'/'.$country?>"><?php echo $LANG['More']== NULL?'More':$LANG['More'] ;?> &nbsp;<?php echo $LANG['Hotels']== NULL?'Hotels':$LANG['Hotels'] ;?> <img src="images/arrow.png" alt="" /></a></div>
                    	</div>
                    </div>
              <!--LONDON END-->
              <?php } } ?>
                 
 
               </div>
               <!--LEFT PANEL END-->

               <!--RIGHT PANEL START-->
               <div class="right_panel">
               	<div class="blue_box top_margin" style="min-height:260px;">
                    	<div class="viewed_box">
                         	<div class="heading_left" style="padding-left: 10px;"><h4><?php echo $LANG['Most Viewed']== NULL?'Most Viewed':$LANG['Most Viewed'] ;?></h4></div>
                              <?php /*?><div class="heading_right"><a href="javascript:void(0);"><?php echo $LANG['Delete All']== NULL?'Delete All':$LANG['Delete All'] ;?> <img src="images/icon_03.png" alt="" /></a></div><?php */?>
                               <?php if(count($Most_Viewed_Hotel) > 0) { foreach($Most_Viewed_Hotel as $Most_Viewed_Hotel_Data) {
								   ?>
                              
                              
                              <div class="view_row">
                              	<div class="cell_01">
                                <?php 
                                if(!empty($Most_Viewed_Hotel_Data->thumbnail_url)){?>
                                <a  href="<?php echo base_url().'hotel-details/'.$Most_Viewed_Hotel_Data->ean_hotel_id.'/'.convert_accented_characters(strtolower($Most_Viewed_Hotel_Data->name),'-')?>"><img  src="<?php echo $Most_Viewed_Hotel_Data->thumbnail_url?>" alt="" title="" border="0"  /></a>
                               <?php }else{?> <a  href="<?php echo base_url().'hotel-details/'.$Most_Viewed_Hotel_Data->ean_hotel_id.'/'.convert_accented_characters(strtolower($Most_Viewed_Hotel_Data->name),'-')?>"><img  src="<?php echo base_url()?>images/no_image_thumb.jpg"  alt="" title="" border="0"  /></a><?php } ?>
                                </div>
                                   <div class="cell_02">
                                   	<h5><a href="<?php echo base_url().'hotel-details/'.$Most_Viewed_Hotel_Data->ean_hotel_id.'/'.convert_accented_characters(strtolower($Most_Viewed_Hotel_Data->name),'-')?>"><?php echo $Most_Viewed_Hotel_Data->name;?></a></h5>
                                        <div class="rating"><img src="images/<?php echo str_replace(".","",$Most_Viewed_Hotel_Data->star_rating)?>_stars.png" alt="" /></div>
                                        <h6><?php echo $Most_Viewed_Hotel_Data->address1; ?><?php if($Most_Viewed_Hotel_Data->city != "") { echo ", ".$Most_Viewed_Hotel_Data->city; } ?><?php if($Most_Viewed_Hotel_Data->country != "") { echo ", ".$Most_Viewed_Hotel_Data->countryname; ?> <img src="country_flag/flags_thumb/<?php echo str_replace(" ","_",strtolower($Most_Viewed_Hotel_Data->countryname)); ?>.png" alt="" /><?php  } ?></h6>
                                        <p><?php echo getReviewRating(227774); ?></p>
                                        <div class="booking">Latest booking: 3 minutes ago <img src="images/icon_02.png" alt="" /></div>
                                   </div>
                                   <!--<div class="cell_03"><a href="javascript:void(0);"><img src="images/icon_03.png" alt="" /></a></div>-->
                              </div>
                              
                               <?php } } ?>  
                              <div class="clr"></div>
                         </div>
                    </div>
                 <!--YOU VIEWED END-->
                   <div class="blue_box top_margin" style="min-height:580px;">
                   		<div class="map_section">
                         	<h4><?php  echo $this->data['hotel_count']['no_of_hotels']; ?>&nbsp;<?php echo $LANG['Hotels in']== NULL?'Hotels in':$LANG['Hotels in'] ;?><?php  echo $this->data['country_count']['no_of_country']; ?> <?php echo $LANG['countries']== NULL?'countries':$LANG['countries'] ;?>&nbsp; <?php echo $LANG['worldwide']== NULL?'worldwide':$LANG['worldwide'] ;?></h4>
                            <div id="continent">
                             <!-- <a href="javascript:void(0);">Europe</a>&nbsp;|&nbsp;<a href="javascript:void(0);">North America</a>&nbsp;|&nbsp;<a href="javascript:void(0);">South America</a>&nbsp;|&nbsp;<a href="javascript:void(0);" class="select">Asia</a>&nbsp;|&nbsp;<a href="javascript:void(0);">Oceania</a>&nbsp;|&nbsp;<a href="javascript:void(0);">Africa</a>-->
                             <div class="heading">
                                <ul>
                                <li><a href="#continent-1" id="list_continent_1">Europe</a></li><li class="divider">|</li>
                                <li><a href="#continent-2" id="llist_continent_2">North America</a></li><li class="divider">|</li>
                                <li><a href="#continent-3" id="list_continent_3">South America</a></li><li class="divider">|</li>
                                <li><a href="#continent-4" id="list_continent_4">Asia</a></li><li class="divider">|</li>
                                <li><a href="#continent-5" id="list_continent_5">Oceania</a></li><li class="divider">|</li>
                                <li><a href="#continent-6" id="list_continent_6">Africa</a></li>
                                </ul>
                                </div>
                                <div id="continent-1">
                              
								<?php 
									$continent = 6022967;
									$s_where = " WHERE n.continent_id = ".$continent;
									$i_start = 0;
									$i_limit = 20;
									$all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where, $i_start, $i_limit);
									if(count($all_country_lists_by_continent) > 0) { 
									$tr = 0;
									$td = 0;
									$i = 0;
                                ?>
							  <div class="country_box">
                              	<ul>
								<?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") { $td++; $i++; $tr++; 
								?>
                                   	<li><img src="<?php echo base_url(); ?>country_flag/flags_thumb/<?php echo str_replace(" ","_",strtolower($Country_From_Hotel['country_name'])); ?>.png" alt="" /> 
                                    <a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'.convert_accented_characters(strtolower(html_entity_decode($Country_From_Hotel['country_name'])),'-');?>"><?php echo $Country_From_Hotel['country_name'];?></a>
                                <?php if($td=='5')
									 {
										echo '</ul></div><div class="country_box"><ul>';
										$td=0;
									 }
								 } } 
								?>        
                                   </ul>
                              </div>
							  <?php } ?> 
                                <div class="clr"></div>
                                </div>
                                <div id="continent-2">
                                
								<?php 
									$continent = 500001;
									$s_where = " WHERE n.continent_id = ".$continent;
									$i_start = 0;
									$i_limit = 20;
									$all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where, $i_start, $i_limit);
									if(count($all_country_lists_by_continent) > 0) { 
									$tr = 0;
									$td = 0;
									$i = 0;
                                ?>
							  <div class="country_box">
                              	<ul>
								<?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") { $td++; $i++; $tr++; 
								?>
                                   	<li><img src="<?php echo base_url(); ?>country_flag/flags_thumb/<?php echo str_replace(" ","_",strtolower($Country_From_Hotel['country_name'])); ?>.png" alt="" /> 
                                    <a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'.convert_accented_characters(strtolower(html_entity_decode($Country_From_Hotel['country_name'])),'-');?>"><?php echo $Country_From_Hotel['country_name'];?></a>
                                <?php if($td=='5')
									 {
										echo '</ul></div><div class="country_box"><ul>';
										$td=0;
									 }
								 } } 
								?>        
                                   </ul>
                              </div>
							  <?php } ?> 
                                <div class="clr"></div>
                                </div>
                                <div id="continent-3">
								<?php 
									$continent = 6023117;
									$s_where = " WHERE n.continent_id = ".$continent;
									$i_start = 0;
									$i_limit = 20;
									$all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where, $i_start, $i_limit);
									if(count($all_country_lists_by_continent) > 0) { 
									$tr = 0;
									$td = 0;
									$i = 0;
                                ?>
							  <div class="country_box">
                              	<ul>
								<?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") { $td++; $i++; $tr++; 
								?>
                                   	<li><img src="<?php echo base_url(); ?>country_flag/flags_thumb/<?php echo str_replace(" ","_",strtolower($Country_From_Hotel['country_name'])); ?>.png" alt="" /> 
                                    <a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'.convert_accented_characters(strtolower(html_entity_decode($Country_From_Hotel['country_name'])),'-');?>"><?php echo $Country_From_Hotel['country_name'];?></a>
                                <?php if($td=='5')
									 {
										echo '</ul></div><div class="country_box"><ul>';
										$td=0;
									 }
								 } } 
								?>        
                                   </ul>
                              </div>
							  <?php } ?>
                                <div class="clr"></div>
                                
                                </div>
                                <div id="continent-4">
                                
								<?php 
									$continent = 6023099;
									$s_where = " WHERE n.continent_id = ".$continent;
									$i_start = 0;
									$i_limit = 20;
									$all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where, $i_start, $i_limit);
									if(count($all_country_lists_by_continent) > 0) { 
									$tr = 0;
									$td = 0;
									$i = 0;
                                ?>
							  <div class="country_box">
                              	<ul>
								<?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") { $td++; $i++; $tr++; 
								?>
                                   	<li><img src="<?php echo base_url(); ?>country_flag/flags_thumb/<?php echo str_replace(" ","_",strtolower($Country_From_Hotel['country_name'])); ?>.png" alt="" /> 
                                    <a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'.convert_accented_characters(strtolower(html_entity_decode($Country_From_Hotel['country_name'])),'-');?>"><?php echo $Country_From_Hotel['country_name'];?></a>
                                <?php if($td=='5')
									 {
										echo '</ul></div><div class="country_box"><ul>';
										$td=0;
									 }
								 } } 
								?>        
                                   </ul>
                              </div>
							  <?php } ?>
                                <div class="clr"></div>
                                
                                </div>
                                <div id="continent-5">
                                
								<?php 
									$continent = 6023180;
									$s_where = " WHERE n.continent_id = ".$continent;
									$i_start = 0;
									$i_limit = 20;
									$all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where, $i_start, $i_limit);
									if(count($all_country_lists_by_continent) > 0) { 
									$tr = 0;
									$td = 0;
									$i = 0;
                                ?>
							  <div class="country_box">
                              	<ul>
								<?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") { $td++; $i++; $tr++; 
								?>
                                   	<li><img src="<?php echo base_url(); ?>country_flag/flags_thumb/<?php echo str_replace(" ","_",strtolower($Country_From_Hotel['country_name'])); ?>.png" alt="" /> 
                                    <a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'.convert_accented_characters(strtolower(html_entity_decode($Country_From_Hotel['country_name'])),'-');?>"><?php echo $Country_From_Hotel['country_name'];?></a>
                                <?php if($td=='5')
									 {
										echo '</ul></div><div class="country_box"><ul>';
										$td=0;
									 }
								 } } 
								?>        
                                   </ul>
                              </div>
							  <?php } ?>
                                <div class="clr"></div>
                                </div>
                                <div id="continent-6">
                                
								<?php 
									$continent = 6023185;
									$s_where = " WHERE n.continent_id = ".$continent;
									$i_start = 0;
									$i_limit = 20;
									$all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where, $i_start, $i_limit);
									if(count($all_country_lists_by_continent) > 0) { 
									$tr = 0;
									$td = 0;
									$i = 0;
                                ?>
							  <div class="country_box">
                              	<ul>
								<?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") { $td++; $i++; $tr++; 
								?>
                                   	<li><img src="<?php echo base_url(); ?>country_flag/flags_thumb/<?php echo str_replace(" ","_",strtolower($Country_From_Hotel['country_name'])); ?>.png" alt="" /> 
                                    <a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'.convert_accented_characters(strtolower(html_entity_decode($Country_From_Hotel['country_name'])),'-');?>"><?php echo $Country_From_Hotel['country_name'];?></a>
                                <?php if($td=='5')
									 {
										echo '</ul></div><div class="country_box"><ul>';
										$td=0;
									 }
								 } } 
								?>        
                                   </ul>
                              </div>
							  <?php } ?>
                                <div class="clr"></div>
                                </div>
                                </div>
                            
                           
                              
                              <div class="clr"></div>
                              <div class="more_link"><a href="<?php base_url()?>Destinations">More <img src="images/arrow.png" alt="" /></a></div>
                              <div><?php echo showMap('asia', '0', base_url().'worldmap'); ?></div>
                         </div>
                   </div>
                <!--MAP END-->
                <?php if(count($Top_Destination) > 0) { ?>
                	<div class="destination top_margin">
                    	<h4><?php echo $LANG['Top Destinations']== NULL?'Top Destinations':$LANG['Top Destinations'] ;?></h4>
                        <?php foreach($Top_Destination as $All_Top_Destination) { ?>
                    	<div class="descrip_box">
                         	<div class="img_box">
                            <?php 
                                if(!empty($All_Top_Destination['destination_img'])){?>
                                <a  href="<?php echo base_url().'hotelsummaries/hotel_search_by_city/'.$All_Top_Destination['city'].'/'.$All_Top_Destination['country_code']?>"><img  src="<?php echo base_url()?>hotel_destination_images/aspect_image/photo_thumbnail74_74/<?php echo $All_Top_Destination['destination_img'];?>" alt="" title="" border="0"  /></a>
                               <?php }else{?> <a  href="<?php echo base_url().'hotelsummaries/hotel_search_by_city/'.$All_Top_Destination['city'].'/'.$All_Top_Destination['country_code']?>"><img  src="<?php echo base_url()?>images/no_image_thumb.jpg"  alt="" title="" border="0"  /></a><?php } ?>
                                </div>
                              <div class="text_box">
                              	<h5><a href="<?php echo base_url().'hotelsummaries/hotel_search_by_city/'.$All_Top_Destination['city'].'/'.$All_Top_Destination['country_code']?>"><?php echo $All_Top_Destination['city'];?></a></h5>
                                   <div class="country"><img src="images/it.gif" alt="" /> <?php echo $All_Top_Destination['country'];?></div>
                                   <p>1304 hotels</p>
                                   <div class="booking">Latest booking: 3 minutes ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
                              </div>
                         </div>
                          <?php } ?>
                         <div class="clr"></div>
                         <div class="more_link"><a href="javascript:void(0);"><?php echo $LANG['More Destination']== NULL?'More Destination':$LANG['More Destination'] ;?> <img src="<?php echo base_url()?>images/arrow.png" alt="" /></a></div>
                    </div>
                     <?php } ?>
                  <!--TOP DESTINATION END-->
                  <div class="booking_box top_margin">
                  		<h3><?php echo $LANG['Why use booking and you.com']== NULL?'Why use booking and you.com':$LANG['Why use booking and you.com'] ;?>? </h3>
                         <ul>
                         	<li>
                              	<h5><?php echo $LANG['No Reservation Fee']== NULL?'No Reservation Fee':$LANG['No Reservation Fee'] ;?></h5>
                                   <p><?php echo $LANG['No booking fees']== NULL?'No booking fees':$LANG['No booking fees'] ;?> <img src="images/bullet_01.png" alt="" /> <?php echo $LANG['Save money']== NULL?'Save money':$LANG['Save money'] ;?> ! </p>
                              </li>
                              <li>
                              	<h5><?php echo $LANG['No Hidden Charges']== NULL?'No Hidden Charges':$LANG['No Hidden Charges'] ;?></h5>
                                   <p>30,000+ <?php echo $LANG['destinations']== NULL?'destinations':$LANG['destinations'] ;?> <img src="images/bullet_01.png" alt="" />  153,980 <?php echo $LANG['hotels worldwide']== NULL?'hotels worldwide':$LANG['hotels worldwide'] ;?></p>
                              </li>
                              <li>
                              	<h5><?php echo $LANG['Instant Confirmation']== NULL?'Instant Confirmation':$LANG['Instant Confirmation'] ;?></h5>
                                   <p><?php echo $LANG['More than']== NULL?'More than':$LANG['More than'] ;?> 200,000 <?php echo $LANG['room nights booked every day']== NULL?'room nights booked every day':$LANG['room nights booked every day'] ;?></p>
                              </li>
                              <li>
                              	<h5><?php echo $LANG['Low Rates']== NULL?'Low Rates':$LANG['Low Rates'] ;?></h5>
                                   <p>9,040,000 <?php echo $LANG['hotel reviews from real guests']== NULL?'hotel reviews from real guests':$LANG['hotel reviews from real guests'] ;?></p>
                              </li>
                              <li style="border:none">
                              	<h5><?php echo $LANG['Over']== NULL?'Over':$LANG['Over'] ;?> 125,467 <?php echo $LANG['hotels']== NULL?'hotels':$LANG['hotels'] ;?></h5>
                                   <p><?php echo $LANG['Website and customer service in']== NULL?'Website and customer service in':$LANG['Website and customer service in'] ;?> English (US) and 40 <?php echo $LANG['other languages']== NULL?'other languages':$LANG['other languages'] ;?> </p>
                              </li>
                         </ul>
                  </div>  
                 <!--BOOKING END-->
                  <div class="blue_box top_margin">
                  	<div class="subscribe">
					<div id="subscription_message" style="color:red;"></div>
					<form name="general_subscription" id="general_subscription" action="<?php echo base_url()?>user/subscribe_general" method="post">
                    	<h4><?php echo $LANG['Save']== NULL?'Save':$LANG['Save'] ;?> 50% <?php echo $LANG['or more with us']== NULL?'or more with us':$LANG['or more with us'] ;?></h4>
                         <h4><?php echo $LANG['Subscribe to get exclusive offers']== NULL?'Subscribe to get exclusive offers':$LANG['Subscribe to get exclusive offers'] ;?></h4>
                         <label><?php echo $LANG['Your e-mail']== NULL?'Your e-mail':$LANG['Your e-mail'] ;?>:</label><?=form_input(array('name'=>'subscribe_email','value'=>'','class'=>'subscribe_emaii'))?>
                         <input  type="submit" value="<?=$LANG['Subscribe']== NULL?'Subscribe':$LANG['Subscribe']?>" class="button_01 right" style=" margin-top:10px; margin-right:5px;" id="subscribe"/>
                         <div class="clr"></div>
                   </form>     
                    </div>
                  </div>
                 
               </div>
               <!--RIGHT PANEL END-->
               <div class="clr"></div>
          </div>
     <!--CONTENT SECTION END-->
     
     </div>
<script type="text/javascript">
$(document).ready(function() {

/*###########################################SUBSCRIBE CODE Start##########################################*/ 	 
	 $("#subscribe").click(function() {
//	 alert("I am here !");
//	 die();

var form_data = {
subscribe_emaii : $('.subscribe_emaii').val(),
ajax : '1'
}


			if($('.subscribe_emaii').val()==''){
					msg="Enter Email ID !";
					//alert(msg);
					$('#subscription_message').html(msg);
					$('#message').fadeIn(500).show();
					return false;
								
			}
			
			else if(!validateEmail($('.subscribe_emaii').val()))
			{
            msg="Please provide a valid email address !";
			//alert(msg);
			$('#subscription_message').html(msg);
			$('#subscription_message').fadeIn(500).show();
			return false;
			}
			

			else
			{
			
				$.ajax({
				//url: "<?php //echo site_url('login/ajax_check'); ?>",
				url: "User/subscribe_general",
				type: 'POST',
				async : false,
				data: form_data,
				success: function(msg) {
				//alert(msg);
				$('#subscription_message').html(msg);
				$('#subscription_message').fadeIn(500).show();
				}
				});
			
			}


return false;
});
/*###########################################SUBSCRIBE CODE End##########################################*/ 


});
</script>

<script type="text/javascript">
      <!--
      var cellStyle='';
      var childHelp="Please provide the ages of children in each room. Children's ages should be their age at the time of travel.";
      var adultHelp="";
      var textRooms="Rooms:";
      var textAdults="Adults: (age 19+)";
      var textChildren="Children: (0-18)";
      var textChildError="Please specify the ages of all children.";
      var pad='<img src="/images/p.gif" width="5" height="1">';
    
      var textRoomX="Room ?:";
      var textChildX="Child ?:";
    
      var childrenPerRoom=new Array();
      var adultsPerRoom=new Array();
      var childAgesPerRoom=new Array();
      var numRooms=0;
      var maxChildren=0;
      var pad='<img src="/images/p.gif" width="5" height="1">';

      adultsPerRoom[0]=2;
      childrenPerRoom[0]=0;
      numRooms=1;
      if (numRooms < 1) {
        numRooms = 1;
      }
      refresh();

      function setChildAge(room, child, age) {
        if (childAgesPerRoom[room] == null) {
          childAgesPerRoom[room] = new Array();
        }
        childAgesPerRoom[room][child] = age;
      }

      function setNumAdults(room, numAdults) {
        adultsPerRoom[room] = numAdults;
      }

      function setNumChildren(room, numChildren) {
        childrenPerRoom[room] = numChildren;
        refresh();
      }

      function setNumRooms(x) {
        numRooms = x;
        for (i = 0; i < x; i++) {
          if (adultsPerRoom[i] == null) {
            adultsPerRoom[i] = 2;
          }
          if (childrenPerRoom[i] == null) {
            childrenPerRoom[i] = 0;
          }
        }
        refresh();
      }

      function renderRoomSelect() {
        var x = '';
        x += '<select name="numberOfRooms" onchange="setNumRooms(this.options[this.selectedIndex].value);">';
        for (var i = 1; i < 9; i++) {
          x += '<option value="'+i+'"'+(numRooms == i ? ' selected' : '')+'>' + i;
        }
        x += '</select>';
        return x;
      }

      function refresh() {
        maxChildren = 0;
        for (var i = 0; i < numRooms; i++) {
          if (childrenPerRoom[i] > maxChildren) {
            maxChildren = childrenPerRoom[i];
          }
        }

        var x = '';
        if (adultHelp.length > 0) {
          x = adultHelp + "<p>\n";
        }

        if (numRooms > 8) {
          x += '<table border="0" cellspacing="0" cellpadding="2" class="hotel_tbl">\n';
          x += '<tr><td'+cellStyle+'><nobr>'+textRooms+pad+'</nobr></td><td>';
          x += renderRoomSelect();
          x += '</td></tr></table>';
        } else {
          x += '<table border="1" cellspacing="0" cellpadding="2" class="hotel_tbl">\n';
         // x += '<tr><td'+cellStyle+'><nobr>'+textRooms+pad+'</nobr></td>';
         // x += '<td'+cellStyle+'><img src="/images/p.gif" width="50" height="1"></td>';
         // x += '<td'+cellStyle+'><nobr>'+textAdults+pad+'</nobr></td><td'+cellStyle+'><nobr>'+textChildren+pad+'</nobr></td></tr>\n';
          for (var i = 0; i < numRooms; i++) {
            x += '<tr><td'+cellStyle+'>';
            if (i == 0) {
              x += renderRoomSelect();
            } else {
              x += '&nbsp;';
            }
            x += '</td>';
            if (numRooms > 1) {
              x += '<td'+cellStyle+'><nobr>'+getValue(textRoomX, i+1)+pad + '</nobr></td>';
            } else {
              x += '<td'+cellStyle+'>&nbsp;</td>';
            }
            x += '<td'+cellStyle+'>';
            x += buildSelect('room-' + i + '-adult-total', 'setNumAdults(' + i + ', this.options[this.selectedIndex].value)', 1, 4, adultsPerRoom[i]);
            x += '</td><td'+cellStyle+'>';
            x += buildSelect('room-' + i + '-child-total', 'setNumChildren(' + i + ', this.options[this.selectedIndex].value)', 0, 3, childrenPerRoom[i]);
            x += '</td></tr>\n';
          }
          x += '</table>\n';

          var didHeader = false;
          for (var i = 0; i < numRooms; i++) {
            if (childrenPerRoom[i] > 0) {
              if (!didHeader) {
                x += '<table border="0" cellpadding="0" cellspacing="2">\n';
                x += '<tr><td'+cellStyle+' colspan="'+(maxChildren+1)+'">';
                x += '<img src="/images/p.gif" width="1" height="5"><br>';
                x += childHelp;
                x += '<img src="/images/p.gif" width="1" height="5"><br>';
                x += '</td></tr>\n<tr><td'+cellStyle+'>&nbsp;</td>';
                for (var j = 0; j < maxChildren; j++) {
                  x += '<td'+cellStyle+'><nobr>'+getValue(textChildX, j+1)+pad+'</nobr></td>\n';
                }
                didHeader = true;
              }
              x += '</tr>\n<tr><td'+cellStyle+'><nobr>'+getValue(textRoomX, i+1)+pad+'</nobr></td>';
              for (var j = 0; j < childrenPerRoom[i]; j++) {
                x += '<td'+cellStyle+'>';
                var def = -1;
                if (childAgesPerRoom[i] != null) {
                  if (childAgesPerRoom[i][j] != null) {
                    def = childAgesPerRoom[i][j];
                  }
                }
                x += '<select name="room-'+i+'-child-'+j+'-age" onchange="setChildAge('+i+', '+j+', this.options[this.selectedIndex].value);">';
                x += '<option value="-1"'+(def == -1 ? ' selected' : '')+'>-?-';
                x += '<option value="0"'+(def == 0 ? ' selected' : '')+'>&lt;1';
                for (var k = 1; k <= 17; k++) {
                  x += '<option value="'+k+'"'+(def == k ? ' selected' : '')+'>'+k;
                }
                x += '</td>';
              }
              if (childrenPerRoom[i] < maxChildren) {
                for (var j = childrenPerRoom[i]; j < maxChildren; j++) {
                  x += '<td'+cellStyle+'>&nbsp;</td>';
                }
              }
              x += '</tr>\n';
            }
          }
          if (didHeader) {
            x += '</table>\n';
          }
        }
        document.getElementById("hot-search-params").innerHTML = x;
      }

      function buildSelect(name, onchange, min, max, selected) {
        var x = '<select name="' + name + '"';
        if (onchange != null) {
          x += ' onchange="' + onchange + '"';
        }
        x +='>\n';
        for (var i = min; i <= max; i++) {
          x += '<option value="' + i + '"';
          if (i == selected) {
            x += ' selected';
          }
          x += '>' + i + '\n';
        }
        x += '</select>';
        return x;
      }

      function validateGuests(form) {
        if (numRooms < 9) {
          var missingAge = false;
          for (var i = 0; i < numRooms; i++) {
            var numChildren = childrenPerRoom[i];
            if (numChildren != null && numChildren > 0) {
              for (var j = 0; j < numChildren; j++) {
                if (childAgesPerRoom[i] == null || childAgesPerRoom[i][j] == null || childAgesPerRoom[i][j] == -1) {
                  missingAge = true;
                }
              }
            }
          }

          if (missingAge) {
            alert(textChildError);
            return false;
          } else {
            return true;
          }
        } else {
          return true;
        }
      }

      function submitGuestInfoForm(form) {
        if (!validateGuests(form)) {
          return false;
        }
        return true;
      }

      function getValue(str, val) {
        return str.replace(/\?/g, val);
      }
      //-->
    </script>
    
    <style>
	.hotel_tbl {font-size:11px; font-weight:bold;}
	#msdrpdd20_msdd {width:55px; background:#fff;}
	</style>