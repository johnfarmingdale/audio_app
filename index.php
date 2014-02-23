<!DOCTYPE html>
<html manifest="cache.manifest.php">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, follow">
	<meta http-equiv="Cache-control" content="public">
    <meta name="description" content="Webapps built with HMTL5, CCS3 , SQL3, JQUERY and JQUERYMOBILE for mobile webapps.">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/iOS-114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/iOS-72.png" />
    <link rel="apple-touch-icon-precomposed" href="images/iOS-57.png" />
    <link rel="icon" href="images/iOS-57.png" />
    <title>AUDIO</title>
	<link rel="stylesheet" href="css/jqm-docs.css" />
    <link rel="stylesheet" href="css/jquery.mobile.addon.green.css" />
	<link rel="stylesheet" href="css/jquery.mobile.addon.red.css" />
    <link  rel="stylesheet"href="css/jquery.mobile-1.3.1.min.css" />
    <link rel="stylesheet" href="css/cachecontrol.css" />
    <style>
	</style>
	<script type="text/javascript"> 
    (function () {
      var filename = navigator.platform === 'iPad' ? 'splashscreen-tablet.png' : 'splashscreen.png';
      document.write('<link rel="apple-touch-startup-image" href="images/' + filename + '" />' );
    })();
    </script>     
	<script src="jscript/jquery-2.0.0.js"></script>
    <script src="jscript/jquery.mobile-1.3.1.js"></script>
    <script type="text/javascript">
 
    function loadPlayer() {
        var audioPlayer = new Audio();
        audioPlayer.controls="controls";
        audioPlayer.addEventListener('ended',nextSong,false);
        audioPlayer.addEventListener('error',errorFallback,true);
        document.getElementById("player").appendChild(audioPlayer);
        nextSong();
    }
    function nextSong() {
        if(urls[next]!=undefined) {
            var audioPlayer = document.getElementsByTagName('audio')[0];
            if(audioPlayer!=undefined) {
                audioPlayer.src=urls[next];
                audioPlayer.load();
                audioPlayer.play();
				$("#songname").text(displayaudioname(urls[next]));
				$('#listmenu').trigger('collapse');
                next++;
            } else {
                loadPlayer();
            }
        } else {
           // alert('the end!');
		   nextSong();
        }
    }
    function errorFallback() {
            nextSong();
    }
    function playPause() {
        var audioPlayer = document.getElementsByTagName('audio')[0];
        if(audioPlayer!=undefined) {
            if (audioPlayer.paused) {
                audioPlayer.play();
            } else {
                audioPlayer.pause();
            }
        } else {
            loadPlayer();
        }
    }
    function pickSong(num) {
        next = num;
        nextSong();
    }
 
    var urls = new Array();
   
   
	<?php
	$directory = "files/";
	$songs = glob($directory . "*.mp3");
	$numsong=0; 
	//print each file name
	foreach($songs as $song)
	{
		$songpath=explode('.',$song);
		$songname=explode('-',$songpath[0]);
		$songtrue=str_replace("_", " ", $songname[1]);
		echo 'urls['.$numsong.'] = \''.$song.'\';
		';
		//echo '<li><a href="javascript:location.href=\'index.php?song=\'+song'.$numsong.'+\'&nums='.$numsong.'\'" id="song'.$numsong.'">'.$songtrue.'</a></li>';
		$numsong++;
	}
	
	function foldersize($dir){
		 $count_size = 0;
		 $count = 0;
		 $dir_array = scandir($dir);
		 foreach($dir_array as $key=>$filename){
		  if($filename!=".." && $filename!="."){
		   if(is_dir($dir."/".$filename)){
			$new_foldersize = foldersize($dir."/".$filename);
			$count_size = $count_size + $new_foldersize;
		   }else if(is_file($dir."/".$filename)){
			$count_size = $count_size + filesize($dir."/".$filename);
			$count++;
		   }
		  }
		 }
		function bytesToSize1024($bytes, $precision = 2) {
		$unit = array('B','KB','MB');
		return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
		}
	   return bytesToSize1024($count_size, $precision = 2);
	}
	?>    
    var next = 0;
	</script>
	<script>
        function xmlhttpPost(strURL) {
				var xmlhttp;
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				 xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					//document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
					}
				  }
				 xmlhttp.open("POST",strURL,true);
				 xmlhttp.send();
         }  
	</script>
	<script>
	function replaceAll(find, replace, str) {
         return str.replace(new RegExp(find, 'g'), replace);
    }
	function displayaudioname(x){     
		 stringsongname=x.replace('files/','');
		 replaceAll('_', ' ', stringsongname);
		 stringsongname=stringsongname.replace('_',' ');
		 document.getElementById('songname').innerHTML=replaceAll('_', ' ', stringsongname);
	}
