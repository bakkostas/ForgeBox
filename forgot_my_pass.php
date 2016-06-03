<?php
	include 'header.php'; 
	$lrs_object_name = "My Account";
?>

<?php
if(isset($_GET["actnum"]) && isset($_GET["mail"])){
	if(!empty($_GET["actnum"]) && !empty($_GET["mail"]))
	{
		$query_select_uid = "SELECT id FROM tbl_users WHERE email_user=".$_GET["mail"]." AND active_user=".$_GET["actnum"];
		$result_select_uid = $connection->query($query_select_uid);
		$uid =0;
		while($row = $result_select_uid->fetch_array())
		{
			$uid = $row[0];
		}
		
		if($uid>0){
			
			?>
			<div class="input-control text size3">
			<label for="newpass" >Put your New Password</label>
			<input type="password" class="form-control" placeholder="" value="" id ="newpass" name="newpass" />
			</div>
			</br>
			<br />
			<div class="input-control text size3">
				<label for="newpass2" >Confirm your New Password</label>
				<input type="password" class="form-control" placeholder="" value="" id ="newpass2" name="newpass2" />
			</div>
			</br>
			<p id="notificatio_msg"></p>
			<br />
			<input type="submit" id="resetpasssubmit" onclick="return false;" value="Change">
							
		<?php
		}
		else{
			echo "<div class=\"row\" style=\"color:#red;\">Wrong URL! Please contact with the administrator</div>";
		}
	}
	else{
		echo "<div class=\"row\" style=\"color:#red;\">Wrong URL! Please contact with the administrator</div>";
	}
}
else{
	
?>
	<div class="row" style="padding:30px;">
		<h3>Give your login email!</h3>
		<label for="email">E-mail</label>
		<input type="email" id="email" placeholder="" class="form-control" value="<?php echo $uemail; ?>" name="email" />
		<label for="email" class="error"></label>
	</div>															
	<div class="row">			
		<p id="notification_msg"></p>
		<input type="submit" id="btnsubmit" onclick="return false;" value="Submit">
	</div>		
<?php
}
?>
<script>

$('#btnsubmit').click(function(){
		$("#notification_msg").html("");
		
		var formData = $('#email').val();
			
			alert(formData);
			
			
		if($('#email').val() == ''){
			
			var formData = $('#email').val();
			
			alert(formData);
			
			$.ajax({
				type: "POST",
				url: "functions/forgot_my_pass.php",
				data: formData,
				success: function(msg){
					$("#notification_msg").html("");
					$("#notification_msg").append("<span style=\"color:green;\">"+msg.txt+"</span>");
				
				}						
			});
		}
		}else{			
			$("#notification_msg").html("");
			$("#notification_msg").append("<span style=\"color:red;\">Please fill a password!</span>");
			//$.Notify({caption:'Checkbox agreement',style: {background: 'red', color: 'white'},shadow: true,position: 'center',content: "You have to agree with .... in order to take effect changes!",timeout: 5000});						
			
		}
		
	});
	
	
	$('#resetpasssubmit').click(function(){
		
		var errNew=true;
			var errNew2=true;
			
				  if(newpass.length < 6) {
					  
					$("#notificatio_msg").html("");
					$("#notificatio_msg").append("<span style=\"color:red;\">Error: Password must contain at least six characters!</span>");
						
					$('#newpass').focus();
					errNew = true;
				  }
				
				  re = /[0-9]/;
				  if(!re.test(newpass)) {
					
					$("#notificatio_msg").html("");
					$("#notificatio_msg").append("<span style=\"color:red;\">Error: password must contain at least one number (0-9)!</span>");
					
					$('#newpass').focus();
					errNew = true;
				  }
				  re = /[a-z]/;
				  if(!re.test(newpass)) {

				  	$("#notificatio_msg").html("");
					$("#notificatio_msg").append("<span style=\"color:red;\">Error: password must contain at least one lowercase letter (a-z)!</span>");

					
					$('#newpass').focus();
					errNew = true;
				  }
				  re = /[A-Z]/;
				  if(!re.test(newpass)) {

				  $("#notificatio_msg").html("");
				  $("#notificatio_msg").append("<span style=\"color:red;\">Error: password must contain at least one uppercase letter (A-Z)!</span>");

					$('#newpass').focus();
					errNew = true;
				  }
				} else if (newpass != newpass2){
					
					$("#notificatio_msg").html("");
					$("#notificatio_msg").append("<span style=\"color:red;\">Error: New Password and confirmation New Password must match</span>");
				  
				
					$('#newpass').focus();
					$('#newpass2').focus();
					errNew = true;
					errNew2 = true;
				}else {
				
				 errNew = false;
				}
				
				


		if((!errNew)&&(!errNew2)){
			
			var formChPass = "newpass="+newpass+"&actnum=<?php echo $_GET["actnum"]; ?>&mail=<?php echo $_GET["mail"]; ?>";
					
			$.ajax({
				type: "POST",
				url: "functions/update_forgotten_pass,php",
				data: formChPass,
				dataType: "json",
				success: function(msg){				
						//	hideshow('loading',0);	
						
					var status = msg.status;
					console.log(msg);
					if(status == '0' ){		
						$("#notificatio_msg").html("");
						$("#notificatio_msg").append("<span style=\"color:red;\">"+msg.txt+"</span>");
						
					}else{				
						$("#notificatio_msg").html("");
						$("#notificatio_msg").append("<span style=\"color:red;\">"+msg.txt+"</span>");
					}
							
				}							
			});
					
					
					
					
		}
				
		
	});
</script>

<?php
	include 'footer.php';
?>