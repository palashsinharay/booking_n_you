<?php

/*
| ----------------------------------------------
| Start Date : 14-01-2013
| Framework : CodeIgniter
| ----------------------------------------------
| Model Main Image Gallery
| ----------------------------------------------
*/

class Cms_model extends CI_Model {

    public $result = null;

    function __construct()
    {
        //parent::Model();
		parent::__construct();
		$this->tbl = $this->db->CMSPAGES; 
    }
    
	function add_cms($dataArray)
	{
		return $this->db->insert($this->tbl, $dataArray);
	}

	function update_cms($id, $dataArray)
	{

		$this->db->where('id', $id);
		$this->db->update($this->tbl, $dataArray);
		 return true;
	}
	function get_content()
	{
		$query = $this->db->get_where($this->tbl,array('rootPage'=>0));
		$this->result = $query->result();
		$a = $this->result;
		if ($query->num_rows() > 0)
		{
			 $result = $query->result();
			
		}
		$this->result = $result;	
		return $this->result;
	}
	function fetch_content($PageUrl)
	{
		$result = array();
		$s_qry = "SELECT * FROM ".$this->tbl." n "
				." WHERE  PageUrl = '" .$PageUrl."' AND lang_id = '".$this->session->userdata('Language_code')."' ";
		$rs = $this->db->query("SET NAMES 'utf8'");  
		$rs = $this->db->query($s_qry);
		//$a = $this->result;
		if ($rs->num_rows() > 0)
		{
			 $result = $rs->result();
			
		}
		return $result;
	}
	
	public function __destruct()
    {}
}

?>