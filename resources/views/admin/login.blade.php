@extends('layouts.app_admin')
 
@section('title', 'ログイン')
 
@section('content')

<div class="login_form">
  <img src="{{ asset('img/logo.png') }}" class="login_logo" alt="">
  {{-- エラーメッセージ --}}
  @if (isset($login_error))
    <div id="error_explanation" class="text-danger">
      <ul>
        <li>メールアドレスまたはパスワードが一致しません。</li>
      </ul>
    </div>
  @endif
  
  {{-- フォーム --}}
  <form action="{{ url('admin_login') }}" method="post">
    @csrf  
    <div class="form-group">
      <div class="login_form_name">ログインID</div>
      <input type="text" class="form-control" id="user_email" name="login_id">
    </div>     
    <div class="form-group">
    <div class="login_form_name">パスワード</div>
      <input type="password" class="form-control" id="user_password" name="password">
    </div>     
    <input type="submit" value="ログイン" class="btn login_button">  
  </form>  
</div>
<div class="copyright">Copyright © 2021 KOC・JAPAN All Rights Reserved.</div>

@endsection