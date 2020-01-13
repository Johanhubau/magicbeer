@extends('layouts.default')

@section('content')
    <div class="container">
        @if(Auth::check())
            <display></display>
        @endif
    </div>
@endsection
