<?php
include("inc/videoscheme.php");
include("inc/settings.php");
include("inc/texts.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<script src="js/modernizr.js"></script>
		<script src="js/prefixfree.min.js"></script>
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/mobiledetect.js"></script>
		<script src="js/jquery.transform2d.js"></script>
		<script src="js/spin.min.js"></script>
		<script src="js/html5Preloader.js"></script>
		<script src="js/popcorn-complete.js"></script>
		<script src="js/jquery.tooltipster.min.js"></script>
		
		<script src="inc/preloadThumbs.php"></script>
		<script src="inc/subtitles.php"></script>
		
		<script>
		var chapterTitles = [<?php 
			$chapterkeys = array_keys($texts[$lang]["chapters"]);
			$i = 0;
			foreach($chapterkeys as $title){
				$comma = ($i!=0)?', ':'';
				echo $comma.'"'.$title.'"';
				$i++;
			}
		?>];
		
		var scheme = [
			<?php
			foreach($scheme as $i => $var){
				$comma = ($i!=0)?', ':'';
				//$vars = explode(",", $var);
				//echo $i.': Array('.$vars[0].','.$vars[1].'),';
				echo $comma.'"'.$var.'"';
			}
			?>
		]
		var parts = {
		<?php
			$j = 0;
			foreach($parts as $chapter){
				foreach($chapter as $i => $part){
					echo "\t$j: {\r\n";
					foreach($part as $side => $list){
						echo "\t\t$side: Array('".implode("','", $list)."'),\r\n";
					}
					echo "\t},\r\n";
					$j++;
				}
			}
		?>
		};
		var active = <?php echo $active ?>;
		</script>
		<script src="js/main.js"></script>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.pageslide.css" />
	</head>
	<body>
		<!--script src="js/jquery.pageslide.min.js"></script>
		<a href="_secondary.html" class="first">Link text</a>
		<script>
			$(".first").pageslide({
				direction: "left"
			});
		</script-->
		<div id="videos" style="width:100%; height:100%">
			<div id="upwrap" style="position:relative; height:50%; overflow:hidden">
				<video id="up" class="notplaying"></video>
				<div id="upcwrap">
					<canvas id="upc"></canvas>
					<div id="upcleft" style="position:absolute; left:-100%; top:0px; width:100%; height:100%; background:#f00; background-size:cover; background-position:center center;"></div>
					<div id="upcright" style="position:absolute; left:100%; top:0px; width:100%; height:100%; background:#ff0; background-size:cover; background-position:center center;"></div>
					<div id="upctop" style="position:absolute; left:0px; top:-100%; width:100%; height:100%; background:#00f; background-size:cover; background-position:center center;"></div>
					<div id="upcbottom" style="position:absolute; left:0px; top:100%; width:100%; height:100%; background:#0ff; background-size:cover; background-position:center center;"></div>
				</div>
			</div>
			<div id="downwrap" style="position:relative; height:50%; overflow:hidden">
				<video id="down" class="playing"></video>
				<div id="downcwrap">
					<canvas id="downc"></canvas>
					<div id="downcleft" style="position:absolute; left:-100%; top:0px; width:100%; height:100%; background:#f00; background-size:cover; background-position:center center;"></div>
					<div id="downcright" style="position:absolute; left:100%; top:0px; width:100%; height:100%; background:#ff0; background-size:cover; background-position:center center;"></div>
					<div id="downctop" style="position:absolute; left:0px; top:-100%; width:100%; height:100%; background:#00f; background-size:cover; background-position:center center;"></div>
					<div id="downcbottom" style="position:absolute; left:0px; top:100%; width:100%; height:100%; background:#0ff; background-size:cover; background-position:center center;"></div>
				</div>
			</div>
		</div>
		<div id="chaptertitle"></div>
		<div id="progress">
			<div id="bar">
				<div id="vidprogressup" class="vidprogress"></div>
				<div id="vidprogressdown" class="vidprogress"></div>
				<div id="marker"></div>
				<?php
				echo '<table cellpadding=0 cellspacing=0 id="uptrack" style="position:absolute; bottom:-11px;">';
				echo '<tr>';					
					$j = 0;
					$c = 0;
					$colors = array("002f3e","3e2700","3e0000");
					$colors = array("333","333","333");
					foreach($parts as $chapter){
						$numparts = count($chapter);
						$partkeys = array_keys($texts[$lang]["chapters"][$chapterkeys[$c]]);
						for($i=0;$i<$numparts;$i++){
							$act = ($active == $j)?"active":"";
							echo '<td valign="bottom" class="part '.$act.' " chapter="'.$c.'" part="'.$j.'">';
								for($b=0; $b<count($chapter[$i]["up"]); $b++){
									$pos = (count($chapter[$i]["up"])-1)-$b;
									$vid = $chapter[$i]["up"][$pos];
									echo '<div id="up'.$pos.$j.'" class="vidBlock up'.$pos.' tooltip tooltipup" onclick="goToVideo(0, \''.$vid.'\', '.$pos.', '.$j.')" title="'.$texts[$lang]["chapters"][$chapterkeys[$c]][$partkeys[$i]]["up"][$pos].'"></div>';
								}
							echo '</td>';
							$j++;
						}
						${'part'.$c} = $i;
						$c++;
					}
				echo '</tr>';
				echo '<tr>';
					for($i=0;$i<$c;$i++){
						echo '<td colspan="'.${'part'.$i}.'"><div class="tooltip chapter" title="'.$chapterkeys[$i].'" style="background:#'.$colors[$i].'; height:11px; margin-top:5px; margin-right:5px; text-align:center"></div></td>';
					}
				echo'</tr>';
				echo '</table><table cellpadding=0 cellspacing=0 id="downtrack" style="position:absolute; top:5px">';
				echo '<tr>';
					$j = 0;
					$c = 0;
					foreach($parts as $chapter){
						$numparts = count($chapter);
						$partkeys = array_keys($texts[$lang]["chapters"][$chapterkeys[$c]]);
						for($i=0;$i<$numparts;$i++){
							$act = ($active == $j)?"active":"";
							echo '<td valign="top" class="part '.$act.'" chapter="'.$c.'" part="'.$j.'">';
								foreach($chapter[$i]["down"] as $pos => $vid){
									echo '<div id="down'.$pos.$j.'" class="vidBlock down'.$pos.' tooltip tooltipdown" onclick="goToVideo(1, \''.$vid.'\', '.$pos.', '.$j.')" title="'.$texts[$lang]["chapters"][$chapterkeys[$c]][$partkeys[$i]]["down"][$pos].'"></div>';
								}
							echo '</td>';
							$j++;
						}
						$c++;
					}
				echo '</tr>';
				echo '</table>';
				?>
			</div>
		</div>
		<div id="controls">
			<div class="controlsX" id="prev" onclick="prev()" title="<?php echo $texts[$lang]["previous"] ?>"></div>
			<div class="controlsX" id="next" onclick="next()" title="<?php echo $texts[$lang]["next"] ?>"></div>
			<div class="controlsY" id="uparrow" onclick="up()" title="<?php echo $texts[$lang]["up"] ?>"></div>
			<div class="controlsY" id="downarrow" onclick="down()" title="<?php echo $texts[$lang]["down"] ?>"></div>
		</div>
		<div class="keyboard"><img src="css/img/keyboard.png"></div>
		<div id="subtitles"></div>
	</body>
</html>