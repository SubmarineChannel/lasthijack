<?php
	$itemArray["menu"] = array(
		"popcorn" => '
			popcorn.code({
				start: 5,
				end: 250,
				onStart: function( options ) {
					$("#menu").slideDown(1000);
				},
				onEnd: function(){
					$("#menu").slideUp(1000);
				}
			});
		',
		"content" => '	<table width="100%">
							<td><img src="images/icons/home.png" /></td>
							<td><img src="images/icons/badge.png" /></td>
							<td><img src="images/icons/shield.png" /></td>
							<td><img src="images/icons/search.png" /></td>
							<td><img src="images/icons/email.png" /></td>
						</table>',
		"class" => "menu",
		"css" => '',
		"javascript" => '
			
		'
	);
?>