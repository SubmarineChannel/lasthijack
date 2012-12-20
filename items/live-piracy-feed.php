<?php

$itemArray["live-piracy-feed"] = array(
	"popcorn" => '
		popcorn.code({
			start: 0.5,
			end:1000,
			framerate: 20,
      onStart: function(){
        // Hacky globals
        window.livePiracyReportItemListReadyForShow = true;
				if (window.livePiracyReportItemList) {
          window.livePiracyReportItemList.show();
        }
			},
		});
	',
	"content" => '<div id="live-piracy-feed-header"><h1>Live Piracy Report</h1></div><div id="live-piracy-feed-content"></div>',
	"class" => 'live-piracy-feed',
	"css" => '
		#live-piracy-feed > div {
			margin: 0;
			border: 0;
			padding: 0;
			box-sizing: border-box;
		}
		#live-piracy-feed {
			margin: 0;
			border: 0;
			box-sizing: border-box;
			
			position: fixed;
			bottom: 0;
			width:24em;
			height:7.5em;
			right:0;
			display: none;
			
			background:#ccc; 
			opacity:.5;
			padding: 0;
      -moz-border-radius: 4px 0 0 0;
      -webkit-border-radius: 4px 0 0 0;
      border-radius: 4px 0 0 0;
		}
		#live-piracy-feed-header {
			margin-left: 0.625em;
			margin-right: 0.625em;
			margin-top: 0.5em;
			margin-bottom: 0;
			
			position: relative;
			width: 100%;
			height: 1.75em;
			border: 0;
			padding: 0;
			box-sizing: border-box;
		}
		#live-piracy-feed-header > h1 {
			font-size: 1.25em;
			margin: 0;
			border: 0;
			padding: 0;
			box-sizing: border-box;
		}
		#live-piracy-feed-content {
			position: relative;
			overflow: hidden;
			height: 5.5em;
			margin: 0;
			padding: 0;
			border: 0;
			box-sizing: border-box;
			
			margin-left: 0.625em;
			margin-right: 0.625em;
		}
		#live-piracy-feed-item-container {
			position: relative;
			margin: 0;
			padding: 0;
			border: 0;
			height: 9em;
			box-sizing: border-box;
		}
		.live-piracy-feed-item {
			height: 5.5em;
			margin: 0;
			padding: 0;
			border: 0;
			box-sizing: border-box;
		}
		.live-piracy-feed-item-date {
			font-size: 0.5.5em;
			font-style: italic;
			margin: 0;
			padding: 0;
			border: 0;
			box-sizing: border-box;
      display: inline-block;
		}
		.live-piracy-feed-item-location {
			font-size: 0.6em;
			margin: 0;
			padding: 0;
			border: 0;
			box-sizing: border-box;
      display: inline-block;
		}
    .live-piracy-feed-item-excerpt {
			font-size: 0.75em;
      height: 5.5em;
			margin: 0;
			padding: 0;
			border: 0;
			box-sizing: border-box;
		}
		.live-piracy-feed-item-content {
			font-size: 0.75em;
			margin: 0;
			padding: 0;
			border: 0;
			box-sizing: border-box;
      display: none;
		}
	',
	"javascript" => '
(function() {
	// Item in live report item list
	function LivePiracyReportItem(id, data) {
		
		// Reference to the item element
		this.element = $("<div id=\"live-piracy-feed-item-" + id + "\" class=\"live-piracy-feed-item\"></div>");
		// Reference to self
		var _this = this;
		
		this.initialize = function(data) {
			// Obtain date, location and message from given string
			
			//08.12.2012: 1135 LT: Posn: 03:55.1N – 098:47.5E, Belawan Roads, Indonesia.
			var dateSeperatorPos = data.indexOf(":"),
				positionStartPos = data.indexOf("Posn:"),
				breakPos = data.indexOf("<br>");
			
      var excerpt = data.substr(breakPos + 4, 170);
			var date = data.substring(0, dateSeperatorPos),
				position = data.substring(positionStartPos + 5, data.indexOf(",")),
				location = data.substring(data.indexOf("Posn:", data.indexOf(",")), breakPos),
        excerpt = excerpt.substr(0, excerpt.lastIndexOf(" ")) + "...",
				content = data.substring(breakPos + 4);
			
			// Update location
			location = location.substr(location.indexOf(",") + 2);
			
			// Check position starts with a number (position is invalid if no numerical data found)
			if (isNaN(position.substr(0, 2))) {
				location = position + ", " + location;
				position = "";
			}
			
			// Create and append the elements
			//_this.element.append("<div class=\"live-piracy-feed-item-date\">" + date + "</div>");
			_this.element.append("<div class=\"live-piracy-feed-item-location\">" + location + "</div>");
      _this.element.append("<div class=\"live-piracy-feed-item-excerpt\">" + excerpt + "</div>");
			_this.element.append("<div class=\"live-piracy-feed-item-content\">" + content + "</div>");
		};
		
		// Initialize ourselves
		this.initialize(data);
    
    // Add click event handler
	}
	
	// Live report list
	function LivePiracyReportItemList() {
		
		// Container element for the items
		this.container = null;
		// List of items
		this.items = [];
		this.itemIndex = 0;
    
    this.initialized = false;
		
		// Reference to self
		var _this = this;
		
		this.initialize = function() {
			var elements = $("#live-piracy-feed-content td.jos_fabrik_icc_ccs_piracymap2012___narrations");
			
			// Clear html & add container for items
			$("#live-piracy-feed-content").html("");
			$("#live-piracy-feed-content").append("<div id=\"live-piracy-feed-item-container\"></div>");
			_this.container = $("#live-piracy-feed-item-container");
			
			// Create the items
			for (var i = elements.length - 1; i > -1; i--) {
				_this.items.push(new LivePiracyReportItem(i, $(elements[i]).html()));
			}
			
			// Append the items
			for (var i = 0; i < _this.items.length; i++) {
				_this.container.append(_this.items[i].element);
			}
			
      _this.initialized = true;
      if (window.livePiracyReportItemListReadyForShow === true) {
        _this.show();
      }
		};
		
		this.show = function() {
      if (!_this.initialized) {
        return;
      }
			// Show
			// Move list up
			$("#live-piracy-feed").slideDown(350);
		};
		
		this.moveNext = function() {
			// Wait for n seconds
			setTimeout(function() {
				// Move container number of pixels up of the current item
				_this.container.animate({
						top: "-=5.5em"
					},
					350,
					_this.moveNextComplete()
				);
			}, 10000);
		};
		
		this.moveNextComplete = function() {
			// Move top item to bottom
			var itemToMove = _this.items[_this.itemIndex++];
			if (_this.itemIndex >= _this.items.length) {
				_this.itemIndex = 0;
			}
			
			itemToMove.element.remove();
			_this.container.append(itemToMove.element);
			
			_this.container.css("top", 0);
			_this.moveNext();
		};
		
		// Initialize and start
		this.initialize();
		this.moveNext();
	}
	
	// Start load when document is ready
	$("document").ready(function() {
		// Load live piracy report data
		$("#live-piracy-feed-content").load("live-piracy-report.php table.fabrikList", function(response, status, xhr) {
			if (status != "error") {
				// Create the list of items
        // Hacky globals
				window.livePiracyReportItemList = new LivePiracyReportItemList();
			}
		});
	});
})();
	'
);
