<?php
/*
| ----------------------------------------------
| Start Date : 14-06-2012
| Developer : Kafil Akhter (Satyajit Limited)
| Framework : CodeIgniter
| ----------------------------------------------
| Main index controller for backend
| ----------------------------------------------
*/

class User extends RB_Controller  {
    /**
    * Load default admin home page
    *
    * @access    private
    * @param    string
    */
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->default_language_currency_session();
		$this->data["LANG"] = $this->change_language_text();
		
	}
	
    function index()
    {
       // var_dump($this->session->userdata('logged_user')); die();
		$this->pageTitle = '::: Booking and You :::';
		$this->data["LANG"] = $this->change_language_text();
		$this->data["Most_Viewed_Hotel"] =  $this->ActivePropertyList_model->findMostViewed();
		$this->_renderViewFe('index', $this->data);
    } 
	
	/******************************** Country Listing Array *****************************************************/
	function country_list_fetch() {
		$all_Country = $this->CountryList->findAll("CountryList.country_id <> '0'");
		$country_array = array();
		foreach($all_Country as $allCountry) {
			$country_array[$allCountry['CountryList']['country_code']] = $allCountry['CountryList']['country_name'];
		}
		return $country_array;
	}
	/******************************** Country Listing Array *****************************************************/

/******************************** User LOGIN START *****************************************************/
//function login_check($email,$password) {
function login_check() {

		if($this->input->post('ajax') == '1') {
		$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
		$this->form_validation->set_message('required', 'Please fill in the fields');
		if($this->form_validation->run() == FALSE) {
		echo validation_errors();
		} else {
			$this->load->model('User_model');
			$user['data'] =$this->User_model->check_user($this->input->post('username'),$this->input->post('password'));
			if(!empty($user['data']))
			{
					 // Update login time in user table ........
	                  $i_aff=$this->User_model->edit_login_time($this->input->post('username'));						
				
				 //echo 'login successful';
				 $user['id'] 				= $user['data']['id'];
				 $user['email_address'] 	= $user['data']['email_address'];
				 $user['first_name'] 		= $user['data']['first_name'];
				 $user['last_name'] 		= $user['data']['last_name'];
				 $user['email_address2'] 	= $user['data']['email_address2'];
				 $user['email_address3'] 	= $user['data']['email_address3'];
				 $user['address'] 			= $user['data']['address'];
				 $user['ph_no'] 			= $user['data']['ph_no'];
				 $user['lang_id'] 			= $user['data']['lang_id'];
				
				 $user['country_code'] 		= $user['data']['country_code'];
				 $user['city'] 			    = $user['data']['city'];	
				 $user['zip_code'] 			= $user['data']['zip_code'];				 
			  // Fetching language code from session and thn from db fetching the language name ---------------- START--------------//
			 $user_language['data'] =$this->User_model->get_user_language($this->session->userdata('Language_code'));
			//$user_language['data'] =$this->User_model->get_user_language($user['lang_id']);
			//print_r($user_language['data']);
			//die();
			$user_language_name['language']=$user_language['data']['language'];
			$user_language_name['id']=$user_language['data']['id'];
			$user_language_name['lng_id']=$user_language['data']['lng_id'];
			
			
			// Fetching language code from session and thn from db fetching the language name ---------------- END--------------//
			
			//print_r($this->session->userdata);
			//die();	
			
			$data = array( 
			'is_logged_in' => true,
			'user_id' => $user['id'],
			'user_first_name' => $user['first_name'],
			'user_last_name' => $user['last_name'],
			'user_lang_id' => $this->session->userdata('Language_code'),
			'user_language_name'=>$user_language_name['language'],
			'user_email_address'=>$user['email_address'],
			'user_ph_no'=>$user['ph_no'],
			'user_country_code'=>$user['country_code'],
			'user_city'=>$user['city'],
			'user_zip_code'=>$user['zip_code']
			);
	        	$this->session->set_userdata("LOGGEDIN_USER",$data); 
				$this->session->set_userdata('Language_code',$user['lang_id']);
				echo "<script type=\"text/javascript\">\n window.location = '";
				echo base_url().'user/my_account_home/';
				echo "';\n</script>";
			}
			else
			{
				echo 'Login failed';
			}
       }
	}
}
/******************************** User LOGIN END *****************************************************/
function login_check_booking() {

			$username = $this->input->post('s_username');
			$password = $this->input->post('s_password');
			$this->load->model('User_model');
			$user['data'] =$this->User_model->check_user($username,$password);
			if(!empty($user['data']))
			{
					   // Update login time in user table ........
	                  $i_aff=$this->User_model->edit_login_time($username);						 
  				 
				 //echo 'login successful';
				 $user['id'] 				= $user['data']['id'];
				 $user['email_address'] 	= $user['data']['email_address'];
				 $user['first_name'] 		= $user['data']['first_name'];
				 $user['last_name'] 		= $user['data']['last_name'];
				 $user['email_address2'] 	= $user['data']['email_address2'];
				 $user['email_address3'] 	= $user['data']['email_address3'];
				 $user['address'] 			= $user['data']['address'];
				 $user['ph_no'] 			= $user['data']['ph_no'];
				 $user['lang_id'] 			= $user['data']['lang_id'];
				 $user['country_code'] 		= $user['data']['country_code'];
				 $user['city'] 			    = $user['data']['city'];	
				 $user['zip_code'] 			= $user['data']['zip_code'];				 
              // Fetching language code from session and thn from db fetching the language name ---------------- START--------------//
				$user_language['data'] =$this->User_model->get_user_language($this->session->userdata('Language_code'));
				
				$user_language_name['language']=$user_language['data']['language'];
				$user_language_name['id']=$user_language['data']['id'];
				//die();	 
			   // Fetching language code from session and thn from db fetching the language name ---------------- END--------------//
				
				$data = array( 
				'is_logged_in' => true,
				'user_id' => $user['id'],
				'user_first_name' => $user['first_name'],
				'user_last_name' => $user['last_name'],
				'user_lang_id' => $this->session->userdata('Language_code'),
				'user_language_name'=>$user_language_name['language'],
				'user_email_address'=>$user['email_address'],
				'user_ph_no'=>$user['ph_no'],
				'user_country_code'=>$user['country_code'],
				'user_city'=>$user['city'],
				'user_zip_code'=>$user['zip_code']
				);
	        	$this->session->set_userdata("LOGGEDIN_USER",$data);
				echo "Login Successful";
			}
			else
			{
				echo 'Login failed';
			}
	}
