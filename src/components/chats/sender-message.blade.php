@props(['message', 'typing'])

<div class="col-start-1 col-end-8 p-3 rounded-lg">
    <div class="flex flex-row items-center">
        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">

            @if (isset(auth()->user()->avatar_url))
                <img src="{{ auth()->user()->avatar_url }}" alt="">
            @else
                {{ auth()->user()->name[0] ?? 'N' }}
            @endif

        </div>
        <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl max-width-full">
            @if ($typing ?? false)
                <img class="w-14 p-0 m-0" src="https://cdn.dribbble.com/users/597268/screenshots/2991038/dribbble_2x.gif"
                    alt="">
            @else
                <div class="message-div">
                    {!! $message->message !!}
                </div>
                <i class="text-gray-400 my-3">{{ $message->created_at->diffForHumans() }}</i>
            @endif
        </div>
    </div>
</div>
