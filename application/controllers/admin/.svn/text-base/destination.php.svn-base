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

class Destination extends RB_Controller {

	public $menu = '7';

	function __construct(){
		parent::__construct();
		$this->_isLoggedIn();
		$this->session->set_userdata('menu', $this->menu);
		$this->load->model('Destination_model');
		
		 /* Faciliteis Image */
		  $this->allowedExt = 'jpg|jpeg|png';
		  //for uploading images to this folder
		  $this->uploaddir = $this->config->item('admin_destination_image_upload_path');	
		  //for uploading image thumbnails to this folder
		  $this->thumbdir = $this->config->item('admin_destination_image_thumb_upload_path');
		  $this->thumbdirSmall = $this->config->item('admin_destination_image_thumb_small_upload_path');
		  //for display thumbnails image 
		  $this->smallthumbDisplayPath = $this->config->item('destination_image_thumb_small_path');
	}

    function index($order_name='',$order_by='asc',$start=NULL,$limit=NULL)
    {
	 	try
		{
			$operation = $this->input->post('action');
			switch(true) {
				case $operation == 'add':
				$this->destinationAdd();
				break;
				
				case $operation == 'update':
				$this->destinationUpdate();
				break;
				
			}
			 
			 		            ////////Getting Posted or session values for search///
            $s_search=(isset($_POST["h_search"])?$this->input->post("h_search"):$this->session->userdata("h_search"));
			$s_destination_code=($this->input->post("h_search")?$this->input->post("txt_destination_code"):$this->session->userdata("txt_destination_code"));
			$s_country_code=($this->input->post("h_search")?$this->input->post("txt_country_code"):$this->session->userdata("txt_country_code"));
			////////end Getting Posted or session values for search///
            
            
            $s_where="";
			$s_where .=" WHERE n.id IS NOT NULL ";
            if($s_search=="basic")
            {
				if($s_destination_code!="")
				{
					$s_where .=" AND n.city LIKE '%".get_formatted_string($s_destination_code)."%' ";
				}
				if($s_country_code!="")
				{
					$s_where .=" AND n.country_code = '".$s_country_code."' ";
				}
                /////Storing search values into session///
				$this->session->set_userdata("txt_destination_code",$s_destination_code);
				$this->session->set_userdata("txt_country_code",$s_country_code);
                $this->session->set_userdata("h_search",$s_search);
                
                $this->data["h_search"]				=	$s_search;
				$this->data["txt_destination_code"]	=	$s_destination_code;
				$this->data["txt_country_code"]	=	$s_country_code;
                /////end Storing search values into session///
            }
            else////List all records, **not done
            {
                $s_where=" WHERE n.id IS NOT NULL ";;
                /////Releasing search values from session///
				$this->session->unset_userdata("txt_destination_code");
				$this->session->unset_userdata("txt_country_code");
                $this->session->unset_userdata("h_search");
                
                $this->data["h_search"]				=	$s_search;
				$this->data["txt_destination_code"]	=	"";   
				$this->data["txt_country_code"]	=	"";                 
                /////end Storing search values into session///                 
            }
            unset($s_search, $s_destination_code, $s_country_code);
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
			$this->s_pageurl= 'destination/index';
			$this->total_db_records = $this->Destination_model->gettotal_info($s_where);
			
			$data["pagination"]=$this->get_admin_pagination($this->s_pageurl, $this->total_db_records, $this->i_admin_page_limit, $this->i_uri_seg);
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			$info	= $this->Destination_model->fetch_multi_sorted_list($s_where,$s_order_name,$order_by,intval($start),$limit);
			
			$data['pageDetails'] = $info;
			$this->_renderView('destination', $data);
			 
		}
		catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
    }
	
