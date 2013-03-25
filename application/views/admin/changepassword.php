<?php 
  $logged_user = $session->userdata('logged_user');
  $alert = $session->flashdata('error');
  //$logged_user = $logged_user[0];
 // print_r($logged_user);
?>
<div class="rightPanel">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
    <tr>
      <td align="left" valign="top" class="headingTxt"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="60%" align="left" valign="top">Change Your Password</td>
            <td align="right" valign="top" class="h_name"></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td align="left" valign="top" class="border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" class="frmContainer">
			<?php echo form_open(base_url().'admin/changepassword',array("id"=>"changepassword_form"));?>
				<input type="hidden" name="formname" value="changepassword" />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left" valign="top"><p class="mandatory_txt">All fields are mandatory.</p></td>
					</tr>
					<tr>
						<td align="left" valign="top"><table width="100%" border="0" cellspacing="8" cellpadding="0">
					<tr>
                        <td width="20%" align="right" valign="top">Old Password <span class="red-star">*</span></td>
                        <td width="2%" align="left" valign="top">:</td>
                        <td align="left" valign="top"><input name="old_password" type="password" class="txtbox1" id="old_password" size="30" /></td>
                    </tr>
                    <tr>
                        <td width="20%" align="right" valign="top">New Password <span class="red-star">*</span></td>
                        <td width="2%" align="left" valign="top">:</td>
                        <td align="left" valign="top"><input name="password" type="password" class="txtbox1" id="password" size="30" /></td>
                    </tr>
                    <tr>
                        <td width="20%" align="right" valign="top">Confirm Password <span class="red-star">*</span></td>
                        <td width="2%" align="left" valign="top">:</td>
                        <td align="left" valign="top"><input name="conf_password" type="password" class="txtbox1" id="conf_password" size="30" retypewith="password" /></td>
                    </tr>					
					<td align="left" valign="top">&nbsp;</td>
					<td align="left" valign="top">&nbsp;</td>
					<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					<td width="100" align="left" valign="top"><input type="submit" value="Submit" class="frm_btn" /></td>
					<td align="left" valign="top"><input type="reset" value="Reset" class="frm_btn" /></td>
					</tr>
					</table></td>
					</tr>
					</table></td>
					</tr>
				</table>

			<?php echo form_close();?>
			</td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
