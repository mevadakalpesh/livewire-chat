<div>
    <label for="medias" class="flex items-center justify-center text-gray-400 hover:text-gray-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
            </path>
        </svg>
    </label>
    <input wire:model='medias' multiple type="file" class="hidden" name="medias[]" id="medias">
</div>
<div class="flex-grow ml-4">
    <div class="relative w-full">
        <input id="typingInput" type="text" wire:focus='onFocusTyping' wire:blur='onBulrTyping'
            wire:model.live="message_text" name="message_text"
            class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10" />

        <button wire:click='emojyboradToggle'
            class="absolute flex items-center justify-center h-full w-12 right-0 top-0 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
        </button>
    </div>
</div>
