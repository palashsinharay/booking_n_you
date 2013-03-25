<?php
/*
| ----------------------------------------------
| Start Date : 07-01-2013
| Developer : Kafil A Siddiqui (Satyjit Limited)
| Framework : CodeIgniter
| ----------------------------------------------
| Main Goods_Receipts controller for Admin
| ----------------------------------------------
*/

class User extends RB_Controller {

	public $menu = '4';

	function __construct(){
		parent::__construct();
		$this->_isLoggedIn();
		$this->session->set_userdata('menu', $this->menu);
		$this->load->model('User_model');
	}

    function index($order_name='',$order_by='asc',$start=NULL,$limit=NULL)
    {
	 	try
		{
			$operation = $this->input->post('action');
			switch(true) {
				/*case $operation == 'add':
				$this->userAdd();
				break;*/
				
				case $operation == 'update':
				$this->userUpdate();
				break;
				
			}
			 
            $s_search=(isset($_POST["h_search"])?$this->input->post("h_search"):$this->session->userdata("h_search"));
			$s_first_name=($this->input->post("h_search")?$this->input->post("txt_first_name"):$this->session->userdata("txt_first_name"));
			$s_last_name=($this->input->post("h_search")?$this->input->post("txt_last_name"):$this->session->userdata("txt_last_name"));
			$s_email_address=($this->input->post("h_search")?$this->input->post("txt_email_address"):$this->session->userdata("txt_email_address"));
			////////end Getting Posted or session values for search///
            
            
            $s_where="";
			$s_where .=" WHERE n.is_active = '0' ";
            if($s_search=="basic")
            {
				if($s_first_name!="")
				{
					$s_where .=" AND n.first_name LIKE '%".get_formatted_string($s_first_name)."%' ";
				}
				if($s_last_name!="")
				{
					$s_where .=" AND n.last_name LIKE '%".get_formatted_string($s_last_name)."%' ";
				}
				if($s_email_address!="")
				{
					$s_where .=" AND n.email_address LIKE '%".get_formatted_string($s_email_address)."%' ";
				}
                /////Storing search values into session///
				$this->session->set_userdata("txt_first_name",$s_first_name);
				$this->session->set_userdata("txt_last_name",$s_last_name);
				$this->session->set_userdata("txt_email_address",$s_email_address);
                $this->session->set_userdata("h_search",$s_search);
                
                $this->data["h_search"]				    =	$s_search;
				$this->data["txt_first_name"]			=	$s_first_name;
				$this->data["txt_last_name"]			=	$s_last_name;
				$this->data["txt_email_address"]		=	$s_email_address;
                /////end Storing search values into session///
            }
            else////List all records, **not done
            {
				$s_where =" WHERE n.is_active = '0' ";
                /////Releasing search values from session///
				$this->session->unset_userdata("txt_first_name");
				$this->session->unset_userdata("txt_last_name");
				$this->session->unset_userdata("txt_email_address");
                $this->session->unset_userdata("h_search");
                
                $this->data["h_search"]				    =	$s_search;
				$this->data["txt_first_name"]			=	"";   
				$this->data["txt_last_name"]			=	"";   
				$this->data["txt_email_address"]		=	"";                 
                /////end Storing search values into session///                 
            }
            unset($s_search, $s_first_name, $s_last_name, $s_email_address);
            ///Setting Limits, If searched then start from 0////
		
			//Setting Limits, If searched then start from 0////
			$i_uri_seg =4;
			if($this->input->post("h_search"))
			{
				$start=0;
			}
			else
			{
				$start=$this->uri->segment($i_uri_seg);
			}
			
			$arr_sort = array(0=>'created_on'); 
			$s_order_name = !empty($order_name)?in_array(($order_name),$arr_sort)?($order_name):$arr_sort[0]:$arr_sort[0];
		  
			//$limit	= $this->i_admin_page_limit;
			$this->i_admin_page_limit = $this->fe_page_limit();
			$limit	= $this->i_admin_page_limit;
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			
			
			$this->i_uri_seg=$i_uri_seg;
			$this->s_pageurl= 'user/index';
			$this->total_db_records = $this->User_model->gettotal_info($s_where);
			
			$data["pagination"]=$this->get_admin_pagination($this->s_pageurl, $this->total_db_records, $this->i_admin_page_limit, $this->i_uri_seg);
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			$info	= $this->User_model->fetch_multi_sorted_list($s_where,$s_order_name,$order_by,intval($start),$limit);
			
			$data['pageDetails'] = $info;
			$this->_renderView('user', $data);
			 
		}
		catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
    }
	
/*	public function userAdd()           
	{
		try
		{
			unset($_POST['action']);
			$posted=array();
			$posted["email_address"]	=	trim($this->input->post("email_address"));
			$posted["first_name"]		=	trim($this->input->post("first_name"));
			$posted["last_name"]		=	trim($this->input->post("last_name"));
			$posted["lang_id"]			=	trim($this->input->post("lang_id"));
			$posted["address"]			=	trim($this->input->post("address"));
			$posted["city"]				=	trim($this->input->post("city"));
			$posted["zip_code"]			=	trim($this->input->post("zip_code"));
			$posted["country_code"]		=	trim($this->input->post("country_code"));
			
			$this->form_validation->set_rules('email_address', 'Email', 'valid_email|required');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');

		  
			if($this->form_validation->run() == FALSE)/////invalid
			{
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			}
			else///validated, now save into DB
			{
				$info=array();
				$info['username']  			=   $posted['username'];
				$info['password']  			=   $posted['password'];
				$info['admin_email']  		=   $posted['admin_email'];
				$info['admin_name']  		=   $posted['admin_name'];
				$info['UserStatus']  		=   'U';
				$info['UserActive']  		=   'Y';
				$info['ShowPage']  			=   'N';
				$info['ShowUser']  			=   'N';
				$info['ShowMetaSection']  	=   'N';

				$i_newid = $this->User_model->add_info($info);
				if($i_newid)////saved successfully
				{
					$alertMsg = 'User Added successfully!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/user');
				}
				else///Not saved, show the form again
				{
					$alertMsg = 'Some Error happen please try again!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/user');
				}
				
			}
		
		
			
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
	}*/

	
	public function userUpdate(){
		try
        {
			unset($_POST['action']);
			$posted=array();
			$posted["Id"]				=	trim($this->input->post("id1"));
			//$posted["email_address"]	=	trim($this->input->post("email_address"));
			$posted["first_name"]		=	trim($this->input->post("first_name"));
			$posted["last_name"]		=	trim($this->input->post("last_name"));
			$posted["lang_id"]			=	trim($this->input->post("lang_id"));
			$posted["address"]			=	trim($this->input->post("address"));
			$posted["city"]				=	trim($this->input->post("city"));
			$posted["zip_code"]			=	trim($this->input->post("zip_code"));
			$posted["country_code"]		=	trim($this->input->post("country_code"));
			
			//$this->form_validation->set_rules('email_address', 'Email', 'valid_email|required');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			
                if($this->form_validation->run() == FALSE)/////invalid
                {
                    ////////Display the add form with posted values within it////
                    $this->data["posted"]=$posted;
                }
                else///validated, now save into DB
                {
					$info=array();
					//$info['email_address']  		=   $posted['email_address'];
					$info['first_name']  			=   $posted['first_name'];
					$info['last_name']  			=   $posted['last_name'];
					$info['lang_id']  				=   $posted['lang_id'];
					$info['address']  				=   $posted['address'];
					$info['city']  					=   $posted['city'];
					$info['country']  				=   $posted['country_code'];
					$info['zip_code']  				=   $posted['zip_code'];
					
					
					$i_aff=$this->User_model->edit_info($info,$posted["Id"]);
					if($i_aff)////saved successfully
                    {
						$alertMsg = 'User Updated successfully!';
						$this->session->set_flashdata('error', $alertMsg);
						redirect(base_url().'admin/user');
                    }
                    else///Not saved, show the form again
                    {
                        $alertMsg = 'Some Error happen please try again!';
						$this->session->set_flashdata('error', $alertMsg);
						redirect(base_url().'admin/user');
                    }
                    
                }
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
    }
	
	
/*
 * Delete user
 * @access   public
 */
    function delete_user($id = 0)
    {

		 if($this->User_model->delete($id)){
            $alertMsg = 'user Deleted!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/user');
    }

/*
 * Staus Change user
 *
 * @access   public
 */
    function change_status($id = 0, $status = '0')
    {
		if($status == '0') {
			$st = '1';
		} else {
			$st = '0';
		}
        $cond = array('is_active' => $st);
        if($this->User_model->change_status($id, $cond)) {
            $alertMsg = 'Status Changed!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/user');
    }
   /***
    * Shows details of a single record.
    * 
    * @param int $i_id, Primary key
    */
    public function show_detail($i_id=0)
    {
        try
        {
            if(trim($i_id)!="")
            {
                $info=$this->User_model->fetch_this($i_id);

                if(!empty($info))
                {
                        $temp=array();
                        $temp["id"]				= 	$info["id"];
                        $temp["first_name"]		= 	trim($info["first_name"]);
                        $temp["last_name"]		= 	trim($info["last_name"]);
                        $temp["email_address"]	=	trim($info["email_address"]);
						
						$temp["address"]		=	trim($info["address"]);
						$temp["city"]			=	trim($info["city"]);
						$temp["zip_code"]		=	trim($info["zip_code"]);
						$temp["country"]		=	trim($info["country"]);
						$temp["ph_no"]			=	trim($info["ph_no"]);

                        $temp["is_active"]		= 	trim($info["is_active"]);
                        $temp["created_on"]		= 	($info["created_on"]);

                        $this->data["info"]=$temp;
                        unset($temp);
                }
                unset($info);
            }
			
			$this->load->view('admin/show_detail', $this->data);
            unset($i_id);
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }         
    }

	public function __destruct()
    {}
}
?>