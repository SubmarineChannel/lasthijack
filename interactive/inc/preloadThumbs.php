<?php
header('Content-Type: application/javascript');
?>
function preloadThumbs(){
	var myLoader = html5Preloader();

	myLoader.addFiles(
	<?php
	$i = 0;
	foreach(glob('../video/firstframes/*.*') as $filename){
		$comma = ($i!=0)?', ':'';
		echo $comma.'"'.str_replace("../", "", $filename).'"';
		$i++;
	}
	?>
	);
	
	myLoader.on('error', function(e){ console.error(e); });
	
	myLoader.on('finish', function(){
		console.log('thumbs loaded');
	});
}