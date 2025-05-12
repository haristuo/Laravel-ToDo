<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return view('todos.index', [
            'todos' => Todo::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'task' => 'required|max:255',
        'date' => 'nullable|date_format:Y-m-d' // Explizites Format
    ]);

    Todo::create([
        'task' => $request->task,
        'date' => $request->date ?: null, // Konvertiere leere Strings zu null
        'completed' => false
    ]);

    return redirect()->route('todos.index');
}

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        // Explizite Wertezuweisung
        $data = [
            'completed' => $request->has('completed'),
            'task' => $request->input('task', $todo->task),
            'date' => $request->input('date', $todo->date)
        ];
    
        $todo->update($data);
        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index');
    }
}