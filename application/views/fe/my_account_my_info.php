<?php 
$user_session_info = $this->session->userdata('LOGGEDIN_USER'); 

//-------------------- USER DETAIL ARRAY ------------------------------//
/*echo"<pre>";
print_r($user_detail);
echo"</pre>"; */
//-------------------- USER LANGUAGE DETAIL ARRAY BY USER ID  ------------------------------//


/*echo"<pre>";
print_r($user_language_detail);
echo"</pre>";


echo"<pre>";
print_r($user_country_detail);
echo"</pre>";

*/


?>
<script type="text/javascript"> 
/*$(document).ready(function() {


$("#change_passowrd_link").click(function() {
alert("hello");
$("#change_password_div").show();

});
});*/	

// JavaScript Document
$(document).ready(function() {
<!--################### 3 tabs ######################-->

		$("#details_tabing ul li").click(function() {
		
		   $( '#details_tabing ul li').each(function(){
			 $('#details_tabing ul li ').removeClass();
			 currentId = $(this).attr('id');
			 $('#div'+currentId).hide();
		   }); 
		   
		   $(this).addClass('select');
		   currentId = $(this).attr('id');
		   $('#div'+currentId).show();
		});
<!--################### Add Email Code ######################-->		
		
 $("#add_email").click(function () {
 
	  //$('#email_box_main').append('#email_box');
	  //$('#email_box_main').append('');
	  
 
    });
		
<!--################### Password Box Code ######################-->	

$("#password_submit").click(function() {
/*alert($('.old_password').val());
alert($('.new_password').val());
alert($('.id').val());*/
var form_data = {
old_password : $('.old_password').val(),
new_password : $('.new_password').val(),
id : $('.id').val(),
ajax : '1'
}



if($('.old_password').val()=='' || $('.new_password').val()=='')
{
  msg="Both fileds are mandatory !";
  //alert("Both fileds are mandatory");
  $('#password_msg').html(msg);
  $('#password_msg').fadeIn(500).show();
 

}
else if($('.old_password').val() != $('.new_password').val())
{
	msg="Old Password and New Password are not same !!!!";
	//alert("Old Password and New Password does not match !!");
	$('#password_msg').html(msg);
    $('#password_msg').fadeIn(500).show();

}
else
{


				$.ajax({
				//url: "<?php //echo site_url('login/ajax_check'); ?>",
				url: "user/my_account_password_update",
				type: 'POST',
				async : false,
				data: form_data,
				success: function(msg) {
				//alert(msg);
				$('#password_msg').html(msg);
				}
				});



}
return false;
});
		
		
<!--################### Add Email Code ######################-->	

$("#add_new_email").click(function() {
var form_data = {
new_email : $('.new_email').val(),
id : $('.id').val(),
ajax : '1'
}



if($('.new_email').val()=='')
{
  msg="Email filed is mandatory !";
  //alert("Email filed is mandatory !");
  $('#div_error').html(msg);
  $('#div_error').fadeIn(500).show();
 

}
else  if(!validateEmail($('.new_email').val())){

                        msg="Please provide a valid email address !";
						$('#div_error').html(msg);
						$('#div_error').fadeIn(500).show();
						//alert("Please provide a valid email address !");
						return false;

                    }
else
{

				$.ajax({
				//url: "<?php //echo site_url('login/ajax_check'); ?>",
				url: "user/my_account_add_email",
				type: 'POST',
				async : false,
				data: form_data,
				success: function(msg) {
				//alert(msg);
				$('#div_error').html(msg);
				$('#div_error').fadeIn(500).show();
				//$("#div3").load(location.href + " #div3>*", "");
				window.setTimeout('location.reload()', 2000);	
				}
				});


}
return false;
});





<!--################### Remove Second Email ID Code ######################-->	

$("#remove_second_id").click(function() {

var form_data = {
new_email : $('.new_email').val(),
ajax : '1'
}


					$.ajax({
				//url: "<?php //echo site_url('login/ajax_check'); ?>",
				url: "user/delete_second_id",
				type: 'POST',
				async : false,
				data: form_data,
				success: function(msg) {
				//alert(msg);
				$('#div_error').html(msg);
				$('#div_error').fadeIn(500).show();
				//$("#div3").load(location.href + " #div3>*", "");
				
				window.setTimeout('location.reload()', 2000);	
				}
				});



return false;
});
		
	
	
<!--################### Remove Third Email ID Code ######################-->	

$("#remove_third_id").click(function() {
var form_data = {
new_email : $('.new_email').val(),
ajax : '1'
}


					$.ajax({
				//url: "<?php //echo site_url('login/ajax_check'); ?>",
				url: "user/delete_third_id",
				type: 'POST',
				async : false,
				data: form_data,
				success: function(msg) {
				//alert(msg);
				$('#div_error').html(msg);
				$('#div_error').fadeIn(500).show();
				//$("#div3").load(location.href + " #div3>*", "");
				window.setTimeout('location.reload()', 2000);	
				}
				});



return false;


});


<!--################### Edit Second Email ID Code ######################-->	
$("#edit_second_id").click(function() {
show_dialog ("edit_second_email_box");
var second_email=$("#second_email_row").text();
$("#second_edit_email").val(second_email);

return false;
});


$("#second_email_submit_button").click(function() {

//alert($('.second_edit_email').val());
var form_data = {
second_edit_email : $('.second_edit_email').val(),
ajax : '1'
}


if($('.second_edit_email').val()=='')
{
  msg="Email filed is mandatory !";
 // alert("Email filed is mandatory !");
  $('#second_edit_div_error').html(msg);
  $('#second_edit_div_error').fadeIn(500).show(); 

}
else  if(!validateEmail($('.second_edit_email').val())){

                        msg="Please provide a valid email address !";
    					$('#second_edit_div_error').html(msg);
					    $('#second_edit_div_error').fadeIn(500).show(); 
						//alert("Please provide a valid email address !");
						window.setTimeout('location.reload()', 2000);	
						return false;

                    }
	else
	{
			
					$.ajax({
				//url: "<?php //echo site_url('login/ajax_check'); ?>",
				url: "user/edit_second_id",
				type: 'POST',
				async : false,
				data: form_data,
				success: function(msg) {
				//alert(msg);
				$('#div_error').html(msg);
				$('#div_error').fadeIn(500).show();
				//$("#div3").load(location.href + " #div3>*", "");
				window.setTimeout('location.reload()', 2000);	
				}
				});

	}
return false;
});
	


<!--################### Edit Third Email ID Code ######################-->	
$("#edit_third_id").click(function() {
show_dialog ("edit_third_email_box");
var third_email=$("#third_email_row").text();
$("#third_edit_email").val(third_email);
return false;
});


$("#third_email_submit_button").click(function() {



//alert($('.third_edit_email').val());
var form_data = {
third_edit_email : $('.third_edit_email').val(),
ajax : '1'
}


if($('.third_edit_email').val()=='')
{
  msg="Email filed is mandatory !";
 // alert("Email filed is mandatory !");
  $('#third_edit_div_error').html(msg);
  $('#third_edit_div_error').fadeIn(500).show(); 

}
else  if(!validateEmail($('.third_edit_email').val())){

                        msg="Please provide a valid email address !";
    					$('#third_edit_div_error').html(msg);
					    $('#third_edit_div_error').fadeIn(500).show(); 
						//alert("Please provide a valid email address !");
						return false;

                    }
	else
	{
			
					$.ajax({
				//url: "<?php //echo site_url('login/ajax_check'); ?>",
				url: "user/edit_third_id",
				type: 'POST',
				async : false,
				data: form_data,
				success: function(msg) {
				//alert(msg);
				$('#div_error').html(msg);
				$('#div_error').fadeIn(500).show();
				//$("#div3").load(location.href + " #div3>*", "");
				window.setTimeout('location.reload()', 2000);	
				}
				});

	}
return false;



});	
		
		
  });
	       
