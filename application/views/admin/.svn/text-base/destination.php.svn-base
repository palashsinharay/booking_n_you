<?php
	 ini_set("memory_limit","256M");
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

    $('#addDestination').click(function(){

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

		$('#destination_id').val(aData['destination_id']+','+aData['city']);

		$('#country_code').val(aData['country_code']);

		$('#destimage').val(aData['destimage']);

		$('#h_destimage').val(aData['destimage']);

		$('#is_featured').val(aData['is_featured']);

		$('#is_topten').val(aData['is_topten']);

		

		if(aData['destimage'] == '') {

            var imgpath = '<?php echo $Ipath; ?>no-image.png';

        } else {

            var imgpath = '<?php echo $this->config->item('destination_image_thumb_small_path'); ?>'+aData['destimage'];

        }

		

		

		$('#destimage').children('input').hide();

		$('#destimage').children('div').html("<img src='"+imgpath+"' /> <br>Double click to change image.").fadeIn(5000);

		

        $('#action').val('update');



        $('#dataContainer').fadeOut(1000, function(){

           $('#formContainer').fadeIn(1000);

        });



    })



	$('#destimage').children('div').dblclick(function(){

		$(this).fadeOut(1000, function(){

			$(this).prev('input').show(1000);

		});

	});



    $('.delete').click(function(){

        eval($(this).closest('td').children('div:first').text());

        var answer = confirm("Do you really want to remove " + aData['city'] + "?");

        if(answer){

            window.location = '<?php echo base_url();?>admin/destination/destination_delete/'+aData['id1'];

        }





    });



    //Change Events Status------------------------------------------------------//

	$('.status').click(function(){

        eval($(this).closest('td').next('td').children('div:first').text());

        var answer = confirm("Do you really want to Change status " + aData['city'] + "?");

        if(answer){

            window.location = '<?php echo base_url();?>admin/destination/change_status/'+aData['id1']+'/'+aData['is_active'];

        }





    });



	/*var oFCKeditor = new FCKeditor('edetails');

	oFCKeditor.Height = "512";

	oFCKeditor.Width = "712";

    oFCKeditor.BasePath = "<?php echo $Rpath;?>fckeditor/";

    oFCKeditor.ReplaceTextarea();*/

	

	$("#btn_srchall").click(function(){

	$("#txt_destination_code").val("");

	$("#txt_destination_name").val("");

    $("#frm_search_2").submit();

});





});





</script>

<div class="rightPanel">



<?php 

if($logged_user['AdminsStatus'] == 'S') {?><div style="padding-bottom : 10px; text-align: right;"><button id="addDestination" class="frm_btn">Add Destination</button></div><?php }?>

