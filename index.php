<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>fps_lasthijack_interactive_852x480</title>
<script src="js/popcorn-complete.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/demos.css" type="text/css" media="screen" />
<script src="js/jquery.min.js" ></script>
<script src="js/rgraph/RGraph.common.core.js" ></script>
<script src="js/rgraph/RGraph.common.effects.js" ></script>
<script src="js/rgraph/RGraph.rose.js" ></script>
<script src="js/rgraph/RGraph.cornergauge.js" ></script>
<script src="js/rgraph/RGraph.bar.js" ></script>
<!--[if lt IE 9]><script src="../excanvas/excanvas.js"></script><![endif]-->
<style>
html, body{margin:0px; padding:0px; width:100%; height:100%;}
body{overflow:hidden;}
#test1, #cvs{position:absolute; left:0px; top:0px; font-size:50px;}
#cvs{display:none}
#cvs2{position:absolute; bottom:0px; left:0px;}
#myCanvas{position:absolute; bottom:0px; opacity:.3; display:none}
#container{position:relative; width:100%; height:100%; overflow:hidden; background:#ff00ff}
video{position:absolute; min-width:100%; min-height:100%; left:50%; top:50%}
#bag{position:absolute; left:20px; top:20px;}
#menu{width:100%; position:absolute; left:0px; top:10px;}
td{text-align:center}
</style>
<script>
Popcorn( function(){
var popcorn = Popcorn.smart("#video");
	popcorn.loopPlugin({
	  "start": 16,
	  "end": 22,
	  "target": "video-container",
	  "loop": 3
	});
	popcorn.code({
		start: 0.1,
		end:1,
		onStart: function( options ) {
		  setVideoPosition();
        }
	});
	popcorn.code({
      start: 61,
      end: 71,
      onStart: function( options ) {
		$("#cvs").fadeIn(500);
      },
      onEnd: function( options ) {
		$("#cvs").hide();
      }
    });
	popcorn.code({
      start: 10,
      end: 20,
      onStart: function( options ) {
		$("#myCanvas").fadeIn(500);
      },
      onEnd: function( options ) {
		$("#myCanvas").hide();
      }
    });
	var rose = new RGraph.Rose('cvs', [[4,5,8],[1,3,5],[2,6,8],[4,2,2],[4,3,5]]);
	rose.Set('chart.colors.alpha', 0.5);
	rose.Set('chart.labels', ['NE','E','SE','S','SW','W','NW','N']);
	rose.Set('chart.labels.position', 'edge');
	rose.Set('chart.margin', 5);
	rose.Draw();
	
	popcorn.on( "timeupdate", function() {
		//do something
	});
	/*
	var cg = new RGraph.CornerGauge('cvs2', 0,100, 0);
	cg.Set('chart.colors.ranges', [[0,30, 'red'], [30, 60,'yellow'], [60, 100, '#0f0']]);
	cg.Set('chart.value.text.units.post', '%');
	cg.Set('chart.value.text.boxed', false);
	cg.Set('chart.value.text.size', 14);
	cg.Set('chart.value.text.font', 'Verdana');
	cg.Set('chart.value.text.bold', true);
	cg.Set('chart.value.text.decimals', 2);
	cg.Set('chart.shadow.offsetx', 5);
	cg.Set('chart.shadow.offsety', 5);
	cg.Draw();
	popcorn.on( "timeupdate", function() {
		var current_time = this.currentTime();
		var total_time = this.duration();
		var value = (current_time/total_time) * 100;
		cg.value = value;
		cg.Draw();
	});
	
	
	var data = [280,45,133,280,45,133,280,45,133,280,45,133,280,45,133];	
	// An example of the data used by stacked and grouped charts
	// var data = [[1,5,6], [4,5,3], [7,8,9]
	var bar = new RGraph.Bar('myCanvas', data);	
	bar.Set('chart.labels', ['Richard', 'Alex', 'Nick','Richard', 'Alex', 'Nick','Richard', 'Alex', 'Nick','Richard', 'Alex', 'Nick','Richard', 'Alex', 'Nick']);
	bar.Set('chart.gutter.left', 45);
	bar.Set('chart.background.grid', true);
	bar.Set('chart.background.grid.color', 'black');
	bar.Set('chart.text.color', 'white');
	bar.Set('chart.axis.color', 'white');
	bar.Set('chart.colors', ['red']);	
	bar.Draw();*/
});
function setVideoPosition(){
	var videoWidth = $("video").width();
	var videoHeight = $("video").height();
	$("video").css("margin-left", (videoWidth/2)*-1);
	$("video").css("margin-top", (videoHeight/2)*-1);
}
$(window).resize(function() {
	setVideoPosition();
});
</script>
</head>
<body>
<div id="container">
<video id="video" autoplay="autoplay" poster="video/index.files/html5video/fps_lasthijack_interactive_852x480_%281%29.jpg">
<source src="video/LastHijack.mp4" type="video/mp4" />
<!--source src="video/Last_Hijack_v01.webm" type="video/webm" />
<source src="video/Last_Hijack_v01.ogg" type="video/ogg" /-->
<!--source src="video/index.files/html5video/fps_lasthijack_interactive_852x480_%281%29.m4v" type="video/mp4" />
<source src="video/index.files/html5video/fps_lasthijack_interactive_852x480_%281%29.webm" type="video/webm" />
<source src="video/index.files/html5video/fps_lasthijack_interactive_852x480_%281%29.ogv" type="video/ogg" />
<source src="video/index.files/html5video/fps_lasthijack_interactive_852x480_%281%29.mp4" /-->
</video>
<div id="test1"></div>
<canvas id="cvs" width="400" height="450">[No canvas support]</canvas>
<!--canvas id="cvs2" width="300" height="300">[No canvas support]</canvas-->
<canvas id="myCanvas" width="1500" height="450">[No canvas support]</canvas>

<div id="menu">
	<table width="100%">
		<td><img src="images/icons/home.png" /></td>
		<td><img src="images/icons/badge.png" /></td>
		<td><img src="images/icons/shield.png" /></td>
		<td><img src="images/icons/search.png" /></td>
		<td><img src="images/icons/email.png" /></td>
	</table>
</div>
</div>
</body>
</html>
