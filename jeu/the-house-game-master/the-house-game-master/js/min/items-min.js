var items={
	room_name:function(){var e=$.jStorage.get("is_in","");return e},
	take:function(e){
		var t=$(e).attr("id"),n=$(e).attr("data-info");
		$(e).remove();items.itembox(items.room_name(),t,n);
		var r=$.jStorage.get("collected");r.push(t);
		$.jStorage.set("collected",r);$.jStorage.set(t+"_room",items.room_name());
		$.jStorage.set(t+"_info",n);$("#items_text").remove();$(e).remove();
		$("#tooltip").remove();items.add_to_holder("#button",t,items.room_name(),n);$("#items").fadeIn()
	},
	use:function(e){
		var t=$(e);if(!(t.length>0))return!1;var n=$(e).attr("id");$(e).remove();var r=$.jStorage.get("used");
		r.push(n);$.jStorage.set("used",r);
		dialogue_box.display({character:!1,picture:!1,text:'The item "'+n+'" has been used!',options:["Ok"]});$("#items").children().length<2&&$("#items").fadeOut()
	},
	holder:function(){
		var e=document.getElementById("items"),t=document.getElementById("button");
		items.loop_and_add(collected);
		$(t).toggle(function(){$(t).addClass("up");$(e).animate({top:0},500)},
		function(){$(t).removeClass("up");$(e).animate({top:-100},500)});
		$(e).delegate("img","click",function(){var e=$(this).attr("id"),t=$.jStorage.get(e+"_room"),n=$.jStorage.get(e+"_info");items.itembox(t,e,n)})
	},
	loop_and_add:function(e){var t=e.length;if(t>0)for(i=0;i<t;i++){var n=$.jStorage.get(e[i]+"_room"),r=$.jStorage.get(e[i]+"_info");items.add_to_holder("#button",e[i],n,r)}},
	itembox:function(e,t,n){
		$("#lightbox").fadeIn("1000").text(n).append("<div class='close'>").append("<img src='images/"+e+"_"+t+"_big.png'>");
		$("div.close").click(function(){$("#lightbox").empty().fadeOut("1000")})
	},
	add_to_holder:function(e,t,n,r){$(e).before("<img src='images/"+n+"_"+t+"_min.png' id='"+t+"' data-info='"+r+"'>")}};