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
function get_formatted_string($str)
{
    try
    {    
	
	    //return addslashes(htmlspecialchars(trim($str),ENT_QUOTES,'UTF-8'));
		return addslashes(htmlentities(trim($str),ENT_QUOTES,'UTF-8'));
		//return addslashes($str);
    }
    catch(Exception $err_obj)
    {
      show_error($err_obj->getMessage());
    }         
}

/****
* Function to reverse of get_formatted_string
*
*****/
function get_unformatted_string($str)
{
    try
    {    
	    return stripslashes(trim($str));
    }
    catch(Exception $err_obj)
    {
      show_error($err_obj->getMessage());
    }         
}
/////////////sh ajax Jason for any array to use into JS//////////
function makeArrayJs($mix_php_array = array())
{
    try
    {   
        if(!empty($mix_php_array))
        {
            return  json_encode($mix_php_array);
        }         
    }
    catch(Exception $err_obj)
    {
        show_error($err_obj->getMessage());
    }
}
/////////////sh ajax Jason for any array to use into JS//////////
/*
* For uploading files, picture etc.

* 

* @param string $s_up_path, $s_fld_name, $s_file_name

* @param int $i_max_file_size

* @param mixture $mix_allowed_types

* @param mixture $mix_configArr

* @return void

*/



