     
     <!--FOOTER SECTION START-->
     <div id="footer">
     	<div class="footer_main">
          	<img src="images/footer_top.jpg" alt="" />
               <p><a href="<?php echo base_url().'about_us'?>"><?php echo $LANG['About Us']== NULL?'About Us':$LANG['About Us']?></a> | <a href="<?php echo base_url().'faq'?>"><?=$LANG['FAQ']== NULL?'FAQ':$LANG['FAQ']?></a> | <a href="<?php echo base_url().'terms_conditions'?>"><?=$LANG['Terms and Conditions']== NULL?'Terms and Conditions':$LANG['Terms and Conditions']?></a> | <a href="<?php echo base_url().'privacy'?>"><?=$LANG['Privacy statement']== NULL?'Privacy statement':$LANG['Privacy statement']?></a> | <?=$LANG['Share the fun using']== NULL?'Share the fun using':$LANG['Share the fun using']?><a onclick='postToFeed(); return false;'><img src="images/facebook_icon.png" alt="" /></a> <span><a href="javascript:(function(){window.twttr=window.twttr||{};var D=550,A=450,C=screen.height,B=screen.width,H=Math.round((B/2)-(D/2)),G=0,F=document,E;if(C>A){G=Math.round((C/2)-(A/2))}window.twttr.shareWin=window.open('http://twitter.com/share','','left='+H+',top='+G+',width='+D+',height='+A+',personalbar=0,toolbar=0,scrollbars=1,resizable=1');E=F.createElement('script');E.src='http://platform.twitter.com/bookmarklets/share.js?v=1';F.getElementsByTagName('head')[0].appendChild(E)}());"><img src="images/twitter_icon.png" alt="" /></a></span></p>
         		<!--<h6><a href="javascript:void(0);">Online Hotel Booking</a><a href="javascript:void(0);">No booking charges</a><a href="javascript:void(0);">No booking fees </a><a href="javascript:void(0);">No reservation fee</a><a href="javascript:void(0);">Instant confirmation</a><a href="javascript:void(0);">No hidden cost</a><a href="javascript:void(0);">Your Booking Partner</a></h6>-->
               <h6><?=$LANG['We speak your language']== NULL?'We speak your language':$LANG['We speak your language']?>:</h6>
               <p id="footer_language_change"><?php echo makeOptionLanguageFooter_new();?></p>
               <p><?=$LANG['Copyright']== NULL?'Copyright':$LANG['Copyright']?> © 2013 Bookingandyou.com <?=$LANG['All rights reserved']== NULL?'All rights reserved':$LANG['All rights reserved']?>.</p>
          </div>
     </div>
     <!--FOOTER SECTION END-->

</body>
</html>
<!--  /******************************** User SIGNUP BOX START *****************************************************/ -->  	  
	<div id="sign_up_box" class="blue_box signup_box" style="display:none; position:absolute; width:520px;">
     	<div class="close_btn"><a href="javascript:void(0)" onclick="hide_dialog()"><img src="images/close_btn.png" alt="" /></a></div>

          <?php echo form_open('signup');?>
		  <h3><?=$LANG['Sign up']== NULL?'Sign up':$LANG['Sign up']?></h3>
          <div class="descrip">
		  <?=$LANG['Your booking will be faster with a Bookingandyou.com profile Save the contact details you want to use every time you book Manage all bookings saved to your profile']== NULL?'Your booking will be faster with a Bookingandyou.com profile Save the contact details you want to use every time you book Manage all bookings saved to your profile':$LANG['Your booking will be faster with a Bookingandyou.com profile Save the contact details you want to use every time you book Manage all bookings saved to your profile']?>	  </div>
		  <div id="message" style="padding-left:66px; color:red;"></div>
     	<label><?=$LANG['Your email']== NULL?'Your email':$LANG['Your email']?></label><?=form_input(array('name'=>'email','value'=>'','class'=>'email textbox'))?>
     	<div class="clr"></div>
          <label><?=$LANG['First name']== NULL?'First name':$LANG['First name']?></label><?=form_input(array('name'=>'first_name','value'=>'','class'=>'first_name textbox'))?>
     	<div class="clr"></div>
          <label><?=$LANG['Last name']== NULL?'Last name':$LANG['Last name']?></label><?=form_input(array('name'=>'last_name','value'=>'','class'=>'last_name textbox'))?>
     	<div class="clr"></div>
          <label><?=$LANG['Password']== NULL?'Password':$LANG['Password']?></label><?=form_password(array('name'=>'password','value'=>'','class'=>'password textbox'))?>
     	<div class="clr"></div>
          <label><?=$LANG['Confirm Password']== NULL?'Confirm Password':$LANG['Confirm Password']?></label><?=form_password(array('name'=>'confirm_password','value'=>'','class'=>'confirm_password textbox'))?>
     	<div class="clr"></div>
          <label>&nbsp;</label> <input type="submit" value="Create my Account" class="button_02 left" style="margin-top:15px;" id="submit_button" />
          <div class="clr"></div>
		  
		<?=form_close("\n")?>  	  
		  
           <p class="top_margin"><?=$LANG['By updating your profile you are agreeing with our']== NULL?'By updating your profile you are agreeing with our':$LANG['By updating your profile you are agreeing with our']?><a href="<?php echo base_url().'terms_conditions'?>"><?=$LANG['Terms and Conditions']== NULL?'Terms and Conditions':$LANG['Terms and Conditions']?></a> <?=$LANG['and']== NULL?'and':$LANG['and']?>  <a href="<?php echo base_url().'privacy'?>"><?=$LANG['Privacy statement']== NULL?'Privacy statement':$LANG['Privacy statement']?></label></a>.</p>
  <h3 class="top_margin"><?=$LANG['Already a registered user']== NULL?'Already a registered user':$LANG['Already a registered user']?> ? 
  <a href="javascript:void(0);" onclick="hide_dialog('sign_in_box');show_dialog('sign_in_box');"><?=$LANG['Click here']== NULL?'Click here':$LANG['Click here']?></a>
  </h3>
  
     </div>
