<?php
/*
| ----------------------------------------------
| Start Date : 14-06-2012
| Developer : Kafil Akhter (Satyajit Limited)
| Framework : CodeIgniter
| ----------------------------------------------
| Main index controller for backend
| ----------------------------------------------
*/

class Hotelsummaries extends RB_Controller {


    /**
    * Load default admin home page
    *
    * @access    private
    * @param    string
    */
	function __construct()
	{
		parent::__construct();
		$this->load->model('ActivePropertyList_model');
		$this->load->model('Location_model');
		$this->load->model('RegionCenterCoordinatesList_model');
		$this->load->model('AttributeList_model');
		$this->load->model('ChainList_model');
		$this->load->model('PropertyTypeList_model');
		$this->load->model('SearchPricerange_model');
		$this->load->model('CountryList_model');
		$this->load->model('PropertyAttributeLink_model');
		$this->load->model('HotelImageList_model');
		$this->load->model('RoomTypeList_model');
		$this->load->model('Booking_model');
		$this->load->model('Destination_model');
		$this->load->helper('cookie');
		$this->default_language_currency_session();
		$this->data["LANG"] = $this->change_language_text();
		
	}
	
    function index()
    {
       // var_dump($this->session->userdata('logged_user')); die();
		$this->pageTitle = '::: Booking and You :::';
		$this->data["LANG"] = $this->change_language_text();
		$this->data["Most_Viewed_Hotel"] =  $this->ActivePropertyList_model->findMostViewed();
		
		/*$cond = array('Destination.is_featured' => '0','limit' => '3');
		$this->data["Featured_Destination"] =  $this->Destination->find();*/
		
		
		
		/*$condition = "ActivePropertyList.country <> ''";
		$this->data["All_Country_From_Hotel"] =  $this->ActivePropertyList->find();
		
		$this->data["Top_Destination"] =  $this->Destination->find();*/

		$this->_renderViewFe('index', $this->data);
		
    } 
	
