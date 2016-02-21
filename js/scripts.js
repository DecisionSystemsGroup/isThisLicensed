/*function ifValUrl(url){
	if(url.indexOf('http://')<0){
		url = 'http://'+url;
	}
	return /^https?:\/\/(?:[a-z\-]+\.)+[a-z]{2,6}(?:\/[^\/#?]+)+\.(?:jpe?g|png)$/.test(url);
}*/
function addHttp(url){
	url = (url.indexOf('://') == -1) ? 'http://' + url : url;
	return url;
}
function ifValUrl(url){
	url = addHttp(url);
	return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}

$(document).ready(function(){
	$("#image-url").val("");
	$("#image-url").on("focus", function(){
		$(this).closest(".form-group").addClass("has-warning has-feedback");
		$(this).siblings("span.hidden").removeClass("hidden").addClass("glyphicon glyphicon-warning-sign form-control-feedback");
	});
	$("#image-url").on("input", function(){
		if(ifValUrl($(this).val())){console.log('y');
			$(this).closest(".form-group").removeClass("has-warning").addClass("has-success");
			$(this).val(addHttp($(this).val()));
			console.log($(this).closest("form"));
		} else {console.log('n');
			$(this).closest(".form-group").addClass("has-warning").removeClass("has-success");
		}
	});
});