<?php
class Logout extends RB_Controller {
	


	function index($redir = true){
        $this->session->sess_destroy();
        if($redir){
            redirect(real_url().'admin/login'); 
        }
		}
	
}