</script>

     	<div id="content">
          	<div class="page_nav">
               	<p><a href="index.php"><?=$LANG['You are here']== NULL?'You are here':$LANG['You are here']?>:&nbsp;&nbsp;<a href="index.php"><?=$LANG['Home']== NULL?'Home':$LANG['Home']?></a><img src="images/arrow2.png" alt="" /><a href="<?php echo base_url().'user/my_account_home/';?>"><?=$LANG['My Account']== NULL?'My Account':$LANG['My Account']?> </a></p>
               </div>
          	<!--LEFT PANEL START-->
               	<div class="left_panel_02">
                    	<div class="blue_box">
                         	<div class="inner_nav">
                              	<ul>
	                                   	<li><img src="images/icon_10.png" alt="" /> <a href=<?php echo base_url().'user/my_account_home/';?>><?=$LANG['Home']== NULL?'Home':$LANG['Home']?></a></li>
                                        <li><img src="images/icon_11.png" alt="" /> <a href="<?php echo base_url().'user/my_booking_list';?>"><?=$LANG['My Booking']== NULL?'My Booking':$LANG['My Booking']?></a></li>
                                        <li><img src="images/icon_27.png" alt="" /> <a href="<?php echo base_url().'user/my_review_list';?>"><?=$LANG['My Review']== NULL?'My Review':$LANG['My Review']?></a></li>
                                        <li class="select"><img src="images/icon_12.png" alt="" /> <a href="<?php echo base_url().'user/my_account_my_info';?>"><?=$LANG['My Account']== NULL?'My Account':$LANG['My Account']?></a></li>
                                        <li><img src="images/icon_13.png" alt="" /> <a href="<?php echo base_url().'user/sign_out/';?>"><?=$LANG['Sign Out']== NULL?'Sign Out':$LANG['Sign Out']?></a></li>
                                   </ul>
                              </div>
                         </div>
                    </div>
               <!--LEFT PANEL END-->

               <!--RIGHT PANEL START-->
               	<div class="right_panel_02">
                    	<div class="inner">
                         	<div class="inner_heading">
                              	<div class="left_part"><?=$LANG['My Account']== NULL?'My Account':$LANG['My Account']?></div>
                                   <div class="right_part"><a href="<?php echo base_url().'user/sign_out/';?>"><img src="images/icon_03.png" alt="" /> <?=$LANG['Sign Out']== NULL?'Sign Out':$LANG['Sign Out']?></a></div>
                                   <div class="clr"></div>
                              </div>
                              <div class="inner_cont">
                              	<div id="details_tabing" class="acount_tab">
                                   	<ul>
                                        	<li id="1" class="select"><img src="images/icon_15.png" alt="" /> <a href="javascript:void(0);" ><?=$LANG['My Information']== NULL?'My Information':$LANG['My Information']?></a></li>
                                             <li id="2"><img src="images/icon_14.png" alt="" /> <a href="javascript:void(0);"><?=$LANG['Change my Password']== NULL?'Change my Password':$LANG['Change my Password']?> </a></li>
                                             <li id="3"><img src="images/icon_16.png" alt="" /> <a href="javascript:void(0);" ><?=$LANG['My Email Addresses']== NULL?'My Email Addresses':$LANG['My Email Addresses']?></a></li>
                                        </ul>
                                   </div>
                                   <div class="clr"></div>
                                   <div id="div1">
                                        <div class="account_row">
                                             <p><?=$LANG['We’ll use this information to complete your future bookings']== NULL?'We’ll use this information to complete your future bookings':$LANG['We’ll use this information to complete your future bookings']?>. </p>
                                        </div>