<!--  /******************************** User SIGNUP BOX END *****************************************************/ -->  	  
     
<!--  /******************************** User LOGIN BOX START *****************************************************/ -->  
     <div id="sign_in_box" class="signin_box" style="display:none; position:absolute; width:320px;">
     <div class="close_btn"><a href="javascript:void(0)" onclick="hide_dialog()"><img src="images/close_btn.png" alt="" /></a></div>
	     <?php echo form_open('login');?>
		  <h3><?=$LANG['Sign in']== NULL?'Sign in':$LANG['Sign in']?></h3>
     <div id="email_validate_error" style="display:none; padding-left:66px; color:red;"></div>
	 	<label><?=$LANG['Email']== NULL?'Email':$LANG['Email']?></label><?=form_input(array('name'=>'email','value'=>'','class'=>'username textbox'))?><br />
     	<div class="clr"></div>
          <label><?=$LANG['Password']== NULL?'Password':$LANG['Password']?></label><?=form_password(array('name'=>'password','value'=>'','class'=>'password_signup textbox'))?><br />
     	<div class="clr"></div>
          <label>&nbsp;</label><label style="width:220px;"><?=$LANG['Forgot your password']== NULL?'Forgot your password':$LANG['Forgot your password']?> ? <!--<a href="<?php //echo base_url().'user/forget_password/';?>"><?php //echo insertStaticWord('Click here'); ?></a>-->
		  <a href="javascript:void(0);" onclick="hide_dialog('forget_password_box');show_dialog('forget_password_box');"><?=$LANG['Click here']== NULL?'Click here':$LANG['Click here']?></a></label>
          <div class="clr"></div>
          <label>&nbsp;</label><input type="submit" value="<?=$LANG['Sign in']== NULL?'Sign in':$LANG['Sign in']?>" class="button_01 left" style="margin-top:15px;" id="submit" /><?php //echo form_submit('submit','Sign In','id="submit"'); ?>
		  <div class="clr"></div>
		   <label>&nbsp;</label><label style="width:220px;"><?=$LANG['Not a Member yet']== NULL?'Not a Member yet':$LANG['Not a Member yet']?> ?
		  <a href="javascript:void(0);" onclick="hide_dialog('sign_up_box');show_dialog('sign_up_box');"><?=$LANG['Click here']== NULL?'Click here':$LANG['Click here']?></a>				  </label>

		  <?=form_close()?>
     </div>
	 
<!--  /******************************** User LOGIN BOX END *****************************************************/ -->  	 


<!--########################################################################Forget Password BOX Start####################################################################### -->	 
	 
	      <div id="forget_password_box" class="signin_box" style="display:none; position:absolute; width:320px;">
     <div class="close_btn"><a href="javascript:void(0)" onClick="hide_dialog()"><img src="images/close_btn.png" alt="" /></a></div>
	 
          <?php //echo form_open('Forget Password');?>
		  <form name="forget_password" id="forget_password" action="<?php echo base_url()?>user/forget_password" method="post">
		  <h3><?=$LANG['Forget Password']== NULL?'Forget Password':$LANG['Forget Password']?></h3></h3>
		  
		  	<span class="forget_password_msg" style="display:none; color:red; padding-left:0px; font-size:95%; " ></span>
		  
     	<label><?=$LANG['Email']== NULL?'Email':$LANG['Email']?></label><?=form_input(array('name'=>'user_email','value'=>'','class'=>'forget_password_user_email textbox'))?>
     	<div class="clr"></div>
        <label>&nbsp;</label><input type="submit" value="<?=$LANG['Click']== NULL?'Click':$LANG['Click']?>" class="button_01 left" style="margin-top:15px;" id="forget_password_submit_button" />

		</form>
          <div class="clr"></div>
     </div>
	 
