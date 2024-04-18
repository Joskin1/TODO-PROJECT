<div x-data="todos">
    <div>
        <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-16">
            <div class="px-4 py-2">
                <h1 class="text-gray-800 font-bold text-2xl uppercase">To-Do List</h1>
            </div>
            <div>
                {{-- Search Bar --}}
                <div>
                    <input wire:model.live="search" class="bg-gray-100 ml-2 rounded px-4 py-2 hover:bg-gray-100"
                        type="text" placeholder="Search..." />
                </div>

                {{-- form for new Todo --}}
                <form wire:submit.live="create" class="w-full max-w-sm mx-auto px-4 py-2">
                    <div class="flex items-center border-b-2 border-teal-500 py-2">
                        <input wire:model="title" id="title"
                            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                            type="text" placeholder="Add a task">
                        @error('title')
                            <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                        @enderror
                        <button
                            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                            type="submit">
                            Add
                        </button>
                        @if (session('success'))
                            <span class="text-green-500 text-xs">{{ session('success') }}.</span>
                        @endif
                    </div>
                </form>

                {{-- List of TODOS --}}
                <ul class="grid gap-4">
                    @foreach ($todos as $todo)
                        <li wire:key="{{ $todo->id }}" class="flex items-center">
                            @if ($editingTodoID === $todo->id)
                                <!-- Edit mode -->
                                <input type="text" wire:model="editedTitle" class="mr-2 px-3 py-1 border border-gray-300 rounded">
                                <button wire:click="updateTodo"
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700">Update</button>
                                <button wire:click="cancelEdit"
                                    class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                            @else
                                <!-- View mode -->
                                @if ($todo->completed)
                                    <input type="checkbox" wire:click="toggle({{ $todo->id }})" checked
                                        class="mr-2 form-checkbox h-5 w-5 text-blue-500">
                                @else
                                    <input type="checkbox" wire:click="toggle({{ $todo->id }})"
                                        class="mr-2 form-checkbox h-5 w-5 text-blue-500">
                                @endif
                                <label class="flex-grow">{{ $todo->title }}</label>
                                <button wire:click="editTodo({{ $todo->id }})"
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 24 24">
                                        <path d="M 18.414062 2 C 18.158188 2 17.902031 2.0974687 17.707031 2.2929688 L 16 4 L 20 8 L 21.707031 6.2929688 C 22.098031 5.9019687 22.098031 5.2689063 21.707031 4.8789062 L 19.121094 2.2929688 C 18.925594 2.0974687 18.669937 2 18.414062 2 z M 14.5 5.5 L 3 17 L 3 21 L 7 21 L 18.5 9.5 L 14.5 5.5 z"></path>
                                    </svg>
                                </button>
                            @endif
                            <button wire:click="deleteTodo({{ $todo->id }})"
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-700 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50">
                                    <path d="M 42 5 L 32 5 L 32 3 C 32 1.347656 30.652344 0 29 0 L 21 0 C 19.347656 0 18 1.347656 18 3 L 18 5 L 8 5 C 7.449219 5 7 5.449219 7 6 C 7 6.550781 7.449219 7 8 7 L 9.085938 7 L 12.695313 47.515625 C 12.820313 48.90625 14.003906 50 15.390625 50 L 34.605469 50 C 35.992188 50 37.175781 48.90625 37.300781 47.515625 L 40.914063 7 L 42 7 C 42.554688 7 43 6.550781 43 6 C 43 5.449219 42.554688 5 42 5 Z M 20 44 C 20 44.554688 19.550781 45 19 45 C 18.449219 45 18 44.554688 18 44 L 18 11 C 18 10.449219 18.449219 10 19 10 C 19.550781 10 20 10.449219 20 11 Z M 20 3 C 20 2.449219 20.449219 2 21 2 L 29 2 C 29.550781 2 30 2.449219 30 3 L 30 5 L 20 5 Z M 26 44 C 26 44.554688 25.550781 45 25 45 C 24.449219 45 24 44.554688 24 44 L 24 11 C 24 10.449219 24.449219 10 25 10 C 25.550781 10 26 10.449219 26 11 Z M 32 44 C 32 44.554688 31.554688 45 31 45 C 30.445313 45 30 44.554688 30 44 L 30 11 C 30 10.449219 30.445313 10 31 10 C 31.554688 10 32 10.449219 32 11 Z"></path>
                                    </svg>
                            </button>
                        </li>
                    @endforeach
                </ul>

                {{-- Filtering Todos and clear completed todos --}}
                <footer>
                    <ul class="filters flex space-x-4 mt-5 mb-4">
                        <li>

                            <button wire:click="setFilter('all')" class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">All</button>
                        </li>
                        <li>
                            <button wire:click="setFilter('active')" class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">Active</button>
                        </li>
                        <li>
                            <button wire:click="setFilter('completed')" class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">Completed</button>
                        </li>
                    </ul>

                    <!-- Hidden if no completed items are left ↓ -->
                    <button wire:click="clearCompleted" x-data
                        x-model="open  {{ $todos->where('completed', true)->count() > 0 ? 'true' : 'false' }}"
                        x-show="open"
                        class="clear-completed bg-transparent text-red-500 hover:text-red-700 font-semibold py-2 px-4 border border-red-500 hover:border-red-700 rounded">
                        Clear completed
                    </button>
                </footer>

            </div>

            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('todos', () => ({
                        todos: @json($todos),
                        filterTodos(type) {
                            if (type === 'all') {
                                this.todos.forEach(todo => todo.completed = true);
                            } else if (type === 'active') {
                                this.todos.forEach(todo => todo.completed = !todo.completed);
                            } else if (type === 'completed') {
                                this.todos.forEach(todo => todo.completed = todo.completed);
                            }
                        },
                    }))
                })
            </script>
        </div>
    </div>
</div>
