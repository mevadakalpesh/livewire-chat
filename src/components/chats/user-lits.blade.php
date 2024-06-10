@props(['users', 'receiver_id', 'userTyping', 'unreadMessage'])

<div class="flex flex-col mt-8">
    <div class="flex flex-row items-center justify-between text-xs">
        <span class="font-bold">Users </span>
        <span class="flex items-center justify-center bg-gray-300 h-4 w-4 rounded-full">{{ count($users) }}</span>
    </div>
    @if ($users)
        <div>
            @foreach ($users as $user)
                <a href="{{ route('chat-app', ['userid' => $user->id]) }}" wire:navigate
                    class="flex  flex-row items-center hover:bg-gray-100 rounded-xl p-2
                @if ($user->id == $receiver_id ?? null) bg-indigo-100 @endif">

                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center ">
                            <div class="flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full">
                                {{ $user->name[0] ?? 'N' }}
                            </div>
                            <div class="ml-2 text-sm font-semibold">
                                {{ str()->ucfirst($user->name) }}
                                @if (isset($unreadMessage[$user->id]) && $receiver_id != $user->id)
                                    <small class="block text-gray-500 dark:text-gray-400">
                                        {{ str()->limit($unreadMessage[$user->id]['message_text'], 10, '...') }}
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="count-details">

                            @if (isset($unreadMessage[$user->id]) && $receiver_id != $user->id)
                                @if (isset($unreadMessage[$user->id]) && isset($unreadMessage[$user->id]['count']))
                                    <span
                                        class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                        {{ $unreadMessage[$user->id]['count'] }}
                                    </span>
                                @endif
                            @endif

                            @if (isset($userTyping[$user->id]) &&
                                    $userTyping[$user->id]['receiver_id'] == auth()->user()->id &&
                                    $userTyping[$user->id]['typing_status'] === true &&
                                    $receiver_id != $user->id)
                                <small class="text-blue-600">typing... </small>
                            @endif


                        </div>
                    </div>


                </a>
            @endforeach
        </div>
    @else
        <h1>no user here</h1>
    @endif
</div>
