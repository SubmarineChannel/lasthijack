var sides = ["up", "down"];
var side = 0;
var uplevel = 0;
var downlevel = 0;
var fullscreen = false;
var animationTime = 700;
var popcornVideos = [];
var animating = false;
var curChapter;
var playedVids = [];
var schemeNumber = 0;
var followScheme = true;
var isMobile = navigator.userAgent.match(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i) != null;

var videos,canvass,contexts,video,videoWidth,videoHeight,tempImgEl, tempImgEl1, tempImgEl2, activeVideo, ext;

if (Modernizr.video) {
	if (Modernizr.video.h264) {
		ext = "mp4";
	} else if (Modernizr.video.webm) {
		ext = "webm";
	} else if (Modernizr.video.ogg){
		ext = "ogg";
	}
	console.log("browser supports "+ext);
} else {
	alert("browser does not support HTML video");
}

function browserIsCompatible(){
	if (!Modernizr.video || !Modernizr.canvas || !Modernizr.csstransforms || !Modernizr.csstransitions || !Modernizr.backgroundsize || isMobile){
		return false;
	} else {
		return true;
	}
}
if(!browserIsCompatible()){
	location.href = "alternative.html";
}

function setVideoPosition(){
	$("video").each(function(){
		videoWidth = $(this).width();
		videoHeight = $(this).height();
		$(this).css("margin-left", (videoWidth/2)*-1);
		$(this).css("margin-top", (videoHeight/2)*-1);
		updateProgress($(this));
	});
}

//update the progress bar inside the active block
function updateProgress(el){
	var updown = el.attr("id");
	var pos = eval(updown+"level");
	var x = (updown=="up")?-5:5;
	var activeEl = $(".active").find("."+updown+pos)
	if(activeEl.length){
		var w = activeEl.width();
		var h = activeEl.height();
		var position = activeEl.position();
		var l = position.left;
		var t =  position.top + x;
		var time = el[0].currentTime;
		var duration = el[0].duration;
		var percentage = (time/duration)*100;
		var progress = (w/100)*percentage;
		var id = "vidprogress"+updown;
		$('#'+id).css({
			left: l,
			top: t
		});
		$('#'+id).width(progress);
	}
}

function loadVid(s, vidURL){			
	var myVideo = document.getElementById(sides[s]);
	var url = 'video/'+vidURL+'.'+ext;
	var poster = 'video/firstframes/'+vidURL+'.jpg';
	myVideo.src = url;
	myVideo.setAttribute('poster',poster);
	myVideo.load();
}

function vidSwap(s, vidURL){
	side = s;
	loadVid(s, vidURL);
	var myVideo = document.getElementById(sides[s]);
	playVid(myVideo);
}

function playVid(ele){
	var level = (side==0)?uplevel:downlevel;
	var vidURL = parts[active][sides[side]][level];	
	activeVideo = vidURL;
	setSubtitles(vidURL);
	$("video").not(ele).get(0).pause();
	$("video").not(ele).removeClass("playing").addClass("notplaying");
	$(ele).get(0).play();
	$(ele).removeClass("notplaying").addClass("playing");
}

function markPlayed(){
	for(i in playedVids){
		//console.log(playedVids[i]);
		$("#"+playedVids[i]).addClass("played");
	}
}

//highlight chapter i
function highlightPart(i){
	$(".part.active").removeClass("active");
	$("#uptrack").find(".part").eq(i).addClass("active");
	$("#downtrack").find(".part").eq(i).addClass("active");
}

//previous chapter
function prev(followPath){
	if(active>0 && !animating){
		showHideLoader(true);
		var level = (side==0)?uplevel:downlevel;
		playedVids.push(sides[side]+level+active);
		markPlayed();
		active--;		
		//side = (followPath)?scheme[active][0]:side;
		level = (side==0)?uplevel:downlevel;
		//level = (followPath)?scheme[active][1]:availableIndex(active, side, level);
		level = availableIndex(active, side, level);
		prevNextScene("prev", active, level);
		
		if(side==0){
			uplevel=level;
			downlevel=0;
			if(!fullscreen && uplevel > 0)fullScreen();
		}
		if(side==1){
			downlevel=level;
			uplevel=0;
			if(!fullscreen && downlevel > 0)fullScreen();
		}
		if(fullscreen)fullscreen=false;fullScreen();
		
		highlightPart(active);
		vidSwap(side, parts[active][sides[side]][level]);
		loadOther();
		showHideControls(fullscreen);
	}
}

