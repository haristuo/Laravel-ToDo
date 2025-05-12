@extends('layouts.app')

@section('title', 'Neue Aufgabe erstellen')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-6 pb-2 border-b">Neue Aufgabe</h2>
    
    <form method="POST" action="{{ route('todos.store') }}">
        @csrf
        
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Aufgabe *
                </label>
                <input 
                    type="text" 
                    name="task" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Aufgabenbeschreibung"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Fälligkeitsdatum
                </label>
                <input 
                    type="date" 
                    name="date"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('todos.index') }}" 
                   class="px-4 py-2 text-gray-600 hover:text-gray-800">
                    Abbrechen
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Aufgabe anlegen
                </button>
            </div>
        </div>
    </form>
</div>
@endsection