<div>
    <ul>
        @foreach ($notifications as $notification )
        <li>

            <strong> {{ $notification->data['title'] }}</strong>
            <p> {{ $notification->data['body'] }}</p>
            <a href="{{ $notification->data['url'] }}"></a>

        </li>

        @endforeach

    </ul>


    </div>
