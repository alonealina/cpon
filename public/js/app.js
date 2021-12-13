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

function clickCommentButton() {
    document.forms.comment_form.submit();
}

function clickCommentButtonIpad() {
    document.forms.comment_form_ipad.submit();
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

// 以下スライダー機能について

$('.slider').slick({
    autoplay: false,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 10,//スライドを画面に3枚見せる
    slidesToScroll: 10,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="../img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="../img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
    // variableWidth: true,
});

$('.slider_ipad').slick({
    autoplay: false,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 5,//スライドを画面に3枚見せる
    slidesToScroll: 5,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="../img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="../img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
});

$('.slider_sp').slick({
    autoplay: false,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 5,//スライドを画面に3枚見せる
    slidesToScroll: 5,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="../img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="../img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
});

// バナー用
$('.slider_banner').slick({
    autoplay: false,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 3,//スライドを画面に3枚見せる
    slidesToScroll: 3,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
});

$('.slider_banner_ipad').slick({
    autoplay: false,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 2,//スライドを画面に3枚見せる
    slidesToScroll: 2,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
});

$('.slider_banner_sp').slick({
    autoplay: false,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 1,//スライドを画面に3枚見せる
    slidesToScroll: 1,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
});

let client_h = document.getElementById('restaurant_profile_text').clientHeight;

if (client_h < 120) {
    document.getElementById('restaurant_profile_label').style.display ="none";
}
