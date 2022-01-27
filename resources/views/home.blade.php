@extends('layouts.app')

@section('content')

@yield('banner')

<p style="margin-left:30px;margin-bottom:0.2rem;">カテゴリから探す</p>
<div class="category">
    <ul class="slider">
    @foreach ($categories as $category)
        <li class="category_link">
            <a href="{{ route('category', ['id' => $category->id]) }}">
                <img src="../../img/category/{{$category->id}}.png" alt="">
                <div class="category_name">{{ $category->name }}</div>
            </a>
        </li>
        @endforeach
    </ul>
</div>

@yield('category_background')
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

@yield('banner_ipad')

<p class="category_title_ipad">カテゴリから探す</p>
<div class="category_ipad">
    <ul class="slider_ipad">
        @foreach ($categories as $category)
        <li class="category_link">
            <a href="{{ route('category', ['id' => $category->id]) }}">
                <img src="../../img/category/{{$category->id}}.png" alt="">
                <div class="category_name_ipad">{{ $category->name }}</div>
            </a>
        </li>
        @endforeach
    </ul>
</div>


@yield('category_background_ipad')

@include('form.filter_search_ipad')

@yield('restaurant_list_ipad')

@endsection




@section('content_sp')

@include('form.header_search_sp')

@yield('banner_sp')

<p class="category_title_sp">カテゴリから探す</p>
<div class="category_sp">
    <ul class="slider_sp">
        @foreach ($categories as $category)
        <li class="category_link">
            <a href="{{ route('category', ['id' => $category->id]) }}">
                <img src="../../img/category/{{$category->id}}.png" alt="">
                <div class="category_name_sp">{{ $category->name }}</div>
            </a>
        </li>
        @endforeach
    </ul>
</div>

@yield('category_background_sp')

@yield('restaurant_list_sp')

@endsection