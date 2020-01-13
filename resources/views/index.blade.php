@extends('layouts.app')

@php
    use App\House;
    use App\Article;
@endphp

@section('content')
    <div class="container">
        @if(Auth::check())
            <purchase
{{--                :houses="{{House::all()}}"--}}
                :connecteduser="{{ Auth::id() }}"
                :articles="{{Article::where('active', 1)->get()}}"></purchase>
        @endif
    </div>
@endsection
