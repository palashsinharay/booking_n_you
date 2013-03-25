<?php 
//date_default_timezone_set('Europe/London');
$check_in_date_exp = explode("-",$search_checkin_date);
$check_in_date = mktime(0,0,0,$check_in_date_exp[0],$check_in_date_exp[1],$check_in_date_exp[2]);

$checkout_date_exp = explode("-",$search_checkout_date);
$checkout_date = mktime(0,0,0,$checkout_date_exp[0],$checkout_date_exp[1],$checkout_date_exp[2]);

$dateDiff = $checkout_date - $check_in_date;
$fullDays_diff = floor($dateDiff/(60*60*24));

$start_date = date('m-d-Y');
$end_date = date('m-d-Y', strtotime(date('Y-m-d').' +1 Weekday'));

$rooms 		 = $session->userdata('rooms');
$room_adults = $session->userdata('room_adults');
$room_childs = $session->userdata('room_childs');
?>
<script language="javascript">

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
</script>
<script type="text/javascript" charset="utf-8">
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
	
$( function() {
	$('.room_info_').hide();
});

function toggle_display_room_details(hotel_id) {
	if($('.room_info_'+hotel_id).css('display')=='none') {
		$('.room_info_'+hotel_id).show();
		$('#img_more_'+hotel_id).attr('src', '<?php echo base_url(); ?>images/arrow4.png');
	}
	else {
		$('.room_info_'+hotel_id).hide();
		$('#img_more_'+hotel_id).attr('src', '<?php echo base_url(); ?>images/arrow.png');
	}
}

