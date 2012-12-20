<?php
	$itemArray["sprite"] = array(
		"popcorn" => '
			popcorn.code({
				start: 1,
				end:12,
				onStart: function( options ) {
					var locationSpriteArray = new Array(2500, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 2000);
					var numsprites = locationSpriteArray.length;
					showSprite("sprite", 0, locationSpriteArray, 400, false, numsprites);
					$("#map").show();
				},
				onEnd: function(){
					$("#map").fadeOut();
				}
			});
			popcorn.code({
				start: 30,
				end:40,
				onStart: function( options ) {
					$("#targetchoice").show();
					var locationSpriteArray = new Array(100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 2000);
					var numsprites = locationSpriteArray.length;
					showSprite("targetchoice", 0, locationSpriteArray, 850, false, numsprites);					
				},
				onEnd: function(){
					$("#targetchoice").fadeOut();
				}
			});
		',
		"id" => "map",
		"content" => '<div id="sprite"></div>',
		"extrahtml" => '<div id="targetchoice"></div>',
		"css" => '
			#map{position:absolute; width:400px; height:400px; bottom:8px; left:0px; display:none}
			#sprite{position:absolute; width:400px; height:400px; background:url(../images/spriteSheets/location_sprite.png) 0px 0px no-repeat; overflow:hidden}
			#targetchoice{position:absolute; width:850px; height:250px; left:10px; top:10px; background:url(../images/spriteSheets/targetofchoice_sprite.png) 0px 0px no-repeat; overflow:hidden; display:none}
		',
		"javascript" => '
			function showSprite(id, spriteNum, spriteArr, spriteWidth, sprinteRepeat, numsprites){
				$("#"+id).css("background-position", spriteWidth*spriteNum*-1);
				setTimeout(function(){
					spriteNum++;
					if(spriteNum < numsprites){
						showSprite(id, spriteNum, spriteArr, spriteWidth, sprinteRepeat, numsprites);
					} else {
						if(sprinteRepeat){
							spriteNum = 0;
							showSprite(id, spriteNum, spriteArr, spriteWidth, sprinteRepeat, numsprites);
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