<?php
header('Content-Type: application/javascript');
$subtitles = array(
	/*
	array(
		"lh" => array(
			array(1,2,"hoi"),
			array(3,5,"ik ben mohammed"),
			array(6,15,"..."),
			array(16,20,"ok"),
			array(21,25,"doei")
		),
		"voorbeeld_Animaties" => array(
			array(1,2,"hoi2"),
			array(3,5,"ik ben mohammed2"),
			array(6,15,"...2"),
			array(16,20,"ok2"),
			array(21,25,"doei2")
		)
	),
	array(
		"last" => array(
			array(1,2,"hoi3"),
			array(3,5,"ik ben mohammed3"),
			array(6,15,"...3"),
			array(16,20,"ok3"),
			array(21,25,"doei3")
		),
		"voorbeeld_Animaties2" => array(
			array(1,2,"hoi!"),
			array(3,5,"ik ben mohammed.."),
			array(6,15,"....."),
			array(16,20,"ok,"),
			array(21,25,"doei!")
		)
	)
	*/
);

echo '
function setSubtitles(vid){
';
foreach($subtitles as $side => $sidesubs){
	foreach($sidesubs as $video => $subtitle){
		echo '		
			if(vid == "'.$video.'"){
		';
		foreach($subtitle as $val){
			echo '
				popcornVideos['.$side.'].code({
					start: '.$val[0].',
					end: '.$val[1].',
					onStart: function() {
						$("#subtitles").html("'.$val[2].'");
					},
					onEnd: function(){
						$("#subtitles").html("");
					}
				});
			';
		}
		echo '
			}
		';
	}
}
echo '
}
';