 <?php include "header.php"; 

accessRole("INSTALL_COURSE_FROM_FORGESTORE",$connection) or die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=403error.html">');

$query_select_repository = "SELECT name, id FROM tbl_repository WHERE active=1";
$result_select_repository = $connection->query($query_select_repository);
$count_repository = 0;
while($row = $result_select_repository->fetch_array())
{			
	$repo_name[$count_repository]=$row[0];
	$repo_id[$count_repository]=$row[1];
	
	$count_repository++;
}

?>
<style>
.carousel-caption
{
	position:relative;
	top:0px;
	left:0px;
	background:#000000;
}

</style>
<div class="row"> <!--  ------------------------  START CONTENT      ------------------------      -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	

<h1>
		<a href="index.php" id="return_back"  style="text-decoration:none;">
			<span class="fa fa-arrow-circle-o-left fa-lg black"></span>
		</a>
		Install Courses From FORGEBox
	</h1>

			<div>
			    <div id="myCarousel" class="carousel slide">
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>
					<!-- Carousel items -->
					<div class="carousel-inner">
						<div class="active item">
							<img src="images/slide1.PNG" />
							<div class="carousel-caption">
								<h2>FORGE services</h2>
								<p class="bg-color-blueDark fg-color-white">A wide range of interactive widget to support your interactive course<br />
									<a href="category_item.php">Browse</a> our widget marketplace to view a list of possible solutions to include in your interactive course!
								</p>
							</div>
						</div>
						<div class="item">
							<img src="images/slide2.PNG" />
							<div class="carousel-caption">
								<h2 class="fg-color-darken">Create your own FORGE enabled Courses</h2>
								<p class="bg-color-blueDark fg-color-white">Create your interactive courses, publish them from FORGEBox to your LMS or your eBooks and
									share them online with other interested learners!</p>
							</div>							
						</div>
						<div class="item">
							<img src="images/slide3.PNG" />
							<div class="carousel-caption">
								<h2>Easy access of FIRE tools and infrastructures!</h2>
									<p class="bg-color-blueDark fg-color-white">Install services inside your FORGEBox to enable easy access to FIRE facilities. Resource
										configuration, scheduling and user management with a few clicks!</p>
							</div>
						</div>
					</div>
					<!-- Carousel nav -->
					<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div>
			</div>

		<br /><br />
	</div>
		<?php
		echo "<div class=\"col-md-4\">";
		echo "<div class=\"input-control select\">";
		echo "<select class=\"form-control\" name=\"select_repository\" id=\"select_repository\" >";
		for($i=0;$i<$count_repository;$i++)
		{
			echo "<option value=\"".$repo_id[$i]."\">".$repo_name[$i]."</option>";
		}
		echo "</select>";
		echo "</div>";
		echo "</div>";
	?>

	<script type="text/javascript">
		$('#return_back').click(function(){
			parent.history.back();
			return false;
		});
		
		$('.carousel').carousel()
		
	</script>
	
	
</div>
<?php include "footer.php"; ?>
