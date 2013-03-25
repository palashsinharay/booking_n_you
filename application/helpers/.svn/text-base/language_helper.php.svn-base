<?php
/*********
* Author: Kafil Akhter
* Date  : 25th June 2012
* Purpose:
*  Custom Helpers 
* Includes all necessary files and common functions
* 
*/

/****
* Function to format input string
*
*****/

function insertStaticWord_old($string) {
		
		$CI = &get_instance();
		$CI->db->SETTINGS;
		$CI->db->WORDS;
		$CI->db->WORD_TRANSLATIONS;

		
		return $string;
		
		$current_language = $CI->session->userdata('Language_code');
		
		$CI->load->model('site_setting_model','mod_site_setting');
		//$info = $this->mod_site_setting->fetch_this("NULL");
		$info = $CI->mod_site_setting->fetch_this(1);
		$this->data['site_setting'] = $info;
		
		$master_language = $this->data['site_setting']['SettingsLanguage'];
						
		if(trim($string)!="") {
			$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$page = $_SERVER['PHP_SELF'];
			
			$arr_same_word_result = $this->Word->find("Word.word_md5='".md5($string)."'");
			//echo "'Word.word_md5'='".md5($string)."'";
			//print_r($arr_same_word_result);
			//echo count($arr_same_word_result);
			//exit();
			$arr_same_word = array();
			
			/* word does not exist in database */
			//if( !is_array($arr_same_word_result) || count($arr_same_word_result)==0 ) {
			if( $arr_same_word_result == "" ) {
				
				$this->data['Word']['word'] = addslashes($string);
				$this->data['Word']['word_md5'] = md5($string);
				$this->data['Word']['page'] = $page;
				$this->data['Word']['url'] = $url;
				if($this->Word->save($this->data['Word'])) {
					$word_id = $this->Word->getLastInsertId();
					$word_id_current = $word_id;
					/* Inserting according to master language */					
					$this->data['Wordtranslation']['word_id'] = $word_id;		
					$this->data['Wordtranslation']['lang_id'] = $master_language;		
					$this->data['Wordtranslation']['word'] = addslashes($string);
					$this->Wordtranslation->save($this->data['Wordtranslation']);
				}
				return $string;
			} else {
				$arr_same_word = $arr_same_word_result['Word']['id'];
				$word_id_current = $arr_same_word;

				$arr_string = '';
				
				$arr_string_result = $this->Wordtranslation->find("Wordtranslation.word_id='".$arr_same_word."' AND Wordtranslation.lang_id='".$current_language."'");
		
				/* translation exists in current language */
				if(trim($arr_string_result['Wordtranslation']['word'])!="") {
					return stripslashes($arr_string_result['Wordtranslation']['word']);
				}
		
				/* If translation does not exist or blank It will display in master language */
				else {
					
					$arr_string_result = $this->Wordtranslation->find("Wordtranslation.word_id='".$arr_same_word."' AND Wordtranslation.lang_id='".$master_language."'");

					if( isset($arr_string_result['Wordtranslation']) ) {
						return stripslashes($arr_string_result['Wordtranslation']['word']);
					}

					/* exceptional case, word exists in master table, 
						but not exists in word data table for master language */
					else {
						return $string;
					}
				}
			}
		}
	}
	/******************************** Language Insert Into Database Page *****************************************************/
	function insertStaticWord($string)
	{
		return $string;
	}
	
	
?>