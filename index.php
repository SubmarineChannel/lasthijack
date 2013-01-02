<?php
	$itemArray = array();
	foreach (glob("items/*.php") as $filename){
		include $filename;
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>The Last Hijack</title>
  <script src="js/modernizr.js" type="text/javascript"></script>
	<script src="js/popcorn-complete.js" type="text/javascript"></script>
  <script type="text/javascript" src="//use.typekit.net/qgr6piw.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<link rel="stylesheet" href="css/demos.css" type="text/css" media="screen" />
	<script src="js/jquery.min.js" ></script>
	<script type="text/javascript" src="js/script.js.php"></script>
	<link rel="stylesheet" href="css/style.css.php" type="text/css" media="screen" />
</head>
<body>
<div id="container">
<video id="video" autoplay="autoplay">
	<source src="/video/LastHijack.mp4" type="video/mp4" />
  <source src="/video/LastHijack.ogv" type="video/ogg" />
</video>
<?php
foreach($itemArray as $key => $var){
	$id = isset($var['id'])?$var['id']:$key;
	$class = isset($var['class'])?$var['class']:"";
	if(isset($var['content']))echo '<div class="'.$class.'" id="'.$id.'"><div>'.$var['content'].'</div></div>';
	if(isset($var['extrahtml']))echo $var['extrahtml'];
}
?>
</div>
</body>
</html>
