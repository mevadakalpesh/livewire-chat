@props(['message', 'receiver'])
<div class="col-start-6 col-end-13 p-3 rounded-lg">
    <div class="flex  justify-start flex-row-reverse">
        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
            @if (isset($receiver->avatar_url))
                <img src="{{ $receiver->avatar_url }}" alt="">
            @else
                {{ $receiver->name[0] ?? 'N' }}
            @endif
        </div>
        <div class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl ">
            <div class="message-div">
                {!! $message->message !!}
            </div>
            <i class="text-gray-400 my-3">{{ $message->created_at->diffForHumans() }}</i>

        </div>
    </div>
</div>
