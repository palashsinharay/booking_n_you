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

class Currency extends RB_Controller {

	public $menu = '1';

	function __construct(){
		parent::__construct();
		$this->_isLoggedIn();
		$this->session->set_userdata('menu', $this->menu);
		$this->load->model('Currency_model');
	}

    function index($order_name='',$order_by='asc',$start=NULL,$limit=NULL)
    {
	 	try
		{
			$operation = $this->input->post('action');
			switch(true) {
				case $operation == 'add':
				$this->currencyAdd();
				break;
				
				case $operation == 'update':
				$this->currencyUpdate();
				break;
				
			}
			 
			 		            ////////Getting Posted or session values for search///
            $s_search=(isset($_POST["h_search"])?$this->input->post("h_search"):$this->session->userdata("h_search"));
			$s_currency_code=($this->input->post("h_search")?$this->input->post("txt_currency_code"):$this->session->userdata("txt_currency_code"));
			$s_currency_name=($this->input->post("h_search")?$this->input->post("txt_currency_name"):$this->session->userdata("txt_currency_name"));
			////////end Getting Posted or session values for search///
            
            
            $s_where="";
			$s_where .=" WHERE n.id IS NOT NULL ";
            if($s_search=="basic")
            {
				if($s_currency_code!="")
				{
					$s_where .=" AND n.currency_id LIKE '%".get_formatted_string($s_currency_code)."%' ";
				}
				if($s_currency_name!="")
				{
					$s_where .=" AND n.currency_details LIKE '%".get_formatted_string($s_currency_name)."%' ";
				}
                /////Storing search values into session///
				$this->session->set_userdata("txt_currency_code",$s_currency_code);
				$this->session->set_userdata("txt_currency_name",$s_currency_name);
                $this->session->set_userdata("h_search",$s_search);
                
                $this->data["h_search"]				=	$s_search;
				$this->data["txt_currency_code"]	=	$s_currency_code;
				$this->data["txt_currency_name"]	=	$s_currency_name;
                /////end Storing search values into session///
            }
            else////List all records, **not done
            {
                $s_where=" WHERE n.id IS NOT NULL ";;
                /////Releasing search values from session///
				$this->session->unset_userdata("txt_currency_code");
				$this->session->unset_userdata("txt_currency_name");
                $this->session->unset_userdata("h_search");
                
                $this->data["h_search"]				=	$s_search;
				$this->data["txt_currency_code"]	=	"";   
				$this->data["txt_currency_name"]	=	"";                 
                /////end Storing search values into session///                 
            }
            unset($s_search, $s_currency_code, $s_currency_name);
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
			
			$arr_sort = array(0=>'currency_id'); 
			$s_order_name = !empty($order_name)?in_array(($order_name),$arr_sort)?($order_name):$arr_sort[0]:$arr_sort[0];
		  
			//$limit	= $this->i_admin_page_limit;
			$this->i_admin_page_limit = $this->fe_page_limit();
			$limit	= $this->i_admin_page_limit;
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			
			
			$this->i_uri_seg=$i_uri_seg;
			$this->s_pageurl= 'currency/index';
			$this->total_db_records = $this->Currency_model->gettotal_info($s_where);
			
			$data["pagination"]=$this->get_admin_pagination($this->s_pageurl, $this->total_db_records, $this->i_admin_page_limit, $this->i_uri_seg);
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			$info	= $this->Currency_model->fetch_multi_sorted_list($s_where,$s_order_name,$order_by,intval($start),$limit);
			
			$data['pageDetails'] = $info;
			$this->_renderView('currency', $data);
			 
		}
		catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
    }
	
	public function currencyAdd()           
	{
		try
		{
			unset($_POST['action']);
			$posted=array();
			$posted["currency_id"]			=	trim($this->input->post("currency_id"));
			$posted["currency_details"]		=	trim($this->input->post("currency_details"));
			
			$this->form_validation->set_rules('currency_id', 'Currency Code', 'required');
			$this->form_validation->set_rules('currency_details', 'Currency Name', 'required');
		  
			if($this->form_validation->run() == FALSE)/////invalid
			{
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			}
			else///validated, now save into DB
			{
				$info=array();
				$info['currency_id']  		=   $posted['currency_id'];
				$info['currency_details']  	=   $posted['currency_details'];
				$info["is_active"]			=	'0';

				$i_newid = $this->Currency_model->add_info($info);
				if($i_newid)////saved successfully
				{
					$alertMsg = 'Currency Added successfully!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/currency');
				}
				else///Not saved, show the form again
				{
					$alertMsg = 'Some Error happen please try again!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/currency');
				}
				
			}
		
		
			
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
	}

	
	public function currencyUpdate(){
		try
        {
			unset($_POST['action']);
			$posted=array();
			$posted["Id"]					=	trim($this->input->post("id1"));
			$posted["currency_id"]			=	trim($this->input->post("currency_id"));
			$posted["currency_details"]		=	trim($this->input->post("currency_details"));
			
			$this->form_validation->set_rules('currency_id', 'Currency Code', 'required');
			$this->form_validation->set_rules('currency_details', 'Currency Name', 'required');
              
                if($this->form_validation->run() == FALSE)/////invalid
                {
                    ////////Display the add form with posted values within it////
                    $this->data["posted"]=$posted;
                }
                else///validated, now save into DB
                {
					$info=array();
					$info['currency_id']  			=   $posted['currency_id'];
					$info['currency_details']  		=   $posted['currency_details'];
                    $info["is_active"]				=	'0';
					
					$i_aff=$this->Currency_model->edit_info($info,$posted["Id"]);
					if($i_aff)////saved successfully
                    {
						$alertMsg = 'Currency Updated successfully!';
						$this->session->set_flashdata('error', $alertMsg);
						redirect(base_url().'admin/currency');
                    }
                    else///Not saved, show the form again
                    {
                        $alertMsg = 'Some Error happen please try again!';
						$this->session->set_flashdata('error', $alertMsg);
						redirect(base_url().'admin/currency');
                    }
                    
                }
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
    }
	
	
/*
 * Delete currency
 * @access   public
 */
    function currency_delete($id = 0)
    {
        if($this->Currency_model->delete($id)){
            $alertMsg = 'currency Deleted!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/currency');
    }

/*
 * Staus Change currency
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
        if($this->Currency_model->change_status($id, $cond)) {
            $alertMsg = 'Status Changed!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/currency');
    }

	public function __destruct()
    {}
}
?>