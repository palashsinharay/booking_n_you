<?php
//$logged_user = $session->userdata('logged_user');
$logged_user = $session->userdata('logged_admin_user');
$alert = $session->flashdata('error');
$list_of_staticmenu_names=array('superadmin');
$list_of_admin_names=array('admin');
  
$headers = array();
$headers["width"]	="10%";
$headers["val"]	="Username";
?>
<!--Below Javascript use for every page on every purpose Like Add , Edit , Delete-->
<link  type="text/css" rel="stylesheet" media="screen" href="js/ui/prettyPhoto/prettyPhoto.css" />
<script language="javascript" type="text/javascript" src="js/ui/jquery.prettyPhoto.js"></script>
<script type="text/javascript" >
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
		$('#first_name').val(aData['first_name']);
		$('#email_address').val(aData['email_address']);
		$('#last_name').val(aData['last_name']);
		$('#password').val(aData['password']);
		$('#lang_id').val(aData['lang_id']);
		$('#address').val(aData['address']);
		$('#city').val(aData['city']);
		$('#zip_code').val(aData['zip_code']);
		$('#country_code').val(aData['country_code']);
		$('#ph_no').val(aData['ph_no']);

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
            window.location = '<?php echo base_url();?>admin/user/delete_user/'+aData['id1'];
        }


    });

    //Change Events Status------------------------------------------------------//
	$('.status').click(function(){
        eval($(this).closest('td').next('td').children('div:first').text());
        var answer = confirm("Do you really want to Change status " + aData['username'] + "?");
        if(answer){
            window.location = '<?php echo base_url();?>admin/user/change_status/'+aData['id1']+'/'+aData['is_active'];
        }


    });

		////////Popup Details Page///////
		$("[id^='disp_det_']").each(function(i){
		$(this).click(function(){
			var tmp=JSON.parse('<?php echo makeArrayJs($headers);?>');
			var pop_w=(tmp["popup_width"]?"width="+tmp["popup_width"]:"");
			var pop_h=(tmp["popup_height"]?"height="+tmp["popup_height"]:"");
			$.fn.prettyPhoto();
			$.prettyPhoto.open('<?php echo base_url();?>admin/user/show_detail/'+$(this).attr("value")+'/iframe'
							   +(pop_w!=""||pop_h!=""?"?"+pop_w+"&"+pop_h:"")
								,'Users');  
		});
		
	});

	////////end Popup Details Page///////  
	
	$("#btn_srchall").click(function(){
	$("#txt_username").val("");
	$("#txt_admin_name").val("");
    $("#frm_search_2").submit();
});


});


</script>
<div class="rightPanel">


