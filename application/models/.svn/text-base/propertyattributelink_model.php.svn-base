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

class PropertyAttributeLink_model extends CI_Model {

	 private $conf;
     private $tbl;///used for this class

	public function __construct()
    {
        try
        {
          parent::__construct();
          $this->tbl = $this->db->PROPERTY_ATTRIBUTE_LINKS;   
          $this->conf =&get_config();
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
	
	
	public function fetch_multi($s_where=null,$order_name,$order_by)
    {
        try
        {
          	$ret_=array();
          	$s_qry="SELECT p.attribute_id, a.attribute_desc FROM booking_property_attribute_links p, booking_attribute_lists a  
			WHERE p.attribute_id = a.attribute_id " .($s_where!=""?$s_where:"" ).
			" group by  p.attribute_id  "
					." ORDER BY {$order_name} {$order_by}";
          $rs=$this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                  $ret_[$i_cnt]["attribute_id"]=intval($row->attribute_id); 
				  $ret_[$i_cnt]["attribute_desc"]=stripslashes(htmlspecialchars_decode($row->attribute_desc));
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