  /*--------------------------------------------------- */
  /* ナビゲーションメニュー
  /*--------------------------------------------------- */
  // navi1
  $(function(){
      $('#nav_toggle').click(function(){
          $("header").toggleClass('open');
          $("nav").slideToggle(500);
      });

  });

  //navi2
  // $(function() {
  //   $('#nav_toggle').click(function() {
  //     $('body').toggleClass('open');
  //   });

  // });





  /*--------------------------------------------------- */
  /* スマホの時だけtelリンクを有効
  /*--------------------------------------------------- */

  if (navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)) {
    $(function() {
      $('.tel').each(function() {
        //.tel内のHTMLを取得
        var str = $(this).html();
        //子要素がimgだった場合、alt属性を取得して電話番号リンクを追加
        if ($(this).children().is('img')) {
          $(this).html($('<a>').attr('href', 'tel:' + $(this).children().attr('alt').replace(/-/g, '')).append(str + '</a>'));
        } else {
          //それ以外はテキストを取得して電話番号リンクを追加
           $(this).html($('<a>').attr('href', 'tel:' + $(this).text().replace(/-/g, '')).append(str + '</a>'));
        }
      });
    });
  }
  if (navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)) {
    $(function() {
      $('.tel2').each(function() {
        var str = $(this).html();
        if ($(this).text()) {
          $(this).html($('<a>').attr('href', 'tel:' + $(this).attr('alt').replace(/-/g, '')).append(str + '</a>'));
        }
      });
    });
  }

  /*--------------------------------------------------- */
  /* 固定ヘッダー
  /*--------------------------------------------------- */
  $(function() {
    var headNav = $(".headFix");
    var height = headNav.outerHeight(true); //headerの高さを取得
    $(window).on('load scroll', function() { //scrollだけだと読み込み時困るのでloadも追加
      //現在の位置が500px以上かつ、クラスwhiteが付与されていない時
      if ($(this).scrollTop() > 500 && headNav.hasClass('white') == false) {
        headNav.css({
          "top": '-100px'
        });
        $('main').css({
          "margin-top": height
        });
        headNav.addClass('white'); //クラスwhiteを付与
        headNav.animate({
          "top": 0
        }, 400); //位置を0に設定し、アニメーションのスピードを指定
      }

      //現在の位置が100px以下かつ、クラスwhiteが付与されている時
      else if ($(this).scrollTop() < 100 && headNav.hasClass('white') == true) {
        headNav.removeClass('white');
        $('main').css({
          "margin-top": 0
        });
      }
    });
  });




  /*-------------------------------------
    gotoTop
    -------------------------------------*/

    $(function() {

      var showFlag = false;

      var topBtn = $('#footGoto');

      topBtn.css('bottom', '-200px');

      var showFlag = false;

    //スクロールが100～に達したらボタン表示

    $(window).scroll(function() {

      if ($(this).scrollTop() > 400) {

        if (showFlag == false) {

          showFlag = true;

          topBtn.stop().animate({
            'bottom': '60px'
          }, 200);

        }

      } else {

        if (showFlag) {

          showFlag = false;

          topBtn.stop().animate({
            'bottom': '-100px'
          }, 200);

        }

      }

    });

    //スクロールしてトップ

    topBtn.click(function() {

      $('body,html').animate({

        scrollTop: 0

      }, 400);

      return false;

    });

  });





    /*--------------------------------------------------- */
  /* 個別のjquery
  /*--------------------------------------------------- */

  $(function() {
    $('.hoverImg')

    .find('img').hover(
      function() {
        $(this).stop().animate({'opacity': '0'}, 400);
      },
      function() {
        $(this).stop().animate({'opacity': '1'}, 400);

      }
      );
  });

/*--------------------------------------------------- */
/* スムーズスクロール
/*--------------------------------------------------- */

$(function(){
  $('a[href^="#"]').click(function(){
    var speed = 500;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });
});


//別ページへ推移する場合のアンカーリンク
$(function(){
var headerHeight = $('header').outerHeight();
var urlHash = location.hash;
if(urlHash) {
    $('body,html').stop().scrollTop(0);
    setTimeout(function(){
        var target = $(urlHash);
        var position = target.offset().top;
        $('body,html').stop().animate({scrollTop:position}, 0);
    }, 100);
}

});

//Retina-Srcset.js
$(function(){
  var retinaCheck = window.devicePixelRatio;
  if(retinaCheck >= 2) { // Retinaディスプレイのときを分岐させている
    $('img.retina').each( function() {
      var retinaimg = $(this).attr('src').replace(/\.(?=(?:png|jpg|jpeg)$)/i, '@2x.');
      $(this).attr('srcset', retinaimg + " 2x");
    });
  }
});