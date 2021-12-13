@extends('layouts.app')

@section('content')

<p>カテゴリーから探す</p>
<div class="category">
    <ul class="slider">
    @foreach ($categories as $category)
        <li class="category_link">
            <a href="{{ route('category', ['id' => $category->id]) }}">
                <img src="{{ asset('img/kategori2.png') }}" alt="">
                <div class="category_name">{{ $category->name }}</div>
            </a>
        </li>
        @endforeach
        @foreach ($categories as $category)
        <li class="category_link">
            <a href="{{ route('category', ['id' => $category->id]) }}">
                <img src="{{ asset('img/kategori2.png') }}" alt="">
                <div class="category_name">{{ $category->name }}</div>
            </a>
        </li>
        @endforeach
        @foreach ($categories as $category)
        <li class="category_link">
            <a href="{{ route('category', ['id' => $category->id]) }}">
                <img src="{{ asset('img/kategori2.png') }}" alt="">
                <div class="category_name">{{ $category->name }}</div>
            </a>
        </li>
        @endforeach
    </ul>
</div>

@yield('banner')

<div class="flexible-list">
    <aside id="column-side" class="flexible-list-side">
    @include('form.filter_search')
    </aside>

    <div class="flexible-list-main">
        @yield('restaurant_list')
    </div>
</div>

@endsection




@section('content_ipad')

@include('form.header_search_ipad')

<p class="category_title_ipad">カテゴリーから探す</p>
<div class="category">
    <ul class="slider_ipad">
        @foreach ($categories as $category)
        <li class="category_link">
            <a href="{{ route('category', ['id' => $category->id]) }}">
                <img src="{{ asset('img/kategori2.png') }}" alt="">
                <div class="category_name_sp">{{ $category->name }}</div>
            </a>
        </li>
        @endforeach
        @foreach ($categories as $category)
        <li class="category_link">
            <a href="{{ route('category', ['id' => $category->id]) }}">
                <img src="{{ asset('img/kategori2.png') }}" alt="">
                <div class="category_name_sp">{{ $category->name }}</div>
            </a>
        </li>
        @endforeach
        @foreach ($categories as $category)
        <li class="category_link">
            <a href="{{ route('category', ['id' => $category->id]) }}">
                <img src="{{ asset('img/kategori2.png') }}" alt="">
                <div class="category_name_sp">{{ $category->name }}</div>
            </a>
        </li>
        @endforeach
    </ul>
</div>

@yield('banner_ipad')

@include('form.filter_search_ipad')

@yield('restaurant_list_ipad')


@endsection