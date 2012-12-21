<?php
	$itemArray["fadein"] = array(
		"popcorn" => '
			popcorn.code({
				start: 0.1,
				end:0.2,
				onStart: function( options ) {
					showSplash();
				},
				onEnd: function(){
					$("#fadein").fadeOut(1000);
				}
			});
		',
		"content" => '
			<h1>The Last Hijack explores the current issue of modern day piracy and the lives of the people it touches from both the Western and the Somali perspective.</h1>
			<center>
			<table>
			<tr>
			<td><img src="images/icons/switch_icon_white.png" /><br />Interact</td>
			<!--td><img src="images/icons/arrow-up-white.png" /><br />switch perspective</td-->
			</tr>
			</table>
			</center>
		',
		"css" => '
			#fadein{position:absolute; width:100%; height:100%; background:#000; text-align:center; color:white}
			#fadein h1{margin-top:15%;}
			#fadein table{width:400px}
			#fadein img{height:60px}
		',
		"javascript" => '
			function showSplash(){
				popcorn.pause();
				setTimeout(function(){
					popcorn.play();
				}, 5000);
			}
		'
	);
?>