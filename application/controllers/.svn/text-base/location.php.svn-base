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

class Location extends RB_Controller {


    /**
    * Load default admin home page
    *
    * @access    private
    * @param    string
    */
	function __construct()
	{
		parent::__construct();
		$this->load->model('ActivePropertyList_model');
		$this->load->model('location_model');
	}
	
    function index()
    {
       // var_dump($this->session->userdata('logged_user')); die();
		$this->pageTitle = '::: Booking and You :::';
		$this->data["LANG"] = $this->change_language_text();
		$this->data["Most_Viewed_Hotel"] =  $this->ActivePropertyList_model->findMostViewed();
		
		/*$cond = array('Destination.is_featured' => '0','limit' => '3');
		$this->data["Featured_Destination"] =  $this->Destination->find();*/
		
		
		
		/*$condition = "ActivePropertyList.country <> ''";
		$this->data["All_Country_From_Hotel"] =  $this->ActivePropertyList->find();
		
		$this->data["Top_Destination"] =  $this->Destination->find();*/

		$this->_renderViewFe('index', $this->data);
		
		
    } 
	
	function ajax_autocomplete_location($location=null)
	{
		if(!$location)
		{
			return false;
		}
		$location = str_ireplace("%20"," ",$location);
		
		$this->load->model('location_model');
		$s_where = " WHERE  n.region_name LIKE '{$location}%'";
		$location_list = $this->location_model->fetch_multi($s_where);
		if($location_list)
		{
			foreach($location_list as $val)
			{
				/*if(strstr($val['region_name'], '(') !== false){
					
					$string_first = explode(",",$val['region_name']);
					$postion_first = strpos( $string_first[0], '(');
					$postion_last = strpos( $string_first[0], ')');
					$string_first[0] =substr($string_first[0],0,$postion_first);
					if(!empty($string_first[2])){
					$arr_string_first = array(trim($string_first[0]) , trim($string_first[1]) , trim($string_first[2]));
					}elseif(!empty($string_first[1])){
						$arr_string_first = array(trim($string_first[0]) , trim($string_first[1]));
					}
					else{
						$arr_string_first = array($string_first[0]);
					}
					$string_region_name = implode(",", $arr_string_first);
				
				echo '<div class="autocomplete_link" onclick="business_fill(\''. htmlspecialchars ($string_region_name).'^'.$val['region_id'].'\');">'.$string_region_name.'</div>';
				}else{
					echo '<div class="autocomplete_link" onclick="business_fill(\''. htmlspecialchars ($val['region_name']).'^'.$val['region_id'].'\');">'.$val['region_name'].'</div>';
				}*/
				echo '<div class="autocomplete_link" onclick="business_fill(\''. htmlspecialchars ($val['region_name']).'^'.$val['region_id'].'\');">'.$val['region_name'].'</div>';
			}
		}
	}
	/******************************** Region Coordinate Code Fetch Function Page *****************************************************/
   /******************************** Region Coordinate Code Fetch Function Page *****************************************************/
	
	

    // --------------------------------------------------------------------
  
}

	
/* End of admin controller file index.php */
/* Location: ./system/application/controllers/admin/index.php */


