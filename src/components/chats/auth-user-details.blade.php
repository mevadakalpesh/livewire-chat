<div class="flex flex-row items-center justify-center h-12 w-full">
    <div class="flex items-center justify-center rounded-2xl text-indigo-700 bg-indigo-100 h-10 w-10">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
            </path>
        </svg>
    </div>
    <div class="ml-2 font-bold text-2xl">QuickChat</div>
</div>
<div class="flex flex-col items-center bg-indigo-100 border border-gray-200 mt-4 w-full py-6 px-4 rounded-lg">
    <div class="h-20 w-20 rounded-full border overflow-hidden">
        @if (isset(auth()->user()->avatar_url))
            <img src="{{ auth()->user()->avatar_url }}" alt="" alt="Avatar" class="h-full w-full">
        @else
            <div class="h-full w-full flex justify-center items-center bg-indigo-500 text-white text-3xl uppercase">
                {{ auth()->user()->name[0] ?? 'N' }}
            </div>
        @endif
    </div>
    <div class="text-sm font-semibold mt-2">{{ auth()->user()->name }}</div>
    <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
</div>