		/******************************** Hotel Search By All Criteria Page *****************************************************/
	function search_result($search_string=null,$curr_page=1) {
		//echo $search_string;exit;
		$this->data["LANG"] = $this->change_language_text();
		$this->data["pageTitle"] = '::: Booking and You ::: - Search Result';
		
		if($this->input->cookie('User_Viewed_Hotels') && (is_array($this->input->cookie('User_Viewed_Hotels')))) {
		
			$My_Viewed_Val = $this->input->cookie('User_Viewed_Hotels');
			$cnt = count($My_Viewed_Val);
			if($cnt > 1){
			$Val1 = array();
				foreach($My_Viewed_Val as $key=>$val){
					$Val1[] = $val;
				}
				$My_Viewed_Val1 = implode(",",$Val1);
			}else{
					foreach($My_Viewed_Val as $key=>$val){
						$My_Viewed_Val1 = $val;
					}
			}
			$cookie_data = $this->ActivePropertyList_model->findMyViewed($My_Viewed_Val1);
			
			$this->data['User_View_cookie_data'] = $cookie_data;
		} else {
			$this->data['User_View_cookie_data'] = '';
		}
		if($this->session->userdata('Currency_code') == 'default'){
			$this->session->unset_userdata('Currency_code');
			$explode_search_string = explode('&',$search_string);
			$city_name = $explode_search_string[0];
			$explode_city = explode('=',$city_name);
			$city = trim($explode_city[1]);
			$curr = $this->ActivePropertyList_model->findCurrency($city);
			$currency =$curr[0]['booking_active_property_lists']['property_currency']; 
			$this->session->set_userdata('Currency_code', $currency);
		}
		$api_var = "http://api.ean.com/ean-services/rs/hotel/v3/list?minorRev=1&cid=".$this->config->item('cid')."&apiKey=jn3tqm9txz6dudysvyukz5jq&customerUserAgent=&customerIpAddress=&customerSessionId=&locale=en_US&currencyCode=".trim($this->session->userdata('Currency_code'))."&xml=<HotelListRequest>";
		
		$b_checkin_date_set = false;
		$b_checkout_date_set = false;
		
		$room_group_adult_str = '';
		$room_group_child_str = '';
		$room_group_child_ages_str = '';
		
		$explode_search_string = explode('&',$search_string);
		for($cnt_arr=0;$cnt_arr<count($explode_search_string);$cnt_arr++) {
			$explode_sub = explode('=',$explode_search_string[$cnt_arr]);
			
			if(in_array('city',$explode_sub)) {
				if($explode_sub[count($explode_sub) - 1] != 'All') {
					$api_var = $api_var."<city>".trim(htmlspecialchars($explode_sub[count($explode_sub) - 1]))."</city>";
					$this->data['search_city'] = rawurldecode($explode_sub[count($explode_sub) - 1]);
					
					$this->session->set_userdata('search_city', $explode_sub[count($explode_sub) - 1]);
				} 
				else {
					$this->data['search_city'] = '';
					
					$this->session->set_userdata('search_city', $explode_sub[count($explode_sub) - 1]);
					
				}
			}
			
			if(in_array('state_province',$explode_sub)) {
				if($explode_sub[count($explode_sub) - 1] != 'All') {
					$api_var = $api_var."<stateProvinceCode>".trim(htmlspecialchars($explode_sub[count($explode_sub) - 1]))."</stateProvinceCode>";
					$this->data['search_state'] = $explode_sub[count($explode_sub) - 1];
					
					$this->session->set_userdata('state_province', $explode_sub[count($explode_sub) - 1]);
				} 
				else {
					$this->data['search_state'] = '';
					
					$this->session->set_userdata('state_province', $explode_sub[count($explode_sub) - 1]);
				}
			}
			
			
			if(in_array('country',$explode_sub)) {
				if($explode_sub[count($explode_sub) - 1] != 'All') {
					$api_var = $api_var."<countryCode>".trim(htmlspecialchars($explode_sub[count($explode_sub) - 1]))."</countryCode>";
					$get_country_name = rawurldecode($explode_sub[count($explode_sub) - 1]);
					$s_where = " WHERE n.country_name = '".trim($get_country_name)."'" ;
					$country_code = $this->CountryList_model->fetch_multi($s_where);
					$this->data['search_country'] = $country_code[0]['country_code'];
					$this->data['search_country'] = rawurldecode($explode_sub[count($explode_sub) - 1]);
					
					$this->session->set_userdata('search_country', rawurldecode($explode_sub[count($explode_sub) - 1]));
				} 
				else {
					$this->data['search_country'] = '';
					$this->data['search_country'] = rawurldecode($explode_sub[count($explode_sub) - 1]);
					
					$this->session->set_userdata('search_country', '');
				}
			}
			
			if(!empty($this->data['search_city']) && !empty($this->data['search_country'])){
				$city = $this->data['search_city'];
				$country = $this->data['search_country'];
				$s_where = " WHERE  n.Destination LIKE '{$city}' AND n.Country LIKE '{$country}' ";
				$DestinationID = $this->Location_model->get_destinationId($s_where);
				$api_var = $api_var."<destinationId>".trim(htmlspecialchars($DestinationID))."</destinationId>";
			}
			
			if(in_array('checkin_date',$explode_sub)) {
				$api_var = $api_var."<arrivalDate>".htmlspecialchars(str_replace("-","/",$explode_sub[count($explode_sub) - 1]))."</arrivalDate>";
				$this->data['search_checkin_date'] = $explode_sub[count($explode_sub) - 1];
				
				$this->session->set_userdata('search_checkin_date', $explode_sub[count($explode_sub) - 1]);
				//$b_checkin_date_set = true;
			}
			
			if(in_array('checkout_date',$explode_sub)) {
				$api_var = $api_var."<departureDate>".htmlspecialchars(str_replace("-","/",$explode_sub[count($explode_sub) - 1]))."</departureDate>";
				$this->data['search_checkout_date'] = $explode_sub[count($explode_sub) - 1];
				
				$this->session->set_userdata('search_checkout_date', $explode_sub[count($explode_sub) - 1]);
				//$b_checkout_date_set = true;
			}
			
			
			if(in_array('amenity',$explode_sub) && ($explode_sub[count($explode_sub) - 1] != "All")) {
				$api_var = $api_var."<amenities>".htmlspecialchars(trim($explode_sub[count($explode_sub) - 1]))."</amenities>";
				$this->data['search_amenity'] = $explode_sub[count($explode_sub) - 1];
			} else {
				$this->data['search_amenity'] = '';
				
			}
			if(in_array('starrate',$explode_sub) && ($explode_sub[count($explode_sub) - 1] != "All")) {
				$api_var = $api_var."<maxStarRating>".htmlspecialchars(trim($explode_sub[count($explode_sub) - 1]))."</maxStarRating>";
				$this->data['search_starrate'] = $explode_sub[count($explode_sub) - 1];
			} else {
				$this->data['search_starrate'] = '';
			}
            
           			
			if(in_array('propertytype',$explode_sub) && ($explode_sub[count($explode_sub) - 1] != "All")) {
				$api_var = $api_var."<propertyCategory>".htmlspecialchars(trim($explode_sub[count($explode_sub) - 1]))."</propertyCategory>";
				$this->data['search_propertytype'] = $explode_sub[count($explode_sub) - 1];
			} else {
				$this->data['search_propertytype'] = '';
			}
			
			if(in_array('chaincode',$explode_sub) && ($explode_sub[count($explode_sub) - 1] != "All")) {
				$api_var = $api_var."<departureDate>".htmlspecialchars(trim($explode_sub[count($explode_sub) - 1]))."</departureDate>";
				$this->data['search_chaincode'] = $explode_sub[count($explode_sub) - 1];
			} else {
				$this->data['search_chaincode'] = '';
			}
			
			if(in_array('pricerange',$explode_sub) && ($explode_sub[count($explode_sub) - 1] != "All")) {
				$explode_PriceRange = explode("-",$explode_sub[count($explode_sub) - 1]);
				
				//$api_var = $api_var."<propertyCategory>".rawurlencode(trim($explode_sub[count($explode_sub) - 1]))."</propertyCategory>";
				$this->data['search_pricerange'] = $explode_sub[count($explode_sub) - 1];
			} else {
				$this->data['search_pricerange'] = '';
			}
			
            if(in_array('sortby',$explode_sub)) {
               $api_var = $api_var."<sortMethod>".trim($explode_sub[count($explode_sub) - 1])."</sortMethod>";
                $this->data['search_sortby'] = trim($explode_sub[count($explode_sub) - 1]);
            } 
			
			if(in_array('rooms',$explode_sub)) {
			
				$rooms_str = $explode_sub[count($explode_sub) - 1];
				$this->data['rooms'] = $explode_sub[count($explode_sub) - 1];
				$this->session->set_userdata('rooms', $explode_sub[count($explode_sub) - 1]);
			}
			if(in_array('room_adults',$explode_sub)) {
			
				$room_group_adult_str = $explode_sub[count($explode_sub) - 1];
				$room_group_adult_arr 		= explode(',', $room_group_adult_str);
				$this->data['room_adults'] = array_sum($room_group_adult_arr);
				$this->session->set_userdata('room_adults', array_sum($room_group_adult_arr));
			}
			
			if(in_array('room_childs',$explode_sub)) {
				$room_group_child_str = $explode_sub[count($explode_sub) - 1];
				$room_group_child_arr 		= explode(',', $room_group_child_str);
				$this->data['room_childs'] = array_sum($room_group_child_arr);
				$this->session->set_userdata('room_childs', array_sum($room_group_child_arr));
			}
			
			if(in_array('room_child_ages',$explode_sub)) {
			
				$room_group_child_ages_str = $explode_sub[count($explode_sub) - 1];
				$this->data['room_child_ages'] = $explode_sub[count($explode_sub) - 1];
				$this->session->set_userdata('room_child_ages', $explode_sub[count($explode_sub) - 1]);
			}
			
			//<RoomGroup><numberOfAdults>2</numberOfAdults><numberOfChildren>2</numberOfChildren></RoomGroup>
		}
		
		//$room_group_adult_arr 		= explode(',', $room_group_adult_str);
		//$room_group_child_arr 		= explode(',', $room_group_child_str);
		$room_group_child_ages_arr  = explode(',', $room_group_child_ages_str);
		$room_count_child_arr       = count($room_group_child_arr);
		
		$room_group_str = '';
		$room_group_str .= '<RoomGroup>';
		$z = 0;
		$room_count = $rooms_str;
		if($room_count > 1){
			
			for($i=1; $i <= count($room_group_child_arr); $i++) {
				$room_group_str  .= '<Room>';
				$room_group_str .= '<numberOfAdults>'.$room_group_adult_arr[$i-1].'</numberOfAdults>';
				if($room_count_child_arr > 0){
					
					$room_group_str .= '<numberOfChildren>'.$room_group_child_arr[$i-1].'</numberOfChildren>';
					if(count($room_group_child_ages_arr)>1){
					for($n = 1; $n<= $room_group_child_arr[$i-1]; $n++){
					    $room_group_child_string[] = $room_group_child_ages_arr[$z];//Preparing child ages array for a each room
						$z = $z+1;	
					}
					//Sending child ages array as comma separedted values
					if(!empty($room_group_child_string)){
					$room_group_str .= '<childAges>'.implode(",",$room_group_child_string).'</childAges>';
					}
					//Unset the array to reset  it to start with start
					unset($room_group_child_string);
					}
				}
				$room_group_str  .= '</Room>';
			}
			
		}else{
			$room_group_str  .= '<Room>';
			$room_group_str .= '<numberOfAdults>'.$room_group_adult_arr[0].'</numberOfAdults>';
			$room_group_str .= '<numberOfChildren>'.$room_group_child_arr[0].'</numberOfChildren>';
			$room_group_str  .= '</Room>';
		}
		$room_group_str .= '</RoomGroup>';
		$api_var .= $room_group_str;
        $api_var .= '<numberOfResults>200</numberOfResults></HotelListRequest>';
		
		//echo $api_var;
		
		/*if(!$b_checkin_date_set) {
			$this->session->set_userdata('search_checkin_date', '');
		}
		if(!$b_checkout_date_set) {
			$this->session->set_userdata('search_checkout_date', '');
		}*/
		
		/*First Api Call*/
		$hotel_ids_array = array();
		//print_r( $this->session->userdata('Search_Api_Hotel_Ids'));
		
		//echo $api_var;
        //exit;
		if($curr_page==1) {
			$api_content = $this->file_get_contents_curl($api_var);
/*			echo "<pre>";
            print_r($api_content);
            echo "</pre>";
            exit();*/

			if(isset($api_content) && is_object($api_content->HotelListResponse)){
				//echo 'success';	
				if(isset($api_content->HotelListResponse->HotelList->HotelSummary))	{		
				$hotel_summaries = $api_content->HotelListResponse->HotelList->HotelSummary;
				foreach($hotel_summaries as $all_hotel_summaries) {
					$hotel_ids_array[@$all_hotel_summaries->hotelId] = @$all_hotel_summaries->hotelId;					
				}
				
				}
				//print_r($hotel_ids_array);
				$this->session->set_userdata('Search_Api_Hotel_Ids', $hotel_ids_array);
				
			} else {
				$this->session->set_userdata('Search_Api_Hotel_Ids', '');
			}
			sleep(1);
		}
		
		/*First Api Call*/
		//print_r($hotel_ids_array);		
		
		
		
		
		/*Second Api Call*/
		//print_r($hotel_ids_second);
		$this->load->library('Mypagination');
		$this->mypagination->implodeBy = "|";
		$this->mypagination->showFirstAndLast = true;
		//$this->Mypagination->pages = 5;
		$this->mypagination->baseURL = base_url()."hotelsummaries/search_result/".$search_string;
		if($curr_page == 1) {			
			$Search_hotel_Id = $this->mypagination->generate($hotel_ids_array,$curr_page,10);
			//$result = array_diff($hotel_ids_array, $Search_hotel_Id);
			//$this->session->set_userdata('Search_Api_Hotel_Ids', $result);
		} else {
			$Search_hotel_Id = $this->mypagination->generate($this->session->userdata('Search_Api_Hotel_Ids'),$curr_page,10);
			//$result = array_diff($this->session->userdata('Search_Api_Hotel_Ids'), $Search_hotel_Id);
			//$this->session->set_userdata('Search_Api_Hotel_Ids', $result);
		}
		$Search_hotel_Id_implode = implode(",",$Search_hotel_Id);
		if($Search_hotel_Id_implode != "") {
			$api_var_second = "http://api.ean.com/ean-services/rs/hotel/v3/list?minorRev=1&cid=".$this->config->item('cid')."&apiKey=jn3tqm9txz6dudysvyukz5jq&customerUserAgent=&customerIpAddress=&customerSessionId=&locale=en_US&currencyCode=".trim($this->session->userdata('Currency_code'))."&xml=<HotelListRequest>";
			$api_var_second = $api_var_second.'<hotelIdList>'.$Search_hotel_Id_implode.'</hotelIdList>';
			
			$explode_search_string_second = explode('&',$search_string);
			for($cnt_arr=0;$cnt_arr < count($explode_search_string_second);$cnt_arr++) {
				$explode_sub_second = explode('=',$explode_search_string_second[$cnt_arr]);
				if(in_array('checkin_date',$explode_sub_second)) {
					$api_var_second = $api_var_second."<arrivalDate>".rawurlencode(str_replace("-","/",$explode_sub_second[count($explode_sub_second) - 1]))."</arrivalDate>";
				}
				if(in_array('checkout_date',$explode_sub_second)) {
					$api_var_second = $api_var_second."<departureDate>".rawurlencode(str_replace("-","/",$explode_sub_second[count($explode_sub_second) - 1]))."</departureDate>";
				}
			}

			//$api_var_second .= $room_group_str;//'<RoomGroup><numberOfAdults>2</numberOfAdults><numberOfChildren>2</numberOfChildren></RoomGroup>';
			
			$api_var_second .= '<maxRatePlanCount>100</maxRatePlanCount>';
			$api_var_second .= '</HotelListRequest>';
			//echo rawurldecode($api_var_second);exit;
			$api_content_second = $this->file_get_contents_curl($api_var_second);

			if(isset($api_content_second) && is_object(@$api_content_second->HotelListResponse->HotelList)){
				//echo 'success';
				$all_hotel_summary_second = @$api_content_second->HotelListResponse->HotelList;
				//print_r(@$api_content_second->HotelListResponse);
				$this->data['hotel_lists'] = $all_hotel_summary_second;
				
				//$hotel_summaries_second = $api_content_second->HotelListResponse->HotelList->HotelSummary;
				$property_links_hotel_id = '';
				$explode_hotel_id = explode(",",$Search_hotel_Id_implode);
				foreach($explode_hotel_id as $explode_hotel_idKey => $explode_hotel_idVal) {
					if($property_links_hotel_id == '') {
						$property_links_hotel_id = "'".$explode_hotel_idVal."'";
					} else {
						$property_links_hotel_id = $property_links_hotel_id.",'".$explode_hotel_idVal."'";
					}
				}
				if($property_links_hotel_id != "") {
					/*==========================================================================================================================*/
					$condition_property_attribute = "p.ean_hotel_id IN (".$property_links_hotel_id.")";
					$s_where = " AND a.language_code = 'en_US' AND a.type = 'PropertyAmenity' AND a.sub_type = 'PropertyAmenity'  AND ".$condition_property_attribute;
					$order_name = " p.id";
					$order_by =" ASC";
					$this->data['property_attribute_link'] = $this->PropertyAttributeLink_model->fetch_multi($s_where,$order_name,$order_by);
					/*==========================================================================================================================*/
					/*==========================================================================================================================*/
					$condition_property_list_starrate = "a.ean_hotel_id IN (".$property_links_hotel_id.")";
					$s_where = $condition_property_list_starrate;
					$order_name = " a.id";
					$order_by =" DESC";
					$this->data['property_list_starrate'] = $this->ActivePropertyList_model->fetch_property_list_starrate($s_where,$order_name,$order_by);
					/*==========================================================================================================================*/
					/*==========================================================================================================================*/
					$condition_property_list_chaincode = "a.ean_hotel_id IN (".$property_links_hotel_id.")";
					$s_where = " AND ".$condition_property_list_chaincode;
					$order_name = " a.id";
					$order_by =" ASC";
					//$this->set('property_list_chaincode',$this->ActivePropertyList->find('all',array('conditions'=>$condition_property_list_chaincode,'fields' => array('DISTINCT ActivePropertyList.chain_code_id'),'order' => array('ActivePropertyList.id ASC'))));
					$this->data['property_list_chaincode'] = $this->ActivePropertyList_model->fetch_property_list_chaincode($s_where,$order_name,$order_by);
					/*==========================================================================================================================*/
					/*==========================================================================================================================*/
					$condition_property_type_list = "a.ean_hotel_id IN (".$property_links_hotel_id.")";
					$s_where = " AND ".$condition_property_type_list;
					$order_name = " a.id";
					$order_by =" ASC";
					$this->data['property_type_list'] = $this->ActivePropertyList_model->fetch_property_type_list($s_where,$order_name,$order_by);
					/*==========================================================================================================================*/
				}
				/*==========================================================================================================================*/
				$condition_search_pricerange_lists =	"n.currency_code = 'USD'";
				//$condition_search_pricerange_lists =	"n.currency_code = '".trim($this->session->userdata('Currency_code'))."'";
				$s_where = " WHERE ".$condition_search_pricerange_lists;
				$order_name = " n.id";
				$order_by =" ASC";
				$this->data['all_search_pricerange_lists'] = $this->SearchPricerange_model->fetch_multi($s_where,$order_name,$order_by);
				/*==========================================================================================================================*/
				
				//$this->set('room_type_details',$this->api_room_type_data($Search_hotel_Id_implode));
				
				if (count($Search_hotel_Id) != 0) {
					// Create the page numbers
					//$this->set('pageLinks','<div class="paging top_margin" style="text-align:center;">'.$this->Mypagination->links().'</div>');
					$this->data['pageLinks'] = '<div class="paging top_margin" style="text-align:center;">'.$this->mypagination->links().'</div>';
				}
				
				//print_r($_SESSION);
			} 
			else {
				$this->data['hotel_summaries'] = '';
			}
		} else {
			$this->data['hotel_lists'] = '';
		}
		/*Second Api Call*/
		//$this->perPage =
// ********** Start Getting city name and country name from the search string *******       
                
			$city_name = $explode_search_string[0];
			$explode_city = explode('=',$city_name);
			$city = trim($explode_city[1]);
                        $city =urldecode($city);
                        
                        $country_name = $explode_search_string[2];
			$explode_country = explode('=',$country_name);
			$country = trim($explode_country[1]);
                        $country= urldecode($country);
                        $regionName=$city.','.$country;
 // ********** End Getting city name and country name from the search string *******
 // ********** Start get region id , airport name , monument name , stadium name for  in and around block search result page********               
                $this->data['regionID'] = getRegionId($regionName);
                if($this->data['regionID']!=NULL){
                $this->data['airport'] =  getAirportName($this->data['regionID']);
                $this->data['monument'] = getMonumentName($this->data['regionID']);
                $this->data['stadium'] = getStadiumName($this->data['regionID']);
                }
                else{
                  $this->data['airport']=NULL; 
                  $this->data['monument']=NULL;
                  $this->data['stadium']=NULL;
                }
// ********** End get region id , airport name , monument name , stadium name for  in and around block search result page********                               
           	$this->_renderViewFe('search_result', $this->data); 
		
	}
	
