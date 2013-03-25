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

class Booking extends RB_Controller {

	public $menu = '5';

	function __construct(){
		parent::__construct();
		$this->_isLoggedIn();
		$this->session->set_userdata('menu', $this->menu);
		$this->load->model('Booking_model');
	}

    function index($order_name='',$order_by='asc',$start=NULL,$limit=NULL)
    {
	 	try
		{
			$operation = $this->input->post('action');
			/*switch(true) {
				case $operation == 'add':
				$this->bookingAdd();
				break;
				
				case $operation == 'update':
				$this->bookingUpdate();
				break;
				
			}*/
			 
			 		            ////////Getting Posted or session values for search///
            $s_search=(isset($_POST["h_search"])?$this->input->post("h_search"):$this->session->userdata("h_search"));
			$s_itinerary_id=($this->input->post("h_search")?$this->input->post("txt_itinerary_id"):$this->session->userdata("txt_itinerary_id"));
			$s_confirmation_number=($this->input->post("h_search")?$this->input->post("txt_confirmation_number"):$this->session->userdata("txt_confirmation_number"));
			////////end Getting Posted or session values for search///
            
            
            $s_where="";
			$s_where .=" WHERE n.user_id IS NOT NULL ";
            if($s_search=="basic")
            {
				if($s_itinerary_id!="")
				{
					$s_where .=" AND n.itinerary_id LIKE '%".get_formatted_string($s_itinerary_id)."%' ";
				}
				if($s_confirmation_number!="")
				{
					$s_where .=" AND n.confirmation_number LIKE '%".get_formatted_string($s_confirmation_number)."%' ";
				}
                /////Storing search values into session///
				$this->session->set_userdata("txt_itinerary_id",$s_itinerary_id);
				$this->session->set_userdata("txt_confirmation_number",$s_confirmation_number);
                $this->session->set_userdata("h_search",$s_search);
                
                $this->data["h_search"]				=	$s_search;
				$this->data["txt_itinerary_id"]	=	$s_itinerary_id;
				$this->data["txt_confirmation_number"]	=	$s_confirmation_number;
                /////end Storing search values into session///
            }
            else////List all records, **not done
            {
                $s_where=" WHERE n.user_id IS NOT NULL ";;
                /////Releasing search values from session///
				$this->session->unset_userdata("txt_itinerary_id");
				$this->session->unset_userdata("txt_confirmation_number");
                $this->session->unset_userdata("h_search");
                
                $this->data["h_search"]				=	$s_search;
				$this->data["txt_itinerary_id"]	=	"";   
				$this->data["txt_confirmation_number"]	=	"";                 
                /////end Storing search values into session///                 
            }
            unset($s_search, $s_itinerary_id, $s_confirmation_number);
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
			
			$arr_sort = array(0=>'booking_time'); 
			$s_order_name = !empty($order_name)?in_array(($order_name),$arr_sort)?($order_name):$arr_sort[0]:$arr_sort[0];
		  
			//$limit	= $this->i_admin_page_limit;
			$this->i_admin_page_limit = $this->fe_page_limit();
			$limit	= $this->i_admin_page_limit;
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			
			
			$this->i_uri_seg=$i_uri_seg;
			$this->s_pageurl= 'booking/index';
			$this->total_db_records = $this->Booking_model->gettotal_info($s_where);
			
			$data["pagination"]=$this->get_admin_pagination($this->s_pageurl, $this->total_db_records, $this->i_admin_page_limit, $this->i_uri_seg);
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			$info	= $this->Booking_model->fetch_multi_sorted_list($s_where,$s_order_name,$order_by,intval($start),$limit);
			
			$data['pageDetails'] = $info;
			$this->_renderView('booking', $data);
			 
		}
		catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
    }
	
	/*
	 * Delete booking
	 * @access   public
	 */
    function booking_delete($id = 0)
    {

		 if($this->Booking_model->delete($id)){
            $alertMsg = 'Booking Deleted!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/booking');
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
                $info=$this->Booking_model->fetch_this($i_id);

                if(!empty($info))
                {
                        $temp=array();
                        $temp["id"]					= 	$info["id"];
                        $temp["user_id"]			= 	trim($info["user_id"]);
                        $temp["hotel_id"]			= 	trim($info["hotel_id"]);
                        $temp["check_in"]			=	trim($info["check_in"]);
						
						$temp["check_out"]			=	trim($info["check_out"]);
						$temp["max_person"]			=	trim($info["max_person"]);
						$temp["no_of_rooms"]		=	trim($info["no_of_rooms"]);
						$temp["rate"]				=	trim($info["rate"]);
						$temp["currency"]			=	trim($info["currency"]);

                        $temp["itinerary_id"]		= 	trim($info["itinerary_id"]);
                        $temp["confirmation_number"]= 	($info["confirmation_number"]);
						
						$temp["city"]				= 	($info["city"]);
						$temp["country_code"]		= 	($info["country_code"]);
						$temp["is_cancelled"]		= 	($info["is_cancelled"]);
						$temp["booking_time"]		= 	($info["booking_time"]);
						$temp["hotelname"]			= 	($info["hotelname"]);
						$temp["username"]			= 	($info["username"]);

                        $this->data["info"]=$temp;
                        unset($temp);
                }
                unset($info);
            }
			
			$this->load->view('admin/show_detail_booking', $this->data);
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