/****************************************************
 * Card Designer Bric
 * Made for Blocs app for Mac
 * Author: Whittfield Holmes
 * Last Modified Date: August 3, 2020 8:00pm CST
*****************************************************/

(function($) {
  $('.cd-swiper-slide').removeClass('preview');
  $('.cd-swiper-container').each(function(i) {
      $(this).removeClass('swiper1');
      $(this).addClass('swiper' + ++i);
  });
  $('.card-designer .swiper-pagination').each(function(i) {
      $(this).removeClass('swiper-pagination1');
      $(this).addClass('swiper-pagination' + ++i);
  });



  $(".cd-title a[aria-disabled='true'], .cd-button[aria-disabled='true']").click(function(e){
      e.preventDefault();
  });

  //var swiperCard = parseInt($(".card-designer").length);
  //console.log("No. of cards = "+ swiperCard);
  //console.log("Top slide count = "+ ++swiperSlide);

  var swiperSlide = parseInt($(".cd-swiper-container .cd-swiper-slide + .cd-swiper-slide").length);
  if ( swiperSlide == 0 || swiperSlide == undefined){
    //do nothing
  } else if (swiperSlide > 0){
      var swiper1 = new Swiper(".cd-container[data-nav-style='fade-bullets'] .cd-swiper-container", {
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
      spaceBetween: 0,
      speed: 600,
      watchOverflow: true,
      grabCursor: true,
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + "&bull;" + '</span>';
        },
      },
      autoplay: {
        disableOnInteraction: false,
      },
      a11y: {
        prevSlideMessage: 'Previous slide',
        nextSlideMessage: 'Next slide',
        paginationBulletMessage: 'Go to slide {{index}}',
        notificationClass: 'swiper-notification'
      }
    });

    var swiper2 = new Swiper('.cd-container[data-nav-style="slide-bullets"] .cd-swiper-container', {
      effect: 'slide',
      spaceBetween: 0,
      watchOverflow: true,
      grabCursor: true,
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + "&bull;" + '</span>';
        },
      },
      autoplay: {
        disableOnInteraction: false,
      },
      a11y: {
        prevSlideMessage: 'Previous slide',
        nextSlideMessage: 'Next slide',
        paginationBulletMessage: 'Go to slide {{index}}',
        notificationClass: 'swiper-notification'
      }
    });

    var swiper3 = new Swiper('.cd-container[data-nav-style="fade-fraction"] .cd-swiper-container', {
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
      spaceBetween: 0,
      speed: 600,
      watchOverflow: true,
      grabCursor: true,
      pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
        renderFraction: function (currentClass, totalClass) {
            return '<span class="' + currentClass + '"></span>' +
                   ' / ' +
                   '<span class="' + totalClass + '"></span>';
        },
      },
      autoplay: {
        disableOnInteraction: false,
      },
      a11y: {
        prevSlideMessage: 'Previous slide',
        nextSlideMessage: 'Next slide',
        paginationBulletMessage: 'Go to slide {{index}}',
        notificationClass: 'swiper-notification'
      }
    });

    var swiper4 = new Swiper('.cd-container[data-nav-style="slide-fraction"] .cd-swiper-container', {
      effect: 'slide',
      spaceBetween: 0,
      watchOverflow: true,
      grabCursor: true,
      pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
        renderFraction: function (currentClass, totalClass) {
            return '<span class="' + currentClass + '"></span>' +
                   ' / ' +
                   '<span class="' + totalClass + '"></span>';
        },
      },
      autoplay: {
        disableOnInteraction: false,
      },
      a11y: {
        prevSlideMessage: 'Previous slide',
        nextSlideMessage: 'Next slide',
        paginationBulletMessage: 'Go to slide {{index}}',
        notificationClass: 'swiper-notification'
      }
    });

    var swiper5 = new Swiper('.cd-container[data-nav-style="fade-progress"] .cd-swiper-container', {
      effect: 'fade',
      spaceBetween: 0,
      speed: 600,
      watchOverflow: true,
      grabCursor: true,
      pagination: {
        el: '.swiper-pagination',
        type: 'progressbar',
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + "&bull;" + '</span>';
        },
      },
      autoplay: {
        disableOnInteraction: false,
      },
      fadeEffect: {
        crossFade: true,
      },
    });

    var swiper6 = new Swiper('.cd-container[data-nav-style="slide-progress"] .cd-swiper-container', {
      effect: 'slide',
      spaceBetween: 0,
      speed: 600,
      watchOverflow: true,
      grabCursor: true,
      pagination: {
        el: '.swiper-pagination',
        type: 'progressbar',
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + "&bull;" + '</span>';
        },
      },
      autoplay: {
        disableOnInteraction: false,
      },
      fadeEffect: {
        crossFade: true,
      },
    });

  };
  /*! npm.im/object-fit-images 3.2.4 */
  var objectFitImages=function(){"use strict";function t(t,e){return"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='"+t+"' height='"+e+"'%3E%3C/svg%3E"}function e(t){if(t.srcset&&!p&&window.picturefill){var e=window.picturefill._;t[e.ns]&&t[e.ns].evaled||e.fillImg(t,{reselect:!0}),t[e.ns].curSrc||(t[e.ns].supported=!1,e.fillImg(t,{reselect:!0})),t.currentSrc=t[e.ns].curSrc||t.src}}function i(t){for(var e,i=getComputedStyle(t).fontFamily,r={};null!==(e=u.exec(i));)r[e[1]]=e[2];return r}function r(e,i,r){var n=t(i||1,r||0);b.call(e,"src")!==n&&h.call(e,"src",n)}function n(t,e){t.naturalWidth?e(t):setTimeout(n,100,t,e)}function c(t){var c=i(t),o=t[l];if(c["object-fit"]=c["object-fit"]||"fill",!o.img){if("fill"===c["object-fit"])return;if(!o.skipTest&&f&&!c["object-position"])return}if(!o.img){o.img=new Image(t.width,t.height),o.img.srcset=b.call(t,"data-ofi-srcset")||t.srcset,o.img.src=b.call(t,"data-ofi-src")||t.src,h.call(t,"data-ofi-src",t.src),t.srcset&&h.call(t,"data-ofi-srcset",t.srcset),r(t,t.naturalWidth||t.width,t.naturalHeight||t.height),t.srcset&&(t.srcset="");try{s(t)}catch(t){window.console&&console.warn("https://bit.ly/ofi-old-browser")}}e(o.img),t.style.backgroundImage='url("'+(o.img.currentSrc||o.img.src).replace(/"/g,'\\"')+'")',t.style.backgroundPosition=c["object-position"]||"center",t.style.backgroundRepeat="no-repeat",t.style.backgroundOrigin="content-box",/scale-down/.test(c["object-fit"])?n(o.img,function(){o.img.naturalWidth>t.width||o.img.naturalHeight>t.height?t.style.backgroundSize="contain":t.style.backgroundSize="auto"}):t.style.backgroundSize=c["object-fit"].replace("none","auto").replace("fill","100% 100%"),n(o.img,function(e){r(t,e.naturalWidth,e.naturalHeight)})}function s(t){var e={get:function(e){return t[l].img[e?e:"src"]},set:function(e,i){return t[l].img[i?i:"src"]=e,h.call(t,"data-ofi-"+i,e),c(t),e}};Object.defineProperty(t,"src",e),Object.defineProperty(t,"currentSrc",{get:function(){return e.get("currentSrc")}}),Object.defineProperty(t,"srcset",{get:function(){return e.get("srcset")},set:function(t){return e.set(t,"srcset")}})}function o(){function t(t,e){return t[l]&&t[l].img&&("src"===e||"srcset"===e)?t[l].img:t}d||(HTMLImageElement.prototype.getAttribute=function(e){return b.call(t(this,e),e)},HTMLImageElement.prototype.setAttribute=function(e,i){return h.call(t(this,e),e,String(i))})}function a(t,e){var i=!y&&!t;if(e=e||{},t=t||"img",d&&!e.skipTest||!m)return!1;"img"===t?t=document.getElementsByTagName("img"):"string"==typeof t?t=document.querySelectorAll(t):"length"in t||(t=[t]);for(var r=0;r<t.length;r++)t[r][l]=t[r][l]||{skipTest:e.skipTest},c(t[r]);i&&(document.body.addEventListener("load",function(t){"IMG"===t.target.tagName&&a(t.target,{skipTest:e.skipTest})},!0),y=!0,t="img"),e.watchMQ&&window.addEventListener("resize",a.bind(null,t,{skipTest:e.skipTest}))}var l="bfred-it:object-fit-images",u=/(object-fit|object-position)\s*:\s*([-.\w\s%]+)/g,g="undefined"==typeof Image?{style:{"object-position":1}}:new Image,f="object-fit"in g.style,d="object-position"in g.style,m="background-size"in g.style,p="string"==typeof g.currentSrc,b=g.getAttribute,h=g.setAttribute,y=!1;return a.supportsObjectFit=f,a.supportsObjectPosition=d,o(),a}();

/*  // <![CDATA[
  $(function(){
    $(".cd-title a").each(function(i){
      len=$(this).html().length;
      if(len>75)
      {
        $(this).html($(this).html().substr(0,75)+'...');
      }
    });
  });
  // ]]>

  // <![CDATA[
  $(function(){
    $(".cd-caption span").each(function(i){
      len=$(this).html().length;
      if(len>130)
      {
        $(this).html($(this).html().substr(0,130)+'...');
      }
    });
  });
  // ]]>*/

})(jQuery);






(function($) {
  $('.cd-swiper-slide').removeClass('preview');
  $('.cd-container').on("mresize",function(){
      var $this=$(this);
      w= parseInt($this.width());
      var cd = $this.find(".card-designer");
      var capl = parseInt($this.find('.cd-caption').text().length);
      var title = $this.find(".cd-title");
      var link = $this.find(".cd-title a");
      var size = parseInt($this.attr("data-title-size"));
      var line = parseInt($this.attr("data-line-height"));
      if(w>350){
          cd.removeClass("md sm").addClass("lg");
          if($this.attr('data-responsive-title') == '1'){
              title.css({"font-size": size+"px"}).removeClass("sm md").addClass("lg");
              link.css({"line-height": line+"px"});
          }
      } else if(w>=250 && w<=350){
          cd.removeClass("sm lg").addClass("md");
          if($this.attr('data-responsive-title') == '1'){
              title.css({"font-size":""}).removeClass("lg sm").addClass("md");
              link.css({"line-height":""});
          }
      } else if(w<250){
          cd.removeClass("md lg").addClass("sm");
          if($this.attr('data-responsive-title') == '1'){
              title.css({"font-size":""}).removeClass("lg md").addClass("sm");
              link.css({"line-height":""});
          }
      }
      $this.find(".cd-output").first().html($this.width()+"x"+$this.height());
  }).trigger("mresize").throttle=0;
})(jQuery);