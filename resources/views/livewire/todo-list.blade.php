<div x-data="{ todos: <?= json_encode($todos->toArray()) ?> }">
    <div>
        <h1 class="text-gray-500">Todo List</h1>
        <template x-for="todo in todos" :key="todo.id">
            <li x-text="todo.title" ></li>
        </template>
    </div>
</div>
