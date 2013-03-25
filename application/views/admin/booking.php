<?php
//$logged_user = $session->userdata('logged_user');
$logged_user = $session->userdata('logged_admin_user');
$alert = $session->flashdata('error');
$list_of_staticmenu_names=array('superadmin');
$list_of_admin_names=array('admin');
  
$headers = array();
$headers["width"]	="10%";
$headers["val"]	="Booking";
?>
<!--Below Javascript use for every page on every purpose Like Add , Edit , Delete-->
<link  type="text/css" rel="stylesheet" media="screen" href="js/ui/prettyPhoto/prettyPhoto.css" />
<script language="javascript" type="text/javascript" src="js/ui/jquery.prettyPhoto.js"></script>
<script>
$(document).ready(function(){
    var fb = true;
    $('#addLanguage').click(function(){
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
		$('#hotelname').val(aData['hotelname']);
		$('#username').val(aData['username']);
		$('#itinerary_id').val(aData['itinerary_id']);
		$('#confirmation_number').val(aData['confirmation_number']);
		$('#booking_time').val(aData['booking_time']);
		$('#is_cancelled').val(aData['is_cancelled']);
		
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
        var answer = confirm("Do you really want to remove " + aData['itinerary_id'] + "?");
        if(answer){
            window.location = '<?php echo base_url();?>admin/booking/booking_delete/'+aData['id1'];
        }


    });

    //Change Events Status------------------------------------------------------//
	$('.status').click(function(){
        eval($(this).closest('td').next('td').children('div:first').text());
        var answer = confirm("Do you really want to Change status " + aData['itinerary_id'] + "?");
        if(answer){
            window.location = '<?php echo base_url();?>admin/booking/change_status/'+aData['id1']+'/'+aData['is_cancelled'];
        }


    });

	////////Popup Details Page///////
		$("[id^='disp_det_']").each(function(i){
		$(this).click(function(){
			var tmp=JSON.parse('<?php echo makeArrayJs($headers);?>');
			var pop_w=(tmp["popup_width"]?"width="+tmp["popup_width"]:"");
			var pop_h=(tmp["popup_height"]?"height="+tmp["popup_height"]:"");
			$.fn.prettyPhoto();
			$.prettyPhoto.open('<?php echo base_url();?>admin/booking/show_detail/'+$(this).attr("value")+'/iframe'
							   +(pop_w!=""||pop_h!=""?"?"+pop_w+"&"+pop_h:"")
								,'Booking');  
		});
		
	});
	
	$("#btn_srchall").click(function(){
	$("#txt_itinerary_id").val("");
	$("#txt_confirmation_number").val("");
    $("#frm_search_2").submit();
});


});


</script>
<div class="rightPanel">
<div style="display:none;" id="lblVoucher"><?=$url_id?></div>
  <table width="100%" border="0" cellspacing="2" cellpadding="0" style="display:none;" id="formContainer">
    <tr>
      <td align="left" valign="top" class="headingTxt">Booking</td>
    </tr>
    <tr>
      <td align="left" valign="top" class="border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" class="frmContainer">
            <?php echo form_open_multipart(base_url().'admin/booking',array("id"=>"booking_form"));?>
                <input type="hidden" name="id1" id="id1" value="" />
                <input type="hidden" name="action" id="action" value="add" />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left" valign="top"><p class="mandatory_txt">All * fields are mandatory</p></td>
					</tr>
					<tr>
						<td align="left" valign="top"><table width="100%" border="0" cellspacing="8" cellpadding="0">

					<tr>
					    <td width="200" align="right" valign="top">Booking Code<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="lng_id" type="text" class="txtbox1" id="lng_id" valid='alpanum' size="30" /></td>
					</tr>
                    <tr>
					    <td width="200" align="right" valign="top">Booking Name<span class="red-star">*</span></td>
					    <td align="center" valign="top">:</td>
					    <td align="left" valign="top"><input name="language" type="text" class="txtbox1" id="language" valid='alpanum' size="30" /></td>
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
    <form id="frm_search_2" name="frm_search_2" method="post" action="<?php echo base_url().'admin/booking';?>" >
  <input type="hidden" id="h_search" name="h_search" value="basic">
        <div id="div_err_2"><div class="tab_general"><a href="#">Search</a></div></div>        
        <table width="100%" cellpadding="0" cellspacing="2" border="0" class="light_bg_tbl">
          <tr>
             <td width="15%" class="h_bg">Itinerary Number:</td>
            <td  colspan="3" class="light_bg_2">
            <input id="txt_itinerary_id" name="txt_itinerary_id" value="" type="text" size="28" valid="not" />
            </td>
            <td width="20%" class="h_bg">Confirmation Number:</td>
            <td  colspan="3" class="light_bg_2">
            <input id="txt_confirmation_number" name="txt_confirmation_number" value="" type="text" size="28" valid="not" />
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
        <th class="h_bg" width="20%" title="Purchase Order No">Hotel Name</th>
        <th class="h_bg" width="15%" title="Purchase Order No">Username</th>
        <th class="h_bg" width="15%" title="Purchase Order No">Itinerary Id</th>
        <th class="h_bg" width="15%" title="Purchase Order No">Confirmation Number</th>
        <th class="h_bg" width="15%" title="Purchase Order Date">Booking date</th>
        <th class="h_bg" width="20%">Action</th>
        </tr>
    <?php if (isset($pageDetails) && $pageDetails) : ?>
	<?php $i = 1; foreach ($pageDetails as $row): ?>
    <tr>
        <td align="center" valign="middle" class="light_bg"><?php echo $i?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["hotelname"];?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["username"];?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["itinerary_id"];?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["confirmation_number"];?></td>
        <td align="center" valign="middle" class="light_bg"><?php echo $row["booking_time"];?></td>
        <td align="center" valign="middle" class="light_bg">
            <div style="display:none">
                var aData = new Array();
                aData['id1'] 					= "<?php echo $row["id"]?>";
                aData['hotelname'] 				= "<?php echo $row["hotelname"]?>";
                aData['username']   			= "<?php echo $row["username"]?>";
                aData['itinerary_id']   		= "<?php echo $row["itinerary_id"]?>";
                aData['confirmation_number']   	= "<?php echo $row["confirmation_number"]?>";
                aData['is_cancelled'] 			= "<?php echo $row["is_cancelled"]?>";  
                aData['booking_time'] 			= "<?php echo $row["booking_time"]?>";              
            </div>
            
			<p class="action">
			<a  id="disp_det_<?php echo $row["id"];?>" value="<?php echo $row["id"];?>" href="Javascript:void(0)" ><img src="<?php echo $Ipath ?>view.png" alt="View Details" align="absmiddle" title="View Details" /></a>&nbsp;
            <?php //if($logged_user->usertype == 'superadmin') 
            if($logged_user['AdminsStatus'] == 'S') 
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
