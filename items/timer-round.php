<?php
	$itemArray["timer-round"] = array(
    /*
		"popcorn" => '
			popcorn.timerRound({
				start: 5,
				end: 15,
				framerate: 20,
				id: "timer-round1",
        infoText: "Current Hijacks",
        clickCallback: null
			});
		',
    */
		"RelativePosLeft" => 45,
		"RelativePosTop" => 40,
		"content" => '
      <canvas id="countdown-canvas" width="150px" height="150px"></canvas>
      <img src="images/icons/switch_icon_white.png" />
      <div id="timer-info"></div>
		',
		"id" => "timer-round",
		"class" => "item timer",
		"css" => '
			#timer-round {
        position: absolute;
        width: 150px;
        height: 150px;
        cursor: pointer;
        opacity: 0.4;
        -moz-transition:opacity 0.25s ease-out;
        -webkit-transition:opacity 0.25s ease-out;
        transition:opacity 0.25s ease-out;
      }
      .countdown-canvas {
        position: absolute;
        z-index: 1;
        border: 0;
      }
			#timer-round img {
        position:absolute;
        top:38px;
        left:32px;
        height: 70px;
        z-index:2;
        border: 0;
      }
			.no-touch #timer-round:hover {
        opacity: 1;
      }
      #timer-info {
        position:absolute;
        background:white;
        left:160px;
        top:10%;
        white-space:nowrap;
        padding:5px;
        padding-left:10px;
        padding-right:10px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        font-weight:bold;
        font-size:20px;
      }
		',
		"javascript" => '
			(function (Popcorn) {
			  Popcorn.plugin( "timerRound" , function( options ) {
				var frameCount = 0;
				var totaltime, that;
        var SIZE = 150;
        var context = $("#countdown-canvas")[0].getContext("2d");
				
				return {
				  _setup : function( options ){
					
				  },
				  start: function(event, options){
            that = this;
            totaltime = options.end - options.start;
            $("#timer-info").html(options.infoText);
            $("#"+options.id).show();
            if (options.clickCallback != null) {
              $("#"+options.id).bind("click", function() {
                $("#"+options.id).hide();
                options.clickCallback();
              });
            }
				  },
				  end: function(event, options){
            $("#"+options.id).hide();
            $("#"+options.id).bind("click");
				  },
				  frame: function(){
            frameCount++;
            var numframes = (options.framerate) ? Math.round((100 / options.framerate) * 0.6) : 6;
            if (frameCount >= numframes) {
              //frame action
              var currentTime = that.currentTime() - options.start;
              var p = (currentTime / totaltime);
              
              // Draw arc
              context.lineCap = "butt";
              context.lineWidth = 10;
              context.clearRect(0, 0, SIZE, SIZE);
              context.beginPath();
              context.strokeStyle = "rgba(255, 255, 255, 0.7)";
              context.fillStyle = "rgba(255, 255, 255, 0.7)";
              context.arc(SIZE/2, SIZE/2, SIZE/2 - 10, (Math.PI * 2 * (1 - Math.max(0.01, p))) - Math.PI * 0.5, -Math.PI * 0.5, true);
              context.stroke();
              
              // Reset framecount
              frameCount = 0;
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