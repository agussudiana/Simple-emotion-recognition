<!doctype html>
<html lang="en">
	<head>
		<title>Emotion Detection</title>
		<meta charset="utf-8">
		<link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<style>
			@import url(https://fonts.googleapis.com/css?family=Lato:300italic,700italic,300,700);
			
			body {
				font-family: 'Lato';
				background:url(styles/img/bg-footer-noise.jpg) repeat;
				margin: 0px auto;
				overflow:hidden;
	
			}
			header{
			background:url(styles/img/nav-bg.png) repeat-x;
			height:50px;
			width:auto;
			padding-top:5px;
			
			
			}
			footer{
			
			
			background:url(styles/img/nav-bg.png) repeat-x;
			height:45px;
			width:auto;
			padding:2px;
			margin-top:5px;
			
			
			
			
		
			
			}
			#overlay {
				position: absolute;
				top: 0px;
				left: 0px;
				-o-transform : scaleX(-1);
				-webkit-transform : scaleX(-1);
				transform : scaleX(-1);
				-ms-filter : fliph; /*IE*/
				filter : fliph; /*IE*/
				
				
			}
				#imgfile {
				position: absolute;
				top: 0px;
				left: 0px;
				-o-transform : scaleX(-1);
				-webkit-transform : scaleX(-1);
				transform : scaleX(-1);
				-ms-filter : fliph; /*IE*/
				filter : fliph; /*IE*/
			
				z-index:-1;
			}
			#model {
			   
				top: 0px;
				left: 0px;
				-o-transform : scaleX(1.5) scaleY(1);
				-webkit-transform : scaleX(1.5)  scaleY(1);
				transform : scaleX(1.5)  scaleY(1);
				-ms-filter : fliph; /*IE*/
				filter : fliph; /*IE*/
				margin-left:100px;
				
				
				
			}

			#videoel {
				-o-transform : scaleX(-1);
				-webkit-transform : scaleX(-1);
				transform : scaleX(-1);
				-ms-filter : fliph; /*IE*/
				filter : fliph; /*IE*/
				
				
			}
			
			#container {
				position : relative;
				width : 400px;
				margin : 0px 20px;
				background:#000000;
				
				height:300px;
				float:left;
				
			}
			#fpsmeter{
				position : relative;
				width : 140px;
				margin-top:-8px;
				background:#000000;
				
				
				float:left;
				
			}
			
			#content1 {
			border-right:2px solid #333333;
				width:700px;
				padding:30px;
				float:left;
				height:568px;
				
				
				
			}
			#content2 {
			
				width:300px;
				padding:10px;
				padding-left:30px;
				float:left;
				height:568px;
				
			}
			
			#sketch {
				display: block;
			}
			
			#filter {
				display: none;
			}
			
		

			.btnarea{
				font-family: 'Lato';
				font-size: 16px;
				text-align:center;
			    margin-left:5px;
				margin-bottom:5px;
				float:left;
				border:1px solid white;
				
				
			}
		
			.btn-file {
  		  position: relative;
   			 overflow: hidden;
			}
			.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: inherit;
			display: block;
			}
			.pmt{
			width:70px;
			margin-bottom:3px;
			
			
			
			}
			
		</style>
		
	</head>
	<body>
		<script src="ext_js/utils.js"></script>
		<script src="ext_js/jsfeat-min.js"></script>
		<script src="ext_js/frontalface.js"></script>
		<script src="ext_js/jsfeat_detect.js"></script>
		<script src="ext_js/numeric-1.2.6.min.js"></script>
		<script src="ext_js/mosse.js"></script>
		<script src="ext_js/left_eye_filter.js"></script>
		<script src="ext_js/right_eye_filter.js"></script>
		<script src="ext_js/nose_filter.js"></script>
		<script src="ext_js/Stats.js"></script>
	 <script src="models/model_pca_20_svm_emotionDetection.js"></script>
		<script src="js/clm.js"></script>
		<script src="js/svmfilter_webgl.js"></script>
		<script src="js/svmfilter_fft.js"></script>
		<script src="js/mossefilter.js"></script>
		<script src="js/emotion_classifier.js"></script>
		<script src="js/emotionmodel.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
	
		<header>
		<h3 style="margin:5px 60px; color:#CCCCCC;"> Emotion Recognition</h3>
		
		
		
		
		</header>
		<div id="content1">
			
			<div id="container">
				<video id="videoel" width="400" height="300" preload="auto" loop>
					
				</video>
			
				<canvas id="overlay" width="400" height="300"></canvas>
				<canvas id="imgfile" width="400" height="300"></canvas>
			</div>
		<div id="btnarea">
		<button style="width:140px; background:url(styles/img/nav-bg.png) repeat-x;"   class="btn btn-success"   disabled="disabled" onClick="startVideo()" id="startbutton">Start Recognition <span class="glyphicon glyphicon-user"></span></button><br clear="right">
		<button style="width:140px; margin:10px 0 0 0; background:url(styles/img/nav-bg.png) repeat-x;"  class="btn btn-danger" disabled="disabled"   onClick="stopVideo()" id="stopvideo">Stop Recognition <span class="glyphicon glyphicon-ban-circle"></span></button>
		
		
		<br clear="right">
		<span class="btn btn-default btn-file" style="width:140px; margin:10px 0 0 0; color:#FFFFFF; background:url(styles/img/nav-bg.png) repeat-x;">Image File <span class="glyphicon glyphicon-picture"></span><input  type="file"  id="files" name="files[]"  ></input></span>
		<br clear="right">
		<button style="width:140px; margin:10px 0 0 0; background:url(styles/img/nav-bg.png) repeat-x;"  class="btn btn-info"  onClick="refreshpage()" id="refresh">Refresh <span class="glyphicon glyphicon-refresh"></span></button>
		
		<br clear="right">
		<p style="color:#FFFFFF; margin-top:63px;">Status :</p>
		   <div id="fpsmeter">
	
		
		   </div>
		
		
			</div>
			<br/>
			<br clear="all"> 
			<h5 style="margin:10px 20px; color:#FFFFFF;">Emotion :</h5>
					<div class="progress" style="width:600px; margin:10px 20px; height:35px">
					<div id="angry" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0"
		  aria-valuemin="10" aria-valuemax="100" style="width:0%; padding-top:5px;">
			
		  </div>
		</div>
		
					<div class="progress" style="width:600px; margin:10px 20px; height:35px">
		  <div id="sad" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0"
		  aria-valuemin="0" aria-valuemax="100" style="width:0%; padding-top:5px;">
			
		  </div>
		</div>
		
					<div class="progress" style="width:600px; margin:10px 20px; height:35px">
		  <div id="surprised" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0"
		  aria-valuemin="0" aria-valuemax="100" style="width:0%; padding-top:5px;">
			
		  </div>
		</div>
		
					<div class="progress" style="width:600px; margin:10px 20px; height:35px">
		  <div id="happy" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
		  aria-valuemin="0" aria-valuemax="100" style="width:0%; padding-top:5px;">
			
		  </div>
		</div>
				
			
			<script>
				var vid = document.getElementById('videoel');
				var overlay = document.getElementById('overlay');
				var overlayCC = overlay.getContext('2d');
				var red = 130;
				var green = 255;
				var blue = 50;
			    
				
				var ctrack = new clm.tracker({useWebGL : true});
				ctrack.init(pModel);
				
				stats = new Stats();
				stats.setMode(0);
				stats.domElement.style.position = 'absolute';
				stats.domElement.style.top = '0px';
				
				stats2 = new Stats();
				stats2.setMode(2);
				stats2.domElement.style.position = 'absolute';
				stats2.domElement.style.left = '90px';
				
				document.getElementById('fpsmeter').appendChild( stats.domElement );
				document.getElementById('fpsmeter').appendChild( stats2.domElement );
				
				
				function enablestart() {
					var startbutton = document.getElementById('startbutton');
					startbutton.value = "Start Recognition";
					startbutton.disabled = null;
				}
				function enableShowModel() {
					var showmodel = document.getElementById('drawmodel');
					showmodel.value = "Show Model";
					showmodel.disabled = null;
				}
					function enableStop() {
					var stopbutton = document.getElementById('stopvideo');
					stopbutton.value = "Stop Recognition";
					stopbutton.disabled = null;
				}
				
			
				navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
				window.URL = window.URL || window.webkitURL || window.msURL || window.mozURL;

				// check for camerasupport
				if (navigator.getUserMedia) {
					// set up stream
				
					var videoSelector = {video : true};
					if (window.navigator.appVersion.match(/Chrome\/(.*?) /)) {
						var chromeVersion = parseInt(window.navigator.appVersion.match(/Chrome\/(\d+)\./)[1], 10);
				
						if (chromeVersion < 20) {
							videoSelector = "video";
						}
					};
				
					navigator.getUserMedia(videoSelector, function( stream ) {
				
						if (vid.mozCaptureStream) {
							vid.mozSrcObject = stream;
						} else {
							vid.src = (window.URL && window.URL.createObjectURL(stream)) || stream;
						}
						vid.play();
					}, function() {});
				} 

				vid.addEventListener('canplay', enablestart, false);
				
				function startVideo() {
				    ctrack.reset();
					overlay.style.transform= "scaleX(-1)";
					// start video
					var imgfile = document.getElementById('imgfile');
					imgfile.style.display="none";
					vid.style.display="inline";
					vid.play();
					// start tracking
					ctrack.start(vid);
					// start loop to draw face
					drawLoop();
				}
				
				function drawLoop() {
				    
					requestAnimFrame(drawLoop);
					overlayCC.clearRect(0, 0, 400, 300);
					modelCC.clearRect(0, 0, 400, 300);
					
                 
					
					 
					var angry = document.getElementById('angry');
					var sad = document.getElementById('sad');
					var surprised = document.getElementById('surprised');
					var happy = document.getElementById('happy');
						var sk = document.getElementById('skor');
					
					
					var cp = ctrack.getCurrentParameters();
					var er = ec.meanPredict(cp);
					
					
					angry.innerHTML = "angry :" + er[0].value.toFixed(1)*100 +"%";
					angry.style.width = er[0].value.toFixed(1)*100 +"%";
					sad.innerHTML = "sad :" +  er[1].value.toFixed(1)*100 +"%";
					sad.style.width = er[1].value.toFixed(1)*100 +"%";
					surprised.innerHTML = "surprised :" +  er[2].value.toFixed(1)*100 +"%";
					surprised.style.width = er[2].value.toFixed(1)*100 +"%";
					happy.innerHTML = "happy :" +  er[3].value.toFixed(1)*100 +"%";
					happy.style.width = er[3].value.toFixed(1)*100 +"%";
					
					enableStop();

                    enableShowModel();
					
					if (ctrack.getCurrentPosition()) {
						ctrack.draw(model,red,green,blue);
					}
					
					var param0 = document.getElementById('param0');
					var param1 = document.getElementById('param1');
					var param2 = document.getElementById('param2');
					var param3 = document.getElementById('param3');
					var param4 = document.getElementById('param4');
					var param5 = document.getElementById('param5');
					var param6 = document.getElementById('param6');
					var param7 = document.getElementById('param7');
					var param8 = document.getElementById('param8');
					var param9 = document.getElementById('param9');
					var param10 = document.getElementById('param10');
					var param11 = document.getElementById('param11');
					var param12 = document.getElementById('param12');
					var param13= document.getElementById('param13');
					var param14 = document.getElementById('param14');
					var param15 = document.getElementById('param15');
					var param16 = document.getElementById('param16');
					var param17 = document.getElementById('param17');
					var param18 = document.getElementById('param18');
					var param19 = document.getElementById('param19');
					var param20 = document.getElementById('param20');
					var param21 = document.getElementById('param21');
					var param22 = document.getElementById('param22');
					var param23 = document.getElementById('param23');
					
					param0.value=cp[0].toFixed(4);
					param1.value=cp[1].toFixed(4);
					param2.value=cp[2].toFixed(4);
					param3.value=cp[3].toFixed(4);
					param4.value=cp[4].toFixed(4);
					param5.value=cp[5].toFixed(4);
					param6.value=cp[6].toFixed(4);
					param7.value=cp[7].toFixed(4);
					param8.value=cp[8].toFixed(4);
					param9.value=cp[9].toFixed(4);
					param10.value=cp[10].toFixed(4);
					param11.value=cp[11].toFixed(4);
					param12.value=cp[12].toFixed(4);
					param13.value=cp[13].toFixed(4);
					param14.value=cp[14].toFixed(4);
					param15.value=cp[15].toFixed(4);
					param16.value=cp[16].toFixed(4);
					param17.value=cp[17].toFixed(4);
					param18.value=cp[18].toFixed(4);
					param19.value=cp[19].toFixed(4);
					param20.value=cp[20].toFixed(4);
					param21.value=cp[21].toFixed(4);
					param22.value=cp[22].toFixed(4);
					param23.value=cp[23].toFixed(4);
					
					
					
				}
				
				document.addEventListener('clmtrackrIteration', function(event) {
					stats.update();
				}, false);
				
				document.addEventListener('clmtrackrIteration', function(event) {
					stats2.update();
				}, false);
				
				function drawModel(){
				
					requestAnimFrame(drawModel);
					overlayCC.clearRect(0, 0, 400, 300);
				
					if (ctrack.getCurrentPosition()) {
						ctrack.draw(overlay,red,green,blue);
						
					}
				
				
				}
				
				function stopVideo(){
					ctrack.stop(vid);	
				
				}
				function refreshpage(){
					
                  location.reload();

				}
				
				
					var ec = new emotionClassifier();
				    ec.init(emotionModel);
				    var emotionData = ec.getBlank();
				
				function loadImage(){
				    ctrack.reset();
				    vid.style.display="none";
					document.getElementById('imgfile').style.display="inline";
					var bgcon = document.getElementById('container');
					bgcon.style.background= "none";
				    var canvas = document.getElementById('imgfile')
					var cc = canvas.getContext('2d');
				    if (fileList.indexOf(fileIndex) < 0) {
						var reader = new FileReader();
						reader.onload = (function(theFile) {
							return function(e) {
								
								var img = new Image();
								img.onload = function() {
									if (img.height > 300 || img.width > 400) {
										var rel = img.height/img.width;
										var neww = 400;
										var newh = neww*rel;
										if (newh > 300) {
											newh = 300;
											neww = newh/rel;
										}
										canvas.setAttribute('width', neww);
										canvas.setAttribute('height', newh);
										cc.drawImage(img,0,0,neww, newh);
									} else {
										canvas.setAttribute('width', img.width);
										canvas.setAttribute('height', img.height);
										cc.drawImage(img,0,0,img.width, img.height);
									}
								}
								img.src = e.target.result;
							};
						})(fileList[fileIndex]);
						reader.readAsDataURL(fileList[fileIndex]);
						
						ctrack.start(document.getElementById('imgfile'));
						overlay.style.transform= "scaleX(1)";
						drawLoop();
					   
					  
						
															}
				
				
				}
				var fileList, fileIndex;
				if (window.File && window.FileReader && window.FileList) {
					function handleFileSelect(evt) {
						var files = evt.target.files;
						fileList = [];
						for (var i = 0;i < files.length;i++) {
							if (!files[i].type.match('image.*')) {
								continue;
							}
							fileList.push(files[i]);
						}
						if (files.length > 0) {
							fileIndex = 0;
						}
						
						loadImage();
					}
					document.getElementById('files').addEventListener('change', handleFileSelect, false);
				} else {
					$('#files').addClass("hide");
				}
				
				
				function redmodel(){
					red = 255;
					green= 50;
					blue=50;
					requestAnimFrame(redmodel);
					modelCC.clearRect(0, 0, 400, 300);
				
					if (ctrack.getCurrentPosition()) {
						ctrack.draw(model,red,green,blue);
						
					}
				

				
				
				}
				
				function bluemodel(){
					red = 50;
					green= 50;
					blue =255;
					requestAnimFrame(bluemodel);
					modelCC.clearRect(0, 0, 400, 300);
				
					if (ctrack.getCurrentPosition()) {
						ctrack.draw(model,red,green,blue);
						
					}
				

				
				
				}
				
					
				
			</script>
		</div>
			<div id="content2">
		<h3 style="color:#FFFFFF;">The Model</h3>
		<canvas id="model" width="400" height="300"></canvas>
		
		<script>
				var model = document.getElementById('model');
				var modelCC = model.getContext('2d');
		</script>
		<br>
		<h5 style="margin:10px 10px; color:#FFFFFF;">Parameter :</h5>
		<div id="parameter" style=" width:600px;">
		<input id="param0" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param1" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param2" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param3" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param4" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param5" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param6" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param7" class="pmt input-sm" type="text" disabled="disabled" value="">
		
		<input id="param8" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param9" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param10" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param11" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param12" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param13" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param14" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param15" class="pmt input-sm" type="text" disabled="disabled" value="">

		<input id="param16" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param17" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param18" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param19" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param20" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param21" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param22" class="pmt input-sm" type="text" disabled="disabled" value="">
		<input id="param23" class="pmt input-sm" type="text" disabled="disabled" value="">

		
		
		</div>
		<div style="width:550px; padding-left:30px ">
		<button style="width:120px; margin:10px 10px 0 0; background:url(styles/img/nav-bg.png) repeat-x; float:left; "  class="btn btn-warning"  disabled="disabled"  onClick="drawModel()" id="drawmodel">Apply Model <span class="glyphicon glyphicon-log-in"></span></button>
		<button style="width:120px; margin:10px 10px 0 0; background:url(styles/img/nav-bg.png) repeat-x; float:left;"  class="btn btn-danger"  onClick="redmodel()" id="redmodel">Red model <span class="glyphicon glyphicon-tint"></span></button>
		<button style="width:120px; margin:10px 10px 0 0; background:url(styles/img/nav-bg.png) repeat-x; float:left;"  class="btn btn-info"  onClick="bluemodel()" id="bluemodel">Blue model <span class="glyphicon glyphicon-tint"></span></button>
		
		<button style="width:120px; margin:10px 0 0 0; background:url(styles/img/nav-bg.png) repeat-x; float:left;"  class="btn btn-info" data-toggle="modal" data-target="#myModal"> Model <span class="glyphicon glyphicon-eye-open"></span></button>
		
		<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Constrained Local Model</h4>
      </div>
      <div class="modal-body" style="text-align:inherit;">
      <center><img src="styles/img/gambar3.png" ></center>
	
      </div>
     
    </div>
  </div>
</div>
		</div>
		
		
		
		
		
		
		
		</div>
		<br clear="all">
		
		<footer>
		<img style="float:right; padding-bottom:5px;" src="styles/img/logo.png" width="50" height="50">
		
		
		
		
		
		</footer>
	</body>
</html>
