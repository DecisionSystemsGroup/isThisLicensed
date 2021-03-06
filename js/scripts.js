function addHttp(url){
	url = (url.indexOf('://') == -1) ? 'http://' + url : url;
	return url;
}
function ifValUrl(url){
	url = addHttp(url);
	return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}
function init(){
	$(".get-image").show();
	$("#get-loader").hide();
	$("#get-results").hide();
}
function showSearchResults(resp){
	var item;
	if(!resp['success'] || resp['hits'].length<1){
		$("#get-results>.row").append("<div class=\"col-md-4 col-md-offset-4\"><img src=\"img/sad.png\" class=\"img-responsive\"><span class=\"text-center\">No matches found</span></div>");
		return;
	}
	for(var i=0;i<resp['hits'].length;i++){
		item = $(resp['hits'].length==1?"<div class=\"col-md-4 col-md-offset-4\"></div>":"<div class=\"col-md-4\"></div>");
		$(item).append("<a href=\""+resp['hits'][i]['url']+"\" target=\"_blank\"><img src=\""+resp['hits'][i]['url']+"\" alt=\""+resp['hits'][i]['title']+"\" class=\"img-responsive\"></a>");
		$(item).append("<div class=\"title\">"+resp['hits'][i]['image_title']+"</div>");
		$(item).append("<div class=\"license\"><a href=\""+licenses[resp['hits'][i]['license']]['url']+"\" target=\"_blank\"><img src=\""+licenses[resp['hits'][i]['license']]['img']+"\"></div>");
		$(item).append("<a href=\""+"https://www.flickr.com/photos/"+resp['hits'][i]['system_creator_id']+"/"+resp['hits'][i]['system_id']+"\" target=\"_blank\">Original Location</a>");
		
		$("#get-results>.row").append(item);
	}
}

$(document).ready(function(){ 
	var myDropzone = new Dropzone("#image-upload");
	myDropzone.on("complete", function(resp) {
		$("#get-loader").hide();
		$("#get-results").show();
		showSearchResults(JSON.parse(resp.xhr.response));
	});
	myDropzone.on("sending", function(resp) {
		$(".get-image").hide();
		$("#get-loader").show();
	});
	init();
	$("#image-url").val("");
	$("#image-url").on("focus", function(){
		$(this).closest(".form-group").addClass("has-warning has-feedback");
		$(this).siblings("span.hidden").removeClass("hidden").addClass("glyphicon glyphicon-warning-sign form-control-feedback");
	});
	$("#image-url").on("input", function(){
		if(ifValUrl($(this).val())){
			$(this).closest(".form-group").removeClass("has-warning").addClass("has-success");
			$(this).val(addHttp($(this).val()));
			imageurl = $(this).val();
			$.ajax({
				type: 'POST',
				url: "./upload.php",
				data : {"image-url": imageurl},
				beforeSend: function(){
					$(".get-image").hide();
					$("#get-loader").show();
				},
				success: function (resp) {
					$("#get-loader").hide();
					$("#get-results").show();
					showSearchResults(JSON.parse(resp));
				},
				error: function (resp) {
					console.log('no hits');
				}
			});
		} else {
			$(this).closest(".form-group").addClass("has-warning").removeClass("has-success");
		}
	});
	
});
var licenses = [{
	"type": "All Rights Reserved",
	"img": "http://169.45.235.85/img/copy.png",
	"url": "https://en.wikipedia.org/wiki/Copyright"
},
{
	"type": "Attribution-NonCommercial-ShareAlike License",
	"url": "http://creativecommons.org/licenses/by-nc-sa/2.0/",
	"img": "https://licensebuttons.net/l/by-nc-sa/3.0/88x31.png"
},
{
	"type": "Attribution-NonCommercial License",
	"url": "http://creativecommons.org/licenses/by-nc/2.0/",
	"img": "https://licensebuttons.net/l/by-nc/3.0/88x31.png"
},
{
	"type": "Attribution-NonCommercial-NoDerivs License",
	"url": "http://creativecommons.org/licenses/by-nc-nd/2.0/",
	"img": "https://licensebuttons.net/l/by-nc-nd/3.0/88x31.png"
},
{
	"type": "Attribution License",
	"url": "http://creativecommons.org/licenses/by/2.0/",
	"img": "https://licensebuttons.net/l/by/3.0/88x31.png"
},
{
	"type": "Attribution-ShareAlike License",
	"url": "http://creativecommons.org/licenses/by-sa/2.0/",
	"img": "https://licensebuttons.net/l/by-sa/3.0/88x31.png"
},
{
	"type": "Attribution-NoDerivs License",
	"url": "http://creativecommons.org/licenses/by-nd/2.0/",
	"img": "https://licensebuttons.net/l/by-nd/3.0/88x31.png"
},
{
	"type": "No known copyright restrictions",
	"url": "http://flickr.com/commons/usage/",
	"img": "http://169.45.235.85/img/nc.png"
},
{
	"type": "United States Government Work",
	"url": "http://www.usa.gov/copyright.shtml",
	"img": "http://169.45.235.85/img/usa.png"
},
{
	"type": "Public Domain Work",
	"url": "https://creativecommons.org/publicdomain/mark/1.0/",
	"img": "http://i.creativecommons.org/p/mark/1.0/88x31.png"
},
{
	"type": "Public Domain Dedication (CC0)",
	"url": "https://creativecommons.org/publicdomain/zero/1.0/",
	"img": "http://i.creativecommons.org/p/zero/1.0/88x31.png"
}];
