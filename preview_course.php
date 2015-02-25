<?php 
	include "header.php"; 
	//include "functions/conf.php";
	
	if(isset($_GET['course_id']))
	{
	
		$query_select= "SELECT title, author, create_date, publisher, language, about, alignmentType, educationalFramework, targetName, targetDescription, targetURL, educationalUse, duration, typicalAgeRange, interactivityType, learningResourseType, licence, isBasedOnURL, educationalRole, audienceType, content, interactive_url, publish_to_anonymous FROM tbl_courses WHERE tbl_courses.id = ".$_GET['course_id'];//." AND course_item_id=1";
		
		$result_select = $connection->query($query_select);
		
		while($row1 = $result_select->fetch_array()){
			$title_course=$row1[0];
			$author=$row1[1];
			$create_date=$row1[2];
			$publisher=$row1[3];
			$language=$row1[4];
			$about=$row1[5];
			$alignmentType=$row1[6];
			$educationalFramework=$row1[7];
			$targetName=$row1[8];
			$targetDescription=$row1[9];
			$targetURL=$row1[10];
			$educationalUse=$row1[11];
			$$duration=$row1[12];
			$typicalAgeRange=$row1[13];
			$interactivityType=$row1[14];
			$learningResourseType=$row1[15];
			$licence=$row1[16];
			$isBasedOnURL=$row1[17];
			$educationalRole=$row1[18];
			$audienceType=$row1[19];
			$content=$row1[20];
			$interactive_url=$row1[21];
			$publish_to_anonymous = $row1[22];
		}
		
		if($publish_to_anonymous == 0 && $urole_id==7 )
		{
			?>
			<script>
				window.location.href = "index.php";
			</script>
			<?php
		}
		$query_select_list = "SELECT id, presentation_id, interactive_id FROM tbl_match_present_interact_course WHERE course_id=".$_GET['course_id']." ORDER BY order_list ASC";
		$result_select_list = $connection->query($query_select_list);
		$count_list=0;
		while($row1 = $result_select_list->fetch_array()){
			$id[$count_list]=$row1[0];
			$presentation_id[$count_list]= $row1[1];
			$interactive_id[$count_list]= $row1[2];
			
			$count_list++;
		}
	}
	
	?>
	
