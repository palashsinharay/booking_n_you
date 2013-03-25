<?php

/*
| ----------------------------------------------
| Start Date : 16-11-2010 
| Developer : Kousik Das (Limtex Technology)
| Framework : CodeIgniter
| ----------------------------------------------
| Main Changepassword controller for Admin
| ----------------------------------------------
*/
class Changepassword extends RB_Controller {



	 /**
    * Admin Change Password section
    *
    * @access    public
    */
	
	public $menu = '9';

	function __construct()
	{
        parent::__construct();
        $this->_isLoggedIn();
		$this->session->set_userdata('menu', $this->menu);
		$this->load->model('Admin_model');
	}
	
    function index()
    {



        $agentData = $this->session->userdata('logged_user');
        if($this->input->post('formname')){
            unset($_POST['formname']);
            $cond = array('id' => $agentData[0]->id);

            $_POST['old_password'] = ($_POST['old_password']);
            $_POST['password'] = ($_POST['password']);
            $_POST['conf_password'] = ($_POST['conf_password']);

            $res = $this->Admin_model->isOldPass($_POST['old_password']);

            if($res > 0)
            {
                if($_POST['password'] == $_POST['conf_password'])
                {
                    unset($_POST['old_password'], $_POST['conf_password']);

                    if($this->Admin_model->update($cond, $_POST)){
                        $alertMsg = 'Password Updated!';
                    }else{
                        $alertMsg = 'Some Error happen please try again!';
                    }
                }
                else
                    $alertMsg = 'New Password and Confirm Password are not same! please try again!';
            }
            else
                $alertMsg = 'Old password is wrong! please try again!';

            $this->session->set_flashdata('error', $alertMsg);
            redirect(base_url().'admin/changepassword');
            die();
        }
        $this->_renderView('changepassword');


    }
}

/* End of file changepassword.php */
/* Location: ./system/application/controllers/admin/changepassword.php */