</script> 
		
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
<?php 
/*$search = $this->here;
echo $search_result = stristr($search, 'city');
*/?>
     <!--CONTENT SECTION START-->
     	<div id="content">
		<div class="page_nav">
               	<p><?php echo $LANG['You are here']== NULL?'You are here':$LANG['You are here'] ;?>:&nbsp;&nbsp;<a href="<?php echo base_url(); ?>"><?php echo $LANG['Home']== NULL?'Home':$LANG['Home'] ;?></a> <!--<span>[17 hotels]</span>--> </p>
               </div>
          	<!--LEFT PANEL START-->
               	<div class="left_panel_02">
					<?php echo form_open_multipart('hotelsummaries/search_result',array("id"=>"search_result_form"));?>
                    <!--HOTEL SEARCH START-->
                    	<div class="hetel_search">
                             <h3 style="font-size:17px;"><img src="<?php echo base_url(); ?>images/i_glass.png" alt="" /> <?php echo $LANG['Search Hotels']== NULL?'Search Hotels':$LANG['Search Hotels'] ;?></h3>
                             <p><?php echo $LANG['Where']== NULL?'Where':$LANG['Where'] ;?> ?</p>
                             <?php
							 $Location = "";
							 if($search_city != "") { if($Location == "") { $Location = $search_city; } else { $Location = $Location.",".$search_city; } }
							 if($search_state != "") { if($Location == "") { $Location = $search_state; } else { $Location = $Location.",".$search_state; } }
							 if($search_country != "") { if($Location == "") { $Location = $search_country; } else { $Location = $Location.",".$search_country; } }
							 $Location = str_ireplace("%20"," ",$Location);
							//echo $Location; die();
							 ?>
							 
                             <input type="text" name="txt_location" id="txt_location" onkeyup="get_location_name(this.value)" value="<?php echo $Location;?>"  autocomplete="off" />
                            <input type="hidden" name="location_id" id="location_id"  />
                            <div id="suggestionsSearch" class="suggestionsBox2" style="display:none;">
                            <div class="arrow_autocom" style="height:2px;">&nbsp;</div>
                            <!--<div class="suggestionList" id="autoSuggestionsListSearch" style="height:130px; overflow:auto;">&nbsp;</div>-->
                            <div class="suggestionList" id="autoSuggestionsListSearch">&nbsp;</div>
                            </div>
                           
                              <div class="clr"></div>
                              <p class="top_margin10"><?php echo $LANG['Check-In Date']== NULL?'Check-In Date':$LANG['Check-In Date'] ;?></p>
                              <div class="select_box" style="width:130px;">
								<input type="text" style="width: 88px;" class="date-pick dp-applied" id="start-date" name="start-date" value="<?php echo $search_checkin_date; ?>" readonly="readonly">
                               </div>
                                <div class="select_box"></div>                                   
                               <div class="clr"></div>
                               <p class="top_margin10"><?php echo $LANG['Check-Out Date']== NULL?'Check-Out Date':$LANG['Check-Out Date'] ;?></p>
                              <div class="select_box" style="width:130px;">
                              <input type="text" style="width: 88px;" class="date-pick dp-applied" id="end-date" name="end-date" value="<?php echo $search_checkout_date; ?>" readonly="readonly">
                               </div>
                                <div class="select_box"></div>                                   
                                <div class="clr"></div>
                               
                                 <p class="margin_10_tb"><span style="padding-left:2px;"><?php echo $LANG['Rooms']== NULL?'Rooms':$LANG['Rooms'] ;?></span><span style="margin-left:5px; padding-left:15px;"> <?php echo $LANG['Adults']== NULL?'Adults':$LANG['Adults'] ;?></span><span style="margin-left:20px; padding-left:13px;"><?php echo $LANG['Children']== NULL?'Children':$LANG['Children'] ;?></span></p>
                                 <div class="clr"></div>
                                <p>
                                  <select name="rooms2[]" id="rooms2" style="width:50px; float:left;background: #FFFFFF;">
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
                                    
                                  
                                     </p>
                                 <!--<h6>Room-2 <span>1 Adults</span> <span>0 Children</span></h6>
                                 <h6><a href="javascript:void(0);"  onclick="show_div()">Change Selection</a></h6> 
                                 <h6><a href="javascript:void(0);">Clear Selection</a></h6>--> 
                              <div class="clr"></div>
                               <p class="top_margin"><input type="checkbox" name="sp_dates" id="sp_dates"  /> <?php echo $LANG["I don't have specific dates yet"]== NULL?"I don't have specific dates yet":$LANG["I don't have specific dates yet"] ;?></p> 
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
                               	<h5><a href="javascript:void(0);" onclick="hide_div()"><?php echo $LANG['Close']== NULL?'Close':$LANG['Close'] ;?></a></h5>
                                   <div class="pop_heading"><?php echo $LANG['Rooms']== NULL?'Rooms':$LANG['Rooms'] ;?></div>
                                   <div class="pop_heading"><?php echo $LANG['Adults']== NULL?'Adults':$LANG['Adults'] ;?></div>
                                   <div class="pop_heading"><?php echo $LANG['Children']== NULL?'Children':$LANG['Children'] ;?></div>
                                   <div class="clr"></div>
                                   <div class="pop_row">
                                   	<div class="pop_cell">Room1</div>
                                    
                                    <div class="pop_cell">
                                        	<select name="rooms2" id="rooms2"  style="width:50px; background: #FFFFFF;line-height: 16px;" >
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
						 <script type="text/javascript">
                                        $(document).ready(function(arg) {
                                                  //$("body select").msDropDown(
                                              $("#rooms2").msDropDown();
                                              $("#rooms2").hide();
/*                                              $('#rooms2_msdd').css("background-image", "url(<?php echo base_url(); ?>images/select_bg3.png)");
                                              $('#rooms2_msdd').css("background-repeat", "no-repeat");
									          $('#rooms2_msdd').css("background-position", "right");
                                              $('#rooms2_msdd').css("height", "24px"); 
                                              $('#rooms2_msdd').css("line-height", "22px");	 */
                                              
                                        })
                                   </script>
                                        </div>
                                    
                                        <div class="pop_cell">
                                        	<select name="adult2" id="adult2"  style="width:50px; background: #FFFFFF;line-height: 16px;" style="width:50px; background: #FFFFFF;line-height: 16px;">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
						 <script type="text/javascript">
                                        $(document).ready(function(arg) {
                                                  //$("body select").msDropDown(
                                              $("#adult2").msDropDown();
                                              $("#adult2").hide();
/*                                              $('#adult2_msdd').css("background-image", "url(<?php echo base_url(); ?>images/select_bg3.png)");
                                              $('#adult2_msdd').css("background-repeat", "no-repeat");
									          $('#adult2_msdd').css("background-position", "right");
                                              $('#adult2_msdd').css("height", "24px"); 
                                              $('#adult2_msdd').css("line-height", "22px");	*/ 
                                              
                                        })
                                   </script>
                                        </div>
                                        <div class="pop_cell">
                                        <select name="child2" id="child2"  style="width:50px; background: #FFFFFF;line-height: 16px;" >
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
						 <script type="text/javascript">
                                        $(document).ready(function(arg) {
                                                  //$("body select").msDropDown(
                                              $("#child2").msDropDown();
                                              $("#child2").hide();
/*                                              $('#child2_msdd').css("background-image", "url(<?php echo base_url(); ?>images/select_bg3.png)");
                                              $('#child2_msdd').css("background-repeat", "no-repeat");
									          $('#child2_msdd').css("background-position", "right");
                                              $('#child2_msdd').css("height", "24px"); 
                                              $('#child2_msdd').css("line-height", "22px");	*/ 
                                              
                                        })
                                   </script>
                                        </div>
                                        <div class="pop_cell2"><a href="javascript:void(0);"><?php echo $LANG['Remove']== NULL?'Remove':$LANG['Remove'] ;?></a></div>
                                   </div>
                                   <div class="clr"></div>
                                   <p class="top_margin10"><a href="javascript:void(0);">+<?php echo $LANG['Add another room']== NULL?'Add another room':$LANG['Add another room'] ;?></a></p>
                                   <input type="submit" value="Change" class="button_01 top_margin10 right" />
                                   <div class="clr"></div>
                               </div> 
                         </div>
                   <!--HOTEL SEARCH END-->
                  <!--FILTER START-->       
                        <div class="blue_box filter">
                        		<h3><?php echo $LANG['Filter By']== NULL?'Filter By':$LANG['Filter By'] ;?></h3>
                        		<?php if(isset($all_search_pricerange_lists) && count($all_search_pricerange_lists) > 0) { ?>
								<h4><?php echo $LANG['Price Range']== NULL?'Price Range':$LANG['Price Range'] ;?> <span>(<?php echo $LANG['per night']== NULL?'per night':$LANG['per night'] ;?>)</span> <img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<?php foreach($all_search_pricerange_lists as $search_pricerange_lists) {  ?>
								<tr>
								  <td width="17"><input type="checkbox" name="pricerange" id="pricerange_<?php echo $search_pricerange_lists["minPrice"]."-".$search_pricerange_lists["maxPrice"]; ?>" value="<?php echo $search_pricerange_lists["minPrice"]."-".$search_pricerange_lists["maxPrice"]; ?>" onclick="send_url(this.form);" /></td>
								  <td><?php echo $session->userdata('Currency_code'); ?> <?php echo $search_pricerange_lists["minPrice"]; ?> - <?php echo $session->userdata('Currency_code'); ?> <?php if($search_pricerange_lists["maxPrice"] == 0) { echo "+"; } else { echo $search_pricerange_lists["maxPrice"]; } ?></td>
								</tr>
								<?php } ?>
							  </table>
							<?php } if(isset($property_list_starrate) && count($property_list_starrate) > 0) { ?>	  
							<h4><?php echo $LANG['Star Rating']== NULL?'Star Rating':$LANG['Star Rating'] ;?><img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <?php foreach($property_list_starrate as $property_list_starrate_all) { 
							  ?>
                                <tr>
                                  <td width="17"><input type="checkbox" name="starrate" id="starrate_<?php echo $property_list_starrate_all['star_rating']; ?>" value="<?php echo intval($property_list_starrate_all['star_rating']); ?>" onclick="send_url(this.form);" /></td>
                                  <td><?php echo intval($property_list_starrate_all['star_rating']); ?> <?php echo $LANG['Stars']== NULL?'Stars':$LANG['Stars'] ;?></td>
                                  <td align="right"><span>8 <?php echo $LANG['Hotels']== NULL?'Hotels':$LANG['Hotels'] ;?></span></td>
                                </tr>
								<?php } ?>                                
                              </table>
							  <?php } if(isset($property_type_list) && count($property_type_list) > 0) { ?>
                              <h4><?php echo $LANG['Hotel Type']== NULL?'Hotel Type':$LANG['Hotel Type'] ;?> <img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <?php foreach($property_type_list as $property_type_list_all) {  ?>
								<tr>
                                  <td width="17"><input type="checkbox" name="propertytype" id="propertytype_<?php echo $property_type_list_all['property_category']; ?>" value="<?php echo $property_type_list_all['property_category']; ?>" onclick="send_url(this.form);" /></td>
                                  <td><?php echo $property_type_list_all['property_category_desc']; ?></td>
                                  <td align="right"><span>17 <?php echo $LANG['Hotels']== NULL?'Hotels':$LANG['Hotels'] ;?></span></td>
                                </tr>
								<?php }  ?>
                              </table>
							  <?php } if(isset($property_attribute_link) && count($property_attribute_link) > 0) { ?>
                              <h4><?php echo $LANG['Facilities']== NULL?'Facilities':$LANG['Facilities'] ;?> <img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <?php foreach($property_attribute_link as $property_attribute_link_all) { ?>
								<tr>
                                  <td width="17"><input type="checkbox" name="amenity" id="amenity_<?php echo $property_attribute_link_all['attribute_id']; ?>" value="<?php echo $property_attribute_link_all['attribute_id']; ?>" onclick="send_url(this.form);" /></td>
                                  <td width="130"><?php echo $property_attribute_link_all['attribute_desc']; ?></td>
                                  <td align="right"><span>16 <?php echo $LANG['Hotels']== NULL?'Hotels':$LANG['Hotels'] ;?></span></td>
                                </tr>
								<?php } ?>                                
                              </table>
							  <?php } ?>
                               <h4><?php echo $LANG['Hotel Theme']== NULL?'Hotel Theme':$LANG['Hotel Theme'] ;?> <img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="17"><input type="checkbox" /></td>
                                  <td>City Trip</td>
                                  <td align="right"><span>1 <?php echo $LANG['Hotels']== NULL?'Hotels':$LANG['Hotels'] ;?></span></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" /></td>
                                  <td>Business</td>
                                  <td align="right"><span>2 <?php echo $LANG['Hotels']== NULL?'Hotels':$LANG['Hotels'] ;?></span></td>
                                </tr>
                              </table>
							  <?php if(isset($property_list_chaincode) && count($property_list_chaincode) > 0) { ?>
                              <h4><?php echo $LANG['Chain']== NULL?'Chain':$LANG['Chain'] ;?> <img src="<?php echo base_url(); ?>images/arrow_dn.png" alt="" /></h4>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <?php foreach($property_list_chaincode as $property_list_chaincode_all) {  ?>
								<tr>
                                  <td width="17"><input type="checkbox" name="chaincode" id="chaincode_<?php echo $property_list_chaincode_all['chain_code_id']; ?>" value="<?php echo $property_list_chaincode_all['chain_code_id']; ?>" onclick="send_url(this.form);" /></td>
                                  <td><?php echo $property_list_chaincode_all['chain_name']; ?></td>
                                  <td align="right"><span>1 <?php echo $LANG['Hotels']== NULL?'Hotels':$LANG['Hotels'] ;?></span></td>
                                </tr>
								<?php }  ?>                                
                              </table>
							  <?php } ?>
                        </div> 
                  <?php echo form_close();?>
                  <!--FILTER END-->  
                  
                  <!--MAP START-->
                      <div class="blue_box filter">
                      <h3><?php echo $LANG['Map']== NULL?'Map':$LANG['Map']; ?></h3>
                      <div class="inner_box" id="map_canvas" style="height:210px;width:222px;"></div>
                         <?php
                           $latLang = getResignLatitudeLongitude($Location);
                           $latitude = $latLang[0];
                           $longitude = $latLang[1];
                         ?>
						 <script language="javascript">
                            googleMap('<?php echo $latitude; ?>', '<?php echo $longitude; ?>', 10);
						</script>
                         <div class="more_link"><a href="javascript:void(0);">Show Map <img src="<?php echo base_url(); ?>images/arrow.png" alt="" /></a></div>
                      </div> 
                 <!--MAP END-->
                 <!--IN AND AROUND-->
