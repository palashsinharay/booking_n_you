<?php
/*
| ----------------------------------------------
| Start Date : 07-12-2012 
| Developer : Kafil Akhter (Satyajit Limited)
| Framework : CodeIgniter
| ----------------------------------------------
| Main Login controller for Admin
| ----------------------------------------------
*/class Login extends RB_Controller {
	 /**
    * Admin Login section
    *
    * @access    public
    */
	
	function __construct(){
		parent::__construct();
		$this->load->model('Admin_model','mod_admin');
	}
	
    function index()
    {
		try
        { 
			///Posted login form///
            if($_POST)
            {
				$posted=array();
                $posted["txt_user_name"]= trim($this->input->post("txt_user_name"));
                $posted["txt_password"]= trim($this->input->post("txt_password"));
                
                $this->form_validation->set_rules('txt_user_name', 'user name', 'required');
                $this->form_validation->set_rules('txt_password', 'password', 'required');

                if($this->form_validation->run() == FALSE)/////invalid
                {
                    ////////Display the add form with posted values within it////
                    $this->data["posted"]=$posted;
					$this->load->view('admin/login');
                }

                else///validated, now save into DB

                {
					$info=array();
                    $info["username"]=$posted["txt_user_name"];
                    $info["password"]=$posted["txt_password"];
                    $loggedin=$this->mod_admin->login($info);
					
                    if(!empty($loggedin))   ////saved successfully
                    {
						 // Setting the session with the logged user
                		$this->session->set_userdata('logged_in', true);
                        redirect(base_url().'admin');
                    }
                    else///Not saved, show the form again
                    {
					   $data['error'] = ' Invalid UserName / Password!';
                       $this->logout(false);
            		   $this->load->view('admin/login', $data);
                    }
                }
            }else{
            ///end Posted login form///
            unset($loggedin);
			unset($data);
            $this->load->view('admin/login');
			}
			
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
	}

    // --------------------------------------------------------------------

}
/* End of file login.php */
/* Location: ./system/application/controllers/admin/login.php */