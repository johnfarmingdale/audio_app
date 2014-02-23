	    // when the page loads, set the status to online or offline
	    function loadDemo() {
	        // Log timing 
	        if (navigator.onLine) {
	            appCacheLog("Initial online status: online");
	            return;
	        } else {
	            appCacheLog("Initial online status: offline");
	            return;
	        }
	    }

	    // add listeners on page load and unload
	    window.addEventListener("load", loadDemo, true);

		var counter = 1;

		appCacheLog = function() {
		    var p = document.getElementById("cachestatictext");
		    var classpro=document.getElementById("cachestatictext");
			var message = Array.prototype.join.call(arguments, " ");
	    	var mess= Math.round(message);
			p.value = mess;
		    drawszlider(100,mess);
			if(isFinite(String(message))==true){ message=mess+"%";}
			
			classpro.innerHTML=message; 
		}

		
		if (navigator.onLine)
		{
				// log each of the events fired by window.applicationCache
				window.applicationCache.onchecking = function(e) {
					appCacheLog("Checking for updates");
				}
		
				window.applicationCache.onnoupdate = function(e) {
					appCacheLog("current version (click to update)");
				}
		
				window.applicationCache.onupdateready = function(e) {
					counter=0;
					appCacheLog("Update complete");
					 window.location.reload();
				}
		
				window.applicationCache.onobsolete = function(e) {
					appCacheLog("Cache obsolete");
				}
		
				window.applicationCache.ondownloading = function(e) {
					appCacheLog("Downloading updates");
				}
		
				window.applicationCache.oncached = function(e) {
					counter=0;
					appCacheLog("Cached");
				}
		
				window.applicationCache.onerror = function(e) {
					appCacheLog("ApplicationCache error");
				}
		
				window.applicationCache.onprogress = function(e) {
					var percenttotal=(counter/e.total)*100;
					//appCacheLog("Total:" +e.total+"Progress: downloaded file " + counter);
					//var p = document.getElementById("statinfo");
					//classpro.innerHTML = percenttotal;
					appCacheLog(percenttotal);
					counter++;
				}
		}
       

		window.addEventListener("online", function(e) {
		    appCacheLog("You are online");
		}, true);

		window.addEventListener("offline", function(e) {
		    appCacheLog("You are offline");
		}, true);

		// Convert applicationCache status codes into messages
		showCacheStatus = function(n) {
		    statusMessages = ["Uncached","Idle","Checking","Downloading","Update Ready","Obsolete"];
		    return statusMessages[n];
		}

		onload = function(e) {
		    // Check for required browser features
		    if (!window.applicationCache) {
		        appCacheLog("HTML5 offline web applications (ApplicationCache) are not supported in your browser.");
		        return;
		    }

		    appCacheLog("Initial AppCache status: " + showCacheStatus(window.applicationCache.status));
		}


		function drawszlider(ossz, meik){
			var szazalek=Math.round((meik*100)/ossz);
			document.getElementById("cachestaticbar").style.width=szazalek+'%';
		   // document.getElementById("szazalek").innerHTML=szazalek+'%';
		}

		function runupdate(){
		   document.getElementById("cachestaticbar").style.width='0%';
		   if (navigator.onLine){
		   cache = window.applicationCache;
		   cache.update();
		   
		   }
		 }
  