//next chapter
function next(followPath){
	if(active<(Object.size(parts)-1) && !animating){
		showHideLoader(true);
		var level = (side==0)?uplevel:downlevel;
		playedVids.push(sides[side]+level+active);
		markPlayed();
		active++;
		//side = (followPath)?scheme[active][0]:side;
		level = (side==0)?uplevel:downlevel;
		//level = (followPath)?scheme[active][1]:availableIndex(active, side, level);
		level = availableIndex(active, side, level);
		prevNextScene("next", active, level);
		if(side==0){
			uplevel=level;
			downlevel=0;
			if(!fullscreen && uplevel > 0)fullScreen();
		} else {
			downlevel=level;
			uplevel=0;
			if(!fullscreen && downlevel > 0)fullScreen();
		}
		if(fullscreen)fullscreen=false;fullScreen();
		
		highlightPart(active);
		vidSwap(side, parts[active][sides[side]][level]);
		loadOther();
		showHideControls(fullscreen);
	}
}

//load the other video that's not on the active side
function loadOther(){
	var s = (side-1)*(side-1);
	loadVid(s, parts[active][sides[s]][0]);
}

function up(){
	if(!animating){
		showHideLoader(true);
		var pos = (side == 0)?uplevel:downlevel;
		playedVids.push(sides[side]+pos+active);
		markPlayed();
		if(side==0 && fullscreen){				
			var vid = parts[active][sides[side]][pos+1];
			if(vid != undefined){
				goToVideo(side, vid, pos+1, active);
			}
		} else if(side==1 && pos > 0){
			var vid = parts[active][sides[side]][pos-1];
			if(vid != undefined){
				goToVideo(side, vid, pos-1, active);
			}
		} else if(side==1 && pos == 0 && fullscreen) {
			fullScreen();
		} else if(side==1 && pos == 0 && !fullscreen){
			side = 0;
			uplevel=0;
			downlevel=0;
			fullScreen();	
			var myVideo = document.getElementById(sides[side]);
			playVid(myVideo);
		} else if(side==0 && pos == 0 && !fullscreen){
			uplevel=0;
			downlevel=0;
			fullScreen();	
			var myVideo = document.getElementById(sides[side]);
			playVid(myVideo);
		}
	}
}

function down(){
	if(!animating){
		showHideLoader(true);
		var pos = (side == 0)?uplevel:downlevel;
		playedVids.push(sides[side]+pos+active);
		markPlayed();
		if(side==1 && fullscreen){
			var vid = parts[active][sides[side]][pos+1];
			if(vid != undefined){
				goToVideo(side, vid, pos+1, active);
			}
		} else if(side==0 && pos > 0){
			var vid = parts[active][sides[side]][pos-1];
			if(vid != undefined){
				goToVideo(side, vid, pos-1, active);
			}
		} else if(side==0 && pos == 0 && fullscreen) {
			fullScreen();
		} else if(side==0 && pos == 0 && !fullscreen){
			side = 1;
			uplevel=0;
			downlevel=0;
			fullScreen();	
			var myVideo = document.getElementById(sides[side]);
			playVid(myVideo);
		} else if(side==1 && pos == 0 && !fullscreen){
			uplevel=0;
			downlevel=0;
			fullScreen();	
			var myVideo = document.getElementById(sides[side]);
			playVid(myVideo);
		}
	}
}

function playPause(){
	var vid = $('#'+sides[side]).get(0);
	if (vid.paused === false) {
        vid.pause();
    } else {
        vid.play();
    }
}

function chapterTitle(cc){
	if(cc != curChapter){
		//show something maybe?
		//$("#chaptertitle").show().stop(true, true).fadeIn(1).html(chapterTitles[cc]).fadeOut(5000);
		curChapter = cc;
	}
}

function goToVideo(s, vid, pos, i){	
	side = s;
	var cc = $("#"+sides[s]+pos+i).parent().attr("chapter");
	chapterTitle(cc);
	
	playedVids.push(sides[s]+pos+i);
	markPlayed();
	
	$('.tooltip').tooltipster('hide');
	if(active==i&&((s==0&&pos>uplevel)||(s==1&&pos<downlevel)))changeVideo("up");
	if(active==i&&((s==0&&pos<uplevel)||(s==1&&pos>downlevel)))changeVideo("down");
	if(i>active)prevNextScene("next", i, pos);
	if(i<active)prevNextScene("prev", i, pos);
	
	if(s==1)downlevel=pos;
	if(s==0)uplevel=pos;
	
	highlightPart(i);
	if(activeVideo != vid){
		vidSwap(s, vid);
	} else {
		playPause();
	}
	
	if(active!=i){		
		active=i;
		loadOther();
		//setMarker(fullscreen);
		showHideControls(fullscreen);
	}
	fullscreen = false;
	fullScreen();
}

function recalculate(){
	setVideoPosition();
	itemWidth = $("body").width();
}

function availableIndex(p, s, i){	
	if(parts[p][sides[s]][i] != undefined){
		return i;
	} else {
		return availableIndex(p, s, i-1);
	}
}

