<form class="w-full max-w-sm mx-auto px-4 py-2">
    <div class="flex items-center border-b-2 border-teal-500 py-2">
        <input wire:model="title" id="title"
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            type="text" placeholder="Add a task">
        @error('title')
            <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
        @enderror
        <button wire:click.prevent="create"
            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
            type="button">
            Add
        </button>
        @if (session('success'))
            <span class="text-green-500 text-xs">{{ session('success') }}.</span>
        @endif
    </div>
</form>
