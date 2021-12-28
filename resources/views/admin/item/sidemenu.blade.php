<div class="flexible-list-sidebar">
    @if(session('type') == 'operation')
    <a href="{{ route('admin.restaurant_list') }}"><div class="sidemenu_name">
        <div class="sidemenu_img">
        <img src="{{ asset('img/unei_home.png') }}" class="" alt="">
        </div>
        店舗管理
    </div></a>
    <hr>
    <a href="{{ route('admin.notice_list') }}"><div class="sidemenu_name">
        <div class="sidemenu_img">
        <img src="{{ asset('img/unei_mail.png') }}" class="" alt="">
        </div>
        お知らせ管理
    </div></a>
    <hr>
    <a href="{{ route('admin.banner_list') }}"><div class="sidemenu_name">
        <div class="sidemenu_img">
        <img src="{{ asset('img/unei_img.png') }}" class="" alt="">
        </div>
        画像管理
    </div></a>
    <hr>
    <a href="{{ route('admin.setting_list') }}"><div class="sidemenu_name">
        <div class="sidemenu_img">
        <img src="{{ asset('img/unei_sistem.png') }}" class="" alt="">
        </div>
        各種設定
    </div></a>
    <hr>
    @else
    <a href="{{ route('admin.restaurant_edit', ['id' => session('id')]) }}"><div class="sidemenu_name">
        <div class="sidemenu_img">
        <img src="{{ asset('img/tenpo_home.png') }}" class="" alt="">
        </div>
        店舗情報編集
    </div></a>
    <hr>
    <a href="{{ route('admin.menu_list', ['id' => session('id')]) }}"><div class="sidemenu_name">
        <div class="sidemenu_img">
        <img src="{{ asset('img/tenpo_menu.png') }}" class="" alt="">
        </div>
        メニュー管理
    </div></a>
    <hr>
    <a href="{{ route('admin.comment_list', ['id' => session('id')]) }}"><div class="sidemenu_name">
        <div class="sidemenu_img">
        <img src="{{ asset('img/tenpo_coment.png') }}" class="" alt="">
        </div>
        クチコミ管理
    </div></a>
    <hr>
    @endif
</div>