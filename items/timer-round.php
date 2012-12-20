<?php
	$itemArray["timer-round"] = array(
		"popcorn" => '
			popcorn.timerRound({
				start: 5,
				end: 15,
				framerate: 20,
				id: "timer-round1"
			});
		',
		"RelativePosLeft" => 45,
		"RelativePosTop" => 40,
		"content" => '
      <canvas id="countdown-canvas" width="150px" height="150px"></canvas>
      <img id="pirate" src="images/icons/switch_icon_white.png" />
		',
		"id" => "timer-round1",
		"class" => "item timer",
		"css" => '
			#timer-round1 {
        position: absolute;
        width: 150px;
        height: 150px;
        cursor: pointer;
      }
      #countdown-canvas {
        position: absolute;
        z-index: 1;
        border: 0;
      }
			#timer-round1 img {
        position:absolute;
        top:38px;
        left:32px;
        height: 70px;
        z-index:2;
        border: 0;
      }
			#timer-round1:hover {
      }
		',
		"javascript" => '
			(function (Popcorn) {  
			  Popcorn.plugin( "timerRound" , function( options ) {
				var fr = 0;
				var totaltime, that;
        var SIZE = 150;
        var context = $("#countdown-canvas")[0].getContext("2d");
				
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
            var numframes = (options.framerate) ? Math.round((100 / options.framerate) * 0.6) : 6;
            if (fr >= numframes) {
              //frame action
              var currentTime = that.currentTime() - options.start;
              var p = (currentTime / totaltime);
              
              console.log(p);
              
              // 
              context.lineCap = "butt";
              context.lineWidth = 10;
              context.clearRect(0, 0, SIZE, SIZE);
              context.beginPath();
              context.strokeStyle = "rgba(255, 255, 255, 0.7)";
              context.fillStyle = "rgba(255, 255, 255, 0.7)";
              context.arc(SIZE/2, SIZE/2, SIZE/2 - 10, (Math.PI * 2 * (1 - Math.max(0.01, p))) - Math.PI * 0.5, -Math.PI * 0.5, true);
              context.stroke();
              
              fr = 0;
            }
				  }
				};
			  });
			})(Popcorn);
			$("document").ready(function(){
				$("#timer1").live("click", function(){
					popcorn.currentTime(179.3);
				});
			});
		'
	);
?>