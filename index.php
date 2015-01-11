<?php include 'header.php'; ?>



</div> <!-- trick to close the container for the next section  -->


<?php

if(!isset($_SESSION["UROLE_ID"]) OR ($_SESSION["UROLE_ID"]==7)) {
	include "login_header.php";
	echo "<script> $('#FORGEBoxHeaderMenu').hide(); </script><!-- HIDE THE MENU in INDEX When NOT LOGGED IN -->";
}

?>

<section id="headermain" >
	<div class="container">
		<div class="row"> <!--  ------------------------  START CONTENT      ------------------------      -->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1>&nbsp;</h1>
			<h1>Learn by experimenting on real hardware!</h1>
			<p>Interactive Courses with Real Infrastructures! Access, create and share interactive courses with widgets accessing real infrastructures and resources available from <a href="http://www.ict-fire.eu/">FIRE</a> testbeds across Europe! 
			</p>
			<h1>&nbsp;</h1>
			</div>
		</div><!--  ------------------------  END CONTENT      ------------------------      -->
	</div>
</section>



<section id="headerMainOpencourses" style="background-color: #E4E3D5; " >
	<div class="container" >
		<div class="row"  > 
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-top:50px;padding-bottom:50px">
			
			<h1 style="color:#636365" >Featured Open courses</h1>
			</div>	
		</div>	
		<div class="row"> 
			<?php printTeaserPublicCourses($connection); ?>
		</div>
		<div class="row" >  <!--  ------------------------  START CONTENT      ------------------------      -->			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: right;padding-top:50px;padding-bottom:50px">
			<h3><a style="color:#636365; text-decoration:none;" href="all_course.php">More Open Courses...</a></h3>
			</div>
		</div><!--  ------------------------  END CONTENT      ------------------------      -->
	
	</div>
</section>
<section id="headerMainSignUpcourses" style="background-color: #EFEFDF; " >
	<div class="container" >
		<div class="row"  > 
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-top:50px;padding-bottom:50px">
			
			<h1 style="color:#636365" >Featured courses for FORGEBox users</h1>
			</div>	
		</div>	
		<div class="row"> 
			<?php printTeaserSignUpCourses($connection); ?>
		</div>
		<div class="row" >  <!--  ------------------------  START CONTENT      ------------------------      -->			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: right;padding-top:50px;padding-bottom:50px">
			<?php if(!isset($_SESSION["UROLE_ID"])) {
					echo '<h3><a style="color:#636365" href="register.php">Open a FORGEBox account to see more courses</a></h3>';
				}else{
					echo '<h3><a style="color:#636365; text-decoration:none;" href="all_course.php">See all courses...</a></h3>';
				}
			?>
			</div>
		</div><!--  ------------------------  END CONTENT      ------------------------      -->
	
	</div>
</section>
			
<section id="headermain_whatisFIRE" >
        <div class="container">
                <div class="row"> <!--  ------------------------  START CONTENT      ------------------------      -->
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <h1>&nbsp;</h1>
                        <h1>What is FIRE?</h1>
			<h3>Future Internet Research and Experimentation = FIRE</h3>
			<p>There is an increasing demand from both academic and industrial communities to bridge 
			the gap between visionary research and large-scale experimentation, 
			through experimentally-driven advanced research consisting of iterative cycles of research, 
			design and experimentation of new networking and service architectures and paradigms addressing all 
			levels, including horizontal research on issues such as system complexity and security.
			See more at <a href="http://www.ict-fire.eu">http://www.ict-fire.eu</a>
</p>


                        <h1>&nbsp;</h1>
                        </div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<br>
			<iframe width="560" height="315" src="//www.youtube.com/embed/YlTSyn5iHCU" frameborder="0" allowfullscreen></iframe>
			</div>
                </div><!--  ------------------------  END CONTENT      ------------------------      -->
        </div>
</section>


<div class="container"> <!-- trick reopen container again so that can continue normally. Container div closes on footer anyway    -->


 <?php include "footer.php"; ?>
 
 <?php 
 
 
 //Shows only latest public Course Modules
 function printTeaserPublicCourses($connection){
	$query_select_courses= "SELECT * FROM tbl_courses WHERE publish_to_anonymous=1  AND course_item_id=1 AND active=1 order by modify_date DESC LIMIT 4";
	printCoursesTeaser($connection, $query_select_courses);
	
}

function printTeaserSignUpCourses($connection){
	$query_select_courses= "SELECT * FROM tbl_courses WHERE publish_to_anonymous=0  AND course_item_id=1 AND active=1 order by modify_date DESC LIMIT 4";
	printCoursesTeaser($connection, $query_select_courses);
	
 }
	
function printCoursesTeaser($connection, $query_select_courses){
	$result_select_course = $connection->query($query_select_courses)  or die("Error in query.." . mysqli_error($connection)); ;
	while($row = $result_select_course->fetch_array()){
		echo '<div class="col-sm-6 col-md-3" >';
		echo '<div  style="border: #cecece; background-color: white;border-width: 1px;border-style: solid;padding: 5px;/*text-align: center;*/;border-radius: 5px;box-shadow: 2px 2px 9px #888888;">';
		echo '<div  style="height:400px;">';
		echo '<div id="courseHeaderTitle" style="height:130px;margin-bottom:10px;border-bottom: 1px dotted rgb(222, 197, 197);">';
		echo '<table><tr>';
		echo '<td width="50px" style="vertical-align: top;"><img style="margin-top: 5px;" src="images/course_smallico.PNG"></td>';
		echo '<td style="vertical-align: top;"><a href="preview_course.php?course_id='  .$row['id'].  '"><h3 style="color:#525789; margin-top:7px; margin-left:2px; font-size:19px;">'.$row['title'].'</h3></a>';
		echo '<tr><td colspan="2"><p style="color:#0B0F39;margin-top:10px;" >by '.$row['publisher'].'</p></td></tr>';
		echo '</td>';
		echo '</tr></table>';
		echo '</div>';//headerTitle
		echo '<p style="color:#636365">'.$row['sdescription'].'</p>';
		echo '</div>';
		
		echo '<a style="bottom: 0; margin: 5px; border-style: solid; border-width: 1px;padding: 10px; background-color: #525789; text-decoration: none; text-align: center; color:white; right: 15px; position: absolute; left: 15px;" href="preview_course.php?course_id='  .$row['id'].  '">View course</a>';
		echo '</div>';
		echo '</div>';
	
	}
 }
 

 
 ?>