<!--########################################################################Forget Password BOX End####################################################################### -->	 	
	 
	 
	 
	 
<script type="text/javascript">
$(document).ready(function() {

/*###########################################SIGN IN CODE Start##########################################*/ 
$('#submit').click(function() {




var form_data = {
username : $('.username').val(),
password : $('.password_signup').val(),
ajax : '1'
};

/*alert($('.username').val());
alert($('.password_signup').val());*/
if($('.username').val()=='' || $('.password_signup').val()=='' )
{
		
		$('#email_validate_error').fadeIn(500).show();
		msg="Both Fields are Mandatory!!";
		$('#email_validate_error').html(msg);
		$('#email_validate_error').fadeIn(500).show();
	    //alert(msg);
		
	
	
}
else if(!validateEmail($('.username').val()))
{
	//msg="Please provide a valid email address !";
	//$('.email_validate_error').html(msg);
		$('#email_validate_error').fadeIn(500).show();
		msg="Invalid Email!!";
		$('#email_validate_error').html(msg);
		$('#email_validate_error').fadeIn(500).show();
		//alert(msg);
		

}
else
{
		$.ajax({
		//url: "<?php //echo site_url('login/ajax_check'); ?>",
		url: "login/login_check/",
		type: 'POST',
		async : false,
		data: form_data,
		success: function(msg) {
		//alert(msg);
		$('#email_validate_error').fadeIn(500).show();
		$('#email_validate_error').html(msg);
		$('#email_validate_error').fadeIn(500).show();
		}
		});
}
return false;
});
/*########################################### SIGN IN CODE End ##########################################*/ 

/*###########################################SIGN UP CODE Start##########################################*/ 	 
	 $("#submit_button").click(function() {
	 
	 //alert("I am here !");

var form_data = {
email : $('.email').val(),
first_name : $('.first_name').val(),
last_name : $('.last_name').val(),
password : $('.password').val(),
confirm_password : $('.confirm_password').val(),
ajax : '1'
}


			if($('.email').val()==''){
					msg="Enter Email ID !";
					$('#message').html(msg);
					$('#message').fadeIn(500).show();
					return false;
								
			}
			
			else if(!validateEmail($('.email').val()))
			{
            msg="Please provide a valid email address !";
			$('#message').html(msg);
			$('#message').fadeIn(500).show();
			return false;
			}
			
			else if($('.first_name').val()=='')
			{
			msg="Enter First Name !";
			$('#message').html(msg);
			$('#message').fadeIn(500).show();
			return false;
   	        }
           else if($('.last_name').val()=='')
			{
			msg="Enter Last Name !";
			$('#message').html(msg);
			$('#message').fadeIn(500).show();
			return false;
			}
			else if($('.password').val()=='')
			{
				msg="Enter Password !";
				$('#message').html(msg);
				$('#message').fadeIn(500).show();
				return false;
			}
			else if($('.confirm_password').val()=='')
			{
				msg="Enter Confirm Password !";
				$('#message').html(msg);
				$('#message').fadeIn(500).show();
				return false;
			}
/*			else if($('.password').val()!=$('.confirm_password'))
			{
			msg="Password and Confrim Password does not match !";
			$('#message').html(msg);
			$('#message').fadeIn(500).show();
			return false;
			}*/

			else
			{
			
				$.ajax({
				//url: "<?php //echo site_url('login/ajax_check'); ?>",
				url: "signup/signup_check",
				type: 'POST',
				async : false,
				data: form_data,
				success: function(msg) {
				$('#message').html(msg);
				}
				});
			
			}


return false;
});
/*###########################################SIGN UP CODE End##########################################*/ 

/*###########################################Forget Passowrd CODE Start##########################################*/ 
 $("#forget_password_submit_button").click(function() {


var form_data = {
forget_password_user_email : $('.forget_password_user_email').val(),
ajax : '1'
}



if($('.forget_password_user_email').val()=='')
{
					    msg="Enter Email ID !!";
						$('.forget_password_msg').html(msg);
						$('.forget_password_msg').fadeIn(500).show();
}
else
{
	 				   if(!validateEmail($('.forget_password_user_email').val())){
					    msg="Please provide a valid email address !";
						$('.forget_password_msg').html(msg);
						$('.forget_password_msg').fadeIn(500).show();

						return false;
						}

						else
						{
						//alert($('.forget_password_user_email').val());
						//alert('i am here');	
							$.ajax({
							//url: "<?php //echo site_url('login/ajax_check'); ?>",
							url: "user/forget_password",
							type: 'POST',
							async : false,
							data: form_data,
							success: function(msg) {
							//alert(msg);
						$('.forget_password_msg').html(msg);
						$('.forget_password_msg').fadeIn(500).show();

							}
							});

						}
}
return false;
});
});

/*###########################################Forget PassowrdCODE End##########################################*/ 
function validateEmail(user_email){
   var filter = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{1,4}$/;
    if(filter.test(user_email)){
        return true;
    }else{
        return false;
    }
}
function rating_details(id){
    $.ajax({
    url: "hotelsummaries/get_reviews",
    type: 'POST',
    async : false,
    data: {hotel_id : id},
    beforeSend: function() {
    $('#balloon1').html('Loading...');
    $('#balloon1').css({'display':'block'});
    },    
    success: function(msg) {
    $('#balloon1').html(msg); 
    $('#balloon1').css({'display':'block'});
    }
    });
}
/* TOOL TIP RATING */        
</script>