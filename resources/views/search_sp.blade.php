@extends('layouts.app')


@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection


@section('content_sp')

@include('form.header_search_sp')

@include('form.filter_search_sp')

<div style="width:375px;position:relative;left:2%;" class="category_list">
    @foreach ($categories as $category)
    <li class="category_link">
        <a href="{{ route('category', ['id' => $category->id]) }}">
            <img src="../../img/category/{{$category->id}}.png" alt="">
            <div class="category_name_sp">{{ $category->name }}</div>
        </a>
    </li>
    @endforeach
</div>

@endsection