@extends('layouts.app')


@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection


@section('content_sp')

@include('form.header_search_sp')

@include('form.filter_search_sp')

<div class="category_list">
    @foreach ($categories as $category)
    <li class="category_link">
        <a href="{{ route('category', ['id' => $category->id]) }}">
            <img src="{{ asset('img/kategori2.png') }}" alt="">
            <div class="category_name_sp">{{ $category->name }}</div>
        </a>
    </li>
    @endforeach
</div>

@endsection