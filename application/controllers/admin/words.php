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

class Words extends RB_Controller {

	public $menu = '3';

	function __construct(){
		parent::__construct();
		$this->_isLoggedIn();
		$this->session->set_userdata('menu', $this->menu);
		$this->load->model('Words_model');
	}

    function index($order_name='',$order_by='asc',$start=NULL,$limit=NULL)
    {
	 	try
		{
			$operation = $this->input->post('action');
			switch(true) {
				case $operation == 'add':
				$this->wordAdd();
				break;
				
				case $operation == 'update':
				$this->wordUpdate();
				break;
				
				case $operation == 'addWordTranslate':
				$this->addWordTranslate();
				break;
				
			}
			 
			 		            ////////Getting Posted or session values for search///
            $s_search=(isset($_POST["h_search"])?$this->input->post("h_search"):$this->session->userdata("h_search"));
			$s_words=($this->input->post("h_search")?$this->input->post("txt_word"):$this->session->userdata("txt_word"));
			////////end Getting Posted or session values for search///
            
            
            $s_where="";
			$s_where .=" WHERE n.id IS NOT NULL ";
            if($s_search=="basic")
            {
				if($s_words!="")
				{
					$s_where .=" AND n.word LIKE '%".get_formatted_string($s_words)."%' ";
				}
                /////Storing search values into session///
				$this->session->set_userdata("txt_word",$s_words);
                $this->session->set_userdata("h_search",$s_search);
                
                $this->data["h_search"]		=	$s_search;
				$this->data["txt_word"]		=	$s_words;
                /////end Storing search values into session///
            }
            else////List all records, **not done
            {
                $s_where=" WHERE n.id IS NOT NULL ";;
                /////Releasing search values from session///
				$this->session->unset_userdata("txt_word");
                $this->session->unset_userdata("h_search");
                
                $this->data["h_search"]		=	$s_search;
				$this->data["txt_word"]		=	"";   
                /////end Storing search values into session///                 
            }
            unset($s_search, $s_words);
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
			
			$arr_sort = array(0=>'id'); 
			$s_order_name = !empty($order_name)?in_array(($order_name),$arr_sort)?($order_name):$arr_sort[0]:$arr_sort[0];
		  
			//$limit	= $this->i_admin_page_limit;
			$this->i_admin_page_limit = $this->fe_page_limit();
			$limit	= $this->i_admin_page_limit;
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			
			
			$this->i_uri_seg=$i_uri_seg;
			$this->s_pageurl= 'words/index';
			$this->total_db_records = $this->Words_model->gettotal_info($s_where);
			
			$data["pagination"]=$this->get_admin_pagination($this->s_pageurl, $this->total_db_records, $this->i_admin_page_limit, $this->i_uri_seg);
			//$info	= $this->mod_rect->fetch_multi($s_where,intval($start),$limit);
			$info	= $this->Words_model->fetch_multi_sorted_list($s_where,$s_order_name,$order_by,intval($start),$limit);
			
			$data['pageDetails'] = $info;
			$this->_renderView('words', $data);
			 
		}
		catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        } 
    }
	
	public function wordAdd()           
	{
		try
		{
			unset($_POST['action']);
			$posted=array();
			$posted["word"]		=	trim($this->input->post("word"));
			
			$this->form_validation->set_rules('word', 'word', 'required');
		  
			if($this->form_validation->run() == FALSE)/////invalid
			{
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			}
			else///validated, now save into DB
			{
				$info=array();
				$info['word']  	=   $posted['word'];
				$info['word_md5']  	=   md5($posted['word']);
				$info["is_active"]	=	'0';

				$i_newid = $this->Words_model->add_info($info);
				if($i_newid)////saved successfully
				{
					$alertMsg = 'Word Added successfully!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/words');
				}
				else///Not saved, show the form again
				{
					$alertMsg = 'Some Error happen please try again!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/words');
				}
				
			}
		
		
			
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
	}
	
	public function addWordTranslate()
	{
		try
        {
			unset($_POST['action']);
			$posted=array();
			$posted["word_id"]			=	trim($this->input->post("id2"));
			$posted["word"]				=	trim($this->input->post("word1"));
			$posted["lang_id"]			=	trim($this->input->post("lang_id"));
			$posted["trans_word"]		=	trim($this->input->post("trans_word"));
			
			$this->form_validation->set_rules('trans_word', 'Translated Word', 'required');
			if($this->form_validation->run() == FALSE)/////invalid
			{
				////////Display the add form with posted values within it////
				$this->data["posted"]=$posted;
			}
			else///validated, now save into DB
			{
				$info=array();
				$info['word_id']  		=   $posted['word_id'];
				$info['lang_id']  		=   $posted['lang_id'];
				$info['word']  			=   $posted['trans_word'];
				$info["is_active"]		=	'0';
				
				$i_newid=$this->Words_model->add_translated_word_info($info);
				if($i_newid)////saved successfully
				{
					$alertMsg = 'Word Translation successfully!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/words');
				}
				else///Not saved, show the form again
				{
					$alertMsg = 'Some Error happen please try again!';
					$this->session->set_flashdata('error', $alertMsg);
					redirect(base_url().'admin/words');
				}
			}
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		} 
	}
	
	public function wordUpdate(){
		try
        {
			unset($_POST['action']);
			$posted=array();
			$posted["Id"]			=	trim($this->input->post("id1"));
			$posted["word"]		=	trim($this->input->post("word"));
			
			$this->form_validation->set_rules('word', 'word', 'required');
              
                if($this->form_validation->run() == FALSE)/////invalid
                {
                    ////////Display the add form with posted values within it////
                    $this->data["posted"]=$posted;
                }
                else///validated, now save into DB
                {
					$info=array();
					$info['word']  			=   $posted['word'];
					$info['word_md5']  		=   md5($posted['word']);
                    $info["is_active"]		=	'0';
					
					$i_aff=$this->Words_model->edit_info($info,$posted["Id"]);
					if($i_aff)////saved successfully
                    {
						$alertMsg = 'Word Updated successfully!';
						$this->session->set_flashdata('error', $alertMsg);
						redirect(base_url().'admin/words');
                    }
                    else///Not saved, show the form again
                    {
                        $alertMsg = 'Some Error happen please try again!';
						$this->session->set_flashdata('error', $alertMsg);
						redirect(base_url().'admin/words');
                    }
                    
                }
		}
		catch(Exception $err_obj)
		{
			show_error($err_obj->getMessage());
		}          
    }
	
	
/*
 * Delete words
 * @access   public
 */
    function word_delete($id = 0)
    {

		 if($this->Words_model->delete($id)){
            $alertMsg = 'Word Deleted!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/words');
    }

/*
 * Staus Change words
 *
 * @access   public
 */
    function change_status($id = 0, $status = '0')
    {
		if($status == '0') {
			$st = '1';
		} else {
			$st = '0';
		}
        $cond = array('is_active' => $st);
        if($this->Words_model->change_status($id, $cond)) {
            $alertMsg = 'Status Changed!';
        } else {
            $alertMsg = 'Some Error happen please try again!';
        }
        $this->session->set_flashdata('error', $alertMsg);
        redirect(base_url().'admin/words');
    }

	public function __destruct()
    {}
}
?>