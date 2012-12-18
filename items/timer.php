<?php
	$itemArray["timer"] = array(
		"popcorn" => '
			popcorn.timer({
				start: 1,
				end:6,
				framerate: 20,
				id: "timer1"
			});
		',
		"RelativePosLeft" => 45,
		"RelativePosTop" => 40,
		"content" => '
			<div class="text">Click now!!!</div>
			<img src="images/icons/arrow-up-inverse.png" />
			<div class="countdown"></div>
		',
		"id" => "timer1",
		"class" => "item timer",
		"css" => '
			#timer1{position:absolute; width:150px; height:120px; background:#333; opacity:.5; text-align:center; cursor:pointer}
			#timer1 img{position:absolute; top:0px; left:0px;z-index:2}
			#timer1 .text{position:absolute; z-index:3; width:100%; color:#fff}
			.timer{
				border-radius: 5px; 
				-moz-border-radius: 5px; 
				-webkit-border-radius: 5px; 
				border: 1px solid #000000;
			}
			#timer1:hover{background:#fcc;}
			.countdown{position:absolute; left:0px; bottom:0px; height:100%; width:100%; overflow:hidden; background:#fff; border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius: 5px; z-index:1}
			#timer1:hover .countdown{background:#f00}
		',
		"javascript" => '
			(function (Popcorn) {  
			  Popcorn.plugin( "timer" , function( options ) {
				var fr = 0;
				var totaltime, that;
				
				return {
				  _setup : function( options ){
					
				  },
				  start: function(event, options){
					that = this;
					totaltime = options.end - options.start;
					$("#"+options.id).show();
				  },
				  end: function(event, options){
					$("#"+options.id).hide();
				  },
				  frame: function(){
					fr++;
					var numframes = (options.framerate)?Math.round((100/options.framerate)*0.6):6;
					if(fr >= numframes){
						//frame action
						var currentTime = that.currentTime() - options.start;
						$("#"+options.id).find(".countdown").css("height", 100-((currentTime/totaltime)*100)+"%");
						fr = 0;
					}
				  }
				};
			  });
			})(Popcorn);
			$("document").ready(function(){
				$("#timer1").live("click", function(){
					popcorn.currentTime(150);
				});
			});
		'
	);
?>