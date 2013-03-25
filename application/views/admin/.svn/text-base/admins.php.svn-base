<?php
  //$logged_user = $session->userdata('logged_user');
  $logged_user = $session->userdata('logged_admin_user');
  $alert = $session->flashdata('error');
  $list_of_staticmenu_names=array('superadmin');
  $list_of_admin_names=array('admin');
?>
<!--Below Javascript use for every page on every purpose Like Add , Edit , Delete-->
<script>
$(document).ready(function(){
    var fb = true;
    $('#addAdmin').click(function(){
       fb = false;
       $('#cancelButton').click();
       $('#dataContainer').fadeOut(1000, function(){
           $('#formContainer').fadeIn(1000);
        });
        $('#id').val('');
        $('#action').val('add');
        $('#password').val('');
    });

	//----------Add SubMenu under root submenu------------------------------------------------------//

    $('#cancelButton').click(function(){

        if(fb){
            $('#formContainer').fadeOut(1000, function(){
               $('#dataContainer').fadeIn(1000);
            });
        }
        fb = true;

		/*$('#eimage').children('div').fadeOut(1000);
		$('#eimage').children('div').prev('input').show();
		$('#eimage').children('div').html("");*/

        $('.txtbox1').css('border', '1px solid #b8bab8');
    });

    $('.edit').click(function(){
        eval($(this).closest('td').children('div:first').text());
        fb = false;
        $('#cancelButton').click();
        $('#id1').val(aData['id1']);
		$('#username').val(aData['username']);
		$('#password').val(aData['password']);
		$('#conf_password').val(aData['password']);
		$('#admin_email').val(aData['admin_email']);
		$('#admin_name').val(aData['admin_name']);
		
        $('#action').val('update');

        $('#dataContainer').fadeOut(1000, function(){
           $('#formContainer').fadeIn(1000);
        });

    })

	/*$('#eimage').children('div').dblclick(function(){
		$(this).fadeOut(1000, function(){
			$(this).prev('input').show(1000);
		});
	});*/

    $('.delete').click(function(){
        eval($(this).closest('td').children('div:first').text());
        var answer = confirm("Do you really want to remove " + aData['username'] + "?");
        if(answer){
            window.location = '<?php echo base_url();?>admin/admins/delete_admin/'+aData['id1'];
        }


    });

    //Change Events Status------------------------------------------------------//
	$('.status').click(function(){
        eval($(this).closest('td').next('td').children('div:first').text());
        var answer = confirm("Do you really want to Change status " + aData['username'] + "?");
        if(answer){
            window.location = '<?php echo base_url();?>admin/admins/change_status/'+aData['id1']+'/'+aData['is_active'];
        }


    });

	/*var oFCKeditor = new FCKeditor('edetails');
	oFCKeditor.Height = "512";
	oFCKeditor.Width = "712";
    oFCKeditor.BasePath = "<?php echo $Rpath;?>fckeditor/";
    oFCKeditor.ReplaceTextarea();*/
	
	$("#btn_srchall").click(function(){
	$("#txt_username").val("");
	$("#txt_admin_name").val("");
    $("#frm_search_2").submit();
});


});


</script>
<div class="rightPanel">

