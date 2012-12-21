<?php
	$itemArray["sprite"] = array(
		"popcorn" => '
      // Timer for Piracy & Somalia
      popcorn.timerRound({
				start: 60,
				end: 70,
				framerate: 20,
				elementID: "timer-round",
        infoText: "Piracy &amp; Somalia",
        relativePositionTop: 20,
        relativePositionLeft: 20,
        displayProgress: true,
        onClick: function(){
					showMap();
				}
			});
      
      // Timer for Target of Choice
      popcorn.timerRound({
				start: 90,
				end: 100,
				framerate: 20,
				elementID: "timer-round",
        infoText: "Target of Choice",
        relativePositionTop: 20,
        relativePositionLeft: 20,
        displayProgress: true,
        onClick: function(){
					showTargetOfChoice();
				}
			});
		',
		"id" => "map",
		"content" => '<div id="sprite"></div>',
		"extrahtml" => '<div id="targetchoice"></div>',
		"css" => '
			#map{position:absolute; width:400px; height:400px; bottom:8px; left:0px; display:none}
			#sprite{position:absolute; width:400px; height:400px; background:url(../images/spriteSheets/location_sprite.png) 0px 0px no-repeat; overflow:hidden}
			#targetchoice{position:absolute; width:850px; height:250px; left:-1px; top:-1px; background:url(../images/spriteSheets/targetofchoice_sprite.png) 0px 0px no-repeat; overflow:hidden; display:none}
		',
		"javascript" => '
      $("document").ready(function(){
        $("#map").live("click", function(){
					$("#map").fadeOut();
					popcorn.play();
				});
        
        $("#targetchoice").live("click", function(){
					$("#targetchoice").fadeOut();
					popcorn.play();
				});
			});
      
      function showMap() {
        popcorn.pause();
        
        var ms = 30;
        var locationSpriteArray = new Array(2500, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms);
        var numsprites = locationSpriteArray.length;
        showSprite("sprite", 0, locationSpriteArray, 400, 400, false, numsprites, 2);
        $("#map").show();
      };
      
      function showTargetOfChoice() {
        popcorn.pause();
      
        $("#targetchoice").show();
        var ms = 60;
        var locationSpriteArray = new Array(ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, ms, 3000, ms+20, ms+20, ms+20, ms+20, ms+20, ms+20, ms+20, ms+20);
        var numsprites = locationSpriteArray.length;
        showSprite("targetchoice", 0, locationSpriteArray, 850, 256, false, numsprites, 1);	
      };
      
			function showSprite(id, spriteNum, spriteArr, spriteWidth, spriteHeight, sprinteRepeat, numsprites, cols){
				var col = spriteNum%cols;
				var row = Math.floor(spriteNum/cols);
				var marginleft = spriteWidth*col*-1;
				var marginTop = spriteHeight*row*-1;
				$("#"+id).css("background-position", marginleft+"px "+marginTop+"px");
				setTimeout(function(){
					spriteNum++;
					if(spriteNum < numsprites){
						showSprite(id, spriteNum, spriteArr, spriteWidth, spriteHeight, sprinteRepeat, numsprites, cols);
					} else {
						if(sprinteRepeat){
							spriteNum = 0;
							showSprite(id, spriteNum, spriteArr, spriteWidth, spriteHeight, sprinteRepeat, numsprites, cols);
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