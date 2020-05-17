@extends('layouts.app')

@section('content')
    <div class="container">
    <h1>Иерархия в виде дерева</h1>
    <ul class="list-group">
        @foreach($rootManager as $rootManagers)

            <li class="list-group-item list-group-item-action">{{ $rootManagers->level }}.{{ $rootManagers->name }}({{ $rootManagers->position_id }})</li>
            @if($rootManagers->WorkersManager->count() > 0)
                @include('workers.item', ['workers' => $rootManagers->WorkersManager,])
                @endif
            @endforeach
    </ul>
@endsection
