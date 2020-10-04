var sp = new URLSearchParams(window.location.search)
$.ajax({
	url: "php/getData.php",
	data: {
		id:sp.get("id"),
		source: sp.get("source")
	},
	method: "post",
	statusCode:{
		400: function(){
			alert("Request Parameters Error");
		},
		405: function(){
			alert("Request Method Error"); //impossible
		}
	},
	success:function(data){
		switch(sp.get("source")){
			case "sn":
				//[main]title,imgurl,content,extended_content
				$("img").attr("src",data['main']['imgurl']).show();
				$("h1").append(data['main']['title']);
				$("p").append(data['main']['content']).append("<br />")
						.append(data['main']['extended_content']);
				break;
			case "ev":
				$("p").append(data['main']['content']);
				break;
			case "ms":
				document.title = data['main']['title']+" - NASA";
				$("img").attr("src",data['main']['imgurl']).show();
				$("h1").append(data['main']['title']);
				$("p").append(data['main']['content']);
				$("div").append("Links:<br />")
				$.each(data['links'],function(key,value){
					$("<a/>",{
						text: value['text'],
						href: value['url']
					}).appendTo("div");
					$("<br />").appendTo("div");
				});
				break;
			case "nw":
				document.title = data['main']['title']+" - NASA";
				$("img").attr("src",data['main']['imgurl']).show();
				$("h1").append(data['main']['title']);
				$("p").append(data['main']['content']);
				break;
			default:	//impossible
				return;
		}
		$("body").show();
	},
	dataType: "json"
});