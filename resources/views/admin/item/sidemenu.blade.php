<div class="flexible-list-sidebar">
    @if(session('type') == 'operation')
    <div class="sidemenu_name"><a href="{{ route('admin.restaurant_list') }}">店舗管理</a></div>
    <hr>
    <div class="sidemenu_name"><a href="{{ route('admin.notice_list') }}">お知らせ管理</a></div>
    <hr>
    <div class="sidemenu_name"><a href="{{ route('admin.banner_list') }}">画像管理</a></div>
    <hr>
    <div class="sidemenu_name"><a href="{{ route('admin.setting_list') }}">各種設定</a></div>
    <hr>
    @else
    <div class="sidemenu_name"><a href="{{ route('admin.restaurant_edit', ['id' => session('id')]) }}">店舗情報編集</a></div>
    <hr>
    <div class="sidemenu_name"><a href="{{ route('admin.menu_list', ['id' => session('id')]) }}">メニュー管理</a></div>
    <hr>
    <div class="sidemenu_name"><a href="{{ route('admin.comment_list', ['id' => session('id')]) }}">クチコミ管理</a></div>
    <hr>
    @endif
</div>