<?php 
if($logged_user['AdminsStatus'] == 'S') {?><div style="padding-bottom : 10px; text-align: right;"><button id="addAdmin" class="frm_btn">Add Admin</button></div><?php }?>
<div style="display:none;" id="lblVoucher"><?=$url_id?></div>
  <table width="100%" border="0" cellspacing="2" cellpadding="0" style="display:none;" id="formContainer">
    <tr>
      <td align="left" valign="top" class="headingTxt">admins</td>
    </tr>
    <tr>
      <td align="left" valign="top" class="border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" class="frmContainer">
            <?php echo form_open_multipart(base_url().'admin/admins',array("id"=>"admins_form"));?>
                <input type="hidden" name="id1" id="id1" value="" />
                <input type="hidden" name="action" id="action" value="add" />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left" valign="top"><p class="mandatory_txt">All * fields are mandatory</p></td>
					</tr>
					<tr>
						<td align="left" valign="top"><table width="100%" border="0" cellspacing="8" cellpadding="0">

					<tr>
					    <td width="200" align="right" valign="top">Username<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="username" type="text" class="txtbox1" id="username" valid='alpanum' size="30" /></td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">Password<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="password" type="password" class="txtbox1" id="password" valid='alpanum' size="30" /></td>
					</tr>
                     <tr>
					    <td width="200" align="right" valign="top">Confirm Password<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="conf_password" type="password" class="txtbox1" id="conf_password" valid='alpanum' size="30" /></td>
					</tr>
                     <tr>
					    <td width="200" align="right" valign="top">Email<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="admin_email" type="text" class="txtbox1" id="admin_email" valid='alpanum' size="30" /></td>
					</tr>
                     <tr>
					    <td width="200" align="right" valign="top">Name<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="admin_name" type="text" class="txtbox1" id="admin_name" valid='alpanum' size="30" /></td>
					</tr>
                    
					 <tr>
					    <td align="right" valign="top">&nbsp;</td>
					    <td align="center" valign="top">&nbsp;</td>
						<td align="center" valign="top">&nbsp;</td>
					</tr>

					 <tr>
					    <td align="right" valign="top">&nbsp;</td>
					    <td align="center" valign="top">&nbsp;</td>
					    <td align="left" valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
					            <tr>
					                <td width="100" align="left" valign="top"><input type="submit" value="Submit" class="frm_btn" /></td>
					                <td align="left" valign="top"><input type="reset" value="Cancel" class="frm_btn" id="cancelButton" /></td>
					            </tr>
					        </table>
                        </td>
					</tr>
					</table>
                    </td>
					</tr>
				</table>
            <?php echo form_close();?>
            </td>
          </tr>
        </table></td>
    </tr>
  </table>
  
  <table width="100%" cellpadding="0" cellspacing="1" border="0" id="dataContainer">
  <tr>
    <td>
    <form id="frm_search_2" name="frm_search_2" method="post" action="<?php echo base_url().'admin/admins';?>" >
  <input type="hidden" id="h_search" name="h_search" value="basic">
        <div id="div_err_2"><div class="tab_general"><a href="#">Search</a></div></div>        
        <table width="100%" cellpadding="0" cellspacing="2" border="0" class="light_bg_tbl">
          <tr>
             <td width="15%" class="h_bg">Username:</td>
            <td  colspan="3" class="light_bg_2">
            <input id="txt_username" name="txt_username" value="" type="text" size="28" valid="not" />
            </td>
            <td width="15%" class="h_bg">Email:</td>
            <td  colspan="3" class="light_bg_2">
            <input id="txt_admin_email" name="txt_admin_email" value="" type="text" size="28" valid="not" />
            </td>
              </tr>
       <!-- </table>
        <table width="100%" cellpadding="0" cellspacing="1" border="0">-->
          <tr>
             <td  colspan="10" class="light_bg_2">
            <input id="btn_submit" name="btn_submit" type="submit" value="Search" class="frm_btn" title="Click to search information." />&nbsp;<input id="btn_clear" name="btn_clear" type="reset" value="Clear" class="frm_btn" title="Clear all values within the fields." />
            &nbsp;<input id="btn_srchall" name="btn_srchall" type="submit" class="frm_btn" value="Show all" title="Show all information." />
            </td>
          </tr>
        </table>
      </form>
      </td>
  </tr>
  <tr>
    <td>
  <div class="clear_10"></div>
   </td>
  </tr>
  <tr>
    <td>
    <table width="100%" cellpadding="0" cellspacing="1" border="0">
<?php if(count($pageDetails) > 0){?>    
        <tr>
        <th class="h_bg" width="5%">Sl No</th>
        <th class="h_bg" width="20%" title="Purchase Order No">Username</th>
        <th class="h_bg" width="20%" title="Purchase Order No">Email</th>
        <th class="h_bg" width="20%" title="Purchase Order No">Name</th>
        <th class="h_bg" width="20%">Action</th>
        </tr>
    <?php if (isset($pageDetails) && $pageDetails) : ?>
	<?php $i = 1; foreach ($pageDetails as $row): ?>
    <tr>
        <td align="center" valign="middle" class="light_bg"><?php echo $i?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["username"];?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["admin_email"];?></td> 	
        <td align="center" valign="middle" class="light_bg"><?php echo $row["admin_name"];?></td>
        <td align="center" valign="middle" class="light_bg">
            <div style="display:none">
                var aData = new Array();
                aData['id1'] 			= "<?php echo $row["id"]?>";
                aData['username'] 		= "<?php echo $row["username"]?>";
                aData['password'] 		= "<?php echo $row["password"]?>"; 
                aData['admin_email']    = "<?php echo $row["admin_email"]?>";
                aData['admin_name'] 	= "<?php echo $row["admin_name"]?>";                
            </div>
            <p class="action">
			<a href="Javascript:void(0)" title="Edit"><img class='edit' src="<?php echo $Ipath ?>edit.png" alt="" align="absmiddle" title="Edit" /></a>&nbsp; 
            <?php 
            if($logged_user['AdminsStatus'] == 'S' && $row["UserStatus"] == 'U') 
            {?>
             |&nbsp;
			<a href="Javascript:void(0)" class='delete nor8marg' title="Delete"><img src="<?php echo $Ipath ?>del.png" alt="" align="absmiddle" title="Delete" /></a>
             <?php }?>
			</p>
           
		</td>
    </tr>
    <?php $i++; endforeach;?>
<?php endif; ?>
	<tr>
        <td align="center" valign="middle" class="pagination" colspan="5">
		<?=$this->pagination->create_links()?>
		</td>
	</tr>
<?php }?>
<?php if(count($pageDetails) == 0){?>
        <tr><th colspan="8" align="center" class="light_bg" style="color:#FE340C;"> No Record Found</th>
    </tr>
    <?php }?>
  </table></td>
  </tr>
</table>
</div>
