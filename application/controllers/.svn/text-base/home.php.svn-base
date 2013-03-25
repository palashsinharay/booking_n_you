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

class Home extends RB_Controller {


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
		$this->load->model('CountryList_model');
		$this->load->model('Country_model');
		$this->load->model('Destination_model');
		$this->load->model('Cms_model');
		$this->default_language_currency_session();
	}
	
    function index()
    {
      try{
	   // var_dump($this->session->userdata('logged_user')); die();
		$this->pageTitle = '::: Booking and You :::';
		
		$this->data["Most_Viewed_Hotel"] =  $this->ActivePropertyList_model->findMostViewed();
		$this->data["LANG"] = $this->change_language_text();

		$s_where_feature = " WHERE n.is_featured = '0' ";
		$i_start_feature = 0;
		$i_limit_feature = 3;
		$this->data['Featured_Destination'] = $this->Destination_model->fetch_multi($s_where_feature,$i_start_feature,$i_limit_feature);
		
		/*$condition = "ActivePropertyList.country <> ''";
		$this->data["All_Country_From_Hotel"] =  $this->ActivePropertyList->find();
		
		$this->data["Top_Destination"] =  $this->Destination->find();*/
		
		$s_where_top = " WHERE n.is_featured = '0' AND n.is_topten <> '0' ";
		$i_start_top = 0;
		$i_limit_top = 10;
		$this->data['Top_Destination'] = $this->Destination_model->fetch_multi($s_where_top,$i_start_top,$i_limit_top);
		
		 // Total Hotels
		 $hotel_count	=	$this->ActivePropertyList_model->get_total_hotels();
		 $this->data['hotel_count'] = $hotel_count;

		 // Total Country
		 $country_count	=	$this->ActivePropertyList_model->get_total_country();
		 $this->data['country_count'] = $country_count;
		 
		  
		$this->_renderViewFe('index', $this->data);
	  }
	  catch(Exception $err_obj)
	  {
			show_error($err_obj->getMessage());
	  }
		
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

    // --------------------------------------------------------------------
	function change_current_language($lng_id)
	{
		try{
			
			$this->session->unset_userdata('Language_code');
			$this->session->set_userdata('Language_code', $lng_id);
			
		}catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}
		
	}
    // --------------------------------------------------------------------
    function change_current_currency($Currency_code)
    {
        try{
            
            $this->session->unset_userdata('Currency_code');
            $this->session->set_userdata('Currency_code', trim($Currency_code));
            
        }catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }
        
    }  
	 
	function destinations()
    {
        try{
			$this->data["LANG"] = $this->change_language_text();
            $this->data['pageTitle'] = '::: Booking and You ::: - Destinations';
            $this->_renderViewFe('destinations', $this->data);
            
        }catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }
        
    } 
		/******************************** About Us Page *****************************************************/
	function about_us($id=null){	
	try{	
			$this->data["LANG"] = $this->change_language_text();
			$PageUrl = $this->uri->segment(1);
			$pageDetail = $this->Cms_model->fetch_content($PageUrl);
			if(!empty($pageDetail)){
			#For Meta Section#		
			$this->data['page_name'] = $pageDetail[0]->PageName;
			$this->data['page_title'] = SITENAME.' '.$pageDetail[0]->PageTitle;
			$this->data['meta_description'] = $pageDetail[0]->PageMeta;
			$this->data['meta_keywords']	= $pageDetail[0]->PageKeyword;
			$this->data['page_content']	= $pageDetail[0]->PageContent;
			}else{
				$this->data['page_name'] = '';
			$this->data['page_title'] = '';
			$this->data['meta_description'] = '';
			$this->data['meta_keywords']	= '';
			$this->data['page_content']	= '';
			}
			
			$this->_renderViewFe('about_us', $this->data);	
    	}catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }
		#For Meta Section#
	}
	/******************************** About Us Page *****************************************************/
	/******************************** FAQ Page *****************************************************/
	function faq($id=null){	
	try{	
			$this->data["LANG"] = $this->change_language_text();
			#For Meta Section#	
			$PageUrl = $this->uri->segment(1);
			$pageDetail = $this->Cms_model->fetch_content($PageUrl);
			#For Meta Section#		
			if(!empty($pageDetail)){
			#For Meta Section#		
			$this->data['page_name'] = $pageDetail[0]->PageName;
			$this->data['page_title'] = SITENAME.' '.$pageDetail[0]->PageTitle;
			$this->data['meta_description'] = $pageDetail[0]->PageMeta;
			$this->data['meta_keywords']	= $pageDetail[0]->PageKeyword;
			$this->data['page_content']	= $pageDetail[0]->PageContent;
			}else{
				$this->data['page_name'] = '';
			$this->data['page_title'] = '';
			$this->data['meta_description'] = '';
			$this->data['meta_keywords']	= '';
			$this->data['page_content']	= '';
			}
			
			$this->_renderViewFe('faq', $this->data);
		}catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }	
		#For Meta Section#
	}
	/******************************** FAQ Page *****************************************************/
	/******************************** Terms & Conditions Page *****************************************************/
	function terms_conditions($id=null){	
	try{	
			$this->data["LANG"] = $this->change_language_text();
			#For Meta Section#
			$PageUrl = $this->uri->segment(1);
			$pageDetail = $this->Cms_model->fetch_content($PageUrl);
			#For Meta Section#		
			if(!empty($pageDetail)){
			#For Meta Section#		
			$this->data['page_name'] = $pageDetail[0]->PageName;
			$this->data['page_title'] = SITENAME.' '.$pageDetail[0]->PageTitle;
			$this->data['meta_description'] = $pageDetail[0]->PageMeta;
			$this->data['meta_keywords']	= $pageDetail[0]->PageKeyword;
			$this->data['page_content']	= $pageDetail[0]->PageContent;
			}else{
				$this->data['page_name'] = '';
			$this->data['page_title'] = '';
			$this->data['meta_description'] = '';
			$this->data['meta_keywords']	= '';
			$this->data['page_content']	= '';
			}
			
			$this->_renderViewFe('terms_conditions', $this->data);	
		}catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }		
		#For Meta Section#
	}
	/******************************** Terms & Conditions Page *****************************************************/
	/******************************** Privacy statement Page *****************************************************/
	function privacy($id=null){	
		try{	
			$this->data["LANG"] = $this->change_language_text();
			#For Meta Section#	
			$PageUrl = $this->uri->segment(1);
			$pageDetail = $this->Cms_model->fetch_content($PageUrl);
			#For Meta Section#		
			if(!empty($pageDetail)){
			#For Meta Section#		
			$this->data['page_name'] = $pageDetail[0]->PageName;
			$this->data['page_title'] = SITENAME.' '.$pageDetail[0]->PageTitle;
			$this->data['meta_description'] = $pageDetail[0]->PageMeta;
			$this->data['meta_keywords']	= $pageDetail[0]->PageKeyword;
			$this->data['page_content']	= $pageDetail[0]->PageContent;
			}else{
				$this->data['page_name'] = '';
			$this->data['page_title'] = '';
			$this->data['meta_description'] = '';
			$this->data['meta_keywords']	= '';
			$this->data['page_content']	= '';
			}
			
			$this->_renderViewFe('privacy', $this->data);	
		}catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }		
     	#For Meta Section#
	}
	/******************************** Privacy statement Page *****************************************************/
	/******************************** How It Works  Page *****************************************************/
	function how_it_works($id=null){
     try{	
			$this->data["LANG"] = $this->change_language_text();
			#For Meta Section#
			$PageUrl = $this->uri->segment(1);
			$pageDetail = $this->Cms_model->fetch_content($PageUrl);
			#For Meta Section#		
			if(!empty($pageDetail)){
			#For Meta Section#		
			$this->data['page_name'] = $pageDetail[0]->PageName;
			$this->data['page_title'] = SITENAME.' '.$pageDetail[0]->PageTitle;
			$this->data['meta_description'] = $pageDetail[0]->PageMeta;
			$this->data['meta_keywords']	= $pageDetail[0]->PageKeyword;
			$this->data['page_content']	= $pageDetail[0]->PageContent;
			}else{
				$this->data['page_name'] = '';
			$this->data['page_title'] = '';
			$this->data['meta_description'] = '';
			$this->data['meta_keywords']	= '';
			$this->data['page_content']	= '';
			}
			
			$this->_renderViewFe('how_it_works', $this->data);
		}catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }	
		#For Meta Section#
	}
	/******************************** How It Works  Page *****************************************************/

  
}

	
/* End of admin controller file index.php */
/* Location: ./system/application/controllers/admin/index.php */


