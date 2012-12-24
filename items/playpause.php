<?php
	$itemArray["playpause"] = array(
		"popcorn" => '
			popcorn.code({
				start: 0.2,
				end: 10000,
				onStart: function( options ) {
					$("#playpause").fadeIn();
				},
				onEnd: function(){
					$("#playpause").hide();
				}
			});
		',
		"content" => "",
		"css" => '
			#playpause{display:none; position:absolute; left:10px; width:50px; height:50px; bottom:10px; background:url(../images/icons/playpause.png); z-index:1000; cursor:pointer}
		',
		"javascript" => '
			var playing = true;
			
			$("#playpause").live("click", function(){
				if(playing){
					$("#playpause").css("background-position", -50);
					popcorn.pause();
					playing = false;
				} else {
					$("#playpause").css("background-position", 0);
					popcorn.play();
					playing = true;
				}
			});
		'
	);
?>