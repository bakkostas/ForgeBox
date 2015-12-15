 <?php 
	include "header.php"; 
	
	accessRole("VIEW_ALL_COURSES",$connection) or die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=403error.html">');
	$lrs_object_name = "All Course Module";
	
	//uid tou teacher
	/*$query_select_lrs= "SELECT lrs_name, endpoint_url, username, password FROM lrs_details WHERE uid=12";
			
	$result_select_lrs = $connection->query($query_select_lrs);
	
	while($row_lrs = $result_select_lrs->fetch_array()){
		$_lrs_name=$row_lrs[0];
		$_lrs_endpoint_url='http://'.$row_lrs[1];
		$_lrs_username=$row_lrs[2];
		$_lrs_password=$row_lrs[3];
		$_lrs_login_record=1;
	}

	$url_lrs_endpoint = '&endpoint='.rawurlencode($_lrs_endpoint_url).'&auth=Basic%20'.urlencode(base64_encode($_lrs_username.":".$_lrs_password)).'&actor='.str_replace('%27','&quot;',rawurlencode("{'mbox' : 'kostas.bakoulias@gmail.com', 'name' : 'Costas Bakoulias'}"));	*/
	
?>

<div class="row"> <!--  ------------------------  START CONTENT      ------------------------      -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<h1>
		<a href="index.php" id="return_back" style="text-decoration:none;">
			<span class="fa fa-arrow-circle-o-left fa-lg black"></span>
		</a>
		Available Course Modules in <?php echo $InstallationSite;?>
	</h1>
	</div>
	<style>
		.pagination li {
			display:inline-block;
			padding:5px;
		}
		
		.list tr:hover{
			background-color:#f7fafa;
		}
	</style>
	<div class="col-sm-12">	
		<div class="grid fluid">
		<?php
			if(accessRole("VIEW_ALL_COURSES",$connection))
			{
		?>
			<div id="test-list">
				<div class="row">
					<div class="col-sm-4 "><input type="text" class="form-control search" id="inputEmail2" placeholder="Search by Title,Author,Category" /></div>					
				</div>
				<br />
				<?php
				
					if(strpos($_SESSION['UROLE'],"Administrator")!== false){
						$table_owner = "<td class=\"sort\">Course Owner</td>";
					}else{
						$table_owner = "";
					}
					$table_data = "<table width=\"100%\" style=\"border: 1px solid #efefef;\"><tr style=\"font-size:16px; background-color:#f5f5f5;height:30px;\"><td class=\"sort\" width=\"30%\" data-sort=\"name\">Title</td><td class=\"sort\" width=\"20%\" data-sort=\"author\">Author/Owner</td>".$table_owner."<td width=\"10%\" class=\"sort\" data-sort=\"category\">Category</td><td class=\"sort\">Files</td><td class=\"sort\"><center>Preview</center></td></tr>";
	
					$table_data .= "<tbody class=\"list\">";
					
					//publish_to_anonymous
					if($_SESSION["UROLE_ID"]==7)
					{
						$if_anonymous_query = " AND publish_to_anonymous=1";
					}
					else
					{
						$if_anonymous_query="";
					}
					$query_select_mycourse= "SELECT tbl_courses.id, tbl_courses.title, tbl_courses.sdescription, tbl_courses.author, tbl_users.email_user FROM tbl_courses INNER JOIN tbl_users ON tbl_courses.create_uid = tbl_users.id_user WHERE course_item_id=1 AND active=1".$if_anonymous_query." GROUP BY title";	
					$result_select_mycourse = $connection->query($query_select_mycourse);
	
					while($row = $result_select_mycourse->fetch_array()){
		
						$query_select_categories= "SELECT tbl_category_courses.name FROM tbl_category_courses INNER JOIN tbl_match_course_category ON tbl_category_courses.id = tbl_match_course_category.course_category_id WHERE tbl_match_course_category.course_id=".$row[0];
						
						
						$result_select_categories = $connection->query($query_select_categories);
						$course_categories='';
						while($row_cat = $result_select_categories->fetch_array()){
			
							$course_categories .= $row_cat[0]."<br>";			
						}
		
						if(strpos($_SESSION['UROLE'],"Administrator")!== false){
							$table_owner_email = "<td class=\"email\">".$row[4]."</td>";
						}else{
							$table_owner_email = "";
							
						}
						$table_data .="<tr style=\"height:30px;\"><td><a href=\"preview_course.php?course_id=".$row[0].$url_lrs_endpoint."\" class=\"name\">".$row[1]."</a></td><td class=\"author\">".$row[3]."</td>".$table_owner_email."<td class=\"right category\">".$course_categories."</td>";
						
						$query_select_files= "SELECT has_scorm, has_epub FROM store_scorm_epub WHERE course_id=".$row[0];
			
							$result_select_files = $connection->query($query_select_files);
							$course_files='NA / NA';
							while($row_file = $result_select_files->fetch_array()){
								if($row_file[0]>0 && $row_file[1]>0)
								{
									$course_files = "<a href=\"attachments/scorm_files/".$row[0]."/".$row[0].".zip \">scorm</a> / <a href=\"attachments/epub_files/".$row[0]."/".$row[0].".epub \">epub</a>";
								}
								else if($row_file[0]>0 && $row_file[1]==0)
								{
									$course_files = "<a href=\"attachments/scorm_files/".$row[0]."/".$row[0].".zip \">scorm</a>&nbsp;/&nbsp;NA";
								}
								else if($row_file[0]==0 && $row_file[1]>0)
								{
									$course_files = "NA &nbsp; / &nbsp;<a href=\"attachments/epub_files/".$row[0]."/".$row[0].".epub \">epub</a>";
								}
								else{
									$course_files='NA / NA';
								}
								//$course_files .= $row_file[0]."<br>";
							}
							$base_encode_string = base64_encode('2c13ee2bba86fecdacbae3c27e9a32aad65b5dd3:ffed5458c4c52ce557c9e7a1335d5ca8003ba838');
							$url_add = '&endpoint=http%3A%2F%2Fwww.forgebox.eu%2Flrs%2Flearninglocker%2Fpublic%2Fdata%2FxAPI%2F&auth=Basic%20'.$base_encode_string.'&actor=%7B&quot;mbox&quot;%3A%5B&quot;mailto%3Atranoris%40ece.upatras.gr&quot;%5D%2C&quot;name&quot;%3A%5B&quot;'.$_SESSION['FNAME'].'&quot;%5D%7D';
							
							
						$table_data .="<td class=\"right\">".$course_files."</td>";
						//$table_data .='<td class="right"><a href="preview_course.php?course_id='.$row[0].'&endpoint=http%3A%2F%2F192.168.164.128%2Fdata%2FxAPI%2F&auth=Basic%20Yzg4ZTQ2YjUyYWMyMTRkMzQ4ZWIyNmE1YTQ0NTI0MzM0YzU5ZDliMjoxZTJiYjlmYjcxZDEyYmIwMWE5YjY3ZTRmOGY1OTZkZTU1NDI3NThk&actor=%7B&quot;mbox&quot;%3A%5B&quot;mailto%3Akostas.bakoulias%40gmail.com&quot;%5D%2C&quot;name&quot;%3A%5B&quot;'.$_SESSION['FNAME'].'&quot;%5D%7D" \"><i class="glyphicon glyphicon-eye-open"></i></a></td>';
						$table_data .='<td class="right"><center><a href="preview_course.php?course_id='.$row[0].'" \"><i class="glyphicon glyphicon-eye-open"></i></a></center></td>';
						$table_data .="</tr>";
		
					}
					$table_data .="</tbody></table>";
	
					echo $table_data;
				?>
			
				<ul class="pagination"></ul>
			</div>
			<?php
			}
		?>
		</div>
	</div>

	<script>
		$('#return_back').click(function(){
			parent.history.back();
			return false;
		});
		
		var monkeyList = new List('test-list', {
		  valueNames: ['name','category','author'],
		  page: 10,
		  plugins: [ ListPagination({}) ] 
		});
		
		
	</script>
</div><!--  ------------------------  END CONTENT      ------------------------      -->
 <?php include "footer.php"; ?>
