<?php

/*
| ----------------------------------------------
| Start Date : 20-11-2010
| Framework : CodeIgniter
| Description :BPD CMS
| ----------------------------------------------
| Model Siteconf
| ----------------------------------------------
*/

class Siteconf extends CI_Model {

    private $conf;
     private $tbl;///used for this class
	
	 public function __construct()
    {
        try
        {
          parent::__construct();
          $this->tbl = $this->db->SETTINGS;  
          $this->conf =&get_config();
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
	
	function get_sitedetails($offset = null, $limit = null)
	{
		
		$this->db->select('*')->from($this->tbl,  $limit, $offset);
		$query = $this->db->get();
		$this->result = $query->result();
		return $this->result;
		
	}
	
	function update_siteconfig($id, $dataArray)
	{

		$this->db->where('id', $id);
		$this->db->update($this->tbl, $dataArray);
		 return true;
	}
}	