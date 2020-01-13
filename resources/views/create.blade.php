@extends('layouts.app')

@php
    use App\House;
    use App\Article;
@endphp

@section('content')
    <div class="container">
        @if(Auth::check())
        <create
        :route="`{{ url('admin') }}`"></create>
        @endif
    </div>
@endsection

<script src=//unpkg.com/vue></script>
<script src=//unpkg.com/vuebars@0.1.5></script>
