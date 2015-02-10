 <?php 
		 include "header.php"; 

		$query_course = "SELECT tbl_courses.id, tbl_courses.title, tbl_courses.author, tbl_courses.create_date, tbl_courses.sdescription FROM tbl_courses WHERE tbl_courses.active=1 AND tbl_courses.course_item_id=1 ORDER BY tbl_courses.create_date DESC LIMIT 10";		
		$result_course = $connection->query($query_course);
		
		$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
		$url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  
		$plit_url = explode('/',$_SERVER["REQUEST_URI"]);
		$url_host = $url;
		for($i=0;$i<count($plit_url)-1;$i++)
		{
			$url_host .= $plit_url[$i]."/";
		}
		//echo $url_host;
		
		$count_rec = 0;
		
		while($row = $result_course->fetch_row()) 
		{
			$id[$count_rec]=$row[0];
			$title[$count_rec]=$row[1];
			$author[$count_rec]=$row[2];
			$create_date[$count_rec]=$row[3];
			$sdescription[$count_rec]=$row[4];
			$count_rec++;
		}
 ?>
	
	<div class="container">
		<h1>See All Forgebox Course</h1>
		
			
			<?php 				
				for($i=0;$i<$count_rec;$i++) {
				?>
				<div class="row">
					<?php echo "<div style=\"padding-left:30px;\"><h3>".$title[$i]."</h3></center></div>"; ?>
					<div class="col-md-1">
						<img src="images/course_smallico.PNG"/>
					</div>
					<div class="col-md-8">						
						<?php echo "<p>".$sdescription[$i]."</p>"; ?>
					</div>
					<div class="col-md-3">
						<?php echo "<p><i class=\"fa fa-user\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Author\"></i>&nbsp;&nbsp;".$author[$i]."</p>"; ?><br />
						<?php echo "<p><i class=\"fa fa-calendar\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Created Date\"></i>&nbsp;&nbsp;".date('d-m-Y', strtotime($create_date[$i]))."</p>"; ?><br />
						<a href="http://localhost/forgebox/preview_course.php?course_id=<?php echo $id; ?>">See More</a>
					</div>
				</div>
				<hr />
				<?php
				}
			?>
		
	</div>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
</script>
<?php include "footer.php"; ?>
