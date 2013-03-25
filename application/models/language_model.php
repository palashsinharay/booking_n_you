<?php

/*
| ----------------------------------------------
| Start Date : Start Date : 14-01-2013
| Framework : CodeIgniter
| ----------------------------------------------
| Model Main Image Gallery
| ----------------------------------------------
*/

class Language_model extends CI_Model {

    public $result = null;

    function __construct()
    {
        //parent::Model();
		parent::__construct();
		$this->tbl = $this->db->LANGUAGES; 
    }
    
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
				$ret_[$i_cnt]["lng_id"]=stripslashes(htmlspecialchars_decode($row->lng_id));
                $ret_[$i_cnt]["language"]=stripslashes($row->language);
                $ret_[$i_cnt]["is_active"]=$row->is_active;
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
                $s_qry.=" lng_id=? ";
                $s_qry.=", language=? ";
                $s_qry.=", is_active=? ";
                
                $this->db->query($s_qry,array(
												  trim(htmlspecialchars($info["lng_id"], ENT_QUOTES, 'utf-8')),
												  trim(htmlspecialchars($info["language"], ENT_QUOTES, 'utf-8')),
												  ($info["is_active"])
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
				 $s_qry.=" lng_id=? ";
                $s_qry.=", language=? ";
				$s_qry.=", is_active=? ";
                $s_qry.=" Where id=? ";
                
                $this->db->query($s_qry,array(
												trim(htmlspecialchars($info["lng_id"], ENT_QUOTES, 'utf-8')),
												trim(htmlspecialchars($info["language"], ENT_QUOTES, 'utf-8')),
												$info["is_active"],
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
	/***
    * Change Status records in db. As we know the table name 
    * we will not pass it into params.
    * 
    * @param array $info, array of fields(as key) with values,ex-$arr["field_name"]=value
    * @param int $i_id, id value to be updated used in where clause
    * @returns $i_rows_affected  on success and FALSE if failed 
    */
 	function change_status($id, $cond)
    {
		$this->db->where('id', $id);
		$this->db->update($this->tbl, $cond);
		return true;

	}
	public function __destruct()
    {}
}

?>