//global settings for jquery 
jQuery.fx.interval=10;
if(typeof (window["collected"]&&window["used"])=="undefined")
	var collected=!1,used=!1;
var room={
	settings:{
	inject:!1,grid_width:null,grid_height:null,tile_width:69.282,tile_height:40,
	drag_room:!1,room_glow:!1,player:!1,player_speed:null,player_position_x:null,
	player_position_y:null,collision_nodes:[],collected_items:collected,used_items:used,transparency_power:".7",
	volume:50,preload:[],fade_color:"black",zdetection:function(){return!1},execute:function(){}
	},
	generate:function(e){
		$.extend(room.settings,e);$("<div/>",{id:room.settings.fade_color}).
		appendTo("body").css({opacity:0}).animate({opacity:1},1e3,
		function(){
			room.settings.fade_color==="white"?$("body").css("background","#fff"):$("body").css("background","#000");
			room.settings.inject&&$("#the_game").empty();setTimeout(function(){$("#black").remove();$("#white").remove();room.inject()},500)
		})
	},
	inject:function(){
		if(room.settings.inject)$("#the_game").load(room.settings.inject+".html?"+(new Date).getTime(),function(){soundManager.stopAll();
		var e=window.room.settings.inject,t=function(){sound[e].play({volume:room.settings.volume,onfinish:function(){t(e)}})};
		t(e);
		$("body").css("background","#000");$("<div/>",{id:room.settings.fade_color}).appendTo("body").css({opacity:1}).animate({opacity:0},1e3,
		function(){$("body").find("#"+room.settings.fade_color).remove()});
		$.jStorage.set("is_in",room.settings.inject);room.draw_grid();
		room.place_player();room.set_collisions();room.set_collected_items();
		room.set_used_items();room.draggable();room.stroke();room.settings.execute();
		room.the_player.start();room.center();$.idleTimer("destroy");$(".the-resume-screen").remove();
		setTimeout(function(){$("#items").children().length>1&&$("#items").fadeIn()},100);$(room.player_body()).sprite({no_of_frames:8}).spStop(!0)});else{room.draw_grid();room.draggable()}
	},
	player:function(){var e=$("#"+room.settings.player);return e},
	player_body:function(){var e=$("#sprite");return e},
	center:function(e,t){
		var n=$("#the_game").children("div").first(),
		r=$(window).width(),
		i=$(window).height(),s=$(room.player()).width(),o=$(room.player()).height(),u=$(room.player_body()).height(),a=$(room.player()).position(),f=$("body").find("#floor"),
		l=$(f).width(),c=$(f).height(),h=$(f).position();
		if(!e)
			$(n).css({left:r/2-s/2-a.left-h.left,top:i/2-o/2-a.top-h.top+u/3});
		else{
			if(!t)return!1;
			$("#tooltip").remove();$(n).stop(!0,!1).animate({left:r/2-s/2-a.left-h.left,top:i/2-o/2-a.top-h.top+u/3},t)
		}
	},draggable:function(){
		if(!room.settings.drag_room)return!1;$("#the_game").children("div:first-child").draggable({start:function(){$("#the_game").children("div").stop()}})}
	,stroke:function(){
		if(!room.settings.room_glow)return!1;$("div.tile, div.active").hover(function(){$("#stroke").css({opacity:1})},function(){$("#stroke").css({opacity:.5})})
	}
	,draw_grid:function(){
		var e=0,t=0;
		for(e=0;e<room.settings.grid_width;e++)
		for(t=0;t<room.settings.grid_height;t++)
		var n=$("<div/>",{id:e+"-"+t,
		css:{width:room.settings.tile_width,height:room.settings.tile_height,position:"absolute",
		left:e*room.settings.tile_width/2+(room.settings.grid_height*room.settings.tile_width/2-room.settings.tile_width/2)-room.settings.tile_width/2*t,
		top:t*room.settings.tile_height/2+e*room.settings.tile_height/2}})
		.appendTo("#floor").attr("class","tile").attr("data-x",e).attr("data-y",t).attr("data-z",t+(t+room.settings.grid_height*e))
	},
	grid:function(){
		grid=function(){
			grid=new Array(room.settings.grid_height);for(var e,t=0;
			t<room.settings.grid_height;t++){grid[t]=new Array(room.settings.grid_width);
			for(e=0;e<room.settings.grid_width;e++)grid[t][e]=0}return grid
		};
		add_collisions=function(e,t){
			for(i=0;i<e.length;i++){var n=$("#"+e[i]).attr("data-x"),r=$("#"+e[i]).attr("data-y");t[r][n]=1}return t};
			grid=add_collisions(room.settings.collision_nodes,grid());return grid
		}
		,place_player:function(){
			var e=$("#"+room.settings.player_position_x+"-"+room.settings.player_position_y),
			t=e.position();
			$(room.player()).css({top:t.top,left:t.left,"z-index":e.attr("data-z")}).attr("data-x",room.settings.player_position_x).attr("data-y",room.settings.player_position_y)},
			set_collisions:function(){room.loop_and_add_class(room.settings.collision_nodes,"collision")},
			set_collected_items:function(){room.loop_and_remove(room.settings.collected_items)},
			set_used_items:function(){room.loop_and_remove(room.settings.used_items,!0)},
			loop_and_remove:function(e,t){
				var n=e.length;if(t){if(!(n>0))return!1;for(i=0;i<n;i++)$("#"+e[i]).remove()}else{if(!(n>0))return!1;
				for(i=0;i<n;i++)$("#the_game").find("#"+e[i]).remove()}
			},
			loop_and_add_class:function(e,t){var n=e.length;if(!(n>0))return!1;for(i=0;i<n;i++)$("#"+e[i]).addClass(t)},
			transparency:function(e,t){$(t).addClass("transparency");$(t).hover(function(){$(e).stop().css({opacity:room.settings.transparency_power})},function(){$(e).stop().css({opacity:1})})},
			pulse:function(e,t){
				function n(){
					setTimeout(function(){$(e).css({opacity:0});setTimeout(function(){$(e).css({opacity:1});n()},t*2)},t)}
				$(e).css({
					"-moz-transition":"opacity "+t/1e3+"s linear","-webkit-transition":"opacity "+t/1e3+"s linear",
					"-o-transition":"opacity "+t/1e3+"s linear","-moz-transition":"opacity "+t/1e3+"s linear",transition:"opacity "+t/1e3+"s linear"
				});n()
			},the_player:{
				start:function(){
					$("#floor").find("div.tile").on("click",function(){if(!$(this).hasClass("collision")){
					var e=$.jStorage.get("temp_path");e=[];$.jStorage.set("this_path",path);$(room.player_body()).spStart();
					$(room.player()).stop();room.the_player.go_to.start({target:!1,action:function(){!1}});
					room.the_player.footsteps();room.the_player.footsteps(12,4,!0);room.the_player.clear_path();room.the_player.find_path(this,!1,!1,room.grid())}})
				},
				go_to:{
					settings:{target:!1,action:function(){return!1}},
					start:function(e){
						$.extend(room.the_player.go_to.settings,e);if(room.the_player.go_to.settings.target){$(room.player_body()).spStart();
						$(room.player()).stop();
						room.the_player.footsteps();
						room.the_player.footsteps(12,4,!0);
						room.the_player.clear_path();
						room.the_player.find_path($("#"+room.the_player.go_to.settings.target),!1,!1,room.grid())}
					}
				},
				footsteps:function(e,t,n){
					if(e&&t&&n)stop_steps=setInterval(function(){sound_footstep.play()},1e3/e*t);else{typeof window["stop_steps"]!="undefined"&&clearInterval(stop_steps);sound_footstep.play()}
				},
				clear_path:function(){$("div.tile").removeClass("marked")},
				AStar:function(){
					function e(e,t,n,r,i,s,o,u,a,f,l,c,h){
						if(e){n&&!a[i][o]&&(c[h++]={x:o,y:i});r&&!a[i][u]&&(c[h++]={x:u,y:i})}if(t){n&&!a[s][o]&&(c[h++]={x:o,y:s});r&&!a[s][u]&&(c[h++]={x:u,y:s})}return c
					}
					function t(e,t,n,r,i,s,o,u,a,f,l,c,h){
						e=i>-1;t=s<f;n=o<l;r=u>-1;if(n){e&&!a[i][o]&&(c[h++]={x:o,y:i});t&&!a[s][o]&&(c[h++]={x:o,y:s})}if(r){e&&!a[i][u]&&(c[h++]={x:u,y:i});t&&!a[s][u]&&(c[h++]={x:u,y:s})}
						return c
					}
					function n(e,t,n,r,i,s,o,u,a,f,l,c,h){return c}
					function r(e,t,n,r,i,s){
						var o=n-1,u=n+1,a=t+1,f=t-1,l=o>-1&&!r[o][t],c=u<i&&!r[u][t],h=a<s&&!r[n][a],p=f>-1&&!r[n][f],d=[],v=0;
						l&&(d[v++]={x:t,y:o,index:v,direction:"up"});h&&(d[v++]={x:a,y:n,index:v,direction:"right"});c&&(d[v++]={x:t,y:u,index:v,direction:"down"});
						p&&(d[v++]={x:f,y:n,index:v,direction:"left"});return e(l,c,h,p,o,u,a,f,r,i,s,d,v)
					}
					function i(e,t,n,r){return r(n(e.x-t.x),n(e.y-t.y))}
					function s(e,t,n,r){var i=e.x-t.x,s=e.y-t.y;return r(i*i+s*s)}
					function o(e,t,n,r){return n(e.x-t.x)+n(e.y-t.y)}
					function u(u,a,f,l){
						var c=u[0].length,h=u.length,p=c*h,d=Math.abs,v=Math.max,m={},g=[],y=[{x:a[0],y:a[1],f:0,g:0,v:a[0]+a[1]*c}],b=1,w,E,S,x,T,N,C,k,L;f={x:f[0],y:f[1],v:f[0]+f[1]*c};
						switch(l){case"Diagonal":S=e;case"DiagonalFree":E=i;break;case"Euclidean":S=e;case"EuclideanFree":v=Math.sqrt;E=s;break;
						default:E=o;S=n}S||(S=t);do{N=p;C=0;for(x=0;x<b;++x)if((l=y[x].f)<N){N=l;C=x}k=y.splice(C,1)[0];if(k.v!=f.v){--b;L=r(S,k.x,k.y,u,h,c);
						for(x=0,T=L.length;x<T;++x){(w=L[x]).p=k;w.f=w.g=0;w.v=w.x+w.y*c;if(!(w.v in m)){w.f=(w.g=k.g+E(w,k,d,v))+E(w,f,d,v);y[b++]=w;m[w.v]=1}}}
						else{x=b=0;do g[x++]=[k.x,k.y,k.index,k.direction];while(k=k.p);g.reverse()}}while(b);return g
						}return u
				}(),
				find_path:function(e,t,n,r){
					if(!t&&!n)var t=parseInt($(room.player()).attr("data-x")),n=parseInt($(room.player()).attr("data-y"));var i=parseInt($(e).attr("data-x")),s=parseInt($(e).attr("data-y"));
					go=function(e,t){
						var t=t?t:1;
						if(e.length>t){
							var n=$("#"+e[t][0]+"-"+e[t][1]).position(),r=room.settings.zdetection()?room.settings.zdetection():$("#"+e[t][0]+"-"+e[t][1]).attr("data-z");
							e[t][3]==="up"?$(room.player_body()).spState(2):e[t][3]==="down"?$(room.player_body()).spState(3):e[t][3]==="right"?
							$(room.player_body()).spState(4):e[t][3]==="left"&&$(room.player_body()).spState(5);$(room.player()).attr("data-x",e[t][0]).attr("data-y",e[t][1]).css(
							"z-index",r).animate({left:n.left,top:n.top},room.settings.player_speed,"linear",function(){t++;go(e,t)})
						}else{
							$(room.player_body()).spStop(!0);
							get_direction=$(room.player_body()).css("background-position"),direction=get_direction.substr(-6,4);
							room.center(!0,1e3);
							direction=="-310"?room.player_body().css("background-position","0 0"):direction=="-620"?room.player_body().css("background-position","-620px 0"):direction=="-930"?
							room.player_body().css("background-position","-930px 0"):direction=="1240"&&room.player_body().css("background-position","-310px 0");
							room.the_player.go_to.settings.action()&&room.the_player.go_to.settings.action();
							room.the_player.go_to.start({target:!1,action:function(){!1}});room.the_player.footsteps()
						}
					};go(room.the_player.AStar(r,[t,n],[i,s]))
				}
			}
};