<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<base href="<?= base_url(); ?>" />
<title><?= SITENAME;?></title>

<link href="resources/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="resources/css/bootstrap-responsive.min.css" type="text/css" rel="stylesheet">
<link href="resources/css/blue.css" type="text/css" rel="stylesheet">
<link href="resources/css/style_1.css" type="text/css" rel="stylesheet">

<script type="text/javascript" src="resources/js/jquery.js" ></script>
<script type="text/javascript">
$(document).ready(function(){
    
     $("#frm_login").submit(function(){
        $.blockUI({ message: 'Just a moment please...' });
        var b_valid=true;
        var s_err="";
        $("#div_err").hide("slow");  
        
        if($.trim($("#txt_user_name").val())=="") 
        {
            s_err='<div id="err_msg" class="error_massage">Please provide user name.</div>';
            b_valid=false;
        }
        
        if($.trim($("#txt_password").val())=="") 
        {
            s_err+='<div id="err_msg" class="error_massage">Please provide password.</div>';
            b_valid=false;
        }        
        
        /////////validating//////
        if(!b_valid)
        {
            $.unblockUI();  
            $("#div_err").html(s_err).show("slow");
        }
        
        return b_valid;        
    });
    $('.wrapper').fadeIn(1000, function(){
        $('#txt_user_name').focus();
    });
    $('#msg_cont').hide().html('<?php echo $error?>').fadeIn(2000);
   
			
});
</script>
<style>
.msg_cont {
	color:#F00;
	text-align:center;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
}
</style>
        <!--[if lte IE 8]>
            <script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
        <![endif]-->
		
    </head>
    <body class="login_page">
		
		<div class="login_box">
			
			<form name="admin_login" id="admin_login" action="<?php echo base_url()?>admin/login" method="post">
				<div class="top_b">Sign in to <?php echo SITENAME;?> Admin</div>    
				<div class="alert alert-info alert-login">Sign in with username and password.
                <div class="msg_cont" id="div_err"><?php echo validation_errors();?></div>      
                <div class="msg_cont" id="msg_cont"></div>
				</div>
				<div class="cnt_b">
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-user"></i></span><input type="text" name="txt_user_name" id="txt_user_name" class="field" value="" size="20" maxlength="20" ><div class="err_div" id="usrlog_err"></div>
						</div>
					</div>
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span><input type="password" class="field" value="" name="txt_password" id="txt_password" size="20" maxlength="20" ><div class="err_div" id="usrpass_err"></div>
						</div>
					</div>
					<div class="formRow clearfix">
						<label class="checkbox"><input type="checkbox" name="remember" id="remember" class="checkbox" value="true"/> Remember me</label>
					</div>
				</div>
				<div class="btm_b clearfix">
					<input type="submit" name="login" class="btn btn-inverse pull-right" value="Sign In" size="30" style="border:none;">
					<!--<span class="link_reg"><a href="#pass_form">Forgot password?</a></span>-->
				</div>  
		
            </form>		
            </div>
		
		
       
    </body>
</html>
