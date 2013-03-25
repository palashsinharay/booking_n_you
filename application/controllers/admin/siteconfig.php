<?php
/*
| ----------------------------------------------
| Start Date : 16-11-2010 
| Developer : Kousik Das (Limtex Technology)
| Framework : CodeIgniter
| ----------------------------------------------
| Main Siteconfig controller for Admin
| ----------------------------------------------
*/
class Siteconfig extends RB_Controller {

	public $alertMsg = false;
	public $menu = '9';

	function __construct()
	{
		parent::__construct();
		$this->_isLoggedIn();
		$this->session->set_userdata('menu', $this->menu);
		$this->load->model('Siteconf');
	}
	
	function index()
    {
		$operation = $this->input->post('action');
		switch(true) {
			case $operation == 'siteconf':
				$this->_updatesiteconf();
				break;
		}

		$pageDetails = $this->Siteconf->get_sitedetails();
        $data['pageDetails'] = $pageDetails;
        $this->_renderView('siteconfig', $data);
    }
	
	// ------------------------------------------------------------------------------//
    /*
     * Site Information Update
    */
    // ------------------------------------------------------------------------------//

    function _updatesiteconf()
	{
        $id             		= $this->input->post('id');
        $settingsCopyright 		= $this->input->post('SettingsCopyright');
        $settingsCurrency		= $this->input->post('SettingsCurrency');
        $settingsLanguage  		= $this->input->post('SettingsLanguage');
        $settingsEmail 			= $this->input->post('SettingsEmail');
        $settingsEmailSubject  	= $this->input->post('SettingsEmailSubject');
        $settingsEmailBody 		= $this->input->post('SettingsEmailBody');
        $settingsAckSubject 	= $this->input->post('SettingsAckSubject');
        $settingsAckBody 		= $this->input->post('SettingsAckBody');


        $dataArray = array(
		    'SettingsCopyright' => $settingsCopyright,
		    'SettingsCurrency' => $settingsCurrency,
		    'SettingsLanguage' => $settingsLanguage,
		    'SettingsEmail' => $settingsEmail,
		    'SettingsEmailSubject' => $settingsEmailSubject,
		    'SettingsEmailBody' => $settingsEmailBody,
		    'SettingsAckSubject' => $settingsAckSubject,
		    'SettingsAckBody' => $settingsAckBody
	    );
        
        if($this->Siteconf->update_siteconfig($id, $dataArray)) {
            $alertMsg = 'Site Configuration Updated successfully!';
            $this->session->set_flashdata('error', $alertMsg);
            redirect(base_url().'admin/siteconfig');
        } else {
            $alertMsg = 'Some Error happen please try again!';
            $this->session->set_flashdata('error', $alertMsg);
            redirect(base_url().'admin/siteconfig');
        }
    }

}

/* End of file siteconfig.php */
/* Location: ./system/application/controllers/admin/siteconfig.php */