<?php /*?><div style="display:none;" id="lblVoucher"><?=$url_id?></div><?php */?>

  <table width="100%" border="0" cellspacing="2" cellpadding="0" style="display:none;" id="formContainer">

    <tr>

      <td align="left" valign="top" class="headingTxt">destination</td>

    </tr>

    <tr>

      <td align="left" valign="top" class="border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td align="left" valign="top" class="frmContainer">

            <?php echo form_open_multipart(base_url().'admin/destination',array("id"=>"destination_form"));?>

                <input type="hidden" name="id1" id="id1" value="" />

                <input type="hidden" name="h_destimage" id="h_destimage" value="" />

                <input type="hidden" name="action" id="action" value="add" />

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

					<tr>

						<td align="left" valign="top"><p class="mandatory_txt">All * fields are mandatory</p></td>

					</tr>

					<tr>

						<td align="left" valign="top"><table width="100%" border="0" cellspacing="8" cellpadding="0">



					<tr>

					    <td width="200" align="right" valign="top">Destination<span class="red-star">*</span></td>

					    <td align="center" valign="top">:</td>

					    <td align="left" valign="top">

                        <select name="destination_id" id="destination_id" style="width:200px;">

                        <option value="">Select Destination </option>	

						<?php  echo makeOptionDestination('','')?>

						</select>

                        </td>

					</tr>

                    <tr>

					    <td width="200" align="right" valign="top">Destination Image<span class="red-star">*</span></td>

					    <td align="center" valign="top">:</td>

                         <td align="left" valign="top" id="destimage"><input type="file" name="destination_img" id="destination_img"  valid="not" />

                          <div style="display:none"></div></td>

					</tr>

                    <tr>

					    <td width="200" align="right" valign="top">Country<span class="red-star">*</span></td>

					    <td align="center" valign="top">:</td>

					    <td align="left" valign="top">

                         <select name="country_code" id="country_code" style="width:200px;">

                        <option value="">Select Country </option>	

						<?php  echo makeOptionCountry('','')?>

						</select>

                        </td>

					</tr>

                    <tr>

					    <td width="200" align="right" valign="top">Is Featured</td>

					    <td align="center" valign="top">:</td>

					    <td align="left" valign="top"><input type="checkbox" name="is_featured" id="is_featured" value="0" valid="not" />Yes</td>

					</tr>

                     <tr>

					    <td width="200" align="right" valign="top">Top Ten Rank</td>

					    <td align="center" valign="top">:</td>

					    <td align="left" valign="top">

                         <select name="is_topten" id="is_topten" style="width:200px;" valid="not">

						<?php

						$i=0;

                        while($i<11){

						?>

                         <option value="<?php echo $i;?>"><?php echo $i;?> </option>	

                        <?php

						$i++;

						}

						?>

                        </select>

                        

                        </td>

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

    <form id="frm_search_2" name="frm_search_2" method="post" action="<?php echo base_url().'admin/destination';?>" >

  <input type="hidden" id="h_search" name="h_search" value="basic">

        <div id="div_err_2"><div class="tab_general"><a href="#">Search</a></div></div>        

        <table width="100%" cellpadding="0" cellspacing="2" border="0" class="light_bg_tbl">

          <tr>

             <td width="15%" class="h_bg">Destination:</td>

            <td  colspan="3" class="light_bg_2">

            <input id="txt_destination_code" name="txt_destination_code" value="" type="text" size="28" valid="not" />

            </td>

            <td width="15%" class="h_bg">Country:</td>

            <td  colspan="3" class="light_bg_2">

            <select name="txt_country_code" id="txt_country_code" style="width:200px;" valid="not" >

            <option value="">Select Country </option>	

            <?php  echo makeOptionCountry('','')?>

            </select>

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

        <th class="h_bg" width="25%" title="Purchase Order No">Destination</th>

        <th class="h_bg" width="30%" title="Purchase Order No">Country</th>

        <th class="h_bg" width="20%" title="Purchase Order Date">Top Ten Rank</th>

        <th class="h_bg" width="30%">Action</th>

        </tr>

    <?php if (isset($pageDetails) && $pageDetails) : ?>

	<?php $i = 1; foreach ($pageDetails as $row): ?>

    <tr>

        <td align="center" valign="middle" class="light_bg"><?php echo $i?></td>

        <td align="center" valign="middle" class="light_bg"><?php echo $row["city"];?></td>

        <td align="center" valign="middle" class="light_bg"><?php echo $row["country_code"];?></td>

        <td align="center" valign="middle" class="light_bg"><?php echo $row["is_topten"];?></td>

        <td align="center" valign="middle" class="light_bg">

            <div style="display:none">

                var aData = new Array();

                aData['id1'] 			= "<?php echo $row["id"]?>";

                aData['destination_id'] = "<?php echo $row["destination_id"]?>";

                aData['city'] 			= "<?php echo $row["city"]?>";

                aData['country_code']   = "<?php echo $row["country_code"]?>";

                aData['destimage']		= "<?php echo $row["destination_img"]?>";

                aData['is_featured'] 	= "<?php echo $row["is_featured"]?>";

                aData['is_topten'] 		= "<?php echo $row["is_topten"]?>";                

            </div>

            

			<p class="action">

			<a href="Javascript:void(0)" title="Edit"><img class='edit' src="<?php echo $Ipath ?>edit.png" alt="" align="absmiddle" title="Edit" /></a>&nbsp;

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

