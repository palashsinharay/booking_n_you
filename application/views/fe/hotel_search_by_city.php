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
	//alert(search_location);
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
    
	var	search_string = 'city='+city+'&state_province='+state+'&country='+country+'&checkin_date='+start_date+'&checkout_date='+end_date+'&amenity='+amenitylist+'&starrate='+starratelist+'&sortby='+sortby+'&propertytype='+propertytypelist+'&chaincode='+chaincodelist+'&pricerange='+pricerangelist+'&rooms='+numRooms+'&room_adults='+room_adults+'&room_childs='+room_childs;
	
	
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
               	<p><?php echo $LANG['You are here']== NULL?'You are here':$LANG['You are here'] ;?>:&nbsp;&nbsp;<a href="<?php echo base_url(); ?>"><?php echo $LANG['Home']== NULL?'Home':$LANG['Home'] ;?></a>
				<?php if(!empty($search_country)) { ?><img src="<?php echo base_url(); ?>images/arrow2.png" alt="" />
				<?php echo $LANG['Hotels in']== NULL?'Hotels in':$LANG['Hotels in'] ;?>
                <a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$search_country.'/'.str_replace(" ","-",mb_strtolower($search_country, 'UTF-8'));?>"><?php echo $search_country;?></a><?php } ?>
				<?php if($search_city != "") {?><a href="<?php echo base_url().'hotelsummaries/hotel_search_by_city/'.$search_city.'/'.$search_country;?>"><?php echo $search_city;?></a>
                 <?php } ?> 
                </p>
               </div>
          	<!--LEFT PANEL START-->
               	<div class="left_panel_02">
                    <!--HOTEL SEARCH START-->
					<?php echo form_open_multipart('hotelsummaries/search_result',array("id"=>"search_result_form"));?>
                    	<div class="hetel_search">
                             <h3 style="font-size:17px;"><img src="<?php echo base_url(); ?>images/i_glass.png" alt="" /> <?php echo $LANG['Search Hotels']== NULL?'Search Hotels':$LANG['Search Hotels'] ;?></h3>
                             <p><?php echo $LANG['Where']== NULL?'Where':$LANG['Where'] ;?> ?</p>
                            <div id="div_err"></div>
                             <input type="text" name="txt_location" id="txt_location" onkeyup="get_location_name(this.value)" value=""  autocomplete="off" />
                            <input type="hidden" name="location_id" id="location_id"  />
                            <div id="suggestionsSearch" class="suggestionsBox2" style="display:none;">
                            <div class="arrow_autocom" style="height:2px;">&nbsp;</div>
                            <!--<div class="suggestionList" id="autoSuggestionsListSearch" style="height:130px; overflow:auto;">&nbsp;</div>-->
                            <div class="suggestionList" id="autoSuggestionsListSearch">&nbsp;</div>
                            </div>
                            
                              <div class="clr"></div>
                              <p class="top_margin10"><?php echo $LANG['Check-In Date']== NULL?'Check-In Date':$LANG['Check-In Date'] ;?></p>
                              <div class="select_box" style="width:130px;">
								<input type="text" style="width: 88px;" class="date-pick dp-applied" id="start-date" name="start-date" readonly="readonly">
                               </div>
                                <div class="select_box"></div>                                   
                               <div class="clr"></div>
                               <p class="top_margin10"><?php echo $LANG['Check-Out Date']== NULL?'Check-Out Date':$LANG['Check-Out Date'] ;?></p>
                              <div class="select_box" style="width:130px;">
                              <input type="text" style="width: 88px;" class="date-pick dp-applied" id="end-date" name="end-date" readonly="readonly">
                               </div>
                                <div class="select_box"></div>                                   
                                <div class="clr"></div>
                              
                                 <p class="margin_10_tb"><span style="padding-left:2px;"><?php echo $LANG['Rooms']== NULL?'Rooms':$LANG['Rooms'] ;?></span><span style="margin-left:5px; padding-left:15px;"> <?php echo $LANG['Adults']== NULL?'Adults':$LANG['Adults'] ;?></span><span style="margin-left:20px; padding-left:13px;"><?php echo $LANG['Children']== NULL?'Children':$LANG['Children'] ;?></span></p>
                                 <div class="clr"></div>
                                <p>
                                  <select name="rooms2[]" id="rooms2" style="width:50px; float:left;background: #FFFFFF;line-height: 16px;">
										<option value="1" selected="selected">1</option>
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
                                    
                                    
                                
                                 <select name="adult2[]" id="adult2" style="width:50px; float:left; margin-left:10px;background:#FFFFFF;line-height: 16px;">
										<option value="1">1</option>
										<option value="2" selected="selected">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
									</select>
                                   
                                    
                                    <select name="child2[]" id="child2" style="width:50px; float:left; margin-left:20px;background: #FFFFFF;line-height: 16px;">
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
                                              $("#rooms2").msDropDown();                                              
                                              $("#adult2").msDropDown();                                              
                                              $("#child2").msDropDown();                                              
                                        })                                    
                                    </script>                                                                 
                                     </p>
                              <div class="clr"></div>
                               <p class="top_margin"><input type="checkbox" /> <?php echo $LANG["I don't have specific dates yet"]== NULL?"I don't have specific dates yet":$LANG["I don't have specific dates yet"] ;?> </p>
								<?php //$url = $this->redirect(array('controller' => 'hotelsummaries', 'action' => 'search_result', 'title' => 'result.html')); ?>
                               <input type='button' value='Search' class='button_01 top_margin' name='search_button' onclick='send_url(this.form);' /> 
                             
                             
                             
                             <!--POP UP BOX--> 
						  <script type="text/javascript">
                                function show_div () 
                                   {
                                   document.getElementById('popup_box').style.visibility = 'visible'; 
                                   }
                                   function hide_div () 
                                   {
                                   document.getElementById('popup_box').style.visibility = 'hidden'; 
                                   }
                                </script>         
                               <div id="popup_box" class="pop_box" style="visibility:hidden">
                               	<h5><a href="javascript:void(0);" onclick="hide_div()">Close</a></h5>
                                   <div class="pop_heading">Rooms</div>
                                   <div class="pop_heading">Adult</div>
                                   <div class="pop_heading">Children</div>
                                   <div class="clr"></div>
                                   <div class="pop_row">
                                   	<div class="pop_cell">Room1</div>
                                        <div class="pop_cell">
                                        	<select name="adult2" id="adult2" style="width:50px;background: #FFFFFF; ">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
						 <script type="text/javascript">
                                        $(document).ready(function(arg) {
                                                  //$("body select").msDropDown(
                                              $("#adult2").msDropDown();
                                              $("#adult2").hide();
                                              $('#adult2_msdd').css("background-image", "url(<?php echo base_url(); ?>images/select_bg3.png)");
                                              $('#adult2_msdd').css("background-repeat", "no-repeat");
									          $('#adult2_msdd').css("background-position", "left");
                                              $('#adult2_msdd').css("height", "24px"); 
                                              $('#adult2_msdd').css("line-height", "18px");	 
                                              
                                        })
                                   </script>
                                        </div>
                                        <div class="pop_cell">
                                        <select name="child2" id="child2" style="width:50px;background: #FFFFFF; ">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
						 <script type="text/javascript">
                                        $(document).ready(function(arg) {
                                                  //$("body select").msDropDown(
                                              $("#child2").msDropDown();
                                              $("#child2").hide();
                                              $('#child2_msdd').css("background-image", "url(<?php echo base_url(); ?>images/select_bg3.png)");
                                              $('#child2_msdd').css("background-repeat", "no-repeat");
									 $('#child2_msdd').css("background-position", "left");
                                              $('#child2_msdd').css("height", "24px"); 
                                              $('#child2_msdd').css("line-height", "22px");	 
                                              
                                        })
                                   </script>
                                        </div>
                                        <div class="pop_cell2"><a href="javascript:void(0);">Remove</a></div>
                                   </div>
                                   <div class="clr"></div>
                                   <p class="top_margin10"><a href="javascript:void(0);">+<?php echo $LANG["Add another room"]== NULL?"Add another room":$LANG["Add another room"] ;?></a></p>
                                   <input type="submit" value="Change" class="button_01 top_margin10 right" />
                                   <div class="clr"></div>
                               </div>
                         </div>
                   <!--HOTEL SEARCH END-->
                  <!--FILTER START-->       
                        <!--div class="blue_box filter">
                        		<h3><?php echo $LANG["Filter By"]== NULL?"Filter By":$LANG["Filter By"] ;?></h3>
                        		<h4><?php echo $LANG["Price Range"]== NULL?"Price Range":$LANG["Price Range"] ;?><span>(<?php echo $LANG["per night"]== NULL?"per night":$LANG["per night"] ;?>)</span> <img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="17"><input type="checkbox" name="price[]" id="price_1" /></td>
                                  <td>INR 0 - INR 3199</td>
                                </tr>
                                <tr>
                                 <td><input type="checkbox" name="price[]" id="price_2" /></td>
                                  <td>INR 3200 - INR 6399</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="price[]" id="price_3" /></td>
                                  <td>INR 6400 - INR 9599</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="price[]" id="price_4" /></td>
                                  <td>INR 9600 - INR 12999</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="price[]" id="price_5" /></td>
                                  <td>INR 13000 +</td>
                                </tr>
                              </table>
						<h4><?php echo insertStaticWord('Star Rating'); ?> <img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="17"><input type="checkbox" name="starrating[]" id="starrating_1" /></td>
                                  <td>1 Stars</td>
                                  <td align="right"><span>8 Hotels</span></td>
                                </tr>
								<tr>
                                  <td width="17"><input type="checkbox" name="starrating[]" id="starrating_2" /></td>
                                  <td>2 Stars</td>
                                  <td align="right"><span>8 Hotels</span></td>
                                </tr>
								<tr>
                                  <td width="17"><input type="checkbox" name="starrating[]" id="starrating_3" /></td>
                                  <td>3 Stars</td>
                                  <td align="right"><span>8 Hotels</span></td>
                                </tr>
                                <tr>
                                 <td><input type="checkbox" name="starrating[]" id="starrating_4" /></td>
                                  <td>4 Stars</td>
                                  <td align="right"><span>5 Hotels</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="starrating[]" id="starrating_5" /></td>
                                  <td>5 Stars</td>
                                  <td align="right"><span>4 Hotels</span></td>
                                </tr>
                              </table>
                              <h4><?php echo insertStaticWord('Hotel Type'); ?> <img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="17"><input type="checkbox" name="hoteltype[]" id="hoteltype_1" /></td>
                                  <td>Hotel</td>
                                  <td align="right"><span>17 Hotels</span></td>
                                </tr>
                              </table>
                              <h4><?php echo insertStaticWord('Fecilities'); ?> <img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="17"><input type="checkbox" name="facilities[]" id="facilities_1" /></td>
                                  <td width="130">Wi-Fi/Wireless LAN</td>
                                  <td align="right"><span>16 Hotels</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="facilities[]" id="facilities_2" /></td>
                                  <td>Parking</td>
                                  <td align="right"><span>16 Hotels</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="facilities[]" id="facilities_3" /></td>
                                  <td>Airport Shuttle</td>
                                  <td align="right"><span>4 Hotels</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="facilities[]" id="facilities_4" /></td>
                                  <td>Internet Services</td>
                                  <td align="right"><span>17 Hotels</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="facilities[]" id="facilities_5" /></td>
                                  <td>Fitness Centre</td>
                                  <td align="right"><span>9 Hotels</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="facilities[]" id="facilities_6" /></td>
                                  <td>Non-Smoking Rooms</td>
                                  <td align="right"><span>16 Hotels</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="facilities[]" id="facilities_7" /></td>
                                  <td>Spa &amp; Wellness Centre</td>
                                  <td align="right"><span>3 Hotels</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="facilities[]" id="facilities_8" /></td>
                                  <td>Outdoor Swimming Pool</td>
                                  <td align="right"><span>7 Hotels</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="facilities[]" id="facilities_9" /></td>
                                  <td>Restaurant</td>
                                  <td align="right"><span>16 Hotels</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="facilities[]" id="facilities_10" /></td>
                                  <td>Rooms/Facilities for Disabled Guests</td>
                                  <td align="right"><span>16 Hotels</span></td>
                                </tr>
                              </table>
                               <h4><?php echo insertStaticWord('Hotel Theme'); ?> <img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="17"><input type="checkbox" name="hoteltheme[]" id="hoteltheme_1" /></td>
                                  <td>City Trip</td>
                                  <td align="right"><span>1 Hotel</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="hoteltheme[]" id="hoteltheme_2" /></td>
                                  <td>Business</td>
                                  <td align="right"><span>2 Hotels</span></td>
                                </tr>
                              </table>
                              <h4>Chain <img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="17"><input type="checkbox" name="hotelchain[]" id="hotelchain_1" /></td>
                                  <td>Taj Hotels &amp; Resorts</td>
                                  <td align="right"><span>1 Hotel</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="hotelchain[]" id="hotelchain_2" /></td>
                                  <td>Swissôtel</td>
                                  <td align="right"><span>1 Hotel</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="hotelchain[]" id="hotelchain_3" /></td>
                                  <td>Sarovar Hotels</td>
                                  <td align="right"><span>1 Hotel</span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="hotelchain[]" id="hotelchain_4" /></td>
                                  <td>The Park Hotels</td>
                                  <td align="right"><span>1 Hotel</span></td>
                                </tr>
                              </table>
                        </div--> 
                  <?php echo form_close();?>
                  <!--FILTER END-->  
                  
                  <!--MAP START-->
                      <div class="blue_box filter">
                      <h3><?php echo $LANG['Map']== NULL?'Map':$LANG['Map']?></h3>
                      <div class="inner_box" id="map_canvas" style="height:210px;width:222px;"></div>
                         <?php
                           $latLang = getResignLatitudeLongitude($search_city);
                           $latitude = $latLang[0];
                           $longitude = $latLang[1];
                         ?>
                         <script language="javascript">
                            googleMap('<?php echo $latitude; ?>', '<?php echo $longitude; ?>', 8);
                        </script>
                         <div class="more_link"><a href="javascript:void(0)"><?=$LANG['Show Map']== NULL?'Show Map':$LANG['Show Map']?> <img src="<?php echo base_url(); ?>images/arrow.png" alt="" /></a>
						 </div>
                      </div> 
                 <!--MAP END-->
                 <!--IN AND AROUND-->
                      <div class="blue_box filter">
                        	<h3><?php echo $LANG['In and around']== NULL?'In and around':$LANG['In and around']?> <img src="<?php echo base_url(); ?>images/icon_05.png" alt="" /></h3>
                         <div class="inner_box">
                         	<h6><?php echo $LANG['Monuments or landmarks']== NULL?'Monuments or landmarks':$LANG['Monuments or landmarks'];?></h6>
                              <p><a href="javascript:void(0);">Marble Palace</a></p>
                              <h6><?php echo $LANG['Stadiums or Arenas']== NULL?'Stadiums or Arenas':$LANG['Stadiums or Arenas'];?><?php echo $LANG['Monuments or landmarks']== NULL?'Monuments or landmarks':$LANG['Monuments or landmarks'];?></h6>
                              <p><a href="javascript:void(0);">Eden Garden Kolkata</a></p>
                              <h6><?php echo $LANG['Airport']== NULL?'Airport':$LANG['Airport']; ?></h6>
                              <p><a href="javascript:void(0);">Netaji Subhash Chandra Bose (CCU) 12.3 km </a></p>
                         </div>
                      </div> 
              <!--MY VIEWED HOTEL-->        
                      <?php if((count($User_View_cookie_data) > 0) && ($User_View_cookie_data != "")) {
					  
					   ?>
                      <div class="blue_box filter">
                        	<h3><?php echo $LANG['My Viewed Hotels']== NULL?'My Viewed Hotels':$LANG['My Viewed Hotels'] ;?></h3>
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
									<br /><a href="javascript:void(0)"><em><?php echo $LANG['Show Map']== NULL?'Show Map':$LANG['Show Map'] ;?></em></a></p>
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
                              <div class="delete_all"><a href="javascript:void(0);">Delete All <img alt="" src="<?php echo base_url(); ?>images/icon_03.png"></a></div>
                         </div>
                      </div>
                      <?php 
					  } ?>
                      
                      
                         
                    </div>
               <!--LEFT PANEL END-->

               <!--RIGHT PANEL START-->
               	<div class="right_panel_02">
                    	<div class="hotel_cont">
                         	<div class="heading">
                              	<div class="left_part"><h2><?php echo $LANG['Hotels found in']== NULL?'Hotels found in':$LANG['Hotels found in'] ;?> <?php echo $search_city; ?></h2></div>
                                  <!-- <div class="right_part"><img src="<?php echo base_url(); ?>images/map4.jpg" alt="" /> <a href="javascript:void(0)" onclick="show_map('google_big_map_for_hotel', '<?php echo $latitude; ?>', '<?php echo $longitude; ?>', '<?php echo mysql_real_escape_string($City_Hotel_Data[0]['name']); ?>')"><?php echo $LANG['Show Map']== NULL?'Show Map':$LANG['Show Map'] ;?></a>

															
								   </div>-->
                              </div>
                              <div class="clr"></div>
                             
                              <div class="clr"></div>
							  <?php if(count($City_Hotel_Data) > 0) { foreach($City_Hotel_Data as $City_All_Hotel_Data) {
							   $ean_hotel_id = $City_All_Hotel_Data['ean_hotel_id'];
							   $this->load->model('HotelImageList_model');
							   $s_where = " WHERE n.ean_hotel_id = ".$ean_hotel_id;
							   $HotelImageData = $this->HotelImageList_model->fetch_multi($s_where); 
							   ?>
                              <div class="hotel_info">
                              	<div class="img_box">
								<?php 
                                if(!empty($HotelImageData[0]['thumbnail_url'])){?>
                                <a href="<?php echo base_url().'hotel-details/'.$ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($City_All_Hotel_Data['name'], 'UTF-8'));?>"><img src="<?php echo $HotelImageData[0]['thumbnail_url'];?>" border="0" width="40" height="40" title="" /><?php } else { ?><img src="images/no_image_thumb.jpg" border="0" width="40" height="40"  title="" /><?php } ?></a>
								</div>
                                   <div class="text_box">
                                   	<div class="review_tag"><?php echo getReviewRatingSearchResult($ean_hotel_id); ?></div>
                                        <h3><a href="<?php echo base_url().'hotel-details/'.$ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($City_All_Hotel_Data['name'], 'UTF-8'));?>"><?php echo $City_All_Hotel_Data['name'];?></a><img src="<?php echo base_url(); ?>images/<?php echo str_replace(".","",$City_All_Hotel_Data['star_rating'])?>_stars.png" alt="" /></h3>
                                        <p><?php echo $City_All_Hotel_Data['address1']; ?><?php if($City_All_Hotel_Data['city'] != "") { echo ", ".$City_All_Hotel_Data['city']; } ?><?php if($City_All_Hotel_Data['country'] != "") { echo ", ".$City_All_Hotel_Data['country']; } ?> 
										<a href="javascript:void(0)" onclick="show_map('google_big_map_for_hotel', '<?php echo $latitude; ?>', '<?php echo $longitude; ?>', '<?php echo mysql_real_escape_string($City_All_Hotel_Data['name']); ?>')"><?php echo $LANG['Show Map']== NULL?'Show Map':$LANG['Show Map'] ;?></a>
										</p>
                                        <p><span><?php if(!empty($HotelImageData[0]['p']['property_description'])){ echo substr(html_entity_decode($HotelImageData[0]['p']['property_description']),0,220);}?> </span>
										<a href="<?php echo base_url().'hotel-details/'.$ean_hotel_id.'/'.str_replace(" ","-",mb_strtolower($City_All_Hotel_Data['name'], 'UTF-8'));?>"><?=$LANG['More']== NULL?'More':$LANG['More']?></a> &nbsp;&raquo;</p>
                                   	<!--<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="<?php echo base_url(); ?>images/icon_02.png" alt="" /></div>-->
										<?php if(getBookingTime($ean_hotel_id)!=""){ ?>
										<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>:  <?php 
										echo getBookingTime($ean_hotel_id); ?> ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
										<?php } ?>									
                                        <?php 
										$this->load->model('RoomTypeList_model');
										$s_where = " WHERE n.ean_hotel_id = ".$ean_hotel_id;
							   			$room_data = $this->RoomTypeList_model->fetch_multi($s_where); 
											//print_r($room_data); echo $City_All_Hotel_Data['ean_hotel_id'];
										if(count($room_data) > 0) { ?>
                                        <div class="listing">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <thead>
                                          <tr>
                                            <th align="left"><?php echo $LANG['Available Room Types']== NULL?'Available Room Types':$LANG['Available Room Types'] ;?></th>
                                            <th><?php echo $LANG['Persons']== NULL?'Persons':$LANG['Persons'] ;?></th>
                                            <th><?php echo $LANG['Available']== NULL?'Available':$LANG['Available'] ;?></th>
                                            <th align="right"><?php echo $LANG['Rate for']== NULL?'Rate for':$LANG['Rate for'] ;?> <?php //echo $fullDays_diff; ?> <?php echo $LANG['nights']== NULL?'nights':$LANG['nights'] ;?></th>
                                          </tr>
                                          </thead>
                                          <tbody>
										  <?php $cnt_room_type = 1; foreach($room_data as $room_data_Val) { if($cnt_room_type == 4) { break; }  ?>
                                          <tr>
                                            <td><a href="javascript:void(0);"><?php echo $room_data_Val['room_type_name']; ?></a></td>
                                            <td align="center"><img src="<?php echo base_url(); ?>images/icon_22.png" alt="" /></td>
                                            <td align="center"><span class="blue"><?php echo $LANG['Available']== NULL?'Available':$LANG['Available'] ;?></span></td>
                                            <td align="right"><span class="blue">INR 26000</span></td>
                                          </tr>
										  <?php $cnt_room_type++; } ?>                                          
                                          </tbody>
                                        </table> 
                                        </div>
										<?php } ?>
                                        <?php if(count($room_data) > 3) { ?>
                                        <div class="more_link">
                                        <a href="<?php echo base_url().'hotel-details/'.$City_All_Hotel_Data['ean_hotel_id'].'/'.str_replace(" ","-",mb_strtolower(html_entity_decode('details'), 'UTF-8'));?>"><?php echo (count($room_data) - 3);?><?=$LANG['More Room Types']== NULL?'More Room Types':$LANG['More Room Types']?></a>
                                        <img src="<?php echo base_url(); ?>images/arrow.png" alt="" /></div><?php } ?>
                                   </div>
                              </div>
                              <?php } } ?>
                              
                              
                         	<div class="clr"></div>
                            <div><ul class="pagination"><?php echo $pagination;?></ul></div>
                             <?php /*?> <?php if($paginator->numbers()!="") { ?>
							  <div class="paging top_margin" style="font-size:12px;"><span style="float:left; width:30%; padding-left:15px;"><?php echo $paginator->prev('<< '.__('Previous', true), array('url' => $paginator->params['pass']), null, array('class'=>'disabled','style'=>'float:left; font-size:12px;')); ?></span><span style="float:left; width:40%; text-align:center;"><?php echo $paginator->counter(array( 
'format' => __('Page %page% of %pages%', true)
)); ?></span><span style="float:right; width:10%;"><?php echo $paginator->next(__('Next', true).' >>', array('url' => $paginator->params['pass']), null, array('class'=>'disabled','style'=>'float:right; font-size:12px;'));?></span>
                                   	<div class="clr"></div>
							   </div>
							 <?php } ?><?php */?>
                         </div>
                    </div>
               <!--RIGHT PANEL END-->
               <div class="clr"></div>
               </div>
<!-- GOOGLE MAP FOR A PARTICULER HOTEL START -->               
<div id="google_big_map_for_hotel" class="signin_box" style="display: none; position:absolute; width:80%; height:80%;">
     <div class="close_btn"><a href="javascript:void(0)" onclick="hide_dialog()"><img src="images/close_btn.png" alt="" /></a></div>
     <h3 id="hotel_details_map"></h3>
    <div class="inner_box" id="map_canvas_big" style="position:fixed; height:90%; width:99%; margin-top:10px; border:2px solid #0275DD;"></div>                                          
</div>
<script language="javascript">
function show_map (id, lat, lang, name)
{
    $('#hotel_details_map').html(name);
    if(!dialog) dialog = null;
    dialog = new ModalDialog ("#"+id);
    dialog.show();    
    googleMapBig(lat, lang, 16);
}  
</script> 