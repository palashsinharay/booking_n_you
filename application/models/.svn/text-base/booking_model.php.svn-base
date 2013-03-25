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

class Booking_model extends CI_Model {

	
	 private $conf;
     private $tbl;///used for this class
	
	 public function __construct()
    {
        try
        {
          parent::__construct();
          $this->tbl 			= $this->db->USERS;  
		  $this->tbl_booking 	= $this->db->MY_BOOKING_DETAILS; 
		  $this->tbl_property 	= $this->db->ACTIVE_PROPERTY_LIST; 
          $this->conf =&get_config();
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
############# Book Now Insert function Start #############	

	public function booking_add_info($hotel_info,$user_session_info)
    {
        try
        {
			$i_ret_=0; ////Returns false
            if(!empty($hotel_info))
            {
                //$s_qry="Insert Into ".$this->tbl." Set ";
				$s_qry="Insert Into  booking_my_booking_details Set ";
                $s_qry.=" user_id=? ";
                $s_qry.=", hotel_id=? ";
                $s_qry.=", check_in=? ";
				$s_qry.=", check_out=? ";
                $s_qry.=", booking_time=? ";
                
              $this->db->query($s_qry,array(
			  trim($user_session_info["user_id"]),
              trim($hotel_info["ean_hotel_id"]),
              trim($hotel_info["check_in_time"]),
			  trim($hotel_info["check_out_time"]),
			  $hotel_info["created_on"]
             ));
               // echo $this->db->last_query();
				$i_ret_=$this->db->insert_id();     
                
            }
            unset($s_qry, $info );
            return $i_ret_;
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }

############# Book Now Insert function End #############

	public function add_info_booking($booking_info)
    {
        try
        {
            $i_ret_=0; ////Returns false
            if(!empty($booking_info))
            {
                $s_qry="Insert Into ".$this->tbl_booking." Set ";
                $s_qry.=" user_id=? ";
                $s_qry.=", hotel_id=? ";
                $s_qry.=", check_in=? ";
                $s_qry.=", check_out=? ";
				$s_qry.=", max_person=? ";
				$s_qry.=", no_of_rooms=? ";
				$s_qry.=", rate=? ";
				$s_qry.=", currency=? ";
				$s_qry.=", itinerary_id=? ";
				$s_qry.=", confirmation_number=? ";
				$s_qry.=", city=? ";
				$s_qry.=", country_code=? ";
				$s_qry.=", is_cancelled=? ";
				$s_qry.=",  booking_time=? ";
                
                $this->db->query($s_qry,array(
												  intval($booking_info["user_id"]),
												  intval($booking_info["hotel_id"]),
												  trim(htmlspecialchars($booking_info["check_in"])),
												  trim(htmlspecialchars($booking_info["check_out"])),
												  intval($booking_info["max_person"]),
												  intval($booking_info["no_of_rooms"]),
												  $booking_info["rate"],
												  trim(htmlspecialchars($booking_info["currency"])),
												  trim(htmlspecialchars($booking_info["itinerary_id"])),
												  trim(htmlspecialchars($booking_info["confirmation_number"])),
												  trim(htmlspecialchars($booking_info["city"])),
												  trim(htmlspecialchars($booking_info["country_code"])),
												  $booking_info["is_cancelled"],
												  $booking_info["booking_time"]
												 ));
				/*echo $this->db->last_query();
				die();*/								 
                $i_ret_=$this->db->insert_id();     
                
            }
            unset($s_qry, $booking_info );
            return $i_ret_;
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }            
	
	function get_thumbnailUrl($hotel_id=null){
		try{
			$s_qry="select thumbnail_url from booking_hotel_image_lists where ean_hotel_id = '".$hotel_id."' ";
            $rs=$this->db->query($s_qry);
			if($rs->num_rows()>0)
			  {
				  foreach($rs->result() as $row)
				  {
					  $thumnailUrl=$row->thumbnail_url; 
				  }    
				  return $thumnailUrl;     
			  }
			
		 }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
		
	}
	function get_hotelIds($s_where=null){
		try{
			$hotel_id = array();
			$s_qry="SELECT hotel_id FROM booking_my_booking_details WHERE booking_time BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() AND ".$s_where." ORDER BY booking_time DESC LIMIT 0 , 3 ";
            $rs=$this->db->query($s_qry);
			if($rs->num_rows()>0)
			  {
				  foreach($rs->result() as $row)
				  {
					  $hotel_id[]=$row->hotel_id; 
				  }    
				  return $hotel_id;     
			  }
			
		 }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
		
	}
	public function fetch_multi_sorted_list($s_where=null,$order_name,$order_by,$i_start=null,$i_limit=null)
    {
        try
        {
          	$ret_=array();
			$s_qry="SELECT n.*, p.name as hotelname, CONCAT(u.first_name,' ',u.last_name) as username FROM ".$this->tbl_booking." n "
					." LEFT JOIN " .$this->tbl_property." p  ON n.hotel_id = p.ean_hotel_id "
					." LEFT JOIN " .$this->tbl." u  ON n.user_id = u.id "
                .($s_where!=""?$s_where:"" )." ORDER BY {$order_name} {$order_by}".(is_numeric($i_start) && is_numeric($i_limit)?" Limit ".intval($i_start).",".intval($i_limit):"" );
          $rs = $this->db->query("SET NAMES 'utf8'");  
		  $rs = $this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                $ret_[$i_cnt]["id"]=$row->id;////always integer
				$ret_[$i_cnt]["user_id"]=intval($row->user_id);
				$ret_[$i_cnt]["hotel_id"]=intval($row->hotel_id);
                $ret_[$i_cnt]["check_in"]=stripslashes($row->check_in);
				$ret_[$i_cnt]["check_out"]=stripslashes($row->check_out);
                $ret_[$i_cnt]["max_person"]=intval($row->max_person);
				$ret_[$i_cnt]["no_of_rooms"]=intval($row->no_of_rooms);
				$ret_[$i_cnt]["rate"]=$row->rate;
				$ret_[$i_cnt]["currency"]=stripslashes($row->currency);
				$ret_[$i_cnt]["itinerary_id"]=stripslashes($row->itinerary_id);
				$ret_[$i_cnt]["confirmation_number"]=stripslashes($row->confirmation_number);
				$ret_[$i_cnt]["city"]=stripslashes($row->city);
				$ret_[$i_cnt]["country_code"]=stripslashes($row->country_code);
				$ret_[$i_cnt]["is_cancelled"]=$row->is_cancelled;
				$ret_[$i_cnt]["booking_time"]=date('d/m/Y',strtotime($row->booking_time));
				
				$ret_[$i_cnt]["hotelname"]=stripslashes($row->hotelname);
				$ret_[$i_cnt]["username"]=stripslashes($row->username);
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
	/****
    * Fetch Total records
    * @param string $s_where, ex- " status=1 AND deleted=0 " 
    * @returns int on success and FALSE if failed 
    */
    public function gettotal_info($s_where=null)
    {
        try
        {
          $ret_=0;
          $s_qry="Select count(*) as i_total "
                ."From ".$this->tbl_booking." n "
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
	
		    /*******
    * Fetches One record from db for the id value.
    * 
    * @param int $i_id
    * @returns array
    */
    public function fetch_this($i_id)
    {
        try
        {
          $ret_=array();
          ////Using Prepared Statement///
          $s_qry=" SELECT n.*, p.name as hotelname, CONCAT(u.first_name,' ',u.last_name) as username "
                ."From ".$this->tbl_booking." AS n "
				." LEFT JOIN " .$this->tbl_property." p  ON n.hotel_id = p.ean_hotel_id "
				." LEFT JOIN " .$this->tbl." u  ON n.user_id = u.id "
                ." Where n.id=?";
                
          $rs=$this->db->query($s_qry,array(intval($i_id))); 
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
				  
				$ret_["id"]=$row->id;////always integer
				$ret_["user_id"]=intval($row->user_id);
				$ret_["hotel_id"]=intval($row->hotel_id);
                $ret_["check_in"]=stripslashes($row->check_in);
				$ret_["check_out"]=stripslashes($row->check_out);
                $ret_["max_person"]=intval($row->max_person);
				$ret_["no_of_rooms"]=intval($row->no_of_rooms);
				$ret_["rate"]=$row->rate;
				$ret_["currency"]=stripslashes($row->currency);
				$ret_["itinerary_id"]=stripslashes($row->itinerary_id);
				$ret_["confirmation_number"]=stripslashes($row->confirmation_number);
				$ret_["city"]=stripslashes($row->city);
				$ret_["country_code"]=stripslashes($row->country_code);
				$ret_["is_cancelled"]=($row->is_cancelled)=='0'?"Active":"Cancelled";
				$ret_["booking_time"]=date('d/m/Y',strtotime($row->booking_time));
				
				$ret_["hotelname"]=stripslashes($row->hotelname);
				$ret_["username"]=stripslashes($row->username);
		  
              }    
              $rs->free_result();          
          }
          unset($s_qry,$rs,$row,$i_id);
          return $ret_;
          
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }
    }       
     /***
    * Logical delete records in db. As we know the table name 
    * we will not pass it into params.
    * 
    * @param array $info, array of fields(as key) with values,ex-$arr["field_name"]=value
    * @param int $i_id, id value to be updated used in where clause
    * @returns $i_rows_affected  on success and FALSE if failed 
    */    
	function delete($id)
    {
		$this->db->where('id', $id);
		$this->db->delete($this->tbl); 
		return true;
    }

}