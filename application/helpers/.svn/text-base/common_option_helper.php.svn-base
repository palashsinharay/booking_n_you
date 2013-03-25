<?php
/*********
* Author: Kafil Akhter
* Date  : 25th June 2012
* Purpose:
*  Custom Helpers 
* Includes all necessary files and common functions
* 
*/

/***
*Start of Currency dropdown
*/

function makeOptionCurrency($mix_where = '', $s_id = '')
{
    try
	{
		$CI = &get_instance();
		$cond = ' WHERE id !=0 order by id';
		$res = $CI->db->query("select id, currency_id, currency_details from {$CI->db->CURRENCIES} {$cond}");	
		$mix_value = $res->result_array();
		$s_option = '';
		if($mix_value)
		{
			foreach ($mix_value as $val)
			{
				$s_select = '';
				if($val["id"] == $s_id)
					$s_select = " selected ";
					
				$s_option .= "<option $s_select value='".$val["id"]."' >".$val["currency_id"]." ".$val["currency_details"]."</option>";
			}
		}

		unset($res, $mix_value, $s_select, $mix_where, $s_id);
		return $s_option;
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}
/***
*End Currency dropdown
*/

/***
*Start of Language dropdown
*/

function makeOptionLanguage($mix_where = '', $s_id = '')
{
    try
	{
		$CI = &get_instance();
		$cond = ' WHERE id !=0 order by id';
		$res = $CI->db->query("select id, lng_id, language from {$CI->db->LANGUAGES} {$cond}");	
		$mix_value = $res->result_array();
		$s_option = '';
		if($mix_value)
		{
			foreach ($mix_value as $val)
			{
				$s_select = '';
				if($val["lng_id"] == $s_id)
					$s_select = " selected ";
					
				$s_option .= "<option $s_select value='".$val["lng_id"]."' >".$val["language"]."</option>";
			}
		}

		unset($res, $mix_value, $s_select, $mix_where, $s_id);
		return $s_option;
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}
/***
*End Language dropdown
*/
/***
*Start of Language footer
*/

function makeOptionLanguageFooter()
{
    try
	{
		$CI = &get_instance();
		$cond = ' WHERE id !=0 order by id';
		$res = $CI->db->query("select id, lng_id, language from {$CI->db->LANGUAGES} {$cond}");	
		$mix_value = $res->result_array();
		$s_option = '';
		if($mix_value)
		{
			foreach ($mix_value as $val)
			{
					
				$s_option .= html_entity_decode($val["language"])." | ";
			}
		}

		unset($res, $mix_value, $s_select);
		return $s_option;
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}
/***
*End Language footer
*/



	function showMap($pre_select = "", $large_map = "0", $maps_url = "") {
	
	try{

	if ($large_map!="1") {
	
	$width = "418";
	$height = "265";
	$map_size = "";
	
	$coordinates = <<<END

<area id="continent_2" shape="poly" alt="North America" coords="85,116,89,106,79,98,83,94,100,100,112,100,105,93,99,87,92,80,111,61,136,53,131,31,137,20,147,35,170,23,186,8,192,2,151,1,109,3,81,8,63,16,35,15,13,26,1,41,22,40,38,36,40,51,34,66,46,94,68,107" nohref onMouseOver="update_map_mouseover('north_america');" onMouseOut="update_map_mouseout('north_america');"  />
<area id="continent_3" shape="poly" alt="South America" coords="123,213,103,203,99,169,96,155,84,140,82,124,89,106,109,107,125,117,138,129,150,135,144,148,141,162,132,168,123,183,116,194,119,205" nohref onMouseOver="update_map_mouseover('south_america');" onMouseOut="update_map_mouseout('south_america');"  />
<area id="continent_1" shape="poly" alt="Europe" coords="200,58,194,66,185,66,185,56,194,57,192,49,184,44,191,32,201,42,207,41,204,30,217,18,234,19,249,20,251,12,270,8,264,16,263,25,271,45,262,45,262,52,261,63,250,59,241,55,234,59,226,70,215,66" nohref onMouseOver="update_map_mouseover('europe')" onMouseOut="update_map_mouseout('europe')" />
<area id="continent_6" shape="poly" alt="Africa" coords="218,180,212,163,212,142,205,122,194,121,174,114,169,93,171,77,189,70,208,64,220,73,237,75,250,96,259,107,270,105,256,127,256,143,266,140,266,157,257,169,250,156,244,165,235,180" nohref onMouseOver="update_map_mouseover('africa')" onMouseOut="update_map_mouseout('africa')"  />
<area id="continent_5" shape="poly" alt="Australia" coords="377,193,371,180,358,182,345,180,348,158,363,147,375,140,377,135,376,123,393,123,410,129,425,144,443,144,440,159,421,164,418,156,413,143,405,144,398,150,403,166,403,175,414,182,426,178,433,188,422,195,413,200,402,201,401,195,406,189,397,180" nohref onMouseOver="update_map_mouseover('australia')" onMouseOut="update_map_mouseout('australia')"  />
<area id="continent_4" shape="poly" alt="Asia" coords="256,104,246,91,238,75,229,63,237,57,257,63,264,63,261,52,260,45,268,45,262,24,267,21,265,13,280,3,307,8,335,8,379,16,398,26,390,34,387,49,381,62,379,73,367,77,358,68,360,83,373,114,376,134,365,144,339,138,327,123,326,104,318,94,310,102,310,119,300,114,292,96,285,89,275,97" nohref onMouseOver="update_map_mouseover('asia')" onMouseOut="update_map_mouseout('asia')" />
END;
	
	} 
	
	$location_display['north_america'] = "none";
	$location_display['south_america'] = "none";
	$location_display['europe'] = "none";
	$location_display['asia'] = "none";
	$location_display['africa'] = "none";
	$location_display['australia'] = "none";
	
	$db_location = $pre_select;
	
	$location_script = "";
	$location_title = "";
	$locations = explode(",",$db_location);
	for ($i=0; $i<count($locations); $i++) {
		$location_display[$locations[$i]] = "block";
		$location_script = "world_map_visible[area] = \"$locations[$i]\";\n";
		$location_title .= ucwords($locations[$i]);
		if ($i<count($locations)+1) {
			$location_title .= ", ";
		}
	}
	$output = <<<END
<div style="position:relative;width:$height;height:$height;">
<img src="$maps_url/world_map_half_colour$map_size.gif" class="world_map" id="world_map_bg" width=$width height=$height style="z-index:1;display:block;" />
<img src="$maps_url/world_map_north_america$map_size.gif" class="world_map" id="world_map_north_america" width=$width height=$height style="z-index:3;display:$location_display[north_america]" />
<img src="$maps_url/world_map_south_america$map_size.gif" class="world_map" id="world_map_south_america" width=$width height=$height style="z-index:4;display:$location_display[south_america]" />
<img src="$maps_url/world_map_europe$map_size.gif" class="world_map" id="world_map_europe" width=$width height=$height style="z-index:6;display:$location_display[europe]" />
<img src="$maps_url/world_map_africa$map_size.gif" class="world_map" id="world_map_africa" width=$width height=$height style="z-index:7;display:$location_display[africa]" />
<img src="$maps_url/world_map_asia$map_size.gif" class="world_map" id="world_map_asia" width=$width height=$height style="z-index:8;display:$location_display[asia]" />
<img src="$maps_url/world_map_australia$map_size.gif" class="world_map" id="world_map_australia" width=$width height=$height style="z-index:9;display:$location_display[australia]" />
<img src="$maps_url/space.gif" class="world_map" id="world_map" usemap="#world_map_half_colour" width=$width height=$height style="border-style:none;z-index:99;display:block;" />
</div>
<map id="world_map_half_colour" name="world_map_half_colour">
$coordinates
<area shape="default" nohref="nohref" alt="" />
</map>
END;
	//echo $output; die();
	return $output;
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}



############# Change Language #############
function language_dropdown(){
	try{
		$CI = &get_instance();
		$sql = "SELECT bl.lng_id, bl.language, bl.lc_time_names, bc.country, bc.country_id FROM booking_languages bl, booking_countries bc WHERE bl.lc_time_names = bc.country_id AND bl.is_active = '0' ORDER BY bl.id ASC ";   
		$result = mysql_query($sql);    
		$dropdown  = '';
		while ($data = mysql_fetch_array($result)) {
			 $dropdown .= "<option ";  
			 if($CI->session->userdata('Language_code') == $data['lng_id'])  $dropdown .= "selected"; 
			  $dropdown .= " value=\"$data[lng_id]\" title=\"country_flag/flags_thumb/".str_replace(' ', '_', strtolower($data['country'])).".png\" >$data[language]</option>";
		} 
		return $dropdown; 
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}
############# Change Currency #############
function currency_dropdown(){
	try{
		$CI = &get_instance();
		$sql = "SELECT currency_id, currency_details, currency_symbol FROM booking_currencies WHERE is_active = '0'";   
		$result = mysql_query($sql);    
		$dropdown  = '';
		while ($data = mysql_fetch_array($result)) {
			 $dropdown .= "<option ";  
			 if($CI->session->userdata('Currency_code') == trim($data['currency_id'])) $dropdown .= "selected";
              $dropdown .= " value=\"$data[currency_id]\" >$data[currency_symbol] ";  
			  $dropdown .= " $data[currency_details]</option>";  
		} 
		return $dropdown; 
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}
/***
*Start of Language dropdown
*/

function makeOptionCountry($mix_where = '', $s_id = '')
{
    try
	{
		$CI = &get_instance();
		$cond = ' WHERE country_id !=0 order by country_id';
		$res = $CI->db->query("select country_id, country_name, country_code from {$CI->db->COUNTRY_LISTS} {$cond}");	
		$mix_value = $res->result_array();
		$s_option = '';
		if($mix_value)
		{
			foreach ($mix_value as $val)
			{
				$s_select = '';
				if($val["country_code"] == $s_id)
					$s_select = " selected ";
					
				$s_option .= "<option $s_select value='".$val["country_code"]."' >".$val["country_name"]."</option>";
			}
		}

		unset($res, $mix_value, $s_select, $mix_where, $s_id);
		return $s_option;
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}
/***
*End Language dropdown
*/
/***
*Start of Language footer
*/
function makeOptionLanguageFooter_new()
{
    try{
        $CI = &get_instance();
        $sql = "SELECT bl.lng_id, bl.language, bl.lc_time_names, bc.country, bc.country_id FROM booking_languages bl, booking_countries bc WHERE bl.lc_time_names = bc.country_id AND bl.is_active = '0' ORDER BY bl.id ASC ";   
        $result = mysql_query($sql);    
        $language_list  = '';
        while ($data = mysql_fetch_array($result)) {
             $language_list .= "<a href=\"javascript:void(0)\" onclick=\"selected_language('".$data['lng_id']."')\" ";  
             if($CI->session->userdata('Language_code') == $data['lng_id'])  $language_list .= " style=\"color:#057DD7;font-weight:bold;\" "; 
              $language_list .= " >$data[language]</a> | ";
        } 
        return substr($language_list, 0, -2); 
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }
}
/*Start of Language footer */
/**
* Return Latitude Longitude For a Resign START
*/
function getResignLatitudeLongitude($resign){
    try{
        $CI = &get_instance();
        $cond = " WHERE region_name LIKE '".$resign."%' LIMIT 0,1 ";
        $res = $CI->db->query("SELECT center_latitude, center_longitude FROM {$CI->db->REGION_CENTER_COORDINATES_LISTS} {$cond}");  
        $mix_value = $res->result_array();
        if($mix_value){
            $latitude = mysql_real_escape_string($mix_value[0]['center_latitude']);
            $longitude = mysql_real_escape_string($mix_value[0]['center_longitude']);
        }   
        if(empty($latitude)) $latitude = '';        
        if(empty($longitude)) $longitude = '';   
        $return_value = explode(",", $latitude.','.$longitude); 
        unset($cond, $res, $mix_value, $latitude, $longitude);
        return $return_value;
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }
        
}

/* Return Latitude Longitude For a Resign END */
/**
* Return Latitude Longitude For a Country START
*/
function getCountryLatitudeLongitude($country){
    try{
        $CI = &get_instance();
        $cond = " WHERE country_name LIKE '%".$country."' LIMIT 0,1 ";
        $res = $CI->db->query("SELECT avg_latitude, avg_longitude FROM {$CI->db->COUNTRY_LATITUDE_LONGITUDE} {$cond}");  
        $mix_value = $res->result_array();
        if($mix_value){
            $latitude = mysql_real_escape_string($mix_value[0]['avg_latitude']);
            $longitude = mysql_real_escape_string($mix_value[0]['avg_longitude']);
        }   
        if(empty($latitude)) $latitude = '';        
        if(empty($longitude)) $longitude = '';   
        $return_value = explode(",", $latitude.','.$longitude); 
        unset($cond, $res, $mix_value, $latitude, $longitude);
        return $return_value;
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }
        
}
/* Return Latitude Longitude For a Country END */
/**
* Return Review and Rating For a Hotel ID START
*/
function getReviewRating($hotel){
    try{
        $CI = &get_instance();
        $cond = " WHERE hotel_id = '".$hotel."' LIMIT 0,1 ";
        $res = $CI->db->query("SELECT COUNT(*) AS total_review, AVG( review_score ) AS avg_rating FROM {$CI->db->MY_REVIEW_DETAILS} {$cond}");
        $mix_value = $res->result_array();
        $return_value = '';
        if(($mix_value[0]['total_review'])>0){
            $return_value .= 'Score from&nbsp;';            
            //$return_value .= $CI->change_language_text->LANG['Score from']== NULL?'Score from':$CI->change_language_text->LANG['Score from'].' ';            
            $return_value .= $mix_value[0]['total_review']; 
            $return_value .= '&nbsp;reviews:&nbsp;';
            //$return_value .= $CI->change_language_text->LANG['reviews']== NULL?'reviews':$CI->change_language_text->LANG['reviews'].': ';
            $return_value .= getReviewLevel($mix_value[0]['avg_rating']);
            $return_value .= '&nbsp;'.$mix_value[0]['avg_rating']; 
            $return_value .= '&nbsp;<a href="'.base_url().'hotelsummaries/get_reviews/'.$hotel.'" class="cute-balloon" clase="gray" ><img src="images/icon_01.png" alt="" /></a>';            
        }else{
        $return_value = '';               
        }     

        unset($cond, $res, $mix_value);
        return $return_value;
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }
        
}
/* Return Review and Rating For a Hotel ID END */
/**
* Return Review LEVEL against score START
*/
function getReviewLevel($score){
    try{
        $CI = &get_instance();
        $level_conf = $CI->config->item('rating_review');
        switch($score)
        {           
            case $score < 6 :
                $level = $level_conf[5];
            break;
            case $score < 7  :
                 $level = $level_conf[6];
            break;    
            case $score < 8  :
                 $level = $level_conf[7];
            break;            
            case $score < 9  :
                 $level = $level_conf[8];
            break;            
            case $score < 10  :
                 $level = $level_conf[9];
            break;
            case $score < 11 :
                $level = $level_conf[10];
            break;             
            default:
                 $level = '';
            break;
        }
        unset($level_conf, $score);
        //return $CI->change_language_text->LANG[$level]== NULL?$level:$CI->change_language_text->LANG[$level];
        return $level;
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }
        
}
/* Return Review LEVEL against score END */
/***
*Start of Destination dropdown
*/

function makeOptionDestination($mix_where = '', $s_id = '')
{
    try
	{
		$CI = &get_instance();
		$cond = " WHERE Destination <> '' ORDER BY SUBSTRING(`Destination`, 1) ASC ";
		$res = $CI->db->query("select Destination, DestinationID from {$CI->db->DESTINATION_DETAILS} {$cond}");	
		$mix_value = $res->result_array();
		$s_option = '';
		if($mix_value)
		{
			foreach ($mix_value as $val)
			{
				$s_select = '';
				if($val["DestinationID"] == $s_id)
					$s_select = " selected ";
					
				$s_option .= "<option $s_select value='".$val["DestinationID"].",".$val["Destination"]."' >".$val["Destination"]."</option>";
			}
		}

		unset($res, $mix_value, $s_select, $mix_where, $s_id);
		return $s_option;
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}
/***
*End Destination dropdown
*/

/**
* Return number of hotel in a city START
*/
function getnumberOfHotel($city){
    try{
        $CI = &get_instance();
        $cond = " WHERE city = '".$city."' ";
        $res = $CI->db->query("SELECT COUNT(id) AS num_city FROM {$CI->db->ACTIVE_PROPERTY_LIST} {$cond}");    
        $mix_value = $res->result_array();
        $result = '';
        if($mix_value[0]['num_city'] > 0)
        {
            $result = $mix_value[0]['num_city'];
        }else{
          $result = 0;  
        }

        unset($cond, $res, $mix_value);
        return $result;
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }
        
}
/* Return number of hotel in a city  END */
/**
* Return Review and Rating For a Hotel ID SEARCH RESULT PAGE START
*/
function getReviewRatingSearchResult($hotel){        
    try{
        $CI = &get_instance();

        $cond = " WHERE hotel_id = '".$hotel."' LIMIT 0,1 ";
        $res = $CI->db->query("SELECT COUNT(*) AS total_review, AVG( review_score ) AS avg_rating FROM {$CI->db->MY_REVIEW_DETAILS} {$cond}");
        $mix_value = $res->result_array();
        $return_value = '';
        if(($mix_value[0]['total_review'])>0){
            $return_value .='<h3><a href="'.base_url().'hotelsummaries/get_reviews/'.$hotel.'" class="cute-balloon" clase="gray" ><img src="images/icon_01.png" alt="" /></a>&nbsp;&nbsp;';
            //$return_value .= $CI->change_language_text->LANG['reviews']== NULL?'reviews':$CI->change_language_text->LANG['reviews'].': ';
            $return_value .= getReviewLevel($mix_value[0]['avg_rating']);
            $return_value .= '&nbsp;'.$mix_value[0]['avg_rating'].'</h3>'; 
            $return_value .= '<span>Score from&nbsp;';            
            //$return_value .= $CI->change_language_text->LANG['Score from']== NULL?'Score from':$CI->change_language_text->LANG['Score from'].' ';            
            $return_value .= $mix_value[0]['total_review']; 
            $return_value .= '&nbsp;reviews</span>';          
        }else{
        $return_value = '';               
        }     

        unset($cond, $res, $mix_value);
        return $return_value;
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }
        
}
/* Return Review and Rating For a Hotel ID SEARCH RESULT PAGE END */

/**
* Return currency symbol start
*/
function getCurrencySymbol($to_Currency){
    try{
        $CI = &get_instance();
        $cond = " WHERE currency_id = '".$to_Currency."' ";
        $res = $CI->db->query("SELECT currency_symbol FROM {$CI->db->CURRENCIES} {$cond}");    
        $mix_value = $res->result_array();
        $result = '';
        if(count($mix_value[0]['currency_symbol']) > 0)
        {
            $result = $mix_value[0]['currency_symbol'];
        }

        unset($cond, $res, $mix_value);
        return $result;
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }
        
}
/* Return currency symbol END */
/* fetch Image Url for hotel room type start */
function getthumbNailUrl($hotel_id, $roomTypeCode){
	try{
        $CI = &get_instance();
        $cond = " WHERE ean_hotel_id = '".$hotel_id."' AND room_type_id = '".$roomTypeCode."' ";
        $res = $CI->db->query("SELECT room_type_image FROM {$CI->db->ROOM_TYPE_LISTS} {$cond}");    
        $mix_value = $res->result_array();
        $result = '';
        if(count($mix_value) > 0)
        {
            $result = $mix_value[0]['room_type_image'];
        }

        unset($cond, $res, $mix_value);
        return $result;
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }
}
/* fetch Image Url for hotel room type END */




/**
* START OF FUNCTION Return Latest Booking Time
*/
function getBookingTime($hotel){
    try{
        $CI = &get_instance();
        $cond = " WHERE hotel_id = '".$hotel."' order by booking_time desc LIMIT 0,1 ";
		//$booking_time_query="SELECT booking_time FROM {$CI->db->MY_BOOKING_DETAILS} {$cond}";
		$res = $CI->db->query("SELECT booking_time FROM {$CI->db->MY_BOOKING_DETAILS} {$cond}");
        $mix_value = $res->result_array();
        $result = '';
        if(count($mix_value) > 0)
        {

		 $result = strtotime($mix_value[0]['booking_time']);
		 $currentTime = strtotime(date('Y-m-d h:i:s', time()));
		 $diff = $currentTime - $result;
  		 $sec   = ($diff % 60 )." seconds";
		 $diff  = intval($diff / 60);
		 $min   = ($diff % 60) ." minutes";
		 $diff  = intval($diff / 60);
		 $hours = ($diff % 24) ." hours";
		 $days  = intval($diff / 24)." days";
			 if($days > 0)
			 {
				$result=$days;
			 }
			 else if($hours >0)
			 {
				$result=$hours;
			 }
			 else if($min >0)
			 {
				$result=$min;
			 }
			 else
			 {
			 	$result=$min;
			 }	
		 
		}

        unset($cond, $res, $mix_value);
        return $result;
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }
        
}
/*END OF FUNCTION Return Latest Booking Time */

function getNumberOfRoom($hotel_id){   
    try{
        $CI = &get_instance();
        $cond = " WHERE ean_hotel_id = '".$hotel_id."' ";
        $res = $CI->db->query("SELECT COUNT(*) AS num_of_rooms FROM {$CI->db->ROOM_TYPE_LISTS} {$cond}");    
        $mix_value = $res->result_array();
        $result = '';
        if(count($mix_value) > 0)
        {
            $result = $mix_value[0]['num_of_rooms'];
        }
        unset($cond, $res, $mix_value);
        return $result;
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }    
}
/** 
 * GET REGION ID BASED ON REGION NAME**
 */
function getRegionId($region_name){
    try{

        $CI = &get_instance();

        $cond = " WHERE region_name = '".$region_name."'";
	$res = $CI->db->query("SELECT region_id FROM {$CI->db->CITY_COORDINATES_LISTS} {$cond}");
        //print_r($CI->db->last_query());
        $region_id = $res->result_array();
        if(count($region_id)!=0){
        return $region_id[0]['region_id'];
        }
        else{
            return NULL;
            
            }
    }

    catch(Exception $err_obj)

    {

        show_error($err_obj->getMessage());

    }

}
/** 
 * GET AIRPORT NAME BASED ON REGION ID
 */
function getAirportName($regionID)
{

    try{

        $CI = &get_instance();
        $cond = " WHERE main_city_id = '".$regionID."'";
        $res = $CI->db->query("SELECT airport_name FROM {$CI->db->AIRPORT_COORDINATES_LISTS} {$cond}");
        $airport_name = $res->result_array();
        if(!empty($airport_name)){
        return $airport_name[0]['airport_name'];
        }
        else{
            return NULL;
        }

    }

    catch(Exception $err_obj)

    {

        show_error($err_obj->getMessage());

    }

        

}
/** 
 * GET MONUMENT NAME BASED ON REGION ID
 */
function getMonumentName($regionID)
{
    try{

        $CI = &get_instance();

        $cond = " WHERE region_id = '".$regionID."' AND sub_classification='monument'";
        $res = $CI->db->query("SELECT region_name FROM {$CI->db->POINTS_OF_INTEREST_COORDINATES_LISTS} {$cond}");
        //print_r($CI->db->last_query());
        //die();
        $monument_name = $res->result_array();
         if(count($monument_name)!=0){
                
        return $monument_name;
        }
        else{
            return NULL;
        }

    }

    catch(Exception $err_obj)

    {

        show_error($err_obj->getMessage());

    }

        

}
/** 
 * GET STADIUM NAME BASED ON REGION ID
 */
function getStadiumName($regionID)
{
    try{

        $CI = &get_instance();

        $cond = " WHERE region_id = '".$regionID."' AND sub_classification='stadium'";
        $res = $CI->db->query("SELECT region_name FROM {$CI->db->POINTS_OF_INTEREST_COORDINATES_LISTS} {$cond}");
        $stadium_name = $res->result_array();
         if(count($stadium_name)!=0){
                
        return $stadium_name;
        }
        else{
            return NULL;
        }

    }

    catch(Exception $err_obj)

    {

        show_error($err_obj->getMessage());

    }

        

}

?>