<?php  if($monument!=NULL || $stadium!=NULL || $airport!=NULL){ ?>
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
                        	<h3><?php echo $LANG['My Viewed Hotels']== NULL?'My Viewed Hotels':$LANG['My Viewed Hotels'] ;?></h3>
                         <div class="inner_box">
						 <?php foreach($User_View_cookie_data as $My_Viewed_Val) { ?>
						 
                         	<div class="viewed_row">
                              	<div class="img_box">
								<?php 
                                if(!empty($My_Viewed_Val['h']['thumbnail_url'])){
                                echo site_url( img($My_Viewed_Val['h']['thumbnail_url'], array("width"=>40,"height"=>40,"border"=>"0")), array("controller" =>"hotelsummaries", "action" => "hotel_info_details", "id" => $My_Viewed_Val['a']['ean_hotel_id'], 'title' => str_replace(" ","-",mb_strtolower($My_Viewed_Val['a']['name'], 'UTF-8')),'ext' => 'html'), array(), '', false); 
                                }else{ echo site_url( img("../images/no_image_thumb.jpg", array("width"=>40,"height"=>40,"border"=>"0")), array("controller" =>"hotelsummaries", "action" => "hotel_info_details", "id" => $My_Viewed_Val['a']['ean_hotel_id'], 'title' => str_replace(" ","-",mb_strtolower($My_Viewed_Val['a']['name'], 'UTF-8')),'ext'=>'html'), array(), '', false); ?><?php } ?>
								
								</div>
                                   <div class="text_box">
                                   	<?php echo site_url( img("../images/icon_03.png", array("alt" =>"delete", "title" => "delete", "class" => "close_btn","border"=>"0")), array("controller" =>"hotelsummaries", "action" => "delete_user_viewed_hotel", $My_Viewed_Val['a']['ean_hotel_id']), array(), sprintf(__('Are you sure you want to delete the hotel from your viewlist?',true), ''), false); ?>
									<!--<a class="close_btn" href="javascript:void(0);"><img  src="<?php echo base_url(); ?>images/icon_03.png" alt="" /></a>-->
                                        <h5><?php echo site_url($My_Viewed_Val['a']['name'], array('controller' => 'hotelsummaries', 'action' => 'hotel_info_details',  'title' => str_replace(" ","-",mb_strtolower($My_Viewed_Val['a']['name'], 'UTF-8')),'ext'=>'html','id'=>$My_Viewed_Val['a']['ean_hotel_id'])); ?></h5>
                                        <div><img src="<?php echo base_url(); ?>images/<?php echo str_replace(".","",$My_Viewed_Val['a']['star_rating'])?>_stars.png" alt="" /></div>
                                   	<p>
									<?php if($My_Viewed_Val['a']['address1'] != ""){ echo $My_Viewed_Val['a']['address1']; } ?><?php if($My_Viewed_Val['a']['city'] != "") { echo ", ".$My_Viewed_Val['a']['city']; } ?><?php if($My_Viewed_Val['a']['country'] != "") { echo ", ".$My_Viewed_Val['c']['countryname'];} ?><?php if($My_Viewed_Val['a']['postal_code'] != "") { echo ", ".$My_Viewed_Val['a']['postal_code']; }?>
									<br /><a href="javascript:void(0);"><em><?php echo $LANG['Show Map']== NULL?'Show Map':$LANG['Show Map'] ;?></em></a></p>
                                        <div class="review"><?php echo getReviewRating($My_Viewed_Val['a']['ean_hotel_id']); ?></div>
                                        <!--<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="<?php echo base_url(); ?>images/icon_02.png" alt="" /></div>-->
										
										<?php if(getBookingTime($My_Viewed_Val['a']['ean_hotel_id'])!=""){ ?>
										<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>:  <?php 
										echo getBookingTime($My_Viewed_Val['a']['ean_hotel_id']); ?> ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
										<?php } ?>										
                                   </div>
                                   <div class="clr"></div>
                              </div>
							<?php } ?>
                              <div class="delete_all"><a href="javascript:void(0);">Delete All <img alt="" src="<?php echo base_url(); ?>images/icon_03.png"></a></div>
                         </div>
                      </div>
                      <?php } ?>
                    </div>
               <!--LEFT PANEL END-->

               <!--RIGHT PANEL START-->
               	<div class="right_panel_02">
                    	<div class="hotel_cont">
                         	<div class="heading">
                              	<div class="left_part"><h2><?php echo count($session->userdata('Search_Api_Hotel_Ids')); ?> <?php echo $LANG['Hotels found in']== NULL?'Hotels found in':$LANG['Hotels found in'] ;?> <?php echo $search_city; ?></h2></div>
                                   <!--<div class="right_part"><img src="<?php echo base_url(); ?>images/map4.jpg" alt="" /> <a href="javascript:void(0);"><?php echo $LANG['Show Map']== NULL?'Show Map':$LANG['Show Map'] ;?></a></div>-->
                              </div>
                              <div class="clr"></div>
                              <div class="shorting_bar">
                              	<div class="left_cell"><?php echo $LANG['Sort By']== NULL?'Sort By':$LANG['Sort By'] ;?>:</div>
                                   <div class="right_cell">
                                   	<ul>                                    
                                        	<!--<li class="<?php echo $search_sortby == 0?'select':'' ;?>" ><a href="javascript:send_url('0');"><?php echo $LANG['Recently Booked']== NULL?'Recently Booked':$LANG['Recently Booked'] ;?></a></li>-->
                                             <li class="<?php echo $search_sortby == 4?'select':'' ;?>" ><a href="javascript:send_url('4');"><?php echo $LANG['Stars']== NULL?'Stars':$LANG['Stars'] ;?></a></li>
                                             <li class="<?php echo $search_sortby == 1?'select':'' ;?>" ><a href="javascript:send_url('1');"><?php echo $LANG['Distance']== NULL?'Distance':$LANG['Distance'] ;?></a></li>
                                             <li class="<?php echo $search_sortby == 7?'select':'' ;?>" ><a href="javascript:send_url('7');"><?php echo $LANG['Proximity']== NULL?'Proximity':$LANG['Proximity'] ;?></a></li>
                                             <li class="<?php echo $search_sortby == 2?'select':'' ;?>" ><a href="javascript:send_url('2');"><?php echo $LANG['Most Popular']== NULL?'Most Popular':$LANG['Most Popular'] ;?></a></li>
                                             <li class="<?php echo $search_sortby == 3?'select':'' ;?>" ><a href="javascript:send_url('3');"><?php echo $LANG['Price']== NULL?'Price':$LANG['Price'] ;?> </a></li>
                                             <li class="<?php echo $search_sortby == 5?'select':'' ;?>" ><a href="javascript:send_url('5');">A-Z</a></li>
                                        </ul>
                                   </div>
                              </div>
                              <div class="clr"></div>
							  <?php if($hotel_lists != "") { foreach($hotel_lists->HotelSummary as $all_hotels) { ?>
							  <?php $hotel_id = @$all_hotels->hotelId; 
								  $name = @$all_hotels->name;
								  $address1 = @$all_hotels->address1;
								  $city = @$all_hotels->city;
								  $postalCode = @$all_hotels->postalCode;
								  $countryCode = @$all_hotels->countryCode;
								  $airportCode = @$all_hotels->airportCode;
								  $propertyCategory = @$all_hotels->propertyCategory;
								  $hotelRating = @$all_hotels->hotelRating;
								  $confidenceRating = @$all_hotels->confidenceRating;
								  $amenityMask = @$all_hotels->amenityMask;
								  $locationDescription = @$all_hotels->locationDescription;
								  $shortDescription = @$all_hotels->shortDescription;
								  $highRate = @$all_hotels->highRate;
								  $lowRate = @$all_hotels->lowRate;
								  $rateCurrencyCode = @$all_hotels->rateCurrencyCode;
								  $latitude = @$all_hotels->latitude;
								  $longitude = @$all_hotels->longitude;
								  $proximityDistance = @$all_hotels->proximityDistance;
								  $proximityUnit = @$all_hotels->proximityUnit;
								  $hotelInDestination = @$all_hotels->hotelInDestination;
								  $thumbNailUrl = "http://images.travelnow.com".@$all_hotels->thumbNailUrl;
								  $deepLink = @$all_hotels->deepLink;
								  
								  $room_details = @$all_hotels->RoomRateDetailsList->RoomRateDetails;
								  
								  //print_r($room_details);
							  ?>
							  <div class="hotel_info">
                              	<div class="img_box"><?php if($thumbNailUrl) { ?><a href="<?php echo base_url().'hotel-details/'.$hotel_id.'/'.str_replace(" ","-",mb_strtolower($name, 'UTF-8'));?>"><img src="<?php echo $thumbNailUrl;?>" border="0" title="" /><?php } else { ?><img src="images/no_image_thumb.jpg" border="0" title="" /><?php } ?></a></div>
                                   <div class="text_box">
                                   	<!--<div class="review_tag"><h3>Good, 8.0</h3> <span>Score from 15 reviews</span></div>-->
                                    <div class="review_tag"><?php echo getReviewRatingSearchResult($hotel_id); ?></div>
                                        <h3> <a href="<?php echo base_url().'hotel-details/'.$hotel_id.'/'.str_replace(" ","-",mb_strtolower($name, 'UTF-8'));?>"><?php echo $name;?></a>
                                        
                                        <img src="<?php echo base_url(); ?>images/<?php echo str_replace(".","",$hotelRating)?>_stars.png" alt="" /></h3>
                                        <p><?php echo $address1; ?> <?php echo $postalCode; ?>, <?php echo $city; ?>, <?php //echo $all_country_lists[$countryCode]; ?> 
                                        <a href="javascript:void(0)" onclick="show_map('google_big_map_for_hotel', '<?php echo $latitude; ?>', '<?php echo $longitude; ?>', '<?php echo $name; ?>')"><?php echo $LANG['Show Map']== NULL?'Show Map':$LANG['Show Map'] ;?></a>
										
                                        <p><span><?php if($shortDescription != "") { echo substr(strip_tags(html_entity_decode($shortDescription)),0,220); } ?> </span><a href="<?php echo base_url().'hotel-details/'.$hotel_id.'/'.str_replace(" ","-",mb_strtolower($name, 'UTF-8'));?>"><?php echo $LANG['More']== NULL?'More':$LANG['More'] ;?></a>&nbsp;&raquo;</p>
                                   	<!--<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>: 3 minutes ago <img src="<?php echo base_url(); ?>images/icon_02.png" alt="" /></div>-->									
										
										<?php if(getBookingTime($hotel_id)!=""){ ?>
										<div class="booking"><?php echo $LANG['Latest booking']== NULL?'Latest booking':$LANG['Latest booking'] ;?>:  <?php 
										echo getBookingTime($hotel_id); ?> ago <img src="<?php echo base_url()?>images/icon_02.png" alt="" /></div>
										<?php } ?>
																		
										<?php 
										//$room_data = $this->requestAction('hotelsummaries/api_room_type_data/'.$hotel_id);
										//	print_r($room_data); 
										//if(count($room_data) > 0) { 
										if(is_array($room_details) && count($room_details) > 0) { 
										?>
                                        <div class="listing">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <thead>
                                          <tr>
                                            <th align="left"><?php echo $LANG['Available Room Types']== NULL?'Available Room Types':$LANG['Available Room Types'] ;?></th>
                                            <th><?php echo $LANG['Persons']== NULL?'Persons':$LANG['Persons'] ;?></th>
                                            <th><?php echo $LANG['Available']== NULL?'Available':$LANG['Available'] ;?></th>
                                            <th align="right"><?php echo $LANG['Rate for']== NULL?'Rate for':$LANG['Rate for'] ;?> <?php echo $fullDays_diff; ?> <?php echo $LANG['nights']== NULL?'nights':$LANG['nights'] ;?></th>
                                          </tr>
                                          </thead>
                                          <tbody>
										  <?php
										  	$cnt_room_type = 1;
											//foreach($room_data as $room_data_Key => $room_data_Val) {
											foreach($room_details as $room_detail) :
												/*if($cnt_room_type == 4) {
													break;
												}*/
												
												$to_Cur = $session->userdata  ('Currency_code');
												$from_Currency = $room_detail->RateInfo->ChargeableRateInfo->{'@currencyCode'};
												$total = $room_detail->RateInfo->ChargeableRateInfo->{'@total'};
												if($to_Cur == 'default'){
													$to_Currency = $from_Currency;
												}else{
													$to_Currency = $to_Cur;
												}
										?>
                                          <tr class="<?php echo ($cnt_room_type>3)?'room_info_'.$hotel_id:'';?>" <?php echo ($cnt_room_type>3)?'style="display:none;"':'';?>>
                                            <td>
											<a href="<?php echo base_url().'hotel-details/'.$hotel_id.'/'.str_replace(" ","-",mb_strtolower($name, 'UTF-8'))?>"><?php echo @$room_detail->roomDescription; ?></a>
											</td>
                                            <td align="center"><?php //echo $commonview->display_head($room_detail->maxRoomOccupancy) ; ?></td>
                                            <td align="center"><span class="blue"><?php echo $LANG['Available']== NULL?'Available':$LANG['Available'] ;?></span></td>
                                            <td align="right"><span class="blue"><?php echo getCurrencySymbol($to_Currency).' '.$total; //echo $session->read('Currency_code').' '.$room_detail->RateInfo->ChargeableRateInfo->{'@total'};?></span></td>
                                          </tr>
										  <?php
										  		$cnt_room_type++;
											//} 
											endforeach;
										?>                                     
                                          </tbody>
                                        </table> 
                                        </div>
										<?php } ?>
                                        <?php if(count($room_details) > 3) { ?><div class="more_link"><a href="javascript:void(0);" onclick="toggle_display_room_details('<?php echo $hotel_id;?>');"><?php echo (count($room_details) - 3).' More Room Types'; ?> <img id="img_more_<?php echo $hotel_id;?>" src="<?php echo base_url(); ?>images/arrow.png" alt="" /></a></div><?php } ?>
                                   </div>
                              </div>
                              
                              <?php } } ?> 
                         	<div class="clr"></div>                        
                              
							
							<div class="paging top_margin">
                                   	<!--<a class="left" href="javascript:void(0);"><img src="<?php echo base_url(); ?>images/arrow4.png" alt="" /> <?php echo $LANG['Previous']== NULL?'Previous':$LANG['Previous'] ;?></a> <a class="right" href="javascript:void(0);"><?php echo $LANG['Next']== NULL?'Next':$LANG['Next'] ;?><img src="<?php echo base_url(); ?>images/arrow.png" alt="" /></a>--><?php if(isset($pageLinks)){echo $pageLinks; }?>
                                   	<div class="clr"></div>
                                   </div>
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