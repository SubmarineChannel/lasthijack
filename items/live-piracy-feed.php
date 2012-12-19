<?php

$itemArray["live-piracy-feed"] = array(
	"popcorn" => '
		popcorn.timeline({
			start: 0.1,
			end:1000,
			framerate: 20
		});
	',
	"content" => '',
	"class" => 'live-piracy-feed',
	"css" => '
		#live-piracy-feed {
			position: fixed;
			bottom: 0;
			width:32em;
			height:9em;
			right:0;
			display: none;
			overflow: hidden;
		}
		#live-piracy-feed-container {
			position: relative;
			background:#ccc; 
			opacity:.5;
			border-bottom-width: 0px ;
			padding: 1.25em 1.25em 6.25em 1.25em;
		}
		.live-piracy-feed-item {
			height: 7.75em;
			margin-bottom: 1.25em;
		}
		.live-piracy-feed-item-date {
			font-size: 0.6em;
			font-style: italic;
		}
		.live-piracy-feed-item-location {
			font-size: 0.6em;
		}
		.live-piracy-feed-item-content {
			font-size: 0.75em;
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
			
			var date = data.substring(0, dateSeperatorPos),
				position = data.substring(positionStartPos + 5, data.indexOf(",")),
				location = data.substring(data.indexOf("Posn:", data.indexOf(",")), breakPos),
				content = data.substring(breakPos + 4);
			
			// Update location
			location = location.substr(location.indexOf(",") + 2);
			
			// Check position starts with a number (position is invalid if no numerical data found)
			if (isNaN(position.substr(0, 2))) {
				location = position + ", " + location;
				position = "";
			}
			
			// Create and append the elements
			_this.element.append("<div class=\"live-piracy-feed-item-date\">" + date + "</div>");
			_this.element.append("<div class=\"live-piracy-feed-item-location\">" + location + "</div>");
			_this.element.append("<div class=\"live-piracy-feed-item-content\">" + content + "</div>");
		};
		
		// Initialize ourselves
		this.initialize(data);
	}
	
	// Live report list
	function LivePiracyReportItemList() {
		
		// Container element for the items
		this.container = null;
		// List of items
		this.items = [];
		this.itemIndex = 0;
		
		// Reference to self
		var _this = this;
		
		this.initialize = function() {
			var elements = $("#live-piracy-feed td.jos_fabrik_icc_ccs_piracymap2012___narrations");
			
			// Clear html & add container for items
			$("#live-piracy-feed").html("");
			$("#live-piracy-feed").append("<div id=\"live-piracy-feed-container\"></div>");
			_this.container = $("#live-piracy-feed-container");
			
			// Create the items
			for (var i = elements.length - 1; i > -1; i--) {
				_this.items.push(new LivePiracyReportItem(i, $(elements[i]).html()));
			}
			
			// Append the items
			for (var i = 0; i < _this.items.length; i++) {
				_this.container.append(_this.items[i].element);
			}
			
			_this.show();
		};
		
		this.show = function() {
			// Show
			//$("#live-piracy-feed").css("display", "block");
			// Move list up
			$("#live-piracy-feed").slideDown(350);
		};
		
		this.moveNext = function() {
			// Wait for n seconds
			setTimeout(function() {
				// Move container number of pixels up of the current item
				_this.container.animate({
						top: "-=9em"
					},
					350,
					_this.moveNextComplete()
				);
			}, 30000);
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
		$("#live-piracy-feed").load("live-piracy-report.php table.fabrikList", function(response, status, xhr) {
			if (status != "error") {
				// Create the list of items
				new LivePiracyReportItemList();
			}
		});
	});
})();
	'
);