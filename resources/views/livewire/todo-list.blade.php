<div x-data="todos">
    <div>
        <h1 class="text-gray-500">Todo List</h1>
        <ul>
            <template x-for="todo in todos" :key="todo.id">
                <li x-text="todo.title" ></li>
            </template>
        </ul>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('todos', () => ({
                todos: @json($todos),
            }))
        })
    </script>
</div>
