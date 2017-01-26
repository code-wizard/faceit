var face_data=""
	

function drawFaces(data) {
	if (! data ) {
		return; 
	}
	face_data = data;
	console.log(data)
	var name = data[0].name;
	// $("#wrapper").append('<img id="'++'" class="img-rounded visualization"  alt="Face Recognition">')
	$("img#src-image").attr("src",data[0].link);
	var vp_width  = $("#wrapper").width();
	var im_width  = data[0].width;
	var im_height = data[0].height;
	
	var mult_x = 1;
	var mult_y = 1;
	if (im_width > vp_width) {
		mult_x = (vp_width / im_width);
		mult_y = mult_x;
	}
		    //if (im_height > vp_height)
		      //mult_y = (vp_height / im_height);
	for (var i = 0; i < data[0].faces.length; i++) {
		var topLeftX = data[0].faces[i].top_left_x * mult_x;
		var topLeftY = data[0].faces[i].top_left_y * mult_y;
		var width    = data[0].faces[i].width * mult_x;
		var height   = data[0].faces[i].height * mult_y;
		$("#wrapper").append("<div id='canvas' style='position:absolute;top:"+topLeftY+"px;left:"+topLeftX+"px;border:2px solid #bd362f;height:"+height+"px;width:"+width+"px;z-index:1;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;'></div>");

	}
}

$.ajax({
	"url":baseUrl+"/v1/images",
	success:function(data){
		drawFaces(data);
	}
})
	// 