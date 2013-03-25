<?php

/*
| ----------------------------------------------
| Start Date : 14-01-2013 
| Developer : Kafil Akhter
| Framework : CodeIgniter
| ----------------------------------------------
| Main Cms controller for Admin
| ----------------------------------------------
*/

class Cms extends RB_Controller {

    public $menuChain = array();
    public $alertMsg = false;
    public $cumbs = array();
	public $menu = '6';

	function __construct()
	{
        parent::__construct();
        $this->_isLoggedIn();
		$this->session->set_userdata('menu', $this->menu);
		$this->load->model('Cms_model');
	}
    
    // ------------------------------------------------------------------------------//
    /*
     * Index Function
    */
    // ------------------------------------------------------------------------------//

    function index()
	{
        $operation = $this->input->post('action');
        switch(true) {
	        case $operation == 'add':
		        $this->_menuadd();
		        break;
	        case $operation == 'update':
		        $this->_menuupdate();
		        break;
	       
        }

        $pageDetails = $this->Cms_model->get_content();
        $data['pageDetails'] = $pageDetails;
        $this->_renderView('cms', $data);
	}
    
    // ------------------------------------------------------------------------------//
    /*
     * CMS Insert or Add
    */
    // ------------------------------------------------------------------------------//
    
    function _menuadd()
    {
        $lang_id 		= $this->input->post('lang_id');
        $rootPage		 = 0;
        $PageName 		= $this->input->post('PageName');
        $PageUrl 		= $this->input->post('PageUrl');
        $PageContent 	= $this->input->post('PageContent');
        $PageTitle 		= $this->input->post('PageTitle');
        $PageKeyword 	= $this->input->post('PageKeyword');
        $PageMeta 		= $this->input->post('PageMeta');
        $PageDate 		= date('Y-m-d');
		$PageType		= 'E';
		$page_location  = 'f';
		$PagePublish    = '0';
		$PageDelete     = '0';
		
        $dataArray = array(
            'lang_id' => $lang_id,
            'rootPage' => $rootPage,
            'PageName' => $PageName,
            'PageUrl' => $PageUrl,
            'PageContent' => $PageContent,
            'PageTitle' => $PageTitle,
            'PageKeyword' => $PageKeyword,
            'PageMeta' => $PageMeta,
            'PageDate' => $PageDate,
            'PageType' => $PageType,
			'page_location' => $page_location,
			'PagePublish' => $PagePublish,
			'PageDelete' => $PageDelete
			
        );
        
        if($this->Cms_model->add_cms($dataArray)) {
            $alertMsg = 'Page added successfully!';
            $this->session->set_flashdata('error', $alertMsg);
            redirect(base_url().'admin/cms');
        } else {
            $alertMsg = 'Some Error happen please try again!';
            $this->session->set_flashdata('error', $alertMsg);
            redirect(base_url().'admin/cms');
        }
		
    }

    // ------------------------------------------------------------------------------//
    /*
     * CMS Update
    */
    // ------------------------------------------------------------------------------//

    function _menuupdate()
	{
        $id             = $this->input->post('menu_id');
        $menutitle 		= $this->input->post('menutitle');
        $ptitle		 	= $this->input->post('ptitle');
        $pheading 		= $this->input->post('pheading');
        $plink 			= $this->input->post('plink');
        $content 		= $this->input->post('content');
        $type 			= $this->input->post('c_type');
        $metadesc 		= $this->input->post('metadesc');
        $metakey 		= $this->input->post('metakey');
        $status 		= 1;
        $date 			= date('Y-m-d');
        $pid            = $this->input->post('pid');


        $dataArray = array(
		    'menutitle' => $menutitle,
		    'ptitle' => $ptitle,
		    'pheading' => $pheading,
		    'plink' => $plink,
		    'content' => $content,
		    'type' => $type,
		    'metadesc' => $metadesc,
		    'metakey' => $metakey,
		    'status' => $status,
		    'date' => $date,
		    'pid' => $pid
	    );
        
        if($this->Cms_model->update_cms($id, $dataArray)) {
            $alertMsg = 'Page Updated successfully!';
            $this->session->set_flashdata('error', $alertMsg);
            redirect(base_url().'admin/cms/showSubmenu/'.$pid.'');
        } else {
            $alertMsg = 'Some Error happen please try again!';
            $this->session->set_flashdata('error', $alertMsg);
            redirect(base_url().'admin/cms/showSubmenu/'.$pid.'');
        }
    }
    
    // ------------------------------------------------------------------------------//
    /*
     * Sub-Page Insert or Add under A Page.
    */
    // ------------------------------------------------------------------------------//

    // ------------------------------------------------------------------------------//
    /*
     * Staus Change CMS
    */
    // ------------------------------------------------------------------------------//    

    function cms_status($id = 0, $pid = 0, $status = 0)
    {
	    if($status == 1) {
		    $st = 0;
	    } else {
		    $st = 1;
	    }
	    $cond = array('status' => $st);

	    if($this->Cms_model->change_status($id, $cond)) {
	        $alertMsg = 'Status Changed!';
	    } else {
	        $alertMsg = 'Some Error happen please try again!';
	    }

	    $this->session->set_flashdata('error', $alertMsg);
	    redirect(base_url().'admin/cms/showSubmenu/'.$pid.'');
    }


    // ------------------------------------------------------------------------------//
    /*
     * CMS Delete 
    */
    // ------------------------------------------------------------------------------//
    
    function cms_delete($pid = 0, $id = 0)
    {
    	$cond = array('id' => $id);
		if($this->Cms_model->delete($cond)) {
		$alertMsg = 'Page Deleted!';
		} else {
		$alertMsg = '<font color="#FF0000">Some Error happen please try again!</font>';
		}
	    $this->session->set_flashdata('error', $alertMsg);
	    redirect(base_url().'admin/cms');
    }
	
	public function __destruct()
    {}
}

// --------------------------------------------
// End of CMS Controller Class
// Page cms.php
// --------------------------------------------