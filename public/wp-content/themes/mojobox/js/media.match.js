/*! MediaMatch v.2.0.3 - Testing css media queries in Javascript. Authors & copyright (c) 2013: WebLinc, David Knight. */
window.matchMedia||(window.matchMedia=function(e){"use strict";var t=e.document,i=t.documentElement,n=[],s=0,r="",l={},a=/\s*(only|not)?\s*(screen|print|[a-z\-]+)\s*(and)?\s*/i,c=/^\s*\(\s*(-[a-z]+-)?(min-|max-)?([a-z\-]+)\s*(:?\s*([0-9]+(\.[0-9]+)?|portrait|landscape)(px|em|dppx|dpcm|rem|%|in|cm|mm|ex|pt|pc|\/([0-9]+(\.[0-9]+)?))?)?\s*\)\s*$/,d=0,o=function(e){var t=-1!==e.indexOf(",")&&e.split(",")||[e],i=t.length-1,n=i,s=null,d=null,o="",m=0,h=!1,p="",u="",f=null,x=0,v=0,g=null,w="",y="",b="",z="",q="",C=!1;if(""===e)return!0;do if(s=t[n-i],h=!1,d=s.match(a),d&&(o=d[0],m=d.index),!d||-1===s.substring(0,m).indexOf("(")&&(m||!d[3]&&o!==d.input))C=!1;else{if(u=s,h="not"===d[1],m||(p=d[2],u=s.substring(o.length)),C=p===r||"all"===p||""===p,f=-1!==u.indexOf(" and ")&&u.split(" and ")||[u],x=f.length-1,v=x,C&&x>=0&&""!==u)do{if(g=f[x].match(c),!g||!l[g[3]]){C=!1;break}if(w=g[2],y=g[5],z=y,b=g[7],q=l[g[3]],b&&(z="px"===b?Number(y):"em"===b||"rem"===b?16*y:g[8]?(y/g[8]).toFixed(2):"dppx"===b?96*y:"dpcm"===b?.3937*y:Number(y)),C="min-"===w&&z?q>=z:"max-"===w&&z?z>=q:z?q===z:!!q,!C)break}while(x--);if(C)break}while(i--);return h?!C:C},m=function(){var t=e.innerWidth||i.clientWidth,n=e.innerHeight||i.clientHeight,s=e.screen.width,r=e.screen.height,a=e.screen.colorDepth,c=e.devicePixelRatio;l.width=t,l.height=n,l["aspect-ratio"]=(t/n).toFixed(2),l["device-width"]=s,l["device-height"]=r,l["device-aspect-ratio"]=(s/r).toFixed(2),l.color=a,l["color-index"]=Math.pow(2,a),l.orientation=n>=t?"portrait":"landscape",l.resolution=c&&96*c||e.screen.deviceXDPI||96,l["device-pixel-ratio"]=c||1},h=function(){clearTimeout(d),d=setTimeout(function(){var t=null,i=s-1,r=i,l=!1;if(i>=0){m();do if(t=n[r-i],t&&(l=o(t.mql.media),(l&&!t.mql.matches||!l&&t.mql.matches)&&(t.mql.matches=l,t.listeners)))for(var a=0,c=t.listeners.length;c>a;a++)t.listeners[a]&&t.listeners[a].call(e,t.mql);while(i--)}},10)},p=function(){var i=t.getElementsByTagName("head")[0],n=t.createElement("style"),s=null,l=["screen","print","speech","projection","handheld","tv","braille","embossed","tty"],a=0,c=l.length,d="#mediamatchjs { position: relative; z-index: 0; }",o="",p=e.addEventListener||(o="on")&&e.attachEvent;for(n.type="text/css",n.id="mediamatchjs",i.appendChild(n),s=e.getComputedStyle&&e.getComputedStyle(n)||n.currentStyle;c>a;a++)d+="@media "+l[a]+" { #mediamatchjs { position: relative; z-index: "+a+" } }";n.styleSheet?n.styleSheet.cssText=d:n.textContent=d,r=l[1*s.zIndex||0],i.removeChild(n),m(),p(o+"resize",h,!1),p(o+"orientationchange",h,!1)};return p(),function(e){var t=s,i={matches:!1,media:e,addListener:function(e){n[t].listeners||(n[t].listeners=[]),e&&n[t].listeners.push(e)},removeListener:function(e){var i=n[t],s=0,r=0;if(i)for(r=i.listeners.length;r>s;s++)i.listeners[s]===e&&i.listeners.splice(s,1)}};return""===e?(i.matches=!0,i):(i.matches=o(e),s=n.push({mql:i,listeners:null}),i)}}(window));