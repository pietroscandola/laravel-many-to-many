@extends('layouts.app')

@section('content')
    <header>
        <h1>Nuovo Post</h1>
    </header>
    <hr>
    @include('includes.posts.form')
@endsection

@section('scripts')
    <script src="{{ asset('js/image-preview.js') }}" defer></script>
@endsection
