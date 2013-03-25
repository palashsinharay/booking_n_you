<?php
/*
| ----------------------------------------------
| Start Date : 10-12-2012
| Developer : Kafil Akhter (Satyajit Limited)
| Framework : CodeIgniter
| ----------------------------------------------
| Main index controller for backend
| ----------------------------------------------
*/

class Booking extends RB_Controller {


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
		$this->load->model('Booking_model');
		$this->load->library('form_validation');
		$this->data["LANG"] = $this->change_language_text();
		
	}
	 
	function index($hotel_id=null, $hotel_tiltle=null) {
		try{
			
			$this->layout = 'userend_layout';		
			$this->pageTitle = '::: Booking and You ::: - Enter booking details';
			$this->data["LANG"] = $this->change_language_text();
			$s_where = " WHERE n.ean_hotel_id =".$hotel_id;
			$order_name = " n.id";
			$order_by =" ASC";
			$Hotel_Data = $this->ActivePropertyList_model->fetch_multi($s_where);
			
			if(!empty($Hotel_Data)){
                //echo "Hellooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo";
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
				//$this->data['checkout_date']			= date('l, F j, Y', strtotime($year_checkout.'-'.$mon_checkout.'-'.$day_checkout));
				
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
			
			if(isset($_POST['room'])) {
				$room = $_POST['room'];
				$room_cnt = 0;
				$total = 0;
				foreach($room as $rooms){
					
					$rooms1 = explode('&', $rooms);
					$room_count = $rooms1[0];
					
					if($room_count > 0){
						$room_cnt = ($room_cnt+$rooms1[0]);
						$rateKey = $rooms1[1];
						$rateCode = $rooms1[2];
						$roomTypeCode = $rooms1[3];
						$total = ($total+$rooms1[4]);
					}
				}
			
					$this->session->unset_userdata("no_of_rooms");
					$this->data['no_of_rooms'] = $room_cnt;
					$this->session->set_userdata('no_of_rooms', $room_cnt);
					
					$this->session->unset_userdata("no_of_people");
					$this->data['no_of_people'] = ($room_cnt*2);
					$this->session->set_userdata('no_of_people', ($room_cnt*2));
					
					$this->session->unset_userdata("total");
					$this->data['total'] = ($total*$room_cnt);
					$this->session->set_userdata('total', ($total*$room_cnt));
					
					$this->session->unset_userdata("rateKey");
					$this->data['rateKey'] = $rateKey;
					$this->session->set_userdata('rateKey', $rateKey);
					
					$this->session->unset_userdata("rateCode");
					$this->data['rateCode'] = $rateCode;
					$this->session->set_userdata('rateCode', $rateCode);
					
					$this->session->unset_userdata("roomTypeCode");
					$this->data['roomTypeCode'] = $roomTypeCode;
					$this->session->set_userdata('roomTypeCode', $roomTypeCode);
				
			}else{
					$this->data['no_of_rooms'] 	= $this->session->userdata('no_of_rooms');
					$this->data['no_of_people'] = $this->session->userdata('no_of_people');
					$this->data['total'] 		= $this->session->userdata('total');
					$this->data['rateKey'] 		= $this->session->userdata('rateKey');
					$this->data['rateCode'] 	= $this->session->userdata('rateCode');
					$this->data['roomTypeCode'] = $this->session->userdata('roomTypeCode');
					
					$this->session->unset_userdata("no_of_rooms");
					$this->session->unset_userdata("no_of_people");
					$this->session->unset_userdata("total");
					$this->session->unset_userdata("rateKey");
					$this->session->unset_userdata("rateCode");
					$this->session->unset_userdata("roomTypeCode");
			}
			
			if(isset($_POST['room_counts'])) {
				
			}
			
			if(isset($_POST['submit_button'])) {
				
				$this->load->library('Form_validation');
				
				$posted=array();
				$posted["fname"]			=	trim($this->input->post("fname"));
				$posted["lname"]			=	trim($this->input->post("lname"));
				$posted["email"]			=	trim($this->input->post("email"));
                $posted["confirm_email"]	=	trim($this->input->post("confirm_email"));
				$posted["password"]			=	trim($this->input->post("password"));
				
				$posted["guest_name"]		=	($this->input->post("guest_name"));
				$posted["special_request"]	=	trim($this->input->post("special_request"));
				$posted["no_of_rooms"]		=	trim($this->input->post("no_of_rooms"));
				$posted["no_of_people"]		=	trim($this->input->post("no_of_people"));
				$posted["total"]			=	trim($this->input->post("total"));
				$posted["rateKey"]			=	trim($this->input->post("rateKey"));
				$posted["rateCode"]			=	trim($this->input->post("rateCode"));
				$posted["roomTypeCode"]		=	trim($this->input->post("roomTypeCode"));
				
				$this->form_validation->set_rules('fname', 'first name', 'required');
                $this->form_validation->set_rules('lname', 'last name', 'required');
				$this->form_validation->set_rules('email', 'email', 'required');
				$this->form_validation->set_rules('confirm_email', 'confirm email', 'required');
			    if($this->form_validation->run() == FALSE)/////invalid
                {
                    ////////Display the add form with posted values within it////
                    $this->data["posted"]=$posted;
                }
                else///validated, now save into DB
                {
					$this->session->set_userdata('booking_fname', $posted["fname"]);
					$this->session->set_userdata('booking_lname', $posted["lname"]);
					$this->session->set_userdata('booking_email', $posted["email"]);
					$this->session->set_userdata('user_password', $posted["password"]);
					$this->session->set_userdata('booking_guest_name', $posted["guest_name"]);
					$this->session->set_userdata('booking_special_request', $posted["special_request"]);
					
					
					$this->session->set_userdata('booking_no_of_rooms', $posted["no_of_rooms"]);
					$this->session->set_userdata('booking_no_of_people', $posted["no_of_people"]);
					$this->session->set_userdata('booking_total', $posted["total"]);
					$this->session->set_userdata('booking_rateKey', $posted["rateKey"]);
					$this->session->set_userdata('booking_rateCode', $posted["rateCode"]);
					$this->session->set_userdata('booking_roomTypeCode', $posted["roomTypeCode"]);
					
					redirect(base_url().'booking/booking_confirm/'.$hotel_id);
				}
			}
			
			//print_r($_POST);
			$search_checkout_date = $this->session->userdata('search_checkout_date');
			$search_checkin_date = $this->session->userdata('search_checkin_date');
			$mon_checkout = substr($search_checkout_date, 0, 2);
			$day_checkout = substr($search_checkout_date, 3, 2);
			$year_checkout = substr($search_checkout_date, 6);
			
			$mon_checkin = substr($search_checkin_date, 0, 2);
			$day_checkin = substr($search_checkin_date, 3, 2);
			$year_checkin = substr($search_checkin_date, 6);
			
			
			$search_checkout_date_formatted = date('l, F j, Y', strtotime($year_checkout.'-'.$mon_checkout.'-'.$day_checkout));
			$this->data['search_checkout_date_formatted'] = $search_checkout_date_formatted;
			$search_checkin_date_formatted =  date('l, F j, Y', strtotime($year_checkin.'-'.$mon_checkin.'-'.$day_checkin));
			$this->data['search_checkin_date_formatted'] = $search_checkin_date_formatted;
			$no_of_nights = (strtotime($year_checkout.'-'.$mon_checkout.'-'.$day_checkout) - strtotime($year_checkin.'-'.$mon_checkin.'-'.$day_checkin))/(60*60*24);
			$this->data['no_of_nights'] = $no_of_nights;
			
			
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
			$this->data['hotel_id'] = $hotel_id;
			$this->_renderViewFe('booking_details', $this->data); 
			
			}catch(Exception $err_obj){
				show_error($err_obj->getMessage());
			}
	}
	
	function booking_confirm($hotel_id=null) {
		try{
			$this->layout = 'userend_layout';		
			$this->pageTitle = '::: Booking and You ::: - Confirm booking details';
			$this->data["LANG"] = $this->change_language_text();
			$s_where = " WHERE n.ean_hotel_id =".$hotel_id;
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
			
		
		if(isset($_POST['submit_button'])) {
			$this->load->library('Form_validation');
				
			$posted=array();
			$posted["address"]			=	trim($this->input->post("address"));
			$posted["city"]				=	trim($this->input->post("city"));
			$posted["zip"]				=	trim($this->input->post("zip"));
			$posted["country"]			=	trim($this->input->post("country"));
			$posted["credit_card"]		=	trim($this->input->post("credit_card"));
			$posted["credit_card_no"]	=	trim($this->input->post("credit_card_no"));
			$posted["date_box"]			=	trim($this->input->post("date_box"));
			$posted["year_box"]			=	trim($this->input->post("year_box"));
			$posted["cvccode"]			=	trim($this->input->post("cvccode"));
			
			$posted["fname"]			=	trim($this->input->post("fname"));
			$posted["lname"]			=	trim($this->input->post("lname"));
			$posted["email"]			=	trim($this->input->post("email"));
			$posted["password"]			=	trim($this->input->post("password"));
			$posted["phone"]			=	trim($this->input->post("phone"));
			
			$posted["total"]			=	trim($this->input->post("total"));
			$posted["rateKey"]			=	trim($this->input->post("rateKey"));
			$posted["rateCode"]			=	trim($this->input->post("rateCode"));
			$posted["roomTypeCode"]		=	trim($this->input->post("roomTypeCode"));
			
			$this->form_validation->set_rules('address', 'address', 'required');
			$this->form_validation->set_rules('city', 'city', 'required');
			$this->form_validation->set_rules('country', 'country', 'required');
			$this->form_validation->set_rules('credit_card', 'credit card', 'required');
			$this->form_validation->set_rules('credit_card_no', 'credit card no', 'required');
			$this->form_validation->set_rules('year_box', 'year box', 'required');
			
			if($this->form_validation->run() == FALSE)/////invalid
			{
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			}
			else///validated, now save into DB
			{
				
				/********************************Start of Hotel reservation Request*****************************************************/
				$search_checkout_date = $this->session->userdata('search_checkout_date');
				$search_checkin_date = $this->session->userdata('search_checkin_date');
				$hotel_id = explode('.', $hotel_id);
				$hotel_id = $hotel_id[0];
				$url = 'https://book.api.ean.com/ean-services/rs/hotel/v3/res';
				
				$query['cid'] = $this->config->item('cid');
				$query['minorRev'] = '1';
				$query['apiKey'] = '3d9au35ksren47h4mg8ahey5';
				$query['customerUserAgent'] = 'Mozilla/5.0';
				$query['customerIpAddress'] = ''.$_SERVER['REMOTE_ADDR'].'';
				$query['customerSessionId'] = '0ABAA827-E654-C913-7362-1C97F8902E7B';
				$query['locale'] = 'en_US';
				$query['currencyCode'] = 'USD';

				$xml = '<HotelRoomReservationRequest>
				<hotelId>'.$hotel_id.'</hotelId>
				<arrivalDate>'.str_replace('-','/',$search_checkin_date).'</arrivalDate>
				<departureDate>'.str_replace('-','/',$search_checkout_date).'</departureDate>
				<supplierType>E</supplierType>
				<rateKey>'.$posted["rateKey"].'</rateKey>
				<rateCode>'.$posted['rateCode'].'</rateCode>
				<roomTypeCode>'.$posted['roomTypeCode'].'</roomTypeCode>
				<chargeableRate>'.$posted['total'].'</chargeableRate>
				<RoomGroup>
				<Room>
				<numberOfAdults>2</numberOfAdults>
				<numberOfChildren>0</numberOfChildren>
				<firstName>test</firstName>
				<lastName>smith</lastName>
				<smokingPreference>NS</smokingPreference>
				</Room>
				</RoomGroup>
				<ReservationInfo>
				<email>'.$posted['email'].'</email>
				<firstName>'.$posted['fname'].'</firstName>
				<lastName>'.$posted['lname'].'</lastName>
				<homePhone>'.$posted['phone'].'</homePhone>
				<workPhone>'.$posted['phone'].'</workPhone>
				<creditCardType>'.$posted['credit_card'].'</creditCardType>
				<creditCardNumber>'.$posted['credit_card_no'].'</creditCardNumber>
				<creditCardExpirationMonth>'.$posted['date_box'].'</creditCardExpirationMonth>
				<creditCardExpirationYear>'.$posted['year_box'].'</creditCardExpirationYear>
				<creditCardIdentifier>'.$posted['cvccode'].'</creditCardIdentifier>
				</ReservationInfo>
				<AddressInfo>
				<address1>travelnow</address1>
				<city>'.$posted['city'].'</city>
				<stateProvinceCode>null</stateProvinceCode>
				<countryCode>'.$posted['country'].'</countryCode>
				<postalCode>'.$posted['zip'].'</postalCode>
				</AddressInfo>
				</HotelRoomReservationRequest>';
		          $queryString = http_build_query($query);
				  $queryString .= '&xml='.$xml;
/*				  echo $queryString;
				  die();
*/				  
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_URL, $url );
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);
				curl_setopt($ch, CURLOPT_POST, true);
				$output = json_decode(curl_exec($ch));
				$error = curl_error($ch);
			/*	echo "<pre>";
				print_r($error);
				echo "<br/>";
				print_r($output);
				die();*/
				 if (@$output->HotelRoomReservationResponse->EanWsError->presentationMessage)
				  {
					  $results = array(
					  'error' => str_replace('TravelNow.com', 'bookingandyou.com', $this->string_clean_up((string)@$output->HotelRoomReservationResponse->EanWsError->presentationMessage))
					  );
				  }
				  else if (@$output->error)
				  {
					  $results = array(
					  'error' => str_replace('TravelNow.com', 'bookingandyou.com', $this->string_clean_up((string)@$output->HotelRoomReservationResponse->error))
					  );
				  }
				  else 
				  {
					  $results = array(
					  'itinerary_number' => (string)@$output->HotelRoomReservationResponse->itineraryId,
					  'confirmation_numbers' => (string)@$output->HotelRoomReservationResponse->confirmationNumbers,
					  'total' => (float)@$output->HotelRoomReservationResponse->RateInfo->ChargeableRateInfo->{'@total'},
					  'currencyCode' => (string)@$output->HotelRoomReservationResponse->RateInfo->ChargeableRateInfo->{'@currencyCode'},
					  'tax_amount' => (string)@$output->HotelRoomReservationResponse->RateInfo->ChargeableRateInfo->Surcharges->{'@Surcharge->amount'},
					  'tax_type' => (string)@$output->HotelRoomReservationResponse->RateInfo->ChargeableRateInfo->Surcharges->{'@Surcharge->type'},
					  'number_of_rooms_booked' => (string)@$output->HotelRoomReservationResponse->numberOfRoomsBooked,
					  'numberOfAdults' => (string)@$output->HotelRoomReservationResponse->RoomGroup->Room->numberOfAdults,
					  'numberOfChildren' => (string)@$output->HotelRoomReservationResponse->RoomGroup->Room->numberOfChildren,
					  'firstName' => (string)@$output->HotelRoomReservationResponse->RoomGroup->Room->firstName,
					  'lastName' => (string)@$output->HotelRoomReservationResponse->RoomGroup->Room->lastName,
					  'bedTypeId' => (string)@$output->HotelRoomReservationResponse->RoomGroup->Room->bedTypeId,
					  'smokingPreference' => (string)@$output->HotelRoomReservationResponse->RoomGroup->Room->smokingPreference,
					  'arrivalDate' => (string)@$output->HotelRoomReservationResponse->arrivalDate,
					  'departureDate' => (string)@$output->HotelRoomReservationResponse->departureDate,
					  'hotelName' => (string)@$output->HotelRoomReservationResponse->hotelName,
					  'hotelAddress' => (string)@$output->HotelRoomReservationResponse->hotelAddress,
					  'hotelCity' => (string)@$output->HotelRoomReservationResponse->hotelCity,
					  'hotelCountryCode' => (string)@$output->HotelRoomReservationResponse->hotelCountryCode,
					  'roomDescription' => (string)@$output->HotelRoomReservationResponse->roomDescription,
					  'cancellationPolicy' => (string)@$output->HotelRoomReservationResponse->cancellationPolicy,
					  );
					 
					
					$user_session_info = $this->session->userdata('LOGGEDIN_USER'); 
					if(!empty($user_session_info))  {
					$booking_info = array();
					$booking_info['user_id']  				=   $user_session_info['user_id'];
					$booking_info['hotel_id']  				=   $hotel_id;
					$booking_info["check_in"]				=	$results['arrivalDate'];
					$booking_info["check_out"]	    		=	$results['departureDate'];
					$booking_info["max_person"]				=	$results['numberOfAdults'];
					$booking_info["no_of_rooms"]			=	$results['number_of_rooms_booked'];
					$booking_info["rate"]					=	$results['total'];
					$booking_info["currency"]				=	$results['currencyCode'];
					$booking_info["itinerary_id"]			=	$results['itinerary_number'];
					$booking_info["confirmation_number"]	=	$results['confirmation_numbers'];
					$booking_info["city"]					=	$results['hotelCity'];
					$booking_info["country_code"]			=	$results['hotelCountryCode'];
					$booking_info["is_cancelled"]			=	'0';
					$booking_info["booking_time"]			=	date('Y-m-d H:i:s');
					
					$i_newid_booked = $this->Booking_model->add_info_booking($booking_info);
					}else{
					/********************************Insert user details into the db*****************************************************/
					$this->load->model('User_model');
					$info=array();
					$info['email_address']    		=   $posted['email'];
					$info['login_email_address']    =   $posted['email'];
					$info['first_name']    			=   $posted['fname'];
					$info['last_name']    			=   $posted['lname'];
					$info['password']    			=   $posted['password'];
					
					$info['address']    			=   $posted['address'];
					$info['city']    				=   $posted['city'];
					$info['zip_code']    			=   $posted['zip'];
					$info['country_code']    		=   $posted['country'];
					
					$info["created_on"] 			= 	date("Y-m-d H:i:s");
					$info["is_active"]   			= 	'0';
					$info["lang_id"]   				= 	$this->session->userdata('Language_code');
					
					$i_newid = $this->User_model->add_user_info($info);
					if($i_newid){
					// send confirmation email to user
					$this->load->library('email'); 
					//$message = "Dear User, <p>Your Account Login Details : <br/> UserName:".$info['email_address']." <br/> password:".$info['password']." </p><br/>Team Bookingandyou.com";
$message="
<table style='width:700px; margin:0px auto; line-height:20px; background:#FFFFFF; color:#666666;font-size:12px;font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;' border='0' cellspacing='0' cellpadding='0'>

<tr>
<td style='border-top:6px solid #13b8e6;  padding-bottom:10px; text-align:right; color:#666666;'><a href=\"base_url()\"><img src=\'".base_url()."\images/logo.png' alt='logo' width='437' height='80' alt='ss' align='left'  /></a><br />&nbsp;</td>
<td></td>
</tr>
<tr>
<td style='padding:20px 0px 0px 0px;'>
<table style='padding-left:20px; font-size:14px; color:#999;' width='70%' border='0' cellspacing='6' cellpadding='6'>                       
<tr>
<td>Dear User,</td> 
</tr>
<tr>
<td>Thanks for signing up!!</td>
</tr>
<tr>
<td><b>UserName :</b> ".$info['email_address']."</td>
</tr>
<tr>
<td><b>password :</b> ".$info['password']."</td>
</tr>
<tr>
<td>Kindly make sure you use this link : <a href='http://satyajitlimited.com/booking_n_you/'>Booking And You</a></td>
</tr>
<tr>
<td><h4>Thanks,<br/> Booking And You Team</h4></td>
</tr>
</table>
<tr>
  <td style='border:1px solid #dadada; border-bottom:0px; background:#fff; padding:0px;'></td>
</tr>
<tr style='background:#CCC'>
  <td align='center' valign='middle' height='40px;'><em> &copy; Copyright 2013 by BookingandYou.com. All Rights Reserved. </em></td>
</tr>
</table>
";							   
					$email_to  = $info['email_address'];
					$email_from  = ADMIN_EMAIL;
					$this->email->from($email_from, 'Booking And You');
					$this->email->to($email_to);
					$this->email->bcc('kafil@satyajittech.com');
					$this->email->subject('Login Details :');
					$this->email->message($message);
					$this->email->send();
					
					
					$booking_info = array();
					$booking_info['user_id']  				=   $i_newid;
					$booking_info['hotel_id']  				=   $hotel_id;
					$booking_info["check_in"]				=	$results['arrivalDate'];
					$booking_info["check_out"]	    		=	$results['departureDate'];
					$booking_info["max_person"]				=	$results['numberOfAdults'];
					$booking_info["no_of_rooms"]			=	$results['number_of_rooms_booked'];
					$booking_info["rate"]					=	$results['total'];
					$booking_info["currency"]				=	$results['currencyCode'];
					$booking_info["itinerary_id"]			=	$results['itinerary_number'];
					$booking_info["confirmation_number"]	=	$results['confirmation_numbers'];
					$booking_info["city"]					=	$results['hotelCity'];
					$booking_info["country_code"]			=	$results['hotelCountryCode'];
					$booking_info["is_cancelled"]			=	'0';
					$booking_info["booking_time"]			=	date('Y-m-d H:i:s');
					
					$i_newid_booked = $this->Booking_model->add_info_booking($booking_info);
					}
					/********************************End user details into the db*****************************************************/

					}
					
				
					/*if (@$output->HotelRoomReservationResponse->ConfirmationNumbers && sizeof(@$output->HotelRoomReservationResponse->confirmationNumber) > 0)
					  {
							  for ($position = 0;$position < sizeof(@$output->HotelRoomReservationResponse->confirmationNumber);$position++)
							  {
								  $results['confirmation_numbers'][] = array(
								  'confirmation_number' => (string)@$output->HotelRoomReservationResponse->confirmationNumber[0],
								  'guest_name' => (string)@$output->GuestNames->guestName[0]
							  );
							   $position++;
						  }
					  }*/
				  }
				 //print_r( $results); exit();
				$this->session->set_userdata('booking_result', $results);
				redirect(base_url().'/booking/booking_complete/'.$hotel_id);
				/********************************End of Hotel reservation Request*****************************************************/

			}
		}
		
		//print_r($_POST);
			$search_checkout_date = $this->session->userdata('search_checkout_date');
			$search_checkin_date = $this->session->userdata('search_checkin_date');
			$mon_checkout = substr($search_checkout_date, 0, 2);
			$day_checkout = substr($search_checkout_date, 3, 2);
			$year_checkout = substr($search_checkout_date, 6);
			
			$mon_checkin = substr($search_checkin_date, 0, 2);
			$day_checkin = substr($search_checkin_date, 3, 2);
			$year_checkin = substr($search_checkin_date, 6);
			
			
			$search_checkout_date_formatted = date('l, F j, Y', strtotime($year_checkout.'-'.$mon_checkout.'-'.$day_checkout));
			$this->data['search_checkout_date_formatted'] = $search_checkout_date_formatted;
			$search_checkin_date_formatted =  date('l, F j, Y', strtotime($year_checkin.'-'.$mon_checkin.'-'.$day_checkin));
			$this->data['search_checkin_date_formatted'] = $search_checkin_date_formatted;
			$no_of_nights = (strtotime($year_checkout.'-'.$mon_checkout.'-'.$day_checkout) - strtotime($year_checkin.'-'.$mon_checkin.'-'.$day_checkin))/(60*60*24);
			$this->data['no_of_nights'] = $no_of_nights;
			
			
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
			$this->data['hotel_id'] = $hotel_id;
			$this->_renderViewFe('booking_confirm', $this->data); 
		}catch(Exception $err_obj){
			show_error($err_obj->getMessage());
	  }
	
	}
	
	function booking_complete($hotel_id=null) {
		try{
			$this->data['pageTitle'] = '::: Booking and You ::: - Booking complete details';
			$this->data['hotel_id'] = $hotel_id;
			$this->data['thumnailUrl'] = $this->Booking_model->get_thumbnailUrl($hotel_id);;
			$this->_renderViewFe('booking_complete', $this->data); 
		}catch(Exception $err_obj){
			show_error($err_obj->getMessage());
	  }
	}
	
	function booking_cancel($hotel_id=null) {
		try{$user_session_info = $this->session->userdata('LOGGEDIN_USER');
				
				if($_POST){
					
					$itineraryId = $this->input->post('txt_itinerary_id');
					$email = $this->input->post('txt_email');
					$reason = $this->input->post('txt_reason_cancel');
					$confirmationNumber = $this->input->post('txt_confirmation_number');
					$user_id=$user_session_info['user_id']; 
					/*======================Cancel Url================*/
					$url = "http://api.ean.com/ean-services/rs/hotel/v3/cancel";
					$append = "?cid=" . $this->config->item('cid');
					$append .= "&apiKey=" . '3d9au35ksren47h4mg8ahey5';
					$append .= "&customerIpAddress=" . $_SERVER['REMOTE_ADDR'];
					$append .= "&customerSessionId="; //empty for this demo, populate with Session ID from Room Availability Request
					$append .= "&minorRev=1&locale=en_US&currencyCode=USD";
					
					$xml = "<HotelRoomCancellationRequest>
						<itineraryId>".$itineraryId."</itineraryId>
						<email>".$email."</email>
						<reason>".$reason."</reason>
						<confirmationNumber>".$confirmationNumber."</confirmationNumber>
					</HotelRoomCancellationRequest>";
					
					$sendurl = $url.$append."&xml=".urlencode($xml); //important - always URLencode the XML part.
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$sendurl);
					curl_setopt($ch, CURLOPT_HEADER, false);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 65000);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Keep-Alive','Keep-Alive: 300'));
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					
					$response = json_decode(curl_exec($ch));
					$error = curl_error($ch); //collected for debugging only
					//$info = curl_getinfo($ch);
					curl_close($ch);
					if (@$response->HotelRoomCancellationResponse->EanWsError->presentationMessage)
					  {
						  $results = array(
						  'error' => ($this->string_clean_up((string)@$response->HotelRoomCancellationResponse->EanWsError->presentationMessage))
						  );
					  }
					  else{
						  $results = array();
					  }
					/*======================Cancel Url================*/
					//print_r($api_content);
					if(!empty($results))
					{
						
						 $this->session->set_flashdata('message', $results['error']);
						 redirect(base_url().'booking/booking_cancel');
					}
				
					// Update is_cancelled in booking table ........
					//$i_aff=$this->Booking_model->cancel_booking($user_id,$itineraryId);						 
				}
				$this->data['pageTitle'] = '::: Booking and You ::: - Booking cancel';
			    $this->_renderViewFe('booking_cancel', $this->data); 
		}catch(Exception $err_obj){
			show_error($err_obj->getMessage());
	  }
	}
	public function string_clean_up($string)
	{
		try{
	  		return trim(str_replace(array('&amp;','&apos;'),array('&','\''),htmlspecialchars_decode($string)));
	  }catch(Exception $err_obj){
			show_error($err_obj->getMessage());
	  }
	}
}