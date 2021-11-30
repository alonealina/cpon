@extends('layouts.app')

@section('content')

<p class="cpon_notice">Cポンポータルからのお知らせ</p>
<hr>
<div class="notice_home">
    @foreach ($notices as $notice)
    <a href="{{ route('notice.show', ['id' => $notice->id]) }}">
        <div class="notice_date">{{ $notice->notice_date }}</div>
        <div class="notice_title">{{ $notice->title }}</div>
    </a>
    <hr>
    @endforeach
</div>
<div class="d-flex justify-content-center">
{{ $notices->links('pagination::bootstrap-4') }}
</div>

@endsection