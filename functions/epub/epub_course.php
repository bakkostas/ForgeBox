<?php
error_reporting(E_ALL | E_STRICT);
ini_set('error_reporting', E_ALL | E_STRICT);
ini_set('display_errors', 1);

include "../conf.php";	
$count_list=0;
if(isset($_GET['course_id']))
	{
		$query_select= "SELECT id,title,author,publisher,sdescription,content FROM tbl_courses WHERE tbl_courses.id = ".$_GET['course_id'];
		$result_select = $connection->query($query_select) or die("Error in query.." . mysqli_error($connection));
		
		
		while($row1 = $result_select->fetch_array()){
			$id_course=$row1[0];
			$title_course=$row1[1];
			$author = $row1[2];
			$publisher = $row1[3];
			$sdescription = $row1[4];
			$content = $row1[5];
		}
		
		$query_select_list = "SELECT id, presentation_id, interactive_id FROM tbl_match_present_interact_course WHERE course_id=".$_GET['course_id']." ORDER BY order_list ASC";
		
		$result_select_list = $connection->query($query_select_list)  or die("Error in query.." . mysqli_error($connection));
		if(strlen($content)>15)
		{
			$count_list=1;
		}
		else
		{
			$count_list=0;
		}
		
		while($row1 = $result_select_list->fetch_array()){
			$id[$count_list]=$row1[0];
			$presentation_id[$count_list]= $row1[1];
			$interactive_id[$count_list]= $row1[2];
			
			$count_list++;
		}
		
// Example.
// Create a test book for download.
// ePub uses XHTML 1.1, preferably strict.
$content_start =
"<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"
. "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\"\n"
. "    \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n"
. "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n"
. "<head>"
. "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n"
. "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\" />\n"
. "<title>".$title_course."</title>\n"
. "</head>\n"
. "<body>\n";

$bookEnd = "</body>\n</html>\n";

// setting timezone for time functions used for logging to work properly
date_default_timezone_set('Europe/Athens');

include_once("Logger.php");
$log = new Logger("Example", TRUE);

$fileDir = './PHPePub';

include_once("EPub.php");
$log->logLine("include EPub");

$book = new EPub(EPub::BOOK_VERSION_EPUB3, "en", EPub::DIRECTION_LEFT_TO_RIGHT); // Default is ePub 2
		$log->logLine("new EPub()");
		$log->logLine("EPub class version: " . EPub::VERSION);
		$log->logLine("EPub Req. Zip version: " . EPub::REQ_ZIP_VERSION);
		$log->logLine("Zip version: " . Zip::VERSION);
		$log->logLine("getCurrentServerURL: " . $book->getCurrentServerURL());
		$log->logLine("getCurrentPageURL..: " . $book->getCurrentPageURL());

// Title and Identifier are mandatory!
		$book->setTitle($title_course);
		$book->setIdentifier($InstallationSite, EPub::IDENTIFIER_URI); // Could also be the ISBN number, prefered for published books, or a UUID.
		$book->setLanguage("en"); // Not needed, but included for the example, Language is mandatory, but EPub defaults to "en". Use RFC3066 Language codes, such as "en", "da", "fr" etc.
		$book->setDescription($sdescription);
		$book->setAuthor($author, $author);
		$book->setPublisher($publisher, "http://forgebox.eu/"); // I hope this is a non existant address :)
		$book->setDate(time()); // Strictly not needed as the book date defaults to time().
		$book->setRights("Copyright and licence information specific for the book."); // As this is generated, this _could_ contain the name or licence information of the user who purchased the book, if needed. If this is used that way, the identifier must also be made unique for the book.
		$book->setSourceURL("http://forgebox.eu");

$book->addDublinCoreMetadata(DublinCore::CONTRIBUTOR, "PHP");

$book->setSubject($title_course);
$book->setSubject("keywords");
$book->setSubject("Chapter levels");

// Insert custom meta data to the book, in this cvase, Calibre series index information.
$book->addCustomMetadata("calibre:series", "PHPePub Test books");
$book->addCustomMetadata("calibre:series_index", "1");

$log->logLine("Set up parameters");

$cssData = "body {\n  margin-left: .5em;\n  margin-right: .5em;\n  text-align: justify;\nbackground-color:#F2F0F0;\n}\n\np {\n  font-family: Garamond;\n  font-size: 10pt;\n  text-align: justify;\n  text-indent: 1em;\n  margin-top: 0px;\n  margin-bottom: 1ex;\n}\n\nh1, h2 {\n  font-family: Garamond;\n  font-style: italic;\n  text-align: center;\n  width: 100%;\n}\n\nh1 {\n    margin-bottom: 2px;\n}\n\nh2 {\n    margin-top: -2px;\n    margin-bottom: 2px;\n}\n";


$log->logLine("Add css");
$book->addCSSFile("styles.css", "css1", $cssData);

// This test requires you have an image, change "demo/cover-image.jpg" to match your location.
$log->logLine("Add Cover Image");
$book->setCoverImage("Cover.jpg", file_get_contents("demo/cover-image.jpg"), "image/jpeg");
$book->addLargeFile("images/back-cover-image.jpg", "back-cover-image.jpg", "demo/back-cover-image.jpg", "image/jpeg");
// A better way is to let EPub handle the image itself, as it may need resizing. Most Ebooks are only about 600x800
//  pixels, adding megapix images is a waste of place and spends bandwidth. setCoverImage can resize the image.
//  When using this method, the given image path must be the absolute path from the servers Document root.

/* $book->setCoverImage("/absolute/path/to/demo/cover-image.jpg"); */

// setCoverImage can only be called once per book, but can be called at any point in the book creation.
$log->logLine("Set Cover Image");

$cover = $content_start . "<img src=\"images/Cover.jpg\"/>" . $bookEnd;
$book->addChapter("Notices", "Cover.html", $cover);


$cover1 = $content_start . "<h1> <br />".$title_course."</h1><br /><br /><br /><br /><h2>By: ".$author."</h2><br />" . $bookEnd;
$book->addChapter("Intro", "intro.html", $cover1);


$book->buildTOC(NULL, "toc", "Table of Contents", TRUE, TRUE);
//    function buildTOC($cssFileName = NULL, $tocCSSClass = "toc", $title = "Table of Contents", $addReferences = TRUE, $addToIndex = FALSE, $tocFileName = "TOC.xhtml") {
	$count_i=0;
		for($i=0; $i<$count_list;$i++)
		{
			$count_i++;
			
			if(strlen($content)>15 && $count_i==1)
			{
				$title_part[$count_i] = $title_course;
				$chapter[$count_i] = $content_start . html_entity_decode(htmlentities(str_replace("<br>","<br />",utf8_encode($content)))).'<br /><br /><br />'.$bookEnd;
				
			}
			else
			{			
				if($presentation_id[$i]>0 && $interactive_id[$i]==0)
				{
					//presentation
					$query_select_present= "SELECT title, content FROM tbl_courses WHERE id=".$presentation_id[$i];
					$result_select_present = $connection->query($query_select_present) or die("Error in query.." . mysqli_error($connection));
					
					while($row = $result_select_present->fetch_array()){
						$title_part[$count_i] = $row[0];
						$chapter[$count_i] = $content_start . '<h1>'.$row[0].'</h1><br />'.html_entity_decode(htmlentities(str_replace("<br>","<br />",utf8_encode($row[1])))).'<br /><br /><br />'.$bookEnd;
						
					}
				}
				else if($presentation_id[$i]==0 && $interactive_id[$i]>0)
				{
					//interactive
					$query_select_present= "SELECT title, interactive_url, content FROM tbl_courses WHERE id=".$interactive_id[$i];
					$result_select_present = $connection->query($query_select_present) or die("Error in query.." . mysqli_error($connection));
			
					while($row2 = $result_select_present->fetch_array()){
						$title_part[$count_i] = $row2[0];
						if(!empty($row2[2]))
						{
							$chapter[$count_i] = $content_start . '<h1>'.$row2[0].'</h1><iframe sandbox="allow-same-origin allow-forms allow-scripts" style="border-right: 1px dotted navy; border-style: dotted; border-color: navy; border-width: 1px;" height="450px" width="100%" scrolling="auto" src="'.html_entity_decode($row2[1]).'"></iframe><br /><br /><a href="'.html_entity_decode(htmlentities($row2[1])).'" target="_blank" style="font-size:20px;">'.html_entity_decode(htmlentities($row2[1])).'</a><br /><br />'.$bookEnd;
						}
						else
						{
							$chapter[$count_i] = $content_start . '<h1>'.$row2[0].'</h1><p>'.html_entity_decode(htmlentities($row2[2])).'</p><iframe sandbox="allow-same-origin allow-forms allow-scripts" style="border-right: 1px dotted navy; border-style: dotted; border-color: navy; border-width: 1px;" height="450px" width="100%" scrolling="auto" src="'.html_entity_decode($row2[1]).'"></iframe><br /><br /><a href="'.html_entity_decode(htmlentities($row2[1])).'" target="_blank" style="font-size:20px;">'.html_entity_decode(htmlentities($row2[1])).'</a><br /><br />'.$bookEnd;
						}
						
					}
				}
			}
		}
		
		

		$log->logLine("Build Chapters");
		if(strlen($content)>15)
		{
			
		$addchapter = "Add Chapter 1";
			$log->logLine($addchapter);
			//$Chapters='$chapter'.$count_i;
			$chapter_num_title = "Chapter 1:".$title_course;
			$chapter_html =  "Chapter001.html";
			$book->addChapter($chapter_num_title, $chapter_html, $chapter[1] , false, EPub::EXTERNAL_REF_ADD);
		$count_i=1;
		$count_list = $count_list-1;
		}
		else
		{
		$count_i=0;
		}

		//$count_i=0;
		for($i=0; $i<$count_list;$i++)
		{
			
			$count_i++;
			$addchapter = "Add Chapter ".$count_i;
			$log->logLine($addchapter);
			//$Chapters='$chapter'.$count_i;
			$chapter_num_title = "Chapter ".$count_i.":".$title_part[$count_i];
			$chapter_html =  "Chapter00".$count_i.".html";
			
			$book->addChapter($chapter_num_title, $chapter_html, $chapter[$count_i] , false, EPub::EXTERNAL_REF_ADD);			
			
		}
		
		$backcover = $content_start . "<img src=\"images/back-cover-image.jpg\"/>" . $bookEnd;
		$book->addChapter("LastPage", "last_page.html", $backcover);
/*
$book->addChapter("Log", "Log.html", $content_start . $log->getLog() . "\n</pre>" . $bookEnd);

if ($book->isLogging) { // Only used in case we need to debug EPub.php.
    $epuplog = $book->getLog();
    $book->addChapter("ePubLog", "ePubLog.html", $content_start . $epuplog . "\n</pre>" . $bookEnd);
}*/

$book->finalize(); // Finalize the book, and build the archive.

// This is not really a part of the EPub class, but IF you have errors and want to know about them,
//  they would have been written to the output buffer, preventing the book from being sent.
//  This behaviour is desired as the book will then most likely be corrupt.
//  However you might want to dump the output to a log, this example section can do that:
/*
if (ob_get_contents() !== false && ob_get_contents() != '') {
    $f = fopen ('./log.txt', 'a') or die("Unable to open log.txt.");
    fwrite($f, "\r\n" . date("D, d M Y H:i:s T") . ": Error in " . __FILE__ . ": \r\n");
    fwrite($f, ob_get_contents() . "\r\n");
    fclose($f);
}
*/

// Save book as a file relative to your script (for local ePub generation)
// Notice that the extions .epub will be added by the script.
// The second parameter is a directory name which is '.' by default. Don't use trailing slash!
$filename="../../attachments/epub_files/".$_GET['course_id']."/";
if (file_exists($filename)) {	
	$book->saveBook($id_course, $filename);
}
else
{
	 mkdir($filename, 0777, true);
	 $book->saveBook($id_course, $filename);
}

if (file_exists($filename.$id_course.".epub")) {	
	//insert in database....

	$count_scorm_epub=0;
	$query_select_record= "SELECT * FROM store_scorm_epub WHERE course_id = ".$_GET['course_id'];
	$result_select_record = $connection->query($query_select_record) or die("Error in query.." . mysqli_error($connection));
		
	while($row1 = $result_select_record->fetch_array()){
		$count_scorm_epub=1;
	}
		
	if($count_scorm_epub==1)
	{
		$query_edit = "UPDATE store_scorm_epub SET has_epub=1 WHERE course_id=".$_GET['course_id'];
		$result_edit = $connection->query($query_edit);
	}
	else
	{
		$query_edit = "INSERT INTO store_scorm_epub(course_id, has_scorm, has_epub) VALUES (".$_GET['course_id'].",0,1)";
		$result_edit = $connection->query($query_edit);
	}
	die(msg(1,"Succeed"));
}
//ob_end_clean();
// Send the book to the client. ".epub" will be appended if missing.


//$zipData = $book->sendBook($title_course);



// After this point your script should call exit. If anything is written to the output,
// it'll be appended to the end of the book, causing the epub file to become corrupt.
}

function msg($status,$txt)
{
	return '{"status":"'.$status.'","txt":"'.$txt.'"}';
}
	
	
	
	
	
?>