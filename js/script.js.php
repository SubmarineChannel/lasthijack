<?php
Header("content-type: application/x-javascript");

$itemArray = array();
foreach (glob("../items/*.php") as $filename){
	include $filename;
}
?>

var videoWidth, videoHeight;
Popcorn( function(){
	var popcorn = Popcorn.smart("#video");
	<?php
	foreach($itemArray as $key => $var){
		if(isset($var['popcorn'])){
			echo $var['popcorn'];
		}
	}
	?>
	popcorn.code({
		start: 0.1,
		end:1,
		onStart: function( options ) {
		  setVideoPosition();
		}
	});
	popcorn.on( "timeupdate", function() {
		//do something
		<?php 
		foreach($itemArray as $key => $var){
			if(isset($var['ontimeupdate']))echo $var['ontimeupdate'];
		}
		?>
	});
	<?php 
	foreach($itemArray as $key => $var){
		if(isset($var['javascript']))echo $var['javascript'];
	}
	?>
});

function positionItems(){
<?php 
	foreach($itemArray as $key => $var){
		if(isset($var['RelativePosLeft']))echo '$("#'.$key.'").css("margin-left", ('.$var['RelativePosLeft'].'-50)*(videoWidth/100));';
		if(isset($var['RelativePosTop']))echo '$("#'.$key.'").css("margin-top", ('.$var['RelativePosTop'].'-50)*(videoHeight/100));';
	}
?>
}

function setVideoPosition(){
	videoWidth = $("video").width();
	videoHeight = $("video").height();
	$("video").css("margin-left", (videoWidth/2)*-1);
	$("video").css("margin-top", (videoHeight/2)*-1);
	positionItems();
}

$(window).resize(function() {
	setVideoPosition();
});