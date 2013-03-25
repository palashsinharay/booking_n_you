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

class Admins extends RB_Controller {

	public $menu = '0';

	function __construct(){
		parent::__construct();
		$this->_isLoggedIn();
		$this->session->set_userdata('menu', $this->menu);
		$this->load->model('Admin_model');
	}

    function index($order_name='',$order_by='asc',$start=NULL,$limit=NULL)
    {
	 	try
		{
			$operation = $this->input->post('action');
			switch(true) {
				case $operation == 'add':
				$this->adminAdd();
				break;
				
				case $operation == 'update':
				$this->adminUpdate();
				break;
				
			}
			 
			 		            ////////Getting Posted or session values for search///
            $s_search=(isset($_POST["h_search"])?$this->input->post("h_search"):$this->session->userdata("h_search"));
			$s_username=($this->input->post("h_search")?$this->input->post("txt_username"):$this->session->userdata("txt_username"));
			$s_admin_email=($this->input->post("h_search")?$this->input->post("txt_admin_email"):$this->session->userdata("txt_admin_email"));
			////////end Getting Posted or session values for search///
            
            
            $s_where="";
			$s_where .=" WHERE n.UserActive = 'Y' ";
            if($s_search=="basic")
            {
				if($this->session->userdata['logged_admin_user']['AdminsStatus'] != 'S'){
					$s_where .= " AND n.id <> '1' ";
				}
				if($s_username!="")
				{
					$s_where .=" AND n.username LIKE '%".get_formatted_string($s_username)."%' ";
				}
				if($s_admin_email!="")
				{
					$s_where .=" AND n.admin_email LIKE '%".get_formatted_string($s_admin_email)."%' ";
				}
                /////Storing search values into session///
				$this->session->set_userdata("txt_username",$s_username);
				$this->session->set_userdata("txt_admin_email",$s_admin_email);
                $this->session->set_userdata("h_search",$s_search);
                
                $this->data["h_search"]				=	$s_search;
				$this->data["txt_username"]			=	$s_username;
				$this->data["txt_admin_email"]		=	$s_admin_email;
                /////end Storing search values into session///
            }
            else////List all records, **not done
            {
				if($this->session->userdata['logged_admin_user']['AdminsStatus'] == 'S'){
					$s_where = " WHERE n.UserActive = 'Y' ";
				}else{
					 $s_where = " WHERE n.UserActive = 'Y' AND n.id <> '1' ";
				}
                /////Releasing search values from session///
				$this->session->unset_userdata("txt_username");
				$this->session->unset_userdata("txt_admin_email");
                $this->session->unset_userdata("h_search");
                
                $this->data["h_search"]				=	$s_search;
				$this->data["txt_username"]			=	"";   
				$this->data["txt_admin_email"]		=	"";                 
                /////end Storing search values into session///                 
            }
            unset($s_search, $s_username, $s_admin_email);
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
			
			$arr_sort = array(0=>'id'); 
			$s_order_name = !empty($order_name)?in_array(($order_name),$arr_sort)?($order_name):$arr_sort[0]:$arr_sort[0];
		  
			//$limit	= $this->i_admin_page_limit;
			$this->i_admin_page_limit = $this->fe_page_limit();
			$limit	= $this->i_admin_page_limit;
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			
			
			$this->i_uri_seg=$i_uri_seg;
			$this->s_pageurl= 'admins/index';
			$this->total_db_records = $this->Admin_model->gettotal_info($s_where);
			
			$data["pagination"]=$this->get_admin_pagination($this->s_pageurl, $this->total_db_records, $this->i_admin_page_limit, $this->i_uri_seg);
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			$info	= $this->Admin_model->fetch_multi_sorted_list($s_where,$s_order_name,$order_by,intval($start),$limit);
			
			$data['pageDetails'] = $info;
			$this->_renderView('admins', $data);
			 
		}
		catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
    }
	
	public function adminAdd()           
	{
		try
		{
			unset($_POST['action']);
			$posted=array();
			$posted["username"]			=	trim($this->input->post("username"));
			$posted["password"]			=	trim($this->input->post("password"));
			$posted["conf_password"]	=	trim($this->input->post("conf_password"));
			$posted["admin_email"]		=	trim($this->input->post("admin_email"));
			$posted["admin_name"]		=	trim($this->input->post("admin_name"));
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('conf_password', 'Confirm Password', 'required|matches[password]');
			$this->form_validation->set_rules('admin_email', 'Email', 'valid_email|required');
			$this->form_validation->set_rules('admin_name', 'Name', 'required');
		  
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

				$i_newid = $this->Admin_model->add_info($info);
				if($i_newid)////saved successfully
				{
					$alertMsg = 'Admin Added successfully!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/admins');
				}
				else///Not saved, show the form again
				{
					$alertMsg = 'Some Error happen please try again!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/admins');
				}
				
			}
		
		
			
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
	}

	
	public function adminUpdate(){
		try
        {
			unset($_POST['action']);
			$posted=array();
			$posted["Id"]				=	trim($this->input->post("id1"));
			$posted["username"]			=	trim($this->input->post("username"));
			$posted["password"]			=	trim($this->input->post("password"));
			$posted["conf_password"]	=	trim($this->input->post("conf_password"));
			$posted["admin_email"]		=	trim($this->input->post("admin_email"));
			$posted["admin_name"]		=	trim($this->input->post("admin_name"));
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('admin_email', 'Email', 'required');
			$this->form_validation->set_rules('admin_name', 'Name', 'required');
			
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
					
					$i_aff=$this->Admin_model->edit_info($info,$posted["Id"]);
					if($i_aff)////saved successfully
                    {
						$alertMsg = 'Admin Updated successfully!';
						$this->session->set_flashdata('error', $alertMsg);
						redirect(base_url().'admin/admins');
                    }
                    else///Not saved, show the form again
                    {
                        $alertMsg = 'Some Error happen please try again!';
						$this->session->set_flashdata('error', $alertMsg);
						redirect(base_url().'admin/admins');
                    }
                    
                }
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
    }
	
	
/*
 * Delete admins
 * @access   public
 */
    function delete_admin($id = 0)
    {

		 if($this->Admin_model->delete($id)){
            $alertMsg = 'admins Deleted!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/admins');
    }

/*
 * Staus Change admins
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
        if($this->Admin_model->change_status($id, $cond)) {
            $alertMsg = 'Status Changed!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/admins');
    }

	public function __destruct()
    {}
}
?>