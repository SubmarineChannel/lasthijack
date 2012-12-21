<?php
	$itemArray["ships"] = array(
		"popcorn" => '
			popcorn.timerRound({
				start: 30,
				end: 40,
				framerate: 20,
				elementID: "timer-round",
        infoText: "Current Hijacks",
        relativePositionTop: 45,
        relativePositionLeft: 15,
        displayProgress: true,
        onClick: function(){
					showShips(500);
				}
			});
      popcorn.code({
        start: 30,
        end: 50,
        onEnd: function() {
          $("#ships").fadeOut();
        }
      });
		',
		"onresize" => 'scale("ships", 1000, 800, true, true);',
		"onstart" => 'scale("ships", 1000, 800, true, true);',
		"content" => '
			<h1>Current Hijacks</h1>
			<div style="height:841px; width:238px; left:0px; top:0px; position:absolute; margin-right:10px; margin-top:70px">
				<div class="shiptext ship1"><div>6 bulk-type carriers</div></div>
				<div class="shiptext ship2"><div>8 dhows (small wooden ships)</div></div>
				<div class="shiptext ship3"><div>1 liquid petroleum gas carrier</div></div>
				<div class="shiptext ship4"><div>2 yachts</div></div>
				<div class="shiptext ship5"><div>14 fishing vessels</div></div>
				<div class="shiptext ship6"><div>4 tankers</div></div>
				<div class="shiptext ship7"><div>12 cargo vessels of varous types</div></div>
				<div class="shiptext ship8"><div>3 other vessels</div></div>
				<div class="shiptext ship9"><div>1 tug boat</div></div>
			</div>
			<div style="height:841px; width:562px; left:248px; top:0px; position:absolute; overflow:hidden; margin-top:70px">
				<div class="ship ship1" id="ship1"><img src="images/ships/ships_bulk-type.png" /></div>
				<div class="ship ship2" id="ship2"><img src="images/ships/ships_dhows.png" /></div>
				<div class="ship ship3" id="ship3"><img src="images/ships/ships_liquid-carrier.png" /></div>
				<div class="ship ship4" id="ship4"><img src="images/ships/ships_yachts.png" /></div>
				<div class="ship ship5" id="ship5"><img src="images/ships/ships_fishingvessels.png" /></div>
				<div class="ship ship6" id="ship6"><img src="images/ships/ships_tankers.png" /></div>
				<div class="ship ship7" id="ship7"><img src="images/ships/ships_cargovessels.png" /></div>
				<div class="ship ship8" id="ship8"><img src="images/ships/ships_othervessels.png" /></div>
				<div class="ship ship9" id="ship9"><img src="images/ships/ships_tugboat.png" /></div>
			</div>
		',
		"css" => '
			.ship{position:absolute; left:-562px; width:562px; display:none; text-align:left}
			.shiptext{text-align:right; font-weight:bold;}
			.shiptext div{margin-top:2px;}
			.ship1{height:159px; top:0px}
			.ship2{height:102px; top:159px}
			.ship3{height:39px; top:261px}
			.ship4{height:25px; top:300px}
			.ship5{height:103px; top:325px}
			.ship6{height:108px; top:428px}
			.ship7{height:246px; top:536px}
			.ship8{height:31px; top:782px}
			.ship9{height:31px; top:813px}
			#ships{
				position:absolute;
				background-color:rgba(255,255,255,0.8);
				width:850px;
				height:920px;
				top:25px;
				left:25px;
				padding:10px;
				padding-left:30px;
				-webkit-transform: scale(0.7);
				-moz-transform: scale(0.7);
				-ms-transform: scale(0.7);
				-o-transform: scale(0.7);
				display:none;
			}
			#ships h1{margin:0}
			#shipcountdown{display:none; width:185px; height:171px; position:absolute; left:50%; top:50%; margin-left:-142px; margin-top:-125px; }
			.interactive{cursor:pointer; opacity:.5}
			.interactive:hover{opacity:1}
			#shipcountdown .countdown{position:absolute; width:100%; height:8px; bottom:1px}
		',
		"javascript" => '
			$("document").ready(function(){
        $("#ships").live("click", function(){
					$("#ships").fadeOut();
					popcorn.play();
				});
			});
			
			function scale(id, width, height, changemarginleft, changemargintop){
				var containerHeight = $("#container").height();
				var scale = containerHeight/height;	
				$("#"+id).css("-webkit-transform", "scale("+scale+")");
				$("#"+id).css("-moz-transform", "scale("+scale+")");
				$("#"+id).css("-ms-transform", "scale("+scale+")");
				$("#"+id).css("-o-transform", "scale("+scale+")");
				$("#"+id).css("transform", "scale("+scale+")");
				if(changemarginleft)$("#"+id).css("margin-left", (width-((scale*width)))*-0.5);
				if(changemargintop)$("#"+id).css("margin-top", (height-((scale*height)))*-0.5);
			}
			function showShips(pership){
				$("#shipcountdown").hide();
				//popcorn.pause();
				$("#ships").show(function(){
					$("#ship1").show().animate({"left": "+=562px"}, pership, function(){
						$("#ship2").show().animate({"left": "+=562px"}, pership, function(){
							$("#ship3").show().animate({"left": "+=562px"}, pership, function(){
								$("#ship4").show().animate({"left": "+=562px"}, pership, function(){
									$("#ship5").show().animate({"left": "+=562px"}, pership, function(){
										$("#ship6").show().animate({"left": "+=562px"}, pership, function(){
											$("#ship7").show().animate({"left": "+=562px"}, pership, function(){
												$("#ship8").show().animate({"left": "+=562px"}, pership, function(){
													$("#ship9").show().animate({"left": "+=562px"}, pership, function(){
									
													});
												});
											});
										});
									});
								});
							});
						});
					});
				});
			}
		'
	);
?>