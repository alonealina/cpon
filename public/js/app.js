// 以下メニューバー切り替えについて（保留）
// let menuRecommend = document.querySelector(".menu_recommend");
// let menuAll = document.querySelector(".menu_all");
// let menuListRecommend = document.getElementById("menu_list_recommend");
// let menuListAll = document.getElementById("menu_list_all");
// menuRecommend.addEventListener("click", function () {
//     menuRecommend.classList.add("current");
//     menuAll.classList.remove("current");
//     menuListRecommend.hidden = false;
//     menuListAll.hidden = true;
// });

// menuAll.addEventListener("click", function () {
//     menuAll.classList.add("current");
//     menuRecommend.classList.remove("current");
//     menuListRecommend.hidden = true;
//     menuListAll.hidden = false;
// });

function clickFilterButton() {
    document.forms.filter_form.submit();
}

function clickFilterButtonIpad() {
    document.forms.filter_form_ipad.submit();
}

function clickFilterButtonAdmin() {
    document.forms.filter_form.submit();
}

function clickCommentButton() {
    document.forms.comment_form.submit();
}

function clickCommentButtonIpad() {
    document.forms.comment_form_ipad.submit();
}

function clickCommentButtonSp() {
    document.forms.comment_form_sp.submit();
}

function clickRegistButton() {
    document.forms.regist_form.submit();
}

function clickClearButton() {
    document.forms.filter_form.reset();
}


function searchFormChange() {
    var radio = document.getElementsByName('search_radio');
    var prefList = document.getElementById('pref_list');
    if(radio[0].checked) {
        prefList.style.display = "block";
    }else if(radio[1].checked || radio[2].checked || radio[3].checked) {
        prefList.style.display = "none";
    }
}

function searchFormChangeIpad() {
    var radio = document.getElementsByName('search_radio_ipad');
    var prefListIpad = document.getElementById('pref_list_ipad');
    if(radio[0].checked) {
        prefListIpad.style.display = "block";
    }else if(radio[1].checked || radio[2].checked || radio[3].checked) {
        prefListIpad.style.display = "none";
    }
}

// 以下スライダー機能について

$('.slider').slick({
    autoplay: true,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 10,//スライドを画面に3枚見せる
    slidesToScroll: 10,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="../img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="../img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
    // variableWidth: true,
});

$('.slider_ipad').slick({
    autoplay: true,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 5,//スライドを画面に3枚見せる
    slidesToScroll: 5,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="../img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="../img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
});

$('.slider_sp').slick({
    autoplay: true,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 5,//スライドを画面に3枚見せる
    slidesToScroll: 5,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="../img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="../img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: false,//下部ドットナビゲーションの表示
});

// バナー用
$('.slider_banner').slick({
    autoplay: true,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 1,//スライドを画面に3枚見せる
    slidesToScroll: 1,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
});

$('.slider_banner_ipad').slick({
    autoplay: true,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 1,//スライドを画面に3枚見せる
    slidesToScroll: 1,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
});

$('.slider_banner_sp').slick({
    autoplay: true,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 1,//スライドを画面に3枚見せる
    slidesToScroll: 1,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
});

// SP版の店舗画像用
$('.restaurant_img_sp').slick({
    autoplay: true,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 1,//スライドを画面に3枚見せる
    slidesToScroll: 1,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="../../img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="../../img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
});

$(function(){
	var loader = $('.loader-wrap');

	//ページの読み込みが完了したらアニメーションを非表示
	$(window).on('load',function(){
		loader.fadeOut();
	});

	//ページの読み込みが完了してなくても3秒後にアニメーションを非表示にする
	setTimeout(function(){
		loader.fadeOut();
	},3000);
});

$(function() {
    // 1. 「全選択」する
    $('#all').on('click', function() {
      $("input[name='chk[]']").prop('checked', this.checked);
    });
    // 2. 「全選択」以外のチェックボックスがクリックされたら、
    $("input[name='chk[]']").on('click', function() {
      if ($('#boxes :checked').length == $('#boxes :input').length) {
        // 全てのチェックボックスにチェックが入っていたら、「全選択」 = checked
        $('#all').prop('checked', true);
      } else {
        // 1つでもチェックが入っていたら、「全選択」 = checked
        $('#all').prop('checked', false);
      }
    });
  });