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

class RoomTypeList_model extends CI_Model {

	 private $conf;
     private $tbl;///used for this class
	
	 public function __construct()
    {
        try
        {
          parent::__construct();
          $this->tbl = $this->db->ROOM_TYPE_LISTS;   
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
                  $ret_[$i_cnt]["ean_hotel_id"]=intval($row->ean_hotel_id); 
				  $ret_[$i_cnt]["room_type_id"]=intval($row->room_type_id);
                  $ret_[$i_cnt]["language_code"]=stripslashes(htmlspecialchars_decode($row->language_code));
				  $ret_[$i_cnt]["room_type_image"]=stripslashes(htmlspecialchars_decode($row->room_type_image)); 
				  $ret_[$i_cnt]["room_type_name"]=stripslashes(htmlspecialchars_decode($row->room_type_name)); 
				  $ret_[$i_cnt]["room_type_description"]=stripslashes(htmlspecialchars_decode($row->room_type_description)); 
                  
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
}