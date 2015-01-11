 <?php 
	include "header.php"; 
	
	accessRole("VIEW_ALL_COURSES",$connection) or die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=403error.html">');

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
					$table_data = "<table width=\"100%\" style=\"border: 1px solid #efefef;\"><tr style=\"font-size:16px; background-color:#f5f5f5;height:30px;\"><td class=\"sort\" width=\"30%\" data-sort=\"name\">Title</td><td class=\"sort\" width=\"20%\" data-sort=\"author\">Author/Owner</td><td width=\"25%\" class=\"sort\" data-sort=\"category\">Category</td><td class=\"sort\">Files</td><td class=\"sort\">Preview</td></tr>";
	
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
					$query_select_mycourse= "SELECT id, title, sdescription, author FROM tbl_courses WHERE course_item_id=1 AND active=1".$if_anonymous_query." GROUP BY title";	
					$result_select_mycourse = $connection->query($query_select_mycourse);
	
					while($row = $result_select_mycourse->fetch_array()){
		
						$query_select_categories= "SELECT tbl_category_courses.name FROM tbl_category_courses INNER JOIN tbl_match_course_category ON tbl_category_courses.id = tbl_match_course_category.course_category_id WHERE tbl_match_course_category.course_id=".$row[0];
						
						
						$result_select_categories = $connection->query($query_select_categories);
						$course_categories='';
						while($row_cat = $result_select_categories->fetch_array()){
			
							$course_categories .= $row_cat[0]."<br>";			
						}
		

						$table_data .="<tr style=\"height:30px;\"><td><a href=\"preview_course.php?course_id=".$row[0]."\" class=\"name\">".$row[1]."</a></td><td class=\"author\">".$row[3]."</td><td class=\"right category\">".$course_categories."</td>";
						
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
							
							
						$table_data .="<td class=\"right\">".$course_files."</td>";
						$table_data .="<td class=\"right\"><a href=\"preview_course.php?course_id=".$row[0]."\"><i class=\"glyphicon glyphicon-eye-open\"></i></a></td>";
		
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
