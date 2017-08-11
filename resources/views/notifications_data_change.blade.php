<li>
    <a href="{{route('show.data',$notification->data['DataId'])}}">
        @if($notification->data['User']['id'] != Auth::User()->id)
            {{$notification->data['User']['name']}} Updated Your Data.
            @else
                You've updated your data.
        @endif
    </a>
</li>