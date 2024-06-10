<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            <div class="flex h-screen antialiased text-gray-800">
                <div class="flex flex-row h-full w-full overflow-x-hidden">

                    <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0">
                        {{-- <x-auth-user-details /> --}}
                        @include('chat-app::auth-user-details')
                        @include('chat-app::user-lits')

                        {{-- <x-user-lits :users="$users" :receiver_id="$receiver_id" :userTyping="$userTyping" :unreadMessage="$unreadMessage" /> --}}
                    </div>


                    <div class="flex flex-col flex-auto h-full p-6">
                        <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">

                            @if (!blank($this->receiver_id))
                                <div
                                    class="flex flex-col h-full overflow-x-auto mb-4 container-coman chat-container-{{ auth()->user()->id }} chat-container-{{ $this->receiver_id }}    ">
                                    @if (!blank($messages))
                                        <div class="flex flex-col h-full">
                                            <div class="grid grid-cols-12 gap-y-2">
                                                @foreach ($messages as $message)
                                                    @if ($message->sender_id == auth()->user()->id)
                                                        {{-- <x-receiver-message :message="$message" :receiver="$receiver" /> --}}
                                                        @include('chat-app::receiver-message')
                                                    @else
                                                        @include('chat-app::sender-message', [
                                                            'typing' => false,
                                                        ])
                                                        {{-- <x-sender-message :message="$message" /> --}}
                                                    @endif
                                                @endforeach

                                                @if ($typing)
                                                    @include('chat-app::sender-message', [
                                                        'typing' => true,
                                                    ]);
                                                    {{-- <x-sender-message :typing="true" /> --}}
                                                @endif

                                            </div>
                                        </div>
                                    @else
                                        <h1 class="text-center">Start Chating by sending message to
                                            <b>{{ ucfirst($receiver->name) }}</b>
                                        </h1>
                                    @endif

                                </div>

                                <div class="emojy-container {{ $emojyBoradClass }}">
                                    <div class="emojy-element float-right" wire:ignore></div>
                                </div>

                                <div class="bg-white w-full rounded-xl">

                                    @if (!blank($medias))
                                        <div class="flex pt-4 pl-4 gap-3">
                                            @foreach ($medias as $key => $media)
                                                <div class="div">
                                                    <span wire:click='removeImage({{ $key }})'
                                                        class="flex items-center justify-center bg-gray-300 h-5 w-5 cursor-pointer rounded-full">X</span>
                                                    <img src="{{ $media->temporaryUrl() }}" alt=""
                                                        width="100" height="100" class="shadow">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif


                                    <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">

                                        @include('chat-app::typing-input')
                                        @include('chat-app::send-btn')

                                        {{-- <x-typing-input />
                                        <x-send-btn /> --}}

                                    </div>
                                </div>
                            @else
                                <h1 class="text-center">Start new conversion with by selecting user </h1>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    Livewire.on('scroll_top', (user_id, receiver_id = 0) => {
        var selector = `.chat-container-${user_id}, .chat-container-${receiver_id}`;
        $(selector).animate({
            scrollTop: $(selector).get(0).scrollHeight
        }, 10);
    });

    $('.container-coman').animate({
        scrollTop: $('.container-coman').get(0).scrollHeight
    }, 0);
</script>
<script src="https://cdn.jsdelivr.net/npm/emoji-mart@latest/dist/browser.js"></script>
<script>
    var pickerOptions = {
        onEmojiSelect: emojiSelected
    }
    var picker = new EmojiMart.Picker(pickerOptions)
    $('.emojy-element').html(picker);

    function emojiSelected(data) {
        Livewire.dispatch('set-emoji', [data.native]);
    }
</script>
