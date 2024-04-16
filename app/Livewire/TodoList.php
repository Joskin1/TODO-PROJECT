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
    public $editingTodoID;
    public $editingTodoName;

    public function create()
    {
        $validatedData = $this->validate([
            'title' => 'required|min:3|max:50',
        ]);

        Todo::create([
            'title' => $validatedData['title'],
            'user_id' => request()->user()->id,
        ]);

        $this->reset('title');
        session()->flash("success", __("submitted"));
    }
    public function delete($todoID)
    {
       Todo::find($todoID)->delete();
    }
    public function toggle($todoID)
    {
        $todo = Todo::find($todoID);
        $todo->completed = ! $todo->completed;
        $todo->save();
    }
    public function render(){
        $userId = Auth::id();
        $todos = Todo::where('user_id', $userId)->get();

        return view('livewire.todo-list', [
            'todos' => $todos
        ]);
    }
}
