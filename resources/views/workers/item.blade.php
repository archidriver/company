<ul>
    @foreach($workers as $worker)
        <li  class="list-group-item list-group-item-action pointer">{{ $worker->level }}.{{ $worker->name }}({{ $worker->position_id }})</li>
        @if($worker->WorkersManager->count() > 0)
            @include('workers.item', ['workers' => $worker->WorkersManager])
        @endif
    @endforeach
</ul>
