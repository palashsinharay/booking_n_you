<?php
//--------------------------//
//Creating a Common class which extends the main controller.
//--------------------------//


class RB_Controller extends CI_Controller {

    public $Rpath = ''; // Use to store the path to the resource folder
    public $Ipath = ''; // Use to store the path to the image folder

    // --------------------------------------------------------------------

    /**
    * Constructer
    *
    * @access    default
    */

    function __construct()
    {
        //parent::Controller();
		parent::__construct();

        $this->Rpath = real_url().RESOURCES; // Creating Full Path to resources folder
        $this->Ipath = $this->Rpath.IMP.'admin/'; // Creating Full Path to images folder

        // Native session controlled CI-Session
        if(!$this->phpsession->get('CI-Session')){
            $this->phpsession->save('CI-Session',time());
            // Check whether remember is clicked or not at the time of last signup
            /*if($this->session->userdata('logged_in') != true){
                $this->logout();
                die();
            }*/
        }
        if($this->session->userdata('logged_in') == true){
            $userData = $this->session->userdata('logged_admin_user');
        }
    }

    // --------------------------------------------------------------------

    /**
    * Check if user is logged in
    *
    * @access    private
    */
    public function _isLoggedIn()
    {
        if($this->session->userdata('logged_in') != true){
            $this->logout();
            die();
        }
		$this->_isAdmin();
    }

    // --------------------------------------------------------------------

     /**
    * Check if user is Admin or not
    *
    * @access    private
    */
    public function _isAdmin()
    {
        $agentData = $this->session->userdata('logged_admin_user');
        // if($agentData[0]->usertype != 'admin' && $agentData[0]->usertype != 'superadmin'){
		   if($agentData['AdminsStatus'] != 'S' && $agentData['AdminsStatus'] != 'U' ){
            $this->logout();
            die();
        }
    }

    // --------------------------------------------------------------------