<div id="CourseContentRow" class="row"> <!--  ------------------------  START CONTENT      ------------------------      -->
	<div itemscope="" itemtype="http://schema.org/CreativeWork" > 
	 
		<div id="FORGETitleWindow" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1>
				<a href="index.php" id="return_back" style="text-decoration:none;">
					<span class="fa fa-arrow-circle-o-left fa-lg black"></span>
				</a>
				FORGE Course
			</h1>
			
		</div>
		
		
		<?php
		if($count_list>0)
		{
		?>
			<div id="CourseViewMenu"  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<a class="btn btn-private" href="preview_course.php?course_id=<?php echo $_GET['course_id']; ?>">Full Height</a>&nbsp;|&nbsp;
						<a class="btn btn-private" href="preview_course.php?course_id=<?php echo $_GET['course_id']; ?>&preview=twocol">Two columns</a>&nbsp;|&nbsp;
						<a class="btn btn-private" href="preview_course.php?course_id=<?php echo $_GET['course_id']; ?>&preview=section">Parts</a>&nbsp;|&nbsp;
						<a href="preview_course.php?course_id=<?php echo $_GET['course_id']; if(isset($_GET["preview"])){ if($_GET["preview"]=="twocol"){echo "&preview=twocol&noheaders=1";}if($_GET["preview"]=="section"){echo "&preview=section&noheaders=1";}}else{echo "&noheaders=1";}?>" onclick=""><i class="glyphicon glyphicon-fullscreen" ></i></a>
			</div>
		<?php	
		}
		?>
		
		<?php
		if(isset($_GET['preview']))
		{
			if($_GET['preview']=="twocol")
			{    
    
				echo '<div id="twocols" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height: 400px;">';
				if(isset($_GET["noheaders"]) && $_GET["noheaders"]==1)
				{
					?>
					<div class="row" style="float:right; font-size:20px; padding-right:15px;"><a href="preview_course.php?course_id=<?php echo $_GET['course_id']; if(isset($_GET['preview'])){ if($_GET['preview']=="twocol"){echo "&preview=twocol";}if($_GET['preview']=="section"){echo "&preview=section";}} ?>" onclick=""><i class="glyphicon glyphicon-resize-small"></i></a></div>
					<?php
				}
				echo '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-left: 0;padding-right: 0px; height: inherit;"  > ';
				echo "<div style=\"height:inherit; overflow:scroll;\">";
				
				printCoursePart($connection, $_GET['course_id'],"twocol", 0); //printModule Content in left part column
				
				for($i=0; $i<$count_list;$i++)
				{
					echo "<div itemprop=\"citation\">";
					if($presentation_id[$i]>0 && $interactive_id[$i]==0)
					{						
						printCoursePart($connection, $presentation_id[$i]);
					}
					echo "</div>";
				}
				echo "</div>";
				echo "</div>";
				//Now print right column with interaction parts
				echo '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-left: 0;padding-right: 0px;  height: inherit;" >';
				echo "<div style=\"height:inherit; overflow:scroll;\">";
				for($i=0; $i<$count_list;$i++)
				{
					echo "<div itemprop=\"citation\">";
					if($presentation_id[$i]==0 && $interactive_id[$i]>0)
					{
						//interactive
						printCoursePart($connection, $interactive_id[$i]);
					}
					echo "</div>";
				}
				echo "</div>";
				echo "</div>";
				echo "</div>";
					
				
			}
			else if($_GET['preview']=="section")
			{ 
				
				echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >';
				if(isset($_GET["noheaders"]) && $_GET["noheaders"]==1)
				{
					?>
					<div class="row" style="float:right; font-size:20px; padding-right:15px;"><a href="preview_course.php?course_id=<?php echo $_GET['course_id']; if(isset($_GET['preview'])){ if($_GET['preview']=="twocol"){echo "&preview=twocol";}if($_GET['preview']=="section"){echo "&preview=section";}} ?>" onclick=""><i class="glyphicon glyphicon-resize-small"></i></a></div>
					<?php
				}
				echo "<div class=\"tab-control\" data-role=\"tab-control\">";
				echo "<ul id=\"myTab\" class=\"nav nav-tabs\">";
				//$count_pres=0;
				//echo "<li class=\"active\"><a href=\"#_page_".$count_pres."\">Part - ".$count_pres."</a></li>";	
				$count_pres=1;
				for($i=0; $i<$count_list;$i++)
				{
					if($presentation_id[$i]>0 && $interactive_id[$i]==0)
					{
						//presentation
						$query_select_present= "SELECT title FROM tbl_courses WHERE id=".$presentation_id[$i];
						$result_select_present = $connection->query($query_select_present);
						
						while($row = $result_select_present->fetch_array()){
							if($count_pres==1)
							{
								echo '<li class="active"><a href="#_page_'.$count_pres.'" data-toggle="tab" >Part - '.$count_pres.'</a></li>';

							}
							else
							{
								echo '<li><a href="#_page_'.$count_pres.'" data-toggle="tab">Part - '.$count_pres.'</a></li>';
							}
							
						}
						
					}
					else if($presentation_id[$i]==0 && $interactive_id[$i]>0)
					{
						//interactive
						$query_select_present= "SELECT title FROM tbl_courses WHERE id=".$interactive_id[$i];
						$result_select_present = $connection->query($query_select_present);
										
						while($row2 = $result_select_present->fetch_array()){
							
							if($count_pres==1)
							{
								echo "<li class=\"active\"><a href=\"#_page_".$count_pres."\" data-toggle=\"tab\" >Part - ".$count_pres."9999</a></li>";	
							}
							else
							{
								echo "<li><a href=\"#_page_".$count_pres."\" data-toggle=\"tab\">Part - ".$count_pres."</a></li>";
							}
									
						}
					}

					$count_pres++;
				}
				echo "</ul>";
				
				echo "<div id=\"myTabContent\" class=\"tab-content\">";
				//$count_pres=0;
				//printCoursePart($connection, $_GET['course_id'] , "section", $count_pres);  //printModule Content in first tab
				$count_pres=1;
				for($i=0; $i<$count_list;$i++)
				{
					if($presentation_id[$i]>0 && $interactive_id[$i]==0)
					{
						printCoursePart($connection, $presentation_id[$i], "section", $count_pres);
						
						
					}
					else if($presentation_id[$i]==0 && $interactive_id[$i]>0)
					{
						printCoursePart($connection, $interactive_id[$i], "section", $count_pres);
					}
				
					$count_pres++;
				}
				
				echo "</div>";
				echo "</div>";
				echo "</div>";
				
			}
			
		}
		else
		{
			if(isset($_GET["noheaders"]) && $_GET["noheaders"]==1)
				{
					?>
					<div class="row" style="float:right; font-size:20px; padding-right:35px;"><a href="preview_course.php?course_id=<?php echo $_GET['course_id']; if(isset($_GET['preview'])){ if($_GET['preview']=="twocol"){echo "&preview=twocol";}if($_GET['preview']=="section"){echo "&preview=section";}} ?>" onclick=""><i class="glyphicon glyphicon-resize-small"></i></a></div>
					<?php
				}
			printCoursePart($connection, $_GET['course_id']);

			for($i=0; $i<$count_list;$i++)
			{
				echo "<span itemprop=\"citation\">";
				if($presentation_id[$i]>0 && $interactive_id[$i]==0)
				{
					printCoursePart($connection, $presentation_id[$i]);
				}
				else if($presentation_id[$i]==0 && $interactive_id[$i]>0)
				{					
					printCoursePart($connection, $interactive_id[$i]);
				}
				echo "</span>";
			}
		}
			
			
		
		?>
	</div> <!-- div   itemtype= http://schema.org/CreativeWork    -->
