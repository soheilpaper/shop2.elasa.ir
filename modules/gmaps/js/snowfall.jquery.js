/**
 *
 * Color picker
 * Author: Stefan Petre www.eyecon.ro
 * 
 * Dual licensed under the MIT and GPL licenses
 * 
 */

(function(e){e.snowfall=function(t,n){function s(r,s,o,u,a){this.id=a;this.x=r;this.y=s;this.size=o;this.speed=u;this.step=0;this.stepSize=i(1,10)/100;if(n.collection){this.target=d[i(0,d.length-1)]}var h=e(document.createElement("div")).attr({"class":"snowfall-flakes",id:"flake-"+this.id}).css({width:this.size,height:this.size,background:n.flakeColor,position:"absolute",top:this.y,left:this.x,fontSize:0,zIndex:n.flakeIndex});if(e(t).get(0).tagName===e(document).get(0).tagName){e("body").append(h);t=e("body")}else{e(t).append(h)}this.element=document.getElementById("flake-"+this.id);this.update=function(){this.y+=this.speed;if(this.y>f-(this.size+6)){this.reset()}this.element.style.top=this.y+"px";this.element.style.left=this.x+"px";this.step+=this.stepSize;if(E===false){this.x+=Math.cos(this.step)}else{this.x+=E+Math.cos(this.step)}if(n.collection){if(this.x>this.target.x&&this.x<this.target.width+this.target.x&&this.y>this.target.y&&this.y<this.target.height+this.target.y){var e=this.target.element.getContext("2d"),t=this.x-this.target.x,r=this.y-this.target.y,i=this.target.colData;if(i[parseInt(t)][parseInt(r+this.speed+this.size)]!==undefined||r+this.speed+this.size>this.target.height){if(r+this.speed+this.size>this.target.height){while(r+this.speed+this.size>this.target.height&&this.speed>0){this.speed*=.5}e.fillStyle="#fff";if(i[parseInt(t)][parseInt(r+this.speed+this.size)]==undefined){i[parseInt(t)][parseInt(r+this.speed+this.size)]=1;e.fillRect(t,r+this.speed+this.size,this.size,this.size)}else{i[parseInt(t)][parseInt(r+this.speed)]=1;e.fillRect(t,r+this.speed,this.size,this.size)}this.reset()}else{this.speed=1;this.stepSize=0;if(parseInt(t)+1<this.target.width&&i[parseInt(t)+1][parseInt(r)+1]==undefined){this.x++}else if(parseInt(t)-1>0&&i[parseInt(t)-1][parseInt(r)+1]==undefined){this.x--}else{e.fillStyle="#fff";e.fillRect(t,r,this.size,this.size);i[parseInt(t)][parseInt(r)]=1;this.reset()}}}}}if(this.x>l-c||this.x<c){this.reset()}};this.reset=function(){this.y=0;this.x=i(c,l-c);this.stepSize=i(1,10)/100;this.size=i(n.minSize*100,n.maxSize*100)/100;this.speed=i(n.minSpeed,n.maxSpeed)}}function S(){for(a=0;a<o.length;a+=1){o[a].update()}h=setTimeout(function(){S()},30)}var r={flakeCount:35,flakeColor:"#ffffff",flakeIndex:999999,minSize:1,maxSize:2,minSpeed:1,maxSpeed:5,round:false,shadow:false,collection:false,collectionHeight:40,deviceorientation:false},n=e.extend(r,n),i=function(t,n){return Math.round(t+Math.random()*(n-t))};e(t).data("snowfall",this);var o=[],u=0,a=0,f=e(t).height(),l=e(t).width(),c=0,h=0;if(n.collection!==false){var p=document.createElement("canvas");if(!!(p.getContext&&p.getContext("2d"))){var d=[],v=e(n.collection),m=n.collectionHeight;for(var a=0;a<v.length;a++){var g=v[a].getBoundingClientRect(),y=document.createElement("canvas"),b=[];if(g.top-m>0){document.body.appendChild(y);y.style.position="absolute";y.height=m;y.width=g.width;y.style.left=g.left+"px";y.style.top=g.top-m+"px";for(var w=0;w<g.width;w++){b[w]=[]}d.push({element:y,x:g.left,y:g.top-m,width:g.width,height:m,colData:b})}}}else{n.collection=false}}if(e(t).get(0).tagName===e(document).get(0).tagName){c=25}e(window).bind("resize",function(){f=e(t).height();l=e(t).width()});for(a=0;a<n.flakeCount;a+=1){u=o.length;o.push(new s(i(c,l-c),i(0,f),i(n.minSize*100,n.maxSize*100)/100,i(n.minSpeed,n.maxSpeed),u))}if(n.round){e(".snowfall-flakes").css({"-moz-border-radius":n.maxSize,"-webkit-border-radius":n.maxSize,"border-radius":n.maxSize})}if(n.shadow){e(".snowfall-flakes").css({"-moz-box-shadow":"1px 1px 1px #555","-webkit-box-shadow":"1px 1px 1px #555","box-shadow":"1px 1px 1px #555"})}var E=false;if(n.deviceorientation){e(window).bind("deviceorientation",function(e){E=e.originalEvent.gamma*.1})}S();this.clear=function(){e(t).children(".snowfall-flakes").remove();o=[];clearTimeout(h)}};e.fn.snowfall=function(t){if(typeof t=="object"||t==undefined){return this.each(function(n){new e.snowfall(this,t)})}else if(typeof t=="string"){return this.each(function(t){var n=e(this).data("snowfall");if(n){n.clear()}})}}})(jQuery)