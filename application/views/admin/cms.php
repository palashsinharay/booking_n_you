<?php
  //$logged_user = $session->userdata('logged_user');
   $logged_user = $session->userdata('logged_admin_user');
  $alert = $session->flashdata('error');
  //$logged_user = $logged_user['id'];
  $list_of_staticmenu_names=array('superadmin');
  $list_of_admin_names=array('admin');
?>
<!--Below Javascript use for every page on every purpose Like Add , Edit , Delete-->
<script>
$(document).ready(function(){
    var fb = true;
    /*$('#addPage').click(function(){
       fb = false;
       $('#cancelButton').click();
       $('#dataContainer').fadeOut(1000, function(){
           $('#formContainer').fadeIn(1000);
        });
        $('#action').val('add');
		$('#page_id').val('');
    });*/
	
	//----------Use for Cancel button ------------------------------------------------------//

    $('#cancelButton').click(function(){

        if(fb){
            $('#formContainer').fadeOut(1000, function(){
               $('#dataContainer').fadeIn(1000);
            });
        }
        fb = true;
        $('.txtbox1').css('border', '1px solid #b8bab8');
    });

//Edit and Show hide menu------------------------------------------------------//
    $('.edit').click(function(){
        eval($(this).closest('td').children('div:first').text());
        fb = false;
        $('#cancelButton').click();
        $('#page_id').val(aData['page_id']);
		$('#lang_id').val(aData['lang_id']);
        $('#PageName').val(aData['PageName']);
		$('#PageName').attr('readonly', true);
		$('#PageUrl').val(aData['PageUrl']);
        $('#PageUrl').attr('readonly', true);
		$('#PageTitle').val(aData['PageTitle']);
		$('#PageKeyword').val(aData['PageKeyword']);
		$('#PageMeta').val(aData['PageMeta']);
		$('#PagePublish').val(aData['PagePublish']);
        
		// Assigning the PageContent in fckeditor.
		var oEditor = FCKeditorAPI.GetInstance('PageContent') ;
		oEditor.SetHTML($(this).closest('td').children('div:last').html());



        $('#action').val('update');

        $('#dataContainer').fadeOut(1000, function(){
           $('#formContainer').fadeIn(1000);
        });

    })

	 $('.add').click(function(){
	   eval($(this).closest('td').children('div:first').text());
       fb = false;
		$('#cancelButton').click();
		$('#page_id').val(aData['page_id']);
		$('#PageName').val(aData['PageName']);
		$('#PageName').attr('readonly', true);
		$('#PageUrl').val(aData['PageUrl']);
		$('#PageUrl').attr('readonly', true);
		$('#PageTitle').val(aData['PageTitle']);
		$('#PageTitle').attr('readonly', true);
		$('#PageKeyword').val(aData['PageKeyword']);
		$('#PageKeyword').attr('readonly', true);
		$('#PageMeta').val(aData['PageMeta']);
		$('#PageMeta').attr('readonly', true);
		
		$('#action').val('add');
       	$('#dataContainer').fadeOut(1000, function(){
           $('#formContainer').fadeIn(1000);
        });
        
    });
//Delete Menu------------------------------------------------------//
    $('.delete').click(function(){
        eval($(this).closest('td').children('div:first').text());
        var answer = confirm("Do you really want to remove " + aData['PageName'] + "?");
        if(answer){
            window.location = '<?php echo base_url();?>admin/cms/cms_delete/'+aData['page_id'];
        }


    });

//Change CNS Status------------------------------------------------------//
	$('.status').click(function(){
        eval($(this).closest('td').next('td').children('div:first').text());
        var answer = confirm("Do you really want to Change status " + aData['PageName'] + "?");
        if(answer){
            window.location = '<?php echo base_url();?>admin/cms/cms_status/'+aData['page_id']+'/'+aData['PagePublish'];
        }


    });

      
	// FCK Editor Path--------------------------------------------------------
    var oFCKeditor = new FCKeditor('PageContent');
	oFCKeditor.Height = "512";
	oFCKeditor.Width = "712";
    oFCKeditor.BasePath = "<?php echo $Rpath;?>fckeditor/";
    oFCKeditor.ReplaceTextarea();
});
</script>
<div class="rightPanel">
<!--<div style="padding-bottom : 10px; text-align: right;"><button id="addPage" class="frm_btn">Add Page</button></div>-->
</div>

  <table width="100%" border="0" cellspacing="2" cellpadding="0" style="display:none;" id="formContainer">
    <tr>
      <td align="left" valign="top" class="headingTxt">Content Management</td>
    </tr>
    <tr>
      <td align="left" valign="top" class="border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" class="frmContainer">
            <?php echo form_open_multipart(base_url().'admin/cms',array("id"=>"cms_form"));?>
                <input type="hidden" name="page_id" id="page_id" value="" />
                <input type="hidden" name="action" id="action" value="add" />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left" valign="top"><p class="mandatory_txt">All * fields are mandatory</p></td>
					</tr>
					<tr>
						<td align="left" valign="top"><table width="100%" border="0" cellspacing="8" cellpadding="0">

					
                    <tr>
					    <td width="120" align="right" valign="top">Page Name <span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="PageName" type="text" class="txtbox1" id="PageName" valid='alfa' size="30" /></td>
					</tr>
					<tr>
					    <td width="200" align="right" valign="top">Language <span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top">
                        <select name="lang_id" id="lang_id" style="width:200px;">
                        <option value="">Select Language </option>	
						<?php  echo makeOptionLanguage('','')?>
						</select>
                        </td>
					</tr>
					<tr class="yes_box">
					    <td align="right" valign="top">Page Link <span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="PageUrl" type="text"  class="txtbox1" id="PageUrl" size="30" valid="not"/>&nbsp;&nbsp;<font size="-5">(Ex. about_us,how_it_works,privacy)</font></td>
					</tr>
					<tr class="no_box">
					    <td align="right" valign="top">Page Content</td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><textarea class="editor" name="PageContent" id="PageContent"></textarea></td>
					</tr>
					
					
					<tr  class="no_box">
					    <td align="right" valign="top">Page Title</td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="PageTitle" type="text"  class="txtbox1" id="PageTitle" valid="not" size="30"/></td>
					</tr>
					<tr  class="no_box">
					    <td align="right" valign="top">Meta Keywords</td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><textarea name="PageKeyword" id="PageKeyword" valid="not" class="txtarea-width"></textarea></td>
					</tr>
                    <tr class="no_box">
					    <td align="right" valign="top">Meta Description</td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><textarea name="PageMeta" id="PageMeta" valid="not" class="txtarea-width"></textarea></td>
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
    <?php if(count($pageDetails) > 0){?>
  <tr>
        <th class="h_bg">Sl No</th>
        <th class="h_bg">Page Name</th>
		<th class="h_bg">Language</th>
        <th width="15%" class="h_bg">Create Date</th>
	  <th class="h_bg">Action</th>
    </tr>
    <?php if (isset($pageDetails) && $pageDetails) : ?>
<?php $i = 1; foreach ($pageDetails as $row): ?>
    <tr>
        <td align="center" valign="middle" class="light_bg"><?=$i?></td>
		<td align="center" valign="middle" class="light_bg"><?php echo $row->PageName ?></td>
		<td align="center" valign="middle" class="light_bg"><?php echo $row->lang_id; ?></td>
		<td align="center" valign="middle" class="light_bg"><?php echo $newDate = date("d-m-Y", strtotime($row->PageDate)); ?></td>
		<td align="center" valign="middle" class="light_bg">
            <div style="display:none">
                var aData = new Array();
                aData['page_id'] = "<?php echo $row->id ?>";
                aData['lang_id'] = "<?php echo $row->lang_id ?>";
                aData['PageName'] = "<?php echo $row->PageName ?>";
                aData['PageUrl'] = "<?php echo $row->PageUrl ?>";
                aData['PageTitle'] = "<?php echo $row->PageTitle ?>";
                aData['PageKeyword'] = "<?php echo $row->PageKeyword ?>";
                aData['PageMeta'] = "<?php echo $row->PageMeta ?>";
                aData['PagePublish'] = "<?php echo $row->PagePublish 	?>";
            </div>
            <div style="display:none;">
            	<?php echo $row->PageContent ?>
            </div>
			<p class="action">
			<a href="Javascript:void(0)" title="Edit"><img class='edit' src="<?php echo $Ipath ?>edit.png" alt="Edit" align="absmiddle" /></a>&nbsp; 
            <?php
            if($row->lang_id == 'en_GB'){
			?>
             |  
            <a href="Javascript:void(0)" title="Add"><img class='add' src="<?php echo $Ipath ?>add.png" alt="" align="absmiddle" title="Page Tranlation" /></a>&nbsp; 
            <?php
			}
			?>
            <!-- |
			&nbsp;<a href="Javascript:void(0)" class='delete' title="Delete nor8marg"><img src="<?php echo $Ipath ?>del.png" alt="Delete" align="absmiddle" /></a>-->
			</p>
		</td>
    </tr>
<?php $i++; endforeach;?>
<?php endif; ?>
<?php }?>
<?php if(count($pageDetails) == 0){?>
        <tr><th colspan="8" align="center" valign="middle" class="light_bg" style="color:#FE340C;"> No Page Found </th>
    </tr>
    <?php }?>
  </table>
</div>
