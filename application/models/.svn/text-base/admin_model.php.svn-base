<?php

/*
| ----------------------------------------------
| Start Date : 20-11-2010
| Framework : CodeIgniter
| Description :BPD CMS
| ----------------------------------------------
| Model USER
| ----------------------------------------------
*/

class Admin_model extends CI_Model {

    private $conf;
     private $tbl;///used for this class
	
	 public function __construct()
    {
        try
        {
          parent::__construct();
          $this->tbl = $this->db->ADMINS;   
          $this->conf =&get_config();
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }

	
    /*******
    * Login and save loggedin values.
    * 
    * @param array $login_data, login[field_name]=value
    * @returns true if success and false
    */
    public function login($login_data)
    {

        try
        {
          $ret_=array();
          ////Using Prepared Statement///
          $s_qry="Select id, username, admin_email, admin_name, UserStatus, UserActive, ShowPage From ".$this->tbl." Where username=?";
          $s_qry.=" And password=? ";
          $s_qry.="And UserActive='Y' ";
          
          $stmt_val["username"]= htmlspecialchars(trim($login_data["username"]));
          /////Added the salt value with the password///
          $stmt_val["password"]= trim($login_data["password"]);
		  
		  
          $rs=$this->db->query($s_qry,$stmt_val);
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                  $ret_["id"]=$row->id;////always integer
                  $ret_["username"]=stripslashes($row->username); 
                  $ret_["admin_email"]=trim($row->admin_email); 
                  $ret_["admin_name"]=trim($row->admin_name);
				  $ret_["UserStatus"]=trim($row->UserStatus);
                  $ret_["UserActive"]=trim($row->UserActive); 
                  $ret_["ShowPage"]=trim($row->ShowPage); 
                  
                  ////////saving logged in user data into session////
                  $this->session->set_userdata(array(
                                                    "logged_admin_user"=> array(
                                                    "Admin_Id"=> intval($ret_["id"]),
													"AdminUsername"=> $ret_["username"],
                                                    "AdminsStatus"=> $ret_["UserStatus"],
                                                    "AdminPageShow"=> $ret_["ShowPage"],
                                                    "SelectedPage"=> 'Admin')       
                                                ));
              }    
              $rs->free_result();          
          }
          unset($s_qry,$rs,$row,$login_data,$stmt_val);
          return $ret_;
          
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
			$s_qry="SELECT * FROM ".$this->tbl." n "
                .($s_where!=""?$s_where:"" )." ORDER BY {$order_name} {$order_by}".(is_numeric($i_start) && is_numeric($i_limit)?" Limit ".intval($i_start).",".intval($i_limit):"" );
          $rs=$this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                
				$ret_[$i_cnt]["id"]=$row->id;////always integer
				$ret_[$i_cnt]["username"]=stripslashes($row->username); 
				$ret_[$i_cnt]["password"]=stripslashes($row->password); 
				$ret_[$i_cnt]["admin_email"]=trim($row->admin_email); 
				$ret_[$i_cnt]["admin_name"]=trim($row->admin_name);
				$ret_[$i_cnt]["UserStatus"]=trim($row->UserStatus);
				$ret_[$i_cnt]["UserActive"]=trim($row->UserActive); 
				$ret_[$i_cnt]["ShowPage"]=trim($row->ShowPage);

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
                $s_qry.=" username=? ";
                $s_qry.=", password=? ";
                $s_qry.=", admin_email=? ";
				$s_qry.=", admin_name=? ";
				$s_qry.=", UserStatus=? ";
				$s_qry.=", UserActive=? ";
				$s_qry.=", ShowPage=? ";
				$s_qry.=", ShowUser=? ";
				$s_qry.=", ShowMetaSection=? ";
                
                $this->db->query($s_qry,array(
												  trim(htmlspecialchars($info["username"], ENT_QUOTES, 'utf-8')),
												  trim(htmlspecialchars($info["password"], ENT_QUOTES, 'utf-8')),
												  trim(htmlspecialchars($info["admin_email"], ENT_QUOTES, 'utf-8')),
												  trim(htmlspecialchars($info["admin_name"], ENT_QUOTES, 'utf-8')),
												  trim(htmlspecialchars($info["UserStatus"])),
												  trim(htmlspecialchars($info["UserActive"])),
												  trim(htmlspecialchars($info["ShowPage"])),
												  trim(htmlspecialchars($info["ShowUser"])),
												  trim(htmlspecialchars($info["ShowMetaSection"]))
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
				$s_qry.=" username=? ";
                $s_qry.=", password=? ";
                $s_qry.=", admin_email=? ";
				$s_qry.=", admin_name=? ";
				$s_qry.=", UserStatus=? ";
				$s_qry.=", UserActive=? ";
				$s_qry.=", ShowPage=? ";
				$s_qry.=", ShowUser=? ";
				$s_qry.=", ShowMetaSection=? ";
                $s_qry.=" Where id=? ";
                
                $this->db->query($s_qry,array(
												trim(htmlspecialchars($info["username"], ENT_QUOTES, 'utf-8')),
											    trim(htmlspecialchars($info["password"], ENT_QUOTES, 'utf-8')),
											    trim(htmlspecialchars($info["admin_email"], ENT_QUOTES, 'utf-8')),
											    trim(htmlspecialchars($info["admin_name"], ENT_QUOTES, 'utf-8')),
											    trim(htmlspecialchars($info["UserStatus"])),
											    trim(htmlspecialchars($info["UserActive"])),
											    trim(htmlspecialchars($info["ShowPage"])),
												trim(htmlspecialchars($info["ShowUser"])),
											    trim(htmlspecialchars($info["ShowMetaSection"])),
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
	function isOldPass($pass)
    {
        $this->db->select('*')->from($this->tbl)->where('password', $pass);
		$query = $this->db->get();
		$query = $this->db->affected_rows(); 
		return $this->db->affected_rows();	
		
		
    }


    function update($cond, $data)
    {
        if($this->db->update($this->tbl, $data, $cond)){
          // echo $this->db->last_query(); die();
		    return true;
        }
    }
	public function __destruct()
    {}
}