    /**
    * Loading the desired page
    *
    * @access    private
    * @param    string
    */
    public function _renderView($view = 'dashboard', $data = null)
    {

        $data['session'] = &$this->session;
        $data['phpsession'] = &$this->phpsession;
        $data['Rpath'] = $this->Rpath;
        $data['Ipath'] = $this->Ipath;

        $data['menu'] = $this->session->userdata('menu');
		if($view == 'dashboard'){
            $data['menu'] = '1000000';
        }
		
        if(!isset($data['conFunc'])){
            $data['conFunc'] = 'dashboard';
        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/'.$view, $data);
        $this->load->view('admin/footer', $data);
    }

 // --------------------------------------------------------------------

    // --------------------------------------------------------------------

    /**
    * Loading the desired page
    *
    * @access    private
    * @param    string
    */
    public function _renderViewFe($view = '', $data = null)
    {

        $data['session'] = &$this->session;
        $data['phpsession'] = &$this->phpsession;
        $data['Rpath'] = $this->Rpath;
        $data['Ipath'] = $this->Ipath;

        $this->load->view('fe/common/header', $data);
        $this->load->view('fe/'.$view, $data);
        $this->load->view('fe/common/footer', $data);
    }

 // --------------------------------------------------------------------
    /**
    * Pagination
    *
    * @access    public
    * @return    int
    */
   function paginate($table,$page,$model,$cond=null)
    {
	    $this->load->library('pagination');
		$config['base_url'] = base_url().'admin/'.$page;
        $config['total_rows'] = $this->$model->count_all($table,$cond);
        $config['per_page'] = '10';
        $this->pagination->initialize($config);
        $this->offset= (int)$config['per_page'];
		return $this->pagination->create_links();

    }

 // --------------------------------------------------------------------

    /**
    * Admin logout
    *
    * @access    public
    * @param    bool
    */
    function logout($redir = true){
        $this->session->sess_destroy();
        if($redir){
           redirect(real_url().'admin/login');
			//redirect(base_url());
        }
    }

    // --------------------------------------------------------------------

	//admin pagination start here
	public function get_admin_pagination($s_rq_url, $i_total_no, $i_per_page=10, $i_uri_seg=NULL)
    {
        try
        {
			$this->load->library('pagination');
            $config['base_url'] = base_url().'admin/'.$s_rq_url;

            $config['total_rows'] = $i_total_no;
            $config['per_page'] = $i_per_page;

            $config['uri_segment'] = ($i_uri_seg?$i_uri_seg:$this->i_uri_seg);

            $config['num_links'] = 2;
            $config['page_query_string'] = false;
			
			
			$config['first_link'] = '&lsaquo; First';
            $config['last_link'] = 'Last &rsaquo;';

            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
			
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>';
            //$config['prev_tag_open'] = '<li class="previous-off">';
	 		$config['prev_tag_open'] = '<li class="previous">';
            $config['prev_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo;&nbsp;Previous';
            $config['next_link'] = 'Next&nbsp;&raquo;';
			
			

            $config['cur_tag_open'] = ' <li class="active">';
            $config['cur_tag_close'] = '</li>';
			//pr($config);
            $this->pagination->initialize($config);
            unset($s_rq_url,$i_total_no,$i_per_page,$i_uri_seg,$config);
            return $this->pagination->create_links();
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }
    }        
	//admin pagination ends here
	//front end  pagination start here
	public function get_fe_pagination($s_rq_url, $i_total_no, $i_per_page=10, $i_uri_seg=NULL)
    {
        try
        {
			$this->load->library('pagination');
            $config['base_url'] = base_url().$s_rq_url;

            $config['total_rows'] 	= $i_total_no;
            $config['per_page'] 	= $i_per_page;

            //$config['uri_segment'] = ($i_uri_seg?$i_uri_seg:$this->i_uri_seg);
		    $config['uri_segment'] 	= $i_uri_seg;

            $config['num_links'] = 2;
            $config['page_query_string'] = false;
			
			
			$config['first_link'] = '&lsaquo; First';
            $config['last_link'] = 'Last &rsaquo;';

            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
			
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>';
            //$config['prev_tag_open'] = '<li class="previous-off">';
	 		$config['prev_tag_open'] = '<li class="previous">';
            $config['prev_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo;Previous';
            $config['next_link'] = 'Next&raquo;';
			
			

            $config['cur_tag_open'] = ' <li class="active">';
            $config['cur_tag_close'] = '</li>';
						
			//pr($config);
            $this->pagination->initialize($config);
            unset($s_rq_url,$i_total_no,$i_per_page,$i_uri_seg,$config);
            return $this->pagination->create_links();
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }
    }        
	//front end pagination ends here
	
		/* Function For Get Content Of Hotel Api Using Curl */
	private $ch = null;
	function file_get_contents_curl($url) {
		 //global $ch;
		try
        {
			 $ch = $this->ch;
			 if(is_null($ch)) {
			  //echo 'init called';
			  $ch = curl_init();
			  
			  curl_setopt($ch, CURLOPT_HEADER, 0);
			  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			   'Connection: Keep-Alive',
			   'Keep-Alive: 300'
			  ));
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			   //Set curl to return the data instead of printing it to the browser.
			  curl_setopt($ch, CURLOPT_FAILONERROR, true);
			  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:6.0.2) Gecko/20100101 Firefox/6.0.2');
			 }
			 
			 curl_setopt($ch, CURLOPT_URL, $url);
			 
			 $data = curl_exec($ch);
			 
			 $result = json_decode ( $data );
			 
			 return $result;
		}
		catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }
	}
	
	
	function fetch_curl_content($url){
		try
        {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FAILONERROR,1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_HTTPHEADER,array('Accept: text/xml,application/xml'));
			curl_setopt($ch, CURLOPT_TIMEOUT, 15);
			$result = curl_exec($ch);                     
			curl_close($ch);
			return $result;
		}
		catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }
	}
	/* Function For Get Content Of Hotel Api Using Curl */
	
	
	
	/*===========================================session check for user default language and default currency section===============================================*/
	protected function default_language_currency_session(){
		
		$this->load->model('site_setting_model','mod_site_setting');
		//$info = $this->mod_site_setting->fetch_this("NULL");
		$info = $this->mod_site_setting->fetch_this(1);
		$this->data['site_setting'] = $info;
		
		if($this->session->userdata('Language_code') == "")
        {
			$this->session->set_userdata('Language_code', $this->data['site_setting']['SettingsLanguage']);
        }
		if($this->session->userdata('Currency_code') == "")
        {
			$this->session->set_userdata('Currency_code', $this->data['site_setting']['SettingsCurrency']);
        }
	}
	/*===========================================session check for user default language and default currency section===============================================*/
	/*===========================================Per Page Limit===============================================*/
	protected function fe_page_limit(){
		
		$this->load->model('site_setting_model','mod_site_setting');
		//$info = $this->mod_site_setting->fetch_this("NULL");
		$info = $this->mod_site_setting->fetch_this(1);
		$this->data['RecordPerPage'] = $info['SettingsRecordPerPage'];
		return $this->data['RecordPerPage'];
		
	}
	/*===========================================Per Page Limit===============================================*/
	/*===========================================fetch static language text===============================================*/
	function change_language_text(){
		$LANG = null;
		$this->load->database();
		$lan_query = "SELECT  bw.word AS main_word, (SELECT word FROM booking_wordtranslations bwt WHERE bw.id = bwt.word_id AND bwt.lang_id =  '".$this->session->userdata('Language_code')."') as translated FROM booking_words bw WHERE bw.is_active = '0'";
        $result = $this->db->query("SET NAMES 'utf8'");  
		$result = $this->db->query($lan_query);  
	 
		foreach ($result->result_array() as $data) {
			$LANG[stripslashes($data['main_word'])] = stripslashes($data['translated']);
		} 
		  return $LANG;    
	}
	/*===========================================fetch static language text===============================================*/
	 public function __destruct()
    {}

}


/* End of admin controller file RB_Controller.php */
/* Location: ./system/application/libraries/RB_Controller.php */

