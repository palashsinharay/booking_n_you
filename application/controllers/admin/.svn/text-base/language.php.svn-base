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

class Language extends RB_Controller {

	public $menu = '2';

	function __construct(){
		parent::__construct();
		$this->_isLoggedIn();
		$this->session->set_userdata('menu', $this->menu);
		$this->load->model('Language_model');
	}

    function index($order_name='',$order_by='asc',$start=NULL,$limit=NULL)
    {
	 	try
		{
			$operation = $this->input->post('action');
			switch(true) {
				case $operation == 'add':
				$this->languageAdd();
				break;
				
				case $operation == 'update':
				$this->languageUpdate();
				break;
				
			}
			 
			 		            ////////Getting Posted or session values for search///
            $s_search=(isset($_POST["h_search"])?$this->input->post("h_search"):$this->session->userdata("h_search"));
			$s_language_code=($this->input->post("h_search")?$this->input->post("txt_language_code"):$this->session->userdata("txt_language_code"));
			$s_language_name=($this->input->post("h_search")?$this->input->post("txt_language_name"):$this->session->userdata("txt_language_name"));
			////////end Getting Posted or session values for search///
            
            
            $s_where="";
			$s_where .=" WHERE n.id IS NOT NULL ";
            if($s_search=="basic")
            {
				if($s_language_code!="")
				{
					$s_where .=" AND n.lng_id LIKE '%".get_formatted_string($s_language_code)."%' ";
				}
				if($s_language_name!="")
				{
					$s_where .=" AND n.language LIKE '%".get_formatted_string($s_language_name)."%' ";
				}
                /////Storing search values into session///
				$this->session->set_userdata("txt_language_code",$s_language_code);
				$this->session->set_userdata("txt_language_name",$s_language_name);
                $this->session->set_userdata("h_search",$s_search);
                
                $this->data["h_search"]				=	$s_search;
				$this->data["txt_language_code"]	=	$s_language_code;
				$this->data["txt_language_name"]	=	$s_language_name;
                /////end Storing search values into session///
            }
            else////List all records, **not done
            {
                $s_where=" WHERE n.id IS NOT NULL ";;
                /////Releasing search values from session///
				$this->session->unset_userdata("txt_language_code");
				$this->session->unset_userdata("txt_language_name");
                $this->session->unset_userdata("h_search");
                
                $this->data["h_search"]				=	$s_search;
				$this->data["txt_language_code"]	=	"";   
				$this->data["txt_language_name"]	=	"";                 
                /////end Storing search values into session///                 
            }
            unset($s_search, $s_language_code, $s_language_name);
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
			
			$arr_sort = array(0=>'lng_id'); 
			$s_order_name = !empty($order_name)?in_array(($order_name),$arr_sort)?($order_name):$arr_sort[0]:$arr_sort[0];
		  
			//$limit	= $this->i_admin_page_limit;
			$this->i_admin_page_limit = $this->fe_page_limit();
			$limit	= $this->i_admin_page_limit;
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			
			
			$this->i_uri_seg=$i_uri_seg;
			$this->s_pageurl= 'language/index';
			$this->total_db_records = $this->Language_model->gettotal_info($s_where);
			
			$data["pagination"]=$this->get_admin_pagination($this->s_pageurl, $this->total_db_records, $this->i_admin_page_limit, $this->i_uri_seg);
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			$info	= $this->Language_model->fetch_multi_sorted_list($s_where,$s_order_name,$order_by,intval($start),$limit);
			
			$data['pageDetails'] = $info;
			$this->_renderView('language', $data);
			 
		}
		catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
    }
	
	public function languageAdd()           
	{
		try
		{
			unset($_POST['action']);
			$posted=array();
			$posted["lng_id"]		=	trim($this->input->post("lng_id"));
			$posted["language"]		=	trim($this->input->post("language"));
			
			$this->form_validation->set_rules('lng_id', 'language Code', 'required');
			$this->form_validation->set_rules('language', 'language Name', 'required');
		  
			if($this->form_validation->run() == FALSE)/////invalid
			{
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			}
			else///validated, now save into DB
			{
				$info=array();
				$info['lng_id']  	=   $posted['lng_id'];
				$info['language']  	=   $posted['language'];
				$info["is_active"]	=	'0';

				$i_newid = $this->Language_model->add_info($info);
				if($i_newid)////saved successfully
				{
					$alertMsg = 'language Added successfully!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/language');
				}
				else///Not saved, show the form again
				{
					$alertMsg = 'Some Error happen please try again!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/language');
				}
				
			}
		
		
			
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
	}

	
	public function languageUpdate(){
		try
        {
			unset($_POST['action']);
			$posted=array();
			$posted["Id"]			=	trim($this->input->post("id1"));
			$posted["lng_id"]		=	trim($this->input->post("lng_id"));
			$posted["language"]		=	trim($this->input->post("language"));
			
			$this->form_validation->set_rules('lng_id', 'language Code', 'required');
			$this->form_validation->set_rules('language', 'language Name', 'required');
              
                if($this->form_validation->run() == FALSE)/////invalid
                {
                    ////////Display the add form with posted values within it////
                    $this->data["posted"]=$posted;
                }
                else///validated, now save into DB
                {
					$info=array();
					$info['lng_id']  		=   $posted['lng_id'];
					$info['language']  		=   $posted['language'];
                    $info["is_active"]		=	'0';
					
					$i_aff=$this->Language_model->edit_info($info,$posted["Id"]);
					if($i_aff)////saved successfully
                    {
						$alertMsg = 'language Updated successfully!';
						$this->session->set_flashdata('error', $alertMsg);
						redirect(base_url().'admin/language');
                    }
                    else///Not saved, show the form again
                    {
                        $alertMsg = 'Some Error happen please try again!';
						$this->session->set_flashdata('error', $alertMsg);
						redirect(base_url().'admin/language');
                    }
                    
                }
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
    }
	
	
/*
 * Delete language
 * @access   public
 */
    function language_delete($id = 0)
    {

		 if($this->Language_model->delete($id)){
            $alertMsg = 'Language Deleted!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/language');
    }

/*
 * Staus Change language
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
        if($this->Language_model->change_status($id, $cond)) {
            $alertMsg = 'Status Changed!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/language');
    }

	public function __destruct()
    {}
}
?>