</div><!--  ------------------------  END CONTENT      ------------------------      -->
<div class="row">
<div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'forgeboxeu'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>
</div>

<?php include "footer.php"; ?>


<script>
$('#return_back').click(function(){
	parent.history.back();
	return false;
});

$('#myTab a[href="#_page_1"]').tab('show');

$('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
})

function reloadFullscreen(){
	
	window.location = document.URL + '&noheaders=1';
}
/*var reloadFullscreen = function (object){
	window.location = document.URL + '&noheaders=1';
}*/	

function showFullScreen() {
	$('#CourseViewMenu').hide();
	$('#FORGETitleWindow').hide();
	$('#FORGEBoxHeaderMenu').hide();
	$('#FORGEBoxHeaderMenuLogo').hide();
	$('#footer').hide();
	$('#disqus_thread').hide();
	$('#CourseContentRow').css({ left: 10, right:10, position:'absolute'});
}
/*
var showFullScreen = function (object){
	$('#CourseViewMenu').hide();
	$('#FORGETitleWindow').hide();
	$('#FORGEBoxHeaderMenu').hide();
	$('#FORGEBoxHeaderMenuLogo').hide();
	$('#footer').hide();
	$('#disqus_thread').hide();
	$('#CourseContentRow').css({ left: 10, right:10, position:'absolute'});
}*/
function twoSectionsDiv() {
		if ($('#footer').is(':visible') ){
			$('#twocols').height($(window).height() - $('#footer').height() - $('#twocols').offset().top-100 );
		}else{
		
			$('#twocols').height($(window).height()  - $('#twocols').offset().top );
		}
	}
/*
var twoSectionsDiv = function (object) {
		if ($('#footer').is(':visible') ){
			$('#twocols').height($(window).height() - $('#footer').height() - $('#twocols').offset().top-100 );
		}else{
		
			$('#twocols').height($(window).height()  - $('#twocols').offset().top );
		}
	}*/
$(window).ready(function () {


	<?php if(isset($_GET['noheaders']) && $_GET['noheaders']==1){ //trick to Hide header and all to show the course clear for embedded usage in other pages
	?>showFullScreen();
	<?php }
	else {
		return_screen();
	}
	//if....?>
	
	if ($('#twocols').length ){
		twoSectionsDiv($('#twocols'));		
	}	
});	

$(window).bind("resize", function () {
	if ($('#twocols').length){
		twoSectionsDiv($('#twocols'));
	}
});	
		
	 $('#lrmi_popup').popover({ html : true });
	
	$('body').on('click', function (e) {
    $('[data-toggle="popover"]').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});

function return_screen(){
	$('#CourseViewMenu').show();
	$('#FORGETitleWindow').show();
	$('#FORGEBoxHeaderMenu').show();
	$('#FORGEBoxHeaderMenuLogo').show();
	$('#footer').show();
	$('#disqus_thread').show();
	//$('#CourseContentRow').css({ left: 10, right:10, position:'absolute'});
	twoSectionsDiv();
}
</script>

<style>
.popover-content {
	font-size:11px;
}

</style>


<?php
function printTitleAndHintInfo($hintTitle, $coursetitle, $author, $publisher, $create_date, $lang, $about, $educAlignement, $eduFramework, $targetName, $targetDescription){
	$hintinfo = 'Author(s) : '.$author.
					' <br/> Publisher : '.$publisher.
					' <br/> Date created : '.date("d/m/Y",strtotime( $create_date )).
					' <br/> Language : '.$lang.
					' <br/> About : '.$about.
					' <br/> Educational Alignment : '.$educAlignement.
					' <br/> Educational Framework : '. $eduFramework.
					' <br/> Target Name : '.$targetName.
					' <br/> Target Description : '.$targetDescription;
					
	echo "<h2>".$coursetitle;
	/*echo '<a href="#" data-hint-mode="2" data-hint="'.$hintTitle.' | '.$hintinfo.'" data-hint-position="bottom"><small style="padding-left: 5px;"><i class="fa fa-info-circle"></i></small></a>';*/
	echo '<a href="#" id="lrmi_popup" class="btn" data-toggle="popover" rel="popover" data-content="'.$hintinfo.'" data-original-title="'.$hintTitle.'"><i class="fa fa-info-circle fa-2x"></i></a>';
	echo "</h2>";				

}