function fullScreen(){
	if(!fullscreen){
		if(side==0){
			$("#progress").css({top: "90%"});
			$("#upwrap").css({height: "90%"});
			$("#downwrap").css({height: "10%"});
			fullscreen = true;
		} else {
			$("#progress").css({top: "10%"});
			$("#upwrap").css({height: "10%"});
			$("#downwrap").css({height: "90%"});
			fullscreen = true;
		}
	} else {
		$("#progress").css({top: "50%"});
		$("#upwrap").css({height: "50%"});
		$("#downwrap").css({height: "50%"});
		fullscreen = false;
	}
	var level = (side==0)?uplevel:downlevel;
	playedVids.push(sides[side]+level+active);
	markPlayed();
	setMarker(fullscreen);
	showHideControls(fullscreen);
}

//set background image of next screen
function setBgImg(imgUrl,axis,plusmin){
	tempImgEl.css('background-image', 'url('+imgUrl+')');
	animateSnapshot(axis, plusmin, $("#"+sides[side]+"c"), $("#"+sides[side]+"cwrap"));
}

//snap video and load image of next screen
function changeVideo(updown){
	snapVideo(videos[side], canvass[side], contexts[side], sides[side]);

	var level = (side==0)?uplevel:downlevel;
	var addSub = ((updown=="up"&&side==0)||(updown=="down"&&side==1))?1:-1;
	var topbottom = (updown == "up")?"top":"bottom";
	tempImgEl = $("#"+sides[side]+"c"+topbottom);
	var plusmin = (updown == "up")?"+":"-";
	$("<img id='loaderImg' src='video/firstframes/"+parts[active][sides[side]][level+addSub]+".jpg' onload='setBgImg(this.src, \"v\", \""+plusmin+"\")'/>");
}

//create a snapshot of a video and put it in a canvas element on top of the video
function snapVideo(videoEl, canvasEl, contextEl, s){
	var w = $("#"+s).width();
	var h = $("#"+s).height();
	
	var vw = videoEl.videoWidth;
	var vh = videoEl.videoHeight;
	var teller = 0;
	canvasEl.width = vw;
	canvasEl.height = vh;
	contextEl.fillRect(0, 0, vw, vh);
	contextEl.drawImage(videoEl, 0, 0, vw, vh);
	$("#"+s+"c").css({
		width: w,
		height: h,
		marginLeft: -1*w/2,
		marginTop: -1*h/2
	});
	$("#"+s+"cwrap").css({
		width: w,
		height: h,
		marginLeft: -1*w/2,
		marginTop: -1*h/2
	});
}

var upLoaded = false;
var downLoaded = false;

//start animation when both up and down image are loaded
function checkBothLoaded(side, imgUrl, axis, plusmin){
	if(side=="up"){
		upLoaded=true;
		tempImgEl1.css('background-image', 'url('+imgUrl+')');
	}
	if(side=="down"){
		downLoaded=true;
		tempImgEl2.css('background-image', 'url('+imgUrl+')');
	}
	if(upLoaded&&downLoaded){				
		animateSnapshot(axis, plusmin, $("#upc, #downc"), $("#upcwrap, #downcwrap"));
		upLoaded = false;
		downLoaded = false;
	}
}

//make snapshot of video and load images of next screen, when images are loaded, call checkBothLoaded
function prevNextScene(prevnext, newIndex, level){
	var plusmin = (prevnext == "prev")?"+":"-";
	var addSub = (prevnext == "prev")?-1:1;
	if(typeof newIndex === 'undefined'){
		newIndex=active+addSub;
	}
	var leftright = (prevnext == "prev")?"left":"right";
	
	snapVideo(videos[0], canvass[0], contexts[0], sides[0]);
	snapVideo(videos[1], canvass[1], contexts[1], sides[1]);
	
	tempImgEl1 = $("#"+sides[0]+"c"+leftright);
	tempImgEl2 = $("#"+sides[1]+"c"+leftright);
	if((typeof level === 'undefined')){
		var upindex = (scheme[newIndex][0] == 0)?scheme[newIndex][1]:0;
	} else if(typeof level !== 'undefined' && side==0) {
		var upindex = level;
		var downindex = 0;
	}
	if((typeof level === 'undefined')){
		var downindex = (scheme[newIndex][0] == 1)?scheme[newIndex][1]:0;
	} else if(typeof level !== 'undefined' && side==1) {
		var upindex = 0;
		var downindex = level;
	}
	$("<img id='loaderImg1' src='video/firstframes/"+parts[newIndex][sides[0]][upindex]+".jpg' onload='checkBothLoaded(\"up\", this.src, \"h\", \""+plusmin+"\")'/>");
	$("<img id='loaderImg2' src='video/firstframes/"+parts[newIndex][sides[1]][downindex]+".jpg' onload='checkBothLoaded(\"down\", this.src, \"h\", \""+plusmin+"\")'/>");
}

