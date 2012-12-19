<?php
	$itemArray["sprite"] = array(
		"popcorn" => '
			popcorn.code({
				start: 1,
				end:8,
				onStart: function( options ) {
					showSprite();
					$("#map").show();
				},
				onEnd: function(){
					$("#map").fadeOut();
				}
			});
		',
		"id" => "map",
		"content" => '<div id="sprite"></div>',
		"css" => '
			#map{position:absolute; width:400px; height:400px; bottom:8px; left:0px; display:none}
			#sprite{position:absolute; width:400px; height:400px; background:url(../images/spriteSheets/location_sprite.png) 0px 0px no-repeat; overflow:hidden}
		',
		"javascript" => '
			var spriteWidth = 400;
			var spriteHeight = 400;
			var sprinteRepeat = false;
			var spriteArr = new Array(2500, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 2000);
			var numsprites = spriteArr.length;
			var spriteNum = 0;
			
			function showSprite(){
				$("#sprite").css("background-position", spriteWidth*spriteNum*-1);
				setTimeout(function(){
					spriteNum++;
					if(spriteNum < numsprites){
						showSprite();
					} else {
						if(sprinteRepeat){
							spriteNum = 0;
							showSprite();
						} else {
							spriteNum = 0;
						}
					}
				}, spriteArr[spriteNum]
				);
			}
		'
	);
?>