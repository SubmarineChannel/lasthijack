<?php
	$itemArray["fadeout"] = array(
		"popcorn" => '
			popcorn.code({
				start: 358,
				end:500,
				onStart: function( options ) {
					$("#fadeout").fadeIn(300);
					endTitles();
				},
				onEnd: function(){
					$("#fadeout").hide();
					$("#endtitle").hide();
					$("#comingsoon").show();
				}
			});
		',
		"onresize" => 'scale("endscreen", 1000, 800, false, true);',
		"onstart" => 'scale("endscreen", 1000, 800, false, true);',
		"content" => '
			<center>
			<table id="endscreen">
				<tr>
					<td colspan="2" height="200"></td>
				</tr>
				<tr>
					<td colspan="2">
						<h1 id="comingsoon">&nbsp;<span>Coming Soon</span></h1>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<h1 id="endtitle">&nbsp;<span>The Last Hijack</span></h1>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<div class="logos">
							<img src="images/logos/sub_logo.png" />
							<img src="images/logos/ikon_logo.png" />
							<img src="images/logos/npo_logo.png" />
							<img src="images/logos/zdf_logo.png" />
						</div>
            <div class="logos logos-bottom">
              <img src="images/logos/mediafonds.png" />
            </div>
					</td>
				</tr>
			</table>
			</center>
		',
		"css" => '
			#fadeout{position:absolute; width:100%; height:100%; background:#000; text-align:center; display:none; color:#fff}
			#fadeout table{width:1000px}
			#endtitle span{font-size:40px; display:none}
		',
		"javascript" => '
			function endTitles(){
				setTimeout(function(){
					$("#endtitle").find("span").fadeIn(1000);
				},2000);
				setTimeout(function(){
					$("#comingsoon").find("span").fadeOut(2000);
				},5000);
			}
		'
	);
?>