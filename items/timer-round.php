<?php
	$itemArray["timer-round"] = array(
    "popcorn" => '
      popcorn.timerRound({
        start: 150,
        end: 179.3,
        framerate: 20,
        elementID: "timer-round",
        displayProgress: false,
        relativePositionTop: 40,
        relativePositionLeft: 45,
        onClick: function(elementID) {
          // Move popcorn playback
          popcorn.currentTime(179.3);
        },
        blink: true,
        useSwitch: true
      });
    ',
		"content" => '
      <canvas class="countdown-canvas" width="150px" height="150px"></canvas>
      <img src="images/icons/switch_icon_white.png" />
      <div class="timer-info"></div>
		',
		"id" => "timer-round",
		"class" => "item timer timer-round",
		"css" => '
			.timer-round {
        position: absolute;
        width: 150px;
        height: 150px;
        cursor: pointer;
        opacity: 0.5;
        -moz-transition:opacity 0.25s ease-out;
        -webkit-transition:opacity 0.25s ease-out;
        transition:opacity 0.25s ease-out;
      }
			.timer-round img {
        position:absolute;
        top:38px;
        left:32px;
        height: 70px;
        z-index: 3;
        border: 0;
      }
      .timer-round img.timer-switch {
        position:absolute;
        top:0;
        left:0;
        height: 150px;
        z-index: 2;
        border: 0;
      }
      .timer-round.timer-blinking {
        opacity: 1;
      }
			.no-touch div:not(.timer-blink) .timer-round:hover {
        opacity: 1;
      }
      .timer-info {
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
          
          return {
            start: function(event, options){
              //console.log("timerRound.start");
              
              // Check if element can be found
              if ($("#" + options.elementID).length == 0) {
                // Create timer element
                var element = $("<div id=" + options.elementID + " class=\"item timer timer-round\"><div><canvas class=\"countdown-canvas\" width=\"150px\" height=\"150px\"></canvas>" +
      "<img src=\"images/icons/switch_icon_white.png\" />" +
      "<div class=\"timer-info\"></div></div></div>");
                // Append element to div#container
                $("div#container").append(element);
              }
              
              that = this;
              frameCount = 0;
              totaltime = options.end - options.start;
              
              if (options.infoText !== undefined) {
                $("#" + options.elementID + " .timer-info").html(options.infoText);
                $("#" + options.elementID + " .timer-info").css("display", "block");
              } else {
                $("#" + options.elementID + " .timer-info").css("display", "none");
              }
              
              // Set timer position
              $("#"+options.elementID).css("position", "absolute");
              $("#"+options.elementID).addClass("item");
              if (!isNaN(options.relativePositionTop)) {
                $("#"+options.elementID).css("margin-top", ((options.relativePositionTop - 50) * ($("#video").height() / 100)).toString() + "px");
              } else {
                $("#"+options.elementID).css("margin-top", 0);
              }
              if (!isNaN(options.relativePositionLeft)) {
                $("#"+options.elementID).css("margin-left", ((options.relativePositionLeft - 50) * ($("#video").width() / 100)).toString() + "px");
              } else {
                $("#"+options.elementID).css("margin-left", 0);
              }
              
              if (!isNaN(options.absolutePositionBottom)) {
                $("#"+options.elementID).removeClass("item");
                $("#"+options.elementID).css("position", "fixed");
                $("#"+options.elementID).css("bottom", options.absolutePositionBottom + "px");
              }
              
              if (!isNaN(options.absolutePositionRight)) {
                $("#"+options.elementID).removeClass("item");
                $("#"+options.elementID).css("position", "fixed");
                $("#"+options.elementID).css("right", options.absolutePositionRight + "px");
              }
              
              if (options.useSwitch === true) {
                if ($("#" + options.elementID + " img.timer-switch").length == 0) {
                  // Add the switch image
                  $("#" + options.elementID).append("<img src=\"images/icons/switch_icon.png\" class=\"timer-switch\"/>");
                }
              } else {
                if ($("#" + options.elementID + " img.timer-switch").length != 0) {
                  // Remove the switch image
                  $("#" + options.elementID + " img.timer-switch").remove();
                }
              }
              
              // Set text position
              if (!isNaN(options.verticalTextRelativeTop)) {
                $("#" + options.elementID + " .timer-info").css("top", options.verticalTextRelativeTop + "%");
              } else {
                  $("#" + options.elementID + " .timer-info").css("top", "10%");
              }
              
              if (!isNaN(options.verticalTextRelativeLeft)) {
                $("#" + options.elementID + " .timer-info").css("left", options.verticalTextRelativeLeft + "px");
              } else {
                  $("#" + options.elementID + " .timer-info").css("left", "160px");
              }
              
              $("#"+options.elementID).show();
              if (options.onClick) {
                $("#"+options.elementID).bind("click", function() {
                  $("#"+options.elementID).hide();
                  options.onClick(options.elementID);
                });
              }
              
              setTimeout(function() {
                if (options.blink === true) {
                  // Update transition duration
                  $("#" + options.elementID).css("-moz-transition", "opacity 0.5s ease-out");
                  $("#" + options.elementID).css("-webkit-transition", "opacity 0.5s ease-out");
                  $("#" + options.elementID).css("transition", "opacity 0.5s ease-out");
                  
                  // Set class to that of blink
                  $("#" + options.elementID).addClass("timer-blink");
                  $("#" + options.elementID).addClass("timer-blinking");
                  
                  // Register event listener for
                  $("#" + options.elementID).bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                    if ($("#" + options.elementID).hasClass("timer-blinking")) {
                      $("#" + options.elementID).removeClass("timer-blinking");
                    } else {
                      $("#" + options.elementID).addClass("timer-blinking");
                    }
                  });
                }
               }, 100);
            },
            
            end: function(event, options){
              $("#"+options.elementID).hide();
              $("#"+options.elementID).unbind("click");
              $("#" + options.elementID).unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
              $("#" + options.elementID).removeClass("timer-blink");
              $("#" + options.elementID).removeClass("timer-blinking");
              
              if (options.onEnd) {
                options.onEnd();
              }
            },
            
            frame: function(event, options){
              frameCount++;
              var numframes = (options.framerate) ? Math.round((100 / options.framerate) * 0.6) : 6;
              if (frameCount >= numframes) {
                //frame action
                var currentTime = that.currentTime() - options.start;
                var p = (currentTime / totaltime);
                
                if (options.displayProgress === true) {
                  // Draw arc
                  var context = $("#" + options.elementID + " canvas.countdown-canvas")[0].getContext("2d");
                  context.lineCap = "butt";
                  context.lineWidth = 10;
                  context.clearRect(0, 0, SIZE, SIZE);
                  context.beginPath();
                  context.strokeStyle = "rgba(255, 255, 255, 0.7)";
                  context.fillStyle = "rgba(255, 255, 255, 0.7)";
                  context.arc(SIZE/2, SIZE/2, SIZE/2 - 10, (Math.PI * 2 * (1 - Math.max(0.01, p))) - Math.PI * 0.5, -Math.PI * 0.5, true);
                  context.stroke();
                }
                
                // Reset framecount
                frameCount = 0;
              }
            }
          };
			  });
			})(Popcorn);
		'
	);
?>