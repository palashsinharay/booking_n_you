<?php 
  $logged_user = $session->userdata('logged_user');
  $alert = $session->flashdata('error');
  //$logged_user = $logged_user[0];
?>
<div class="rightPanel">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
    <tr>
      <td align="left" valign="top" class="headingTxt"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="60%" align="left" valign="top">Site Configuration</td>
            <td align="right" valign="top" class="h_name"></td>
          </tr>
        </table></td>
    </tr>
<?php foreach ($pageDetails as $row): ?>	
    <tr>
      <td align="left" valign="top" class="border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" class="frmContainer">
			<?php echo form_open(base_url().'admin/siteconfig',array("id"=>"siteconf_form"));?>
				<input type="hidden" name="action" value="siteconf" />
				<input type="hidden" name="id" value="<?=$row->id?>" />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					
					<tr>
						<td align="left" valign="top"><table width="100%" border="0" cellspacing="8" cellpadding="0">
					<tr>
                        <td width="20%" align="right" valign="top">Copyright</td>
                        <td width="2%" align="left" valign="top">:</td>
                        <td align="left" valign="top"><input name="SettingsCopyright" type="text" class="txtbox1"  valid='not' id="SettingsCopyright" size="30" value="<?=$row->SettingsCopyright?>" /></td>
                    </tr>
					
					<tr>
                        <td width="20%" align="right" valign="top">Currency</td>
                        <td width="2%" align="left" valign="top">:</td>
                        <td align="left" valign="top">
							<input name="SettingsCurrency" type="text" class="txtbox1" id="SettingsCurrency" valid='not' size="30"  value="<?=$row->SettingsCurrency?>" />
						</td>
                    </tr>
					
					<tr>
                        <td width="20%" align="right" valign="top">Language</td>
                        <td width="2%" align="left" valign="top">:</td>
                        <td align="left" valign="top">
							<input name="SettingsLanguage" type="text" class="txtbox1" id="SettingsLanguage" valid='not' size="30"  value="<?=$row->SettingsLanguage?>" />
						</td>
                    </tr>
					
					<tr>
                        <td width="20%" align="right" valign="top">Email Address</td>
                        <td width="2%" align="left" valign="top">:</td>
                        <td align="left" valign="top">
							<input name="SettingsEmail" type="text" class="txtbox1" id="SettingsEmail" valid='not' size="30"  value="<?=$row->SettingsEmail?>" />
						</td>
                    </tr>
					
					<tr>
                        <td width="20%" align="right" valign="top">Email Subject (Admin)</td>
                        <td width="2%" align="left" valign="top">:</td>
                        <td align="left" valign="top"><input name="SettingsEmailSubject" type="text" class="txtbox1" id="SettingsEmailSubject" valid='not' size="30" value="<?=$row->SettingsEmailSubject?>" /></td>
                    </tr>
					<tr>
                        <td width="20%" align="right" valign="top">Email Body</td>
                        <td width="2%" align="left" valign="top">:</td>
                        <td align="left" valign="top"><input name="SettingsEmailBody" type="text" class="txtbox1" id="SettingsEmailBody" valid='not' size="30" value="<?=$row->SettingsEmailBody?>" /></td>
                    </tr>
					<tr>
                        <td width="20%" align="right" valign="top">Email Subject (Client)</td>
                        <td width="2%" align="left" valign="top">:</td>
                        <td align="left" valign="top"><textarea name="SettingsAckSubject" id="SettingsAckSubject" valid="not" class="txtarea-width"><?=$row->SettingsAckSubject?></textarea></td>
                    </tr>
					
					<tr>
                        <td width="20%" align="right" valign="top">Email Body</td>
                        <td width="2%" align="left" valign="top">:</td>
                        <td align="left" valign="top"><input name="SettingsAckBody" type="text" class="txtbox1" id="SettingsAckBody" valid='not' size="30" value="<?=$row->SettingsAckBody?>" /></td>
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
<?php endforeach;?>	  
        </table></td>
    </tr>
  </table>
</div>