function get_file_uploaded(	$s_up_path = '', $s_fld_name = '', $s_file_name = '', $i_max_file_size = '' , $mix_allowed_types = '',  $mix_configArr = array())
 {
	try
	{
		$CI = & get_instance();
		$CI->load->library('upload');

		$i_config_max_file_size = $CI->config->item('admin_file_upload_max_size');
		$s_file_ext	= getExtension(@$_FILES[$s_fld_name]['name']);

		$mix_config['upload_path'] 	= $s_up_path;
		$mix_config['allowed_types']= (!empty($mix_allowed_types) && !is_numeric($mix_allowed_types))?$mix_allowed_types:'png|jpg|gif';
		$s_filename 		= (!empty($s_file_name))?$s_file_name:getFilenameWithoutExtension(@$_FILES[$s_fld_name]['name']);
		//$mix_config['file_name'] = $s_filename.$s_file_ext;
		$mix_config['file_name'] = $s_filename.$s_file_ext;
		$mix_config['max_size']	= (!empty($i_max_file_size) && is_numeric($i_max_file_size))?$i_max_file_size:$i_config_max_file_size;

		if(is_array($mix_configArr) && count($mix_configArr)>0)
		{
			foreach($mix_configArr as $key=>$val)
			$mix_config[$key] = $val;
		}	
		unset($s_up_path, $i_max_file_size , $mix_allowed_types ,$mix_configArr, $i_config_max_file_size);

		$CI->upload->initialize($mix_config);
		$s_response 	= ( ! $CI->upload->do_upload($s_fld_name))?('err|@sep@|'.$CI->upload->display_errors('<div>', '</div>')):('ok|@sep@|'.$s_filename.$s_file_ext);
		unset($s_filename, $s_fld_name, $s_file_ext);
		return $s_response;	
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}



/**

* For geting extension of a file

* 

* @param string $s_filename

* @return string

*/



function getExtension($s_filename = '')
{
	try
        {
         	if(empty($s_filename))
			return FALSE;
			$mix_matches = array();
			preg_match('/\.([^\.]*)$/', $s_filename, $mix_matches);
			unset($s_filename);		
			return strtolower($mix_matches[0]);
        }
        catch(Exception $err_obj)
        {
            show_error($err_obj->getMessage());
        }
}

function getFilenameWithoutExtension($s_filename = '')

{

	try

        {

         	if(empty($s_filename))

			return FALSE;

			$mix_matches = array();

			preg_match('/(.+?)(\.[^.]*$|$)/', $s_filename, $mix_matches);

			unset($s_filename);
			$s_new_filename = str_replace(" ","_",$mix_matches[1]).'_'.time();
			return strtolower($s_new_filename);
			 
        }

        catch(Exception $err_obj)

        {

            show_error($err_obj->getMessage());

        }

}



function get_file_deleted($s_up_path = '', $s_file_name = '')
{
	try
	{
		/*if(is_dir($s_up_path) && fileperms($s_up_path)!='0777')
		{
			chmod($s_up_path, 0777);
		}*/
		if(file_exists($s_up_path.$s_file_name))
		{
			 @unlink($s_up_path.$s_file_name);
			 return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}



/**
* For image thumbnailing
* 
* @param string $s_img_path, $s_new_path, $s_file_name
* @param int $i_new_height, $i_new_width 
* @param mix $configArr
* @return string
* Modified By Jagannath Samanta on 21-03-2012
*/
function get_image_size($src = '')
{
	try
	{
		$size = array();
		if($src != '')
		{
			$CI = &get_instance();
			$CI->load->library('image_lib');
			
			if(function_exists('getimagesize'))
			{
				$size = @getimagesize($src);
			}
		}
		unset($src);
		return $size;
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}

function get_image_thumb($s_img_path = '',$s_new_path = '',	$s_file_name = '', $i_new_height = '', $i_new_width = '',$mix_configArr = array())
{
	try
	{
		$CI = & get_instance();
		$CI->load->library('image_lib');
		$i_new_height 	= (!empty($i_new_height)) ? $i_new_height : $CI->config->item('admin_image_upload_thumb_height');
		$i_new_width 	= (!empty($i_new_width)) ? $i_new_width : $CI->config->item('admin_image_upload_thumb_width');

		$config['image_library'] 	= 'gd2';
		$config['source_image']		= $s_img_path;
		$config['create_thumb'] 	= TRUE;
		$config['maintain_ratio'] 	= FALSE;  
		$config['width'] 			= $i_new_width;
		$config['height'] 			= $i_new_height;
		
		$config['thumb_marker'] = '';
		$config['new_image'] = $s_new_path.$s_file_name;
		if(is_array($mix_configArr) && count($mix_configArr)>0)
		{
			foreach($mix_configArr as $s_key=>$mix_val)
				$config[$s_key] = $mix_val;
		}	
		$CI->image_lib->initialize($config); 
		
		unset($s_img_path, $s_new_path, $s_file_name, $i_new_height, $i_new_width ,$mix_configArr, $config);
		$b_res = $CI->image_lib->resize();
		$CI->image_lib->clear();
		if( !$b_res )
		{
			unset($b_res);
			return $msg	= $CI->image_lib->display_errors('<div class="err">','</div>');
		}
		else
		{
			unset($b_res);
			return 'ok';
		}
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}

function get_image_thumb_watermark($s_img_path = '',$s_new_path = '',	$s_file_name = '', $i_new_height = '', $i_new_width = '',$mix_configArr = array())
{
	try
	{
		$CI = & get_instance();
		$CI->load->library('image_lib');
		$i_new_height 	= (!empty($i_new_height)) ? $i_new_height : $CI->config->item('admin_image_upload_thumb_height');
		$i_new_width 	= (!empty($i_new_width)) ? $i_new_width : $CI->config->item('admin_image_upload_thumb_width');

		$config['image_library'] 	= 'gd2';
		$config['source_image']		= $s_img_path;
		$config['create_thumb'] 	= TRUE;
		$config['maintain_ratio'] 	= TRUE;  
		$config['width'] 			= $i_new_width;
		$config['height'] 			= $i_new_height;
		
		list($width,$height) = @getimagesize($s_img_path);
		
		if($width > $height &&  $width > $i_new_width)
		{
			$config['master_dim'] = 'width';
		}
		else if($width < $height &&  $height > $i_new_height)
		{
			$config['master_dim'] = 'height';
		}
		else
		{
			$config['master_dim'] = 'width';
		}
		$config['thumb_marker'] = '';
		$config['new_image'] = $s_new_path.$s_file_name;
		if(is_array($mix_configArr) && count($mix_configArr)>0)
		{
			foreach($mix_configArr as $s_key=>$mix_val)
				$config[$s_key] = $mix_val;
		}	
		$CI->image_lib->initialize($config); 
		
		//unset($s_img_path, $s_new_path, $s_file_name, $i_new_height, $i_new_width ,$mix_configArr, $config);
		$b_res = $CI->image_lib->resize();
		$CI->image_lib->clear();
		unset($config);

		//Add watermark to 600px version
		$config = array();
		$config['source_image'] = $s_new_path.'196x130.jpg';
		$config['image_library'] = 'gd2';
		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = $s_new_path.$s_file_name;
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'center';
		$this->image_lib->initialize($config);
		$this->image_lib->watermark();
		$this->image_lib->clear();
		unset($config);
		
		if( !$b_res )
		{
			unset($b_res);
			return $msg	= $CI->image_lib->display_errors('<div class="err">','</div>');
		}
		else
		{
			unset($b_res);
			return 'ok';
		}
	}
	catch(Exception $err_obj)
	{
		show_error($err_obj->getMessage());
	}
}


?>