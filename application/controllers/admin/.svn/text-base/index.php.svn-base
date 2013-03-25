<?php
/*
| ----------------------------------------------
| Start Date : 07-12-2012
| Developer : Kafil Akhter (Satyajit Limited)
| Framework : CodeIgniter
| ----------------------------------------------
| Main index controller for backend
| ----------------------------------------------
*/

class Index extends RB_Controller {


    /**
    * Load default admin home page
    *
    * @access    private
    * @param    string
    */
	function __construct()
	{
		parent::__construct();
		$this->_isLoggedIn();
	}
    function index()
    {
        //var_dump($this->session->userdata('logged_admin_user')); die();
     
        if($this->session->userdata('logged_admin_user')){

            $this->_renderView();  
        }
        else
        {
            $this->login();  
        } 
    } 
	
	function download_me($file_name=''){
	
		$file_path		=	FCPATH.'Document/BPD_CMS.pdf';
		header('Content-disposition: attachment; filename=BPD_CMS.pdf');
		header('Content-type: application/pdf');
		readfile($file_path);
	
	}

    // --------------------------------------------------------------------
  
}

	
/* End of admin controller file index.php */
/* Location: ./system/application/controllers/admin/index.php */


