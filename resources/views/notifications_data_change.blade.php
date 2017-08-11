@if($notification->read_at == '')
    <li style="background-color:#eee4e3;">
    @else
    <li>
@endif
        <a href="{{ route('show.data', $notification->data['DataId']) }}">
            @if($notification->data['User']['id'] != Auth::User()->id)
                {{$notification->data['User']['name']}} updated your data.
            @else
                You've updated your data.
            @endif
        </a>
    </li>
