<?php
  $logged_user = $session->userdata('logged_user');
  $alert = $session->flashdata('error');
  //$logged_user = $logged_user['id'];
 // print_r($logged_user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?= base_url(); ?>" />
<title><?= SITENAME;?></title>
<link href="resources/css/admin-inner.css" rel="stylesheet" type="text/css" media="all" />
<link href="resources/jq/css/ad-themes/cupertino/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
<link href="resources/jq/css/jquery.timeentry.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="resources/js/jquery-1.4.2.js" ></script>
<script type="text/javascript" src="resources/jq/ui/ui.core.js" ></script>
<script type="text/javascript" src="resources/jq/ui/ui.accordion.js" ></script>
<script type="text/javascript" src="resources/jq/ui/ui.datepicker.js" ></script>
<!--<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>-->
<script type="text/javascript" src="resources/fckeditor/fckeditor.js"></script>
<script>

$(window).resize(function() {

   var height = ($('div.fixed_width').children('table:first').height()+25)+'px';
   var width = ($(window).width() - 280)
   if(width < 750){
       width = 750;
   }

   var m_width = (width + 260)+'px';
   var m_height = ($(window).height() - 50 )+'px';

   width = width+'px';


  $('.mainContainer').css('min-height', m_height);
  $('div.fixed_width').css('width', width);
  $('div.fixed_width').css('height', height);
  $('.mainContainer').css('min-width', m_width);
  $('div.footer').css('min-width', m_width);
});

