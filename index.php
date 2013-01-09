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
	<script type="text/javascript" src="http://assets.cn.omroep.nl/javascripts/npo-explore.js"></script> 
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
<div id="npo_button_wrapper">
	<div id="npo_button_container" class="npo_button_dod">
		<a href="http://www.omroep.nl/">Ontdek Omroep.nl</a>
	</div>
</div>
<br clear="all" />
<!-- Begin Sitestat code CMC v.1.0.1 -->
<script type="text/javascript">
// <![CDATA[
function sitestat(u){var d=document,l=d.location;ns_pixelUrl=u+"&ns__t="+(new
Date().getTime());u=ns_pixelUrl+"&ns_c="+((d.characterSet)?d.characterSet:d.defaultCharset)
+"&ns_ti="+escape(d.title)+"&ns_jspageurl="+escape(l&&l.href?l.href:d.URL)+"&ns_referrer="+
escape(d.referrer);(d.images)?new Image().src=u:d.write('<'+'p><img src="'+u+'" height="1" width="1" alt="*"><'+'/p>');};
sitestat("//nl.sitestat.com/klo/ikon/s?ikon.thelasthijack.homepage&amp;category=thelasthijack&amp;ns_webdir=thelasthijack&amp;po_source=fixed");
// ]]>
</script>
<noscript><p><img
src="//nl.sitestat.com/klo/ikon/s? ikon.thelasthijack.homepage&amp;category=thelasthijack&amp;ns_webdir=thelasthijack&amp;po_source=fixed"
height="1" width="1" alt="*"></p></noscript>
<!-- End Sitestat code CMC -->

</body>
</html>