	public function destinationAdd()           
	{
		try
		{
			unset($_POST['action']);
			$posted=array();
			$posted["destination_id"]	=	$this->input->post("destination_id");
			$posted["country_code"]		=	trim($this->input->post("country_code"));
			$posted["is_featured"]		=	trim($this->input->post("is_featured"));
			$posted["is_topten"]		=	trim($this->input->post("is_topten"));
			
			$this->form_validation->set_rules('destination_id', 'Destination', 'required');
			$this->form_validation->set_rules('country_code', 'Country', 'required');
			
			if(isset($_FILES['destination_img']) && !empty($_FILES['destination_img']['name']))
			{
				$s_uploaded_filename = get_file_uploaded( $this->uploaddir,'destination_img','','',$this->allowedExt);
				$arr_upload_res = explode('|',$s_uploaded_filename);						
			}

		  
			if($this->form_validation->run() == FALSE)/////invalid
			{
				// Display upload error
				if($arr_upload_res[0]==='err')
				{
					set_error_msg($arr_upload_res[2]);
				}
				else
				{
					get_file_deleted($this->uploaddir,$arr_upload_res[2]);
				}
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			}
			else///validated, now save into DB
			{
				$info=array();
				
				$destination_id = explode(',', $posted['destination_id']);
				
				$info['destination_id']  		=   $destination_id[0];
				$info['type']  					=   '1';
				$info["city"]					=	$destination_id[1];
				$info["state_province_code"]	=	'0';
				$info["country_code"]			=	$posted["country_code"];
				$info["address"]				=	$destination_id[1].','.$posted["country_code"];
				$info["postal_code"]			=	'0';
				$info["destination_string"]		=	'0';
				$info["destination_img"]		=	$arr_upload_res[2];
				$info["is_featured"]			=	$posted["is_featured"];
				$info["is_topten"]				=	$posted["is_topten"];
				
				
				$i_newid = $this->Destination_model->add_info($info);
				if($i_newid)////saved successfully
				{
					if($arr_upload_res[0]==='ok')
						{
							get_image_thumb($this->uploaddir.$info["destination_img"], $this->thumbdir, $info["destination_img"],138,485);
							get_image_thumb($this->uploaddir.$info["destination_img"], $this->thumbdirSmall, $info["destination_img"],30,74);
						}
					$alertMsg = 'destination Added successfully!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/destination');
				}
				else///Not saved, show the form again
				{
					$alertMsg = 'Some Error happen please try again!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/destination');
				}
				
			}
		
		
			
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
	}

	
	public function destinationUpdate(){
		try
        {
			unset($_POST['action']);
			$arr_upload_res = array();
			$posted=array();
			$posted["Id"]				=	trim($this->input->post("id1"));
			$posted["destination_id"]	=	$this->input->post("destination_id");
			$posted["country_code"]		=	trim($this->input->post("country_code"));
			$posted["h_destimage"]		= 	trim($this->input->post("h_destimage"));
			$posted["is_featured"]		=	trim($this->input->post("is_featured"));
			$posted["is_topten"]		=	trim($this->input->post("is_topten"));
			
			$this->form_validation->set_rules('destination_id', 'Destination', 'required');
			$this->form_validation->set_rules('country_code', 'Country', 'required');
			
			if(isset($_FILES['destination_img']) && !empty($_FILES['destination_img']['name']))
			{
				$s_uploaded_filename = get_file_uploaded( $this->uploaddir,'destination_img','','',$this->allowedExt);
				$arr_upload_res = explode('|',$s_uploaded_filename);						
			}

              
			if($this->form_validation->run() == FALSE)/////invalid
			{
				////////Display the add form with posted values within it////
					if($arr_upload_res[0]==='err')
					{
						set_error_msg($arr_upload_res[2]);
					}
					else
					{
						get_file_deleted($this->uploaddir,$arr_upload_res[2]);
					}
				$this->data["posted"]=$posted;
			}
			else///validated, now save into DB
			{
				$info=array();
				$destination_id = explode(',', $posted['destination_id']);
				$info['destination_id']  		=   $destination_id[0];
				$info['type']  					=   '1';
				$info["city"]					=	$destination_id[1];
				$info["state_province_code"]	=	'0';
				$info["country_code"]			=	$posted["country_code"];
				$info["address"]				=	$destination_id[1].','.$posted["country_code"];
				$info["postal_code"]			=	'0';
				$info["destination_string"]		=	'0';
				//$info["destination_img"]		=	$arr_upload_res[2];
				if(count($arr_upload_res)== 0)
				{
					$info["destination_img"] = $posted['h_destimage'];
				}
				else
				{
					$info["destination_img"] = $arr_upload_res[2];
				}
				$info["is_featured"]			=	$posted["is_featured"];
				$info["is_topten"]				=	$posted["is_topten"];
				
				$i_aff=$this->Destination_model->edit_info($info,$posted["Id"]);
				if($i_aff)////saved successfully
				{
					if($arr_upload_res[0]==='ok')
					{
						//get_image_thumb($this->uploaddir.$info["s_person_image"], $this->thumbdir, 'thumb_'.$info["s_person_image"],$this->uploadHeight,$this->uploadWidth);
						get_image_thumb($this->uploaddir.$info["destination_img"], $this->thumbdir, $info["destination_img"],138,485);
						get_image_thumb($this->uploaddir.$info["destination_img"], $this->thumbdirSmall, $info["destination_img"],30,74);
						get_file_deleted($this->uploaddir,$posted['h_destimage']);
						get_file_deleted($this->thumbdir, $posted['h_destimage']);
						get_file_deleted($this->thumbdirSmall, $posted['h_destimage']);
					}

					
					$alertMsg = 'destination Updated successfully!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/destination');
				}
				else///Not saved, show the form again
				{
					$alertMsg = 'Some Error happen please try again!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/destination');
				}
				
			}
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
    }
	
	
/*
 * Delete destination
 * @access   public
 */
    function destination_delete($id = 0)
    {

		 if($this->Destination_model->delete($id)){
            $alertMsg = 'Destination Deleted!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/destination');
    }

/*
 * Staus Change destination
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
        if($this->Destination_model->change_status($id, $cond)) {
            $alertMsg = 'Status Changed!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/destination');
    }

	public function __destruct()
    {}
}
?>