$(document).ready(function(){
  // Position the footer
    $(window).resize();

    $('textarea').keyup(function(){
        $ta = $(this);
        $cLimit = parseInt($ta.attr('cl'));
        if($cLimit)
            $ta.val($ta.val().substr(0,$cLimit));
    });

    $('textarea').bind('paste', function(e){
        $id = $('#' + e.target.id);
        setTimeout('$id.keyup()', 1);
    });

    $("#left_menu").accordion({
        active: <?php echo $menu; ?>,
        autoHeight: false
    });

      <?php if($alert) { ?>
      $("#alert").html('<?php echo $alert ?>');
      $("#alert").fadeIn(3000).fadeOut(6000);
      <?php } ?>
	  
	  
	  $('form').submit(function(){
        
        var v_error = '1px solid #f32517';
        var v_ok = '1px solid #b8bab8';
        var validate = true;
        var retype_failed = false;
		var msg='Please correct red marked field(s)';
       // alert("*********"); 
        $("form :input")
            .not(':button, :submit, :reset, :hidden, [valid="not"]')
            .each(function(){
				var value = $(this).val();
				if($(this).val() != ''){
					value = $.trim($(this).val());
				}
                if( value == ''){
                    $(this).css('border', v_error);
                    validate = false;    
                } else if($(this).attr('valid') == 'alfa'){
                    //var regexLetter = /^[A-Za-z' ']+$/;
					var regexLetter = /^[a-zA-Z 0-9\s\[\]\!\(\)\-\.\&\*\#\@/\\(/)/)]+$/;
                   if(!regexLetter.test(value)){
                        $(this).css('border', v_error);
						msg='Please enter charachters only!';
                        validate = false;   
                    }else{
                        $(this).css('border', v_ok);
                    }       
                } else if($(this).attr('valid') == 'alfanum'){
                    var regexLetter = /^[A-Za-z0-9 ]+$/;
                   if(!regexLetter.test(value)){
                        $(this).css('border', v_error);
						msg='Please enter alpha numeric charachters only!';
                        validate = false;   
                    }else{
                        $(this).css('border', v_ok);
                    }       
                } else if($(this).attr('name') == 'phone'){
                    if(isNaN(value) || value.length != 10 ){
                        $(this).css('border', v_error);
						msg='Please 10 digit long mobile number!';
                        validate = false;   
                    }else{
                        $(this).css('border', v_ok);
                    }       
                } else if($(this).attr('valid') == 'num'){
                    if(isNaN(value)){
                        $(this).css('border', v_error);
						msg='Please enter charachters only!';
                        validate = false;   
                    }else{
                        $(this).css('border', v_ok);
                    }       
                }else if($(this).attr('name') == 'email'){
                    var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
                    if(pattern.test(value)){
                        $(this).css('border', v_ok);   
                    }else{
                        $(this).css('border', v_error);
						msg='Please enter proper email!';
                        validate = false;
                    }       
                }else if($(this).attr('retypewith')){
                
                    var compare_val = $.trim($("#"+$(this).attr('retypewith')).val());                
                    if($.trim($(this).val()) != compare_val)
                    {
                        retype_failed = true;
                    }    
                }else if($(this).attr('type') == 'password'){
                    if(value.length < 4 ){
                        $(this).css('border', v_error);
						msg='Password length must be 4 charachter long';
                        validate = false;   
                    }else{
                        $(this).css('border', v_ok);
                    }       
                }
				 
                else{
                        $(this).css('border', v_ok);
                }
                //alert("*********"); 
        });
        
		
      
        $('check').not('[valid="not"]').each(function(){
            if(!$(this).attr('disabled')){
                if($(this).val()=='-1'){
                     $(this).css('border', v_error);
                     validate = false;
                }else{
                    $(this).css('border', v_ok);
                        
                }
            }
        });
       
        if(validate == false){
            $('.mandatory_txt').fadeOut(1000, function(){
                $(this).html(msg);
                $(this).fadeIn(1000).fadeOut(1000).fadeIn(1000);
                
            });
        }
        
        if(retype_failed)
        {
            $('.mandatory_txt').fadeOut(1000, function(){
                $(this).html('New Password and Confirm Password are not same.');            
                $(this).fadeIn(1000).fadeOut(1000).fadeIn(1000);                
            });
            
            validate = false;            
        }
           
        return validate;            
    });
});

</script>
</head>
<body>
<div id="alert"></div>
<!--Wrapper Starts-->
<div class="wrapper">
  <!--Main Container Starts-->
  <div class="mainContainer">
    <!--Header Container Starts-->
    <div class="headerContainer">
      <div class="logoContainer"><a href="<?php echo base_url();?>admin"><img  src="<?php echo $Ipath ?>logo.png" alt="<?php echo SITENAME;?>" title="<?php echo SITENAME;?>" ></a></div>
      <div class="headerRight">
          <div class="header_r8cont">WELCOME <?php echo strtoupper($logged_user['user_fullname'])."<br />Last Login : ".$logged_user['user_logtime']." From (".$logged_user['user_ip'].")" ?></div>
        <div class="btnContainer">
          <ul>
          <li><a href="<?php echo base_url().'admin'?>"><strong class="leftBg"></strong><strong class="rightBg"><img src="<?php echo $Ipath ?>home.png" alt="" class="logout"/>Home</strong></a></li>
          
           <?php /*?><li><a href="<?php echo base_url();?>/admin/index/download_me"><strong class="leftBg"></strong><strong class="rightBg"><img src="<?php echo $Ipath ?>download-manual.png" alt="" class="logout"/>Manual</strong></a></li><?php */?>
          
            <li><a href="<?php echo base_url().'admin/logout'?>"><strong class="leftBg"></strong><strong class="rightBg"><img src="<?php echo $Ipath ?>logout.png" alt="" class="logout"/>Logout</strong></a></li>
          </ul>
        </div>
      </div>
    </div>
    <!--Header Container End-->
    <div id="topMenu"></div>
    <!--Content Container Starts-->
    <div class="contentContainer">
      <!--Content Inner Starts-->
      <div class="contentInner">
        <!--Panel Holder Starts-->
        <div class="panelHolder">
          <table  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="220" align="left" valign="top"><!--Left Panel Starts-->
                <div class="leftPanel">
                  <div id="left_menu">
					  
					   <h3><a href="<?php echo base_url().'admin/#'?>">Admin Management</a></h3>
                      <ul class="leftmenu">
                      <li><a href="<?php echo base_url().'admin/admins'?>">Admin</a></li>
                      </ul>
                       <h3><a href="<?php echo base_url().'admin/#'?>">Currency Management</a></h3>
                      <ul class="leftmenu">
                      <li><a href="<?php echo base_url().'admin/currency'?>">Currency</a></li>
                      </ul>
                       <h3><a href="<?php echo base_url().'admin/#'?>">Language Management</a></h3>
                      <ul class="leftmenu">
					 <li><a href="<?php echo base_url().'admin/language'?>">Language</a></li>
                      </ul>
                      <h3><a href="<?php echo base_url().'admin/#'?>">Word Management</a></h3>
                      <ul class="leftmenu">
                       <li><a href="<?php echo base_url().'admin/words'?>">Word</a></li>
                       <li><a href="<?php echo base_url().'admin/words_translation'?>">Word Translation</a></li>
                      </ul>
                      <h3><a href="<?php echo base_url().'admin/#'?>">User Management</a></h3>
                      <ul class="leftmenu">
                       <li><a href="<?php echo base_url().'admin/user'?>">User</a></li>
                      </ul>
                      <h3><a href="<?php echo base_url().'admin/#'?>">Booking Management</a></h3>
                      <ul class="leftmenu">
                       <li><a href="<?php echo base_url().'admin/booking'?>">Booking</a></li>
                      </ul>
                      <h3><a href="<?php echo base_url().'admin/#'?>">CMS Management</a></h3>
                      <ul class="leftmenu">
                       <li><a href="<?php echo base_url().'admin/cms'?>">CMS</a></li>
                      </ul>
                      <h3><a href="<?php echo base_url().'admin/#'?>">Destination Management</a></h3>
                      <ul class="leftmenu">
                       <li><a href="<?php echo base_url().'admin/destination'?>">Destination</a></li>
                      </ul>
                      
                    <h3><a href="<?php echo base_url().'admin/'?>">Site Settings</a></h3>
                      <ul class="leftmenu">
					  <li><a href="<?php echo base_url();?>admin/siteconfig">Site Configure</a></li>
                        <li><a href="<?php echo base_url();?>admin/changepassword">Change Password</a></li>
                      </ul>
					  
                  </div>
                </div>
                <!--Left Panel End-->
              </td>
              <td width="20" align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top" width="100%"><!--Right Panel Starts-->
