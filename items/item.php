<?php
	$itemArray["item"] = array(
		"start" => 1,
		"end" => 5,
		"onStart" => "$('#menu').fadeIn(1000); test();",
		"onEnd" => "$('#menu').fadeOut(1000); ",
		"RelativePosLeft" => 10,
		"RelativePosTop" => 80,
		"content" => "blaat",
		"class" => "item",
		"javascript" => '
			function test(){
				alert(\'test\');
			}
		'
	);
?>