/******************************** User SIGNUP START *****************************************************/
function signup_check() {
	try
	{
			   unset($_POST['action']);
			   $posted=array();
			   $posted["email"]  			= trim($this->input->post("email"));
			   $posted["first_name"]  		= trim($this->input->post("first_name"));
			   $posted["last_name"]  		= trim($this->input->post("last_name"));
			   $posted["password"]  		= trim($this->input->post("password"));
			   $posted["confirm_password"]  = trim($this->input->post("confirm_password"));
              // Fetching language code from session and thn from db fetching the language name ---------------- START--------------//
			$user_language['data'] =$this->User_model->get_user_language($this->session->userdata('Language_code'));
			$user_language_name['language']=$this->session->userdata('Language_code');
			$user_language_name['id']=$user_language['data']['id'];
			$user_language_name['lng_id']=$user_language['data']['lng_id'];
				 
			   // Fetching language code from session and thn from db fetching the language name ---------------- END--------------//
			   	$this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
				$this->form_validation->set_rules('first_name', 'first_name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('last_name', 'last_name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
				$this->form_validation->set_rules('confirm_password', 'confirm_password', 'trim|required|xss_clean');
				$this->form_validation->set_message('required', 'Please fill in the fields');
			   if($this->form_validation->run() == FALSE)/////invalid
			   {
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			   }
			   else///validated, now save into DB
			   {
				//$logged_user = $this->session->userdata('logged_user');
				$info=array();
				$info['email_address']    		=   $posted['email'];
				$info['login_email_address']    =   $posted['email'];
				$info['first_name']    			=   $posted['first_name'];
				$info['last_name']    			=   $posted['last_name'];
				$info['password']    			=   $posted['password'];
				$info['confirm_password']    	=   $posted['confirm_password'];
				$info["created_on"] 			= 	date("Y-m-d H:i:s");
				$info["last_login"] 			= 	date("Y-m-d H:i:s");
				$info["is_active"]   			= 	'0';
				$info["lang_id"]   				= 	$this->session->userdata('Language_code');
				
				if($info['password'] == $info['confirm_password'])
				{
						$i_newid = $this->User_model->add_info($info);
						if($i_newid)////saved successfully
						{
							// Insert function for subscription table
								$i_subscription_id = $this->User_model->add_subscription_info($info,$i_newid);
								// Shoot Email to USer 
							   //$message = "Dear User, <p>Your Account Login Details : <br/> UserName:".$info['email_address']." <br/> password:".$info['password']." </p><br/>Team Bookingandyou.com";
							   

$message="
<table style='width:700px; margin:0px auto; line-height:20px; background:#FFFFFF; color:#666666;font-size:12px;font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;' border='0' cellspacing='0' cellpadding='0'>

<tr>
<td style='border-top:6px solid #13b8e6;  padding-bottom:10px; text-align:right; color:#666666;'><a href=\"base_url()\"><img src=\'".base_url()."\images/logo.png' alt='logo' width='437' height='80' alt='ss' align='left'  /></a><br />&nbsp;</td>
<td></td>
</tr>
<tr>
<td style='padding:20px 0px 0px 0px;'>
<table style='padding-left:20px; font-size:14px; color:#999;' width='70%' border='0' cellspacing='6' cellpadding='6'>                       
<tr>
<td>Dear User,</td> 
</tr>
<tr>
<td>Thanks for signing up!!</td>
</tr>
<tr>
<td><b>UserName :</b> ".$info['email_address']."</td>
</tr>
<tr>
<td><b>password :</b> ".$info['password']."</td>
</tr>
<tr>
<td>Kindly make sure you use this link : <a href='http://satyajitlimited.com/booking_n_you/'>Booking And You</a></td>
</tr>
<tr>
<td><h4>Thanks,<br/> Booking And You Team</h4></td>
</tr>
</table>
<tr>
  <td style='border:1px solid #dadada; border-bottom:0px; background:#fff; padding:0px;'></td>
</tr>
<tr style='background:#CCC'>
  <td align='center' valign='middle' height='40px;'><em> &copy; Copyright 2013 by BookingandYou.com. All Rights Reserved. </em></td>
</tr>
</table>
";							   
							   
							   
							   $email_to  = $info['email_address'];
							   $email_from  = ADMIN_EMAIL;
							   $this->email->from($email_from, 'Booking And You');
							   $this->email->to($email_to);
							   $this->email->bcc('siddharth@satyajittech.com');
							   $this->email->subject('Registration Details :');
							   $this->email->message($message);
							   $this->email->send();
							  // echo $this->email->print_debugger(); die();
							 //echo 'Registration successfully Compleated!';
							// LOGIN USER 
								  $user['data'] =$this->User_model->check_user($this->input->post("email"),$this->input->post("password"));
									if(!empty($user['data']))
									{
										 $user['id'] 				= $user['data']['id'];
										 $user['email_address'] 	= $user['data']['email_address'];
										 $user['first_name'] 		= $user['data']['first_name'];
										 $user['last_name'] 		= $user['data']['last_name'];
										 $user['email_address2'] 	= $user['data']['email_address2'];
										 $user['email_address3'] 	= $user['data']['email_address3'];
										 $user['address'] 			= $user['data']['address'];
										 $user['ph_no'] 			= $user['data']['ph_no'];
										 $user['lang_id'] 			= $user['data']['lang_id'];
										 $user['country_code'] 		= $user['data']['country_code'];
										 $user['city'] 			    = $user['data']['city'];	
										 $user['zip_code'] 			= $user['data']['zip_code'];				 
										 
									  // Fetching language code from session and thn from db fetching the language name ---------------- START--------------//
									$user_language['data'] =$this->User_model->get_user_language($this->session->userdata('Language_code'));
									$user_language_name['language']=$user_language['data']['language'];
									$user_language_name['id']=$user_language['data']['id'];
									  // Fetching language code from session and thn from db fetching the language name ---------------- END--------------//
									$data = array(
									'is_logged_in' => true,
									'user_id' => $user['id'],
									'user_first_name' => $user['first_name'],
									'user_last_name' => $user['last_name'],
									'user_lang_id' => $this->session->userdata('Language_code'),
									'user_language_name'=>$user_language_name['language'],
									'user_email_address'=>$user['email_address'],
									'user_ph_no'=>$user['ph_no'],
									'user_country_code'=>$user['country_code'],
									'user_city'=>$user['city'],
									'user_zip_code'=>$user['zip_code']
									);
									$this->session->set_userdata("LOGGEDIN_USER",$data); 
									echo "<script type=\"text/javascript\">\n window.location = '";
									echo base_url().'user/my_account_home/';
									echo "';\n</script>";
							}
								
						}
						else///Not saved, show the form again
						{
						echo 'Registration failed!';
						// redirect(base_url().'admin/category');
						}
				 }
				 else
				 {
				 		echo 'Password And Confirm Password does not match !';
				 }		
				
			   }
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
}
/******************************** User SIGNUP END *****************************************************/
############# MyAccount Home Page Load function Start #############
 function my_account_home()
 {
 	$user_session_info = $this->session->userdata('LOGGEDIN_USER');
	try
	{
		if($this->session->userdata('LOGGEDIN_USER')){
         // Getting User Detail From Model 
		$this->data['user_detail']=$this->User_model->get_user_detail($user_session_info['user_id']);
		// Getting language Detail From Model for the specific User
		$this->data['user_language_detail']=$this->User_model->get_user_language_by_id($this->data['user_detail']['lang_id']);
		// Rendering The Veiw with data
		   $s_where =" WHERE n.user_id = '".($user_session_info['user_id'])."' AND n.is_cancelled = '0' ";
           
			$order_name = " n.booking_time";
			$order_by = " DESC";
			$s_where .= " ORDER BY {$order_name} {$order_by} ";
			$start=0;
			$limit = 3;
			$info	= $this->User_model->fetch_multi_my_booking($s_where, $order_name,$order_by,intval($start),$limit);
			$this->data['pageDetails'] = $info;
		
		$this->_renderViewFe('my_account_home', $this->data);
        }
        else
        {
            $this->login_check();  
        } 
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
	
 }
############# MyAccount Home Page Load function  End #############
############# User SignOut Function Start #############
 function sign_out()
 {
	try
	{
		$this->session->sess_destroy(); 
		$this->session->unset_userdata("LOGGEDIN_USER");
		redirect(base_url());
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
	
 }
############# User SignOut Function End #############

############# User My Account page load Function Start #############
 function my_account_my_info()
 {
 	 $user_session_info = $this->session->userdata('LOGGEDIN_USER');
	 try
	 {
		if($this->session->userdata('LOGGEDIN_USER')){
		// Getting User Detail From Model 
		$this->data['user_detail']=$this->User_model->get_user_detail($user_session_info['user_id']);
		// Getting language Detail From Model for the specific User
		$this->data['user_language_detail']=$this->User_model->get_user_language_by_id($this->data['user_detail']['lang_id']);
		// Getting country Detail From Model for the specific User
		$this->data['user_country_detail']=$this->User_model->get_user_country_by_id($this->data['user_detail']['country_code']);
		// Rendering The Veiw with data
		$this->_renderViewFe('my_account_my_info', $this->data);
		}
		else
		{
		$this->login_check();  
		} 
	 }
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
 }
############# User SignOut Function End #############
############# User My Account EDIT page load Function Start #############
 function my_account_edit()
 {
	$user_session_info = $this->session->userdata('LOGGEDIN_USER');
	try
	{
		if($this->session->userdata('LOGGEDIN_USER')){
		// Getting User Detail From Model 
		$this->data['user_detail']=$this->User_model->get_user_detail($user_session_info['user_id']);
		// Getting language Detail From Model for the specific User
		$this->data['user_language_detail']=$this->User_model->get_user_language_by_id($this->data['user_detail']['lang_id']);
		
		// Rendering The Veiw with data
		$this->_renderViewFe('my_account_edit', $this->data);
		}
		else
		{
		$this->login_check();  
		} 
	 }
   catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
 }
############# User SignOut Function End #############
############# User My Account Update Function Start #############
function my_account_update() {
	try
	{
			   unset($_POST['action']);
			   $posted=array();
			   $posted["first_name"]  			= trim($this->input->post("first_name"));
			   $posted["last_name"]  			= trim($this->input->post("last_name"));
			   $posted["address"]  				= trim($this->input->post("address"));
			   $posted["ph_no"]  				= trim($this->input->post("ph_no"));
			   $posted["id"]  					= $this->input->post("id");			   
			   $posted["lang_id"]  				= $this->input->post("lang_id");
			   $posted["city"]  				= $this->input->post("city");
			   $posted["country"]  				= $this->input->post("country");
			   $posted["zip_code"]  			= $this->input->post("zip_code");
			    
	/*			echo "<pre>";
				print_r($posted);
				echo "</pre>";
				die(); 	
				*/
				$this->form_validation->set_rules('first_name', 'first_name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('last_name', 'last_name', 'trim|required|xss_clean');
				$this->form_validation->set_message('required', 'Please fill in the fields');
				
			   if($this->form_validation->run() == FALSE)/////invalid
			   {
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			   }
			   else///validated, now save into DB
			   {
				//$logged_user = $this->session->userdata('logged_user');
				$info=array();
				$info['first_name']    			=   $posted['first_name'];
				$info['last_name']    			=   $posted['last_name'];
				$info['address']    			=   $posted['address'];
				$info['ph_no']    				=   $posted['ph_no'];
				$info['id']    				    =   $posted["id"];
				$info['lang_id']    			=   $posted["lang_id"];
				$info['city']    				=   $posted["city"];
				$info['country']    			=   $posted["country"];
				$info['zip_code']    			=   $posted["zip_code"];
/*				echo "<pre>";
				print_r($info);
				echo "</pre>";
				die();*/
				 		$i_aff=$this->User_model->edit_info($info,$posted["id"]);
						if($i_aff)////saved successfully
						{
                            
							$this->session->set_flashdata('message1', 'Your Profile Updated Successfully');
							$this->session->set_userdata('Language_code',$info['lang_id']);	
							echo "<script type=\"text/javascript\">\n window.location = '";
							echo base_url().'user/my_account_my_info/';
							echo "';\n</script>";						 
							
						}
						else///Not saved, show the form again
						{
     						//echo 'You have not Updated Anything!';
							echo "<script type=\"text/javascript\">\n window.location = '";
							echo base_url().'user/my_account_my_info/';
							echo "';\n</script>";						 
						  
						}
			   }
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
}
/******************************** User My Account Update Function End *****************************************************/
############# User My Account PASSWORD Update Function Start #############
function my_account_password_update() {
	try
	{
			   unset($_POST['action']);
			   $posted=array();
			   $posted["old_password"]  			= trim($this->input->post("old_password"));
			   $posted["new_password"]  			= trim($this->input->post("new_password"));
			   $posted["id"]  						= $this->input->post("id");			   
				$this->form_validation->set_rules('old_password', 'old_password', 'trim|required|xss_clean');
				$this->form_validation->set_rules('new_password', 'new_password', 'trim|required|xss_clean');
				if($this->form_validation->run() == FALSE)/////invalid
			   {
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			   }
			   else///validated, now save into DB
			   {
				//$logged_user = $this->session->userdata('logged_user');
				$info=array();
				$info['old_password']    			=   $posted['old_password'];
				$info['new_password']    			=   $posted['new_password'];
				$info['id']    				    	=   $posted["id"] ;
					if($info['old_password'] == $info['new_password'])
					{	
				 		$i_aff=$this->User_model->edit_password_info($info,$posted["id"]);
						if($i_aff)////saved successfully
						{
						echo 'You have Updated Your password successfully!';
						}
						else///Not saved, show the form again
						{
						echo 'You have not Updated Your password!';
						}
				     }
					 else
					 {
					 	echo 'Old Password and New Password are not same !!!!';
					 }
			   }
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
}
############# User My Account PASSWORD Update Function End #############
############# User New Email Add Function Start #############
public function my_account_add_email() {
	try
	{
			   unset($_POST['action']);
			   $posted=array();
			   $posted["new_email"]  			= trim($this->input->post("new_email"));
			   $posted["id"]  					= $this->input->post("id");			   
			   $this->form_validation->set_rules('new_email', 'new_email', 'trim|required|xss_clean');
			   $this->form_validation->set_message('required', 'Please fill in the fields');
			   if($this->form_validation->run() == FALSE)/////invalid
			   {
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			   }
			   else///validated, now save into DB
			   {
				$info=array();
				$info['new_email']    			=   $posted['new_email'];
				$info['id']    				    =   $posted["id"] ;
				 		$i_aff=$this->User_model->edit_add_new_email_info($info,$posted["id"]);
						if($i_aff)////saved successfully
						{
						echo 'Your new email has beeen added successfully!';
						}
						else///Not saved, show the form again
						{
						echo 'You have not Updated Anything!';
						}
				
			   }
  }
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
}
########### User New Email Add Function End #############
############# User Second Email Delete Function Start #############
public function delete_second_id() {
$user_session_info = $this->session->userdata('LOGGEDIN_USER');
	try
	{

			   unset($_POST['action']);
			   $posted=array();
			   $posted["new_email"]  			= trim($this->input->post("new_email"));
			   $posted["id"]  					= $user_session_info['user_id'];			   

				
				$info=array();
				$info['new_email']    			=   $posted['new_email'];
				$info['id']    				    =   $posted["id"] ;
				 		$i_aff=$this->User_model->delete_second_email_info($info,$posted["id"]);
						if($i_aff)////saved successfully
						{
						echo 'You have successfully deleted your second email id !!';
						}
						else///Not saved, show the form again
						{
						echo 'You have not deleted Anything!';
						}
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
}
############# User Second Email Delete Function Start #############
############# User Third Email Delete Function Start #############
public function delete_third_id() {
$user_session_info = $this->session->userdata('LOGGEDIN_USER');
	try
	{
			   unset($_POST['action']);
			   $posted=array();
			   $posted["new_email"]  			= trim($this->input->post("new_email"));
			   $posted["id"]  					= $user_session_info['user_id'];			   
				$info=array();
				$info['new_email']    			=   $posted['new_email'];
				$info['id']    				    =   $posted["id"] ;
				 		$i_aff=$this->User_model->delete_third_email_info($info,$posted["id"]);
						if($i_aff)////saved successfully
						{
						echo 'You have successfully deleted  your third email id !!';
						}
						else///Not saved, show the form again
						{
						echo 'You have not deleted Anything!';
						}
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
}
############# User Third Email Delete Function Start #############
############# User Second Email Edit Function Start #############
public function edit_second_id() {
$user_session_info = $this->session->userdata('LOGGEDIN_USER');
	try
	{
			   unset($_POST['action']);
			   $posted=array();
			   $posted["second_edit_email"]  	= trim($this->input->post("second_edit_email"));
			   $posted["id"]  					= $user_session_info['user_id'];			   
				$this->form_validation->set_rules('second_edit_email', 'second_edit_email', 'trim|required|xss_clean');
				$this->form_validation->set_message('required', 'Please fill in the fields');
			   if($this->form_validation->run() == FALSE)/////invalid
			   {
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			   }
			   else///validated, now save into DB
			   {
				$info=array();
				$info['second_edit_email']    			=   $posted['second_edit_email'];
				$info['id']    				    		=   $posted["id"] ;
				 		$i_aff=$this->User_model->edit_second_email_info($info,$posted["id"]);
						if($i_aff)////saved successfully
						{
						echo 'Your new email has beeen edited successfully!';
						}
						else///Not saved, show the form again
						{
						echo 'You have not Updated Anything!';
						}
			   }
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
}
############# User New Email Add Function End #############
############# User Third Email Add Function Start #############
public function edit_third_id() {
$user_session_info = $this->session->userdata('LOGGEDIN_USER');
	try
	{
			   unset($_POST['action']);
			   $posted=array();
			   $posted["third_edit_email"]  	= trim($this->input->post("third_edit_email"));
			   $posted["id"]  					= $user_session_info['user_id'];			   
				$this->form_validation->set_rules('third_edit_email', 'third_edit_email', 'trim|required|xss_clean');
				$this->form_validation->set_message('required', 'Please fill in the fields');
			   if($this->form_validation->run() == FALSE)/////invalid
			   {
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			   }
			   else///validated, now save into DB
			   {
				$info=array();
				$info['third_edit_email']    			=   $posted['third_edit_email'];
				$info['id']    				    		=   $posted["id"] ;
				$i_aff=$this->User_model->edit_third_email_info($info,$posted["id"]);
						if($i_aff)////saved successfully
						{
						echo 'Your new email has beeen edited successfully!';
						}
						else///Not saved, show the form again
						{
						echo 'You have not Updated Anything!';
						}
				}
  
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
}
############# User New Email Edit Function End #############
############# MyAccount MyBooking Page Load function Start #############
 function my_account_my_booking()
 {
 	$user_session_info = $this->session->userdata('LOGGEDIN_USER');
	try
	{
		if($this->session->userdata('LOGGEDIN_USER')){
         // Getting User Detail From Model 
		$this->data['user_detail']=$this->User_model->get_user_detail($user_session_info['user_id']);
		// Getting language Detail From Model for the specific User
		$this->data['user_language_detail']=$this->User_model->get_user_language_by_id($this->data['user_detail']['lang_id']);
		// Rendering The Veiw with data
		$this->_renderViewFe('my_account_my_booking', $this->data);
        }
        else
        {
            $this->login_check();  
        } 
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
 }
############# MyAccount MyBooking Page Load function  End #############
############# MyAccount MyReveiw Page Load function Start #############
/* function my_account_my_review()
 {
 	$user_session_info = $this->session->userdata('LOGGEDIN_USER');
	try
	{
		if($this->session->userdata('LOGGEDIN_USER')){
         // Getting User Detail From Model 
         if($_POST){
          $rating = $this->input->post('rating');   
          $review_comments = $this->input->post('review_comments');   
          // INSERT QUERY
          
         }
		$this->data['user_detail']=$this->User_model->get_user_detail($user_session_info['user_id']);
		// Getting language Detail From Model for the specific User
		$this->data['user_language_detail']=$this->User_model->get_user_language_by_id($this->data['user_detail']['lang_id']);
        $this->data["booked_hotels"] =$this->User_model->model_get_all_hotels_for_an_user($user_session_info['user_id']);
		$this->_renderViewFe('my_account_my_review', $this->data);
        }
        else
        {
            $this->login_check();  
        } 
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
	
 }
 */
############# MyAccount MyReveiw Page Load function  End #############
############# MyAccount MyBooking2 page load Function Start #############
 function my_account_my_booking2()
 {
	$user_session_info = $this->session->userdata('LOGGEDIN_USER');
	try
	{
		if($this->session->userdata('LOGGEDIN_USER')){
		// Getting User Detail From Model 
		$this->data['user_detail']=$this->User_model->get_user_detail($user_session_info['user_id']);
		// Getting language Detail From Model for the specific User
		$this->data['user_language_detail']=$this->User_model->get_user_language_by_id($this->data['user_detail']['lang_id']);
		// ***************************Getting Booking details *************************** 
			   $posted=array();
			   $posted["booking_number"]  	= trim($this->input->post("booking_number"));
			   $posted["pincode"]  			= trim($this->input->post("pincode"));
			  //print_r($posted);
			  //die();			   
				$this->form_validation->set_rules('booking_number', 'booking_number', 'trim|required|xss_clean');
				$this->form_validation->set_rules('pincode', 'pincode', 'trim|required|xss_clean');
				$this->form_validation->set_message('required', 'Please fill in the fields');
			   if($this->form_validation->run() == FALSE)/////invalid
			   {
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			   }
			   else
			   {
				$info=array();
				$info['booking_number']    			=   $posted['booking_number'];
				$info['pincode']    				=	$posted["pincode"] ;
				$this->data["booking"] =$this->User_model->model_my_account_my_booking2($info,$user_session_info['user_id']);
		// ***************************Getting Hotel details *************************** 				
					if(!empty($this->data["booking"]))
					{
					$this->data["hotel"] =$this->User_model->model_get_hotel_detail($this->data["booking"]["hotel_id"]);
					}
			   }
		// Rendering The Veiw with data
		$this->_renderViewFe('my_account_my_booking2', $this->data);
		}
		else
		{
		$this->login_check();  
		} 

	 }
   catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}

 }
############# MyAccount MyBooking2 Function End #############
############# MyAccount MyBookingAll page load Function Start #############
 function my_account_my_booking_all()
 {
	$user_session_info = $this->session->userdata('LOGGEDIN_USER');
	try
	{
		if($this->session->userdata('LOGGEDIN_USER')){
         // Getting User Detail From Model 
		$this->data['user_detail']=$this->User_model->get_user_detail($user_session_info['user_id']);
		// Getting language Detail From Model for the specific User
		$this->data['user_language_detail']=$this->User_model->get_user_language_by_id($this->data['user_detail']['lang_id']);
 		
		$this->data["all_hotels"] =$this->User_model->model_get_all_hotels_for_an_user($user_session_info['user_id']);
		// Rendering The Veiw with data
		$this->_renderViewFe('my_account_my_booking_all', $this->data);
        }
        else
        {
            $this->login_check();  
        } 
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
 }
############# MyAccount MyBookingALL Function End #############
############# forget password Page Load function Start #############
 public function forget_password()
 {
	try
	{
					if($this->input->post('ajax') == '1') {
					$this->form_validation->set_rules('forget_password_user_email', 'forget_password_user_email', 'trim|required|xss_clean');
					$this->form_validation->set_message('required', 'Please fill in the fields');
					if($this->form_validation->run() == FALSE) {
					echo validation_errors();
					} else {
							$this->load->model('User_model');
							//$user=$this->User_model->check_user($this->input->post('username'),$this->input->post('password'));
							$this->data["user_details"] =$this->User_model->forget_password($this->input->post('forget_password_user_email'));
							//print_r($this->data["user_details"]);
							if(!empty($this->data["user_details"]))
							{									
							
							$encripted_id=$this->data["user_details"]["encripted_id"];
							$sec_key=$this->data["user_details"]["sec_key"];
							$email_address=$this->data["user_details"]["email_address"];
							$site_root=base_url();
							/*$msg = "Dear User,
							<p>Please click on the below link to reset you password:</p> <p> <a href=".$site_root."user/password_reset/$encripted_id&/$sec_key>Reset Passowrd Here</a> </p><p>Regads,<br/>Team Bookingandyou.com </p>";*/
							
$msg="
<table style='width:700px; margin:0px auto; line-height:20px; background:#FFFFFF; color:#666666;font-size:12px;font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;' border='0' cellspacing='0' cellpadding='0'>

<tr>
<td style='border-top:6px solid #13b8e6;  padding-bottom:10px; text-align:right; color:#666666;'><a href=\"base_url()\"><img src=\'".base_url()."\images/logo.png' alt='logo' width='437' height='80' alt='ss' align='left'  /></a><br />&nbsp;</td>
<td></td>
</tr>
<tr>
<td style='padding:20px 0px 0px 0px;'>
<table style='padding-left:20px; font-size:14px; color:#999;' width='70%' border='0' cellspacing='6' cellpadding='6'>                       
<tr>
<td>Dear User,</td> 
</tr>
<tr>
<td>Please click on the below link to reset you password:</p> <p> <a href=".$site_root."user/password_reset/$encripted_id&/$sec_key>Reset Passowrd Here</a> </p><p>Regads,<br/>Team Bookingandyou.com </td>
</tr>

<tr>
<td><h4>Thanks,<br/> Booking And You Team</h4></td>
</tr>
</table>
<tr>
  <td style='border:1px solid #dadada; border-bottom:0px; background:#fff; padding:0px;'></td>
</tr>
<tr style='background:#CCC'>
  <td align='center' valign='middle' height='40px;'><em> &copy; Copyright 2013 by BookingandYou.com. All Rights Reserved. </em></td>
</tr>
</table>
";
													
							        $headers = "From: ADMIN_EMAIL";
//									$this->load->library('email');
									$email_from  = ADMIN_EMAIL;
									$this->email->from($email_from, 'Booking N You');
									$this->email->to($email_address);
									$this->email->bcc('siddharth@satyajittech.com');
									$this->email->subject('Reset Password : Booking N You');
									//echo $txt ;
									$this->email->message($msg);
									//echo $this->email->print_debugger();
									//die();
									if($this->email->send())
									{
										echo "Please check your email for password reset";									
									}
									else
									{
										echo "Email sending failed ..";		
									}	
	   
							}
							else
							{
							 echo "Email link is invalid now";
							}
				   }
			}
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
	
 }
############# forget password Page Load function  End #############
 public function password_reset($encripted_id,$sec_key)
 {
 	try
	{
/*echo "<br>id : ".*/$id = base64_decode($encripted_id);
/*echo "<br>key : ".*/$requested_security_key = trim($sec_key);
/*echo "<br>checkingkey : ".*/$checking_key = md5(SECURITY_KEY.$id);
/*echo "<br>id : ".*/$this->data['id']=$id;
		if($requested_security_key == $checking_key)
		{
			// Form Open
			$this->load->view('fe/password_reset',$this->data);
		}
		else
		{
			 echo " Keys mismatch !!";
		}
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
 }
  ############# User forget PASSWORD Update Function Start #############
function password_reset_update() {
	try
	{
               ob_start();
			   unset($_POST['action']);
			   $posted=array();
			   $posted["new_password"]  			= trim($this->input->post("new_password"));
			   $posted["confirm_password"]  		= trim($this->input->post("confirm_password"));
			   $posted["id"]  						= $this->input->post("id");	
				$this->form_validation->set_rules('new_password', 'new_password', 'trim|required|xss_clean');
				$this->form_validation->set_rules('confirm_password', 'confirm_password', 'trim|required|xss_clean');
				if($this->form_validation->run() == FALSE)/////invalid
			   {
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			   }
			   else///validated, now save into DB
			   {
				$info=array();
				$info['new_password']    			=   $posted['new_password'];
				$info['confirm_password']    			=   $posted['confirm_password'];
				$info['id']    				    	=   $posted["id"] ;
					if($info['new_password'] == $info['confirm_password'])
					{	
				 		$i_aff=$this->User_model->edit_forget_password_info($info,$posted["id"]);
						if($i_aff)////saved successfully
						{
						echo 'Your password upadted successfully!';
						//redirect(base_url());
						}
						else///Not saved, show the form again
						{
						echo 'Your password is allready updated!';
						//redirect(base_url());
						}
				     }
					 else
					 {
					 	echo 'Old Password and New Password are not same !!!!';
					 }
			   }
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
}
############# User forget PASSWORD Update Function End #############
############# General User Subscription Function Start #############
function subscribe_general() {
	try
	{

			   unset($_POST['action']);
			   $posted=array();
			   $posted["subscribe_emaii"]  			= trim($this->input->post("subscribe_emaii"));
			   $this->form_validation->set_rules('subscribe_emaii', 'subscribe_emaii', 'trim|required|xss_clean');
			   $this->form_validation->set_message('required', 'Please fill in the fields');
			   if($this->form_validation->run() == FALSE)/////invalid
			   {
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			   }
			   else///validated, now save into DB
			   {
				$info=array();
				$info['subscribe_emaii']    		=   $posted['subscribe_emaii'];
				$info["created_on"] 				= 	date("Y-m-d H:i:s");
						$i_newid = $this->User_model->add_general_subscription_info($info);
						if($i_newid)////saved successfully
						{
						echo 'Subscription Compelated !!';
						}
						else///Not saved, show the form again
						{
						echo 'Registration failed!';
						}
			   }
	}
	catch(Exception $err_obj)
	{
			show_error($err_obj->getMessage());
	}
}
############# General User Subscription Function End #############  
############# Start of My Booking List ############# 
function my_booking_list($start=NULL,$limit=NULL)
{
	try
	{
		 $user_session_info = $this->session->userdata('LOGGEDIN_USER');
			 		        ////////Getting Posted or session values for search///
		$s_itinerary_id=($this->input->post("txt_itinerary_id")?$this->input->post("txt_itinerary_id"):$this->session->userdata("txt_itinerary_id"));
		$s_confirmation_number=($this->input->post("txt_confirmation_number")?$this->input->post("txt_confirmation_number"):$this->session->userdata("txt_confirmation_number"));
		////////end Getting Posted or session values for search///
		$s_where =" WHERE n.user_id = '".($user_session_info['user_id'])."' AND n.is_cancelled = '0' ";
        if($s_itinerary_id!="")
		{
			$s_where .=" AND n.itinerary_id = '".trim($s_itinerary_id)."' ";
		}
		if($s_confirmation_number!="")
		{
			$s_where .=" AND n.confirmation_number = '".trim($s_confirmation_number)."' ";
		}
		$order_name = " n.booking_time";
		$order_by = " DESC";
		$s_where .= " ORDER BY {$order_name} {$order_by} ";
        unset($s_confirmation_number,$s_itinerary_id);
		$i_uri_seg = 3;
		$start=$this->uri->segment($i_uri_seg);
		if(empty($start))
		{
			$start=0;
		}
		else
		{
			$start=$start;
		}
		$this->i_uri_seg= $i_uri_seg;
		$this->s_pageurl= 'user/my_booking_list';
		$this->total_db_records = $this->User_model->gettotal_info_my_booking($s_where);
		$limit = $this->fe_page_limit();
		$this->i_uri_seg = $i_uri_seg;
		$this->fe_page_limit = $limit;
		$this->data["pagination"] = $this->get_fe_pagination($this->s_pageurl, $this->total_db_records, $this->fe_page_limit, $this->i_uri_seg);
		$info	= $this->User_model->fetch_multi_my_booking($s_where, $order_name,$order_by,intval($start),$limit);
		$this->data['pageDetails'] = $info;
		$this->_renderViewFe('my_booking_list', $this->data);
	}
	catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    } 
}
############# End of My Booking List #############     
############# Start of My Review List ############# 
function my_review_list($start=NULL,$limit=NULL)
{
     try
    {
        $user_session_info = $this->session->userdata('LOGGEDIN_USER');
        if($_POST){
           $posted = array();
           $posted["review_score"]      = trim($this->input->post("rating"));
           $posted["hotel_id"]          = trim($this->input->post("hotel_id"));           
           $posted["review_comments"]   = trim($this->input->post("review_comments")); 
           
            $this->form_validation->set_rules('rating', 'rating', 'trim|required|xss_clean');
               if($this->form_validation->run() == FALSE)/////invalid
               {
                ////////Display the add form with posted values within it////
                $this->data["posted"]=$posted;
               }
               else///validated, now save into DB
               {
                 $info["user_id"]           = $user_session_info['user_id'];
                 $info["review_score"]      = $posted["review_score"];
                 $info["hotel_id"]          = $posted["hotel_id"];
                 $info["review_comments"]   = $posted["review_comments"]; 
                 $info["review_date"]       = date('Y-m-d H:i:s');
                 $info["is_active"]         = '0';
                
                    $newid = $this->User_model->add_review_by_userid($info);
                    if($newid)
                    {
                     $this->session->set_flashdata('message', 'Review Submitted Successfully !');
                     redirect(base_url().'user/my_review_list');
                    }
                    else
                    {
                    
                    $this->session->set_flashdata('error', 'Error: Try Again!');
                    redirect(base_url().'user/my_review_list');                     
                    }               
               }
                  
        }
        $s_where =" WHERE bd.user_id = '".($user_session_info['user_id'])."' ";
        $order_name = " bd.booking_time";
        $order_by = " DESC";
        $s_where .= " ORDER BY {$order_name} {$order_by} ";
        $i_uri_seg = 3;
        $start=$this->uri->segment($i_uri_seg);
        if(empty($start))
        {
            $start=0;
        }
        else
        {
            $start=$start;
        }
        $this->i_uri_seg= $i_uri_seg;
        $this->s_pageurl= 'user/my_review_list';
        $this->total_db_records = $this->User_model->gettotal_info_my_review($s_where);
        $s_where1 = " WHERE user_id = '".($user_session_info['user_id'])."' ";
        $this->total_db_reviewed_records = $this->User_model->gettotal_info_my_reviewed($s_where1);
        $limit = $this->fe_page_limit();
        $this->i_uri_seg = $i_uri_seg;
        $this->fe_page_limit = $limit;
        $this->data["pagination"] = $this->get_fe_pagination($this->s_pageurl, $this->total_db_records, $this->fe_page_limit, $this->i_uri_seg);
        $info    = $this->User_model->fetch_multi_my_reviews($s_where, $order_name,$order_by,intval($start),$limit);
        $this->data['pageDetails'] = $info;
        $this->data['booked_records'] = $this->total_db_records;
        $this->data['reviewed_records'] = $this->total_db_reviewed_records;
        $this->_renderViewFe('my_account_my_review', $this->data);
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    } 
}
############# End of My Review List #############     
}
/* End of admin controller file index.php */
/* Location: ./system/application/controllers/admin/index.php */


