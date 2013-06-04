
// usage: log('inside coolFunc', this, arguments);
window.log = function(){
log.history = log.history || [];   // store logs to an array for reference
log.history.push(arguments);
if(this.console) {
arguments.callee = arguments.callee.caller;
console.log( Array.prototype.slice.call(arguments) );
}
};
(function(b){function c(){}for(var d="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),a;a=d.pop();)b[a]=b[a]||c})(window.console=window.console||{});


/*
 * jQuery Responsive menu plugin by Matt Kersley
 * Converts menus into a select elements for mobile devices and low browser widths
 * github.com/mattkersley/Responsive-Menu
 */
(function(b){var c=0;b.fn.mobileMenu=function(g){function f(a){return a.attr("id")?b("#mobileMenu_"+a.attr("id")).length>0:(c++,a.attr("id","mm"+c),b("#mobileMenu_mm"+c).length>0)}function h(a){a.hide();b("#mobileMenu_"+a.attr("id")).show()}function k(a){if(a.is("ul, ol")){var e='<select id="mobileMenu_'+a.attr("id")+'" class="mobileMenu">';e+='<option value="">'+d.topOptionText+"</option>";a.find("li").each(function(){var a="",c=b(this).parents("ul, ol").length;for(i=1;i<c;i++)a+=d.indentString;
c=b(this).find("a:first-child").attr("href");a+=b(this).clone().children("ul, ol").remove().end().text();e+='<option value="'+c+'">'+a+"</option>"});e+="</select>";a.parent().append(e);b("#mobileMenu_"+a.attr("id")).change(function(){var a=b(this);if(a.val()!==null)document.location.href=a.val()});h(a)}else alert("mobileMenu will only work with UL or OL elements!")}function j(a){b(window).width()<d.switchWidth&&!f(a)?k(a):b(window).width()<d.switchWidth&&f(a)?h(a):!(b(window).width()<d.switchWidth)&&
f(a)&&(a.show(),b("#mobileMenu_"+a.attr("id")).hide())}var d={switchWidth:768,topOptionText:"Select a page",indentString:"&nbsp;&nbsp;&nbsp;"};return this.each(function(){g&&b.extend(d,g);var a=b(this);b(window).resize(function(){j(a)});j(a)})}})(jQuery);


/**
 * Copyright (c) 2007-2012 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * @author Ariel Flesler
 * @version 1.4.3.1
 */
;(function($){var h=$.scrollTo=function(a,b,c){$(window).scrollTo(a,b,c)};h.defaults={axis:'xy',duration:parseFloat($.fn.jquery)>=1.3?0:1,limit:true};h.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(e,f,g){if(typeof f=='object'){g=f;f=0}if(typeof g=='function')g={onAfter:g};if(e=='max')e=9e9;g=$.extend({},h.defaults,g);f=f||g.duration;g.queue=g.queue&&g.axis.length>1;if(g.queue)f/=2;g.offset=both(g.offset);g.over=both(g.over);return this._scrollable().each(function(){if(e==null)return;var d=this,$elem=$(d),targ=e,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}$.each(g.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=h.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(g.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=g.offset[pos]||0;if(g.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*g.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(g.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&g.queue){if(old!=attr[key])animate(g.onAfterFirst);delete attr[key]}});animate(g.onAfter);function animate(a){$elem.animate(attr,f,g.easing,a&&function(){a.call(this,e,g)})}}).end()};h.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);



/*
 * jQuery Extended Selectors plugin. (c) Keith Clark freely distributable under the terms of the MIT license.
 * Adds missing -of-type pseudo-class selectors to jQuery
 * github.com/keithclark/JQuery-Extended-Selectors  -  twitter.com/keithclarkcouk  -  keithclark.co.uk
 */
(function(g){function e(a,b){for(var c=a,d=0;a=a[b];)c.tagName==a.tagName&&d++;return d}function h(a,b,c){a=e(a,c);if(b=="odd"||b=="even")c=2,a-=b!="odd";else{var d=b.indexOf("n");d>-1?(c=parseInt(b,10)||parseInt(b.substring(0,d)+"1",10),a-=(parseInt(b.substring(d+1),10)||0)-1):(c=a+1,a-=parseInt(b,10)-1)}return(c<0?a<=0:a>=0)&&a%c==0}var f={"first-of-type":function(a){return e(a,"previousSibling")==0},"last-of-type":function(a){return e(a,"nextSibling")==0},"only-of-type":function(a){return f["first-of-type"](a)&&
f["last-of-type"](a)},"nth-of-type":function(a,b,c){return h(a,c[3],"previousSibling")},"nth-last-of-type":function(a,b,c){return h(a,c[3],"nextSibling")}};g.extend(g.expr[":"],f)})(jQuery);


/*! http://mths.be/placeholder v1.8.5 by @mathias */
(function(g,a,$){var f='placeholder' in a.createElement('input'),b='placeholder' in a.createElement('textarea');if(f&&b){$.fn.placeholder=function(){return this};$.fn.placeholder.input=$.fn.placeholder.textarea=true}else{$.fn.placeholder=function(){return this.filter((f?'textarea':':input')+'[placeholder]').bind('focus.placeholder',c).bind('blur.placeholder',e).trigger('blur.placeholder').end()};$.fn.placeholder.input=f;$.fn.placeholder.textarea=b;$(function(){$('form').bind('submit.placeholder',function(){var h=$('.placeholder',this).each(c);setTimeout(function(){h.each(e)},10)})});$(g).bind('unload.placeholder',function(){$('.placeholder').val('')})}function d(i){var h={},j=/^jQuery\d+$/;$.each(i.attributes,function(l,k){if(k.specified&&!j.test(k.name)){h[k.name]=k.value}});return h}function c(){var h=$(this);if(h.val()===h.attr('placeholder')&&h.hasClass('placeholder')){if(h.data('placeholder-password')){h.hide().next().show().focus().attr('id',h.removeAttr('id').data('placeholder-id'))}else{h.val('').removeClass('placeholder')}}}function e(){var l,k=$(this),h=k,j=this.id;if(k.val()===''){if(k.is(':password')){if(!k.data('placeholder-textinput')){try{l=k.clone().attr({type:'text'})}catch(i){l=$('<input>').attr($.extend(d(this),{type:'text'}))}l.removeAttr('name').data('placeholder-password',true).data('placeholder-id',j).bind('focus.placeholder',c);k.data('placeholder-textinput',l).data('placeholder-id',j).before(l)}k=k.removeAttr('id').hide().prev().attr('id',j).show()}k.addClass('placeholder').val(k.attr('placeholder'))}else{k.removeClass('placeholder')}}}(this,document,jQuery));

(function($,sr){

  // Smart resize
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100);
      };
  }
    // smartresize
    jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');

/*
jquery.animate-enhanced plugin v0.98
---
http://github.com/benbarnett/jQuery-Animate-Enhanced
http://benbarnett.net
@benpbarnett
*/
(function(c,I,J){function O(a,b,c,e,l,k,f,p,q){var t=!1,f=!0===f&&!0===p,b=b||{};b.original||(b.original={},t=!0);b.properties=b.properties||{};b.secondary=b.secondary||{};for(var p=b.meta,m=b.original,g=b.properties,P=b.secondary,B=r.length-1;0<=B;B--){var D=r[B]+"transition-property",E=r[B]+"transition-duration",h=r[B]+"transition-timing-function",c=f?r[B]+"transform":c;t&&(m[D]=a.css(D)||"",m[E]=a.css(E)||"",m[h]=a.css(h)||"");P[c]=f?(!0===q||!0===y&&!1!==q)&&K?"translate3d("+p.left+"px, "+p.top+
"px, 0)":"translate("+p.left+"px,"+p.top+"px)":k;g[D]=(g[D]?g[D]+",":"")+c;g[E]=(g[E]?g[E]+",":"")+e+"ms";g[h]=(g[h]?g[h]+",":"")+l}return b}function z(a){for(var c in a)return!1;return!0}function G(a){return parseFloat(a.replace(a.match(/\D+$/),""))}function L(a){var c=!0;a.each(function(a,e){return c=c&&e.ownerDocument});return c}var Q="top right bottom left opacity height width".split(" "),H=["top","right","bottom","left"],r=["-webkit-","-moz-","-o-",""],R=["avoidTransforms","useTranslate3d","leaveTransforms"],
S=/^([+-]=)?([\d+-.]+)(.*)$/,T=/([A-Z])/g,U={secondary:{},meta:{top:0,right:0,bottom:0,left:0}},M=null,F=!1,A=(document.body||document.documentElement).style,N=void 0!==A.WebkitTransition||void 0!==A.MozTransition||void 0!==A.OTransition||void 0!==A.transition,K="WebKitCSSMatrix"in window&&"m11"in new WebKitCSSMatrix,y=K;c.expr&&c.expr.filters&&(M=c.expr.filters.animated,c.expr.filters.animated=function(a){return c(a).data("events")&&c(a).data("events")["webkitTransitionEnd oTransitionEnd transitionend"]?
!0:M.call(this,a)});c.extend({toggle3DByDefault:function(){return y=!y},toggleDisabledByDefault:function(){return F=!F}});c.fn.translation=function(){if(!this[0])return null;var a=window.getComputedStyle(this[0],null),c={x:0,y:0};if(a)for(var n=r.length-1;0<=n;n--){var e=a.getPropertyValue(r[n]+"transform");if(e&&/matrix/i.test(e)){a=e.replace(/^matrix\(/i,"").split(/, |\)$/g);c={x:parseInt(a[4],10),y:parseInt(a[5],10)};break}}return c};c.fn.animate=function(a,b,n,e){var a=a||{},l=!("undefined"!==
typeof a.bottom||"undefined"!==typeof a.right),k=c.speed(b,n,e),f=this,p=0,q=function(){p--;0===p&&"function"===typeof k.complete&&k.complete.apply(f,arguments)},t;if(!(t=!0===("undefined"!==typeof a.avoidCSSTransitions?a.avoidCSSTransitions:F)))if(!(t=!N))if(!(t=z(a))){var m;a:{for(m in a)if(("width"==m||"height"==m)&&("show"==a[m]||"hide"==a[m]||"toggle"==a[m])){m=!0;break a}m=!1}t=m||0>=k.duration||!0===c.fn.animate.defaults.avoidTransforms&&!1!==a.avoidTransforms}return t?I.apply(this,arguments):
this[!0===k.queue?"queue":"each"](function(){var g=c(this),b=c.extend({},k),f=function(b){var e=g.data("jQe")||{original:{}},d={};if(2==b.eventPhase){if(!0!==a.leaveTransforms){for(b=r.length-1;0<=b;b--)d[r[b]+"transform"]="";if(l&&"undefined"!==typeof e.meta)for(var b=0,f;f=H[b];++b)d[f]=e.meta[f+"_o"]+"px",c(this).css(f,d[f])}g.unbind("webkitTransitionEnd oTransitionEnd transitionend").css(e.original).css(d).data("jQe",null);"hide"===a.opacity&&g.css({display:"none",opacity:""});q.call(this)}},
e={bounce:"cubic-bezier(0.0, 0.35, .5, 1.3)",linear:"linear",swing:"ease-in-out",easeInQuad:"cubic-bezier(0.550, 0.085, 0.680, 0.530)",easeInCubic:"cubic-bezier(0.550, 0.055, 0.675, 0.190)",easeInQuart:"cubic-bezier(0.895, 0.030, 0.685, 0.220)",easeInQuint:"cubic-bezier(0.755, 0.050, 0.855, 0.060)",easeInSine:"cubic-bezier(0.470, 0.000, 0.745, 0.715)",easeInExpo:"cubic-bezier(0.950, 0.050, 0.795, 0.035)",easeInCirc:"cubic-bezier(0.600, 0.040, 0.980, 0.335)",easeInBack:"cubic-bezier(0.600, -0.280, 0.735, 0.045)",
easeOutQuad:"cubic-bezier(0.250, 0.460, 0.450, 0.940)",easeOutCubic:"cubic-bezier(0.215, 0.610, 0.355, 1.000)",easeOutQuart:"cubic-bezier(0.165, 0.840, 0.440, 1.000)",easeOutQuint:"cubic-bezier(0.230, 1.000, 0.320, 1.000)",easeOutSine:"cubic-bezier(0.390, 0.575, 0.565, 1.000)",easeOutExpo:"cubic-bezier(0.190, 1.000, 0.220, 1.000)",easeOutCirc:"cubic-bezier(0.075, 0.820, 0.165, 1.000)",easeOutBack:"cubic-bezier(0.175, 0.885, 0.320, 1.275)",easeInOutQuad:"cubic-bezier(0.455, 0.030, 0.515, 0.955)",easeInOutCubic:"cubic-bezier(0.645, 0.045, 0.355, 1.000)",
easeInOutQuart:"cubic-bezier(0.770, 0.000, 0.175, 1.000)",easeInOutQuint:"cubic-bezier(0.860, 0.000, 0.070, 1.000)",easeInOutSine:"cubic-bezier(0.445, 0.050, 0.550, 0.950)",easeInOutExpo:"cubic-bezier(1.000, 0.000, 0.000, 1.000)",easeInOutCirc:"cubic-bezier(0.785, 0.135, 0.150, 0.860)",easeInOutBack:"cubic-bezier(0.680, -0.550, 0.265, 1.550)"},m={},e=e[b.easing||"swing"]?e[b.easing||"swing"]:b.easing||"swing",h;for(h in a)if(-1===c.inArray(h,R)){var n=-1<c.inArray(h,H),i;var j=g,w=a[h],u=h,s=n&&!0!==
a.avoidTransforms;if("d"==u)i=void 0;else if(L(j)){var d=S.exec(w);i="auto"===j.css(u)?0:j.css(u);i="string"==typeof i?G(i):i;"string"==typeof w&&G(w);var s=!0===s?0:i,t=j.is(":hidden"),v=j.translation();"left"==u&&(s=parseInt(i,10)+v.x);"right"==u&&(s=parseInt(i,10)+v.x);"top"==u&&(s=parseInt(i,10)+v.y);"bottom"==u&&(s=parseInt(i,10)+v.y);!d&&"show"==w?(s=1,t&&j.css({display:"block",opacity:0})):!d&&"hide"==w&&(s=0);d?(j=parseFloat(d[2]),d[1]&&(j=("-="===d[1]?-1:1)*j+parseInt(s,10)),i=j):i=s}else i=
void 0;if(d=!0!==a.avoidTransforms)if(d=h,j=i,w=g,L(w)){u=-1<c.inArray(d,Q);if(("width"==d||"height"==d||"opacity"==d)&&parseFloat(j)===parseFloat(w.css(d)))u=!1;d=u}else d=!1;if(d){d=g;j=h;w=b.duration;u=e;i=n&&!0===a.avoidTransforms?i+"px":i;var n=n&&!0!==a.avoidTransforms,s=l,t=!0===a.useTranslate3d,v=(v=d.data("jQe"))&&!z(v)?v:c.extend(!0,{},U),x=i;if(-1<c.inArray(j,H)){var C=v.meta,A=G(d.css(j))||0,y=j+"_o",x=i-A;C[j]=x;C[y]="auto"==d.css(j)?0+x:A+x||0;v.meta=C;s&&0===x&&(x=0-C[y],C[j]=x,C[y]=
0)}d.data("jQe",O(d,v,j,w,u,x,n,s,t))}else m[h]=a[h]}g.unbind("webkitTransitionEnd oTransitionEnd transitionend");if((h=g.data("jQe"))&&!z(h)&&!z(h.secondary)){p++;g.css(h.properties);var F=h.secondary;setTimeout(function(){g.bind("webkitTransitionEnd oTransitionEnd transitionend",f).css(F)})}else b.queue=!1;z(m)||(p++,I.apply(g,[m,{duration:b.duration,easing:c.easing[b.easing]?b.easing:c.easing.swing?"swing":"linear",complete:q,queue:b.queue}]));return!0})};c.fn.animate.defaults={};c.fn.stop=function(a,
b,n){if(!N)return J.apply(this,[a,b]);a&&this.queue([]);this.each(function(){var e=c(this),l=e.data("jQe");if(l&&!z(l)){var k,f={};if(b){if(f=l.secondary,!n&&void 0!==typeof l.meta.left_o||void 0!==typeof l.meta.top_o){f.left=void 0!==typeof l.meta.left_o?l.meta.left_o:"auto";f.top=void 0!==typeof l.meta.top_o?l.meta.top_o:"auto";for(k=r.length-1;0<=k;k--)f[r[k]+"transform"]=""}}else if(!z(l.secondary)){var p=window.getComputedStyle(e[0],null);if(p)for(var q in l.secondary)if(l.secondary.hasOwnProperty(q)&&
(q=q.replace(T,"-$1").toLowerCase(),f[q]=p.getPropertyValue(q),!n&&/matrix/i.test(f[q]))){k=f[q].replace(/^matrix\(/i,"").split(/, |\)$/g);f.left=parseFloat(k[4])+parseFloat(e.css("left"))+"px"||"auto";f.top=parseFloat(k[5])+parseFloat(e.css("top"))+"px"||"auto";for(k=r.length-1;0<=k;k--)f[r[k]+"transform"]=""}}e.unbind("webkitTransitionEnd oTransitionEnd transitionend");e.css(l.original).css(f).data("jQe",null)}else J.apply(e,[a,b])});return this}})(jQuery,jQuery.fn.animate,jQuery.fn.stop);


/**
 * @name jQuery Swipe plugin (https://github.com/jgarber623/jquery-swipe)
 * @author Jason Garber
 * @copyright (cc) Jason Garber (http://sixtwothree.org and http://www.viget.com)
 *
 * Licensed under the CC-GNU GPL (http://creativecommons.org/licenses/GPL/2.0/)
 */

;(function( $, window, document, undefined ) {

  var Swipe = function( elem, options ) {
    this.elem = elem;
    this.$elem = $( elem );
    this.options = options;
    this.metadata = this.$elem.data( "swipe-options" );
  };

  Swipe.prototype = {
    defaults: {
      left: function( event ) {},
      right: function( event ) {},
      threshold: {
        x: 100,
        y: 25
      }
    },

    init: function() {
      this.config = $.extend( {}, this.defaults, this.options, this.metadata );

      this.coords = {
        start: {
          x: 0,
          y: 0
        },
        end: {
          x: 0,
          y: 0
        }
      };

      if ( this.elem.addEventListener ) {
        this.elem.addEventListener( "touchcancel", $.proxy( this.touchCancel, this ), false );
        this.elem.addEventListener( "touchend", $.proxy( this.touchEnd, this ), false );
        this.elem.addEventListener( "touchmove", $.proxy( this.touchMove, this ), false );
        this.elem.addEventListener( "touchstart", $.proxy( this.touchStart, this ), false );
      }

      return this;
    },

    touchCancel: function( event ) {

    },

    touchEnd: function( event ) {
      var delta = {
        x: this.coords.start.x - this.coords.end.x,
        y: this.coords.start.y - this.coords.end.y
      };

      if ( delta.y < this.config.threshold.y && delta.y > ( this.config.threshold.y * -1 ) ) {
        if ( delta.x > this.config.threshold.x ) {
          this.config.left();
        }

        if ( delta.x < ( this.config.threshold.x * -1 ) ) {
          this.config.right();
        }
      }
    },

    touchMove: function( event ) {
      event.preventDefault();

      var touches = event.targetTouches[0];

      this.coords.end = {
        x: touches.pageX,
        y: touches.pageY
      };
    },

    touchStart: function( event ) {
      var touches = event.targetTouches[0];

      this.coords = {
        start: {
          x: touches.pageX,
          y: touches.pageY
        },
        end: {
          x: touches.pageX,
          y: touches.pageY
        }
      };
    }
  };

  Swipe.defaults = Swipe.prototype.defaults;

  $.fn.swipe = function( options ) {
    return this.each( function() {
      new Swipe( this, options ).init();
    });
  };

  // window.Swipe = Swipe;

})( jQuery, window , document );

/**
 *
 * Copyright (c) 2008 Tom Deater (http://www.tomdeater.com)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * uses an iframe, sized in ems, to detect font size changes then trigger a "fontresize" event
 * heavily based on code by Hedger Wang: http://www.hedgerwow.com/360/dhtml/js-onfontresize.html
 *
 * "fontresize" event is triggered on the document object
 * subscribe to event using: $(document).bind("fontresize", function (event, data) {});
 * "data" contains the current size of 1 em unit (in pixels)
 *
 */

jQuery.onFontResize = (function ($) {
  // initialize
  $(document).ready(function () {
    var $resizeframe = $("<iframe />")
      .attr("id", "frame-onFontResize" + Date.parse(new Date))
      .addClass("div-onfontresize")
      .css({width: "100em", height: "10px", position: "absolute", borderWidth: 0, top: "-5000px", left: "-5000px"})
      .appendTo("body");

    if ($.browser.msie) {
      // use IE's native iframe resize event
      $resizeframe.bind("resize", function () {
        $.onFontResize.trigger($resizeframe[0].offsetWidth / 100);
      });
    } else {
      // everyone else uses script inside the iframe to detect resize
      var doc = $resizeframe[0].contentWindow || $resizeframe[0].contentDocument || $resizeframe[0].document;
      doc = doc.document || doc;
      doc.open();
      doc.write('<scri' + 'pt>window.onload = function(){var em = parent.jQuery(".div-onfontresize")[0];window.onresize = function(){if(parent.jQuery.onFontResize){parent.jQuery.onFontResize.trigger(em.offsetWidth / 100);}}};</scri' + 'pt>');
      doc.close();
    }

    jQuery.onFontResize.initialSize = $resizeframe[0].offsetWidth / 100;
  });

  return {
    // public method, so it can be called from within the iframe
    trigger: function (em) {
      $(document).trigger("fontresize", [em]);
    }
  };
}) (jQuery);


/*!
 * jQuery Easing Molecules plugin v1.0.0
 * https://github.com/gilmoreorless/jquery-easing-molecules/
 * Open source under the MIT licence: http://gilmoreorless.mit-license.org/2011/
 * Original equations by Robert Penner under the BSD licence: http://robertpenner.com/easing_terms_of_use.html
 */
;(function ($, undefined) {
    var $e = $.easing,
        ease = 'ease';

    //// Setup

    function reverse(func) {
        return function (t) {
            return 1 - func(1 - t);
        }
    }

    function reflect(func) {
        return function (t) {
            return .5 * (t < .5 ? func(2 * t) : (2 - func(2 - 2 * t)));
        }
    }

    function build(name, easeInFunc, inOutTweak) {
        var basicFunc = inOutTweak ? easeInFunc() : easeInFunc,
            inOutFunc = inOutTweak ? easeInFunc(inOutTweak) : easeInFunc;
        $e[ease + 'In' + name] = basicFunc;
        $e[ease + 'Out' + name] = reverse(basicFunc);
        $e[ease + 'InOut' + name] = reflect(inOutFunc);
    }


    //// Easing functions

    function kapow(n) {
        return function (t) {
            return Math.pow(t, n);
        }
    }

    build('Quad',  kapow(2));
    build('Cubic', kapow(3));
    build('Quart', kapow(4));
    build('Quint', kapow(5));

    build('Sine', function (t) {
        return 1 - Math.cos(t * Math.PI / 2);
    });

    build('Expo', function (t) {
        return Math.pow(2, 10 * (t - 1));
    });

    build('Circ', function (t) {
        return 1 - Math.sqrt(1 - t * t);
    });

    var back = function (s) {
        if (s === undefined) s = 1.70158; // Penner's magic number #1
        return function (t) {
            return t * t * ((s + 1) * t - s);
        }
    }
    // easeInOutBack has a more exaggerated snap-back
    build('Back', back, 1.70158 * 1.525);

    build('Bounce', function (t) {
        var d = 2.75,
            m = 7.5625, // Penner's magic number #2
            e = 0;
        e = t < .25 / d ?
            m * (t -= .125 / d) * t + .984375 :
            t < .75 / d ?
                m * (t -= .5 / d) * t + .9375 :
                t < 1.75 / d ?
                    m * (t -= 1.25 / d) * t + .75 :
                    m * --t * t;
        return 1 - e;
    });

    var elastic = function (p) {
        if (p === undefined) p = .3;
        return function (t) {
            if (t == !!t) return t;
            var pi2 = 2 * Math.PI,
                s = p / pi2 * Math.asin(1);
            return -(Math.pow(2, 10 * --t) * Math.sin((t - s) * pi2 / p));
        }
    }
    // easeInOutElastic has a different modifier so it's not as exaggerated
    build('Elastic', elastic, .45);

})(jQuery);


(function ($) {

    $.fn.animateCSS = function (effect, delay, callback) {

        // Return this to maintain chainability
        return this.each(function () {

            // Cache $(this) for speed
            var $this = $(this);

            // Create a function we can call later
            function run() {

                // Add the animation effect with classes
                $this.addClass('animated ' + effect);

                // Check if the elemenr has been hidden to start with
                if ($this.css('visibility') == 'hidden') {

                    // If it has, show it (after the class has been added)
                    $this.css({
                        'visibility': 'visible'
                    });

                }

                // If the element is hidden
                if ($this.is(':hidden')) {

                    // Show it
                    $this.show();

                }

                // Event triggered when the animation has finished
                $this.bind('animationend webkitAnimationEnd oAnimationEnd', function () {

                    // Remove the classes so they can be added again later
                    $this.removeClass('animated ' + effect);

                    // Add a callback event
                    if (typeof callback == 'function') {

                        // Execute the callback
                        callback.call(this);

                        // Unbind the event handlers
                        $this.unbind('animationend webkitAnimationEnd oAnimationEnd');

                    }

                });

            }

            // Check if delay exists or if it's a callback
            if (!delay || typeof delay == 'function') {

                // If it's a callback, move it to callback so we can call it later
                callback = delay;

                // Run the animation (without delay)
                run();

            } else {

                // Start a counter so we can delay the animation if required
                var animation = setTimeout(function () {

                    // Run the animation (with delay)
                    run();

                // Specify the delay
                }, delay);

            }

        });

    };

})(jQuery);


/**
* @preserve FastClick: polyfill to remove click delays on browsers with touch UIs.
*
* @version 0.4.2
* @codingstandard ftlabs-jslint
* @copyright The Financial Times Limited [All Rights Reserved]
* @license MIT License (see LICENSE.txt)
*/
/*jslint browser:true, node:true*/
/*global define*/
/**
* Instantiate fast-clicking listeners on the specificed layer.
*
* @constructor
* @param {Element} layer The layer to listen on
*/
function FastClick(layer) {
    'use strict';
    var oldOnClick, that = this;


    /**
     * Whether a click is currently being tracked.
     *
     * @type boolean
     */
    this.trackingClick = false;


    /**
     * The element being tracked for a click.
     *
     * @type Element
     */
    this.targetElement = null;


    /**
     * The FastClick layer.
     *
     * @type Element
     */
    this.layer = layer;

    if (!layer || !layer.nodeType) {
        throw new TypeError('Layer must be a document node');
    }

    // Bind handlers to this instance
    this.onClick = function() {
        FastClick.prototype.onClick.apply(that, arguments);
    };
    this.onTouchStart = function() {
        FastClick.prototype.onTouchStart.apply(that, arguments);
    };
    this.onTouchMove = function() {
        FastClick.prototype.onTouchMove.apply(that, arguments);
    };
    this.onTouchEnd = function() {
        FastClick.prototype.onTouchEnd.apply(that, arguments);
    };
    this.onTouchCancel = function() {
        FastClick.prototype.onTouchCancel.apply(that, arguments);
    };

    // Devices that don't support touch don't need FastClick
    if (typeof window.ontouchstart === 'undefined') {
        return;
    }

    // Set up event handlers as required
    layer.addEventListener('click', this.onClick, true);
    layer.addEventListener('touchstart', this.onTouchStart, false);
    layer.addEventListener('touchmove', this.onTouchMove, false);
    layer.addEventListener('touchend', this.onTouchEnd, false);
    layer.addEventListener('touchcancel', this.onTouchCancel, false);

    // If a handler is already declared in the element's onclick attribute, it will be fired before
    // FastClick's onClick handler. Fix this by pulling out the user-defined handler function and
    // adding it as listener.
    if (typeof layer.onclick === 'function') {

        // Android browser on at least 3.2 requires a new reference to the function in layer.onclick
        // - the old one won't work if passed to addEventListener directly.
        oldOnClick = layer.onclick;
        layer.addEventListener('click', function(event) {
            oldOnClick(event);
        }, false);
        layer.onclick = null;
    }
}


/**
* Android requires an exception for labels.
*
* @type boolean
*/
FastClick.prototype.deviceIsAndroid = navigator.userAgent.indexOf('Android') > 0;


/**
* Determine whether a given element requires a native click.
*
* @param {Element} target Target DOM element
* @returns {boolean} Returns true if the element needs a native click
*/
FastClick.prototype.needsClick = function(target) {
    'use strict';
    switch (target.nodeName.toLowerCase()) {
    case 'label':
    case 'video':
        return true;
    default:
        return (/\bneedsclick\b/)
            .test(target.className);
    }
};


/**
* Determine whether a given element requires a call to focus to simulate click into element.
*
* @param {Element} target Target DOM element
* @returns {boolean} Returns true if the element requires a call to focus to simulate native click.
*/
FastClick.prototype.needsFocus = function(target) {
    'use strict';
    switch (target.nodeName.toLowerCase()) {
    case 'textarea':
    case 'select':
        return true;
    case 'input':
        switch (target.type) {
        case 'button':
        case 'checkbox':
        case 'file':
        case 'image':
        case 'radio':
        case 'submit':
            return false;
        }
        return true;
    default:
        return (/\bneedsfocus\b/)
            .test(target.className);
    }
};


/**
* Send a click event to the element if it needs it.
*
* @returns {boolean} Whether the click was sent or not
*/
FastClick.prototype.maybeSendClick = function(targetElement, event) {
    'use strict';
    var clickEvent, touch;

    // Prevent the actual click from going though - unless the target node is marked as requiring
    // real clicks or if it is in the whitelist in which case only non-programmatic clicks are permitted
    // to open the options list and so the original event is required.
    if (this.needsClick(targetElement)) {
        return false;
    }

    // On some Android devices activeElement needs to be blurred otherwise the synthetic click will have no effect (#24)
    if (document.activeElement && document.activeElement !== targetElement) {
        document.activeElement.blur();
    }

    touch = event.changedTouches[0];

    // Synthesise a click event, with an extra attribute so it can be tracked
    clickEvent = document.createEvent('MouseEvents');
    clickEvent.initMouseEvent('click', true, true, window, 1, touch.screenX, touch.screenY, touch.clientX, touch.clientY, false, false, false, false, 0, null);
    clickEvent.forwardedTouchEvent = true;
    targetElement.dispatchEvent(clickEvent);

    return true;
};


/**
* On touch start, record the position and scroll offset.
*
* @param {Event} event
* @returns {boolean}
*/
FastClick.prototype.onTouchStart = function(event) {
    'use strict';
    var touch = event.targetTouches[0];

    this.trackingClick = true;
    this.targetElement = event.target;

    this.touchStartX = touch.pageX;
    this.touchStartY = touch.pageY;

    return true;
};


/**
* Based on a touchmove event object, check whether the touch has moved past a boundary since it started.
*
* @param {Event} event
* @returns {boolean}
*/
FastClick.prototype.touchHasMoved = function(event) {
    'use strict';
    var touch = event.targetTouches[0];

    if (Math.abs(touch.pageX - this.touchStartX) > 10 || Math.abs(touch.pageY - this.touchStartY) > 10) {
        return true;
    }

    return false;
};


/**
* Update the last position.
*
* @param {Event} event
* @returns {boolean}
*/
FastClick.prototype.onTouchMove = function(event) {
    'use strict';
    if (!this.trackingClick) {
        return true;
    }

    // If the touch has moved, cancel the click tracking
    if (this.targetElement !== event.target || this.touchHasMoved(event)) {
        this.trackingClick = false;
        this.targetElement = null;
    }

    return true;
};


/**
* Attempt to find the labelled control for the given label element.
*
* @param {HTMLLabelElement} labelElement
* @returns {HTMLInputElement|null}
*/
FastClick.prototype.findControl = function(labelElement) {
    'use strict';

    // Fast path for newer browsers supporting the HTML5 control attribute
    if (labelElement.control !== undefined) {
        return labelElement.control;
    }

    // All browsers under test that support touch events also support the HTML5 htmlFor attribute
    if (labelElement.htmlFor) {
        return document.getElementById(labelElement.htmlFor);
    }

    // If no for attribute exists, attempt to retrieve the first labellable descendant element
    // the list of which is defined here: http://www.w3.org/TR/html5/forms.html#category-label
    return labelElement.querySelector('button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea');
};


/**
* On touch end, determine whether to send a click event at once.
*
* @param {Event} event
* @returns {boolean}
*/
FastClick.prototype.onTouchEnd = function(event) {
    'use strict';
    var forElement, targetElement = this.targetElement;

    if (!this.trackingClick) {
        return true;
    }

    this.trackingClick = false;

    if (targetElement.nodeName.toLowerCase() === 'label') {
        forElement = this.findControl(targetElement);
        if (forElement) {
            targetElement.focus();
            if (this.deviceIsAndroid) {
                return false;
            }

            if (this.maybeSendClick(forElement, event)) {
                event.preventDefault();
            }

            return false;
        }
    } else if (this.needsFocus(targetElement)) {
        targetElement.focus();
        if (targetElement.tagName.toLowerCase() !== 'select') {
            event.preventDefault();
        }
        return false;
    }

    if (!this.maybeSendClick(targetElement, event)) {
        return false;
    }

    event.preventDefault();
    return false;
};


/**
* On touch cancel, stop tracking the click.
*
* @returns {void}
*/
FastClick.prototype.onTouchCancel = function() {
    'use strict';
    this.trackingClick = false;
    this.targetElement = null;
};


/**
* On actual clicks, determine whether this is a touch-generated click, a click action occurring
* naturally after a delay after a touch (which needs to be cancelled to avoid duplication), or
* an actual click which should be permitted.
*
* @param {Event} event
* @returns {boolean}
*/
FastClick.prototype.onClick = function(event) {
    'use strict';
    var oldTargetElement;

    if (event.forwardedTouchEvent) {
        return true;
    }

    // If a target element was never set (because a touch event was never fired) allow the click
    if (!this.targetElement) {
        return true;
    }

    oldTargetElement = this.targetElement;
    this.targetElement = null;

    // Programmatically generated events targeting a specific element should be permitted
    if (!event.cancelable) {
        return true;
    }

    // Very odd behaviour on iOS (issue #18): if a submit element is present inside a form and the user hits enter in the iOS simulator or clicks the Go button on the pop-up OS keyboard the a kind of 'fake' click event will be triggered with the submit-type input element as the target.
    if (event.target.type === 'submit' && event.detail === 0) {
        return true;
    }

    // Derive and check the target element to see whether the click needs to be permitted;
    // unless explicitly enabled, prevent non-touch click events from triggering actions,
    // to prevent ghost/doubleclicks.
    if (!this.needsClick(oldTargetElement)) {

        // Prevent any user-added listeners declared on FastClick element from being fired.
        if (event.stopImmediatePropagation) {
            event.stopImmediatePropagation();
        }

        // Cancel the event
        event.stopPropagation();
        event.preventDefault();

        return false;
    }

    // If clicks are permitted, return true for the action to go through.
    return true;
};


/**
* Remove all FastClick's event listeners.
*
* @returns {void}
*/
FastClick.prototype.destroy = function() {
    'use strict';
    var layer = this.layer;

    layer.removeEventListener('click', this.onClick, true);
    layer.removeEventListener('touchstart', this.onTouchStart, false);
    layer.removeEventListener('touchmove', this.onTouchMove, false);
    layer.removeEventListener('touchend', this.onTouchEnd, false);
    layer.removeEventListener('touchcancel', this.onTouchCancel, false);
};


if (typeof define === 'function' && define.amd) {

    // AMD. Register as an anonymous module.
    define(function() {
        'use strict';
        return FastClick;
    });
}

if (typeof module !== 'undefined' && module.exports) {
    module.exports = function(layer) {
        'use strict';
        return new FastClick(layer);
    };

    module.exports.FastClick = FastClick;
}

/*! matchMedia() polyfill - Test a CSS media type/query in JS. Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas. Dual MIT/BSD license */

window.matchMedia = window.matchMedia || (function( doc, undefined ) {

  "use strict";

  var bool,
      docElem = doc.documentElement,
      refNode = docElem.firstElementChild || docElem.firstChild,
      // fakeBody required for <FF4 when executed in <head>
      fakeBody = doc.createElement( "body" ),
      div = doc.createElement( "div" );

  div.id = "mq-test-1";
  div.style.cssText = "position:absolute;top:-100em";
  fakeBody.style.background = "none";
  fakeBody.appendChild(div);

  return function(q){

    div.innerHTML = "&shy;<style media=\"" + q + "\"> #mq-test-1 { width: 42px; }</style>";

    docElem.insertBefore( fakeBody, refNode );
    bool = div.offsetWidth === 42;
    docElem.removeChild( fakeBody );
    return {
      matches: bool,
      media: q
    };

  };


}( document ));

;(function($, undefined) {
    
$.fn.cssAnimationEnd = function( callback ) {
    var $this = this;
    if( $this.length > 0 ) {
        $this.bind('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function( e ){
            if ( $.isFunction( callback ) ) {
                callback.call( $this, e );
            }
        });
    }
    return $this;
};

})(jQuery);
(function($, undefined) {
    
$.fn.cssTransitionEnd = function( callback ) {
    var $this = this;
    if( $this.length > 0 ) {
        $this.bind('transitionend webkitTransitionEnd MSTransitionEnd oTransitionEnd', function( e ){
            if ( $.isFunction( callback ) ) {
                callback.call( $this, e );
            }
        });
    }
    return $this;
};

})(jQuery);