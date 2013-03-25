<?php 
include("common/header.php");
//print_r($this->data);
$id=$this->data['id'];
//echo $id;

			// NEW PASSWORD AND CONFIRM PASSWORD FORM , Update DB with NEW PASSWORD , Update requested passwd feild 0
?>	
<!--########################################################################New/Confirm Password BOX Start####################################################################### -->	 

 <div id="content" style="min-height:240px;">
     

<div style="width:26%; margin:0 auto; padding:20px 0;">
<div class="inner">
                         	<div class="inner_heading">
                              	<div class="left_part"><?php echo $LANG['Reset Password']== NULL?'Reset Password':$LANG['Reset Password'] ;?></div>
                                  <div class="clr"></div>
                              </div>
							  <span id="msg" style="display:block;padding-left:0px; color:red;"></span>

                              <div class="inner_cont">
                                   
                              <form action="<?php echo base_url()?>user/password_reset_update" method="post">
		  <input type="hidden" name="id" id="id" value="<?php echo $id;?>" class="id"/>
		  
			<div class="account_row" style="border-bottom:none;">
			<p><?php echo $LANG['New Password']== NULL?'New Password':$LANG['New Password'] ;?> :</p>
			<?=form_password(array('name'=>'new_password','value'=>'','class'=>'new_password textbox'))?>                                    
			</div>
			
			<div class="account_row" style="border-bottom:none;">
			<p><?php echo $LANG['Confirm Password']== NULL?'Confirm Password':$LANG['Confirm Password'] ;?>  :</p>
			<?=form_password(array('name'=>'confirm_password','value'=>'','class'=>'confirm_password textbox'))?>                                  
			</div>
		  
		  
		 <input type="submit" name="confirm_password_submit_button" value="click" class="button_01 left" style="margin-top:15px;" id="confirm_password_submit_button" />
		
		  </form>
                              
                              </div>
                         </div>
</div>
		  
     </div>
	 
<!--########################################################################Forget Password BOX End####################################################################### -->	 				
 <script type="text/javascript" >
 	$(document).ready(function() {
	
	/*###########################################Forget Passowrd CODE Start##########################################*/ 
 $("#confirm_password_submit_button").click(function() {
//alert("i am here");

var form_data = {
new_password : $('.new_password').val(),
confirm_password : $('.confirm_password').val(),
id : $('.id').val(),
ajax : '1'
}


if($('.new_password').val()=='' || $('.confirm_password').val()=='')
{
					    msg="Both Fields are mandatory !!";
						//alert(msg);
						$('#msg').html(msg);
						$('#msg').fadeIn(500).show();
}
else if($('.new_password').val()!=$('.confirm_password').val())
{
						    msg="New password , Confirm password does not match  !!";
						//	alert(msg);
						$('#msg').html(msg);
						$('#msg').fadeIn(500).show();
	
}

						else
						{
							
								$.ajax({
								//url: "<?php //echo site_url('login/ajax_check'); ?>",
								url: "user/password_reset_update",
								type: 'POST',
								async : false,
								data: form_data,
								success: function(msg) {
							//	alert(msg);
								$('#msg').html(msg);
								}
								});
										
						}


return false;
});

});
 </script>								   
<?php			



include("common/footer.php");
?>
