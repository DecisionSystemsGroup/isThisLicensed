function ifValUrl(url){
	if(url.indexOf('http://')<0||url.indexOf('https://')<0){
		url = 'http://'+url;
	}
	return /^https?:\/\/(?:[a-z\-]+\.)+[a-z]{2,6}(?:\/[^\/#?]+)+\.(?:jpe?g|png)$/.test(url);
}

$(document).ready(function(){
	$("#image-url").val("");
	$("#image-url").on("focus", function(){
		$(this).closest(".form-group").addClass("has-warning has-feedback");
		$(this).siblings("span.hidden").removeClass("hidden").addClass("glyphicon glyphicon-warning-sign form-control-feedback");
	});
	$("#image-url").on("input", function(){
		if(ifValUrl($(this).val())){
			$(this).closest(".form-group").removeClass("has-warning").addClass("has-success");
		} else {
			$(this).closest(".form-group").addClass("has-warning").removeClass("has-success");
		}
	});
});