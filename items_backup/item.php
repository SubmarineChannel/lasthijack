<?php
	$itemArray["item"] = array(
		"popcorn" => '
			popcorn.code({
				start: 1,
				end:5,
				onStart: function( options ) {
					$("#item").fadeIn(1000);
				},
				onEnd: function(){
					$("#item").fadeOut(1000);
				}
			});
		',
		"RelativePosLeft" => 10,
		"RelativePosTop" => 80,
		"content" => "blaat",
		"class" => "item",
		"javascript" => '
			function test(){
				alert("test");
			}
		'
	);
?>