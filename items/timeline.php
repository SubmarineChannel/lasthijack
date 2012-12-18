<?php
	$itemArray["timeline"] = array(
		"popcorn" => '
			popcorn.timeline({
				start: 0.1,
				end:1000,
				framerate: 20
			});
		',
		"content" => '
			<div id="progress"></div>
		',
		"class" => "timeline",
		"css" => '
			#timeline{position:absolute; width:100%; bottom:0px; left:0px; height:10px; background:#ccc; opacity:.5}
			#progress{position:absolute; left:0px; top:1px; height:8px; width:0%; overflow:hidden; background:#000}
		',
		"javascript" => '
			(function (Popcorn) {  
			  Popcorn.plugin( "timeline" , function( options ) {
				// do stuff
				// this refers to the popcorn object
			 
				// You are required to return an object
				// with a start and end property
				
				var fr = 0;
				var totaltime, that;
				
				return {
				  _setup : function( options ){
					
				  },
				  start: function(event, options){
					that = this;
					totaltime = that.duration();
					$("#timeline").show();
				  },
				  end: function(event, options){
					$("#timeline").hide();
				  },
				  frame: function(){
					fr++;
					var numframes = (options.framerate)?Math.round((100/options.framerate)*0.6):6;
					if(fr >= numframes){
						//frame action
						$("#progress").css("width", (that.currentTime()/totaltime)*100+"%");
						fr = 0;
					}
				  }
				};
			  });
			})(Popcorn);
		'
	);
?>