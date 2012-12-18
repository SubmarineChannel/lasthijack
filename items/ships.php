<?php
	$itemArray["ships"] = array(
		"popcorn" => '
			popcorn.ships({
				start: 5,
				end:11,
				framerate: 20,
				timeAfterAnimation: 4
			});
		',
		"RelativePosLeft" => 10,
		"RelativePosTop" => 10,
		"content" => '
			<div class="ship" id="ship1"><img src="images/ships/ship1.png" /></div>
			<div class="ship" id="ship2"><img src="images/ships/ship2.png" /></div>
			<div class="ship" id="ship3"><img src="images/ships/ship3.png" /></div>
			<div class="ship" id="ship4"><img src="images/ships/ship4.png" /></div>
		',
		"class" => "item",
		"css" => '
			.ship{position:absolute; left:-150px; width:322px; height:50px; display:none; text-align:right}
			#ship1{top:50px}
			#ship2{top:120px}
			#ship3{top:190px}
			#ship4{top:260px}
		',
		"javascript" => '
			(function (Popcorn) {  
			  Popcorn.plugin( "ships" , function( options ) {
				// do stuff
				// this refers to the popcorn object
			 
				// You are required to return an object
				// with a start and end property
				
				var fr = 0;
				return {
				  _setup : function( options ){
					
				  },
				  start: function(event, options){
					var that = this;
					var totaltime = (options.end - options.start)*1000;
					var pership = (totaltime-(options.timeAfterAnimation*1000))/4;
					$("#ships").show(function(){
						$("#ship1").show().animate({"left": "+=150px"}, pership, function(){
							$("#ship2").show().animate({"left": "+=150px"}, pership, function(){
								$("#ship3").show().animate({"left": "+=150px"}, pership, function(){
									$("#ship4").show().animate({"left": "+=150px"}, pership, function(){
										
									});
								});
							});
						});
					});
				  },
				  end: function(event, options){
					$("#ships").hide();
				  },
				  frame: function(){
					fr++;
					var numframes = (options.framerate)?Math.round((100/options.framerate)*0.6):6;
					if(fr >= numframes){
						//frame action
						
						fr = 0;
					}
				  }
				};
			  });
			})(Popcorn);
		'
	);
?>