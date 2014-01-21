<?php
function removeExt($filename){
	$filename = basename($filename);
	return preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
}

function whatSideIsThisVidOn($parts, $vid){	

	foreach($parts as $chapter){
		foreach($chapter as $part){
			foreach($part as $updown => $vids){
				foreach($vids as $val){
					if($val == $vid)return $updown;
				}
			}
		}
	}
	return false;
}

function subTimeToSeconds($time){
	$timeArr = explode(":",$time);
	$time = $timeArr[0]*3600 + $timeArr[1]*60 + $timeArr[2];
	return $time;
}