function printCoursePart( $connection, $course_id, $issectionparts, $partid ){
	
	$query_select_present= "SELECT title, content, author, create_date, publisher, language, about, alignmentType, educationalFramework, ".
	"targetName, targetDescription, targetURL, educationalUse, duration, typicalAgeRange, interactivityType, learningResourseType, licence, ".
	"isBasedOnURL, educationalRole, audienceType, interactive_url FROM tbl_courses WHERE id=".$course_id;
	
	$result_select_present = $connection->query($query_select_present);
	if($issectionparts=="section")
	{
		$bool_issectionparts=true;
	}
	else
	{
		$bool_issectionparts=false;
	}
	while($row = $result_select_present->fetch_array())
	{	
	
		if ($bool_issectionparts){
			if($partid==1){ 
				echo "<div class=\"tab-pane fade in active\" id=\"_page_".$partid."\">";
			}
			else
			{
				echo "<div class=\"tab-pane fade\" id=\"_page_".$partid."\">";
			}
			printTitleAndHintInfo('Course Presentation Part info',$row[0], $row[2], $row[4], $row[3], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10]);
		}else{			
			echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
			printTitleAndHintInfo('Course Presentation Part info',$row[0], $row[2], $row[4], $row[3], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10]);
			echo "</div><!-- end col-sm-12 div-->";
		}	
		
		printLRMIInfoBlock($row);
		
		echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
		echo html_entity_decode($row[1]);
		echo "</div><!-- end col-sm-12 div-->";
		
		if ($row[21]){
			echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
			echo "<iframe width=\"100%\" height=\"450px\" style=\"border-right: 1px dotted navy; border-style: dotted; border-color: navy; border-width: 1px;\"  src=\"".$row[21]."\"></iframe>";	
			echo "</div><!-- end col-sm-12 div-->";
		}
		
		if ($bool_issectionparts){
			echo "</div>";
		}
	}	
}


function printLRMIInfoBlock( $row ){
							
	?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div style="display:none;">
				<span itemprop="name"><?php echo $row[0]; ?> </span>
				<?php 
					if(substr_count($row[2], ',')>0) 
					{
						$author_arr = explode(',',$row[2]);						
						for($q=0;$q<count($author_arr);$q++)
						{
							echo "<span itemprop=\"author\">".$author_arr[$q]."</span>";
						}
					}
					else
					{
					?>
						<span itemprop="author"><?php echo $row[2]; ?> </span>
					<?php
					}
				?>
				
				<span itemprop="publisher"><?php echo $row[4]; ?> </span>
				<span itemprop="datecreated"><?php echo date("d/m/Y",strtotime($row[3])); ?> </span>
				<span itemprop="inLanguage"><?php echo $row[5]; ?></span><br>	
				<?php 
					if(substr_count($row[6], ',')>0) 
					{
						$author_arr = explode(',',$row[6]);						
						for($q=0;$q<count($author_arr);$q++)
						{
							echo "<span itemprop=\"about\">".$author_arr[$q]."</span>";
						}
					}
					else
					{
					?>
						<span itemprop="about"><?php echo $row[6]; ?> </span>
					<?php
					}
				?>
				<span itemprop="educationalAlignment" itemscope itemtype="http://schema.org/AlignmentObject">
					<span itemprop="alignmentType" ><?php echo $row[7]; ?></span>
					<span itemprop="educationalFramework" ><?php echo $row[8]; ?></span>
					<span itemprop="targetName"  ><?php echo $row[9]; ?></span>
					<span itemprop="targetDescription"  ><?php echo $row[10]; ?></span>
					<span itemprop="targetUrl" >
						<a href="<?php echo $row[11]; ?>" >
							<?php echo $row[11]; ?>
						</a>
					</span>
				</span>
				<span itemprop="educationalUse"><?php echo $row[12]; ?></span>
				<span itemprop="timeRequired" content="PT1H30M"><?php echo $row[13]; ?></span>
				<span itemprop="typicalAgeRange" ><?php echo $row[14]; ?></span>
				<span itemprop="interactivityType" ><?php echo $row[15]; ?></span>
				<span itemprop="learningResourceType" ><?php echo $row[16]; ?></span>
				<span itemprop="license" itemscope itemtype="http://schema.org/URL">
					<a href="http://creativecommons.org/licenses/by/3.0/" itemprop="url">
						http://creativecommons.org/licenses/by/3.0/
					</a>
				</span>
				<span itemprop="isBasedOnUrl" ><?php echo $row[18]; ?></span>
				<span itemprop="audience" itemscope itemtyp="http://schema.org/EducationalAudience">
					<span itemprop="educationalRole"><?php echo $row[19]; ?></span>
					<span itemprop="audienceType"><?php echo $row[20]; ?></span>
				</span>
			</div>
		</div>

	<?php
}

?>