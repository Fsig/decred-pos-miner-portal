<?php
date_default_timezone_set('Australia/Brisbane');
header('Content-type: text/html; charset=UTF-8');
include_once("./includes/config.inc.php");
include_once("./includes/core.inc.php");
include_once("./api.php");

//Initialise the API
API::initialise();

//Javascript File array
$loadJsFiles = array();
$loadJs = "";
$page = "home";

//Page we are on
if(isset($_GET['page'])) $page = $_GET['page'];

//Page title
$page == "home" ? $page_title = WEBSITETITLE : $page_title = restore_title($page);
?>
<!DOCTYPE html>
<html lang="en-AU"> 
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes"/>
		
		<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" href="./content/css/styles.css"/>
		
		<title><?php echo $page_title; ?></title>
	</head>
	
	<body>
		<?php include("./components/navbar.php"); ?>
		
		<div class="content">			
			<?php 
				if(file_exists("./pages/" . $page . ".php")){
					include("./pages/" . $page . ".php"); 
				}else{
					include("./pages/404.php"); 
				}
			?>

		</div>
		
		<?php include("./components/footer.php"); ?>
		
		<script src="./content/scripts/vendor/modernizr.custom.2.8.3.js"></script>
		<script src="./content/scripts/vendor/jquery-2.1.4.min.js"></script>
		<script src='./content/scripts/scripts.js'></script>
		
		<!-- Load custom JS here -->
		<?php
		if(isset($loadJsFiles)){
			foreach(array_unique($loadJsFiles) as $jsFile){
				echo "<script type=\"text/JavaScript\" src=\"" . $jsFile . "\"></script>"; 
			}
		}
		
		if(isset($loadJs)) echo "<script type=\"text/JavaScript\">" . $loadJs . "</script>";
		?>
	</body>
	
</html>
