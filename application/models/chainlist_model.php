<?php

/*
| ----------------------------------------------
| Start Date : 18-11-2010
|
| Framework : CodeIgniter
|
| ----------------------------------------------
| Model BCMS
| ----------------------------------------------
*/

class ChainList_model extends CI_Model {

	public $_table = 'ActivePropertyList';
	public $result = null;

	function __construct()
	{
		//parent::Model();
		parent::__construct();
	}
	
	function findMostViewed()
     {
		/*$query_sql="SELECT a.id, a.ean_hotel_id, a.name, a.address1, a.address2, a.city, a.country, a.property_currency, a.star_rating, a.low_rate, a.view_counter, h.thumbnail_url,c.country as countryname FROM booking_active_property_lists AS a LEFT JOIN booking_hotel_image_lists AS h ON a.ean_hotel_id = h.ean_hotel_id LEFT JOIN  booking_countries as c on a.country = c.country_id GROUP BY a.ean_hotel_id ORDER BY a.view_counter DESC LIMIT 0 , 2";*/
		$query_sql="SELECT a.id, a.ean_hotel_id, a.name, a.address1, a.address2, a.city, a.country, a.postal_code,  a.property_currency, a.star_rating, a.low_rate, a.view_counter, 
(select thumbnail_url from booking_hotel_image_lists where a.ean_hotel_id = ean_hotel_id limit 0,1) as thumbnail_url
,(SELECT country FROM booking_countries WHERE country_id = a.country) AS countryname FROM booking_active_property_lists AS a ORDER BY a.view_counter DESC limit 0,2";
		$result=$this->db->query($query_sql);
         return $result;
	 
	 }	
	 
	 function findMyViewed($My_Viewed_Val1=null)
	 {
	 	$query_sql="SELECT a.id, a.ean_hotel_id, a.name, a.address1, a.address2, a.city, a.country,  a.postal_code, a.property_currency, a.star_rating, a.low_rate, a.view_counter, 
(select thumbnail_url from booking_hotel_image_lists where a.ean_hotel_id = ean_hotel_id limit 0,1) as thumbnail_url
,(SELECT country FROM booking_countries WHERE country_id = a.country) AS countryname FROM booking_active_property_lists AS a WHERE a.ean_hotel_id in ($My_Viewed_Val1) ";
		$result=$this->db->query($query_sql);
         return $result;
	 }
	 
	 function findByCountry($country)
	 {
	 
	 	$query_sql="
		SELECT a.id, a.ean_hotel_id, a.name, a.property_currency, a.star_rating, a.low_rate, a.view_counter, a.city, a.country, (select thumbnail_url from booking_hotel_image_lists where a.ean_hotel_id = ean_hotel_id limit 0,1) as thumbnail_url FROM booking_active_property_lists AS a 
WHERE a.country LIKE '%$country%' ORDER BY a.city ASC LIMIT 0 , 5";
		$result=$this->db->query($query_sql);
         return $result;
	 }
	 function findCountryList($c_id)
	 {
		 
		 $query_sql="SELECT distinct(b.country_name) , b.country_code FROM booking_active_property_lists a, booking_country_lists b, booking_parent_region_lists c WHERE a.country = b.country_code
AND b.continent_id = c.region_id AND c.region_id = $c_id limit 0,20";
		$result=$this->db->query($query_sql);
         return $result;
	}
	function findCountryAll($c_id)
	 {
		 
		 $query_sql="SELECT distinct(b.country_name) , b.country_code FROM booking_active_property_lists a, booking_country_lists b, booking_parent_region_lists c WHERE a.country = b.country_code
AND b.continent_id = c.region_id AND c.region_id = $c_id ";
		$result=$this->db->query($query_sql);
         return $result;
	}
	 function findCurrency($city)
	 {
		$query_sql="SELECT property_currency FROM booking_active_property_lists WHERE city LIKE '%$city%' limit 0,1 ";
		$result=$this->db->query($query_sql);
         return $result;
	}
	function findCurrencyByHotelId($id)
	 {
		$query_sql="SELECT property_currency FROM booking_active_property_lists WHERE ean_hotel_id = '$id' ";
		$result=$this->db->query($query_sql);
         return $result;
	}
	function findImageByHotelId($hotel_id)
	 {
		$query_sql="select h.url from booking_hotel_image_lists h where h.ean_hotel_id = '$hotel_id' limit 0,1 ";
		$result=$this->db->query($query_sql);
         return $result;
	}


}