<?php
	$itemArray["logos"] = array(
		"popcorn" => '
			popcorn.code({
				start: 5,
				end: 250,
				onStart: function( options ) {
					$("#logos").slideDown(1000);
				},
				onEnd: function(){
					$("#logos").slideUp(1000);
				}
			});
		',
		"content" => '<div class="logo"><a href="http://www.submarinechannel.com"><img src="images/logos/channel.png"/></a></div>
      <div class="logo"><a href="http://www.ikonrtv.nl/"><img src="images/logos/ikon.png"/></a></div>
      <div class="logo"><a href="http://www.zdf.de/"><img src="images/logos/zdf.png"/></a></div>
      <div class="logo"><img src="images/logos/npo.png"/></div>',
		"class" => "logos",
		"css" => '
      #logos {
        width:320px;
        height: 32px;
        position: absolute;
        top: 1em;
        right: 1em;
      }
      div.logo {
        display: inline-block;
        margin-right: 30px;
      }
      div.logo:last-child {
        margin-right: 0;
      }
    ',
		"javascript" => '
			
		'
	);
?>