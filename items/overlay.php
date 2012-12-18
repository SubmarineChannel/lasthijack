<?php
	$itemArray["overlay"] = array(
		"popcorn" => '
			popcorn.code({
				start: 10,
				end: 30,
				onStart: function( options ) {
					popcorn.pause(); $("#overlay").show();
				}
			});
		',
		"content" => "<h1>overlay</h1><p>content</p><div class='close'>X</div>",
		"class" => "overlay",
		"css" => '
			.overlay{position:absolute; left:0px; top:0px; background:white; width:96%; height:96%; margin:2%; display:none}
			.overlay > div{padding:40px}
			.close{position:absolute; right:10px; top:10px; cursor:pointer}
		',
		"javascript" => '
			$("#overlay .close").live("click", function(){
				$("#overlay").fadeOut();
				popcorn.play();
			});
		'
	);
?>