</script>
</head>
<body>
  <div data-role="page" class="type-home">
        <div data-role="header" data-theme="a" style="height:26px;">
            <a href="#" data-ajax="false" data-icon="home"  data-iconpos="notext"  class="ui-btn-left">home</a>
            <h1> AUDIO </h1> 
            <!--<a href="" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>-->
           <a href="#" data-role="button" data-icon="plus" data-ajax="false" onClick="xmlhttpPost('files/rename_files.php')"  data-iconpos="notext" class="ui-btn-right"></a>
        </div>
        <div id="cachestatic"><div id="cachestaticbar"></div></div><div onClick="runupdate();" id="cachestatictext">&nbsp; </div><div id="cachesize" style="font-size:10px; display:inline;"> <?php echo foldersize('files'); ?></div> 
	    <div data-role="content" data-theme="a">
             <div class="content-secondary">
          
               <div data-role="collapsible" data-collapsed="true" data-theme="e" data-content-theme="d" style="margin-top:-6px;margin-bottom:20px; ">
				 <h2> WEBAPPS LIST </h2>
	             <ul id="listmenu" class="ui-listview ui-listview-inset ui-corner-all ui-shadow" data-inset="true" role="listbox" >
                        <!--<li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c' data-theme='c' data-iconpos='right' data-icon='arrow-r' data-wrapperels='div' data-iconshadow='true' data-shadow='false' data-corners='false'><div class='ui-btn-inner ui-li'><div class='ui-btn-text'><a class='ui-link-inherit' href='#' onClick="" >MAIN</a></div><span class='ui-icon ui-icon-arrow-r ui-icon-shadow'>&nbsp;</span></div></li>-->                        
					   <?php
								$dirFiles = array();
								// opens images folder
								if ($handle = opendir('files')) {
									while (false !== ($file = readdir($handle))) {
										 $oneoff=1;
										 if($oneoff==1){ $alphaletter=$file[0];  $al=$file[0];      $oneoff=0;      }
										// strips files extensions      
										$crap   = array(".doc", ".txt", ".JPG", ".JPEG", "_", "-"); 
										$newstring = str_replace($crap, " ", $file );   
										//asort($file, SORT_NUMERIC); - doesnt work :(
										// hides folders, writes out ul of images and thumbnails from two folders
										if ($file != "." && $file != ".." && $file != "index.php"  && $file != "cover.jpg" && $file != "notes.txt" && $file != "rename_files.php") { 	$dirFiles[] = $file;  }
									}
									closedir($handle);
								}
								sort($dirFiles);
								$oneoff=1;
								$numsong=0; 
								foreach($dirFiles as $file)
								{
									$filename=explode('-',$file);
                                    $filenametext=str_replace("_", " ", $filename[1]);
									$filenametext=explode('.',$filenametext);
									$band=str_replace("_", " ", $filename[0]);
									if($oneoff==1){ echo "<li data-role='list-divider'><div align='center' style='color:#CCFF00; font-size:14px;'>$band</div></li>"; $al=$band; $oneoff=0;}
									$alphaletter=$band;
									$num=$numsong+1;
									if($alphaletter!=$al){  echo "<li data-role='list-divider' data-theme='a'><div align='center' style='color:#CCFF00; font-size:14px;'>$band</div></li>";    }
									echo "<li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c' data-theme='c' data-iconpos='right' data-icon='arrow-r' data-wrapperels='div' data-iconshadow='true' data-shadow='false' data-corners='false' id='".$file."'><div class='ui-btn-inner ui-li'><div class='ui-btn-text'><a class='ui-link-inherit' href='#' onclick='pickSong(\"".$numsong."\"); $(\"#songname\").text(\" ".$band." - ".$filenametext[0]." \");'>".$num.". ".$filenametext[0]."</a></div><span class='ui-icon ui-icon-arrow-r ui-icon-shadow'>&nbsp;</span></div></li>\n";
									$al=$band;
									$numsong++;
								}
                            ?> 
                  </ul>
               </div>
          </div>
          <!--/content-primary-->
		  <div class="content-primary">
          	
          <div id="detail_page" data-role="content" data-theme="a" style="margin-top:-26px; padding: -14px 0 10px 0 !important;" class="ui-body ui-body-c " style="border: 3px black solid; border-radius:28px/28px">
           <br>
           <form class="ui-body ui-body-a ui-corner-all">
           <div id="songname" align="center" style="font-size:16px"> PICK A SONG </div>
           <br>
              <div id="player" style="height:25px;" align="center"></div>
           <br>
          </div> 
          </form>
          <div style="font-size:16px; margin:5px 5px 5px 5px;"><b>OPEN SOURCE PROJECT:</b></div>
          <p style="margin-left:5px;">Audio Play list for a portable, cache, and fully controlable. FORMAT: (.mp3)</p>
           <div align="center">
                 <img id="cover_front" src="files/cover.jpg" width="280" style="border-radius:10px; border:5px solid #333;" />
          </div>
          
          <div align="center">
                 <img id="QR_loction" src="images/qrcode.png" width="50" onClick="if(this.width == 50){this.width = 200;}else{this.width = 50;}" style="border-radius:10px; border:5px solid #333;" />
          </div>
                <!--<a href="#" onclick="playPause()">Play / Pause!</a> |-->
        
		</div>
	</div>
	<div data-role="footer" class="footer-docs" data-theme="a">
			<a class="ui-btn ui-btn-icon-left ui-btn-up-a" data-theme="a" href="#" data-icon="arrow-u" onClick="$.mobile.silentScroll(40);"><span aria-hidden="true" class="ui-btn-inner"><span class="ui-btn-text">TOP</span><span class="ui-icon ui-icon-arrow-u ui-icon-shadow"></span></span></a>
            <a class="ui-btn ui-btn-icon-right ui-btn-down-a" data-theme="a" href="#" data-icon="arrow-d" onClick="$.mobile.silentScroll(40);"><span aria-hidden="true" class="ui-btn-inner"><span class="ui-btn-text">SOURCE</span><span class="ui-icon ui-icon-arrow-d ui-icon-shadow"></span></span></a>
 
  </div>	
    
</body>
</html>
<script type='text/javascript'>
$(document).on('pageinit',function(){
	$("#listmenu li").on("swiperight",function(){
		var answer=confirm('DELETE \r'+ this.id );
		if(answer==true){ $(this).remove(); xmlhttpPost('file_delete.php?file='+ this.id);  }
	});
});
</script>
<script src="jscript/cachecontrol.js"></script>
<?php /*if(!file_exists('images/qrcode.png')){$_SESSION['urllink']="http://".$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI'];include("../../../../system/QRcode/file_qrcode.php"); }*/ ?>