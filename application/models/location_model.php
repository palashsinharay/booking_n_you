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

class Location_model extends CI_Model {

	 private $conf;
     private $tbl;///used for this class
	
	 public function __construct()
    {
        try
        {
          parent::__construct();
          $this->tbl = $this->db->CITY_COORDINATES_LISTS;   
          $this->tbl_destination = $this->db->DESTINATION_DETAILS;
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
          	$s_qry="SELECT * 
					FROM ".$this->tbl." n "
					.($s_where!=""?$s_where:"" ).(is_numeric($i_start) && is_numeric($i_limit)?
					"Limit ".intval($i_start).",".intval($i_limit):"" );
          $rs=$this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                  $ret_[$i_cnt]["id"]=$row->id;////always integer
                  $ret_[$i_cnt]["region_id"]=intval($row->region_id); 
                  $ret_[$i_cnt]["region_name"]=str_replace("'","",stripslashes($row->region_name)); 
				  $ret_[$i_cnt]["coordinates"]=($row->coordinates);
				 // $ret_[$i_cnt]["center_latitude"]=($row->center_latitude);
				 // $ret_[$i_cnt]["center_longitude"]=($row->center_longitude);
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
	
	public function get_destinationId($s_where=null)
    {
        try
        {
			$DestinationID = '';
          	$s_qry="SELECT n.DestinationID 
					FROM ".$this->tbl_destination." n "
					.($s_where!=""?$s_where:"" );
          $rs=$this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                 $DestinationID =stripslashes($row->DestinationID); 
                  $i_cnt++;
              }    
              $rs->free_result();          
          }
          unset($s_qry,$rs,$row,$s_where);
          return $DestinationID;
          
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
}