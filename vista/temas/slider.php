	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
	<script async src="https://www.youtube.com/iframe_api"></script>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

<style class="cp-pen-styles">
@import url('https://fonts.googleapis.com/css?family=Roboto');

/*Background*/
aside { 
  box-sizing: border-box; 
}
.video-background {
  background: #000;
  position: fixed;
  top: 0; right: 0; bottom: 0; left: 0;
  z-index: -99;
}
#video-foreground, .video-background iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
}

@media (min-aspect-ratio: 16/9) {
  #video-foreground { height: 300%; top: -100%; }
}
@media (max-aspect-ratio: 16/9) {
  #video-foreground { width: 300%; left: -100%; }
}

/*Content*/
aside h1, aside p, aside i {
  color: white;
}
aside p {
  font-family: 'Roboto', sans-serif;
  font-size: 16px;
}
aside h1 {
  	font-size: 50px;
	/*  font-family: 'Roboto', sans-serif;
  	font-weight: 600;*/
  	text-transform: uppercase;
	margin: 0px;
}
aside .main-content {
  margin-top: 15%;
}

aside {
  margin-bottom: 25px;
}
aside path {
    color: white;
}
.video-informacion {
    width: 100%;
    background: rgba(0,0,0,0.3);
    height: 450px;
    margin-bottom: -25px;
}
.informacion {
    width: 100%;
    max-width: 1080px;
    margin: 0 auto;
}
.detalles {
    text-align: center;
    padding-top: 20%;
}
.detalles button {
    background: transparent;
    border: 1px solid white;
    padding: 10px;
    font-size: 16px;
    background-color: rgba(255, 255, 255, 0.3);
}
</style>

	<div class="video-background">
		<div id="video-foreground" class="mute"></div>
	</div>
	<div class="video-informacion">
		<div class="informacion">
			<div class="detalles">
				<h1>Anegociar Peru!</h1>
				<p>Una plataforma donde encontraras todo lo que nesecites en un solo lugar.</p>
				<p>
				<button>
					<i class="fas fa-mouse-pointer"></i>
					<a href="crear_anuncio" style="color: white">Vender Ahora</a>
				</button>
				</p>
				<span class="fa-stack fa-lg sound">
				  <i class="far fa-circle fa-stack-2x"></i>
				  <i class="fas fa-volume-off fa-stack-1x volume-icon"></i>
				</span>
				<a href="https://web.facebook.com/groups/186395021952068/" target="_blank">
				<span class="fa-stack fa-lg">
			  		<!-- <i class="fa fa-circle-o fa-stack-2x"></i> -->
			  		<i class="far fa-circle fa-stack-2x"></i>
			  		<i class="fab fa-facebook-f fa-stack-1x"></i>
				</span>
				</a>
				<a href="https://www.youtube.com" target="_blank">
					<span class="fa-stack fa-lg">
				  		<i class="far fa-circle fa-stack-2x"></i>
				  		<i class="fab fa-youtube-square fa-stack-1x"></i>
					</span>								
				</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var player; 
		function onYouTubeIframeAPIReady() {
		  player = new YT.Player('video-foreground', {
		    videoId: 'q8oQiC2lScA', // YouTube Video ID
		    playerVars: {
		      autoplay: 1,        // Auto-play the video on load
		      controls: 1,        // Show pause/play buttons in player
		      showinfo: 0,        // Hide the video title
		      modestbranding: 1,  // Hide the Youtube Logo
		      loop: 1,            // Run the video in a loop
		      fs: 0,              // Hide the full screen button
		      cc_load_policy: 0, // Hide closed captions
		      iv_load_policy: 3,  // Hide the Video Annotations
		      autohide: 0,         // Hide video controls when playing
		      playlist: 'q8oQiC2lScA'
		    },
		    events: {
		      onReady: function(e) {
		        e.target.mute();
		      }
		    }
		  });
		}

		$(document).ready(function(e) {   
		  $('.sound').on('click', function(){
		    $('#video-foreground').toggleClass('mute');
		    $('.volume-icon').toggleClass('fas fa-volume-up', 'fas fa-volume-off');
		    if($('#video-foreground').hasClass('mute')){
		      player.mute();
		    } else {
		      player.unMute();
		    }
		  });
		});

	</script>