<div style="display:none;" id="lblVoucher"><?=$url_id?></div>
  <table width="100%" border="0" cellspacing="2" cellpadding="0" style="display:none;" id="formContainer">
    <tr>
      <td align="left" valign="top" class="headingTxt">admins</td>
    </tr>
    <tr>
      <td align="left" valign="top" class="border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" class="frmContainer">
            <?php echo form_open_multipart(base_url().'admin/user',array("id"=>"user_form"));?>
                <input type="hidden" name="id1" id="id1" value="" />
                <input type="hidden" name="action" id="action" value="add" />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left" valign="top"><p class="mandatory_txt">All * fields are mandatory</p></td>
					</tr>
					<tr>
						<td align="left" valign="top"><table width="100%" border="0" cellspacing="8" cellpadding="0">

					<tr>
					    <td width="200" align="right" valign="top">Email<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="email_address" type="text" class="txtbox1" id="email_address" valid='alpanum' size="30" readonly="readonly" /></td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">First name<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="first_name" type="text" class="txtbox1" id="first_name" valid='alpanum' size="30" /></td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">Last name<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="last_name" type="text" class="txtbox1" id="last_name" valid='alpanum' size="30" /></td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">Language</td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top">
                        <select name="lang_id" id="lang_id">
                        <option value="">Select Language </option>	
						<?php  echo makeOptionLanguage('','')?>
						</select>
                        </td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">Address</td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="address" type="text" class="txtbox1" id="address" valid='not' size="30" /></td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">City</td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="city" type="text" class="txtbox1" id="city" valid='not' size="30" /></td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">Zip Code</td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="zip_code" type="text" class="txtbox1" id="zip_code" valid='not' size="30" /></td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">Country</td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top">
                         <select name="country_code" id="country_code">
                        <option value="">Select Country </option>	
						<?php  echo makeOptionCountry('','')?>
						</select>
                        </td>
					</tr>
                  <tr>
					    <td width="200" align="right" valign="top">Phone Number</td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="ph_no" type="text" class="txtbox1" id="ph_no" valid='not' size="30" /></td>
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
    <form id="frm_search_2" name="frm_search_2" method="post" action="<?php echo base_url().'admin/user';?>" >
  <input type="hidden" id="h_search" name="h_search" value="basic">
        <div id="div_err_2"><div class="tab_general"><a href="#">Search</a></div></div>        
        <table width="100%" cellpadding="0" cellspacing="2" border="0" class="light_bg_tbl">
          <tr>
             <td width="15%" class="h_bg">First Name:</td>
            <td  colspan="3" class="light_bg_2">
            <input id="txt_first_name" name="txt_first_name" value="" type="text" size="28" valid="not" />
            </td>
            <td width="15%" class="h_bg">Last Name:</td>
            <td  colspan="3" class="light_bg_2">
            <input id="txt_last_name" name="txt_last_name" value="" type="text" size="28" valid="not" />
            </td>
            <td width="15%" class="h_bg">Email:</td>
            <td  colspan="3" class="light_bg_2">
            <input id="txt_email_address" name="txt_email_address" value="" type="text" size="28" valid="not" />
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
        <th class="h_bg" width="15%" title="Purchase Order No">Username</th>
        <th class="h_bg" width="25%" title="Purchase Order No">Name</th>
        <th class="h_bg" width="15%" title="Purchase Order No">Email</th>
        <th class="h_bg" width="10%" title="Purchase Order No">Created On</th>
        <th class="h_bg" width="10%" title="Purchase Order No">Status</th>
        
        <th class="h_bg" width="10%">Action</th>
        </tr>
    <?php if (isset($pageDetails) && $pageDetails) : ?>
	<?php $i = 1; foreach ($pageDetails as $row): ?>
    <tr>
        <td align="center" valign="middle" class="light_bg"><?php echo $i?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["email_address"];?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["first_name"].' '.$row['last_name'];?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["login_email_address"];?></td> 
        <td align="center" valign="middle" class="light_bg"><?php echo $row["created_on"];?></td> 	
        <td align="center" valign="middle" class="light_bg"><?php echo $row["is_active"];?></td> 		
        <td align="center" valign="middle" class="light_bg">
            <div style="display:none">
                var aData = new Array();
                aData['id1'] 			= "<?php echo $row["id"]?>";
                aData['email_address'] 	= "<?php echo $row["email_address"]?>";
                aData['email_address'] 	= "<?php echo $row["email_address"]?>";
                aData['first_name'] 	= "<?php echo $row["first_name"]?>";
                aData['last_name'] 		= "<?php echo $row["last_name"]?>";
                aData['password'] 		= "<?php echo $row["password"]?>";
                aData['lang_id'] 		= "<?php echo $row["lang_id"]?>";
                aData['address'] 		= "<?php echo $row["address"]?>";
                aData['city'] 			= "<?php echo $row["city"]?>";
                aData['zip_code'] 		= "<?php echo $row["zip_code"]?>";
                aData['country_code'] 	= "<?php echo $row["country_code"]?>";
                aData['ph_no'] 			= "<?php echo $row["ph_no"]?>";
            </div>
            <p class="action">
            <a  id="disp_det_<?php echo $row["id"];?>" value="<?php echo $row["id"];?>" href="Javascript:void(0)" ><img src="<?php echo $Ipath ?>view.png" alt="View Details" align="absmiddle" title="View Details" /></a>&nbsp; 
			<a href="Javascript:void(0)" title="Edit"><img class='edit' src="<?php echo $Ipath ?>edit.png" alt="Edit" align="absmiddle" title="Edit" /></a>&nbsp; 
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
