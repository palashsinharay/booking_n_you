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

class User_model extends CI_Model {

	
	 private $conf;
     private $tbl;///used for this class
	
	 public function __construct()
    {
        try
        {
          parent::__construct();
          $this->tbl 		  = $this->db->USERS;   
		  $this->tbl_booking  = $this->db->MY_BOOKING_DETAILS;  
		  $this->tbl_property = $this->db->ACTIVE_PROPERTY_LIST;  
          $this->tbl_reviews  = $this->db->MY_REVIEW_DETAILS; 
		  $this->tbl_country  = $this->db->COUNTRIES;  
          $this->conf =&get_config();
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
	
	
############# Get user details function Start #############
public function get_user_detail($id) {
/*echo $id;
echo "<br/>";
echo $password;*/
try
	{
	$this->query = $this->db->select('*')->from($this->tbl)->where(array('id'=>$id))->get();
	//echo $this->db->last_query();
	return $this->query->row_array();
	
	}
 catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
}


############# SignIn function Start #############
public function check_user($username,$password) {

try
	{
	$this->query = $this->db->select('*')->from('booking_users')->where(array('email_address'=>trim($username),'password'=>trim(md5($password))))->get();
	return $this->query->row_array();
	
	}
 catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
}

############# SignIn function End #############

############# SignUp function Start #############
/*public function signup_user($email,$first_name,$last_name,$password,$confirm_password) {

try
	{
		$data = array(
		'email_address' => mysql_real_escape_string($email),
		'login_email_address' => mysql_real_escape_string($email),
		'first_name' => mysql_real_escape_string($first_name),
		'last_name' => mysql_real_escape_string($last_name),
		'password' => mysql_real_escape_string(md5($password)),
        'created_on'=>date('Y-m-d H:i:s'),
		'is_active'=>'0'
		);
		if($this->db->insert('booking_users', $data))
		{
			return '1';
		}
		else
		{
			return '0';
		}

	}
 catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
}
*/

public function add_info($info)
    {
        try
        {
        // Checking in DB if the email exists or not 
		//$this->query = $this->db->select('id')->from($this->tbl)->where(array('email_address'=>$info["email_address"]))->get();
		$this->query = $this->db->select('id')->from($this->tbl);
		$this->db->where(array('email_address'=>$info["email_address"]));
		$this->db->or_where(array('email_address2'=>$info["email_address"]));
		$this->db->or_where(array('email_address3'=>$info["email_address"]));
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		//$this->db->last_query();
       // if Email Id not in db then insert the record in db 
		if($rowcount==0)
		{
			$i_ret_=0; ////Returns false
            if(!empty($info))
            {
                $s_qry="Insert Into ".$this->tbl." Set ";
				//$s_qry="Insert Into booking_users Set ";
                $s_qry.=" email_address=? ";
				$s_qry.=", login_email_address=? ";
                $s_qry.=", first_name=? ";
                $s_qry.=", last_name=? ";
				$s_qry.=", password=? ";
				$s_qry.=", created_on=? ";
				$s_qry.=", last_login=? ";
                $s_qry.=", is_active=? ";
				$s_qry.=", lang_id=? ";
                
              $this->db->query($s_qry,array(
			  trim($info["email_address"]),
			  trim($info["login_email_address"]),
			  trim($info["first_name"]),
			  trim($info["last_name"]),
			  trim(md5($info["password"])),
              $info["created_on"],
			  $info["last_login"],
              $info["is_active"],
			  $info["lang_id"]
             ));
                $i_ret_=$this->db->insert_id();     
                
            }
            unset($s_qry, $info );
            return $i_ret_;
			
		 }
		 else
		 {
		 	echo "Email ID exists !";
		 }	
			
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }

############# SignUp function End #############
public function add_user_info($info)
    {
        try
        {
       	  $i_ret_=0; ////Returns false
            if(!empty($info))
            {
                $s_qry="Insert Into ".$this->tbl." Set ";
				//$s_qry="Insert Into booking_users Set ";
                $s_qry.=" email_address=? ";
				$s_qry.=", login_email_address=? ";
                $s_qry.=", first_name=? ";
                $s_qry.=", last_name=? ";
				$s_qry.=", password=? ";
				$s_qry.=", address=? ";
				$s_qry.=", city=? ";
				$s_qry.=", zip_code=? ";
				$s_qry.=", country_code=? ";
				$s_qry.=", created_on=? ";
                $s_qry.=", is_active=? ";
				$s_qry.=", lang_id=? ";
                
              $this->db->query($s_qry,array(
			  trim($info["email_address"]),
			  trim($info["login_email_address"]),
			  trim($info["first_name"]),
			  trim($info["last_name"]),
			  trim(md5($info["password"])),
			  trim($info["address"]),
			  trim($info["city"]),
			  trim($info["zip_code"]),
			  trim($info["country_code"]),
              $info["created_on"],
              $info["is_active"],
			  $info["lang_id"]
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

############# Booking  function End #############
############# Registration Subscription function Start #############
public function add_subscription_info($info,$i_newid)
    {
        try
        {
        // Checking in DB if the email exists or not 
		//$this->query = $this->db->select('id')->from($this->tbl)->where(array('email_address'=>$info["email_address"]))->get();
		$this->query = $this->db->select('i_id')->from('booking_newsletter_subscription');
		$this->db->where(array('s_email'=>$info["email_address"]));
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		//$this->db->last_query();
       // if Email Id not in db then insert the record in db 
			if($rowcount==0)
			{
					$i_ret_=0; ////Returns false
					if(!empty($info))
					{ 
					   // $s_qry="Insert Into ".$this->tbl." Set ";
						$s_qry="Insert Into booking_newsletter_subscription Set ";
						$s_qry.=" i_user_id=? ";
						$s_qry.=", i_user_type=? ";
						$s_qry.=", s_email=? ";
						$s_qry.=", s_name=? ";
						$s_qry.=", dt_entry_date=? ";
						
					  $this->db->query($s_qry,array(
					  $i_newid,
					  '1',
					  trim($info["email_address"]),
					  trim($info["first_name"])." ".trim($info["last_name"]),
					  $info["created_on"]
					 ));
						$i_ret_=$this->db->insert_id();     
						
					}
					unset($s_qry, $info );
					return $i_ret_;
			}
			
					
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
############# Registration Subscription function End #############
############# General Subscription function Start #############
public function add_general_subscription_info($info)
    {
        try
        {
			
        // Checking in DB if the email exists or not 
		//$this->query = $this->db->select('id')->from($this->tbl)->where(array('email_address'=>$info["email_address"]))->get();
		$this->query = $this->db->select('i_id')->from('booking_newsletter_subscription');
		$this->db->where(array('s_email'=>$info["subscribe_emaii"]));
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		//$this->db->last_query();
       // if Email Id not in db then insert the record in db 
			if($rowcount==0)
			{
				
				$i_ret_=0; ////Returns false
				if(!empty($info))
				{ 
				   // $s_qry="Insert Into ".$this->tbl." Set ";
					$s_qry="Insert Into booking_newsletter_subscription Set ";
					$s_qry.=" i_user_type=? ";
					$s_qry.=", s_email=? ";
					$s_qry.=", dt_entry_date=? ";
					
				  $this->db->query($s_qry,array(
				  '2',
				  trim($info["subscribe_emaii"]),
				  $info["created_on"]
				 ));
					$i_ret_=$this->db->insert_id();     
					
				}
				unset($s_qry, $info );
				return $i_ret_;
			}
			else
			{
				echo "You are allready subscribed with this email id !!";
			}	
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }
############# General Subscription function End #############
############# Get Language By Language Code Start #############
public function get_user_language($lang_id) {
try
	{
	$this->query = $this->db->select('*')->from('booking_languages')->where(array('lng_id'=>$lang_id))->get();
	//echo $this->db->last_query();
	//die();
	return $this->query->row_array();
	
	}
 catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
}

############# Get Language By Language Code End #############


############# Get Language By ID Start #############
public function get_user_language_by_id($lang_id) {
try
	{
	$this->query = $this->db->select('*')->from('booking_languages')->where(array('lng_id'=>$lang_id))->get();
	$this->db->last_query();
	//die();
	return $this->query->row_array();
	
	}
 catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
}

############# Get Language By ID End #############
############# Get Country By ID Start #############
public function get_user_country_by_id($country_code) {
try
	{
	$this->query = $this->db->select('*')->from('booking_country_lists')->where(array('country_code'=>$country_code))->get();
	//echo $this->db->last_query();
	//die();
	return $this->query->row_array();
	
	}
 catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
}

############# Get Language By ID End #############
############# Account Edit function Start #############

public function edit_info($info,$i_id)
    {
        try
        {
       
			$i_ret_=0; ////Returns false
            if(!empty($info))
            {
                $s_qry="Update ".$this->tbl." Set ";
				//$s_qry="Insert Into booking_users Set ";
                $s_qry.="  first_name=? ";
                $s_qry.=", last_name=? ";
                $s_qry.=", address=? ";
				$s_qry.=", ph_no=? ";
				$s_qry.=", lang_id=? ";
				$s_qry.=", city=? ";
				$s_qry.=", country_code=? ";
				$s_qry.=", zip_code=? ";
				$s_qry.=" Where id=? ";
                
              $this->db->query($s_qry,array(
			  trim($info["first_name"]),
			  trim($info["last_name"]),
			  trim($info["address"]),
			  trim($info["ph_no"]),
			  trim($info["lang_id"]),
			  trim($info["city"]),
			  trim($info["country"]),
			  trim($info["zip_code"]),
              intval($i_id)
             ));
			  //  echo $this->db->last_query();
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

############# Account Edit function End #############


############# Account Edit function Start #############

public function edit_login_time($username)
    {
        try
        {
       
			$i_ret_=0; ////Returns false
                $s_qry="Update ".$this->tbl." Set ";
				//$s_qry="Insert Into booking_users Set ";
				$s_qry.="last_login=? ";
				$s_qry.=" Where email_address=? ";
                
              $this->db->query($s_qry,array(
			  date("Y-m-d H:i:s"),
			  $username
             ));
			    $i_ret_=$this->db->affected_rows();     

            unset($s_qry);
            return $i_ret_;
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }

############# Account Edit function End #############



############# Account Password Edit function Start #############

public function edit_password_info($info,$i_id)
    {
        try
        {
       
			$i_ret_=0; ////Returns false
            if(!empty($info))
            {
                $s_qry="Update ".$this->tbl." Set ";
                $s_qry.="  password=? ";
				$s_qry.=" Where id=? ";
                
              $this->db->query($s_qry,array(
			  trim(md5($info["new_password"])),
              intval($i_id)
             ));
			  //  echo $this->db->last_query();
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




############# Account Password Edit function End #############
/******************************** Function For Selected Language Fetch  **************************************/

	public function get_selected_language($lang_id)
	{
        try
        {
			//echo $lang_id;
			$sql = "select * from booking_languages where is_active = '0'";   
			$result = mysql_query($sql);    
			$dropdown  = '';
			$dropdown.= "<select name='all_language' id='language_select' class='language_select' style='width:35%;' >";
			while ($data = mysql_fetch_array($result)) {
					$dropdown .= "<option  value= $data[lng_id] ";
						if($lang_id == $data['lng_id']){
								$dropdown.= ' selected ';
								
								}
						$dropdown.= '>'.$data['language'].'</option>';
					} 
			echo $dropdown.= "</select>";
		}
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
				
	}
############# My Account new email Add function Start #############
public function edit_add_new_email_info($info,$i_id)
    {
        try
        {
	   // Checking db , if the email id exist then do not update
		$this->query = $this->db->select('id')->from($this->tbl);
		$this->db->where(array('email_address'=>$info["new_email"]));
		$this->db->or_where(array('email_address2'=>$info["new_email"]));
		$this->db->or_where(array('email_address3'=>$info["new_email"]));
		
		$query = $this->db->get();
       // $this->db->last_query();
		//die();
		$email_rowcount = $query->num_rows();
							
		if($email_rowcount==0)
		 {
				$this->query = $this->db->select('*')->from($this->tbl);
				$this->db->where(array('id'=>$info["id"]));
				$query = $this->db->get();
				$this->db->last_query();
				$rowcount = $query->num_rows();
				$email_data=$query->row_array();
			   // if Email Id not in db then insert the record in db 
				if($rowcount>0)
				{
				// IF email address 2 is blank then insert as email id 2 					
					if($email_data["email_address2"]=='')
					{
						$i_ret_=0; ////Returns false
						if(!empty($info))
						{
							$s_qry="Update ".$this->tbl." Set ";
							//$s_qry="Insert Into booking_users Set ";
							$s_qry.="  email_address2=? ";
							$s_qry.=" Where id=? ";
							
						  $this->db->query($s_qry,array(
						  trim($info["new_email"]),
						  intval($i_id)
						 ));
							//echo $this->db->last_query();
							$i_ret_=$this->db->affected_rows();     
							
						}
						unset($s_qry, $info,$i_id);
						return $i_ret_;
					}
				// IF email address 3 is blank then insert as email id 3 								
					if($email_data["email_address3"]=='')
					{
						$i_ret_=0; ////Returns false
						if(!empty($info))
						{
							$s_qry="Update ".$this->tbl." Set ";
							//$s_qry="Insert Into booking_users Set ";
							$s_qry.="  email_address3=? ";
							$s_qry.=" Where id=? ";
							
						  $this->db->query($s_qry,array(
						  trim($info["new_email"]),
						  intval($i_id)
						 ));
							//echo $this->db->last_query();
							$i_ret_=$this->db->affected_rows();     
							
						}
						unset($s_qry, $info,$i_id);
						return $i_ret_;
					}		
									
									
				  }	
				 else
				 {
					echo "Email can not be added !";
				 }	
		  }
		  else
		  {
		  	echo "Email ID exists !";
		  }
			
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }




############# My Account new email Add function End #############
############# My Account second email delete function Start #############

public function delete_second_email_info($info,$i_id)
    {
        try
        {
								$i_ret_=0; ////Returns false
								if(!empty($info))
								{
									$s_qry="Update ".$this->tbl." Set ";
									//$s_qry="Insert Into booking_users Set ";
									$s_qry.="  email_address2=? ";
									$s_qry.=" Where id=? ";
									
								  $this->db->query($s_qry,array(
								  trim(''),
								  intval($i_id)
								 ));
									//echo $this->db->last_query();
									//die();
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




############# My Account second email delete function End #############



############# My Account third email delete function Start #############

public function delete_third_email_info($info,$i_id)
    {
        try
        {
								$i_ret_=0; ////Returns false
								if(!empty($info))
								{
									$s_qry="Update ".$this->tbl." Set ";
									//$s_qry="Insert Into booking_users Set ";
									$s_qry.="  email_address3=? ";
									$s_qry.=" Where id=? ";
									
								  $this->db->query($s_qry,array(
								  trim(''),
								  intval($i_id)
								 ));
									//echo $this->db->last_query();
									//die();
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

############# My Account third email delete function End #############



############# My Account second email Edit function Start #############

public function edit_second_email_info($info,$i_id)
    {
        try
        {
       
	   // Checking db , if the email id exist then do not update
		
		$this->query = $this->db->select('id')->from($this->tbl);
		$this->db->where(array('email_address'=>$info["second_edit_email"]));
		$this->db->or_where(array('email_address2'=>$info["second_edit_email"]));
		$this->db->or_where(array('email_address3'=>$info["second_edit_email"]));
		
		$query = $this->db->get();
     /*   echo $this->db->last_query();
		die();*/
		$email_rowcount = $query->num_rows();
							
		if($email_rowcount==0)
		 {
		       // echo "update";
				//die();
		   
				$this->query = $this->db->select('*')->from($this->tbl);
				$this->db->where(array('id'=>$info["id"]));
				$query = $this->db->get();
				$this->db->last_query();
				$rowcount = $query->num_rows();
				$email_data=$query->row_array();
				//$email_data['email_address2'];
				//$email_data['email_address3'];
				
			   // if Email Id not in db then insert the record in db 
				if($rowcount>0)
				{
							//	echo "i am here";			
							  //  die();
				// IF email address 2 is blank then insert as email id 2 					
								$i_ret_=0; ////Returns false
								if(!empty($info))
								{
									$s_qry="Update ".$this->tbl." Set ";
									//$s_qry="Insert Into booking_users Set ";
									$s_qry.="  email_address2=? ";
									$s_qry.=" Where id=? ";
									
								  $this->db->query($s_qry,array(
								  trim($info["second_edit_email"]),
								  intval($i_id)
								 ));
									/*echo $this->db->last_query();
									die();*/
									$i_ret_=$this->db->affected_rows();     
									
								}
								unset($s_qry, $info,$i_id);
								return $i_ret_;
							
									
				  }	
				 else
				 {
					echo "Email can not be added !";
				 }	
		  }
		  else
		  {
		  	echo "Email ID exists !";
		  }
			
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }




############# My Account second email Edit function End #############





############# My Account third email Edit function Start #############

public function edit_third_email_info($info,$i_id)
    {
        try
        {
       
	   // Checking db , if the email id exist then do not update
		
		$this->query = $this->db->select('id')->from($this->tbl);
		$this->db->where(array('email_address'=>$info["third_edit_email"]));
		$this->db->or_where(array('email_address2'=>$info["third_edit_email"]));
		$this->db->or_where(array('email_address3'=>$info["third_edit_email"]));
		
		$query = $this->db->get();
     /*   echo $this->db->last_query();
		die();*/
		$email_rowcount = $query->num_rows();
							
		if($email_rowcount==0)
		 {
		       // echo "update";
				//die();
		   
				$this->query = $this->db->select('*')->from($this->tbl);
				$this->db->where(array('id'=>$info["id"]));
				$query = $this->db->get();
				$this->db->last_query();
				$rowcount = $query->num_rows();
				$email_data=$query->row_array();
				//$email_data['email_address2'];
				//$email_data['email_address3'];
				
			   // if Email Id not in db then insert the record in db 
				if($rowcount>0)
				{
							//	echo "i am here";			
							  //  die();
				// IF email address 2 is blank then insert as email id 2 					
								$i_ret_=0; ////Returns false
								if(!empty($info))
								{
									$s_qry="Update ".$this->tbl." Set ";
									//$s_qry="Insert Into booking_users Set ";
									$s_qry.="  email_address3=? ";
									$s_qry.=" Where id=? ";
									
								  $this->db->query($s_qry,array(
								  trim($info["third_edit_email"]),
								  intval($i_id)
								 ));
									/*echo $this->db->last_query();
									die();*/
									$i_ret_=$this->db->affected_rows();     
									
								}
								unset($s_qry, $info,$i_id);
								return $i_ret_;
							
									
				  }	
				 else
				 {
					echo "Email can not be added !";
				 }	
		  }
		  else
		  {
		  	echo "Email ID exists !";
		  }
			
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }          
    }




############# My Account third email Edit function End #############


############# MyBooking2 function Start #############
public function model_my_account_my_booking2($info,$user_id) {
try
	{
	$this->query = $this->db->select('*')->from('booking_my_booking_details')->where(array('id'=>trim($info['booking_number']),'user_id'=>trim($user_id)))->get();
	//echo $this->db->last_query();
	//return $this->query->num_rows(); 
	return $this->query->row_array();
	
	}
 catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
}

############# MyBooking2 function End #############


############# Get Hotel Details function Start #############
public function model_get_hotel_detail($hotel_id) {

/*echo $username;
echo "<br/>";
echo $password;*/
try
	{
//	$this->query = $this->db->select('*')->from('booking_my_booking_details')->where(array('id'=>trim($booking_number),'user_id'=>trim($password)))->get();
	$this->query = $this->db->select('*')->from('booking_hotelsummaries')->where(array('hotel_id'=>$hotel_id))->get();
	//echo $this->db->last_query();
	//return $this->query->num_rows(); 
	return $this->query->row_array();
	
	}
 catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
}

############# Get Hotel Details function End #############



############# Get Hotel Details function Start #############
public function model_get_all_hotels_for_an_user($user_id) {
try
	{
       $query_sql="SELECT * FROM booking_hotelsummaries bhs, booking_my_booking_details bmbd WHERE bmbd.user_id = '$user_id' AND bmbd.hotel_id = bhs.hotel_id";
		$query=$this->db->query($query_sql);
		$result = $query->result();
	    $this->db->last_query();
        return $result;    
	}
 catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
}
############# Get Hotel Details function End #############


############# ForgetPassword function #############
public function forget_password($forget_password_user_email)
{
try
{
	$this->query = $this->db->select('*')->from($this->tbl)->where(array('email_address'=>trim($forget_password_user_email)))->get();
	$count_row=$this->query->num_rows(); 
				if($count_row>0){
				$user_data=$this->query->row_array();
				$i_ret_1 = array();
				$id = trim($user_data['id']);
				$encripted_id = base64_encode($id);
				$email_address=trim($user_data['email_address']);
				$first_name=trim($user_data['first_name']);
				$last_name=trim($user_data['last_name']);
				$sec_key = md5(SECURITY_KEY.$id);
				//die();
				// Update the booking_users table's requested_passowrd to 1 
						if($id!='')
						{
								$s_qry="Update ".$this->tbl." Set ";
								//$s_qry="Insert Into booking_users Set ";
								$s_qry.="  requested_passowrd=? ";
								$s_qry.=" Where id=? ";
								
								$this->db->query($s_qry,array( '1',intval($id)));
								//$this->db->last_query();
								$i_ret_=$this->db->affected_rows();
								//return $i_ret_;
								if($i_ret_>0)
								{
									$i_ret_1['id'] = $id;
									$i_ret_1['encripted_id'] = $encripted_id;
									$i_ret_1['email_address'] = $email_address;
									$i_ret_1['first_name'] = $first_name;
									$i_ret_1['last_name'] = $last_name;
									$i_ret_1['email_address'] = $email_address;
									$i_ret_1['sec_key'] = $sec_key;
								}
								return $i_ret_1;
								unset($i_ret_1);
																
						 }		
								//die();

				}  
				else
				{
					echo "Email ID does not exists!!";
					exit();
				}
				
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	} 			
}

############# GET USER DETAIL BY EMAIL function #############

############# password reset update function Start #############




public function edit_forget_password_info($info,$i_id)
    {
	$set_value=0;
        try
        {
       
			$i_ret_=0; ////Returns false
            if(!empty($info))
            {
                $s_qry="Update ".$this->tbl." Set ";
				//$s_qry="Insert Into booking_users Set ";
                $s_qry.="  password=? ";
				$s_qry.=",  requested_passowrd=? ";
				$s_qry.=" Where id=? ";
                
              $this->db->query($s_qry,array(
			  trim(md5($info["new_password"])),
			  $set_value,
              intval($i_id)
             ));
			   // echo $this->db->last_query();
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

############# password reset update  function End #############
##################################################################################################################################
	/****
    * Fetch Total records
    */
    public function gettotal_info_my_booking($s_where=null)
    {
        try
        {
          $ret_=0;
          $s_qry="Select count(*) as i_total "
                	."FROM ".$this->tbl_booking." n  "
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
	public function fetch_multi_my_booking($s_where=null,$i_start=null,$i_limit=null)
    {
        try
        {
          	$ret_=array();
            $s_qry="SELECT n.*, p.name, p.address1, (select thumbnail_url from booking_hotel_image_lists where n.hotel_id = ean_hotel_id limit 0,1) as thumbnail_url FROM ".$this->tbl_booking." n  LEFT JOIN " .$this->tbl_property." p  ON n.hotel_id = p.ean_hotel_id "
					.($s_where!=""?$s_where:"" ).(is_numeric($i_start) && is_numeric($i_limit)?
					"Limit ".intval($i_start).",".intval($i_limit):"" );
          $rs=$this->db->query($s_qry);
          $i_cnt=0;
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
                  $ret_[$i_cnt]["id"]=$row->id;////always integer
                  $ret_[$i_cnt]["user_id"]=intval($row->user_id); 
				  $ret_[$i_cnt]["hotel_id"]=intval($row->hotel_id);
				  $ret_[$i_cnt]["name"]=stripslashes(htmlspecialchars_decode($row->name)); 
				  $ret_[$i_cnt]["address1"]=stripslashes(htmlspecialchars_decode($row->address1)); 
				  $ret_[$i_cnt]["thumbnail_url"]=stripslashes(htmlspecialchars_decode($row->thumbnail_url)); 
				  $ret_[$i_cnt]["check_in"]=($row->check_in); 
				  $ret_[$i_cnt]["check_out"]=($row->check_out);
				  $ret_[$i_cnt]["max_person"]=intval($row->max_person); 
				  $ret_[$i_cnt]["no_of_rooms"]=intval($row->no_of_rooms);
				  $ret_[$i_cnt]["rate"]=intval($row->rate); 
                  $ret_[$i_cnt]["currency"]=stripslashes(htmlspecialchars_decode($row->currency)); 
				  $ret_[$i_cnt]["itinerary_id"]=stripslashes(htmlspecialchars_decode($row->itinerary_id)); 
				  $ret_[$i_cnt]["confirmation_number"]=stripslashes(htmlspecialchars_decode($row->confirmation_number)); 
				  $ret_[$i_cnt]["is_cancelled"]=($row->is_cancelled); 
				  $ret_[$i_cnt]["booking_time"]=($row->booking_time); 
				  
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
################################################################################################################################
#################################################################################################################################
public function fetch_multi_my_reviews($s_where=null,$i_start=null,$i_limit=null)
{
    try
    {
    $ret_=array();
    $s_qry="SELECT bd.user_id, bd.hotel_id as b_hotel_id, bd.rate, bd.currency, ar.*, ap.name, ap.address1, ap.star_rating, (select thumbnail_url from booking_hotel_image_lists where bd.hotel_id = ean_hotel_id limit 0,1) as thumbnail_url FROM ".$this->tbl_booking." bd LEFT JOIN " .$this->tbl_reviews." ar ON bd.user_id = ar.user_id AND bd.hotel_id = ar.hotel_id LEFT JOIN " .$this->tbl_property." ap ON bd.hotel_id = ap.ean_hotel_id "
      .($s_where!=""?$s_where:"" ).(is_numeric($i_start) && is_numeric($i_limit)?
      "LIMIT ".intval($i_start).",".intval($i_limit):"" );
      $rs=$this->db->query($s_qry);
      $i_cnt=0;
      if($rs->num_rows()>0)
      {
          foreach($rs->result() as $row)
          {
              $ret_[$i_cnt]["id"]=$row->id;////always integer
              $ret_[$i_cnt]["user_id"]=intval($row->user_id); 
              $ret_[$i_cnt]["hotel_id"]=intval($row->b_hotel_id);
              $ret_[$i_cnt]["name"]=stripslashes(htmlspecialchars_decode($row->name)); 
              $ret_[$i_cnt]["address1"]=stripslashes(htmlspecialchars_decode($row->address1)); 
              $ret_[$i_cnt]["thumbnail_url"]=stripslashes(htmlspecialchars_decode($row->thumbnail_url)); 
              $ret_[$i_cnt]["star_rating"]=($row->star_rating); 
              $ret_[$i_cnt]["rate"]=intval($row->rate); 
              $ret_[$i_cnt]["currency"]=stripslashes(htmlspecialchars_decode($row->currency));  
              $ret_[$i_cnt]["review_score"]=($row->review_score); 
              $ret_[$i_cnt]["review_comments"]=($row->review_comments); 
              
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
################################################################################################################################
################################################################################################################################
public function gettotal_info_my_review($s_where=null)
{
    try
    {
      $ret_=0;
      $s_qry="SELECT COUNT(*) AS b_total FROM ".$this->tbl_booking." bd LEFT JOIN " .$this->tbl_reviews." ar ON bd.user_id = ar.user_id AND bd.hotel_id = ar.hotel_id "
      .($s_where!=""?$s_where:"" );                
      $rs=$this->db->query($s_qry);
      $i_cnt=0;
      if($rs->num_rows()>0)
      {
          foreach($rs->result() as $row)
          {
              $ret_=intval($row->b_total); 
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
################################################################################################################################
public function gettotal_info_my_reviewed($s_where1=null)
{
    try
    {
      $ret_=0;
      $s_qry="SELECT COUNT(*) AS r_total FROM ".$this->tbl_reviews." "
      .($s_where1!=""?$s_where1:"" ). " ";                
      $rs=$this->db->query($s_qry);
      $i_cnt=0;
      if($rs->num_rows()>0)
      {
          foreach($rs->result() as $row)
          {
              $ret_=intval($row->r_total); 
          }    
          $rs->free_result();          
      }
      unset($s_qry,$rs,$row,$i_cnt,$s_where1,$i_start,$i_limit);
      return $ret_;
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }           
}         
#################################################################################################################################
#################################################################################################################################
public function add_review_by_userid($info)
{
    try
    {
    $i_ret_=0; ////Returns false
    if(!empty($info))
    { 
        $s_qry="INSERT INTO ".$this->tbl_reviews." SET ";
        $s_qry.=" user_id =? ";
        $s_qry.=", hotel_id =? ";
        $s_qry.=", review_score =? ";
        $s_qry.=", review_comments =? ";
        $s_qry.=", review_date =? ";        
        $s_qry.=", is_active =? ";        
        $this->db->query($s_qry,array(
        intval($info["user_id"]),
        intval($info["hotel_id"]),
        $info["review_score"],
        trim($info["review_comments"]),
        $info["review_date"],
        $info["is_active"]
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
#################################################################################################################################
########################################Start ofFetch Multisotred data for admin##################################################
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
				$ret_[$i_cnt]["email_address"]=stripslashes($row->email_address); 
				$ret_[$i_cnt]["email_address2"]=stripslashes($row->email_address2); 
				$ret_[$i_cnt]["email_address3"]=stripslashes($row->email_address3); 
				$ret_[$i_cnt]["login_email_address"]=stripslashes($row->login_email_address);
				$ret_[$i_cnt]["is_active_email2"]=($row->is_active_email2);
				$ret_[$i_cnt]["is_active_email3"]=($row->is_active_email3); 
				$ret_[$i_cnt]["email_stat"]=stripslashes($row->email_stat);
				$ret_[$i_cnt]["first_name"]=stripslashes($row->first_name);
				$ret_[$i_cnt]["last_name"]=stripslashes($row->last_name);
				$ret_[$i_cnt]["password"]=stripslashes($row->password);
				$ret_[$i_cnt]["lang_id"]=stripslashes($row->lang_id);
				$ret_[$i_cnt]["address"]=stripslashes($row->address);
				$ret_[$i_cnt]["city"]=stripslashes($row->city);
				$ret_[$i_cnt]["zip_code"]=stripslashes($row->zip_code);
				$ret_[$i_cnt]["country_code"]=stripslashes($row->country_code);
				$ret_[$i_cnt]["state_id"]=intval($row->state_id);
				$ret_[$i_cnt]["ph_no"]=stripslashes($row->ph_no);
				$ret_[$i_cnt]["created_on"]=date('d/m/Y',strtotime($row->created_on));
				$ret_[$i_cnt]["is_active"]=($row->is_active)=='0'?"Active":"Inactive";
				$ret_[$i_cnt]["is_delete"]=($row->is_delete);
                 
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
########################################End ofFetch Multisotred data for admin##################################################
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
          $s_qry=" Select n.*, c.country "
                ."From ".$this->tbl." AS n "
				." LEFT JOIN ".$this->tbl_country." AS c"
				." ON n.country_code = c.country_id "
                ." Where n.id=?";
                
          $rs=$this->db->query($s_qry,array(intval($i_id))); 
          if($rs->num_rows()>0)
          {
              foreach($rs->result() as $row)
              {
				  
				$ret_["id"]=$row->id;////always integer
				$ret_["email_address"]=stripslashes($row->email_address); 
				$ret_["email_address2"]=stripslashes($row->email_address2); 
				$ret_["email_address3"]=stripslashes($row->email_address3); 
				$ret_["login_email_address"]=stripslashes($row->login_email_address);
				$ret_["is_active_email2"]=($row->is_active_email2);
				$ret_["is_active_email3"]=($row->is_active_email3); 
				$ret_["email_stat"]=stripslashes($row->email_stat);
				$ret_["first_name"]=stripslashes($row->first_name);
				$ret_["last_name"]=stripslashes($row->last_name);
				$ret_["password"]=stripslashes($row->password);
				$ret_["lang_id"]=stripslashes($row->lang_id);
				$ret_["address"]=stripslashes($row->address);
				$ret_["city"]=stripslashes($row->city);
				$ret_["zip_code"]=stripslashes($row->zip_code);
				$ret_["country_code"]=stripslashes($row->country_code);
				$ret_["country"]=stripslashes($row->country);
				$ret_["state_id"]=intval($row->state_id);
				$ret_["ph_no"]=stripslashes($row->ph_no);
				$ret_["created_on"]=date('d/m/Y',strtotime($row->created_on));
				$ret_["is_active"]=($row->is_active)=='0'?"Active":"Inactive";
				$ret_["is_delete"]=($row->is_delete);
		  
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
}
