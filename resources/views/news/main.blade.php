@extends('layout')

@section('title')
    Поиск новостей
@endsection

@section('content')
    @livewire('feed')
@endsection

@section('scripts')
    <script>
    window.onscroll = function(ev) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            window.livewire.emit('load-more');
        }
    };
    </script>

@endsection