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
    document.filter_form.submit();
}

function clickCommentButton() {
    document.comment_form.submit();
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
    prevArrow: '<img src="img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
    // variableWidth: true,
    responsive: [
        {
        breakpoint: 769,//モニターの横幅が769px以下の見せ方
        settings: {
            slidesToShow: 8,//スライドを画面に2枚見せる
            slidesToScroll: 8,//1回のスクロールで2枚の写真を移動して見せる
        }
    },
    {
        breakpoint: 426,//モニターの横幅が426px以下の見せ方
        settings: {
            slidesToShow: 6,//スライドを画面に1枚見せる
            slidesToScroll: 6,//1回のスクロールで1枚の写真を移動して見せる
        }
    }
]
});

$('.slider_sp').slick({
    autoplay: false,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 5,//スライドを画面に3枚見せる
    slidesToScroll: 5,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
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
    responsive: [
        {
        breakpoint: 769,//モニターの横幅が769px以下の見せ方
        settings: {
            slidesToShow: 2,//スライドを画面に2枚見せる
            slidesToScroll: 2,//1回のスクロールで2枚の写真を移動して見せる
        }
    },
    {
        breakpoint: 426,//モニターの横幅が426px以下の見せ方
        settings: {
            slidesToShow: 1,//スライドを画面に1枚見せる
            slidesToScroll: 1,//1回のスクロールで1枚の写真を移動して見せる
        }
    }
]
});

let client_h = document.getElementById('restaurant_profile_text').clientHeight;

if (client_h < 120) {
    document.getElementById('restaurant_profile_label').style.display ="none";
}
