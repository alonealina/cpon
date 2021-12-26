@extends('layouts.app_admin')

@section('content')

<nav class="navbar admin_header">
    <div class="content_title">各種設定</div>
</nav>
<div class="admin_content">
    @include('admin.item.scene_list')
    @include('admin.item.commitment_list')
</div>

@endsection


