@extends('layouts.app_admin')

@section('content')

<nav class="navbar admin_header">
    <div class="content_title">クチコミ管理</div>
</nav>
<div class="admin_content">
    @include('form.admin_comment_search')

    @include('admin.item.comment_list')
</div>

@endsection