   		/******************************** Hotel Details Page *****************************************************/
	function hotel_info_details($hotel_id=null, $hotel_tiltle=null) {
		try{
			$this->data["LANG"] = $this->change_language_text();
			$s_where = " WHERE n.ean_hotel_id ='".$hotel_id."' AND n.language_code = '".$this->session->userdata('Language_code')."' ";
			$order_name = " n.id";
			$order_by =" ASC";
			$Hotel_Data = $this->ActivePropertyList_model->fetch_multi($s_where);
			if(!empty($Hotel_Data)){
				$this->data['Hotel_Data'] 				= $Hotel_Data[0];
				$this->data['country_name'] 			= $this->data['Hotel_Data']['country_name'];
				$this->data['country'] 					= $this->data['Hotel_Data']['country'];
				$this->data['state_province']			= $this->data['Hotel_Data']['state_province'];
				$this->data['city']						= $this->data['Hotel_Data']['city'];
				$this->data['name']						= $this->data['Hotel_Data']['name'];
				$this->data['star_rating']				= $this->data['Hotel_Data']['star_rating'];
				$this->data['address1']					= $this->data['Hotel_Data']['address1'];
				$this->data['postal_code']				= $this->data['Hotel_Data']['postal_code'];
				$this->data['latitude']				    = $this->data['Hotel_Data']['latitude'];
				$this->data['longitude']				= $this->data['Hotel_Data']['longitude'];
				$this->data['location']					= $this->data['Hotel_Data']['location'];
				$this->data['airport_code']				= $this->data['Hotel_Data']['airport_code'];
				$this->data['property_description']		= $this->data['Hotel_Data']['property_description'];
				$this->data['policy_description']		= $this->data['Hotel_Data']['policy_description'];
				$this->data['check_in_time']			= $this->data['Hotel_Data']['check_in_time'];
				$this->data['check_out_time']			= $this->data['Hotel_Data']['check_out_time'];
				$this->data['recreation_description']	= $this->data['Hotel_Data']['recreation_description'];
				$this->data['dining_description']		= $this->data['Hotel_Data']['dining_description'];
				$this->data['spa_description']			= $this->data['Hotel_Data']['spa_description'];
				
			}else{
				$this->data['Hotel_Data'] 				= array();
				$this->data['country_name'] 			= '';
				$this->data['country'] 					= '';
				$this->data['state_province']			= '';
				$this->data['city']						= '';
				$this->data['name']						= '';
				$this->data['star_rating']				= '';
				$this->data['address1']					= '';
				$this->data['postal_code']				= '';
				$this->data['latitude']					= '';
				$this->data['longitude'] 				= '';
				$this->data['location'] 				= '';
				$this->data['airport_code'] 			= '';
				$this->data['property_description']		= '';
				$this->data['policy_description']		= '';
				$this->data['check_in_time']			= '';
				$this->data['check_out_time'] 			= '';
				$this->data['recreation_description']	= '';
				$this->data['dining_description']		= '';
				$this->data['spa_description']			= '';
			}
			
			
			
			/* User Viewed Hotel */
			$user_viewed_hotel = array();
			if($this->input->cookie('User_Viewed_Hotels') && (is_array($this->input->cookie('User_Viewed_Hotels')))) {
				$user_viewed_hotel = $this->input->cookie('User_Viewed_Hotels');
			}
			if(!array_key_exists($hotel_id,$user_viewed_hotel)) {
				$user_viewed_hotel[$hotel_id] = $hotel_id;
			}
			
				$cnt = count($user_viewed_hotel);
				if($cnt > 1){
				$Val1 = array();
					foreach($user_viewed_hotel as $key=>$val){
						$Val1[] = $val;
					}
					$user_viewed_hotel1 = implode(",",$Val1);
				}else{
						foreach($user_viewed_hotel as $key=>$val){
							$user_viewed_hotel1 = $val;
						}
				}
			$user_cookie_data = $this->ActivePropertyList_model->findMyViewed($user_viewed_hotel1);
				
			//$this->input->set_cookie('User_Viewed_Hotels',$user_viewed_hotel,$_SERVER['SERVER_NAME'],3600,false);
			$this->data['User_View_cookie_data'] = $user_cookie_data;
			
			if($this->session->userdata('search_checkin_date') != ""){
			$search_checkin_date = $this->session->userdata('search_checkin_date');
			}else{
				$search_checkin_date = date('m-d-Y');
				$this->session->set_userdata('search_checkin_date', $search_checkin_date);
			}
			if($this->session->userdata('search_checkout_date') != ""){
			$search_checkout_date = $this->session->userdata('search_checkout_date');
			}else{
				$search_checkout_date = date('m-d-Y', strtotime(date('Y-m-d').' +1 Weekday'));
				$this->session->set_userdata('search_checkout_date', $search_checkout_date);
			}
			
			if($this->session->userdata('Currency_code') == 'default'){
			$this->session->unset_userdata('Currency_code');
			$curr = $this->ActivePropertyList_model->findCurrencyByHotelId($hotel_id);
			$currency =$curr[0]['booking_active_property_lists']['property_currency']; 
			$this->session->set_userdata('Currency_code', $currency);
			}
			if( !empty($search_checkout_date) && !empty($search_checkin_date) ) {
			$api_url = "http://api.ean.com/ean-services/rs/hotel/v3/list?minorRev=1&cid=".$this->config->item('cid')."&apiKey=jn3tqm9txz6dudysvyukz5jq&customerUserAgent=&customerIpAddress=&customerSessionId=&locale=en_US&currencyCode=".trim($this->session->userdata('Currency_code'))."&xml=<HotelListRequest>";
			$api_url = $api_url.'<hotelIdList>'.$hotel_id.'</hotelIdList>';
			
			
			$api_url = $api_url."<arrivalDate>".rawurlencode(str_replace('-', '/', $search_checkin_date))."</arrivalDate>";
			$api_url = $api_url."<departureDate>".rawurlencode(str_replace('-', '/', $search_checkout_date))."</departureDate>";
			
			$api_url .= '<RoomGroup><numberOfAdults>2</numberOfAdults></RoomGroup>';
			$api_url .= '<maxRatePlanCount>100</maxRatePlanCount>';
			$api_url .= '</HotelListRequest>';
			
			$mon_checkout = substr($search_checkout_date, 0, 2);
			$day_checkout = substr($search_checkout_date, 3, 2);
			$year_checkout = substr($search_checkout_date, 6);
			
			$mon_checkin = substr($search_checkin_date, 0, 2);
			$day_checkin = substr($search_checkin_date, 3, 2);
			$year_checkin = substr($search_checkin_date, 6);
			
			/*echo strtotime($year_checkout.'-'.$mon_checkout.'-'.$day_checkout);
			echo strtotime($year_checkin.'-'.$mon_checkin.'-'.$day_checkin);
			exit;*/
			
			$no_of_nights = (strtotime($year_checkout.'-'.$mon_checkout.'-'.$day_checkout) - strtotime($year_checkin.'-'.$mon_checkin.'-'.$day_checkin))/(60*60*24);
			//echo $no_of_nights/(60*60*24);exit;
			$this->data['no_of_nights'] = $no_of_nights;
			
			//echo $api_url;
			$hotel_content = $this->file_get_contents_curl($api_url);

			if(isset($hotel_content) && is_object(@$hotel_content->HotelListResponse->HotelList)){
				//echo 'success';
				$hotel_summary = @$hotel_content->HotelListResponse->HotelList->HotelSummary;
				//print_r(@$hotel_content->HotelListResponse);exit;
				$this->data['hotel_details'] = $hotel_summary;
			}
			/*==========================================================================================================================*/
			//$this->set('HotelimageData',$this->HotelImageList_model->findAll("HotelImageList.ean_hotel_id = '".$hotel_id."'"));
			$condition_property_attribute = "n.ean_hotel_id =".$hotel_id;
			$s_where = " WHERE ".$condition_property_attribute;
			$order_name = " n.id";
			$order_by =" ASC";
			$this->data['HotelimageData'] = $this->HotelImageList_model->fetch_multi($s_where,$order_name,$order_by);
			/*==========================================================================================================================*/
			/*==========================================================================================================================*/
			//$this->set('HotelpamenityData',$this->Hotelpamenity_model->findAll("Hotelpamenity.hotel_id = '".$hotel_id."'"));
			$this->data['HotelpamenityData']  = array();
			/*==========================================================================================================================*/
			/*==========================================================================================================================*/
			//$this->set('HotelroomtypeData',$this->RoomTypeList_model->findAll("RoomTypeList.ean_hotel_id = '".$hotel_id."' AND RoomTypeList.language_code = '".$this->session->userdata('Language_code')."'"));
			$this->data['HotelroomtypeData']  = array();
			/*==========================================================================================================================*/
			/*==========================================================================================================================*/
			$condition_property_attribute = "p.ean_hotel_id =".$hotel_id;
			$s_where = " AND a.language_code = 'en_US' AND a.type = 'PropertyAmenity' AND a.sub_type = 'PropertyAmenity'  AND ".$condition_property_attribute;
			$order_name = " p.id";
			$order_by =" ASC";
			$this->data['HotelPropertyAttributeLinkData'] = $this->PropertyAttributeLink_model->fetch_multi($s_where,$order_name,$order_by);
			/*==========================================================================================================================*/
			/*==========================================================================================================================*/
			$condition_property_attribute = "p.ean_hotel_id =".$hotel_id;
			$s_where = " AND a.language_code = 'en_US' AND a.type = 'RoomAmenity' AND a.sub_type = 'RoomAmenity'  AND ".$condition_property_attribute;
			$order_name = " p.id";
			$order_by =" ASC";
			$this->data['HotelRoomAttributeLinkData'] = $this->PropertyAttributeLink_model->fetch_multi($s_where,$order_name,$order_by);
			/*==========================================================================================================================*/
			/*==========================================================================================================================*/
			if($this->session->userdata('search_city') != ''){
			$search_city = $this->session->userdata('search_city');
			$s_where = "city LIKE '%$search_city%'";
			$this->data['Recently_Booked_Hotel_Id'] = $this->Booking_model->get_hotelIds($s_where);
			}else{
				$this->data['Recently_Booked_Hotel_Id'] = array();
			}
			/*==========================================================================================================================*/
			
			$this->data['hotel_id'] = $hotel_id;
                        
// ********** Start Getting city name and country name from the search string *******       
                
                        $city =$this->data['city'];
                        
                        $country= $this->data['country_name'];
                        $regionName=$city.', '.$country;
                        //$regionName="Kolkata, India";
 // ********** End Getting city name and country name from the search string *******
 // ********** Start get region id , airport name , monument name , stadium name for  in and around block search result page********               
                $this->data['regionID'] = getRegionId($regionName);
				if($this->data['regionID']!=NULL){
                $this->data['airport'] =  getAirportName($this->data['regionID']);
                $this->data['monument'] = getMonumentName($this->data['regionID']);
                $this->data['stadium'] = getStadiumName($this->data['regionID']);
                }
                else{
                  $this->data['airport']=NULL; 
                  $this->data['monument']=NULL;
                  $this->data['stadium']=NULL;
                }

				
// ********** End get region id , airport name , monument name , stadium name for  in and around block search result page********                        
                        
                        
			$this->_renderViewFe('hotel_info_details', $this->data); 
		}
		}catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}
	}
	/******************************** Hotel Details Page *****************************************************/
  		/******************************** Hotel State/City Search By Country Page *****************************************************/
	function search_by_country($country_code=null, $country_title=null) {
		try{
				$cond = " WHERE n.country_code = '".$country_code."'";
				$country_coordinate  = $this->CountryList_model->fetch_multi($cond);
				$this->data['country_coordinate'] = $country_coordinate[0]; 
				$this->data['All_City_From_Hotel'] = $this->ActivePropertyList_model->findByCountry($country_code);
				
				$this->data['Most_Viewed_Hotel'] = $this->ActivePropertyList_model->findMostViewed();
				
				$s_where = "country_code = '".$country_code."'";
				$this->data['Recently_Booked_Hotel_Id'] = $this->Booking_model->get_hotelIds($s_where);
				
				$this->data['country_codes'] = $country_code;
				$this->data["pageTitle"] = '::: Booking and You ::: - Search Hotels By Country';
				$this->_renderViewFe('search_by_country', $this->data); 
		 }
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}
	}
	/******************************** Hotel State/City Search By Country Page *****************************************************/
		/******************************** Hotel Search By City Page *****************************************************/
	function hotel_search_by_city($city=null,$country=null) {
		try{
			if($this->input->cookie('User_Viewed_Hotels') && (is_array($this->input->cookie('User_Viewed_Hotels')))) {
			
				$My_Viewed_Val = $this->input->cookie('User_Viewed_Hotels');
				$cnt = count($My_Viewed_Val);
				if($cnt > 1){
				$Val1 = array();
					foreach($My_Viewed_Val as $key=>$val){
						$Val1[] = $val;
					}
					$My_Viewed_Val1 = implode(",",$Val1);
				}else{
						foreach($My_Viewed_Val as $key=>$val){
							$My_Viewed_Val1 = $val;
						}
				}
				$cookie_data = $this->ActivePropertyList_model->findMyViewed($My_Viewed_Val1);
				
				$this->data['User_View_cookie_data'] = $cookie_data;
			} else {
				$this->data['User_View_cookie_data'] = '';
			}
			$this->data['search_city'] = $city;
			$this->data['search_country'] = $country;
			/*$this->set('City_Hotel_Data',$this->ActivePropertyList->find('all',array('conditions' => array('ActivePropertyList.city' => $city),'order' => array('ActivePropertyList.view_counter DESC'), 'limit' => 30)));*/
			
			$condition_property_list = " WHERE n.city = '".$city."' AND n.country = '".$country."'";
			$s_where = $condition_property_list;
			
			$this->total_db_records = $this->ActivePropertyList_model->gettotal_info($s_where);
			$this->data['City_Hotel_Data_Count'] = $this->total_db_records;
			$this->s_pageurl = 'hotelsummaries/hotel_search_by_city/'.$city.'/'.$country;
			$order_name = " n.view_counter";
			$order_by = " DESC";
			$s_rq_url = "";
			$s_where = " WHERE n.city = '".$city."' AND n.country = '".$country."' ORDER BY {$order_name} {$order_by} ";
			
			//Setting Limits, If searched then start from 0////
			$i_uri_seg = 5;
			$i_start=$this->uri->segment($i_uri_seg);
			if(empty($i_start))
			{
				$i_start=0;
			}
			else
			{
				$i_start=$i_start;
			}
			
			$i_limit = $this->fe_page_limit();
			$this->i_uri_seg = $i_uri_seg;
			$this->fe_page_limit = $i_limit;
			$this->data["pagination"] = $this->get_fe_pagination($this->s_pageurl, $this->total_db_records, $this->fe_page_limit, $this->i_uri_seg);
			//print_r($data["pagination"]); die();
			$City_Hotel_Data = $this->ActivePropertyList_model->fetch_multi($s_where,$i_start,$i_limit);
			
			$this->data['City_Hotel_Data'] = $City_Hotel_Data;
			$this->data["pageTitle"] = '::: Booking and You ::: - Search Hotels By Country';
			$this->_renderViewFe('hotel_search_by_city', $this->data); 
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}
		
	}	
	/******************************** Hotel Search By City Page *****************************************************/
	
	
	
