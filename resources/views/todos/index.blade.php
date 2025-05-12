@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Todo Liste</h1>
        <a href="{{ route('todos.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Neue Aufgabe
        </a>
    </div>

    <div class="bg-white rounded shadow">
        @foreach($todos as $todo)
        <div class="p-4 border-b flex items-center justify-between hover:bg-gray-50">
            <div class="flex items-center space-x-4">
                <!-- Sofort-Update-Formular -->
                <form action="{{ route('todos.update', $todo) }}" 
                      method="POST" 
                      id="form-{{ $todo->id }}"
                      class="hidden">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="task" value="{{ $todo->task }}">
                    <input type="hidden" name="date" value="{{ $todo->date }}">
                    <input type="checkbox" name="completed" value="1" {{ $todo->completed ? 'checked' : '' }}>
                </form>

                <!-- Visuelle Checkbox -->
                <input type="checkbox" 
                       class="w-5 h-5 cursor-pointer transition-colors"
                       {{ $todo->completed ? 'checked' : '' }}
                       onchange="document.getElementById('form-{{ $todo->id }}').submit()">

                <!-- Aufgaben-Text mit dynamischer Formatierung -->
                <span class="text-lg {{ $todo->completed ? 'line-through text-gray-400' : 'text-gray-700' }}">
                    {{ $todo->task }}
                    @if($todo->date)
                    <span class="text-sm text-gray-500 ml-2">
                        📅 {{ $todo->date->format('d.m.Y') }}
                    </span>
                    @endif
                </span>
            </div>

            <!-- Action-Buttons -->
            <div class="flex space-x-2">
                <a href="{{ route('todos.edit', $todo) }}" 
                   class="text-yellow-600 hover:text-yellow-800 px-3 py-1 rounded transition-colors">
                    ✏️ Bearbeiten
                </a>
                <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="text-red-600 hover:text-red-800 px-3 py-1 rounded transition-colors"
                            onclick="return confirm('Wirklich löschen?')">
                        🗑️ Löschen
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection