@extends('layouts.app')

@php
    use App\House;
    use App\Article;
@endphp

@section('content')
    <div class="container">
        @if(Auth::check())
            <admin
                :connecteduser="{{ Auth::id() }}"
                :articles="{{Article::all()}}"
                :route="`{{ url('admin/create') }}`"
                ></admin>
        @endif
    </div>
@endsection
