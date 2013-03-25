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
    $('#addWord').click(function(){
       fb = false;
       $('#cancelButton').click();
       $('#dataContainer').fadeOut(1000, function(){
           $('#formContainer').fadeIn(1000);
        });
        $('#id').val('');
        $('#action').val('add');
        $('#password').val('');
		$('#word_md5').hide();
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
	
	$('#cancelButton1').click(function(){

        if(fb){
            $('#formContainer2').fadeOut(1000, function(){
               $('#dataContainer').fadeIn(1000);
            });
        }
        fb = true;

        $('.txtbox2').css('border', '1px solid #b8bab8');
    });

    $('.edit').click(function(){
		$('#word_md5').show();
        eval($(this).closest('td').children('div:first').text());
        fb = false;
        $('#cancelButton').click();
        $('#id1').val(aData['id1']);
		$('#word').val(aData['word']);
		$('#word_md5').val(aData['word_md5']);
		$('#is_active').val(aData['is_active']);
		
        $('#action').val('update');

        $('#dataContainer').fadeOut(1000, function(){
           $('#formContainer').fadeIn(1000);
        });

    });
	$('.add').click(function(){
		 eval($(this).closest('td').children('div:first').text());
		fb = false;
		$('#cancelButton1').click();
		$('#id2').val(aData['id1']);
		$('#word1').val(aData['word']);
		$('#is_active1').val(aData['is_active']);
		
		
		$('#action').val('addWordTranslate');
		//alert($('#word1').val(aData['word']));
		$('#dataContainer').fadeOut(1000, function(){
           $('#formContainer2').fadeIn(1000);
        });
	});

    $('.delete').click(function(){
        eval($(this).closest('td').children('div:first').text());
        var answer = confirm("Do you really want to remove " + aData['word'] + "?");
        if(answer){
            window.location = '<?php echo base_url();?>admin/words/word_delete/'+aData['id1'];
        }


    });

    //Change Events Status------------------------------------------------------//
	$('.status').click(function(){
        eval($(this).closest('td').next('td').children('div:first').text());
        var answer = confirm("Do you really want to Change status " + aData['word'] + "?");
        if(answer){
            window.location = '<?php echo base_url();?>admin/words/change_status/'+aData['id1']+'/'+aData['is_active'];
        }


    });

	/*var oFCKeditor = new FCKeditor('edetails');
	oFCKeditor.Height = "512";
	oFCKeditor.Width = "712";
    oFCKeditor.BasePath = "<?php echo $Rpath;?>fckeditor/";
    oFCKeditor.ReplaceTextarea();*/
	
	$("#btn_srchall").click(function(){
	$("#txt_word").val("");
    $("#frm_search_2").submit();
});


});


</script>
<div class="rightPanel">

