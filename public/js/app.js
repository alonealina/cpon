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

const maxFiles = 5;
function fileCheck(){

  let $file_btn = $("#file_btn_pc");

  // addEventListener() の jQuery による略記
  $file_btn.on("change", function(evt){
    // jQuery オブジェクトの最初の要素は Element が格納されているので
    // 次のようにHTMLElementを取得できる。
    // $(this)[0];　$(this).get(0);

    // 変数 $file_btn に格納済みのjQueryオブジェクトを使っても良い。
    let elm = $file_btn[0];
    if( maxFiles < elm.files.length ) {

      alert(`添付できるのは ${maxFiles} 枚までです` );

      elm.value = null; // input[type=file] をリセット

      return false;// イベントリスナを抜ける。
    }
    // プレビュー処理など。
  })
};

function clickReleaseOnButton() {
    // エレメントを作成
    var ele = document.createElement('input');
    // データを設定
    ele.setAttribute('type', 'hidden');
    ele.setAttribute('name', 'release_flg');
    ele.setAttribute('value', 1);
    // 要素を追加
    document.forms.restaurant_list_form.appendChild(ele);
    document.forms.restaurant_list_form.submit();
}

function clickReleaseOffButton() {
    // エレメントを作成
    var ele = document.createElement('input');
    // データを設定
    ele.setAttribute('type', 'hidden');
    ele.setAttribute('name', 'release_flg');
    ele.setAttribute('value', 0);
    // 要素を追加
    document.forms.restaurant_list_form.appendChild(ele);
    document.forms.restaurant_list_form.submit();
}

function clickRecommendOnButton() {
    // エレメントを作成
    var ele = document.createElement('input');
    // データを設定
    ele.setAttribute('type', 'hidden');
    ele.setAttribute('name', 'recommend_flg');
    ele.setAttribute('value', 1);
    // 要素を追加
    document.forms.restaurant_list_form.appendChild(ele);
    document.forms.restaurant_list_form.submit();
}

function clickRecommendOffButton() {
    // エレメントを作成
    var ele = document.createElement('input');
    // データを設定
    ele.setAttribute('type', 'hidden');
    ele.setAttribute('name', 'recommend_flg');
    ele.setAttribute('value', 0);
    // 要素を追加
    document.forms.restaurant_list_form.appendChild(ele);
    document.forms.restaurant_list_form.submit();
}

// 以下スライダー機能について

$('.slider').slick({
    autoplay: true,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 8,//スライドを画面に3枚見せる
    slidesToScroll: 8,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="../img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="../img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
    // variableWidth: true,
});

$('.slider_ipad').slick({
    autoplay: true,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 6,//スライドを画面に3枚見せる
    slidesToScroll: 6,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<img src="../img/yazi1.png" class="slide-arrow prev-arrow slick-prev">',//矢印部分PreviewのHTMLを変更
    nextArrow: '<img src="../img/yazi2.png" class="slide-arrow next-arrow slick-next">',//矢印部分NextのHTMLを変更
    dots: true,//下部ドットナビゲーションの表示
});

$('.slider_sp').slick({
    autoplay: true,//自動的に動き出すか。初期値はfalse。
    infinite: true,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 4,//スライドを画面に3枚見せる
    slidesToScroll: 4,//1回のスクロールで3枚の写真を移動して見せる
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


$(function() {
    // 1. 「定休日なし」をクリックする
    $('#none').on('click', function() {
        if (this.checked) {
            $("input[id='monday']").prop('checked', false);
            $("input[id='tuesday']").prop('checked', false);
            $("input[id='wednesday']").prop('checked', false);
            $("input[id='thursday']").prop('checked', false);
            $("input[id='friday']").prop('checked', false);
            $("input[id='saturday']").prop('checked', false);
            $("input[id='sunday']").prop('checked', false);
        }
    });
    // 2. 「定休日なし」以外のチェックボックスがクリックされたら、
    $('#monday').on('click', function() {
        if (this.checked) {
            $("input[id='none']").prop('checked', false);
        }
    });
    $('#tuesday').on('click', function() {
        if (this.checked) {
            $("input[id='none']").prop('checked', false);
        }
    });
    $('#wednesday').on('click', function() {
        if (this.checked) {
            $("input[id='none']").prop('checked', false);
        }
    });
    $('#thursday').on('click', function() {
        if (this.checked) {
            $("input[id='none']").prop('checked', false);
        }
    });
    $('#friday').on('click', function() {
        if (this.checked) {
            $("input[id='none']").prop('checked', false);
        }
    });
    $('#saturday').on('click', function() {
        if (this.checked) {
            $("input[id='none']").prop('checked', false);
        }
    });
    $('#sunday').on('click', function() {
        if (this.checked) {
            $("input[id='none']").prop('checked', false);
        }
    });
});