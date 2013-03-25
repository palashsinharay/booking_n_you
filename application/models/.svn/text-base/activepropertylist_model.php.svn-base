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

class ActivePropertyList_model extends CI_Model {

	 private $conf;
     private $tbl;///used for this class
	
	 public function __construct()
    {
        try
        {
          parent::__construct();
          $this->tbl 				= $this->db->ACTIVE_PROPERTY_LIST; 
		  $this->tbl_description 	= $this->db->PROPERTY_DESCRIPTION_LISTS;
		  $this->tbl_policy 		= $this->db->POLICY_DESCRIPTION_LISTS;
		  $this->tbl_recreation 	= $this->db->RECREATION_DESCRIPTION_LISTS;
		  $this->tbl_dining 		= $this->db->DINING_DESCRIPTION_LISTS;
		  $this->tbl_spa			= $this->db->SPA_DESCRIPTION_LISTS;
		  $this->tbl_country 		= $this->db->COUNTRIES;   
		  
          $this->conf =&get_config();
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
	
	function findMostViewed()
     {
		/*$query_sql="SELECT a.id, a.ean_hotel_id, a.name, a.address1, a.address2, a.city, a.country, a.property_currency, a.star_rating, a.low_rate, a.view_counter, h.thumbnail_url,c.country as countryname FROM booking_active_property_lists AS a LEFT JOIN booking_hotel_image_lists AS h ON a.ean_hotel_id = h.ean_hotel_id LEFT JOIN  booking_countries as c on a.country = c.country_id GROUP BY a.ean_hotel_id ORDER BY a.view_counter DESC LIMIT 0 , 2";*/
		$query_sql="SELECT a.id, a.ean_hotel_id, a.name, a.address1, a.address2, a.city, a.country, a.postal_code,  a.property_currency, a.star_rating, a.low_rate, a.view_counter, 
(select thumbnail_url from booking_hotel_image_lists where a.ean_hotel_id = ean_hotel_id limit 0,1) as thumbnail_url
,(SELECT country FROM booking_countries WHERE country_id = a.country) AS countryname FROM booking_active_property_lists AS a ORDER BY a.view_counter DESC limit 0,2";
		$query=$this->db->query($query_sql);
		$result = $query->result();
        return $result;
	 
	 }	
	 
	 function findMyViewed($My_Viewed_Val1=null)
	 {
	 	$query_sql="SELECT a.id, a.ean_hotel_id, a.name, a.address1, a.address2, a.city, a.country,  a.postal_code, a.property_currency, a.star_rating, a.low_rate, a.view_counter, 
(select thumbnail_url from booking_hotel_image_lists where a.ean_hotel_id = ean_hotel_id limit 0,1) as thumbnail_url
,(SELECT country FROM booking_countries WHERE country_id = a.country) AS countryname FROM booking_active_property_lists AS a WHERE a.ean_hotel_id in ($My_Viewed_Val1) ";
		$query=$this->db->query($query_sql);
		$result = $query->result();
        return $result;
	 }
	 
	 function findByCountry($country)
	 {
	 
	 	$query_sql="SELECT a.id, a.ean_hotel_id, a.name, a.property_currency, a.star_rating, a.low_rate, a.view_counter, a.city, a.country, (select thumbnail_url from booking_hotel_image_lists where a.ean_hotel_id = ean_hotel_id limit 0,1) as thumbnail_url FROM booking_active_property_lists AS a 
WHERE a.country LIKE '%$country%' ORDER BY a.id ASC LIMIT 0 , 5";
		$query=$this->db->query($query_sql);
		$result = $query->result();
        return $result;
	 }
	 function findCountryList($c_id)
	 {
		 
		 $query_sql="SELECT distinct(b.country_name) , b.country_code FROM booking_active_property_lists a, booking_country_lists b, booking_parent_region_lists c WHERE a.country = b.country_code
AND b.continent_id = c.region_id AND c.region_id = $c_id limit 0,20";
		$query=$this->db->query($query_sql);
		$result = $query->result();
        return $result;
	}
	function findCountryAll($c_id)
	 {
		 
		 $query_sql="SELECT distinct(b.country_name) , b.country_code FROM booking_active_property_lists a, booking_country_lists b, booking_parent_region_lists c WHERE a.country = b.country_code
AND b.continent_id = c.region_id AND c.region_id = $c_id ";
		$query=$this->db->query($query_sql);
		$result = $query->result();
        return $result;
	}
	 function findCurrency($city)
	 {
		$query_sql="SELECT property_currency FROM booking_active_property_lists WHERE city LIKE '%$city%' limit 0,1 ";
		$query=$this->db->query($query_sql);
		$result = $query->result();
        return $result;
	}
	function findCurrencyByHotelId($id)
	 {
		$query_sql="SELECT property_currency FROM booking_active_property_lists WHERE ean_hotel_id = '$id' ";
		$query=$this->db->query($query_sql);
		$result = $query->result();
        return $result;
	}
	function findImageByHotelId($hotel_id)
	 {
		$query_sql="select h.url from booking_hotel_image_lists h where h.ean_hotel_id = '$hotel_id' limit 0,1 ";
		$query=$this->db->query($query_sql);
		$result = $query->result();
        return $result;
	}
	############################################################################################################################################
	public function fetch_multi($s_where=null,$i_start=null,$i_limit=null)
    {
        try
        {
          	$ret_=array();
            $s_qry="SELECT n.*, c.country as country_name, d.property_description , p.section_type_id, p.policy_description,
					 r.recreation_description, din.dining_description, s.spa_description
					 FROM ".$this->tbl." n  LEFT JOIN " .$this->tbl_country." c  ON n.country = c.country_id LEFT JOIN "
					  .$this->tbl_description." d  ON n.ean_hotel_id = d.ean_hotel_id AND n.language_code = d.language_code LEFT JOIN "
					  .$this->tbl_policy." p  ON n.ean_hotel_id = p.ean_hotel_id LEFT JOIN "
					  .$this->tbl_recreation." r  ON n.ean_hotel_id = r.ean_hotel_id LEFT JOIN "
					  .$this->tbl_dining." din  ON n.ean_hotel_id = din.ean_hotel_id LEFT JOIN " 
					  .$this->tbl_spa." s  ON n.ean_hotel_id = s.ean_hotel_id " 
					
					.($s_where!=""?$s_where:"" ).(is_numeric($i_start) && is_numeric($i_limit)?
					"Limit ".intval($i_start).",".intval($i_limit):"" );
          $rs=$this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                  $ret_[$i_cnt]["id"]=$row->id;////always integer
                  $ret_[$i_cnt]["ean_hotel_id"]=intval($row->ean_hotel_id); 
                  $ret_[$i_cnt]["language_code"]=stripslashes(htmlspecialchars_decode($row->language_code)); 
				  $ret_[$i_cnt]["sequence_number"]=intval($row->sequence_number); 
				  $ret_[$i_cnt]["name"]=stripslashes(htmlspecialchars_decode($row->name)); 
				  $ret_[$i_cnt]["property_description"]=stripslashes(htmlspecialchars_decode($row->property_description)); 
				  $ret_[$i_cnt]["address1"]=stripslashes(htmlspecialchars_decode($row->address1)); 
				  $ret_[$i_cnt]["address2"]=stripslashes(htmlspecialchars_decode($row->address2)); 
				  $ret_[$i_cnt]["city"]=stripslashes(htmlspecialchars_decode($row->city)); 
				  $ret_[$i_cnt]["state_province"]=stripslashes(htmlspecialchars_decode($row->state_province)); 
				  $ret_[$i_cnt]["postal_code"]=intval($row->postal_code); 
				  $ret_[$i_cnt]["country"]=stripslashes(htmlspecialchars_decode($row->country));
				  $ret_[$i_cnt]["star_rating"]=stripslashes(htmlspecialchars_decode($row->star_rating));
				  $ret_[$i_cnt]["country_name"]=stripslashes(htmlspecialchars_decode($row->country_name));  
				  $ret_[$i_cnt]["latitude"]=($row->latitude); 
				  $ret_[$i_cnt]["longitude"]=($row->longitude); 
				  $ret_[$i_cnt]["airport_code"]=stripslashes(htmlspecialchars_decode($row->airport_code)); 
				  $ret_[$i_cnt]["property_category"]=intval($row->property_category); 
				  $ret_[$i_cnt]["property_currency"]=stripslashes(htmlspecialchars_decode($row->property_currency)); 
				  $ret_[$i_cnt]["star_rating"]=($row->star_rating); 
				  $ret_[$i_cnt]["confidence"]=($row->confidence); 
				  $ret_[$i_cnt]["supplier_type"]=intval($row->supplier_type); 
				  $ret_[$i_cnt]["location"]=stripslashes(htmlspecialchars_decode($row->location)); 
				  $ret_[$i_cnt]["chain_code_id"]=intval($row->chain_code_id); 
				  $ret_[$i_cnt]["region_id"]=intval($row->region_id); 
				  $ret_[$i_cnt]["high_rate"]=($row->high_rate); 
				  $ret_[$i_cnt]["low_rate"]=($row->low_rate); 
				  $ret_[$i_cnt]["check_in_time"]=stripslashes(htmlspecialchars_decode($row->check_in_time)); 
				  $ret_[$i_cnt]["check_out_time"]=stripslashes(htmlspecialchars_decode($row->check_out_time)); 
				  $ret_[$i_cnt]["view_counter"]=intval($row->view_counter);
				  $ret_[$i_cnt]["section_type_id"]=stripslashes(htmlspecialchars_decode($row->section_type_id)); 
				  $ret_[$i_cnt]["policy_description"]=stripslashes(htmlspecialchars_decode($row->policy_description)); 
                  $ret_[$i_cnt]["recreation_description"]=stripslashes(htmlspecialchars_decode($row->recreation_description)); 
				  $ret_[$i_cnt]["dining_description"]=stripslashes(htmlspecialchars_decode($row->dining_description));
				  $ret_[$i_cnt]["spa_description"]=stripslashes(htmlspecialchars_decode($row->spa_description));
				  
                  $i_cnt++;
              }    
              $rs->free_result();          
          }
          unset($s_qry,$rs,$row,$i_cnt,$s_where,$i_start,$i_limit, $s_desc);
          return $ret_;
          
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
##################################################################################################################################
	/****
    * Fetch Total records
    */
    public function gettotal_info($s_where=null)
    {
        try
        {
          $ret_=0;
          $s_qry="Select count(*) as i_total "
                	."FROM ".$this->tbl." n  "
                .($s_where!=""?$s_where:"" );				
          $rs=$this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                  $ret_=intval($row->i_total); 
              }    
              $rs->free_result();          
          }
          unset($s_qry,$rs,$row,$i_cnt,$s_where,$i_start,$i_limit);
          return $ret_;
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }           
    }         
#################################################################################################################################
	public function fetch_property_type_list($s_where=null,$order_name,$order_by)
    {
        try
        {
          	$ret_=array();
          	$s_qry="SELECT a.property_category, p.property_category_desc FROM  booking_active_property_lists a, booking_property_type_lists p  
			WHERE a.property_category = p.property_category and p.language_code = 'en_US' " .($s_where!=""?$s_where:"" ).
			" group by  a.property_category  "
					." ORDER BY {$order_name} {$order_by}";
          $rs=$this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                  $ret_[$i_cnt]["property_category"]=intval($row->property_category); 
				  $ret_[$i_cnt]["property_category_desc"]=stripslashes(htmlspecialchars_decode($row->property_category_desc));
                  $i_cnt++;
              }    
              $rs->free_result();          
          }
         unset($s_qry,$rs,$row,$i_cnt,$s_where,$i_start,$i_limit, $s_desc);
          return $ret_;
          
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
##################################################################################################################################
##################################################################################################################################
	public function fetch_property_list_starrate($s_where=null,$order_name,$order_by)
    {
        try
        {
          	$ret_=array();
            $s_qry="SELECT a.star_rating FROM  booking_active_property_lists a
					WHERE " .($s_where!=""?$s_where:"" ) .
					" GROUP BY a.star_rating ORDER BY {$order_name} {$order_by} ";
          $rs=$this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                  $ret_[$i_cnt]["star_rating"]=($row->star_rating); 
                  $i_cnt++;
              }    
              $rs->free_result();          
          }
         unset($s_qry,$rs,$row,$i_cnt,$s_where,$i_start,$i_limit, $s_desc);
          return $ret_;
          
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
	#################################################################################################################################################
	#################################################################################################################################################
	public function fetch_property_list_chaincode($s_where=null,$order_name,$order_by)
    {
        try
        {
          	$ret_=array();
          	$s_qry="SELECT a.chain_code_id,  c.chain_name FROM  booking_active_property_lists a,  booking_chain_lists c  
			WHERE a.chain_code_id = c.chain_code_id " .($s_where!=""?$s_where:"" ).
			" group by  a.chain_code_id  "
					." ORDER BY {$order_name} {$order_by}";
          $rs=$this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                  $ret_[$i_cnt]["chain_code_id"]=intval($row->chain_code_id); 
				  $ret_[$i_cnt]["chain_name"]=stripslashes(htmlspecialchars_decode($row->chain_name));
                  $i_cnt++;
              }    
              $rs->free_result();          
          }
         unset($s_qry,$rs,$row,$i_cnt,$s_where,$i_start,$i_limit, $s_desc);
          return $ret_;
          
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
	#################################################################################################################################################
	
	
	// TOTAL NUMBER OF HOTELS
	