<?php 
/*if($logged_user['AdminsStatus'] == 'S') {?><div style="padding-bottom : 10px; text-align: right;"><button id="addWord" class="frm_btn">Add Word</button></div><?php }*/?>
<div style="display:none;" id="lblVoucher"><?=$url_id?></div>
  <table width="100%" border="0" cellspacing="2" cellpadding="0" style="display:none;" id="formContainer">
    <tr>
      <td align="left" valign="top" class="headingTxt">word</td>
    </tr>
    <tr>
      <td align="left" valign="top" class="border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" class="frmContainer">
            <?php echo form_open_multipart(base_url().'admin/words',array("id"=>"words_form"));?>
                <input type="hidden" name="id1" id="id1" value="" />
                <input type="hidden" name="action" id="action" value="add" />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left" valign="top"><p class="mandatory_txt">All * fields are mandatory</p></td>
					</tr>
					<tr>
						<td align="left" valign="top"><table width="100%" border="0" cellspacing="8" cellpadding="0">

					<tr>
					    <td width="200" align="right" valign="top">Word<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="word" type="text" class="txtbox1" id="word" valid='alpanum' size="50" /></td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">Word (md5)</td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="word_md5" type="text" class="txtbox1" id="word_md5" valid='not' size="50" readonly="readonly" /></td>
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
  <table width="100%" border="0" cellspacing="2" cellpadding="0" style="display:none;" id="formContainer2">
    <tr>
      <td align="left" valign="top" class="headingTxt">word</td>
    </tr>
    <tr>
      <td align="left" valign="top" class="border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" class="frmContainer2">
            <?php echo form_open_multipart(base_url().'admin/words',array("id"=>"words_form"));?>
                <input type="hidden" name="id2" id="id2" value="" />
                <input type="hidden" name="action" id="action" value="addWordTranslate" />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left" valign="top"><p class="mandatory_txt">All * fields are mandatory</p></td>
					</tr>
					<tr>
						<td align="left" valign="top"><table width="100%" border="0" cellspacing="8" cellpadding="0">

					<tr>
					    <td width="200" align="right" valign="top">Word<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="word1" type="text" class="txtbox2" id="word1" valid='alpanum' size="50" readonly="readonly" /></td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">Language<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><select name="lang_id" id="lang_id">
                        <?php echo makeOptionLanguage('','');?>
                        </select></td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">Translated Word<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="trans_word" type="text" class="txtbox2" id="trans_word" valid='alpanum' size="50" /></td>
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
					                <td align="left" valign="top"><input type="reset" value="Cancel" class="frm_btn" id="cancelButton1" /></td>
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
    <form id="frm_search_2" name="frm_search_2" method="post" action="<?php echo base_url().'admin/words';?>" >
  <input type="hidden" id="h_search" name="h_search" value="basic">
        <div id="div_err_2"><div class="tab_general"><a href="#">Search</a></div></div>        
        <table width="100%" cellpadding="0" cellspacing="2" border="0" class="light_bg_tbl">
          <tr>
             <td width="10%" class="h_bg">Word:</td>
            <td  colspan="3" class="light_bg_2">
            <input id="txt_word" name="txt_word" value="" type="text" size="28" valid="not" />
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
        <th class="h_bg" width="25%" title="Purchase Order No">Words</th>
        <th class="h_bg" width="30%" title="Purchase Order No">Words (md5)</th>
        <th class="h_bg" width="30%" title="Purchase Order Date">Status</th>
        <th class="h_bg" width="30%">Action</th>
        </tr>
    <?php if (isset($pageDetails) && $pageDetails) : ?>
	<?php $i = 1; foreach ($pageDetails as $row): ?>
    <tr>
        <td align="center" valign="middle" class="light_bg"><?php echo $i?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["word"];?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["word_md5"];?></td>
        <td align="center" valign="middle" class="light_bg">
		<?php if($row["is_active"] == '0'){ ?>
			<a href="Javascript:void(0)" title="Status Published. Click to Unpublish" class="status"><img src="<?php echo $Ipath ?>status_icon_1.png" alt="Status Published. Click to Unpublish" align="absmiddle" title="Status Published. Click to Unpublish" /></a>
			<? } else { ?>
			<a href="Javascript:void(0)" title="Status Unpublish. Click to Published"  class="status"><img src="<?php echo $Ipath ?>status_icon_0.png" alt="Status Unpublish. Click to Published" align="absmiddle" title="Status Unpublish. Click to Publish" /></a>
			<?php } ?>
		</td>
        <td align="center" valign="middle" class="light_bg">
            <div style="display:none">
                var aData = new Array();
                aData['id1'] 		= "<?php echo $row["id"]?>";
                aData['word'] 	= "<?php echo $row["word"]?>";
                aData['word_md5']   = "<?php echo $row["word_md5"]?>";
                aData['is_active'] 	= "<?php echo $row["is_active"]?>";                
            </div>
            
			
            <p class="action">
			<!--<a href="Javascript:void(0)" title="Edit"><img class='edit' src="<?php echo $Ipath ?>edit.png" alt="" align="absmiddle" title="Edit" /></a>&nbsp; |  -->
            <a href="Javascript:void(0)" title="Add"><img class='add' src="<?php echo $Ipath ?>add.png" alt="" align="absmiddle" title="Translate Word" /></a>&nbsp;  
            <?php //if($logged_user->usertype == 'superadmin') 
           /* if($logged_user['AdminsStatus'] == 'S') 
            {?>
            |&nbsp;
			<a href="Javascript:void(0)" class='delete nor8marg' title="Delete"><img src="<?php echo $Ipath ?>del.png" alt="" align="absmiddle" title="Delete" /></a>
            <?php }*/?>
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
