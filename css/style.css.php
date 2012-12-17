<?php
header('Content-type: text/css');
?>
html, body{margin:0px; padding:0px; width:100%; height:100%;}
body{overflow:hidden;}
#test1, #cvs{position:absolute; left:0px; top:0px; font-size:50px;}
#cvs{display:none}
#cvs2{position:absolute; bottom:0px; left:0px;}
#myCanvas{position:absolute; bottom:0px; opacity:.3; display:none}
#container{position:relative; width:100%; height:100%; overflow:hidden;}
video{position:absolute; min-width:100%; min-height:100%; left:50%; top:50%}
#bag{position:absolute; left:20px; top:20px;}
#menu{width:100%; position:absolute; left:0px; top:10px; display:none}
td{text-align:center}
.item{position:absolute; left:50%; top:50%; display:none}
<?php
$itemArray = array();
foreach (glob("../items/*.php") as $filename){
	include $filename;
}
foreach($itemArray as $key => $var){
	if(isset($var['css']))echo $var['css'];
}
?>