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

class Destination_model extends CI_Model {

	
	 private $conf;
     private $tbl;///used for this class
	
	 public function __construct()
    {
        try
        {
          parent::__construct();
          $this->tbl = $this->db->HOTEL_DESTINATIONS;  
		  $this->tbl_country = $this->db->COUNTRIES;   
          $this->conf =&get_config();
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
	
	
	public function fetch_multi($s_where=null,$i_start=null,$i_limit=null)
    {
        try
        {
          	$ret_=array();
          	$s_qry="SELECT n.*, c.country FROM ".$this->tbl." n 
					LEFT JOIN ".$this->tbl_country." c ON n.country_code = c.country_id "
					.($s_where!=""?$s_where:"" ).(is_numeric($i_start) && is_numeric($i_limit)?
					" Limit ".intval($i_start).",".intval($i_limit):"" );
          $rs=$this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                  $ret_[$i_cnt]["id"]=$row->id;////always integer
                  $ret_[$i_cnt]["destination_id"]=stripslashes($row->destination_id); 
				  $ret_[$i_cnt]["type"]=stripslashes($row->type);
				  $ret_[$i_cnt]["city"]=stripslashes($row->city);
				  $ret_[$i_cnt]["state_province_code"]=stripslashes($row->state_province_code);
				  $ret_[$i_cnt]["country_code"]=stripslashes($row->country_code);
				  $ret_[$i_cnt]["country"]=stripslashes($row->country);
				  $ret_[$i_cnt]["address"]=stripslashes($row->address);
				  $ret_[$i_cnt]["postal_code"]=stripslashes($row->postal_code);
				  $ret_[$i_cnt]["destination_string"]=($row->destination_string);
				  $ret_[$i_cnt]["destination_img"]=stripslashes($row->destination_img);
				  $ret_[$i_cnt]["is_featured"]=($row->is_featured);
				  $ret_[$i_cnt]["is_topten"]=($row->is_topten);
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

	function hotel_by_city($city=null, $current_lang=null)
     {
	 	try{
			  $ret_=array();
			  $s_qry="SELECT a.id, a.ean_hotel_id, a.name, a.property_currency, a.star_rating, a.low_rate, a.view_counter, a.city, a.country, (select thumbnail_url from booking_hotel_image_lists where a.ean_hotel_id = ean_hotel_id limit 0,1) as thumbnail_url FROM booking_active_property_lists AS a
	WHERE a.language_code = '$current_lang' AND a.city LIKE '%$city%' ORDER BY a.view_counter DESC LIMIT 0 , 5";
			  $rs=$this->db->query($s_qry);
			  $i_cnt=0;
			  if($rs->num_rows()>0)
			  {
				  foreach($rs->result() as $row)
				  {
					  $ret_[$i_cnt]["id"]=$row->id;////always integer
					  $ret_[$i_cnt]["ean_hotel_id"]=intval($row->ean_hotel_id); 
					  $ret_[$i_cnt]["name"]=stripslashes($row->name);
					  $ret_[$i_cnt]["property_currency"]=stripslashes($row->property_currency);
					  $ret_[$i_cnt]["star_rating"]=($row->star_rating);
					  $ret_[$i_cnt]["low_rate"]=($row->low_rate);
					  $ret_[$i_cnt]["view_counter"]=intval($row->view_counter);
					  $ret_[$i_cnt]["city"]=stripslashes($row->city);
					  $ret_[$i_cnt]["country"]=stripslashes($row->country);
					  $ret_[$i_cnt]["thumbnail_url"]=stripslashes($row->thumbnail_url);
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
	 
	 function hotel_by_id($Hotel_Id=null)
     {
	 	try{
			 $ret_=array();
			  $s_qry="SELECT a.id, a.ean_hotel_id, a.name, a.address1,  a.city, a.state_province, a.postal_code, a.country, a.property_currency, a.star_rating, a.low_rate, a.view_counter, a.city, a.country, (select thumbnail_url from booking_hotel_image_lists where a.ean_hotel_id = ean_hotel_id limit 0,1) as thumbnail_url FROM booking_active_property_lists AS a
	WHERE a.ean_hotel_id = '".$Hotel_Id."' ";
			  $rs=$this->db->query($s_qry);
			  if($rs->num_rows()>0)
			  {
				  foreach($rs->result() as $row)
				  {
					$ret_["id"]=$row->id;////always integer
					$ret_["ean_hotel_id"]=intval($row->ean_hotel_id); 
					$ret_["name"]=stripslashes($row->name);
					$ret_["address1"]=stripslashes($row->address1);
					$ret_["city"]=stripslashes($row->city);
					$ret_["state_province"]=stripslashes($row->state_province);
					$ret_["postal_code"]=intval($row->postal_code);
					$ret_["country"]=stripslashes($row->country);
					$ret_["property_currency"]=stripslashes($row->property_currency);
					$ret_["star_rating"]=($row->star_rating);
					$ret_["low_rate"]=($row->low_rate);
					$ret_["view_counter"]=intval($row->view_counter);
					$ret_["city"]=stripslashes($row->city);
					$ret_["country"]=stripslashes($row->country);
					$ret_["thumbnail_url"]=stripslashes($row->thumbnail_url);
				  }    
				  $rs->free_result();          
			  }
			  unset($s_qry,$rs,$row,$s_where,$i_start,$i_limit, $s_desc);
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
                ."From ".$this->tbl." n "
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
	 /****
    * Fetch Total records as a multisotred array
    * @param string $s_where, ex- " status=1 AND deleted=0 " 
    * @returns int on success and FALSE if failed 
    */
	public function fetch_multi_sorted_list($s_where=null,$order_name,$order_by,$i_start=null,$i_limit=null)
    {
        try
        {
          	$ret_=array();
			$s_qry="SELECT * FROM ".$this->tbl." n "
                .($s_where!=""?$s_where:"" )." ORDER BY {$order_name} {$order_by}".(is_numeric($i_start) && is_numeric($i_limit)?" Limit ".intval($i_start).",".intval($i_limit):"" );
          $rs = $this->db->query("SET NAMES 'utf8'");  
		  $rs = $this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                $ret_[$i_cnt]["id"]=$row->id;////always integer
				$ret_[$i_cnt]["destination_id"]=stripslashes(htmlspecialchars_decode($row->destination_id));
                $ret_[$i_cnt]["type"]=$row->type;
			    $ret_[$i_cnt]["city"]=stripslashes($row->city);
				$ret_[$i_cnt]["state_province_code"]=stripslashes($row->state_province_code);
				$ret_[$i_cnt]["country_code"]=stripslashes($row->country_code);
				$ret_[$i_cnt]["address"]=stripslashes($row->address);
				$ret_[$i_cnt]["postal_code"]=stripslashes($row->postal_code);
				$ret_[$i_cnt]["destination_string"]=stripslashes($row->destination_string);
				$ret_[$i_cnt]["destination_img"]=stripslashes($row->destination_img);
                $ret_[$i_cnt]["is_featured"]=$row->is_featured;
				$ret_[$i_cnt]["is_topten"]=$row->is_topten;
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
    /***
    * Inserts new records into db. As we know the table name 
    * we will not pass it into params.
    * 
    * @param array $info, array of fields(as key) with values,ex-$arr["field_name"]=value
    * @returns $i_new_id  on success and FALSE if failed 
    */
    public function add_info($info)
    {
        try
        {
            $i_ret_=0; ////Returns false
            if(!empty($info))
            {
                $s_qry="Insert Into ".$this->tbl." Set ";
                $s_qry.=" destination_id=? ";
                $s_qry.=", type=? ";
				$s_qry.=", city=? ";
				$s_qry.=", state_province_code=? ";
				$s_qry.=", country_code=? ";
				$s_qry.=", address=? ";
				$s_qry.=", postal_code=? ";
				$s_qry.=", destination_string=? ";
				$s_qry.=", destination_img=? ";
				$s_qry.=", is_featured=? ";
                $s_qry.=", is_topten=? ";
                
                $this->db->query($s_qry,array(
													trim(htmlspecialchars($info["destination_id"], ENT_QUOTES, 'utf-8')),
													trim(htmlspecialchars($info["type"], ENT_QUOTES, 'utf-8')),
													trim(htmlspecialchars($info["city"], ENT_QUOTES, 'utf-8')),
													trim(htmlspecialchars($info["state_province_code"])),
													trim(htmlspecialchars($info["country_code"], ENT_QUOTES, 'utf-8')),
													trim(htmlspecialchars($info["address"], ENT_QUOTES, 'utf-8')),
													trim(htmlspecialchars($info["postal_code"], ENT_QUOTES, 'utf-8')),
													trim(htmlspecialchars($info["destination_string"])),
													trim(htmlspecialchars($info["destination_img"], ENT_QUOTES, 'utf-8')),
													$info["is_featured"],
												    $info["is_topten"]
												 ));
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
	 /***
    * Update records in db. As we know the table name 
    * we will not pass it into params.
    * 
    * @param array $info, array of fields(as key) with values,ex-$arr["field_name"]=value
    * @param int $i_id, id value to be updated used in where clause
    * @returns $i_rows_affected  on success and FALSE if failed 
    */
    public function edit_info($info,$i_id)
    {
        try
        {
            $i_ret_=0;////Returns false
            if(!empty($info))
            {
                $s_qry	="Update ".$this->tbl." Set ";
				$s_qry.=" destination_id=? ";
                $s_qry.=", type=? ";
				$s_qry.=", city=? ";
				$s_qry.=", state_province_code=? ";
				$s_qry.=", country_code=? ";
				$s_qry.=", address=? ";
				$s_qry.=", postal_code=? ";
				$s_qry.=", destination_string=? ";
				$s_qry.=", destination_img=? ";
				$s_qry.=", is_featured=? ";
                $s_qry.=", is_topten=? ";
                $s_qry.=" Where id=? ";
                
                $this->db->query($s_qry,array(
												trim(htmlspecialchars($info["destination_id"], ENT_QUOTES, 'utf-8')),
												trim(htmlspecialchars($info["type"], ENT_QUOTES, 'utf-8')),
												trim(htmlspecialchars($info["city"], ENT_QUOTES, 'utf-8')),
												trim(htmlspecialchars($info["state_province_code"])),
												trim(htmlspecialchars($info["country_code"], ENT_QUOTES, 'utf-8')),
												trim(htmlspecialchars($info["address"], ENT_QUOTES, 'utf-8')),
												trim(htmlspecialchars($info["postal_code"], ENT_QUOTES, 'utf-8')),
												trim(htmlspecialchars($info["destination_string"])),
												trim(htmlspecialchars($info["destination_img"], ENT_QUOTES, 'utf-8')),
												$info["is_featured"],
												$info["is_topten"],
												intval($i_id)

                                                     ));
                $i_ret_=$this->db->affected_rows();   
                                                            
            }
            unset($s_qry, $info,$i_id);
            return $i_ret_;
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }            
	/***
    *  delete records in db. As we know the table name 
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
?>