//slide the canvas element out of the screen
function animateSnapshot(axis, plusmin, el, elani){
	animating = true;
	var w = el.width();
	var h = el.height();
	elani.css({
		width: w,
		height: h,
		marginLeft: -w/2,
		marginTop: -h/2
	});
	
	//css3 animation
	if(axis == "h"){
		elani.show().animate({"transform": 'translateX('+plusmin+w+'px)'},animationTime,function(){
			animating = false;
		});
	} else {
		elani.show().animate({"transform": 'translateY('+plusmin+h+'px)'},animationTime,function(){
			animating = false;
		});
	}
}

function showHideLoader(show){
	$('.spinner').toggle(show);
}

function hideCWrappers(){
	if(animating == false){
		$('#upcwrap, #downcwrap').hide().css({"transform": 'translateX(0px) translateY(0px)'});
		showHideLoader(false);
	} else {
		setTimeout(hideCWrappers, 100);
	}
}

function setMarker(f){
	var partwidth = $(".part").not(".active").width();
	var blockheight = 25;
	var l = partwidth*active;
	var t = (side==0)?(blockheight*(uplevel+1)*-1):(blockheight*downlevel)+14;
	var h = 22;
	if(!f){
		t=-13;
		h=36;
	}
	$("#marker").animate({
		left: l,
		top: t,
		height: h
	}, animationTime);
}

function showHideControls(f){
	$("#next").toggle(active<(Object.size(parts)-1));
	$("#prev").toggle(active>0);
	$("#uparrow").toggle(side==1 || !f || uplevel<parts[active]["up"].length-1);
	$("#downarrow").toggle(side==0 || !f || downlevel<parts[active]["down"].length-1);
}

Object.size = function(obj) {
	var size = 0, key;
	for (key in obj) {
		if (obj.hasOwnProperty(key)) size++;
	}
	return size;
};

$(document).keydown(function(e){
	//if(keyFunctions[e.keyCode] != undefined)eval(keyFunctions[e.keyCode]+"()");
	//keys with their corresponding functions
	if(e.keyCode==39)next();
	if(e.keyCode==37)prev();
	if(e.keyCode==38)up();
	if(e.keyCode==40)down();
});

function nextScheme(){
	$("#"+scheme[schemeNumber]).click();
	schemeNumber++;
}

$(document).ready(function(){
	videos = [document.getElementById('up'), document.getElementById('down')];
	canvass = [document.getElementById('upc'), document.getElementById('downc')];
	contexts = [canvass[0].getContext('2d'), canvass[1].getContext('2d')];
	
	setInterval(setVideoPosition, 200);
	itemWidth = $("body").width();
	$("video").click(function(){
		side = $("video").index($(this));
		fullscreen = false;
		fullScreen();	
		playVid(this);
	});
	setVideoPosition();
	loadOther();
	loadVid(side, parts[active][sides[side]][0]);
	
	//vidSwap(side, parts[active][sides[side]][level]);
	
	setMarker(fullscreen);
	showHideControls(fullscreen);
	$("video").bind('ended', function(){
		//next(true);
		if(followScheme){
			if(scheme[schemeNumber] != undefined){
				nextScheme();
			} else {
				//end
			}
		} else {
			next(true);
		}
	});
	$('video').bind('play', function(e) {
		hideCWrappers();
	});
	$('video').bind('timeupdate', function(e) {
		hideCWrappers();
	});
	$('#marker').click(function(){
		playPause();
	});
	$('.chapter').click(function(){
		var chap = $(".chapter").index(this);
		var a = $('.part').index($('[chapter='+chap+']'));
		var s = scheme[a][0];
		var p = scheme[a][1];
		var vid = parts[a][sides[s]][p];
		if(vid != undefined){
			goToVideo(s, vid, p, a);
		}
	});
	
	$('.tooltipup').tooltipster({
		touchDevices: false,
		delay: 500
	});
	$('.tooltipdown').tooltipster({
		touchDevices: false,
		delay: 500,
		position: "bottom"
	});
	$('.chapter').tooltipster({
		touchDevices: false,
		delay: 500
	});
	
	var spinopts = {
		color: '#fff',
		shadow: true,
		radius: 50,
		lines: 20,
		length: 10,
		width: 5
	}
	
	var spinner = new Spinner(spinopts).spin(document.getElementById('videos'));
	preloadThumbs();
	
	nextScheme();
});

Popcorn( function(){
	popcornVideos[0] = Popcorn("#up");
	popcornVideos[1] = Popcorn("#down");
});

$(window).resize(function() {
	recalculate();
});