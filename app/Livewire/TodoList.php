<?php

namespace App\Livewire;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    #[Rule("required|min:3|max:50")]
    public $title;
    public $search;
    public $editedTitle;
    public $editingTodoID;
    public $editingTodoName;
    public $filter = 'all';

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }


    public function create()
    {
        $validatedData = $this->validate([
            'title' => 'required|min:3|max:50',
        ]);

        Todo::create([
            'title' => $validatedData['title'],
            'user_id' => request()->user()->id,
        ]);

        $this->title = null;
        session()->flash("success", __("submitted"));
    }

    public function editTodo($todoId)
    {
        $this->editingTodoID = $todoId;
        $this->editedTitle = Todo::findOrFail($todoId)->title;
    }
    public function updateTodo()
    {
        $todo = Todo::findOrFail($this->editingTodoID);
        $todo->title = $this->editedTitle;
        $todo->save();
        $this->editingTodoID = null; // Reset edit mode
    }

    public function cancelEdit()
    {
        $this->editingTodoID = null; // Reset edit mode
    }
    public function deleteTodo($todoID)
    {
        Todo::find($todoID)->delete();
    }

    public function clearCompleted()
    {
        Todo::where('completed', true)->delete();
    }
    public function toggle($todoID)
    {
        $todo = Todo::find($todoID);
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    public function render()
    {
        $userId = Auth::id();
        $query = Todo::where('user_id', $userId);

        // Apply search filter if provided
        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%");
        }

        // Apply filter based on the selected filter
        if ($this->filter === 'active') {
            $query->where('completed', false);
        } elseif ($this->filter === 'completed') {
            $query->where('completed', true);
        }

        $todos = $query->latest()->get();

        return view('livewire.todo-list', [
            'todos' => $todos
        ]);
    }
}
