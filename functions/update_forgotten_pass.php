<?php

	
	include "conf.php";
	include "session.php";
	

	if(isset($_POST['email']))
	{
		if(!empty($_POST['email'])){
			
			$query_select_uid = "SELECT user_id FROM tbl_users WHERE email_user='".$_POST['mail']."' AND password_user='".$_POST['actnum']."'";
			$result_select_uid = $connection->query($query_select_uid);
			$uid =0;
			while($row = $result_select_uid->fetch_array())
			{
				$uid = $row[0];
			}
			
			if($uid>0){
				
				
				$query_update_uid = "UPDATE tbl_users SET password_user='".$_POST['newpass']."' WHERE id_user=".$uid;
				$result_update_uid = $connection->query($query_update_uid);

				
				die(msg(1,"You have change your password successfully!"));
				
				
			}else{
				die(msg(1,"The email doesn't exist! Please try again!"));
			}
			
		}

	}
	
	
	
	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}
	
?>