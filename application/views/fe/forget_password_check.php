<?php 
//include("common/header.php");
print_r($_POST);
	$new_password		=	$_POST['new_password'];
	$confirm_password	=	$_POST['confirm_password'];
	$id					=	$_POST['id'];
	if($new_password==$confirm_password)
	{
		
/*		$this->load->model('User_model');
		$i_ret_=$this->User_model->update_reset_password($confirm_password,$id);
        if($i_ret_>0)
		{
			echo "Update";
		}
		else
		{
			echo "Not Update";
		}
*/

		//update_password($_POST['id'],$_POST['new_password']);
/*		echo $update_password_sql="update booking_users set
		password='".md5($_POST['confirm_password'])."',
		requested_passowrd='0'
		where id='".$_POST['id']."'";
		mysql_query($update_password_sql);	*/
/*			if(mysql_query($update_password_sql))
			{
		// Email Shoot to User 	
			echo 'Your password is reset';
			}  
			else
			{
			echo 'Your password is not reset';
			}
*/			
/*$CI->db->query("UPDATE booking_users SET password = '".$confirm_password."', requested_passowrd = '0' WHERE id = '".$id."'");
echo $CI->db->affected_rows();*/
			
			
			
			
/*			
								    $i_ret_=0; 
								
									$s_qry="Update ".$this->tbl." Set ";
									
									$s_qry.="  password=? ";
									$s_qry.="  requested_passowrd=? ";
									$s_qry.=" Where id=? ";
									
								  $this->db->query($s_qry,array(
								  md5($confirm_password),
								  '0',
								  intval($i_id)
								 ));
									echo $this->db->last_query();
									
									$i_ret_=$this->db->affected_rows();     
									if($i_ret_>0)
									{
						
			echo 'Your password is reset';				
									}
									else
									{
									echo 'Your password is not reset';
									}
											
			
			*/
			
			
		
	}
	else
	{
		//echo "hello";
		$msg="new password confirm password does not match !";
	}


?>




<?php			
//include("common/footer.php");
?>