	#################################################################################################################################################
	public function get_total_hotels()
    {
        try
        {
			$this->query = $this->db->select('count(`ean_hotel_id`) as no_of_hotels')->from('booking_active_property_lists')->get();
			$total_hotels=$this->query->row_array();
			//print_r($total_hotels);
			return $total_hotels;
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
	#################################################################################################################################################

	
	
		// TOTAL NUMBER OF COUNTRY
	
	#################################################################################################################################################
	public function get_total_country()
    {
        try
        { 
			$this->query = $this->db->select('count(distinct `country`) as no_of_country')->from('booking_active_property_lists')->get();
			$total_country=$this->query->row_array();
			//print_r($total_hotels);
			return $total_country;
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
	#################################################################################################################################################







##################### Get Reviews details from booking_my_account_my_review,booking_active_property_lists,booking_hotel_image_lists   ##########################
public function get_reviews($hotel_id)
{
    try
    { 
	  $ret_=array();
      //$s_qry="SELECT bmamr.review_score,bmamr.review_comments,bapl.name,bapl.address1,bapl.star_rating,bhil.thumbnail_url FROM booking_my_account_my_review bmamr,booking_active_property_lists bapl,booking_hotel_image_lists bhil WHERE bmamr.hotel_id = '".$hotel_id."' AND bmamr.is_active ='0' AND bmamr.`hotel_id`=bapl.ean_hotel_id AND bhil.ean_hotel_id=bapl.ean_hotel_id LIMIT 0, 10";
      $s_qry="SELECT a.name, a.address1, a.address2, a.city, a.country, a.star_rating, (SELECT thumbnail_url FROM booking_hotel_image_lists WHERE a.ean_hotel_id = ean_hotel_id LIMIT 0 , 1) AS thumbnail_url, (SELECT country FROM booking_countries WHERE country_id = a.country) AS countryname,  r.user_id, r.review_score, r.review_comments, (SELECT CONCAT(first_name,' ', last_name) FROM booking_users WHERE id = r.user_id)  AS username FROM booking_active_property_lists a LEFT JOIN booking_my_account_my_review r ON a.ean_hotel_id = r.hotel_id WHERE a.ean_hotel_id = '".$hotel_id."' ORDER BY review_score DESC  LIMIT 0 , 5";
      $rs=$this->db->query($s_qry);
      $i_cnt=0;
      if($rs->num_rows()>0)
      {
          foreach($rs->result() as $row)
          {
			  $ret_[$i_cnt]["review_score"]=($row->review_score); 
			  $ret_[$i_cnt]["review_comments"]=($row->review_comments); 
			  $ret_[$i_cnt]["name"]=($row->name);
              $ret_[$i_cnt]["address1"]=($row->address1);
              $ret_[$i_cnt]["address2"]=($row->address2);
			  $ret_[$i_cnt]["city"]=($row->city);
			  $ret_[$i_cnt]["star_rating"]=($row->star_rating);
              $ret_[$i_cnt]["thumbnail_url"]=($row->thumbnail_url); 
              $ret_[$i_cnt]["countryname"]=($row->countryname); 
              $ret_[$i_cnt]["username"]=($row->username); 
			  
              $i_cnt++;
          }    
          $rs->free_result();          
      }
      unset($s_qry,$rs,$row,$i_cnt,$s_where,$i_start,$i_limit, $s_desc);
      return $ret_;
      
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }          
}
#################################################################################################################################################



	
	
}