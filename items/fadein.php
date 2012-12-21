<?php
	$itemArray["fadein"] = array(
		"popcorn" => '
			popcorn.code({
				start: 0.1,
				end:0.2,
				onStart: function( options ) {
					showSplash();
				},
				onEnd: function(){
					$("#fadein").fadeOut(1000);
				}
			});
		',
		"onresize" => 'scale("startscreen", 1000, 800, false, true); $("#startscreen").show(); ',
		"onstart" => 'scale("startscreen", 1000, 800, false, true); $("#startscreen").show(); ',
		"content" => '
			<center>
			<table id="startscreen">
				<tr>
					<td colspan="2" height="200"></td>
				</tr>
				<tr>
					<td>
						<div id="preloader">
							<div class="progress"></div>
							<img src="images/icons/skull_loading.png" />
						</div>
					</td>
					<td>
						<div class="textfield">The Last Hijack explores the current issue of modern day piracy and the lives of the people it touches from both the Western and the Somali perspective.</div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<div id="logos">
							<img src="images/logos/sub_logo.png" />
							<img src="images/logos/ikon_logo.png" />
							<img src="images/logos/npo_logo.png" />
							<img src="images/logos/zdf_logo.png" />
						</div>
					</td>
				</tr>
			</table>
			</center>
		',
		"css" => '
			#fadein{position:absolute; width:100%; height:100%; background:#000; text-align:center;}
			#fadein table{width:1000px}
			.textfield{font-size:20px; font-weight:bold; background:#fff; padding:20px; margin-left:80px;-moz-border-radius: 16px;-webkit-border-radius: 16px;border-radius: 16px;}
			#preloader{position:relative; background:#333; width:491px; height:400px; overflow:hidden;}
			#preloader .progress{background:#fff; position:absolute; width:491px; bottom:0px; left:0px; height:0%; overflow:hidden}
			#preloader img{height:400px; position:absolute; left:0px; top:0px; }
			#logos img{margin-top:100px;height:40px;margin-right:45px;}
		',
		"javascript" => '
			function showSplash(){
				var time = 10000;
				popcorn.pause();
				$("#preloader").find(".progress").animate({height:"100%"},time, function(){
					popcorn.play();
				});
			}
		'
	);
?>