<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
   public function index()
{
    $todos = Todo::where('user_id', auth()->id())
             ->latest()
             ->orderBy('created_at', 'desc')
             ->get();

    
    return view('todos.index', compact('todos'));
}

    public function create()
    {
        return view('todos.create');
    }

public function store(Request $request)
{
    // Validierte Felder holen
    $validated = $request->validate([
        'task' => 'required|max:255',
        'date' => 'nullable|date_format:Y-m-d'
    ]);

    // user_id hinzufügen
    $validated['user_id'] = auth()->id();
    $validated['completed'] = false;
    $validated['date'] = $validated['date'] ?: null;

    // speichern
    Todo::create($validated);

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