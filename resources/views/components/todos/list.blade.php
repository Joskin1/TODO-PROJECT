<ul class="divide-y divide-gray-200 px-4">
    <template x-if="filter === 'all'">
        <template x-for="todo in todos">
            <li class="py-4">
                <div class="flex items-center">



                    <label for="todo1" class="ml-3 block text-gray-900">
                        <span class="text-lg font-medium" x-show="todo.completed"></span>

                    </label>


                    {{-- <button wire:click="edit({{ $todo->id }})"
                        class="ml-auto px-2 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">
                        EDIT
                    </button>
                    <button wire:click="delete({{ $todo->id }})" type="submit"
                        class="ml-auto px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">DELETE</button> --}}
                </div>
            </li>

    {{-- </template>
    <template x-if="filter === 'active'">
        @foreach ($todos as $todo)
            <li class="py-4">
                <div class="flex items-center">
                    @if ($todo->completed)
                        <input wire:click="toggle({{ $todo->id }})" id="" name="todo1"
                            type="checkbox" checked
                            class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                    @else
                        <input wire:click="toggle({{ $todo->id }})" id="todo1" name="todo1"
                            type="checkbox"
                            class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                    @endif

                    <label for="todo1" class="ml-3 block text-gray-900">
                        <span class="text-lg font-medium">{{ $todo->title }}</span>

                    </label>


                    <button wire:click="edit({{ $todo->id }})"
                        class="ml-auto px-2 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">
                        EDIT
                    </button>
                    <button wire:click="delete({{ $todo->id }})" type="submit"
                        class="ml-auto px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">DELETE</button>
                </div>
            </li>
        @endforeach
    </template>
    <template x-if="filter === 'completed'">
        @foreach ($todos as $todo)
            <li class="py-4">
                <div class="flex items-center">
                    @if ($todo->completed)
                        <input wire:click="toggle({{ $todo->id }})" id="" name="todo1"
                            type="checkbox" checked
                            class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                    @else
                        <input wire:click="toggle({{ $todo->id }})" id="todo1" name="todo1"
                            type="checkbox"
                            class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                    @endif

                    <label for="todo1" class="ml-3 block text-gray-900">
                        <span class="text-lg font-medium">{{ $todo->title }}</span>

                    </label>


                    <button wire:click="edit({{ $todo->id }})"
                        class="ml-auto px-2 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">
                        EDIT
                    </button>
                    <button wire:click="delete({{ $todo->id }})" type="submit"
                        class="ml-auto px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">DELETE</button>
                </div>
            </li>
        @endforeach
    </template> --}}
</ul>
