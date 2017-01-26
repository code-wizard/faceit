
(function(){

	 var app = angular.module("faceit") 
	 app.service("Images",function($http,$q){
		var defer=$q.defer();
		this.getImages= function(){
		    $http.get(baseUrl+"/v1/images")
		    .then(function(data) {
		      defer.resolve(data);
		    });
		    return defer.promise;
	  	};


	})
	app.controller("ImageDownloadCtrl",function($http,$scope,Images){

	 	$scope.urlArray = []
	 	$scope.urlText=""
	 	$scope.maxUrl=10;
	 	$scope.submitted=false
	 	

	 	$scope.init=function(){
	 		Images.getImages().then(function(data){
	 			$scope.imageUrls=data.data
	 		})
	 	}
	 	$scope.addUrl = function(){
	 		if(validURL($scope.urlText)){
	 			if($scope.urlText && $scope.urlArray.length<= $scope.maxUrl){
		 			$scope.urlArray.push($scope.urlText)
		 			$scope.urlText=""
		 		}
	 		}
	 		else{
	 			$scope.error="Enter a valid Url"
	 		}
	 		
	 	}


	 	$scope.downloadFiles=function(){
	 		$scope.submitted=true;
	 		$http.post(baseUrl+"/image/detect-face",{"_csrf":$('meta[name="csrf-token"]').attr('content'),"url":$scope.urlArray})
	 		.then(function(data){
	 			$scope.message=data.data.message;
	 			$scope.noOfFaces=data.data.no_of_faces;
	 			$scope.submitted=false;
	 			$scope.showMessage=true;
	 			$scope.noOfImages=data.data.no_of_saved_images;
	 			$scope.urlArray=[];
	 			$scope.imageUrls=data.data.image_urls;
	 			console.log($scope.imageUrls)
	 		},function(data){
	 			$scope.submitted=false;
	 			console.error("An error occurred while downloading file")
	 		})
	 	}

	 	$scope.delete=function($index){
	 		console.log(121)
	 		$scope.urlArray.splice($index,1);
	 	}

	 	$scope.detect=function(id){
	 		$http.get(baseUrl+"/v1/images/"+id)
	 		.then(function(data){
	 			console.log(data)
	 			drawFaces(data.data)
	 		},function(error){

	 		})
	 	}
	 	function validURL(str) {
		  
		  if(/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(str)) {
		    return true
		  } else {
		    return false;
		  }
		}

		function drawFaces(data) {
		if (! data ) {
			return; 
		}
		// for (var j=0;j<data.length;j++){
			$("#wrapper").html('<img id="src-image" class="img-rounded visualization"  alt="Face Recognition Result">')
			$("img#src-image").attr("src",data.link);
			var vp_width  = $("#wrapper").width();
			var im_width  = data.width;
			var im_height = data.height;
			
			var mult_x = 1;
			var mult_y = 1;
			if (im_width > vp_width) {
				mult_x = (vp_width / im_width);
				mult_y = mult_x;
			}
				    //if (im_height > vp_height)
				      //mult_y = (vp_height / im_height);

			for (var i = 0; i < data.faces.length; i++) {
				var topLeftX = data.faces[i].top_left_x * mult_x;
				var topLeftY = data.faces[i].top_left_y * mult_y;
				var width    = data.faces[i].width * mult_x;
				var height   = data.faces[i].height * mult_y;
				$("#wrapper").append("<div id='canvas' style='position:absolute;top:"+topLeftY+"px;left:"+topLeftX+"px;border:2px solid #bd362f;height:"+height+"px;width:"+width+"px;z-index:1;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;'></div>");
				$("#wrapper").append('<div><div>Gender: <strong>'+data.faces[i].gender+'</strong></div><div>Confidence Level: <strong>'+data.faces[i].confident_level+'</strong></div></div>')
			}
		// }
		
	}

	 })

})()