/******************************** Get Reviews function start *****************************************************/
function get_reviews($hotel_id = null) {
	try{
		$details	= $this->ActivePropertyList_model->get_reviews($hotel_id);
        $star = str_replace(".","",$details[0]['star_rating']);
        $country = str_replace(" ","_",strtolower($details[0]['countryname']));
        $output = '';
        $output .= "<div class='ballon_inner'>";
        $output .= "<h3><img src='".$details[0]['thumbnail_url']."' class='image_place' />".$details[0]['name']."</h3>"; 
        $output .= "<p><img src='images/".$star."_stars.png' alt='' /></p>";
        $output .= "<p>".$details[0]['address1']. ",&nbsp;".$details[0]['address2']. ",&nbsp;".$details[0]['city'].",&nbsp;".$details[0]['countryname']."&nbsp;&nbsp;<img src='".base_url()."country_flag/flags_thumb/".$country.".png' alt='' /></p>";             
        $output .= "<table width='100%' border='0' cellspacing='1' cellpadding='4'>";
        $output .= "<tr>";
        $output .= "<th width='25%'>User Name</th>";
        $output .= "<th width='10%'>Rating</th>";
        $output .= "<th width='65%'>Comments</th>";
        $output .= "</tr>";      
        
        foreach($details as $info){
          $output .= "<tr><td>$info[username]</td><td>$info[review_score]</td><td>$info[review_comments]</td></tr>";                   
        }          

        $output .= "</table>";
        $output .= "</div>";
        $this->data['output'] = $output;
        $this->load->view('fe/tooltip_rating_details.php', $this->data);  
	   }
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}
/******************************** Hotel State/City Search By Country Page *****************************************************/	
function delete_user_viewed_hotel($hotel_id) {
 if($this->input->cookie("User_Viewed_Hotels") && (is_array($this->input->cookie("User_Viewed_Hotels")))) {
    delete_cookie("User_Viewed_Hotels");
  }
  redirect($_SERVER['HTTP_REFERER']);
 }	
 
 
 
}

	
/* End of admin controller file index.php */
/* Location: ./system/application/controllers/admin/index.php */