<div style="color:red;">
<?php
echo $this->session->flashdata('message1');
?>							   
</div>                                         <div class="account_row">
                                             <p><?=$LANG['Name']== NULL?'Name':$LANG['Name']?></p>
                                             <h5><!--Alex Brown--><?php  if(!empty($user_session_info)){echo $user_detail['first_name']." ".$user_detail['last_name'];}?></h5>
                                         </div>
                                         <div class="account_row">
                                             <p><?=$LANG['Email']== NULL?'Email':$LANG['Email']?></p>
                                             <h5><!--alex.brown@gmail.com--><?php  if(!empty($user_session_info)){echo $user_detail['email_address'];}?></h5>
                                         </div>
                                         <div class="account_row">
                                             <p><?=$LANG['Address']== NULL?'Address':$LANG['Address']?></p>
                                             <h5><!--India--><?php if(!empty($user_session_info)){echo $user_detail['address'];} ?></h5>
                                         </div>
                                         <div class="account_row">
                                             <p><?=$LANG['City']== NULL?'City':$LANG['City']?></p>
                                             <h5><!--India--><?php if(!empty($user_session_info)){echo $user_detail['city'];} ?></h5>
                                         </div>
                                         <div class="account_row">
                                             <p><?=$LANG['ZipCode']== NULL?'ZipCode':$LANG['ZipCode']?></p>
                                             <h5><!--India--><?php if(!empty($user_session_info)){echo $user_detail['zip_code'];} ?></h5>
                                         </div>

                                         <div class="account_row">
                                             <p><?=$LANG['Country']== NULL?'Country':$LANG['Country']?></p>
                                             <h5><!--India--><?php if(!empty($user_session_info) && $user_detail['country_code']){echo $user_country_detail['country_name'];} ?></h5>
                                         </div>

                                         <div class="account_row">
                                             <p><?=$LANG['Language']== NULL?'Language':$LANG['Language']?></p>
                                             <h5><!--English (US)--><?php if(!empty($user_language_detail)){echo $user_language_detail['language'];} ?></h5>
                                         </div>
                                         <div class="account_row">
                                             <p><?=$LANG['Telephone']== NULL?'Telephone':$LANG['Telephone']?></p>
                                             <h5><!--123456789--><?php if(!empty($user_session_info)){echo $user_detail['ph_no'];} ?></h5>
                                         </div>
                                        <input  type="button" value="Edit" class="button_01" style="margin-top:10px;" onclick="window.location.href='<?php echo base_url().'user/my_account_edit';?>'" />
                                        <p class="top_margin"><?=$LANG['By updating your profile you are agreeing with our']== NULL?'By updating your profile you are agreeing with our':$LANG['By updating your profile you are agreeing with our']?> <a href="<?php echo base_url().'home/terms_conditions'?>"><?=$LANG['Terms and Conditions']== NULL?'Terms and Conditions':$LANG['Terms and Conditions']?></a> <?=$LANG['and']== NULL?'and':$LANG['and']?> <a href="<?php echo base_url().'home/privacy'?>"><?php echo $LANG['Privacy statement']== NULL?'Privacy statement':$LANG['Privacy statement'] ;?></a>.</p>
                                   </div>
                              <!--TAB 1 END-->
                                   <div id="div2" style="display:none">
                                   	<div class="change_password" id="change_password">
                                   		<p><?=$LANG['Create your own password and reset it whenever you like']== NULL?'Create your own password and reset it whenever you like':$LANG['Create your own password and reset it whenever you like']?>.</p>
										 
											<div id="password_msg" class="pwd_msg" style="color:red; padding-left:148px; font-size:95%;"></div>
										
										<?php echo form_open('my_account_form');?>
										<input type="hidden" name="id" value="<?php echo $user_session_info['user_id']?>" class="id"/>
                                             <label><?=$LANG['New Password']== NULL?'New Password':$LANG['New Password']?></label><?=form_password(array('name'=>'old_password','value'=>'','class'=>'old_password textbox'))?>
                                             <div class="clr"></div>
                                             <label><?=$LANG['Repeat New Password']== NULL?'Repeat New Password':$LANG['Repeat New Password']?></label><?=form_password(array('name'=>'new_password','value'=>'','class'=>'new_password textbox'))?>
                                             <div class="clr"></div>
                                             <label></label><input type="submit" value="Save" class="button_01 left" style="margin-top:12px;" id="password_submit"/>
                                             <div class="clr"></div>
                                         </form>    
											 <p class="top_margin"><?=$LANG['By updating your profile you are agreeing with our']== NULL?'By updating your profile you are agreeing with our':$LANG['By updating your profile you are agreeing with our']?> <a href="<?php echo base_url().'home/terms_conditions'?>"><?=$LANG['Terms and Conditions']== NULL?'Terms and Conditions':$LANG['Terms and Conditions']?></a> <?=$LANG['and']== NULL?'and':$LANG['and']?> <a href="<?php echo base_url().'home/privacy'?>"><?php echo $LANG['Privacy statement']== NULL?'Privacy statement':$LANG['Privacy statement'] ;?></a>.</p>
                                        </div>
                                   </div>
                                <!--TAB 2 END--> 
                                	<div id="div3" style="display:none">
                                   	<div class="account_row">
                                             <p><?=$LANG['Save up to 3 email addresses, and use any of them to sign in']== NULL?'Save up to 3 email addresses, and use any of them to sign in':$LANG['Save up to 3 email addresses, and use any of them to sign in']?>.</p>
                                        </div>
										<span id="msg_div" style="color:red; padding-left:148px; font-size:95%; display:none;"></span>
										<span id="div_error" style="color:red; padding-left:148px; font-size:95%; display:none;"></span>
										<span id="div_success" style="color:red; padding-left:148px; font-size:95%; display:none;"></span>
                                        <div class="account_row">
                                        	<p><?=$LANG['Main email address']== NULL?'Main email address':$LANG['Main email address']?>: </p>
                                             <h5><?php  if(!empty($user_session_info)){echo $user_detail['email_address'];}?></h5>
                                             <h6><?=$LANG['Booking confirmations will be sent to this address']== NULL?'Booking confirmations will be sent to this address':$LANG['Booking confirmations will be sent to this address']?> </h6>
                                        </div>
										<!--check db , if email add 2 is thr fetch it with a row -->
										<!--check db , if email add 3 is thr fetch it with a row -->
										<!--count row <3 then show below div , else hide it -->
										<?php if($user_detail['email_address2']!=''){ ?>
										<div class="account_row">
										<table width="100%">
										<tr>
											<td width="50%" >
                                        	<p><?=$LANG['Second Email address']== NULL?'Second Email address':$LANG['Second Email address']?>: </p>
                                             <h5><div id="second_email_row"><?php  echo $user_detail['email_address2'];?></div></h5>
											 </td>
											 <td width="20%"></td>
											 <td  width="15%" align="right" class="my_email_link">
											 	<a href="javascript:void(0)" id="remove_second_id"><?=$LANG['Remove Email']== NULL?'Remove Email':$LANG['Remove Email']?></a>
											 </td>
											 <td  width="15%" align="right" class="my_email_link">
											 	<a href="javascript:void(0)" id="edit_second_id"><?=$LANG['Edit Email']== NULL?'Edit Email':$LANG['Edit Email']?></a>
											 </td>

                                         </tr>
										 </table>    
                                        </div>
                                        <?php 
										}
										if($user_detail['email_address3']!=''){ ?>
										<div class="account_row">
										<table width="100%">
										<tr>
											<td width="50%" >
	                                        	<p><?=$LANG['Third Email address']== NULL?'Third Email address':$LANG['Third Email address']?>: </p>
                                             <!--<h5><div id="third_email_value"><?php  //echo $email_address3;?></div></h5>-->
											 <h5><div id="third_email_row"><?php  echo $user_detail['email_address3'];?></div></h5>
											 </td>
											 <td width="20%"></td>
											  <td  width="15%" align="right" class="my_email_link">
											 	<a href="javascript:void(0)" id="remove_third_id"><?=$LANG['Remove Email']== NULL?'Remove Email':$LANG['Remove Email']?></a>
											 </td>
											  <td  width="15%" align="right" class="my_email_link">
											 	<a href="javascript:void(0)" id="edit_third_id"><?=$LANG['Edit Email']== NULL?'Edit Email':$LANG['Edit Email']?></a>
											 </td>
                                         </tr>
										 </table>
                                             
                                        </div>
										<?php } ?>
										<div class="change_password" id="email_box_main">
										<?php 
										//echo $email_address." ".$email_address2." ".$email_address3; 
										if($user_detail['email_address'] =='' || $user_detail['email_address2'] =='' ||  $user_detail['email_address3'] =='')
										{
										
										echo form_open('my_account_form');
										?>
										<input type="hidden" name="id" id="id" class="id" value="<?php $user_session_info['user_id'];?>"/>
                                        	<div id="email_box" ><label><?=$LANG['New email address']== NULL?'New email address':$LANG['New email address']?>:</label><input type="text" name="new_email" id="new_email" class="new_email"/></div>
                                             <div class="clr"></div>
                                             <label></label><input type="submit" value="Add new email" class="button_02 left" style="margin-top:12px;" id="add_new_email"/>
                                             <div class="clr"></div>
										
										<?php echo form_close("\n"); } ?> 
                                            <p class="top_margin"><?=$LANG['By updating your profile you are agreeing with our']== NULL?'By updating your profile you are agreeing with our':$LANG['By updating your profile you are agreeing with our']?> <a href="<?php echo base_url().'home/terms_conditions'?>"><?=$LANG['Terms and Conditions']== NULL?'Terms and Conditions':$LANG['Terms and Conditions']?></a> <?=$LANG['and']== NULL?'and':$LANG['and']?> <a href="<?php echo base_url().'home/privacy'?>"><?php echo $LANG['Privacy statement']== NULL?'Privacy statement':$LANG['Privacy statement'] ;?></a>.</p>
                                        </div>
                                   </div>
                                <!--TAB 3 END-->  
                              
                              </div>
                         </div>
                    </div>
               <!--RIGHT PANEL END-->
               <div class="clr"></div>
          </div>
     <!--CONTENT SECTION END-->
     
     </div>
  <!-- Second Edit Div Start-->
      <div id="edit_second_email_box" class="signin_box" style="display:none; position:absolute; width:320px;">
      <div class="close_btn"><a href="javascript:void(0)" onClick="hide_dialog()"><img src="images/close_btn.png" alt="" /></a></div>
          <h3><?=$LANG['New email address']== NULL?'Edit Email':$LANG['Edit Email']?></h3>
		  <span id="second_edit_div_error" style="display:none; color:red; padding-left:0px; font-size:95%;"></span>
		  <span id="second_edit_div_success" style="display:none; color:red; padding-left:0px; font-size:95%;"></span>
     	<?php echo form_open('my_account_second_email_form');?>
		<label><?=$LANG['Email']== NULL?'Email':$LANG['Email']?></label><input type="text" name="second_edit_email" id="second_edit_email" class="second_edit_email"/>
     	<div class="clr"></div>
          <label>&nbsp;</label><input type="submit" value="Edit Email" class="button_01 left" style="margin-top:15px;" id="second_email_submit_button" />
          <div class="clr"></div>
		<?php echo form_close("\n"); ?>   
     </div>
  <!-- Second Edit Div END-->
    <!-- Third Edit Div Start-->	 
      <div id="edit_third_email_box" class="signin_box" style="display:none; position:absolute; width:320px;">
      <div class="close_btn"><a href="javascript:void(0)" onClick="hide_dialog()"><img src="images/close_btn.png" alt="" /></a></div>
          <h3><?=$LANG['New email address']== NULL?'Edit Email':$LANG['Edit Email']?></h3>
		  <div class="msg_third_email">
		  <span id="third_edit_div_success" style="display:none; color:red; padding-left:0px; font-size:95%;"></span>
		  <span id="third_edit_div_error" style="display:none; color:red; padding-left:0px; font-size:95%;"></span>
		  </div>
     	<form action="#" method="post">
		<label><?=$LANG['Email']== NULL?'Email':$LANG['Email']?></label><input type="text" name="third_edit_email" id="third_edit_email" class="third_edit_email"/>
     	<div class="clr"></div>
          <label>&nbsp;</label><input type="submit" value="Edit Email" class="button_01 left" style="margin-top:15px;" id="third_email_submit_button" />
          <div class="clr"></div>
		</form>  
     </div>	 
  <!-- Third Edit Div END--> 
     
<?php //include("footer.php");?>